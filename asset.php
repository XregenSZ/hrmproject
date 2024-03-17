<?php
session_start();
$open_connect = 1;
require('config/config.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/dashboard.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>

<body>
    <div class="d-flex">
        <nav class="navbar navbar-expand-lg fixed-left sidebar border-end">
            <div class="container-fluid flex-lg-column">
                <!-- Logo -->
                <a class="navbar-brand m-auto" href="#"><img src="images/myhr.png" alt="" width="100px" height="100px" /></a>
                <!-- Toggle Btn -->
                <button class="navbar-toggler shadow-nona border 0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Sidebar Body -->
                <div class="offcanvas-body d-flex flex-column p-4 p-lg-0">
                    <ul class="navbar-nav justify-content-center  fs-5 flex-grow-1 flex-lg-column">
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <li class="nav-item border-top">
                                <a class="nav-link active main-btn-hover" id="dashboardLink" data-bs-toggle="collapse" href="#collapseExample"><img src="images/layout.png" alt="" style="width: 3rem; height: 2rem;" class="px-2">แดชบอร์ด</a>
                                <div class="collapse" id="collapseExample">
                                    <div class="container">
                                        <ul class="p-0">
                                            <li class="nav-item border-top"><a class="nav-link fs-6 sub-btn-hover" href="dashboard.php">หน้าแดชบอร์ด</a></li>
                                            <li class="nav-item border-top"><a class="nav-link fs-6" href="dashboard.php">ข้อมูลบันทึกเวลางานทั้งหมด</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                        <li class="nav-item border-top">
                            <a class="nav-link main-btn-hover" href="workio.php"><img src="images/clock.png" alt="" style="width: 3rem; height: 2rem;" class="px-2">บันทึกเวลาทำงาน</a>
                        </li>
                        <li class="nav-item border-top">
                            <a class="nav-link main-btn-hover" href="leave.php"><img src="images/notice.png" alt="" style="width: 3rem; height: 2rem;" class="px-2">ระบบลางาน</a>
                        </li>
                        <li class="nav-item border-top">
                            <a class="nav-link main-btn-hover" href="info.php"><img src="images/personal-data.png" alt="" style="width: 3rem; height: 2rem;" class="px-2">ข้อมูลของฉัน</a>
                        </li>
                        <li class="nav-item border-top">
                            <a class="nav-link main-btn-hover" href="asset.php"><img src="images/office-supplies.png" alt="" style="width: 3rem; height: 2rem;" class="px-2">อุปกรณ์</a>
                        </li>
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <li class="nav-item border-top">
                                <a class="nav-link main-btn-hover" href="member.php"><img src="images/team.png" alt="" style="width: 3rem; height: 2rem;" class="px-2">สมาชิก</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <!-- Login / Sign Up -->
                    <div class="d-flex justify-content-center align-items-center gap-3 mt-5">
                        <a href="/hrproject/config/logout.php" class="text-white text-decoration-none px-3 py-1 rounded-4" style="background-color: #f94ca4">Sign out</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- user -->
        <?php
        if (!isset($_SESSION['account_id'])) {
        } else {
            $user_id = $_SESSION['account_id'];
            $sql = "SELECT * FROM user_info WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            $result_show = mysqli_fetch_assoc($result);
        }
        ?>

        <!-- -Main info -->
        <div class="container mt-5 m-auto">

            <?php
            $query = "SELECT * FROM asset";
            $result = mysqli_query($conn, $query);

            // request count
            $query_req_count = "SELECT COUNT(status) AS total_req FROM asset_borrow WHERE status = 'request'";
            $result_req_count = mysqli_query($conn, $query_req_count);

            if ($result_req_count) {
                $row_req = mysqli_fetch_assoc($result_req_count);
                $total_req = $row_req['total_req'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            // approve count
            $query_approve_count = "SELECT COUNT(status) AS total_approve FROM asset_borrow WHERE status = 'approve'";
            $result_approve_count = mysqli_query($conn, $query_approve_count);

            if ($result_approve_count) {
                $row_approve = mysqli_fetch_assoc($result_approve_count);
                $total_approve = $row_approve['total_approve'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            // reject count
            $query_reject_count = "SELECT COUNT(status) AS total_reject FROM asset_borrow WHERE status = 'decline'";
            $result_reject_count = mysqli_query($conn, $query_reject_count);

            if ($result_reject_count) {
                $row_reject = mysqli_fetch_assoc($result_reject_count);
                $total_reject = $row_reject['total_reject'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            ?>
            <?php
            if ($_SESSION['role'] == 'admin') { ?>
                <div class="row fs-5 mt-5 text-center">
                    <div class="col-12 col-md-6 col-xl-4">
                        <a href="asset_request.php">
                            <div class="p-1 bg-success border rounded-4 d-inline-flex text-white p-3 align-items-center justify-content-center">
                                <img src="images/digital-asset-management.png" alt="" width="86px" class="me-3">
                                <p class="m-auto">คำขอยืมอุปกรณ์<br><?php echo $total_req; ?> <br>รออนุมัติ</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                        <a href="asset_approve.php">
                            <div class="p-1 bg-info border rounded-4 d-inline-flex text-white p-3 align-items-center justify-content-center">
                                <img src="images/check.png" alt="" width="86px" class="me-3">
                                <p class="m-auto">คำขอยืมอุปกรณ์<br><?php echo $total_approve; ?> <br>อนุมัติ</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-xl-4">
                        <a href="asset_decline.php">
                            <div class="p-1 bg-danger border rounded-4 d-inline-flex text-white p-3 align-items-center justify-content-center">
                                <img src="images/x-mark.png" alt="" width="86px" class="me-3">
                                <p class="m-auto">คำขอยืมอุปกรณ์<br><?php echo $total_reject; ?> <br>ไม่อนุมัติ</p>
                            </div>
                        </a>
                    </div>
                </div> <?php } ?>
            <h3 class="text-center mt-5 pt-3 border-top">Asset </h3>
            <div class="mt-5">
                <!-- Button trigger modal -->
                <div class="">
                    <?php
                    if ($_SESSION['role'] == 'admin') { ?>
                        <button type="submit" name="submit" id="submitBtny" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img src="images/plus.png" style="width : 26px;"> เพิ่มอุปกรณ์</button>
                    <?php } ?>
                    <button type="submit" name="submit" id="submitBtny" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop2"><img src="images/solidarity.png" style="width : 26px;"> ขอยืมอุปกรณ์</button>
                </div>

                <!-- add asset modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">เพิ่มอุปกรณ์</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="config/process_asset_info.php" method="post" enctype="multipart/form-data" class="upload-form">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label for="start_date" class="form-label">ชื่ออุปกรณ์ <font color="red">*</font></label>
                                            <input type="text" id="asset_name" name="asset_name" class="form-control" require>
                                        </div>
                                    </div>
                                    <div class="mt-2 row pt-2">
                                        <div class="mt-3 pt-2 col-12 border-top">
                                            <label for="" class="form-label">รายละเอียด/Details</label>
                                            <textarea name="asset_detail" class="form-control" cols="30" rows="10"></textarea>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label class="form-label">รูปภาพ/ไฟล์แนบ</label>
                                            <input type="file" class="form-control" name="asset_file" accept="image/gif, image/jpeg, image/png">
                                        </div>
                                        <div class=" modal-footer">
                                            <button type="submit" name="submit" id="submitBtn" class="btn btn-primary">ยืนยันเพิ่มอุปกรณ์ใหม่</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- borrow asset modal -->
                <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">ขอยืมอุปกรณ์</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="config/process_asset_borrow.php" method="post" enctype="multipart/form-data" class="upload-form">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label for="asset_id" class="form-label">เลือกอุปกรณ์ที่ต้องการยืม <font color="red">*</font></label>
                                            <select id="asset_id" name="asset_id" class="form-select" required>
                                                <option value="">-- เลือกอุปกรณ์ --</option>
                                                <?php
                                                // Query for unused assets
                                                $get_unused_assets_query = "SELECT * FROM asset WHERE emp_borrow_id IS NULL";
                                                $unused_assets_result = mysqli_query($conn, $get_unused_assets_query);
                                                if ($unused_assets_result && mysqli_num_rows($unused_assets_result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($unused_assets_result)) {
                                                        echo "<option value='" . $row['asset_id'] . "'>" . $row['asset_name'] . "</option>";
                                                    }
                                                } else {
                                                    echo "<option disabled>No unused assets available</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="emp_id" value="<?php echo $result_show['user_id'] ?>">
                                    <p id="result" class="mt-4 text-center"></p>
                                    <div class="mt-2 row pt-2">
                                        <div class="col-sm-6">
                                            <label for="start_date" class="form-label">วันที่ยืม <font color="red">*</font></label>
                                            <input type="date" id="start_date" name="start_date" class="form-control" onchange="calculateDateDifference()" require>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="end_date" class="form-label">ถึงวันที่ <font color="red">*</font></label>
                                            <input type="date" id="end_date" name="end_date" class="form-control" onchange="calculateDateDifference()" require>
                                        </div>
                                        <div class="mt-2 row pt-2">
                                            <div class="mt-3 pt-2 col-12 border-top">
                                                <label for="borrow_reason" class="form-label">เหตุผลที่ต้องการยืม</label>
                                                <textarea name="borrow_reason" id="borrow_reason" class="form-control" cols="30" rows="5"></textarea>
                                            </div>
                                            <div class=" modal-footer">
                                                <button type="submit" name="submit" id="submitBtn" class="btn btn-primary">ยืนยันการยืมอุปกรณ์</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- show data -->
                <table class="table table-hover border border-dark text-center m-auto table table-dark table-striped table-hover">
                    <thead class="align-item-center">
                        <tr>
                            <th>Pic</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Detail</th>
                            <th>EmpUsed</th>
                            <?php if ($_SESSION['role'] == 'admin') { ?>
                                <th></th>
                                <th></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><img src="config/asset/<?php echo $row['asset_file'] ?>" alt="" class="rounded-circle" style="width: 42px; height: 42px; object-fit: cover;"></td>
                                <td class="res_leave_id"><?php echo $row['asset_id'] ?></td>
                                <td><?php echo $row['asset_name'] ?></td>
                                <td><?php echo $row['asset_detail'] ?></td>
                                <?php if ($row['emp_borrow_id'] != NULL) { ?>
                                    <td><button class="btn btn-warning">พนักงานรหัส <?php echo $row['emp_borrow_id'] ?> กำลังใช้งานอยู่</button></td>
                                <?php } else { ?>
                                    <td>
                                        <button class="btn btn-success">สามารถขอยืมใช้งานได้</button>
                                    </td>
                                <?php } ?>
                                <?php if ($_SESSION['role'] == 'admin') { ?>
                                    <td>
                                        <button type="button" class="btn btn-primary view_data_asset" data-bs-toggle="modal" data-bs-target="#staticBackdrop3">
                                            แก้ไขข้อมูล
                                        </button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger delete_data_asset" data-bs-toggle="modal" data-bs-target="#staticBackdrop4">
                                            ลบข้อมูล
                                        </button>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="modal fade modal-xl" id="viewusermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                        <font color="black">รายละเอียด ข้อมูล</font>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body view_asset_data">
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="get_asset_id_script.js"></script>
    <script src="date_borrow_script.js"></script>
</body>

</html>