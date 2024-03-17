<?php
session_start();
$open_connect = 1;
require('config/config.php');
if (!isset($_SESSION['account_id']) || !isset($_SESSION['role'])) {
    header('Location: /hrproject/login.php');
    exit();
}
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
        <div class="container mt-5">
            <?php
            if (!isset($_SESSION['account_id'])) {
            } else {
                $user_id = $_SESSION['account_id'];
                $sql = "SELECT * FROM user_info WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $sql);
                $result_show = mysqli_fetch_assoc($result);
            }
            ?>

            <h3 class="text-center">Infomation</h3>
            <div class="rounded bg-white p-4">
                <form action="config/process_add_info.php" method="post" enctype="multipart/form-data" class="upload-form">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <?php if (empty($result_show['img'])) { ?>
                        <div class="d-flex justify-content-center mb-4">
                            <img id="selectedAvatar" src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                        </div>
                    <?php } else { ?>
                        <div class="d-flex justify-content-center mb-4">
                            <img id="selectedAvatar" src="config/uploads/<?php echo $result_show['img'] ?>" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                        </div>
                    <?php } ?>
                    <div class="mb-3 row d-flex align-items-center justify-content-center">
                        <div class="align-items-center justify-content-center col-sm-6">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="inputGroupFile01">Select an image</label>
                                <input type="file" class="form-control" id="inputGroupFile01" name="imageName" value="<?php echo $result_show['img'] ?>" accept="image/gif, image/jpeg, image/png">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row justify-content-center">
                        <div class="col-sm-6">
                            <div id="profileTitleHelp" class="form-text">ชื่อ</div>
                            <input type="text" class="form-control" id="profileTitle" aria-describedby="profileTitleHelp" name="f_name" value="<?php echo $result_show['first_name'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row justify-content-center">
                        <div class="col-sm-6">
                            <div id="profileTitleHelp" class="form-text">นามสกุล</div>
                            <input type="text" class="form-control" id="profileTitle" aria-describedby="profileTitleHelp" name="l_name" value="<?php echo $result_show['last_name'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row justify-content-center">
                        <div class="col-sm-6">
                            <div id="profileTitleHelp" class="form-text">อายุ</div>
                            <input type="text" class="form-control" id="profileTitle" aria-describedby="profileTitleHelp" name="age" value="<?php echo $result_show['age'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row justify-content-center">
                        <div class="col-sm-6">
                            <div id="profileTitleHelp" class="form-text">ตำแหน่งงาน</div>
                            <input type="text" class="form-control" id="profileTitle" aria-describedby="profileTitleHelp" name="position" value="<?php echo $result_show['position'] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row justify-content-center">
                        <button type="submit" class="btn btn-primary col-sm-3 rounded-4" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>