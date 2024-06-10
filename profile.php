<?php
include( "config.php" );
ob_start();
$pagesetting = basename( $_SERVER[ 'PHP_SELF' ] );
if ( isset( $_SESSION[ 'id' ] ) ) {
  $customerchechlogin_id = $_SESSION[ 'id' ];
} else {
  $customerchechlogin_id = "0";
  header( "Location:login.php" );
  ob_end_flush();
}
$customerchechlogin_sql = "select * from users WHERE id=$customerchechlogin_id";
$customerchechlogin_resu = mysqli_query( $link, $customerchechlogin_sql );
$customerchechlogin_row = mysqli_fetch_array( $customerchechlogin_resu );

$personal_info_sql = "select * from personal_info WHERE profile_id=$customerchechlogin_id";
$personal_info_resu = mysqli_query($link, $personal_info_sql);
$listinfo_row = mysqli_fetch_array( $personal_info_resu );

$emegency_contact_sql = "select * from emegency_contact WHERE profile_id=$customerchechlogin_id";
$emegency_contact_resu = mysqli_query($link, $emegency_contact_sql);
$listemegency_contact_row = mysqli_fetch_array( $emegency_contact_resu);

$bank_details_sql = "select * from bank_details WHERE profile_id=$customerchechlogin_id";
$bank_details_resu = mysqli_query($link, $bank_details_sql);
$listbank_details_row = mysqli_fetch_array( $bank_details_resu);

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
        <div class="row">
          <div class="col-sm-12">
            <h3 class="page-title">Profile</h3>
            <ul class="breadcrumb">
				<?php if($customerchechlogin_row['account_type'] == '1' || $primiaryRole == 'hr' && $customerchechlogin_row[ 'account_type' ] == $counterID){?>
				<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
		  <?php }else{ ?>
			   <li class="breadcrumb-item"><a href="emloyee-dashboard.php"> Dashboard</a></li>
			  <?php } ?>
             
              <li class="breadcrumb-item active">Profile</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /Page Header -->
      
      <div class="card mb-0">
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <div class="profile-view">
                <div class="profile-img-wrap">
                  <div class="profile-img">
                    <?php if($customerchechlogin_row['image']!='') { ?>
                    <img class="inline-block" src="uploads/<?php echo $customerchechlogin_row['image'];?>" />
                    <?php } else{ ?>
                    <img class="inline-block" src="assets\img\user.jpg" alt="user">
                    <?php } ?>
                  </div>
                </div>
                <div class="profile-basic">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="profile-info-left">
                        <h3 class="user-name m-t-0 mb-0"><?php echo $customerchechlogin_row['fullname'];?></h3>
                        
						<?php if($customerchechlogin_row['emirateid']){?>  
                        <div class="staff-id">Emirate ID : <?php echo $customerchechlogin_row['emirateid'];?></div>
						  <?php } ?>
                        <!--div class="staff-msg"><a class="btn btn-custom" href="chat.html">Send Message</a></div-->
                      </div>
                    </div>
                    <div class="col-md-7">
                      <ul class="personal-info">
                        <li>
                          <div class="title">Phone:</div>
                          <div class="text"><a href=""><?php echo $customerchechlogin_row['phone'];?></a></div>
                        </li>
                        <li>
                          <div class="title">Email:</div>
                          <div class="text"><a href=""><?php echo $customerchechlogin_row['email'];?></a></div>
                        </li>
                        <li>
                          <div class="title">Birthday:</div>
                          <div class="text"><?php echo $customerchechlogin_row['dob'];?></div>
                        </li>
                        <li>
                          <div class="title">Address:</div>
                          <div class="text"><?php echo $customerchechlogin_row['address'];?></div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card tab-box">
        <div class="row user-tabs">
          <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
            <ul class="nav nav-tabs nav-tabs-bottom">
              <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
              <li class="nav-item"><a href="#emp_projects" data-toggle="tab" class="nav-link">Projects</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="tab-content"> 
        
        <!-- Profile Info Tab -->
        <div id="emp_profile" class="pro-overview tab-pane fade show active">
          <div class="row">
            <div class="col-md-6 d-flex">
              <div class="card profile-box flex-fill">
                <div class="card-body">
                  <h3 class="card-title">Personal Informations 
					  <?php if($listinfo_row['status']!='0'){?>
					  <a href="#" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a>
					<?php } ?>
					</h3>
					<?php if($listinfo_row['status']=='1'){?>
					<ul class="personal-info">
					<?php if($listinfo_row['passportno']){?>	
                    <li>
                      <div class="title">Passport No.</div>
                      <div class="text"><?php echo $listinfo_row['passportno'];?></div>
                    </li>
						<?php } ?>
						<?php if($listinfo_row['expire_date']){?>
                    <li>
                      <div class="title">Passport Exp Date.</div>
                      <div class="text"><?php echo $listinfo_row['expire_date'];?></div>
                    </li>
						<?php } ?>
					<?php if($listinfo_row['tel_phone']){?>	
                    <li>
                      <div class="title">Tel</div>
                      <div class="text"><a href=""><?php echo $listinfo_row['tel_phone'];?></a></div>
                    </li>
					<?php } ?>
					<?php if($listinfo_row['nationality']){?>		
                    <li>
                      <div class="title">Nationality</div>
                      <div class="text"><?php echo $listinfo_row['nationality'];?></div>
                    </li>
						<?php } ?>
					<?php if($listinfo_row['religion']){?>	
                    <li>
                      <div class="title">Religion</div>
                      <div class="text"><?php echo $listinfo_row['religion'];?></div>
                    </li>
					<?php } ?>
					<?php if($listinfo_row['marital_status']){?>		
                    <li>
                      <div class="title">Marital status</div>
                      <div class="text"><?php echo $listinfo_row['marital_status'];?></div>
                    </li>
					<?php } ?>
					<?php if($listinfo_row['employment_of_pouse']){?>		
                    <li>
                      <div class="title">Employment of spouse</div>
                      <div class="text"><?php echo $listinfo_row['employment_of_pouse'];?></div>
                    </li>
						<?php } ?>
					<?php if($listinfo_row['no_of_child']){?>	
                    <li>
                      <div class="title">No. of children</div>
                      <div class="text"><?php echo $listinfo_row['no_of_child'];?></div>
                    </li>
					<?php } ?>	
                  </ul>
					<?php } else if($listinfo_row['status']=='0'){?>
					<div class="alert alert-info alert-dismissible fade show" role="alert">
								<strong>Hi <?php echo $customerchechlogin_row['fullname'];?>!</strong> Personal Informations update sucessfuly. Please wait for HR Aprove.
								
							</div>
					<p></p>
					<?php } ?>
                  
                </div>
              </div>
            </div>
            <div class="col-md-6 d-flex">
              <div class="card profile-box flex-fill">
                <div class="card-body">
                  <h3 class="card-title">Emergency Contact 
					<?php if($listemegency_contact_row['status']!='0'){?>
					  <a href="#" class="edit-icon" data-toggle="modal" data-target="#emergency_contact_modal"><i class="fa fa-pencil"></i></a>
					<?php } ?>
					  
					
					</h3>
                  
					<?php if($listemegency_contact_row['status']=='1'){?>
					<?php if($listemegency_contact_row['ref_name'] && $listemegency_contact_row['phone']){?>
					<h5 class="section-title">Primary</h5>
                  <ul class="personal-info">
                    <li>
                      <div class="title">Name</div>
                      <div class="text"><?php echo $listemegency_contact_row['ref_name'];?></div>
                    </li>
					  <?php if($listemegency_contact_row['relationship']){?>
                    <li>
                      <div class="title">Relationship</div>
                      <div class="text"><?php echo $listemegency_contact_row['relationship'];?></div>
                    </li>
					  <?php } ?>
                    <li>
                      <div class="title">Phone </div>
                      <div class="text"><?php echo $listemegency_contact_row['phone'];?>,<?php echo $listemegency_contact_row['altphone'];?></div>
                    </li>
                  </ul>
					<?php } ?>
					<?php if($listemegency_contact_row['ref_name2'] && $listemegency_contact_row['phone2']){?>
                  <hr>
                  <h5 class="section-title">Secondary</h5>
					
                  <ul class="personal-info">
                    <li>
                      <div class="title">Name</div>
                      <div class="text"><?php echo $listemegency_contact_row['ref_name2'];?></div>
                    </li>
                    <li>
                      <div class="title">Relationship</div>
                      <div class="text"><?php echo $listemegency_contact_row['relationship2'];?></div>
                    </li>
                    <li>
                      <div class="title">Phone </div>
                      <div class="text"><?php echo $listemegency_contact_row['phone2'];?>,<?php echo $listemegency_contact_row['altphone2'];?></div>
                    </li>
                  </ul>
					
					<?php } ?>
					<?php } else if($listemegency_contact_row['status']=='0'){?>
					<div class="alert alert-info alert-dismissible fade show" role="alert">
								<strong>Hi <?php echo $customerchechlogin_row['fullname'];?>!</strong> Emergency Contact update sucessfuly. Please wait for HR Aprove.
								
							</div>
					<p></p>
					<?php } ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 d-flex">
              <div class="card profile-box flex-fill">
                <div class="card-body">
					
					<?php if($listbank_details_row['status']!='0'){?>
					  <a href="#" class="edit-icon" data-toggle="modal" data-target="#bankinformation"><i class="fa fa-pencil"></i></a>
					<?php } ?>
                  <h3 class="card-title">Bank information</h3>
					<?php if($listbank_details_row['status']=='1'){?>
					<?php if($listbank_details_row['bank_name'] && $listbank_details_row['bank_no']){?>
                  <ul class="personal-info">
					 <?php if($listbank_details_row['bank_name']){?> 
                    <li>
                      <div class="title">Bank name</div>
                      <div class="text"><?php echo $listbank_details_row['bank_name'];?></div>
                    </li>
					  <?php } ?>
					  
					  <?php if($listbank_details_row['bank_no']){?> 
                    <li>
                      <div class="title">Bank account No.</div>
                      <div class="text"><?php echo $listbank_details_row['bank_no'];?></div>
                    </li>
					 <?php } ?>
					  <?php if($listbank_details_row['ifsc_code']){?> 
                    <li>
                      <div class="title">IBAN Code</div>
                      <div class="text"><?php echo $listbank_details_row['ifsc_code'];?></div>
                    </li>
					  <?php } ?>
					  <?php if($listbank_details_row['pan_no']){?> 
                    <li>
                      <div class="title">Branch Name</div>
                      <div class="text"><?php echo $listbank_details_row['pan_no'];?></div>
                    </li>
					 <?php } ?>  
                  </ul>
					<?php } ?>
					<?php } else if($listbank_details_row['status']=='0'){?>
					<div class="alert alert-info alert-dismissible fade show" role="alert">
								<strong>Hi <?php echo $customerchechlogin_row['fullname'];?>!</strong> Bank information submitted succesfully for HR approval.
								
							</div>
					<p></p>
					<?php } ?>
                </div>
              </div>
            </div>
            <div class="col-md-6 d-flex">
              <div class="card profile-box flex-fill">
                <div class="card-body">
                  <h3 class="card-title">Family Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#family_info_modal"><i class="fa fa-plus"></i></a></h3>
                  <div class="table-responsive">
                    <table class="table table-nowrap">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Relationship</th>
                          <th>Date of Birth</th>
                          <th>Phone</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
