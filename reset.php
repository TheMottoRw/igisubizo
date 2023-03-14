<?php
include"php/main.php";
?>

<html>
<head> 
<title>Reset account</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport"content="width=device-width,intial-scale=1">
   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css"media="all">
	<link rel="shortcut icon" href="webuse/ETracklogo.png">
	<style>
		body{font-family: lucida fax}
		#footer{height:25px;width:99%;background-color:;color:#4682B4;text-align: center;font-family: georgia;font-weight: bold;
       letter-spacing: 2px;font-size: 14px;border:1px solid #4489b4;padding-top:3px;padding-bottom:3px;border-radius:3%;}

		fieldset{height:200px;width:500px;border:2px solid black;border-radius:5px;}
		.logincont{width:700px;border:2px solid #4682B4;margin-top:50px;border-radius: 10px;}
		#logo{margin-top:-85px;}
		#login{margin-top: ;padding-top:;}
	/*	.connacc{font-size:20px;font-weight: bold;}
		input[type=text],input[type=password]{height:30px;width:200px;border:1px solid black;border-radius:4px;
		                            font-size: 16px;font-family: lucida fax;text-align: center;}
		input[type=submit]{height: 30px;width:120px;margin-left:100px;margin-top: 10px;padding-right:3%;font-size:15px ;font-weight: bold;
		                    border:2px solid black;border-radius:4px;background-color:lavender;font-family: lucida fax}
*/
		</style></head>
<body><center><form action=""method="POST" role="form"><div id="label">
<div class=""id="wrapper"style="">
<div class="logincont">
<!--rgb(45,130,160)-->
<p style="background:linear-gradient(#328CC6,white);color:white;font-weight:bold;padding-right:1%;padding-left:1%;padding-top:5%;padding-bottom:5%;font-size:20px;margin-top:1px;width:99.5%;">IGISUBIZO System</p>

<div id="login">
					<div class="row">
					<div class="alert alert-success" style="width:80%;margin-top:-2%;height:8%;">
			<h4 style="color:green;">Request Post Office Reset Password</h4></div>
					<br>
					<p id="requestResetResponse"></p>
					<div class="form-group">
					<input type="hidden" id="postoffid">
                           <div class="col-lg-1"></div>
						   <div class="col-lg-2"> <label>Phone</label></div>
                           <div class="col-lg-7">  <input type="text" id="postPhone" required class="form-control">
                          </div>
						  <div class="col-lg-2"></div>
						  <br><br><span class="" style="color:#0006ff;font-size:13px;">Please fill the phone your Post office allready use to Reset</span>
						  </div>
						  <div class="form-group">
                           <div class="col-lg-1"></div>
						   <div class="col-lg-2"> <label>Reason</label></div>
                     <div class="col-lg-7"> 
                           <textarea id="reason" class="form-control" style="resize:none" pattern="[a-zA-Z0-9 ]" rows=3 cols=45></textarea>
                            </div>
						  <div class="col-lg-2"></div>
						  <br><br> </div>
						<div class="form-group">
						<br><br><button type="button" name="reqReset" id="reqReset" class="btn btn-primary" value=""><span class="glyphicon glyphicon-log-in"></span> Request</button>
                           </div>
						   </div>
	  <?php include"includes/footer.php";?>
	  <br>
</div></div></div>
		</form>
		 <script src="bootstrap/js/jquery.js"></script>
    <script src="js/jqdepend.js"></script>
    <script src="js/main.js"></script>
    <script type="text/javascript">
		document.getElementById("postoffid").value=document.URL.split("?")[1].split("=")[1];
	
</script>
</body>
</html>