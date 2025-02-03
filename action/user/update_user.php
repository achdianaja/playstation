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
    $old_photo = $_POST['old_photo'];
    
    $query = "UPDATE user SET name = '$name', username = '$username', phone = '$phone' WHERE user_id = '$user_id'";
    $update = mysqli_query($db_connection, $query);
    
    if (!$update) {
        die("Error updating user: " . mysqli_error($db_connection));
    }

    $_SESSION['name'] = $name;
    
    if (!empty($_FILES['user_photo']['name'])) {
        $photo_tmp = $_FILES['user_photo']['tmp_name'];
        $photo_ext = pathinfo($_FILES['user_photo']['name'], PATHINFO_EXTENSION);
        $new_photo_name = strtolower(str_replace(' ', '_', $username)) . '_' . rand(100, 999) . '.' . $photo_ext;
        $user_photo_path = $folder . $new_photo_name;
        
        if (move_uploaded_file($photo_tmp, $user_photo_path)) {
            $query = "UPDATE user SET user_photo='$new_photo_name' WHERE user_id='$user_id'";
            $upload = mysqli_query($db_connection, $query);

            if (!$upload) {
                die("Error updating photo: " . mysqli_error($db_connection));
            }
            if ($old_photo !== 'default.png' && file_exists($folder . $old_photo)) {
                @unlink($folder . $old_photo);
            }

            $_SESSION['user_photo'] = $new_photo_name;
        } else {
            die("Upload error: " . $_FILES['user_photo']['error']);
        }
    }
    
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 1) {
            echo "<script>alert('Change Success!');window.location.replace('../../views/admin/profile-admin.php')</script>";
        } else {
            echo "<script>alert('Change Success!');window.location.replace('../../views/customer/profile.php')</script>";
        }
    } else {
        echo "<script>alert('Role tidak ditemukan');window.location.replace('../../views/auth/form_login.php')</script>";
        exit;
    }
}
