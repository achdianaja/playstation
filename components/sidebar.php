<?php

include 'config.php';

$menuItems = [
    'Dashboard' => ['views/dashboard.php', 'home-alt.svg', 'views/dashboard.php'],
    'Product' => ['views/product/read_product.php', 'gamepad.svg', 'views/product/'],
    'User' => ['views/user/read_user.php', 'user.svg', 'views/user'],
    'Booking' => ['views/booking/read_booking.php', 'booking.svg', 'views/booking/'],
];

// if ($_SESSION['role'] == 'Manager') {
//     $menuItems['Users List'] = ['views/users/read_user_230012.php', 'user-list.png', 'views/users/']; 
// }
?>

<div class="sidebar active" id="sidebar">
    <div class="navbar-brand">
        <img src="<?= htmlspecialchars($logoPath) ?>" alt="Logo" class="logo">
    </div>
    <button class="close-btn" id="close" onclick="toggleSidebar()">✖</button>
    <ul class="sidebar-links">
        <?php foreach ($menuItems as $title => [$link, $icon, $subpath]) :
            $active = (strpos($currentPage, $subpath) !== false) ? 'active' : '';
        ?>
            <li>
                <a href="<?= htmlspecialchars($baseLink . $link) ?>" class="<?= $active ?>">
                    <?php include $baseLink . 'public/assets/icons/' . $icon ?>
                    <?= htmlspecialchars($title) ?>
                </a>
            </li>
        <?php endforeach; ?>

    </ul>
</div>