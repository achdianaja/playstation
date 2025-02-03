<?php
$title = 'Product';
$page = 'List PS 4';
include '../../components/head-user.php';
?>

<div class="container mt-5" style="height: 100vh;">
    <h1>
        <a href="../../index.php" class="btn btn-outline-info btn-sm mr-3">←</a> List PS 3
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

                    $query = "SELECT product.*, booking.user_id AS user_id, booking.status AS booking_status
                                FROM product
                                LEFT JOIN booking ON booking.product_id = product.product_id
                                WHERE product.type = 'PS4'
                            ";
                    $products = mysqli_query($db_connection, $query);

                    $i = 1;

                    foreach ($products as $data) {
                        $statusValue = $data['status'];

                        if ($statusValue === 'available') {
                            $status = 'badge-success';
                            $btn = "btn-primary";
                            $text = 'AVAILABLE';
                        } elseif ($statusValue === 'rented') {
                            $status = 'badge-danger';
                            $btn = "btn-danger btn-disabled";
                            $text = 'RENTED';
                        } elseif ($statusValue === 'booked') {
                            $status = 'badge-warning';
                            $btn = "btn-warning" . " " . ($_SESSION['userid'] != $data['user_id'] ? 'btn-disabled' : '');
                            $text = 'BOOKED';
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
                                <?php if (empty($_SESSION['userid'])) {
                                    $btn = "btn-primary";
                                    $text = 'LOGIN TO BOOK';
                                    $link = '../auth/form_login.php';

                                ?>
                                    <a href="<?= $link ?>" class="btn <?php echo $btn ?> "><?php echo $text; ?></a>
                                <?php } else {
                                    $link = '../booking/add_booking.php?id='.$data['product_id'];
                                ?>
                                    <?php if ($statusValue === 'booked') { ?>
                                        <a href="mybooking.php" class="btn <?php echo $btn ?> "><?php echo $text; ?></a>
                                    <?php } else { ?>
                                        <a href="<?= $link ?>" class="btn <?php echo $btn ?> "><?php echo $text; ?></a>
                                    <?php } ?>
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