<?php
include '../../connection.php';
session_start();
date_default_timezone_set('Asia/Jakarta');

$current_time = time();

$query = "SELECT booking_id, product_id FROM booking WHERE user_id = '$_SESSION[userid]' AND end_rent < '$current_time'";
$result = mysqli_query($db_connection, $query);

if (!$result) {
    die('Query SELECT gagal: ' . mysqli_error($db_connection));
}

$response = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $booking_id = $row['booking_id'];
        $product_id = $row['product_id'];

        $delete_query = "DELETE FROM booking WHERE booking_id = '$booking_id'";
        $delete_result = mysqli_query($db_connection, $delete_query);

        $delete_result = true;

        if (!$delete_result) {
            die('Query DELETE gagal: ' . mysqli_error($db_connection));
        }

        if ($delete_result) {
            $new_status = 'available';
            if ($new_status !== 'available') {
                $response[] = "Status produk tidak valid untuk update.";
                continue;
            }
 
            $update_query = "UPDATE product SET status = '$new_status' WHERE product_id = '$product_id'";
            $update_result = mysqli_query($db_connection, $update_query);

            if (!$update_result) {
                die('Query UPDATE gagal: ' . mysqli_error($db_connection));
            } else {
                $response[] = "Waktu Sudah Habis";
            }
        } else {
            $response[] = "Gagal membatalkan Booking.";
        }
    }
}
// else {
//     // $response[] = "Tidak ada booking yang perlu dibatalkan.";
//     die("Tidak ada booking yang perlu dibatalkan.");
// }

echo json_encode($response);
