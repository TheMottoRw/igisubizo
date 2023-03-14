<?php
include"includes/header.php";
?>
<style type="text/css">
</style>
  <div id="resetPasswordModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form ng-submit="" >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="postname"></h4>
          </div>
          <div class="modal-body" >
            <p style="font-size:13px;"id="resetPwdResponse"></p>
            <input type="hidden" id="resetidreset"> <input type="hidden" id="postoffidreset">
            <span id="doesnotmatchreset" class="col-lg-12" style="text-align:center"></span><br>
<span class="col-lg-4">New Password</span><div class="col-lg-8"><input type="password" name="nwresetpassword" class="form-control" id="nwresetpassword"><br></div>
<span class="col-lg-4">Confirm Password</span><div class="col-lg-8"><input type="password" name="confresetpassword" class="form-control" id="confresetpassword"></div>
</div>
       <br><br><br><br><br> <div class="modal-footer">
            <button type="button" class="btn btn-success" id="resetPwd">
              Reset</button><button type="button" class="btn btn-default" data-dismiss="modal">
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->
  
  
		      <div class="row" id="packviewform" style="margin-top:-3%;">
        <span style="color:green"></span><br/>
        <center>
        <div class="table-responsive">
        <table class="table table-bordered" style="width:95%;" id="tblSupport">
          <caption>Postoffice Requested Reset</caption>
          <thead>
            <tr>
              <th>#Counts</th>
              <th>Post Name  </th>
              <th>Post Phone </th>
					<th>Post Reason  </th>
              <th> Date</th>
              <th>  Modifications</th>
            </tr>
          </thead>
          <tbody id="loadedreqreset">
          
          </tbody>
        </table>
        </div>
        </center>
      </div><!--end invoiceviewform-->
<!--End Optional-->
	    <div id='delModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" id="delModalTitle">Do you want to delete</h4>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delResponse">  </p>
            <input type="hidden" id="deleteid">  
			<label>Delete reason </label>
            <textarea class="form-control" id="delReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelType" class="btn btn-danger" >
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal">
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->

  </nav>						
<?php
include"includes/footer.php";
?>
</div>
</body>
</html>