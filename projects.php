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

if(isset($_POST['update']) || isset($_POST['add'])){
$project_name = $_REQUEST['project_name'];
$client = $_REQUEST['client'];
$start_date = $_REQUEST['start_date'];
$end_date = $_REQUEST['end_date'];
$priority = $_REQUEST['priority'];
$lead = $_REQUEST['lead'];
$description = $_REQUEST['description'];
$id = $_REQUEST['id'];
$employee=implode(',',$_REQUEST['employee']);

if($_FILES["image"]["name"]!='')
{
if (($_FILES["image"]["type"] == "application/docx")
|| ($_FILES["image"]["type"] == "image/jpeg")
|| ($_FILES["image"]["type"] == "application/pdf")
|| ($_FILES["image"]["type"] == "image/X-PNG")
|| ($_FILES["image"]["type"] == "image/PNG")
|| ($_FILES["image"]["type"] == "image/png")
|| ($_FILES["image"]["type"] == "image/x-png"))
{
$image="$path0".$rand1.$_FILES["image"]["name"];
$image0=$rand1.$_FILES["image"]["name"];
move_uploaded_file($_FILES["image"]["tmp_name"],$image);
}
else
{
$image0='';
}
}

else
{
$image0=$_REQUEST['hiddenimage'];
}	

	
}


