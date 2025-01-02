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
    <link rel="stylesheet" href="<?= $basePath ?>css/sidebar.css">
</head>

<body>
    <?php
    $basePath = ($page == "Dashboard") ? "../components/" : (($page != "Home") ? "../../components/" : "");

    if($page != "Home"){
        include $basePath . 'navbar.php';
        include $basePath . 'sidebar.php';

        $shifted = "";
    } else {
        include $basePath . 'navbar.php';
        $shifted = "shifted";
    }

    ?>
    <main class="content <?php $shifted ?>" id="content">