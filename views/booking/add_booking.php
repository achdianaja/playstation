<?php
include '../../connection.php';

$query = "SELECT * FROM product WHERE product_id='$_GET[id]'";
$product = mysqli_query($db_connection, $query);
$data = mysqli_fetch_assoc($product);

$page = "Form Booking";
include '../../components/head-user.php';
?>


<div class="container mt-4">
    <h1>Form Add Booking</h1>
    <div class="card">
        <div class="card-body">
            <form action="../../action/booking/booking.php" method="POST">
                <input type="hidden" name="product_id" value="<?= $data['product_id'] ?>">
                <input type="hidden" name="user_id" value="<?= $_SESSION['userid'] ?>">
                <input type="hidden" name="hourly_price" value="<?= $data['hourly_price'] ?>">

                <div class="form-group">
                    <label for="product_name" class="form-label">Product</label>
                    <input type="text" id="product_name" required class="form-control" value="<?= $data['product_name'] ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="rental_duration" class="form-label">Rental Duration</label>
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <input type="datetime-local" name="start_rent" id="start_rent" required class="form-control" style="flex: 1;">
                        <input type="datetime-local" name="end_rent" id="end_rent" required class="form-control" style="flex: 1;">
                    </div>
                </div>

                <div class="form-group" style="display:flex; justify-content:flex-end;">
                    <button type="submit" name="save" class="btn btn-success mx-3">SAVE</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php include '../../components/footer-user.php'; ?>