<?php
	session_start();
	include 'config.php';
	$link_status=$_GET['s'];
	$links=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM links"));
	$logged_user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));	
	if(isset($_POST['block'])){
		mysqli_query($conn,"UPDATE links SET status='blocked' WHERE id='".$_POST['id']."'");
		$alert='<div class="alert alert-success"><i class="fa fa-lock"></i>&nbsp;&nbsp;Link Blocked</div>';
	}
	
	if(isset($_POST['unblock'])){
		mysqli_query($conn,"UPDATE links SET status='active' WHERE id='".$_POST['id']."'");
		$alert='<div class="alert alert-success"><i class="fa fa-unlock"></i>&nbsp;&nbsp;Link Actived</div>';
	}
	
	if(isset($_POST['remove'])){
		mysqli_query($conn,"UPDATE links SET status='removed' WHERE id='".$_POST['id']."'");
		$alert='<div class="alert alert-success"><i class="fa fa-remove"></i>&nbsp;&nbsp;Link Removed</div>';
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Edit Links</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- select2 CSS -->
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterangepicker CSS -->
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
                    <li class="breadcrumb-item active" aria-current="page">Links</li>
                </ol>
            </nav>
<div id="result"></div>
            <!-- Container -->
            <div class="container">
                <!-- Title -->
				
                <div class="hk-pg-header">
                    <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon">
					<i data-feather="align-left"></i></span></span>Links</h4>
                </div>
                <!-- /Title -->
	<?php echo $alert;?>

                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
                     <section class="hk-sec-wrapper">
					 <div class="table-wrap">
                             <table id="datable_1" class="table w-100 display pb-30">
                                            <thead>
                                                <tr>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">#</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Link</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">Created</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="4">Views</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5">Status</th>
													<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
							 $query   = "select * from links where user_id='" . $logged_user['user_id'] . "' and status='".$link_status."' ORDER BY id DESC";
								$results = mysqli_query($conn, $query);
								
								$s=0;
								while($row=mysqli_fetch_assoc($results)) {
								if ($row['status'] == 'active') {
									$transtatus = 'success';
								} else {
									$transtatus = 'danger';
								}
							$views=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM views WHERE link_id='".$row['link_id']."'"));
							$s++;
								echo '
								 <td class="table_cell">'.$s.'</td>
								 <td class="table_cell">http://'.$_SERVER['HTTP_HOST'].'/gets/'.$row['get_id'].'</td>
								 <td class="table_cell">'.date("d M Y",strtotime($row['date'])).'</td>
								 <td class="table_cell">'.number_format($views).'</td>
								 <td class="table_cell"><span class="badge badge-' . $transtatus . '">' . strtoupper($row['status']) . '</span></td>
								 <td class="table_cell">
									<form action="" method="post">
										<input type="hidden" name="id" value="'.$row['id'].'"/>
										
										<div class="btn-group">
                                            <button type="button" class="btn btn-light">Action</button>
                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                              <a class="dropdown-item" href="edit.php?id='.$row['link_id'].'"><i class="fa fa-pencil"></i> Edit</a>
                                                <a class="dropdown-item" href="views/'.$row['link_id'].'"><i class="fa fa-eye"></i> View Link</a>
										<button name="block" class="dropdown-item"><i class="fa fa-lock"></i> Block</button>
										<button name="unblock" class="dropdown-item"><i class="fa fa-unlock"></i> Active</button>
										<button name="remove" class="dropdown-item"><i class="fa fa-remove"></i> Remove</button>                                           
										   </div>
                                        </div>
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
                </div>
			
                <!-- /Row -->
            </div>
            <!-- /Container -->

            <!-- Footer -->
        <?php include 'footer.php';?>
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