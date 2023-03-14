<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){
	$fop=fopen("APPRequest.hd", "a");
		fwrite($fop,date("Y-m-d H:i:s")."=>".$_SERVER['REMOTE_ADDR']."=>".$_SERVER['REQUEST_URI']."\n");
		fclose($fop);
	switch($_GET['cate']){
		case 'register':
		echo addLosts(array("postoffid"=>$_GET['postoffid'],"owner"=>$_GET['owner'],"type"=>$_GET['type'],"identifier"=>$_GET['identifier'],"comments"=>$_GET['comments']));
		break;
		case 'load':
		    header('Content-Type: application/json');
		echo getLosts(null);
		break;
		case 'loadbyid':
		    header('Content-Type: application/json');
		echo getLosts($_GET['id']);
		break;
		case 'loadbypostoffice':
		    header('Content-Type: application/json');
		echo getLostsByPostoffices(array("postoffid"=>$_GET['id']));
		break;
		case 'report':
		      $size=array(100,180);
		$data=getLostsReport(array("postoffid"=>$_GET['id'],"start"=>$_GET['start'],"end"=>$_GET['end']));
		to_pdf($data);
		break;
		case 'search':
		   header('Content-Type: application/json');
		echo searchLosts($_GET['key']);
		break;
		case 'searchbykeys':
		   header('Content-Type: application/json');
		echo searchLostsByKeys($_GET['postoffid'],$_GET['key']);
		break;
		case'update':
		echo updateLosts($_GET['id'],array("owner"=>$_GET['owner'],"type"=>$_GET['type'],"identifier"=>$_GET['identifier'],"comments"=>$_GET['comments']));
		break;
		case'found':
		echo setFoundLosts($_GET);
		break;
		case 'delete':
		echo delete(array("table"=>"losts","tablecol"=>"lost_id","id"=>$_GET["id"],"reason"=>$_GET['reason']));
		break;
		default:	echo "Invalid Request";
		
}	
}
?>