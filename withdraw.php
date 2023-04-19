<?php
	session_start();
	include 'config.php';
	error_reporting(0);
	$mystatus=$_GET['s'];
	$logged_user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));

    $settings=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id='1'"));
	$limit_amount=$settings['payout_limit'];
	if(isset($_POST['re'])){
		if($_POST['amount']>$logged_user['wallet']){
			$alert='<div class="alert alert-danger">Choose Less Amount, You have Only $'.$logged_user['wallet'].'</div>';
		} else {
			if($_POST['amount']<$limit_amount){
				$alert='<div class="alert alert-danger">Minimun $'.$limit_amount.' is required</div>';
			} else {
				$amt=$_POST['amount'];
				$c=mysqli_query($conn,"INSERT INTO transactions (user_id,amount,date,status) VALUES ('".$logged_user['user_id']."','".$_POST['amount']."','".date("Y-m-d")."','pending')");
				if($c){
					mysqli_query($conn,"UPDATE users SET wallet = wallet - $amt WHERE user_id='".$logged_user['user_id']."'");
					$alert='<div class="alert alert-success"><i class="fa fa-check"></i>&nbsp;&nbsp;Amount $'.$amt.' is requsted</div>';
				} else {
					$alert='<div class="alert alert-danger">Somethis is wrong</div>';
				}
			}
		}
	}
	
	if (isset($_POST['cancal'])) {
    $transid    = $_POST['id'];
    $usersid    = $_SESSION['user_id'];
    $useramount = $_POST['amount'];
	
	$data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM transactions WHERE id='" . $transid . "'"));
	if($data['status']==='cancalled') {
		$alert='<div class="alert alert-danger">Transaction Alreay Cancallation</div>';
	} else {
    mysqli_query($conn, "UPDATE transactions SET status = 'cancalled' WHERE id ='" . $transid . "'");
    $ok=mysqli_query($conn, "UPDATE users SET wallet = wallet + $useramount WHERE user_id ='" . $usersid . "'");
	if($ok){
   $alert='<div class="alert alert-primary">Transaction Cancalled, '.$currency.''.$_POST['amount'].' is Returned to your wallet</div>';
	} else {
		$alert='<div class="alert alert-danger>Transaction Cancallation Failed</div>';
	}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Withdraw Requeste</title>

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
                    <li class="breadcrumb-item active" aria-current="page">WithDraw</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->
			                        
            <!-- Container -->
            <div class="container">

                <!-- Title -->
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title">
					<span class="pg-title-icon">
					<span class="feather-icon"><i data-feather="layers"></i></span></span>WithDraw Amount</h4>   
                </div>
                <!-- /Title -->
				<?php echo $alert;?>
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">  
					<section class="hk-sec-wrapper">
				<form action="" method="post">
				<div class="form-group">
				<label>Enter Amount</label>
				<input type="number" name="amount" class="form-control" placeholder="Enter Amount"/>
				</div>
				<div class="form-group">
					<input name="re" type="submit" class="btn btn-success" value="REQUEST"/>
				</div>
			</form>
		</form>
                        </section>
						<section class="hk-sec-wrapper">
					 <div class="table-wrap">
                             <table id="datable_1" class="table w-100 display pb-30">
                                            <thead>
                                                <tr>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">#</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Amount</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">Date</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Status</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
							 $query   = "select * from transactions where user_id='" . $logged_user['user_id'] . "' and status='".$mystatus."' ORDER BY ID desc";
								$results = mysqli_query($conn, $query);
								
								$s=0;
								while($row=mysqli_fetch_assoc($results)) {
									$s++;
								if ($row['status'] == 'paid') {
									$transtatus = 'success';
									$btn='';
								} else if ($row['status'] == 'pending') {
									$transtatus = 'warning';
									$btn='<input name="cancal" type="submit" class="btn btn-danger btn-rounded btn-xs" value="CANCAL">';
								} else {
									$transtatus = 'danger';
									$btn='';
								}
								
								echo '
								 <td class="table_cell">#'.$s.'</td>
								 <td class="table_cell">'.$currency.''.$row['amount'].'</td>
								 <td class="table_cell">'.date("d M Y",strtotime($row['date'])).'</td>
								 <td class="table_cell"><span class="badge badge-' . $transtatus . '">' . strtoupper($row['status']) . '</span></td>
								 <td class="table_cell">
								 <form action="" method="post">
								 <input name="id" type="hidden" value="'.$row['id'].'">
								 <input name="amount" type="hidden" value="'.$row['amount'].'">
								 '.$btn.'
								 </form>
								 </td>
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
	<script>
	function linkCopy() {
  /* Get the text field */
  var copyText = document.getElementById("links");

  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  //alert("Copied the text: " + copyText.value);
  document.getElementById("copy-alert").innerHTML="&nbsp;Link Copied";
}

function get_link(){
	document.getElementById("result").innerHTML="Generating...";
}
	</script>
    <!-- jQuery -->
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
    <script src="vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="dist/js/select2-data.js"></script>

    <!-- Bootstrap Tagsinput JavaScript -->
    <script src="vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

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