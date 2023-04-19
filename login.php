<?php
	session_start();
	include 'config.php';
	if(isset($_POST['login'])){
		$username=mysqli_real_escape_string($conn,$_POST['username']);
		$password=mysqli_real_escape_string($conn,md5($_POST['password']));
		$check=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users where username='".$username."' and password='".$password."'"));
		if($check>=1){
			$data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users where username='".$username."' and password='".$password."'"));
			
			date_default_timezone_set(date_default_timezone_get());
			if ($data['status']=='disabled') {
				$alert='Your Account has been blocked, Apeal Now';
			} else {
			//login code
			$_SESSION['user_id']=$data['user_id'];
				header('location:dashboard.php');
		}
			
		} else {
			$alert='<div class="alert alert-danger">Invalid Username or Password</div>';
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Login</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- Toggles CSS -->
		<link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
		<link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
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
					<div class="row">
						<div class="col-xl-12 pa-0">
							<div class="auth-form-wrap pt-xl-0 pt-70">
								<div class="auth-form w-xl-30 w-lg-55 w-sm-75 w-100">
									<a class="auth-brand text-center d-block mb-20" href="#">
										<img class="brand-img" src="dist/img/logo-light.png" alt="brand"/>
									</a>
								<?php echo $alert;?>
									<form action="" method="post">
										<h1 class="display-4 text-center mb-10">Welcome Back :)</h1>
										<p class="text-center mb-30">100% Secure Login</p> 
										<div class="form-group">
											<input class="form-control" name="username" placeholder="Username" type="text">
										</div>
										<div class="form-group">
											<div class="input-group">
												<input class="form-control" name="password" placeholder="Password" type="password">
												<div class="input-group-append">
													<span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
												</div>
											</div>
										</div>
										<div class="custom-control custom-checkbox mb-25">
											<p><i class="fa fa-lock"></i> &nbsp;Forget Password? <a data-toggle="modal" data-target="#forget" href="#">Click Here</a></p>
				
										</div>
										<button class="btn btn-primary btn-block" name="login" type="submit">Login</button>
										
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Main Content -->
		<div class="modal fade" id="forget">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Forget Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
					<form action="reset_password.php" method="post" id="insertform">
						<input type="email" name="email" class="form-control" Placeholder="Enter Your Regitered Email"/>
						
						<br>
						<input style="width:100%;" name="reset" type="submit" value="Forget" id="insert" class="btn btn-primary btn-block"/>
						<br>
						<br>
						<div id="result"></div>
					</form>
					
      </div>

    </div>
  </div>
</div>
		</div>
		<!-- /HK Wrapper -->
		
		<!-- JavaScript -->
<script>
$('#insertform').submit(function(){
	return false;
});
$('#insert').click(function(){
	document.getElementById("result").innerHTML="Please Wait....";
	$.post(		
		$('#insertform').attr('action'),
		$('#insertform :input').serializeArray(),
		function(result){
			$('#result').html(result);
		}
	);
});
</script>
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