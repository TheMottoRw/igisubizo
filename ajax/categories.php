<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'register':
		echo addCategory(array("category"=>$_GET["category"]));
		break;
		case 'load':
		    header('Content-Type: application/json');
		echo getCategories(null);
		break;
		case 'loadbyid':
		    header('Content-Type: application/json');
		echo getCategories($_GET['id']);
		break;
		case 'search':
		    header('Content-Type: application/json');
		echo searchCategory($_GET['key']);
		break;
		case 'update':
		echo updateCategory($_GET['id'],array("category"=>$_GET["category"]));
		break;
		case 'delete':
		echo delete(array("table"=>"usertypes","tablecol"=>"usrt_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:	echo "Invalid Request";	
}	
}
?>