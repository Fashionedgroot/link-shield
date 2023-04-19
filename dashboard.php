<?php
session_start();
include 'config.php';
//week

$logged_user=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE user_id='".$_SESSION['user_id']."'"));

	$ttl_pay = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(amount) AS value_sum FROM transactions WHERE user_id='".$_SESSION['user_id']."' and status='paid'")); 
	$ttl_payout = $ttl_pay['value_sum'];
	
	if($ttl_payout==''){
		$ttl_payout=0;
	}
	
	$ttl_pen =  mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(amount) AS value_sum FROM transactions WHERE user_id='".$_SESSION['user_id']."' and status='pending'")); 
	$ttl_pending = $ttl_pen['value_sum'];
	
	if($ttl_pending==''){
		$ttl_pen=0;
	}
	
	$settings=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM settings WHERE id='1'"));
	
	$result  = mysqli_query($conn, "SELECT * FROM views where user_id='".$_SESSION['user_id']."'");
    $lifetime_view= mysqli_num_rows($result);
	
	$result  = mysqli_query($conn, "SELECT * FROM views where user_id='".$_SESSION['user_id']."' and date='" . date('Y/m/d', strtotime("-6 days")) . "'");
    $sixweek = mysqli_num_rows($result);
    
    $result   = mysqli_query($conn, "SELECT * FROM views where user_id='".$_SESSION['user_id']."' and date='" . date('Y/m/d', strtotime("-5 days")) . "'");
    $fiveweek = mysqli_num_rows($result);
    
    $result   = mysqli_query($conn, "SELECT * FROM views where user_id='".$_SESSION['user_id']."' and date='" . date('Y/m/d', strtotime("-4 days")) . "'");
    $fourweek = mysqli_num_rows($result);
    
    $result    = mysqli_query($conn, "SELECT * FROM views where user_id='".$_SESSION['user_id']."' and date='" . date('Y/m/d', strtotime("-3 days")) . "'");
    $threeweek = mysqli_num_rows($result);
    
    $result  = mysqli_query($conn, "SELECT * FROM views where user_id='".$_SESSION['user_id']."' and date='" . date('Y/m/d', strtotime("-2 days")) . "'");
    $twoweek = mysqli_num_rows($result);
    
    $result  = mysqli_query($conn, "SELECT * FROM views where user_id='".$_SESSION['user_id']."' and date='" . date('Y/m/d', strtotime("-1 days")) . "'");
    $oneweek = mysqli_num_rows($result);
    
    $result = mysqli_query($conn, "SELECT * FROM views where user_id='".$_SESSION['user_id']."' and date='" . date("Y/m/d") . "'");
    $week   = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Dashboard</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<!-- Morris Charts CSS -->
    <link href="vendors/morris.js/morris.css" rel="stylesheet" type="text/css" />
	
	
	
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
	<div class="hk-wrapper hk-alt-nav">

		<?php include 'header1.php';?>

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
			<!-- Container -->
            <div class="container mt-xl-50 mt-sm-30 mt-15">
                <!-- Title -->
                <!-- Row -->
                <div class="row">
                    <div class="col-xl-12">
						<!-- Page Alerts -->
						<!-- /Page Alerts -->
						
                        <div class="card hk-dash-type-1 overflow-hide">
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
							<div class="card-body">
								<div class="tab-content" id="nav-tabContent">
									<div class="tab-pane fade show active" id="nav-dash-1" role="tabpanel" aria-labelledby="dash-tab-1">
										<div id="e_chart_7" class="" style="height:294px;"></div>
									</div>
									
								<h6>Weekly Traffic</h6>
								</div>
							</div>
						</div>
						<div class="hk-row">
							<div class="col-md-4">
								<div class="card card-sm">
									<div class="card-body">
										<div class="d-flex align-items-center justify-content-between">
											<div>
												<span class="d-block font-12 font-weight-500 text-dark text-uppercase mb-5">Lifetime Views</span>
												<span class="d-block display-6 font-weight-400 text-dark"><?php echo number_format($lifetime_view);?></span>
											</div>
											<div>
											
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card card-sm">
									<div class="card-body">
										<div class="d-flex align-items-center justify-content-between">
											<div>
												<span class="d-block font-12 font-weight-500 text-dark text-uppercase mb-5">Today Views</span>
												<span class="d-block display-6 font-weight-400 text-dark"><?php echo number_format($week);?></span>
											</div>
											<div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
									<div class="card card-sm">
									<div class="card-body">
										<div class="d-flex align-items-center justify-content-between">
											<div>
												<span class="d-block font-12 font-weight-500 text-dark text-uppercase mb-5">Yesterday Views</span>
												<span class="d-block display-6 font-weight-400 text-dark"><?php echo number_format($oneweek);?></span>
											</div>
											<div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><div class="card">
							<div class="card-body pa-2">
								<div class="table-wrap">
										<table  id="datable_1"  class="table table-hover mb-0">
											<thead>
												<tr>
													<th></th>
													<th>Link</th>
													<th>View</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$s=0;
												$r=mysqli_query($conn,"SELECT *, COUNT(`link_id`) AS `value_occurrence` FROM `views` WHERE user_id='".$logged_user['user_id']."' GROUP BY `link_id` ORDER BY `value_occurrence` DESC LIMIT 25");
												while($rows=mysqli_fetch_assoc($r)){
													//$data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM links WHERE code='".$rows['code']."'"));
													$s++;
													echo '
													<tr>
													<td>TOP #'.$s.'</td>
													<td><span class="text-info">http://'.$_SERVER['HTTP_HOST'].'/get/'.$rows['link_id'].'</span></td>
													<td><span class="badge badge-warning">'.number_format($rows['value_occurrence']).'</span></td>
													</tr>
													';
												}
												?>
												</tbody>
										</table>
								</div>
							</div>
						</div>		
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

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- FeatherIcons JavaScript -->    <!-- Select2 JavaScript -->
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

    <script src="dist/js/feather.min.js"></script>

    <!-- Toggles JavaScript -->
    <script src="vendors/jquery-toggles/toggles.min.js"></script>
    <script src="dist/js/toggle-data.js"></script>
	
	<!-- Counter Animation JavaScript -->
	<script src="vendors/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="vendors/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- Easy pie chart JS -->
    <script src="vendors/easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
	
	<!-- Sparkline JavaScript -->
    <script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
	
	<!-- Morris Charts JavaScript -->
    <script src="vendors/raphael/raphael.min.js"></script>
    <script src="vendors/morris.js/morris.min.js"></script>
   
	<!-- EChartJS JavaScript -->
    <script src="vendors/echarts/dist/echarts-en.min.js"></script>
   
	<script>
	/*Dashboard Init*/
 
