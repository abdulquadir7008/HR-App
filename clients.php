<?php include("config.php");
ob_start();
$pagesetting = basename($_SERVER['PHP_SELF']); 
if(isset($_SESSION['id'])) {
echo $customerchechlogin_id=$_SESSION['id'];
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
$fullname = $_REQUEST['fullname'];
$email = $_REQUEST['email'];
$phone = $_REQUEST['phone'];
$position = $_REQUEST['position'];
$client_id = $_REQUEST['client_id'];
$company_name = $_REQUEST['company_name'];


if($_FILES["image"]["name"]!='')
{
if (($_FILES["image"]["type"] == "image/gif")
|| ($_FILES["image"]["type"] == "image/jpeg")
|| ($_FILES["image"]["type"] == "image/pjpeg")
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


$querybord="insert into clients (fullname,email,phone,position,image,company_name,create_date,status,admin_id,hr_id) values('$fullname','$email','$phone','$position','$image0','$company_name',now(),'1','$cont_hr_id','$hr_id')";
mysqli_query($link,$querybord);
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Budgets Revenues Add Successfully.</span></div>";
$errflag = true;
$_SESSION['clients_expensive'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_POST['update'])){
$query="update clients SET fullname='$fullname',email='$email',phone='$phone',position='$position',image='$image0',company_name='$company_name' WHERE client_id=$client_id";
mysqli_query($link,$query);
	
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Budgets Revenues Update Successfully.</span></div>";
$errflag = true;
$_SESSION['clients_expensive'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from clients WHERE client_id=$del";
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
	if($_REQUEST['fullname']!=''){
			$sername = $_REQUEST['fullname'];
		echo $btnsrst = "AND fullname LIKE '%$sername%'";
		}else{
			echo $btnsrst='';
		}
	if($_REQUEST['company_name']!=''){
			$company_namesr = $_REQUEST['company_name'];
		echo $btncompany = "AND company_name='$company_namesr'";
		}else{
			echo $btncompany='';
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
								<h3 class="page-title">Clients</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active">Clients</li>
								</ul>
							</div>
							<?php if($list_hr_permission['clients_wr']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_client"><i class="fa fa-plus"></i> Add Client</a>
								
							</div>
							<?php } ?>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
					<form action="clients.php" method="post">
					<div class="row filter-row">
						
						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating" name="fullname">
								<label class="focus-label">Client Name</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating" name="company_name"> 
									<option>Select Company</option>
<?php					   
$leave_tbl2_sql="select * from clients WHERE admin_id='$cont_hr_id' and status='1'";
$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
while($leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result)){?>
<option value="<?php echo $leave_tbl2_row['company_name'];?>"><?php echo $leave_tbl2_row['company_name'];?></option>
<?php } ?>
									
								</select>
								<label class="focus-label">Company</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 col-lg-3 col-xl-1 col-12">
						   <button type="submit" name="search_crm" class="btn btn-success btn-block">Search</button>

					   </div>
					   <div class="col-sm-6 col-md-3 col-lg-3 col-xl-1 col-12">
						   <a href="clients.php?date=reset" class="btn btn-white btn-block">RESET</a>  
					   </div> 
							
                    </div>
						</form>
					<!-- Search Filter -->
					
					<div class="row staff-grid-row">
					<?php
										
										$SQDepart="select * from clients WHERE admin_id='$cont_hr_id' and status='1' $btnsrst $btncompany order by fullname ASC";
										$ResultDepart=mysqli_query($link,$SQDepart);
										while($ListDepart=mysqli_fetch_array($ResultDepart)){
											?>	
				<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
							<div class="profile-widget">
								<div class="profile-img">
									<a href="" class="avatar">
									<?php if($ListDepart['image']!='') { ?>
										<img src="uploads/<?php echo $ListDepart['image'];?>" alt="">
                      <?php } else{ ?>
					  <img class="inline-block" src="assets\img\user.jpg" alt="user">
									<?php } ?>
									
									
									</a>
									
								</div>
								<div class="dropdown profile-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
									<?php if($list_hr_permission['clients_red']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_client<?php echo $ListDepart['client_id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
									<?php } ?>
									<?php if($list_hr_permission['clients_del']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_client<?php echo $ListDepart['client_id'];?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
									<?php } ?>
                                </div>
								</div>
								<h4 class="user-name m-t-10 mb-0 text-ellipsis"><?php echo $ListDepart['company_name'];?></h4>
								<h5 class="user-name m-t-10 mb-0 text-ellipsis"><?php echo $ListDepart['fullname'];?></h5>
								<div class="small text-muted"><?php echo $ListDepart['position'];?></div>
								
								<a href="client-profile.php" class="btn btn-white btn-sm m-t-10">View Profile</a>
							</div>
						</div>
						
						<div id="edit_client<?php echo $ListDepart['client_id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Client</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="clients.php" enctype="multipart/form-data"> 
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Full Name <span class="text-danger">*</span></label>
												<input class="form-control" name="fullname" value="<?php echo $ListDepart['fullname'];?>" type="text" required>
											</div>
										</div>
										
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Email <span class="text-danger">*</span></label>
												<input class="form-control floating" name="email" type="email" value="<?php echo $ListDepart['email'];?>">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Position </label>
												<input class="form-control" name="position" type="text" value="<?php echo $ListDepart['position'];?>">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Phone </label>
												<input class="form-control" name="phone" type="text" value="<?php echo $ListDepart['phone'];?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Company Name <span class="text-danger">*</span></label>
												<input class="form-control" name="company_name" type="text" value="<?php echo $ListDepart['company_name'];?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Logo or profile image</label>
												<input class="form-control" name="image" type="file">
												<input type="hidden" name="hiddenimage" value="<?php echo $ListDepart['image'];?>" />
											</div>
										</div>
										<?php if($ListDepart['image']!='') { ?>
										<div class="profile-img-wrap edit-img">
                      <img class="inline-block" src="uploads/<?php echo $ListDepart['image'];?>" width="100" />
										</div>
                      <?php } ?>
									</div>
									
									<div class="submit-section">
										<input type="hidden" name="client_id" value="<?php echo $ListDepart['client_id'];?>">
										<button type="submit" name="update" class="btn btn-primary submit-btn">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
						
					<div class="modal custom-modal fade" id="delete_client<?php echo $ListDepart['client_id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Client</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="clients.php?del=<?php echo $ListDepart['client_id'];?>" class="btn btn-primary continue-btn">Delete</a>
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
					<?php  }?>		
					</div>
                </div>
				<!-- /Page Content -->
			
				<!-- Add Client Modal -->
				<div id="add_client" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Client</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="clients.php" enctype="multipart/form-data"> 
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Full Name <span class="text-danger">*</span></label>
												<input class="form-control" name="fullname" type="text" required>
											</div>
										</div>
										
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Email <span class="text-danger">*</span></label>
												<input class="form-control floating" name="email" type="email" required>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Position </label>
												<input class="form-control" name="position" type="text">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Phone </label>
												<input class="form-control" name="phone" type="text">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Company Name <span class="text-danger">*</span></label>
												<input class="form-control" name="company_name" type="text"  required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-form-label">Logo or profile image</label>
												<input class="form-control" name="image" type="file">
											</div>
										</div>
									</div>
									
									<div class="submit-section">
										<button type="submit" name="add" class="btn btn-primary submit-btn">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Client Modal -->
				
				<!-- Edit Client Modal -->
				
				<!-- /Edit Client Modal -->
				
				<!-- Delete Client Modal -->
				
				<!-- /Delete Client Modal -->
				
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