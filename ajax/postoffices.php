<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'register':
		echo addPostoffices(array("name"=>$_GET["name"],"representative"=>$_GET["representative"],"phone"=>$_GET["phone"],"password"=>$_GET["password"],"provid"=>$_GET["provid"],"distid"=>$_GET["district"],"sector"=>$_GET["sector"],"cell"=>$_GET["cell"],"address"=>$_GET["address"]));
		break;
		case 'load':
		    header('Content-Type: application/json');
		echo getPostoffices(null);
		break;
		case 'loadbyid':
		    header('Content-Type: application/json');
		echo getPostoffices($_GET['id']);
		break;
		case 'search':
		    header('Content-Type: application/json');
		echo searchPostoffices($_GET['key']);
		break;
		case 'update':
		echo updatePostoffices($_GET['id'],array("name"=>$_GET["name"],"representative"=>$_GET["representative"],"phone"=>$_GET["phone"],"provid"=>$_GET["provid"],"distrid"=>$_GET["district"],"sector"=>$_GET["sector"],"cell"=>$_GET["cell"],"address"=>$_GET["address"]));
		break;
		case 'changepwd':
		echo updatePostofficesPwd($_GET['id'],array("old"=>$_GET["old"],"new"=>$_GET["new"]));;
		break;
		case 'reqreset':
		echo requestResetPostoffices($_GET['id'],array("phone"=>$_GET["phone"],"reason"=>$_GET["reason"]));;
		break;
		case 'loadreqreset':
		    header('Content-Type: application/json');
		echo getReqReset(null);
		break;
		case 'loadreqresetbyid':
		echo getReqReset($_GET['resetid']);
		break;
		case 'reset':
		echo resetPostoffices($_GET['resetid'],$_GET['postoffid'],array("new"=>$_GET["new"]));
		break;
		case 'delete':
		echo delete(array("table"=>"postoffices","tablecol"=>"postoff_id","id"=>$_GET['id'],"reason"=>$_GET['reason']));
		break;
		default:		echo "Invalid Request";
}	
}
?>