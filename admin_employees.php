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
				
					<!-- Page Header -->
					<div class="page-header">
						<div class="row align-items-center">
							<div class="col">
								<h3 class="page-title">Employee</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active">Employee</li>
								</ul>
							</div>
							<div class="col-auto float-right ml-auto">
								<a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
								
							</div>
						</div>
					</div>
					<!-- /Page Header -->
					
					<!-- Search Filter -->
					<div class="row filter-row">
						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating">
								<label class="focus-label">Employee ID</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">  
							<div class="form-group form-focus">
								<input type="text" class="form-control floating">
								<label class="focus-label">Employee Name</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3"> 
							<div class="form-group form-focus select-focus">
								<select class="select floating"> 
									<option value="">Empployee Type</option>
                          <?php
                           $counter_sql="select * from counter where admin_id='$customerchechlogin_id' order by countr ASC";
                           $counter_result=mysqli_query($link,$counter_sql);
                           while($counter_row=mysqli_fetch_array($counter_result)){
                          ?>
                          <option value="<?php echo $counter_row['id']; ?>"><?php echo $counter_row['countr']; ?></option>
                        <?php }?>
								</select>
								<label class="focus-label">Designation</label>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">  
							<a href="#" class="btn btn-success btn-block"> Search </a>  
						</div>
                    </div>
					<!-- Search Filter -->
					
					<div class="row staff-grid-row">

					<?php
					   
