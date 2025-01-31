<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/form_login.php");
    exit;
}

if (isset($_POST['update'])) {
    include '../../connection.php';
    
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $folder = '../../public/assets/images/user/';
    $photo_name = $_FILES['user_photo']['name'];
    $photo_tmp = $_FILES['user_photo']['tmp_name'];
    $old_photo = $_POST['old_photo'];
    
    $query = "UPDATE user SET 
        name = '$name',
        username = '$username',
        phone = '$phone'
        WHERE user_id = '$user_id'";

    $update = mysqli_query($db_connection, $query);
    
    if (!$update) {
        die("Error updating user: " . mysqli_error($db_connection));
    }

    if (!empty($photo_name)) {
        $user_photo_path = $folder . $photo_name;
        
        if (move_uploaded_file($photo_tmp, $user_photo_path)) {
            $query = "UPDATE user SET user_photo='$photo_name' WHERE user_id='$user_id'";
            $upload = mysqli_query($db_connection, $query);

            if (!$upload) {
                die("Error updating photo: " . mysqli_error($db_connection));
            }
            // if ($old_photo !== 'default.jpg') {
            //     @unlink($folder . $old_photo);
            // }

            $_SESSION['user_photo'] = $photo_name;
        } else {
            die("Upload error: " . $_FILES['user_photo']['error']);
        }
    }
    
    header("Location: ../../views/customer/profile.php");
    exit;
}
