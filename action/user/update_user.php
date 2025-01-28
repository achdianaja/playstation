<?php

if (isset($_POST)) {
    include "../../connection.php";

    $query = "UPDATE user SET
    `name` = '$_POST[name]',
    `username` = '$_POST[username]',
    `phone` = '$_POST[phone]'
    WHERE user_id = '$_POST[user_id]'";

    $update = mysqli_query($db_connection, $query);

    if ($update) {
        echo "<script>alert('Added Successfuly !');</script>";
    } else {
        echo "<script> alert('ADDED FAILED!')</script>";
    }
}
?>
<!-- <p><a href="read_user230018.php"> << back to usertors list</a></p> -->
<script>
    window.location.replace('../../views/customer/profile.php')
</script>