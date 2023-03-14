<?php
include"../includes/conn.php";
include"../php/main.php";
if(isset($_GET['cate'])){
	switch($_GET['cate']){
		case 'loadprovince':
		echo getProvinces(null);
		break;
		case 'loadprovincebyid':
		echo getProvinces($_GET['id']);
		break;
		case 'loaddistricts':
		echo getDistricts(null);
		break;
		case 'loaddistrictsbyid':
		echo getDistricts($_GET['id']);
		break;
		case 'loaddistrictsbyprov':
		echo getDistrictByProvince($_GET['id']);
		break;
		case 'loadsectors':
		echo getSectors(null);
		break;
		case 'loadsectorsbyid':
		echo getSectors($_GET['id']);
		break;
		case 'loadsectorsbydist':
		echo getSectorsByDistrict($_GET['id']);
		break;
		case 'loadsectorsbydistname':
		echo getSectorsByDistrictName($_GET['distname']);
		break;
		case 'whole':
		echo wholeGeoLocRwanda();
		break;
		case 'arranger':
		echo arrangeGeoLocRwanda(array("district"=>$_GET['dist'],"sector"=>$_GET['sector']));
		break;
		default:	echo "Invalid Request";
}	
}
?>