<?php
$title = '';
$page = 'Payment';
include '../../components/head.php';
?>

<div class="container mt-5">
    <h1>
        <a href="read_booking.php" class="btn btn-outline-info btn-sm mr-3">&#8592;</a> <?= $page ?>
    </h1>

    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <?php
                    include "../../connection.php";

                    if (isset($_GET['booking_id'])) {

                        $query = "SELECT booking.*, 
                                        order_product.status AS order_status, 
                                        order_product.payment_method AS payment_method, 
                                        booking.status AS booking_status, 
                                        product.*,
                                        user.*
                                FROM booking 
                                JOIN product ON product.product_id = booking.product_id
                                LEFT JOIN order_product ON order_product.booking_id = booking.booking_id
                                JOIN user ON user.user_id = booking.user_id 
                                WHERE booking.booking_id = '$_GET[booking_id]'";

                        $result = mysqli_query($db_connection, $query);
                        $data = mysqli_fetch_assoc($result);

                        if ($data) {
                            $statusValue = $data['order_status'] ?? 'unpaid';
                            $statusText = ($statusValue === 'paid') ? 'Paid' : 'Unpaid';
                            $statusBadge = ($statusValue === 'paid') ? 'badge-success' : 'badge-warning';
                ?>

                        <table class="table">
                            <tr>
                                <th>Renters</th>
                                <td><?= $data['name']; ?></td>
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
                                    <?= date('H:i', $data['start_rent']) . ' - ' . date('H:i', $data['end_rent']); ?>
                                    (<?= round(($data['end_rent'] - $data['start_rent']) / 3600, 1); ?> jam)
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
                            <tr>
                                <th>Receipt</th>
                                <td>
                                    <?php if (!empty($data['payment_method'])) { ?>
                                        <p class="text-warning"><?= $data['payment_method'] ?></p>
                                    <?php } else { ?>
                                        <p class="text-warning">No receipt uploaded.</p>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>

                        <div class="text-center mt-4">
                            <?php if ($statusValue === 'paid') { ?>
                                <p class="text-success">Payment has been successfully processed.</p>
                            <?php } else { ?>
                                <td>
                                    <form action="../../action/booking/approve.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="booking_id" value="<?php echo $data['booking_id']; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
                                        <input type="hidden" name="product_id" value="<?php echo $data['product_id']; ?>">
                                        <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                    </form>
                                    <a href="../../action/booking/process_cancel.php?booking_id=<?php echo $data['booking_id']; ?>&product_id=<?= $data['product_id'] ?>" class="btn btn-danger btn-sm">Cancel</a>
                                </td>
                            <?php } ?>
                        </div>



                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php include '../../components/footer.php'; ?>