<?php
$page = "Product | Form Edit";

include '../../components/head.php';
include "../../connection.php";
$query = "SELECT * FROM product WHERE product_id ='$_GET[id]'";
$pet = mysqli_query($db_connection, $query);
$data = mysqli_fetch_assoc($pet);

?>

<h1>Form Edit </h1>

<div class="container mt-4">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form action="../../action/product/update_product.php" method="POST">
                    <div class="form-group">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="product_name" id="name" value="<?= $data['product_name'] ?>" required class="form-control">
                        <input type="hidden" name="product_id" id="" value="<?= $data['product_id'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" required class="form-select">
                            <option value="" selected disabled>Choose</option>
                            <option value="PS5" <?= ($data['type'] == 'PS5') ? 'selected' : ''; ?>>PS 5</option>
                            <option value="PS4" <?= ($data['type'] == 'PS4') ? 'selected' : ''; ?>>PS 4</option>
                            <option value="PS3" <?= ($data['type'] == 'PS3') ? 'selected' : ''; ?>>PS 3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="specification" class="form-label">Specification</label>
                        <textarea name="specification" id="specification" required class="form-control textarea"><?= $data['specification'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="hourly_price" class="form-label">Hourly Price</label>
                        <input type="number" name="hourly_price" id="hourly_price" value="<?= $data['hourly_price'] ?>" required class="form-control">
                    </div>

                    <div class="form-group" style="display:flex; justify-content:flex-end;">
                        <button type="submit" name="save" class="btn btn-success mx-3">SAVE</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../../components/footer.php' ?>