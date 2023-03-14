<?php
include"php/main.php";
$docTypes=json_decode(getTypes(null),TRUE)['types'];
$itemType="";
for($i=0;$i<count($docTypes);$i++){
$itemType.=($i+1).".".$docTypes[$i]['doctype']."\n";
}
// Reads the variables sent via GET from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];
$texts=explode("*",$text);
$response="";
if ( $_POST['text'] =="" ) {
     // This is the first request. Note how we start the response with CON
     $response  = "CON Welcome to Igisubizo Beforward Generation \n";
     $response .= "1. Kinyarwanda \n";
     $response .= "2. English";
}
else if ( count($texts) == 1){
  if($texts[0]==1 ) {
  // Business logic for first level response
  $response = "CON Hitamo \n";
  $response .= "1. Gushaka Icyabuze \n";
  $response .= "2. Kwiyandikisha \n";
  $response .= "3. Kwandika Icyangombwa";
 }
 else if($texts[0] == 2) {
  // Business logic for first level response
  // This is a terminal request. Note how we start the response with END
   $response = "CON Choose Action \n";
  $response .= "1. Search Losts \n";
  $response .= "2. Register Yourself \n";
  $response .= "3. Register Items";
 }
 }else if(count($texts) ==2) {//second stage
  if($texts[0]==1){//for kinyarwanda
    switch($texts[1]){
      case '1':
      $response="CON  Andika Numero Iranga Icyangombwa";break;
      case '2':
      $response="CON  Andika Amazina yawe";break;
      case '3':
      $response="CON  Andika Numero Ndangamuntu";break;
      }
    }else if($texts[0]==2){//for english
      switch($texts[1]){
      case '1':
      $response="CON  Enter Item ID Number";break;
      case '2':
      $response="CON  Enter Your Full Name";break;
      case '3':
      $response="CON  Enter National ID";break;
      }
    }
  }else if(count($texts) ==3) {
     if($texts[0]==1){
    if($texts[1]==1){
      //search losts
      $lostsInfo=json_decode(searchLosts($texts[2]),TRUE)['losts'];
      if($lostsInfo!=null){
        $lostsArr=$lostsInfo[0];
$response="END Icyo mwari mwarabuze cyabonetse\n Mwagisanga:\n";
$response.="Ibiro :".$lostsArr['name']."\n";
$response.="Ubihagarariye :".$lostsArr['representer']."\n";
$response.="Telefoni :".$lostsArr['phone']."\n";
$response.="Nyiracyo :".$lostsArr['owner']."\n";
$response.="Ubwoko :".$lostsArr['doctype']."\n";
$response.="Numero Ikiranga :".$lostsArr['identifier']."\n";
$response.="Kwishyura :".$lostsArr['pay_amount']."\n";
$response.="Intara :".$lostsArr['province_name']."\n";
$response.="Akarere :".$lostsArr['district_name']."\n";
$response.="Umurenge :".$lostsArr['sector_name']."\n";
$response.="Akagari :".$lostsArr['cell']."\n";
$response.="Aho biherereye :".$lostsArr['address']."\n";
      }else{
      $response="END Mwihangane Icyo mushakisha ntikibonetse";
    }
      }else if($texts[1]==3){
        $citInfo=json_decode(searchCitizens($texts[2]),TRUE)['citizens'];
        if($citInfo[0]['cit_id']==null || count($citInfo)==0){
      $response="END Mwihangane Ntabwo musanzwe mwanditse \n mubanze mwiyandikishe \n";
        }else{
          $citName=explode(" ",$citInfo[0]['cit_names'])[1];
      $response="CON ".$citName." Andika Ubwoko bw'Icyangombwa \n".$itemType;
        }
      }
    }else if($texts[0]==2){
    if($texts[1]==1){
      //search losts
      $lostsInfo=json_decode(searchLosts($texts[2]),TRUE)['losts'];
      if($lostsInfo!=null){
        $lostsArr=$lostsInfo[0];
$response="END Item you're searching for is Found\n Find it :\n";
$response.="Office :".$lostsArr['name']."\n";
$response.="Representer :".$lostsArr['representer']."\n";
$response.="Mobile :".$lostsArr['phone']."\n";
$response.="Owner :".$lostsArr['owner']."\n";
$response.="Item Type :".$lostsArr['doctype']."\n";
$response.="Item identification :".$lostsArr['identifier']."\n";
$response.="Payment :".$lostsArr['pay_amount']."\n";
$response.="Province :".$lostsArr['province_name']."\n";
$response.="District :".$lostsArr['district_name']."\n";
$response.="Sector :".$lostsArr['sector_name']."\n";
$response.="Cell :".$lostsArr['cell']."\n";
$response.="Address :".$lostsArr['address']."\n";
      }else{
      $response="END Sorry Item you are searching not found\n try again after few days";
    }
    }else if($texts[1]==2){
      $response="CON  Enter your phone number";
      }else if($texts[1]==3){
      $citInfo=json_decode(searchCitizens($texts[2]),TRUE)['citizens'];
        if($citInfo[0]['cit_id']==null || count($citInfo)==0){
      $response="END Sorry you are not registered \n Register first \n";
        }else{
          $citName=explode(" ",$citInfo[0]['cit_names'])[1];
      $response="CON ".$citName." Enter Item Type \n".$itemType;
        }}
    }
  }else if(count($texts) ==4) {
  if($texts[0]==1){
   if($texts[1]==2){
      $response="CON  Andika Numero Ndangamuntu";
      }else if($texts[1]==3){
      $response="CON  Numero Iranga Icyangombwa";
      }
    }else if($texts[0]==2){
   if($texts[1]==2){
      $response="CON  Enter National ID";
      }else if($texts[1]==3){
      $response="CON  Enter Item Identification Number";
      }
    }
  }else if(count($texts) ==5) {
  if($texts[0]==1){
   if($texts[1]==2){
      $response="END  Urakira ubutumwa bugufi";
      }else if($texts[1]==3){
      $response="END Urakira ubutumwa bugufi";
      }
    }else if($texts[0]==2){
   if($texts[1]==2){
    //register Citizens
    //addCitizens(array("name"=>$texts[2],"phone"=>$texts[3],"nid"=>$texts[4],"commid"=>0));
      $response="END You will receive SMS shortly";
      }else if($texts[1]==3){
    //register Items
    //addQueue(array("nid"=>$texts[2],"type"=>$texts[3],"identifier"=>$texts[4],"commid"=>0));
      $response="END You will receive SMS shortly";
      }
    }
  }
// Print the response onto the page so that our gateway can read it
header('Content-type: text/plain');
echo $response;
// DONE!!!
?>