<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){	
	switch($_GET['cate']){
		case 'register':
		echo addType(array("doctype"=>$_GET["doctype"],"max"=>$_GET['max']));
		break;
		case 'load':
		    header('Content-Type: application/json');
		echo getTypes(null);
		break;
		case 'loadbyid':
		echo getTypes($_GET['id']);
		break;
		case 'search':
		    header('Content-Type: application/json');
		echo searchType($_GET['key']);
		break;
		case 'update':
		echo updateType($_GET['id'],$_GET);
		break;
		case 'delete':
		echo delete(array("table"=>"doctypes","tablecol"=>"doc_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:	echo "Invalid Request";	
}	
}
?>