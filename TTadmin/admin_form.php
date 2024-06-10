<?php
include('includes/configset.php'); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>AdminLTE | Data Tables</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Theme style -->
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<?php include('includes/head.php'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left"> 
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('includes/sidebar.php'); ?>
  
      <?php 
if (isset($_REQUEST['cms'])){$id=$_REQUEST['cms'];}else{$id=0;}
$sql_cms="select * from users WHERE id=$id"; 
$result_cms=mysqli_query($link,$sql_cms); 
$row_cms=mysqli_fetch_array($result_cms);
?>
      <?php if(isset($_REQUEST['cms'])) { 
$sub="update";
$sub2="Update";
 } 
 else { 
 $sub="add";
 $sub2="Save";
 } ?>
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Manage Admin <small>Content Managment System</small> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">CMS</a></li>
        <li class="active"><?php if(isset($_REQUEST['cms'])) { 
			  echo "Modify admin Create - ".$row_cms['fullname'];
			  }
			  else
			  {
				echo "Add admin Create";  
			  }
			 
 ?> </li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">
              <?php if(isset($_REQUEST['cms'])) { 
			  echo "Modify admin Create- ".$row_cms['fullname'];
			  }
			  else
			  {
				echo "Add admin Create";  
			  }
			 
 ?> 
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <div class="box box-primary"> 
               <?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div class='pad margin no-print'><div style='margin-bottom: 0!important;' class='alert alert-info'><i class='fa fa-info'></i><b>Note:</b>" .$msg."</div></div>";  
}
unset($_SESSION['ERRMSG_ARR']); }?> 
                <!-- /.box-header --> 
                <!-- form start -->
                
                <form action="admin_manage.php" method="post" enctype="multipart/form-data" name="cont"  id="myform" onSubmit="return validate();">
                  <div class="box-body">
					  <div class="row">
					  	<div class="col-md-4">
						  <h4>Personal Details</h4>
						  <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" value="<?php echo $row_cms['email']; ?>">
                    </div>
							<div class="form-group">
                      <label for="exampleInputEmail1">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Enter Password" value="<?php echo $row_cms['password']; ?>">
                    </div>
							
							<div class="form-group">
                      <label for="exampleInputEmail1">Full Name</label>
                      <input type="text" name="fullname" class="form-control" id="exampleInputEmail1" placeholder="Enter Full Name" value="<?php echo $row_cms['fullname']; ?>">
                    </div>
							
							<div class="form-group">
                      <label for="exampleInputEmail1">Role</label>
                      <input type="text" name="role" class="form-control" id="exampleInputEmail1" placeholder="Enter Role" value="<?php echo $row_cms['role']; ?>">
                    </div>
							
							<div class="form-group">
                      <label for="exampleInputEmail1">DOB</label>
                      <input type="date" name="dob" class="form-control" id="exampleInputEmail1" placeholder="Enter DOB" value="<?php echo $row_cms['dob']; ?>">
                    </div>
							
						  </div>
						  
						  <div class="col-md-4">
						  <h4>Contact Details</h4>
						  <div class="form-group">
                      <label for="exampleInputEmail1">address</label>
							  <textarea name="address" rows="5" class="form-control" placeholder="Address"><?php echo $row_cms['address']; ?></textarea>
                    </div>
							
							
							<div class="form-group">
                      <label for="exampleInputEmail1">City</label>
                      <input type="text" name="city" class="form-control" id="exampleInputEmail1" placeholder="Enter City" value="<?php echo $row_cms['city']; ?>">
                    </div>
							
							<div class="form-group">
                      <label for="exampleInputEmail1">Country</label>
                      <input type="text" name="country" class="form-control" id="exampleInputEmail1" placeholder="Enter Country" value="<?php echo $row_cms['country']; ?>">
                    </div>
							
							
							
						  </div>
						  <div class="col-md-4">
						  <h4>Passport and Visa Details</h4>
						  <div class="form-group">
                      <label for="exampleInputEmail1">Vissa Expire</label>
                      <input type="date" name="vissa_expire" class="form-control" id="exampleInputEmail1" placeholder="Enter date" value="<?php echo $row_cms['vissa_expire']; ?>">
                    </div>
							
							
							<div class="form-group">
                      <label for="exampleInputEmail1">Vissa Number</label>
                      <input type="text" name="vissa_number" class="form-control" id="exampleInputEmail1" placeholder="Enter Vissa Number" value="<?php echo $row_cms['vissa_number']; ?>">
                    </div>
							
							<div class="form-group">
                      <label for="exampleInputEmail1">Passport Expire</label>
                      <input type="date" name="passport_expire" class="form-control" id="exampleInputEmail1" placeholder="Enter Passport Expire" value="<?php echo $row_cms['passport_expire']; ?>">
                    </div>
							
							<div class="form-group">
                      <label for="exampleInputEmail1">Passport Number</label>
                      <input type="text" name="passport_number" class="form-control" id="exampleInputEmail1" placeholder="Enter Passport Number" value="<?php echo $row_cms['passport_number']; ?>">
                    </div>
							  <div class="form-group">
                      <label for="exampleInputEmail1">Emirate ID</label>
                      <input type="text" name="emirateid" class="form-control" id="exampleInputEmail1" placeholder="Enter Emirate ID" value="<?php echo $row_cms['emirateid']; ?>">
                    </div>
							  <div class="form-group">
                      <label for="exampleInputEmail1">Emerite ID Expire</label>
                      <input type="date" name="emerite_id_expire" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" value="<?php echo $row_cms['emerite_id_expire']; ?>">
                    </div>
						  </div>
					  </div>
                  
                    
                    
                    
                    
                    
                    
                    
                    <div class="form-group">
                    <label for="exampleInputEmail1">Photo</label>
                      <input type="file" name="image" id="image" />
                      <input type="hidden" name="hiddenimage" id="image" value="<?php echo $row_cms['image']; ?>" />
                      <?php if($row_cms['image']!='') { image_size(); ?>
                      <img src="../uploads/<?php echo $row_cms['image'];?>" width="<?php echo $width; ?>100" height="<?php echo $height; ?>" class="alignLeft" />
                      <?php } ?>
                    </div>
                    
                    
                    
                  </div>
                  <!-- /.box-body -->
                  
                  <div class="box-footer">
                    <input type='hidden' name='id' id='id' maxlength="50"   size="30" value="<?php echo $row_cms['id']; ?>"/>
                    <button type="submit"  name="<?php echo $sub ?>" class="btn btn-primary"><?php echo $sub2 ?></button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-body --> 
          </div>
          <!-- /.box --> 
        </div>
      </div>
    </section>
    <!-- /.content --> 
  </aside>
  <!-- /.right-side --> 
</div>
<!-- ./wrapper --> 

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script> 
<!-- DATA TABES SCRIPT --> 
<script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script> 
<script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script> 
<!-- AdminLTE App --> 
<!-- InputMask -->
        <script src="js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>

<script src="js/AdminLTE/app.js" type="text/javascript"></script> 
<!-- AdminLTE for demo purposes --> 
<script src="js/AdminLTE/demo.js" type="text/javascript"></script>
 <script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
            });
        </script>
<!-- page script --> 
<script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script> 
<script src="//cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script> 
<!-- Bootstrap WYSIHTML5 --> 
<script src="../../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script> 
<script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('editor1');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>
        
</body>
</html>