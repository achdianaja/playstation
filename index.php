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
<div class="slider-container">
    <div class="slides">
        <div class="slide clone"><img src="public/assets/hero3.png" alt="Slide 3"></div>
        <div class="slide"><img src="public/assets/hero.png" alt="Slide 1"></div>
        <div class="slide"><img src="public/assets/hero2.png" alt="Slide 2"></div>
        <div class="slide"><img src="public/assets/hero3.png" alt="Slide 3"></div>
        <div class="slide clone"><img src="public/assets/hero.png" alt="Slide 1"></div>
    </div>
    <button class="prev">&#10094;</button>
    <button class="next">&#10095;</button>
</div>

<script>
    const slides = document.querySelector('.slides');
    const slideImages = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');

    let index = 1;
    const slideWidth = 100;
    slides.style.transform = `translateX(-${index * slideWidth}%)`;

    function showSlide(i) {
        index = i;
        slides.style.transition = "transform 0.5s ease-in-out";
        slides.style.transform = `translateX(-${index * slideWidth}%)`;

        setTimeout(() => {
            if (index === slideImages.length - 1) {
                slides.style.transition = "none";
                index = 1;
                slides.style.transform = `translateX(-${index * slideWidth}%)`;
            } else if (index === 0) {
                slides.style.transition = "none";
                index = slideImages.length - 2;
                slides.style.transform = `translateX(-${index * slideWidth}%)`;
            }
        }, 500);
    }

    nextBtn.addEventListener('click', () => showSlide(index + 1));
    prevBtn.addEventListener('click', () => showSlide(index - 1));

    setInterval(() => showSlide(index + 1), 5000);
</script>

<style>
    .slider-container {
        position: relative;
        width: 100%;
        overflow: hidden;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .slides {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .slide {
        min-width: 100%;
    }

    .slide img {
        width: 100%;
        display: block;
    }

    .prev,
    .next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgb(255, 255, 255);
        color: black;
        border: none;
        padding: 10px;
        cursor: pointer;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .prev {
        left: 10px;
    }

    .next {
        right: 10px;
    }
</style>

<section class="mt-5">
    <h1>Booking Disini</h1>
    <div class="row">
        <?php
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
                            <h1>Jumlah Ps</h1>
                            <h1 class="my-3"><?php echo $productCounts[$type]; ?></h1>
                            <a href="views/customer/<?php echo strtolower($type); ?>.php" class="btn btn-primary">Lihat</a>
                        </div>
                        <img src="public/assets/images/<?php echo $images[$index]; ?>" alt="" class="" style="width: 200px;">
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class=" mt-5">
    <h1 class="mb-3">Jadwal Hari <?php echo $currentDayTranslated . " " . date('H:i', time()); ?></h1>
    <div class="card mb-4">
        <div class="card-body">
            <table class="table">
                <thead>
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
                    <?php if ($maxRows === 0): ?>
                        <tr>
                            <td colspan="<?php echo count($jadwalHariIni); ?>">Jadwal masih kosong</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<section class="mt-5">
    <h1 class="mb-3">Hubungi Kami</h1>
    <div class="mb-4" style="display: flex; justify-content: space-around; align-items: center; background-color: #007bff; padding: 20px; border-radius: 10px;">
        <div style="display: flex; flex-direction: column; gap: 15px;">
            <ul style="list-style: none; padding: 0; margin: 0; color: white;">
                <li class="my-4" style="display: flex; align-items: center; gap: 10px;">
                    <img src="public/assets/icons/marker.svg" alt="" width="30">
                    <span>Alamat: Jl. Saparua No. 1, Bandung</span>
                </li>
                <li class="my-4" style="display: flex; align-items: center; gap: 10px;">
                    <img src="public/assets/icons/envelope.svg" alt="" width="30    ">
                    <span>Email: playstationid@gmail.com</span>
                </li>
                <li class="my-4" style="display: flex; align-items: center; gap: 10px;">
                    <img src="public/assets/icons/whatsapp.svg" alt="" width="30    ">
                    <span>Whatsapp: +64 895 422 685 991</span>
                </li>
                <li class="my-4" style="display: flex; align-items: center; gap: 10px;">
                    <img src="public/assets/icons/instagram.svg" alt="" width="30   ">
                    <span>Instagram: @playstationid</span>
                </li>
            </ul>
        </div>
        <div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31686.379529070364!2d107.610112!3d-6.9148052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e645bfffffff%3A0x6ddea69c76478a61!2sGOR%20dan%20Taman%20Saparua!5e0!3m2!1sen!2sid!4v1738411457423!5m2!1sen!2sid"
                width="1000"
                height="300"
                style="border:0; border-radius: 10px;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<?php include 'components/footer-user.php'; ?>