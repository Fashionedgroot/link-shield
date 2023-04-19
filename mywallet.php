<?php
	session_start();
	include 'config.php';
	$logged_user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));
	
	$ttl_pay = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(amount) AS value_sum FROM transactions WHERE user_id='".$_SESSION['user_id']."' and status='paid'")); 
	$ttl_payout = $ttl_pay['value_sum'];
	
	if($ttl_payout==''){
		$ttl_payout=0;
	}
	
	$ttl_pen =  mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(amount) AS value_sum FROM transactions WHERE user_id='".$_SESSION['user_id']."' and status='pending'")); 
	$ttl_pending = $ttl_pen['value_sum'];
	
	if($ttl_pending==''){
		$ttl_pending=0;
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>My Wallet</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
 <!-- select2 CSS -->
 <link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterangepicker CSS -->
    <link href="vendors/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
    <!-- Toggles CSS -->
    <script src='dist/jquery-2.1.3.min.js'></script>
	<script src="dist/jquery.min.js"></script>
    <!-- Toggles CSS -->
    <link href="vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
    <link href="vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
	<style>
		.pagination-c {
			padding-left:15px;
			padding-bottom:15px;
			box-sizing:border-box;
			
		}
	</style>
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

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Account</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Wallet</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->
			                        
            <!-- Container -->
            <div class="container">

                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title">
					<span class="pg-title-icon">
					<span class="feather-icon"><i data-feather="layers"></i></span></span>My Wallet</h4>   
                </div>
                <!-- /Title -->
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">  
					<section class="hk-sec-wrapper">
						<div class="card-header pa-0">
								<div class="nav nav-tabs nav-light nav-justified" id="dash-tab" role="tablist">
									<a class="d-flex align-items-center justify-content-center nav-item nav-link active" id="dash-tab-1" data-toggle="tab" href="#nav-dash-1" role="tab" aria-selected="true">
										<div class="d-flex">
											<div>
												<span class="d-block mb-5"><?php echo $currency;?><span class="display-4 counter-anim"><?php echo round($logged_user['wallet'],4);?></span></span>
												<span class="d-block"><i class="zmdi zmdi-money mr-10"></i>Wallet</span>
											</div>
										</div>
									</a>
									<a class="d-flex align-items-center justify-content-center nav-item nav-link active" id="dash-tab-2" data-toggle="tab" href="#nav-dash-2" role="tab" aria-selected="false">
										<div class="d-flex">
											<div>
												<span class="d-block mb-5"><?php echo $currency;?><span class="display-4 counter-anim"><?php echo $ttl_payout;?></span></span>
												<span class="d-block"><i class="zmdi zmdi-money mr-10"></i>Total Payouts</span>
											</div>
										</div>
									</a>
									<a class="d-flex align-items-center justify-content-center nav-item nav-link active" id="dash-tab-3" data-toggle="tab" href="#nav-dash-3" role="tab" aria-controls="nav-dash-3" aria-selected="false">
										<div class="d-flex">
											<div>
												<span class="d-block mb-5"><?php echo $currency;?><span class="display-4 counter-anim"><?php echo $ttl_pending;?></span></span>
												<span class="d-block"><i class="zmdi zmdi-money mr-10"></i>Pending Payment</span>
											</div>
										</div>
									</a>
								</div>
							</div>
							
                        </section>
						<section class="hk-sec-wrapper">
						
					 <div class="table-wrap">
                             <table id="datable_1" class="table w-100 display pb-30">
                                            <thead>
                                                <tr>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">#</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Earn Amount</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">Date</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">For</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
								$result = mysqli_query($conn, "SELECT * FROM earn_transactions WHERE user_id='".$_SESSION['user_id']."' ORDER BY id DESC");
								
								$s=0;
								while($data=mysqli_fetch_assoc($result)){
								$s++;
								echo '
								<tr>
								 <td class="table_cell">#'.$s.'</td>
								 <td class="table_cell"><span class="text-success">+'.$currency.''.$data['amount'].'</span></td>
								 <td class="table_cell">'.date("d M Y",strtotime($data['date'])).'</td>
								 <td class="table_cell"><span class="badge badge-success">'.$data['type'].'</span></td>
							
							  </tr>';
							}
						?>
											</tbody>
											</table>
											</div>
						</section>
						
						
            </div>
            <!-- /Container -->
           <?php include 'footer.php';?>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->
    </div>
    <!-- /HK Wrapper -->
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
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="dist/js/select2-data.js"></script>
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