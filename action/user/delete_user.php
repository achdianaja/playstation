<?php
if (isset($_GET['id'])) {
    include '../../connection.php';

    $user_id = $_GET['id'];

    $updateProductQuery = "UPDATE product 
                           SET status = 'available' 
                           WHERE product_id IN 
                           (SELECT product_id FROM order_product WHERE user_id = '$user_id')";
    mysqli_query($db_connection, $updateProductQuery);

    $query = "DELETE FROM user WHERE user_id = '$user_id'";
    $delete = mysqli_query($db_connection, $query);

    if ($delete) {
        echo "<script>alert('Deleted Successfully !')</script>";
    } else {
        echo "<script>alert('Delete Failed !')</script>";
    }
}
?>

<script>
    window.location.replace('../../views/user/read_user.php');
</script>