$backoffice_sql="select * from users where parent_admin='$customerchechlogin_id' and status='1'";
$backoffice_result=mysqli_query($link,$backoffice_sql);
while($backoffice_row=mysqli_fetch_array($backoffice_result)){
$acounttype= $backoffice_row['type_role'];
$sql_type="select * from counter WHERE primary_role='$acounttype'";
$ressql=mysqli_query($link,$sql_type);
$listsqltype=mysqli_fetch_array($ressql);

  if($backoffice_row['account_type'] == '1'){}
  else{
	
  
					   ?>
						<div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
							<div class="profile-widget">
								<div class="profile-img">
									<a href="" class="avatar">
									<?php if($backoffice_row['image']!='') { ?>
										<img src="uploads/<?php echo $backoffice_row['image'];?>" alt="">
                      <?php } else{ ?>
					  <img class="inline-block" src="assets\img\user.jpg" alt="user">
									<?php } ?>
									
									
									</a>
								</div>
								<div class="dropdown profile-action">
									<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
									<div class="dropdown-menu dropdown-menu-right">
										<a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_employee<?php echo $backoffice_row['id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
										<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee<?php echo $backoffice_row['id'];?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
									</div>
								</div>
								<h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#">
								<?php echo $backoffice_row['fullname'];?></a>
								</h4>
								<div class="small text-muted"><?php echo $listsqltype['countr'];?></div>
							</div>
						</div>



						<div class="modal custom-modal fade" id="delete_employee<?php echo $backoffice_row['id'];?>" role="dialog">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
							<div class="modal-body">
								<div class="form-header">
									<h3>Delete Employee</h3>
									<p>Are you sure want to delete?</p>
								</div>
								<div class="modal-btn delete-action">
									<div class="row">
										<div class="col-6">
											<a href="script/employe_script.php?del=<?php echo $backoffice_row['id'];?>" class="btn btn-primary continue-btn">Delete</a>
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


						<div id="edit_employee<?php echo $backoffice_row['id'];?>" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Edit Employee</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form form action="script/employe_script.php" name="Registerform" enctype="multipart/form-data" method="post">
								<div class="profile-img-wrap edit-img">
								<?php if($backoffice_row['image']!='') { ?>
                      <img class="inline-block" src="uploads/<?php echo $backoffice_row['image'];?>" />
                      <?php } else{ ?>
					  <img class="inline-block" src="assets\img\user.jpg" alt="user">
									<?php } ?>
											
																	  
																	  <div class="fileupload btn">
																		  <span class="btn-text">edit</span>
																	  
																		  <input type="file" class="upload" name="image"/>
																		<input type="hidden" name="hiddenimage" value="<?php echo $backoffice_row['image'];?>" />
																	  </div>
																  </div>
									<div class="row">

									

									<div class="col-sm-6">
											<div class="form-group">
									<label class="bmd-label-floating">Empployee Type</label>
                        <select name="type_role" class="form-control">
                          <option value="">Empployee Type</option>
                          <?php
                           $counter_sql="select * from counter where admin_id='$customerchechlogin_id' order by countr ASC";
                           $counter_result=mysqli_query($link,$counter_sql);
                           while($counter_row=mysqli_fetch_array($counter_result)){
                          ?>
                          <option value="<?php echo $counter_row['primary_role']; ?>" <?php if($counter_row['primary_role'] == $acounttype){?>selected<?php } ?>><?php echo $counter_row['countr']; ?></option>
                        <?php }?>
                          
                        </select>
						</div>
						</div>
										
										
										
										
										<div class="col-sm-6">
											<div class="form-group">
										<label>Department <span class="text-danger">*</span></label>
										<select class="select" name="department" disabled>
											<option value="">Select Department</option>
											<?php
										
										$SQDepartstr="select * from department WHERE admin_id='$cont_hr_id' and parent_id='0' order by dep_name ASC";
										$ResultDepartstr=mysqli_query($link,$SQDepartstr);
										while($ListDepartstr=mysqli_fetch_array($ResultDepartstr)){
										?>
											<option value="<?php echo $ListDepartstr['depart_id'];?>" <?php if($ListDepartstr['depart_id']==$backoffice_row['department']){?>selected<?php } ?>><?php echo $ListDepartstr['dep_name'];?></option>
											<?php } ?>
										</select>
									</div>
						</div>
										
										<div class="col-sm-6">
											<div class="form-group">
										<label>Designation <span class="text-danger">*</span></label>
										<select class="select" name="destination">
											<?php
										$depart_ID = $backoffice_row['department'];
										$SQDepartstr1="select * from department WHERE parent_id='$depart_ID' order by dep_name ASC";
										$ResultDepartstr1=mysqli_query($link,$SQDepartstr1);
										while($ListDepartstr1=mysqli_fetch_array($ResultDepartstr1)){
										?>
											<option value="<?php echo $ListDepartstr1['depart_id'];?>" <?php if($ListDepartstr1['depart_id']==$backoffice_row['destination']){?>selected<?php } ?>><?php echo $ListDepartstr1['dep_name'];?></option>
											<?php } ?>
											
										</select>
									</div>
						</div>
										
										
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Name of empployee <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="fullname" value="<?php echo $backoffice_row['fullname'];?>" required>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Email</label>
												<input type="email" name="email" class="form-control" value="<?php echo $backoffice_row['email'];?>" required>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Phone <span class="text-danger">*</span></label>
												<input type="text" name="phone" value="<?php echo $backoffice_row['phone'];?>" class="form-control" required>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Emirates ID Number <span class="text-danger">*</span></label>
												<input type="text" class="form-control" readonly name="emirateid"
												 value="<?php echo $backoffice_row['emirateid'];?>">
											</div>
										</div>
										
										
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
												<div class="cal-icon"><input name="dob" readonly  value="<?php echo $backoffice_row['dob'];?>" class="form-control datetimepicker" type="text"></div>
											</div>
										</div>

										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Emirates ID Expire <span class="text-danger">*</span></label>
												<input name="emerite_id_expire" class="form-control datetimepicker" value="<?php echo $backoffice_row['emerite_id_expire'];?>" type="text">
											</div>
										</div>
										
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Passport number <span class="text-danger">*</span></label>
												<input name="passport_number" class="form-control" type="text" value="<?php echo $backoffice_row['passport_number'];?>">
											</div>
										</div>
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Passport Expire <span class="text-danger">*</span></label>
												<input name="passport_expire" class="form-control datetimepicker" type="text" value="<?php echo $backoffice_row['passport_expire'];?>">
											</div>
										</div>
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">vissa number <span class="text-danger">*</span></label>
												<input name="vissa_number" class="form-control" type="text" value="<?php echo $backoffice_row['vissa_number'];?>">
											</div>
										</div>

										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">vissa Expire <span class="text-danger">*</span></label>
												<input name="vissa_expire" class="form-control datetimepicker" type="text" value="<?php echo $backoffice_row['vissa_expire'];?>">
											</div>
										</div>
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Visa Status <span class="text-danger">*</span></label>
												<input name="role" class="form-control" type="text" value="<?php echo $backoffice_row['role'];?>">
											</div>
										</div>

										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">City <span class="text-danger"></span></label>
												<input name="city" class="form-control" type="text" value="<?php echo $backoffice_row['city'];?>">
											</div>
										</div>
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Country <span class="text-danger"></span></label>
												<select name="country" class="form-control" required>
										<option value=""> Select Country</option>
											<?php
											$SQlcountry="select * from country  order by cname ASC"; 
													$Result_country=mysqli_query($link,$SQlcountry); 
														while($listCountry=mysqli_fetch_array($Result_country)){
											?>
											<option value="<?php echo $listCountry['country_id'];?>" <?php if($backoffice_row['country'] == $listCountry['country_id']){?>selected<?php } ?> > <?php echo $listCountry['cname'];?></option>
											<?php } ?>
										</select>
											</div>
										</div>
										
										
										
										
									
									<div class="submit-section">
									<input name="empid" class="form-control" value="<?php echo $backoffice_row['id'];?>" type="hidden">
										<button type="submit" name="update" class="btn btn-primary submit-btn">Submit</button>
									</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>



<?php } } ?>
						
					
						
					</div>
                </div>
				<!-- /Page Content -->
				
				<!-- Add Employee Modal -->
				<div id="add_employee" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Employee</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form form action="script/employe_script.php" name="Registerform" enctype="multipart/form-data" method="post">
								<div class="profile-img-wrap edit-img">
											
											<img class="inline-block" src="assets\img\user.jpg" alt="user">
																	  
																	  <div class="fileupload btn">
																		  <span class="btn-text">edit</span>
																	  
																		  <input type="file" class="upload" name="image"/>
											<input type="hidden" name="hiddenimage" value="" />
																	  </div>
																  </div>
									<div class="row">

									

									
										
										
										<div class="col-sm-6">
											<div class="form-group">
									<label class="bmd-label-floating">Empployee Type</label>
                        <select name="type_role" class="form-control">
                          <option value="">Empployee Type</option>
                          <?php
                           $counter_sql="select * from counter where admin_id='$customerchechlogin_id' order by countr ASC";
                           $counter_result=mysqli_query($link,$counter_sql);
                           while($counter_row=mysqli_fetch_array($counter_result)){
							   
                          ?>
                          <option value="<?php echo $counter_row['primary_role']; ?>"><?php echo $counter_row['countr']; ?></option>
                        <?php } ?>
                          
                        </select>
						</div>
						</div>
										
										
										<div class="col-sm-6">
											<div class="form-group">
										<label>Department <span class="text-danger">*</span></label>
										<select class="select" name="department" id="sel_depart">
											<option value="">Select Department</option>
											<?php
										
										$SQDepartstr="select * from department WHERE admin_id='$cont_hr_id' and parent_id='0' order by dep_name ASC";
										$ResultDepartstr=mysqli_query($link,$SQDepartstr);
										while($ListDepartstr=mysqli_fetch_array($ResultDepartstr)){
										?>
											<option value="<?php echo $ListDepartstr['depart_id'];?>"><?php echo $ListDepartstr['dep_name'];?></option>
											<?php } ?>
										</select>
									</div>
						</div>
										
										<div class="col-sm-6">
											<div class="form-group">
										<label>Designation <span class="text-danger">*</span></label>
										<select class="select" name="destination" id="sel_user">
											<option value="">Select Designation</option>
											
										</select>
									</div>
						</div>
										
										
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Name of empployee <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="fullname" required>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Email</label>
												<input type="email" name="email" class="form-control" required>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Phone <span class="text-danger">*</span></label>
												<input type="text" name="phone" class="form-control" required>
											</div>
										</div>
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
												<div class="cal-icon"><input name="dob" class="form-control datetimepicker" type="text"></div>
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="form-group">
												<label class="col-form-label">Emirates ID Number <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="emirateid">
											</div>
										</div>
										
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Emirates ID Expire <span class="text-danger">*</span></label>
												<input name="emerite_id_expire" class="form-control datetimepicker" type="text">
											</div>
										</div>
										
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Passport number <span class="text-danger">*</span></label>
												<input name="passport_number" class="form-control" type="text">
											</div>
										</div>
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Passport Expire <span class="text-danger">*</span></label>
												<input name="passport_expire" class="form-control datetimepicker" type="text">
											</div>
										</div>
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">vissa number <span class="text-danger">*</span></label>
												<input name="vissa_number" class="form-control" type="text">
											</div>
										</div>

										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">vissa Expire <span class="text-danger">*</span></label>
												<input name="vissa_expire" class="form-control datetimepicker" type="text">
											</div>
										</div>
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Visa Status <span class="text-danger">*</span></label>
												<input name="role" class="form-control" type="text">
											</div>
										</div>

										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">City <span class="text-danger"></span></label>
												<input name="city" class="form-control" type="text">
											</div>
										</div>
										
										<div class="col-sm-6">  
											<div class="form-group">
												<label class="col-form-label">Country <span class="text-danger"></span></label>
												<select name="country" class="form-control" required>
										<option value=""> Select Country</option>
											<?php
											$SQlcountry="select * from country order by cname ASC"; 
													$Result_country=mysqli_query($link,$SQlcountry); 
														while($listCountry=mysqli_fetch_array($Result_country)){
											?>
											<option value="<?php echo $listCountry['country_id'];?>"> <?php echo $listCountry['cname'];?></option>
											<?php } ?>
										</select>
											</div>
										</div>
										
										
									
									<div class="submit-section">
										<input type="hidden" name="admin_id" value="<?php echo $customerchechlogin_id;?>">
										<button type="submit" name="add" class="btn btn-primary submit-btn">Submit</button>
									</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Employee Modal -->
				
				<!-- Edit Employee Modal -->
				
				<!-- /Edit Employee Modal -->
				
				<!-- Delete Employee Modal -->
				
				<!-- /Delete Employee Modal -->
				
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