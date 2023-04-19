<?php
	session_start();
	include 'config.php';
	$alert=NULL;
	$settings=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id='1'"));
	$ads=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ads WHERE id='1'"));
?>
<html>
	<head>
		<title>DMCA Policy | <?php echo $settings['site_name'];?></title>
		<!-- meta tags-->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Make your link safe using <?php echo $settings['site_name'];?>" />
		<meta name="keywords" content="link, short, protector" />
		<meta name="author" content="Rohit Chauhan" />
		<meta property="og:title" content="DMCA | <?php echo $settings['site_name'];?>" />
		<meta property="og:type" content="website" />
		<meta property="og:description" content="Protect your unlimited links and earn money via sharing link as per view. | "<?php echo $settings['site_name'];?> />
		<meta property="og:url" content="http://<?php echo $_SERVER['HTTP_HOST'];?>" />
		<meta property="og:image" content="http://<?php echo $_SERVER['HTTP_HOST'];?>/assets/img/og.png" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
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
			<h5><i style="color:green;" class="fa fa-file-text-o"></i>&nbsp;Digital Millennium Copyright Act (DMCA)</h5>
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
				<p> <strong><?php echo $_SERVER['HTTP_HOST'];?></strong>  intends to fully comply with the Digital Millennium Copyright Act ("DMCA"), including the notice and "take down" Provisions, and to benefit from the safe harbors immunizing  <strong><?php echo $_SERVER['HTTP_HOST'];?></strong>  from liability to the fullest extent of the law.  <strong><?php echo $_SERVER['HTTP_HOST'];?></strong>  reserves the right to terminate the account of any Member who infringes upon the copyright rights of others upon receipt of proper notification by the copyright owner or the copyright owner's legal agent. Included below are the processes and procedures that  <strong><?php echo $_SERVER['HTTP_HOST'];?></strong>  will follow to resolve any claims of intellectual property violations.

It’s against our policies/terms to post copyrighted material you don’t have the authorization to use. If anybody find any link on our site which violate our terms in any case than report us asap</p>
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