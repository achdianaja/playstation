<?php
$page = 'Home';

include 'components/head.php';

?>

<h1>Form Add </h1>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">

            <table class="table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>pp</th>
                        <th>pp</th>
                        <th>pp</th>
                        <th>pp</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>rr</td>
                        <td>rr</td>
                        <td>rr</td>
                        <td>rr</td>
                        <td>rr</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-4">
        <div class="card" style="background-color: #1C7ABF;">
            <div class="card-body">
                <img src="public/assets/images/ps3.png" alt="" class="card-img">
                <h1><?php echo "100"; ?></h1>
                <a href="views/customer/ps3.php" class="btn btn-primary">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card" style="background-color: #ED0984;">
            <div class="card-body">
                <img src="public/assets/images/ps4.png" alt="" class="card-img">
                <h1><?php echo "100"; ?></h1>
                <a href="views/customer/ps4.php" class="btn btn-primary">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card" style="background-color: #32B669;">
            <div class="card-body">
                <img src="public/assets/images/ps5.png" alt="" class="card-img">
                <h1><?php echo "100" ?></h1>
                <a href="views/customer/ps5.php" class="btn btn-primary">Lihat</a>
            </div>
        </div>
    </div>
</div>
<?php include 'components/footer.php'; ?>