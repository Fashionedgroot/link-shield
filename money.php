<?php
	session_start();
	include 'config.php';
	$alert=NULL;
	$settings=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id='1'"));
	$ads=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ads WHERE id='1'"));
?>
<html>
	<head>
		<title>Earn Money | <?php echo $settings['site_name'];?></title>
		<!-- meta tags-->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Make your link safe using <?php echo $settings['site_name'];?>" />
		<meta name="keywords" content="link, short, protector" />
		<meta name="author" content="Rohit Chauhan" />
		<meta property="og:title" content="Earn Momney | <?php echo $settings['site_name'];?>" />
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
			<h5><i style="color:green;" class="fa fa-file-text-o"></i>&nbsp;Pay Per View Program</h5>
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
<div class="money-wrapper">
<div class="money-content">
The <strong><?php echo $_SERVER['HTTP_HOST'];?></strong> rewards program offer to you the perfect opportunity to earn money by sharing your protected links with your friends and familly. There are no restrictions for any country and anyone can use our free service.
<br />
The program is open to anyone with an account so register a free account and you'll get paid dailly with no traffic shaving, and no hidden rules.
<br />When others view your files,
your account will start generating money automaticaly.
</p>
<ul>
<li>
Minimum payout amount - <?php echo $currency;?><?php echo $settings['payout_limit'];?>
 </li>
<li>
Downloads or Streams are counted only 1 within one ip address
</li>
<li>
There are no rewards for automated downloads
</li>
<li>
Payout requests are processed within 24 hours. Large amounts of abuse notices against
your files may result in suspension
</li>
</ul>
<p>
Attempts to gain revenue with misleading or other unethical methods will result in immediate suspension.
</p>
<p>
Affiliates must agree to abide our Terms and Conditions and the Copyright Policy. Failure to do may result in a temporary or permanent suspension of your account.
</p>
</div>
<div class="money-panel panel-default">
<div class="money-content">
<table class="table table-hover table-bordered">
<thead>
<tr>
<th>GROUP</th>
<th>COUNTRY</th>
</tr>
</thead>
<tbody>
<tr>
<td>A</td>
<td>United States, United Kingdom</td>
</tr>
<tr>
<td>B</td>
<td>Netherlands, Germany, France, Canada, Australia</td>
</tr>
<tr>
<td>C</td>
<td>Spain, Iran</td>
</tr>
<tr>
<td>D</td>
<td>Other</td>
</tr>
<tbody>
</table>
</div>
</div>
<div class="money-panel panel-default">
<div class="panel-heading">
Rules to follow
</div>
<div class="panel-body">
<ul>
<li>Unique IP is counted once per ip address, user must view the final page of the protected link.</li>
<li>Protected link must be have captcha enable to qualify for reward program.</li>
<li>You can protect unlimited urls. No limit at all.</li>
<li>Any kind of porn/nudity is not allowed.</li>
<li>You will be disqualified and banned if you try to manipulate our system.</li>
<li>Your protected links must meet our terms of service.</li>
<li> We reserve the right to modify the rewards program at any time without prior notice.</li>
<li>we pay for all countries traffic.</li>
<li>Minimum payout amount is <?php echo $currency;?><?php echo $settings['payout_limit'];?>.</li>
<li>Payments are made through Paypal or Other Networks</li>
<li>Payment done within 2 business days from payout request date. (It can take up to a week or 7 maximum days)</li>
</ul>
</div>
</div>
</div>
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