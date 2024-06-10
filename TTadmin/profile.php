<?php include('includes/configset.php'); ?>
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
    <h1> Manage CMS <small>advanced tables</small> </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Data tables</li>
    </ol>
  </section>
  
  <!-- Main content -->
  <section class="content">
  <?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
foreach($_SESSION['ERRMSG_ARR'] as $msg) {
echo "<div style='background:#d5f0e4; color:#3d9970; text-align:center; margin-bottom:10px; line-height:45px; font-weight:bold;'>".$msg."</div>";  
}
unset($_SESSION['ERRMSG_ARR']); }?>
<?php 
if (isset($_REQUEST['cms'])){$admin_id=$_REQUEST['cms'];}else{$admin_id=0;}
$sql_cms="select * from admin_login WHERE admin_id=$admin_id"; 
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
<form action="script/setting_script.php" method="post" enctype="multipart/form-data" name="cont"  id="register" onSubmit="return validate();">
  <div class="row"> 
    <!-- left column -->
    <div class="col-md-6">
    <!-- general form elements -->
    <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title">Profile Details</h3>
    </div>
    <!-- /.box-header --> 
    <!-- form start -->
    
      <div class="box-body">
        <div class="input-group atoemail"> <span class="input-group-addon">@</span>
          <input type="text" name='username' class="form-control" placeholder="Username" value="<?php echo $row_cms['username']; ?>">
        </div>
        <br/>
        <div class="input-group atoemail"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
          <input type="text" class="form-control" name="email_address" placeholder="Email" value="<?php echo $row_cms['email_address']; ?>">
        </div>
        <br/>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          
          <input type="password" name="password"  class="form-control" id="password" placeholder="Password" required >
        <span id="result"></span>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Confirm Password</label>
          <input type="password" class="form-control" id="cfmPassword" placeholder="Password">
        </div>
        
        <div class="form-group">
          <label for="exampleInputFile">Logo Input</label>
          <?php if($row_cms['image']!='') { image_size(); ?>
      <img src="../uploads/<?php echo $row_cms['image'];?>" width="<?php echo $width; ?>150" height="<?php echo $height; ?>" class="alignLeft" />
      <br>
	  <?php } ?>
    <input type="file" name="image" id="image" />
    <input type="hidden" name="hiddenimage" id="image" value="<?php echo $row_cms['image']; ?>" />
        </div>
      </div>
      <!-- /.box-body -->
      
      </div>
      
      <div class="box box-warning">
      <div class="box-header">
        <h3 class="box-title">General Elements</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      
      <!-- text input -->
      <div class="form-group">
        <label>First Name</label>
        <input type="text" class="form-control" name="firstname" placeholder="Enter ..." value="<?php echo $row_cms['firstname']; ?>" />
      </div>
      <div class="form-group">
        <label>Last Name</label>
        <input type="text" class="form-control" name="lastname" placeholder="Enter ..." value="<?php echo $row_cms['lastname']; ?>"  />
      </div>
      <div class="form-group">
          <label for="exampleInputPassword1">URL</label>
          <input type="text" class="form-control"  name="url" id="exampleInputPassword1" placeholder="Enter ..." value="<?php echo $row_cms['url']; ?>" >
        </div>
     <div class="form-group">
          <label for="exampleInputPassword1">Copy Right</label>
          <input type="text" class="form-control" name="copyright" id="exampleInputPassword1" placeholder="Enter ..." value="<?php echo $row_cms['copyright']; ?>" >
        </div>
        
        <div class="form-group">
          <label for="exampleInputPassword1">Address</label>
          <input type="text" class="form-control" name="address" placeholder="Enter ..." value="<?php echo $row_cms['address']; ?>" >
        </div>
        
        <div class="form-group">
          <label for="exampleInputPassword1">Phone</label>
          <input type="text" class="form-control" name="phone" placeholder="Enter ..." value="<?php echo $row_cms['phone']; ?>" >
        </div>
        
        <div class="form-group">
          <label for="exampleInputPassword1">Time</label>
          <input type="text" class="form-control" name="time" placeholder="Enter ..." value="<?php echo $row_cms['time']; ?>" >
        </div>
  </div>
  <!-- /.box-body --> 
</div>
      
      <!-- /.box -->
      
      </div>
      <!--/.col (left) --> 
      <!-- right column -->
      <div class="col-md-6">
      <!-- general form elements disabled -->
      <div class="box box-info">
      <div class="box-header">
      <h3 class="box-title">Serach Engine Optimize</h3>
    </div>
        <div class="box-body">
          <div class="form-group">
            <label>Meta Title</label>
            <input type="text" class="form-control" name="metatitle" placeholder="Enter ..." value="<?php echo $row_cms['metatitle']; ?>" />
          </div>
          <div class="form-group">
            <label>Meta Keywords</label>
            <textarea class="form-control" rows="3" name="metakeywords" placeholder="Enter ..."><?php echo $row_cms['metakeywords']; ?></textarea>
          </div>
          <div class="form-group">
            <label>Meta Description</label>
            <textarea class="form-control" rows="3" name="metadescription" placeholder="Enter ..."><?php echo $row_cms['metadescription']; ?></textarea>
          </div>
          <div class="form-group">
            <label>Footer Description</label>
            <textarea class="form-control" rows="3" name="footer_description" placeholder="Enter ..."><?php echo $row_cms['footer_description']; ?></textarea>
          </div>
          <div class="form-group">
          <label for="exampleInputPassword1">Alt Email</label>
          <input type="text" class="form-control" name="altemail" placeholder="Enter ..." value="<?php echo $row_cms['altemail']; ?>" >
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Alt Phone</label>
          <input type="text" class="form-control" name="altphone" placeholder="Enter ..." value="<?php echo $row_cms['altphone']; ?>" >
        </div>
        </div>
      </div>
