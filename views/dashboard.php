<?php
$page = 'Dashboard';
$rr = "Dashboard";

include '../components/head.php';
if (!isset($_SESSION['login'])) {
    echo "<script>alert('Please Login First !');window.location.replace('auth/form_login.php')</script>";
}

include '../connection.php';

$queryPrice = "SELECT SUM(total_price) AS total_price FROM order_product WHERE `status` = 'paid'";
$resultPrice = $db_connection->query($queryPrice);
$totalPrice = mysqli_fetch_assoc($resultPrice)['total_price'];

$queryMembers = "SELECT COUNT(*) AS members FROM user WHERE role_id != 1";
$resultMembers = $db_connection->query($queryMembers);
$members = mysqli_fetch_assoc($resultMembers)['members'];

$querySoldProduct = "SELECT COUNT(*) AS total_product FROM product";
$resultProduct = $db_connection->query($querySoldProduct);
$product = mysqli_fetch_assoc($resultProduct)['total_product'];

?>

<h1><?php echo $page ?></h1>

<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h2 class="mb-3">Total Income</h2>
                    <h1><?php echo number_format($totalPrice, 0, ',', '.'); ?></h1>
                </div>
                <img src="../public/assets/icons/income.svg" alt="Income Icon" class="card-img">
            </div>
        </div>

    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h2 class="mb-3">Total Product (Unit)</h2>
                    <h1><?php echo $product ?></h1>
                </div>
                <img src="../public/assets/icons/console.svg" alt="Income Icon" class="card-img">
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h2 class="mb-3">Total Member</h2>
                    <h1><?php echo $members ?></h1>
                </div>
                <img src="../public/assets/icons/member.svg" alt="Income Icon" class="card-img">
            </div>
        </div>
    </div>
</div>

<?php
$queryOrders = "SELECT o.order_id, COALESCE(u.name, o.renter) AS user_name, p.product_name, o.total_price, o.created_at, o.rent_duration
                FROM order_product o
                LEFT JOIN user AS u ON o.user_id = u.user_id
                JOIN product p ON o.product_id = p.product_id WHERE o.status = 'paid'
                ORDER BY o.created_at DESC 
                LIMIT 10";

$resultOrders = $db_connection->query($queryOrders);
?>

<h2 class="mt-4">Data Terbaru Peminjaman</h2>

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
        while ($row = $resultOrders->fetch_assoc()): ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $row['user_name']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['rent_duration']; ?></td>
                <td><?php echo number_format($row['total_price'], 0, ',', '.'); ?></td>
                <td><?php echo $row['created_at']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>



<?php include '../components/footer.php' ?>