<?php
session_start();
$open_connect = 1;
require('config.php');

if (isset($_POST['click_view_btn'])) {
    $res_id = $_POST['res_leave_id'];

    $info_sql = "SELECT * FROM user_info WHERE user_id = '$res_id'";
    $fetch_info_sql = mysqli_query($conn, $info_sql);

    if (mysqli_num_rows($fetch_info_sql) > 0) {
        while ($result_show = mysqli_fetch_array($fetch_info_sql)) {
            echo '<div class="rounded bg-white p-4">
            <form action="config/process_add_info_admin.php" method="post" enctype="multipart/form-data" class="upload-form">
                <input type="hidden" name="user_id" value="' . $res_id . '">';

            if (empty($result_show['img'])) {
                echo '<div class="d-flex justify-content-center mb-4">
                        <img id="selectedAvatar" src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                    </div>';
            } else {
                echo '<div class="d-flex justify-content-center mb-4">
                        <img id="selectedAvatar" src="config/uploads/' . $result_show['img'] . '" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                    </div>';
            }

            echo '<div class="mb-3 row d-flex align-items-center justify-content-center">
                    <div class="align-items-center justify-content-center col-sm-6">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupFile01">Select an image</label>
                            <input type="file" class="form-control" id="inputGroupFile01" name="imageName" value="' . $result_show['img'] . '" accept="image/gif, image/jpeg, image/png">
                        </div>
                    </div>
                </div>
                <div class="mb-3 row justify-content-center">
                    <div class="col-sm-6">
                        <div id="profileTitleHelp" class="form-text">ชื่อ</div>
                        <input type="text" class="form-control" id="profileTitleFirstName" aria-describedby="profileTitleHelp" name="f_name" value="' . $result_show['first_name'] . '">
                    </div>
                </div>
                <div class="mb-3 row justify-content-center">
                    <div class="col-sm-6">
                        <div id="profileTitleHelp" class="form-text">นามสกุล</div>
                        <input type="text" class="form-control" id="profileTitleLastName" aria-describedby="profileTitleHelp" name="l_name" value="' . $result_show['last_name'] . '">
                    </div>
                </div>
                <div class="mb-3 row justify-content-center">
                    <div class="col-sm-6">
                        <div id="profileTitleHelp" class="form-text">อายุ</div>
                        <input type="text" class="form-control" id="profileTitleAge" aria-describedby="profileTitleHelp" name="age" value="' . $result_show['age'] . '">
                    </div>
                </div>
                <div class="mb-3 row justify-content-center">
                    <div class="col-sm-6">
                        <div id="profileTitleHelp" class="form-text">ตำแหน่งงาน</div>
                        <input type="text" class="form-control" id="profileTitlePosition" aria-describedby="profileTitleHelp" name="position" value="' . $result_show['position'] . '">
                    </div>
                </div>
                <div class="mb-3 row justify-content-center">
                    <button type="submit" class="btn btn-primary col-sm-3 rounded-4" name="submit">Submit</button>
                </div>
            </form>
        </div>';
        }
    }
}

if (isset($_POST['click_delete_btn'])) {
    $res_id = $_POST['res_leave_id'];

    $info_sql = "SELECT * FROM user_info WHERE user_id = '$res_id'";
    $fetch_info_sql = mysqli_query($conn, $info_sql);

    if (mysqli_num_rows($fetch_info_sql) > 0) {
        while ($result_show = mysqli_fetch_array($fetch_info_sql)) {
            echo '<div class="rounded bg-white p-4">
            <form action="config/process_delete_info_admin.php" method="post" enctype="multipart/form-data" class="upload-form">
                <input type="hidden" name="user_ids" value="' . $res_id . '">';

            if (empty($result_show['img'])) {
                echo '<div class="d-flex justify-content-center mb-4">
                        <img id="selectedAvatar" src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                    </div>';
            } else {
                echo '<div class="d-flex justify-content-center mb-4">
                        <img id="selectedAvatar" src="config/uploads/' . $result_show['img'] . '" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                    </div>';
            }

            echo '<div class="mb-3 row d-flex align-items-center justify-content-center">
                </div>
                <div class="mb-3 row justify-content-center">
                    <div class="col-sm-6">
                        <div id="profileTitleHelp" class="form-text">ชื่อ</div>
                        <input type="text" class="form-control" id="profileTitleFirstName" aria-describedby="profileTitleHelp" name="f_name" value="' . $result_show['first_name'] . '" disabled>
                    </div>
                </div>
                <div class="mb-3 row justify-content-center">
                    <div class="col-sm-6">
                        <div id="profileTitleHelp" class="form-text">นามสกุล</div>
                        <input type="text" class="form-control" id="profileTitleLastName" aria-describedby="profileTitleHelp" name="l_name" value="' . $result_show['last_name'] . '" disabled>
                    </div>
                </div>
                <div class="mb-3 row justify-content-center">
                    <div class="col-sm-6">
                        <div id="profileTitleHelp" class="form-text">อายุ</div>
                        <input type="text" class="form-control" id="profileTitleAge" aria-describedby="profileTitleHelp" name="age" value="' . $result_show['age'] . '" disabled>
                    </div>
                </div>
                <div class="mb-3 row justify-content-center">
                    <div class="col-sm-6">
                        <div id="profileTitleHelp" class="form-text">ตำแหน่งงาน</div>
                        <input type="text" class="form-control" id="profileTitlePosition" aria-describedby="profileTitleHelp" name="position" value="' . $result_show['position'] . '" disabled>
                    </div>
                </div>
                <div class="mb-3 row justify-content-center">
                    <button type="submit" class="btn btn-danger col-sm-3 rounded-4" name="submit_delete">คุณต้องการลบข้อมูลนี้ใช่หรือไม่ ?</button>
                </div>
            </form>
        </div>';
        }
    }
}
?>
