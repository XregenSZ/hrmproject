<?php
session_start();
$open_connect = 1;
require('config.php');
if (isset($_POST['submit'])) {
    // Check if 'account_id' key is set in the session
    $asset_id = mysqli_real_escape_string($conn, $_POST['asset_id']);
    $asset_name = mysqli_real_escape_string($conn, $_POST['asset_name']);
    $asset_info = mysqli_real_escape_string($conn, $_POST['asset_info']);
    
    if ($_FILES["asset_file"]["error"] === 4) {

        $sql = "UPDATE asset SET asset_name = '$asset_name', asset_detail = '$asset_info'  WHERE asset_id = '$asset_id'";
        $result3 = mysqli_query($conn, $sql);
        
        if ($result3) { // Successfully updated
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
                document.location.href = 'asset.php';
            </script>";
        } else if ($fileSize > 10000000) {
            echo
            "<script> 
                alert('Image Size Is Too Large'); 
                document.location.href = 'asset.php';
            </script>";
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;

            move_uploaded_file($tmpName, 'asset/' . $newImageName);

            $sql = "UPDATE asset SET asset_name = '$asset_name', asset_detail = '$asset_info', asset_file = '$newImageName'  WHERE asset_id = '$asset_id'";
            $result = mysqli_query($conn, $sql);

            if ($result) { // Successfully updated
                echo "<script type='text/javascript'>";
                echo "alert('Asset updated successfully');";
                echo "window.location = '/hrproject/asset.php';";
                echo "</script>";
            } else { // Update failed
                echo "<script type='text/javascript'>";
                echo "alert('Asset to update profile');";
                echo "window.location = '/hrproject/asset.php';";
                echo "</script>";
            }
        }
    }
}

if (isset($_POST['delete_submit'])) {
    $res_id = $_POST['asset_id'];

    // Perform the deletion query
    $delete_sql = "DELETE FROM asset WHERE asset_id = '$res_id'";
    $result = mysqli_query($conn, $delete_sql);

    // Check if the deletion was successful
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('asset deleted successfully');";
        echo "window.location = '/hrproject/asset.php';";
        echo "</script>";
    } else {
        echo "Error deleting data: " . mysqli_error($conn);
    }
}
