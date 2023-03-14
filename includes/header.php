<?php
include"php/main.php";
sessionManager();
?>
<html>
<head>
<title>IGISUBIZO System</title>
<meta name="viewport"content="width=device-width, initial-scale=1.0">
<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="js/jslive.js"></script>
<script src="js/jqdepend.js"></script>
<script src="js/main.js"></script>
<link rel="stylesheet"href="bootstrap/css/bootstrap.min.css"type="text/css">
<link rel="stylesheet"href="css/style.css"type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="css/dashDesigner.css"/>
  <!-- Custom fonts for this template-->
  <link href="BSHelper/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="webuse/ETracklogo.png">
<style type="text/css">
body{font-family: lucida fax;background-color:;overflow-x:hidden;overflow-y:auto}
nav{font-family: arial;background-color:whitesmoke;position:fixed;}
#mnavbar{background-color:	rgb(40,110,195);font-family: lucida fax;width:100%;}
#navbartarg{padding-right:5%;}z
 h5{font-size:18px;color:black;font-weight:bold;text-align:;}
h2{color:green;}
#foot-bar{background-color:rgb(180,220,200);color:darkmagenta;}
#foot-bar h5{color:blue;margin-left:5%}
#foot-bar ul li{list-style: disc;}

/*-----------MAPUTO SCRATCH----------*/
#footer{height:25px;width:100%;background-color:white;color:#4489b4;text-align: center;font-family: georgia;font-weight: bold;
       letter-spacing: 2px;font-size: 14px;border:1px solid #4489b4;padding-top:3px;padding-bottom:3px;}
#modfrm:hover{background-color:blue;color:black;font-weight:bold}
/*bgcolorheader:rgb(100,180,160) #mnavbarbgColor:rgb(100,180,130)*/

</style>
 
<style>
</style>
</head>
<body ng-app="etrackApp" style="background-color:white">
  <input type="hidden" name="sessid" id="sessid" value="<?php echo $_SESSION['etrackuid'];?>">
<div class="fluid" style="width: 100%;left: 0;right: 0">
<!-- <div style="background-color:rgb(40,110,195);padding-right:8%;"> -->
	<nav class="navbar navbar-inverse" role="navigation" id="mnavbar" style="background-color:rgb(40,110,195);">
	<div class="navbar-header">
	<a href=""class="navbar-brand"><div id="site-names"style="color:white;font-weight:bold;">
	<img src="webuse/ETracklogo.png" height="50px" width="35px" class="img img-circle" style="margin-top:-5.5%">
	&nbsp;
  <span>IGISUBIZO <span class="hidde-sm hidden-xs">SYSTEM</span>
  <span class="hidden-lg hidden-md hidde-sm">APP</span></span>
</div></a>
<button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target="#navbartarg">
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
  </button>
</div><!--end navbar header-->
	<div class="collapse navbar-collapse navbar-right" id="navbartarg" >
		<ul class="nav navbar-nav">
        <li><a href="dashboard"style="color:white"id="modfrm" class="home"><span class="glyphicon glyphicon-home"></span> Dashboard</a></li>
		
        <?php if($_SESSION['usercate']==1){?>
            <li><a href="users"style="color:white"id="modfrm" class="users"><span class="fa fa-users"></span> Users</a></li>
    <li><a href="categories"style="color:white"id="modfrm" class="categories"><span class="glyphicon glyphicon-th-list"></span> Categories</a></li>
    <li><a href="postoffice"style="color:white"id="modfrm" class="postoffice"><span class="glyphicon glyphicon-globe"></span> Post Offices</a></li>
		<li><a href="citizens"style="color:white"id="modfrm" class="queues"><span class="glyphicon glyphicon-th-list"></span> Citizens</a></li>
		<li><a href="types"style="color:white"id="modfrm" class="types"><span class="glyphicon glyphicon-star"></span> Types</a></li>
    <!--li><a href="payments" style="color:white"id="modfrm" class="payments"><span class="fa fa-bitcoin"></span> Payment</a></li-->
    <li class="dropdown"><a href="#payments" style="color:white" id="modfrm" class="dropdown-toggle payments" data-toggle="dropdown"><i class="fa fa-credit-card"></i> <span>Payments <i class="fa fa-caret-down"></i></span></a>
     <ul class="dropdown-menu">
                <li class="dropdown-header">Payments Info</li>
                <li class="divider"></li>
                <li><a href="modes" class="fa fa-bitcoin">&nbsp;Modes</a></li>
                <li><a href="payments" class="fa fa-cubes">&nbsp;Structure</a></li>
            <li><a href="payhist" class="fa fa-copy">&nbsp;History</a></li>
             <li><a href="ratios" class="fa fa-tasks">&nbsp;Ratios</a></li>
             <li><a href="withdraw" class="fa fa-dollar">&nbsp;Withdraw</a></li>
              </ul>
    </li>
<?php } ?>
		<!--li><a href="report"style="color:white"id="modfrm"  class="report"><span class="glyphicon glyphicon-print"></span>Reports</a></li-->
