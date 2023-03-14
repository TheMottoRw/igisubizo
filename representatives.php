<?php
include"includes/header.php";
?>
<style type="text/css">
  .representer{background-color:orange;}
</style>
<button class="btn btn-primary pull-right" style="margin-right:3%;margin-top:0%;margin-bottom:-5%" id="btnPrintReps"type="button"><span class="glyphicon glyphicon-print"></span>Print</button>
<button id="btnAddRep" data-toggle="modal" data-target="#addRepeModal" class="btn btn-primary pull-right" style="margin-right:10%;margin-bottom:-1.5%"><span class="glyphicon glyphicon-plus" ></span>Add New</button><br>
       	    <div id="addRepeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Register New Representative</h4>
          </div>
          <div class="modal-body" >
            <p id="regRepResponse">  </p>
          <div class="form-group"> 
		  <label>Name:</label>
			<input type="text" id="repname" class="form-control">
			</div>
			 <div class="form-group"> 
		  <label>Phone:</label>
			<input type="text" id="repphone" class="form-control">
			</div>
			 <div class="form-group"> 
		  <label>Email:</label>
			<input type="text" id="repemail" class="form-control">
			</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnSaveRep">
              <span class="glyphicon glyphicon-ok"></span>Save</button><button type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Create Modal-->
       	   
  <div id="updateRepModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Representative </h4>
          </div>
          <div class="modal-body">
		  <p id="updateRepResponse"></p>
		  <input type="hidden" id="repid">
		 <div class="form-group"> 
		  <label>Name:</label>
			<input type="text" id="updrepname" class="form-control">
			</div>
			 <div class="form-group"> 
		  <label>Phone:</label>
			<input type="text" id="updrepphone" class="form-control">
			</div>
			 <div class="form-group"> 
		  <label>Email:</label>
			<input type="text" id="updrepemail" class="form-control">
			</div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnUpdRep" class="btn btn-success">
            <span class="glyphicon glyphicon-ok"></span>  Update</button><button type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Update Created Modal-->
		      <div class="row" id="repviewform" style="padding-left:2%;padding-right: 2%">
        <span style="color:green"></span>
        <div class="table-responsive">
        <table class="table table-bordered" id="tblRepresentative">
          <caption>Registered Representatives</caption>
          <thead>
            <tr>
              <th>#Count</th>
              <th>Name  </th>
               <th>Phone  </th>
                <th>Email  </th>
              <th>  Registration Date</th>
              <th class="loadedrepmodif">  Modifications</th>
            </tr>
          </thead>
          <tbody id="loadedreps">
          
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
         <h4 class="modal-title" id="repdelModalTitle">Do you want to delete</h4>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="repdelResponse">  </p>
            <input type="hidden" id="repdeleteid">  
			<label>Delete reason </label>
            <textarea class="form-control" id="repdelReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelRep" class="btn btn-danger" >
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