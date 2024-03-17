<?php
$open_connect = 1;
require('config.php');

if (isset($_POST['click_view_btn'])) {
    $b_id = $_POST['b_id'];

    $info_sql = "SELECT asset_borrow.*, asset.*
                FROM asset_borrow
                INNER JOIN asset ON asset_borrow.asset_id = asset.asset_id
                WHERE asset_borrow.b_id = '$b_id'";
    $fetch_info_sql = mysqli_query($conn, $info_sql);

    if (mysqli_num_rows($fetch_info_sql) > 0) {
        while ($result_show = mysqli_fetch_array($fetch_info_sql)) {

            echo '
            <form action="config/process_asset_confirm.php" method="post" enctype="multipart/form-data" class="upload-form">
            <input type="hidden" class="form-control" name="b_id" value="' . $result_show['b_id'] . '">
            <input type="hidden" class="form-control" name="emp_id" value="' . $result_show['emp_id'] . '">
            <input type="hidden" class="form-control" name="asset_id" value="' . $result_show['asset_id'] . '">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="asset_id" class="form-label">อุปกรณ์ที่ต้องการยืม</label>
                        <input type="text" name="asset_name" class="form-control" value="'.$result_show['asset_name'].'">                   
                    </div>
                </div>
                <div class="mt-2 row pt-2">
                    <div class="col-sm-6">
                        <label for="start_date" class="form-label">วันที่ยืม</label>
                        <input type="text" id="start_date" name="start_date" class="form-control" value="'.$result_show['b_start'].'" require>
                    </div>
                <div class="col-sm-6">
                    <label for="end_date" class="form-label">ถึงวันที่ </label>
                    <input type="text" id="end_date" name="end_date" class="form-control" value="'.$result_show['b_end'].'" require>
                </div>
                <div class="mt-2 row pt-2">
                    <div class="mt-3 pt-2 col-12 border-top">
                        <label for="borrow_reason" class="form-label">เหตุผลที่ต้องการยืม</label>
                        <textarea name="borrow_reason" id="borrow_reason" class="form-control" cols="30" rows="5">'. $result_show['b_reason'] .'</textarea>
                    </div>
                <div class=" modal-footer d-flex justify-content-around">
                    <div>
                        <button type="submit" name="submit" id="submitBtny" class="btn btn-success">อนุมัติ</button>
                        <button type="submit" name="nosubmit" id="submitBtnx" class="btn btn-danger">ไม่อนุมัติ</button>
                    </div>
                </div>
            </form>
            ';
        }
    }
}
