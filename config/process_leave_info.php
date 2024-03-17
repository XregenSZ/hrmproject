<?php
session_start();
$open_connect = 1;
require('config.php');
date_default_timezone_set('Asia/Bangkok');

if (isset($_POST['submit'])) {
    $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    $reason_info = mysqli_real_escape_string($conn, $_POST['reason_info']);
    $create_date = Date("Y-m-d G:i:s");
    $status = 'request';

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileName = $_FILES["file"]["name"];
        $fileSize = $_FILES["file"]["size"];
        $tmpName = $_FILES["file"]["tmp_name"];

        $validImageExtention = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtention)) {
            echo
            "<script> 
                alert('Image Does Not Exist); 
                document.location.href = 'product-img.php';
            </script>";
        } else if ($fileSize > 10000000) {
            echo
            "<script> 
                alert('Image Size Is Too Large'); 
                document.location.href = 'product-img.php';
            </script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, 'leave_uploads/' . $newImageName);

            $sql = "INSERT INTO resleave 
            SET create_date = '$create_date' ,
            status = '$status',
            start_date = '$start_date', 
            end_date ='$end_date' ,
            emp_id = '$emp_id' ,
            f_name = '$f_name', 
            l_name = '$l_name', 
            emp_position = '$position', 
            emp_reason = '$reason_info', 
            emp_file = '$newImageName'";
            $result = mysqli_query($conn, $sql);

            if ($result) { // Successfully updated
                echo "<script type='text/javascript'>";
                echo "alert('Request uploaded successfully');";
                echo "window.location = '/hrproject/leave.php';";
                echo "</script>";
            } else { // Update failed
                echo "<script type='text/javascript'>";
                echo "alert('Failed to upload request-leave-form');";
                echo "window.location = '/hrproject/leave.php';";
                echo "</script>";
            }
        }
    } else {
        $sql2 = "INSERT INTO resleave 
            SET create_date = '$create_date' ,
            status = '$status' ,
            start_date = '$start_date' ,
            end_date ='$end_date' ,
            emp_id = '$emp_id' ,
            f_name = '$f_name',
            l_name = '$l_name', 
            emp_position = '$position',
            emp_reason = '$reason_info'";
        $result2 = mysqli_query($conn, $sql2);

        if ($result2) { // Successfully updated
            echo "<script type='text/javascript'>";
            echo "alert('Request uploaded successfully');";
            echo "window.location = '/hrproject/leave.php';";
            echo "</script>";
        } else { // Update failed
            echo "<script type='text/javascript'>";
            echo "alert('Failed to upload request-leave-form');";
            echo "window.location = '/hrproject/leave.php';";
        }
    }
} else {
    echo "<script type='text/javascript'>";
    echo "alert('Failed to upload request-leave-form');";
    echo "window.location = '/hrproject/leave.php';";
}
