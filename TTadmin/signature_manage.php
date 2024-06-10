<?php 
include('includes/configset.php');

$id=$_REQUEST['id'];
$image=$_REQUEST['image'];
$status=$_REQUEST['status'];

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
$image="../$path".$rand1.$_FILES["image"]["name"];
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



if(isset($_REQUEST['update']))
{

$query="update signature SET image='$image0' WHERE id=$id";
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
$query="insert into signature(image,status) values('$image0','1')";
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
$query="update signature SET status='$status' WHERE id='$id'";         
mysqli_query($link,$query);
}
else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from signature WHERE id=$id";
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
document.frmUser.action = "script/all-delatenews.php";
document.frmUser.submit();
}
}
function setInactiveAction() {
document.frmUser.action = "script/allinactivenews.php";
document.frmUser.submit();
}
function setActiveAction() {
document.frmUser.action = "script/activepagenews.php";
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
      <h1> Manage SIGNATURE DISHES </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">CMS</a></li>
        <li class="active">SIGNATURE DISHES</li>
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
              <h3 class="box-title">All pages List for SIGNATURE DISHES</h3>
              <form action="signature_manage.php" method="post" enctype="multipart/form-data" name="cont"  id="myform" onSubmit="return validate();">
              <div class="add_img_gell"><label>Add Image</label> <input type="file" name="image" id="image" />
              <button type="submit"  name="add" class="btn btn-primary">add</button>
              </div>
             </form> 
               </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <form name="frmUser" method="post" action="">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>All</th>
                      <th>Image</th>
                      <th>Image Path</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
				  
$sql_cms="select * from signature order by id DESC"; 
 $result_cms=mysqli_query($link,$sql_cms); 
 while($row_cms=mysqli_fetch_array($result_cms)) { 
?>
                    <tr>
                      <td><input type="checkbox" name="users[]" value="<?php echo $row_cms["id"]; ?>" /></td>
                      <td><?php if($row_cms['image']!='') { image_size(); ?>
                      <img src="../uploads/<?php echo $row_cms['image'];?>" width="<?php echo $width; ?>70" height="<?php echo $height; ?>70" class="alignLeft" />
                      <?php } ?>
												
												</td>
                      <td> <span id="p<?php echo $row_cms['id'];?>"><?php echo $domain_url."/uploads/".$row_cms['image']; ?></span> <button onclick="copyToClipboard('#p<?php echo $row_cms['id'];?>')">Copy</button> </td>
                      <td>
                        <?php if($row_cms['status']==1){ ?>
                        <span><a href="signature_manage.php?id=<?php echo $row_cms['id']; ?>" title="Active" class="active"><span>ac</span></a></span>
                        <?php } else { ?>
                        <span><a href="signature_manage.php?id1=<?php echo $row_cms['id']; ?>" title="Inactive" class="inact"><span>in</span></a></span>
                        <?php } ?>
                        <span><a href="signature_manage.php?del=<?php echo $row_cms['id']; ?>" onClick="return confirm('Do you really want to remove it?')" class="delet"><span>Delete</span></a></span></td>
                    </tr>
                    
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>All</th>
                      <th>Image</th>
                      <th>Image Path</th>
                      <th>Modify</th>
                    </tr>
                  </tfoot>
                </table>
                
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
			function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}

        </script>
</body>
</html>
