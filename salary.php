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

if(isset($_REQUEST['search_crm'])){
		$search_employe = $_REQUEST['search_employe'];
	
	if(isset($_REQUEST['from_search']) && isset($_REQUEST['to_search']) ){
		
			if($_REQUEST['from_search']!='' && $_REQUEST['to_search']!=''){
			$from_search = $_REQUEST['from_search'];
		$to_search =$_REQUEST['to_search'];
			
		$bwch = "AND salary_date between '".$from_search."' AND '".$to_search."'";
	}
		else
		{$bwch = '';}
	}
}
else if(isset($_REQUEST['reset'])){
		$from_search='';
		$to_search = '';
		$bwch = '';
		$search_employe='';
	}
if(isset($_REQUEST['tabadd']) || isset($_REQUEST['update'])){
$staff_id =$_REQUEST['staff_id'];
$net_salary =$_REQUEST['net_salary'];
$basic =$_REQUEST['basic'];
$da =$_REQUEST['da'];
$hra =$_REQUEST['hra'];
$conveyance =$_REQUEST['conveyance'];
$allowance =$_REQUEST['allowance'];
$medical_allowance =$_REQUEST['medical_allowance'];
$other =$_REQUEST['other'];
$tds =$_REQUEST['tds'];
$esi =$_REQUEST['esi'];
$pf =$_REQUEST['pf'];
$leave =$_REQUEST['leave'];
$prof_tax =$_REQUEST['prof_tax'];
$labour_welfare =$_REQUEST['labour_welfare'];
$others =$_REQUEST['others'];
$salary_date = $_REQUEST['salary_date'];
$salary_id = $_REQUEST['salary_id'];
}

