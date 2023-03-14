<style type="text/css">
  .payments{background-color:orange;}
</style>
<?php
include"includes/header.php";
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Modes</li>
      </ol>
      <!-- Example DataTables Card-->
       <div class="card mb-3" id="paymodeinfo">
        <div class="card-header">
          <i class="fa fa-table"></i> List of Payment Modes Allowed</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="tblModes" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#Count</th>
                  <th>Mode</th>
                  <th>Company</th>
                  <th>Account Name</th>
                  <th>Account Number</th>
               <th>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <th>More &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php if (!isset($_GET['cate'])) {?>
                <button class="btn btn-success btn-sm" id="addpaymodebtn" data-toggle='modal' data-target='#regPaymodeModal'><i class="fa fa-plus"></i>Add New</button>
                <?php } ?></th>
                 </tr>
              </thead>
              <!--tfoot>
                <tr>
                <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Category</th>
                  <th>Represents</th>
                 <th>More</th>
                 </tr>
              </tfoot-->
              <tbody id="loadedpaymodes">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--Forms-->
      
            <div id="regPaymodeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form>
          <div class="modal-header">
<span style="font-size: 18px;">Register New Payment Mode</span>    <button type="button" class="close" data-dismiss="modal">&times;</button>   
   </div>         <div class="modal-body" >
            <p id="regPaymodeResponse">  </p>
          <div class="form-group"> 
      <label>Paymode Name:</label>
      <input type="text" id="paymodename" class="form-control">
      </div>
      <div class="form-group"> 
      <label>Company:</label>
      <input type="text" id="company" class="form-control">
      </div>
      <div class="form-group"> 
      <label>Account Name:</label>
      <input type="text" id="accname" class="form-control">
      </div>
       <div class="form-group"> 
      <label>Account Number:</label>
      <input type="text" id="accnumber" class="form-control">
      </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnSavePaymode">
              <span class="fa fa-check"></span>Save</button><button type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="fa fa-close"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--Registration Form-->
<!--Update Category Form-->

            <div id="updatePaymodeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form>
        <input type="hidden" name="paymodeid" id="paymodeid">
          <div class="modal-header">
<span style="font-size: 18px;">Update Payment Mode</span>   <button type="button" class="close" data-dismiss="modal">&times;</button>      </div>
          <div class="modal-body" >
              <p id="updPaymodeResponse">  </p>
          <div class="form-group"> 
      <label>Paymode Name:</label>
      <input type="text" id="updpaymodename" class="form-control">
      </div>
      <div class="form-group"> 
      <label>Company:</label>
      <input type="text" id="updcompany" class="form-control">
      </div>
      <div class="form-group"> 
      <label>Account Name:</label>
      <input type="text" id="updaccname" class="form-control">
      </div>
       <div class="form-group"> 
      <label>Account Number:</label>
      <input type="text" id="updaccnumber" class="form-control">
      </div>
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnUpdPaymode">
              <span class="fa fa-check"></span>Update</button><button type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="fa fa-close"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--Update Form-->
    </div>
    <!--end update user-->
      
      </div><!--end Users Forms-->
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
<?php
include"includes/footer.php";
?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
     <!--Delete Modal-->
    <div id='delModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" id="delModalTitle">Do you want to delete<span id="delcate"></span>?</h4>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delResponse">  </p>
            <input type="hidden" id="deleteid">  
      <label>Delete reason </label>
            <textarea class="form-control" id="delReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelPaymode" class="btn btn-danger" ><i class="fa fa-check"></i>
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->
    </div>
</body>

</html>
