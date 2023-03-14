<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'register':
		if(!isset($_GET['fromid'])){
			$_GET['fromid']=(isset($_GET['sessid']) && !is_numeric($_GET['sessid'])?decodeGetparams($_GET['sessid']):$_GET['sessid']);
		}
		echo addIssueChat($_GET);
		break;
		case 'load':
		header("Content-Type:application/json");
		echo getIssueChat($_GET);
		break;
		case 'loadbyid':
		header("Content-Type:application/json");
		echo getIssueChat($_GET);
		break;
		case 'search':
		header("Content-Type:application/json");
		echo searchIssueChat($_GET['key']);
		break;
		case 'seen':
		header("Content-Type:application/json");
		echo makeAllSeenIssueChat($_GET);
		break;
		case 'update':
		echo updateIssueChat($_GET['id'],array("nid"=>$_GET["nid"],"type"=>$_GET["type"],"identifier"=>$_GET["identifier"],"notifreceive"=>"sms","address"=>'',"regdate"=>null));
		break;
		case 'delete':
		echo delete(array("table"=>"issues_chat","tablecol"=>"isc_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:		echo "Invalid Request";
}	
}
?>