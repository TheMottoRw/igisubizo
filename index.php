<?php
session_start();
if(isset($_SESSION['etrackuid'])) {
header("location:dashboard");
}else {
header("location:login");
}
?>