<?php
session_start();
$open_connect = 1;
require('config/config.php');
require('config/role_check.php');
$today = date('Y-m-d');
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

        <!-- query -->
        <?php
        if (!isset($_SESSION['account_id'])) {
        } else {
            $query_member_count = "SELECT COUNT(account_id) AS total_members FROM user_account";
            $result_member_count = mysqli_query($conn, $query_member_count);

            if ($result_member_count) {
                $row = mysqli_fetch_assoc($result_member_count);
                $total_members = $row['total_members'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            // request count
            $query_req_count = "SELECT COUNT(status) AS total_req FROM resleave WHERE status = 'request'";
            $result_req_count = mysqli_query($conn, $query_req_count);

            if ($result_req_count) {
                $row_req = mysqli_fetch_assoc($result_req_count);
                $total_req = $row_req['total_req'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            // approve count
            $query_approve_count = "SELECT COUNT(status) AS total_approve FROM resleave WHERE status = 'approve'";
            $result_approve_count = mysqli_query($conn, $query_approve_count);

            if ($result_approve_count) {
                $row_approve = mysqli_fetch_assoc($result_approve_count);
                $total_approve = $row_approve['total_approve'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            // reject count
            $query_reject_count = "SELECT COUNT(status) AS total_reject FROM resleave WHERE status = 'decline'";
            $result_reject_count = mysqli_query($conn, $query_reject_count);

            if ($result_reject_count) {
                $row_reject = mysqli_fetch_assoc($result_reject_count);
                $total_reject = $row_reject['total_reject'];
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
        ?>

        <!-- right content -->
        <div class="flex-grow-1 mt-5 ms-3 container text-center">
            <div class="row fs-5">
                <div class="col-12 col-md-6 col-xl-3">
                    <a href="dashboard_leave_admin.php">
                        <div class="p-1 bg-success border rounded-4 d-inline-flex text-white p-3">
                            <img src="images/humancheck.png" alt="" width="86px" class="me-3">
                            <p class="m-auto">คำขออนุมัติลา<br><?php echo $total_req; ?> <br>รออนุมัติ</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <a href="dashboard_approve_admin.php">
                        <div class="p-1 bg-info border rounded-4 d-inline-flex text-white p-3">
                            <img src="images/check.png" alt="" width="86px" class="me-3">
                            <p class="m-auto">คำขออนุมัติลา<br><?php echo $total_approve; ?> <br>อนุมัติ</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <a href="dashboard_decline_admin.php">
                        <div class="p-1 bg-danger border rounded-4 d-inline-flex text-white p-3">
                            <img src="images/x-mark.png" alt="" width="86px" class="me-3">
                            <p class="m-auto">คำขออนุมัติลา<br><?php echo $total_reject; ?> <br>ไม่อนุมัติ</p>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <a href="member.php">
                        <div class="p-1 border rounded-4 d-inline-flex text-white p-3" style="background-color: #CD35CD;">
                            <img src="images/user.png" alt="" width="86px" class="me-3">
                            <p class="m-auto">สมาชิก<br><?php echo $total_members; ?> <br>รายชื่อสมาชิก</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- sort data-->
            <div class="container m-auto justify-content-center text-center mt-5 border-top">
                <?php
                $query = "SELECT * FROM resleave WHERE status = 'request'";
                $result = mysqli_query($conn, $query);
                ?>
                <h3>Request List</h3>
                <div class="mt-5">
                    <table class="table table-hover border border-dark text-center m-auto table table-dark table-striped table-hover">
                        <thead class="align-item-center">
                            <tr>
                                <th>ID</th>
                                <th>วัน-เวลา ที่ร้องขอ</th>
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
                            <?php foreach ($result as $value) { ?>
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
                                        <?php } else if ($value['status'] == 'request'){ ?>
                                            <button class="btn btn-warning"><?php echo $value['status'] ?></button>
                                        <?php } else { ?>
                                            <button class="btn btn-danger"><?php echo $value['status'] ?></button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary view_data" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            ดูรายละเอียด
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="date_script.js"></script>
    <script src="get_id_script.js"></script>
</body>

</html>