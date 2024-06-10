<?php include("config.php");
ob_start();
$pagesetting = basename($_SERVER['PHP_SELF']); 
if(isset($_SESSION['id'])) {
$customerchechlogin_id=$_SESSION['id'];
} else {
$customerchechlogin_id="0";
header("Location:user-login.php");
ob_end_flush();	
	 }
$customerchechlogin_sql="select * from users WHERE id=$customerchechlogin_id";
$customerchechlogin_resu=mysqli_query($link,$customerchechlogin_sql);
$customerchechlogin_row=mysqli_fetch_array($customerchechlogin_resu);
$userID = $customerchechlogin_row['id'];
$personalsql="select * from personal_info WHERE profile_id=$userID";
$resultpersonal=mysqli_query($link,$personalsql);
$listprosonal=mysqli_fetch_array($resultpersonal);

$education_sql="select * from education_details WHERE profile_id=$userID";
$resulteducation=mysqli_query($link,$education_sql);
$listeducation=mysqli_fetch_array($resulteducation);

?>


<!DOCTYPE html>
<html>
    <head>
<?php include("include/head.php");?>
    </head>
	
    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <?php include("include/header.php");?>
			<!-- /Header -->
			
			<!-- Sidebar -->
            <?php include("include/sidebar.php");?>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
				<!-- Page Content -->
                <div class="content container-fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="welcome-box">
								<div class="welcome-img">
									<?php if($customerchechlogin_row['image']!='') { ?>
                      <img src="uploads/<?php echo $customerchechlogin_row['image'];?>" />
                      <?php } else{ ?>
					  <img src="assets\img\user.jpg" alt="user">
									<?php } ?>
								</div>
								<div class="welcome-det">
									<h3>Welcome, <?php echo ucwords($customerchechlogin_row['fullname']);?></h3>
									<p><?php echo date("D, M Y");?></p>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-8 col-md-8">
							<section class="dash-section">
								<h1 class="dash-sec-title">Today</h1>
								<div class="dash-sec-content">
									<div class="card">
										<div class="card-body">
											<h3 class="card-title">My Salary Details</h3>
											<div id="bar-charts"></div>
										</div>
									</div>
<div class="dash-info-list">
										<a href="#" class="dash-card">
											<div class="dash-card-container">
												<div class="dash-card-icon">
													<i class="fa fa-suitcase"></i>
												</div>
												<div class="dash-card-content">
													<p>Document Details</p>
												</div>
												<div class="dash-card-avatars">
													<div class="e-avatar">
														<?php if($customerchechlogin_row['image']!='') { ?>
                      <img src="uploads/<?php echo $customerchechlogin_row['image'];?>" />
                      <?php } else{ ?>
					  <img src="assets\img\user.jpg" alt="user">
									<?php } ?>
													</div>
												</div>
												
											</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped mb-0">
											<thead>
												<tr>
													<th>Document Type</th>
													<th>Number</th>
													
													<th>Expiry Date</th>
												</tr>
											</thead>
											<tbody>
												
												<tr>
													<td>Passport</td>
													<td><?php echo $listprosonal['passportno'];?></td>
													<td><?php echo $listprosonal['expire_date'];?></td>
												</tr>
												
												
											</tbody>
										</table>
									</div>
								</div>
											
											
										</a>
									</div>
									<div class="dash-info-list">
										<a href="#" class="dash-card">
											<div class="dash-card-container">
												<div class="dash-card-icon">
													<i class="fa fa-graduation-cap"></i>
												</div>
												<div class="dash-card-content">
													<p>Education Allowance Details</p>
												</div>
												<div class="dash-card-avatars">
													<div class="e-avatar">
														<?php if($customerchechlogin_row['image']!='') { ?>
                      <img src="uploads/<?php echo $customerchechlogin_row['image'];?>" />
                      <?php } else{ ?>
					  <img src="assets\img\user.jpg" alt="user">
									<?php } ?>
													</div>
												</div>
												
											</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table table-striped mb-0">
											<thead>
												<tr>
													<th>Year</th>
													<th>Dependant Name</th>
													<th>Annual Balance</th>
													<th>Balance Utilize</th>
													<th>Remaining Balance</th>
												</tr>
											</thead>
											<tbody>
												
												<?php
									$education_allownce_sql="select * from education_allownce WHERE profile_id=$userID";
