<?php
session_start();
$open_connect = 1;
require('config.php');

if (isset($_POST['submit_delete'])) {
    $user_id = $_POST['user_ids']; // Retrieve the user ID from the form

    // Perform the deletion query
    $delete_sql = "DELETE FROM user_info WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $delete_sql);

    // Check if the deletion was successful
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('Profile deleted successfully');";
        echo "window.location = '/hrproject/member.php';";
        echo "</script>";
    } else {
        echo "Error deleting data: " . mysqli_error($conn);
    }
}
?>
