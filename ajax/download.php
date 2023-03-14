<?php
include"../dev-plugins/file.php";
if(isset($_GET)){
switch ($_GET['cate']) {
  case 'archives':
    $size=array(100,180);
 to_pdf(array("filename"=>'hackathon',"contents"=>"Roger Android Developer",$size,$mode));
  }
}
?>