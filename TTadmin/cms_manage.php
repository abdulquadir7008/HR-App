<?php 

include('includes/configset.php');

$page_name=$_REQUEST['page_name'];

$content=$_REQUEST['content'];
$page_id=$_REQUEST['page_id'];
$category=$_REQUEST['category'];
$sidebar=$_REQUEST['sidebar'];
$topbar=$_REQUEST['topbar'];
$footer=$_REQUEST['footer'];
$sortorder=$_REQUEST['sortorder'];
$seokeyword2=$_REQUEST['seo_keyword'];
$seokeyword = str_replace(' ','-',$page_name);
$seokeyword24=str_replace(' ','-',$seokeyword2);
$sekey=mb_strtolower($seokeyword24);
$sekey2=mb_strtolower($seokeyword);
$image=$_REQUEST['image'];
$meta_title=$_REQUEST['meta_title'];
$meta_description=$_REQUEST['meta_description'];
$meta_keywords=$_REQUEST['meta_keywords'];
$shortdescription=$_REQUEST['shortdescription'];
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

if($_FILES["image2"]["name"]!='')
{
if (($_FILES["image2"]["type"] == "image/gif")
|| ($_FILES["image2"]["type"] == "image/jpeg")
|| ($_FILES["image2"]["type"] == "image/pjpeg")
|| ($_FILES["image2"]["type"] == "image/X-PNG")
|| ($_FILES["image2"]["type"] == "image/PNG")
|| ($_FILES["image2"]["type"] == "image/png")
|| ($_FILES["image2"]["type"] == "image/x-png"))
{
$image2="../$path".$rand1.$_FILES["image2"]["name"];
$image01=$rand1.$_FILES["image2"]["name"];
move_uploaded_file($_FILES["image2"]["tmp_name"],$image2);
}
else
{
$image01='';
}
}

else
{
$image01=$_REQUEST['hiddenimage2'];
}

if(isset($_REQUEST['update']))
{


$query="update cms_pages SET page_name='$page_name',sortorder=$sortorder, seo_keyword='$sekey',content='$content', topbar='$topbar',footer='$footer',sidebar='$sidebar',category='$category' ,meta_title='$meta_title',meta_description='$meta_description',meta_keywords='$meta_keywords',image='$image0',shortdescription='$shortdescription',image2='$image01' WHERE page_id=$page_id";
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
$query="insert into cms_pages(page_name,sortorder,seo_keyword,content,category,sidebar,topbar,footer,meta_title,meta_description,meta_keywords,status,image,shortdescription,image2) values('$page_name','$sortorder','$sekey2','$content','$category','$sidebar','$topbar','$footer','$meta_title','$meta_description','$meta_keywords','1','$image0','$shortdescription','$image01')";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = ' Record Add successfully.';
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
}

