<?php
include"../file.php";

$fldn=null;//hold field names
$fieldData=null;
$data=null;//hold data to be passed
mysql_connect("localhost","root","");
mysql_select_db("osa");

function excelData(){
$fldn=null;//hold field names
$fieldData=null;
$data=null;//hold data to be passed
mysql_connect("localhost","root","");
mysql_select_db("vms");
$qy=mysql_query("SELECT emp_name,phone,email FROM employees");
$fld=mysql_num_fields($qy);
for($i=0;$i<$fld;$i++){//get field names
	$fldn[($i+1)]=mysql_field_name($qy,$i);
}

while($fth=mysql_fetch_assoc($qy)){
	//$id[]=$fth['emp_id'];
$name[]=$fth['emp_name'];
$phone[]=$fth['phone'];
$email[]=$fth['email'];
$fieldDta[]=array(1=>$name,$phone,$email);
}
$data=array("fields"=>$fldn,"fieldData"=>$fieldDta);
return $data;
}

to_excel(excelData());
function pdfData(){
$html = '
<h3>MPDF</h3>
<hr>
<h4>Manipulation of the PDF file</h4>
<p class="breadcrumb">Chapter &raquo; Topic</p>
';
$data="<p style='color:green;background-color:yellow;font-weight:bold;text-align:center'>RUTGER FILE PLUGINS MANIPULATION";

$datas="<table border='1'>
<tr>
<th>NAME</th>
<th>SEX</th>
<th>AGGREGATES</th>
<th>SCHOOL_ATTENDED</th>
<th>ACYEAR</th>
<th>ALLOCATE</th>
</tr>";
//$osa->paginationolvl("try1.php",$fields,$tables,$data,$feedgetparams,1,1);
$qy=mysql_query("SELECT * FROM candidates WHERE level='Advanced Level' AND sex='male' AND status='non'");
while($fth=mysql_fetch_assoc($qy)){
	echo "";
	$datas.="<tr>
<th>".$fth['cdt_name']."</th>
<th>".$fth['sex']."</th>
<th>".$fth['aggregates']."</th>
<th>".$fth['current_skl']."</th>
<th>".$fth['ac_year']."</th>
<th><button type='button'value=''>Run JS</button></th>
</tr>";
}
$datas.="</table>";
$dta=array("filename"=>'Roger'.date(dmYHis),"contents"=>$html.$datas.$data);
return $dta;
}


function emailData(){
return $data=array("from"=>"hasua.mr@gmail.com","to"=>"mnzroger@gmail.com","fromName"=>"MANZI ROGER ASUA
                  ","receiverName"=>"Hasua Manzi","subject"=>"Testing email plugins","message"=>"Hey there i'm RUTGER Developper 
                  i'm just testing email plugins from local machine","attachment"=>null);
}
send_Email(emailData());
?>