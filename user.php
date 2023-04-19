<?php
	session_start();
	include 'config.php';
	$alert=NULL;
	
	if(!$_SESSION['user_id']){
	header('location:login.php');	
	}	
	$ads=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ads WHERE id='1'"));
	$logged_user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));

	if(isset($_POST['profile'])){
	$username=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE username='".$_POST['username']."' AND NOT username='".$logged_user['username']."'"));
	$email=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users WHERE email='".$_POST['email']."' AND NOT email='".$logged_user['email']."'"));
	if($username==1){
		$alert='<div class="alert alert-danger">@'.$_POST['username'].' already used!</div>';
	}else if($email==1){
		$alert='<div class="alert alert-danger">Already used '.$_POST['email'].'!</div>';
	} else {
		$check=mysqli_query($conn,"UPDATE users SET name='".$_POST['name']."', username='".$_POST['username']."', email='".$_POST['email']."', pay_method='".$_POST['pay_method']."', details='".$_POST['details']."' WHERE user_id='".$_SESSION['user_id']."'");
		if($check){
			$alert='<div class="alert alert-success">Account Updated!<meta http-equiv="refresh" content="1" /></div>';
		} else {
			$alert='<div class="alert alert-danger">Account Updation Failed!</div>';
		}
	}
}
?>
<html>
	<head>
		<title>Account Settings</title>
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
		<?php echo $alert;?>
		<div class="card p-3">
			<h4><i class="fa fa-user-o"></i>&nbsp;Account Settings</h4>
			<hr>
			
		<form action="" method="post">
			 <fieldset>
			    	  	<div class="form-group">
							<label><i class="fa fa-user"></i>&nbsp;Account Name</label>
			    		    <input class="form-control" placeholder="Name" name="name" type="text" value="<?php echo $logged_user['name'];?>" required>
			    		</div>
						<div class="form-group">
							<label><i class="fa fa-user"></i>&nbsp;Account Username</label>
			    		    <input class="form-control" placeholder="Username" name="username" type="text" value="<?php echo $logged_user['username'];?>" required>
			    		</div>
						<div class="form-group">
							<label><i class="fa fa-envelope"></i>&nbsp;Account Email</label>
			    		    <input class="form-control" placeholder="Email" name="email" type="text" value="<?php echo $logged_user['email'];?>" required>
			    		</div>
						<br>
						<hr>
						<h3><i class="fa fa-money"></i>&nbsp;Payment Settings</h3>
						<br>
						<div class="form-group">
							<label><i class="fa fa-credit-card"></i>&nbsp;Payment Resource</label>
			    		    <select name="pay_method" class="form-control">
					<?php 
							 $query   = "select * from pay_methods";
								$results = mysqli_query($conn, $query);
								while($row=mysqli_fetch_assoc($results)) {
							?>
					<option value="<?php echo $row['name'];?>" <?php if($logged_user['pay_method']==$row['name']){echo 'selected';}?>><?php echo $row['name'];?></option>
						<?php
								}
						?>
					</select>
					</div>
					<div class="form-group">
							<label><i class="fa fa-file-o"></i>&nbsp;Payment Details</label>
			    		    <input type="text" name="details" class="form-control" value="<?php echo $logged_user['details'];?>" placeholder="Payment Details"/>
					</div>
					<div class="form-group">
								<input type="submit" name="profile" class="btn btn-success" value="UPDATE"/></div>
			    	</fieldset>
					
		</form>
		</div>
		<br>
		</div>
			<?php include 'footer.php';?>	
	</body>
</html>