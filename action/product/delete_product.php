<?php
if (isset($_GET['id'])) {
    include '../../connection.php';

    $query = "DELETE FROM product WHERE product_id = '$_GET[id]'";

    $delete = mysqli_query($db_connection, $query);

    // die($db_connection->error);

    if ($delete) {
        echo "<script>alert('Deleted Successfully !')</script>";
    } else {
        echo "<script>alert('Delete Failed !')</script>";
    }
}
?>

<script>
    window.location.back();
</script>