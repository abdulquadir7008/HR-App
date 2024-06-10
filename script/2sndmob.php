<?php
if(isset($_REQUEST['add'])){
//Your message2 to send, Add URL encoding here.
$message2 = urlencode("Dear {$firstname}, Greetings from Customer Care - Splendid. Hope you are enjoying with your new vehicle. You can reach us at 7064424458 in case of any assistance or issues. We love to hear your compliments too! Assuring you our best services all the time.");

$message3 = urlencode("Refer & Win!  Now refer your friends and collegues to purchase any Suzuki2Wheeler and win Rs500 Paytm Cash. Also win exciting Gifts and Discount Vouchers. T&C Apply.");

//Define route 
$route = "default";
//Prepare you post parameters
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

// init the resource
$ch2 = curl_init();
$ch3 = curl_init();
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


//Ignore SSL certificate verification
curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch3, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, 0);


//get response
$output2 = curl_exec($ch2);
$output3 = curl_exec($ch3);

//Print error if any
if(curl_errno($ch2))
{
    echo 'error:' . curl_error($ch2);
}
else if(curl_errno($ch3))
{
    echo 'error:' . curl_error($ch3);
}

curl_close($ch2,$ch3);

echo $output2.$output3;
}
?>