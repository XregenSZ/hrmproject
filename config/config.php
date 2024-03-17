<?php

if($open_connect != 1){
    die(header('Location: login.html'));
}

$servername = "127.0.0.1";
$username = "root";
$password = "";
$database = "hr";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $database, $port);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    mysqli_set_charset($conn, 'utf8');
}
?>