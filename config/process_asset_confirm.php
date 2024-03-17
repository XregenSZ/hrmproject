<?php
session_start();
$open_connect = 1;
require('config.php');

$approve = 'approve';
$decline = 'decline';

if (isset($_POST['submit'])) {
    $b_id = mysqli_real_escape_string($conn, $_POST['b_id']);
    $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
    $asset_id = mysqli_real_escape_string($conn, $_POST['asset_id']);

    $sql = "UPDATE asset_borrow AS ab
    INNER JOIN asset AS a ON ab.asset_id = a.asset_id
    INNER JOIN user_info AS ui ON ab.emp_id = ui.user_id
    SET ab.status = '$approve'
    WHERE ab.b_id = '$b_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) { // Successfully updated
        $sqlapprove = "UPDATE asset SET emp_borrow_id = '$emp_id' WHERE asset_id = '$asset_id'";
        $resultapprove = mysqli_query($conn, $sqlapprove);
        if($resultapprove){
            echo "<script type='text/javascript'>";
            echo "alert('Approve successfully');";
            echo "window.location = '/hrproject/asset_request.php';";
            echo "</script>";
        }else{
            // Update failed
        echo "<script type='text/javascript'>";
        echo "alert('Failed to Approve 2 request');";
        echo "window.location = '/hrproject/asset_request.php';";
        echo "</script>";
        }
        
    } else { // Update failed
        echo "<script type='text/javascript'>";
        echo "alert('Failed to Approve request');";
        echo "window.location = '/hrproject/asset_request.php';";
        echo "</script>";
    }
}

if (isset($_POST['nosubmit'])) {
    $b_id2 = mysqli_real_escape_string($conn, $_POST['b_id']);

    $sql2 = "UPDATE asset_borrow AS ab
    INNER JOIN asset AS a ON ab.asset_id = a.asset_id
    INNER JOIN user_info AS ui ON ab.emp_id = ui.user_id
    SET ab.status = '$decline'
    WHERE ab.b_id = '$b_id2'";
    $result2 = mysqli_query($conn, $sql2);

    if ($result2) { // Successfully updated
        echo "<script type='text/javascript'>";
        echo "alert('Decline successfully');";
        echo "window.location = '/hrproject/asset_request.php';";
        echo "</script>";
    } else { // Update failed
        echo "<script type='text/javascript'>";
        echo "alert('Failed to Decline request');";
        echo "window.location = '/hrproject/asset_request.php';";
        echo "</script>";
    }
}