if(isset($_REQUEST['tabadd'])){	
$querybord="insert into salary (staff_id,net_salary,basic,da,hra,conveyance,allowance,medical_allowance,other,tds,esi,pf,leaves,prof_tax,labour_welfare,others,salary_date,admin_id,hr_id) values('$staff_id','$net_salary','$basic','$da','$hra','$conveyance','$allowance','$medical_allowance','$other','$tds','$esi','$pf','$leave','$prof_tax','$labour_welfare','$others','$salary_date','$cont_hr_id','$hr_id')";
mysqli_query($link,$querybord);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Salary Add Successfully.</span></div>";
$errflag = true;
$_SESSION['salary_msg'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}

else if(isset($_POST['update'])){

		
$query="update salary SET staff_id='$staff_id',net_salary='$net_salary',basic='$basic',da='$da',hra='$hra',conveyance='$conveyance',allowance='$allowance',medical_allowance='$medical_allowance',other='$other',tds='$tds',esi='$esi',pf='$pf',leaves='$leave',prof_tax='$prof_tax',labour_welfare='$labour_welfare',others='$others',salary_date='$salary_date' WHERE salary_id=$salary_id";
mysqli_query($link,$query);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Update - </b>Salary Update Successfully.</span></div>";
$errflag = true;
$_SESSION['salary_msg'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}

else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from salary WHERE salary_id=$del";
mysqli_query($link,$query);
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Delete - </b>Salary Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['salary_msg'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$sql_module_hr_permission = "select * from hr_fun_permission";
$result_hr_permission = mysqli_query( $link, $sql_module_hr_permission );
$list_hr_permission = mysqli_fetch_array( $result_hr_permission );
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<?php include("include/head.php");?>
		<script src="assets\js\jquery-3.5.1.min.js"></script>
		
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
if( isset($_SESSION['salary_msg']) && is_array($_SESSION['salary_msg']) && count($_SESSION['salary_msg']) >0 ) {
foreach($_SESSION['salary_msg'] as $msg) {
echo $msg;  
}
unset($_SESSION['salary_msg']); }?>
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Employee Salary</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Salary</li>
								</ul>
							</div>
							<?php if($list_hr_permission['salary_wr']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_salary"><i class="fa fa-plus"></i> Add Salary</a>
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- /Page Header -->
					<form method="post" action="salary.php">
					<!-- Search Filter -->
					<div class="row filter-row">
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-4 col-12">  
							<div class="form-group form-focus select-focus">
							<select name="search_employe" class="select floating" required>
                          <option value="">Select Empployee</option>
                          <?php
					   
					   $leave_tbl2_sql="select * from users where parent_admin='$cont_hr_id'";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){
$acounttype= $leave_tbl2_row['account_type'];
$sql_type="select * from counter WHERE id=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

  if($leave_tbl2_row['account_type'] == '1'){}
  else{
	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['id']; ?>" >
						  <?php echo $leave_tbl2_row['fullname']; ?></option>
                        <?php }}?>
  </select>
  <label class="focus-label">Employee Name</label>
							</div>
					   </div>
					   
					   
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
							<div class="form-group form-focus">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker" name="from_search" type="text">
								</div>
								<label class="focus-label">From</label>
							</div>
						</div>
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">  
							<div class="form-group form-focus">
								<div class="cal-icon">
									<input class="form-control floating datetimepicker" name="to_search" type="text">
								</div>
								<label class="focus-label">To</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 col-lg-3 col-xl-1 col-12">
						   <button type="submit" class="btn btn-success btn-block" name="search_crm">Search</button>

					   </div>
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-1 col-12">
						   <a href="salary.php?date=reset" class="btn btn-white btn-block">RESET</a>  
					   </div>    
                    </div>
					<!-- /Search Filter -->
						</form>
					
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-striped custom-table datatable">
									<thead>
										<tr>
											<th>Employee</th>
											<th>Employee ID</th>
											<th>Email</th>
											<th>Salary Date</th>
											<th>Salary</th>
											<th>Payslip</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										
										$SQDepart="select * from salary where admin_id='$cont_hr_id' and staff_id LIKE '%$search_employe%' $bwch order by salary_id DESC";
										$ResultDepart=mysqli_query($link,$SQDepart);
										while($ListDepart=mysqli_fetch_array($ResultDepart)){
											$emplID = $ListDepart['staff_id'];
											$SqlEmpl="select * from users LEFT JOIN department ON users.destination=department.depart_id where id='$emplID'";
											$ResultEmpl=mysqli_query($link,$SqlEmpl);
											$ListEmplrow=mysqli_fetch_array($ResultEmpl);
											
										?>
										<tr>
											<td>
												<h2 class="table-avatar">
													<a href="" class="avatar">
														<?php if($ListEmplrow['image']!='') { ?>
										<img src="uploads/<?php echo $ListEmplrow['image'];?>" alt="">
                      <?php } else{ ?>
					  <img class="inline-block" src="assets\img\user.jpg" alt="user">
									<?php } ?>
													</a>
													<a href=""><?php echo $ListEmplrow['fullname'];?> <span><?php echo $ListEmplrow['dep_name'];?></span></a>
												</h2>
											</td>
											<td>FT-00<?php echo $ListEmplrow['id'];?></td>
											<td><?php echo $ListEmplrow['email'];?></td>
											<td><?php echo $ListDepart['salary_date'];?></td>
											
											<td><?php echo $ListDepart['net_salary'];?></td>
											<td><a class="btn btn-sm btn-primary" href="salary-view.php?slip=<?php echo $ListDepart['salary_id'];?>">Generate Slip</a></td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<?php if($list_hr_permission['salary_red']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_salary<?php echo $ListDepart['salary_id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<?php } ?>
														<?php if($list_hr_permission['salary_del']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
														<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_salary<?php echo $ListDepart['salary_id'];?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
														<?php } ?>
													</div>
												</div>
											</td>
										</tr>
										
										<!-- Delete Salary Modal -->
				<div class="modal custom-modal fade" id="delete_salary<?php echo $ListDepart['salary_id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Salary</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="salary.php?del=<?php echo $ListDepart['salary_id'];?>" class="btn btn-primary continue-btn">Delete</a>
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
				<!-- /Delete Salary Modal -->
										
										<!-- Edit Salary Modal -->
				<div id="edit_salary<?php echo $ListDepart['salary_id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Staff Salary</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								
								
								<form method="post" action="salary.php">
									<div class="row"> 
										<div class="col-sm-6"> 
											<div class="form-group">
												<label>Select Staff</label>
												<select class="select" name="staff_id"> 
													<?php
					   
					   $leave_tbl2_sql="select * from users where parent_admin='$cont_hr_id' order by fullname ASC";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){
$acounttype= $leave_tbl2_row['account_type'];
$sql_type="select * from counter WHERE id=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

  if($leave_tbl2_row['account_type'] == '1'){}
  else{
	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['id']; ?>" <?php if($leave_tbl2_row['id']==$emplID){?>selected<?php } ?>><?php echo $leave_tbl2_row['fullname']; ?></option>
                        <?php }}?>
												</select>
											</div>
										</div>
										
									</div>
									<div class="row">
									<div class="col-sm-6"> 
											<label>Net Salary</label>
											<input class="form-control" name="net_salary" value="<?php echo $ListDepart['net_salary'];?>" type="text">
										</div>
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Salary Date <span class="text-danger">*</span></label>
												<div class="cal-icon"><input name="salary_date" value="<?php echo $ListDepart['salary_date'];?>" class="form-control datetimepicker" type="text"></div>
											</div>
										</div>
									</div>
									<div class="row"> 
										<div class="col-sm-6"> 
											<h4 class="text-primary">Earnings</h4>
											<div class="form-group">
												<label>Basic</label>
												<input class="form-control"  name="basic" value="<?php echo $ListDepart['basic'];?>" type="text">
											</div>
											<div class="form-group">
												<label>DA(40%)</label>
												<input class="form-control" name="da" value="<?php echo $ListDepart['da'];?>" type="text">
											</div>
											<div class="form-group">
												<label>HRA(15%)</label>
												<input class="form-control" name="hra" value="<?php echo $ListDepart['hra'];?>" type="text">
											</div>
											<div class="form-group">
												<label>Conveyance</label>
												<input class="form-control" name="conveyance" value="<?php echo $ListDepart['conveyance'];?>" type="text">
											</div>
											<div class="form-group">
												<label>Allowance</label>
												<input class="form-control" name="allowance" value="<?php echo $ListDepart['allowance'];?>" type="text">
											</div>
											<div class="form-group">
												<label>Medical  Allowance</label>
												<input class="form-control" name="medical_allowance" value="<?php echo $ListDepart['medical_allowance'];?>" type="text">
											</div>
											<div class="form-group">
												<label>Others</label>
												<input class="form-control" name="other" value="<?php echo $ListDepart['other'];?>" type="text">
											</div>
											
										</div>
										<div class="col-sm-6">  
											<h4 class="text-primary">Deductions</h4>
											<div class="form-group">
												<label>TDS</label>
												<input class="form-control" name="tds" value="<?php echo $ListDepart['tds'];?>" type="text">
											</div> 
											<div class="form-group">
												<label>ESI</label>
												<input class="form-control" name="esi" value="<?php echo $ListDepart['esi'];?>" type="text">
											</div>
											<div class="form-group">
												<label>PF</label>
												<input class="form-control" name="pf" value="<?php echo $ListDepart['pf'];?>" type="text">
											</div>
											<div class="form-group">
												<label>Leave</label>
												<input class="form-control" name="leave" value="<?php echo $ListDepart['leaves'];?>" type="text">
											</div>
											<div class="form-group">
												<label>Prof. Tax</label>
												<input class="form-control" name="prof_tax" value="<?php echo $ListDepart['prof_tax'];?>" type="text">
											</div>
											<div class="form-group">
												<label>Labour Welfare</label>
												<input class="form-control" name="labour_welfare" value="<?php echo $ListDepart['labour_welfare'];?>" type="text">
											</div>
											<div class="form-group">
												<label>Others</label>
												<input class="form-control" name="others" value="<?php echo $ListDepart['others'];?>" type="text">
											</div>
											
										</div>
									</div>
									<div class="submit-section">
										<input type="hidden" name="salary_id" value="<?php echo $ListDepart['salary_id'];?>">
										<button type="submit" name="update" class="btn btn-primary submit-btn">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Edit Salary Modal -->
										
										
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Salary Modal -->
				<div id="add_salary" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Staff Salary</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								
								
								<form method="post" action="salary.php">
									<div class="row"> 
										<div class="col-sm-6"> 
											<div class="form-group">
												<label>Select Staff</label>
												<select class="select" name="staff_id"> 
													<?php
					   
					   $leave_tbl2_sql="select * from users where parent_admin='$cont_hr_id' order by fullname ASC";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){
$acounttype= $leave_tbl2_row['account_type'];
$sql_type="select * from counter WHERE id=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

  if($leave_tbl2_row['account_type'] == '1'){}
  else{
	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['id']; ?>"><?php echo $leave_tbl2_row['fullname']; ?></option>
                        <?php }}?>
												</select>
											</div>
										</div>
										<div class="col-sm-6"> 
											<label>Net Salary</label>
											<input class="form-control" name="net_salary" type="text">
										</div>
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Salary Date <span class="text-danger">*</span></label>
												<div class="cal-icon"><input name="salary_date" class="form-control datetimepicker" type="text"></div>
											</div>
										</div>
									</div>
									<div class="row"> 
										<div class="col-sm-6"> 
											<h4 class="text-primary">Earnings</h4>
											<div class="form-group">
												<label>Basic</label>
												<input class="form-control" name="basic" type="text">
											</div>
											<div class="form-group">
												<label>DA(40%)</label>
												<input class="form-control" name="da" type="text">
											</div>
											<div class="form-group">
												<label>HRA(15%)</label>
												<input class="form-control" name="hra" type="text">
											</div>
											<div class="form-group">
												<label>Conveyance</label>
												<input class="form-control" name="conveyance" type="text">
											</div>
											<div class="form-group">
												<label>Allowance</label>
												<input class="form-control" name="allowance" type="text">
											</div>
											<div class="form-group">
												<label>Medical  Allowance</label>
												<input class="form-control" name="medical_allowance" type="text">
											</div>
											<div class="form-group">
												<label>Others</label>
												<input class="form-control" name="other" type="text">
											</div>
											
										</div>
										<div class="col-sm-6">  
											<h4 class="text-primary">Deductions</h4>
											<div class="form-group">
												<label>TDS</label>
												<input class="form-control" name="tds" type="text">
											</div> 
											<div class="form-group">
												<label>ESI</label>
												<input class="form-control" name="esi" type="text">
											</div>
											<div class="form-group">
												<label>PF</label>
												<input class="form-control" name="pf" type="text">
											</div>
											<div class="form-group">
												<label>Leave</label>
												<input class="form-control" name="leave" type="text">
											</div>
											<div class="form-group">
												<label>Prof. Tax</label>
												<input class="form-control" name="prof_tax" type="text">
											</div>
											<div class="form-group">
												<label>Labour Welfare</label>
												<input class="form-control" name="labour_welfare" type="text">
											</div>
											<div class="form-group">
												<label>Others</label>
												<input class="form-control" name="others" type="text">
											</div>
											
										</div>
									</div>
									<div class="submit-section">
										<button type="submit" name="tabadd" class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Salary Modal -->
				
				
				
				
				
            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        
		<!-- Bootstrap Core JS -->
        <script src="assets\js\popper.min.js"></script>
        <script src="assets\js\bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets\js\jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets\js\select2.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets\js\moment.min.js"></script>
		<script src="assets\js\bootstrap-datetimepicker.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
		
    </body>
</html>