<?php
	session_start();
	include 'config.php';
	$alert=NULL;
	$settings=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id='1'"));
	$ads=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ads WHERE id='1'"));
?>
<html>
	<head>
		<title>FAq | <?php echo $settings['site_name'];?></title>
		<!-- meta tags-->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Make your link safe using <?php echo $settings['site_name'];?>" />
		<meta name="keywords" content="link, short, protector" />
		<meta name="author" content="Rohit Chauhan" />
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
			<div id="accordion" class="page-content">
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
<div class="card card-default">
<a class="card-header" data-toggle="collapse" href="#faq1">What is Protactlink?</a>
<div class="card-body collapse in" id="faq1">
It is a free service that helps you protect your links from inconvenient people or automated robots with security such as captcha and password. we will convert your links to direct links that will act as autoforwarders to your original links. In addition, we optionally provide you with the ability to limited access to those direct links with a CAPTCHA or/and password. This protection will appear on a protected page. We also offer you the opportunity to shorten a long website address.
</div>
</div>
<br>
<div class="card card-default">
<a class="card-header" data-toggle="collapse" href="#faq2">How can I protect url?</a>
<div class="card-body collapse" id="faq2">
The easiest and most common way to protected links through our service is to
go to our main page (home page), input your links in the text area (box) and press the "Protect your links" button.
This will generate a results page where several outputs will be listed, such as generated protected links, direct links and remove links. go to 'Advanced Options' on (home page) to set your settings before submitting.
</div>
</div>
<br>
<div class="card card-default">
<a class="card-header" data-toggle="collapse" href="#faq3">How can I delete/remove protected link?</a>
<div class="card-body collapse" id="faq3">
You can delete protected link with unique removal id, that you get after protect url on site (result page). Also you can delete protected links from your account "Manage Links" section.
</div>
</div>
<br>
<div class="card card-default">
<a class="card-header" data-toggle="collapse" href="#faq4">What is the difference between a direct and a protected link?</a>
<div class="card-body collapse" id="faq4">
A direct link is a simple forwarder to the original link you have inputted (using a HTTP redirection). Those direct links do not have any protection system. They are fully compatible with any download managers.
A protected link will point to a security page where a CAPTCHA or a password form will get displayed and required to be completed in order to access direct/live links (original links) listing.
</div>
</div>
<br>
<div class="card card-default">
<a class="card-header" data-toggle="collapse" href="#faq5">What are the benefits of registering an account?</a>
<div class="card-body collapse" id="faq5">
A personal account will allow you to manage the protected links you create on our site. You will be able to edit, duplicate and delete them. See your complete protected links history. with a advance search feature. you can search your submitted links with protected url or original filename.
</div>
</div>
<br>
<div class="card card-default">
<a class="card-header" data-toggle="collapse" href="#faq6">How can I register an account?</a>
<div class="card-body collapse" id="faq6">
Just click on the 'Forgot Password' link at the top right of the screen. You will be prompted by a small dialog and all you need to do is enter correct email address and submit... check our mail on inbox to recover your username or password.
</div>
</div>
<br>
<div class="card card-default">
<a class="card-header" data-toggle="collapse" href="#faq7">How can I report improper links?</a>
<div class="card-body collapse" id="faq7">
If you are holder of an intellectual property right or you are an agent of such, and you feel that a protactlink.site violates this right, you may send us a DMCA report by using the 'Contact Us' button. we make sure to handle these reports the quickest possible. You also use contact us to report links pointing to dangerous materials (virus) - illegal pornography or anything used to cause harm to our users.
</div>
</div>
<br>
<div class="card card-default">
<a class="card-header" data-toggle="collapse" href="#faq8">I still have questions, what should I do?</a>
<div class="card-body collapse" id="faq8">
If you still have questions regarding our service please don't hesitate to contact us using <a href="/contact">our page</a>
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