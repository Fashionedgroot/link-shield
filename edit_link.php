<?php
	session_start();
	include 'config.php';
	$alert=NULL;
	
	if(!$_SESSION['user_id']){
	header('location:login.php');	
	}	

	$link_id=$_GET['id'];
	
	$logged_user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));
	$links=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM links WHERE get_id='".$link_id."'"));
	
	if(!$logged_user['user_id']==$links['user_id']){
		 header('location:links.php');
	}
	
	if(isset($_POST['update'])){
		$links=mysqli_real_escape_string($conn,$_POST['links']);
		mysqli_query($conn,"UPDATE links SET urls='".$links."' WHERE get_id='".$link_id."'");
		 header('location:links.php');
	}
?>
<html>
	<head>
		<title>Edit Link</title>
		<!-- meta tags-->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Make your link safe using Link Protector" />
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
		<form action="" method="post">
		<?php echo $alert;?>
		<?php include 'menu.php';?>
		<div class="card p-3">
			<h4><i class="fa fa-pencil"></i>&nbsp;Edit Links</h4>
			<br>
				<form action="" method="post">
				<textarea name="links" class="form-control"><?php echo $links['urls'];?></textarea>
				<br>
				<input type="submit" name="update" class="btn btn-success" value="UPDATE LINKS"/>
				</form>
			<hr>
			
		</div>
		<br>
		</form>
		</div>
			<?php include 'footer.php';?>	
	</body>
</html>