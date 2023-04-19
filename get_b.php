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
		$display1='block';
	} else {
		$display='block';
		$display1='none';
	}
	$settings=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id='1'"));
	$ads=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ads WHERE id='1'"));
?>
<html>
	<head>
		<title><?php echo $settings['site_name'];?></title>
		<!-- meta tags-->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Make your link safe using Link Protector" />
		<meta name="keywords" content="link, short, protector" />
		<meta name="author" content="Rohit Chauhan" />
		<meta name="robots" content="nofollow, noindex" />
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="../assets/fonts/css/font-awesome.min.css">
		<link rel="icon" href="../favicon.png" sizes="16x16" type="image/png">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="../assets/js/popper.min.js"></script>
		<script src="../assets/js/jquery-1.9.1.min.js"></script>
		<script src="../assets/js/bootstrap.min.js"></script>
		<script src="../assets/js/bootstrap.bundle.min.js"></script>
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
		<?php include 'header.php';?>
		<div class="container">
		<br>
		<div class="card p-4">
		<?php
	if($check_ip>=2){
		echo '';
	} else {
		echo '
			<form id="insertformGet1" action="ad_click.php" method="post">
			<input type="hidden" name="ip" value="'.$users_ip.'"/>
			<div id="sendGet1">
				<div id="resultGet1">'.$ads['ads4'].'</h4>
			</div>
			</form>
		';
	}
?>
		<center><h3><span id="timer">Wait <span id="progressBar">10</span> Sec</span></h3></center>
		<center>
		<span style="color:red;" class="msg-error error"></span>
		<br>
		<div style="display:<?php echo $display1;?>;">
		<div id="recaptcha" class="g-recaptcha" data-sitekey="<?php echo $settings['re_key'];?>"></div>
		<br>
		<button id="verify" class="btn btn-primary">Verify Captcha</button>
		</div>
		<br>
		
		<br>
			<a style="text-decoration:none;" href="../view/<?php echo $links['link_id'];?>">
			<button style="display:<?php echo $display;?>;" name="get" id="get_btn" style="width:200px;" class="btn btn-primary" disabled><i class="fa fa-link"></i>&nbsp;&nbsp;GET LINK
			</button>
			</a>
			</center>
			<?php
	if($check_ip>=2){
		echo '';
	} else {
		echo '
			<form id="insertformGet2" action="ad_click.php" method="post">
			<input type="hidden" name="ip" value="'.$users_ip.'"/>
			<div id="sendGet2">
				<div id="resultGet2">'.$ads['ads5'].'</h4>
			</div>
			</form>
		';
	}
?>
		<br>		
		<hr>
		<p>We provides one of the finest Link Protecting services in the world. Our Team Experts have created our very own Link Sharing Algorithm (implemented carefully) to maintain your Links at Max Speed with the alternative of consuming much more and inappropriate Resources. We at JioLink always care for our users and protect their information and all the services are ascendable referred to your benefit like you can easily add more links and edit without putting a notable impact on yours mind.</p>
		</div>
		<br>
		</div>
			<?php include 'footer.php';?>	
	</body>
	<script>
//document.getElementById('get_btn').style.display = "block";

	$( '#verify' ).click(function(){
  var $captcha = $( '#recaptcha' ),
      response = grecaptcha.getResponse();
  
  if (response.length === 0) {
    $( '.msg-error').text( "Invalid Captcha, Please Try Again" );
    if( !$captcha.hasClass( "error" ) ){
      $captcha.addClass( "error" );
    }
  } else {
    $( '.msg-error' ).text('');
    $captcha.removeClass( "error" );
	 document.getElementById('verify').style.display = "none";
	 document.getElementById('recaptcha').style.display = "none";
    document.getElementById('get_btn').style.display = "block";
  }
})

	window.onload = function() {
		window.setTimeout(setDisabled, 8000);
	}
	function setDisabled() {
		document.getElementById('get_btn').disabled = false;
	}
	var timeleft = 10;
	var downloadTimer = setInterval(function(){
	 var tm= document.getElementById("progressBar").innerHTML = 20 - ++timeleft;
	  if(tm <= 0)
		 document.getElementById("timer").innerHTML = "GET YOUR LINKS NOW";
	},1000);
	</script>
	
	<script>
		$('#insertformGet1').submit(function(){
			return false;
		});
		$('#sendGet1').click(function(){
			$.post(		
				$('#insertformGet1').attr('action'),
				$('#insertformGet1 :input').serializeArray(),
				function(result){
					$('#resultGet1').html(result);
				}
			);
		});
		$('#insertformGet2').submit(function(){
			return false;
		});
		$('#sendGet2').click(function(){
			$.post(		
				$('#insertformGet2').attr('action'),
				$('#insertformGet2:input').serializeArray(),
				function(result){
					$('#resultGet2').html(result);
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