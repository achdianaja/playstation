<?php
include '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $start_rent = $_POST['start_rent'];
    $end_rent = $_POST['end_rent'];
    $hourly_price = $_POST['hourly_price'];

    if (empty($user_id) || empty($product_id) || empty($start_rent) || empty($end_rent) || empty($hourly_price)) {
        die("Semua input harus diisi!");
    }

    $start = new DateTime($start_rent);
    $end = new DateTime($end_rent);
    $interval = $start->diff($end);

    $total_hours = ($interval->d * 24) + $interval->h + ($interval->i > 0 ? 1 : 0);

    $total_price = $total_hours * $hourly_price;

    // echo "Total Price: $hourly_price x $total_hours = $total_price";
    // die();

    $query = "INSERT INTO booking (user_id, product_id, start_rent, end_rent, total_price, status) 
              VALUES ('$user_id', '$product_id', '$start_rent', '$end_rent', '$total_price', 'pending')";
    
    if (mysqli_query($db_connection, $query)) {
        $update_query = "UPDATE product SET status = 'booked' WHERE product_id = '$product_id'";
        mysqli_query($db_connection, $update_query);
        echo "Booking berhasil disimpan!";
    } else {
        echo "Error: " . mysqli_error($db_connection);
    }
}
?>
