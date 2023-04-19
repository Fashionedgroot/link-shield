<?php
	session_start();
	include 'config.php';
	$p=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM pages WHERE id='".$_GET['id']."'"));
	$ads=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ads WHERE id='1'"));
?>
<html>
	<head>
		<title><?php echo $p['page_name'];?></title>
		<!-- meta tags-->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Make your link safe using Link Protector" />
		<meta name="keywords" content="link, short, protector" />
		<meta name="author" content="Rohit Chauhan" />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="assets/fonts/css/font-awesome.min.css">
		<link rel="icon" href="../favicon.png" sizes="16x16" type="image/png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/jquery-1.9.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
		<style>
			#text-url{width:80%;}
			#av-btn{margin-left:10%;}
			@media (max-width: 700px) { 
				#text-url{width:100%;}
				#av-btn{margin-left:0%;}
			}
		</style>
	</head>
	<body class="bg-light">
		<div class="container">
		<br>
		<br>
		<br>
		<center><a href="/"><img style="height:80px;" class="brand-img d-inline-block" src="dist/img/logo-light.png" alt="brand" /></a></center>
		<br>
				<div class="card p-4">
			<h5><i style="color:green;" class="fa fa-link"></i>&nbsp;<?php echo $p['page_name'];?></h5>
					<hr>
					<?php echo $p['page_data'];?>
					<br>
					<?php
	if($check_ip>=2){
		echo '';
	} else {
		echo '
			<form id="insertformD" action="ad_click.php" method="post">
			<input type="hidden" name="ip" value="'.$users_ip.'"/>
			<div id="sendD">
				<div id="resultD">'.$ads['ads2'].'</div>
			</div>
			</form>
		';
	}
?>
				</div>
		<br>
		</div>
		<br>
		<br>
		<br>
		<br>
		<br>
	</body>
	<script>
		$('#insertformD').submit(function(){
			return false;
		});
		$('#sendD').click(function(){
			$.post(		
				$('#insertformD').attr('action'),
				$('#insertformD :input').serializeArray(),
				function(result){
					$('#resultD').html(result);
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