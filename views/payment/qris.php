<?php 

include '../../connection.php';

$data = "SELECT * FROM booking WHERE booking_id = '$_GET[booking_id]'";
$result = $db_connection->query($data);
$booking = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran QRIS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }

        .payment-qris {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 400px;
            border: 1px solid #ddd;
        }

        .text-center{
            text-align: center;
        }

        .payment-qris img.logo {
            width: 200px;
            margin-bottom: 10px;
        }

        .merchant-info {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .merchant-id {
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
        }

        .grand-total {
            font-size: 30px;
            /* color: #555; */
            /* margin-bottom: 15px; */
            font-weight: bold;
        }

        .qris-image {
            width: 100%;
            height: auto;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .instruction {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        label {
            font-weight: 600;
            font-size: 14px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        a {
            width: 100%;
            padding: 12px;
            background: #d32f2f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
        }

        a:hover {
            background: #b71c1c;
        }
    </style>
</head>

<body>
    <div class="payment-qris">
        <img src="../../public/assets/iconQris.png" alt="QRIS Logo" class="logo">
        <div class="text-center">
            <p class="merchant-info">PLAYSTATION</p>
            <p class="merchant-id">NMID: ID2021065207775</p>
            <p class="grand-total"><?= number_format($booking['total_price'], 0, ',', '.') ?></p>
            <img src="../../public/assets/barcode.png" alt="QR Code QRIS" class="qris-image">
            <p class="instruction">Scan kode QR di atas menggunakan aplikasi pembayaran pilihan Anda.</p>
            <a href="../../index.php">Selesai</a>
        </div>
    </div>
</body>

</html>