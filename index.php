<?php
$page = 'Home';

include 'components/head-user.php';
include 'connection.php';

$today = date('Y-m-d');
$currentDay = date('l');
$currentDayTranslated = [
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu',
    'Sunday' => 'Minggu'
][$currentDay];

$query = "SELECT booking.*, booking.status AS booking_status, order_product.status AS order_status, product.*
          FROM booking 
          JOIN product ON product.product_id = booking.product_id 
          LEFT JOIN order_product ON order_product.booking_id = booking.booking_id
          WHERE DATE(start_rent) = '$today' AND booking.status = 'rented'";


$result = $db_connection->query($query);

$jadwalHariIni = [
    'ps3' => [],
    'ps4' => [],
    'ps5' => [],
];

foreach ($result as $data) {
    $productType = strtolower($data['type']);
    if (isset($jadwalHariIni[$productType])) {
        $jadwalHariIni[$productType][] = date('H:i', strtotime($data['start_rent'])) . ' - ' . date('H:i', strtotime($data['end_rent']));
    }
}
?>

<h1 class="mt-3">Jadwal Hari Ini (<?php echo $currentDayTranslated; ?>)</h1>
<div class="card">
    <div class="card-body">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Hari</th>
                        <th>PS 3</th>
                        <th>PS 4</th>
                        <th>PS 5</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $currentDayTranslated; ?></td>
                        <td>
                            <?php
                            echo empty($jadwalHariIni['ps3']) ? '-' : implode('<br>', $jadwalHariIni['ps3']);
                            ?>
                        </td>
                        <td>
                            <?php
                            echo empty($jadwalHariIni['ps4']) ? '-' : implode('<br>', $jadwalHariIni['ps4']);
                            ?>
                        </td>
                        <td>
                            <?php
                            echo empty($jadwalHariIni['ps5']) ? '-' : implode('<br>', $jadwalHariIni['ps5']);
                            ?>
                        </td>
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
                <h1><?php echo "100"; ?></h1>
                <a href="views/customer/ps5.php" class="btn btn-primary">Lihat</a>
            </div>
        </div>
    </div>
</div>
<?php include 'components/footer-user.php'; ?>