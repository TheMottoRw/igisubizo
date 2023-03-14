<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'register':
		echo addWithdrawAccounts($_GET);
		break;
		case 'load':
		    header('Content-Type: application/json');
		echo getWithdrawAccounts($_GET);
		break;
		case 'loadbyid':
		    header('Content-Type: application/json');
		echo getWithdrawAccounts($_GET);
		break;
		case 'search':
		   header('Content-Type: application/json');
		echo searchWithdrawAccounts($_GET['key']);
		break;
		case'update':
		echo updateWithdrawAccounts($_GET['id'],$_GET);
		break;
		case'approve':
		$_GET['sessid']=decodeGetParams($_GET['sessid']);
		echo approveWithdrawAccounts($_GET['id'],$_GET);
		break;
		case 'delete':
		echo delete(array("table"=>"withdraw_history","tablecol"=>"wthacc_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:	echo "Invalid Request";
}	
}
?>