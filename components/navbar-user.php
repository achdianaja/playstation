<?php
session_start();
include 'config.php';
$menuItems = [
    'Profile' => ['views/customer/profile.php'],
    'Logout' => ['action/auth/logout.php'],
    'Change Password' => ['views/auth/change_password.php'],
];

?>

<!-- Start Navbar -->
<nav class="navbar" id="navbar">

    <div class="navbar-brand">
        <img src="<?php echo $baseLink; ?>public/assets/logo-playstation.png" alt="Logo" class="logo">
    </div>

    <?php if (empty($_SESSION['photo_user']) && empty($_SESSION['name'])) { ?>
        <div>
            <a href="<?php $baseLink ?>/playstation/views/auth/form_regis.php" class="btn btn-primary">Register</a>
            <a href="<?php $baseLink ?>/playstation/views/auth/form_login.php" class="btn btn-primary">Login</a>
        </div>
        <?php } else { ?>
            <a href="<?php $baseLink ?>/playstation/views/customer/mybooking.php">My Booking</a>
        <div class="img-dropdown">
            <div><?php echo $_SESSION['name'] ?></div>
            <img src="/playstation/public/assets/images/user/<?php echo $_SESSION['user_photo'] ?>" alt="User Photo" width="40" height="40" style="border-radius: 100%;">
            <div class="dropdown-menu">
                <?php foreach ($menuItems as $title => [$link]) : ?>
                    <a href="<?= $baseLink . $link ?>">
                        <?= $title ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php } ?>
</nav>
<!-- end navbar -->