<?php
session_start();
$open_connect = 1;
require('config.php');

if (isset($_POST['click_view_btn'])) {
    $res_id = $_POST['res_leave_id'];

    $info_sql = "SELECT * FROM asset WHERE asset_id = '$res_id'";
    $fetch_info_sql = mysqli_query($conn, $info_sql);

    if (mysqli_num_rows($fetch_info_sql) > 0) {
        while ($result_show = mysqli_fetch_array($fetch_info_sql)) {
            echo '<div class="rounded bg-white p-4">
            <form action="config/process_asset_info_admin.php" method="post" enctype="multipart/form-data" class="upload-form">
                <input type="hidden" name="asset_id" value="' . $res_id . '">';

            if (empty($result_show['asset_file'])) {
                echo '<div class="d-flex justify-content-center mb-4">
                        <img id="selectedAvatar" src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                    </div>';
            } else {
                echo '<div class="d-flex justify-content-center mb-4">
                        <img id="selectedAvatar" src="config/asset/' . $result_show['asset_file'] . '" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                    </div>';
            }

            echo '<div class="mb-3 row d-flex align-items-center justify-content-center">
                    <div class="align-items-center justify-content-center col-sm-6">
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupFile01">Select an image</label>
                            <input type="file" class="form-control" id="inputGroupFile01" name="asset_file" value="' . $result_show['asset_file'] . '" accept="image/gif, image/jpeg, image/png">
                        </div>
                    </div>
                </div>
                <div class="mb-3 row justify-content-center">
                    <div class="col-sm-6">
                        <div id="profileTitleHelp" class="form-text">ชื่ออุปกรณ์</div>
                        <input type="text" class="form-control" id="profileTitleFirstName" aria-describedby="profileTitleHelp" name="asset_name" value="' . $result_show['asset_name'] . '">
                    </div>
                </div>
                <div class="mt-3 pt-2 col-12 border-top">
                    <label for="" class="form-label">รายละเอียด/Details</label>
                    <textarea name="asset_info" class="form-control" cols="30" rows="10" >' . $result_show['asset_detail'] . '</textarea>
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

    $info_sql = "SELECT * FROM asset WHERE asset_id = '$res_id'";
    $fetch_info_sql = mysqli_query($conn, $info_sql);

    if (mysqli_num_rows($fetch_info_sql) > 0) {
        while ($result_show = mysqli_fetch_array($fetch_info_sql)) {
            echo '<div class="rounded bg-white p-4">
            <form action="config/process_asset_info_admin.php" method="post" enctype="multipart/form-data" class="upload-form">
                <input type="hidden" name="asset_id" value="' . $res_id . '">';

            if (empty($result_show['asset_file'])) {
                echo '<div class="d-flex justify-content-center mb-4">
                        <img id="selectedAvatar" src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg" class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                    </div>';
            } else {
                echo '<div class="d-flex justify-content-center mb-4">
                        <img id="selectedAvatar" src="config/asset/' . $result_show['asset_file'] . '" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
                    </div>';
            }

            echo '<div class="mb-3 row d-flex align-items-center justify-content-center">
                    <div class="align-items-center justify-content-center col-sm-6">
                    </div>
                </div>
                <div class="mb-3 row justify-content-center">
                    <div class="col-sm-6">
                        <div id="profileTitleHelp" class="form-text">ชื่ออุปกรณ์</div>
                        <input type="text" class="form-control" id="profileTitleFirstName" aria-describedby="profileTitleHelp" name="asset_name" value="' . $result_show['asset_name'] . '" readonly>
                    </div>
                </div>
                <div class="mt-3 pt-2 col-12 border-top">
                    <label for="" class="form-label">รายละเอียด/Details</label>
                    <textarea name="asset_info" class="form-control" cols="30" rows="10" readonly>' . $result_show['asset_detail'] . '</textarea>
                </div>
                <div class="mb-3 row justify-content-center">
                    <button type="submit" class="btn btn-danger col-sm-6 rounded-4" name="delete_submit">คุณต้องการลบข้อมูล อุปกรณ์นี้ ใช่ไหม ?</button>
                </div>
            </form>
        </div>';
        }
    }
}

?>
