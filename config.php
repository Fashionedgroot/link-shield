<?php
error_reporting(0);
$server="localhost"; //Server
$username="*******"; //cPanel Username
$password="*******"; //cPanel Password
$database="*******"; //Database Name

//----------------------------------

date_default_timezone_set(date_default_timezone_get());

$conn=mysqli_connect($server,$username,$password,$database);

require 'access.php';
?>