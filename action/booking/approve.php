<?php

include '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];


    $update_status_booking = "UPDATE product SET status = 'rented' WHERE product_id = '$product_id'";
    $approve = mysqli_query($db_connection, $update_status_booking);

    if ($approve) {
        $update_booking = "UPDATE booking SET status = 'rented' WHERE booking_id = '$booking_id'";
        mysqli_query($db_connection, $update_booking);

        echo "berhasil";
    } else {
        echo "gagal";
    }
}
