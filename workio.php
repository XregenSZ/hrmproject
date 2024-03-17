<?php
session_start();
$open_connect = 1;
require('config/config.php');

date_default_timezone_set('Asia/Bangkok');
$timenow = date('H:i:s');
$datenow = date('Y-m-d');
$emp_id = $_SESSION['account_id'];
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

        <!-- -Main info -->
        <?php
        $query = "SELECT * FROM user_info WHERE user_id = $emp_id";
        $result = mysqli_query($conn, $query);
        $call_back_result = mysqli_fetch_assoc($result);

        $queryworkio = "SELECT MAX(workdate) as lastdate, work_in, work_out FROM work_io WHERE emp_id = $emp_id AND workdate = '$datenow' ORDER BY id DESC";
        $resultio = mysqli_query($conn, $queryworkio) or die("Error in query: $queryworkio " . mysqli_error($conn));
        $rowio = mysqli_fetch_assoc($resultio);

        $querylist = "SELECT * FROM work_io WHERE emp_id = $emp_id ORDER BY workdate DESC";
        $resultlist = mysqli_query($conn, $querylist)  or die("Error:" . mysqli_error($conn));
        ?>
        <div class="container mt-5 m-auto justify-content-center">
            <h3 class="text-center">ระบบบันทึกเวลา เข้า-ออก ทำงาน</h3>
            <?php if (empty($call_back_result['img'])) { ?>
                <div class="d-flex justify-content-center mb-4 mt-5">
                    <img id="selectedAvatar" src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                </div>
            <?php } else { ?>
                <div class="d-flex justify-content-center mb-4 mt-5">
                    <img id="selectedAvatar" src="config/uploads/<?php echo $call_back_result['img'] ?>" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                </div>
            <?php } ?>
            <div class="text-center">
                <p>ID : <?php echo $emp_id; ?></p>
                <p>ชื่อ : <?php echo $call_back_result['first_name']; ?> <?php echo $call_back_result['last_name'] ?></p>
                <p>ตำแหน่ง : <?php echo $call_back_result['position']; ?></p>
            </div>
            <div class="mt-4 justify-content-center m-auto text-center">
                <h4>ลงเวลาเข้า-ออกงาน</h4>
                <form action="config/process_workio.php" class="justify-content-center" method="post">
                    <div class="form-group row justify-content-center">
                        <div class="col-sm-4">
                            <label for="m_id">รหัสพนักงาน</label>
                            <input type="text" class="form-control text-center" name="m_id" placeholder="รหัสพนักงาน" value="<?php echo $emp_id; ?>" readonly>
                        </div>
                        <div class="col-sm-4 ">
                            <label for="m_id">เวลาเข้างาน</label>
                            <?php if (isset($rowio['work_in'])) { ?>
                                <input type="text" class="form-control text-center" name="workin" value="<?php echo $rowio['work_in']; ?>" disabled>
                            <?php } else { ?>
                                <input type="text" class="form-control text-center" name="workin" value="<?php echo date('H:i:s'); ?>" readonly>
                            <?php  } ?>
                        </div>
                        <div class="col-sm-4">
                            <label for="m_id">เวลาออกงาน</label>
                            <?php
                            if (!empty($rowio['work_in'])) {
                                if (isset($rowio['work_out'])) { ?>
                                    <input type="text" class="form-control text-center" name="workout" value="<?php echo $rowio['work_out']; ?>" disabled>
                                <?php } else { ?>
                                    <input type="text" class="form-control text-center" name="workout" value="<?php echo date('H:i:s'); ?>" readonly>
                            <?php
                                }
                            } else {
                                echo '<br><font color="red"> กรุณาบันทึกเวลาเข้างานก่อน </font>';
                            } ?>
                        </div>
                        <?php
                        if (!empty($rowio['work_in'])) {
                            if (isset($rowio['work_out'])) { ?>
                                <div class="col-sm-12 text-center mt-3">
                                    <button type="submit" class="btn btn-success" disabled>คุณได้บันทึกเวลา เข้างาน แล้ว</button>
                                </div>
                            <?php } else { ?>
                                <div class="col-sm-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary">บันทึกเวลา ออกงาน</button>
                                </div>
                        <?php
                            }
                        } else {
                            echo '<div class="col-sm-12 text-center mt-3">
                                    <button type="submit" class="btn btn-primary">บันทึกเวลา เข้างาน</button>
                                    </div>';
                        }
                        ?>

                    </div>
                </form>

                <table class="table table-bordered table-striped mt-4">
                    <thead>
                        <tr class="table-danger">
                            <td class="col-sm-4">date</td>
                            <td class="col-sm-4">work-in</td>
                            <td class="col-sm-4">work-out</td>
                        </tr>
                    </thead>
                    <?php foreach ($resultlist as $value) { ?>
                        <tr>
                            <td><?php echo $value['workdate'] ?></td>
                            <td><?php echo $value['work_in'] ?></td>
                            <td><?php echo $value['work_out'] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

</body>

</html>