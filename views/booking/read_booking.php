<?php
$title = 'Product';
$page = 'read_product';
include '../../components/head.php';
?>

<div class="container mt-5">
    <h1>
        <a href="../../index.php" class="btn btn-outline-info btn-sm mr-3">←</a> List Ps 3
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


                    $query = "SELECT booking.*, booking.status AS booking_status, product.*
                              FROM booking 
                              JOIN product ON product.product_id = booking.product_id";

                    $products = mysqli_query($db_connection, $query);

                    $i = 1;

                    foreach ($products as $data) {
                        $statusValue = $data['booking_status'];
                        if ($statusValue === 'pending') {
                            $status = 'badge-warning';
                            $text = 'Pending';
                        } elseif ($statusValue === 'confirmed') {
                            $status = 'badge-success';
                            $text = 'Booked';
                        } elseif ($statusValue === 'rented') {
                            $status = 'badge-danger';
                            $text = 'Rented';
                        }else {
                            $status = 'badge-success';
                            $text = 'Kosong';
                        }
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data['product_name']; ?></td>
                            <td><?= $data['type']; ?></td>
                            <td><?= date('H:i', strtotime($data['start_rent'])) . ' - ' . date('H:i', strtotime($data['end_rent'])); ?></td>
                            <td><?= number_format($data['total_price'], 0, ',', '.') ?></td>
                            <td>
                                <div class="badge <?php echo $status; ?>">
                                    <?php echo $text; ?>
                                </div>
                            </td>

                            <?php if($data['status'] != 'pending' ){ ?>
                            <td>
                                <form action="../../action/booking/approve.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="booking_id" value="<?php echo $data['booking_id']; ?>">
                                    <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
                                    <input type="hidden" name="product_id" value="<?php echo $data['product_id']; ?>">
                                    <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                                </form>
                                <a href="../../action/booking/process_cancel.php?booking_id=<?php echo $data['booking_id']; ?>" class="btn btn-danger btn-sm">Cancel</a>
                            </td>
                            <?php } ?>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../components/footer.php'; ?>