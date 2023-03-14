<?php
include"includes/header.php";
?>
<style type="text/css">
  .categories{background-color:orange;}
</style>
<button class="btn btn-primary pull-right" style="margin-right:3%;margin-top:0%;margin-bottom:-3%" id="btnPrintCategory" type="button"><span class="glyphicon glyphicon-print"></span>Print</button>
<!--button id="btnAddCategory" data-toggle="modal" data-target="#addCategoryModal" class="btn btn-primary pull-right" style="margin-right:10%;margin-bottom:0.5%"><span class="glyphicon glyphicon-plus" ></span> New Category</button-->
       	    <div id="addCategoryModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Register New Category</h4>
          </div>
          <div class="modal-body" >
            <p id="regCategoryResponse">  </p>
          <div class="form-group"> 
		  <label>Category:</label>
			<input type="text" id="category" class="form-control">
			</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btnSaveCategory">
              <span class="glyphicon glyphicon-ok"></span>Save Category</button><button type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Create Modal-->
       	   
   <div id="updateCategoryModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Category </h4>
          </div>
          <div class="modal-body">
		  <p id="updateCategoryResponse"></p>
		  <input  type="hidden" id="categoryid">
         <div class="form-group"> 
		  <label> Category Name:</label>
			<input type="text" id="updCategory" class="form-control">
			</div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnUpdCategory" class="btn btn-success">
            <span class="glyphicon glyphicon-ok"></span>  Update</button><button type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Update Created Modal-->
		
		      <div class="row" id="categoryviewform" style="padding-left:2%;padding-right: 2%">
        <span style="color:green"></span>
        <div class="table-responsive">
        <table class="table table-bordered" id="tblCategory">
          <caption>Registered Category</caption>
          <thead>
            <tr>
            <th># Count  </th>
              <th> Category Name  </th>
              <th>  Registration Date</th>
              <!--th colspan="3" class="loadedcategorymodif" style="text-align:center">  Modifications</th-->
            </tr>
          </thead>
          <tbody id="loadedcategories">
          
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
            <button type="button" id="btnDelCategory" class="btn btn-danger" >
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