<?php
session_start();
include '../../connection.php';

if (isset($_POST['change'])) {
    if (!isset($_SESSION['userid'])) {
        die("Unauthorized access.");
    }

    $new_password = trim($_POST['new_password']);

    if (empty($new_password)) {
        echo "<script>alert('Password cannot be empty!');window.history.back();</script>";
        exit;
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $query = "UPDATE user SET password='$hashed_password' WHERE user_id='$_SESSION[userid]'";
    $execute = mysqli_query($db_connection, $query);

    if ($execute) {
        $_SESSION['password'] = $hashed_password;

        $redirect_url = ($_SESSION['role'] == 1)
            ? '../../views/admin/profile-admin.php'
            : '../../views/customer/profile.php';

        header("Location: $redirect_url");
        exit;
    } else {
        echo "<script>alert('Change Password Failed!');window.location.replace('change_password.php');</script>";
    }
}
