<?php
	session_start();
	include 'config.php';
	$alert=NULL;
	$myset=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id=1"));
	$ref_user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_GET['ref']."'"));
if(isset($_GET['ref'])){
$field_show='hidden';
$ref_code=$_GET['ref'];
$ref_alert=' <div class="alert alert-success bg-success text-white" role="alert">
                                        '.$ref_user['name'].' send you '.$currency.''.$myset['reg_user'].', Signup to claim.
                                    </div>';
$user_earn=$myset['reg_user'];;
} else {
	$field_show='text';
	$ref_code=NULL;
	$user_earn=0;
	$ref_alert='';
}	
	
$per_ref=$myset['ref_user'];


if($myset['captcha']=='1'){
					$captcha_display='block';
				} else {	
					$captcha_display='none';
				}
				
if(isset($_POST['signup'])){
			
	$username=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE username='".$_POST['username']."'"));
	$email=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE email='".$_POST['email']."'"));
	
	if($username==1){
		$alert='<div class="alert alert-danger">@'.$_POST['username'].' already used!</div>';
	}else if($email==1){
		$alert='<div class="alert alert-danger">Already Registered with '.$_POST['email'].'!</div>';
	} else {
			$password=mysqli_real_escape_string($conn,md5($_POST['password']));
			$if=mysqli_query($conn,"INSERT INTO users (`name`,`username`,`email`,`status`,`password`,`wallet`,`ref`,`date`,`pay_method`,`details`) VALUES ('".$_POST['name']."','".$_POST['username']."','".$_POST['email']."','active','".$password."','".$user_earn."','".$ref_code."','".date("Y-m-d")."','','')");
			if($if){
				 $users=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE username='".$_POST['username']."'"));
				 mysqli_query($conn,"UPDATE users SET wallet = wallet + $per_ref WHERE user_id=".$ref_code."");
				 mysqli_query($conn,"INSERT INTO earn_transactions (user_id,amount,date,type) VALUES ('".$ref_code."','".$per_ref."','".date("Y-m-d")."','Refer')");
				
				$_SESSION['user_id']=$users['user_id'];
				header('location:dashboard.php');
			} else {
				$alert='<div class="alert alert-danger">Invalid Data!</div>';
			}
	}
}
	$settings=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id='1'"));
	$ads=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ads WHERE id='1'"));
?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Signup</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- Toggles CSS -->
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
		 <!-- Toastr CSS -->
    <link href="vendors/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
		
		<!-- Custom CSS -->
		<link href="dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!-- Preloader -->
		<div class="preloader-it">
			<div class="loader-pendulums"></div>
		</div>
		<!-- /Preloader -->
		
		<!-- HK Wrapper -->
		<div class="hk-wrapper">
			<!-- Main Content -->
			<div class="hk-pg-wrapper hk-auth-wrapper">
				<div class="container-fluid">
					<div class="row pt-20">
						<div class="col-xl-12 pt-10">
							<div class="auth-form-wrap pt-xl-0 pt-70">
								<div class="auth-form w-xl-30 w-lg-55 w-sm-75 w-100">
									<a class="auth-brand text-center d-block mb-20" href="#">
										<img class="brand-img" src="dist/img/logo-light.png" alt="brand"/>
									</a>
								<?php echo $alert;?>
								<div id="cap_alert"></div>
									<form action="" method="post">
										<p class="text-center mb-30">Create New Account</p> 
										<?php echo $ref_alert;?>
										 <fieldset>
					<div class="form-group">
							<label>Enter Name</label>
			    		    <input class="form-control" placeholder="Enter Name" name="name" type="text" required>
			    		</div>
			    	  	<div class="form-group">
						<label>Enter Username</label>
			    		    <input class="form-control" id="nosp" placeholder="Enter Username" name="username" type="text" required>
			    		</div>
							<div class="form-group">
							<label>Enter Email</label>
			    		    <input class="form-control" id="nosp" placeholder="Enter Email" name="email" type="email" required>
			    		</div>
			    		<div class="form-group">
						<label>Enter Password</label>
			    			<input class="form-control" id="nosp" placeholder="Enter Password" name="password" type="password" value="" required>
			    		</div>
						<div class="form-group">
			    			<input class="form-control" id="nosp" placeholder="Enter Refer Code (Optional)" name="refer" type="<?php echo $field_show;?>" value="<?php echo $ref_code;?>">
			    		</div>
						<div style="display:<?php echo $captcha_display;?>;" class="form-group">
							<div class="g-recaptcha" data-sitekey="<?php echo $myset['re_key'];?>"></div>	
						</div>
			    		<input class="btn btn-primary btn-block" name="signup" type="submit" value="SIGN UP">
			    	</fieldset>
									</form>
								</div>
							</div>
							
									<br>
									<br>
									<br>
						</div>
					</div>
				</div>
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /HK Wrapper -->
		
		<!-- JavaScript -->
<script>
$("input#nosp").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});
</script>
<?php if($myset['captcha']=='1'){ ?>
 <script>
$('form').on('submit', function(e) {
  if(grecaptcha.getResponse() == "") {
    e.preventDefault();
    document.getElementById("cap_alert").innerHTML='<div class="alert alert-danger">Invalid Captcha!</div>';
  } else {
   
  }
});
 </script>
<?php } else {} ?>

		<!-- jQuery -->
		<script src="vendors/jquery/dist/jquery.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="vendors/popper.js/dist/umd/popper.min.js"></script>
		<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="dist/js/jquery.slimscroll.js"></script>
	
		<!-- Fancy Dropdown JS -->
		<script src="dist/js/dropdown-bootstrap-extended.js"></script>
		
		<!-- FeatherIcons JavaScript -->
		<script src="dist/js/feather.min.js"></script>
		
		<!-- Init JavaScript -->
		<script src="dist/js/init.js"></script>
	</body>
</html>