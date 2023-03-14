<?php
#=>THE Motto<=Software Developperz
#Author:Manzi Neretse Roger<=PROGRAMMING IS MY PASSION
#ABOUT THE AUTHOR
#=================
#Contact:+(250)726183049
#E-mail:mnzroger@gmail.com
#==FOLLOW ME ON=====
#Facebook:Manzi Roger Asua
#Twitter:@rogerneretse

#lets enjoy Programming with THE Motto
#Follow me up and Don't give up to ask for help from =>author 
#================================================================

#SERVER INFORMATION
#---------------------
class server{
function connection($pwd,$db){
mysql_connect("localhost","root",$pwd) or die("ERROR:".mysql_error());
mysql_select_db($db) or die("ERROR:failed to connect db-->".mysql_errno()."=>".mysql_error());
 date_default_timezone_set("UTC");
}
public function getRunningFile(){//GET allready running FIle
return $_SERVER['PHP_SELF'];
}
public function getName() {
return $_SERVER['SERVER_NAME'];
}
public function getSoftware() {
return $_SERVER['SERVER_SOFTWARE'];
}
public function getProtocol() {
return $_SERVER['SERVER_PROTOCOL'];
}
public function getRequestMethod() {
return $_SERVER['REQUEST_METHOD'];
}
public function getQuery() {
return $_SERVER['QUERY_STRING'];
}
public function getRoot() {
return $_SERVER['DOCUMENT_ROOT'];
}
public function getHttpAccept() {//get header from current Request
return $_SERVER['HTTP_ACCEPT'];
}
public function getHttpCharset() {//get Charset ISO...
return $_SERVER['HTTP_ACCEPT_CHARSET'];
}
public function getEncoding() {
return $_SERVER['HTTP_ACCEPT_ENCODING'];	
}
public function getLanguage() {//get language for current Req
return $_SERVER['HTTP_ACCEPT_LANGUAGE'];	
}
public function getConnectionStatus() {
return $_SERVER['HTTP_CONNECTION'];	
}
public function getHost() {
return $_SERVER['HTTP_HOST'];	
}
public function getPrevUrl() {
return $_SERVER['HTTP_REFERER'];	
}
public function getUserAgent() {
return $_SERVER['HTTP_USER_AGENT'];	
}
public function getPort() {
return $_SERVER['SERVER_PORT'];	
}
public function getURL() {
return $_SERVER['REQUEST_URI'];	
}
public function getAuthUser() {//get authenticated user
return $_SERVER['PHP_AUTH_USER'];	
}
public function getAuthPwd() {//get Authenticated PWD
return $_SERVER['PHP_AUTH_PW'];	
}
public function getAuthType() {//Get Authentication Type
return $_SERVER['PHP_AUTH_TYPE'];	
}

}
$server=new server;
#========END SERVER INFOS CLASS====================
#CLIENT INFORMATION
#---------------------
class client{
function getIP(){
return $_SERVER['REMOTE_ADDR'];
}
public function getRequestType(){
	return $_SERVER['HTTP_X_REQUESTED_WITH'];
}
public function getComPort() {//get Port User use to communicate to server
return $_SERVER['REMOTE_PORT'];
}
public function getAuthClUser() {//get Authenticated User
return $_SERVER['REMOTE_USER'];
}
public function getPath(){
return $_SERVER['SCRIPT_FILENAME'];
}
public function getOS() { 
$user_agent=$_SERVER['HTTP_USER_AGENT'];

    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

public function getBrowser() {
$user_agent=$_SERVER['HTTP_USER_AGENT'];;
    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}
}
$client=new client;
//echo $client->getOS()."-".$client->getBrowser()."-".$client->getIP();
#========END CLIENT INFOS CLASS====================
#========RUNNIG MYSQL FUNCTIONS===================
class mysql{
	public $conn;
	private function connection($datas){
try{
     //$connection= new PDO("mysql:host=localhost;dbname=muhire6_wo832","muhire6","Echo@@AlphaBravo");
$connection= new PDO("mysql:host=".$datas['host'].";dbname=".$datas['database'],$datas["user"],$datas['password']);
}catch(PDOException $ex){
	echo"Could not connect to Database";
}
return $connection;
	}
private function delete($datas){
	$feed=null;
$qr=mysql_query("UPDATE ".$datas["table"]." SET delete_status='1',delete_reason='".$datas["reason"]."' WHERE ".$datas["tablecol"]."='".$datas['id']."'");
	if($qr){
		$feed="ok";
	}else{
		$feed="fail ".mysql_error();
	}
	return $feed;
}
}
#=============================ENCRYPTER CLASS=========================
class encrypter{
function md($str) {
return md5($str);
}
function base($str) {
return base64_encode($str);
}
function sha($str) {
return sha1($str);
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
}//end class encrypt
$encrypt=new encrypter;
#=============================encrypters CLASS=========================
#=============================DECRYPTER CLASS=========================
class decrypter{
function base($str) {
return base64_decode($str);
}
}//end class encrypt
$decrypt=new decrypter;
#=============================DECRYPTER CLASS=========================
#=============================OZEKI MESSAGING======================================
class ozeki{
public $response;
function httpsend($recepient,$message){
$recepient=$_POST['recepient'];
	$message=$_POST['message'];
$url='http://localhost:9333/ozeki?'; 
$url.="action=sendMessage";
$url.="&login=admin";
$url.="&password=abc123"; 
$url.="&recepient=".$recepient;
$url.="&messageData=".$message; 
file($url);
return"message sent successfull";
}
}
$ozeki=new ozeki;
#=============================FOLDERS OR DIRECTORIES MANIPULATION CLASS===========
class folders{
public function create($dirname) {
	if($dirname!="") {
mkdir($dirname);
return"Diretory created with name".$dirname;
}else {
	return"Directory name must not be empty";
}
}
public function opendirectory($dirname) {
	if($dirname!="") {
opendir($dirname);
return"Diretory opened with name".$dirname;
}else {
	return"Directory name must not be empty";
}
}//end open dir

public function deldir($dirname) {
	if($dirname!="") {
rmdir($dirname);
return"Diretory deleted with name ".$dirname;
}else {
	return"Directory name must not be empty";
}
}//end del func
}//end class
$dir=new folders;
#=============================END FOLDERS MANIPULATION CLASS=======================
#=============================FILES MANIPULATION CLASS=============================
class files{
	function create($dir,$fl){
		if($dir!=""){
		if(!file_exists($dir."/".$fl)) {
$fop=fopen($dir."/".$fl,"w");
fwrite($fop,"");
$feed="File $fl created";
}else {
	$feed="Sorry the file allready exist";
}
}else{//else to check if dir is empty
		if(!file_exists($fl)) {
$fop=fopen($fl,"w");
$feed="File $fl created";
}else {//else to check if file exist
	$feed="Sorry the file allready exist";
}
}//end else to check if dir is empty
return $feed;
}//end function create
	function write($fl,$data){
$fop=fopen($fl,"w");
fwrite($fop,$data);
$feed=" data added to a file";
return $feed;
}//end function create
	function append($fl,$data){
$fop=fopen($fl,"a");
fwrite($fop,$data."#del# ");
$feed=" data appended to a file";
return $feed;
}//end function create
	function getcontent($fl,$delimiter,$encryption){
if(file_exists($fl)){
	if($encryption==true) {
		$data=base64_decode((file_get_contents($fl)));
	}else {
		$fop=fopen($fl,"r");
$data=fgets($fop);
	}

if($delimiter!=false) {
$feed=explode($delimiter,$data);
}else {
	$feed=$fl;
}
}	
return $feed;
}//end get content method	
function cleardata($dir,$fl){
	for($i=0;$i<count($fl);$i++){
		if($dir!="") {
		if(file_exists($dir."/".$fl[$i])) {
$fop=fopen($dir."/".$fl[$i],"w");
fwrite($fop,"");
$feed="File ".$fl[$i]." its data cleared success<br>";	
}else {
	$feed="File ".$fl[$i]." doesn't exist";
}
}else {//else to check if dir is empty
if(file_exists($fl[$i])) {//check if file allready exist to clear its data
	$fop=fopen($fl[$i],"w");
fwrite($fop,"");
$feed="File ".$fl[$i]." its data cleared success<br>";	
}else {
	$feed="File ".$fl[$i]." doesn't exist";
}
}//end else to check  if dir empty
}//end for loop
return $feed;
}//end function
function delfile($dir,$fl){
	for($i=0;$i<count($fl);$i++){
			if($dir!="") {
		if(file_exists($dir."/".$fl[$i])) {
unlink($dir."/".$fl[$i]);
$feed="The  file ".$fl[$i]." deleted success<br>";
}else {
	$feed="File ".$fl[$i]." Doesn't exist";
	}
}else {//else to check if dir is empty
			if(file_exists($fl[$i])) {
unlink($fl[$i]);
$feed="The  file ".$fl[$i]." deleted success<br>";
}else {
	$feed="File ".$fl[$i]." Doesn't exist";
	}
}//end else of checking if dir is empty
}//end for loop
return $feed;
}//end function delfile

function upload($targetdir,$filearray){
                              //  check  uploaded  file  size
                if  ($filearray['size']  ==  0)  {
                $feed="ERROR:  Zero  byte  file  upload";
                }else {
                //  check  if  this  is  a  valid  upload
                if(move_uploaded_file($filearray['tmp_name'],  $targetdir."/".$filearray['name'])){
return $feed=1;                
                }else {
                	return $feed=0;}
                
                }//end else to check the file size
}//end function upload

function download($dir,$name,$type) {
	header('Content-Description: File Transfer');
    header('Content-Type: '.$type);
    if($dir!="") {
    header('Content-Disposition: attachment; filename='.basename($dir."/".$name));
 }else {
 	header('Content-Disposition: attachment; filename='.basename($name));
 }
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($name));
    ob_clean();
    flush();
    readfile($name);
    exit;
 }//end Download method
 public function captcha(){
 //Send a generated image to the browser
 
//Let's generate a totally random string using md5 
$md5 = md5(rand(0,999)); 
//We don't need a 32 character long string so we trim it down to 5
$pass =substr($md5, 10, 5);
//Set the image width and height
$width = 200; $height = 100; 
//Create the image resource 
$image = ImageCreate($width, $height);
//We are making three colors, white, black and gray 
$white = ImageColorAllocate($image, 255, 255, 255);
$black = ImageColorAllocate($image, 0, 0, 0); 
$grey = ImageColorAllocate($image, 204, 204, 204);
        //Make the background black
ImageFill($image, 0, 0, $white);
//Add randomly generated string in white to the image
ImageString($image, 50, 80, 40, $pass, $black); //imagestr
//Throw in some lines to make it a little bit harder for any bots to break
ImageRectangle($image,0,0,$width-1,$height-1,$grey);//imagere
imageline($image, 0, $height/3, $width, $height/5, $grey);
imageline($image, 0, $height/2, $width, $height/3, $grey);
imageline($image, 0, $width/3, $height, $width/3, $grey);
imageline($image, $width/5, 0, $width/2, $height, $grey); 
imageline($image, $height,$height/2,0,$width/3, $grey);
imageline($image, $width,$height/2,0,$height/3, $grey);
imageline($image, $height/4,(2*$width)/3,$height,$width/4, $grey);
imageline($image, $width/4,(14*$width)/3,$height,$height/4, $grey);
imageline($image, $width,$height,$height/2,$width/3, $grey);
imageline($image, (4*$width)/4,$height,$width/3,$height/4, $grey);
//Tell the browser what kind of file is come in
header("Content-Type: image/jpeg"); 
//Output the newly created image in jpeg format
$feed=ImageJpeg($image);
 //Free up resources
  ImageDestroy($image); 
return $feed;
 }//end method captcha
 
}//end class files
$file=new files;
#=============================END FILES MANIPULATION CLASS=========================
#=======DATE FUNCTIONS===============
class date{
	private function weekRange(){
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
private function monthRange(){
	$dt=date("Y-m");
	return array("start"=>date("Y-m-d",strtotime($dt."-01")),"end"=>date("Y-m-d",strtotime($dt."-31")));
}
private function compareDate($a,$b){
	if($a>$b) {
		$a=strtotime($a);$b=strtotime($b);
		$feed="first greater";
	}elseif($a<$b) {
	$feed="first lesser";
	}else {
		$feed="equals";
	}
}
}
#=============================VALIDATE CLASS=================================
class validate{
function text($format,$str){
if($format=='lower') {
	return $this->lower($str);
}elseif($format=='upper') {
	return $this->caps($str);
}elseif($format=='number') {
	return $this->num($str);
}elseif($format=='mixed') {
	return $this->mixed($str);
}else{
	return"invalid format ".$format;
	}
}//end text method

public function phone($ctr,$num){
if($ctr=='rwandan') {
	return $this->rwandan($num);
}elseif($ctr=='international') {
	return $this->international($num);
}
}//end phone method

public function rwandanID($num){
	if(preg_match("/^1 [0-9]{4} [7,8]{1} [0-9]{7} [0-9]{1} [0-9]{2}/",$num)) {
		$feed=1;
}else {
$feed=0;
}
return $feed;
}
public function email($str){
///^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/i
if(preg_match("/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/i",$str)){
	$feed=1;
}else {
$feed=0;
}//end else for preg
return $feed;
}//end email method

private function sessionManager($allowed,$redirect){
	$arr=explode("/",$_SERVER['REQUEST_URI']);
if(!isset($_SESSION[$allowed])){
	header("location:".$redirect);
//echo "<script>console.log('No Session Exist')</script>";
}else{
//echo "<script>console.log('Session Exist')</script>";
}
}

#=============================PRIVATE FUNCTION TO EXECUTE FORMAT=========================
private function lower($str){
if(preg_match("/^[a-z]+$/i",$str)) {
	$feed=1;
}else {
$feed=0;
}//end else for preg
return $feed;
}//end method lower
private function caps($str){
if(preg_match("/^[A-Z]+$/i",$str)) {
	$feed=1;
}else {
$feed=0;
}//end else for preg
return $feed;
}//end caps method
private function num($str){
if(preg_match("/^[0-9]+$/i",$str)) {
	$feed=1;
}else {
$feed=0;
}//end else for preg
return $feed;
}//end num mehod
private function mixed($str){
if(preg_match("/^[a-zA-Z0-9]+$/i",$str)) {
	$feed=1;
}else {
$feed=0;
}//end else for preg
return $feed;
}//end mixed metohd
private function rwandan($num){
if(is_numeric($num)){
	if(strlen($num)==12){
		$feed=$this->rwandan12($num);
	}elseif(strlen($num)==10) {
		$feed=$this->rwandan10($num);
	}else {
		$feed="Rwandan phone number must be 10 or 12 digits";
		}
}//end is numeric
else {
$feed="Phone number must be always integer";	
}
return $feed;
}//end rwandan method
private function rwandan12($num){
if(preg_match("/^2507[2,3,8][0-9]{7}/",$num)){
		$feed=1;
		}else {
			$feed=0;}
		return $feed;

}//end rwandan12 method
private function rwandan10($num){
if(preg_match("/^07[2,3,8][0-9]{7}/",$num)){
		$feed=1;
		}else {
			$feed=0;}
		return $feed;
}//end rwandan10 method	
private function international($num){
if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}+$/i",$num)){
		$feed=1;
}else {
	$feed=0;
}
return $feed;
}//end method international
}//end class validate
$validate=new validate;
#=============================END VALIDATE CLASS=========================
#=============================JSON CLASS=================================
class json{
function push_json($jsonfile,$readformat,$data){//write the new json code into a file of json
$encoded_data=json_encode($data);
$json_file=fopen($jsonfile,$readformat);
fwrite($json_file,$encoded_data);
fclose($json_file);
}

function pull_json($data){//decode json code into a file of json
return $decoded_data=json_decode($data,TRUE);
}
}//end class
$json=new json;
#=============================END JSON CLASS=========================

