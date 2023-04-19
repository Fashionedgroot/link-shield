<?php
if(!$_SESSION['user_id']){
	echo '<script>
    window.location = "logout.php";
</script>';
} 
date_default_timezone_set(date_default_timezone_get());
function generateRandomString($length = 100) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}			
$token=generateRandomString();
			
$users_status=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));
if($user_status['status']=='deactive'){
		mysqli_query($conn,"UPDATE users SET token='".$token."', last_login='". date("Y/m/d H:i:s")."' WHERE user_id='".$_SESSION['user_id']."'");
		header('location: confirm.php?token='.$token.'');
} else if ($user_status=='disabled'){
	header('location:logout.php');
} else {}
?>
<nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
            <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand" href="/">
                <img style="height:50px;" class="brand-img d-inline-block" src="dist/img/logo-light.png" alt="brand" />
            </a>
        </nav>