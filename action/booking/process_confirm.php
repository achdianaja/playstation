<?php
include '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $start_rent = $_POST['start_rent'];
    $end_rent = $_POST['end_rent'];
    $payment_method = $_POST['payment_method'];


    $user_query = "SELECT name, address, phone FROM user WHERE user_id = '$user_id'";
    $user_result = mysqli_query($db_connection, $user_query);
    
    if ($user_result && mysqli_num_rows($user_result) > 0) {
        $user_data = mysqli_fetch_assoc($user_result);
        $renter = $user_data['name'];
        $address = $user_data['address'];
        $phone = $user_data['phone'];
    } else {
        $renter = $_POST['renter'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $payment_method = 'cash';
        $status = 'paid';       
    }

    $booking_query = "SELECT start_rent, end_rent, total_price FROM booking WHERE booking_id = '$booking_id'";
    $booking_result = mysqli_query($db_connection, $booking_query);
    $booking_data = mysqli_fetch_assoc($booking_result);
    
    $rent_duration = round(($booking_data['end_rent'] - $booking_data['start_rent']) / 3600, 1) . " jam";
    $total_price = $booking_data['total_price'];

    $insert_query = "INSERT INTO order_product (`booking_id`, `user_id`, `renter`, `address`, `phone`, `product_id`, `total_price`, `rent_duration`, `status`, `payment_method`) 
                     VALUES('$booking_id', '$user_id', '$renter', '$address', '$phone', '$product_id', '$total_price', '$rent_duration', '$status','$payment_method')";

                    //  var_dump($insert_query);
    
    $insert_result = mysqli_query($db_connection, $insert_query);

    if (!$insert_result) {
        die("Error: " . mysqli_error($db_connection));
    } else {
        $update_booking = "UPDATE booking SET status = 'in_queue' WHERE booking_id = '$booking_id'";
        $update_order = "UPDATE order_product SET status = 'waiting' WHERE booking_id = '$booking_id'";
        mysqli_query($db_connection, $update_booking);
        mysqli_query($db_connection, $update_order);

        if ($payment_method == 'cash') {
            echo "<script>alert('Payment Successfully!');window.location.replace('../../views/customer/mybooking.php')</script>";
        } else {
            echo "<script>window.location.replace('../../views/payment/qris.php?booking_id=$booking_id')</script>";
        }
    }
}
?>