class paginate{
	public $returned=array(array());public $reference_page;public $fields;public $nextpg;public $previous;public $getparam;
	public $st;public $lim;public $subnum;public $subpg;public $pg;public $looping_subpage=array();
	
function pagination($type,$reference_page,$fields,$table,$data,$feedbackgetparams,$limit,$loop_subpage){ 
$this->reference_page=$reference_page;
$this->subnum=$loop_subpage;//to hold number of looping subpage

if($type=='Hybrid'){
if(!isset($_GET['subpg'])) {
	$this->subpg=1;
	$this->pg=1;
	}else{$this->subpg=$_GET['subpg'];
	      $this->pg=$_GET['pg'];}
	   }elseif($type=='Plain') {
	   	if(!isset($_GET['subpg'])) {
	$this->subpg=1;
	}else{$this->subpg=$_GET['subpg'];
	     }
	   }//END TYPE CHECKING FOR INITIALIZATION
$this->lim=$limit;
$st=($this->subpg*$this->lim)-$this->lim;

$sls="SELECT $fields FROM $table WHERE $data LIMIT $st,$this->lim";
$qrie=mysql_query($sls);
$cont=mysql_num_rows($qrie);
if($cont>0){
	$this->fields=explode(',', $fields);
	while($fetch=mysql_fetch_array($qrie)) {
		for($i=0;$i<count($this->fields); $i++){
	$this->returned[$this->fields[$i]][]=$fetch[$this->fields[$i]];//$this->arr['cdtname'][]=$fetch['cdt_name'];$this->arr['sex'][]=$fetch['sex'];
}//end fetch

$this->getparam=$feedbackgetparams;//initialize parameter to be passed on get output
}//end cont check
if($type=='Hybrid') {
$this->hybrid($table,$data);
}elseif($type=='Plain'){
$this->plain($table,$data);	
}//end if for type verification
}else {echo"no data to retrieve";}
return $this->returned;
}//end get func
private function plain($table,$data) {

	$sls="SELECT * FROM $table WHERE $data";
$qrie=mysql_query($sls);
$cont=mysql_num_rows($qrie);
$pagernumber=ceil($cont/$this->lim);//get total subpages
	if($this->subpg>1){
		$this->previous="<span class='previous'><a href='".$this->reference_page."?".$this->getparam."&subpg=".($this->subpg-1)."'>Prev</a></span>";
}

	if($this->subpg<$pagernumber){
		$this->nextpg="<span class='next'><a href='".$this->reference_page."?".$this->getparam."&subpg=".($this->subpg+1)."'>Next</a></span><br>";
}else{
echo"<br>";}
}//end plain method


private function hybrid($table,$data) {

	$sls="SELECT * FROM $table WHERE $data";
$qrie=mysql_query($sls);
$cont=mysql_num_rows($qrie);
$pagernumber=ceil($cont/$this->lim);//get total subpages
$subpgmax=$this->pg*$this->subnum;
$subpgmin=($this->pg*$this->subnum)-($this->subnum-1);
	if($this->pg>1){
		$this->previous="<a href='".$this->reference_page."?".$this->getparam."&pg=".($this->pg-1)."&subpg=".((($this->pg*$this->subnum)-1)-($this->subnum-1))."'>Prev</a>";
}

for($a=$subpgmin;$a<=$subpgmax;$a++) {
if($a<=$pagernumber){
$this->looping_subpage[]="<a href='".$this->reference_page."?".$this->getparam."&pg=".$this->pg."&subpg=".$a."'>$a</a>";
}else {break;}
}

	if(($this->pg*$this->subnum)<$pagernumber){
		$this->nextpg="<a href='".$this->reference_page."?".$this->getparam."&pg=".($this->pg+1)."&subpg=".((($this->pg+1)*$this->subnum)-($this->subnum-1))."'>Next</a><br>";
}else{
echo"<br>";}
}//end hybrid method

}//end class
$paginate=new paginate;
#=============================OSA PAGINATION=======================================
class osa{
public function paginationalvl($reference_page,$fields,$tables,$data,$feedgetparams,$limit,$subnum) {
global $nextpg;global $previous;global $looping_subpage;
if(!isset($_GET['subpg'])) {
	$subpg=1;
	$pg=1;
	}else{$subpg=$_GET['subpg'];
	      $pg=$_GET['pg'];}
$st=($subpg*$limit)-$limit;

//PAGINATIING
	$sls="SELECT $fields FROM $tables WHERE $data";
$qrie=mysql_query($sls);
$cont=mysql_num_rows($qrie);
$pagernumber=ceil($cont/$limit);//get total subpages
$subpgmax=$pg*$subnum;
$subpgmin=($pg*$subnum)-($subnum-1);
	if($pg>1){
		$previous="<a href='".$reference_page."?".$feedgetparams."&pg=".($pg-1)."&subpg=".((($pg*$subnum)-1)-($subnum-1))."'>Prev</a>";
}

for($a=$subpgmin;$a<=$subpgmax;$a++) {
if($a<=$pagernumber){
$looping_subpage[]="<a href='".$reference_page."?".$feedgetparams."&pg=".$pg."&subpg=".$a."'>$a</a>";
}else {break;}
}

	if(($pg*$subnum)<$pagernumber){
		$nextpg="<a href='".$reference_page."?".$feedgetparams."&pg=".($pg+1)."&subpg=".((($pg+1)*$subnum)-($subnum-1))."'>Next</a><br>";
}else{
echo"<br>";}

$sel="SELECT $fields FROM $tables WHERE $data LIMIT $st,$limit";
$qry=mysql_query($sel);
$row=mysql_num_rows($qry);
while($fe=mysql_fetch_assoc($qry)){
	echo"<tr>";
	echo"<th>".$fe['cdt_name']."</th><th>".$fe['sex']."</th><th>".$fe['father']."</th><th>".$fe['mother']."</th><th>".$fe['district']."</th><th>".$fe['sector']."</th><th>".$fe['aggregates']."</th><th>".$fe['current_skl']."</th><th>".$fe['ac_year']."</th><th>".$fe['fst_comb'].",".$fe['scnd_comb']."</th><th>ALLBUT</th>";
	echo"</tr>";
}
echo"</table>";

#===================showing pagination==============================
$this->paging($previous,$looping_subpage,$nextpg);
	}//==============END METHOD PAGINATION ALVL
	
