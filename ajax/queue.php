<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'register':
		$fop=fopen("regQeueu.hd","a");
		fwrite($fop, $_SERVER['REQUEST_URI']);
		fclose($fop);
		echo addQueue(array("nid"=>$_GET["nid"],"commid"=>$_GET["commid"],"type"=>$_GET["type"],"identifier"=>$_GET["identifier"],"notifreceive"=>"sms","address"=>'',"regdate"=>null));
		break;
		case 'load':
		header("Content-Type:application/json");
		echo getQueue($_GET);
		break;
		case 'loadbyid':
		header("Content-Type:application/json");
		echo getQueue($_GET);
		break;
		case 'search':
		header("Content-Type:application/json");
		echo searchQueue($_GET['key']);
		break;
		case 'update':
		echo updateQueue($_GET['id'],array("nid"=>$_GET["nid"],"type"=>$_GET["type"],"identifier"=>$_GET["identifier"],"notifreceive"=>"sms","address"=>'',"regdate"=>null));
		break;
		case 'delete':
		echo delete(array("table"=>"queue","tablecol"=>"queue_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:		echo "Invalid Request";
}	
}
?>