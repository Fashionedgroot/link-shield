<?php
	session_start();
	include 'config.php';
	$alert=NULL;
	function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
		return $randomString;
	}
	$user_id=$_SESSION['user_id'];
	if(isset($_POST['generate'])){
		if(!$_POST['password']==''){
			$pass='yes';
		} else {
			$pass='no';
		}
		$link_gen=generateRandomString();
		$check_link=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM links WHERE link_id='".$link_gen."'"));
		if($check_link>=1){
			$link_gen="X".generateRandomString()."";
		} else {
			$link_gen=generateRandomString();
		}
		$link_rev=generateRandomString();
		$check_r_link=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM links WHERE remove_id='".$link_rev."'"));
		if($check_r_link>=1){
			$link_rev="X".generateRandomString()."";
		} else {
			$link_rev=generateRandomString();
		}
		$link_get=generateRandomString();
		$check_g_link=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM links WHERE get_id='".$link_get."'"));
		if($check_g_link>=1){
			$link_get="X".generateRandomString()."";
		} else {
			$link_get=generateRandomString();
		}
		$mycaptcha = isset($_POST['captcha']) && $_POST['captcha']  ? "on" : "off";
		$urls=mysqli_real_escape_string($conn,$_POST['urls']);
		$password=mysqli_real_escape_string($conn,$_POST['password']);
		$title=mysqli_real_escape_string($conn,$_POST['title']);
		$done_link=mysqli_query($conn,"INSERT INTO links (link_id,get_id,remove_id,urls,pass,password,title,user_id,captcha,date,status) VALUES ('".$link_gen."','".$link_get."','".$link_rev."','".$urls."','".$pass."','".$password."','".$title."','".$user_id."','".$mycaptcha."','".date("Y-m-d H:i")."','active')");
		if($done_link){
			$alert='<div class="alert alert-success"><i class="fa fa-check"></i>&nbsp;Success, Link has been protected</div>';
		} else {
			$alert='<div class="alert alert-danger"><i class="fa fa-remove"></i>&nbsp;Something is wrong, try again</div>';
			$st='none';
		}
	} else {
		header('location:/');
	}
		$settings=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id='1'"));
		$ads=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ads WHERE id='1'"));
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   	<title><?Php echo $settings['site_name'];?> - Share your link now</title>
		<!-- meta tags-->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Make your link safe using Link Protector" />
		<meta name="keywords" content="link, short, protector" />
		<meta name="author" content="Rohit Chauhan" />
		<meta name="robots" content="nofollow, noindex" />
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Toggles CSS -->
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->
    
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">

       

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container-fluid">
                <!-- Row -->
		<?php include 'home_header.php';?>
                <div class="row">
                    <div class="col-xl-10 pa-0">
					<div class="tab-content mt-50">
					
							<div class="tab-pane fade show active" role="tabpanel">
								<div class="container">
									
											<div class="card p-4">
											
											<?php
	if($check_ip>=$ads_click){
		echo '';
	} else {
		echo '
			<form id="insertformHead" action="ad_click.php" method="post">
			<input type="hidden" name="ip" value="'.$users_ip.'"/>
			<div id="sendHead">
				<div id="resultHead">'.$ads['ads2'].'</div>
			</div>
			</form>
		';
	}
?>
			<h5><i style="color:green;" class="fa fa-link"></i>&nbsp;YOUR PROTECTED LINKS</h5>
			<hr>
			<?php echo $alert;?>
			<div style="display:<?php echo $st;?>;">
			<div class="well p-2">
				<h3 style="font-size:16px;" class="badge badge-success">Protected link</h3>&nbsp;&nbsp;&nbsp;&nbsp;
				<a  style="font-size:18px;" href="gets/<?php echo $link_get;?>">http://<?php echo $_SERVER['HTTP_HOST'];?>/gets/<?php echo $link_get;?></a>
			</div>
			<br>
			<div class="well p-2">
				<h3 style="font-size:16px;" class="badge badge-warning">Remove link</h3>&nbsp;&nbsp;&nbsp;&nbsp;
				<a  style="font-size:18px;" href="dels/<?php echo $link_rev;?>">http://<?php echo $_SERVER['HTTP_HOST'];?>/dels/<?php echo $link_rev;?></a>
			</div>
			<hr>
<!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="http://<?php echo $_SERVER['HTTP_HOST'];?>/get/<?php echo $link_get;?>">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_whatsapp"></a>
<a class="a2a_button_google_gmail"></a>
<a class="a2a_button_copy_link"></a>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
			</div>
			<?php
	if($check_ip>=$ads_click){
		echo '';
	} else {
		echo '
			<form id="insertformFoot" action="ad_click.php" method="post">
			<input type="hidden" name="ip" value="'.$users_ip.'"/>
			<div id="sendFoot">
				<div id="resultFoot">'.$ads['ads2'].'</div>
			</div>
			</form>
		';
	}
?>
		</div>
		<br>
		</div>
		
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
           <?php include 'home_footer.php';?>
            <!-- /Footer -->

        </div>
        <!-- /Main Content -->

    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>
    <script src="vendors/click.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="dist/js/feather.min.js"></script>
	    <script src="vendors/bootstrap-input-spinner/src/bootstrap-input-spinner.js"></script>
    <script src="dist/js/inputspinner-data.js"></script>
	
	<!-- twitter JavaScript -->
    <script src="dist/js/twitterFetcher.js"></script>
    <script src="dist/js/widgets-data.js"></script>
	
	<!-- Owl JavaScript -->
    <script src="vendors/owl.carousel/dist/owl.carousel.min.js"></script>

    <!-- Owl Init JavaScript -->
    <script src="dist/js/owl-data.js"></script>
	
    <!-- Toggles JavaScript -->
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>

    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>

</body>

</html>