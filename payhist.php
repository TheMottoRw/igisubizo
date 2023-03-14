<?php
include"includes/header.php";
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb" id="breadcrumb">
        <li class="breadcrumb-item">
          <a href="bohome.php">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Payment History</li>
      </ol>
       <div class="card mb-3" id="paymentinfo">
        <div class="card-header" style="padding-right: 3%;">
          <i class="fa fa-table"></i> List of Payment Done and Approval
         </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="tblPaymentHistory" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#Count</th>
                  <th>Payer Name</th>
                  <th>Payer Type</th>
                  <th>Payment Mode</th>
                  <th>Account Name</th>
                  <th>Account Number</th>
                  <th>Sender Name</th>
                  <th>Sender Number</th>
                  <th>Amount</th>
                   <th class='status'>Status</th>
                   <th>Registration Date</th>
                   <th class='approval'>Approval</th>
                 </tr>
              </thead>
              <tbody id="loadedpayhistory">
              </tbody>
            </table>
          </div>
        </div>
      </div>
         <!--Forms-->
      <div id="paymentmodforms">
<div class="panel card-register mx-auto mt-5" id="regpaymentform" style="display: none;margin-top: -1%;width:80%;margin-left: 10%">
      <div class="panel-header">
       <span style="margin-left: 5%">Payment Registration</span></div>
      <div class="panel-body">
        <form>
        <p id="regPaymentResponse" style="font-size: 14px;"></p>
        <div class="row">

              <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
            <div class="form-group">
              <div class="form-group">
                <label for="paymode">Payment Mode</label>
               <select id="paymode" class="form-control"></select>
               
                <div id="cardinfo">
                  <div class="form-group">
                    <label for="cardholder">Card Holder</label>
                    <input type="text" name="cardholder" id="cardholder" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="cardnbr">Card Number</label>
                    <input type="text" name="cardnbr" id="cardnbr" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="expdate">Expiration Date</label>
                    <input type="text" name="expdate" id="expdate" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="ccv">CCV</label>
                    <input type="text" name="ccv" id="ccv" class="form-control">
                  </div>
                </div>

                <div class="slips" id="slips">
                 <div class="form-group">
                    <label for="txnid">Transaction ID</label>
                    <input type="text" name="txnid" id="txnid" class="form-control">
                  </div>
                </div>
                <div class="momoinfo" id="momoinfo">
              <div class="form-group">
                    <label for="sendername">Sender Name(Sender Mobile Money Account Name)</label>
                    <input type="text" name="sendername" id="sendername" class="form-control" placeholder="Manzi Roger">
                  </div>
              <div class="form-group">
                    <label for="senderphone">Sender Number(Sender Account Phone Number)</label>
                    <input type="text" name="senderphone" id="senderphone" class="form-control" placeholder="2507XXXXXX">
                  </div>
                  </div>
                <div class="bankslip" id="bankslip">
<label for="bankslipcopy">Upload Bank Slip</label>
<input type="file" id="bankslipcopy" name="bankslipcopy" class="form-control">
                </div>
               </div>
              
              <div class="form-group">
                <label for="amount">Amount</label>
                <input class="form-control" id="amount" type="text" aria-describedby="amount" placeholder="Enter Amount">  </div>
              </div>
          <br/><br/>
          <button type="button" class="btn btn-primary btn-block" id="btnregpayment">
          <i class="fa fa-save"></i>
          Pay</button>
            
              </div>
          </form>
      </div>
    </div>
    <div id="paymentstructureinfo">
<table class="table table-bordered
">
  <thead>
    <tr>
      <th>#Counts</th><th>Amount</th><th>Activation Period
      <button class="btn btn-info btn-sm pull-right" id="btnbackpayinfo">Payment Form</button></th><th class="regdate">Date</th><th class="loadedpaystructmodif">More</th>
    </tr>
  </thead>
  <tbody id="loadedpaystructure"></tbody>
