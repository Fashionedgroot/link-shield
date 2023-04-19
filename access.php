<?php

$settings=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id='1'"));
$currency=$settings['symbol'];

$dd=30;
$curdate=date("Y-m-d",strtotime("+1 day"));
$beforedate=date("Y-m-d",strtotime("-".$dd." day"));
$users_ip=$_SERVER['REMOTE_ADDR'];
$check_ip=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM ads_click WHERE ip='".$users_ip."' and date BETWEEN '".$beforedate."' AND '".$curdate."'"));
$ads_click=2;
?>