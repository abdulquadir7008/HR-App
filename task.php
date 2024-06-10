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

if(isset($_REQUEST['proj'])){
	$projreq = $_REQUEST['proj'];
}
else
{
	$projreq='';
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
$task_name = $_REQUEST['task_name'];

$querybord="insert into task_board (task_name,project_id,status) values('$task_name','$projreq','1')";
mysqli_query($link,$querybord);
	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Task Add Successfully.</span></div>";
$errflag = true;
$_SESSION['clients_expensive'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else if(isset($_REQUEST['del']))
{
$del=$_REQUEST['del'];
$query="delete from task_board WHERE task_id=$del";
mysqli_query($link,$query);

	
$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b>Task Delete Successfully.</span></div>";
$errflag = true;
$_SESSION['clients_expensive'] = $errmsg_arr;
session_write_close();	
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
if(isset($_POST['add'])){
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
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div class="sidebar-menu">
						<ul>
							<li> 
								<a href="index.php"><i class="la la-home"></i> <span>Back to Home</span></a>
							</li>
							<li class="menu-title">Projects <a href="#" data-toggle="modal" data-target="#create_project"><i class="fa fa-plus"></i></a></li>
							<?php
							$SQDepart="select * from project WHERE admin_id=$cont_hr_id and status='1' order by id DESC";
											$ResultDepart=mysqli_query($link,$SQDepart);
												while($ListDepart=mysqli_fetch_array($ResultDepart)){
							?>
							<li <?php if($projreq == $ListDepart['id']){?>class="active"<?php } ?> > 
								<a href="task.php?proj=<?php echo $ListDepart['id'];?>"><?php echo $ListDepart['project_name'];?></a>
							</li>
							<?php } ?>
							
						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
				<div class="chat-main-row">
					<div class="chat-main-wrapper">
						<div class="col-lg-7 message-view task-view task-left-sidebar">
							<div class="chat-window">
								<div class="fixed-header">
									<div class="navbar">
										<div class="float-left mr-auto">
											<?php if(isset($_REQUEST['proj'])){?>
											<div class="add-task-btn-wrapper">
												<span class="add-task-btn btn btn-white btn-sm">
													Add Task
												</span>
											</div>
											<?php } ?>
										</div>
										<a class="task-chat profile-rightbar float-right" id="task_chat" href="#task_window"><i class="fa fa fa-comment"></i></a>
										<ul class="nav float-right custom-menu">
											<li class="nav-item dropdown dropdown-action">
												<a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)">Pending Tasks</a>
													<a class="dropdown-item" href="javascript:void(0)">Completed Tasks</a>
													<a class="dropdown-item" href="javascript:void(0)">All Tasks</a>
												</div>
											</li>
										</ul>
									</div>
								</div>
								<div class="chat-contents">
									<div class="chat-content-wrap">
										<div class="chat-wrap-inner">
											<div class="chat-box">
												<div class="task-wrapper">
													<div class="task-list-container">
														<div class="task-list-body">
															<ul id="task-list">
																
																<?php
							$Sqltask="select * from task_board WHERE project_id='$projreq' order by task_id ASC";
											$resultask=mysqli_query($link,$Sqltask);
												while($listtask=mysqli_fetch_array($resultask)){
							?>
																<li class="<?php if($listtask['status'] == 0){ ?>completed<?php }?> task boxdelete">
																	<div class="task-container">
																		<?php if($listtask['status'] == 0){ ?>
																		<span class="task-action-btn task-check">
																			<span class="action-circle large complete-btn taskinact" title="Mark Complete" id="<?php echo $listtask['task_id'];?>">
																				<i class="material-icons">check</i>
																			</span>
																		</span>
																		<?php } else if($listtask['status'] == 1){ ?>
																		<span class="task-action-btn task-check">
																			<span class="action-circle large complete-btn taskact" title="Mark Complete" id="<?php echo $listtask['task_id'];?>">
																				<i class="material-icons">check</i>
																			</span>
																		</span>
																		
																		<?php } ?>
																		<span class="task-label" contenteditable="true">
																			<?php echo $listtask['task_name'];?></span>
																		<span class="task-action-btn task-btn-right">
																			
																			<span class="action-circle large delete-btn kadelete" title="Delete Task" id="<?php echo $listtask['task_id'];?>">
																				<i class="material-icons">delete</i>
																			</span>
																		</span>
																	</div>
																</li>
																<?php } ?>
																
																
																
																
																
																
															</ul>
														</div>
														
														<div class="task-list-footer">
															<div class="new-task-wrapper">
																<form action="task.php?proj=<?php echo $projreq;?>" method="post">
																<textarea id="new-task" name="task_name" placeholder="Enter new task here. . ."></textarea>
																<span class="error-message hidden">You need to enter a task first</span>
																
																	<button type="submit" class="add-new-task-btn btn" name="add">Add Task</button>
																<span class="btn" id="close-task-panel">Close</span>
																	</form>
															</div>
														</div>
														
													</div>
												</div>
												<div class="notification-popup hide">
													<p>
														<span class="task"></span>
														<span class="notification-text"></span>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-5 message-view task-chat-view task-right-sidebar" id="task_window">
							<div class="chat-window">
								<div class="fixed-header">
									<div class="navbar">
										<div class="task-assign">
											<a class="task-complete-btn" id="task_complete" href="javascript:void(0);">
												<i class="material-icons">check</i> Mark Complete
											</a>
										</div>
										<ul class="nav float-right custom-menu">
											<li class="dropdown dropdown-action">
												<a href="" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="javascript:void(0)">Delete Task</a>
													<a class="dropdown-item" href="javascript:void(0)">Settings</a>
												</div>
											</li>
										</ul>
									</div>
								</div>
								<div class="chat-contents task-chat-contents">
									<div class="chat-content-wrap">
										<div class="chat-wrap-inner">
											<div class="chat-box">
												<div class="chats">
													<h4>Hospital Administration Phase 1</h4>
													<div class="task-header">
														<div class="assignee-info">
															<a href="#" data-toggle="modal" data-target="#assignee">
																<div class="avatar">
																	<img alt="" src="assets\img\profiles\avatar-02.jpg">
																</div>
																<div class="assigned-info">
																	<div class="task-head-title">Assigned To</div>
																	<div class="task-assignee">John Doe</div>
																</div>
															</a>
															<span class="remove-icon">
																<i class="fa fa-close"></i>
															</span>
														</div>
														<div class="task-due-date">
															<a href="#" data-toggle="modal" data-target="#assignee">
																<div class="due-icon">
																	<span>
																		<i class="material-icons">date_range</i>
																	</span>
																</div>
																<div class="due-info">
																	<div class="task-head-title">Due Date</div>
																	<div class="due-date">Mar 26, 2019</div>
																</div>
															</a>
															<span class="remove-icon">
																<i class="fa fa-close"></i>
															</span>
														</div>
													</div>
													<hr class="task-line">
													<div class="task-desc">
														<div class="task-desc-icon">
															<i class="material-icons">subject</i>
														</div>
														<div class="task-textarea">
															<textarea class="form-control" placeholder="Description"></textarea>
														</div>
													</div>
													<hr class="task-line">
													<div class="task-information">
														<span class="task-info-line"><a class="task-user" href="#">Lesley Grauer</a> <span class="task-info-subject">created task</span></span>
														<div class="task-time">Jan 20, 2019</div>
													</div>
													<div class="task-information">
														<span class="task-info-line"><a class="task-user" href="#">Lesley Grauer</a> <span class="task-info-subject">added to Hospital Administration</span></span>
														<div class="task-time">Jan 20, 2019</div>
													</div>
													<div class="task-information">
														<span class="task-info-line"><a class="task-user" href="#">Lesley Grauer</a> <span class="task-info-subject">assigned to John Doe</span></span>
														<div class="task-time">Jan 20, 2019</div>
													</div>
													<hr class="task-line">
													<div class="task-information">
														<span class="task-info-line"><a class="task-user" href="#">John Doe</a> <span class="task-info-subject">changed the due date to Sep 28</span> </span>
														<div class="task-time">9:09pm</div>
													</div>
													<div class="task-information">
														<span class="task-info-line"><a class="task-user" href="#">John Doe</a> <span class="task-info-subject">assigned to you</span></span>
														<div class="task-time">9:10pm</div>
													</div>
													<div class="chat chat-left">
														<div class="chat-avatar">
															<a href="profile.html" class="avatar">
																<img alt="" src="assets\img\profiles\avatar-02.jpg">
															</a>
														</div>
														<div class="chat-body">
															<div class="chat-bubble">
																<div class="chat-content">
																	<span class="task-chat-user">John Doe</span> <span class="chat-time">8:35 am</span>
																	<p>I'm just looking around.</p>
																	<p>Will you tell me something about yourself? </p>
																</div>
															</div>
														</div>
													</div>
													<div class="completed-task-msg"><span class="task-success"><a href="#">John Doe</a> completed this task.</span> <span class="task-time">Today at 9:27am</span></div>
													<div class="chat chat-left">
														<div class="chat-avatar">
															<a href="profile.html" class="avatar">
																<img alt="" src="assets\img\profiles\avatar-02.jpg">
															</a>
														</div>
														<div class="chat-body">
															<div class="chat-bubble">
																<div class="chat-content">
																	<span class="task-chat-user">John Doe</span> <span class="file-attached">attached 3 files <i class="fa fa-paperclip"></i></span> <span class="chat-time">Feb 17, 2019 at 4:32am</span>
																	<ul class="attach-list">
																		<li><i class="fa fa-file"></i> <a href="#">project_document.avi</a></li>
																		<li><i class="fa fa-file"></i> <a href="#">video_conferencing.psd</a></li>
																		<li><i class="fa fa-file"></i> <a href="#">landing_page.psd</a></li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
													<div class="chat chat-left">
														<div class="chat-avatar">
															<a href="profile.html" class="avatar">
																<img alt="" src="assets\img\profiles\avatar-16.jpg">
															</a>
														</div>
														<div class="chat-body">
															<div class="chat-bubble">
																<div class="chat-content">
																	<span class="task-chat-user">Jeffery Lalor</span> <span class="file-attached">attached file <i class="fa fa-paperclip"></i></span> <span class="chat-time">Yesterday at 9:16pm</span>
																	<ul class="attach-list">
																		<li class="pdf-file"><i class="fa fa-file-pdf-o"></i> <a href="#">Document_2016.pdf</a></li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
													<div class="chat chat-left">
														<div class="chat-avatar">
															<a href="profile.html" class="avatar">
																<img alt="" src="assets\img\profiles\avatar-16.jpg">
															</a>
														</div>
														<div class="chat-body">
															<div class="chat-bubble">
																<div class="chat-content">
																	<span class="task-chat-user">Jeffery Lalor</span> <span class="file-attached">attached file <i class="fa fa-paperclip"></i></span> <span class="chat-time">Today at 12:42pm</span>
																	<ul class="attach-list">
																		<li class="img-file">
																			<div class="attach-img-download"><a href="#">avatar-1.jpg</a></div>
																			<div class="task-attach-img"><img src="assets\img\user.jpg" alt=""></div>
																		</li>
																	</ul>
																</div>
															</div>
														</div>
													</div>
													<div class="task-information">
														<span class="task-info-line">
															<a class="task-user" href="#">John Doe</a>
															<span class="task-info-subject">marked task as incomplete</span>
														</span>
														<div class="task-time">1:16pm</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="chat-footer">
									<div class="message-bar">
										<div class="message-inner">
											<a class="link attach-icon" href="#"><img src="assets\img\attachment.png" alt=""></a>
											<div class="message-area">
												<div class="input-group">
													<textarea class="form-control" placeholder="Type message..."></textarea>
													<span class="input-group-append">
														<button class="btn btn-primary" type="button"><i class="fa fa-send"></i></button>
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="project-members task-followers">
										<span class="followers-title">Followers</span>
										<a class="avatar" href="#" data-toggle="tooltip" title="Jeffery Lalor">
											<img alt="" src="assets\img\profiles\avatar-16.jpg">
										</a>
										<a class="avatar" href="#" data-toggle="tooltip" title="Richard Miles">
											<img alt="" src="assets\img\profiles\avatar-09.jpg">
										</a>
										<a class="avatar" href="#" data-toggle="tooltip" title="John Smith">
											<img alt="" src="assets\img\profiles\avatar-10.jpg">
										</a>
										<a class="avatar" href="#" data-toggle="tooltip" title="Mike Litorus">
											<img alt="" src="assets\img\profiles\avatar-05.jpg">
										</a>
										<a href="#" class="followers-add" data-toggle="modal" data-target="#task_followers"><i class="material-icons">add</i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
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
								<form method="post" action="task.php" enctype="multipart/form-data">
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
<option value="<?php echo $leave_tbl2_row['company_name'];?>"><?php echo $leave_tbl2_row['company_name'];?></option>
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
				
				<!-- Assignee Modal -->
				<div id="assignee" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Assign to this task</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="input-group m-b-30">
									<input placeholder="Search to add" class="form-control search-input" type="text">
									<span class="input-group-append">
										<button class="btn btn-primary">Search</button>
									</span>
								</div>
								<div>
									<ul class="chat-user-list">
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar"><img alt="" src="assets\img\profiles\avatar-09.jpg"></span>
													<div class="media-body align-self-center text-nowrap">
														<div class="user-name">Richard Miles</div>
														<span class="designation">Web Developer</span>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar"><img alt="" src="assets\img\profiles\avatar-10.jpg"></span>
													<div class="media-body align-self-center text-nowrap">
														<div class="user-name">John Smith</div>
														<span class="designation">Android Developer</span>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar">
														<img alt="" src="assets\img\profiles\avatar-16.jpg">
													</span>
													<div class="media-body align-self-center text-nowrap">
														<div class="user-name">Jeffery Lalor</div>
														<span class="designation">Team Leader</span>
													</div>
												</div>
											</a>
										</li>
									</ul>
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Assign</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Assignee Modal -->
				
				<!-- Task Followers Modal -->
				<div id="task_followers" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add followers to this task</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="input-group m-b-30">
									<input placeholder="Search to add" class="form-control search-input" type="text">
									<span class="input-group-append">
										<button class="btn btn-primary">Search</button>
									</span>
								</div>
								<div>
									<ul class="chat-user-list">
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar"><img alt="" src="assets\img\profiles\avatar-16.jpg"></span>
													<div class="media-body media-middle text-nowrap">
														<div class="user-name">Jeffery Lalor</div>
														<span class="designation">Team Leader</span>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar"><img alt="" src="assets\img\profiles\avatar-08.jpg"></span>
													<div class="media-body media-middle text-nowrap">
														<div class="user-name">Catherine Manseau</div>
														<span class="designation">Android Developer</span>
													</div>
												</div>
											</a>
										</li>
										<li>
											<a href="#">
												<div class="media">
													<span class="avatar"><img alt="" src="assets\img\profiles\avatar-26.jpg"></span>
													<div class="media-body media-middle text-nowrap">
														<div class="user-name">Wilmer Deluna</div>
														<span class="designation">Team Leader</span>
													</div>
												</div>
											</a>
										</li>
									</ul>
								</div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Add to Follow</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Task Followers Modal -->
				
            </div>
			<!-- /Page Wrapper -->
			
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        
		<!-- Bootstrap Core JS -->
		<script src="assets\js\jquery-3.5.1.min.js"></script>
<script type="text/javascript">
$(function() {
$(".kadelete").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'id=' + del_id;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "taskdel.php",
   data: info,
	  _method: 'DELETE',
   success: function(){
 }
});
  $(this).parents(".boxdelete").animate({ backgroundColor: "blue" }, "slow")
  .animate({ opacity: "hide" }, "slow");
 }
return false;
});
});
	
$(function() {
$(".taskact").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'edel=' + del_id;

 $.ajax({
   type: "POST",
   url: "taskdel.php",
   data: info,
	  _method: 'DELETE',
   success: function(){
 }
});
return true;
});
});
$(function() {
$(".taskinact").click(function(){
var element = $(this);
var del_id = element.attr("id");
var info = 'inedel=' + del_id;

 $.ajax({
   type: "POST",
   url: "taskdel.php",
   data: info,
	  _method: 'DELETE',
   success: function(){
 }
});
return true;
});
});		
	
</script>
        <script src="assets\js\popper.min.js"></script>
        <script src="assets\js\bootstrap.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets\js\jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets\js\select2.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets\js\moment.min.js"></script>
		<script src="assets\js\bootstrap-datetimepicker.min.js"></script>
		<script src="assets\js\task.js"></script>
		<!-- Custom JS -->
		<script src="assets\js\app.js"></script>
		
		
    </body>
</html>