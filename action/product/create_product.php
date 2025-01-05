<?php

if(isset($_POST)) {
    include "../../connection.php"; //call connection php mysql

    //sql query INSERT INTO VALUES
    $query = "INSERT INTO product 
    (`product_name`, `type`, `specification`, `hourly_price`) 
    VALUES ('$_POST[product_name]', '$_POST[type]', '$_POST[specification]', '$_POST[hourly_price]')";

    //run query
    $create = mysqli_query($db_connection, $query);

    if($create) { 
        //echo "<p>Added succeefully!</p>"; //msg html ver
        echo "<script>alert('Added Successfuly !');window.location.replace('../../views/dashboard.php')</script>";
    } else {
        //echo "<p>Add pet failed!</p>";
        echo "<script> alert('ADDED FAILED!')</script>"; //msg js ver
    }

}
?>
<!-- <p><a href="read_user230018.php"> << back to usertors list</a></p> -->
<script>window.location.replace("read_product.php");</script>