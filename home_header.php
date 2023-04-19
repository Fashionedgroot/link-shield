<?php
session_start();
$logged_user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));
$ads=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ads WHERE id='1'"));
?>
<div id="resultHeadss"><?php $ads['ads3']?></div>
<nav style="height:80px;" class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
            <a class="navbar-brand" href="/">
                <img style="height:60px;" class="brand-img d-inline-block" src="dist/img/logo-light.png" alt="brand" />
            </a>
			
            <ul class="navbar-nav hk-navbar-content">
			<?php if($_SESSION['user_id']) {?>
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
                                <span><?php echo $logged_user['name'];?><i class="zmdi zmdi-chevron-down"></i></span>
								
                            </div>
                        </div>
						   <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                       <a class="dropdown-item" href="dashboard.php"><i class="dropdown-icon fa fa-line-chart"></i><span>Dashbaord</span></a>
                       <a class="dropdown-item" href="account.php"><i class="dropdown-icon fa fa-paper-plane"></i><span>Account</span></a>
                       <a class="dropdown-item" href="password.php"><i class="dropdown-icon fa fa-lock"></i><span>Password</span></a>
                       <a class="dropdown-item" href="payment.php"><i class="dropdown-icon fa fa-usd"></i><span>Payment Settings</span></a>
                       <a class="dropdown-item" href="logout.php"><i class="dropdown-icon zmdi zmdi-power"></i><span>Log out</span></a>
                    </div>
                    </a>
				</li>
			<?php } else {?>
<div class="dropdown">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    More Pages
  </button>
  <div class="dropdown-menu">
  <?php
	$sql=mysqli_query($conn,"SELECT * FROM pages WHERE page_st='on'");
	while($p=mysqli_fetch_assoc($sql)){
		echo '<a class="dropdown-item" href="pages.php?id='.$p['id'].'">'.$p['page_name'].'</a>';
	}
  ?>
  </div>
</div>
				<li class="nav-link">
				<a href="login.php"><button class="btn btn-primary">Login</button></a>
				</li>	
				<li class="nav-link">
				<a href="signup.php"><button class="btn btn-primary">Signup</button></a>
				</li>
			<?php } ?>
            </ul>
			
        </nav>
		
		