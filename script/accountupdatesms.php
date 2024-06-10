<?php
//Your authentication key
$authKey = "241016AardnSDMfR5bb5d12d";

//Multiple mobiles numbers separated by comma
$mobileNumber = $contact;

//Sender ID,While using route4 sender id should be 6 characters long.
$senderId = "SSuzki";

$SMSVech_Q="select * from vehicle where id='$vehicle'";
$smsV_Q=mysqli_query($link,$SMSVech_Q);
$smsvec_row=mysqli_fetch_array($smsV_Q);
$vecsuz=$smsvec_row['vehicle_name'];
$ins_Query="select * from insurance_co where insurance_id='$insurance_co'";
$ins_res=mysqli_query($link,$ins_Query);
$ins_row=mysqli_fetch_array($ins_res);
$insurance_name=$ins_row['insurance_name'];



if(isset($_REQUEST['accountupdate'])){
//Your message to send, Add URL encoding here.

if($insurance_co > 0){
$message4 = urlencode("Insurance Generated: Dear Customer, Insurance for your vehicle {$vecsuz} has been generated with {$insurance_name} bearing Policy No. {$policy_no}. Enjoy Quality repairs within our service network and cashless* & transparent claim settelments. For your insurance renewal please contact 7064424458.");
$postData4 = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message4,
    'sender' => $senderId,
    //'route' => $route
);
}
if($ew > 0){
$message5 = urlencode("Extended Warranty: Dear Customer, EW for your vehicle has been generated. Now enjoy 5 Years warranty* on your vehicle.To know more about the scheme refer to the Extended warranty book given to you. *T&C Apply.");
$postData5 = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message5,
    'sender' => $senderId,
    //'route' => $route
);
}
if($road_tax=='taxyes'){
$message6 = urlencode("Road Tax Update: Road tax for your vehicle Suzuki {$vecsuz} has been generated with reference# {$road_tax_ref_no}. Registration number will be generated in 10-12 Working days.  Incase of any issue please call 7064424458. Team Splendid.");

$message7 = urlencode("Dear Customer please note as per the new Govt Regulation, RC card will be dispatched from RTO office after High Security Registration Plate is fitted on your vehicle. Our team will contact you when HSRP(Registration Plate) arrive at our dealership. For any assistance please call 7064424458.");

$postData6 = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message6,
    'sender' => $senderId,
    //'route' => $route
);
$postData7 = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message7,
    'sender' => $senderId,
    //'route' => $route
);
}
//Define route 
$route = "default";
//Prepare you post parameters



//API URL
$url="http://api.msg91.com/api/sendhttp.php";

// init the resource

if($insurance_co > 0){
	$sms_slt_query="select * from sms_slt where insurance_parent=$sl_no";
$sms_slt_result=mysqli_query($link,$sms_slt_query);
$sms_slt_row=mysqli_fetch_array($sms_slt_result);
$isur_id_sms=$sms_slt_row['insurance_parent'];
if($isur_id_sms==$sl_no){
	
	}else{
$smsslt="insert into sms_slt (insurance_parent) values('$sl_no')";
mysqli_query($link,$smsslt);

$ch4 = curl_init();
curl_setopt_array($ch4, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData4
    //,CURLOPT_FOLLOWLOCATION => true
));
curl_setopt($ch4, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, 0);
$output4 = curl_exec($ch4);
curl_close($ch4);
echo $output4;

}
	
}
if($ew > 0){
	$sms_slt_query2="select * from sms_slt where ew_parent=$sl_no";
$sms_slt_result2=mysqli_query($link,$sms_slt_query2);
$sms_slt_row2=mysqli_fetch_array($sms_slt_result2);
$isur_id_sms2=$sms_slt_row2['ew_parent'];
if($isur_id_sms2==$sl_no){
	$prim_id2=$sms_slt_row2['smsid'];
$sms_insurance_update_query2="update sms_slt SET ew_parent='$sl_no' WHERE smsid=$prim_id2";
mysqli_query($link,$sms_insurance_update_query2);
	}else{
$smsslt2="insert into sms_slt (ew_parent) values('$sl_no')";
mysqli_query($link,$smsslt2);
	
$ch5 = curl_init();
curl_setopt_array($ch5, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData5
    //,CURLOPT_FOLLOWLOCATION => true
));
curl_setopt($ch5, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch5, CURLOPT_SSL_VERIFYPEER, 0);
$output5 = curl_exec($ch5);
curl_close($ch5);
echo $output5;
}

}

if($road_tax=='taxyes'){
	$sms_slt_query="select * from sms_slt where rodtax_parent=$sl_no";
$sms_slt_result=mysqli_query($link,$sms_slt_query);
$sms_slt_row=mysqli_fetch_array($sms_slt_result);
$isur_id_sms=$sms_slt_row['rodtax_parent'];
if($isur_id_sms==$sl_no){
	
	}else{
$smsslt="insert into sms_slt (rodtax_parent) values('$sl_no')";
mysqli_query($link,$smsslt);
	
$ch6 = curl_init();
curl_setopt_array($ch6, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData6
    //,CURLOPT_FOLLOWLOCATION => true
));
curl_setopt($ch6, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch6, CURLOPT_SSL_VERIFYPEER, 0);
$output6 = curl_exec($ch6);
curl_close($ch6);
echo $output6;

$ch7 = curl_init();
curl_setopt_array($ch7, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData7
    //,CURLOPT_FOLLOWLOCATION => true
));
curl_setopt($ch7, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch7, CURLOPT_SSL_VERIFYPEER, 0);
$output7 = curl_exec($ch7);
curl_close($ch7);
echo $output7;

}
		
}
//Ignore SSL certificate verification
}
?>