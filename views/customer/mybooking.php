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
                                product.*
                            FROM booking 
                            JOIN product ON product.product_id = booking.product_id 
                            LEFT JOIN order_product ON order_product.booking_id = booking.booking_id
                            WHERE booking.user_id = '$_SESSION[userid]'";



                    $products = mysqli_query($db_connection, $query);

                    $i = 1;

                    foreach ($products as $data) {
                        $statusValue = $data['order_status'];
                        if ($statusValue === 'on') {
                            $status = 'badge-warning';
                            $text = 'on';
                        } else {
                            $status = 'badge-danger';
                            $text = 'off';
                        }
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data['product_name']; ?></td>
                            <td><?= $data['type']; ?></td>
                            <td><?= date('H:i', strtotime($data['start_rent'])) . ' - ' . date('H:i', strtotime($data['end_rent'])); ?></td>
                            <!-- <td><?= $data['rent_duration']; ?></td> -->
                            <td><?= number_format($data['total_price'], 0, ',', '.') ?></td>
                            <td>
                                <div class="badge <?php echo $status; ?>">
                                    <?php echo $text; ?>
                                </div>
                            </td>
                            <td>
                                <form action="../../action/booking/process_confirm.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="booking_id" value="<?php echo $data['booking_id']; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
                                    <input type="hidden" name="product_id" value="<?php echo $data['product_id']; ?>">
                                    <input type="hidden" name="start_rent" value="<?php echo $data['start_rent']; ?>">
                                    <input type="hidden" name="end_rent" value="<?php echo $data['end_rent']; ?>">
                                    <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                </form>
                                <?php if ($data['order_status'] != 'on') { ?>
                                    <a href="../../action/booking/process_cancel.php?booking_id=<?php echo $data['booking_id']; ?>" class="btn btn-danger btn-sm">Cancel</a>
                                <?php } ?>
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