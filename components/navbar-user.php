<?php
session_start();
include 'config.php';
include $baseLink . 'connection.php';
$menuItems = [
    'Profile' => ['views/customer/profile.php'],
    'Logout' => ['action/auth/logout.php'],
    'Change Password' => ['views/auth/change_password.php'],
];

?>

<!-- Start Navbar -->
<nav class="navbar" id="navbar">
    <div class="navbar-brand" style="display: flex; align-items: center;">
        <img src="<?php echo $baseLink; ?>public/assets/logo-playstation.png" alt="Logo" class="logo" style="height: 40px;">
    </div>

    <?php if (empty($_SESSION['photo_user']) && empty($_SESSION['name'])) { ?>
        <div>
            <a href="<?php echo $baseLink ?>views/auth/form_regis.php" class="btn btn-primary">Register</a>
            <a href="<?php echo $baseLink ?>views/auth/form_login.php" class="btn btn-primary">Login</a>
        </div>
    <?php } else {
        
        $mybooking = 'SELECT * FROM booking WHERE user_id = ' . $_SESSION['userid'];
        $mybooking = mysqli_query($db_connection, $mybooking);
        $mybooking = mysqli_num_rows($mybooking);
    ?>
        <div style="display: flex; align-items: center; gap: 20px;">
            <a href="<?php echo $baseLink ?>views/customer/mybooking.php" class="" style="text-decoration: none; padding: 5px 10px; border-radius: 5px; background-color: #6c757d; color: white; position: relative;">
                My Booking
                <span class="notif-dot" style="position: absolute; top: -5px; right: -5px; width: 20px; height: 20px; background-color: red; border-radius: 50%; color: white; display: flex; justify-content: center; align-items: center; font-size: 12px; font-weight: bold;">
                    <?php echo $mybooking > 0 ? $mybooking : 0; ?>
                </span>
            </a>
            <div class="img-dropdown" style="position: relative;">
                <div style="display: flex; align-items: center; cursor: pointer;">
                    <div style="margin-right: 10px;"> <?php echo $_SESSION['name'] ?> </div>
                    <img src="/playstation/public/assets/images/user/<?php echo $_SESSION['user_photo'] ?>" alt="User Photo" width="40" height="40" style="border-radius: 50%;">
                </div>
                <div class="dropdown-menu" style="position: absolute; top: 50px; right: 0; background: white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border-radius: 5px; display: none; flex-direction: column;">
                    <?php foreach ($menuItems as $title => [$link]) : ?>
                        <a href="<?= $baseLink . $link ?>" style="padding: 10px 20px; text-decoration: none; color: black;"> <?= $title ?> </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php } ?>
</nav>
<!-- end navbar -->