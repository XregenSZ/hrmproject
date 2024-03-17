<?php
// Database connection
$open_connect = 1;
require('config.php');

if(isset($_POST['name'])) {

    $name = $_POST['name'];
    $sql = "SELECT * FROM user_info WHERE 
    user_id LIKE '%$name%' OR 
    first_name LIKE '%$name%' OR
    last_name LIKE '%$name%' OR
    position LIKE '%$name%'";
    $query = mysqli_query($conn,$sql);
    $data='';

    while($row = mysqli_fetch_assoc($query)){
        $data .= "
        <tr>
            <td><img src='config/uploads/" . $row['img'] . "' alt='' class='rounded-circle' style='width: 42px; height: 42px; object-fit: cover;'></td>
            <td>" . $row['user_id'] . "</td>
            <td>" . $row['first_name'] . "</td>
            <td>" . $row['last_name'] . "</td>
            <td>" . $row['position'] . "</td>
            <td>" . $row['rank'] . "</td>
        </tr>
        ";
    }
    echo $data;

}

if(isset($_POST['nameworkio'])) {

    $name = $_POST['nameworkio'];
    $sql = "SELECT * FROM work_io WHERE 
    id LIKE '%$name%' OR 
    emp_id LIKE '%$name%' OR
    workdate LIKE '%$name%'";
    $query = mysqli_query($conn,$sql);
    $data='';

    while($row = mysqli_fetch_assoc($query)){
        $data .= "
        <tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['emp_id'] . "</td>
            <td>" . $row['workdate'] . "</td>
            <td>" . $row['work_in'] . "</td>
            <td>" . $row['work_out'] . "</td>
        </tr>
        ";
    }
    echo $data;

} 

$conn->close(); // Close the database connection
?>
