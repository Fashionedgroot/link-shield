<?php
session_start();
	include 'config.php';
	$alert=NULL;
	$link_id=$_GET['id'];
	$links=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM links WHERE get_id='".$link_id."'"));
	
	$links_st=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM links WHERE get_id='".$link_id."'"));
	if(!$links_st>=1){
		header('location:/');
	}
	if($links['captcha']=='on'){
		$display='none';
		$display1='none';
		$c_c="on";
	} else {
		$display='none';
		$display1='none';
	}
        
        if($links['title']==''){
		$title=$settings['site_name'];
	} else {
		$title=$links['title'];
	}
        
	$settings=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id='1'"));
	$ads=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ads WHERE id='1'"));
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $title;?> - <?php echo $settings['site_name'];?></title>
	<meta name="robots" content="nofollow, noindex" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="icon" href="../favicon.ico" type="image/x-icon">


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Toggles CSS -->
    <link href="../vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="../vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body class="bg-light" >

    
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">

       

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container-fluid">
                <!-- Row -->
		<?php include 'homeg_header.php';?>
                <div class="row">
                    <div class="col-xl-10 pa-0">
					<div class="tab-content mt-50">
					
							<div class="tab-pane fade show active" role="tabpanel">
								<div class="container">
<?php
	if($check_ip>=$ads_click){
		echo '';
	} else {
		echo '
			<form id="insertformHead" action="../ad_click.php" method="post">
			<input type="hidden" name="ip" value="'.$users_ip.'"/>
			<div id="sendHead">
				<div id="resultHead">'.$ads['ads4'].'</div>
			</div>
			</form>
		';
	}
?>
								
		<center><h3><span id="timer">Wait <span id="progressBar"><?php echo $settings['skip_timer']; ?></span> Sec</span></h3></center>
		<center>
		<span style="color:red;" class="msg-error error"></span>
		<br>
		<div id="cc" style="display:<?php echo $display1?>;">
		<div id="recaptcha" class="g-recaptcha" data-sitekey="<?php echo $settings['re_key'];?>"></div>
		<br>
		<a id="verify" class="btn btn-primary">Verify Captcha</a>
		</div>
		<br>
		
		<br>
			<a style="display:<?php echo $display;?>;text-decoration:none;width:200px;" name="get" id="get_btn" style="width:200px;" class="btn btn-primary" href="../view/<?php echo $links['link_id'];?>"><i class="fa fa-link"></i>&nbsp;&nbsp;GET LINK
			</a>
			</center>
		<br>		
		<hr>
		<p>We provides one of the finest Link Protecting services in the world. Our Team Experts have created our very own Link Sharing Algorithm (implemented carefully) to maintain your Links at Max Speed with the alternative of consuming much more and inappropriate Resources. We at JioLink always care for our users and protect their information and all the services are ascendable referred to your benefit like you can easily add more links and edit without putting a notable impact on yours mind.</p>
		
		</div>
		<?php
	if($check_ip>=$ads_click){
		echo '';
	} else {
		echo '
			<form id="insertformFoot" action="../ad_click.php" method="post">
			<input type="hidden" name="ip" value="'.$users_ip.'"/>
			<div id="sendFoot">
				<div id="resultFoot">'.$ads['ads5'].'</div>
			</div>
			</form>
		';
	}
?>


									</div>
								</div>
							</div>
						</div>	
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
    <!-- jQuery -->
<script>
var xx="<?php echo $c_c; ?>";
var exp_time=<?php echo $settings['skip_timer']; ?>;
</script>
    <script src="../vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="../dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="../dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="../dist/js/feather.min.js"></script>
	    <script src="../vendors/bootstrap-input-spinner/src/bootstrap-input-spinner.js"></script>
    <script src="../dist/js/inputspinner-data.js"></script>
	
    <script src="../vendors/v.js"></script>
    <script src="../vendors/click.js"></script>
	<!-- twitter JavaScript -->
    <script src="../dist/js/twitterFetcher.js"></script>
    <script src="../dist/js/widgets-data.js"></script>
	
	<!-- Owl JavaScript -->
    <script src="../vendors/owl.carousel/dist/owl.carousel.min.js"></script>

    <!-- Owl Init JavaScript -->
    <script src="../dist/js/owl-data.js"></script>
	
    <!-- Toggles JavaScript -->
    <script src="../vendors/jquery-toggles/toggles.min.js"></script>
    <script src="../dist/js/toggle-data.js"></script>

    <!-- Init JavaScript -->
    <script src="../dist/js/init.js"></script>

</body>

</html>