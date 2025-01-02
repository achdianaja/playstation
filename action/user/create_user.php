<?php

if (isset($_POST)) {
    include "../../connection.php";

    $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $query = "INSERT INTO user 
    (`fullname`, `username`, `password`, `phone`, `role_id`) 
    VALUES ('$_POST[fullname]', '$_POST[username]', '$hashed_password', '$_POST[phone]', 2)";

    $create = mysqli_query($db_connection, $query);

    if ($create) { 
        echo "<script>alert('Added Successfuly !');window.location.replace('../../views/dashboard.php')</script>";
    } else {    
        echo "<script> alert('ADD FAILED!')</script>";
    }
}
?>
<!-- Mengarahkan kembali ke halaman read_user.php -->
<script>window.location.replace("read_user.php");</script>
