<?php
$page = "Detail User";
include '../../connection.php';
include '../../components/head.php';
date_default_timezone_set('Asia/Jakarta');

$query = "SELECT * FROM user WHERE user_id = '$_GET[id]'";
$user = mysqli_query($db_connection, $query);
$data = mysqli_fetch_assoc($user);

?>

<div class="container mt-5 checkout-container">
    <div class="checkout-wrapper">
        <h1>
            <a href="read_user.php" class="btn btn-outline-info btn-sm mr-3">←</a> <?= $page ?>
        </h1>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div style="text-align: center;">
                                <img src="../../public/assets/images/user/<?= $data['user_photo'] ?>"
                                    alt="User Photo" class="image" width="200" height="200"
                                    style="border-radius: 50%; padding: 5px; background: white; border: 2px solid #007bff;">
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="row">
                                <div class="col-3">
                                    <div class="mb-4">
                                        <h3>Name : </h3>
                                        <p style="font-size: 20px;"><?= $data['name'] ?></p>
                                    </div>
                                    <div class="mb-4">
                                        <h3>Username : </h3>
                                        <p style="font-size: 20px;"><?= $data['username'] ?></p>
                                    </div>
                                    <div class="mb-4">
                                        <h3>Phone : </h3>
                                        <p style="font-size: 20px;"><?= $data['phone'] ?></p>
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="">
                                        <h3>Address : </h3>
                                        <p style="font-size: 20px;"><?= $data['address'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h1>History</h1>
        <?php
        $queryOrders = "SELECT o.order_id, u.name, p.product_name, o.total_price, o.created_at, o.rent_duration
            FROM order_product o
            JOIN user u ON o.user_id = u.user_id
            JOIN product p ON o.product_id = p.product_id
            WHERE o.user_id = '$_GET[id]'
            ORDER BY o.created_at DESC";

        $resultOrders = $db_connection->query($queryOrders);
        ?>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Rental Duration</th>
                            <th>Total Price</th>
                            <th>Tanggal Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if ($resultOrders->num_rows > 0):
                            while ($row = $resultOrders->fetch_assoc()):
                        ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $row['product_name']; ?></td>
                                    <td><?php echo $row['rent_duration']; ?></td>
                                    <td><?php echo number_format($row['total_price'], 0, ',', '.'); ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                </tr>
                            <?php
                            endwhile;
                        else:
                            ?>
                            <tr>
                                <td colspan="5" align="center">Belum ada History</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "../../components/footer.php"; ?>