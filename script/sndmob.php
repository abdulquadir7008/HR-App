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



if(isset($_REQUEST['add'])){
//Your message to send, Add URL encoding here.

$message = urlencode("Dear {$firstname}, thank you for choosing Suzuki {$vecsuz}. We welcome you to the Suzuki Family. Wish you a very safe and pleasant motoring. Like us on Facebook: https://bit.ly/31peeOX . Team Splendid");

$message2 = urlencode("Dear {$firstname}, Greetings from Customer Care - Splendid. Hope you are enjoying with your new vehicle. You can reach us at 7064424458 in case of any assistance or issues. We love to hear your compliments too! Assuring you our best services all the time.");

$message3 = urlencode("Refer & Win!  Now refer your friends and collegues to purchase any Suzuki2Wheeler and win Rs500 Paytm Cash. Also win exciting Gifts and Discount Vouchers. T&C Apply.");

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
$postData = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message,
    'sender' => $senderId,
    //'route' => $route
);
$postData2 = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message2,
    'sender' => $senderId,
    //'route' => $route
);
$postData3 = array(
    'authkey' => $authKey,
    'mobiles' => $mobileNumber,
    'message' => $message3,
    'sender' => $senderId,
    //'route' => $route
);


//API URL
$url="http://api.msg91.com/api/sendhttp.php";

// init the resource
$ch = curl_init();
$ch2 = curl_init();
$ch3 = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData
    //,CURLOPT_FOLLOWLOCATION => true
));
curl_setopt_array($ch2, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData2
    //,CURLOPT_FOLLOWLOCATION => true
));

curl_setopt_array($ch3, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData3
    //,CURLOPT_FOLLOWLOCATION => true
));
if($insurance_co > 0){
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

$sms_slt_query="select * from sms_slt where insurance_parent=$last_id";
$sms_slt_result=mysqli_query($link,$sms_slt_query);
$sms_slt_row=mysqli_fetch_array($sms_slt_result);
$isur_id_sms=$sms_slt_row['insurance_parent'];
if($isur_id_sms==$last_id){
	
	}else{
$smsslt="insert into sms_slt (insurance_parent) values('$last_id')";
mysqli_query($link,$smsslt);
}
	
}
if($ew > 0){
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

$sms_slt_query2="select * from sms_slt where ew_parent=$last_id";
$sms_slt_result2=mysqli_query($link,$sms_slt_query2);
$sms_slt_row2=mysqli_fetch_array($sms_slt_result2);
$isur_id_sms2=$sms_slt_row2['ew_parent'];
if($isur_id_sms2==$last_id){
	
	}else{
$smsslt2="insert into sms_slt (ew_parent) values('$last_id')";
mysqli_query($link,$smsslt2);
}	
}

if($road_tax=='taxyes'){
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

$sms_slt_query="select * from sms_slt where rodtax_parent=$last_id";
$sms_slt_result=mysqli_query($link,$sms_slt_query);
$sms_slt_row=mysqli_fetch_array($sms_slt_result);
$isur_id_sms=$sms_slt_row['rodtax_parent'];
if($isur_id_sms==$last_id){
	
	}else{
$smsslt="insert into sms_slt (rodtax_parent) values('$last_id')";
mysqli_query($link,$smsslt);
}	
		
}
//Ignore SSL certificate verification

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch3, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, 0);

//get response
$output = curl_exec($ch);
$output2 = curl_exec($ch2);
$output3 = curl_exec($ch3);

//Print error if any
if(curl_errno($ch))
{
    echo 'error:' . curl_error($ch);
}
//Print error if any
else if(curl_errno($ch2))
{
    echo 'error:' . curl_error($ch2);
}
else if(curl_errno($ch3))
{
    echo 'error:' . curl_error($ch3);
}

curl_close($ch,$ch2,$ch3);

}
?>