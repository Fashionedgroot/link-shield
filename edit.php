<?php
	session_start();
	include 'config.php';
	$link_id=$_GET['id'];
	
	$logged_user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));
	
	$mylinks=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM links WHERE link_id='".$link_id."'"));
	if($mylinks['user_id']!=$_SESSION['user_id']){
		header('location:all_links.php?s=active');
	}
	
	if(isset($_POST['update'])){
		$links=mysqli_real_escape_string($conn,$_POST['links']);
		$title=mysqli_real_escape_string($conn,$_POST['title']);
		$password=mysqli_real_escape_string($conn,$_POST['password']);
		$done=mysqli_query($conn,"UPDATE links SET title='".$title."', urls='".$links."', captcha='".$_POST['captcha']."', pass='".$_POST['pass']."', password='".$password."' WHERE link_id='".$link_id."'");
		if($done){
			$alert='<div class="alert alert-success">Link Updated</div>';
		} else {
				$alert='<div class="alert alert-danger">Link Updated Failed</div>';
		}
	}
	
	$links=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM links WHERE link_id='".$link_id."'"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Edit Links</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- select2 CSS -->
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterangepicker CSS -->
    <link href="vendors/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src='dist/jquery-2.1.3.min.js'></script>
	<script src="dist/jquery.min.js"></script>
    <!-- Toggles CSS -->
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
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
	<div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar -->
       <?php include 'header.php';?>
	   
        <!-- /Top Navbar -->

      <?php include 'sidebar.php';?>
        <!-- Setting Panel -->
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Settings</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Links</li>
                </ol>
            </nav>
<div id="result"></div>
            <!-- Container -->
            <div class="container">
                <!-- Title -->
				
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon">
					<i data-feather="align-left"></i></span></span>Links</h4>
                </div>
                <!-- /Title -->
	<?php echo $alert;?>

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                     <section class="hk-sec-wrapper">
					 <form action="" method="post">
					 
			<h4><i class="fa fa-pencil"></i>&nbsp;Edit Links</h4>
			<br>
				<form action="" method="post">
				<div class="form-group">
							<label><i class="fa fa-edit"></i>&nbsp;Link Title</label>
			    		    <input class="form-control" placeholder="Link Title" name="title" type="text" value="<?php echo $links['title'];?>">
			    </div>
					<div class="form-group">
							<label><i class="fa fa-link"></i>&nbsp;Links</label>
				<textarea name="links" class="form-control"><?php echo $links['urls'];?></textarea>
				 </div>
				 <hr>
				<div class="form-group">
							<label><i class="fa fa-lock"></i>&nbsp;ReCaptcha</label>
			    		    <select class="form-control" name="captcha">
								<option value="off" <?php if($links['captcha']=='off'){echo'selected';}else{echo '';}?>>OFF</option>
								<option value="on"<?php if($links['captcha']=='on'){echo'selected';}else{echo '';}?>>ON</option>
							</select>
			    </div>
				<div class="form-group">
							<label><i class="fa fa-lock"></i>&nbsp;Pass</label>
			    		    <select class="form-control" name="pass">
								<option value="off" <?php if($links['pass']=='no'){echo'selected';}else{echo '';}?>>OFF</option>
								<option value="on"<?php if($links['pass']=='yes'){echo'selected';}else{echo '';}?>>ON</option>
							</select>
			    </div>
				<div class="form-group">
							<label><i class="fa fa-edit"></i>&nbsp;Password</label>
			    		    <input class="form-control" placeholder="Password" name="password" type="text" value="<?php echo $links['password'];?>">
			    </div>
				<input type="submit" name="update" class="btn btn-success" value="UPDATE LINKS"/>
				</form>
		</div>
					 </section>

                    </div>
                </div>
			
                <!-- /Row -->
            </div>
            <!-- /Container -->

            <!-- Footer -->
      
            <!-- /Footer -->

        </div>
        <!-- /Main Content -->
    </div>
   <!-- /HK Wrapper -->
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
    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Jasny-bootstrap  JavaScript -->
    <script src="vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- Ion JavaScript -->
    <script src="vendors/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="dist/js/rangeslider-data.js"></script>

    <!-- Select2 JavaScript -->
	  <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="dist/js/dataTables-data.js"></script>


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