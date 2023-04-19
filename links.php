<?php
	session_start();
	include 'config.php';
	$alert=NULL;
	
	if(!$_SESSION['user_id']){
	header('location:login.php');	
	}	
$ads=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM ads WHERE id='1'"));
	$logged_user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));

	$sort='desc';
	$column='id';
	$limit='10';
		
	if(isset($_GET['sort_re'])){
		$sort=$_GET['sort'];
		$column=$_GET['column'];
		$limit=$_GET['limit'];
	}
	
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
<html>
	<head>
		<title>All Links</title>
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
		<div class="card p-3">
			<h4><i class="fa fa-link"></i>&nbsp;Manage Links</h4>
			<hr>
			<div class="row">
				<div class="col-3">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#recordFilter">
  Record Filter
</button>
				</div>
			</div>
			<br>
			<div class="table-responsive">
                <table class="table">
                  <thead class="table_head">
                    <tr class="table_row">
                      <th class="table_cell table_cell--head">Name</th>
                      <th class="table_cell table_cell--head">Created</th>
                      <th class="table_cell table_cell--head">View</th>
                      <th class="table_cell table_cell--head">Status</th>
                      <th class="table_cell table_cell--head">Action</th>
                    </tr>
                  </thead>

                  <tbody>
				      <?php
							 $query   = "select * from links where user_id='" . $logged_user['user_id'] . "' and NOT status='removed' ORDER BY $column $sort LIMIT $limit";
								$results = mysqli_query($conn, $query);
								while($row=mysqli_fetch_assoc($results)) {
								if ($row['status'] == 'active') {
									$transtatus = 'success';
								} else {
									$transtatus = 'danger';
								}
								
							$views=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM views WHERE link_id='".$row['link_id']."'"));
								echo '
								 <td class="table_cell">'.$row['get_id'].'</td>
								 <td class="table_cell">'.date("d M Y",strtotime($row['date'])).'</td>
								 <td class="table_cell">'.$views.'</td>
								 <td class="table_cell"><span class="badge badge-' . $transtatus . '">' . strtoupper($row['status']) . '</span></td>
								 <td class="table_cell">
									<a class="btn btn-success" href="edit_link.php?id='.$row['get_id'].'"><i class="fa fa-pencil"></i></a>
									<a class="btn btn-warning" href="view/'.$row['link_id'].'"><i class="fa fa-eye"></i></a>
									<br>
									<br>
									<form action="" method="post">
										<input type="hidden" name="id" value="'.$row['id'].'"/>
										<button name="block" class="btn btn-dark"><i class="fa fa-lock"></i></button>
										<button name="unblock" class="btn btn-success"><i class="fa fa-unlock"></i></button>
										<button name="remove" class="btn btn-danger"><i class="fa fa-remove"></i></button>
									</form>
									
								 </td>
							  </tr>';
							}
						?>
                  </tbody>
                </table>
              </div>
		</div>
		<br>
		</form>
		<div class="modal fade" id="recordFilter">
  <div class="modal-dialog">
    <div class="modal-content">
<form action="" method="get">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Record Filter</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <label>Sort By</label>
		<select name="sort" class="form-control">
			<option value="asc">Ascending</option>
			<option value="desc">Dscending</option>
		</select>
		<br>
		<label>Sort Column</label>
		<select name="column" class="form-control">
			<option value="link_id">Link Name</option>
			<option value="date">Date</option>
		</select>
		<br>
		<label>Records</label>
		<select name="limit" class="form-control">
			<option value="10">10</option>
			<option value="25">25</option>
			<option value="50">50</option>
			<option value="100">100</option>
			<option value="250">250</option>
			<option value="500">500</option>
			<option value="1000">1000</option>
			<option value="2500">2500</option>
			<option value="5000">5000</option>
			<option value="10000">10000</option>
			<option value="9999999999999999">Show All Records</option>
		</select>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
       <input type="submit" name="sort_re" class="btn btn-success" value="SORT RECORD"/>
      </div>
</form>
    </div>
  </div>
</div>
		</div>
			<?php include 'footer.php';?>	
	</body>
</html>