else if(isset($_REQUEST['page_id']) || isset($_REQUEST['page_id1']))
{
if(isset($_REQUEST['page_id']))
{
$page_id=$_REQUEST['page_id'];
$status='0';
}
else if(isset($_REQUEST['page_id1']))
{
$page_id=$_REQUEST['page_id1'];	
$status='1';
}
else
{
$status='0';	
}
$query="update cms_pages SET status='$status' WHERE page_id='$page_id'";         
mysqli_query($link,$query);
}
else if(isset($_REQUEST['del']))
{
$id=$_REQUEST['del'];
$query="delete from cms_pages WHERE page_id=$id";
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
document.frmUser.action = "script/all-delate.php";
document.frmUser.submit();
}
}
function setInactiveAction() {
document.frmUser.action = "script/allinactive.php";
document.frmUser.submit();
}
function setActiveAction() {
document.frmUser.action = "script/activepage.php";
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
      <h1> Manage CMS <small>Content Managment System</small> </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">CMS</a></li>
        <li class="active">Manage Page</li>
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
              <h3 class="box-title">All pages List for Content Managment System</h3>
              <a href="cms_form.php">
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
                      <th>Heading</th>
                      <th>URL Link</th>
                      <th>Modify</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
				  
$sql_cms="select * from cms_pages where category='' order by sortorder ASC"; 
 $result_cms=mysqli_query($link,$sql_cms); 
 while($row_cms=mysqli_fetch_array($result_cms)) { 
?>
                    <tr>
                      <td><input type="checkbox" name="users[]" value="<?php echo $row_cms["page_id"]; ?>" /></td>
                      <td><?php echo $row_cms['sortorder'];?></td>
                      <td><?php 
												
												echo $row_cms['page_name'];
												
												?></td>
                      <td><?php echo $row_cms['seo_keyword'];?></td>
                      <td><a href="cms_form.php?cms=<?php echo $row_cms['page_id'];?>" class="edit_btn"><span>Edit</span></a>
                        <?php if($row_cms['status']==1){ ?>
                        <span><a href="cms_manage.php?page_id=<?php echo $row_cms['page_id']; ?>" title="Active" class="active"><span>ac</span></a></span>
                        <?php } else { ?>
                        <span><a href="cms_manage.php?page_id1=<?php echo $row_cms['page_id']; ?>" title="Inactive" class="inact"><span>in</span></a></span>
                        <?php } ?>
                        <span><a href="cms_manage.php?del=<?php echo $row_cms['page_id']; ?>" onClick="return confirm('Do you really want to remove it?')" class="delet"><span>Delete</span></a></span></td>
                    </tr>
                    <?php
		   				$sub_category=$row_cms['page_id'];
						$caterand='category';
						$sql1245 ="SELECT * FROM cms_pages WHERE category=$sub_category";
						if($sub_category)
						{
						$result_sub=mysqli_query($link,$sql1245); 
 while($row_cms587=mysqli_fetch_array($result_sub)) { 
		   ?>
                    <tr>
                      <td><input type="checkbox" name="users[]" value="<?php echo $row_cms587["page_id"]; ?>" /></td>
                      <td><?php echo $row_cms587['sortorder'];?></td>
                      <td><?php 
					 
												echo $row_cms['page_name']." /<b> ".$row_cms587['page_name']."</b>";
												
												?></td>
                      <td><?php echo $row_cms587['seo_keyword'];?></td>
                      <td><a href="cms_form.php?cms=<?php echo $row_cms587['page_id'];?>" class="edit_btn"><span>Edit</span></a>
                        <?php if($row_cms587['status']==1){ ?>
                        <span><a href="cms_manage.php?page_id=<?php echo $row_cms587['page_id']; ?>" title="Active" class="active"><span>ac</span></a></span>
                        <?php } else { ?>
                        <span><a href="cms_manage.php?page_id1=<?php echo $row_cms587['page_id']; ?>" title="Inactive" class="inact"><span>in</span></a></span>
                        <?php } ?>
                        <span><a href="cms_manage.php?del=<?php echo $row_cms587['page_id']; ?>" onClick="return confirm('Do you really want to remove it?')" class="delet"><span>Delete</span></a></span></td>
                    </tr>
                    <?php
		   				$sub_category12=$row_cms587['page_id'];
						$caterand12='category';
						$sql12452 ="SELECT * FROM cms_pages WHERE $sub_category12=$caterand12";
						if($sub_category12)
						{
						
						$result_sub1=mysqli_query($link,$sql12452); 
 while($row_cms5871=mysqli_fetch_array($result_sub1)) { 
		   ?>
                    <tr>
                      <td><input type="checkbox" name="users[]" value="<?php echo $row_cms5871["page_id"]; ?>" /></td>
                      <td><?php echo $row_cms5871['sortorder'];?></td>
                      <td><?php echo $row_cms['page_name']." / ".$row_cms587['page_name']." /<b> ".$row_cms5871['page_name']."</b>";				?></td>
                      <td><?php echo $row_cms5871['seo_keyword'];?></td>
                      <td><a href="cms_form.php?cms=<?php echo $row_cms5871['page_id'];?>" class="edit_btn"><span>Edit</span></a>
                        <?php if($row_cms5871['status']==1){ ?>
                        <span><a href="cms_manage.php?page_id=<?php echo $row_cms5871['page_id']; ?>" title="Active" class="active"><span>ac</span></a></span>
                        <?php } else { ?>
                        <span><a href="cms_manage.php?page_id1=<?php echo $row_cms5871['page_id']; ?>" title="Inactive" class="inact"><span>in</span></a></span>
                        <?php } ?>
                        <span><a href="cms_manage.php?del=<?php echo $row_cms587['page_id']; ?>" onClick="return confirm('Do you really want to remove it?')" class="delet"><span>Delete</span></a></span></td>
                    </tr>
                    <?php } } ?>
                    <?php } } ?>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>All</th>
                      <th>Order</th>
                      <th>Heading</th>
                      <th>URL Link</th>
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
