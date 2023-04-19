<?php
	session_start();
	include 'config.php';
	
	$logged_user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));
	$myset=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id=1"));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Refer</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- select2 CSS -->
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterangepicker CSS -->
	<link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="vendors/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
<script src='dist/jquery-2.1.3.min.js'></script>
	<script src="dist/jquery.min.js"></script>
    <!-- Toggles CSS -->
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->
    
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-vertical-nav">

        <!-- Top Navbar -->
       <?php include 'header.php';?>
	   
        <!-- /Top Navbar -->

      <?php include 'sidebar.php';?>
        <!-- Setting Panel -->
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Settings</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Refer</li>
                </ol>
            </nav>
<div id="result"></div>
            <!-- Container -->
            <div class="container">
                <!-- Title -->
				
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon">
					<i data-feather="align-left"></i></span></span>Refer and Earn Extra</h4>
                </div>
                <!-- /Title -->
	<?php echo $alert;?>

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                     <section class="hk-sec-wrapper">
					<h4>Hy, <?php echo $logged_user['name'];?></h4>
				<p>Refer and Earn <?php echo $myset['symbol'];?><?php echo $myset['ref_user'];?></p>
				<br>
				<!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-url="http://<?php echo $_SERVER['HTTP_HOST'];?>/signup.php?ref=<?php echo $logged_user['user_id'];?>">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_whatsapp"></a>
<a class="a2a_button_google_gmail"></a>
<a class="a2a_button_copy_link"></a>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
<br>
				<p><i class="fa fa-money"></i>&nbsp;Your Refer Link</p>
				<input type="text" class="form-control" value="http://<?php echo $_SERVER['HTTP_HOST'];?>/signup.php?ref=<?php echo $logged_user['user_id'];?>" readonly>
				<br>
				<p><i class="fa fa-money"></i>&nbsp;Refer Code</p>
				<input type="text" class="form-control" value="<?php echo $logged_user['user_id'];?>" readonly>
				<hr>
				<h5>My Referrals</h5>
				<br>
					 <div class="table-wrap">
                             <table id="datable_1" class="table w-100 display pb-30">
                                            <thead>
                                                <tr>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">#</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Username</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">Wallet</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
								$results = mysqli_query($conn, "SELECT * FROM users WHERE ref='".$_SESSION['user_id']."' ORDER by user_id DESC");
								
								$s=0;
								while($data=mysqli_fetch_assoc($results)){
							$s++;
								echo '
								<tr>
								 <td class="table_cell">'.$s.'</td>
								 <td class="table_cell">@'.$data['username'].'</td>
								 <td class="table_cell">'.$currency.''.$data['wallet'].'</td>
								 <td class="table_cell">'.date("d M Y",strtotime($data['date'])).'</td>
							
							  </tr>';
							}
						?>
											</tbody>
											</table>
											</div>
					 </section>

                    </div>
                </div>
			
                <!-- /Row -->
            </div>
            <!-- /Container -->

            <!-- Footer -->
      
            <!-- /Footer -->

        </div>
        <!-- /Main Content -->
    </div>
   <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Jasny-bootstrap  JavaScript -->
    <script src="vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- Ion JavaScript -->
    <script src="vendors/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <script src="dist/js/rangeslider-data.js"></script>

    <!-- Select2 JavaScript -->
	  <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="dist/js/dataTables-data.js"></script>


    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="dist/js/select2-data.js"></script>

    <!-- Bootstrap Tagsinput JavaScript -->
    <script src="vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

    <!-- Daterangepicker JavaScript -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/daterangepicker/daterangepicker.js"></script>
    <script src="dist/js/daterangepicker-data.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="dist/js/feather.min.js"></script>

    <!-- Toggles JavaScript -->
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>

    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
</body>

</html>