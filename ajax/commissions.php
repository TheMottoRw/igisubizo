<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){	
	switch($_GET['cate']){
		case 'register':
		echo addCommission(array("amount"=>$_GET["amount"]));
		break;
		case 'load':
		    header('Content-Type: application/json');
		echo getCommissions(null);
		break;
		case 'loadbyid':
		    header('Content-Type: application/json');
		echo getCommissions($_GET);
		break;
		case 'search':
		    header('Content-Type: application/json');
		echo searchCommission($_GET['key']);
		break;
		case 'update':
		echo updateCommission($_GET['id'],$_GET);
		break;
		case 'delete':
		echo delete(array("table"=>"commissions","tablecol"=>"comm_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:	echo "Invalid Request";	
}	
}
?>