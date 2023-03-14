<?php
include"includes/header.php";
?>
<style type="text/css">
  .commissions{background-color:orange;}
</style>
<button class="btn btn-primary pull-right" style="margin-right:3%;margin-top:0%;margin-bottom:-7%" id="btnPrintCommission" type="button"><span class="glyphicon glyphicon-print"></span>Print</button>
<!--button id="btnAddCommission" data-toggle="modal" data-target="#addCommissionModal" class="btn btn-primary pull-right" style="margin-right:10%;margin-bottom:-2%"><span class="glyphicon glyphicon-plus" ></span> New Commission</button-->
            <div id="addCommissionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <button  type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Register New Commission</h4>
          </div>
          <div class="modal-body" >
            <p id="regCommissionResponse">  </p>
          <div class="form-group"> 
      <label>Commission:</label>
      <input  type="text" id="pay" class="form-control">
      </div>
          </div>
          <div class="modal-footer">
            <button  type="button" class="btn btn-success" id="btnSaveCommission">
              <span class="glyphicon glyphicon-ok"></span>Save Commission</button><button  type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Create Modal-->
           
   <div id="updateCommissionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button  type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Commission <span id="commTitle"></span></h4>
          </div>
          <div class="modal-body">
      <p id="updateCommissionResponse"></p>
      <input  type="hidden" id="commid">
         <div class="form-group"> 
      <label> Target:</label>
      <input  type="text" id="updCommissionTarget" class="form-control" readonly="readonly"> 
      <label> Rate:</label>
      <input  type="text" id="updCommissionRate" class="form-control"> 
      <label> Rate Type:</label>
      <select id="updCommissionRateType" class="form-control">
      </select>
      </div>
          </div>
          <div class="modal-footer">
            <button  type="button" id="btnUpdCommission" class="btn btn-success">
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
        <table class="table table-bordered" id="tblCommissions">
          <caption>Registered Commission</caption>
          <thead>
            <tr>
            <th># Count  </th>
              <th> Payment  </th>
              <th> Target</th>
              <th> Rate  </th>
              <th>  Registration Date</th>
              <th class="loadedpaymodif" style="text-align:center">  Modifications</th>
            </tr>
          </thead>
          <tbody id="loadedcommissions">
          
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
            <button  type="button" id="btnDelCommission" class="btn btn-danger" >
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