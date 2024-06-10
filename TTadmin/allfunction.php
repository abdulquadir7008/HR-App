<?php
function category_sub_f(){
	$kader002=$id=$_REQUEST['cms'];
	$sq="SELECT * FROM category WHERE id=$kader002";
				$re=mysqli_query($link,$sq);
				$ro=mysqli_fetch_array($re);
				$id00=$ro['parent_id'];
				 echo "<option value=''>--Select Category---</option>";
                     $sql ="SELECT * FROM category WHERE status='1' AND parent_id=''";
					  $selected = '';
					$page_cont = mysqli_query($link,$sql);
					while($row_cms45=mysqli_fetch_array($page_cont)) { 
							if($id00==$row_cms45['id']){
								$selected = 'selected=selected';
							}
							else
							{
								$selected ='';
							}
						echo "<option value='".$row_cms45['id']."'".$selected.">".$row_cms45['pro_name']."</option>";
						$cd=$row_cms45['id'];
						$cater='parent_id';
						$sql12 ="SELECT * FROM category WHERE status='1' AND $cd=$cater";
						$page_cont2 = mysqli_query($link,$sql12);
						while($row_cms2=mysqli_fetch_array($page_cont2)) { 
							if($id00==$row_cms2['id']){
								$selected = 'selected=selected';
							}
							else
							{
								$selected ='';
							}
						
						echo "<option value='".$row_cms2['id']."' $selected style='padding-left:10px;'>".$row_cms2['pro_name']."</option>";
						$cd3=$row_cms2['id'];
						$cater2='parent_id';
						$sql122 ="SELECT * FROM category WHERE status='1' AND $cd3=$cater2";
						$page_cont4 = mysqli_query($link,$sql122);
						while($row_cms3=mysqli_fetch_array($page_cont4)) {
							
						echo "<option value='".$row_cms3['id']."' style='padding-left:20px;'>".$row_cms3['pro_name']."'</option>";
						}
						}
						
						}

	
	}


function page_parent_f($link){
	$kader=$page_id=$_REQUEST['cms'];
	$sq="SELECT * FROM cms_pages WHERE page_id=$kader";
				$re=mysqli_query($link,$sq);
				$ro=mysqli_fetch_array($re);
				$id00=$ro['category'];
				 echo "<option value=''>--Select Category---</option>";
                     $sql ="SELECT * FROM cms_pages WHERE status='1' AND category=''";
					  $selected = '';
					$page_cont = mysqli_query($link,$sql);
					while($row_cms45=mysqli_fetch_array($page_cont)) { 
							if($id00==$row_cms45['page_id']){
								$selected = 'selected=selected';
							}
							else
							{
								$selected ='';
							}
						echo "<option value='".$row_cms45['page_id']."'".$selected.">".$row_cms45['page_name']."</option>";
						$cd=$row_cms45['page_id'];
						$cater='category';
						$sql12 ="SELECT * FROM cms_pages WHERE status='1' AND $cd=$cater";
						$page_cont2 = mysqli_query($link,$sql12);
						while($row_cms2=mysqli_fetch_array($page_cont2)) { 
							if($id00==$row_cms2['page_id']){
								$selected = 'selected=selected';
							}
							else
							{
								$selected ='';
							}
						
						echo "<option value='".$row_cms2['page_id']."' $selected style='padding-left:10px;'>".$row_cms2['page_name']."</option>";
						$cd3=$row_cms2['page_id'];
						$cater2='category';
						$sql122 ="SELECT * FROM cms_pages WHERE status='1' AND $cd3=$cater2";
						$page_cont4 = mysqli_query($link,$sql122);
						while($row_cms3=mysqli_fetch_array($page_cont4)) {
							
						echo "<option value='".$row_cms3['page_id']."' style='padding-left:20px;'>".$row_cms3['page_name']."'</option>";
						}
						}
						
						}
}

