<?php
session_start();
include 'config.php';
$menuItems = [
    'Profile' => ['views/users/user_photo.php'],
    'Logout' => ['action/auth/logout.php'],
    'Change Password' => ['views/auth/change_password_230012.php'],
];
?>
<!-- start navbar -->
<nav class="navbar" id="navbar">

    <?php if ($page != 'Home') { ?>
        <div class="">
            <button class="menu-toggle" onclick="toggleSidebar()">&#9776;</button>
        </div>
    <?php } else { ?>
        <div class="navbar-brand">
            <img src="<?php $baseLink ?>public/assets/logo-playstation.png" alt="Logo" class="logo">
        </div>
    <?php } ?>

    <?php if (empty($_SESSION['photo_user']) && empty($_SESSION['fullname'])) { ?>
        <a href="<?php $baseLink ?>views/auth/form_login.php" class="btn btn-success">Login</a>
        <?php } else { ?>
            <div class="img-dropdown">
                <div><?php echo $_SESSION['fullname'] ?></div>
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