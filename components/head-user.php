<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page, ENT_QUOTES, 'UTF-8') ?></title>
    <?php
    $basePath = ($page == "Dashboard") ? "../public/" : (($page != "Home") ? "../../public/" : "public/");
    ?>
    <link rel="stylesheet" href="<?= $basePath ?>css/style.css">
    <!-- <link rel="stylesheet" href="<?= $basePath ?>css/navbar.css"> -->
</head>

<body>
    <?php
    $navbarPath = ($page != "Home") ? "../../components" : "components";

    include $navbarPath . '/navbar-user.php';
    ?>
    <main class="content" id="content">