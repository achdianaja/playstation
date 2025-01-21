<?php

include '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];


    $update_status_booking = "UPDATE product SET status = 'rented' WHERE product_id = '$product_id'";
    $approve = mysqli_query($db_connection, $update_status_booking);

    if ($approve) {
        $update_booking = "UPDATE booking SET status = 'starting' WHERE booking_id = '$booking_id'";
        mysqli_query($db_connection, $update_booking);
        $update_order = "UPDATE order_product SET status = 'paid' WHERE booking_id = '$booking_id'";
        mysqli_query($db_connection, $update_order);
        echo "<script>alert('Added Successfuly !');window.location.replace('../../views/booking/read_booking.php')</script>";
    } else {
        echo "gagal";
    }
}
