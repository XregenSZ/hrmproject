<?php
session_start();
$open_connect = 1;
require('config/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <title>Log in or Sign Up | LinkME</title>
</head>

<body class="bg-login">
    <!-- Main -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!-- Login -->
        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!-- Left -->
            <div class="col-md-6 left-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4 text-center">
                        <h1>Welcome back</h1>
                        <p>We are happy to have you back.</p>
                    </div>
                    <form action="config/process_login.php" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg bg-light fs-6" name="email_account" placeholder="Email address">
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-lg bg-light fs-6" name="password_account" placeholder="Password">
                        </div>
                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck"> 
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                            </div>
                            <div class="forgot">
                                <small><a href="#">Forgot Password?</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                        </div>
                    </form>
                    <div class="row justify-content-center align-items-center text-center">
                        <small >Don't have account? <a href="register.php">Sign Up</a></small>
                    </div>
                </div>
            </div>

            <!-- Right -->
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column right-box" 
            style="background-image: url(images/myhr.png); background-position: center; background-repeat: no-repeat;">
            </div>
        </div>
    </div>
</body>

</html>