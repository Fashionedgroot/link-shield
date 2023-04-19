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
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar hk-navbar-alt">
            <a class="navbar-toggle-btn nav-link-hover navbar-toggler" href="javascript:void(0);" data-toggle="collapse" data-target="#navbarCollapseAlt" aria-controls="navbarCollapseAlt" aria-expanded="false" aria-label="Toggle navigation"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand" href="/">
                <img style="height:60px;" class="brand-img d-inline-block align-top" src="dist/img/logo-dark.png" alt="brand" />
            </a>
            <div class="collapse navbar-collapse" id="navbarCollapseAlt">
                <ul class="navbar-nav">
					<li class="nav-item">
                        <a class="nav-link" href="all_links.php?s=active"><i class="fa fa-link"></i>&nbsp;Manage Links</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="refer.php"><i class="fa fa-trophy"></i>&nbsp;Refer</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="mywallet.php"><i class="fa fa-money"></i>&nbsp;My Wallet</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="withdraw.php?s=paid"><i class="fa fa-exchange"></i>&nbsp;Withdraw</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav hk-navbar-content">
			
				<li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar">
                                    <img src="favicon.png" alt="user" class="avatar-img rounded-circle">
                                </div>
                                <span class="badge badge-success badge-indicator"></span>
                            </div>
                            <div class="media-body">
                                <span>Hy, <?php echo $logged_user['name'];?><i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                       <a class="dropdown-item" href="account.php"><i class="dropdown-icon fa fa-paper-plane"></i><span>Account</span></a>
                       <a class="dropdown-item" href="password.php"><i class="dropdown-icon fa fa-lock"></i><span>Password</span></a>
                       <a class="dropdown-item" href="payment.php"><i class="dropdown-icon fa fa-usd"></i><span>Payment Settings</span></a>
                        <a class="dropdown-item" href="logout.php"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /Top Navbar -->
		