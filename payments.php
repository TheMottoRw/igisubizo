<?php
include"includes/header.php";
?>
<style type="text/css">
  .payments{background-color:orange;}
</style>
<button class="btn btn-primary pull-right" style="margin-right:3%;margin-top:0%;margin-bottom:-7%" id="btnPrintPayment" type="button"><span class="glyphicon glyphicon-print"></span>Print</button>
<!--button id="btnAddPayment" data-toggle="modal" data-target="#addPaymentModal" class="btn btn-primary pull-right" style="margin-right:10%;margin-bottom:-2%"><span class="glyphicon glyphicon-plus" ></span> New Payment</button-->
       	    <div id="addPaymentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <button  type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Register New Payment</h4>
          </div>
          <div class="modal-body" >
            <p id="regPaymentResponse">  </p>
          <div class="form-group"> 
		  <label>Payment:</label>
			<input  type="text" id="pay" class="form-control">
			</div>
          </div>
          <div class="modal-footer">
            <button  type="button" class="btn btn-success" id="btnSavePayment">
              <span class="glyphicon glyphicon-ok"></span>Save Payment</button><button  type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Create Modal-->
       	   
   <div id="updatePaymentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button  type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Payment </h4>
          </div>
          <div class="modal-body">
		  <p id="updatePaymentResponse"></p>
		  <input  type="hidden" id="payid">
         <div class="form-group"> 
		  <label> Name:</label>
			<input  type="text" id="updPaymentName" class="form-control" readonly="readonly"> 
      <label> Type:</label>
      <input  type="text" id="updPaymentType" class="form-control" readonly="readonly"> 
      <label> Amount:</label>
      <input  type="text" id="updPaymentAmount" class="form-control">
			</div>
          </div>
          <div class="modal-footer">
            <button  type="button" id="btnUpdPayment" class="btn btn-success">
            <span class="glyphicon glyphicon-ok"></span>  Update</button><button  type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Update Created Modal-->
		
		      <div class="row" id="payviewform" style="padding-left:2%;padding-right: 2%;">
        <span style="color:green"></span><br/>
        <div class="table-responsive">
        <table class="table table-bordered" id="tblPayments">
          <caption>Registered Payment</caption>
          <thead>
            <tr>
            <th># Count  </th>
              <th> Name  </th>
              <th> Type  </th>
              <th> Amount  </th>
              <th>  Registration Date</th>
              <th class="loadedapproval" style="text-align:center">  Modifications</th>
            </tr>
          </thead>
          <tbody id="loadedpayments">
          
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
            <button  type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" id="delModalTitle">Do you want to delete</h4>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delResponse">  </p>
            <input  type="hidden" id="deleteid">  
			<label>Delete reason </label>
            <textarea class="form-control" id="delReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button  type="button" id="btnDelPayment" class="btn btn-danger" >
              Delete</button><button  type="button" class="btn btn-default" data-dismiss="modal">
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