<?php
$page = "Profiles";
include '../../connection.php';
include '../../components/head-user.php';
date_default_timezone_set('Asia/Jakarta');

$query = "SELECT * FROM user WHERE user_id = '$_SESSION[userid]'";
$user = mysqli_query($db_connection, $query);
$data = mysqli_fetch_assoc($user);

?>

<div class="container mt-5 checkout-container">
    <div class="checkout-wrapper">
        <h1>
            <a href="../../index.php" class="btn btn-outline-info btn-sm mr-3">←</a> <?= $page ?>
        </h1>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form method="POST" action="../../action/user/update_user.php" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>">
                        <input type="hidden" name="old_photo" value="<?= $data['user_photo'] ?>">

                        <div class="form-group" style="display: flex; justify-content: center;">
                            <img src="../../public/assets/images/user/<?= $data['user_photo'] ?>"
                                alt="User Photo" class="image" width="100" height="100" style="border-radius: 100%;">
                            <input type="file" name="user_photo" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" value="<?= $data['name'] ?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" id="username" name="username" value="<?= $data['username'] ?>" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" id="phone" name="phone" value="<?= $data['phone'] ?>" class="form-control" required>
                        </div>

                        <input type="submit" class="btn btn-success" value="Update" name="update">
                        <a href="change-password.php" class="btn btn-primary">Change password</a>
                    </form>
                </div>
            </div>
        </div>

        <h1>Your History</h1>
        <?php
        $queryOrders = "SELECT o.order_id, u.name, p.product_name, o.total_price, o.created_at, o.rent_duration
            FROM order_product o
            JOIN user u ON o.user_id = u.user_id
            JOIN product p ON o.product_id = p.product_id
            WHERE o.user_id = '$_SESSION[userid]'";

        $resultOrders = $db_connection->query($queryOrders);
        ?>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Renter</th>
                            <th>Product Name</th>
                            <th>Rental Duration</th>
                            <th>Total Price</th>
                            <th>Tanggal Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = $resultOrders->fetch_assoc()):
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['product_name']; ?></td>
                                <td><?php echo $row['rent_duration']; ?></td>
                                <td><?php echo number_format($row['total_price'], 0, ',', '.'); ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "../../components/footer-user.php"; ?>