<?php
session_start();
date_default_timezone_set("Africa/Kigali");
include"sendAPIData.php";
include"../dev-plugins/file.php";
$data=null;
$spurl=($_SERVER['HTTP_HOST']=='localhost:12' || $_SERVER['HTTP_HOST']=='localhost')?"/RUT/igisubizo/":"";
function connect(){
  $connection=null;
	try{
  $connection= new PDO("mysql:host=localhost;dbname=bfg_beforward","bfg","Echo@@AlphaBravo");
//$connection= new PDO("mysql:host=localhost;dbname=igisubizodb","root","");
}catch(PDOException $ex){
	echo "Could not connect to Database";
}
return $connection;
}
$conn=connect();
function adminExistance(){//add an Admin if not Exist
global $conn;
 $qr=$conn->prepare("SELECT * FROM users 
                       WHERE cate_id=:admin AND delete_status=:delstatus");
$qr->execute(array("admin"=>1,"delstatus"=>0));
if ($qr->rowCount()==0) {
try{
  $conn->beginTransaction();
    $qy=$conn->prepare("INSERT INTO users VALUES(:id,:name,:nid,:uname,:phone,:email,:password,:cate,:address,:paid,:remain,:amount,:delstatus,:delreason,:regdate)");
            $qy->execute(array("id"=>'',"name"=>'Admin Admin',"nid"=>0000,"uname"=>"admin","email"=>'adminstrator',"phone"=>'0726183049',"password"=>encryptPwd('12345'),"cate"=>1,"address"=>"BFG Headquarter","paid"=>0,"remain"=>0,"amount"=>0,"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
            $conn->commit();
} catch(PDOException $ex){
  $conn->rollBack();
}
}
}
adminExistance();//autoCalled to Ensure that 
function login() { global $conn;global $spurl;
$uname=safeInput($_POST['uname']);
$pass=encryptPwd(safeInput($_POST["pass"]));
$qr=$conn->prepare("SELECT * FROM users WHERE (username=:uname || email=:uname) AND password=:pass AND (cate_id=:category || cate_id=:categvrt) AND delete_status=:delstatus");
$qr->execute(array("uname"=>$uname,"pass"=>$pass,"category"=>1,"categvrt"=>3,"delstatus"=>0));
if($cunt=$qr->rowCount()==1) {
                         
 $usr=$qr->fetchAll(PDO::FETCH_ASSOC);
                             $_SESSION['etrackuid']=encodeGetParams($usr[0]['uid']);
                             $_SESSION['usercate']=$usr[0]['cate_id'];
              setcookie('etrackuid', encodeGetParams($usr[0]['uid']), time() + (60 * 60*24*30), "/");
                          header("location:index");
                          }else{
								echo"<script>alert('wrong username or password ');</script><br>";
						}
}
function appLogin() {global $conn;
	$feed=null;
	$uname=safeInput($_GET['uname']);
$pass=encryptPwd(safeInput($_GET["password"]));

	$qr=$conn->prepare("SELECT * FROM postoffices WHERE (name=:uname || phone=:uname) AND password=:pass AND delete_status=:delstatus");

$qr->execute(array("uname"=>$uname,"pass"=>$pass,"delstatus"=>0));
if($cunt=$qr->rowCount()==1) {    
 $usr=$qr->fetchAll(PDO::FETCH_ASSOC);
                       // $feed=$usr[0]['postoff_id'];
                        $feed=array("sessid"=>$usr[0]['postoff_id'],"cate"=>'postoffice');
                        }else{//check if is Commissioner
     $qr=$conn->prepare("SELECT * FROM users WHERE (username=:uname || phone=:uname || email=:uname) AND cate_id=:category AND password=:pass AND delete_status=:delstatus");

$qr->execute(array("uname"=>$uname,"pass"=>$pass,"category"=>2,"delstatus"=>0)); 
if($cunt=$qr->rowCount()==1) {    
 $usr=$qr->fetchAll(PDO::FETCH_ASSOC);
 if($usr[0]['cate_id']==1){
                        $feed=array("sessid"=>$usr[0]['uid'],"cate"=>'admin');
 }else{
                        $feed=array("sessid"=>$usr[0]['uid'],"cate"=>'commissioner');
                        }
                        }else{  
								$feed=array("sessid"=>0,"cate"=>"fail");
                }
						}
$fop=fopen("dne.hd","a");
	fwrite($fop,"\n".date("Y-m-d H:i:s")."=>".json_encode($feed));
	fclose($fop);
	return json_encode($feed);
	}
  //echo encryptPwd("12345")."<br>";
#=========ADMIN OPERATIONS==============================================
function addUser($datas) { global $conn;global $spurl;
  $names=safeInput($datas['name']);
   $uname=safeInput($datas['uname']);
  $phone=safeInput($datas['phone']);
  $email=safeInput($datas['email']);
  $cate=safeInput($datas['category']);
  $nid=safeInput($datas['nid']);
  $address=safeInput($datas['address']);
     $password=encryptPwd(safeInput($datas['password']));
     $date=date("Y-m-d H:i:s");
   $qr=$conn->prepare("SELECT * FROM users 
                       WHERE (username=:uname OR email=:email OR phone=:phone) AND delete_status=:delstatus");
$qr->execute(array("uname"=>$uname,"email"=>$email,"phone"=>$phone,"delstatus"=>0));
$count=$qr->rowCount();
   if($count==0) {
   try{
    $conn->beginTransaction();
    $qy=$conn->prepare("INSERT INTO users VALUES(:id,:name,:nid,:uname,:phone,:email,:password,:cate,:address,:paid,:remain,:amount,:delstatus,:delreason,:regdate)");
    
      $qy->execute(array("id"=>'',"name"=>$names,"nid"=>$nid,"uname"=>$uname,"email"=>$email,"phone"=>$phone,"password"=>$password,"address"=>$address,"cate"=>$cate,"paid"=>0,"remain"=>0,"amount"=>0,"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
            $cnt=$qy->rowCount();
        if($cnt==1){
echo"ok";
}else {
echo"fail";
$fop=fopen("log.hd","a");
fwrite($fop,date("Y-m-d H:i:s")."  ".mysql_errno()."  ".mysql_error());
fclose($fop);
}//end count rows

$conn->commit();

$qry1=$conn->prepare("SELECT * FROM users ORDER BY uid DESC LIMIT 0,1");
$qry1->execute(array());
$stmt1=$qry1->fetchAll(PDO::FETCH_ASSOC);
//SAVING AN ACTIVITY

}catch(PDOException $ex){
  $conn->rollBack();
}
 }else{
  echo"exist";
}

}
function getUsers($datas) {global $conn;
  $ft=null;$additionalWhere="";
  if(!isset($datas['id'])){
if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND users.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
$qy0=$conn->prepare("SELECT users.uid,users.names,users.nid,users.username,users.phone,users.email,users.cate_id,users.address,users.paid,users.remain,users.balance,users.regdate AS usr_regdate,usertypes.usrt_name AS category,(CASE WHEN sum(withdraw_history.wth_amount_given)!=NULL THEN (sum(citizens.cit_commission)-sum(withdraw_history.wth_amount_given)) ELSE sum(citizens.cit_commission) END) AS usr_amount,sum(citizens.cit_commission) AS total_income,users.paid AS paid_amount,users.remain AS usr_remain_amount,count(citizens.cit_id) AS usr_registered,withdraw_accounts.* FROM users INNER JOIN usertypes ON usertypes.usrt_id=users.cate_id LEFT JOIN citizens ON citizens.cit_commissionerid=users.uid LEFT JOIN withdraw_accounts ON withdraw_accounts.wthac_owner_id=users.uid AND withdraw_accounts.wthac_owner_type='Commissioner' LEFT JOIN withdraw_history ON withdraw_history.wth_withdrawer_id=users.uid AND withdraw_history.wth_withdrawer_type='Commissioner' AND withdraw_history.wth_status=:status LEFT JOIN payment_history ON payment_history.pmth_payer_id=users.uid AND payment_history.pmth_payer_type='Commissioner' AND payment_history.pmth_status=:status WHERE users.delete_status=:delstatus ".$additionalWhere." GROUP BY users.uid");
$qy0->execute(array("status"=>'approved',"delstatus"=>0));

$qy=$conn->prepare("SELECT users.uid,users.names,users.nid,users.username,users.phone,users.email,users.cate_id,users.address,users.paid AS paid_amount,users.remain AS usr_remain_amount,users.balance AS usr_amount,users.regdate AS usr_regdate,usertypes.usrt_name AS category,count(citizens.cit_id) AS usr_registered,sum(citizens.cit_commission) AS total_income,withdraw_company.wthc_name AS wth_company_name,withdraw_accounts.* FROM users INNER JOIN usertypes ON usertypes.usrt_id=users.cate_id LEFT JOIN citizens ON citizens.cit_commissionerid=users.uid LEFT JOIN withdraw_accounts ON withdraw_accounts.wthac_owner_id=users.uid AND withdraw_accounts.wthac_owner_type='Commissioner' LEFT JOIN withdraw_company ON withdraw_company.wthc_id=withdraw_accounts.wthac_company  WHERE users.delete_status=:delstatus ".$additionalWhere." GROUP BY users.uid");
$qy->execute(array("delstatus"=>0));

//echo json_encode($qy->errorInfo());
if($qy->rowCount($qy)>0) {
$ft=$qy->fetchAll(PDO::FETCH_ASSOC);    
for($i=0;$i<count($ft);$i++){
   $qyCommWth=$conn->prepare("SELECT sum(wth_amount_given) AS total_withdrawn FROM withdraw_history WHERE wth_withdrawer_type=:wthtype AND wth_status=:status AND delete_status=:delstatus AND wth_withdrawer_id=:wthid");
  $qyCommWth->execute(array("wthtype"=>'Commissioner',"wthid"=>$ft[$i]['uid'],"status"=>'approved',"delstatus"=>0));
  $stmtCommWth=$qyCommWth->fetchAll(PDO::FETCH_ASSOC)[0];
$ft[$i]['total_withdrawn']=$stmtCommWth['total_withdrawn'];
}
}
}else{
$qy=$conn->prepare("SELECT users.uid,users.names,users.nid,users.username,users.phone,users.email,users.cate_id,users.address,users.paid AS paid_amount,users.remain AS usr_remain_amount,users.balance AS usr_amount,users.regdate AS usr_regdate,usertypes.usrt_name AS category,count(citizens.cit_id) AS usr_registered,sum(citizens.cit_commission) AS total_income,withdraw_company.wthc_name AS wth_company_name,withdraw_accounts.* FROM users INNER JOIN usertypes ON usertypes.usrt_id=users.cate_id LEFT JOIN citizens ON citizens.cit_commissionerid=users.uid LEFT JOIN withdraw_accounts ON withdraw_accounts.wthac_owner_id=users.uid AND withdraw_accounts.wthac_owner_type='Commissioner' LEFT JOIN withdraw_company ON withdraw_company.wthc_id=withdraw_accounts.wthac_company WHERE users.delete_status=:delstatus AND users.uid=:etrackuid GROUP BY users.uid");
$qy->execute(array("etrackuid"=>$datas['id'],"delstatus"=>0));
//echo json_encode($qy->errorInfo());
   $qyCommWth=$conn->prepare("SELECT sum(wth_amount_given) AS total_withdrawn FROM withdraw_history WHERE wth_withdrawer_type=:wthtype AND wth_status=:status AND delete_status=:delstatus AND wth_withdrawer_id=:wthid");
  $qyCommWth->execute(array("wthtype"=>'Commissioner',"wthid"=>$datas['id'],"status"=>'approved',"delstatus"=>0));
  $stmtCommWth=$qyCommWth->fetchAll(PDO::FETCH_ASSOC)[0];

if($qy->rowCount($qy)>0) {
$ft=$qy->fetchAll(PDO::FETCH_ASSOC);    
}
if(isset($datas['id'])){
$ft[0]['total_withdrawn']=$stmtCommWth['total_withdrawn'];
return json_encode(array("user"=>$ft,"wthcompany"=>json_decode(getWithdrawCompany(null),TRUE)['wthcompany']));
}
}
//echo json_encode($qy->errorInfo());
return json_encode(array("user"=>$ft));
}
function getUsersByStatus($datas){
  global $conn;
  $qy=$conn->prepare("SELECT users.uid,users.names,users.nid,users.username,users.phone,users.email,users.cate_id,users.address FROM users WHERE cate_id=:cateid");
  $qy->execute(array("cateid"=>$datas['category']));
  $users=$qy->fetchAll(PDO::FETCH_ASSOC);
  return json_encode(array("user"=>$users));
}
function updateUser($userid,$datas) { $data=null;global $conn;global $spurl;
     try{
$conn->beginTransaction();      
$name=safeInput($datas['name']);
$nid=safeInput($datas['nid']);
$uname=safeInput($datas['uname']);
  $phone=safeInput($datas['phone']);
  $email=safeInput($datas['email']);
  $cate=safeInput($datas['category']);
  $address=safeInput($datas['address']);
 $qry=$conn->prepare("SELECT * FROM users WHERE uid=:usrid");
$qry->execute(array("usrid"=>$userid));
$stmt=$qry->fetchAll(PDO::FETCH_ASSOC);

$qy=$conn->prepare("UPDATE users SET names=:name,nid=:nides,username=:uname,phone=:phone,email=:email,address=:address,cate_id=:cate WHERE uid=:userid");
 $qy->execute(array("name"=>$name,"uname"=>$uname,"nides"=>$nid,"phone"=>$phone,"email"=>$email,"address"=>$address,"cate"=>$cate,"userid"=>$userid));
 
      if($qy->rowCount()){
echo"ok";
    }else {
  echo"fail";
}

$conn->commit();
 $qry1=$conn->prepare("SELECT * FROM users WHERE uid=:usrid");
$qry1->execute(array("usrid"=>$userid));
$stmt1=$qry1->fetchAll(PDO::FETCH_ASSOC);
//SAVING ACTIVITY

}catch(PDOException $ex){
  echo $ex->getMessage();
  $conn->rollBack();
}
}
function addCitizen($datas) { global $conn;
$commid=$datas['commid'];
  $regamount=0;
  $commissionAmount=0;
  $agaciroAmount=0;
  $remainAmount=0;
  $paymstruct=null;
if($commid!=0){
  $paymstruct=json_decode(getPayments(1),TRUE)['payments'];
  $regamount=$paymstruct[0]['pay_amount'];
  $commissions=json_decode(getCommissions(array("paymentid"=>$paymstruct[0]['pay_id'])),TRUE)['commissions'];
for($i=0;$i<count($commissions);$i++){
  if($commissions[$i]['comm_target']=='Commissioner'){
if($commissions[$i]['comm_rate_type']=='%'){
  $commissionAmount=($regamount*$commissions[$i]['comm_rate'])/100;
  }else{
    $commissionAmount=$commissions[$i]['comm_rate'];
  }
}elseif($commissions[$i]['comm_target']=='Agaciro Development Fund'){
  if($commissions[$i]['comm_rate_type']=='%'){
  $agaciroAmount=($regamount*$commissions[$i]['comm_rate'])/100;
  }else{
    $agaciroAmount=$commissions[$i]['comm_rate'];
  }
}
}//end for loop
$remainAmount=$regamount-$commissionAmount-$agaciroAmount;
}//end else to check payment amount
//echo $commissionAmount."-".$agaciroAmount."=".$remainAmount;exit;
  $name=safeInput($datas['name']);
  $phone=safeInput($datas['phone']);
  $email='';
  $nid=safeInput($datas['nid']);
     $date=date("Y-m-d H:i:s");
   $qr=$conn->prepare("SELECT * FROM citizens 
                       WHERE (cit_phone=:phone OR cit_nid=:nid)");
$qr->execute(array("phone"=>$phone,"nid"=>$nid));
$count=$qr->rowCount();
   if($count==0) {
   try{
    $conn->beginTransaction();
    $qy=$conn->prepare("INSERT INTO citizens VALUES(:id,:commid,:name,:phone,:email,:nid,:amount,:commission,:agaciro,:remain,:regdate)");
    
      $qy->execute(array("id"=>'',"commid"=>$datas['commid'],"name"=>$name,"email"=>$email,"phone"=>$phone,"nid"=>$nid,"amount"=>$regamount,"commission"=>$commissionAmount,"agaciro"=>$agaciroAmount,"remain"=>$remainAmount,"regdate"=>date("Y-m-d H:i:s")));
            $cnt=$qy->rowCount();
        if($cnt==1){
          if($commid!=0){
         //Update Commissioner amount
        $qyUser=$conn->prepare("SELECT * FROM users WHERE uid=:uid AND delete_status=:delstatus");
$qyUser->execute(array("uid"=>$commid,"delstatus"=>0));
$userInfo=$qyUser->fetchAll(PDO::FETCH_ASSOC);
$qyUser1=$conn->prepare("UPDATE users SET balance=:balance,remain=:remain WHERE uid=:uid");
$qyUser1->execute(array("balance"=>($userInfo[0]['balance']+$commissionAmount),"remain"=>($userInfo[0]['remain']+$regamount),"uid"=>$commid));
          }
echo"ok";
}else {
echo"fail";
$fop=fopen("log.hd","a");
fwrite($fop,date("Y-m-d H:i:s")."  ".mysql_errno()."  ".mysql_error());
fclose($fop);
}//end count rows
$citId=$conn->lastInsertId();
$conn->commit();

$qry1=$conn->prepare("SELECT * FROM citizens WHERE cit_id=:citid");
$qry1->execute(array("citid"=>$citId));
$stmt1=$qry1->fetchAll(PDO::FETCH_ASSOC);
//SAVING AN ACTIVITY

}catch(PDOException $ex){
  $conn->rollBack();
}
 }else{
  echo"exist";
}

}
function getCitizens($datas) {global $conn;
  $ft=null;
  $additionalWhere="";

  if(!isset($datas['id'])){
    //check payment status
    if(isset($datas['commid'])){
    $additionalWhere.=" AND citizens.cit_commissionerid='".$datas['commid']."'";
  }
    if(isset($datas['paid'])){
      if($datas['paid']==0){
      $additionalWhere.=" AND citizens.reg_amount=0";
    }else{
      $additionalWhere.=" AND citizens.reg_amount!=0";
    }
    }
    if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere.=" AND citizens.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
$qy=$conn->prepare("SELECT citizens.*,LEFT(citizens.regdate,10) as regdate,count(queue.queue_id) AS total_items,users.names FROM citizens LEFT JOIN queue ON queue.queue_citizenid=citizens.cit_id LEFT JOIN users ON citizens.cit_commissionerid=users.uid WHERE citizens.regdate!=:delstatus ".$additionalWhere."  GROUP BY citizens.cit_id ORDER BY citizens.cit_id DESC");
$qy->execute(array("delstatus"=>0));
}else{
$qy=$conn->prepare("SELECT citizens.*,count(queue.queue_id) AS total_items FROM citizens LEFT JOIN queue ON queue.queue_citizenid=citizens.cit_id WHERE citizens.cit_id=:citid");
$qy->execute(array("citid"=>$datas['id']));
}
if($qy->rowCount($qy)>0) {
$ft=$qy->fetchAll(PDO::FETCH_ASSOC);    
}
return json_encode(array("citizens"=>$ft));
}
function getCitizensByCommissioner($datas) {global $conn;
  $ft=null;$additionalWhere="";
  if(!isset($datas['id'])){
    if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND citizens.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
$qy=$conn->prepare("SELECT citizens.*,count(queue.queue_id) AS total_items FROM citizens LEFT JOIN queue ON queue.queue_citizenid=citizens.cit_id WHERE citizens.cit_commissionerid=:commid ".$additionalWhere." GROUP BY citizens.cit_commissionerid");
$qy->execute(array("commid"=>$datas['commid']));
}
if($qy->rowCount($qy)>0) {
$ft=$qy->fetchAll(PDO::FETCH_ASSOC);   
}
return json_encode(array("citizen"=>$ft));
}
function searchCitizens($key){global $conn;
  $ft=null;
$qy=$conn->prepare("SELECT citizens.*,count(queue.queue_id) AS total_items FROM citizens LEFT JOIN queue ON queue.queue_citizenid=citizens.cit_id WHERE citizens.cit_nid=:key || citizens.cit_names=:key");
$qy->execute(array("key"=>$key,"delstatus"=>0));
if($qy->rowCount($qy)>0) {
$ft=$qy->fetchAll(PDO::FETCH_ASSOC);    
}
//echo $ft[0]['cit_id'];exit;
return json_encode(array("citizens"=>$ft));
}
function updateCitizens($citizenid,$datas) { $data=null;global $conn;global $spurl;
$feed=null;
  $name=safeInput($datas['owner']);
  $phone=safeInput($datas['phone']);
  $email='';
  $nid=safeInput($datas['nid']);
     $date=date("Y-m-d H:i:s");
   
    try{
$conn->beginTransaction();      
 $qry=$conn->prepare("SELECT * FROM citizens WHERE cit_id=:citid");
$qry->execute(array("citid"=>$datas['id']));
  if($qry->rowCount()>0){
$stmt=$qry->fetchAll(PDO::FETCH_ASSOC);

$qy=$conn->prepare("UPDATE citizens SET cit_names=:name,cit_nid=:nid,cit_phone=:phone WHERE cit_id=:citid");
 $qy->execute(array("name"=>$name,"nid"=>$nid,"phone"=>$phone,"citid"=>$datas['id']));

       if($qy->rowCount()==1) {
$feed="ok";
    }else {
  $feed="fail";
}
$conn->commit();
 $qry1=$conn->prepare("SELECT * FROM citizens WHERE cit_id=:citid");
$qry1->execute(array("citid"=>$citizenid));
$stmt1=$qry1->fetchAll(PDO::FETCH_ASSOC);
//SAVING ACTIVITY

}else{
  $feed='notexist';
}
}catch(PDOException $ex){
  $conn->rollBack();
}
return $feed;
}

function addPostoffices($datas) { global $conn;
	$name=safeInput($datas['name']);
	$representative=safeInput($datas['representative']);
	$phone=safeInput($datas['phone']);
	$password=encryptPwd(safeInput($datas['password']));
	$provid=safeInput($datas['provid']);
	$distid=safeInput($datas['distid']);
	$sector=safeInput($datas['sector']);
	$cell=safeInput($datas['cell']);
	$address=safeInput($datas['address']);
     $date=date("Y-m-d");
   $qr=$conn->prepare("SELECT * FROM postoffices 
                       WHERE name=:name AND cell=:cell AND delete_status=:delstatus");
  $qr->execute(array("name"=>$name,"cell"=>$cell,"delstatus"=>0));
   $cnt=$qr->rowCount();
   if($cnt==0) {
            $qy=$conn->prepare("INSERT INTO postoffices VALUES(:id,:name,:representative,:phone,:password,:provid,:distid,:sector,:cell,:address,:paid,:remain,:amount,:delstatus,:delreason,:regdate)");
            $qy->execute(array("id"=>'',"name"=>$name,"representative"=>$representative,"phone"=>$phone,"password"=>$password,"provid"=>$provid,"distid"=>$distid,"sector"=>$sector,"cell"=>$cell,"address"=>$address,"paid"=>0,"remain"=>0,"amount"=>0,"delstatus"=>0,"delreason"=>'',"regdate"=>$date));
        if($qy){
echo"ok";
}else {
echo"fail";
$fop=fopen("log.hd","a");
fwrite($fop,date("Y-m-d H:i:s")."  ".mysql_errno()."  ".mysql_error());
fclose($fop);
}//end count rows
 }else{
	echo"exist";
}
}
function getPostoffices($postoffid) { global $conn;
$data=null;$additionalWhere="";
if($postoffid==null) {	
  if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND postoffices.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
if(isset($datas['province'])){
  $additionalWhere.=" AND postoffice.prov_id='".$datas['province']."'";
}
if(isset($datas['district'])){
  $additionalWhere.=" AND postoffice.distr_id='".$datas['district']."'";
}
if(isset($datas['province'])){
  $additionalWhere.=" AND postoffice.sector='".$datas['sector']."'";
}
$qy=$conn->prepare("SELECT postoffices.postoff_id,postoffices.name,postoffices.representative,representative.rep_name as representer,representative.delete_status as repstatus,postoffices.phone,postoffices.address,postoffices.prov_id,postoffices.distr_id,postoffices.sector,provinces.province_name,districts.district_name,sector.name as sector_name,postoffices.cell,provinces.*,districts.*,sector.id as secid,sector.name as sector_name,postoffices.regdate,COUNT(losts.lost_id) AS totlosts,postoffices.paid AS paid_amount,postoffices.remain AS usr_remain_amount,postoffices.balance AS usr_amount FROM postoffices JOIN provinces ON provinces.id=postoffices.prov_id
					JOIN districts ON districts.id=postoffices.distr_id AND provinces.id=districts.provinces_id
                   LEFT JOIN doctypes ON doctypes.delete_status=:delstatus JOIN representative ON postoffices.representative=representative.rep_id JOIN sector ON sector.district_id=districts.id AND postoffices.sector=sector.id
                    LEFT JOIN losts ON losts.postoff_id=postoffices.postoff_id AND losts.representative_id=representative.rep_id AND losts.doctype_id=doctypes.doc_id 
                    AND losts.status=:pending AND losts.delete_status=:delstatus
                    WHERE postoffices.delete_status=:delstatus ".$additionalWhere." GROUP BY postoffices.postoff_id");
$qy->execute(array("pending"=>'pending',"delstatus"=>0));
}else {
              	$qy=$conn->prepare("SELECT postoffices.postoff_id,postoffices.name,postoffices.representative,representative.rep_name as representer,representative.delete_status as repstatus,postoffices.phone,postoffices.address,postoffices.balance AS usr_amount,postoffices.paid AS paid_amount,postoffices.remain AS usr_remain_amount,postoffices.prov_id,postoffices.distr_id,postoffices.sector,provinces.province_name,districts.district_name,sector.name as sector_name,postoffices.cell,provinces.*,districts.*,sector.id as secid,sector.name as sector_name,postoffices.regdate AS post_regdate,withdraw_accounts.*,withdraw_company.wthc_name AS wth_company_name
					 FROM postoffices LEFT JOIN provinces ON provinces.id=postoffices.prov_id LEFT JOIN districts ON districts.id=postoffices.distr_id AND provinces.id=districts.provinces_id INNER JOIN  representative ON postoffices.representative=representative.rep_id LEFT JOIN sector ON sector.district_id=districts.id AND postoffices.sector=sector.id LEFT JOIN payment_history ON payment_history.pmth_payer_id=postoffices.postoff_id  AND payment_history.pmth_payer_type='Postoffice' LEFT JOIN withdraw_history ON  withdraw_history.wth_withdrawer_id=postoffices.postoff_id AND withdraw_history.wth_withdrawer_type='Postoffice' LEFT JOIN withdraw_accounts ON withdraw_accounts.wthac_owner_id=postoffices.postoff_id AND withdraw_accounts.wthac_owner_type='Postoffice'  LEFT JOIN withdraw_company ON withdraw_company.wthc_id=withdraw_accounts.wthac_company
					WHERE postoffices.postoff_id=:postoffid AND postoffices.delete_status=:delstatus GROUP BY postoffices.postoff_id");
              	$qy->execute(array("postoffid"=>$postoffid,"delstatus"=>0));
                //Selects by status and their incomes
                $qyPending=$conn->prepare("SELECT COUNT(losts.lost_id) AS total_remain FROM postoffices LEFT JOIN losts ON postoffices.postoff_id=losts.postoff_id WHERE postoffices.postoff_id=:postoffid AND losts.status=:status AND postoffices.delete_status=:delstatus GROUP BY postoffices.postoff_id");
                $qyPending->execute(array("postoffid"=>$postoffid,"status"=>'pending',"delstatus"=>0));
                $stmtPending=$qyPending->fetchAll(PDO::FETCH_ASSOC);
                //avoid postoffices with no data
               $stmtPending=count($stmtPending)==0?array(array("total_remain"=>0)):$stmtPending;
               //echo json_encode($stmtPending);exit;

                $qyGiven=$conn->prepare("SELECT COUNT(losts.lost_id) AS total_given,sum(losts.ratio_postoffices) AS total_income FROM postoffices LEFT JOIN losts ON postoffices.postoff_id=losts.postoff_id LEFT JOIN payment_history ON  payment_history.pmth_payer_id=postoffices.postoff_id AND payment_history.pmth_payer_type='Postoffice' AND payment_history.pmth_status='approved' LEFT JOIN withdraw_history ON withdraw_history.wth_withdrawer_id=postoffices.postoff_id AND withdraw_history.wth_withdrawer_type='Postoffice' AND withdraw_history.wth_status='approved'  WHERE postoffices.postoff_id=:postoffid AND losts.status=:status AND postoffices.delete_status=:delstatus GROUP BY postoffices.postoff_id");
                $qyGiven->execute(array("postoffid"=>$postoffid,"status"=>'taken',"delstatus"=>0));
                $stmtGiven=$qyGiven->fetchAll(PDO::FETCH_ASSOC);
                //avoid postoffices with no data
               $stmtGiven=count($stmtGiven)==0?array(array("total_losts"=>0,"paid_amount"=>0,"total_withdrawn"=>0,"total_income"=>0,"usr_amount"=>0,"usr_remain_amount"=>0)):$stmtGiven;
               //echo json_encode($stmtGiven);exit;
              }
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
//echo json_encode($data);exit;
	if($postoffid!=null) {
    //Merging Data to make full info supply
    $data=array(array_merge($data[0],array("totlosts"=>$stmtPending[0]['total_remain']+$stmtGiven[0]['total_given']),$stmtPending[0],$stmtGiven[0]));
$data=array("postoffice"=>$data,"wthcompany"=>json_decode(getWithdrawCompany(null),TRUE)['wthcompany']);
	}
return json_encode($data);
}
function getPostofficesReport($datas){global $conn;
  if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND postoffices.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
if(isset($datas['province'])){
  $additionalWhere.=" AND postoffice.prov_id='".$datas['province']."'";
}
if(isset($datas['district'])){
  $additionalWhere.=" AND postoffice.distr_id='".$datas['district']."'";
}
if(isset($datas['province'])){
  $additionalWhere.=" AND postoffice.sector='".$datas['sector']."'";
}
  $qy=$conn->prepare("SELECT postoffices.postoff_id,postoffices.name,postoffices.representative,representative.rep_name as representer,representative.delete_status as repstatus,postoffices.phone,postoffices.address,postoffices.prov_id,postoffices.distr_id,postoffices.sector,provinces.province_name,districts.district_name,sector.name as sector_name,postoffices.cell,provinces.*,districts.*,sector.id as secid,sector.name as sector_name,postoffices.regdate AS post_regdate,COUNT(losts.lost_id) AS totlosts,(CASE WHEN losts.status='given' THEN COUNT(losts.lost_id) END) AS total_given,(CASE WHEN losts.status='pending' THEN COUNT(losts.lost_id) END) AS total_remain, sum(payment_history.pmth_amount) AS paid_amount,sum(withdraw_history.wth_amount_given) AS total_withdrawn,withdraw_accounts.*
           FROM postoffices LEFT JOIN provinces ON provinces.id=postoffices.prov_id LEFT JOIN districts ON districts.id=postoffices.distr_id AND provinces.id=districts.provinces_id LEFT JOIN doctypes ON doctypes.delete_status=:delstatus LEFT JOIN representative ON postoffices.representative=representative.rep_id LEFT JOIN losts ON losts.postoff_id=postoffices.postoff_id AND losts.representative_id=representative.rep_id AND losts.doctype_id=doctypes.doc_id AND losts.delete_status=:delstatus LEFT JOIN sector ON sector.district_id=districts.id AND postoffices.sector=sector.id LEFT JOIN payment_history ON payment_history.pmth_payer_id=postoffices.postoff_id AND payment_history.pmth_payer_type='postoffice' LEFT JOIN withdraw_history ON  withdraw_history.wth_withdrawer_id=postoffices.postoff_id AND withdraw_history.wth_withdrawer_type='postoffice' LEFT JOIN withdraw_accounts ON wthac_owner_id=postoffices.postoff_id AND wthac_owner_type='postoffice' ON  WHERE postoffices.delete_status=:delstatus ".$additionalWhere." GROUP BY postoffices.postoff_id");
  $qy->execute(array("delstatus"=>0));
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("postoffices"=>$data));
}
function getLostsByPostoffices($datas){global $conn;
$data=null;
$postoffid=$datas['postoffid'];
if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND losts.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
$qy=$conn->prepare("SELECT postoffices.postoff_id,postoffices.name,representative.rep_name as representer,losts.lost_id,losts.owner,doctypes.doctype,losts.identifier,losts.status,losts.regdate,citizens.cit_id,pay_id,pay_amount 
          FROM postoffices,representative,doctypes,losts LEFT JOIN citizens ON citizens.cit_names=losts.owner AND citizens.reg_amount!=0 LEFT JOIN queue ON citizens.cit_id=queue.queue_citizenid AND losts.identifier=queue.queue_identifier AND losts.doctype_id=queue.queue_type LEFT JOIN payment ON payment.pay_name='Losts' AND (CASE WHEN losts.regdate>=queue.regdate THEN payment.payer_type='Registered' ELSE payment.payer_type='Non Registered' END) WHERE 
          postoffices.postoff_id=losts.postoff_id AND postoffices.representative=representative.rep_id AND losts.representative_id=representative.rep_id
          AND losts.doctype_id=doctypes.doc_id AND postoffices.postoff_id=:postoffid AND losts.status=:pending ".$additionalWhere);
        $qy->execute(array("postoffid"=>$postoffid,"pending"=>'pending'));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("losts"=>$data));
}
function searchPostoffices($key) {global $conn;
$data=null;
$qy=$conn->prepare("SELECT postoffices.postoff_id,postoffices.name,postoffices.representative,representative.rep_name as representer,representative.delete_status as repstatus,postoffices.phone,postoffices.address,postoffices.prov_id,postoffices.distr_id,postoffices.sector,provinces.province_name,districts.district_name,sector.name as sector_name,postoffices.cell,provinces.*,districts.*,sector.id as secid,sector.name as sector_name,postoffices.regdate,COUNT(losts.lost_id) AS totlosts FROM postoffices JOIN provinces ON provinces.id=postoffices.prov_id
					JOIN districts ON districts.id=postoffices.distr_id AND provinces.id=districts.provinces_id
                    JOIN doctypes ON doctypes.delete_status=:delstatus JOIN representative ON postoffices.representative=representative.rep_id JOIN sector ON sector.district_id=districts.id AND postoffices.sector=sector.id
                    LEFT JOIN losts ON losts.postoff_id=postoffices.postoff_id AND losts.representative_id=representative.rep_id AND losts.doctype_id=doctypes.doc_id 
                    AND losts.status=:pending AND losts.delete_status=:delstatus
                    WHERE
					(postoffices.name LIKE :key || postoffices.representative LIKE :key || postoffices.phone LIKE :key || provinces.province_name LIKE :key || 
					districts.district_name LIKE :key || sector.name LIKE :key || postoffices.cell LIKE :key || postoffices.address LIKE :key || postoffices.regdate LIKE :key) AND postoffices.delete_status=:delstatus
					GROUP BY losts.postoff_id");
             $qy->execute(array("pending"=>'pending',"delstatus"=>0,"key"=>$key."%"));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($data);
}

function updatePostoffices($postoffid,$datas) { $data=null;global $conn;
$name=safeInput($datas['name']);
$representative=safeInput($datas['representative']);
	$phone=safeInput($datas['phone']);
	$provid=safeInput($datas['provid']);
	$distid=safeInput($datas['distrid']);
	$sector=safeInput($datas['sector']);
	$cell=safeInput($datas['cell']);
	$address=safeInput($datas['address']);
 $qy=$conn->prepare("UPDATE postoffices SET name=:name,representative=:representative,phone=:phone,prov_id=:provid,distr_id=:distid,sector=:sector,cell=:cell,address=:address WHERE postoff_id=:postoffid");
 $qy->execute(array("name"=>$name,"representative"=>$representative,"phone"=>$phone,"provid"=>$provid,"distid"=>$distid,"sector"=>$sector,"cell"=>$cell,"address"=>$address,"postoffid"=>$postoffid));
       if($qy) {
echo"ok";
		}else {
	echo"fail";
}
}

function requestResetPostoffices($postoffid,$datas) { $data=null;global $conn;
$phone=safeInput($datas['phone']);
	$reason=safeInput($datas['reason']);
$qy=$conn->prepare("SELECT * FROM postoffices WHERE phone=:phone");
$qy->execute(array("phone"=>$phone));
$qrynt=$qy->rowCount($qy);
if($qrynt==1) {
	$postoffid=$qy->fetchAll(PDO::FETCH_ASSOC)[0]["postoff_id"];
	$qrieCheckExistReset=$conn->prepare("SELECT * FROM reset WHERE postoff_id=:postoffid AND status=:status");
	$qrieCheckExistReset->execute(array("postoffid"=>$postoffid,"status"=>'pending'));
if($qrieCheckExistReset->rowCount($qrieCheckExistReset)==0) {
	$qry=$conn->prepare("INSERT INTO reset VALUES(:id,:postoffid,:reason,:status,:regdate,:regdate)");
	$qry->execute(array("id"=>'',"postoffid"=>$postoffid,"reason"=>$reason,"status"=>'pending',"regdate"=>date("Y-m-d H:i:s")));
        if($qry) {
echo"ok";
		}else {
	echo"fail";
}
}else {
	echo "allreadyonqueue";
}
}else {
	echo"notexist";
}
}
function updatePostofficesPwd($postoffid,$datas){//for postoffice itself
	global $conn;
$qy=$conn->prepare("SELECT * FROM postoffices WHERE postoff_id=:postoffid AND password=:old");
	$qy->execute(array("old"=>encryptPwd($datas["old"]),"postoffid"=>$postoffid));
	$cnt=$qy->rowCount();
if($cnt==1) {
$qy=$conn->prepare("UPDATE postoffices SET password=:new WHERE postoff_id=:postoffid");
$qy->execute(array("postoffid"=>$postoffid,"new"=>encryptPwd($datas["new"])));
if($qy){
$feed="ok";
}else{
$feed="fail";
}
}else{
$feed="notexist";
}
return $feed;
}
function resetPostoffices($resetid,$postoffid,$datas) { $data=null;//for when password Forgotten
	global $conn;
$qry=$conn->prepare("SELECT * FROM postoffices INNER JOIN reset ON reset.postoff_id=postoffices.postoff_id WHERE postoffices.postoff_id=:postoffid AND reset.reset_id=:resetid AND reset.status=:status");
$qry->execute(array("resetid"=>$resetid,"postoffid"=>$postoffid,"status"=>'pending'));
$cnt=$qry->rowCount();
if($cnt==1) {
$qy=$conn->prepare("UPDATE postoffices SET password=:new WHERE postoff_id=:postoffid");
$qy->execute(array("new"=>encryptPwd($datas['new']),"postoffid"=>$postoffid));
if($qy){
	$qrie=$conn->prepare("UPDATE reset SET status=:status,statusdate=:regdate WHERE reset_id=:resetid AND postoff_id=:postoffid");
	$qrie->execute(array("resetid"=>$resetid,"status"=>'resetted',"postoffid"=>$postoffid,"regdate"=>date("Y-m-d H:i:s")));
$feed="ok";
}else{
$feed="fail";
}
}else{
$feed="notexist";
}
return $feed;
}
function addRepresenter($datas) { global $conn;
$feed=null;
	$name=safeInput($datas['name']);
	$email=safeInput($datas['email']);
	$phone=safeInput($datas['phone']);
     $date=date("Y-m-d");
   $qry=$conn->prepare("SELECT * FROM representative 
                       WHERE rep_name=:name AND rep_phone=:phone AND delete_status=:delstatus");
$qry->execute(array("name"=>$name,"phone"=>$phone,"delstatus"=>0));
$cnt=$qry->rowCount();
   if($cnt==0) {
            $qy=$conn->prepare("INSERT INTO representative VALUES(:id,:name,:phone,:email,:delstatus,:delreason,:regdate)");
            $qy->execute(array("id"=>'',"name"=>$name,"phone"=>$phone,"email"=>$email,"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
        if($qy){
$feed="ok";
}else {
$feed="fail";
$fop=fopen("log.hd","a");
fwrite($fop,date("Y-m-d H:i:s")."  ".mysql_errno()."  ".mysql_error());
fclose($fop);
}//end count rows
 }else{
	echo"exist";
}
return $feed;
}
function getRepresenter($repid) { global $conn;
$data=null;$additionalWhere="";
if($repid==null) {
  if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND representative.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
$qy=$conn->prepare("SELECT postoffices.name,postoffices.delete_status as poststatus,representative.* FROM representative 
			LEFT JOIN postoffices ON postoffices.representative=representative.rep_id 
			AND postoffices.delete_status=:delstatus WHERE representative.delete_status=:delstatus ".$additionalWhere);
$qy->execute(array("delstatus"=>0));
             }else {
              	$qy=$conn->prepare("SELECT * FROM representative 
              	WHERE representative.rep_id=:repid AND representative.delete_status=:delstatus");
              	$qy->execute(array("repid"=>$repid,"delstatus"=>0));
              }
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);

$data=array("representative"=>$data);
return json_encode($data);
}
function searchRepresenter($key) {global $conn;
$data=null;
$qy=$conn->prepare("SELECT postoffices.name,representative.* FROM postoffices LEFT JOIN representative ON postoffices.representative=representative.rep_id 
		WHERE (representative.rep_name LIKE :key || representative.rep_phone LIKE :key representative.rep_email LIKE :key) AND representative.delete_status=:delstatus");
             $qy->execute(array("key"=>$key));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode($data);
}

function updateRepresenter($repid,$datas) { $data=null;global $conn;
$feed=null;
	$name=safeInput($datas['name']);
	$email=safeInput($datas['email']);
	$phone=safeInput($datas['phone']);
 $qy=$conn->prepare("UPDATE representative SET rep_name=:name,rep_phone=:phone,rep_email=:email WHERE rep_id=:repid");
 $qy->execute(array("repid"=>$repid,"name"=>$name,"phone"=>$phone,"email"=>$email));
       if($qy) {
$feed="ok";
}else {
$feed="fail";
$fop=fopen("log.hd","a");
fwrite($fop,date("Y-m-d H:i:s")."  ".mysql_errno()."  ".mysql_error());
fclose($fop);
}
return $feed;
}
function getRepresenterByPost($postoffid){global $conn;
	$data=null;
$qy=$conn->prepare("SELECT representative.rep_id FROM postoffices,representative 
		WHERE postoffices.representative=representative.rep_id AND postoffices.postoff_id=:postoffid 
		AND representative.delete_status=:delstatus");
$qy->execute(array("postoffid"=>$postoffid,"delstatus"=>0));
			if($qy->rowCount($qy)>0) {
				$data=$qy->fetchAll(PDO::FETCH_ASSOC);
			}else {
				$data=array("rep_id"=>0);
			}
return json_encode($data);
}
//echo json_decode(getRepresenterByPost($_GET['id']),TRUE)["rep_id"];
function addQueue($datas) { global $conn;
	$id=safeInput($datas['nid']);
  $name='';
	$type=safeInput($datas['type']);
	$identifier=safeInput($datas['identifier']);
	$notifreceive=safeInput($datas['notifreceive']);
	$address=safeInput($datas['address']);
     $date=date("Y-m-d");
     //getting Documents_id
          $qrie=$conn->prepare("SELECT * FROM doctypes WHERE doctype=:type AND delete_status=:delstatus");
          $qrie->execute(array("type"=>$type,"delstatus"=>0));
     $docInfo=$qrie->fetchAll(PDO::FETCH_ASSOC)[0];
     $docid=$docInfo["doc_id"];
     //getting Citizenid
     $qrie1=$conn->prepare("SELECT * FROM citizens 
                       WHERE cit_nid=:nid");
          $qrie1->execute(array("nid"=>$datas['nid']));
         // echo $datas['nid'];exit;
     if($qrie1->rowCount()!=0){
     $citizenid=$qrie1->fetchAll(PDO::FETCH_ASSOC)[0]["cit_id"];
     //avoid duplication
     $qry=$conn->prepare("SELECT * FROM queue 
                       WHERE queue_citizenid=:citid AND queue_type=:docid AND queue_identifier=:identifier AND delete_status=:delstatus");
$qry->execute(array("citid"=>$citizenid,"docid"=>$docid,"identifier"=>$identifier,"delstatus"=>0));
$cnt=$qry->rowCount();
   if($cnt==0) {
    //avoid  max items
    $qry1=$conn->prepare("SELECT * FROM queue 
                       WHERE queue_citizenid=:citid AND queue_type=:docid AND delete_status=:delstatus");
$qry1->execute(array("citid"=>$citizenid,"docid"=>$docid,"delstatus"=>0));
$cnt1=$qry1->rowCount();
if($docInfo['max_items']!=0){
if($cnt1<$docInfo['max_items']){
            $qy=$conn->prepare("INSERT INTO queue VALUES(:id,:citid,:commid,:name,:docid,:identifier,:notifreceive,:address,:pending,:delstatus,:delreason,:regdate)");
            $qy->execute(array("id"=>'',"citid"=>$citizenid,"commid"=>$datas['commid'],"name"=>$name,"docid"=>$docid,"identifier"=>$identifier,"notifreceive"=>$notifreceive,"address"=>$address,"pending"=>'pending',"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
        if($qy){
$feed="ok";
}else {
$feed="fail";
}//end count rows
   }else{//maximum Exceed
    $feed="maxitems";
  }
}else{//Maximum Allowed
 $qy=$conn->prepare("INSERT INTO queue VALUES(:id,:citid,:commid,:name,:docid,:identifier,:notifreceive,:address,:pending,:delstatus,:delreason,:regdate)");
            $qy->execute(array("id"=>'',"citid"=>$citizenid,"commid"=>$datas['commid'],"name"=>$name,"docid"=>$docid,"identifier"=>$identifier,"notifreceive"=>$notifreceive,"address"=>$address,"pending"=>'pending',"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
        if($qy){
$feed="ok";
}else {
$feed="fail";
}//end count rows
}
 }else{
				$feed="exist";
}
}else{
  $feed="notexist";
}
return $feed;
}
function getQueue($datas) { global $conn;
$queueid=isset($datas['id'])?$datas['id']:null;
$data=null;
$additionalWhere="";
if(isset($datas['citid'])){
  $additionalWhere.=" AND citizens.cit_id=".$datas['citid'];
}
if($queueid==null) {
  if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND queue.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
$qy=$conn->prepare("SELECT queue.*,doctypes.doctype,citizens.cit_names FROM queue LEFT JOIN citizens ON citizens.cit_id=queue.queue_citizenid INNER JOIN doctypes ON doctypes.doc_id=queue.queue_type WHERE queue.delete_status=:delstatus".$additionalWhere);
$qy->execute(array("delstatus"=>0));
              }else {
              	$qy=$conn->prepare("SELECT queue.*,doctypes.doctype,citizens.cit_names,citizens.cit_nid FROM queue LEFT JOIN citizens ON citizens.cit_id=queue.queue_citizenid INNER JOIN doctypes ON doctypes.doc_id=queue.queue_type WHERE queue.queue_id=:queueid AND queue.delete_status=:delstatus");
              	$qy->execute(array("queueid"=>$queueid,"delstatus"=>0));
              }
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("queues"=>$data,"types"=>json_decode(getTypes(null),TRUE)['types']));
}
function searchQueue($key) {global $conn;
$data=null;
$qy=$conn->prepare("SELECT queue.*,doctypes.doctype,citizens.cit_nid,citizens.cit_names FROM queue LEFT JOIN citizens ON citizens.cit_id=queue.queue_citizenid INNER JOIN doctypes ON doctypes.doc_id=queue.queue_type WHERE citizens.cit_nid=:key AND queue.delete_status=:delstatus");
             $qy->execute(array("key"=>$key,"delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("queues"=>$data));
}

function updateQueue($queueid,$datas) { $data=null;
global $conn;
  $citizens=json_decode(searchCitizens($datas['nid']),TRUE)['citizens'];

  if($citizens[0]['cit_id']!=null){
    $citizenid=$citizens[0]['cit_id'];
  }else{
    return "notexist";
  }
  $identifier=safeInput($datas['identifier']);
  $notifreceive=safeInput($datas['notifreceive']);
      //getting Documents_id
  $docInfo=json_decode(searchType($datas['type']),TRUE)['types'][0];
     $docid=$docInfo["doc_id"];
     //avoid duplication
     $qry=$conn->prepare("SELECT * FROM queue 
                       WHERE queue_citizenid=:citid AND queue_type=:docid AND queue_identifier=:identifier AND delete_status=:delstatus");
$qry->execute(array("citid"=>$citizenid,"docid"=>$docid,"identifier"=>$identifier,"delstatus"=>0));
$cnt=$qry->rowCount();
   if($cnt==0) {
    //avoid  max items
    $qry1=$conn->prepare("SELECT * FROM queue 
                       WHERE queue_citizenid=:citid AND queue_type=:docid AND delete_status=:delstatus");
$qry1->execute(array("citid"=>$citizenid,"docid"=>$docid,"delstatus"=>0));
$cnt1=$qry1->rowCount();
if($docInfo['max_items']!=0){
  //echo $cnt1."-".$docInfo['max_items'];exit;
if($cnt1<$docInfo['max_items']){
 $qy=$conn->prepare("UPDATE queue SET queue_type=:type,queue_identifier=:identifier,queue_citizenid=:citizenid
      WHERE queue_id=:queueid");
 $qy->execute(array("citizenid"=>$citizenid,"type"=>$type,"identifier"=>$identifier,"queueid"=>$queueid));
       if($qy->rowCount()==1) {
$feed="ok";
    }else {
  $feed="fail";
}
}else{
  $feed="maxitems";
}
}else{
 $qy=$conn->prepare("UPDATE queue SET queue_type=:type,queue_identifier=:identifier,queue_citizenid=:citizenid
      WHERE queue_id=:queueid");
 $qy->execute(array("citizenid"=>$citizenid,"type"=>$docid,"identifier"=>$identifier,"queueid"=>$queueid));
       if($qy->rowCount()==1) {
$feed="ok";
    }else {
  $feed="fail";
}
}
 }else{
        $feed="exist";
}
return $feed;
}

function addLosts($datas) { global $conn;
  $copy='';
  if(isset($datas['copy'])){$copy=$datas['copy'];}
$postoffid=$datas['postoffid'];
$repid=json_decode(getRepresenterByPost($postoffid),TRUE)[0]["rep_id"];
	$name=safeInput($datas['owner']);
	$identifier=safeInput($datas['identifier']);
	$doctype=safeInput($datas['type']);
	$comments=safeInput($datas['comments']);
	//$geoloc=arrangeGeoLocRwanda(array("district"=>$datas['distname'],"sector"=>$datas['sector']));
//$geolocdt=json_decode($geoloc);	
//$distid=safeInput($geolocdt->distid);
	//$sector=safeInput($geolocdt->secid);

     $date=date("Y-m-d");
     $qriy=$conn->prepare("SELECT * FROM doctypes 
                       WHERE doctype=:doctype AND delete_status=:delstatus");
$qriy->execute(array("doctype"=>$doctype,"delstatus"=>0));
     $docid=$qriy->fetchAll(PDO::FETCH_ASSOC)[0]["doc_id"];

$qrie=$conn->prepare("SELECT * FROM losts 
                       WHERE owner=:name AND identifier=:identifier AND delete_status=:delstatus AND status=:status");
$qrie->execute(array("name"=>$name,"identifier"=>$identifier,"status"=>'pending',"delstatus"=>0));
   $cnt=$qrie->rowCount();
   if($cnt==0) {
   	 if($repid!=0 && $docid!=null) {
            $qy=$conn->prepare("INSERT INTO losts VALUES(:id,:postoffid,:repid,:docid,:name,:identifier,:copy,comments,:ratio,:ratio,:ratio,:ratio,:pending,:delstatus,:delreason,:regdate)");
            $qy->execute(array("id"=>'',"postoffid"=>$postoffid,"repid"=>$repid,"docid"=>$docid,"name"=>$name,"identifier"=>$identifier,"copy"=>$copy,"comments"=>$comments,"ratio"=>0,"pending"=>'pending',"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
        if($qy){

        	//Get Queued User to Send Notification
     $qry=$conn->prepare("SELECT postoffices.postoff_id,postoffices.name as officename,postoffices.phone as officephone,queue.queue_id as queueid,citizens.cit_phone as queuephone,citizens.cit_names as ownername FROM
     				 postoffices,queue,citizens WHERE postoffices.postoff_id=:postoffid AND queue.queue_identifier=:identifier AND queue.queue_type=losts.doctype_id");
     $qry->execute(array("postoffid"=>$postoffid,"identifier"=>$identifier));
if($cntQ=$qry->rowCount()>0) {     
     $ft=$qry->fetchAll(PDO::FETCH_ASSOC);
     $officename=$ft[0]["officename"];
       $officePhone=$ft[0]["officephone"];
     if(substr($officePhone,0,1)==0){ $officePhone="25".$ft[0]["officephone"];}elseif(strlen($ft[0]["officephone"])==9){$officePhone="250".$ft[0]["officephone"];}
   $queueid=$ft[0]["queueid"];$number=$ft[0]["queuephone"];$ownername=$ft[0]["ownername"];
    $response=sendAPIData($number,array("officename"=>$officename,"officephone"=>$officePhone,"ownername"=>$ownername));

   /* $fop=fopen("API Response.hd","a");
    $prepData=array("officename"=>$officename,"officephone"=>$officePhone,"queueid"=>$queueid,"queuenumber"=>$number,"doneat"=>date("Y-m-d H:i"));
fwrite($fop,$response."=>".json_encode($prepData));
fclose($fop);
//update queue status
$qs=$conn->prepare("UPDATE queue SET queue_status=:notified WHERE queueid=:queueid");
$qs->execute(array("queueid"=>$queueid,"notified"=>$notified));
*/	//FillMessage for History
$message=$ownername." Muraho! Twishimiye kubamenyesha ko ibyo mwari mwabuze byabonetse ubu mwabisanga kubiro byacu ";
$message1="Hi! Happy to inform  you've told us that,what you've lost is now found,find it at our office:".$officename.",+".$officephone;
$date=date("Y-m-d H:i:s");
$qx=$conn->prepare("INSERT INTO notifications VALUES(:notid,:postoffid,:queueid,:message,:response,:regdate)");
$qInMsg=$qx->execute(array("notid"=>'',"postoffid"=>$ft[0]['postoff_id'],"message"=>$message."\n".$message1,"response"=>$response,"regdate"=>date("Y-m-d H:i:s")));
}
//END Sending Notification
$feed="ok";
}else {
$feed="fail";
$fop=fopen("log.hd","a");
fwrite($fop,date("Y-m-d H:i:s")."  ".mysql_errno()."  ".mysql_error());
fclose($fop);
}//end count rows
 }else{
$feed="fail"; 
 }
 }else{
		$feed="exist";
}
return $feed;
}
function getLosts($lostsid) { global $conn;
$lostsid=$lostsid;$additionalWhere="";
$data=null;
if($lostsid==null) {
  if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND losts.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
$qy=$conn->prepare("SELECT losts.*,queue.* FROM losts LEFT JOIN queues ON losts.identifier=queue.queue_identifier AND losts.doctype_id=queue.queue_type  WHERE losts.delete_status=:delstatus ".$additionalWhere." ORDER BY losts.lost_id");
$qy->execute(array("delstatus"=>0));
              }else {
              	$qy=$conn->prepare("SELECT postoffices.postoff_id,postoffices.name,representative.rep_name,losts.lost_id,losts.owner,doctypes.doctype,losts.identifier,losts.regdate 
					FROM postoffices,doctypes,losts,representative WHERE 
					postoffices.postoff_id=losts.postoff_id AND losts.doctype_id=doctypes.doc_id AND representative.rep_id=losts.representative_id
					 AND losts.status=:pending AND losts.lost_id=:lostsid AND losts.delete_status=:delstatus");
              	$qy->execute(array("lostsid"=>$lostsid,"pending"=>'pending',"delstatus"=>0));
              }
$count=$qy->rowCount();
//echo $count;exit;
if($lostsid==null) {
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
	$feed=array("losts"=>$data);
}else{
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
$types=json_decode(getTypes(null),TRUE);
$feed=array("losts"=>$data,"typ"=>$types);
}
return json_encode($feed);
}
function searchLosts($key) {global $conn;
$data=null;
$qy=$conn->prepare("SELECT postoffices.postoff_id,postoffices.name,representative.rep_name as representer,postoffices.phone,postoffices.address,provinces.province_name,districts.district_name,sector.name as sector_name,postoffices.cell,losts.lost_id,losts.owner,doctypes.doctype,losts.identifier,pay_id,pay_amount,losts.regdate 
					FROM postoffices INNER JOIN doctypes LEFT JOIN losts ON losts.doctype_id=doctypes.doc_id AND losts.postoff_id=postoffices.postoff_id INNER JOIN provinces ON postoffices.prov_id=provinces.id INNER JOIN districts ON provinces.id=districts.provinces_id AND postoffices.distr_id=districts.id  INNER JOIN sector ON districts.id=sector.district_id AND postoffices.sector=sector.id INNER JOIN representative  LEFT JOIN citizens ON citizens.cit_names=losts.owner AND citizens.reg_amount!=0 LEFT JOIN queue ON citizens.cit_id=queue.queue_citizenid AND losts.identifier=queue.queue_identifier AND losts.doctype_id=queue.queue_type LEFT JOIN payment ON payment.pay_name='Losts' AND (CASE WHEN losts.regdate>=queue.regdate THEN payment.payer_type='Registered' ELSE payment.payer_type='Non Registered' END) WHERE losts.status=:pending AND losts.delete_status=:delstatus AND (losts.identifier=:key || losts.owner=:key)");

             $qy->execute(array("pending"=>'pending',"delstatus"=>0,"key"=>$key));
$count=$qy->rowCount();
if($count>0){
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
}
return json_encode(array("losts"=>$data));
}

function searchLostsByKeys($postoffid,$key){global $conn;
$data=null;
$qy=$conn->prepare("SELECT postoffices.postoff_id,postoffices.name,representative.rep_name as representer,postoffices.phone,postoffices.address,provinces.province_name,districts.district_name,sector.name as sector_name,postoffices.cell,losts.lost_id,losts.owner,doctypes.doctype,losts.identifier,losts.regdate 
					FROM postoffices,doctypes,losts,provinces,districts,sector,representative WHERE 
					postoffices.postoff_id=losts.postoff_id AND losts.doctype_id=doctypes.doc_id  AND losts.representative_id=representative.rep_id
					 AND provinces.id=districts.provinces_id AND districts.id=sector.district_id AND postoffices.prov_id=provinces.id
					 AND postoffices.distr_id=districts.id AND postoffices.sector=sector.id AND losts.status=:pending AND losts.delete_status=:delstatus 
					 AND postoffices.postoff_id=:postoffid AND (losts.identifier LIKE :key OR losts.owner LIKE :key)");
             $qy->execute(array("pending"=>'pending',"key"=>$key."%","postoffid"=>$postoffid,"delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("losts"=>$data));
}

function updateLosts($lostsid,$datas) { $data=null;global $conn;
$name=safeInput($datas['owner']);
	$identifier=safeInput($datas['identifier']);
	$doctype=safeInput($datas['type']);
	$comments=safeInput($datas['comments']);
	//$geoloc=arrangeGeoLocRwanda(array("district"=>$datas['distname'],"sector"=>$datas['sector']));
//$geolocdt=json_decode($geoloc);	
//$distid=safeInput($geolocdt->distid);
	//$sector=safeInput($geolocdt->secid);
$qrie=$conn->prepare("SELECT * FROM doctypes 
                       WHERE doctype=:doctype AND delete_status=:delstatus");
$qrie->execute(array("doctype"=>$doctype,"delstatus"=>0));
     $docid=$qrie->fetchAll(PDO::FETCH_ASSOC)[0]["doc_id"];
 $qy=$conn->prepare("UPDATE losts SET owner=:name,identifier=:identifier,doctype_id=:docid,comments=:comments
 WHERE lost_id=:lostsid");
 $qy->execute(array("name"=>$name,"identifier"=>$identifier,"docid"=>$docid,"comments"=>$comments,"lostsid"=>$lostsid));
       if($qy) {
echo"ok";
		}else {
	echo"fail";
}
}
function setFoundLosts($datas){//update to found
	global $conn;
  $lostid=$datas['id'];
   $paymstruct=json_decode(getPayments($datas['payid']),TRUE)['payments'];
  $takeAmount=$datas['amount'];
  $commissions=json_decode(getCommissions(array("paymentid"=>$paymstruct[0]['pay_id'])),TRUE)['commissions'];
for($i=0;$i<count($commissions);$i++){
  if($commissions[$i]['comm_target']=="Postoffice"){
if($commissions[$i]['comm_rate_type']=='%'){
  $commissionAmount=($takeAmount*$commissions[$i]['comm_rate'])/100;
  }else{
    $commissionAmount=$commissions[$i]['comm_rate'];
  }
}elseif($commissions[$i]['comm_target']=='Agaciro Development Fund'){
  if($commissions[$i]['comm_rate_type']=='%'){
  $agaciroAmount=($takeAmount*$commissions[$i]['comm_rate'])/100;
  }else{
    $agaciroAmount=$commissions[$i]['comm_rate'];
  }
}
}//end for loop
$remainAmount=$takeAmount-$commissionAmount-$agaciroAmount;
$qy=$conn->prepare("SELECT * FROM losts WHERE lost_id=:lostid AND status=:pending AND delete_status=:delstatus");
$qy->execute(array("lostid"=>$lostid,"pending"=>'pending',"delstatus"=>0));
$cnt=$qy->rowCount();
if($cnt!=0) {
  $lostInfo=$qy->fetchAll(PDO::FETCH_ASSOC);
$qy=$conn->prepare("UPDATE losts SET status=:taken,paid=:amount,ratio_postoffices=:postoffice,ratio_agaciro=:agaciro,ratio_remain=:remain WHERE lost_id=:lostid");
$qy->execute(array("taken"=>'taken',"amount"=>$takeAmount,"postoffice"=>$commissionAmount,"agaciro"=>$agaciroAmount,"remain"=>$remainAmount,"lostid"=>$lostid));
       if($qy->rowCount()==1) {
         //Update postoffice amount
        $qyPost=$conn->prepare("SELECT * FROM postoffices WHERE postoff_id=:postoffid AND delete_status=:delstatus");
$qyPost->execute(array("postoffid"=>$lostInfo[0]['postoff_id'],"delstatus"=>0));
$postInfo=$qyPost->fetchAll(PDO::FETCH_ASSOC);
$qyPost1=$conn->prepare("UPDATE  postoffices SET balance=:balance,remain=:remain WHERE postoff_id=:postoffid");
$qyPost1->execute(array("balance"=>($postInfo[0]['balance']+$commissionAmount),"remain"=>($postInfo[0]['remain']+$takeAmount),"postoffid"=>$lostInfo[0]['postoff_id']));
       	$date=date("Y-m-d H:i:s");
       	$qry=$conn->prepare("INSERT INTO taken VALUES(:id,:lostid,:regdate,:regdate)");
       	$qry->execute(array("id"=>'',"lostid"=>$lostid,"regdate"=>date("Y-m-d H:i:s"),date("Y-m-d H:i")));
       

       	if($qry){
		$feed="ok";
		}else {
	$feed="fail";
}
}
}else{
$feed="ready";
}
return $feed;
}
//ABOUT TYPES
  function addType($datas) { global $conn;
 $doctype=safeInput($datas["doctype"]);
 $max=safeInput($datas["max"]);
  $date=date("Y-m-d");
  $qry=$conn->prepare("SELECT * FROM doctypes WHERE doctype=:doctype");
  $qry->execute(array("doctype"=>$doctype));
  if($qry->rowCount()==0){
   $qy=$conn->prepare("INSERT INTO doctypes VALUES(:id,:doctype,:max,:delstatus,:delreason,:regdate)");
                      $qy->execute(array("id"=>'',"doctype"=>$doctype,"max"=>$max,"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
                          if($qy){
                         		echo"ok";
							}else {
						echo"fail";
							}
}else{
	echo"exist";
}
}
function getTypes($docid) { global $conn;
$data=null;
if($docid==null) {
$qy=$conn->prepare("SELECT * FROM doctypes WHERE delete_status=:delstatus");
$qy->execute(array("delstatus"=>0));
              }else {
              	$qy=$conn->prepare("SELECT * FROM doctypes WHERE doc_id=:docid AND delete_status=:delstatus");
              	$qy->execute(array("docid"=>$docid,"delstatus"=>0));
              }   
$count=$qy->rowCount();

$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("types"=>$data));
}

function searchType($key) { global $conn;
$data=null;
   	$qy=$conn->prepare("SELECT * FROM doctypes WHERE doctype LIKE :key AND delete_status=:delstatus");
  $qy->execute(array("key"=>$key."%","delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("types"=>$data));
}
function updateType($docid,$datas) { global $conn;
$data=null;
 $doctype=safeInput($datas["doctype"]);
 $max=safeInput($datas["max"]);
 $qy=$conn->prepare("UPDATE doctypes SET doctype=:doctype,max_items=:max
                    WHERE doc_id=:docid");
 $qy->execute(array("doctype"=>$doctype,"max"=>$max,"docid"=>$docid));
if($qy) {
echo"ok";
}else {
	echo"fail";
}
}
//ABOUT REquests to Reset 
function getReqReset($resetid) { 
$data=null;global $conn;
if($resetid==null) {
$qy=$conn->prepare("SELECT postoffices.postoff_id,postoffices.name,postoffices.phone,postoffices.address,
				postoffices.prov_id,postoffices.distr_id,postoffices.sector,provinces.province_name,districts.district_name,
				sector.name as sector_name,postoffices.cell,provinces.*,districts.*,sector.id as secid,sector.name as sector_name,
				reset.reset_id,reset.reason,postoffices.regdate 
				FROM postoffices JOIN provinces ON provinces.id=postoffices.prov_id
					JOIN districts ON districts.id=postoffices.distr_id AND provinces.id=districts.provinces_id
					JOIN sector ON sector.district_id=districts.id AND postoffices.sector=sector.id JOIN reset ON postoffices.postoff_id=reset.postoff_id WHERE postoffices.delete_status=:delstatus AND reset.status=:pending");
$qy->execute(array("pending"=>'pending',"delstatus"=>0));
              }else {
$qy=$conn->prepare("SELECT postoffices.postoff_id,postoffices.name,postoffices.phone,postoffices.address,
				postoffices.prov_id,postoffices.distr_id,postoffices.sector,provinces.province_name,districts.district_name,
				sector.name as sector_name,postoffices.cell,provinces.*,districts.*,sector.id as secid,sector.name as sector_name,
				reset.reset_id,reset.reason,postoffices.regdate 
				FROM postoffices JOIN provinces ON provinces.id=postoffices.prov_id
					JOIN districts ON districts.id=postoffices.distr_id AND provinces.id=districts.provinces_id
					JOIN sector ON sector.district_id=districts.id AND postoffices.sector=sector.id JOIN reset ON
					 postoffices.postoff_id=reset.postoff_id WHERE reset.reset_id=:resetid AND postoffices.delete_status=:delstatus AND reset.status=:pending");
$qy->execute(array("resetid"=>$resetid,"pending"=>'pending',"delstatus"=>0));
              }   
$count=$qy->rowCount();

$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("requests"=>$data));
}
//ABOUT Types of  Payment that may be done via system
  function addPayment($datas) { global $conn;
    $payerid=$datas['payerid'];
    if($commid==0){
      $payertype='citizen';
    }else{
      $payertype='commissioner';
    }
 $pay_name=safeInput($datas["pay_name"]);
  $date=date("Y-m-d");
  $qry=$conn->prepare("SELECT * FROM payment WHERE pay_name=:pay_name");
  $qry->execute(array("pay_name"=>$pay_name));
  if($qry->rowCount()==0){
   $qy=$conn->prepare("INSERT INTO payment VALUES(:id,:pay_name,:amount,:delstatus,:delreason,:regdate)");
                      $qy->execute(array("id"=>'',"pay_name"=>$pay_name,"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
                          if($qy){
                            echo"ok";
              }else {
            echo"fail";
              }
}else{
  echo"exist";
}
}
function getPayments($payid) { global $conn;
$data=null;
if($payid==null) {
$qy=$conn->prepare("SELECT * FROM payment WHERE delete_status=:delstatus");
$qy->execute(array("delstatus"=>0));
              }else {
                $qy=$conn->prepare("SELECT * FROM payment WHERE pay_id=:payid AND delete_status=:delstatus");
                $qy->execute(array("payid"=>$payid,"delstatus"=>0));
              }   
$count=$qy->rowCount();

$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("payments"=>$data));
}
function getRegistrationPayment(){
  $data=null;global $conn;
    $qy=$conn->prepare("SELECT * FROM payment WHERE pay_name=:key AND delete_status=:delstatus");
  $qy->execute(array("key"=>"Registration","delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("payments"=>$data,"paymodes"=>json_decode(getPaymentMode(null),TRUE)['paymodes']));
}
function getLostsPayment($paytype){
    $data=null;
    switch ($paytype) {
      case 'nonreg':
          $paytyp='Non Registered';
        break;
        case 'reg':
          $paytyp='Registered';
          break;
      
      default:
        # code...
        break;
    }
    $qy=$conn->prepare("SELECT * FROM payment WHERE pay_name=:key AND payer_type=:paytype AND delete_status=:delstatus");
  $qy->execute(array("key"=>"Losts","type"=>$paytyp,"delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("payments"=>$data,"paymodes"=>json_decode(getPaymentMode(null),TRUE)['paymodes']));
}
function searchPayment($key) { global $conn;
$data=null;
    $qy=$conn->prepare("SELECT * FROM payment WHERE pay_name LIKE :key AND delete_status=:delstatus");
  $qy->execute(array("key"=>$key."%","delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("payments"=>$data));
}
function updatePayment($payid,$datas) { global $conn;
$data=null;
 $amount=safeInput($datas["amount"]);
 $qy=$conn->prepare("UPDATE payment SET pay_amount=:amount
                    WHERE pay_id=:payid");
 $qy->execute(array("payid"=>$payid,"amount"=>$datas['amount']));
if($qy) {
echo"ok";
}else {
  echo"fail";
}
}
//ABOUT Commissions
  function addCommission($datas) { global $conn;
 $target=safeInput($datas["target"]);
  $date=date("Y-m-d");
  $qry=$conn->prepare("SELECT * FROM commissions WHERE comm_target=:target AND comm_paymentid=:payid");
  $qry->execute(array("target"=>$target,"payid"=>$datas['payid']));
  if($qry->rowCount()==0){
   $qy=$conn->prepare("INSERT INTO commissions VALUES(:id,:payid,:target,:rate,:ratetype,:delstatus,:delreason,:regdate)");
                      $qy->execute(array("id"=>'',"payid"=>$datas['payid'],"target"=>$target,"rate"=>$datas['rate'],"ratetype"=>$datas['ratetype'],"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
                          if($qy){
                            echo"ok";
              }else {
            echo"fail";
              }
}else{
  echo"exist";
}
}
function getCommissions($datas) { global $conn;
$data=null;
$additionalWhere="";
if(!isset($datas['id'])) {
  if(isset($datas['paymentid'])){
    $additionalWhere=" AND commissions.comm_payment_id='".$datas['paymentid']."'";
  }
  if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND commissions.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
$qy=$conn->prepare("SELECT commissions.*,payment.pay_name,payment.payer_type FROM commissions INNER JOIN payment ON commissions.comm_payment_id=payment.pay_id AND payment.delete_status=:delstatus WHERE commissions.delete_status=:delstatus ".$additionalWhere);
$qy->execute(array("delstatus"=>0));
              }else {
                $qy=$conn->prepare("SELECT commissions.*,payment.pay_name,payment.payer_type FROM commissions INNER JOIN payment ON commissions.comm_payment_id=payment.pay_id AND payment.delete_status=:delstatus WHERE commissions.comm_id=:commid  AND commissions.delete_status=:delstatus");
                $qy->execute(array("commid"=>$datas['id'],"delstatus"=>0));
              }   
$count=$qy->rowCount();

$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("commissions"=>$data));
}

function searchCommission($key) { global $conn;
$data=null;
    $qy=$conn->prepare("SELECT * FROM commissions WHERE comm_target LIKE :key AND delete_status=:delstatus");
  $qy->execute(array("key"=>$key."%","delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("commissions"=>$data));
}
function updateCommission($id,$datas) { global $conn;
$data=null;
$qy=$conn->prepare("UPDATE commissions SET comm_rate=:rate,comm_rate_type=:ratetype WHERE comm_id=:id");
 $qy->execute(array("id"=>$id,"rate"=>$datas['rate'],"ratetype"=>$datas['ratetype']));
if($qy->rowCount()==1) {
echo"ok";
}else {
  echo"fail";
}
}
#==========SUPERADMIN==============
function changePwd($datas) {global $conn;
  if(isset($datas['id'])){
    $uid=$datas['id'];
  }else{
    $uid=decodeGetParams($_SESSION['etrackuid']);
  }
$qry=$conn->prepare("SELECT * FROM users WHERE uid=:etrackuid AND password=:old");
$qry->execute(array("old"=>encryptPwd($datas["old"]),"etrackuid"=>$uid));
//$qry->execute(array("old"=>encryptPwd("12345678"),"etrackuid"=>'1'));
$cnt=$qry->rowCount();
//echo $cnt;
if($cnt==1) {
	$qy=$conn->prepare("UPDATE users SET password=:new WHERE uid=:etrackuid");
$qy->execute(array("new"=>encryptPwd($datas["new"]),"etrackuid"=>$uid));
//echo $qy==true?"True":"False";
//echo json_encode($qy->errorInfo());exit;
if($qy->rowCount()==1){
	$feed="ok";
}else{
$feed="fail";
}
}else{
$feed="notexist";
}
return $feed;
}

function resetUserPassword($uid,$datas){
    global $conn;global $spurl;
    $qry=$conn->prepare("SELECT * FROM users WHERE uid=:uid");
    $qry->execute(array("uid"=>$uid));
    $stmt=$qry->fetchAll(PDO::FETCH_ASSOC);
    $qr1=$conn->prepare("UPDATE  users SET password=:pwd WHERE uid=:uid");
    $qr1->execute(array("pwd"=>encryptPwd($datas['password']),"uid"=>$uid));
    if($qr1){
        $feed='ok';

        $qry1=$conn->prepare("SELECT * FROM users WHERE uid=:uid");
        $qry1->execute(array("uid"=>$uid));
        $stmt1=$qry1->fetchAll(PDO::FETCH_ASSOC);
//SAVING ACTIVITY
      
    }else{
        $feed='fail';
    }
    return $feed;
}
//ABOUT TYPES
  function addCategory($datas) { global $conn;
 $usrt_name=safeInput($datas["usertype"]);
  $date=date("Y-m-d");
  $qry=$conn->prepare("SELECT * FROM usertypes WHERE usrt_name=:usertype");
  $qry->execute(array("usertype"=>$usertype));
  if($qry->rowCount()==0){
   $qy=$conn->prepare("INSERT INTO usertypes VALUES(:id,:usertype,:delstatus,:delreason,:regdate)");
                      $qy->execute(array("id"=>'',"usertype"=>$usertype,"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
                          if($qy){
                            echo"ok";
              }else {
            echo"fail";
              }
}else{
  echo"exist";
}
}
function getCategories($usrtid) { global $conn;
$data=null;
if($usrtid==null) {
$qy=$conn->prepare("SELECT * FROM usertypes WHERE delete_status=:delstatus");
$qy->execute(array("delstatus"=>0));
              }else {
                $qy=$conn->prepare("SELECT * FROM usertypes WHERE usrt_id=:usrtid AND delete_status=:delstatus");
                $qy->execute(array("usrtid"=>$usrtid,"delstatus"=>0));
              }   
$count=$qy->rowCount();

$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("categories"=>$data));
}

function searchCategory($key) { global $conn;
$data=null;
    $qy=$conn->prepare("SELECT * FROM usertypes WHERE usrt_name LIKE :key AND delete_status=:delstatus");
  $qy->execute(array("key"=>$key."%","delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("categories"=>$data));
}
function updateCategory($docid,$datas) { global $conn;
$data=null;
 $usrt_name=safeInput($datas["usertype"]);
 $qy=$conn->prepare("UPDATE usertypes SET usrt_name=:usertype
                    WHERE doc_id=:docid");
 $qy->execute(array("usertype"=>$usertype,"docid"=>$docid));
if($qy) {
echo"ok";
}else {
  echo"fail";
}
}
//About Withdraw Company
  function addWithdrawCompany($datas) { global $conn;
 $name=safeInput($datas["name"]);
 $accr=safeInput($datas["accr"]);
  $date=date("Y-m-d");
  $qry=$conn->prepare("SELECT * FROM withdraw_company WHERE wthc_name=:name AND wthc_accronym=:accr AND delete_status=:delstatus");
  $qry->execute(array("name"=>$name,"accr"=>$accr,"delstatus"=>0));
  if($qry->rowCount()==0){
   $qy=$conn->prepare("INSERT INTO withdraw_company VALUES(:id,:accr,:name,:delstatus,:delreason,:doneby,:regdate)");
                      $qy->execute(array("id"=>'',"accr"=>$accr,"name"=>$name,"delstatus"=>0,"delreason"=>'',"doneby"=>$datas['sessid'],"regdate"=>date("Y-m-d H:i:s")));
                          if($qy){
                            $feed="ok";
              }else {
            $feed="fail";
              }
}else{
  $feed="exist";
}
return $feed;
}
function getWithdrawCompany($wthcid) { global $conn;
$data=null;
if($wthcid==null) {
$qy=$conn->prepare("SELECT * FROM withdraw_company WHERE delete_status=:delstatus");
$qy->execute(array("delstatus"=>0));
              }else {
                $qy=$conn->prepare("SELECT * FROM withdraw_company WHERE wthc_id=:wthcid AND delete_status=:delstatus");
                $qy->execute(array("wthcid"=>$wthcid,"delstatus"=>0));
              }   
$count=$qy->rowCount();

$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("wthcompany"=>$data));
}

function searchWithdrawCompany($key) { global $conn;
$data=null;
    $qy=$conn->prepare("SELECT * FROM withdraw_company WHERE wthc_name=:key || wthc_accronym=:key AND delete_status=:delstatus");
  $qy->execute(array("key"=>$key,"delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("wthcompany"=>$data));
}
function updateWithdrawCompany($wthcid,$datas) { global $conn;
$data=null;
 $name=safeInput($datas["name"]);
 $accr=safeInput($datas["accr"]);
 $qy=$conn->prepare("UPDATE withdraw_company SET wthc_name=:name,wthc_accronym=:accr
                    WHERE wthc_id=:wthcid");
 $qy->execute(array("name"=>$name,"accr"=>$accr,"wthcid"=>$wthcid));
if($qy) {
$feed="ok";
}else {
  $feed="fail";
}
return $feed;
}

//ABOUT PAYMENT MODES OF USERS
  function addPaymentMode($datas) { 
    global $conn;global $spurl;
 $modename=safeInput($datas["modename"]);
  $company=safeInput($datas["company"]);
   $accname=safeInput($datas["accname"]);
    $accnumber=safeInput($datas["accnumber"]);
  $date=date("Y-m-d H:i");
  $qry=$conn->prepare("SELECT * FROM payment_mode WHERE pmtd_account_number=:accnumber AND delete_status=:delstatus");
  $qry->execute(array("accnumber"=>$accnumber,"delstatus"=>0));
  $cnt=$qry->rowCount();
  if($cnt==0){
   $qy=$conn->prepare("INSERT INTO payment_mode VALUES(:pmtdid,:name,:company,:accname,:accnumber,:delstatus,:delreason,:doneby,:deldate,:regdate)");
     $qy->execute(array("pmtdid"=>'',"name"=>$modename,"company"=>$company,"accname"=>$accname,"accnumber"=>$accnumber,"delstatus"=>0,"delreason"=>'',"doneby"=>$datas['sessid'],"deldate"=>$date,"regdate"=>$date));  
    if($qy){
      $feed="ok";

$qry1=$conn->prepare("SELECT * FROM payment_mode ORDER BY pmtd_id DESC");
$qry1->execute();
$stmt1=$qry1->fetchAll(PDO::FETCH_ASSOC);


              }else {
            $feed="fail ".json_encode($qy->errorInfo());
              }
}else{
  $feed="exist";
}
return $feed;
}
function getPaymentMode($pmtdid) { 
$data=null;global $conn;global $spurl;$additionalWhere="";
if($pmtdid==null) {
  if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND payment_mode.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
$qy=$conn->prepare("SELECT * FROM payment_mode WHERE delete_status=:delstatus ORDER BY payment_mode.pmtd_id DESC");
$qy->execute(array("delstatus"=>0));
              }else {
                $qy=$conn->prepare("SELECT * FROM payment_mode WHERE pmtd_id=:id AND delete_status=:delstatus");
       $qy->execute(array("id"=>$pmtdid,"delstatus"=>0));       }
       
$count=$qy->rowCount($qy);
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("paymodes"=>$data));
}

function searchPaymentMode($key) { 
$data=null;global $conn;global $spurl;
    $qy=$conn->prepare("SELECT * FROM payment_mode WHERE pmtd_name LIKE :key AND delete_status=:delstatus");
    $qy->execute(array("key"=>$key."%","delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("paymodes"=>$data));
}
function updatePaymentMode($pmtdid,$datas) { 
$data=null;global $conn;global $spurl;
 $modename=safeInput($datas["modename"]);
  $company=safeInput($datas["company"]);
   $accname=safeInput($datas["accname"]);
    $accnumber=safeInput($datas["accnumber"]);
$qry=$conn->prepare("SELECT * FROM payment_mode WHERE pmtd_id=:pmtdid");
$qry->execute(array("pmtdid"=>$pmtdid));
$stmt=$qry->fetchAll(PDO::FETCH_ASSOC);
 $qy=$conn->prepare("UPDATE payment_mode SET pmtd_name=:modename,pmtd_company=:company,pmtd_account_name=:accname,pmtd_account_number=:accnumber
                    WHERE pmtd_id=:pmtdid");
    $qy->execute(array("pmtdid"=>$pmtdid,"modename"=>$modename,"company"=>$company,"accname"=>$accname,"accnumber"=>$accnumber)); 
    if($qy) {
$feed="ok";//.json_encode($qy->errorInfo());
$qry1=$conn->prepare("SELECT * FROM payment_mode WHERE pmtd_id=:pmtdid");
$qry1->execute(array("pmtdid"=>$pmtdid));
$stmt1=$qry1->fetchAll(PDO::FETCH_ASSOC);

}else {
  $feed="fail";
}
return $feed;
}
//ABOUT PAYMENT HISTORY OF Commissioners
  function addPaymentHistory($datas) { 
    global $conn;global $spurl;
 $payerid=safeInput($datas["payerid"]);
 $payertype=safeInput($datas['payertype']);
 if($payerid==0){
  $citizens=json_decode(searchCitizens($datas['nid']),TRUE)['citizens'];
 if($citizens[0]['cit_id']!=null){
    $payerid=$citizens[0]['cit_id'];
  }else{
    return "notexist";
  }
  $payertype='Citizen';
 }
  $mode=json_decode(searchPaymentMode($datas["paymode"]),TRUE)['paymodes'][0]['pmtd_id'];
   $amount=safeInput($datas["amount"]);
  $date=date("Y-m-d H:i");
  $qry=$conn->prepare("SELECT * FROM payment_history WHERE pmth_amount=:amount AND pmth_payer_id=:payer AND pmth_payer_type=:payertype AND pmth_status=:status AND delete_status=:delstatus");
  $qry->execute(array("payer"=>$payerid,"payertype"=>$payertype,"amount"=>$amount,"status"=>'pending',"delstatus"=>0));
  $cnt=$qry->rowCount();
  if($cnt==0){
   $qy=$conn->prepare("INSERT INTO payment_history VALUES(:pmthid,:payerid,:payertype,:mode,:sendername,:senderphone,:amount,:status,:approvedby,:approvaldate,:delstatus,:delreason,:regdate)");
     $qy->execute(array("pmthid"=>'',"payerid"=>$payerid,"payertype"=>$payertype,"mode"=>$mode,"sendername"=>$datas['sendername'],"senderphone"=>$datas['senderphone'],"amount"=>$amount,"status"=>'pending',"approvedby"=>0,"approvaldate"=>"0000-00-00","delstatus"=>0,"delreason"=>'',"regdate"=>$date));  
    if($qy){
       if($datas['payertype']=='Commissioner'){
        $userInfo=json_decode(searchUser($datas['payerid']),TRUE)[0];
        //Send an email
        $message="You have Made Payment Submission ".$amount." RWF</b><br> from Registered Citizen <br> Today ".$date;
           //$response= sendEmail(array("from"=>'noreply@bfg.rw',"fromName"=>'IGISUBIZO System',"to"=>$userInfo['email'],"replyTo"=>'noreply',"subject"=>"Payment Submission","message"=>$message));
      }
      $feed="ok";

$qry1=$conn->prepare("SELECT * FROM payment_history ORDER BY pmth_id DESC");
$qry1->execute();
$stmt1=$qry1->fetchAll(PDO::FETCH_ASSOC);
              }else {
            $feed="fail ".json_encode($qy->errorInfo());
              }
}else{
  $feed="exist";
}
return $feed;
}
function getPaymentHistory($datas) { 
$data=null;global $conn;global $spurl;$additionalWhere="";
if(!isset($datas['id'])) {
if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND payment_history.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}

if(isset($datas['payerid']) && isset($datas['payertype'])){
  $additionalWhere.=" AND payment_history.pmth_payer_id='".$datas['payerid']."' AND payment_history.pmth_payer_type='".$datas['payertype']."'";
}
if(!isset($datas['payerid']) && isset($datas['payertype'])){
  $additionalWhere.=" AND payment_history.pmth_payer_type='".$datas['payertype']."'";
}
if(isset($datas['paymode'])){
  $additionalWhere.=" AND payment_history.payment_mode='".$datas['paymode']."'";
}
if(isset($datas['status'])){
  $additionalWhere.=" AND payment_history.pmth_status='".$datas['status']."'";
}
$qy=$conn->prepare("SELECT payment_history.*,(CASE WHEN payment_history.pmth_payer_type='Commissioner' THEN users.names WHEN payment_history.pmth_payer_type='Postoffice' THEN postoffices.name ELSE citizens.cit_names END) AS payer_names,payment_mode.*  FROM payment_history LEFT JOIN citizens ON citizens.cit_id=payment_history.pmth_payer_id AND payment_history.pmth_payer_type='Citizen' LEFT JOIN users on users.uid=payment_history.pmth_payer_id AND payment_history.pmth_payer_type='Commissioner' LEFT JOIN postoffices ON postoffices.postoff_id=payment_history.pmth_payer_id AND payment_history.pmth_payer_type='Postoffice' INNER JOIN payment_mode ON payment_mode.pmtd_id=payment_history.payment_mode WHERE payment_history.regdate!=0 ".$additionalWhere." ORDER BY payment_history.pmth_id DESC");
$qy->execute(array("delstatus"=>0));
              }else {
                $qy=$conn->prepare("SELECT * FROM payment_history WHERE pmth_id=:id AND delete_status=:delstatus");
       $qy->execute(array("id"=>$datas['id'],"delstatus"=>0));       
     }
     $count=$qy->rowCount($qy);
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("payhistory"=>$data));
}

function searchPaymentHistory($key) { 
$data=null;global $conn;global $spurl;
    $qy=$conn->prepare("SELECT * FROM payment_history WHERE pmth_name LIKE :key AND delete_status=:delstatus");
    $qy->execute(array("key"=>$key."%","delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("payhistory"=>$data));
}
function updatePaymentHistory($pmthid,$datas) { 
$data=null;global $conn;global $spurl;
 $commissionerid=safeInput($datas["commissionerid"]);
  $mode=safeInput($datas["mode"]);
   $amount=safeInput($datas["amount"]);
    $status=safeInput($datas["status"]);
$qry=$conn->prepare("SELECT * FROM payment_history WHERE pmth_id=:pmthid");
$qry->execute(array("pmthid"=>$pmthid));
$stmt=$qry->fetchAll(PDO::FETCH_ASSOC);
 $qy=$conn->prepare("UPDATE payment_history SET pmth_name=:commissionerid,pmth_mode=:mode,pmth_account_name=:amount,pmth_amount=:status
                    WHERE pmth_id=:pmthid");
    $qy->execute(array("pmthid"=>$pmthid,"commissionerid"=>$commissionerid,"mode"=>$mode,"amount"=>$amount,"status"=>$status)); 
    if($qy) {
$feed="ok";//.json_encode($qy->errorInfo());
$qry1=$conn->prepare("SELECT * FROM payment_history WHERE pmth_id=:pmthid");
$qry1->execute(array("pmthid"=>$pmthid));
$stmt1=$qry1->fetchAll(PDO::FETCH_ASSOC);

}else {
  $feed="fail";
}
return $feed;
}
function approvePaymentHistory($pmthid,$datas) { 
$data=null;global $conn;global $spurl;
$qry=$conn->prepare("SELECT * FROM payment_history WHERE pmth_id=:pmthid AND pmth_status=:status");
$qry->execute(array("pmthid"=>$pmthid,"status"=>'pending'));
if($qry->rowCount()>0){
$stmt=$qry->fetchAll(PDO::FETCH_ASSOC);

 $qy=$conn->prepare("UPDATE payment_history SET pmth_approvedby=:approver,pmth_approval_date=:regdate,pmth_status=:status
                    WHERE pmth_id=:pmthid");
    $qy->execute(array("pmthid"=>$pmthid,"approver"=>$datas['sessid'],"regdate"=>date("Y-m-d H:i:s"),"status"=>'approved')); 
    if($qy) {
      //updating ratios to all partners
      //Notify by Email Owner for Withdraw Request Approval
      if($stmt[0]['pmth_payer_type']=='Commissioner'){
        $userInfo=json_decode(getUsers(array("id"=>$stmt[0]['pmth_payer_id'])),TRUE)['user'];
        //Send an email
        $message="Your Payment you have done is Approved ".$stmt[0]['pmth_amount']." RWF from Account Holder <b>".$stmt[0]['pmth_sender_name']."</b> Account Number <b>".$stmt['pmth_sender_phone']."</b> Registered On ".$stmt[0]['regdate']."<br> Approved  Today ".$date;
           //$response= sendEmail(array("from"=>'noreply@bfg.rw',"fromName"=>'IGISUBIZO System',"to"=>$userInfo['email'],"replyTo"=>'noreply',"subject"=>"Payment Submission Approval","message"=>$message));

         //Update users payment history and withdraw amounts
  $qryPayhist=$conn->prepare("SELECT sum(pmth_amount) AS paid FROM payment_history WHERE pmth_status=:status AND pmth_payer_type=:payertype AND pmth_payer_id=:payerid");
$qryPayhist->execute(array("payerid"=>$stmt[0]['pmth_payer_id'],"payertype"=>$stmt[0]['pmth_payer_type'],"status"=>'approved'));
$stmtPayhist=$qryPayhist->fetchAll(PDO::FETCH_ASSOC);
  
  $qryCit=$conn->prepare("SELECT sum(reg_amount) AS total_amount FROM citizens WHERE cit_commissionerid=:commid");
$qryCit->execute(array("commid"=>$stmt[0]['pmth_payer_id']));
$stmtCit=$qryCit->fetchAll(PDO::FETCH_ASSOC);
//Assign diffrences of payhistory and withdraw to users
$paid=$userInfo[0]['paid_amount']+$stmt[0]['pmth_amount'];
$remain=$userInfo[0]['usr_remain_amount']-$stmt[0]['pmth_amount'];
//update user remain and paid amount from registrations
   $qy12=$conn->prepare("UPDATE users SET paid=:paid,remain=:remain WHERE uid=:uid");
    $qy12->execute(array("uid"=>$stmt[0]['pmth_payer_id'],"paid"=>$paid,"remain"=>$remain)); 
      }
      if($stmt[0]['pmth_payer_type']=='Postoffice'){
               $userInfo=json_decode(getPostoffices($stmt[0]['pmth_payer_id']),TRUE)['postoffice'];
        //Send an email
        $message="Your Payment you have done is Approved ".$stmt[0]['pmth_amount']." RWF from Account Holder <b>".$stmt[0]['pmth_sender_name']."</b> Account Number <b>".$stmt['pmth_sender_phone']."</b> Registered On ".$stmt[0]['regdate']."<br> Approved  Today ".$date;
           //$response= sendEmail(array("from"=>'noreply@bfg.rw',"fromName"=>'IGISUBIZO System',"to"=>$userInfo['email'],"replyTo"=>'noreply',"subject"=>"Payment Submission Approval","message"=>$message));

         //Update users payment history and withdraw amounts
 
$paid=$userInfo[0]['paid_amount']+$stmt[0]['pmth_amount'];
$remain=$userInfo[0]['usr_remain_amount']-$stmt[0]['pmth_amount'];
//update user remain and paid amount from registrations
   $qy12=$conn->prepare("UPDATE postoffices SET paid=:paid,remain=:remain WHERE postoff_id=:uid");
    $qy12->execute(array("uid"=>$stmt[0]['pmth_payer_id'],"paid"=>$paid,"remain"=>$remain));
      }
if($stmt[0]['pmth_payer_type']=='Citizen'){
//Activating Citizen Accounts & add ratios to all Partners
  $regamount=0;
  $commissionAmount=0;
  $agaciroAmount=0;
  $remainAmount=0;
  $paymstruct=json_decode(getPayments(1),TRUE)['payments'];
  $regamount=$paymstruct[0]['pay_amount'];
  $commissions=json_decode(getCommissions(array("paymentid"=>$paymstruct[0]['pay_id'])),TRUE)['commissions'];
for($i=0;$i<count($commissions);$i++){
  if($commissions[$i]['comm_target']=='Agaciro Development Fund'){
  if($commissions[$i]['comm_rate_type']=='%'){
  $agaciroAmount=($regamount*$commissions[$i]['comm_rate'])/100;
  }else{
    $agaciroAmount=$commissions[$i]['comm_rate'];
  }
}
}//end for loop
$remainAmount=$regamount-$agaciroAmount;
 $qy=$conn->prepare("UPDATE citizens SET reg_amount=:regamount,cit_agaciro=:agaciro,cit_remain=:remain
                    WHERE cit_id=:citid");
    $qy->execute(array("regamount"=>$regamount,"agaciro"=>$agaciroAmount,"remain"=>$remainAmount,"citid"=>$stmt[0]['pmth_payer_id'])); 

}
$feed="ok";//.json_encode($qy->errorInfo());
$qry1=$conn->prepare("SELECT * FROM payment_history WHERE pmth_id=:pmthid");
$qry1->execute(array("pmthid"=>$pmthid));
$stmt1=$qry1->fetchAll(PDO::FETCH_ASSOC);

}else {
  $feed="fail";
}
}else{
  $feed="notexist";
}
return $feed;
}
//About withdraw accounts
 function addWithdrawAccounts($datas) { global $conn;
 $accownerid=safeInput($datas["ownerid"]);
 $accownertype=safeInput($datas["ownertype"]);
 $accname=safeInput($datas["accname"]);
 $accnumber=safeInput($datas["accnumber"]);
 $company=safeInput($datas["company"]);
  $date=date("Y-m-d");
  $companyId=json_decode(searchWithdrawCompany($company),TRUE)['wthcompany'][0]['wthc_id'];
  $qry=$conn->prepare("SELECT * FROM withdraw_accounts WHERE (wthac_owner_id=:ownerid AND wthac_owner_type=:ownertype) || (wthac_company=:company AND wthac_number=:accnumber)");
  $qry->execute(array("ownerid"=>$accownerid,"ownertype"=>$accownertype,"company"=>$companyId,"accnumber"=>$accnumber));
  if($qry->rowCount()==0){
   $qy=$conn->prepare("INSERT INTO withdraw_accounts VALUES(:id,:ownerid,:ownertype,:company,:accname,:accnumber,:delstatus,:delreason,:regdate)");
                      $qy->execute(array("id"=>'',"ownerid"=>$accownerid,"ownertype"=>$accownertype,"company"=>$companyId,"accname"=>$accname,"accnumber"=>$accnumber,"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
                          if($qy){
                            $feed="ok";
              }else {
            $feed="fail";
              }
}else{
  $feed="exist";
}
return $feed;
}
function getWithdrawAccounts($wthacid) { global $conn;
$data=null;$additionalWhere="";
if($wthacid==null) {
  if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND withdraw_accounts.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
$qy=$conn->prepare("SELECT * FROM withdraw_accounts WHERE delete_status=:delstatus ".$additionalWhere);
$qy->execute(array("delstatus"=>0));
              }else {
                $qy=$conn->prepare("SELECT * FROM withdraw_accounts WHERE wthac_id=:wthacid AND delete_status=:delstatus");
                $qy->execute(array("wthacid"=>$wthacid,"delstatus"=>0));
              }   
$count=$qy->rowCount();

$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("categories"=>$data));
}

function searchWithdrawAccounts($key) { global $conn;
$data=null;
    $qy=$conn->prepare("SELECT * FROM withdraw_accounts WHERE wthac_name LIKE :key AND delete_status=:delstatus");
  $qy->execute(array("key"=>$key."%","delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("categories"=>$data));
}
function updateWithdrawAccounts($wthacid,$datas) { global $conn;
$data=null;
 $accownerid=safeInput($datas["ownerid"]);
 $accownertype=safeInput($datas["ownertype"]);
 $accname=safeInput($datas["accname"]);
 $accnumber=safeInput($datas["accnumber"]);
 $company=safeInput($datas["company"]);
  $companyId=json_decode(searchWithdrawCompany($company),TRUE)['wthcompany'][0]['wthc_id'];
    $qry=$conn->prepare("SELECT * FROM withdraw_accounts WHERE wthac_owner_id!=:ownerid AND wthac_company=:company AND wthac_number=:numbers");
  $qry->execute(array("ownerid"=>$accownerid,"company"=>$companyId,"numbers"=>$accnumber));
  if($qry->rowCount()==0){
 $qy=$conn->prepare("UPDATE withdraw_accounts SET wthac_owner_id=:ownerid,wthac_owner_type=:ownertype,wthac_name=:accname,wthac_number=:accnumber,wthac_company=:company
                    WHERE wthac_id=:wthacid");
$qy->execute(array("ownerid"=>$accownerid,"ownertype"=>$accownertype,"company"=>$companyId,"accname"=>$accname,"accnumber"=>$accnumber,"wthacid"=>$wthacid));
if($qy) {
$feed="ok";
}else {
  $feed="fail";
}
}else{
  $feed="exist";
}
return $feed;
}

//ABOUT PAYMENT HISTORY OF Commissioners
  function addPaymentWithdraw($datas) { 
    global $conn;global $spurl;
 $withdrawerid=$datas['withdrawerid'];

  if($datas['withdrawertype']=='Commissioner'){
$userInfo=json_decode(getUsers(array("id"=>$withdrawerid)),TRUE)['user'][0];
   }elseif($datas['withdrawertype']=='Postoffice'){
$userInfo=json_decode(getPostoffices($withdrawerid),TRUE)['postoffice'][0];
   }
  $amount=safeInput($datas["amount"]);
  $date=date("Y-m-d H:i");
  $qry=$conn->prepare("SELECT * FROM withdraw_history WHERE wth_amount=:amount AND wth_withdrawer_id=:withdrawer AND wth_withdrawer_type=:withdrawtype AND wth_status=:status AND delete_status=:delstatus");
  $qry->execute(array("withdrawer"=>$userInfo['wthac_owner_id'],"withdrawtype"=>$userInfo['wthac_owner_type'],"amount"=>$amount,"status"=>'pending',"delstatus"=>0));
  $cnt=$qry->rowCount();
  //echo json_encode($userInfo);exit;
  if($cnt==0){
   $qy=$conn->prepare("INSERT INTO withdraw_history VALUES(:wthid,:withdrawerid,:withdrawertype,:company,:accname,:accnbr,:amountgiven,:amountreq,:status,:approvedby,:approvaldate,:delstatus,:delreason,:regdate)");
     $qy->execute(array("wthid"=>'',"withdrawerid"=>$withdrawerid,"withdrawertype"=>$datas['withdrawertype'],"company"=>$userInfo['wthac_company'],"accname"=>$userInfo['wthac_name'],"accnbr"=>$userInfo['wthac_number'],"amountgiven"=>0,"amountreq"=>$amount,"status"=>'pending',"approvedby"=>0,"approvaldate"=>"0000-00-00","delstatus"=>0,"delreason"=>'',"regdate"=>$date));  
     echo json_encode($qy->errorInfo());
    if($qy){
      //Notify by Email Owner for Withdraw Request
      if($datas['withdrawertype']=='Commissioner'){
        //Send an email
        $message="Your account has been Requested to withdraw ".$amount." RWF Today ".$date;
           //$response= sendEmail(array("from"=>'noreply@bfg.rw',"fromName"=>'IGISUBIZO System',"to"=>$userInfo['email'],"replyTo"=>'noreply',"subject"=>"Withdraw Request","message"=>$message));
      }

      $feed="ok";
$qry1=$conn->prepare("SELECT * FROM withdraw_history ORDER BY wth_id DESC");
$qry1->execute();
$stmt1=$qry1->fetchAll(PDO::FETCH_ASSOC);
              }else {
            $feed="fail ".json_encode($qy->errorInfo());
              }
}else{
  $feed="exist";
}
return $feed;
}
function getPaymentWithdraw($datas) { 
$data=null;global $conn;global $spurl;$additionalWhere="";
if(!isset($datas['id'])) {
  if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND withdraw_history.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
if(isset($datas['withdrawer']) && isset($datas['wthtype'])){
  $additionalWhere.=" AND withdraw_history.wth_withdrawer_id='".$datas['withdrawer']."' AND withdraw_history.wth_withdrawer_type='".$datas['wthtype']."'";
}
if(!isset($datas['withdrawer']) && isset($datas['wthtype'])){
  $additionalWhere.=" AND withdraw_history.wth_withdrawer_type='".$datas['wthtype']."'";
}
if(isset($datas['wthcompany'])){
  $additionalWhere.=" AND withdraw_history.wth_withdrawer_acccompany='".$datas['wthcompany']."'";
}
if(isset($datas['status'])){
  $additionalWhere.=" AND withdraw_history.wth_status='".$datas['status']."'";
}
$qy=$conn->prepare("SELECT withdraw_history.*,(CASE WHEN withdraw_history.wth_withdrawer_type='Commissioner' THEN users.names  ELSE postoffices.name END) AS withdrawer_names,withdraw_company.wthc_name AS wth_company_name  FROM withdraw_history LEFT JOIN users ON users.uid=withdraw_history.wth_withdrawer_id AND withdraw_history.wth_withdrawer_type='Commissioner' LEFT JOIN postoffices ON postoffices.postoff_id=withdraw_history.wth_withdrawer_id AND withdraw_history.wth_withdrawer_type='Postoffice' INNER JOIN withdraw_company ON withdraw_company.wthc_id=withdraw_history.wth_withdrawer_acccompany  WHERE withdraw_history.delete_status=:delstatus ".$additionalWhere." ORDER BY withdraw_history.wth_id DESC");
$qy->execute(array("delstatus"=>0));
//echo json_encode($qy->errorInfo());
              }else {
                $qy=$conn->prepare("SELECT * FROM withdraw_history WHERE wth_id=:id AND delete_status=:delstatus");
       $qy->execute(array("id"=>$datas['id'],"delstatus"=>0));       
     }
     $count=$qy->rowCount($qy);
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("withdraws"=>$data));
}

function searchPaymentWithdraw($key) { 
$data=null;global $conn;global $spurl;
    $qy=$conn->prepare("SELECT * FROM withdraw_history WHERE pmth_name LIKE :key AND delete_status=:delstatus");
    $qy->execute(array("key"=>$key."%","delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("payhistory"=>$data));
}
function updatePaymentWithdraw($pmthid,$datas) { 
$data=null;global $conn;global $spurl;
 $commissionerid=safeInput($datas["commissionerid"]);
  $mode=safeInput($datas["mode"]);
   $amount=safeInput($datas["amount"]);
    $status=safeInput($datas["status"]);
$qry=$conn->prepare("SELECT * FROM withdraw_history WHERE pmth_id=:pmthid");
$qry->execute(array("pmthid"=>$pmthid));
$stmt=$qry->fetchAll(PDO::FETCH_ASSOC);
 $qy=$conn->prepare("UPDATE withdraw_history SET pmth_name=:commissionerid,pmth_mode=:mode,pmth_account_name=:amount,pmth_amount=:status
                    WHERE pmth_id=:pmthid");
    $qy->execute(array("pmthid"=>$pmthid,"commissionerid"=>$commissionerid,"mode"=>$mode,"amount"=>$amount,"status"=>$status)); 
    if($qy) {
$feed="ok";//.json_encode($qy->errorInfo());
$qry1=$conn->prepare("SELECT * FROM withdraw_history WHERE pmth_id=:pmthid");
$qry1->execute(array("pmthid"=>$pmthid));
$stmt1=$qry1->fetchAll(PDO::FETCH_ASSOC);

}else {
  $feed="fail";
}
return $feed;
}
function approvePaymentWithdraw($wthid,$datas) { 
$data=null;global $conn;global $spurl;
//get info about withdraw
$qry=$conn->prepare("SELECT * FROM withdraw_history WHERE wth_id=:wthid AND wth_status=:status");
$qry->execute(array("wthid"=>$wthid,"status"=>'pending'));
if($qry->rowCount()>0){
$stmt=$qry->fetchAll(PDO::FETCH_ASSOC)[0];

$date=date("Y-m-d H:i:s");
 $qy=$conn->prepare("UPDATE withdraw_history SET wth_amount_given=:given,wth_approvedby=:approver,wth_approval_date=:regdate,wth_status=:status
                    WHERE wth_id=:wthid");
    $qy->execute(array("wthid"=>$wthid,"given"=>$datas['given'],"approver"=>$datas['sessid'],"regdate"=>date("Y-m-d H:i:s"),"status"=>'approved')); 
    if($qy->rowCount()==1) {

          //Update users withdraw history and withdraw amounts
  $qryWth=$conn->prepare("SELECT sum(wth_amount_given) AS wth_amount_given FROM withdraw_history WHERE wth_status=:status AND wth_withdrawer_type=:wthtype AND wth_withdrawer_id=:wthid");
$qryWth->execute(array("wthid"=>$stmt['wth_withdrawer_id'],"wthtype"=>$stmt['wth_withdrawer_type'],"status"=>'approved'));
$stmtWth=$qryWth->fetchAll(PDO::FETCH_ASSOC);
//Notify by Email Owner for Withdraw Request Approval
      if($stmt['wth_withdrawer_type']=='Commissioner'){
        $userInfo=json_decode(getUsers(array("id"=>$stmt['wth_withdrawer_id'])),TRUE)[0];
        //Send an email
        $message="Your account Request to withdraw ".$stmt['wth_amount_requested']." RWF to Account Holder <b>".$stmt['wth_withdrawer_name']."</b> Account Number <b>".$stmt['wth_withdrawer_number']."</b> Registered In ".$stmt['wthc_name']." Approved amount Withdrawn is <b>".$stmt['wth_amount_given']."</b><br> Today ".$date;
           //$response= sendEmail(array("from"=>'noreply@bfg.rw',"fromName"=>'IGISUBIZO System',"to"=>$userInfo['email'],"replyTo"=>'noreply',"subject"=>"Withdraw Request Approval","message"=>$message));
  
  $qryUser=$conn->prepare("SELECT balance FROM users WHERE uid=:uid");
$qryUser->execute(array("uid"=>$stmt['wth_withdrawer_id']));
$stmtUserInfo=$qryUser->fetchAll(PDO::FETCH_ASSOC);
//Assign diffrences of payhistory and withdraw to users
$paid=$stmtWth[0]['wth_amount_given'];
$remain=$stmtUserInfo[0]['balance']-$datas['given'];
//update user remain and paid amount from registrations
   $qy12=$conn->prepare("UPDATE users SET balance=:remain
                    WHERE uid=:uid");
    $qy12->execute(array("uid"=>$stmt['wth_withdrawer_id'],"remain"=>$remain)); 

      }elseif($stmt['wth_withdrawer_type']=='Postoffice'){
  
  $qryUser=$conn->prepare("SELECT balance FROM postoffices WHERE postoff_id=:postoffid");
$qryUser->execute(array("postoffid"=>$stmt['wth_withdrawer_id']));
$stmtUserInfo=$qryUser->fetchAll(PDO::FETCH_ASSOC);

//Assign diffrences of payhistory and withdraw to users
$paid=$stmtWth[0]['wth_amount_given'];
$remain=$stmtUserInfo[0]['balance']-$datas['given'];
//update user remain and paid amount from registrations
   $qy12=$conn->prepare("UPDATE postoffices SET balance=:remain
                    WHERE postoff_id=:postoffid");
    $qy12->execute(array("postoffid"=>$stmt['wth_withdrawer_id'],"remain"=>$remain)); 
      }


$feed="ok";//.json_encode($qy->errorInfo());
$qry1=$conn->prepare("SELECT * FROM withdraw_history WHERE wth_id=:wthid");
$qry1->execute(array("wthid"=>$wthid));
$stmt1=$qry1->fetchAll(PDO::FETCH_ASSOC);
}else {
  $feed="fail";
}
}else{
  $feed="notexist";
}
return $feed;
}
function addIssue($datas) { global $conn;
  $ownerid=safeInput($datas['ownerid']);
  $ownertype=safeInput($datas['ownertype']);
  $title=safeInput($datas['title']);
            $qy=$conn->prepare("INSERT INTO issues VALUES(:id,:ownerid,:ownertype,:title,:delstatus,:delreason,:regdate)");
            $qy->execute(array("id"=>'',"ownerid"=>$ownerid,"ownertype"=>$ownertype,"title"=>$title,"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
        if($qy){
$feed="ok";
}else {
$feed="fail";
}//end count rows
return $feed;
}
function getIssue($datas) { global $conn;
$issuesid=isset($datas['id'])?$datas['id']:null;
$data=null;
$additionalWhere="";

if($issuesid==null) {
  if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND issues.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
$qy=$conn->prepare("SELECT issues.* FROM issues  WHERE issues.delete_status=:delstatus".$additionalWhere);
$qy->execute(array("delstatus"=>0));
              }else {
                $qy=$conn->prepare("SELECT issues.* FROM issues WHERE issues.iss_id=:issuesid AND issues.delete_status=:delstatus");
                $qy->execute(array("issuesid"=>$issuesid,"delstatus"=>0));
              }
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("issues"=>$data));
}
function searchIssue($key) {global $conn;
$data=null;
$qy=$conn->prepare("SELECT issues.* FROM issues WHERE issues.iss_title LIKE :key issues.delete_status=:delstatus");
             $qy->execute(array("key"=>$key,"delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("issuess"=>$data));
}

function updateIssue($issuesid,$datas) { $data=null;
global $conn;
 $ownerid=safeInput($datas['ownerid']);
  $ownertype=safeInput($datas['ownertype']);
  $title=safeInput($datas['title']);

     //avoid duplication
     $qry=$conn->prepare("SELECT * FROM issues 
                       WHERE iss_id=:issueid AND delete_status=:delstatus");
$qry->execute(array("issueid"=>$issuesid,"delstatus"=>0));
$cnt=$qry->rowCount();
   if($cnt>0) {
 $qy=$conn->prepare("UPDATE issues SET iss_title=:title
      WHERE iss_id=:issueid");
 $qy->execute(array("issueid"=>$issuesid,"title"=>$title));
       if($qy->rowCount()==1) {
$feed="ok";
    }else {
  $feed="fail";
}
 }else{
        $feed="notexist";
}
return $feed;
}

function addIssueResponse($datas) { global $conn;
  $fromid=safeInput($datas['fromid']);
  $fromtype=safeInput($datas['fromtype']);
  $toid=safeInput($datas['toid']);
  $totype=safeInput($datas['totype']);
  $message=safeInput($datas['message']);
            $qy=$conn->prepare("INSERT INTO issues_chat VALUES(:id,:fromid,:fromtype,:message,:toid,:totype,:status,:delstatus,:delreason,:regdate)");
            $qy->execute(array("id"=>'',"fromid"=>$fromid,"fromtype"=>$fromtype,"toid"=>$toid,"totype"=>$totype,"status"=>'sent',"delstatus"=>0,"delreason"=>'',"regdate"=>date("Y-m-d H:i:s")));
        if($qy){
$feed="ok";
}else {
$feed="fail";
}//end count rows
return $feed;
}
function getIssueResponse($datas) { global $conn;
$issues_chatid=isset($datas['id'])?$datas['id']:null;
$data=null;
$additionalWhere="";

if($issues_chatid==null) {
  if(isset($datas['start']) && isset($datas['end'])){
  $datas['start'].=" 00:00:01";
  $datas['end'].=" 23:59:59";
  $additionalWhere=" AND issues_chat.regdate BETWEEN '".$datas['start']."' AND '".$datas['end']."'";
}
$qy=$conn->prepare("SELECT issues_chat.* FROM issues_chat  WHERE issues_chat.delete_status=:delstatus".$additionalWhere);
$qy->execute(array("delstatus"=>0));
              }else {
                $qy=$conn->prepare("SELECT issues_chat.* FROM issues_chat WHERE issues_chat.iss_id=:issues_chatid AND issues_chat.delete_status=:delstatus");
                $qy->execute(array("issues_chatid"=>$issues_chatid,"delstatus"=>0));
              }
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("issues_chat"=>$data));
}
function searchIssueResponse($key) {global $conn;
$data=null;
$qy=$conn->prepare("SELECT issues_chat.* FROM issues_chat WHERE issues_chat.isc_issueid LIKE :key issues_chat.delete_status=:delstatus ORDER BY issues_chat.regdate DESC LIMIT 30");
             $qy->execute(array("key"=>$key,"delstatus"=>0));
$count=$qy->rowCount();
$data=$qy->fetchAll(PDO::FETCH_ASSOC);
return json_encode(array("issues_chats"=>$data));
}

function updateIssueResponse($issues_chatid,$datas) { $data=null;
global $conn;
 $fromid=safeInput($datas['fromid']);
  $fromtype=safeInput($datas['fromtype']);
 $toid=safeInput($datas['toid']);
  $totype=safeInput($datas['totype']);
  $message=safeInput($datas['message']);

     //avoid duplication
     $qry=$conn->prepare("SELECT * FROM issues_chat 
                       WHERE isc_id=:issueid AND delete_status=:delstatus");
$qry->execute(array("issuecid"=>$issuecid,"delstatus"=>0));
$cnt=$qry->rowCount();
   if($cnt>0) {
 $qy=$conn->prepare("UPDATE issues_chat SET isc_message=:message
      WHERE iss_id=:issueid");
 $qy->execute(array("issuecid"=>$issuecid,"message"=>$message));
       if($qy->rowCount()==1) {
$feed="ok";
    }else {
  $feed="fail";
}
 }else{
        $feed="notexist";
}
return $feed;
}
function updateAdminInfo($datas) {global $conn;
	$feed=null;
	$qry=$conn->prepare("UPDATE users SET username=:uname,email=:email WHERE uid=:etrackuid");
	$qry->execute(array("uname"=>$datas["uname"],"email"=>$datas["email"],"etrackuid"=>decodeGetParams($_SESSION['etrackuid'])));
if($qry) {
	$feed="ok";
}else{
$feed="fail";}
	return $feed;}
	#===================USERS OPERATION==============
function getLostsByRange($cate,$range,$type,$status,$postoff) {//get Losts Report by Range of Date
	global $conn;
	$data=null;$prepWhere=null;$start=null;$end=null;
	
	$qy="SELECT postoffices.postoff_id,postoffices.name,representative.rep_name as representer,losts.lost_id,losts.owner,doctypes.doctype,losts.identifier,losts.status,losts.regdate 
					FROM postoffices,doctypes,losts,representative WHERE postoffices.postoff_id=losts.postoff_id AND losts.doctype_id=doctypes.doc_id AND losts.representative_id=representative.rep_id
					AND losts.delete_status=:delstatus";
					
$prepWhere="";
/*	switch($cate){
		case'day':
		$day=date("Y-m-d");$start=$day;$end=$day." 23:59:59";
		$prepWhere.=" AND losts.regdate>=:start AND losts.regdate<=:end'";
		break;
		case'week':
		$week=weekRange();$start=$week["start"];$end=$week["end"];
		$prepWhere.=" AND losts.regdate>=:start AND losts.regdate<=:end'";
		break;
		case'month':
		$month=monthRange();$start=$month["start"];$end=$month["end"];
		$prepWhere.=" AND losts.regdate>=:start AND losts.regdate<=:end'";
		break;
		case'custom':
		$start=$range["start"];$end=$range["end"];
		$prepWhere.=" AND losts.regdate>=:start AND losts.regdate<=:end'";
		break;
		default:;
	}
	*/
	if($type!='All Types'){
	$prepWhere.=" AND losts.doctype_id='$type'";
}
	if($postoff!='All Post Offices'){
	$prepWhere.=" AND losts.postoff_id='$postoff'";
}
	if($status!='Status') {
	$prepWhere.=" AND losts.status='".strtolower($status)."'";
}
if($range["start"]!=null && $range["end"]!=null) {
	$start=$range["start"];$end=$range["end"];
		$prepWhere.=" AND losts.regdate>='$start' AND losts.regdate<='$end'";
	}
$sel=$qy.$prepWhere;
$qry=$conn->prepare($sel);
$qry->execute(array("delstatus"=>0));
$count=$qry->rowCount();
$data=$qry->fetchAll(PDO::FETCH_ASSOC);
	//$sel."<br><br>".
return json_encode($data);
}
function delete($datas){global $conn;
	$feed=null;
$qr=$conn->prepare("UPDATE ".$datas["table"]." SET delete_status='1',delete_reason='".$datas["reason"]."' WHERE ".$datas["tablecol"]."='".$datas['id']."'");
$qr->execute();
//echo json_encode($qr->errorInfo());exit;
	if($qr->rowCount()==1){
		$feed="ok";
	}else{
		$feed="fail ".mysql_error();
	}
	return $feed;
}
function getProvinces($provid){global $conn;
	$data=null;
	if($provid==null){
	$qry=$conn->prepare("SELECT id as id,province_name as displayer FROM provinces");
	$qry->execute();
	}else{
		$qry=$conn->prepare("SELECT id as id,province_name as displayer FROM provinces WHERE id=:provid");
	$qry->execute(array("provid"=>$provid));
	}
	$data=$qry->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($data);
}
function getDistricts($distid){global $conn;
	$data=null;
	if($distid==null){
	$qry=$conn->prepare("SELECT id as id,district_name as displayer FROM districts");
	$qry->execute();
}else{
		$qry=$conn->prepare("SELECT id as id,district_name as displayer FROM districts WHERE id=:distid");
	$qry->execute(array("distid"=>$distid));
	}
	$data=$qry->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($data);
}
function getDistrictByProvince($provid){global $conn;
$qry=$conn->prepare("SELECT districts.id as id,district_name as displayer FROM districts INNER JOIN provinces ON districts.provinces_id=provinces.id
				WHERE provinces.id=:provid") or die("ERROR".mysql_error());
$qry->execute(array("provid"=>$provid));
			$data=$qry->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($data);
}
function getSectors($secid){global $conn;
	$data=null;
	if($secid==null){
	$qry=$conn->prepare("SELECT id as id,name as displayer FROM sector");
	$qry->execute();
	}else{
		$qry=$conn->prepare("SELECT id as id,name as displayer FROM sector WHERE id=:secid");
		$qry->execute(array("secid"=>$secid));
	}
	$data=$qry->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($data);
}
function getSectorsByDistrict($distid){
	$data=null;global $conn;
	$qry=$conn->prepare("SELECT sector.id as id,sector.name as displayer FROM sector JOIN districts 
			ON sector.district_id=districts.id WHERE districts.id=:distid");
	$qry->execute(array("distid"=>$distid));
	$data=$qry->fetchAll(PDO::FETCH_ASSOC);
	return json_encode($data);
}
function getSectorsByDistrictName($distname){global $conn;
$qry=$conn->prepare("SELECT sector.name as displayer FROM sector JOIN districts 
			ON sector.district_id=districts.id WHERE districts.district_name=:distname");
$qry->execute(array("distname"=>$distname));
	$data=$qry->fetchAll(PDO::FETCH_ASSOC);
	$fop=fopen("secbyname.hd","a");
	fwrite($fop,$distname."=>".date("Y-m-d H:i"));
	fclose($fop);
return json_encode($data);
}
function wholeGeoLocRwanda() {//return whole json data for rwanda Structure
$data=null;global $conn;
	$qry=$conn->prepare("SELECT provinces.province_name,districts.district_name,sector.name FROM provinces,districts,sector 
							WHERE provinces.id=districts.provinces_id AND districts.id=sector.district_id");
	$qry->execute();
	$data=$qry->fetchAll(PDO::FETCH_ASSOC);
	$fop=fopen("rwandastructure.hd", "w");
	fwrite($fop,json_encode($data));
	fclose($fop);
return json_encode($data);
}
function arrangeGeoLocRwanda($geoloc) {//arrange geoloc rwanda to their prefered ID
$data=null;global $conn;
	$qry=$conn->prepare("SELECT provinces.id as provid,districts.id as distid,sector.id as secid 
							FROM provinces,districts,sector 
							WHERE provinces.id=districts.provinces_id AND districts.id=sector.district_id 
							AND districts.district_name=:".$geoloc["district"]." AND sector.name=:".$geoloc["sector"]."");
	//echo $qry->rowCount();
$ft=$qry->fetchAll(PDO::FETCH_ASSOC);
return json_encode($ft);
}
#===================REPORT=======================
function reportFromStart(){global $conn;
$qrie=$conn->prepare("SELECT * FROM losts WHERE delete_status=:delstatus");
$qrie->execute(array("delstatus"=>0));
$tot=$qrie->rowCount();
$qry=$conn->prepare("SELECT * FROM losts,taken WHERE losts.status=:taken AND losts.lost_id=taken.losts_id AND losts.delete_status=:delstatus");
$qry->execute(array("taken"=>'taken',"delstatus"=>0));
$taken=$qry->rowCount();
$qy=$conn->prepare("SELECT * FROM losts WHERE status=:pending AND delete_status=:delstatus");
$qy->execute(array("pending"=>'pending',"delstatus"=>0));
$remain=$qy->rowCount();
if($tot==0){
$perctaken=0;$percremain=0;
}else{
$perctaken=floor(($taken*100)/$tot);
$percremain=ceil(($remain*100)/$tot);
}
return array(array($tot,$taken,$remain),array($perctaken+$percremain,$perctaken,$percremain));
}
function reportByTypeFromStart(){global $conn;
	$typeName=null;$typeCount=null;
$typeQy=$conn->prepare("SELECT doctypes.doctype,count(doctypes.doc_id) as number FROM doctypes JOIN losts ON losts.doctype_id=doctypes.doc_id 
								WHERE losts.delete_status=:delstatus GROUP BY doctypes.doc_id");
$typeQy->execute(array("delstatus"=>0));
$data=$typeQy->fetchAll(PDO::FETCH_ASSOC);
for($i=0;$i<count($data);$i++){
$typeName[]=$data[$i]["doctype"];
$typeCount[]=$data[$i]["number"];
}
	
return array("typeName"=>$typeName,"typeNum"=>$typeCount);
}
//get All Incomes and Balances for Partners
function getAllIncomesPartner(){global $conn;
  $qyComm=$conn->prepare("SELECT sum(balance) AS total_comm_balance FROM users WHERE delete_status=:delstatus");
  $qyComm->execute(array("delstatus"=>0));
  $stmtComm=$qyComm->fetchAll(PDO::FETCH_ASSOC)[0];

$qyPost=$conn->prepare("SELECT sum(balance) AS total_post_balance FROM postoffices WHERE delete_status=:delstatus");
  $qyPost->execute(array("delstatus"=>0));
  $stmtPost=$qyPost->fetchAll(PDO::FETCH_ASSOC)[0];

   $qyCommWth=$conn->prepare("SELECT sum(wth_amount_given) AS total_comm_withdrawn FROM withdraw_history WHERE wth_withdrawer_type=:wthtype AND wth_status=:status AND delete_status=:delstatus");
  $qyCommWth->execute(array("wthtype"=>'Commissioner',"status"=>'approved',"delstatus"=>0));
  $stmtCommWth=$qyCommWth->fetchAll(PDO::FETCH_ASSOC)[0];

$total_comm_income=$stmtComm['total_comm_balance']+$stmtCommWth['total_comm_withdrawn'];

$qyPostWth=$conn->prepare("SELECT sum(wth_amount_given) AS total_post_withdrawn FROM withdraw_history WHERE wth_withdrawer_type=:wthtype AND wth_status=:status AND delete_status=:delstatus");
  $qyPostWth->execute(array("wthtype"=>'Postoffice',"status"=>'approved',"delstatus"=>0));
  $stmtPostWth=$qyPostWth->fetchAll(PDO::FETCH_ASSOC)[0];
$total_post_income=$stmtPost['total_post_balance']+($stmtPostWth['total_post_withdrawn']==null?0:$stmtPostWth['total_post_withdrawn']);
  $qyAgaciroReg=$conn->prepare("SELECT sum(cit_agaciro) AS total_cit_agaciro FROM citizens");
  $qyAgaciroReg->execute();
$stmtAgaciroReg=$qyAgaciroReg->fetchAll(PDO::FETCH_ASSOC)[0];

  $qyAgaciroLost=$conn->prepare("SELECT sum(ratio_agaciro) AS total_losts_agaciro FROM losts WHERE status=:status");
  $qyAgaciroLost->execute(array("status"=>'taken'));
  $stmtAgaciroLost=$qyAgaciroLost->fetchAll(PDO::FETCH_ASSOC)[0];

  $qyAgaciroWth=$conn->prepare("SELECT sum(wth_amount_given) AS total_wth_agaciro FROM withdraw_history WHERE wth_withdrawer_type=:wthtype AND wth_status=:status");
  $qyAgaciroWth->execute(array("wthtype"=>'Agaciro Development Fund',"status"=>'approved'));
$stmtAgaciroWth=$qyAgaciroWth->fetchAll(PDO::FETCH_ASSOC)[0];

$total_agaciro_income=$stmtAgaciroReg['total_cit_agaciro']+$stmtAgaciroLost['total_losts_agaciro']+$stmtAgaciroWth['total_wth_agaciro'];
$total_agaciro_balance=$stmtAgaciroReg['total_cit_agaciro']+$stmtAgaciroLost['total_losts_agaciro'];

$data=array('postoffice'=>array("balance"=>$stmtPost['total_post_balance'],"income"=>$total_post_income),'commissioner'=>array("balance"=>$stmtComm['total_comm_balance'],"income"=>$total_comm_income),"agaciro"=>array("balance"=>$total_agaciro_balance,"income"=>$total_agaciro_income));
return json_encode(array("dashheader"=>$data));
}
function fillDashboard() {
	return json_encode(array("whole"=>reportFromStart(),"bytype"=>reportByTypeFromStart()));
}
#============PDF REPORTS================================
function getPaymentWithdrawReport($datas){
  $wthData=json_decode(getPaymentWithdraw($datas),TRUE)['withdraws'];
  $dashHeader="<table class='row' id='companyInfoHeader' style='width:100%'>
<tr>
<td style='width:60%'>
<img src='../webuse/logo.jpg' class='img img-circle' height='20%'>
</td>
<td class='pull-right'>
Name :<b>Be Forward Generation Ltd</b><br>
Email :<b>info@bfg.rw</b><br>
Phone :<b>(+250) 784634118</b><br>
Website :<b>www.bfg.rw</b><br>

  </td>
  </tr>
</table>";
$dashBody="<table class='table table-bordered' border='1' id='tblPaymentWithdraw' width='100%' cellspacing='0'>
              <caption><span style='font-size:16px;font-weight:bold'>Withdraws Done and their Approval</span><span id='wthReportHeader' class='pull-right' style='color: black;margin-right: 5%;'>&nbsp;&nbsp;&nbsp;&nbsp;From ".$datas['start']." To ".$datas['end']."</span></caption> <thead>
                <tr>
                  <th>#Count</th>
                  <th>Withdrawer Name</th>
                  <th>Type</th>
                  <th>Company</th>
                  <th>A/C Name</th>
                  <th>A/C Number</th>
                  <th>Requested</th>
                  <th>Given</th>
                   <th class='status'>Status</th>
                   <th>Registration Date</th>
                 </tr>
              </thead>";
              $dashBody.="<tbody id='loadedwthhistory'>";
              if(count($wthData)>0){
              for($i=0;$i<count($wthData);$i++){
                $dashBody.="<tr><td>".($i+1)."</td>
                  <td>".$wthData[$i]['withdrawer_names']."</td>
                  <td>".$wthData[$i]['wth_withdrawer_type']."</td>
                  <td>".$wthData[$i]['wth_company_name']."</td>
                  <td>".$wthData[$i]['wth_withdrawer_accname']."</td>
                  <td>".$wthData[$i]['wth_withdrawer_accnumber']."</td>
                  <td>".$wthData[$i]['wth_amount_requested']."</td>
                  <td>".$wthData[$i]['wth_amount_given']."</td>
                   <td class='status'>".$wthData[$i]['wth_status']."</td>
                   <td>".substr($wthData[$i]['regdate'],0,10)."</td>
                 </tr>";
              }
            }else{
              $dashBody.="<tr><th colspan='10'> No Withdraw Found</th></tr>";
            }
              $dashBody.="</tbody></table>";
            return array("filename"=>'../Reports/WithdrawReport_'.date('YmdHis'),"contents"=>$dashHeader.$dashBody);
}
function getPaymentHistoryReport($datas){
  $pmthData=json_decode(getPaymentHistory($datas),TRUE)['payhistory'];
  $dashHeader="<table class='row' id='companyInfoHeader' style='width:100%'>
<tr>
<td style='width:60%'>
<img src='../webuse/logo.jpg' class='img img-circle' height='20%'>
</td>
<td class='pull-right'>
Name :<b>Be Forward Generation Ltd</b><br>
Email :<b>info@bfg.rw</b><br>
Phone :<b>(+250) 784634118</b><br>
Website :<b>www.bfg.rw</b><br>

  </td>
  </tr>
</table>";
$dashBody="<table class='table table-bordered' border='1' id='tblPaymentWithdraw' width='100%' cellspacing='0'>
              <caption><span style='font-size:16px;font-weight:bold'>Payment History Done and their Approval</span><span id='wthReportHeader' class='pull-right' style='color: black;margin-right: 5%;'>&nbsp;&nbsp;&nbsp;&nbsp;From ".$datas['start']." To ".$datas['end']."</span></caption> <thead>
                <tr>
                   <th>#Count</th>
                  <th>Payer Name</th>
                  <th>Payer Type</th>
                  <th>Payment Mode</th>
                  <th>Account Name</th>
                  <th>Account Number</th>
                  <th>Sender Name</th>
                  <th>Sender Number</th>
                  <th>Amount</th>
                   <th class='status'>Status</th>
                   <th>Registration Date</th>
                 </tr>
              </thead>";
              $dashBody.="<tbody id='loadedwthhistory'>";
              if(count($pmthData)>0){
              for($i=0;$i<count($pmthData);$i++){
                $dashBody.="<tr><td>".($i+1)."</td>
                  <td>".$pmthData[$i]['payer_names']."</td>
                  <td>".$pmthData[$i]['pmth_payer_type']."</td>
                  <td>".$pmthData[$i]['pmtd_name']."</td>
                  <td>".$pmthData[$i]['pmtd_account_name']."</td>
                  <td>".$pmthData[$i]['pmtd_account_number']."</td>
                  <td>".$pmthData[$i]['pmth_sender_name']."</td>
                  <td>".$pmthData[$i]['pmth_sender_phone']."</td>
                   <td class='status'>".$pmthData[$i]['pmth_amount']."</td>
                   <td class='status'>".$pmthData[$i]['pmth_status']."</td>
                   <td>".substr($pmthData[$i]['regdate'],0,10)."</td>
                 </tr>";
              }
            }else{
              $dashBody.="<tr><th colspan='11'> No Payment History Found</th></tr>";
            }
              $dashBody.="</tbody></table>";
            return array("filename"=>'../Reports/PayhistReport_'.date('YmdHis'),"contents"=>$dashHeader.$dashBody);
}
function getCitizensReport($datas){
  $citData=json_decode(getCitizens($datas),TRUE)['citizens'];
  $dashHeader="<table class='row' id='companyInfoHeader' style='width:100%'>
<tr>
<td style='width:60%'>
<img src='../webuse/logo.jpg' class='img img-circle' height='20%'>
</td>
<td class='pull-right'>
Name :<b>Be Forward Generation Ltd</b><br>
Email :<b>info@bfg.rw</b><br>
Phone :<b>(+250) 784634118</b><br>
Website :<b>www.bfg.rw</b><br>

  </td>
  </tr>
</table>";
$dashBody="<table class='table table-bordered' border='1' id='tblPaymentWithdraw' width='100%' cellspacing='0'>
              <caption><span style='font-size:16px;font-weight:bold'>Citizens Registration Report</span><span id='wthReportHeader' class='pull-right' style='color: black;margin-right: 5%;'>&nbsp;&nbsp;&nbsp;<br>Registered By:<b>".$citData[0]['names']."</b>&nbsp;&nbsp;From <b>".$datas['start']."</b> To <b>".$datas['end']."</b></span></caption> <thead>
                <tr>
                   <th>#Count</th>
                  <th> Name</th>
                  <th>NID</th>
                  <th>Phone</th>
                   <th>Registration Date</th>
                 </tr>
              </thead>";
              $dashBody.="<tbody id='loadedwthhistory'>";
              if(count($citData)>0){
              for($i=0;$i<count($citData);$i++){
                $dashBody.="<tr><td>".($i+1)."</td>
                  <td>".$citData[$i]['cit_names']."</td>
                  <td>".$citData[$i]['cit_nid']."</td>
                  <td>".$citData[$i]['cit_phone']."</td>
                   <td>".substr($citData[$i]['regdate'],0,10)."</td>
                 </tr>";
              }
            }else{
              $dashBody.="<tr><th colspan='5'> No Citizens Found</th></tr>";
            }
              $dashBody.="</tbody></table>";
            return array("filename"=>'../Reports/CitizenReport_'.date('YmdHis'),"contents"=>$dashHeader.$dashBody);
}
function getLostsReport($datas){
  //$lostsData=json_decode(getLostsByRange($datas),TRUE);
  $lostsData=json_decode(getLostsByRange(null,array("start"=>$datas['start'],"end"=>$datas['end']),"All Types","Status",$datas['postoffid']),TRUE);
 // echo json_encode($lostsData);exit;
  $dashHeader="<table class='row' id='companyInfoHeader' style='width:100%'>
<tr>
<td style='width:60%'>
<img src='../webuse/logo.jpg' class='img img-circle' height='20%'>
</td>
<td class='pull-right'>
Name :<b>Be Forward Generation Ltd</b><br>
Email :<b>info@bfg.rw</b><br>
Phone :<b>(+250) 784634118</b><br>
Website :<b>www.bfg.rw</b><br>

  </td>
  </tr>
</table>";
$dashBody="<table class='table table-bordered' border='1' id='tblPaymentWithdraw' width='100%' cellspacing='0'>
              <caption><span style='font-size:16px;font-weight:bold'>Losts and Found Items Report</span><span id='wthReportHeader' class='pull-right' style='color: black;margin-right: 5%;'>&nbsp;&nbsp;Postoffice:<b>".$lostsData[0]['name']."</b>&nbsp;&nbsp;From ".$datas['start']." To ".$datas['end']."</span></caption> <thead>
                <tr>
                   <th>#Count</th>
                  <th>Owner Name</th>
                  <th>Item Type</th>
                  <th>Identification</th>
                  <th>Done By</th>
                   <th class='status'>Status</th>
                   <th>Registration Date</th>
                 </tr>
              </thead>";
              $dashBody.="<tbody id='loadedwthhistory'>";
              if(count($lostsData)>0){
              for($i=0;$i<count($lostsData);$i++){
                $dashBody.="<tr><td>".($i+1)."</td>
                  <td>".$lostsData[$i]['owner']."</td>
                  <td>".$lostsData[$i]['doctype']."</td>
                  <td>".$lostsData[$i]['identifier']."</td>
                  <td>".$lostsData[$i]['representer']."</td>
                  <td>".$lostsData[$i]['status']."</td>
                  <td>".substr($lostsData[$i]['regdate'],0,10)."</td>
                 </tr>";
              }
            }else{
              $dashBody.="<tr><th colspan='11'> No LostsReport Found</th></tr>";
            }
              $dashBody.="</tbody></table>";
            return array("filename"=>'../Reports/LostsReport_'.date('YmdHis'),"contents"=>$dashHeader.$dashBody);
}
#=====================ACTIVITES====================
function addActivity($datas){global $conn;
	$feed="fail";
$qr=$conn->prepare("INSERT INTO activities VALUES(:actid,:actname,:target,:fromdata,:todata,:regdate)");
$qr->execute(array("actid"=>'',"actname"=>$datas["actname"],"acttarget"=>$datas['target'],"fromdata"=>$datas['fromdata'],"todata"=>$datas['todata'],"regdate"=>date("Y-m-d H:i:s")));
if($qr) {
$feed="ok";
}else {
	$feed="fail";
}
return $feed;
}
function getActivities() {global $conn;
	$qy=$conn->prepare("SELECT * FROM activities");
	$qy->execute();
	$data=$qy->fetchAll(PDO::FETCH_ASSOC);
	return json_encode(array("activities"=>$data));
}
#===================OPTIONAL======================
function countIt($fld,$tbl,$whr) {global $conn;
$cnt=mysql_num_rows(mysql_query("SELECT ".$fld." FROM ".$tbl." WHERE ".$whr));
return $cnt;
}
function checkSessionCookie($category){
	function admin(){
		if(isset($_COOKIE['sid'])){
	echo"Admin Cookie exist<br>".$_COOKIE['sid']."<br>";
}else{
	echo"Admin Cookie doesn't exist<br>";
}
if(isset($_SESSION['maputosid'])){
	echo"Admin Session exist<br>".$_SESSION['maputosid']."<br>";
}else{
	echo"Admin Session doesn't exist<br>";
}
	}
	function company(){
		if(isset($_COOKIE['cid'])){
	echo"Company Cookie exist<br>".$_COOKIE['cid']."<br>";
}else{
	echo"Company Cookie doesn't exist<br>";
}
if(isset($_SESSION['maputocid'])){
	echo"Company Session exist<br>".$_SESSION['maputocid']."<br>";
}else{
	echo"Company Session doesn't exist<br>";
}
	}	
	switch($category){
		case'admin':admin();break;
		case'company':company();break;
		default:echo"Session && Cookie category doesn't exist";
	}
}
function compareDate($a,$b) {
	if($a>$b) {
		$a=strtotime($a);$b=strtotime($b);
		echo $a."  A is greater than  B  ".$b."<br>";
	}elseif($a<$b) {
		echo $a." A is lesser than B ".$b."<br>";
	}else {
		echo"Dates Equals"."<br>";
	}
}
function safeInput($str){
return stripslashes($str);
}
function encodeGetParams($getpars){
	$chars=null;$ngetpars=null;
	echo is_array($getpars);
	if(strlen($getpars)>0) {
for($i=strlen($getpars)-1;$i>=0;$i--){//reverse text string
	$ngetpars.=substr($getpars,$i,1);
}
}else {
	$ngetpars=$getpars;
}
for($i=0;$i<strlen($ngetpars);$i++) {//encrypt reversed string
	if($i % 2==0) {
		$chars.=base64_encode("%").base64_encode(substr($ngetpars,$i,1));
}
elseif($i % 2==1) {
$chars.=base64_encode("%").base64_encode(base64_encode(substr($ngetpars,$i,1)));
}
}
return base64_encode($chars);
}
function decodeGetParams($getpars){
$chars=null;$txt=null;
$getp=explode(base64_encode("%"), base64_decode($getpars));

//decrypt reversed text string
for($i=0;$i<count($getp);$i++){
	if($i % 2==1) {
 $chars.=base64_decode($getp[$i]);
}

elseif($i % 2==0) {
$chars.=base64_decode(base64_decode($getp[$i]));
}
}
//reorder text string
for($i=strlen($chars)-1;$i>=0;$i--){
	$txt.=substr($chars,$i,1);
}
return $txt;
}
function encryptPwd($getpars){
	$chars=null;$ngetpars=null;
for($i=strlen($getpars)-1;$i>=0;$i--){//reverse text string
	$ngetpars.=substr($getpars,$i,1);
}
for($i=0;$i<strlen($ngetpars);$i++) {//encrypt reversed string
	if($i % 2==0) {
		$chars.=base64_encode("%").sha1(substr($ngetpars,$i,1));
}

elseif($i % 2==1) {
$chars.=base64_encode("%").md5(base64_encode(substr($ngetpars,$i,1)));
}
}

return md5($chars);
}

function fixURLAttack($getParameters){//check possible value for the data
$prepIfData=null;
for($i=0;$i<count($getParameters);$i++){
	if($i==0) {
		$prepIfData=$getParameters[$i];
		}else {
			$prepIfData=" || ".$getParameters[$i];
}
}
if(!($prepIfData)) {
	header("location:".$_SERVER['HTTP_REFERER']);
}
}

function sessionManager(){
  global $spurl;
	$arr=explode("/",$_SERVER['REQUEST_URI']);
if(!isset($_SESSION['etrackuid'])){
	if($arr[count($arr)-1]!='login') {
	header("location:includes/logout");
}
}
}
function appendZero($num) {
       if($num<10) {
       $num=intval("0".$num);
       }
       return;
    }
function weekRange(){
	$date=date("Y-m-d");
	$day=date("D");
	$days=array("Mon"=>1,"Tue"=>2,"Wed"=>3,"Thu"=>4,"Fri"=>5,"Sat"=>6,"Sun"=>7);
	$addDaysEndWeek=7-$days[$day];
	$startWeek=$days[$day]-1;
	$startWeekDate=(strtotime($date)-(60*60*24*$startWeek));
	$endWeekDate=(strtotime($date)+(60*60*24*$addDaysEndWeek));
//$daydiff=floor((strtotime($deadline)-strtotime($frm))/(60*60*24));
	return array("start"=>date("Y-m-d",$startWeekDate),"end"=>date("Y-m-d",$endWeekDate)); 
}
function monthRange(){
	$dt=date("Y-m");
	return array("start"=>date("Y-m-d",strtotime($dt."-01")),"end"=>date("Y-m-d",strtotime($dt."-31")));
}
?>