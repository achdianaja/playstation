<?php

if (isset($_POST)) {
    include "../../connection.php";

    $userId = "";
    if(isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    } else {
        $userId = 3;
    }
    $productId = $_POST['product_id'];
    $rentDuration = $_POST['rental_duration'];
    $status = $_POST['status'];
    $totalPrice = $_POST['total_price'];
    $startRent = $_POST['start_rent'];

    $query = "INSERT INTO `booking`(`booking_id`, `user_id`, `product_id`, `rental_duration`, `status`, `total_price`, `start_rent`) 
    VALUES ('', '$userId','$productId','$rentDuration','$status','$totalPrice','$startRent')";

    $create = mysqli_query($db_connection, $query);

    if ($create) {
        echo "<script>alert('Added Successfuly !');window.location.replace('../../views/dashboard.php')</script>";
    } else {
        echo "<script> alert('ADD FAILED!')</script>";
    }
}
?>

<script>
    window.location.replace("read_user.php");
</script>