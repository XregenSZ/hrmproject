<?php
session_start();
$open_connect = 1;
require('config.php');

if (isset($_POST['click_view_btn'])) {
    $res_id = $_POST['res_leave_id'];

    //echo $res_id;
    $info_sql = "SELECT * FROM resleave WHERE leave_id = '$res_id'";
    $fetch_info_sql = mysqli_query($conn, $info_sql);

    if (mysqli_num_rows($fetch_info_sql) > 0) {
        while ($result_show = mysqli_fetch_array($fetch_info_sql)) {
            echo '
                        <form action="config/process_leave_confirm.php" method="post" enctype="multipart/form-data" class="upload-form">
                            <div class="row">
                                <input type="hidden" class="form-control" name="leave_id" value="' . $result_show['leave_id'] . '">
                                <input type="hidden" class="form-control" name="emp_id" value="' . $result_show['emp_id'] . '">
                                <p id="result"></p>
                                <div class="col-sm-6">
                                    <label for="start_date" class="form-label"><font color="black">วันที่ลา </font><font color="red">*</font></label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" value="'. $result_show['start_date'] .'" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label for="end_date" class="form-label"><font color="black">ถึงวันที่ </font><font color="red">*</font></label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" value="'. $result_show['end_date'] .'" readonly>
                                </div>
                            </div>
                            <div class="mt-2 row pt-2">
                                <div class="col-6 text-start">
                                    <img src="images/user_2.png" alt="" style="width: 22px; height: 22px; object-fit: cover;" class="mx-2" />
                                    <label for=""><font color="black">ชื่อ : ' . $result_show['f_name'] . '</font></label>
                                    <input type="hidden" class="form-control" name="f_name" value="' . $result_show['f_name'] . '" readonly>
                                </div>
                                <div class="col-6 text-start">
                                    <label for=""><font color="black">นามสกุล : ' . $result_show['l_name'] . '</font></label>
                                    <input type="hidden" class="form-control" name="l_name" value="' . $result_show['l_name'] . '" readonly>
                                </div>
                                <div class="pt-2 col-12 text-start">
                                    <img src="images/white_check.png" alt="" style="width: 22px; height: 22px; object-fit: cover;" class="mx-2" />
                                    <label for=""><font color="black">ตำแหน่ง : ' . $result_show['emp_position'] . '</font></label>
                                    <input type="hidden" class="form-control" name="position" value="' . $result_show['emp_position'] . '" readonly >
                                </div>
                                <div class="mt-3 pt-2 col-12 border-top">
                                    <label for="" class="form-label">รายละเอียด/เหตุผลการลา</label>
                                    <textarea name="reason_info" class="form-control" cols="30" rows="10" readonly >' . $result_show['emp_reason'] . '</textarea>
                                </div>';
                                
                                if(empty($result_show['emp_file'])){
                                    echo '
                                    <div class="col-sm-12">
                                        <label for="end_date" class="form-label"><font color="red">ไม่มีไฟล์แนบ</font></label>
                                    </div>';
                                } else {
                                    echo '
                                    <div class="d-flex justify-content-center mb-4">
                                        <img id="selectedAvatar" style="width : 460px;" src="config/leave_uploads/'. $result_show['emp_file'] .'" />
                                    </div>';
                                }
                                
                                if ($_SESSION['role'] == 'admin'){
                                    echo '
                                    <div class=" modal-footer d-flex justify-content-around">
                                        <div>
                                            <button type="submit" name="submit" id="submitBtny" class="btn btn-success">อนุมติ</button>
                                            <button type="submit" name="nosubmit" id="submitBtnx" class="btn btn-danger">ไม่อนุมัติ</button>
                                        </div>
                                    </div>
                                    ';}
                            echo '</div>
                        </form>
                    ';
        }
    }
}
