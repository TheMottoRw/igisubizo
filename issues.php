<?php
include"includes/header.php";
?>
<style type="text/css">
  .Issues{background-color:orange;}
  .iscReceived{
    background:rgba(60,120,140,0.4);
    width: 80%;
    float: left;
    border-radius: 5%; 
    padding: 1%;
    margin-top: 3%; 
  }
  .iscSent{
    background:rgba(60,170,140,0.4);
    width: 80%;
    float: right;
    border-radius: 5%; 
    padding: 1%;
    margin-top: 3%;
  }
  .sentdate{
    float: left;
    margin-top: 1%;
    color: gray;
  }
  .status{
    float: right;
    margin-top: 1%;
    color: gray;
  }
  #chatContainer{
    overflow-y: auto;
    font-size: 14px;
    height: 50%;
    ::-webkit-scrollbar{
      width: 15px;
    }
    ::-webkit-scrollbar-track{
  background: #f1f1f1;
  }
    ::-webkit-scrollbar-thumb{
  background: green;
  }
    ::-webkit-scrollbar-thumb:hover{
  background: red;
  }
    }
  .notifierContainer{display: none;}
</style>
<button class="btn btn-primary pull-right" style="margin-right:3%;margin-top:0%;margin-bottom:-5%" id="btnPrintIssue"type="button"><span class="glyphicon glyphicon-print"></span>Print</button>
<button id="btnAddIssue" data-toggle="modal" data-target="#issueChatModal" class="btn btn-primary pull-right" style="margin-right:10%;margin-bottom:-1.5%"><span class="glyphicon glyphicon-plus" ></span> New Issue</button><br>

       	    <div id="issueChatModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><span id='issOwner'></span>  Issue Chat</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="iscissueid" id="iscissueid">
            <input type="hidden" name="toid" id="toid">
            <input type="hidden" name="totype" id="totype">
            <p id="issTitle" style="background-color: green; color:white;text-align: center;">citizens Registration support  </p>
            <div class="" id="chatContainer">
              <div class="iscReceived">Commissioner is not able to register Citizens as expected please your support<br>
                <span class="sentdate">2018-08-12 12:00</span><span class="status">sent</span></div>
              <div class="iscSent">we are dealing with it<br>
                <span class="sentdate">2018-08-12 12:00</span><span class="status">sent</span></div>
              <div class="iscReceived">Commissioner is not able to register Citizens as expected please your support<br>
                <span class="sentdate">2018-08-12 12:00</span><span class="status">sent</span></div>
              <div class="iscSent">we are dealing with it<br>
                <span class="sentdate">2018-08-12 12:00</span><span class="status">sent</span>
            </div>
              <div class="iscReceived">Commissioner is not able to register Citizens as expected please your support<br>
                <span class="sentdate">2018-08-12 12:00</span><span class="status">sent</span></div>
              <div class="iscSent">we are dealing with it<br>
                <span class="sentdate">2018-08-12 12:00</span><span class="status">sent</span>
            </div>
              <div class="iscSent">Commissioner is not able to register Citizens as expected please your support<br>
                <span class="sentdate">2018-08-12 12:00</span><span class="status">sent</span></div>
              <div class="iscReceived">we are dealing with it<br>
                <span class="sentdate">2018-08-12 12:00</span><span class="status">sent</span>
            </div>
            </div>
          </div>
          <div class="modal-footer">
          <div class="form-group">
      <textarea id="issueschat" class="form-control" style="width: 85%;border-radius: 3%;height: 40px;resize: none;"></textarea>
            <button type="button" class="btn btn-success" id="btnSaveIssue" style="margin-top: -7.2%;height: 40px;text-align: center;">
              <span class="glyphicon glyphicon-ok">Reply</span></button>
      </div>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Create Modal-->
       	   
   <div id="updateIssueModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Issue </h4>
          </div>
          <div class="modal-body">
		  <p id="updateIssueResponse"></p>
		  <input type="hidden" id="Issueid">
         <div class="form-group"> 
		  <label>Issue Name:</label>
			<input type="text" id="updIssue" class="form-control">
      <label>Max Item:</label>
      <input type="text" id="updmaxItem" class="form-control">
			</div>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnUpdIssue" class="btn btn-success">
            <span class="glyphicon glyphicon-ok"></span>  Update</button><button type="submit" class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>Cancel</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end Invoice Update Created Modal-->
	
		      <div class="row" id="Issueviewform" style="padding-left:2%;padding-right: 2%">
        <span style="color:green"></span>
        <div class="table-responsive">
        <table class="table table-bordered" id="tblIssues">
          <caption>Registered Issue</caption>
          <thead>
            <tr>
            <th># Count  </th>
              <th>Issue Owner  </th>
              <th>Title</th>
              <th>Status</th>
              <th>  Registration Date</th>
              <th class="loadedIssuemodif" style="text-align:center">  Modifications</th>
            </tr>
          </thead>
          <tbody id="loadedIssues">
          
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
            <button type="button" id="btnDelIssue" class="btn btn-danger" >
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