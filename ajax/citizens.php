<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'register':
		echo addCitizen($_GET);
		break;
		case 'load':
		    header('Content-Type: application/json');
		echo getCitizens($_GET);
		break;
		case 'report':
		      $size=array(100,180);
to_pdf(getCitizensReport($_GET));
		case 'loadbyid':
		    header('Content-Type: application/json');
		echo getCitizens($_GET);
		break;
		case 'loadbypostoffice':
		    header('Content-Type: application/json');
		echo getCitizensByCommissioner($_GET);
		break;
		case 'search':
		   header('Content-Type: application/json');
		echo searchCitizens($_GET['key']);
		break;
		case'update':
		echo updateCitizens($_GET['id'],$_GET);
		break;
		case'found':
		echo setFoundCitizens($_GET['id']);
		break;
		case 'delete':
		echo delete(array("table"=>"losts","tablecol"=>"lost_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:	echo "Invalid Request";
		
}	
}
?>