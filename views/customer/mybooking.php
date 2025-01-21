<?php
$title = '';
$page = 'My Product';
include '../../components/head-user.php';
?>

<div class="container mt-5">
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
                                product.*
                            FROM booking 
                            JOIN product ON product.product_id = booking.product_id 
                            LEFT JOIN order_product ON order_product.booking_id = booking.booking_id
                            WHERE booking.user_id = '$_SESSION[userid]'";



                    $products = mysqli_query($db_connection, $query);

                    $i = 1;

                    foreach ($products as $data) {
                        $statusValue = $data['order_status'];
                        if ($statusValue === 'paid') {
                            $status = 'badge-info';
                            $text = 'paid';
                        } elseif('waiting'){ 
                            $status = 'badge-warning';
                            $text = 'waiting';
                        } else {
                            $status = 'badge-danger';
                            $text = 'unpaid';
                        }
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data['product_name']; ?></td>
                            <td><?= $data['type']; ?></td>
                            <td><?= date('H:i', strtotime($data['start_rent'])) . ' - ' . date('H:i', strtotime($data['end_rent'])); ?> <div class="badge badge-info">Starting</div></td>
                            <td><?= $data['rent_duration']; ?></td>
                            <td><?= number_format($data['total_price'], 0, ',', '.') ?></td>
                            <td>
                                <div class="badge <?php echo $status; ?>">
                                    <?php echo $text; ?>
                                </div>
                            </td>
                            <td>
                                <?php if ($data['order_status'] !== 'paid') { ?>
                                    <a href="../payment/read_payment.php?booking_id=<?php echo $data['booking_id']; ?>" class="btn btn-success btn-sm">Paid</a>
                                <?php } ?>
                                <a href="../../action/booking/process_cancel.php?booking_id=<?php echo $data['booking_id']; ?>&product_id=<?= $data['product_id'] ?>" class="btn btn-danger btn-sm">Cancel</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../components/footer-user.php'; ?>