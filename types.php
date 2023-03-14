<?php
include"includes/header.php";
?>
<style type="text/css">
  .types{background-color:orange;}
</style>
<button class="btn btn-primary pull-right" style="margin-right:3%;margin-top:0%;margin-bottom:-5%" id="btnPrintType"type="button"><span class="glyphicon glyphicon-print"></span>Print</button>
<button id="btnAddType" data-toggle="modal" data-target="#addTypeModal" class="btn btn-primary pull-right" style="margin-right:10%;margin-bottom:-1.5%"><span class="glyphicon glyphicon-plus" ></span> New type</button><br>

       	    <div id="addTypeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Register New Type</h4>
          </div>
          <div class="modal-body" >
            <p id="regTypeResponse">  </p>
          <div class="form-group"> 
		  <label>Type:</label>
			<input type="text" id="type" class="form-control">
      <label>Max Item:</label>
      <input type="text" id="maxItem" class="form-control">
			</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnSaveType">
              <span class="glyphicon glyphicon-ok"></span>Save Type</button><button type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Create Modal-->
       	   
   <div id="updateTypeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Type </h4>
          </div>
          <div class="modal-body">
		  <p id="updateTypeResponse"></p>
		  <input type="hidden" id="typeid">
         <div class="form-group"> 
		  <label>Type Name:</label>
			<input type="text" id="updType" class="form-control">
      <label>Max Item:</label>
      <input type="text" id="updmaxItem" class="form-control">
			</div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnUpdType" class="btn btn-success">
            <span class="glyphicon glyphicon-ok"></span>  Update</button><button type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Update Created Modal-->
	
		      <div class="row" id="typeviewform" style="padding-left:2%;padding-right: 2%">
        <span style="color:green"></span>
        <div class="table-responsive">
        <table class="table table-bordered" id="tblTypes">
          <caption>Registered Type</caption>
          <thead>
            <tr>
            <th># Count  </th>
              <th>Type Name  </th>
              <th>Max Items</th>
              <th>  Registration Date</th>
              <th class="loadedtypemodif" style="text-align:center">  Modifications</th>
            </tr>
          </thead>
          <tbody id="loadedtypes">
          
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