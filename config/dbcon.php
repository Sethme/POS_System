<?php

define('DB_SERVER',"localhost");
define('DB_USERNAME',"root");
define('DB_PASSWORD',"");
define('DB_DATABASE',"pos_system_php");

$conn = mysqli_connect("localhost", "root", "root", "pos_system_php");

if(!$conn){
    die("Connection Failed:". mysqli_connect_error());
}
?>
