<?php
$title = 'Product';
$page = 'read_product';
include '../../components/head.php';

?>

<h1>Product List</h1>

<div class="container mt-5">
    <p><a class="btn btn-success btn-sm" href="add_product.php">Add New Product</a></p>
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
                            <td><?= $data['price']; ?></td>
                            <td>
                                <a href="edit_product.php?id=<?= $data['product_id'] ?> ">Edit Product</a>
                                <a href="delete_product.php?id=<?= $data['product_id'] ?>" onclick="return confirm('Are you sure?')">Delete Product</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../components/footer.php' ?>