<?php
session_start();
$open_connect = 1;
require('config.php');

if (isset($_POST['email_account']) && isset($_POST['password_account'])) {
    $email_account = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['email_account']));
    $password_account = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['password_account']));

    $query_check_account = "SELECT * FROM user_account WHERE email_account = '$email_account'";
    $call_back_check_account = mysqli_query($conn, $query_check_account);

    $emp_rank = 'employee';

    if (mysqli_num_rows($call_back_check_account) == 1) {
        $result_check_account = mysqli_fetch_assoc($call_back_check_account);
        $stored_hash = $result_check_account['password_account'];
        $stored_salt = $result_check_account['salt'];

        $account_id = $result_check_account['account_id'];

        $query_check_info = "SELECT * FROM user_info WHERE user_id = '$account_id'";
        $call_back_check_info = mysqli_query($conn, $query_check_info);
        $result_check_info = mysqli_fetch_assoc($call_back_check_info);

        if (!$result_check_info) {
            $query_create_info = "INSERT INTO user_info (user_id) VALUES ('$account_id')";
            $call_back_create_info = mysqli_query($conn, $query_create_info);
        }

        $query_check_info_rank = "SELECT rank FROM user_info WHERE user_id = '$account_id'";
        $call_back_check_info_rank = mysqli_query($conn, $query_check_info_rank);
        $result_check_info_rank = mysqli_fetch_assoc($call_back_check_info_rank);

        if (!$result_check_info_rank) {
            $query_create_info_rank = "UPDATE user_info SET rank = $emp_rank WHERE user_id = '$account_id'";
            $call_back_create_info_rank = mysqli_query($conn, $query_create_info_rank);
        } else {
            // Check if the rank is null or empty
            $rank = $result_check_info_rank['rank'];
            if (empty($rank)) {
                // If the rank is null or empty, set it to 'employee'
                $query_update_info_rank = "UPDATE user_info SET rank = '$emp_rank' WHERE user_id = '$account_id'";
                $call_back_update_info_rank = mysqli_query($conn, $query_update_info_rank);
            }
        }

        $password_with_salt = $password_account . $stored_salt;

        if (password_verify($password_with_salt, $stored_hash)) {
            $_SESSION['account_id'] = $result_check_account['account_id'];
            $_SESSION['role'] = $result_check_account['role'];

            if (!isset($_SESSION['account_id']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'member')) {
                header('Location: /hrproject/login.php');
                exit();
            } elseif ($_SESSION['role'] == 'admin') {
                header('Location: /hrproject/dashboard.php');
                exit();
            } else {
                header('Location: /hrproject/info.php');
                exit();
            }
        } else {
            echo "<script type='text/javascript'>";
            echo "alert('รหัสผ่าน หรือ อีเมล ไม่ถูกต้อง');";
            echo "window.location = '/hrproject/login.php';";
            echo "</script>";
        }
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('รหัสผ่าน หรือ อีเมล ไม่ถูกต้อง');";
        echo "window.location = '/hrproject/login.php';";
        echo "</script>";;
    }
} else {
    echo "<script type='text/javascript'>";
    echo "alert('ไม่ได้กรอกข้อมูล');";
    echo "window.location = '/hrproject/login.php';";
    echo "</script>";
}
?>
