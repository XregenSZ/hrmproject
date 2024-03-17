<?php
require('config.php');

date_default_timezone_set('Asia/Bangkok');
$today = date('Y-m-d');

// Query to count active members for today
$sql_active = "SELECT COUNT(DISTINCT emp_id) AS active_count FROM work_io WHERE workdate = '$today'";
$res_active = mysqli_query($conn, $sql_active);
$row_active = mysqli_fetch_assoc($res_active);
$active_count = $row_active['active_count'];

// Query to count total members
$sql_total = "SELECT COUNT(DISTINCT user_id) AS total_count FROM user_info";
$res_total = mysqli_query($conn, $sql_total);
$row_total = mysqli_fetch_assoc($res_total);
$total_count = $row_total['total_count'];

// Calculate inactive members
$inactive_count = $total_count - $active_count;


$dataPoints = array();
$days_in_month = date('t');
for ($day = 1; $day <= $days_in_month; $day++) {
    // Assuming your database table has a date field named 'date' where you store the date of activity
    $date = date('Y-m') . '-' . str_pad($day, 2, '0', STR_PAD_LEFT); // Format: 'YYYY-MM-DD'

    // Query to count the number of activities for the current day
    $query = "SELECT COUNT(*) AS activity_count FROM work_io WHERE DATE(workdate) = '$date'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Store the day and activity count as a data point
    $dataPoints[] = array("x" => $day, "y" => (int)$row['activity_count']);
}