	public function paginationolvl($reference_page,$fields,$tables,$data,$feedgetparams,$limit,$subnum) {
global $nextpg;global $previous;global $looping_subpage;
if(!isset($_GET['subpg'])) {
	$subpg=1;
	$pg=1;
	}else{$subpg=$_GET['subpg'];
	      $pg=$_GET['pg'];}
$st=($subpg*$limit)-$limit;

//PAGINATIING
	$sls="SELECT $fields FROM $tables WHERE $data";
$qrie=mysql_query($sls);
$cont=mysql_num_rows($qrie);
$pagernumber=ceil($cont/$limit);//get total subpages
$subpgmax=$pg*$subnum;
$subpgmin=($pg*$subnum)-($subnum-1);
	if($pg>1){
		$previous="<a href='".$reference_page."?".$feedgetparams."&pg=".($pg-1)."&subpg=".((($pg*$subnum)-1)-($subnum-1))."'>Prev</a>";
}

for($a=$subpgmin;$a<=$subpgmax;$a++) {
if($a<=$pagernumber){
$looping_subpage[]="<a href='".$reference_page."?".$feedgetparams."&pg=".$pg."&subpg=".$a."'>$a</a>";
}else {break;}
}

	if(($pg*$subnum)<$pagernumber){
		$nextpg="<a href='".$reference_page."?".$feedgetparams."&pg=".($pg+1)."&subpg=".((($pg+1)*$subnum)-($subnum-1))."'>Next</a><br>";
}else{
echo"<br>";}

$sel="SELECT $fields FROM $tables WHERE $data LIMIT $st,$limit";
$qry=mysql_query($sel);
$row=mysql_num_rows($qry);
while($fe=mysql_fetch_assoc($qry)){
	echo"<tr>";
	echo"<th>".$fe['cdt_name']."</th><th>".$fe['sex']."</th><th>".$fe['father']."</th><th>".$fe['mother']."</th><th>".$fe['district']."</th><th>".$fe['sector']."</th><th>".$fe['aggregates']."</th><th>".$fe['current_skl']."</th><th>".$fe['ac_year']."</th><th>ALLBUT</th>";
	echo"</tr>";
}
echo"</table>";

#===================showing pagination==============================
$this->paging($previous,$looping_subpage,$nextpg);
	}//==============END METHOD PAGINATION OLVL
	
	#===================PAGINATIING OR PAGINATER==============================
	private function paging($prev,$loopg,$nxt) {
		echo"<center>";
echo $prev."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
foreach($loopg as $loopit){
echo $loopit."&nbsp;&nbsp;&nbsp;";
}
echo $nxt."<br>";
echo"</center>";	
}//======END PAGING METHOD
}//=========END CLASS
$osa=new osa;
?>
