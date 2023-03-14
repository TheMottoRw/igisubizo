<?php
 date_default_timezone_set("UTC");
function sendAPIData($number,$postInfo){
$message=urlencode($postInfo['message']);
$url="http://egtecs.com:8080/api/v2/sendSms/?number=".$number."&sender=0784634118&message=".$message;
$unamePwd=base64_encode("user:password");
$headers=array();
$headers[]="Authorization:".base64_encode("user:password");
$headers[]="User-Agent:".$_SERVER['HTTP_USER_AGENT'];

$curlRequest=curl_init();
curl_setopt($curlRequest,CURLOPT_URL,$url);
curl_setopt($curlRequest,CURLOPT_HTTPHEADER,$headers);
curl_setopt($curlRequest,CURLOPT_RETURNTRANSFER,true);

$response=curl_exec($curlRequest);
if(!$response){
    die('Error: "' . curl_error($curlRequest) . '" - Code: ' . curl_errno($curlRequest));
}
$postinfo="";
$number="";
curl_close($curlRequest);
return $response;
}

function sendData($number,$postInfo){
	$message=urlencode("Hi! Happy to inform that wat you've lost is now found,at our office:".$postInfo['officename'].",+".$postInfo['officephone']);
$url="http://egtecs.com:8080/api/v2/sendSms/?number=25".$number."&sender=IGISUBIZO&message=".$message;//.">".$message1;
	$headers[]="Authorization:".base64_encode("user:password");
$headers[]="User-Agent:".$_SERVER['HTTP_USER_AGENT'];

	$opts = array('http' =>
    array(
        'method'  => 'GET',
        'header'  => $headers
        //'content' => $postdata
    )
);
$context  = stream_context_create($opts);
$result = file_get_contents($url, false, $context);
return $result;
}
//echo sendData("0788349092",array("officename"=>"Rukoma","officephone"=>"0788846215","ownername"=>"MANZI Roger"));
function sendSMS($datas){
$url="http://egtecs.com:8080/api/v2/sendSms/?number=25".$datas['to']."&sender=".$datas['sender']."&message=".$datas['message'];
$headers=array();
$headers[]="Authorization:".base64_encode("user:password");
$headers[]="User-Agent:".$_SERVER['HTTP_USER_AGENT'];

$curlRequest=curl_init();
curl_setopt($curlRequest,CURLOPT_URL,$url);
curl_setopt($curlRequest,CURLOPT_HTTPHEADER,$headers);
curl_setopt($curlRequest,CURLOPT_RETURNTRANSFER,true);

$response=curl_exec($curlRequest);
if(!$response){
    die('Error: "' . curl_error($curlRequest) . '" - Code: ' . curl_errno($curlRequest));
}
$postinfo="";
$number="";
curl_close($curlRequest);
return $response;

}
?>