<div class="box box-success">
   <div class="box-header">
        <h3 class="box-title">Social Network Links</h3>
      </div>
   <div class="box-body">
   
    <div class="form-group">
        <label>Facebook Link </label>
        <span>
        <?php if($row_cms['fbchk']) { ?>
        <input type="checkbox" value="1" checked="checked" name="fbchk"  />
        <?php } else { ?>
        <input type="checkbox" name="fbchk" value="1"  />
        <?php } ?>
        
        Frontend</span>
        <input type="text" class="form-control" name="fblink" placeholder="Enter ..." value="<?php echo $row_cms['fblink']; ?>" />
      </div>
      <div class="form-group">
        <label>Instagram Link</label>
        <span>
        <?php if($row_cms['yuchk']) { ?>
        <input type="checkbox" value="1" checked="checked" name="yuchk"  />
        <?php } else { ?>
        <input type="checkbox" name="yuchk" value="1"  />
        <?php } ?>
        Frontend</span>
        <input type="text" class="form-control" name="yulink" placeholder="Enter ..." value="<?php echo $row_cms['yulink']; ?>" />
      </div>
      <div class="form-group">
        <label>Twitter Link</label>
        <span>
        <?php if($row_cms['twchk']) { ?>
        <input type="checkbox" value="1" checked="checked" name="twchk"  />
        <?php } else { ?>
        <input type="checkbox" name="twchk" value="1"  />
        <?php } ?>
        Frontend</span>
        <input type="text" class="form-control" name="twlink" placeholder="Enter ..." value="<?php echo $row_cms['twlink']; ?>"  />
      </div>
      
      <!-- textarea -->
      <div class="form-group">
        <label>Linked Link</label>
        <span>
        <?php if($row_cms['lichk']) { ?>
        <input type="checkbox" value="1" checked="checked" name="lichk"  />
        <?php } else { ?>
        <input type="checkbox" name="lichk" value="1"  />
        <?php } ?>
        Frontend</span>
        <input type="text" class="form-control" name="lilink" placeholder="Enter ..." value="<?php echo $row_cms['lilink']; ?>" />
      </div>
      
      <div class="form-group">
        <label>GPlus Link</label>
        <span>
        <?php if($row_cms['gpchk']) { ?>
        <input type="checkbox" value="1" checked="checked" name="gpchk"  />
        <?php } else { ?>
        <input type="checkbox" name="gpchk" value="1"  />
        <?php } ?>
        Frontend</span>
        <input type="text" class="form-control" name="gplus" placeholder="Enter ..." value="<?php echo $row_cms['gplus']; ?>" />
      </div>
      <div class="box-footer">
        <input type='hidden' name='admin_id' id='admin_id' maxlength="50"   size="30" value="<?php echo $row_cms['admin_id']; ?>"/>
                <button type="submit" name="<?php echo $sub ?>" class="btn btn-primary"><?php echo $sub2 ?></button>

      </div>
    
   </div>                     
                        
                        
                        </div>
<!-- /.box -->
</div>
<!--/.col (right) -->
</div>
</form>
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

<script type="text/javascript">
$(document).ready(function() {
 
    $('#password').keyup(function(){
        $('#result').html(checkStrength($('#password').val()))
    })  
 
    function checkStrength(password){
 
    //initial strength
    var strength = 0
 
    //if the password length is less than 6, return message.
    if (password.length < 6) {
        $('#result').removeClass()
        $('#result').addClass('short')
        return 'Too short'
    }
 
    //length is ok, lets continue.
 
    //if length is 8 characters or more, increase strength value
    if (password.length > 7) strength += 1
 
    //if password contains both lower and uppercase characters, increase strength value
    if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
 
    //if it has numbers and characters, increase strength value
    if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
 
    //if it has one special character, increase strength value
    if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
 
    //if it has two special characters, increase strength value
    if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/)) strength += 1
 
    //now we have calculated strength value, we can return messages
 
    //if value is less than 2
    if (strength < 2 ) {
        $('#result').removeClass()
        $('#result').addClass('weak')
        return 'Weak'
    } else if (strength == 2 ) {
        $('#result').removeClass()
        $('#result').addClass('good')
        return 'Good'
    } else {
        $('#result').removeClass()
        $('#result').addClass('strong')
        return 'Strong'
    }
}
});

</script>
<script>

function validatePassword(){ 
 var validator = $("#loginForm").validate({
  rules: {                   
   password :"required",
   confirmpassword:{
    equalTo: "#password"
      }  
     },                             
     messages: {
      password :" Enter Password",
      confirmpassword :" Enter Confirm Password Same as Password"
     }
 });
 if(validator.form()){
  alert('Sucess');
 }
}

 </script>
</body>
</html>
