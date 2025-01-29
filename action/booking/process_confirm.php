<?php
include '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $start_rent = $_POST['start_rent'];
    $end_rent = $_POST['end_rent'];
    $payment_method = $_POST['payment_method'];

    $user_query = "SELECT name FROM user WHERE user_id = '$user_id'";
    $user_result = mysqli_query($db_connection, $user_query);
    $user_data = mysqli_fetch_assoc($user_result);
    $user_name = $user_data['name'];

    $booking_query = "SELECT start_rent, end_rent, total_price FROM booking WHERE booking_id = '$booking_id'";
    $booking_result = mysqli_query($db_connection, $booking_query);
    $booking_data = mysqli_fetch_assoc($booking_result);
    $rent_duration = round(($booking_data['end_rent'] - $booking_data['start_rent']) / 3600, 1) . " jam";
    $total_price = $booking_data['total_price'];

    $hourly_price_query = "SELECT hourly_price FROM product WHERE product_id = '$product_id'";
    $hourly_price_result = mysqli_query($db_connection, $hourly_price_query);
    $hourly_price_row = mysqli_fetch_assoc($hourly_price_result);
    $hourly_price = $hourly_price_row['hourly_price'];


    $insert_query = "INSERT INTO order_product (booking_id, user_id, total_price, rent_duration, payment_method) 
                     VALUES('$booking_id', '$user_id', '$total_price', '$rent_duration', '$payment_method')";
    $insert_result = mysqli_query($db_connection, $insert_query);

    if (!$insert_result) {
        die("Error: " . mysqli_error($db_connection));
    } else {
        $update_booking = "UPDATE booking SET status = 'in_queue' WHERE booking_id = '$booking_id'";
        $update_order = "UPDATE order_product SET status = 'waiting' WHERE booking_id = '$booking_id'";
        mysqli_query($db_connection, $update_booking);
        mysqli_query($db_connection, $update_order);
        if($payment_method == 'cash'){
            echo "<script>alert('Payment Successfully!');window.location.replace('../../views/customer/mybooking.php')</script>";
        } else {
            echo "<script>window.location.replace('../../views/payment/qris.php?booking_id=$booking_id')</script>";
        }
    }
}
?>
