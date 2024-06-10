<?php include("config.php");
ob_start();
$employee_name='';
$punchinSrs = '';
$pagesetting = basename($_SERVER['PHP_SELF']); 
if(isset($_SESSION['id'])) {
$customerchechlogin_id=$_SESSION['id'];
} else {
$customerchechlogin_id="0";
header("Location:login.php");
ob_end_flush();	
	 }
$customerchechlogin_sql="select * from users WHERE id=$customerchechlogin_id";
$customerchechlogin_resu=mysqli_query($link,$customerchechlogin_sql);
$customerchechlogin_row=mysqli_fetch_array($customerchechlogin_resu);
if($customerchechlogin_row['account_type']=='1'){
	$cont_hr_id = $customerchechlogin_id;
}
else{
	$cont_hr_id = $customerchechlogin_row['parent_admin'];
}
if(isset($_REQUEST['search_attance'])){
	$employee_name = $_REQUEST['employes_name'];
	if(isset($_REQUEST['month'])){
		$currentyear =date("Y");
		$punchinSrs =$currentyear."-".$_REQUEST['month'];
	}
}
else if(isset($_REQUEST['reset'])){
		$employee_name='';
		$punchinSrs = '';
		
	}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<?php include("include/head.php");
		
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
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Attendance</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
					<form form action="attendance.php" name="Registerform" enctype="multipart/form-data" method="post">
					<div class="row filter-row">
						
						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" name="employes_name" class="form-control floating">
								<label class="focus-label">Employee Name</label>
							</div>
						</div>
						
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating" name="month"> 
									<option value="">-</option>
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
						<div class="col-sm-4 col-md-2">
							<button type="submit" name="search_attance" class="btn btn-success btn-block">Search</button>
							 
						</div>
						<div class="col-sm-4 col-md-2">
						<a href="attendance.php?date=reset" class="btn btn-white btn-block">RESET</a>
						</div>
                    </div>
					<!-- /Search Filter -->
					</form>
                    <div class="row">
                        <div class="col-lg-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table table-nowrap mb-0">
									<thead>
										<tr>
											<th>Employee</th>
											<?php
											$currentotaldays = date('t');
											for ($x = 01; $x <= $currentotaldays; $x++) {
  											echo "<th>".$x."</th>";
											}?>
											
										</tr>
									</thead>
									<tbody>
										
<?php
$backoffice_sql="select * from users where parent_admin='$cont_hr_id' and fullname LIKE '%$employee_name%'";
$backoffice_result=mysqli_query($link,$backoffice_sql);
while($backoffice_row=mysqli_fetch_array($backoffice_result)){
$acounttype= $backoffice_row['account_type'];
$sql_type="select * from counter WHERE id=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);
	$employeIDGet = $backoffice_row['id'];
  if($backoffice_row['account_type'] == '1'){}
  else{
?>
										
										<tr>
											<td>
												<h2 class="table-avatar">
													
													<a class="avatar avatar-xs">
													
														<?php if($backoffice_row['image']!='') { ?>
										<img src="uploads/<?php echo $backoffice_row['image'];?>" alt="">
                      <?php } else{ ?>
					  <img class="inline-block" src="assets\img\user.jpg" alt="user">
									<?php } ?>
														
													</a>
													<a><?php echo $backoffice_row['fullname'];?></a>
												</h2>
												
											</td>
											<?php
	   
											$currentotaldays = date('t');
	  										

											for ($x = 1; $x <= $currentotaldays; $x++) {
											
											?>
  											
											<td>
												<?php 
												$n = 1;
												$z = 1;
												$attancerecord_sql="select * from attanance where userid=$employeIDGet and punch_in LIKE '%$punchinSrs%'";
	  										$resultattancerecord=mysqli_query($link,$attancerecord_sql);
	  										while($listattance=mysqli_fetch_array($resultattancerecord)){
												$pucnDatinIDPost =$listattance['attance_id'];
	   										$record_punchin = strtotime($listattance['punch_in']);
											$punchin_data = date("j", $record_punchin);
												$subtotal='0';
															$ResultPunchCal=mysqli_query($link,$attancerecord_sql);
											while($ListPunchCal=mysqli_fetch_array($ResultPunchCal)){
												$punchinCal = $ListPunchCal['punch_in'];
												$timestamp45 = strtotime($punchinCal);
												$punchin_dataCal = date("j", $timestamp45);
												if($punchin_dataCal == $punchin_data && $ListPunchCal['punch_out'] > 0){
												$pucnDatin =$ListPunchCal['punch_in'];
												$punchDateOut = $ListPunchCal['punch_out'];
													$timestamp10 = strtotime($pucnDatin);
													$timestamp20 = strtotime($punchDateOut);
													$hourer = abs($timestamp10 - $timestamp20)/(60*60);
													$subtotal = ($subtotal + $hourer);
												}
												
											}	
												
											
												?>
												
												<?php 
												
												if($punchin_data == $x && $listattance['punch_out'] > 0){
												
													
													
													
												if($n == 1){
												
												?>
												
												<a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info<?php echo $pucnDatinIDPost;?>"><i class="fa fa-check text-success"></i></a>
												<?php if($subtotal < 4){
													?>
												<i class='fa fa-close text-danger'></i>
												<?php }?>
												<?php }  ?>
												<div class="modal custom-modal fade" id="attendance_info<?php echo $pucnDatinIDPost;?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Attendance Info</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-6">
										<div class="card punch-status">
											<div class="card-body">
												<h5 class="card-title">Timesheet <small class="text-muted">
													<?php 
													$record_punchin4 = strtotime($listattance['punch_in']);
													echo date("d M Y", $record_punchin4);?>
													</small></h5>
												
												<div class="punch-info">
													<div class="punch-hours">
														<span>
															<?php
													
												echo number_format($subtotal,2, ':', ',')." hrs";
															?>
															</span>
													</div>
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
																<h6>
																	<?php if($subtotal > 8){
																
																echo number_format($subtotal - 8,2, ':', ',');
															}
													else{echo "0";}
													?>
																	hrs</h6>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="card recent-activity">
											<div class="card-body">
												<h5 class="card-title">Activity</h5>
												<ul class="res-activity-list">
									<?php
										//$Sqlpunch="select * from attanance WHERE userid=$customerchechlogin_id order by attance_id DESC";
										$ResultPunchCal=mysqli_query($link,$attancerecord_sql);
											while($ListPunchCal=mysqli_fetch_array($ResultPunchCal)){
												$punchinCal = $ListPunchCal['punch_in'];
												$timestamp45 = strtotime($punchinCal);
												$punchin_dataCal = date("j", $timestamp45);
												if($punchin_dataCal == $punchin_data && $ListPunchCal['punch_out'] > 0){
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
							</div>
						</div>
					</div>
				</div>
												<?php $n++;} else {
													
													
													if($z == 1){
													
														
													if($punchin_data > $x){
														
														echo "<i class='fa fa-close text-danger'></i>";
													}
													
													
												}$z++;}
											}?>
											</td>
											
											<?php }?>
											
											
											
											
										</tr>
										
									<?php }} ?>	
										
										
										
										
										
										
										
									</tbody>
								</table>
							</div>
                        </div>
                    </div>
                </div>
				<!-- /Page Content -->
				
				<!-- Attendance Modal -->
				
				<!-- /Attendance Modal -->
				
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