<?php
	session_start();
	include 'config.php';
	$alert=NULL;
	$link_id=$_GET['id'];
	$links=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM links WHERE link_id='".$link_id."'"));
	$users=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$links['user_id']."'"));
	$settings=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id='1'"));
	$ads=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ads WHERE id='1'"));
	$links_st=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM links WHERE link_id='".$link_id."'"));
	if(!$links_st>=1){
		header('location:/');
	}
	$earn_lmt=$settings['earn_limit'];
	$earn=$earn_lmt/1000; //>> Earn/Per Click
	
	if($links['title']==''){
		$title=$settings['site_name'];
	} else {
		$title=$links['title'];
	}
	if($links['user_id']==''){
		$user='Anonymous';
	} else {
		$user=$users['name'];
	}
	$ip_add=$_SERVER['REMOTE_ADDR'];
	$check_ip=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM views WHERE link_id='".$link_id."' and ip_add='".$ip_add."'"));
	if(!$check_ip>=1){
		mysqli_query($conn,"INSERT INTO views (link_id,user_id,date,ip_add) VALUES ('".$link_id."','".$links['user_id']."','".date("Y-m-d")."','".$ip_add."')");
		mysqli_query($conn,"UPDATE users SET wallet = wallet + $earn WHERE user_id='".$links['user_id']."'");
		mysqli_query($conn,"INSERT INTO earn_transactions (user_id,amount,date,type) VALUES ('".$links['user_id']."','".$earn."','".date("Y-m-d")."','Link View')");
	}
	$views=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM views WHERE link_id='".$link_id."'"));
	
	if(isset($_POST['saveit'])){

		$newFileName = 'files/'.$link_id.".txt";
		$newFileContent = $links['urls'];
		$filename=file_put_contents($newFileName, $newFileContent);
		
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$link_id.txt");
		header("Content-Type: application/txt");
		header("Content-Transfer-Encoding: binary");
		
		// Read the file
		readfile($newFileName);
		exit;
	}
	
	if(isset($_POST['unlock'])){
		if($_POST['pass']==$links['password']){
		$links['pass']='no';
		$alert='<div class="alert alert-success"><i class="fa fa-check"></i>&nbsp;Currect Encryption Key, Links unlocked!</div>';
		} else {
			$links['pass']='yes';
			$alert='<div class="alert alert-danger"><i class="fa fa-remove"></i>&nbsp;Incorrect Encyption Key!</div>"';
		}
	}
	$date=date("Y-m-d H:i");
?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
   	<title><?php echo $title;?> - <?Php echo $settings['site_name'];?></title>
		<!-- meta tags-->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Make your link safe using Link Protector" />
		<meta name="keywords" content="link, short, protector" />
		<meta name="author" content="Rohit Chauhan" />
		<meta name="robots" content="nofollow, noindex" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="../favicon.ico">
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Toggles CSS -->
    <link href="../vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="../vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="../dist/css/style.css" rel="stylesheet" type="text/css">
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
				<div id="resultHead">'.$ads['ads2'].'</div>
			</div>
			</form>
		';
	}
?>
											<div class="card p-4">
<p>Download Link Protector helps you offer downloads in a safe and secure way. You can still offer your downloads the way you have been doing till now. However now your downloads can not be copied or distributed through emails, forums and social networking websites.</p>
	
			<hr>
			<?php echo $alert;?>
			<br>
			<center>
			<div id="text-url" class="card p-2" style="text-align:left;background:#ffffcc;">
			<?php 
			if($links['status']=='blocked'){
					echo '<div class="alert alert-danger"><i class="fa fa-ban"></i>&nbsp;Blocked</div>';
			} else if($links['status']=='removed'){
					echo '<div class="alert alert-danger"><i class="fa fa-remove"></i>&nbsp;Link Removed or Expaired</div>';
			} else {
				
				if($links['pass']=='yes'){
					echo '<div class="alert alert-warning bg-primary text-white"><i class="fa fa-lock"></i>&nbsp;Link is Protected, Enter Encyption Key to Show Links.</div>
							<center><form action="" method="post">
								<label>Enter Encryption Key</label>
								<input name="pass" class="form-control" placeholder="Enter Key"/>
								<br>
								<input name="unlock" class="btn btn-dark" type="submit" value="UNLOCK"/>
							</form>
							</center>
					';
				} else {
				$url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i'; 
				$string = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>',  $links['urls']);
				echo $string;
				
				}
			}
				?>
			</div>
			</center>
			<br>
		<div class="row">
			<div class="col">
				<center><span class="badge badge-dark">Created by</span> <?php echo $user;?></center>
			</div>
			<div class="col">
				<center><span class="badge badge-dark">Created On</span> <?php echo date("d M Y",strtotime($links['date']));?></center>
			</div>
			<div class="col">
				<center><span class="badge badge-dark">View</span> <?php echo $views;?></center>
			</div>
		</div>
		<br>	
			<center>
			<form action="" method="post">
			<?php 
				if($links['pass']=='yes' || $links['status']=='blocked' || ($links['status']=='removed' && $links['status']!='0')){
					echo '';
				} else {
					echo '<button name="saveit" style="width:200px;" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;SAVE IT</button>';
				}
				?>
			</form>
			</center>
		<br>		
		<hr>
		<p>We provides one of the finest Link Protecting services in the world. Our Team Experts have created our very own Link Sharing Algorithm (implemented carefully) to maintain your Links at Max Speed with the alternative of consuming much more and inappropriate Resources. We at JioLink always care for our users and protect their information and all the services are ascendable referred to your benefit like you can easily add more links and edit without putting a notable impact on yours mind.</p>
		
		</div>
		
		<br>
		</div>
									</div>
								</div>
							</div>
						</div>	
						
					<?php
	if($check_ip>=$ads_click){
		echo '';
	} else {
		echo '
			<form id="insertformFoot" action="../ad_click.php" method="post">
			<input type="hidden" name="ip" value="'.$users_ip.'"/>
			<div id="sendFoot">
				<div id="resultFoot">'.$ads['ads2'].'</div>
			</div>
			</form>
		';
	}
?>
					</div>
                </div> <?php include 'home_footer.php';?>
                <!-- /Row -->
            </div>
            <!-- /Container -->

            <!-- Footer -->
          
            <!-- /Footer -->

     


    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/click.js"></script>

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