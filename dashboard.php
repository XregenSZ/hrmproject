<?php
session_start();
$open_connect = 1;
require('config/config.php');
require('config/role_check.php');
include('config/chart.php');
$today = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/dashboard.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <link rel="stylesheet" href="style/font.php">
    <title>Dashboard</title>
    <script>
        window.onload = function() {
            var activeCount = <?php echo $active_count; ?>;
            var inactiveCount = <?php echo $inactive_count; ?>;

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                title: {
                    text: "จำนวนพนักงานบันทึกเข้างานวันนี้"
                },
                data: [{
                    type: "pie",
                    showInLegend: true,
                    legendText: "{label}",
                    indexLabelFontSize: 16,
                    indexLabel: "{label} - #percent%",
                    yValueFormatString: "#,##0",
                    dataPoints: [{
                            label: "บันทึกเข้างานแล้ว",
                            y: activeCount
                        },
                        {
                            label: "ยังไม่ได้บันทึกเข้างาน",
                            y: inactiveCount
                        }
                    ]
                }]
            });
            chart.render();

            chart.options.data[0].click = function(e) {
                if (e.dataPoint.label === "ยังไม่ได้บันทึกเข้างาน") {
                    showInactiveCount(inactiveCount);
                }
            };
        }

        function showInactiveCount(count) {
            alert("จำนวนผู้ไม่ได้บันทึกเข้างาน: " + count);
        }
    </script>
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
                                                <li class="nav-item border-top"><a class="nav-link fs-6 sub-btn-hover" href="dashboard_io.php">ข้อมูลบันทึกเวลางานทั้งหมด</a></li>
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
        <div class="flex-grow-1 ms-3 container text-center">
            <div class="row fs-5 mt-5">
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

            <!-- request leave dashboard -->
            <div class="container m-auto justify-content-center text-center mt-5 border-top">
                <?php
                $query_date = "SELECT * FROM work_io WHERE workdate = '$today' ORDER BY id DESC";
                $result_today = mysqli_query($conn, $query_date);
                ?>
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                <h3 class="mt-3 border-top pt-3">Activitys today / บันทึกเวลาทำงานวันนี้</h3>

                <div class="mt-5">
                    <table class="table table-hover text-center m-auto table table-success table-striped table-hover mt-2">
                        <thead class="align-item-center">
                            <tr>
                                <th>รหัสพนักงาน</th>
                                <th>เวลาเข้างาน</th>
                                <th>เวลาออกงาน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result_today as $today_io) { ?>
                                <tr>
                                    <td><?php echo $today_io['emp_id'] ?></td>
                                    <td><?php echo $today_io['work_in'] ?></td>
                                    <td><?php echo $today_io['work_out'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            include('config/pagination.php');
            $query = "SELECT * FROM work_io limit {$start} , {$perpage}";
            $result = mysqli_query($conn, $query);

            $query2 = "SELECT * FROM work_io WHERE workdate = '$today'";
            $result2 = mysqli_query($conn, $query2);
            $total_record = mysqli_num_rows($result2);
            $total_page = ceil($total_record / $perpage);
            ?>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <a href="dashboard.php?page=1" class="page-link" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <li class="page-item"><a href="dashboard.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <li class="page-item">
                        <a href="dashboard.php?page=<?php echo $total_page; ?>" class="page-link" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#dashboardLink').on('click', function() {
                $(this).toggleClass('active');
            });
        });
    </script>
</body>
</html>