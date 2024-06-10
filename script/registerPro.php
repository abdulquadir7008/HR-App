    <?php 
include("../config.php");
ob_start();
$sess=session_id();
$account_type=$_POST['account_type'];
$fullname=$_POST['fullname'];
$role=$_POST['role'];
$dob=$_POST['dob'];
$city=$_POST['city'];
$id=$_POST['id'];
$email=$_POST['email'];
$phone=$_POST['phone'];

function generate_password($length = 20){
    $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.
              '0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';
  
    $str = '';
    $max = strlen($chars) - 1;
  
    for ($i=0; $i < $length; $i++)
      $str .= $chars[mt_rand(0, $max)];
  
    return $str;
  }
  $password = generate_password();

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


$query="update users SET fullname='$fullname',role='$role',dob='$dob',city='$city',image='$image0',account_type='$account_type',email='$email',phone='$phone' WHERE id=$id";
mysqli_query($link,$query);

$errmsg_arr = array();
$errflag = false;
$errmsg_arr[] = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname create modified Successfully.</span></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
header('Location: ../uselist.php');
}
else if(isset($_REQUEST['add']))
{
$querybord="insert into users (account_type,fullname,role,dob,sesion,city,image,email,phone,status,password) 
values('$account_type','$fullname','$role','$dob','$sess','$city','$image0','$email','$phone','1','$password')";
mysqli_query($link,$querybord);


$email_massage="<table cellspacing='0' border='0' cellpadding='0' width='100%' bgcolor='#f2f3f8'>
<tr>
  <td>
    <table style='background-color: #f2f3f8; max-width:670px; margin:0 auto;' width='100%' border='0' align='center'
      cellpadding='0' cellspacing='0'>
      <tr>
        <td style='height:80px;'>&nbsp;</td>
      </tr>
      <tr>
        <td style='text-align:center;'>
          <a href='#' title='logo'>
            <img width='210' src='https://hostsplendid.com/CRM/images/logo.png' title='logo' alt='logo'>
          </a>
        </td>
      </tr>
      <tr>
        <td height='40px;'>&nbsp;</td>
      </tr>
      <tr>
        <td>
          <table width='95%' border='0' align='center' cellpadding='0' cellspacing='0'
            style='max-width:600px; background:#fff; border-radius:3px; text-align:left;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);'>
            <tr>
              <td style='padding:40px;'>
                <table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>
                  <tr>
                    <td>
                      <h1 style='color: #1e1e2d; font-weight: 500; margin: 0; font-size: 32px;font-family:'Rubik',sans-serif;'>Hi $fullname,</h1>
                      <p style='font-size:15px; color:#455056; line-height:24px; margin:8px 0 30px;'>Welcome to Join Splendid.</p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                     <p>Username : $email</p>
                     <p>Password : $password</p>
                     <p>If you want to change the password. Please go though the application.</p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td style='height:25px;'>&nbsp;</td>
      </tr>
     
    </table>
  </td>
</tr>
</table>";
    $email_subject = "Regstered in Splendid - ".$fullname;
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: www.splendid.ae"."<support@splendid.ae>\r\n";
    mail($email, $email_subject, $email_massage, $headers); 



//header('Location: ' . $_SERVER['HTTP_REFERER']);
$errmsg_arr[] = "<div class='col-md-12'><div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Sucess - </b> $fullname create Acount Successfully.</span></div></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: https://hostsplendid.com/CRM/uselist.php');
}
else
{
$errmsg_arr[] = "<div class='col-md-12'><div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><i class='material-icons'>close</i></button><span><b> Warning - </b> Filled the form Correctly.</span></div></div>";
$errflag = true;
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();
header('Location: ' . $_SERVER['HTTP_REFERER']);

}
ob_end_flush();

?>
