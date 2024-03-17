<?php
session_start();
$open_connect = 1;
require('config.php');

if (isset($_POST['submit'])) {
    // Check if 'account_id' key is set in the session
    $asset_name = mysqli_real_escape_string($conn, $_POST['asset_name']);
    $asset_detail = mysqli_real_escape_string($conn, $_POST['asset_detail']);
    $asset_file = mysqli_real_escape_string($conn, $_POST['asset_file']);

    
    if ($_FILES["asset_file"]["error"] === 4) {

        $sql = "INSERT INTO asset SET asset_name = '$asset_name', asset_detail = '$asset_detail' ";
        $result3 = mysqli_query($conn, $sql);
        
        if ($result3) { // Successfully updated
            echo "<script type='text/javascript'>";
            echo "alert('asset updated successfully');";
            echo "window.location = '/hrproject/asset.php';";
            echo "</script>";
        } else { // Update failed
            echo "<script type='text/javascript'>";
            echo "alert('Failed to update profile');";
            echo "window.location = '/hrproject/asset.php';";
            echo "</script>";
        }
    } else {
        $fileName = $_FILES["asset_file"]["name"];
        $fileSize = $_FILES["asset_file"]["size"];
        $tmpName = $_FILES["asset_file"]["tmp_name"];

        $validImageExtention = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtention)) {
            echo
            "<script> 
                alert('Image Does Not Exist); 
                document.location.href = '/hrproject/asset.php';
            </script>";
        } else if ($fileSize > 10000000) {
            echo
            "<script> 
                alert('Image Size Is Too Large'); 
                document.location.href = '/hrproject/asset.php';
            </script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, 'asset/' . $newImageName);

            $sql = "INSERT INTO asset SET asset_name = '$asset_name', asset_detail = '$asset_detail', asset_file = '$newImageName'";
            $result = mysqli_query($conn, $sql);

            if ($result) { // Successfully updated
                echo "<script type='text/javascript'>";
                echo "alert('Asset updated successfully');";
                echo "window.location = '/hrproject/asset.php';";
                echo "</script>";
            } else { // Update failed
                echo "<script type='text/javascript'>";
                echo "alert('Failed to update asset');";
                echo "window.location = '/hrproject/asset.php';";
                echo "</script>";
            }
        }
    }
}
