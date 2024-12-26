<?php
$title = 'Product';
$page = 'read_product';
include '../components/head.php';

?>

<h1>Product List</h1>

<div class="container mt-5">
    <p><a class="btn btn-success btn-sm" href="add_pet_230012.php">Add New Pet</a></p>
    <div class="card">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Gender</th>
                        <th>Age (month) </th>
                        <th>Owner</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Jhon</td>
                        <td>Manusia</td>
                        <td>Laki</td>
                        <td>10</td>
                        <td>HJ ule</td>
                        <td>jalan jalan</td>
                        <td>0812490234</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">Edit Pet</a> |
                            <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure Delete this Pet?')">Delete Pet</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../components/footer.php' ?>