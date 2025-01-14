<?php

if (isset($_POST)) {
    include "../../connection.php";

    $query = "UPDATE user SET
    `fullname` = '$_POST[fullname]',
    `username` = '$_POST[username]',
    `password` = '$hashed_password',
    `phone` = '$_POST[phone]',
    `role_id` = 2
    WHERE user_id = '$_POST[user_id]'";
    $update = mysqli_query($db_connection, $query);

    if ($update) {
        echo "<script>alert('Added Successfuly !');window.location.replace('../../views/product/read_user.php')</script>";
    } else {
        echo "<script> alert('ADDED FAILED!')</script>";
    }
}
?>
<!-- <p><a href="read_user230018.php"> << back to usertors list</a></p> -->
<script>
    window.location.replace("read_product.php");
</script>