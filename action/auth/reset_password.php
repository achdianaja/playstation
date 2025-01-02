<?php 
session_start();
if (!isset($_SESSION['login'])) {
    echo "<script>alert('Please Login First !');window.location.replace('../auth/form_login_230012.php')</script>";
}

if(isset($_GET['id'])){
    include '../../koneksi.php';

    $password = password_hash($_GET['type'], PASSWORD_DEFAULT);
    $query = "UPDATE users_230012 SET password_230012='$password' WHERE user_id_230012='$_GET[id]';";
    $update = mysqli_query($db_con, $query);
    if($update){
        echo "<script>alert('Reset Passowrd Successfully !')</script>";
    } else {
        echo "<script>alert('Reset Password Failed !')</script>";
    }
}
?>
<script>window.location.replace("../users/read_user_230012.php")</script>
