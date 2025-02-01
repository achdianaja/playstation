<?php
if (isset($_POST)) {
include "../../connection.php";

    $folder = '../../public/asset/image/user/'; //target folder for upload
    if (move_uploaded_file($_FILES['new_photo']['tmp_name'], $folder . $_FILES['new_photo']['name'])) {

        //success upload, get thte photo name
        $photo = $_FILES['new_photo']['name'];

        $query = "UPDATE user SET user_photo ='$photo' 
        WHERE user_id='$_POST[user_id]'";

        $upload = mysqli_query($db_connection, $query);

        if ($upload) {
            if ($_POST['user_photo'] !== 'default.jpg') unlink($folder . $_POST['user_photo']); //delete old photos
            echo "<script> alert('CHANGE SUCCESSED!');window.location.replace('../../views/admin/profile-admin.php');</script>";
        } else {
            echo "<script> alert('CHANGE FAILED!');window.location.replace('admin_photo.php?id='$_POST[user_id]');</script>";
        }
        //upload failed
    } else {
        echo "<script> alert('UPLOAD FAILED!');window.location.replace('admin_photo.php?id='$_POST[user_id]');</script>";
    }
}
