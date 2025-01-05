<?php
$page = 'Home';

include 'components/head-user.php';
include 'connection.php'; // Koneksi ke database

// Format tanggal hari ini
$today = date('Y-m-d');

// Query untuk mendapatkan data booking hari ini
$query = "SELECT * FROM booking WHERE DATE(start_rent) = '$today'";
$result = $db_connection->query($query);

// Inisialisasi array untuk menyimpan data jadwal berdasarkan hari dan produk
$jadwal = [
    'Senin' => ['ps3' => '-', 'ps4' => '-', 'ps5' => '-'],
    'Selasa' => ['ps3' => '-', 'ps4' => '-', 'ps5' => '-'],
    'Rabu' => ['ps3' => '-', 'ps4' => '-', 'ps5' => '-'],
    'Kamis' => ['ps3' => '-', 'ps4' => '-', 'ps5' => '-'],
    'Jumat' => ['ps3' => '-', 'ps4' => '-', 'ps5' => '-'],
    'Sabtu' => ['ps3' => '-', 'ps4' => '-', 'ps5' => '-'],
    'Minggu' => ['ps3' => '-', 'ps4' => '-', 'ps5' => '-'],
];

// Mapping hari dalam bahasa Inggris ke Indonesia
$hariMap = [
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu',
    'Sunday' => 'Minggu'
];

// Proses data booking
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hari = $hariMap[date('l', strtotime($row['start_rent']))]; // Konversi hari
        $product = 'ps' . $row['product_id']; // Asumsikan product_id adalah angka (3 = PS3, 4 = PS4, dst.)
        
        if (isset($jadwal[$hari][$product])) {
            $jadwal[$hari][$product] = $row['user_id']; // Contoh: tampilkan user_id
        }
    }
}
?>

<h1 class="mt-3">Jadwal Hari ini</h1>
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
                    <?php foreach ($jadwal as $hari => $data): ?>
                        <tr>
                            <td><?php echo $hari; ?></td>
                            <td><?php echo $data['ps3']; ?></td>
                            <td><?php echo $data['ps4']; ?></td>
                            <td><?php echo $data['ps5']; ?></td>
                        </tr>
                    <?php endforeach; ?>
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
<?php include 'components/footer-user.php'; ?>