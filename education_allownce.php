<?php include("config.php");
ob_start();
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
$userID = $customerchechlogin_row['id'];



if(isset($_REQUEST['submitalownce']))
{
$year=$_REQUEST['year'];
$depant_name=$_REQUEST['depant_name'];
$annual_balance=$_REQUEST['annual_balance'];
$balance_utilise=$_REQUEST['balance_utilise'];
$remaining_balance=$_REQUEST['remaining_balance'];
$querybord="insert into education_allownce(year,depant_name,annual_balance,balance_utilise,remaining_balance,profile_id,status) 
values('$year','$depant_name','$annual_balance','$balance_utilise','$remaining_balance','$userID','0')";
mysqli_query($link,$querybord);

$errmsg_arr[] = "<div class='col-md-12'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> Education Allownce Add Successfully.</span></div></div>";
$errflag = true;
$_SESSION['education_error'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);
ob_end_flush();	
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<?php include("include/head.php");
	$employe_id = '33';
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
			
				<!-- Page Content -->
                <div class="content container-fluid">
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Education Allownce</h3>
								<ul class="breadcrumb">
									<?php if($customerchechlogin_row['account_type'] == '1' || $primiaryRole == 'hr' && $customerchechlogin_row[ 'account_type' ] == $counterID){?>
				<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
		  <?php }else{ ?>
			   <li class="breadcrumb-item"><a href="emloyee-dashboard.php"> Dashboard</a></li>
			  <?php } ?>
									<li class="breadcrumb-item active">Education</li>
								</ul>
							</div>
							
						</div>
					</div>
					<!-- /Page Header -->
					
					
					
					
									
					<div class="row">
						<div class="col-xl-6 d-flex">
							
							<div class="card flex-fill">
								<div class="card-header">
									<h4 class="card-title mb-0">Add Education Allownce </h4>
								</div>
								<div class="card-body">
									<?php
if( isset($_SESSION['education_error']) && is_array($_SESSION['education_error']) && count($_SESSION['education_error']) >0 ) {
foreach($_SESSION['education_error'] as $msg) {
echo $msg;  
}
unset($_SESSION['education_error']); }?>
									<form form action="education_allownce.php" name="Registerform" enctype="multipart/form-data" method="post">
									
							<div class="form-group">
										<label>year <span class="text-danger">*</span></label>
											<input class="form-control" name="year" type="text" required>
									</div>
										<div class="form-group">
										<label>Dependant Name <span class="text-danger">*</span></label>
											<input class="form-control" name="depant_name" type="text" required>
										</div>
									<div class="form-group">
										<label>Annual Balance <span class="text-danger">*</span></label>
											<input class="form-control" name="annual_balance" type="text" required>
										</div>
									<div class="form-group">
										<label>Balance Utilize </label>
											<input class="form-control" name="balance_utilise" type="text" required>
										</div>
									<div class="form-group">
										<label>Remaining Balance</label>
											<input class="form-control" name="remaining_balance" type="text">
										</div>
									
									
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" type="submit" name="submitalownce">Submit</button>
									</div>
								</form>
								</div>
							</div>
						</div>
						<div class="col-xl-6 d-flex">
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
													<th>Aproval</th>
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
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Leave Modal -->
				
				<!-- /Add Leave Modal -->
				
				<!-- Edit Leave Modal -->
				
				<!-- /Edit Leave Modal -->

				<!-- Approve Leave Modal -->
				
				<!-- /Approve Leave Modal -->
				
				<!-- Delete Leave Modal -->
				
				<!-- /Delete Leave Modal -->
				
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
		
		<!-- Select2 JS -->
		<script src="assets\js\select2.min.js"></script>
		
		<!-- Datatable JS -->
		<script src="assets\js\jquery.dataTables.min.js"></script>
		<script src="assets\js\dataTables.bootstrap4.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets\js\moment.min.js"></script>
		<script src="assets\js\bootstrap-datetimepicker.min.js"></script>

		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
    </body>
</html>