$education_allownce_resu=mysqli_query($link,$education_allownce_sql);
while($education_allownce_row=mysqli_fetch_array($education_allownce_resu)){
												?>
												<tr>
													<td><?php echo $education_allownce_row['year'];?></td>
													<td><?php echo $education_allownce_row['depant_name'];?></td>
													<td><?php echo $education_allownce_row['annual_balance'];?></td>
													<td><?php echo $education_allownce_row['balance_utilise'];?></td>
													<td><?php echo $education_allownce_row['remaining_balance'];?></td>
													<td><?php echo $education_allownce_row['remaining_balance'];?></td>
												</tr>
												<?php } ?>
												
												
											</tbody>
										</table>
									</div>
								</div>
											
											
										</a>
									</div>
									
									

									

								</div>
							</section>

							

							
						</div>

						<div class="col-lg-4 col-md-4">
							<div class="dash-sidebar">
								<section>
									<h5 class="dash-title">Projects</h5>
									<div class="card">
										<div class="card-body">
											<div class="time-list">
												<div class="dash-stats-list">
													<h4>71</h4>
													<p>Total Tasks</p>
												</div>
												<div class="dash-stats-list">
													<h4>14</h4>
													<p>Pending Tasks</p>
												</div>
											</div>
											<div class="request-btn">
												<div class="dash-stats-list">
													<h4>2</h4>
													<p>Total Projects</p>
												</div>
											</div>
										</div>
									</div>
								</section>
								<section>
									<h5 class="dash-title">Your Leave</h5>
									<div class="card">
										<div class="card-body">
											<div class="time-list">
												<div class="dash-stats-list">
													<?php
													$anual_leave = '28';
	$leave_tbl_sql="select * from leave_tbl LEFT JOIN users ON leave_tbl.user_employee=users.id WHERE user_employee='$userID' AND  lb_status='1'";
		$leave_tbl_result=mysqli_query($link,$leave_tbl_sql);
			while($leave_tbl_row = mysqli_fetch_array($leave_tbl_result)){
				$acounttype= $leave_tbl_row['account_type'];


				$leave_date_from = str_replace('/', '-', $leave_tbl_row['date_from']);
				$leave_date_to = str_replace('/', '-', $leave_tbl_row['date_to']);
				$date70 = date_create($leave_date_from);
				$date80 = date_create($leave_date_to);
				$diff = date_diff($date70,$date80);
				$totaleave = ($totaleave + $diff->format("%a"));
			}
		?>
								<h4><?php if($totaleave){echo $totaleave;}else{echo "0";} ;?></h4>
													<p>Leave Taken</p>
												</div>
												<div class="dash-stats-list">
													<h4><?php if($totaleave){echo ($anual_leave - $totaleave);}else{echo "0";} ;?></h4>
													<p>Remaining</p>
												</div>
											</div>
											<div class="request-btn">
												<a class="btn btn-primary" href="add_leave.php">Apply Leave</a>
											</div>
										</div>
									</div>
								</section>
								<section>
									<h5 class="dash-title">Your time off allowance</h5>
									<div class="card">
										<div class="card-body">
											<div class="time-list">
												<div class="dash-stats-list">
													<?php
													$currentData = date("m-d-Y");
													$Sqlpunch="select * from attanance WHERE userid=$customerchechlogin_id order by attance_id DESC";
													$ResultPunchCal=mysqli_query($link,$Sqlpunch);
											while($ListPunchCal=mysqli_fetch_array($ResultPunchCal)){
												$punchinCal = $ListPunchCal['punch_in'];
												$timestamp45 = strtotime($punchinCal);
												$punchin_dataCal = date("m-d-Y", $timestamp45);
												if($punchin_dataCal == $currentData && $ListPunchCal['punch_out'] > 0){
												$pucnDatin =$ListPunchCal['punch_in'];
												$punchDateOut = $ListPunchCal['punch_out'];
													$timestamp10 = strtotime($pucnDatin);
													$timestamp20 = strtotime($punchDateOut);
													$hour = abs($timestamp20 - $timestamp10)/(60*60);
													$totalhours = ($totalhours + $hour);
												}
											}
													?>
													<h4><?php echo number_format($totalhours,2, ':', ',');?>  Hours</h4>
													<p>Approved</p>
												</div>
												<div class="dash-stats-list">
													<h4><?php 
														$totalduetiy = 9 - $totalhours;
														echo number_format($totalduetiy,2, ':', ',');?> Hours</h4>
													<p>Remaining</p>
												</div>
											</div>
											<div class="request-btn">
												<a class="btn btn-primary" href="#">Go to Attendance</a>
											</div>
										</div>
									</div>
								</section>
								<section>
									<h5 class="dash-title">Upcoming Holiday</h5>
									<div class="card">
										<div class="card-body text-center">
											<h4 class="holiday-title mb-0">
												
											<?php
		$holiday_sql="select * from holiday order by holiday_date DESC";
			$holiday_result=mysqli_query($link,$holiday_sql);
				while($list_holiday=mysqli_fetch_array($holiday_result)){
					$myOriginalDate = str_replace('/', '-', $list_holiday['holiday_date']);
					$curdate_holiday = strtotime(date("d-m-Y"));
					$holiday = strtotime($myOriginalDate);
					if($curdate_holiday < $holiday){ echo date("d M Y",$holiday)." - ".$list_holiday['holiday_name']; } } ?>
											</h4>
										</div>
									</div>
								</section>
							</div>
						</div>
					</div>

				</div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets\js\jquery-3.5.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="assets\js\popper.min.js"></script>
        <script src="assets\js\bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets\js\jquery.slimscroll.min.js"></script>
		
		<!-- Chart JS -->
		<script src="assets\plugins\morris\morris.min.js"></script>
		<script src="assets\plugins\raphael\raphael.min.js"></script>
		<script src="assets\js\chart.js"></script>
		
		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
    </body>
</html>