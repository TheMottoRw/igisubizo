<style type="text/css">
  .queues{background-color:orange;}
</style>
<?php
include"includes/header.php";
?>
  <div class="row" id="queueofficeviewform" style="padding-left:2%;padding-right:2%;">
        <span style="color:green"></span>
        <div class="table-responsive">
        <table class="table table-bordered" id="tblCitizen">
          <caption>Registered Citizens</caption>
          <thead>
            <tr>
               <th>#Count</th>
              <th>Names  </th>
              <th>NID  </th>
              <th>Phone</th>
              <th>Commissioner</th>
              <th>Paid</th>
              <th>  Registration Date</th>
              <th>Modifications</th>
            </tr>
          </thead>
          <tbody id="loadedCitizens">
		  
          </tbody>
        </table>
      </div>
      </div><!--end employeeviewform-->
      <div aria-hidden="true" aria-labelledby="modalViewQueue" role="dialog" tabindex="-1" id="modalViewQueue" class="modal fade">
            <div class="modal-dialog" style="width:80%;">
                <div class="modal-content" style="padding-left: 20px;padding-right:20px;padding-bottom: 20px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Citizens View Queues</h4>
                    </div>
                      <div class="row">
               <div class="modal-body">
                <div class="table-responsive">
    <table class="table table-bordered" id="tblByQueues">
          <caption>Registered Items:&nbsp;<span id="citnametitl"></span></caption>
          <thead>
            <tr>
              <th>#Counts</th>
              <th>Type </th>
               <th>Identifier </th>
              <th>Notify By  </th>
                   <th>Date</th>
            </tr>
          </thead>
          <tbody id="loadedqueuebycitizen">
          
          </tbody>
        </table>
      </div>
             </div>
                   <div class="modal-footer">
                   <button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>
                   </div>
            </div>
                    </div>
                    </form>
                    </div>
                </div>  
  
   <div id='delModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" id="delModalTitle">Do you want to delete <span id="deltit"></span></h4>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delResponse">  </p>
            <input type="hidden" id="deletequeueid">  
			<label>Delete reason </label>
            <textarea class="form-control" id="delQueueReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelQueue" class="btn btn-danger" >
              Delete</button><button type="button" class="btn btn-default" data-dismiss="modal">
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end delete Modal-->

</div><!--end container-->
	</nav>	
<?php
include"includes/footer.php";
?>
</div>
</body>
</html>