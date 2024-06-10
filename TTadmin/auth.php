<?PHP
if(!isset($_SESSION['SESS_ADMIN_ID'])||(trim($_SESSION['SESS_ADMIN_ID'])=='')){

$errmsg_arr[] = 'Please fill in username and password.';
$errflag = true;
if($errflag) {
$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
session_write_close();	
header("location:login.php");
exit();
}
}
$_SESSION['SESS_ADMIN_USER'];


function upload_image($image_field_name, $dir_path)
{
		$resized_path = $dir_path;
		if (!file_exists($dir_path)) 
		{
			mkdir($dir_path);
			chmod($dir_path, 0755);
        }

		if (!file_exists($resized_path)) 
		{
			mkdir($resized_path);
			chmod($resized_path, 0755);
        }
		if(!empty($_FILES[$image_field_name]['tmp_name']))
		{
			$info = getimagesize($_FILES[$image_field_name]['tmp_name']);		
			$originalfilename = basename($_FILES[$image_field_name]['name']);
			$imagetarget = resolve_filename_collisions($dir_path, array(basename($_FILES[$image_field_name]['name'])), $format='%s_%d.%s');
			$originalfile = $dir_path.$imagetarget[0];

			/*$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $originalfile);			
			$destinationfile =  $resized_path.$imagetarget[0];
			$destinationfile1 =  str_replace($ext,'_f1.'.$ext,$destinationfile);
			$destinationfile2 =  str_replace($ext,'_f2.'.$ext,$destinationfile);*/

			$destinationfile1 =  $resized_path.'f1_'.$imagetarget[0];
			$destinationfile2 =  $resized_path.'f2_'.$imagetarget[0];
			$destinationfile3 =  $resized_path.'f3_'.$imagetarget[0];
			$destinationfile4 =  $resized_path.'f4_'.$imagetarget[0];
			$destinationfile5 =  $resized_path.'f5_'.$imagetarget[0];
			$destinationfile6 =  $resized_path.'f6_'.$imagetarget[0];
			$destinationfile7 =  $resized_path.'f7_'.$imagetarget[0];
												
			if(move_uploaded_file($_FILES[$image_field_name]['tmp_name'],$originalfile))
			{
				wp_resize_logo($originalfile,$destinationfile1,$originalfilename,'80','80');
				wp_resize_logo($originalfile,$destinationfile2,$originalfilename,'150','117');
				wp_resize_logo($originalfile,$destinationfile3,$originalfilename,'180','150');
				wp_resize_logo($originalfile,$destinationfile4,$originalfilename,'270','234');
				wp_resize_logo($originalfile,$destinationfile5,$originalfilename,'605','255');
				wp_resize_logo($originalfile,$destinationfile6,$originalfilename,'380','850');
				wp_resize_logo($originalfile,$destinationfile7,$originalfilename,'700','551');
				return $imagetarget[0];
			}else{
				return 0;
			}
		}
		else
		{
			return 0;
		}

}
function kadir(){
$sql_cms="select * from newsletter";
$result_cms=mysqli_query($link,$sql_cms); 
while($row_cms=mysqli_fetch_array($result_cms)){echo $row_cms['email'].',';}
 }

$sql_news="select * from newsltr WHERE id=$id AND status='1'"; 
 $result_news=mysqli_query($link,$sql_news); 
 @$row_news=mysqli_fetch_array($result_news);
  
  function new_title(){
  echo $row_news['title'];
  }
   function new_content(){
	   echo $row_news['content'];
   }

?>