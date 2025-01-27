<?php
$db_host="localhost"; //db server name
$db_username="root";  //db username
$db_password="";      //db password
$db_name="playstation"; //db name 

//connect to mysql, if eror will stop the prrogram
$db_connection = mysqli_connect($db_host,$db_username,$db_password) 
or die;

// select active db
mysqli_select_db($db_connection,$db_name);
?>