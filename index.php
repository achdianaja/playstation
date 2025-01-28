<?php
$page = 'Home';

include 'components/head-user.php';
include 'connection.php';
date_default_timezone_set('Asia/Jakarta');

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
          WHERE DATE(start_rent) = '$today' AND booking.status = 'starting'";

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

$ps3 = "SELECT * FROM product WHERE type = 'PS3'";
$ps3_result = $db_connection->query($ps3);
$ps3_count = $ps3_result->num_rows;

$ps4 = "SELECT * FROM product WHERE type = 'PS4'";
$ps4_result = $db_connection->query($ps4);
$ps4_count = $ps4_result->num_rows;

$ps5 = "SELECT * FROM product WHERE type = 'PS5'";
$ps5_result = $db_connection->query($ps5);
$ps5_count = $ps5_result->num_rows;

?>

<h1 class="mt-3 text-center">Jadwal Hari Ini (<?php echo $currentDayTranslated; ?>)</h1>
<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Hari</th>
                        <th scope="col">PS 3</th>
                        <th scope="col">PS 4</th>
                        <th scope="col">PS 5</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $currentDayTranslated; ?></td>
                        <td>
                            <?php
                            echo empty($jadwalHariIni['ps3']) ? '-' : implode('<br><br>', $jadwalHariIni['ps3']);
                            ?>
                        </td>
                        <td>
                            <?php
                            echo empty($jadwalHariIni['ps4']) ? '-' : implode('<br><br>', $jadwalHariIni['ps4']);
                            ?>
                        </td>
                        <td>
                            <?php
                            echo empty($jadwalHariIni['ps5']) ? '-' : implode('<br><br>', $jadwalHariIni['ps5']);
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
                <h1><?php echo $ps3_count; ?></h1>
                <a href="views/customer/ps3.php" class="btn btn-primary">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card" style="background-color: #ED0984;">
            <div class="card-body">
                <img src="public/assets/images/ps4.png" alt="" class="card-img">
                <h1><?php echo $ps4_count; ?></h1>
                <a href="views/customer/ps4.php" class="btn btn-primary">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card" style="background-color: #32B669;">
            <div class="card-body">
                <img src="public/assets/images/ps5.png" alt="" class="card-img">
                <h1><?php echo $ps5_count; ?></h1>
                <a href="views/customer/ps5.php" class="btn btn-primary">Lihat</a>
            </div>
        </div>
    </div>
</div>
<?php include 'components/footer-user.php'; ?>