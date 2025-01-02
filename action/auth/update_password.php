<?php
session_start();
if (isset($_POST['change'])) {
    include '../../../koneksi.php';

    $password = password_hash($_POST['new_password_230012'], PASSWORD_DEFAULT);

    $query = "UPDATE users_230012 SET password_230012='$password' WHERE user_id_230012='$_SESSION[userid]'";

    $create = mysqli_query($db_con, $query);

    if ($create) {
        $_SESSION['password'] = $password;
        echo "<script>alert('Change Password Success !');window.location.replace('../index.php')</script>";
    } else {
        echo "<script>alert('Change Password Failed !');window.location.replace('change_password_230012.php')</script>";
    }
}
?>

<script>
    window.location.replace("read_user_230012.php")
</script>