<?php
include"includes/header.php";
?>
  <!-- Custom fonts for this template-->
  <link href="BSHelper/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="BSHelper/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="BSHelper/css/sb-admin.css" rel="stylesheet">
<style type="text/css">
  .postoffice{background-color:orange;}
</style>
<button class="btn btn-primary pull-right" style="margin-right:3%;margin-top:-1%;margin-bottom:-3%" id="btnPrintPost"type="button"><span class="glyphicon glyphicon-print"></span>Print</button>

<button data-toggle="modal" data-target="#modalNewPostOffice" class="btn btn-primary pull-right" style="margin-right:10%;margin-bottom:-1.5%;margin-top:-1%;" id="addNewPostOfficeMod"><span class="glyphicon glyphicon-plus"></span>Add PostOffice</button>
      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalNewPostOffice" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content" style="padding-left: 20px;padding-right:20px;padding-bottom: 20px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Post Office Registration form</h4>
                    </div>
                      <div class="row">
                    <div id="regPostOfficeResponse"></div>
					<form name="regNewPostOfficeform" action="" method="post">
                   <div class="modal-body">
							<div class="col-md-6">
						<div class="form-group">
                            <p>Name</p>
                            <input type="text" name="postName" id="postName" required class="form-control" pattern="[a-zA-Z0-9 ]">
                           </div>
                           <div class="form-group">
                            <select id="representativeName" class="form-control">
								<option>Representative</option>
								</select></div>
						   <div class="form-group">
                            <p>Phone</p>
                            <input type="text" id="postPhone"  required class="form-control" pattern="[a-zA-Z0-9 ]">
                           </div>
                           <div class="form-group">
                                <p>Password</p>
                                <input type="password" id="postPassword" class="form-control" pattern="[a-zA-Z0-9 ]" required>
                            </div>
							  <div class="form-group">
                                <p>Province</p>
                                <select id="province" class="form-control">
								<option>Province</option>
								</select>
                            </div>
							<div class="form-group">
                                <p>District</p>
                                <select id="district" class="form-control">
								<option>District</option>
								</select>
                            </div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
                                <p>Sector</p>
                            <select id="sector" class="form-control">
								<option>Sector</option>
								</select>
								</div>
						   <div class="form-group">
                                <p>Cell</p>
                            <input type="text" id="postCell"  required class="form-control" pattern="[a-zA-Z0-9 ]">
                           </div>
							<div class="form-group">
                                <p>Address</p>
                                <textarea id="place" class="form-control" style="resize:none"pattern="[a-zA-Z0-9 ]" rows=9 cols=45></textarea>
                            </div>
						</div>
						 </div> </div>
                        	<div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span>Cancel</button>
                            <button class="btn btn-success" id="btnSavePostOffice" type="submit"><span class="glyphicon glyphicon-ok"></span>Register</button>
                       
						</div>

                    </div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div><!--end PostOffice Dialog-->
        
		<div aria-hidden='true' aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modalUpdatePostOffice" class="modal fade">
            <div class='modal-dialog'>
                <div class="modal-content" style="padding: 20px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Update Post Office</h4>
                    </div>
                    <div class="row">
                     <div id="updPostOfficeResponse"></div>
					<form name="productupdForm" action="" method="post" novalidate>
                    <div class="modal-body">
			<input type="hidden" id="postid">
