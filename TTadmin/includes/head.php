<?php
$sql_cms45="select * from inboxdata where status='1' order by id DESC"; 
 $result_cms45=mysqli_query($link,$sql_cms45);
  $sql_cms451="select * from inboxdata where status='1' order by id DESC limit 5"; 
 $result_cms451=mysqli_query($link,$sql_cms451);
 ?>

<header class="header"> <a href="index.php" class="logo"> 
  <!-- Add the class icon to your logo image or logo icon to add the margining --> 
  Splendid </a> 
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation"> 
    <!-- Sidebar toggle button--> 
    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a>
    <div class="navbar-right">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope"></i> <span class="label label-success"><?php echo mysqli_num_rows($result_cms45);?></span> </a>
          <ul class="dropdown-menu">
            <li class="header">You have <?php echo mysqli_num_rows($result_cms45);?> messages</li>
            <li> 
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <?php while($row_cms78589=mysqli_fetch_array($result_cms451)) {
					?>
                <li><!-- start message --> 
                  <a href="mailbox_details.php?id=<?php echo $row_cms78589['id'];?>&&<?php echo $row_cms78589['session'];?>">
                  
                  <h4> <?php echo $row_cms78589['fromer']; ?> <br /><small><i class="fa fa-clock-o"></i> <?php echo $row_cms78589['date']; ?> </small> </h4>
                  <p><?php echo $row_cms78589['subject']; ?> </p>
                  </a> </li>
               <?php
				}
			   ?>
              </ul>
            </li>
            <li class="footer"><a href="mailbox.php">See All Messages</a></li>
          </ul>
        </li>
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-warning"></i> <span class="label label-warning">10</span> </a>
          <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li> 
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li> <a href="#"> <i class="ion ion-ios7-people info"></i> 5 new members joined today </a> </li>
                <li> <a href="#"> <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems </a> </li>
                <li> <a href="#"> <i class="fa fa-users warning"></i> 5 new members joined </a> </li>
                <li> <a href="#"> <i class="ion ion-ios7-cart success"></i> 25 sales made </a> </li>
                <li> <a href="#"> <i class="ion ion-ios7-person danger"></i> You changed your username </a> </li>
              </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li>
        <!-- Tasks: style can be found in dropdown.less -->
        <li class="dropdown tasks-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-tasks"></i> <span class="label label-danger">9</span> </a>
          <ul class="dropdown-menu">
            <li class="header">You have 9 tasks</li>
            <li> 
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li><!-- Task item --> 
                  <a href="#">
                  <h3> Design some buttons <small class="pull-right">20%</small> </h3>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> <span class="sr-only">20% Complete</span> </div>
                  </div>
                  </a> </li>
                <!-- end task item -->
                <li><!-- Task item --> 
                  <a href="#">
                  <h3> Create a nice theme <small class="pull-right">40%</small> </h3>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> <span class="sr-only">40% Complete</span> </div>
                  </div>
                  </a> </li>
                <!-- end task item -->
                <li><!-- Task item --> 
                  <a href="#">
                  <h3> Some task I need to do <small class="pull-right">60%</small> </h3>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> <span class="sr-only">60% Complete</span> </div>
                  </div>
                  </a> </li>
                <!-- end task item -->
                <li><!-- Task item --> 
                  <a href="#">
                  <h3> Make beautiful transitions <small class="pull-right">80%</small> </h3>
                  <div class="progress xs">
                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"> <span class="sr-only">80% Complete</span> </div>
                  </div>
                  </a> </li>
                <!-- end task item -->
              </ul>
            </li>
            <li class="footer"> <a href="#">View all tasks</a> </li>
          </ul>
        </li>
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-user"></i> <span><?php echo $profile_row['firstname']." ".$profile_row['lastname']; ?> <i class="caret"></i></span> </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header bg-light-blue">
             <?php if($profile_row['image']!='') { image_size(); ?>
      <img src="../uploads/<?php echo $profile_row['image'];?>" class="img-circle" />
	  <?php } ?>
              <p> <?php echo $profile_row['firstname']." ".$profile_row['lastname']; ?> <small>Member since Nov. 2012</small> </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="col-xs-4 text-center"> <a href="#">Followers</a> </div>
              <div class="col-xs-4 text-center"> <a href="#">Sales</a> </div>
              <div class="col-xs-4 text-center"> <a href="#">Friends</a> </div>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left"> <a href="profile.php?cms=<?php echo $profile_row['admin_id'];?>" class="btn btn-default btn-flat">Profile</a> </div>
              <div class="pull-right"> 
              <form name="logut" action="logout.php">
              
              <input type="hidden" name="username" value="<?php echo $kadirtest; ?>" />
              <button type="submit" class="btn btn-default btn-flat">Logout</button>
              </form>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
