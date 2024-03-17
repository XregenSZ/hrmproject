<?php
session_start();
$open_connect = 1;
require('config.php');

if (isset($_POST['submit'])) {
    // Check if 'account_id' key is set in the session
    $asset_id = mysqli_real_escape_string($conn, $_POST['asset_id']);
    $emp_id = mysqli_real_escape_string($conn, $_POST['emp_id']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $borrow_reason = mysqli_real_escape_string($conn, $_POST['borrow_reason']);
    $create_date = date("Y-m-d G:i:s");
    $request = 'request';

    $sql = "INSERT INTO asset_borrow SET 
        b_create = '$create_date',
        asset_id = '$asset_id',
        emp_id = '$emp_id',
        b_start = '$start_date',
        b_end = '$end_date',
        b_reason = '$borrow_reason',
        status = '$request'";

    $result = mysqli_query($conn, $sql);
    if ($result) { // Successfully inserted
        echo "<script type='text/javascript'>";
        echo "alert('Borrow updated successfully');";
        echo "window.location = '/hrproject/asset.php';";
        echo "</script>";
    } else { // Insert failed
        echo "<script type='text/javascript'>";
        echo "alert('Failed to update borrow');";
        echo "window.location = '/hrproject/asset.php';";
        echo "</script>";
    }
}

