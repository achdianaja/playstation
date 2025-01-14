<?php

if (isset($_POST)) {
    include "../../connection.php";

    $query = "UPDATE product SET
    `product_name` = '$_POST[product_name]',
    `type` = '$_POST[type]',
    `specification` = '$_POST[specification]',
    `hourly_price` = '$_POST[hourly_price]'
    WHERE product_id = '$_POST[product_id]'";
    $update = mysqli_query($db_connection, $query);

    if ($update) {
        echo "<script>alert('Added Successfuly !');window.location.replace('../../views/product/read_product.php')</script>";
    } else {
        echo "<script> alert('ADDED FAILED!')</script>";
    }
}
?>
<!-- <p><a href="read_user230018.php"> << back to usertors list</a></p> -->
<script>
    window.location.replace("read_product.php");
</script>