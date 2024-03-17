<?php
$open_connect = 1;
require('config.php');

if (isset($_POST["workin"])) {

    $workdate = date('Y-m-d');
    $m_id = mysqli_real_escape_string($conn, $_POST["m_id"]);
    $workin = mysqli_real_escape_string($conn, $_POST["workin"]);

    $sql = "INSERT INTO work_io
			(emp_id, workdate, work_in)
			VALUES
			('$m_id', '$workdate', '$workin')";
    $result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));

    mysqli_close($conn);
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('บันทึกข้อมูลสำเร็จ');";
        echo "window.location = '/hrproject/workio.php'; ";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('Error');";
        echo "window.location = '/hrproject/workio.php'; ";
        echo "</script>";
    }

    //save workout			
} elseif (isset($_POST["workout"])) {

    $workdate = date('Y-m-d');
    $m_id = mysqli_real_escape_string($conn, $_POST["m_id"]);
    $workout = mysqli_real_escape_string($conn, $_POST["workout"]);

    $sql2 = "UPDATE work_io SET 
			work_out = '$workout'
			WHERE emp_id = $m_id  AND workdate = '$workdate'
			";
    $result2 = mysqli_query($conn, $sql2) or die("Error in query: $sql2 " . mysqli_error($conn));

    mysqli_close($conn);
    if ($result2) {
        echo "<script type='text/javascript'>";
        echo "alert('บันทึกข้อมูลสำเร็จ');";
        echo "window.location = '/hrproject/workio.php'; ";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('Error');";
        echo "window.location = '/hrproject/workio.php'; ";
        echo "</script>";
    }
}
else {
    echo "<script type='text/javascript'>";
    echo "alert('คุณได้บันทึกเวลาเข้า-ออกงานวันนี้เรียบร้อยแล้ว');";
    echo "window.location = '/hrproject/workio.php'; ";
    echo "</script>";
}
