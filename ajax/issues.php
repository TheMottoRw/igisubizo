<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'register':
		echo addIssue($_GET);
		break;
		case 'load':
		header("Content-Type:application/json");
		echo getIssue($_GET);
		break;
		case 'loadbyid':
		header("Content-Type:application/json");
		echo getIssue($_GET);
		break;
		case 'search':
		header("Content-Type:application/json");
		echo searchIssue($_GET['key']);
		break;
		case 'update':
		echo updateIssue($_GET);
		break;
		case 'delete':
		echo delete(array("table"=>"issues","tablecol"=>"iss_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:		echo "Invalid Request";
}	
}
?>