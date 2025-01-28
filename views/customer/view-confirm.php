<?php
$title = '';
$page = 'Payment';
include '../../components/head-user.php';
?>

<div class="container mt-5">
    <h1>
        <a href="mybooking.php" class="btn btn-outline-info btn-sm mr-3">&#8592;</a> <?= $page ?>
    </h1>

    <div class="card">
        <div class="card-body">
            <?php
            include "../../connection.php";

            if (isset($_GET['order_id'])) {
                // $user_id = $_GET['user_id'];

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
                              WHERE order_product.order_id = '$_GET[order_id]'";

                $result = mysqli_query($db_connection, $query);
                $data = mysqli_fetch_assoc($result);

                if ($data) {
                    $statusValue = $data['order_status'] ?? 'unpaid';
                    $statusText = ($statusValue === 'paid') ? 'Paid' : 'Waiting';
                    $statusBadge = ($statusValue === 'paid') ? 'badge-info' : 'badge-warning';
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
                            <th>Payment Method</th>
                            <td>
                                <?php if (!empty($data['payment_method'])) { ?>
                                    <p class="text-warning"><?= $data['payment_method']; ?></p>
                                <?php } else { ?>
                                    <p class="text-warning">No receipt uploaded.</p>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>

                    <div class="text-center mt-4">
                        <?php if ($statusValue === 'paid') { ?>
                            <p class="text-success">Payment has been successfully processed.</p>
                        <?php } ?>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<?php include '../../components/footer-user.php'; ?>