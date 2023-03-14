<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'register':
		echo addRepresenter(array("name"=>$_GET['name'],"phone"=>$_GET['phone'],"email"=>$_GET['email']));
		break;
		case 'load':
		echo getRepresenter(null);
		break;
		case 'loadbyid':
		echo getRepresenter($_GET['id']);
		break;
		case 'loadbypostoffice':
		echo getRepresenterByPost($_GET['id']);
		break;
		case 'search':
		echo searchRepresenter($_GET['key']);
		break;
		case'update':
		echo updateRepresenter($_GET['id'],array("name"=>$_GET['name'],"phone"=>$_GET['phone'],"email"=>$_GET['email']));
		break;
		case 'delete':
		echo delete(array("table"=>"representative","tablecol"=>"rep_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:	echo "Invalid Request";
		
}	
}
?>