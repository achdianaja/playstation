<?php
$title = 'Product';
$page = 'Product List';
include '../../components/head.php';

?>
<div class="container mt-5">
    <div style="display: flex; justify-content:space-between">
        <h1>
            <a href="../dashboard.php" class="btn btn-outline-info btn-sm mr-3">←</a> List Product
        </h1>
        <p>
            <a class="btn btn-success btn-sm" href="add_product.php">Add New Product</a>
        </p>
    </div>
    <div class="card">
        <div class="table-wrapper">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Type</th>
                        <th>Specification</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../connection.php";
                    $query = "SELECT * FROM product";
                    $user = mysqli_query($db_connection, $query);

                    $i = 1;
                    foreach ($user as $data) :
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data['product_name']; ?></td>
                            <td><?= $data['type']; ?></td>
                            <td><?= $data['specification']; ?></td>
                            <td><?= number_format($data['hourly_price'], 0, ',', '.') ?></td>
                            <td>
                                <a href="edit_product.php?id=<?= $data['product_id'] ?> " class="btn btn-warning">Edit</a>
                                <a href="../../action/product/delete_product.php?id=<?= $data['product_id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../components/footer.php' ?>