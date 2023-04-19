<?php
session_start();
include 'config.php';
$settings=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id=1"));
?>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    	<title><?Php echo $settings['site_name'];?></title>
		<!-- meta tags-->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Make your link safe using Link Protector" />
		<meta name="keywords" content="link, short, protector" />
		<meta name="author" content="Rohit Chauhan" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
	<link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

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
				<form action="protected.php" method="post">
                <div class="row">
                    <div class="col-xl-10 pa-0">
					<div class="tab-content mt-50">
					<center>
						<div class="pt-2">
						<h3>Create, Share and Earn <i  class="fa fa-money text-primary"></i> via Protecting Link</h3>
						<p><i style="color:green;" class="fa fa-lock text-dark"></i> Protect Your Link In Just One-Click</p>
						<br>
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
						</div>
					</center>
										 
							<div class="tab-pane fade show active" role="tabpanel">
							
								<div class="container">
								
									<div class="hk-row">
									
										<div class="col-lg-8">
										
											<div class="card card-profile-feed">
                                                <div class="card-header card-header-action">
													<div class="media align-items-center">
														<div class="media-img-wrap d-flex mr-10">
																<i class="fa fa-link text-primary"></i>
														</div>
														<div class="media-body">
															<div class="text-capitalize font-weight-500 text-dark">Create Link</div>
														</div>
													</div>
													
												</div>
												<div class="card-body">
													
													<div class="card">
														<textarea name="urls" style="height:360px;" id="urls" type="url" class="form-control" required></textarea>
													</div>
												</div>
												
                                            </div>
											</div>
										<div class="col-lg-4">
											<div class="card card-profile-feed">
                                                <div class="card-header card-header-action">
													<div class="media align-items-center">
														<div class="media-img-wrap d-flex mr-10">
																<i class="fa fa-cogs text-primary"></i>
														</div>
														<div class="media-body">
															<div class="text-capitalize font-weight-500 text-dark">Advance Settings</div>
														</div>
													</div>
												</div>
												<ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
													 <div class="custom-control custom-checkbox">
														<input type="checkbox" name="captcha" class="custom-control-input" id="customCheck1" checked>
														<label class="custom-control-label" for="customCheck1"><i class="fa fa-refresh text-dark"></i>&nbsp;&nbsp;Enable Captcha</label>
													</div>
													</li>
													<li class="list-group-item">
													 <div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="customCheck2" onclick="title_div()">
														<label class="custom-control-label" for="customCheck2"><i class="fa fa-shield text-dark"></i>&nbsp;&nbsp;Title</label>
														<div id="title_div" class="pt-2">
														<input class="form-control" name="title" placeholder="Enter Title"/>
														</div>
													</div>
													</li>
													<li class="list-group-item">
													 <div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="customCheck3" onclick="pass_div()">
														<label class="custom-control-label" for="customCheck3"><i class="fa fa-lock text-dark"></i>&nbsp;&nbsp;Encrypt Link (Password)</label>
														<div id="pass_div" class="pt-2">
														<input class="form-control" name="password" placeholder="Enter Password"/>
														</div>
													</div>
													</li>
                                                    <li class="list-group-item">
													<button name="generate" class="btn btn-dark btn-wth-icon btn-block icon-wthot-bg btn-rounded icon-right">
													<span class="btn-text">Protect Now Link&nbsp;&nbsp;</span> 
													<span class="icon-label"><span class="feather-icon"><i data-feather="lock"></i></span> </span>
                                        </button>
													</li>
                                                   
												   </ul>
												 
											 </div>
										</div>
									</div>
								</div>
							</div>
						</div>	
					</div>
					  </form>
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
                <!-- /Row -->
            </div>
            <!-- /Container -->

            <!-- Footer -->
           <?php include 'home_footer.php';?>
            <!-- /Footer -->

        </div>
        <!-- /Main Content -->

    </div>

</script>
   <!-- /HK Wrapper -->
    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/h.js"></script>
    <script src="vendors/click.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

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