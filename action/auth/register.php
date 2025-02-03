<?php
session_start();

if (isset($_POST['register'])) {
    include '../../connection.php';

    $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    $query = "INSERT INTO user 
    (`name`, `username`, `password`, `phone`, address, `role_id`)
    VALUES ('$_POST[name]', '$_POST[username]', '$hashed_password', '$_POST[phone]', '$_POST[address]',2)";
    
    $create = mysqli_query($db_connection, $query);

    if($create) { 
        echo "<script>alert('Registrasi berhasil! silahkan login');window.location.replace('../../views/auth/form_login.php')</script>";
    } else {
        echo "<script> alert('Terjadi kesalahan saat registrasi! mohon registrasi kembali');window.location='register.php'</script>"; //msg js ver
    }
}
?>
<!-- <script>window.location.replace("login.php");</script> -->