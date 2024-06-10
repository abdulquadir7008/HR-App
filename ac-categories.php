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
$sql_hr_req="select * from counter WHERE admin_id=$cont_hr_id";
$result_hr_req=mysqli_query($link,$sql_hr_req);
$list_hr_req=mysqli_fetch_array($result_hr_req);
$hr_id = $list_hr_req['id'];
if(isset($_POST['add'])){
$catname = $_REQUEST['catname'];
$querybord="insert into ac_category (catname,admin_id,ac_id) values('$catname','$cont_hr_id','$ac_id')";
mysqli_query($link,$querybord);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Categories Add Successfully.</span></div>";
$errflag = true;
$_SESSION['ac_category'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_POST['update'])){
$catname = $_REQUEST['catname'];
$ac_cat_id = $_REQUEST['ac_cat_id'];
$query="update ac_category SET catname='$catname' WHERE ac_cat_id=$ac_cat_id";
mysqli_query($link,$query);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Categories Update Successfully.</span></div>";
$errflag = true;
$_SESSION['ac_category'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from ac_category WHERE ac_cat_id=$del";
mysqli_query($link,$query);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Categories Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['ac_category'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$sql_module_account_permission = "select * from account_fun_permission";
$result_account_permission = mysqli_query( $link, $sql_module_account_permission );
$list_account_permission = mysqli_fetch_array( $result_account_permission );
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
			
				<!-- Page Content -->
                <div class="content container-fluid">
				<?php
if( isset($_SESSION['ac_category']) && is_array($_SESSION['ac_category']) && count($_SESSION['ac_category']) >0 ) {
foreach($_SESSION['ac_category'] as $msg) {
echo $msg;  
}
unset($_SESSION['ac_category']); }?>
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Categories</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Accounts</li>
								</ul>
							</div>
							<?php if($list_account_permission['categories_wr']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_department"><i class="fa fa-plus"></i> Add Categories</a>
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- /Page Header -->
					
					<div class="row">
						<div class="col-md-12">
							<div>
								<table class="table table-striped custom-table mb-0 datatable">
									<thead>
										<tr>
											<th style="width: 30px;">#</th>
											<th>Category Name</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$k = 1;
										$SQDepart="select * from ac_category WHERE admin_id=$cont_hr_id and parent_id='0' order by catname ASC";
										$ResultDepart=mysqli_query($link,$SQDepart);
										while($ListDepart=mysqli_fetch_array($ResultDepart)){
										?>
										<tr>
											<td><?php echo $k;?></td>
											<td><?php echo $ListDepart['catname'];?></td>
											<td class="text-right">
                                            <div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
													<?php if($list_account_permission['categories_red']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_department<?php echo $ListDepart['ac_cat_id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
													<?php } ?>
													<?php if($list_account_permission['categories_del']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_department<?php echo $ListDepart['ac_cat_id'];?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													<?php } ?>
                                                </div>
												</div>
											</td>
										</tr>
										
										
										<!-- Delete Department Modal -->
				<div class="modal custom-modal fade" id="delete_department<?php echo $ListDepart['ac_cat_id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Department</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="departments.php?del=<?php echo $ListDepart['ac_cat_id'];?>" class="btn btn-primary continue-btn">Delete</a>
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
				<!-- /Delete Department Modal -->
										
										<!-- Edit Department Modal -->
				<div id="edit_department<?php echo $ListDepart['ac_cat_id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Department</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="ac-categories.php">
									<div class="form-group">
										<label>Department Name <span class="text-danger">*</span></label>
										<input class="form-control" name="catname" value="<?php echo $ListDepart['catname'];?>" type="text">
									</div>
									<div class="submit-section">
										<input type="hidden" name="ac_cat_id" value="<?php echo $ListDepart['ac_cat_id'];?>">
										<button class="btn btn-primary submit-btn" name="update" type="submit">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Department Modal -->
										
										<?php $k++; }?>
										
										
										
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Department Modal -->
				<div id="add_department" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Categories</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="ac-categories.php">
									<div class="form-group">
										<label>Categorie Name <span class="text-danger">*</span></label>
										<input class="form-control" name="catname" type="text">
									</div>
									<div class="submit-section">
										<button class="btn btn-primary submit-btn" name="add" type="submit">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Department Modal -->
				
				

				
				
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