<div class="col-md-6">			
					      <div class="form-group">
                            <p>Name</p>
                            <input type="text" name="updpostName" id="updpostName" required class="form-control" pattern="[a-zA-Z0-9 ]">
                           </div>
                           
						   <div class="form-group">
                            <p>Phone</p>
                            <input type="text" id="updpostPhone"  required class="form-control" pattern="[a-zA-Z0-9 ]">
                           </div>
							  <div class="form-group">
                                <p>Province</p>
                                <select id="updprovince" class="form-control">
								<option>Province</option>
								</select>
                            </div>
							<div class="form-group">
                                <p>District</p>
                                <select id="upddistrict" class="form-control">
								<option>District</option>
								</select>
                            </div>
							<div class="form-group">
                                <p>Sector</p>
                              <select id="updsector" class="form-control">
								<option>Sector</option>
								</select>
								</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
                            <p>Representative</p>
                             <select id="updrepresentativeName" class="form-control">
								<option>Representative</option>
								</select>
								</div>
						   <div class="form-group">
                                <p>Cell</p>
                            <input type="text" id="updpostCell"  required class="form-control" pattern="[a-zA-Z0-9 ]">
                           </div>
							<div class="form-group">
                                <p>Address</p>
                                <textarea id="updaddress" class="form-control" style="resize:none" pattern="[a-zA-Z0-9 ]" rows=9 cols=45></textarea>
                            </div>
							</div>
							</div>
							<div class="modal-footer">
                           <button data-dismiss="modal" class="btn btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span>Cancel</button>
                            <button class="btn btn-success" id="btnUpdPostOffice" type="button"><span class="glyphicon glyphicon-ok"></span>Update</button>
                     </div>
					 </form>
                    </div>
					</div>
                    </div>
        </div><!--end PostOffice Dialog-->

       
		      <div class="row" id="postofficeviewform" style="padding-left:2%;padding-right:2%;">
        <span style="color:green"></span><br>
        <div class="table-responsive">
        <table class="table table-bordered" id="tblPostoffices">
          <caption>Registered Post Offices</caption>
          <thead>

            <tr>
            <th>#Counts</th>
              <th>Names  </th>
                <th>Representative</th>
			  <th>Phone</th>
              <th>Province </th>
			  <th>District </th>
			  <th>Sector </th>
			  <th>Cell </th>
              <th> Date</th>
        <th>More Info </th>
              <th class='loadedpostmodif' style="text-align:center">Actions</th>
            </tr>
          </thead>
          <tbody id="loadedPostOffice">
		  
          </tbody>
        </table>
        </div>
      </div><!--end employeeviewform-->
 <div aria-hidden="true" aria-labelledby="modalViewPostOffice" role="dialog" tabindex="-1" id="modalViewPostOffice" class="modal fade">
            <div class="modal-dialog" style="width:80%;">
                <div class="modal-content" style="padding-left: 20px;padding-right:20px;padding-bottom: 20px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Post Office View Losts</h4>
                    </div>
                      <div class="row">
				       <div class="modal-body">
                <div class="table-responsive">
		<table class="table table-bordered" id="tblByPostoffices">
          <caption>Post Name:&nbsp;<span id="postnametitl"></span></caption>
          <thead>
            <tr>
              <th>Owner  </th>
              <th>Type </th>
               <th>Identifier </th>
               <th>Amount</th>
                   <th>Date</th>
            </tr>
          </thead>
          <tbody id="loadedlostsbypostoffice">
          
          </tbody>
        </table>
      </div>
						 </div>
                   <div class="modal-footer">
                   <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                   </div>
						</div>
                    </div>
                    </form>
                    </div>
                </div>  
  

	  <div id='delModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" id="delModalTitle">Do you want to delete <span id="deltit"></span></h4>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delResponse">  </p>
            <input type="hidden" id="deletepostid">  
			<label>Delete reason </label>
            <textarea class="form-control" id="delPostReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelPostOffice" class="btn btn-danger" >
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal">
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->

</div><!--end container-->
	</nav>	
<?php
include"includes/footer.php";
?>
</div>
</body>
 <!-- Bootstrap core JavaScript-->
    <script src="BSHelper/vendor/jquery/jquery.min.js"></script>
    <script src="BSHelper/vendor/popper/popper.min.js"></script>
    <script src="BSHelper/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="BSHelper/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="BSHelper/vendor/datatables/jquery.dataTables.js"></script>
    <script src="BSHelper/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for this page-->
    <script src="BSHelper/js/make-datatables.js"></script>
</html>