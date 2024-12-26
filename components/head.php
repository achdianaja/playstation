<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <?php if ($page == 'index') {?>
        <link rel="stylesheet" href="public/css/style.css">
        <script src="public/js/sidebar.js"></script>
    <?php } else { ?>
        <link rel="stylesheet" href="../public/css/style.css">
        <script src="../public/js/sidebar.js"></script>
    <?php } ?>
</head>

<body>
    <?php
    include "navbar.php";
    include "sidebar.php";
    ?>
    <main class="content shifted" id="content">