<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'register':
		echo addPaymentWithdraw($_GET);
		break;
		case 'load':
		    header('Content-Type: application/json');
		echo getPaymentWithdraw($_GET);
		break;
		case 'report':
		      $size=array(100,180);
to_pdf(getPaymentWithdrawReport($_GET));
//echo getPaymentWithdrawReport($_GET)['contents'];
		break;
		case 'loadbyid':
		    header('Content-Type: application/json');
		echo getPaymentWithdraw($_GET);
		break;
		case 'search':
		   header('Content-Type: application/json');
		echo searchPaymentWithdraw($_GET['key']);
		break;
		case'update':
		echo updatePaymentWithdraw($_GET['id'],$_GET);
		break;
		case'approve':
		$_GET['sessid']=decodeGetParams($_GET['sessid']);
		echo approvePaymentWithdraw($_GET['id'],$_GET);
		break;
		case'decline':
		$_GET['sessid']=decodeGetParams($_GET['sessid']);
		echo declinePaymentWithdraw($_GET);
		break;
		case 'delete':
		echo delete(array("table"=>"withdraw_history","tablecol"=>"wth_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:	echo "Invalid Request";
}	
}
?>