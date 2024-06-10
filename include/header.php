
<div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="" class="logo">
						<img src="images\spl-crm.png" width="136" alt="Splendid CRM">
					</a>
                </div>
				<!-- /Logo -->
				
				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				
				<!-- Header Title -->
                <div class="page-title-box">
					<h3>Splendid</h3>
                </div>
				<!-- /Header Title -->
				
				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
				
				<!-- Header Menu -->
				<ul class="nav user-menu">
				
					<!-- Search -->
					<li class="nav-item">
						<div class="top-nav-search">
							<a href="javascript:void(0);" class="responsive-search">
								<i class="fa fa-search"></i>
						   </a>
							<form action="search.html">
								<input class="form-control" type="text" placeholder="Search here">
								<button class="btn" type="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</li>
					<!-- /Search -->
				
					<!-- Flag -->
					<li class="nav-item dropdown has-arrow flag-nav">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
							<img src="assets\img\flags\us.png" alt="" height="20"> <span>English</span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="assets\img\flags\us.png" alt="" height="16"> English
							</a>
							<a href="javascript:void(0);" class="dropdown-item">
								<img src="assets\img\flags\fr.png" alt="" height="16"> Arabic
							</a>
							
						</div>
					</li>
					<!-- /Flag -->
				
					<!-- Notifications -->
					<?php
					
        if ( $primiaryRole == 'hr' && $customerchechlogin_row[ 'account_type' ] == $counterID ) {
          ?>
					<li class="nav-item dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i> <span class="badge badge-pill">
							<?php
							$notification_sql = "select * from personal_info WHERE status='0'";
								$notification_result = mysqli_query($link, $notification_sql);
									

									$notification_sql2 = "select * from emegency_contact WHERE status='0'";
										$notification_result2 = mysqli_query($link, $notification_sql2);
											

												$notification_sql3 = "select * from bank_details WHERE status='0'";
													$notification_result3 = mysqli_query($link, $notification_sql3);
														
							?>
							<?php echo mysqli_num_rows($notification_result) + mysqli_num_rows($notification_result2) + mysqli_num_rows($notification_result3);?>
							</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">
									
									<?php while($notification_row = mysqli_fetch_array( $notification_result )){
										$employessID = $notification_row['profile_id'];
											$leave_tbl2_sql="select * from users where id='$employessID'";
												$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
													$leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result);
									?>
									<li class="notification-message">
										<a href="datachange.php">
											<div class="media">
												<span class="avatar">
													<img alt="" src="uploads/<?php echo $leave_tbl2_row['image'];?>">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title"><?php echo $leave_tbl2_row['fullname'];?></span> Request <span class="noti-title">Personal Informations Update </span></p>
													<p class="noti-time"><span class="notification-time"></span></p>
												</div>
											</div>
										</a>
									</li>
									<?php } ?>
									
									
									<?php while($notification_row2 = mysqli_fetch_array( $notification_result2 )){
										$employessID2 = $notification_row2['profile_id'];
											$leave_tbl2_sql="select * from users where id='$employessID2'";
												$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
													$leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result);
									?>
									<li class="notification-message">
										<a href="bank_details_request.php">
											<div class="media">
												<span class="avatar">
													<img alt="" src="uploads/<?php echo $leave_tbl2_row['image'];?>">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title"><?php echo $leave_tbl2_row['fullname'];?></span> Request <span class="noti-title">Emergency Contact Update </span></p>
													<p class="noti-time"><span class="notification-time"></span></p>
												</div>
											</div>
										</a>
									</li>
									<?php } ?>
									
									
									<?php while($notification_row3 = mysqli_fetch_array( $notification_result3 )){
										$employessID3 = $notification_row3['profile_id'];
											$leave_tbl2_sql="select * from users where id='$employessID3'";
												$leave_tbl2_result=mysqli_query($link,$leave_tbl2_sql);
													$leave_tbl2_row=mysqli_fetch_array($leave_tbl2_result);
									?>
									<li class="notification-message">
										<a href="employee-emergency-contact.php">
											<div class="media">
												<span class="avatar">
													<img alt="" src="uploads/<?php echo $leave_tbl2_row['image'];?>">
												</span>
												<div class="media-body">
													<p class="noti-details"><span class="noti-title"><?php echo $leave_tbl2_row['fullname'];?></span> Request <span class="noti-title">Bank information Update </span></p>
													<p class="noti-time"><span class="notification-time"></span></p>
												</div>
											</div>
										</a>
									</li>
									<?php } ?>
									
									
									
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="activities.html">View all Notifications</a>
							</div>
						</div>
					</li>
					<?php } ?>
					<!-- /Notifications -->
					
					<!-- Message Notifications -->
					
					<!-- /Message Notifications -->

					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img">
							
							<?php if($customerchechlogin_row['image']!='') { ?>
                      <img src="uploads/<?php echo $customerchechlogin_row['image'];?>" />
                      <?php } else{ ?>
					  <img src="assets\img\user.jpg" alt="user">
									<?php } ?>
							<span class="status online"></span></span>
							<span><?php echo ucwords($customerchechlogin_row['fullname']);?></span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="profile.php">My Profile</a>
							<?php if($customerchechlogin_row['account_type'] == '1'){?>
							<a class="dropdown-item" href="settings.php">Settings</a>
							<?php } ?>
							<a class="dropdown-item" href="user-password-change.php">Change Password</a>
							
							<a class="dropdown-item" href="logout.php">Logout</a>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->
				
				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="profile.html">My Profile</a>
						<a class="dropdown-item" href="settings.html">Settings</a>
						<a class="dropdown-item" href="login.html">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->
				
            </div>