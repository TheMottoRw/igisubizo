<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){	
	switch($_GET['cate']){
		case 'register':
		echo addPayment(array("amount"=>$_GET["amount"]));
		break;
		case 'load':
		    header('Content-Type: application/json');
		echo getPayments(null);
		break;
		case 'loadbyid':
		    header('Content-Type: application/json');
		echo getPayments($_GET['id']);
		break;
		case 'registration':
		    header('Content-Type: application/json');
		echo getRegistrationPayment();
		break;
		case 'losts':
		    header('Content-Type: application/json');
		echo getRegistrationPayment($_GET['status']);
		break;
		case 'search':
		    header('Content-Type: application/json');
		echo searchPayment($_GET['key']);
		break;
		case 'update':
		echo updatePayment($_GET['id'],$_GET);
		break;
		case 'delete':
		echo delete(array("table"=>"payments","tablecol"=>"pay_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:	echo "Invalid Request";	
}	
}
?>