function vender($link){
	$vendor=$_REQUEST['cms'];
	$sq="SELECT * FROM toolbox_login WHERE id=$vendor";
				$re=mysqli_query($link,$sq);
				$ro=mysqli_fetch_array($re);
				$id00=$ro['category'];
				 echo "<option value=''>--Select Member---</option>";
                     $sql ="SELECT * FROM toolbox_login WHERE status='5'";
					  $selected = '';
					$page_cont = mysqli_query($link,$sql);
					while($row_cms45=mysqli_fetch_array($page_cont)) { 
							if($id00==$row_cms45['id']){
								$selected = 'selected=selected';
							}
							else
							{
								$selected ='';
							}
						echo "<option value='".$row_cms45['id']."'".$selected.">".$row_cms45['businessname']."</option>";
						
						
						
						}
}

function city2($link){
	$cityid=$_REQUEST['cms'];
	$sq="SELECT * FROM testimonial WHERE id=$cityid";
				$re=mysqli_query($link,$sq);
				$ro=mysqli_fetch_array($re);
				$id00=$ro['city'];
				 echo "<option value=''>--Select City---</option>";
                     $sql ="SELECT * FROM city WHERE parent_id='0'";
					  $selected = '';
					$page_cont = mysqli_query($link,$sql);
					while($row_cms45=mysqli_fetch_array($page_cont)) { 
							if($id00==$row_cms45['id']){
								$selected = 'selected=selected';
							}
							else
							{
								$selected ='';
							}
						echo "<option value='".$row_cms45['id']."'".$selected.">".$row_cms45['cityname']."</option>";
						
						
						
						}
}



function category($link){
	$kader=$id=$_REQUEST['cms'];
	$sq="SELECT * FROM category WHERE id=$kader";
				$re=mysqli_query($link,$sq);
				$ro=mysqli_fetch_array($re);
				$id00=$ro['parent_id'];
				 echo "<option value=''>--Select Category---</option>";
                     $sql ="SELECT * FROM category WHERE status='1' AND parent_id='' order by pro_name ASC";
					  $selected = '';
					$page_cont = mysqli_query($link,$sql);
					while($row_cms45=mysqli_fetch_array($page_cont)) { 
							if($id00==$row_cms45['id']){
								$selected = 'selected=selected';
							}
							else
							{
								$selected ='';
							}
						echo "<option value='".$row_cms45['id']."'".$selected. ">".$row_cms45['pro_name']."</option>";
						$cd=$row_cms45['id'];
						$cater='parent_id';
						$sql12 ="SELECT * FROM category WHERE status='1' AND $cd=$cater";
						$page_cont2 = mysqli_query($link,$sql12);
						while($row_cms2=mysqli_fetch_array($page_cont2)) { 
							if($id00==$row_cms2['id']){
								$selected = 'selected=selected';
							}
							else
							{
								$selected ='';
							}
						
						echo "<option value='".$row_cms2['id']."'" .$selected.">&nbsp; &nbsp;".$row_cms2['pro_name']."</option>";
						$cd3=$row_cms2['id'];
						$cater2='parent_id';
						$sql122 ="SELECT * FROM category WHERE status='1' AND $cd3=$cater2";
						$page_cont4 = mysqli_query($link,$sql122);
						while($row_cms3=mysqli_fetch_array($page_cont4)) {
							if($id000==$row_cms3['id']){
								$selected2 = 'selected=selected';
							}
							else
							{
								$selected2 ='';
							}
							
						echo "<option value='".$row_cms3['id']."'". $selected2.">&nbsp; &nbsp; &nbsp;".$row_cms3['pro_name']."</option>";
						}
						}
						
						}
}

function maincategory($link){
	$kader=$id=$_REQUEST['cms'];
	$sq="SELECT * FROM promocode WHERE id=$kader order by pro_name ASC";
				$re=mysqli_query($link,$sq);
				$ro=mysqli_fetch_array($re);
				$id00=$ro['parent_id'];
				 echo "<option value=''>--Select Category---</option>";
                     $sql ="SELECT * FROM category WHERE status='1' AND parent_id='' order by pro_name ASC";
					  $selected = '';
					$page_cont = mysqli_query($link,$sql);
					while($row_cms45=mysqli_fetch_array($page_cont)) { 
							if($id00==$row_cms45['id']){
								$selected = 'selected=selected';
							}
							else
							{
								$selected ='';
							}
						echo "<option value='".$row_cms45['id']."'".$selected. "style='font-weight:bold;'".">".$row_cms45['pro_name']."</option>";
						
						}
}