<?php
$familiy_info_sql = "select * from familiy_info WHERE profile_id=$customerchechlogin_id";
$familiy_info_resu = mysqli_query($link, $familiy_info_sql);
while($familiy_info_row = mysqli_fetch_array( $familiy_info_resu)){
?>
                        <tr>
                          <td><?php echo $familiy_info_row['fam_name'];?></td>
                          <td><?php echo $familiy_info_row['fam_realtion'];?></td>
                          <td><?php echo $familiy_info_row['fam_dob'];?></td>
                          <td><?php echo $familiy_info_row['fam_phone'];?></td>
                          <td class="text-right"><div class="dropdown dropdown-action"> <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                              <div class="dropdown-menu dropdown-menu-right"> <a href="#" data-target="#edit_family_info_modal<?php echo $familiy_info_row['fam_id'];?>" data-toggle="modal" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a> <a href="#" class="dropdown-item" data-target="#delete_salary<?php echo $familiy_info_row['fam_id'];?>" data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a> </div>
                            </div>
							
							</td>
                        </tr>
						  <div id="edit_family_info_modal<?php echo $familiy_info_row['fam_id'];?>" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"> Family Informations</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form action="script/family_info_script.php" method="post">
              <div class="form-scroll">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Family Member</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Name <span class="text-danger">*</span></label>
                          <input class="form-control" name="fam_name" value="<?php echo $familiy_info_row['fam_name'];?>" type="text">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Relationship <span class="text-danger">*</span></label>
                          <input class="form-control" name="fam_realtion" value="<?php echo $familiy_info_row['fam_realtion'];?>" type="text">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Date of birth <span class="text-danger">*</span></label>
                          <input class="form-control" name="fam_dob" value="<?php echo $familiy_info_row['fam_dob'];?>" type="text">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Phone <span class="text-danger">*</span></label>
                          <input class="form-control" name="fam_phone" value="<?php echo $familiy_info_row['fam_phone'];?>" type="text">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="submit-section">
				  <input type="hidden" name="fam_id" value="<?php echo $familiy_info_row['fam_id'];?>">
                <button class="btn btn-primary submit-btn" type="submit" name="family_update_btn">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
						  
						  	<div class="modal custom-modal fade" id="delete_salary<?php echo $familiy_info_row['fam_id'];?>" role="dialog">
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
											<a href="script/family_info_script.php?del=<?php echo $familiy_info_row['fam_id'];?>" class="btn btn-primary continue-btn">Delete</a>
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
						  
						  <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 d-flex">
              <div class="card profile-box flex-fill">
                <div class="card-body">
                  <h3 class="card-title">Education Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#education_info"><i class="fa fa-plus"></i></a></h3>
                  <div class="experience-box">
                    <ul class="experience-list">
						<?php
$education_details_sql = "select * from education_details WHERE profile_id=$customerchechlogin_id";
$education_details_resu = mysqli_query($link, $education_details_sql);
while($education_details_row = mysqli_fetch_array( $education_details_resu)){
?>
                      <li>
						    <div align="right" class="dropdown dropdown-action"> <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                              <div class="dropdown-menu dropdown-menu-right"> <a href="#" data-target="#edit_education_info<?php echo $education_details_row['edu_id'];?>" data-toggle="modal" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a> <a href="#" class="dropdown-item" data-target="#delete_salary<?php echo $education_details_row['edu_id'];?>" data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a> </div>
                            </div>
                        <div class="experience-user">
                          <div class="before-circle"></div>
                        </div>
                        <div class="experience-content">
                          <div class="timeline-content"> <a href="" class="name"><?php echo $education_details_row['institution'];?></a>
                            <div><?php echo $education_details_row['degree'];?> <?php echo $education_details_row['subject'];?> - <?php echo $education_details_row['grade'];?></div>
                            <span class="time"><?php echo $education_details_row['starting_date'];?> - <?php echo $education_details_row['complate_date'];?></span> </div>
                        </div>
						  
						
                      </li>
						
						<div class="modal custom-modal fade" id="delete_salary<?php echo $education_details_row['edu_id'];?>" role="dialog">
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
											<a href="script/education_info_script.php?del=<?php echo $education_details_row['edu_id'];?>" class="btn btn-primary continue-btn">Delete</a>
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
						<div id="edit_education_info<?php echo $education_details_row['edu_id'];?>" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"> Education Informations</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form action="script/education_info_script.php" method="post">
              <div class="form-scroll">
                <div class="card">
                  <div class="card-body">
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group form-focus focused">
                          <input type="text" name="institution" value="<?php echo $education_details_row['institution'];?>" class="form-control floating">
                          <label class="focus-label">Institution</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus focused">
                          <input type="text" name="subject" value="<?php echo $education_details_row['subject'];?>" class="form-control floating">
                          <label class="focus-label">Subject</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus focused">
                          <div class="cal-icon">
                            <input type="text" name="starting_date" value="<?php echo $education_details_row['starting_date'];?>" class="form-control floating datetimepicker">
                          </div>
                          <label class="focus-label">Starting Date</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus focused">
                          <div class="cal-icon">
                            <input type="text" name="complate_date" value="<?php echo $education_details_row['complate_date'];?>" class="form-control floating datetimepicker">
                          </div>
                          <label class="focus-label">Complete Date</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus focused">
                          <input type="text" name="degree" value="<?php echo $education_details_row['degree'];?>" class="form-control floating">
                          <label class="focus-label">Degree</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus focused">
                          <input type="text" name="grade" value="<?php echo $education_details_row['grade'];?>" class="form-control floating">
                          <label class="focus-label">Grade</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="submit-section">
				  <input type="hidden" name="edu_id" value="<?php echo $education_details_row['edu_id'];?>">
                <button class="btn btn-primary submit-btn" type="submit" name="educ_update_button">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
						
						<?php } ?>
                      
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 d-flex">
              <div class="card profile-box flex-fill">
                <div class="card-body">
                  <h3 class="card-title">Experience <a href="#" class="edit-icon" data-toggle="modal" data-target="#experience_info"><i class="fa fa-plus"></i></a></h3>
                  <div class="experience-box">
                    <ul class="experience-list">
						
					<?php
$exp_details_sql = "select * from experience_info WHERE profile_id=$customerchechlogin_id";
$exp_details_resu = mysqli_query($link, $exp_details_sql);
while($exp_details_row = mysqli_fetch_array( $exp_details_resu)){
?>	
                      <li>
						   <div align="right" class="dropdown dropdown-action"> <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                              <div class="dropdown-menu dropdown-menu-right"> <a href="#" data-target="#edit_experience_info<?php echo $exp_details_row['exp_id'];?>" data-toggle="modal" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a> <a href="#" class="dropdown-item" data-target="#delete_salary<?php echo $exp_details_row['exp_id'];?>" data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a> </div>
                            </div>
                        <div class="experience-user">
                          <div class="before-circle"></div>
                        </div>
                        <div class="experience-content">
                          <div class="timeline-content"> <a href="#/" class="name"><?php echo $exp_details_row['job_position'];?> at <?php echo $exp_details_row['company_name'];?></a> <span class="time"><?php echo $exp_details_row['period_form'];?> - <?php echo $exp_details_row['period_to'];?></span> </div>
                        </div>
						  
                      </li>
						
						<div class="modal custom-modal fade" id="delete_salary<?php echo $exp_details_row['exp_id'];?>" role="dialog">
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
											<a href="script/experience_info_script.php?del=<?php echo $exp_details_row['exp_id'];?>" class="btn btn-primary continue-btn">Delete</a>
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
						
						
                      <div id="edit_experience_info<?php echo $exp_details_row['exp_id'];?>" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Experience Informations</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form method="post" action="script/experience_info_script.php">
              <div class="form-scroll">
                <div class="card">
                  <div class="card-body">
                   
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group form-focus">
                          <input type="text" class="form-control floating" name="company_name" value="<?php echo $exp_details_row['company_name'];?>">
                          <label class="focus-label">Company Name</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus">
                          <input type="text" class="form-control floating" name="location" value="<?php echo $exp_details_row['location'];?>">
                          <label class="focus-label">Location</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus">
                          <input type="text" class="form-control floating" name="job_position" value="<?php echo $exp_details_row['job_position'];?>">
                          <label class="focus-label">Job Position</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus">
                          <div class="cal-icon">
                            <input type="text" class="form-control floating datetimepicker" name="period_form" value="<?php echo $exp_details_row['period_form'];?>">
                          </div>
                          <label class="focus-label">Period From</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus">
                          <div class="cal-icon">
                            <input type="text" class="form-control floating datetimepicker" name="period_to" value="<?php echo $exp_details_row['period_to'];?>">
                          </div>
                          <label class="focus-label">Period To</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="submit-section">
				  <input type="hidden" name="exp_id" value="<?php echo $exp_details_row['exp_id'];?>">
                <button class="btn btn-primary submit-btn" type="submit" name="exp_update_button">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
                     <?php } ?> 
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /Profile Info Tab --> 
        
        <!-- Projects Tab -->
        <div class="tab-pane fade" id="emp_projects">
          <div class="row">
            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
              <div class="card">
                <div class="card-body">
                  <div class="dropdown profile-action"> <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right"> <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a> <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a> </div>
                  </div>
                  <h4 class="project-title"><a href="project-view.html">Office Management</a></h4>
                  <small class="block text-ellipsis m-b-15"> <span class="text-xs">1</span> <span class="text-muted">open tasks, </span> <span class="text-xs">9</span> <span class="text-muted">tasks completed</span> </small>
                  <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. When an unknown printer took a galley of type and
                    scrambled it... </p>
                  <div class="pro-deadline m-b-15">
                    <div class="sub-title"> Deadline: </div>
                    <div class="text-muted"> 17 Apr 2019 </div>
                  </div>
                  <div class="project-members m-b-15">
                    <div>Project Leader :</div>
                    <ul class="team-members">
                      <li> <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets\img\profiles\avatar-16.jpg"></a> </li>
                    </ul>
                  </div>
                  <div class="project-members m-b-15">
                    <div>Team :</div>
                    <ul class="team-members">
                      <li> <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="assets\img\profiles\avatar-02.jpg"></a> </li>
                      <li> <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="assets\img\profiles\avatar-09.jpg"></a> </li>
                      <li> <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="assets\img\profiles\avatar-10.jpg"></a> </li>
                      <li> <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="assets\img\profiles\avatar-05.jpg"></a> </li>
                      <li> <a href="#" class="all-users">+15</a> </li>
                    </ul>
                  </div>
                  <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                  <div class="progress progress-xs mb-0">
                    <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
              <div class="card">
                <div class="card-body">
                  <div class="dropdown profile-action"> <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right"> <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a> <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a> </div>
                  </div>
                  <h4 class="project-title"><a href="project-view.html">Project Management</a></h4>
                  <small class="block text-ellipsis m-b-15"> <span class="text-xs">2</span> <span class="text-muted">open tasks, </span> <span class="text-xs">5</span> <span class="text-muted">tasks completed</span> </small>
                  <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. When an unknown printer took a galley of type and
                    scrambled it... </p>
                  <div class="pro-deadline m-b-15">
                    <div class="sub-title"> Deadline: </div>
                    <div class="text-muted"> 17 Apr 2019 </div>
                  </div>
                  <div class="project-members m-b-15">
                    <div>Project Leader :</div>
                    <ul class="team-members">
                      <li> <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets\img\profiles\avatar-16.jpg"></a> </li>
                    </ul>
                  </div>
                  <div class="project-members m-b-15">
                    <div>Team :</div>
                    <ul class="team-members">
                      <li> <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="assets\img\profiles\avatar-02.jpg"></a> </li>
                      <li> <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="assets\img\profiles\avatar-09.jpg"></a> </li>
                      <li> <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="assets\img\profiles\avatar-10.jpg"></a> </li>
                      <li> <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="assets\img\profiles\avatar-05.jpg"></a> </li>
                      <li> <a href="#" class="all-users">+15</a> </li>
                    </ul>
                  </div>
                  <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                  <div class="progress progress-xs mb-0">
                    <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
              <div class="card">
                <div class="card-body">
                  <div class="dropdown profile-action"> <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right"> <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a> <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a> </div>
                  </div>
                  <h4 class="project-title"><a href="project-view.html">Video Calling App</a></h4>
                  <small class="block text-ellipsis m-b-15"> <span class="text-xs">3</span> <span class="text-muted">open tasks, </span> <span class="text-xs">3</span> <span class="text-muted">tasks completed</span> </small>
                  <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. When an unknown printer took a galley of type and
                    scrambled it... </p>
                  <div class="pro-deadline m-b-15">
                    <div class="sub-title"> Deadline: </div>
                    <div class="text-muted"> 17 Apr 2019 </div>
                  </div>
                  <div class="project-members m-b-15">
                    <div>Project Leader :</div>
                    <ul class="team-members">
                      <li> <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets\img\profiles\avatar-16.jpg"></a> </li>
                    </ul>
                  </div>
                  <div class="project-members m-b-15">
                    <div>Team :</div>
                    <ul class="team-members">
                      <li> <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="assets\img\profiles\avatar-02.jpg"></a> </li>
                      <li> <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="assets\img\profiles\avatar-09.jpg"></a> </li>
                      <li> <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="assets\img\profiles\avatar-10.jpg"></a> </li>
                      <li> <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="assets\img\profiles\avatar-05.jpg"></a> </li>
                      <li> <a href="#" class="all-users">+15</a> </li>
                    </ul>
                  </div>
                  <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                  <div class="progress progress-xs mb-0">
                    <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
              <div class="card">
                <div class="card-body">
                  <div class="dropdown profile-action"> <a aria-expanded="false" data-toggle="dropdown" class="action-icon dropdown-toggle" href="#"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right"> <a data-target="#edit_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-pencil m-r-5"></i> Edit</a> <a data-target="#delete_project" data-toggle="modal" href="#" class="dropdown-item"><i class="fa fa-trash-o m-r-5"></i> Delete</a> </div>
                  </div>
                  <h4 class="project-title"><a href="project-view.html">Hospital Administration</a></h4>
                  <small class="block text-ellipsis m-b-15"> <span class="text-xs">12</span> <span class="text-muted">open tasks, </span> <span class="text-xs">4</span> <span class="text-muted">tasks completed</span> </small>
                  <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry. When an unknown printer took a galley of type and
                    scrambled it... </p>
                  <div class="pro-deadline m-b-15">
                    <div class="sub-title"> Deadline: </div>
                    <div class="text-muted"> 17 Apr 2019 </div>
                  </div>
                  <div class="project-members m-b-15">
                    <div>Project Leader :</div>
                    <ul class="team-members">
                      <li> <a href="#" data-toggle="tooltip" title="Jeffery Lalor"><img alt="" src="assets\img\profiles\avatar-16.jpg"></a> </li>
                    </ul>
                  </div>
                  <div class="project-members m-b-15">
                    <div>Team :</div>
                    <ul class="team-members">
                      <li> <a href="#" data-toggle="tooltip" title="John Doe"><img alt="" src="assets\img\profiles\avatar-02.jpg"></a> </li>
                      <li> <a href="#" data-toggle="tooltip" title="Richard Miles"><img alt="" src="assets\img\profiles\avatar-09.jpg"></a> </li>
                      <li> <a href="#" data-toggle="tooltip" title="John Smith"><img alt="" src="assets\img\profiles\avatar-10.jpg"></a> </li>
                      <li> <a href="#" data-toggle="tooltip" title="Mike Litorus"><img alt="" src="assets\img\profiles\avatar-05.jpg"></a> </li>
                      <li> <a href="#" class="all-users">+15</a> </li>
                    </ul>
                  </div>
                  <p class="m-b-5">Progress <span class="text-success float-right">40%</span></p>
                  <div class="progress progress-xs mb-0">
                    <div style="width: 40%" title="" data-toggle="tooltip" role="progressbar" class="progress-bar bg-success" data-original-title="40%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /Projects Tab --> 
        
        <!-- Bank Statutory Tab -->
        
        <!-- /Bank Statutory Tab --> 
        
      </div>
    </div>
    <!-- /Page Content --> 
    
    <!-- Profile Modal -->
    <div id="profile_info" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Profile Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form name="profileupdate" method="post" action="script/profileup.php" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12">
                  <div class="profile-img-wrap edit-img">
                    <?php if($customerchechlogin_row['image']!='') { ?>
                    <img class="inline-block" src="uploads/<?php echo $customerchechlogin_row['image'];?>" />
                    <?php } else{ ?>
                    <img class="inline-block" src="assets\img\user.jpg" alt="user">
                    <?php } ?>
                    <div class="fileupload btn"> <span class="btn-text">edit</span>
                      <input type="file" class="upload" name="image"/>
                      <input type="hidden" name="hiddenimage" value="<?php echo $customerchechlogin_row['image']; ?>" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="fullname" class="form-control" 
														value="<?php echo $customerchechlogin_row['fullname'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Birth Date</label>
                        <div class="cal-icon">
                          <input class="form-control datetimepicker" name="dob" type="text" 
															value="<?php echo $customerchechlogin_row['dob'];?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $customerchechlogin_row['phone'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Emirate ID</label>
                        <input type="text" name="emirateid" class="form-control" value="<?php echo $customerchechlogin_row['emirateid'];?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $customerchechlogin_row['address'];?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control" name="country" value="<?php echo $customerchechlogin_row['country'];?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control"
												 value="<?php echo $customerchechlogin_row['city'];?>">
                  </div>
                </div>
              </div>
              <div class="submit-section">
                <input type="hidden" name="cusid" value="<?php echo $customerchechlogin_row['id'];?>">
                <button class="btn btn-primary submit-btn" name="profup">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /Profile Modal --> 
    
    <!-- Personal Info Modal -->
    <div id="personal_info_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Personal Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form method="post" action="script/employepersonal_script.php">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Passport No</label>
                    <input type="text" name="passportno" value="<?php echo $listinfo_row['passportno']?>" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Passport Expiry Date</label>
                    <div class="cal-icon">
                      <input class="form-control datetimepicker" name="expire_date" value="<?php echo $listinfo_row['expire_date']?>" type="text">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tel</label>
                    <input class="form-control" name="tel_phone" value="<?php echo $listinfo_row['tel_phone']?>" type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nationality <span class="text-danger">*</span></label>
                    <input class="form-control" name="nationality" value="<?php echo $listinfo_row['nationality']?>" type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Religion</label>
                    <div class="cal-icon">
                      <input class="form-control" name="religion" value="<?php echo $listinfo_row['religion']?>" type="text">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Marital status <span class="text-danger">*</span></label>
                    <select class="select form-control" name="marital_status" required>
                      <option value="">-</option>
                      <option value="single">Single</option>
                      <option value="married">Married</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Employment of spouse</label>
                    <input class="form-control" name="employment_of_pouse" value="<?php echo $listinfo_row['employment_of_pouse']?>" type="text">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>No. of children </label>
                    <input class="form-control" name="no_of_child" value="<?php echo $listinfo_row['no_of_child']?>" type="text">
                  </div>
                </div>
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn" type="submit" name="add_personal">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /Personal Info Modal --> 
    
	  <div id="bankinformation" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"> Bank information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form action="script/bank_info_script.php" method="post">
              <div class="form-scroll">
                <div class="card">
                  <div class="card-body">
					  <?php if($listbank_details_row['bank_name']){?>	
					
                        <div class="form-group">
                          <h4>CURRENT BANK DETAILS</h4>
                          	<p>
							Bank Name : <?php echo $listbank_details_row['bank_name'];?><br>
							Bank account No : <?php echo $listbank_details_row['bank_no'];?><br>
							IBAN Code : <?php echo $listbank_details_row['ifsc_code'];?><br>
							Branch Name : <?php echo $listbank_details_row['pan_no'];?>
							</p>
							
                       
                      </div>
						<?php } ?>
                   <h4>ADD NEW BANK DETAILS</h4>
					  
                    <div class="row">
					
					 <textarea name="old_bank_details" hidden="" class="form-control">Bank Name : <?php echo $listbank_details_row['bank_name'];?>, Bank account No : <?php echo $listbank_details_row['bank_no'];?>, IBAN Code : <?php echo $listbank_details_row['ifsc_code'];?>
							</textarea>
						
						
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Bank name <span class="text-danger">*</span></label>
                          <input class="form-control" name="bank_name" type="text">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Bank account No. <span class="text-danger">*</span></label>
                          <input class="form-control" name="bank_no" type="text">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>IBAN Code <span class="text-danger">*</span></label>
                          <input class="form-control" name="ifsc_code"  type="text">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Branch Name <span class="text-danger">*</span></label>
                          <input class="form-control" name="pan_no" value="<?php echo $listbank_details_row['pan_no'];?>" type="text">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn" type="submit" name="bank_details">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
	  
	  
    <!-- Family Info Modal -->
    <div id="family_info_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"> Family Informations</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form action="script/family_info_script.php" method="post">
              <div class="form-scroll">
                <div class="card">
                  <div class="card-body">
                    <h3 class="card-title">Family Member</h3>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Name <span class="text-danger">*</span></label>
                          <input class="form-control" name="fam_name" type="text">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Relationship <span class="text-danger">*</span></label>
                          <input class="form-control" name="fam_realtion" type="text">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Date of birth <span class="text-danger">*</span></label>
                          <input class="form-control" name="fam_dob" type="text">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Phone <span class="text-danger">*</span></label>
                          <input class="form-control" name="fam_phone" type="text">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn" type="submit" name="family_add_btn">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /Family Info Modal --> 
    
    <!-- Emergency Contact Modal -->
    <div id="emergency_contact_modal" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Emergency Contact</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form method="post" action="script/primary_contact_script.php">
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Primary Contact</h3>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="ref_name" class="form-control" value="<?php echo $listemegency_contact_row['ref_name'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Relationship <span class="text-danger">*</span></label>
                        <input class="form-control" name="relationship" type="text" value="<?php echo $listemegency_contact_row['relationship'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone <span class="text-danger">*</span></label>
                        <input class="form-control" name="phone" type="text" value="<?php echo $listemegency_contact_row['phone'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone 2</label>
                        <input class="form-control" name="altphone" type="text" value="<?php echo $listemegency_contact_row['altphone'];?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h3 class="card-title">Secondary Contact</h3>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="ref_name2" class="form-control" value="<?php echo $listemegency_contact_row['ref_name2'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Relationship <span class="text-danger">*</span></label>
                        <input class="form-control" name="relationship2" type="text" value="<?php echo $listemegency_contact_row['relationship2'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone <span class="text-danger">*</span></label>
                        <input class="form-control" name="phone2" type="text" value="<?php echo $listemegency_contact_row['phone2'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Phone 2</label>
                        <input class="form-control" name="altphone2" type="text" value="<?php echo $listemegency_contact_row['altphone2'];?>">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn" name="add_personal">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /Emergency Contact Modal --> 
    
    <!-- Education Modal -->
    <div id="education_info" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"> Education Informations</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form action="script/education_info_script.php" method="post">
              <div class="form-scroll">
                <div class="card">
                  <div class="card-body">
                    
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group form-focus focused">
                          <input type="text" name="institution" class="form-control floating">
                          <label class="focus-label">Institution</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus focused">
                          <input type="text" name="subject" class="form-control floating">
                          <label class="focus-label">Subject</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus focused">
                          <div class="cal-icon">
                            <input type="text" name="starting_date" class="form-control floating datetimepicker">
                          </div>
                          <label class="focus-label">Starting Date</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus focused">
                          <div class="cal-icon">
                            <input type="text" name="complate_date" class="form-control floating datetimepicker">
                          </div>
                          <label class="focus-label">Complete Date</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus focused">
                          <input type="text" name="degree" class="form-control floating">
                          <label class="focus-label">Degree</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus focused">
                          <input type="text" name="grade" class="form-control floating">
                          <label class="focus-label">Grade</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn" type="submit" name="educ_ad_button">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /Education Modal --> 
    
    <!-- Experience Modal -->
    <div id="experience_info" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Experience Informations</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form method="post" action="script/experience_info_script.php">
              <div class="form-scroll">
                <div class="card">
                  <div class="card-body">
                   
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group form-focus">
                          <input type="text" class="form-control floating" name="company_name">
                          <label class="focus-label">Company Name</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus">
                          <input type="text" class="form-control floating" name="location">
                          <label class="focus-label">Location</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus">
                          <input type="text" class="form-control floating" name="job_position">
                          <label class="focus-label">Job Position</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus">
                          <div class="cal-icon">
                            <input type="text" class="form-control floating datetimepicker" name="period_form">
                          </div>
                          <label class="focus-label">Period From</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group form-focus">
                          <div class="cal-icon">
                            <input type="text" class="form-control floating datetimepicker" name="period_to">
                          </div>
                          <label class="focus-label">Period To</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn" type="submit" name="add_experience">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /Experience Modal --> 
    
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

<!-- Datetimepicker JS --> 
<script src="assets\js\moment.min.js"></script> 
<script src="assets\js\bootstrap-datetimepicker.min.js"></script> 

<!-- Tagsinput JS --> 
<script src="assets\plugins\bootstrap-tagsinput\bootstrap-tagsinput.min.js"></script> 

<!-- Custom JS --> 
<script src="assets\js\app.js"></script>
</body>
</html>