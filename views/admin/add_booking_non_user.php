<?php
include '../../connection.php';

$query = "SELECT product_id, product_name, type, status, hourly_price FROM product";
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
                    <!-- <input type="hidden" name="user_id" value="<?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'NULL' ?>"> -->

                    <div class="form-group">
                        <label for="renter" class="form-label">Renter Name</label>
                        <input type="text" name="renter" id="renter" required class="form-control" placeholder="Enter your name">
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address" required class="form-control" placeholder="Enter your address">
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" id="phone" required class="form-control" placeholder="Enter your phone number">
                    </div>

                    <div class="form-group">
                        <label for="product" class="form-label">Pilih Product</label>
                        <select name="product_id" id="" class="form-control" required>
                            <option value="" selected disabled>Pilih Product</option>
                            <?php foreach ($product as $data) : ?>
                                <option value="<?= $data['product_id'] ?>" data-price="<?= $data['hourly_price'] ?>" <?= $data['status'] == 'rented' ? 'disabled' : '' ?>>
                                    <?= $data['product_name'] . " ($data[type])" ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="duration" class="form-label">Rental Duration (in hours)</label>
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