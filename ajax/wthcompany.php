<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){	
	switch($_GET['cate']){
		case 'register':
		$_GET['sessid']=decodeGetParams($_GET['sessid']);
		echo addWithdrawCompany($_GET);
		break;
		case 'load':
		    header('Content-WithdrawCompany: application/json');
		echo getWithdrawCompany(null);
		break;
		case 'loadbyid':
		echo getWithdrawCompany($_GET['id']);
		break;
		case 'search':
		    header('Content-WithdrawCompany: application/json');
		echo searchWithdrawCompany($_GET['key']);
		break;
		case 'update':
		echo updateWithdrawCompany($_GET['id'],$_GET);
		break;
		case 'delete':
		echo delete(array("table"=>"withdraw_company","tablecol"=>"wthc_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:	echo "Invalid Request";	
}	
}
?>