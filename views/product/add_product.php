<?php
$page = "Product | Form Add";

include '../../components/head.php';

?>

<h1>Form Add </h1>

<div class="container mt-4">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form action="../../action/product/create_product.php" method="POST">
                    <div class="form-group">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="product_name" id="name" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" required class="form-select">
                            <option value="" selected disabled>Choose</option>
                            <option value="PS5">PS 5</option>
                            <option value="PS4">PS 4</option>
                            <option value="PS3">PS 3</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="specification" class="form-label">Specification</label>
                        <textarea name="specification" id="specification" required class="form-control textarea"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="hourly_price" class="form-label">Hourly Price</label>
                        <input type="number" name="hourly_price" id="hourly_price" required class="form-control">
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