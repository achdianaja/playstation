<?php
$title = '';
$page = 'My Booking';
include '../../components/head-user.php';

date_default_timezone_set('Asia/Jakarta');

?>

<div class="container mt-5" style="height: 100vh;">
    <h1>
        <a href="../../index.php" class="btn btn-outline-info btn-sm mr-3">←</a> <?= $page ?>
    </h1>

    <div class="card">
        <div class="table-wrapper">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Type</th>
                        <th>Rental Duration</th>
                        <th>Rent Status</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../connection.php";

                    $query = "SELECT booking.*, 
                                booking.status AS booking_status, 
                                order_product.status AS order_status,
                                order_product.rent_duration,
                                order_product.order_id AS order_id,
                                product.*
                            FROM booking 
                            JOIN product ON product.product_id = booking.product_id 
                            LEFT JOIN order_product ON order_product.booking_id = booking.booking_id
                            WHERE booking.user_id = '$_SESSION[userid]' ORDER BY booking.created_at DESC";



                    $products = mysqli_query($db_connection, $query);

                    $i = 1;
                    if (mysqli_num_rows($products) > 0) {

                        foreach ($products as $data) {
                            $statusValue = $data['order_status'];
                            if ($statusValue === 'paid') {
                                $status = 'badge-info';
                                $text = 'paid';
                            } elseif ($statusValue === 'waiting') {
                                $status = 'badge-warning';
                                $text = 'waiting';
                            } elseif (empty($statusValue)) {
                                $status = 'badge-danger';
                                $text = 'unpaid';
                            }

                            $rentStatus = $data['booking_status'];
                            if ($rentStatus === 'starting') {
                                $badge = 'badge-info';
                                $textStatus = 'starting';
                            } elseif ('in_queue') {
                                $badge = 'badge-warning';
                                $textStatus = 'in queue';
                            } elseif ('cancelled') {
                                $badge = 'badge-danger';
                                $textStatus = 'cancelled';
                            }
                    ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $data['product_name']; ?></td>
                                <td><?= $data['type']; ?></td>
                                <td><?= date('H:i', $data['start_rent']) . ' - ' . date('H:i', $data['end_rent']); ?>
                                    <!-- <td><?= ' - ' . date('H:i', 1738600522); ?> -->
                                </td>
                                <td>
                                    <div class="badge <?php echo $badge; ?>">
                                        <?php echo $textStatus; ?>
                                    </div>
                                </td>
                                <td><?= number_format($data['total_price'], 0, ',', '.') ?></td>
                                <td>
                                    <div class="badge <?php echo $status; ?>">
                                        <?php echo $text; ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($data['order_status'] == 'paid') { ?>
                                        <a href="view-confirm.php?order_id=<?php echo $data['order_id']; ?>" class="btn btn-primary btn-sm">View</a>
                                        <a href="../../action/booking/process_stop.php?booking_id=<?php echo $data['booking_id']; ?>&product_id=<?= $data['product_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to stop this booking?')">Stop</a>
                                    <?php } elseif ($data['order_status'] == 'waiting') { ?>
                                        <a href="view-confirm.php?order_id=<?php echo $data['order_id']; ?>" class="btn btn-primary btn-sm">View</a>
                                    <?php } else { ?>
                                        <a href="../payment/read_payment.php?booking_id=<?php echo $data['booking_id']; ?>" class="btn btn-success btn-sm">Paid</a>
                                        <a href="../../action/booking/process_cancel.php?booking_id=<?php echo $data['booking_id']; ?>&product_id=<?= $data['product_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</a>
                                    <?php } ?>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="9" align="center">Belum Ada data</td></tr>';
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../components/footer-user.php'; ?>