<?php 
if (!isset($_SESSION['account_id']) || ($_SESSION['role'] != 'admin')) {
    header('Location: /hrproject/login.php');
    exit();
}
?>