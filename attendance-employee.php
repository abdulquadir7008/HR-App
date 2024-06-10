<?php include("config.php");
ob_start();
 $current_date = date("Y-m-d H:i:s");
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
if(isset($_REQUEST['searchbuttn'])){
	 if(isset($_REQUEST['searchdate'])){
		 $datforsearch = $_REQUEST['searchdate'];
		 if($datforsearch == '1970-01-01'){
		$searchdate='';
		
	}else{
		$leave_date_to3 = $_REQUEST['searchdate'];
		$leave_date_to = str_replace('/', '-', $leave_date_to3);
		$searchdate = date("Y-m-d", strtotime($leave_date_to));
			 $bwch = "date_from between '".$from_search."' AND '".$to_search."'";
	}
	if(isset($_REQUEST['searchmonth'])){
		$currentyear =date("Y");
		$searchdate2 =$currentyear."-".$_REQUEST['searchmonth'];
	}
		 
	 }
	
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<?php include("include/head.php");
	if(isset($_REQUEST['counterdel']))
	{
	$id_counterdel=$_REQUEST['counterdel'];
	$query="delete from counter WHERE id=$id_counterdel";
	mysqli_query($link,$query);
	}
	else if(isset($_REQUEST['counter']))
{
$name=$_POST['countr'];
		$primary_role=$_POST['primary_role'];
		
$counter_sql="insert into counter (countr,primary_role) values('$name','$primary_role')";
mysqli_query($link,$counter_sql);
}
		
		if(isset($_POST['punchin']) && isset($_SESSION['id'])){
			$counter_sql="insert into attanance (userid,punch_in) values('$customerchechlogin_id','$current_date')";
			mysqli_query($link,$counter_sql);
			session_write_close();
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			
		}
		
		$Sqlpunch="select * from attanance WHERE userid=$customerchechlogin_id order by attance_id DESC";
		$ResultPunch=mysqli_query($link,$Sqlpunch);
		$ListPunch=mysqli_fetch_array($ResultPunch);
		$punchin = $ListPunch['punch_in'];
		$att_id = $ListPunch['attance_id'];
		$att_idUser = $ListPunch['userid'];
		$timestamp = strtotime($punchin);
		$punchin_data = date("m-d-Y", $timestamp);
		$currentData = date("m-d-Y");
		
		if($ListPunch['punch_in'] > 0 && $punchin_data == $currentData && $ListPunch['punch_out'] == '0000-00-00 00:00:00'){
			$puchbtn = "Punch Out";
			$punchclick = "punchout";}
		else{
			$puchbtn = "Punch In";
			$punchclick = "punchin";
		}
			if(isset($_POST['punchout']) && isset($_SESSION['id'])){
			$query="update attanance SET punch_out='$current_date' WHERE attance_id=$att_id";
    		mysqli_query($link,$query);
			session_write_close();
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		
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
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Attendance</h3>
								<ul class="breadcrumb">
									<?php if($customerchechlogin_row['account_type'] == '1' || $primiaryRole == 'hr' && $customerchechlogin_row[ 'account_type' ] == $counterID){?>
				<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
		  <?php }else{ ?>
			   <li class="breadcrumb-item"><a href="emloyee-dashboard.php"> Dashboard</a></li>
			  <?php } ?>
									<li class="breadcrumb-item active">Attendance</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-4">
							<div class="card punch-status">
								<div class="card-body">
									<h5 class="card-title">Timesheet <small class="text-muted"><?php echo date("d M Y");?></small></h5>
									<?php if($ListPunch['punch_in'] > 0 && $punchin_data == $currentData && $ListPunch['punch_out'] == '0000-00-00 00:00:00'){?>
									<div class="punch-det">
										<h6>Punch In at</h6>
										<p><?php echo date("D M Y h:i a");?></p>
									</div>
									<?php } ?>
									
									<div class="punch-info">
										<div class="punch-hours">
											
											<span><?php echo number_format($totalhours,2, ':', ',');?> hrs</span>
										</div>
									</div>
									<div class="punch-btn-section">
										<form method="post" action="attendance-employee.php">
										<button type="submit" name="<?php echo $punchclick;?>" class="btn btn-primary punch-btn"><?php echo $puchbtn;?></button>
											</form>
									</div>
									<div class="statistics">
										<div class="row">
											<div class="col-md-6 col-6 text-center">
												
												<div class="stats-box">
													<p>Break</p>
													<h6>1 hrs</h6>
												</div>
											</div>
											
											<div class="col-md-6 col-6 text-center">
												<div class="stats-box">
													<p>Overtime</p>
													<h6><?php if($totalhours > 8){
																
																echo number_format($totalhours - 8,2, ':', ',');
															}
													else{echo "0";}
													?> hrs</h6>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card att-statistics">
								<div class="card-body">
									<h5 class="card-title">Statistics</h5>
									<div class="stats-list">
										<div class="stats-info">
											<p>Today <strong><?php echo number_format($totalhours,2, ':', ',');?> <small>/ 8 hrs</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-primary" role="progressbar" style="width: 
																											   <?php 
																											   if($totalhours < 1){echo "15%";}
																											   else if($totalhours < 2){echo "25%";}
																											   else if($totalhours < 3){echo "35%";}
																											   else if($totalhours < 4){echo "50%";}
																											   else if($totalhours < 5){echo "65%";}
																											   else if($totalhours < 6){echo "80%";}
																											   else if($totalhours < 8){echo "100%";}
																											  
																											   ?>
																											   " aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>This Week <strong>28 <small>/ 40 hrs</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>This Month <strong>90 <small>/ 160 hrs</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>Remaining <strong>90 <small>/ 160 hrs</small></strong></p>
											<div class="progress">
												<div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
										<div class="stats-info">
											<p>Overtime <strong>4</strong></p>
											<div class="progress">
												<div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card recent-activity">
								<div class="card-body">
									<h5 class="card-title">Today Activity</h5>
									<ul class="res-activity-list">
										
										<?php
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
													?>
										<?php if($pucnDatin > 0){?>
										<li>
											<p class="mb-0">Punch In at</p>
											<p class="res-activity-time">
												<i class="fa fa-clock-o"></i>
												<?php echo date("h:i a", $timestamp10);?>
											</p>
										</li>
										<?php }?>
										<?php if($punchDateOut > 0){?>
										<li>
											<p class="mb-0">Punch Out at</p>
											<p class="res-activity-time">
												<i class="fa fa-clock-o"></i>
												<?php echo date("h:i a", $timestamp20);?>
											</p>
										</li>
										<?php }?>
										<?php
												}
											}	
										?>
										
										
										
									</ul>
								</div>
							</div>
						</div>
					</div>
						<form form action="attendance-employee.php" name="Registerform" enctype="multipart/form-data" method="post">
					<!-- Search Filter -->
					<div class="row filter-row">
						
						<div class="col-sm-3">  
							<div class="form-group form-focus">
								<div class="cal-icon">
									<input type="text" name="searchdate" class="form-control floating datetimepicker">
								</div>
								<label class="focus-label">Date</label>
							</div>
						</div>
						<div class="col-sm-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating" name="searchmonth"> 
									<option>-</option>
									<option value="01">Jan</option>
									<option value="02">Feb</option>
									<option value="03">Mar</option>
									<option value="04">Apr</option>
									<option value="05">May</option>
									<option value="06">Jun</option>
									<option value="07">Jul</option>
									<option value="08">Aug</option>
									<option value="09">Sep</option>
									<option value="10">Oct</option>
									<option value="11">Nov</option>
									<option value="12">Dec</option>
								</select>
								<label class="focus-label">Select Month</label>
							</div>
						</div>
						
						<div class="col-sm-3"> 
							<button type="submit" name="searchbuttn" class="btn btn-success btn-block">Search</button>
							 
						</div>
						
						
                    </div>
							</form>
					<!-- /Search Filter -->
					
                    <div class="row">
                        <div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Date </th>
											<th>Punch In</th>
											<th>Punch Out</th>
											<th>Production</th>
											
										</tr>
									</thead>
									<tbody>
										<?php
										
										//$Sqlpunch2="select * from attanance where punch_in LIKE '%$searchdate%' OR punch_in LIKE '%$searchdate2%' order by attance_id DESC";
											$Sqlpunch2="select * from attanance where punch_in LIKE '%$searchdate%' or punch_in LIKE '%$searchdate2%' order by attance_id DESC";
										$ResultPunchCal=mysqli_query($link,$Sqlpunch2);
											while($ListPunchCal=mysqli_fetch_array($ResultPunchCal)){
												
												if($ListPunchCal['userid'] == $customerchechlogin_id){
												$punchinCal = $ListPunchCal['punch_in'];
												$timestamp45 = strtotime($punchinCal);
												$punchin_dataCal = date("m-d-Y", $timestamp45);
												
												$pucnDatin =$ListPunchCal['punch_in'];
												$punchDateOut = $ListPunchCal['punch_out'];
													$timestamp10 = strtotime($pucnDatin);
													$timestamp20 = strtotime($punchDateOut);
													$hour = abs($timestamp20 - $timestamp10)/(60*60);
													$totalhours = ($totalhours + $hour);
											?>	
											<tr>
											<td>1</td>
											<td><?php echo date("d M Y", $timestamp10);?></td>
											<td><?php echo date("h:i a", $timestamp10);?></td>
											<td><?php if($ListPunchCal['punch_out'] > 0){ echo date("h:i a", $timestamp20);}?></td>
											<td><?php if($ListPunchCal['punch_out'] > 0){echo number_format($hour,2, ':', ','); echo " hrs";}?> </td>
											
										</tr>
										<?php }} ?>
									</tbody>
								</table>
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
		<script src="assets\js\select2.min.js"></script>
		<script src="assets\js\moment.min.js"></script>
		<script src="assets\js\bootstrap-datetimepicker.min.js"></script>
		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
    </body>
</html>