<?php 
include('includes/configset.php');
$title=$_REQUEST['title'];
$id=$_REQUEST['id'];
$date=$_REQUEST['date'];
$sortorder=$_REQUEST['sortorder'];
$status=$_REQUEST['status'];
$short_tttle=$_REQUEST['short_tttle'];
$desire_skill=$_REQUEST['desire_skill'];

$seokeyword = str_replace(' ','_',$title);
$sekey2=mb_strtolower($seokeyword);



if(isset($_REQUEST['update']))
{


$query="update career SET title='$title',seo_keyword='$sekey2', date=now(),sortorder='$sortorder',short_tttle='$short_tttle',desire_skill='$desire_skill' WHERE id=$id";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Record modified successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	

}

else if(isset($_REQUEST['add']))
{
$query="insert into career(title,seo_keyword,date,sortorder,status,short_tttle,desire_skill) values('$title','$sekey2',now(),'$sortorder','1','$short_tttle','$desire_skill')";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Record Add successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
}

else if(isset($_REQUEST['id']) || isset($_REQUEST['id1']))
{
if(isset($_REQUEST['id']))
{
$id=$_REQUEST['id'];
$status='0';
}
else if(isset($_REQUEST['id1']))
{
$id=$_REQUEST['id1'];	
$status='1';
}
else
{
$status='0';	
}
$query="update career SET status='$status' WHERE id='$id'";         
mysqli_query($link,$query);
}
else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from career WHERE id=$id";
mysqli_query($link,$query);
}
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

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
<script type="text/javascript">
function setDeleteAction() {
if(confirm("Are you sure want to delete these rows?")) {
document.frmUser.action = "script/all-delatetestimonial.php";
document.frmUser.submit();
}
}
function setInactiveAction() {
document.frmUser.action = "script/allinactivetestimonial.php";
document.frmUser.submit();
}
function setActiveAction() {
document.frmUser.action = "script/activepagetestimonial.php";
document.frmUser.submit();
}
</script>
</head>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<?php include('includes/head.php'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left"> 
  <!-- Left side column. contains the logo and sidebar -->
  <?php include('includes/sidebar.php'); ?>
  
  <!-- Right side column. Contains the navbar and content of the page -->
  <aside class="right-side"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Manage Career </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">career</a></li>
        <li class="active">Manage Career</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
    <?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div class='pad margin no-print'><div style='margin-bottom: 0!important;' class='alert alert-info'><i class='fa fa-info'></i><b>Note:</b>" .$msg."</div></div>";  
}
unset($_SESSION['ERRMSG_ARR']); }?>
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All pages List for Career</h3>
              <a href="career_form.php">
              <button class="btn btn-success" style="float:right; margin:10px;">Add New</button>
              </a> </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <form name="frmUser" method="post" action="">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>All</th>
                      <th>Order</th>
                      <th>Job Title</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
				  
$sql_cms="select * from career order by sortorder ASC"; 
 $result_cms=mysqli_query($link,$sql_cms); 
 while($row_cms=mysqli_fetch_array($result_cms)) { 
?>
                    <tr>
                      <td><input type="checkbox" name="users[]" value="<?php echo $row_cms["id"]; ?>" /></td>
                      <td><?php echo $row_cms['sortorder'];?></td>
                      <td><?php 
												
												echo $row_cms['title'];
												
												?></td>
                      
                      <td><a href="career_form.php?cms=<?php echo $row_cms['id'];?>" class="edit_btn"><span>Edit</span></a>
                        <?php if($row_cms['status']==1){ ?>
                        <span><a href="career_manage.php?id=<?php echo $row_cms['id']; ?>" title="Active" class="active"><span>ac</span></a></span>
                        <?php } else { ?>
                        <span><a href="career_manage.php?id1=<?php echo $row_cms['id']; ?>" title="Inactive" class="inact"><span>in</span></a></span>
                        <?php } ?>
                        <span><a href="career_manage.php?del=<?php echo $row_cms['id']; ?>" onClick="return confirm('Do you really want to remove it?')" class="delet"><span>Delete</span></a></span></td>
                    </tr>
                    
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>All</th>
                      <th>Order</th>
                      <th>Name</th>

                      <th>Modify</th>
                    </tr>
                  </tfoot>
                </table>
                <input type="button" name="delete" value="All Delete" class="btn btn-danger btn-sm"  onClick="setDeleteAction();" />
                <input type="button" name="Inactive" value="All Inactive" class="btn btn-warning btn-sm" onClick="setInactiveAction();" />
                <input type="button" name="Active" class="btn btn-success btn-sm" value="All Active" onClick="setActiveAction();" />
              </form>
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
<script src="js/AdminLTE/app.js" type="text/javascript"></script> 
<!-- AdminLTE for demo purposes --> 
<script src="js/AdminLTE/demo.js" type="text/javascript"></script> 
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
</body>
</html>
