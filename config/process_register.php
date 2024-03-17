<?php

$open_connect = 1;
require('config.php');

if(isset($_POST['email_account']) && isset($_POST['password_account'])){

    $email_account = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['email_account'])); 
    $password_account = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password_account'])); 

    if(empty($email_account)){
        die(header('Location: /hrproject/register.php')); // ไม่ได้กรอกอีเมล
    }else if(empty($password_account)){
        die(header('Location: /hrproject/register.php')); // ไม่ได้กรอกรหัสผ่าน
    }else{
        $query_check_email_account = "SELECT email_account FROM user_account WHERE email_account = '$email_account'";
        $call_back_query_check_email_account = mysqli_query($conn, $query_check_email_account);
        if(mysqli_num_rows($call_back_query_check_email_account) > 0){
            echo "<script type='text/javascript'>";
            echo "alert('มีผู้ใช้นี้แล้ว');";
            echo "window. location = '/hrproject/register.php';";
            echo "</script>";
        }else{
            $length = random_int(97, 128);
            $salt_account = bin2hex(random_bytes($length)); //สร้างค่าเกลือ
            $password_account = $password_account . $salt_account; //เอาหรัสผ่านต่อกับค่าเกลือ
            $algo = PASSWORD_ARGON2ID;
            $options = [
                'cost' => PASSWORD_ARGON2_DEFAULT_MEMORY_COST,
                'time_cost' => PASSWORD_ARGON2_DEFAULT_TIME_COST,
                'thread' => PASSWORD_ARGON2_DEFAULT_THREADS
            ];
            $password_account_hashed = password_hash($password_account, $algo, $options); //นำรหัสผ่านที่รวมค่าเกลือแล้ว เข้ารหัสด้วยวิธี ARGON2ID

            $query_create_account = "INSERT INTO user_account VALUES 
            ('','$email_account','$password_account_hashed','$salt_account','member')";

            $call_back_create_account = mysqli_query($conn, $query_create_account);

            

            if($call_back_create_account){ //สมัครสมาชิกสำเร็จ

                $query_create_account_info = "INSERT INTO user_info VALUES ('')"; //info id สำเร็จ
                $call_back_create_info = mysqli_query($conn, $query_create_account_info);

                echo "<script type='text/javascript'>";
                echo "alert('สมัครสมาชิกเรียบร้อยแล้ว');";
                echo "window. location = '/hrproject/login.php';";
                echo "</script>";
            }else{ // error
                echo "<script type='text/javascript'>";
                echo "alert('ไม่สามารถสมัครสมาชิกได้');";
                echo "window. location = '/hrproject/register.php';";
                echo "</script>";
            }
        }
    }
} else {
    die(header('Location: register.html')); // ไม่มีข้อมูล
};