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

                <?php if (isset($_SESSION['user_id'])) { ?>
                    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                    <div class="form-group">
                        <label for="user_name" class="form-label">User Name</label>
                        <input type="text" id="user_name" required class="form-control" value="<?= $_SESSION['fullname'] ?>" disabled>
                    </div>
                <?php } else { ?>
                    <div class="form-group">
                        <label for="user_name" class="form-label">User Name</label>
                        <input type="text" name="user_name" id="user_name" required class="form-control">
                    </div>
                <?php } ?>

                <?php echo $data['hourly_price'] ?>
                <div class="form-group">
                    <label for="product_name" class="form-label">Product</label>
                    <input type="text" id="product_name" required class="form-control" value="<?= $data['product_name'] ?>" disabled>
                </div>

                <div class="form-group">
                    <label for="rental_duration" class="form-label">Rental Duration</label>
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <input type="number" name="rental_duration" id="rental_duration" required class="form-control" style="flex: 2;" placeholder="Enter duration">
                        <select name="duration_unit" id="duration_unit" required class="form-select" style="flex: 1;">
                            <option value="" selected disabled>Choose Unit</option>
                            <option value="hour">Hour</option>
                            <option value="day">Day</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="start_rent" class="form-label">Start Rent Date</label>
                    <input type="date" name="start_rent" id="start_rent" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="total_price" class="form-label">Total Price</label>
                    <input type="number" name="total_price" id="total_price" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" required class="form-select">
                        <option value="" selected disabled>Choose Status</option>
                        <option value="Pending">Pending</option>
                        <option value="Approved">Approved</option>
                        <option value="Rejected">Rejected</option>
                    </select>
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