<?php
session_start();

if (isset($_POST['regis'])) {
    include '../../connection.php';

    $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    $query = "INSERT INTO user 
    (`fullname`, `username`, `password`, `phone`, `role_id`)
    VALUES ('$_POST[fullname]', '$_POST[username]', '$hashed_password', '$_POST[phone]', 2)";
    
    //run query
    $create = mysqli_query($db_connection, $query);

    if($create) { 
        echo "<script>alert('Registrasi berhasil! silahkan login');window.location.replace('../../views/auth/form_login.php')</script>";
    } else {
        echo "<script> alert('Terjadi kesalahan saat registrasi! mohon registrasi kembali');window.location='register.php'</script>"; //msg js ver
    }
}
?>
<!-- <p><a href="read_user230018.php"> << back to usertors list</a></p> -->
<script>window.location.replace("login.php");</script>