</table>
    </div>

    <!--UPDATING USER-->
      <div class="card card-register mx-auto mt-5" id="updmodpaymentform" style="display: none;width: 70%;margin-left: 15%">
      <div class="card-header ">
      <button class="btn btn-info btn-sm" type="button" id="updbackpaymentinfo"><i class="fa fa-arrow-left"></i>Back</button>
      <span style="margin-left: 5%">Update Business Payment Information</span></div>
      <div class="card-body">
        <form>
        <p id="updPaymentResponse" style="font-size: 14px;"></p>
        <input type="hidden" name="paymentid" id="paymentid">
         <div class="row">

              <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
  <div class="form-group">
                <label for="updnames">Business Name</label>
                <select class="form-control" name="updbusinessname" id="updbusinessname"></select>
              </div>
               <div class="form-group">
                <label for="updpaymode">Payment Mode</label>
               <select class="form-control" id="updpaymode"></select>
              </div>
              
              <div class="form-group">
                <label for="updstructure">Payment Structure</label>
               <select id="updstructure" class="form-control"></select>
              </div>
              <div class="form-group">
                <label for="updcurrency">Currency</label>
               <select id="updcurrency" class="form-control"></select>
              </div>
              <div class="form-group">
                <label for="updamount">Amount</label>
                <input class="form-control" id="updamount" type="text" aria-describedby="updamount" placeholder="Enter Amount">
              </div>
              </div>
          <button type="button" class="btn btn-primary btn-block" id="btnupdpayment">
          <i class="fa fa-save"></i> Update</button><br>
          </div>
        </form>
      </div>
    </div>
    <!--end update payment-->
      </div><!--end Businesss Forms-->
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <?php
include"includes/footer.php";
    ?>

    <!--Delete Modal-->
    <div id='delModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" id="delModalTitle">Do you want to delete<span id="delpayment"></span>?</h4>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delResponse">  </p>
            <input type="hidden" id="deleteid">  
      <label>Delete reason </label>
            <textarea class="form-control" id="delReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelBusiness" class="btn btn-danger" >
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal">
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->
<!--Payment Approval USER-->
      <div class="modal fade" role="modal" id="approvePaymentModal">
        <div class="modal-dialog">
    <div class="modal-content">
        <form>
      <div class="modal-header ">
      <h4 style="margin-left: 5%">Approve Payment Information</h4>
    </div>
      <div class="modal-body">
        <p id="approvePaymentResponse" style="font-size: 14px;"></p>
        <input type="hidden" name="payhistid" id="payhistid">
         <h4 style="color: red"><i class="fa fa-warning"></i>
This Action Can not Be Undone
         </h4>
         <h5>Please Make Sure you have Read and Understood Carefully, Provided payment information before Approve<br><br>
          Because if you approve you can not Undo.<br>
        </h5>
      </div>
          <div class="modal-footer">
            <button type="button" id="btnApprovePayment" class="btn btn-success"><i class="fa fa-check-square-o"></i>Approve</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>
            Close</button>
          </div>
        </form>
    </div>
  </div>
</div><!--End Approve Modal-->
<!--Payment Decline USER-->
      <div class="modal fade" role="modal" id="declinePaymentModal">
        <div class="modal-dialog">
    <div class="modal-content">
        <form>
      <div class="modal-header ">
      <h4 style="margin-left: 5%">Decline Payment History</h4>
    </div>
      <div class="modal-body">
        <p id="declinePaymentResponse" style="font-size: 14px;"></p>
        <h4 style="color: red"><i class="fa fa-warning"></i>
This Action Can not Be Undone
         </h4>
         <div class="form-group">
          <label>Amount Paid</label>
<input type="text" name="ampaid" id="ampaid" class="form-control" readonly="readonly">
          <label>Decline Reason</label>
          <textarea style="resize: none; height: 15%" id="declinePmthReason" class="form-control" ></textarea>
         </div>
      </div>
          <div class="modal-footer">
            <button type="button" id="btnDeclinePayment" class="btn btn-danger"><i class="fa fa-check-square-o"></i>Decline</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>
            Close</button>
          </div>
        </form>
    </div>
  </div>
</div><!--End Approve Modal-->
    </div>
</body>

</html>
