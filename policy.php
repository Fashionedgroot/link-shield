<?php
	session_start();
	include 'config.php';
	$alert=NULL;
	$settings=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id='1'"));
	$ads=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ads WHERE id='1'"));
?>
<html>
	<head>
		<title>Terms and Policy | <?php echo $settings['site_name'];?></title>
		<!-- meta tags-->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Make your link safe using <?php echo $settings['site_name'];?>" />
		<meta name="keywords" content="link, short, protector" />
		<meta name="author" content="Rohit Chauhan" />
		<meta property="og:title" content="Terms and Policy | <?php echo $settings['site_name'];?>" />
		<meta property="og:type" content="website" />
		<meta property="og:description" content="Protect your unlimited links and earn money via sharing link as per view. | "<?php echo $settings['site_name'];?> />
		<meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'];?>" />
		<meta property="og:image" content="http://<?php echo $_SERVER['HTTP_HOST'];?>/assets/img/og.png" />		<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="assets/fonts/css/font-awesome.min.css">
		<link rel="icon" href="favicon.png" sizes="16x16" type="image/png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/jquery-1.9.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
	</head>
	<body class="bg-light">
		<?php include 'header.php';?>
		<div class="container">
		<br>
		<div class="card p-4">
			<h5><i style="color:green;" class="fa fa-file-text-o"></i>&nbsp;Terms and Policy</h5>
			<hr>
			<?php echo $alert;?>
			<div class="page-content">
			<?php
	if($check_ip>=2){
		echo '';
	} else {
		echo '
			<form id="insertformMoney" action="ad_click.php" method="post">
			<input type="hidden" name="ip" value="'.$users_ip.'"/>
			<div id="sendMoney">
				<div id="resultMoney">'.$ads['ads2'].'</h4>
			</div>
			</form>
		';
	}
?>
				<p> <strong><?php echo $_SERVER['HTTP_HOST'];?></strong> 's policy is to respect and protect the privacy of our users. We at  <strong><?php echo $_SERVER['HTTP_HOST'];?></strong>  respect your privacy. All information collected at  <strong><?php echo $_SERVER['HTTP_HOST'];?></strong>  is kept confidential and will not be sold, reused, or rented in any way. We do not share your information with any 3rd parties.</p>
				<strong>IP Addresses:</strong>
				<p>IP addresses are logged by  <strong><?php echo $_SERVER['HTTP_HOST'];?></strong>  to ensure account safety features availability, measuring usage and statistics.</p>
				<strong>Email Addresses:</strong>
				<p>We collect email addresses of users at the time of registration as means of contact and verification.  <strong><?php echo $_SERVER['HTTP_HOST'];?></strong>  does not rent, sell, or share your email addresses with anyone.</p>
				<strong>Your account username and password:</strong>
				<p>Please note that it is your responsibility to keep the username and password confidential, so do not share it with anyone. If you use a public PC, make sure you log out prior to leaving  <strong><?php echo $_SERVER['HTTP_HOST'];?></strong>  site. You are solely responsible for keeping your username/password inviolable.</p>
				<strong>Certain Exceptional Disclosures:</strong>
				<p>We may disclose your information if necessary to protect our legal rights or if the information relates to actual or threatened harmful conduct or potential threats to the physical safety of any person. The disclosure of personal information may be required by court or law enforcement officials.</p>
				<strong>Use of Cookies:</strong>
				<p> <strong><?php echo $_SERVER['HTTP_HOST'];?></strong>  uses cookies in order to track and analyze preferences of our users and, as a result, improve our site. A cookie is an encrypted number, generated when you visit any site that supports sessions. This cookie is saved permanently on your computer. This data does not contain any secure information (just an encrypted string). Additionally, we set a cookie when you log in to make further logging into our system a little easier. No other website can access any information about you from the cookies we may store on your local computer. We do not share cookies or any other type of information with any other companies. You can always choose not to receive a cookie file by enabling your web browser to refuse cookies or to prompt you before accepting a cookie.</p>
				<strong>Third party cookies:</strong>
				<p>In case of serving advertisements to this site, our third-party advertiser may place or recognize a unique cookie on your browser.</p>
				<strong>External links:</strong>
				<p>If any part of the  <strong><?php echo $_SERVER['HTTP_HOST'];?></strong>  website links you to other websites, those websites do not operate under this Privacy Policy. We recommend you examine the privacy statements posted on those other websites to understand their procedures for collecting, using and disclosing personal information.</p>
				<strong>Changes to Privacy Policy:</strong>
				<p>We reserve the right, at any time and without notice, to add to, change, update, or modify this Privacy Policy. Any change, update, or modification will be effective immediately upon posting on the site. Please check this page periodically for changes.</p>
		</div>
		</div>
		<br>
		</div>
			<?php include 'footer.php';?>	
	</body>
	<script>
		$('#insertformMoney').submit(function(){
			return false;
		});
		$('#sendMoney').click(function(){
			$.post(		
				$('#insertformMoney').attr('action'),
				$('#insertformMoney :input').serializeArray(),
				function(result){
					$('#resultMoney').html(result);
				}
			);
		});
			$('#insertformHead').submit(function(){
			return false;
		});
		$('#sendHead').click(function(){
			$.post(		
				$('#insertformHead').attr('action'),
				$('#insertformHead :input').serializeArray(),
				function(result){
					$('#resultHead').html(result);
				}
			);
		});
		
		$('#insertformFoot').submit(function(){
			return false;
		});
		$('#sendFoot').click(function(){
			$.post(		
				$('#insertformFoot').attr('action'),
				$('#insertformFoot :input').serializeArray(),
				function(result){
					$('#resultFoot').html(result);
				}
			);
		});
	</script>
</html>