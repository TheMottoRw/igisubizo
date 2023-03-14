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
        <li class="breadcrumb-item active">Withdraws</li>
      </ol>
       <div class="card mb-3" id="withdrawinfo">
        <div class="card-header" style="padding-right: 3%;">
          <i class="fa fa-table"></i> List of Withdraws Done and Approval
                    <button type="button" class="btn btn-success" style="margin-left: 60%" id="btnNewWth" data-toggle='modal' data-target='#modalNewWth' onclick="loadWithdrawCompany('setCombo',null)"><i class='fa fa-plus'></i> Agaciro Donation</button>
         </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="tblPaymentWithdraw" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#Count</th>
                  <th>Withdrawer Name</th>
                  <th>Type</th>
                  <th>Company</th>
                  <th>A/C Name</th>
                  <th>A/C Number</th>
                  <th>Requested</th>
                  <th>Given</th>
                   <th class='status'>Status</th>
                   <th>Registration Date</th>
                   <th class='loadedwthmodif'>Approval</th>
                 </tr>
              </thead>
              <tbody id="loadedwthhistory">
              </tbody>
            </table>
          </div>
        </div>
      </div>
         <!--Forms-->
               <div aria-hidden="true" aria-labelledby="modalNewWth" role="dialog" tabindex="-1" id="modalNewWth" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content" style="padding-left: 20px;padding-right:20px;padding-bottom: 20px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Agaciro Withdraw form</h4>
                    </div>
                      <div class="row">
                    <div id="regWithdrawResponse"></div>
                    <form name="regNewWthform" action="" method="post">
                   <div class="modal-body">
                        <div class="form-group">
                            <p>Withdraw Company</p>
                            <select id="wthCompany" class="form-control">
                                <option></option>
                                </select>
                           </div>
                           <div class="form-group">
                            <p>Account Name</p>
                            <input type="text" name="accName" id="accName" required class="form-control" pattern="[a-zA-Z0-9 ]"></div>
                           <div class="form-group">
                            <p>Account Number</p>
                            <input type="text" id="accNumber"  required class="form-control" pattern="[0-9]">
                           </div>
                           <div class="form-group">
                                <p>Amount</p>
                                <input type="text" id="reqAmount" class="form-control" pattern="[0-9]" required>
                            </div>
                         </div> 
                            <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span>Cancel</button>
                            <button class="btn btn-success" id="btnSaveWth" type="submit"><span class="glyphicon glyphicon-ok"></span>Register</button>
                       
                        </div>

                    </div>
                    </div>
                    </form>
                    </div>
                </div>
            </div>
        </div><!--end Wth Dialog-->

      <div id="withdrawmodforms">
<div class="panel card-register mx-auto mt-5" id="regwithdrawform" style="display: none;margin-top: -1%;width:80%;margin-left: 10%">
      <div class="panel-header">
       <span style="margin-left: 5%">Withdraw Registration</span></div>
      <div class="panel-body">
        <form>
        <p id="regPaymentResponse" style="font-size: 14px;"></p>
        <div class="row">

              <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
            <div class="form-group">
              <div class="form-group">
                <label for="paymode">Withdraw Company</label>
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
          <button type="button" class="btn btn-primary btn-block" id="btnregwithdraw">
          <i class="fa fa-save"></i>
          Pay</button>
            
              </div>
          </form>
      </div>
    </div>
    <div id="withdrawstructureinfo">
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
      <div class="card card-register mx-auto mt-5" id="updmodwithdrawform" style="display: none;width: 70%;margin-left: 15%">
      <div class="card-header ">
      <button class="btn btn-info btn-sm" type="button" id="updbackwithdrawinfo"><i class="fa fa-arrow-left"></i>Back</button>
      <span style="margin-left: 5%">Update Agaciro Withdraw Information</span></div>
      <div class="card-body">
        <form>
        <p id="updPaymentResponse" style="font-size: 14px;"></p>
        <input type="hidden" name="withdrawid" id="withdrawid">
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
          <button type="button" class="btn btn-primary btn-block" id="btnupdwithdraw">
          <i class="fa fa-save"></i> Update</button><br>
          </div>
        </form>
      </div>
    </div>
    <!--end update withdraw-->
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
         <h4 class="modal-title" id="delModalTitle">Do you want to delete<span id="delwithdraw"></span>?</h4>
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
      <div class="modal fade" role="modal" id="approveWithdrawModal">
        <div class="modal-dialog">
    <div class="modal-content">
        <form>
      <div class="modal-header ">
      <h4 style="margin-left: 5%">Approve Withdraw Information</h4>
    </div>
      <div class="modal-body">
        <p id="approveWithdrawResponse" style="font-size: 14px;"></p>
        <input type="hidden" name="withdrawhistid" id="withdrawhistid">
         <h4 style="color: red"><i class="fa fa-warning"></i>
This Action Can not Be Undone
         </h4>
         <div class="form-group">
          <label>Amount Requested</label>
<input type="text" name="requested" id="requested" class="form-control" readonly="readonly">
          <label>Amount Given</label>
<input type="text" name="given" id="given" class="form-control">
         </div>
         <h5>Please Make Sure you have Read and Understood Carefully, Provided withdraw information before Approve<br><br>
          Because if you approve you can not Undo.<br>
        </h5>
      </div>
          <div class="modal-footer">
            <button type="button" id="btnApproveWithdraw" class="btn btn-success"><i class="fa fa-check-square-o"></i>Approve</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>
            Close</button>
          </div>
        </form>
    </div>
  </div>
</div><!--End Approve Modal-->
<!--Payment Approval USER-->
      <div class="modal fade" role="modal" id="declineWithdrawModal">
        <div class="modal-dialog">
    <div class="modal-content">
        <form>
      <div class="modal-header ">
      <h4 style="margin-left: 5%">Decline Withdraw Request</h4>
    </div>
      <div class="modal-body">
        <p id="declineWithdrawResponse" style="font-size: 14px;"></p>
         <h4 style="color: red"><i class="fa fa-warning"></i>
This Action Can not Be Undone
         </h4>
         <div class="form-group">
          <label>Amount Requested</label>
<input type="text" name="amrequested" id="amrequested" class="form-control" readonly="readonly">
          <label>Decline Reason</label>
          <textarea style="resize: none; height: 15%" id="declineWthReason" class="form-control" ></textarea>
         </div>
         <h5>Please Make Sure you have Read and Understood Carefully, Provided withdraw information before Approve<br><br>
          Because if you approve you can not Undo.<br>
        </h5>
      </div>
          <div class="modal-footer">
            <button type="button" id="btnDeclineWithdraw" class="btn btn-danger"><i class="fa fa-check-square-o"></i>Decline</button>
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
