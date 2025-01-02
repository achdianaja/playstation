<?php
$page = 'Dashboard';
$rr = "Dashboard";

include '../components/head.php';
if (!isset($_SESSION['login'])) {
    echo "<script>alert('Please Login First !');window.location.replace('auth/form_login.php')</script>";
}

?>
<h1><?php echo $page ?></h1>

<?php include '../components/footer.php' ?>