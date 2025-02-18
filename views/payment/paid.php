<?php
$title = '';
$page = 'Payment';
include '../../components/head.php';
?>

<div class="container mt-5">
    <h1 class="mb-4">
        <a href="../booking/read_booking.php" class="btn btn-outline-info btn-sm mr-3">
            &#8592;
        </a> <?= $page ?>
    </h1>

    <div class="card shadow-lg">
        <div class="card-content">
            <div class="card-body">
                <?php
                include "../../connection.php";

                $query = "SELECT booking.*, 
                            booking.status AS booking_status, 
                            order_product.status AS order_status,
                            order_product.payment_method AS payment_method,
                            product.*
                        FROM booking 
                        JOIN product ON product.product_id = booking.product_id 
                        LEFT JOIN order_product ON order_product.booking_id = booking.booking_id
                        WHERE booking.booking_id = '$_GET[booking_id]';";

                $result = mysqli_query($db_connection, $query);
                $data = mysqli_fetch_assoc($result);

                if ($data) {
                    $statusValue = $data['order_status'] ?? 'unpaid';
                    $statusText = ($statusValue === 'paid') ? 'Paid' : 'Unpaid';
                    $statusBadge = ($statusValue === 'paid') ? 'badge-success' : 'badge-danger';
                ?>

                    <table class="table table-bordered">
                        <tr>
                            <th>Renter</th>
                            <td><?= $data['renter']; ?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?= $data['phone']; ?></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td><?= $data['address']; ?></td>
                        </tr>
                        <tr>
                            <th>Product Name</th>
                            <td><?= $data['product_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td><?= $data['type']; ?></td>
                        </tr>
                        <tr>
                            <th>Rental Duration</th>
                            <td>
                                <?= round(($data['end_rent'] - $data['start_rent']) / 3600, 1); ?> jam
                            </td>

                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td>Rp <?= number_format($data['total_price'], 0, ',', '.'); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge <?= $statusBadge; ?>">
                                    <?= $statusText; ?>
                                </span>
                            </td>
                        </tr>
                    </table>

                    <?php if ($statusValue !== 'paid') { ?>
                        <div class="text-center mt-4">
                            <form action="../../action/booking/process_confirm.php" method="POST" style="display:inline;">
                                <input type="hidden" id="cash" name="payment_method" required value="cash" style="margin-right: 5px;">
                                <input type="hidden" name="booking_id" value="<?= $data['booking_id']; ?>">
                                <input type="hidden" name="user_id" value="<?= $data['user_id']; ?>">
                                <input type="hidden" name="renter" value="<?= $data['renter']; ?>">
                                <input type="hidden" name="address" value="<?= $data['address']; ?>">
                                <input type="hidden" name="phone" value="<?= $data['phone']; ?>">
                                <input type="hidden" name="product_id" value="<?= $data['product_id']; ?>">
                                <input type="hidden" name="start_rent" value="<?= $data['start_rent']; ?>">
                                <input type="hidden" name="end_rent" value="<?= $data['end_rent']; ?>">
                                <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                            </form>
                        </div>

                    <?php } else { ?>
                        <div class="text-center mt-4">
                            <p class="text-success">Your payment has been successfully processed.</p>
                        </div>
                    <?php } ?>

                <?php
                } else {
                    echo "<p class='text-center text-danger'>Invalid booking ID or no payment details found.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include '../../components/footer.php'; ?>