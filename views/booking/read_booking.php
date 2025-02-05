<?php
$title = 'Product';
$page = 'Read Booking';
include '../../components/head.php';
date_default_timezone_set('Asia/Jakarta');

?>

<div class="container mt-5">
    <div style="display: flex; justify-content:space-between">
        <h1>
            <a href="../dashboard.php" class="btn btn-outline-info btn-sm mr-3">←</a> List Booking
        </h1>
        <p><a class="btn btn-success btn-sm" href="../admin/add_booking_non_user.php">Add New Booking</a></p>
    </div>

    <div class="card">
        <div class="table-wrapper">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Renter</th>
                        <th>Product Name</th>
                        <th>Type</th>
                        <th>Rental Duration</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>User Type</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../connection.php";

                    $query = "SELECT booking.*, 
                     order_product.status AS order_status, 
                     booking.status AS booking_status, 
                     product.*
                    FROM booking 
                    JOIN product ON product.product_id = booking.product_id
                    LEFT JOIN order_product ON order_product.booking_id = booking.booking_id ORDER BY booking.created_at DESC";


                    $products = mysqli_query($db_connection, $query);
                    $i = 1;

                    if (mysqli_num_rows($products) > 0) {
                        foreach ($products as $data) {
                            $statusValue = !empty($data['order_status']) ? $data['order_status'] : 'unpaid';
                            switch ($statusValue) {
                                case 'paid':
                                    $status = 'badge-info';
                                    $text = 'paid';
                                    break;
                                case 'waiting':
                                    $status = 'badge-warning';
                                    $text = 'waiting';
                                    break;
                                default:
                                    $status = 'badge-danger';
                                    $text = 'unpaid';
                                    break;
                            }

                    ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $data['renter']; ?></td>
                                <td><?php echo $data['product_name']; ?></td>
                                <td><?= $data['type']; ?></td>
                                <td><?= date('H:i', $data['start_rent']) . ' - ' . date('H:i', $data['end_rent']); ?></td>
                                <td><?= number_format($data['total_price'], 0, ',', '.'); ?></td>
                                <td>
                                    <div class="badge <?php echo $status; ?>">
                                        <?php echo $text; ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="badge badge-warning">
                                        <?php echo $data['type_user']; ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($data['type_user'] == 'non_member') { ?>
                                        <a href="../payment/paid.php?booking_id=<?php echo $data['booking_id']; ?>&product_id=<?= $data['product_id'] ?>" class="btn btn-primary btn-sm">View</a>
                                    <?php } else { ?>
                                        <a href="detail.php?booking_id=<?php echo $data['booking_id']; ?>&product_id=<?= $data['product_id'] ?>" class="btn btn-primary btn-sm">View</a>
                                    <?php } ?>
                                    <a href="../../action/booking/process_stop.php?booking_id=<?php echo $data['booking_id']; ?>&product_id=<?= $data['product_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to stop this booking?')">Stop</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="9" align="center">Belum ada yang booking</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../components/footer.php'; ?>