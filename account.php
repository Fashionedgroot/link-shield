<?php
	session_start();
	include 'config.php';
	error_reporting(0);
	
	

	

	if(isset($_POST['profile'])){
	$username=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE username='".$_POST['username']."' AND NOT username='".$logged_user['username']."'"));
	$email=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE email='".$_POST['email']."' AND NOT email='".$logged_user['email']."'"));
	if($username==1){
		$alert='<div class="alert alert-danger">@'.$_POST['username'].' already used!</div>';
	}else if($email==1){
		$alert='<div class="alert alert-danger">Already used '.$_POST['email'].'!</div>';
	} else {
		$check=mysqli_query($conn,"UPDATE users SET name='".$_POST['name']."', username='".$_POST['username']."', email='".$_POST['email']."' WHERE user_id='".$_SESSION['user_id']."'");
		if($check){
			$alert='<div class="alert alert-success">Account Updated!<meta http-equiv="refresh" content="1" /></div>';
		} else {
			$alert='<div class="alert alert-danger">Account Updation Failed!</div>';
		}
	}
}
$logged_user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Account Settings</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
 <!-- select2 CSS -->
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterangepicker CSS -->
    <link href="vendors/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
	
	<link href="vendors/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css"/>

    <!-- Toggles CSS -->
    <script src='dist/jquery-2.1.3.min.js'></script>
	<script src="dist/jquery.min.js"></script>
    <!-- Toggles CSS -->
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
	<style>
		.pagination-c {
			padding-left:15px;
			padding-bottom:15px;
			box-sizing:border-box;
			
		}
	</style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->

	<!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar -->
        <?php include 'header.php';?>
        <!-- /Top Navbar -->

  <?php include 'sidebar.php';?>

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Setting</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Account</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->
			                        
            <!-- Container -->
            <div class="container">

                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title">
					<span class="pg-title-icon">
					<span class="feather-icon"><i data-feather="layers"></i></span></span>Account Settings</h4>   
                </div>
                <!-- /Title -->
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">  
					<section class="hk-sec-wrapper">
						
		<form action="" method="post">
			 <fieldset>
			    	  	<div class="form-group">
							<label><i class="fa fa-user"></i>&nbsp;Account Name</label>
			    		    <input class="form-control" placeholder="Name" name="name" type="text" value="<?php echo $logged_user['name'];?>" required>
			    		</div>
						<div class="form-group">
							<label><i class="fa fa-user"></i>&nbsp;Account Username</label>
			    		    <input class="form-control" placeholder="Username" name="username" type="text" value="<?php echo $logged_user['username'];?>" required>
			    		</div>
						<div class="form-group">
							<label><i class="fa fa-envelope"></i>&nbsp;Account Email</label>
			    		    <input class="form-control" placeholder="Email" name="email" type="text" value="<?php echo $logged_user['email'];?>" required>
			    		</div>
						
					<div class="form-group">
								<input type="submit" name="profile" class="btn btn-success" value="UPDATE"/></div>
			    	</fieldset>
					
		</form>
                        </section>
						
						
            </div>
            <!-- /Container -->
           <?php include 'footer.php';?>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->
    </div>

    <!-- /HK Wrapper -->

    <!-- jQuery -->
  <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Jasny-bootstrap  JavaScript -->
	<!-- Dropzone JavaScript -->
	<script src="vendors/dropzone/dist/dropzone.js"></script>
	
	<!-- Dropify JavaScript -->
	<script src="vendors/dropify/dist/js/dropify.min.js"></script>
	
	<!-- Form Flie Upload Data JavaScript -->
	<script src="dist/js/form-file-upload-data.js"></script>
	
    <script src="vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- Ion JavaScript -->
    <script src="vendors/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="dist/js/rangeslider-data.js"></script>

    <!-- Select2 JavaScript -->
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="dist/js/select2-data.js"></script>

    <!-- Bootstrap Tagsinput JavaScript -->
    <script src="vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

    <!-- Daterangepicker JavaScript -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/daterangepicker/daterangepicker.js"></script>
    <script src="dist/js/daterangepicker-data.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="dist/js/feather.min.js"></script>

    <!-- Toggles JavaScript -->
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>

    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
</body>

</html>