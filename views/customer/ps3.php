<?php
$title = 'Product';
$page = 'read_product';
include '../../components/head-user.php';
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
                        <th>Specification</th>
                        <th>Hourly Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../connection.php";

                    $query = "SELECT * FROM product WHERE type = 'PS3'";
                    $products = mysqli_query($db_connection, $query);

                    $i = 1;

                    foreach ($products as $data) {
                        $statusQuery = "SELECT status FROM booking WHERE product_id = '$data[product_id]' ORDER BY created_at DESC LIMIT 1";
                        $statusResult = mysqli_query($db_connection, $statusQuery);
                        $statusRow = mysqli_fetch_assoc($statusResult);

                        if ($statusRow) {
                            $statusValue = $statusRow['status'];
                            if ($statusValue === 'pending') {
                                $status = 'badge-warning';
                                $text = 'Pending';
                            } elseif ($statusValue === 'confirmed') {
                                $status = 'badge-danger';
                                $text = 'Di Booking';
                            } elseif ($statusValue === 'canceled') {
                                $status = 'badge-success';
                                $text = 'Kosong';
                            }
                        } else {
                            $status = 'badge-success';
                            $text = 'Kosong';
                        }
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data['product_name']; ?></td>
                            <td><?= $data['type']; ?></td>
                            <td><?= $data['specification']; ?></td>
                            <td><?= number_format($data['hourly_price'], 0, ',', '.') ?></td>
                            <td>
                                <div class="badge <?php echo $status; ?>">
                                    <?php echo $text; ?>
                                </div>
                            </td>
                            <td>
                                <a href="../booking/add_booking.php?id=<?= $data['product_id'] ?>" class="btn btn-danger">Booking</a>
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