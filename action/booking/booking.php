<?php
include '../../connection.php';
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? null;
    $product_id = $_POST['product_id'];
    $duration = intval($_POST['duration']);
    $renter = $_POST['renter'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $start_rent = time();
    $end_rent = $start_rent + ($duration * 3600);

    if (!empty($user_id)) {
        // Logged-in user
        $hourly_price = $_POST['hourly_price'];
        $total_price = $duration * $hourly_price;

        $query = "INSERT INTO booking (`user_id`, `product_id`, `renter`, `phone`, `address`,`start_rent`, `end_rent`, `total_price`, `status`, `type_user`) 
                  VALUES ('$user_id', '$product_id', '$renter', '$phone', '$address','$start_rent', '$end_rent', '$total_price', 'in_queue', 'member')";

        if (mysqli_query($db_connection, $query)) {
            $update_query = "UPDATE product SET status = 'booked' WHERE product_id = '$product_id'";
            mysqli_query($db_connection, $update_query);
            echo "<script>alert('Booking berhasil ditambahkan!');window.location.replace('../../views/customer/mybooking.php')</script>";
        } else {
            echo "Error: " . mysqli_error($db_connection);
        }
    } else {
        // Non-user
        $queryHourlyPrice = "SELECT hourly_price FROM product WHERE product_id = '$product_id'";
        $hourly_price = mysqli_query($db_connection, $queryHourlyPrice);
        $hourly_price = mysqli_fetch_assoc($hourly_price)['hourly_price'];

        $total_price = $duration * $hourly_price;

        $query = "INSERT INTO booking (`user_id`, `product_id`, `renter`, `phone`, `address`,`start_rent`, `end_rent`, `total_price`, `status`, `type_user`) 
                  VALUES (" . (!empty($user_id) ? "'$user_id'" : "NULL") . ", '$product_id', '$renter', '$phone', '$address','$start_rent', '$end_rent', '$total_price', 'in_queue', 'non_member')";

        if (mysqli_query($db_connection, $query)) {
            $update_query = "UPDATE product SET status = 'booked' WHERE product_id = '$product_id'";
            mysqli_query($db_connection, $update_query);
            echo "<script>alert('Booking berhasil ditambahkan!');window.location.replace('../../views/booking/read_booking.php')</script>";
        } else {
            echo "Error: " . mysqli_error($db_connection);
        }
    }
}
