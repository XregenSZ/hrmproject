<?php
session_start();
session_destroy();
header("Location: /hrproject/login.php");	
?>