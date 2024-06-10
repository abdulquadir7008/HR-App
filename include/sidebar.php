<?php
$sql_module_hr2 = "select * from hr_module_permission";
$hr_empl_res2 = mysqli_query( $link, $sql_module_hr2 );
$list_hr_empl2 = mysqli_fetch_array( $hr_empl_res2 );

$sql_module_ac2 = "select * from account_module_permission";
$ac_empl_res2 = mysqli_query( $link, $sql_module_ac2 );
$list_ac_empl2 = mysqli_fetch_array( $ac_empl_res2 );

$sql_module_emp2 = "select * from employe_module_permission";
$emp_empl_res2 = mysqli_query( $link, $sql_module_emp2 );
$list_per_empl2 = mysqli_fetch_array( $emp_empl_res2 );
?>
<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>
        <li class="menu-title"> <span>Main</span> </li>
        
			  <?php if($customerchechlogin_row['account_type'] == '1' || $primiaryRole == 'hr'){?>
		  <li><a href="index.php">Dashboard</a></li>
		  <?php }else{ ?>
			   <li><a href="emloyee-dashboard.php"> Dashboard</a></li>
			  <?php } ?>
           
         <?php
        if ( $primiaryRole == 'accountant') {
          ?>
		  <?php if($list_ac_empl2['accounting']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
		   <li class="submenu">
								<a href="#"><i class="la la-files-o"></i> <span> Accounting </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="ac-categories.php">Categories</a></li>
									<li><a href="budgets.php">Budgets</a></li>
									<li><a href="budget_expenses.php">Budget Expenses</a></li>
									<li><a href="budget_revenues.php">Budget Revenues</a></li>
									<li><a href="estimates.php">Estimates</a></li>
									<li><a href="invoice.php">Invoices</a></li>
									<li><a href="payments.php">Payments</a></li>
									<li><a href="taxes.php">Taxes</a></li>
								</ul>
							</li>
		  <?php } ?>
		  <?php if($list_ac_empl2['sales']=='on'  || $customerchechlogin_row['account_type'] == '1'){?>
		  <li class="submenu">
								<a href="#"><i class="la la-files-o"></i> <span> Sales </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									
									<li><a href="provident-fund.php">Provident Fund</a></li>
									
								</ul>
							</li>
		  <?php } ?>
		  <?php } ?>
        <?php
            if ( $primiaryRole != 'accountant') {
              ?>
        <li class="menu-title"> <span>Employees</span> </li>
        <li class="submenu">
			<?php if($customerchechlogin_row['account_type'] == '1'){?>
			<a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> 
			<span class="badge badge-pill">3</span>
			<span class="menu-arrow"></span></a>
			<?php }else if($primiaryRole == 'hr' && $list_hr_empl2['employes']=='on'){?>
			<a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> 
			<span class="badge badge-pill">3</span>
			<span class="menu-arrow"></span></a>
			<?php } else if($list_per_empl2['attendance']=='on' && $primiaryRole == ''){ ?>
			<a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> 
			<span class="badge badge-pill">3</span>
			<span class="menu-arrow"></span></a>
			<?php } ?>
          
          <ul style="display: none;">
            <?php if($customerchechlogin_row['account_type'] == '1'){?>
            <li><a href="admin_employees.php">All Employees</a></li>
            <li><a href="holidays.php">Holidays</a></li>
            <li><a href="leaves.php">Leaves (Admin) <span class="badge badge-pill bg-primary float-right">1</span></a></li>
			  <li><a href="attendance.php">Attendance (User)</a></li>
            <li><a href="departments.php">Departments</a></li>
            <li><a href="designations.php">Designations</a></li>
            <?php
            } else if ( $primiaryRole == 'hr' && $list_hr_empl2['employes']=='on') {
              ?>
            <li><a href="employees.php">All Employees</a></li>
            <li><a href="holidays.php">Holidays</a></li>
            <li><a href="leaves.php">Leaves (users)</a></li>
            <li><a href="attendance.php">Attendance (User)</a></li>
            <li><a href="departments.php">Departments</a></li>
            <li><a href="designations.php">Designations</a></li>
            <!--li><a href="timesheet.html">Timesheet</a></li>
									<!--li><a href="shift-scheduling.html">Shift & Schedule</a></li--> 
            <!--li><a href="overtime.html">Overtime</a></li-->
			 
			  
            <?php
            } else {
              ?>
            <li><a href="attendance-employee.php">Attendance (Employee)</a></li>
			  
            <?php } ?>
          </ul>
        </li>
		  
		  <?php }?>
        
