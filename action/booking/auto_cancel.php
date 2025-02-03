<?php
include '../../connection.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

$current_time = time();
$user_id = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;

$query = "SELECT b.booking_id, b.product_id, b.user_id 
    FROM booking b
    JOIN order_product op ON b.booking_id = op.booking_id
    WHERE b.end_rent < '$current_time' 
    AND op.status = 'paid'
";

if ($user_id) {
    $query .= " AND b.user_id = '$user_id'";
}

$result = mysqli_query($db_connection, $query);

if (!$result) {
    die('Query SELECT gagal: ' . mysqli_error($db_connection));
}

$response = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $booking_id = $row['booking_id'];
        $product_id = $row['product_id'];
        $user_booking_id = $row['user_id'];

        $delete_query = "DELETE FROM booking WHERE booking_id = '$booking_id'";
        $delete_result = mysqli_query($db_connection, $delete_query);

        if (!$delete_result) {
            die('Query DELETE gagal: ' . mysqli_error($db_connection));
        }

        $update_query = "UPDATE product SET status = 'available' WHERE product_id = '$product_id'";
        $update_result = mysqli_query($db_connection, $update_query);

        if (!$update_result) {
            die('Query UPDATE gagal: ' . mysqli_error($db_connection));
        }

        if ($user_id && $user_id == $user_booking_id) {
            $response[] = "Waktu Sudah Habis";
        }
    }
}

echo json_encode($response);
