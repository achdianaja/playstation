<?php
session_start();
if (isset($_POST['login'])) {
    include '../../connection.php';

    $query = "SELECT * FROM user WHERE username='$_POST[username]'";

    $login = mysqli_query($db_connection, $query);

    if (mysqli_num_rows($login) > 0) {
        $user = mysqli_fetch_assoc($login);
        if (password_verify($_POST['password'], $user['password'])) {
            $_SESSION['login'] = TRUE;
            $_SESSION['userid'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['password'] = $user['password'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['address'] = $user['address'];
            $_SESSION['user_photo'] = $user['user_photo'];
            $_SESSION['role'] = $user['role_id'];
            //$_SESSION['role_id'] = $user['role_id'];
            if ($user['role_id'] == 1) {
                echo "<script>alert('Login Success !');window.location.replace('../../views/dashboard.php')</script>";
            } else {
                echo "<script>alert('Login Success !');window.location.replace('../../index.php')</script>";
            }
        } else {
            echo "<script>alert('Login Failed, Wrong Password !');window.location.replace('../../views/auth/form_login.php')</script>";
        }
    } else {
        echo "<script>alert('Login Failed, User not found !');window.location.replace('../../index.php')</script>";
    }
}
