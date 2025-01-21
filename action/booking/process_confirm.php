<?php
include '../../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $user_id = $_POST['user_id'];
    $product_id = $_POST['product_id'];
    $start_rent = $_POST['start_rent'];
    $end_rent = $_POST['end_rent'];

    $start = new DateTime($start_rent);
    $end = new DateTime($end_rent);
    $interval = $start->diff($end);

    $days = $interval->d;
    $hours = $interval->h;

    if ($days > 0) {
        $rent_duration = "$days hari";
        if ($hours > 0) {
            $rent_duration .= " $hours jam";
        }
    } elseif ($hours > 0) {
        $rent_duration = "$hours jam";
    } else {
        $rent_duration = "Kurang dari 1 jam";
    }

    $hourly_price_query = "SELECT hourly_price FROM product WHERE product_id = '$product_id'";
    $hourly_price_result = mysqli_query($db_connection, $hourly_price_query);
    $hourly_price_row = mysqli_fetch_assoc($hourly_price_result);
    $hourly_price = $hourly_price_row['hourly_price'];

    $total_price = ($days * 24 + $hours) * $hourly_price;

    $insert_query = "INSERT INTO order_product (booking_id, user_id, total_price, rent_duration) 
                     VALUES('$booking_id', '$user_id', '$total_price', '$rent_duration')";
    $insert_result = mysqli_query($db_connection, $insert_query);

    // die($insert_query);

    if (!$insert_result) {
        die("Error: " . mysqli_error($db_connection));
    } else {
        $update_booking = "UPDATE booking SET status = 'starting' WHERE booking_id = '$booking_id'";
        $update_order = "UPDATE order_product SET status = 'waiting' WHERE booking_id = '$booking_id'";
        mysqli_query($db_connection, $update_booking);
        mysqli_query($db_connection, $update_order);
        echo "<script>alert('Added Successfuly !');window.location.replace('../../views/customer/mybooking.php')</script>";
    }



    // if ($insert_result) {
    //     $update_query = "UPDATE order_product SET status = 'on' WHERE booking_id = '$booking_id'";
    //     $delete_query = "DELETE FROM booking WHERE booking_id = '$booking_id'";
    //     mysqli_query($db_connection, $delete_query);

    //     echo "<script>
    //             alert('Booking confirmed and moved to Order Product.');
    //             window.location.href = 'confirm_booking.php';
    //           </script>";
    // } else {
    //     echo "<script>
    //             alert('Error confirming booking.');
    //             window.location.href = 'confirm_booking.php';
    //           </script>";
    // }
}
?>
