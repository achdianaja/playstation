<?php

if(isset($_POST)) {
    include "../connection.php"; //call connection php mysql

    //sql query INSERT INTO VALUES
    $query = "INSERT INTO user 
    (`fullname`, `username`, `password`, `phone`, `role_id`) 
    VALUES ('$_POST[fullname]', '$_POST[username]', '$_POST[password]', '$_POST[phone]', 0)";

    //run query
    $create = mysqli_query($db_connection, $query);

    if($create) { 
        //echo "<p>Added succeefully!</p>"; //msg html ver
        echo "<script> alert('ADDED SUCCESSFULLY!!')</script>";
    } else {
        //echo "<p>Add pet failed!</p>";
        echo "<script> alert('ADDED FAILED!')</script>"; //msg js ver
    }

}
?>
<!-- <p><a href="read_user230018.php"> << back to usertors list</a></p> -->
<script>window.location.replace("read_user.php");</script>