<?php if($customerchechlogin_row['account_type'] == '1' || $primiaryRole == 'hr'){?>
		  
		  <?php }else{ ?>
		  <!-- Account and   -->
		  <?php if($list_ac_empl2['ac_leave']=='on' && $primiaryRole == 'accountant' ||  $customerchechlogin_row['account_type'] == '1'){?>
		  <li class="submenu"> 
			<a href="#"><i class="la la-hand-holding"></i> <span> Leaves</span> 
			
			<span class="menu-arrow"></span></a>
			  <ul style="display: none;">
				  <li><a href="add_leave.php">New Leave Application</a></li>
				  <li><a href="leaves-employee.php">Leave Summary</a></li>
				  <li><a href="cancel_leaves.php">Cancel Leave</a></li>
				  <li><a href="return_from_leave.php">Return From Leave</a></li>
			  </ul> 
		  </li>
		  <?php } else if( $list_per_empl2['emp_leaves']=='on' ||  $customerchechlogin_row['account_type'] == '1'){?>
		  <li class="submenu"> 
			<a href="#"><i class="la la-hand-holding"></i> <span> Leaves</span> 
			
			<span class="menu-arrow"></span></a>
			  <ul style="display: none;">
				  <li><a href="add_leave.php">New Leave Application</a></li>
				  <li><a href="leaves-employee.php">Leave Summary</a></li>
				  <li><a href="cancel_leaves.php">Cancel Leave</a></li>
				  <li><a href="return_from_leave.php">Return From Leave</a></li>
			  </ul> 
		  </li>
		  
		  <?php } ?>
		  <?php if($list_per_empl2['emp_request']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
		  <li> 
			<a href="profile.php"><i class="la la-address-book-o"></i> <span> Request</span> 
			
			<span class="menu-arrow"></span></a>
			  <ul <?php if($page_name=='profile.php'){?>style="display: block;"<?php } ?> >
				  <li><a href="#" data-toggle="modal" data-target="#personal_info_modal">Personal Informations</a></li>
				  <li><a href="#" data-toggle="modal" data-target="#emergency_contact_modal">Emergency Contact</a></li>
				  <li><a href="#" data-toggle="modal" data-target="#bankinformation">Bank information</a></li>
				  <li><a href="#" data-toggle="modal" data-target="#family_info_modal">Family Informations</a></li>
				  <li><a href="#" data-toggle="modal" data-target="#education_info">Education Informations</a></li>
				  <li><a href="#" data-toggle="modal" data-target="#experience_info">Experience</a></li>
				  <li><a href="education_allownce.php">Education Allownce</a></li>
			  </ul>
			  
		  </li>
		  <?php } else if( $list_per_empl2['emp_leaves']=='on' ||  $customerchechlogin_row['account_type'] == '1'){?>
		  
		  <?php } ?>
		  
		  <?php } ?>
		  
        <?php
        if ( $primiaryRole == 'hr' || $customerchechlogin_row['account_type'] == '1') {
          ?>
		  <?php if($list_hr_empl2['clients']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
		  <li><a href="clients.php"><i class="la la-users"></i> <span>Clients</span></a></li>
		  <?php } ?>
		  <?php if($list_hr_empl2['project']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
		  <li class="submenu">
								<a href="#"><i class="la la-rocket"></i> <span> Projects</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="projects.php">Projects</a></li>
									<li><a href="task.php">Tasks</a></li>
									<!--li><a href="task-board.html">Task Board</a></li-->
								</ul>
							</li>
		  <?php } ?>
		  <li class="menu-title"> <span>HR</span> </li>
		 <?php if($list_hr_empl2['payroll']=='on' || $customerchechlogin_row['account_type'] == '1'){?> 
        <li class="submenu"> <a href="#"><i class="la la-money"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
          <ul style="display: none;">
            <li><a href="salary.php"> Employee Salary </a></li>
          </ul>
        </li>
		  <?php } ?>
		  <?php if($list_hr_empl2['gratuity']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
		   <li><a href="gratuity-calculator.php"><i class="la la-money-check"></i> <span>Gratuity</span></a></li>
		  <?php } ?>
		   <?php if($list_hr_empl2['request']=='on' || $customerchechlogin_row['account_type'] == '1'){?>
		  <li class="submenu">
								<a href="#"><i class="la la-hand-point-up"></i> <span> Request </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									
									<li><a href="datachange.php"> User Personal Informations Request </a></li>
									<li><a href="employee-emergency-contact.php"> User Emergency Contact Request </a></li>
									<li><a href="bank_details_request.php"> User Bank Details Request </a></li>
									<!--li><a href="invoice-reports.html"> Invoice Report </a></li>
									<li><a href="payments-reports.html"> Payments Report </a></li>
									<li><a href="project-reports.html"> Project Report </a></li>
									<li><a href="task-reports.html"> Task Report </a></li>
									<li><a href="user-reports.html"> User Report </a></li>
									<li><a href="employee-reports.html"> Employee Report </a></li>
									<li><a href="payslip-reports.html"> Payslip Report </a></li>
									<li><a href="attendance-reports.html"> Attendance Report </a></li>
									<li><a href="leave-reports.html"> Leave Report </a></li>
									<li><a href="daily-reports.html"> Daily Report </a></li-->
								</ul>
							</li>
		  <?php } ?>
		 <?php
        if ( $customerchechlogin_row['account_type'] == '1') {
          ?>
		  
		   <li class="submenu">
								<a href="#"><i class="la la-files-o"></i> <span> Accounting </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="ac-categories.php">Categories</a></li>
									<li><a href="budgets.php">Budgets</a></li>
									<li><a href="budget_expenses.php">Budget Expenses</a></li>
									<li><a href="budget_revenues.php">Budget Revenues</a></li>
									<li><a href="estimates.php">Estimates</a></li>
									<li><a href="invoice.php">Invoices</a></li>
									<li><a href="payments.php">Payments</a></li>
									<li><a href="taxes.php">Taxes</a></li>
								</ul>
							</li>
		  
		  <li class="submenu">
								<a href="#"><i class="la la-files-o"></i> <span> Sales </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									
									<li><a href="provident-fund.php">Provident Fund</a></li>
									
								</ul>
							</li>
		  
		  <?php } ?>
		  
        <?php } ?>
		  <?php if($customerchechlogin_row['account_type'] == '1'){?>
        <li> <a href="settings.php"><i class="la la-cog"></i> <span>Settings</span></a> </li>
		  <?php } ?>
		  
      </ul>
    </div>
  </div>
</div>
