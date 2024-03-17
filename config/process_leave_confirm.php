<?php
session_start();
$open_connect = 1;
require('config.php');

$approve = 'approve';
$decline = 'decline';

if (isset($_POST['submit'])) {
    $leave_id = mysqli_real_escape_string($conn, $_POST['leave_id']);

    $sql = "UPDATE resleave SET status = '$approve' WHERE leave_id = '$leave_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) { // Successfully updated
        echo "<script type='text/javascript'>";
        echo "alert('Approve successfully');";
        echo "window.location = '/hrproject/dashboard_leave_admin.php';";
        echo "</script>";
    } else { // Update failed
        echo "<script type='text/javascript'>";
        echo "alert('Failed to Approve request');";
        echo "window.location = '/hrproject/dashboard_leave_admin.php';";
        echo "</script>";
    }
}

if (isset($_POST['nosubmit'])) {
    $leave_id = mysqli_real_escape_string($conn, $_POST['leave_id']);

    $sql2 = "UPDATE resleave SET status = '$decline' WHERE leave_id = '$leave_id'";
    $result2 = mysqli_query($conn, $sql2);

    if ($result2) { // Successfully updated
        echo "<script type='text/javascript'>";
        echo "alert('Decline successfully');";
        echo "window.location = '/hrproject/dashboard_leave_admin.php';";
        echo "</script>";
    } else { // Update failed
        echo "<script type='text/javascript'>";
        echo "alert('Failed to Decline request');";
        echo "window.location = '/hrproject/dashboard_leave_admin.php';";
        echo "</script>";
    }
}
