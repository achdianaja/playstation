<?php
$title = '';
$page = 'Payment';
include '../../components/head-user.php';
?>

<div class="container mt-5">
    <h1>
        <a href="../../index.php" class="btn btn-outline-info btn-sm mr-3">&#8592;</a> <?= $page ?>
    </h1>

    <div class="card">
        <div class="card-body">
            <?php
            include "../../connection.php";

            $query = "SELECT booking.*, 
                            booking.status AS booking_status, 
                            order_product.status AS order_status,
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
                $statusBadge = ($statusValue === 'paid') ? 'badge-success' : 'badge-warning';
            ?>

                <table class="table">
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
                        <td><?= date('H:i', strtotime($data['start_rent'])) . ' - ' . date('H:i', strtotime($data['end_rent'])); ?></td>
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
                            <input type="hidden" name="booking_id" value="<?php echo $data['booking_id']; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $data['product_id']; ?>">
                            <input type="hidden" name="start_rent" value="<?php echo $data['start_rent']; ?>">
                            <input type="hidden" name="end_rent" value="<?php echo $data['end_rent']; ?>">
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

<?php include '../../components/footer-user.php'; ?>