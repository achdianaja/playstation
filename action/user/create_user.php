<?php

if (isset($_POST)) {
    include "../../connection.php";

    $hashed_password = password_hash($_POST['name'], PASSWORD_BCRYPT);

    // die($hashed_password);

    $query = "INSERT INTO user 
    (`name`, `username`, `password`, `phone`, `address`,`role_id`) 
    VALUES ('$_POST[name]', '$_POST[username]', '$hashed_password', '$_POST[phone]', '$_POST[address]',2)";

    $create = mysqli_query($db_connection, $query);

    if ($create) { 
        echo "<script>alert('Added Successfuly !')</script>";
    } else {    
        echo "<script> alert('ADD FAILED!')</script>";
    }
}
?>
<!-- Mengarahkan kembali ke halaman read_user.php -->
<script>window.location.replace("../../views/user/read_user.php");</script>
