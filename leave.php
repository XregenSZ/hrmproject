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
    <link rel="stylesheet" href="style/leave.css" />
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

                <!-- SideBar -->
                <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <!-- Sidebar Header -->
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            <img src="images/myhr.png" alt="" style="width: 100px; height: 100px" />
                        </h5>
                        <button type="button" class="btn-close btn-close white me-3" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

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
            </div>
        </nav>
        <!-- main content -->
        <div class="flex-grow-1 mt-5 ms-3 container">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                ยื่นคำร้องขอ ลางาน
            </button>

            <!-- Modal -->
            <?php if (!isset($_SESSION['account_id'])) {
            } else {
                $user_id = $_SESSION['account_id'];
                $sql = "SELECT * FROM user_info WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $sql);
                $result_show = mysqli_fetch_assoc($result);
            } ?>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">ลากิจส่วนตัว</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="config/process_leave_info.php" method="post" enctype="multipart/form-data" class="upload-form">
                                <div class="row">
                                    <input type="hidden" class="form-control" name="emp_id" value="<?php echo $result_show['user_id'] ?>">
                                    <p id="result"></p>
                                    <div class="col-sm-6">
                                        <label for="start_date" class="form-label">วันที่ลา <font color="red">*</font></label>
                                        <input type="date" id="start_date" name="start_date" class="form-control" onchange="calculateDateDifference()" require>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="end_date" class="form-label">ถึงวันที่ <font color="red">*</font></label>
                                        <input type="date" id="end_date" name="end_date" class="form-control" onchange="calculateDateDifference()" require>
                                    </div>
                                </div>
                                <div class="mt-2 row pt-2">
                                    <div class="col-6">
                                        <img src="images/user_2.png" alt="" style="width: 22px; height: 22px; object-fit: cover;" class="mx-2" />
                                        <label for="">ชื่อ : <?php echo $result_show['first_name'] ?></label>
                                        <input type="hidden" class="form-control" name="f_name" value="<?php echo $result_show['first_name'] ?>">
                                    </div>
                                    <div class="col-6">
                                        <label for="">นามสกุล : <?php echo $result_show['last_name'] ?></label>
                                        <input type="hidden" class="form-control" name="l_name" value="<?php echo $result_show['last_name'] ?>">
                                    </div>
                                    <div class="pt-2 col-12">
                                        <img src="images/white_check.png" alt="" style="width: 22px; height: 22px; object-fit: cover;" class="mx-2" />
                                        <label for="">ตำแหน่ง : <?php echo $result_show['position'] ?></label>
                                        <input type="hidden" class="form-control" name="position" value="<?php echo $result_show['position'] ?>">
                                    </div>
                                    <div class="mt-3 pt-2 col-12 border-top">
                                        <label for="" class="form-label">รายละเอียด/เหตุผลการลา</label>
                                        <textarea name="reason_info" class="form-control" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">ไฟล์แนบ</label>
                                        <input type="file" class="form-control" name="file" accept="image/gif, image/jpeg, image/png">
                                    </div>
                                    <div class=" modal-footer">
                                        <button type="submit" name="submit" id="submitBtn" class="btn btn-primary">ส่งคำร้องขอ</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- sort data-->
            <div class="container m-auto justify-content-center text-center mt-5 border-top">
                <?php
                $emp_id = $_SESSION['account_id'];
                $query = "SELECT * FROM resleave WHERE emp_id = '$emp_id' ORDER BY leave_id DESC";
                $result = mysqli_query($conn, $query);
                ?>
                <h3>My Request List</h3>
                <div class="mt-5">
                    <table class="table table-hover border border-dark text-center m-auto table table-dark table-striped table-hover">
                        <thead class="align-item-center">
                            <tr>
                                <th>ID</th>
                                <th>วันที่ร้องขอ</th>
                                <th>เริ่มลาวันที่</th>
                                <th>ถึงวันที่</th>
                                <th>รหัสพนักงาน</th>
                                <th>ชือ</th>
                                <th>นามสกุล</th>
                                <th>ตำแหน่ง</th>
                                <th>req_status</th>
                                <th>detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!$result) {
                                die("Query failed: " . mysqli_error($conn));
                            }
                            if (mysqli_num_rows($result) > 0){
                                foreach ($result as $value) { ?>
                                <tr>
                                    <td class="res_leave_id"><?php echo $value['leave_id'] ?></td>
                                    <td><?php echo $value['create_date'] ?></td>
                                    <td><?php echo $value['start_date'] ?></td>
                                    <td><?php echo $value['end_date'] ?></td>
                                    <td><?php echo $value['emp_id'] ?></td>
                                    <td><?php echo $value['f_name'] ?></td>
                                    <td><?php echo $value['l_name'] ?></td>
                                    <td><?php echo $value['emp_position'] ?></td>
                                    <td><?php if ($value['status'] == 'approve') { ?>
                                            <button class="btn btn-success"><?php echo $value['status'] ?></button>
                                        <?php } else { ?>
                                            <button class="btn btn-danger"><?php echo $value['status'] ?></button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary view_data" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                            ดูรายละเอียด
                                        </button>
                                    </td>
                                </tr>
                            <?php } 
                            } else {
                                echo "No data found.";
                            }?>
                        </tbody>
                    </table>
                    <!-- Modal -->
                    <?php if (!isset($_SESSION['account_id'])) {
                    } else {
                        $user_id = $_SESSION['account_id'];
                        $sql = "SELECT * FROM user_info WHERE user_id = '$user_id'";
                        $result = mysqli_query($conn, $sql);
                        $result_show = mysqli_fetch_assoc($result);
                    } ?>
                    <div class="modal fade" id="viewusermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                        <font color="black">รายละเอียด ลากิจส่วนตัว</font>
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body view_user_data">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="date_script.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="get_id_script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("submitBtn").addEventListener("click", function() {
                document.querySelector(".upload-form").submit();
            });
        });
    </script>
</body>

</html>