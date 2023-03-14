<?php
include"../php/main.php";
			saveRequests();
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'POST':
			switch ($_POST['cate']) {
				case 'register':
				echo addPaymentMode($_POST);
				break;
				case 'update':
				echo updatePaymentMode($_POST['id'],$_POST);
				break;
				case 'delete':
				echo delete(array("table"=>"payment_mode","tablecol"=>"pmtd_id","id"=>$_POST["id"],"reason"=>$_POST['reason']));
				break;
			}
			break;
			case'GET':
		switch($_GET['cate']){
		case 'load':
		    header('Content-Type: application/json');
		echo getPaymentMode(null);
		break;
		case 'loadbyid':
		header('Content-Type: application/json');
		echo getPaymentMode($_GET['id']);
		break;
		case 'search':
		    header('Content-Category: application/json');
		echo searchPaymentMode($_GET['key']);
		break;
		default:	echo "Invalid Request";	
}
		break;
		default:	echo "Invalid Request Method";		
}
?>