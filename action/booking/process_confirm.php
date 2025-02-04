<?php
include '../../connection.php';
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $user_id = $_POST['user_id'] ?? null;
    $product_id = $_POST['product_id'];
    $payment_method = $_POST['payment_method'];
    $renter = $_POST['renter'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $booking_query = "SELECT start_rent, end_rent, total_price FROM booking WHERE booking_id = '$booking_id'";
    $booking_result = mysqli_query($db_connection, $booking_query);
    $booking_data = mysqli_fetch_assoc($booking_result);

    if (!$booking_data) {
        die("Error: Booking tidak ditemukan.");
    }

    $rent_duration = round(($booking_data['end_rent'] - $booking_data['start_rent']) / 3600, 1) . " jam";
    $total_price = $booking_data['total_price'];

    $insert_query = "INSERT INTO order_product (`booking_id`, `user_id`, `product_id`, `renter`, `phone`, `address`, `total_price`, `rent_duration`, `payment_method`, `status`) 
                 VALUES ('$booking_id', " . (!empty($user_id) ? "'$user_id'" : "NULL") . ", '$product_id', '$renter', '$phone', '$address', '$total_price', '$rent_duration', '$payment_method', 'waiting')";

    if (mysqli_query($db_connection, $insert_query)) {
        $update_booking = "UPDATE booking SET status = 'in_queue' WHERE booking_id = '$booking_id'";
        mysqli_query($db_connection, $update_booking);

        if ($payment_method === 'cash') {
            if (empty($user_id)) {
                $update_order = "UPDATE order_product SET status = 'paid' WHERE booking_id = '$booking_id'";
                $update_booking_status = "UPDATE booking SET status = 'starting' WHERE booking_id = '$booking_id'";
                $update_product = "UPDATE product SET status = 'rented' WHERE product_id = '$product_id'";
                mysqli_query($db_connection, $update_order);
                mysqli_query($db_connection, $update_booking_status);
                mysqli_query($db_connection, $update_product);
                echo "<script>alert('Payment Successfully!');window.location.replace('../../views/booking/read_booking.php')</script>";
            }
            echo "<script>alert('Payment Successfully!');window.location.replace('../../views/customer/mybooking.php')</script>";
        } else {
            echo "<script>window.location.replace('../../views/payment/qris.php?booking_id=$booking_id')</script>";
        }
    } else {
        die("Error: " . mysqli_error($db_connection));
    }
}