function city($link){
	$kader=$id=$_REQUEST['cms'];
	$sq="SELECT * FROM city WHERE id=$kader";
				$re=mysqli_query($link,$sq);
				$ro=mysqli_fetch_array($re);
				$id00=$ro['parent_id'];
				 echo "<option value=''>--Select City---</option>";
                     $sql ="SELECT * FROM city WHERE parent_id='' order by id ASC";
					  $selected = '';
					$page_cont = mysqli_query($link,$sql);
					while($row_cms45=mysqli_fetch_array($page_cont)) { 
							if($id00==$row_cms45['id']){
								$selected = 'selected=selected';
							}
							else
							{
								$selected ='';
							}
						echo "<option value='".$row_cms45['id']."'".$selected. "style='font-weight:bold;'".">".$row_cms45['cityname']."</option>";
						$cd=$row_cms45['id'];
						$cater='parent_id';
						$sql12 ="SELECT * FROM city WHERE $cd=$cater";
						$page_cont2 = mysqli_query($link,$sql12);
						while($row_cms2=mysqli_fetch_array($page_cont2)) { 
							if($id00==$row_cms2['id']){
								$selected = 'selected=selected';
							}
							else
							{
								$selected ='';
							}
						
						echo "<option value='".$row_cms2['id']."' $selected style='margin-left:30px;'>".$row_cms2['cityname']."</option>";
						
						}
						
						}
}

function product(){
	$kader=$id=$_REQUEST['cms'];
	$sq="SELECT * FROM product WHERE id=$kader";
				$re=mysqli_query($link,$sq);
				$ro=mysqli_fetch_array($re);
				$id00=$ro['parent_id'];
				 echo "<option value=''>--Select Category---</option>";
                     $sql ="SELECT * FROM category WHERE status='1' AND parent_id='' order by id ASC";
					  $selected = '';
					$page_cont = mysqli_query($link,$sql);
					while($row_cms45=mysqli_fetch_array($page_cont)) { 
							if($id00==$row_cms45['id']){
								$selected = 'selected=selected';
							}
							else
							{
								$selected ='';
							}
						echo "<option value='".$row_cms45['id']."'".$selected. "style='font-weight:bold;'".">".$row_cms45['pro_name']."</option>";
						$cd=$row_cms45['id'];
						$cater='parent_id';
						$sql12 ="SELECT * FROM category WHERE status='1' AND $cd=$cater";
						$page_cont2 = mysqli_query($link,$sql12);
						while($row_cms2=mysqli_fetch_array($page_cont2)) { 
							if($id00==$row_cms2['id']){
								$selected = 'selected=selected';
							}
							else
							{
								$selected ='';
							}
						
						echo "<option value='".$row_cms2['id']."' $selected style='padding-left:10px;'>".$row_cms2['pro_name']."</option>";
						$cd3=$row_cms2['id'];
						$cater2='parent_id';
						$sql122 ="SELECT * FROM category WHERE status='1' AND $cd3=$cater2";
						$page_cont4 = mysqli_query($link,$sql122);
						while($row_cms3=mysqli_fetch_array($page_cont4)) {
							
						echo "<option value='".$row_cms3['id']."' style='padding-left:20px;'>".$row_cms3['pro_name']."'</option>";
						}
						}
						
						}
}




function image_size()
{
	$img_path =$row_supplierlogo['image'];
if($row_supplierlogo['image']!='') {
if (file_exists($img_path)) {
$info = getimagesize($img_path);

$max_width = 100; 
$max_height = 100; 
list($width, $height) = getimagesize($img_path); 
$ratioh = $max_height/$height; 
$ratiow = $max_width/$width; 
$ratio = min($ratioh, $ratiow); 

$width = intval($ratio*$width); 
$height = intval($ratio*$height); 
}

else
{
$width = 100; 
$height = 100; 
} 
}

}

?>