<?php
session_start();
$open_connect = 1;
require('config.php');

if (isset($_POST['submit'])) {
    // Check if 'account_id' key is set in the session
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $f_name = mysqli_real_escape_string($conn, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($conn, $_POST['l_name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $position = mysqli_real_escape_string($conn, $_POST['position']);
    
    if ($_FILES["imageName"]["error"] === 4) {

        $sql = "UPDATE user_info SET first_name = '$f_name', last_name = '$l_name', age = '$age' , position = '$position' WHERE user_id = '$user_id'";
        $result3 = mysqli_query($conn, $sql);
        
        if ($result3) { // Successfully updated
            echo "<script type='text/javascript'>";
            echo "alert('Profile updated successfully');";
            echo "window.location = '/hrproject/info.php';";
            echo "</script>";
        } else { // Update failed
            echo "<script type='text/javascript'>";
            echo "alert('Failed to update profile');";
            echo "window.location = '/hrproject/info.php';";
            echo "</script>";
        }
    } else {
        $fileName = $_FILES["imageName"]["name"];
        $fileSize = $_FILES["imageName"]["size"];
        $tmpName = $_FILES["imageName"]["tmp_name"];

        $validImageExtention = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtention)) {
            echo
            "<script> 
                alert('Image Does Not Exist); 
                document.location.href = 'product-img.php';
            </script>";
        } else if ($fileSize > 10000000) {
            echo
            "<script> 
                alert('Image Size Is Too Large'); 
                document.location.href = 'product-img.php';
            </script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, 'uploads/' . $newImageName);

            $sql = "UPDATE user_info SET first_name = '$f_name', last_name = '$l_name', age = '$age' , position = '$position', img = '$newImageName' WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $sql);

            if ($result) { // Successfully updated
                echo "<script type='text/javascript'>";
                echo "alert('Profile updated successfully');";
                echo "window.location = '/hrproject/info.php';";
                echo "</script>";
            } else { // Update failed
                echo "<script type='text/javascript'>";
                echo "alert('Failed to update profile');";
                echo "window.location = '/hrproject/info.php';";
                echo "</script>";
            }
        }
    }
}
