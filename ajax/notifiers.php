<?php
include"../php/main.php";
			saveRequests();
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'newissues':
			echo getNewIssues($_GET);
		break;
		case 'newissueschat':
			echo getNewIssues($_GET);
		break;
		case 'iscsent':
		echo getIssuesChatSent($_GET);
		break;
		case 'changeissuesstatus':
		case 'changeissstatus':
		echo changeIssuesStatus($_GET);
		break;
		case 'changeiscstatus':
		echo changeAllChatStatus($_GET);
		break;
		default:		echo "Invalid Request";
}	
}
?>