<?php
session_start();
if (!isset($_SESSION['login'])) {
    echo "<script>alert('Please Login First !');window.location.replace('auth/form_login_230012.php')</script>";
}
$title = 'Monthly Report';
$page = 'Monthly Report';
include '../../components/head.php';
include '../../connection.php';

$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$year = date('Y');
?>

<div class="container mt-4">
    <h1>
        <a href="../dashboard.php" class="btn btn-outline-info btn-sm mr-3">←</a> <?= $page ?>
    </h1>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form method="GET" action="">
                    <div class="row">
                        <div class="col-md-5">
                            <select name="month" class="form-select">
                                <option value="">Select Month</option>
                                <?php for ($m = 1; $m <= 12; $m++) { ?>
                                    <option value="<?= $m ?>" <?= (isset($_GET['month']) && $_GET['month'] == $m) ? 'selected' : '' ?>>
                                        <?= $months[$m - 1] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <select name="year" class="form-select">
                                <option value="">Select Year</option>
                                <?php for ($y = 0; $y < 2; $y++) { ?>
                                    <option value="<?= $year - $y ?>" <?= (isset($_GET['year']) && $_GET['year'] == $year - $y) ? 'selected' : '' ?>>
                                        <?= $year - $y ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success w-100">View Report</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <button class="btn btn-primary" onclick="printReport()">Print Report</button>
    <button class="btn btn-secondary ms-2" onclick="resetForm()">Reset</button>
    <div class="card">
        <div class="card-body">
            <div id="printArea">
                <table class="table" id="reportTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Renter</th>
                            <th>Rent Duration</th>
                            <th>Status</th>
                            <th>Total Price (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $month = isset($_GET['month']) ? (int)$_GET['month'] : 0;
                        $year = isset($_GET['year']) ? (int)$_GET['year'] : 0;

                        if ($month && $year) {
                            $query = "SELECT o.order_id, o.booking_id, COALESCE(u.name, o.renter) AS user_name, 
                                             o.total_price, o.rent_duration, o.status, DATE(o.created_at) AS order_date 
                                      FROM order_product AS o 
                                      LEFT JOIN user AS u ON o.user_id = u.user_id 
                                      WHERE MONTH(o.created_at) = '$month' AND YEAR(o.created_at) = '$year'";
                        } else {
                            $query = "SELECT o.order_id, o.booking_id, COALESCE(u.name, o.renter) AS user_name, 
                                             o.total_price, o.rent_duration, o.status, DATE(o.created_at) AS order_date 
                                      FROM order_product AS o 
                                      LEFT JOIN user AS u ON o.user_id = u.user_id";
                        }


                        $report = mysqli_query($db_connection, $query);
                        $i = 1;
                        $total = 0;

                        if (mysqli_num_rows($report) > 0) {
                            foreach ($report as $data) {
                                $total += $data['total_price'];
                        ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $data['order_date'] ?></td>
                                    <td><?= $data['user_name'] ?></td>
                                    <td><?= $data['rent_duration'] ?></td>
                                    <td><?= $data['status'] ?></td>
                                    <td><?= number_format($data['total_price'], 0, ',', '.') ?></td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td colspan="5" align="left"><strong>Total:</strong></td>
                                <td><strong><?= number_format($total, 0, ',', '.') ?></strong></td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td colspan="6" align="center">No Record Found!</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function printReport() {
        var printContents = document.getElementById('printArea').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    function resetForm() {
        document.querySelector("form").reset();
        window.location.href = window.location.pathname;
    }
</script>


<?php include '../../components/footer.php'; ?>