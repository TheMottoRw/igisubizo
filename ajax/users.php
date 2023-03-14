<?php
include"../php/main.php";
#============USER====================
			saveRequests();
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'POST':
			switch ($_POST['cate']) {
				case 'login':
					echo login($_POST);
					break;
				case 'register':
					addUser($_POST);		
					break;
				case 'update':
					echo updateUser($_POST['id'],$_POST);
					break;
				case 'changepwd':
					echo changePwd($_POST);
					break;
                case 'reset':
                    echo resetUserPassword($_POST['id'],array("sessid"=>decodeGetParams($_POST['sessid']),"password"=>$_POST['password']));
                    break;
				case 'delete':
					echo delete(array("sessid"=>decodeGetParams($_POST['sessid']),"table"=>"users","tablecol"=>"uid","id"=>$_POST['id'],"id"=>$_POST['id'],"reason"=>$_POST['reason']));
					break;
				default:
					break;
			}
			break;
			case 'GET':
		switch ($_GET['cate']) {
	case 'load':
	header("Content-Type:application/json");
		echo getUsers($_GET);
		break;
	case 'loadbyid':
	header("Content-Type:application/json");
	if(!is_numeric($_GET['id'])){$_GET['id']=decodeGetParams($_GET['id']);}
		echo getUsers($_GET);
		break;
	case 'loadcommissioner':
	header("Content-Type:application/json");
		echo getUsersByStatus(array("category"=>2));
		break;
	case 'profile':
	userProfile($id=null);
		break;
	case 'search':
	header("Content-Type:application/json");
		echo searchUser($_GET['key']);
		break;
	case 'sendcode':
	echo addResetCode(array("uname"=>$_GET['uname'],"acctype"=>$_GET['acctype'],"sendvia"=>$_GET["sendvia"]));
	break;
	case 'checkcode':
	echo checkResetCode(array("code"=>$_GET['code'],"accid"=>decodeGetParams($_GET['accid']),"acctype"=>decodeGetParams($_GET['acctype'])));
	break;
	case 'reset':
	echo resetPassword(array("nwpassword"=>decodeGetParams($_GET['nwpassword']),"resetid"=>decodeGetParams($_GET['id'])));
	break;
	case 'changepwd':
		echo changePwd($_GET);
	default:
	}
	break;
	default:'Invalid Request Method';
}
?>