if(isset($_POST['add'])){


$querybord="insert into project (project_name,client,start_date,end_date,image,priority,status,lead,description,employee,admin_id,hr_id) values('$project_name','$client','$start_date','$end_date','$image0','$priority','1','$lead','$description','$employee','$cont_hr_id','$hr_id')";
mysqli_query($link,$querybord);
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Project Add Successfully.</span></div>";
$errflag = true;
$_SESSION['clients_expensive'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_POST['update'])){
$query="update project SET project_name='$project_name',client='$client',start_date='$start_date',end_date='$end_date',image='$image0',priority='$priority',lead='$lead',description='$description',employee='$employee' WHERE id=$id";
mysqli_query($link,$query);
	
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Project Update Successfully.</span></div>";
$errflag = true;
$_SESSION['clients_expensive'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from project WHERE id=$del";
mysqli_query($link,$query);

	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Budgets Revenues Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['clients_expensive'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
if(isset($_REQUEST['search_crm'])){
	if($_REQUEST['projectsearch']!=''){
			echo $sername = $_REQUEST['projectsearch'];
		$btnsrst = "AND project_name LIKE '%$sername%'";
		}else{
			$btnsrst='';
		}
	if($_REQUEST['leadsearch']!=''){
			echo $leadsearch = $_REQUEST['leadsearch'];
		$btncompany = "AND lead='$leadsearch'";
		}else{
			$btncompany='';
		}
}
else if(isset($_REQUEST['reset'])){
		$btncompany='';
		$btnsrst = '';
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
		<script>
		$(document).ready(function(){

    $("#sel_depart").change(function(){
        var deptid = $(this).val();

        $.ajax({
            url: 'getUsers.php',
            type: 'post',
            data: {depart:deptid},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#sel_user").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];
                    
                    $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });

});
		</script>
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
if( isset($_SESSION['clients_expensive']) && is_array($_SESSION['clients_expensive']) && count($_SESSION['clients_expensive']) >0 ) {
foreach($_SESSION['clients_expensive'] as $msg) {
echo $msg;  
}
unset($_SESSION['clients_expensive']); }?>
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Projects</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Projects</li>
								</ul>
							</div>
							<?php if($list_hr_permission['projects_wr']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i> Create Project</a>
								
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- /Page Header -->
					<form action="projects.php" method="post">
					<!-- Search Filter -->
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating" name="projectsearch">
								<label class="focus-label">Project Name</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-2">  
							<div class="form-group form-focus">
								<div class="form-group form-focus select-focus">
								<select class="select floating" name="leadsearch"> 
									<option value="">Select Lead</option>
									<?php
					   
$leave_tbl211_sql="select * from users WHERE parent_admin=$cont_hr_id";
$leave_tbl211_result=mysqli_query($link,$leave_tbl211_sql);
while($leave_tbl211_row=mysqli_fetch_array($leave_tbl211_result)){
$acounttype= $leave_tbl211_row['type_role'];
$sql_type="select * from counter WHERE primary_role=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

  if($leave_tbl211_row['account_type'] == '1'){}
  else{
	
  
					   ?>
                          <option value="<?php echo $leave_tbl211_row['id']; ?>" >
						  <?php echo $leave_tbl211_row['fullname']; ?></option>
                        <?php }}?>
								</select>
								<label class="focus-label">Employee</label>
							</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating"> 
									<option>Select Roll</option>
									 <?php
					   
$leave_tbl211_sql="select * from users WHERE parent_admin=$cont_hr_id";
$leave_tbl211_result=mysqli_query($link,$leave_tbl211_sql);
while($leave_tbl211_row=mysqli_fetch_array($leave_tbl211_result)){
$acounttype= $leave_tbl211_row['type_role'];
$sql_type="select * from counter WHERE primary_role=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

  if($leave_tbl211_row['account_type'] == '1'){}
  else{
	
  
					   ?>
                          <option value="<?php echo $leave_tbl211_row['id']; ?>" >
						  <?php echo $leave_tbl211_row['fullname']; ?></option>
                        <?php }}?>
								</select>
								<label class="focus-label">Designation</label>
							</div>
						</div>
						 <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
						   <button type="submit" name="search_crm" class="btn btn-success btn-block">Search</button>

					   </div>
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
						   <a href="projects.php?date=reset" class="btn btn-white btn-block">RESET</a>  
					   </div>   
                    </div>
					<!-- Search Filter -->
						</from>
					<div class="row">				
							<?php
										
										$SQDepart="select * from project WHERE admin_id=$cont_hr_id and status='1' $btnsrst $btncompany order by id DESC";
											$ResultDepart=mysqli_query($link,$SQDepart);
												while($ListDepart=mysqli_fetch_array($ResultDepart)){
													$lead = $ListDepart['lead'];
													$userlead_sql="select * from users WHERE parent_admin=$cont_hr_id and  id='$lead'";
														$userlead_result=mysqli_query($link,$userlead_sql);
															$userlist=mysqli_fetch_array($userlead_result);
											?>
						<div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
							<div class="card">
								<div class="card-body">
									<div class="dropdown dropdown-action profile-action">
										<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<?php if($list_hr_permission['projects_red']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
											<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_project<?php echo $ListDepart['id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
											<?php } ?>
											<?php if($list_hr_permission['projects_del']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
											<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_project<?php echo $ListDepart['id'];?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
											<?php } ?>
										</div>
									</div>
									<h4 class="project-title"><a href="project-view.html"><?php echo $ListDepart['project_name'];?></a></h4>
									<small class="block text-ellipsis m-b-15">
										<span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
										<span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
									</small>
									<p class="text-muted"><?php echo $ListDepart['description'];?>
									</p>
									<div class="pro-deadline m-b-15">
										<div class="sub-title">
											Deadline:
										</div>
										<div class="text-muted">
											<?php echo $ListDepart['end_date'];?>
										</div>
									</div>
									<div class="project-members m-b-15">
										<div>Project Leader :</div>
										<?php if(mysqli_num_rows($userlead_result) > 0){?>
										<ul class="team-members">
											<li>
												<a href="#" data-toggle="tooltip" title="<?php echo $userlist['fullname'];?>">
													<?php if($userlist['image']){?>
													<img alt="" src="uploads/<?php echo $userlist['image'];?>">
													<?php } else{?>
													<img alt="" src="assets/img/user.jpg">
													<?php } ?>
													
												</a>
											</li>
										</ul>
										<?php } ?>
									</div>
									<?php if($ListDepart['employee']){?>
									<div class="project-members m-b-15">
										<div>Team :</div>
										<ul class="team-members">
											<?php
											$tags = preg_replace('/,+/', ',', $ListDepart['employee']);
	 												$Splitexpo=explode(",",$tags);
														foreach ($Splitexpo as  $rowvalue) {
															if($rowvalue){
																$useremployes_sql="select * from users WHERE id='$rowvalue'";
																	$useremployees_result=mysqli_query($link,$useremployes_sql);
																		$userempllist=mysqli_fetch_array($useremployees_result);
											?>
											<li>
												<a href="#" data-toggle="tooltip" title="<?php echo $userempllist['fullname'];?>">
													<?php if($userempllist['image']){?>
													<img alt="" src="uploads/<?php echo $userempllist['image'];?>">
													<?php } else{?>
													<img alt="" src="assets/img/user.jpg">
													<?php } ?>
												</a>
											</li>
											<?PHP } } ?>
											
											
										</ul>
									</div>
									<?php } ?>
									<p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
									<div class="progress progress-xs mb-0">
										<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="40%" style="width: 40%"></div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="modal custom-modal fade" id="delete_project<?php echo $ListDepart['id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Project</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="projects.php?del=<?php echo $ListDepart['id'];?>" class="btn btn-primary continue-btn">Delete</a>
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
						
						<div id="edit_project<?php echo $ListDepart['id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Create Project</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="projects.php" enctype="multipart/form-data">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Project Name</label>
												<input class="form-control" name="project_name" value="<?php echo $ListDepart['project_name'];?>" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Client</label>
												<select class="select" name="client">
													<option>Select Company</option>
													<?php					   
$leave_tbl2_sql="select * from clients where admin_id=$cont_hr_id and status='1'";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){?>
<option value="<?php echo $leave_tbl2_row['client_id'];?>" <?php if($ListDepart['client']==$leave_tbl2_row['client_id']){ echo "selected";}?>><?php echo $leave_tbl2_row['company_name'];?></option>
<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Start Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" name="start_date" value="<?php echo $ListDepart['start_date'];?>" type="text">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>End Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" name="end_date" value="<?php echo $ListDepart['end_date'];?>" type="text">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										
										
										<div class="col-sm-6">
											<div class="form-group">
												<label>Priority</label>
												<select class="select" name="priority">
													<option>High</option>
													<option>Medium</option>
													<option>Low</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Add Project Leader</label>
												<select name="lead" class="select floating" required>
                          <option value="">Select Lead</option>
                          <?php
					   
$leave_tbl2_sql="select * from users where parent_admin=$cont_hr_id";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){
$acounttype= $leave_tbl2_row['account_type'];
$sql_type="select * from counter WHERE id=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

  if($leave_tbl2_row['account_type'] == '1'){}
  else{
	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['id']; ?>" <?php if($ListDepart['lead']==$leave_tbl2_row['id']){ echo "selected";}?>>
						  <?php echo $leave_tbl2_row['fullname']; ?></option>
                        <?php }}?>
  </select>
											</div>
										</div>
										<?php if($ListDepart['lead']){
										$leadid= $ListDepart['lead'];
										$leave_tbl21_sql="select * from users WHERE id='$leadid'";
											$leave_tbl21_result=mysqli_query($link,$leave_tbl21_sql);
												$leave_tbl21_row=mysqli_fetch_array($leave_tbl21_result);
										?>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Team Leader</label>
												<div class="project-members">
													<a href="#" data-toggle="tooltip" title="<?php echo $leave_tbl21_row['fullname'];?>" class="avatar">
														<?php if($leave_tbl21_row['image']){?>
													<img alt="" src="uploads/<?php echo $leave_tbl21_row['image'];?>">
													<?php } else{?>
													<img alt="" src="assets/img/user.jpg">
													<?php } ?>
													
													</a>
												</div>
											</div>
										</div>
										
										<?php } ?>
										
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Add Team</label>
												<select name="employee[]" class="select floating" multiple>
													
												<?php
					   
					   $leave_tbl2_sql="select * from users where parent_admin=$cont_hr_id";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){
$acounttype= $leave_tbl2_row['account_type'];
$sql_type="select * from counter WHERE id=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

  if($leave_tbl2_row['account_type'] == '1'){}
  else{
	 
	  
	  
	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['id']; ?>" <?php if($ListDepart['employee']){ $tags = preg_replace('/,+/', ',', $ListDepart['employee']); $Splitexpo=explode(",",$tags); foreach ($Splitexpo as  $rowvalue) {if($rowvalue==$leave_tbl2_row['id']){ echo "selected";}}} ?> >
						  <?php echo $leave_tbl2_row['fullname']; ?></option>
                        <?php }} ?>
												</select>
												
												
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Team Members</label>
												<div class="project-members">
													<?php
													$tags = preg_replace('/,+/', ',', $ListDepart['employee']);
	 												$Splitexpo=explode(",",$tags);
														foreach ($Splitexpo as  $rowvalue) {
															if($rowvalue){
																$useremployes_sql="select * from users WHERE id='$rowvalue'";
																	$useremployees_result=mysqli_query($link,$useremployes_sql);
																		$userempllist=mysqli_fetch_array($useremployees_result);
													?>
													<a href="#" data-toggle="tooltip" title="<?php echo $userempllist['fullname'];?>" class="avatar">
														<?php if($userempllist['image']){?>
													<img alt="" src="uploads/<?php echo $userempllist['image'];?>">
													<?php } else{?>
													<img alt="" src="assets/img/user.jpg">
													<?php } ?>
													</a>
													<?php } } ?>
													
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Description</label>
										<textarea name="description" rows="4" class="form-control summernote" placeholder="Enter your message here"><?php echo $ListDepart['description'];?></textarea>
									</div>
									<div class="form-group">
										<label>Upload Files</label>
										<input class="form-control" name="image" type="file">
										<input type="hidden" name="hiddenimage" value="<?php echo $ListDepart['image'];?>" />
										<?php if($ListDepart['image']!='') { ?>
										<a href="uploads/<?php echo $ListDepart['image'];?>" target="_blank"><?php echo $ListDepart['image'];?></a>
                      <?php }  ?>
									</div>
									<div class="submit-section">
										<input type="hidden" name="id" value="<?php echo $ListDepart['id'];?>">
										<button type="submit" name="update" class="btn btn-primary submit-btn">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
						
						<?php } ?>	
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Create Project Modal -->
				<div id="create_project" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Create Project</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="projects.php" enctype="multipart/form-data">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Project Name</label>
												<input class="form-control" name="project_name" type="text">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Client</label>
												<select class="select" name="client">
													<option>Select Company</option>
													<?php					   
$leave_tbl2_sql="select * from clients WHERE admin_id=$cont_hr_id and status='1'";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){?>
<option value="<?php echo $leave_tbl2_row['client_id'];?>"><?php echo $leave_tbl2_row['company_name'];?></option>
<?php } ?>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Start Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" name="start_date" type="text">
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>End Date</label>
												<div class="cal-icon">
													<input class="form-control datetimepicker" name="end_date" type="text">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										
										
										<div class="col-sm-6">
											<div class="form-group">
												<label>Priority</label>
												<select class="select" name="priority">
													<option>High</option>
													<option>Medium</option>
													<option>Low</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Add Project Leader</label>
												<select name="lead" class="select floating" required>
                          <option value="">Select Lead</option>
                          <?php
					   
					   $leave_tbl2_sql="select * from users where parent_admin=$cont_hr_id";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){
$acounttype= $leave_tbl2_row['account_type'];
$sql_type="select * from counter WHERE id=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

  if($leave_tbl2_row['account_type'] == '1'){}
  else{
	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['id']; ?>">
						  <?php echo $leave_tbl2_row['fullname']; ?></option>
                        <?php }}?>
  </select>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label>Add Team</label>
												<select name="employee[]" class="select floating" multiple>
												<?php
					   
					   $leave_tbl2_sql="select * from users where parent_admin=$cont_hr_id";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){
$acounttype= $leave_tbl2_row['account_type'];
$sql_type="select * from counter WHERE id=$acounttype";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

  if($leave_tbl2_row['account_type'] == '1'){}
  else{
	
  
					   ?>
                          <option value="<?php echo $leave_tbl2_row['id']; ?>">
						  <?php echo $leave_tbl2_row['fullname']; ?></option>
                        <?php }}?>
												</select>
												
												
											</div>
										</div>
										
									</div>
									<div class="form-group">
										<label>Description</label>
										<textarea name="description" rows="4" class="form-control summernote" placeholder="Enter your message here"></textarea>
									</div>
									<div class="form-group">
										<label>Upload Files</label>
										<input class="form-control" name="image" type="file">
									</div>
									<div class="submit-section">
										<button type="submit" name="add" class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Create Project Modal -->
				
				<!-- Edit Project Modal -->
				
				<!-- /Edit Project Modal -->
				
				<!-- Delete Project Modal -->
				
				<!-- /Delete Project Modal -->
				
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