<li class="dropdown"><a href="report" style="color:white"id="modfrm" data-toggle="dropdown"  class="report"><span class="glyphicon glyphicon-print"></span>Reports<i class="fa fa-caret-down"></i></a>
     <ul class="dropdown-menu">
                <li class="dropdown-header">Reports Info</li>
                <li class="divider"></li>
                <li><a href="report?cate=citizens" class="fa fa-users">&nbsp;Citizens</a></li>
                <li><a href="report?cate=items" class="fa fa-file">&nbsp;Items</a></li>
            <li><a href="report?cate=losts" class="fa fa-folder">&nbsp;Losts</a></li>
           <?php if($_SESSION['usercate']==1){?>
                <li class="dropdown-header">Payments Info</li>
                <li><a href="report?cate=payhist" class="fa fa-euro">&nbsp;Payment History</a></li>
            <li><a href="report?cate=withdraw" class="fa fa-dollar">&nbsp;Withdraw</a></li>
            <!--li><a href="report?cate=balance" class="fa fa-bitcoin">&nbsp;Balance</a></li-->
        <?php } ?>
                </ul>
    </li>

	 <li class="dropdown-setting"><a href="#" class=" btn btn-info dropdown-toggle" data-toggle="dropdown"   style="color:white"><span class="glyphicon glyphicon-cog"></span> Setting</a>
	  <ul class="dropdown-menu dropdown-menu-left"role="menu">
                <li><a href="#" class="glyphicon glyphicon-user" data-toggle="modal" data-target="#userProfile" id="adprof"> Profile</a>
             <?php if($_SESSION['usercate']==1){?>    <li><a href="representatives" class="fa fa-users" class="representer">  Representatives</a>
                     <li><a href="wthcompany" class="fa fa-building" class="wthcompany">  Withdraw Company</a>
                <li><a href="support" class="glyphicon glyphicon-indent-right"> Reset</a>
                <li><a href="issues" class="glyphicon glyphicon-indent-left"> Support</a>
                <?php } ?>
                <li><a href="#"class="glyphicon glyphicon-lock" data-toggle="modal" data-target="#changePasswordModal"> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="includes/logout"class="glyphicon glyphicon-log-out"> Logout</a></li>
            </ul>	 
	 
	 </li>
</ul>
	</div><!--end of collapse navbar-->
		    <div id="changePasswordModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form ng-submit="" >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Change Password</h4>
          </div>
          <div class="modal-body" >
            <p style="font-size:13px;"id="changePwdResponse"></p>
            <span class="col-lg-4">Old Password</span><div class="col-lg-8"><input type="password" class="form-control" id="oldpassword" ><br></div>
<span id="doesnotmatch" class="col-lg-12" style="text-align:center"></span><br>
<span class="col-lg-4">New Password</span><div class="col-lg-8"><input type="password" name="nwpassword" class="form-control" id="nwpassword"><br></div>
<span class="col-lg-4">Confirm Password</span><div class="col-lg-8"><input type="password" name="confpassword" class="form-control" id="confpassword"></div>
</div>
       <br><br><br><br><br><br><br>   <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="changePwd">
             <span class="glyphicon glyphicon-ok"></span> Save</button><button type="button" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->
	   <div id="userProfile" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <!-- Modal content-->
         <div class="modal-content" style="width: 100%;">
             <div class="modal-header">
                 <h5 class="modal-title">Profile Informations</h5>
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body">
                 <p style="font-size:13px;" id="profileInfoResponse"></p>
                 <div class="row">
                     <div class="col-lg-4 col-md-6 col-sm-12">
  <span id="profPic"><img src="webuse/female.jpg" id="profile" style="width: 80%;border-radius: 50%"><br/><br/>
  <!--button type="button" id="changeProfPic" class="btn btn-info">
  <i class="fa fa-camera"></i>Change</button--></span>
                         <form role="form" class="form-inline" action="" method="POST" enctype="multipart/form-data">
                             <div class="form-group" id="updProfPicForm" style="display: none;">
                                 <input type="file" name="profilePhoto" id="profilePhoto" class="form-control" style="display: none;">
                                 <button class="btn btn-default btn-sm" id="attach"  type="button"><i class="fa fa-file-image-o" style="height: 50%;width: 50%"></i></button>
                                 <button class="btn btn-success btn-sm" type="submit" name="updatePhoto"><i class="fa fa-check"></i>Update</button>
                             </div>
                         </form>
                     </div>

                     <div class="col-lg-8 col-md-6 col-sm-12">

                         <h4>Profile Informations</h4>
                         <table border="0" style="font-size: 16px; font-family: Arial;">
                             <tr>
                                 <td>Username:</td><td id="profUname"></td>
                             </tr>
                             <tr>
                                 <td>Email:</td><td id="profEmail"></td>
                             </tr>
                             <tr>
                                 <td>Phone:</td><td id="profPhone"></td>
                             </tr>
                             <tr>
                                 <td>Category:</td><td id="profCategory"></td>
                             </tr>
                             <tr>
                                 <td>Address:</td><td id="profAddress"></td>
                             </tr>
                         </table>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-danger" data-dismiss="modal">
                     <span class="glyphicon glyphicon-remove"></span>Close</button>
             </div>
         </div>

     </div>
     <?php
     if (isset($_POST['updatePhoto'])) {
         updateProfilePhoto();
     }
     ?>
 </div><!--end User Profile-->

  
  <!--</div> currency conversion Modal-->
	</div>
      <div class="notifierContainer" class="">
<a href="issues" class="btn btn-danger hidden-sm hidden-xs"><i class='fa fa-eye'></i><span id='cntIssue' style="font-size: 16px;font-weight: bold;"></span> Pending Issues to Solve</a>
</div>
