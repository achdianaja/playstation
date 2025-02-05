<?php

if(isset($_POST)) {
    include "../../connection.php"; 

    $query = "INSERT INTO product 
    (`product_name`, `type`, `specification`, `hourly_price`) 
    VALUES ('$_POST[product_name]', '$_POST[type]', '$_POST[specification]', '$_POST[hourly_price]')";

    $create = mysqli_query($db_connection, $query);

    if($create) { 
        echo "<script>alert('Added Successfuly !');window.location.replace('../../views/product/read_product.php')</script>";
    } else {
        echo "<script> alert('ADDED FAILED!')</script>";
    }

}
?>
<!-- <p><a href="read_user230018.php"> << back to usertors list</a></p> -->
<script>window.location.replace("read_product.php");</script>