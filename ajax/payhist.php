<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'register':
		echo addPaymentHistory($_GET);
		break;
		case 'load':
		    header('Content-Type: application/json');
		echo getPaymentHistory($_GET);
		break;
		case 'report':
		      $size=array(100,180);
to_pdf(getPaymentHistoryReport($_GET));
		case 'loadbyid':
		    header('Content-Type: application/json');
		echo getPaymentHistory($_GET);
		break;
		case 'loadbypostoffice':
		    header('Content-Type: application/json');
		echo getPaymentHistoryByCommissioner($_GET);
		break;
		case 'search':
		   header('Content-Type: application/json');
		echo searchPaymentHistory($_GET['key']);
		break;
		case'update':
		echo updatePaymentHistory($_GET['id'],$_GET);
		break;
		case'approve':
		$_GET['sessid']=decodeGetParams($_GET['sessid']);
		echo approvePaymentHistory($_GET['id'],$_GET);
		break;
		case'decline':
		$_GET['sessid']=decodeGetParams($_GET['sessid']);
		echo declinePaymentHistory($_GET);
		break;
		case 'delete':
		echo delete(array("table"=>"payment_history","tablecol"=>"pmth_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:	echo "Invalid Request";
		
}	
}
?>