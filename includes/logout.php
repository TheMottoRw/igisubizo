<?php
session_start();
session_destroy();
if(isset($_COOKIE['etrackuid'])) {
setcookie('sid',null,-3600,'/');
}
header("location:../");
?>