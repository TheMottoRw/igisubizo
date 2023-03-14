<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){
		$fop=fopen("APPRequest.hd", "a");
		fwrite($fop,date("Y-m-d H:i:s")."=>".$_SERVER['REMOTE_ADDR']."=>".$_SERVER['REQUEST_URI']."\n");
		fclose($fop);
	switch($_GET['cate']){
		case 'dashboard':
		echo fillDashboard();
		break;
		case 'report':
		header('Content-Type: application/json');
		 $data=getLostsByRange(null,array("start"=>$_GET['start'],"end"=>$_GET['end']),$_GET['type'],$_GET['status'],$_GET['postoffid']);
		echo $data;
		break;
		case'postoffice':
		header("Content-Type:application/json");
		echo getPostofficesReport($_GET);
		break;
		case 'dashheader':
			echo getAllIncomesPartner();
			break;
		default:	echo "Invalid Request";
}	
}
?>