<?php
session_start();
if (!isset($_SESSION['login'])) {
    echo "<script>alert('Please Login First !');window.location.replace('auth/form_login_230012.php')</script>";
}
$title = 'Monthly Report';
$page = 'read_product';
include '../../components/head.php';
include '../../connection.php';

?>

<h1>Monthly Report</h1>

<?php
$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$year = date('Y');
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <form action="">
                <select name="month" id="" class="form-select mb-3">
                    <option value="">Month</option>
                    <?php for ($m = 1; $m <= 12; $m++) { ?>
                        <option value="<?= $m ?>" <?= (isset($_GET['month']) && $_GET['month'] == $m) ? 'selected' : '' ?>>
                            <?= $months[$m - 1] ?>
                        </option>
                    <?php } ?>
                </select>

                <select name="year" id="" class="form-select mb-3">
                    <option value="">Year</option>
                    <?php for ($y = 0; $y < 2; $y++) { ?>
                        <option value="<?= $year - $y ?>" <?= (isset($_GET['year']) && $_GET['year'] == $year - $y) ? 'selected' : '' ?>>
                            <?= $year - $y ?>
                        </option>
                    <?php } ?>
                </select>
                <input type="submit" value="View Report" class="btn btn-success">
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary mb-3" onclick="printReport()">Print Report</button>
            <div class="table-wrapper" id="printArea">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <!-- <th>Order ID</th>
                            <th>Booking ID</th> -->
                            <th>Renter</th>
                            <th>Total Price ($)</th>
                            <th>Rent Duration</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <?php if (isset($_GET['year'])) {
                        $query = "SELECT o.order_id, o.booking_id, u.name AS user_name, o.total_price, o.rent_duration, o.status, DATE(o.created_at) AS order_date 
                        FROM order_product AS o
                        JOIN user AS u ON o.user_id = u.user_id
                        WHERE MONTH(o.created_at) = '$_GET[month]' 
                          AND YEAR(o.created_at) = '$_GET[year]'";

                        $report = mysqli_query($db_connection, $query);
                    ?>
                        <tbody>
                            <?php if (mysqli_num_rows($report) > 0) {
                                $i = 1;
                                $total = 0;
                                foreach ($report as $data):
                                    $total += $data['total_price'];
                            ?>
                                    <tr>
                                        <td><?php echo $i++ ?></td>
                                        <td><?php echo $data['order_date'] ?></td>
                                        <!-- <td><?php echo $data['order_id'] ?></td> -->
                                        <!-- <td><?php echo $data['booking_id'] ?></td> -->
                                        <td><?php echo $data['user_name'] ?></td>
                                        <td><?php echo number_format($data['total_price'], 0, ',', '.'); ?></td>
                                        <td><?php echo $data['rent_duration'] ?></td>
                                        <td><?php echo $data['status'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="5" align="left">
                                        <strong>Total:</strong>
                                    </td>
                                    <td colspan="3" align="left">
                                        <strong>$ <?= number_format($total, 0, ',', '.') ?></strong>
                                    </td>
                                </tr>
                            <?php  } elseif (empty($_GET['month']) || empty($_GET['year'])) { ?>
                                <tr>
                                    <td colspan="8" align="center">Please Select</td>
                                </tr>
                            <?php  } else { ?>
                                <tr>
                                    <td colspan="8" align="center">No Record !</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } else { ?>
                        <tr>
                            <td colspan="8" align="center">No Record Please Select First !</td>
                        </tr>
                    <?php } ?>
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
</script>
<?php include '../../components/footer.php' ?>
