<?php
$title = 'Product';
$page = 'read_product';
include '../../components/head-user.php';

?>


<div class="container mt-5">
    <h1>List Ps 3</h1>
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
                    $query = "SELECT * FROM product WHERE type = 'PS4'";
                    $user = mysqli_query($db_connection, $query);

                    $i = 1;
                    foreach ($user as $data) :
                        $statusCheck = $data['status'];

                        if ($statusCheck == 'kosong') {
                            $status = 'badge-success';
                            $text = 'Kosong';
                        } else if ($statusCheck == 'di_booking') {
                            $status = 'badge-danger';
                            $text = 'Di Booking';
                        } else {
                            $status = 'badge-warning';
                            $text = 'Di Sewa';
                        }
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data['product_name']; ?></td>
                            <td><?= $data['type']; ?></td>
                            <td><?= $data['specification']; ?></td>
                            <td><?= number_format($data['hourly_price'], 0, ',', '.') ?></td>
                            <td>
                                <div class="badge <?php echo $status ?>">
                                    <p><?php echo $text ?></p>
                                </div>
                            </td>
                            <td>
                                <a href="../booking/add_booking.php?id=<?= $data['product_id'] ?>" class="btn btn-danger">booking</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../components/footer-user.php' ?>