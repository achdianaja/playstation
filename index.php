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
          WHERE DATE(FROM_UNIXTIME(start_rent)) = '$today' AND booking.status = 'starting'";

$result = $db_connection->query($query);

$jadwalHariIni = [
    'PS3' => [],
    'PS4' => [],
    'PS5' => [],
];

foreach ($result as $data) {
    $productType = strtoupper($data['type']);
    if (isset($jadwalHariIni[$productType])) {
        $startTime = date('H:i', $data['start_rent']);
        $endTime = date('H:i', $data['end_rent']);
        $jadwalHariIni[$productType][] = "$startTime - $endTime";
    }
}

?>

<h1 class="mt-3 text-center">Jadwal Hari <?php echo $currentDayTranslated; ?></h1>
<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <?php foreach (array_keys($jadwalHariIni) as $type): ?>
                            <th scope="col"><?php echo $type; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $maxRows = max(array_map('count', $jadwalHariIni));

                    for ($i = 0; $i < $maxRows; $i++): ?>
                        <tr>
                            <?php foreach ($jadwalHariIni as $type => $jadwal): ?>
                                <td><?php echo isset($jadwal[$i]) ? $jadwal[$i] : 'Kosong'; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="row">
    <?php
    $colors = ['#1C7ABF', '#ED0984', '#32B669'];
    $images = ['ps3.png', 'ps4.png', 'ps5.png'];

    $productCounts = [];
    $productTypes = ['PS3', 'PS4', 'PS5'];

    foreach ($productTypes as $type) {
        $query = "SELECT COUNT(*) as count FROM product WHERE type = '$type'";
        $result = $db_connection->query($query);
        $productCounts[$type] = $result->fetch_assoc()['count'] ?? 0;
    }

    foreach ($productTypes as $index => $type): ?>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h1 class="my-3"><?php echo $productCounts[$type]; ?></h1>
                        <a href="views/customer/<?php echo strtolower($type); ?>.php" class="btn btn-primary">Lihat</a>
                    </div>
                    <img src="public/assets/images/<?php echo $images[$index]; ?>" alt="" class="" style="width: 200px;">
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'components/footer-user.php'; ?>