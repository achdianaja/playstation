<?php
include '../../connection.php';
date_default_timezone_set('Asia/Jakarta');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $duration = intval($_POST['duration']);
    $hourly_price = $_POST['hourly_price'];

    if (empty($user_id) || empty($product_id) || empty($duration) || empty($hourly_price)) {
        die("Semua input harus diisi!");
    }


    $start_rent = time();

    $end_rent = $start_rent + ($duration * 3600);

    $total_price = $duration * $hourly_price;

    $query = "INSERT INTO booking (user_id, product_id, start_rent, end_rent, total_price, status) 
              VALUES ('$user_id', '$product_id', '$start_rent', '$end_rent', '$total_price', 'in_queue')";

    if (mysqli_query($db_connection, $query)) {
        $update_query = "UPDATE product SET status = 'booked' WHERE product_id = '$product_id'";
        mysqli_query($db_connection, $update_query);
        echo "<script>alert('Booking berhasil ditambahkan!');window.location.replace('../../views/customer/mybooking.php')</script>";
    } else {
        echo "Error: " . mysqli_error($db_connection);
    }
}
