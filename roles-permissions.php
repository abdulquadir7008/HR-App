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

$sql_module_hr = "select * from hr_module_permission";
$hr_empl_res = mysqli_query( $link, $sql_module_hr );
$list_hr_empl = mysqli_fetch_array( $hr_empl_res );

$sql_module_ac = "select * from account_module_permission";
$ac_empl_res = mysqli_query( $link, $sql_module_ac );
$list_ac_empl = mysqli_fetch_array( $ac_empl_res );

$sql_module_emp = "select * from employe_module_permission";
$emp_empl_res = mysqli_query( $link, $sql_module_emp );
$list_per_empl = mysqli_fetch_array( $emp_empl_res );

$sql_module_hr_permission = "select * from hr_fun_permission";
$result_hr_permission = mysqli_query( $link, $sql_module_hr_permission );
$list_hr_permission = mysqli_fetch_array( $result_hr_permission );

$sql_module_account_permission = "select * from account_fun_permission";
$result_account_permission = mysqli_query( $link, $sql_module_account_permission );
$list_account_permission = mysqli_fetch_array( $result_account_permission );

$sql_module_employee_permission = "select * from employee_fun_permission";
$result_employee_permission = mysqli_query( $link, $sql_module_employee_permission );
$list_employee_permission = mysqli_fetch_array( $result_employee_permission );

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
include( "include/head.php" );
if ( isset( $_REQUEST[ 'counterdel' ] ) ) {
  $id_counterdel = $_REQUEST[ 'counterdel' ];
  $query = "delete from counter WHERE id=$id_counterdel";
  mysqli_query( $link, $query );
} else if ( isset( $_REQUEST[ 'counter' ] ) ) {
  $name = $_POST[ 'countr' ];
  $primary_role = $_POST[ 'primary_role' ];

  $counter_sql = "insert into counter (countr,primary_role,admin_id) values('$name','$primary_role','$customerchechlogin_id')";
  mysqli_query( $link, $counter_sql );
}
?>
</head>
<body>
<!-- Main Wrapper -->
<div class="main-wrapper"> 
  
  <!-- Header -->
  <?php include("include/header.php");?>
  <!-- /Header --> 
  
  <!-- Sidebar -->
  
  <?php include("include/sidebar2.php");?>
  <!-- /Sidebar --> 
  
  <!-- Page Wrapper -->
  <div class="page-wrapper"> 
    
    <!-- Page Content -->
    <div class="content container-fluid"> 
      
      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="page-title">Roles & Permissions</h3>
          </div>
        </div>
      </div>
      <!-- /Page Header -->
      
      <div class="row">
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3"> <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_role"><i class="fa fa-plus"></i> Add Roles</a>
          <div class="roles-menu">
            <ul>
              <?php
              $counter_sql = "select * from counter where admin_id='$customerchechlogin_id' order by countr ASC";
              $counter_result = mysqli_query( $link, $counter_sql );
              while ( $counter_row = mysqli_fetch_array( $counter_result ) ) {
                ?>
              <li> <a href="javascript:void(0);"><?php echo $counter_row['countr'];?> <span class="role-action"> <span class="action-circle large delete-btn" data-toggle="modal" data-target="#delete_role<?php echo $counter_row['id'];?>"> <i class="material-icons">delete</i> </span> </span> </a> </li>
              <div class="modal custom-modal fade" id="delete_role<?php echo $counter_row['id'];?>" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="form-header">
                        <h3>Delete Role</h3>
                        <p>Are you sure want to delete?</p>
                      </div>
                      <div class="modal-btn delete-action">
                        <div class="row">
                          <div class="col-6"> <a href="roles-permissions.php?counterdel=<?php echo $counter_row['id'];?>" class="btn btn-primary continue-btn">Delete</a> </div>
                          <div class="col-6"> <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>
            </ul>
          </div>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
          <h6 class="card-title m-b-20">Module Access (HR)</h6>
          <div class="m-b-30">
            <ul class="list-group notification-list">
              <li class="list-group-item"> Employees
                <div class="status-toggle">
                  <input type="checkbox" id="employes" name="employes" class="check module_hr" <?php if($list_hr_empl['employes']=='on'){ ?>checked<?php }?> >
                  <label for="employes" class="checktoggle">checkbox</label>
                </div>
              </li>
              <li class="list-group-item"> Clients
                <div class="status-toggle">
                  <input type="checkbox" id="clients" name="clients" class="check module_hr" <?php if($list_hr_empl['clients']=='on'){ ?>checked<?php }?>>
                  <label for="clients" class="checktoggle">checkbox</label>
                </div>
              </li>
              <li class="list-group-item"> Project
                <div class="status-toggle">
                  <input type="checkbox" id="project" name="project" class="check module_hr" <?php if($list_hr_empl['project']=='on'){ ?>checked<?php }?>>
                  <label for="project" class="checktoggle">checkbox</label>
                </div>
              </li>
              <li class="list-group-item"> Payroll
                <div class="status-toggle">
                  <input type="checkbox" id="payroll" name="payroll" class="check module_hr" <?php if($list_hr_empl['payroll']=='on'){ ?>checked<?php }?>>
                  <label for="payroll" class="checktoggle">checkbox</label>
                </div>
              </li>
              <li class="list-group-item"> Gratuity
                <div class="status-toggle">
                  <input type="checkbox" id="gratuity" name="gratuity" class="check module_hr" <?php if($list_hr_empl['gratuity']=='on'){ ?>checked<?php }?>>
                  <label for="gratuity" class="checktoggle">checkbox</label>
                </div>
              </li>
              <li class="list-group-item"> Request
                <div class="status-toggle">
                  <input type="checkbox" id="request" name="request" class="check module_hr" <?php if($list_hr_empl['request']=='on'){ ?>checked<?php }?>>
                  <label for="request" class="checktoggle">checkbox</label>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
          <h6 class="card-title m-b-20">Module Access (Account)</h6>
          <div class="m-b-30">
            <ul class="list-group notification-list">
              <li class="list-group-item"> Accounting
                <div class="status-toggle">
                  <input type="checkbox" id="accounting" name="accounting" class="check ac_module" <?php if($list_ac_empl['accounting']=='on'){ ?>checked<?php }?>>
                  <label for="accounting" class="checktoggle">checkbox</label>
                </div>
              </li>
              <li class="list-group-item"> Sales
                <div class="status-toggle">
                  <input type="checkbox" id="sales" class="check ac_module" <?php if($list_ac_empl['sales']=='on'){ ?>checked<?php }?>>
                  <label for="sales" class="checktoggle">checkbox</label>
                </div>
              </li>
              <li class="list-group-item"> Leave
                <div class="status-toggle">
                  <input type="checkbox" id="ac_leave" class="check ac_module" <?php if($list_ac_empl['ac_leave']=='on'){ ?>checked<?php }?>>
                  <label for="ac_leave" class="checktoggle">checkbox</label>
                </div>
              </li>
              <li class="list-group-item"> Request
                <div class="status-toggle">
                  <input type="checkbox" id="requesthr" class="check ac_module" <?php if($list_ac_empl['requesthr']=='on'){ ?>checked<?php }?>>
                  <label for="requesthr" class="checktoggle">checkbox</label>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3">
          <h6 class="card-title m-b-20">Module Access (Employee)</h6>
          <div class="m-b-30">
            <ul class="list-group notification-list">
              <li class="list-group-item"> Attendance
                <div class="status-toggle">
                  <input type="checkbox" id="attendance" class="check emp_module" <?php if($list_per_empl['attendance']=='on'){ ?>checked<?php }?>>
                  <label for="attendance" class="checktoggle">checkbox</label>
                </div>
              </li>
              <li class="list-group-item"> Leaves
                <div class="status-toggle">
                  <input type="checkbox" id="emp_leaves" class="check emp_module" <?php if($list_per_empl['emp_leaves']=='on'){ ?>checked<?php }?>>
                  <label for="emp_leaves" class="checktoggle">checkbox</label>
                </div>
              </li>
              <li class="list-group-item"> Request
                <div class="status-toggle">
                  <input type="checkbox" id="emp_request" class="check emp_module" <?php if($list_per_empl['emp_request']=='on'){ ?>checked<?php }?>>
                  <label for="emp_request" class="checktoggle">checkbox</label>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4">
          <h6 class="card-title m-b-20">Module Permission (HR)</h6>
          <div class="table-responsive">
            <table class="table table-striped custom-table">
              <thead>
                <tr>
                  <th>Module Permission</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Create</th>
                  <th class="text-center">Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Employee</td>
                  <td class="text-center"><input type="checkbox" id="employee_red" class="hr_module_permission" <?php if($list_hr_permission['employee_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="employee_wr" class="hr_module_permission" <?php if($list_hr_permission['employee_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="employee_del" class="hr_module_permission" <?php if($list_hr_permission['employee_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
                <tr>
                  <td>Holidays</td>
                  <td class="text-center"><input type="checkbox" id="holiday_red" class="hr_module_permission" <?php if($list_hr_permission['holiday_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="holiday_wr" class="hr_module_permission" <?php if($list_hr_permission['holiday_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="holiday_del" class="hr_module_permission" <?php if($list_hr_permission['holiday_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
                <tr>
                  <td>Leaves</td>
                  <td class="text-center"><input type="checkbox" id="leave_red" class="hr_module_permission" <?php if($list_hr_permission['leave_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="leave_wr" class="hr_module_permission" <?php if($list_hr_permission['leave_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="leave_del" class="hr_module_permission" <?php if($list_hr_permission['leave_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
                <tr>
                  <td>Attendance</td>
                  <td class="text-center"><input type="checkbox" id="attendance_red" class="hr_module_permission" <?php if($list_hr_permission['attendance_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="attendance_wr" class="hr_module_permission" <?php if($list_hr_permission['attendance_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="attendance_del" class="hr_module_permission" <?php if($list_hr_permission['attendance_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
				 <tr>
                  <td>Department</td>
                  <td class="text-center"><input type="checkbox" id="department_red" class="hr_module_permission" <?php if($list_hr_permission['department_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="department_wr" class="hr_module_permission" <?php if($list_hr_permission['department_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="department_del" class="hr_module_permission" <?php if($list_hr_permission['department_del']=='on'){ ?>checked<?php }?>></td>
                </tr> 
				  <tr>
                  <td>Designations</td>
                  <td class="text-center"><input type="checkbox" id="designation_red" class="hr_module_permission" <?php if($list_hr_permission['designation_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="designation_wr" class="hr_module_permission" <?php if($list_hr_permission['designation_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="designation_del" class="hr_module_permission" <?php if($list_hr_permission['designation_del']=='on'){ ?>checked<?php }?>></td>
                </tr> 
				 <tr>
                  <td>Clients</td>
                  <td class="text-center"><input type="checkbox" id="clients_red" class="hr_module_permission" <?php if($list_hr_permission['clients_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="clients_wr" class="hr_module_permission" <?php if($list_hr_permission['clients_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="clients_del" class="hr_module_permission" <?php if($list_hr_permission['clients_del']=='on'){ ?>checked<?php }?>></td>
                </tr> 
				  <tr>
                  <td>Projects</td>
                  <td class="text-center"><input type="checkbox" id="projects_red" class="hr_module_permission" <?php if($list_hr_permission['projects_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="projects_wr" class="hr_module_permission" <?php if($list_hr_permission['projects_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="projects_del" class="hr_module_permission" <?php if($list_hr_permission['projects_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
				  <!--tr>
				 <td>task</td>
                  <td class="text-center"><input type="checkbox" id="task_red" class="hr_module_permission" <?php if($list_hr_permission['task_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="task_wr" class="hr_module_permission" <?php if($list_hr_permission['task_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="task_del" class="hr_module_permission" <?php if($list_hr_permission['task_del']=='on'){ ?>checked<?php }?>></td>
                </tr-->
				  <tr>
			  		<td>Employee Salary</td>
                  <td class="text-center"><input type="checkbox" id="salary_red" class="hr_module_permission" <?php if($list_hr_permission['salary_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="salary_wr" class="hr_module_permission" <?php if($list_hr_permission['salary_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="salary_del" class="hr_module_permission" <?php if($list_hr_permission['salary_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-4">
          <h6 class="card-title m-b-20">Module Permission (Account)</h6>
          <div class="table-responsive">
            <table class="table table-striped custom-table">
              <thead>
                <tr>
                  <th>Module Permission</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Create</th>
                  <th class="text-center">Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Categories</td>
                  <td class="text-center"><input type="checkbox" id="categories_red" class="account_module_permission" <?php if($list_account_permission['categories_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="categories_wr" class="account_module_permission" <?php if($list_account_permission['categories_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="categories_del" class="account_module_permission" <?php if($list_account_permission['categories_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
                <tr>
                  <td>Budgets</td>
                  <td class="text-center"><input type="checkbox" id="budgets_red" class="account_module_permission" <?php if($list_account_permission['budgets_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="budgets_wr" class="account_module_permission" <?php if($list_account_permission['budgets_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="budgets_del" class="account_module_permission" <?php if($list_account_permission['budgets_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
                <tr>
                  <td>Budgets Expenses</td>
                  <td class="text-center"><input type="checkbox" id="expenses_red" class="account_module_permission" <?php if($list_account_permission['expenses_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="expenses_wr" class="account_module_permission" <?php if($list_account_permission['expenses_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="expenses_del" class="account_module_permission" <?php if($list_account_permission['expenses_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
                <tr>
                  <td>Budgets Revenues</td>
                  <td class="text-center"><input type="checkbox" id="revenues_red" class="account_module_permission" <?php if($list_account_permission['revenues_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="revenues_wr" class="account_module_permission" <?php if($list_account_permission['revenues_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="revenues_del" class="account_module_permission" <?php if($list_account_permission['revenues_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
				  <tr>
                  <td>Estimates</td>
                  <td class="text-center"><input type="checkbox" id="estimates_red" class="account_module_permission" <?php if($list_account_permission['estimates_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="estimates_wr" class="account_module_permission" <?php if($list_account_permission['estimates_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="estimates_del" class="account_module_permission" <?php if($list_account_permission['estimates_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
				  <tr>
                  <td>Invoice</td>
                  <td class="text-center"><input type="checkbox" id="invoice_red" class="account_module_permission" <?php if($list_account_permission['invoice_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="invoice_wr" class="account_module_permission" <?php if($list_account_permission['invoice_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="invoice_del" class="account_module_permission" <?php if($list_account_permission['invoice_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
				  <tr>
                  <td>payments</td>
                  <td class="text-center"><input type="checkbox" id="payments_red" class="account_module_permission" <?php if($list_account_permission['payments_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="payments_wr" class="account_module_permission" <?php if($list_account_permission['payments_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="payments_del" class="account_module_permission" <?php if($list_account_permission['payments_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
				  <tr>
                  <td>Taxes</td>
                  <td class="text-center"><input type="checkbox" id="taxes_red" class="account_module_permission" <?php if($list_account_permission['taxes_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="taxes_wr" class="account_module_permission" <?php if($list_account_permission['taxes_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="taxes_del" class="account_module_permission" <?php if($list_account_permission['taxes_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
				  <tr>
                  <td>Cancel Leaves</td>
                  <td class="text-center"><input type="checkbox" id="leaves_red" class="account_module_permission" <?php if($list_account_permission['leaves_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="leaves_wr" class="account_module_permission" <?php if($list_account_permission['leaves_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="leaves_del" class="account_module_permission" <?php if($list_account_permission['leaves_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
				  
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-md-4">
          <h6 class="card-title m-b-20">Module Permission (Employee)</h6>
          <div class="table-responsive">
            <table class="table table-striped custom-table">
              <thead>
                <tr>
                  <th>Module Permission</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Create</th>
                  <th class="text-center">Delete</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Leaves</td>
                  <td class="text-center"><input type="checkbox" id="leave_em_per_red" class="employee_module_permission" <?php if($list_employee_permission['leave_em_per_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="leave_em_per_wr" class="employee_module_permission" <?php if($list_employee_permission['leave_em_per_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="leave_em_per_del" class="employee_module_permission" <?php if($list_employee_permission['leave_em_per_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
                <tr>
                  <td>Cancel Leaves</td>
                  <td class="text-center"><input type="checkbox" id="cancel_leave_red" class="employee_module_permission" <?php if($list_employee_permission['cancel_leave_red']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox" id="cancel_leave_wr" class="employee_module_permission" <?php if($list_employee_permission['cancel_leave_wr']=='on'){ ?>checked<?php }?>></td>
                  <td class="text-center"><input type="checkbox"  id="cancel_leave_del" class="employee_module_permission" <?php if($list_employee_permission['cancel_leave_del']=='on'){ ?>checked<?php }?>></td>
                </tr>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    
    <!-- /Page Content --> 
    
    <!-- Add Role Modal -->
    <div id="add_role" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form action="roles-permissions.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Role Name <span class="text-danger">*</span></label>
                <input class="form-control" name="countr" type="text">
              </div>
              <div class="submit-section">
                <label>If Role <strong>HR</strong> Please check here
                  <input type="radio" name="primary_role" value="hr">
                  or <strong>Accountant</strong> check here
                  <input type="radio" name="primary_role" value="accountant">
                </label>
                <button name="counter" type="submit" class="btn btn-primary submit-btn">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /Add Role Modal --> 
    
    <!-- Edit Role Modal -->
    <div id="edit_role" class="modal custom-modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-md">
          <div class="modal-header">
            <h5 class="modal-title">Edit Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label>Role Name <span class="text-danger">*</span></label>
                <input class="form-control" value="Team Leader" type="text">
              </div>
              <div class="submit-section">
                <button class="btn btn-primary submit-btn">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /Edit Role Modal --> 
    
    <!-- Delete Role Modal --> 
    
    <!-- /Delete Role Modal --> 
    
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

<!-- Custom JS --> 
<script src="assets\js\app.js"></script> 
<script>
	//hr module access
		$('.module_hr').click(function(){
			var id = []; 
			if($(this).is(":checked"))  
                {  
                     id.push($(this).val());  
                }
			id = id.toString(); 
		var mid = $(this).attr("id");
		//var priceid = $('#priceid' + id + '').val();
		$('.ajax-loader').show();
		$.ajax({
			url : "hr_module_process.php",
			method:"post",
			datatype:"text",
			data:{id:id,mid:mid},
			success:function(msg){
		$('#subtotalcart').html(msg);
				$('.ajax-loader').hide();
			}
		});
	});
			// Account module Access
			
			$('.ac_module').click(function(){
			var id = []; 
			if($(this).is(":checked"))  
                {  
                     id.push($(this).val());  
                }
			id = id.toString(); 
		var mid = $(this).attr("id");
		//var priceid = $('#priceid' + id + '').val();
		$('.ajax-loader').show();
		$.ajax({
			url : "account_module_process.php",
			method:"post",
			datatype:"text",
			data:{id:id,mid:mid},
			success:function(msg){
		$('#subtotalcart').html(msg);
				$('.ajax-loader').hide();
			}
		});
	});
			
			//Employee Module Access
			
			$('.emp_module').click(function(){
			var id = []; 
			if($(this).is(":checked"))  
                {  
                     id.push($(this).val());  
                }
			id = id.toString(); 
		var mid = $(this).attr("id");
		//var priceid = $('#priceid' + id + '').val();
		$('.ajax-loader').show();
		$.ajax({
			url : "employee_module_process.php",
			method:"post",
			datatype:"text",
			data:{id:id,mid:mid},
			success:function(msg){
		$('#subtotalcart').html(msg);
				$('.ajax-loader').hide();
			}
		});
	});
	
	//HR Module Permission
			
			$('.hr_module_permission').click(function(){
			var id = []; 
			if($(this).is(":checked"))  
                {  
                     id.push($(this).val());  
                }
			id = id.toString(); 
		var mid = $(this).attr("id");
		//var priceid = $('#priceid' + id + '').val();
		$('.ajax-loader').show();
		$.ajax({
			url : "hr_module_permission_process.php",
			method:"post",
			datatype:"text",
			data:{id:id,mid:mid},
			success:function(msg){
		$('#subtotalcart').html(msg);
				$('.ajax-loader').hide();
			}
		});
	});
	
	//Account Module Permission
			
			$('.account_module_permission').click(function(){
			var id = []; 
			if($(this).is(":checked"))  
                {  
                     id.push($(this).val());  
                }
			id = id.toString(); 
		var mid = $(this).attr("id");
		//var priceid = $('#priceid' + id + '').val();
		$('.ajax-loader').show();
		$.ajax({
			url : "account_module_permission_process.php",
			method:"post",
			datatype:"text",
			data:{id:id,mid:mid},
			success:function(msg){
		$('#subtotalcart').html(msg);
				$('.ajax-loader').hide();
			}
		});
	});
	
	//Employee Module Permission
			
			$('.employee_module_permission').click(function(){
			var id = []; 
			if($(this).is(":checked"))  
                {  
                     id.push($(this).val());  
                }
			id = id.toString(); 
		var mid = $(this).attr("id");
		//var priceid = $('#priceid' + id + '').val();
		$('.ajax-loader').show();
		$.ajax({
			url : "employee_module_permission_process.php",
			method:"post",
			datatype:"text",
			data:{id:id,mid:mid},
			success:function(msg){
		$('#subtotalcart').html(msg);
				$('.ajax-loader').hide();
			}
		});
	});
		
		</script>
</body>
</html>