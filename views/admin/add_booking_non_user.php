<?php
include '../../connection.php';

$query = "SELECT * FROM product WHERE product_id='$_GET[id]'";
$product = mysqli_query($db_connection, $query);
$data = mysqli_fetch_assoc($product);

$page = "Form Booking";
include '../../components/head.php';
?>


<div class="container mt-4">
    <h1>Form Add Booking</h1>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form action="../../action/booking/booking.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $data['product_id'] ?>">
                    <input type="hidden" name="user_id" value="<?= $_SESSION['userid'] ?>">
                    <input type="hidden" name="hourly_price" value="<?= $data['hourly_price'] ?>">

                    <div class="form-group">
                        <label for="rental_duration" class="form-label">Rental Duration (in hours)</label>
                        <input type="number" name="duration" id="duration" required class="form-control" min="1" placeholder="Enter rental duration in hours">
                    </div>

                    <div class="form-group" style="display:flex; justify-content:flex-end;">
                        <button type="submit" name="save" class="btn btn-success mx-3">SAVE</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../../components/footer.php'; ?>