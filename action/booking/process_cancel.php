<?php
include '../../connection.php';

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    $delete_query = "DELETE FROM booking WHERE booking_id = '$booking_id'";
    $delete_result = mysqli_query($db_connection, $delete_query);

    if ($delete_result) {
        echo "<script>
                alert('Booking canceled successfully.');
                window.location.href = 'confirm_booking.php';
              </script>";
    } else {
        echo "<script>
                alert('Error canceling booking.');
                window.location.href = 'confirm_booking.php';
              </script>";
    }
}
