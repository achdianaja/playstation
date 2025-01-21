<?php
session_start();
include '../../connection.php';

if (isset($_GET['booking_id'])) {
  $booking_id = $_GET['booking_id'];

  $delete_query = "DELETE FROM booking WHERE booking_id = '$booking_id'";
  $delete_result = mysqli_query($db_connection, $delete_query);

  if ($delete_result) {
    $update_query = "UPDATE product SET status = 'availabel' WHERE product_id = '$_GET[product_id]'";
    mysqli_query($db_connection, $update_query);
    if ($_SESSION['role'] == 1) {
      echo "<script>alert('Canceled !');window.location.replace('../../views/booking/read_booking.php')</script>";
    } else {
      echo "<script>alert('Canceled !');window.location.replace('../../views/customer/mybooking.php')</script>";
    }
  } else {
    if ($_SESSION['role'] == 1) {
      echo "<script>alert('Error!');window.location.replace('../../views/booking/read_booking.php')</script>";
    } else {
      echo "<script>alert('Error!');window.location.replace('../../views/customer/mybooking.php')</script>";
    }
  }
}
