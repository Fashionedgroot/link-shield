<?php
	include 'config.php';
	$ok=mysqli_query($conn,"INSERT INTO ads_click (ip,date) VALUES ('".$_POST['ip']."','".date("Y-m-d")."')");
?>