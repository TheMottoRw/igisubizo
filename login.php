<?php
include"php/main.php";

if(isset($_POST['con'])){
	login();
	}//end post isset
?>

<html>
<head> 
<title>Connect account</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport"content="width=device-width,intial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css"media="all">
	<link rel="shortcut icon" href="webuse/ETracklogo.png">
	<style>
		body{font-family: lucida fax;}
		#footer{height:25px;width:99%;background-color:;color:#4682B4;text-align: center;font-family: georgia;font-weight: bold;
       letter-spacing: 2px;font-size: 14px;border:1px solid #4489b4;padding-top:3px;padding-bottom:3px;border-radius:3%;}

		fieldset{height:200px;width:500px;border:2px solid black;border-radius:5px;}
		.logincont{width:700px;border:2px solid #4682B4;margin-top:120px;border-radius: 10px;background-color:white;}
		#logo{margin-top:-85px;}
		#login{margin-top: ;padding-top:;}
	/*	.connacc{font-size:20px;font-weight: bold;}
		input[type=text],input[type=password]{height:30px;width:200px;border:1px solid black;border-radius:4px;
		                            font-size: 16px;font-family: lucida fax;text-align: center;}
		input[type=submit]{height: 30px;width:120px;margin-left:100px;margin-top: 10px;padding-right:3%;font-size:15px ;font-weight: bold;
		                    border:2px solid black;border-radius:4px;background-color:lavender;font-family: lucida fax}
*/
		</style></head>
<body style="background-image:url('webuse/bg.jpg');background-repeat:no-repeat;background-size:100% 100%;  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;"><center><form action=""method="POST" role="form"><div id="label">
<div class=""id="wrapper"style="">
<div class="logincont">
<!--rgb(45,130,160)-->
<p style="background:linear-gradient(#328CC6,white);color:white;font-weight:bold;padding-right:1%;padding-left:1%;padding-top:5%;padding-bottom:5%;font-size:20px;margin-top:1px;width:99.5%;">IGISUBIZO System</p>

<div id="login">
	<div class="row">
					<br><div class="form-group">
                           <div class="col-lg-1 col-md-1 col-sm-12"></div>
						   <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"> <label>Name</label></div>
                           <div class="col-lg-7 col-md-7 col-sm-8 col-xs-8">  <input type="text" name="uname" required class="form-control">
                          </div>
						  <div class="col-lg-2"></div>
						  </div>
						    <br> <br><div class="form-group">
							<div class="col-lg-1 col-md-7 col-sm-12"></div>
                            <div class="col-lg-2 col-md-2 col-sm-4   col-xs-4"> <label>Password</label></div>
                           <div class="col-lg-7 col-md-7 col-sm-8 col-xs-8">  <input type="password" name="pass" id="uname" required class="form-control">
                          </div>
						  <div class="col-lg-2"></div>
						  </div>	
						<div class="form-group">
                            <br> <br><button type="submit" name="con" id="login" class="btn btn-primary" value=""><span class="glyphicon glyphicon-log-in"></span> Connect</button>
                           </div>
						   </div>
	  <?php include"includes/footer.php";?>
	  <br>
</div></div></div>
		</form>
</body>
</html>