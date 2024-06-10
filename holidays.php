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
if($customerchechlogin_row['account_type']=='1'){
	$cont_hr_id = $customerchechlogin_id;
}
else{
	$cont_hr_id = $customerchechlogin_row['parent_admin'];
}
$kt = '1';

$sql_module_hr_permission = "select * from hr_fun_permission";
$result_hr_permission = mysqli_query( $link, $sql_module_hr_permission );
$list_hr_permission = mysqli_fetch_array( $result_hr_permission );
?>
<!DOCTYPE html>
<html lang="en">
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
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Holidays 2021</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Holidays</li>
								</ul>
							</div>
							<?php if($list_hr_permission['holiday_wr']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Add Holiday</a>
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table mb-0">
									<thead>
										<tr>
											<th>#</th>
											<th>Title </th>
											<th>Holiday Date</th>
											<th>Day</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
	<?php
		$holiday_sql="select * from holiday where admin_id='$cont_hr_id' order by holiday_date DESC";
			$holiday_result=mysqli_query($link,$holiday_sql);
				while($list_holiday=mysqli_fetch_array($holiday_result)){
					$myOriginalDate = str_replace('/', '-', $list_holiday['holiday_date']);
					$curdate_holiday = strtotime(date("d-m-Y"));
					$holiday = strtotime($myOriginalDate);
					
				
				?>
										<tr class="<?php if($curdate_holiday > $holiday){?>holiday-completed<?php } else{ ?>holiday-upcoming<?php } ?>">
											<td>3</td>
											<td><?php echo $list_holiday['holiday_name'];?></td>
											<td><?php echo date("d M Y",$holiday);?>
											</td>
											<td><?php echo date("l", strtotime($myOriginalDate));?></td>
											<?php if($curdate_holiday > $holiday){?>
												<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
													<?php if($list_hr_permission['holiday_del']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_holiday<?php echo $list_holiday['holiday_id'];?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
														<?php } ?>
													</div>
												</div>
											</td> 
											<?php } else{ ?> 
												<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_holiday<?php echo $list_holiday['holiday_id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_holiday<?php echo $list_holiday['holiday_id'];?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>  
												

				<div class="modal custom-modal fade" id="edit_holiday<?php echo $list_holiday['holiday_id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Holiday</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
							<form action="script/holiday_script.php" name="holiday_form" method="post">
									<div class="form-group">
										<label>Holiday Name <span class="text-danger">*</span></label>
										<input class="form-control" name="holiday_name" value="<?php echo $list_holiday['holiday_name'];?>" type="text">
									</div>
									<div class="form-group">
										<label>Holiday Date <span class="text-danger">*</span></label>
										<div class="cal-icon"><input  name="holiday_date" class="form-control datetimepicker" value="<?php echo $list_holiday['holiday_date'];?>" type="text"></div>
									</div>
								<div class="form-group">
										<label>Message for Leave <span class="text-danger">*</span></label>
										<div>
											<textarea name="message" class="form-control message"><?php echo $list_holiday['message'];?></textarea>
										</div>
									</div>
									<div class="submit-section">
									<input name="holiday_id" value="<?php echo $list_holiday['holiday_id'];?>" type="hidden">
										<button class="btn btn-primary submit-btn" type="submit" name="upd_holiday">Update</button>
										<button class="btn btn-info submit-btn" name="update_holiday_send" type="submit">Send</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>

				

												<?php } ?>
											
												<div class="modal custom-modal fade" id="delete_holiday<?php echo $list_holiday['holiday_id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Holiday</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="script/holiday_script.php?del=<?php echo $list_holiday['holiday_id'];?>" class="btn btn-primary continue-btn">Delete</a>
										</div>
										<div class="col-6">
											<a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>

										</tr>

										
<?php } ?>

									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Holiday Modal -->
				<div class="modal custom-modal fade" id="add_holiday" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Holiday</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form action="script/holiday_script.php" name="holiday_form" enctype="multipart/form-data" method="post">
									<div class="form-group">
										<label>Holiday Name <span class="text-danger">*</span></label>
										<input class="form-control" name="holiday_name" type="text" required>
									</div>
									<div class="form-group">
										<label>Holiday Date <span class="text-danger">*</span></label>
										<div class="cal-icon"><input name="holiday_date" class="form-control datetimepicker" type="text" required></div>
									</div>
									
									<div class="form-group">
										<label>Message for Leave <span class="text-danger">*</span></label>
										<div>
											<textarea class="form-control trapcon" name="message"></textarea>
										</div>
									</div>
									
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" name="add_holiday" type="submit">Save</button>
										<button class="btn btn-info submit-btn" name="add_holiday_send" type="submit">Send</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="assets\js\jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="assets\js\jquery.richtext.js"></script>
		<!-- Bootstrap Core JS -->
        <script src="assets\js\popper.min.js"></script>
        <script src="assets\js\bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets\js\jquery.slimscroll.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets\js\moment.min.js"></script>
		<script src="assets\js\bootstrap-datetimepicker.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
	
	<script>
        $(document).ready(function() {
            $('.trapcon').richText();
        });
        </script>
		
    </body>
</html>