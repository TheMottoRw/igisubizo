<?php
session_start();
$sid=null;$cid=null;
if(isset($_SESSION['maputosid'])) {
	$sid=$_SESSION['maputosid'];
}elseif(isset($_SESSION['maputocid'])) {
	$cid=$_SESSION['maputocid'];
	}elseif(isset($_COOKIE['sid'])) {
			$_SESSION['maputosid']=$_COOKIE['sid'];
			}elseif(isset($_COOKIE['cid'])) {
	$_SESSION['maputocid']=$_COOKIE['cid'];
}else {
		header("location:index.php");	}
	?>