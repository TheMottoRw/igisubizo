<?php
include"includes/header.php";
?>
<style wthcompany="text/css">
  .wthcompany{background-color:orange;}
</style>
<button class="btn btn-primary pull-right" style="margin-right:3%;margin-top:0%;margin-bottom:-5%" id="btnPrintWithdrawCompany"type="button"><span class="glyphicon glyphicon-print"></span>Print</button>
<button id="btnAddWithdraw Company" data-toggle="modal" data-target="#addWithdrawCompanyModal" class="btn btn-primary pull-right" style="margin-right:10%;margin-bottom:-1.5%"><span class="glyphicon glyphicon-plus" ></span> New Withdraw Company</button><br>

       	    <div id="addWithdrawCompanyModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Register New Withdraw Company</h4>
          </div>
          <div class="modal-body" >
            <p id="regWithdrawCompanyResponse">  </p>
          <div class="form-group"> 
		  <label>Company Name:</label>
			<input wthcompany="text" id="wthcName" class="form-control">
      <label>Name Accronym:</label>
      <input wthcompany="text" id="wthcAccr" class="form-control">
			</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnSaveWithdrawCompany">
              <span class="glyphicon glyphicon-ok"></span>Save</button><button wthcompany="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Create Modal-->
       	   
   <div id="updateWithdrawCompanyModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Withdraw Company </h4>
          </div>
          <div class="modal-body">
		  <p id="updateWithdrawCompanyResponse"></p>
		  <input type="hidden" id="wthcompanyid">
         <div class="form-group"> 
		  <label>Company Name:</label>
			<input wthcompany="text" id="updWthcName" class="form-control">
      <label>Name Accronym:</label>
      <input wthcompany="text" id="updWthcAccr" class="form-control">
			</div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnUpdWithdrawCompany" class="btn btn-success">
            <span class="glyphicon glyphicon-ok"></span> Update</button><button wthcompany="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Update Created Modal-->
	
		      <div class="row" id="wthcompanyviewform" style="padding-left:2%;padding-right: 2%">
        <span style="color:green"></span>
        <div class="table-responsive">
        <table class="table table-bordered" id="tblWithdrawCompany">
          <caption>Registered Withdraw Company</caption>
          <thead>
            <tr>
            <th># Count  </th>
              <th>Company Name  </th>
              <th>Accronym</th>
              <th>  Registration Date</th>
              <th class="loadedwthcompanymodif" style="text-align:center">  Modifications</th>
            </tr>
          </thead>
          <tbody id="loadedwthcompany">
          
          </tbody>
        </table>
      </div>
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
            <button type="button" id="btnDelWithdrawCompany" class="btn btn-danger" >
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