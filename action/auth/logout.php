<?php
    session_start();
    session_destroy();
    session_unset();
    echo "<script>alert('Logout Success !');window.location.replace('../../views/auth/form_login.php')</script>";
?>
