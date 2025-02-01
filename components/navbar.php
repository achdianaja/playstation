<?php
session_start();
include 'config.php';
$menuItems = [
    'Profile' => ['views/admin/profile-admin.php'],
    'Logout' => ['action/auth/logout.php'],
    'Change Password' => ['views/auth/change_password.php'],
];
?>

<!-- Start Navbar -->
<nav class="navbar" id="navbar">


    <div>
        <button class="menu-toggle" onclick="toggleSidebar()">&#9776;</button>
    </div>

    <?php if (empty($_SESSION['photo_user']) && empty($_SESSION['name'])) { ?>
        <a href="<?php $baseLink ?>/Playstation/views/auth/form.regis.php" class="btn btn-primary">Login</a>
        <?php } else { ?>
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