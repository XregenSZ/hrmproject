<?php
session_start();
$open_connect = 1;
require('config/config.php');

if ($_SESSION['role'] != 'admin') {
    header('Location: /hrproject/info.php');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        include('config/pagination.php');
        $query = "SELECT * FROM user_info limit {$start} , {$perpage}";
        $result = mysqli_query($conn, $query);
        ?>
        <div class="container mt-5">
            <h3 class="text-center">Employee / รายชื่อพนักงาน</h3>
            <div class="mt-5">
                <div class="form-outline">
                    <input type="text" id="getName" placeholder="Search">
                </div>
                <div id=search-results></div>
                <table class="table table-hover border border-dark text-center m-auto table table-dark table-striped table-hover mt-1">
                    <thead class="align-item-center">
                        <tr>
                            <th>Pic</th>
                            <th>ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Position</th>
                            <th>Rank</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="showdata">
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><img src="config/uploads/<?php echo $row['img'] ?>" alt="" class="rounded-circle" style="width: 42px; height: 42px; object-fit: cover;"></td>
                                <td class="res_leave_id"><?php echo $row['user_id'] ?></td>
                                <td><?php echo $row['first_name'] ?></td>
                                <td><?php echo $row['last_name'] ?></td>
                                <td><?php echo $row['position'] ?></td>
                                <td><?php echo $row['rank'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary view_data_member" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        แก้ไขข้อมูล
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger delete_data_member" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        ลบข้อมูล
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php

            $query2 = "SELECT * FROM user_info ";
            $result2 = mysqli_query($conn, $query2);
            $total_record = mysqli_num_rows($result2);
            $total_page = ceil($total_record / $perpage);
            ?>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item">
                        <a href="member.php?page=1" class="page-link" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                        <li class="page-item"><a href="member.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <li class="page-item">
                        <a href="member.php?page=<?php echo $total_page; ?>" class="page-link" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
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
                <div class="modal-body view_user_data_member">
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="get_member_id_script.js"></script>
    <script>
        $(document).ready(function($) {
            $('#getName').on("keyup", function() { // Add # symbol to select element by ID
                var getName = $(this).val();
                //alert(getName);
                $.ajax({
                    type: "POST",
                    url: "config/search.php",
                    data: {
                        name: getName
                    },
                    success: function(response) {
                        $("#showdata").html(response);
                    }
                });

            });
        });
    </script>
</body>

</html>