/*Dashboard Init*/
 
"use strict"; 
/*****E-Charts function start*****/
var echartsConfig = function() { 
	if( $('#e_chart_3').length > 0 ){
		var e_chart_3 = echarts.init(document.getElementById('e_chart_3'));
		var option3 = {
			tooltip: {
				show: true,
				trigger: 'axis',
				backgroundColor: '#fff',
				borderRadius:6,
				padding:6,
				axisPointer:{
					lineStyle:{
						width:0,
					}
				},
				textStyle: {
					color: '#324148',
					fontFamily: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"',
					fontSize: 12
				}	
			},
			xAxis: {
				type: 'category',
				boundaryGap: false,
				data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
				axisLine: {
					show:false
				},
				axisTick: {
					show:false
				},
				axisLabel: {
					textStyle: {
						color: '#5e7d8a'
					}
				}
			},
			yAxis: {
				type: 'value',
				axisLine: {
					show:false
				},
				axisTick: {
					show:false
				},
				axisLabel: {
					textStyle: {
						color: '#5e7d8a'
					}
				},
				splitLine: {
					lineStyle: {
						color: '#eaecec',
					}
				}
			},
			grid: {
				top: '3%',
				left: '3%',
				right: '3%',
				bottom: '3%',
				containLabel: true
			},
			series: [
				{
					data: [820, 932, 901, 934, 1290, 1330, 1320],
					type: 'line',
					symbolSize: 6,
					itemStyle: {
						color: '#00acf0',
					},
					lineStyle: {
						color: '#00acf0',
						width:2,
					},
					areaStyle: {
						color: '#00acf0',
					},
				}
			]
		};
		e_chart_3.setOption(option3);
		e_chart_3.resize();
	}
	if( $('#e_chart_6').length > 0 ){
		var e_chart_6 = echarts.init(document.getElementById('e_chart_6'));
		var option6 = {
			tooltip: {
				show: true,
				trigger: 'axis',
				backgroundColor: '#fff',
				borderRadius:6,
				padding:6,
				axisPointer:{
					lineStyle:{
						width:0,
					}
				},
				textStyle: {
					color: '#324148',
					fontFamily: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"',
					fontSize: 12
				}	
			},
			xAxis: {
				type: 'category',
				boundaryGap: false,
				data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
				axisLine: {
					show:false
				},
				axisTick: {
					show:false
				},
				axisLabel: {
					textStyle: {
						color: '#5e7d8a'
					}
				}
			},
			yAxis: {
				type: 'value',
				axisLine: {
					show:false
				},
				axisTick: {
					show:false
				},
				axisLabel: {
					textStyle: {
						color: '#5e7d8a'
					}
				},
				splitLine: {
					lineStyle: {
						color: '#eaecec',
					}
				}
			},
			grid: {
				top: '3%',
				left: '3%',
				right: '3%',
				bottom: '3%',
				containLabel: true
			},
			series: [
				{
					data:[120, 132, 101, 134, 90, 230, 210],
					type: 'line',
					stack: 'a',
					symbolSize: 6,
					itemStyle: {
						color: '#00acf0',
					},
					lineStyle: {
						color: '#00acf0',
						width:2,
					},
					areaStyle: {
						color: '#00acf0',
					},
				},
				{
					data: [220, 182, 191, 234, 290, 330, 310],
					type: 'line',
					stack: 'a',
					symbolSize: 6,
					itemStyle: {
						color: '#f83f37',
					},
					lineStyle: {
						color: '#f83f37',
						width:2,
					},
					areaStyle: {
						color: '#f83f37',
					},
				},
				{
					data: [150, 232, 201, 154, 190, 330, 410],
					type: 'line',
					stack: 'a',
					symbolSize: 6,
					itemStyle: {
						color: '#ffbf36',
					},
					lineStyle: {
						color: '#ffbf36',
						width:2,
					},
					areaStyle: {
						color: '#ffbf36',
					},
				}
			]
		};
		e_chart_6.setOption(option6);
		e_chart_6.resize();
	}
	if( $('#e_chart_7').length > 0 ){
		var e_chart_7 = echarts.init(document.getElementById('e_chart_7'));
		var option7 = {
			tooltip: {
				show: true,
				trigger: 'axis',
				backgroundColor: '#fff',
				borderRadius:6,
				padding:6,
				axisPointer:{
					lineStyle:{
						width:0,
					}
				},
				textStyle: {
					color: '#324148',
					fontFamily: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"',
					fontSize: 12
				}	
			},
			xAxis: {
				type: 'category',
				boundaryGap: false,
				data: ['', '', '', '', '', '', ''],
				axisLine: {
					show:false
				},
				axisTick: {
					show:false
				},
				axisLabel: {
					textStyle: {
						color: '#5e7d8a'
					}
				}
			},
			yAxis: {
				type: 'value',
				axisLine: {
					show:false
				},
				axisTick: {
					show:false
				},
				axisLabel: {
					textStyle: {
						color: '#5e7d8a'
					}
				},
				splitLine: {
					lineStyle: {
						color: '#eaecec',
					}
				}
			},
			grid: {
				top: '3%',
				left: '3%',
				right: '3%',
				bottom: '3%',
				containLabel: true
			},
			series: [
				{
					data: [<?php echo $week;?>, <?php echo $oneweek;?>, <?php echo $twoweek;?>, <?php echo $threeweek;?>, <?php echo $fourweek;?>,<?php echo $fiveweek;?>, <?php echo $sixweek;?>],
					type: 'line',
					symbolSize: 6,
					lineStyle: {
						color: '#00acf0',
						width:2,
					},
					itemStyle: {
						color: '#00acf0',
					},
					areaStyle: {
						normal: {
							color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
								offset: 0,
								color: '#00acf0'
							}, {
								offset: 1,
								color: '#22af47'
							}])
						}
					},
				}
			]
		};
		e_chart_7.setOption(option7);
		e_chart_7.resize();
	}
}
/*****Resize function start*****/
var echartResize;
$(window).on("resize", function () {
	/*E-Chart Resize*/
	clearTimeout(echartResize);
	echartResize = setTimeout(echartsConfig, 200);
}).resize(); 
/*****Resize function end*****/

/*****Function Call start*****/
echartsConfig();
/*****Function Call end*****/


	</script>
	<!-- Peity JavaScript -->
    <script src="vendors/peity/jquery.peity.min.js"></script>
   
    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
	<script src="dist/js/dashboard3-data.js"></script>
	
</body>

</html>