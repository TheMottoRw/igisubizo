<?php
include"includes/header.php";
?>
<link type="text/css" href="bootstrap/bootstrap-datepicker/css/bootstrap-datepicker.css" media="all">
<style type="text/css">
  .report{background-color:orange;}
  .notifierContainer{display: none;}
  .loadedcitmodif,.loadedapproval,.loadedwthmodif{display: none;}
</style>
<div class="row" id="companyInfoHeader" style="display: none;">
<div class="pull-left">
<img src="webuse/logo.jpg" class="img img-circle" height="25%">
</div>
<div class="pull-right" style="margin-right: 3%">
  <div class="companyInfo">
Name :<b>Be Forward Generation Ltd</b><br>
Email :<b>info@bfg.rw</b><br>
Phone :<b>(+250) 784634118</b><br>
Website :<b>www.bfg.rw</b><br>

  </div>
  </div>
</div>
<?php
if(isset($_GET['cate'])){
switch($_GET['cate']){
  case 'losts':
  ?>
  <div class="row" id="postofficeviewform" style="padding-left:2%;padding-right:2%;padding-bottom:2%">
        <form action="" method="GET" id="lostsFilterForm">
          <div class="row">
        <div id="viewby" class="col-lg-6 col-md-12 col-sm-12">Filter and View By Combinations of Criterias &nbsp;&nbsp;
    <!--select class="form-control" id="byrange" style="width:120px;">
    <option value="all">Period</option>
        <option value="day">Today</option>
        <option value="week">This Week</option>
        <option value="month">This Month</option>
        <option value="custom">Custom</option>
        </select-->
        <select class="form-control" id="lostsbyStatus" style="width:120px;margin-left:0%;margin-top:0%">
        <option>Status</option>
        <option value="pending">Pending</option>
        <option value="taken">Taken</option>
        </select>
            <select class="form-control" id="byPostoffice" style="width:150px;margin-left:340px;;margin-top:-35px;"><option>All Post Offices</option></select>
        <select class="form-control" id="loststype" style="width:150px;margin-left:150px;margin-top:-32px"><option>All Types</option>
        </select> 
        </div>
<div class="col-lg-6 col-md-12 col-sm-12" id="repbtn">
<div style="margin-left:0%"><div style="padding-left:-250px;padding-top:20px;" id="rangediv"><span>Range:&nbsp; </span>
        <input type="text" class="loststart" id="loststart" placeholder="From" style="border:1px solid lightgrey; border-radius:3%;padding: 3px;text-align: center;">
        <input type="text" id="lostend" placeholder="To" style="border:1px solid lightgrey; border-radius:3%;padding: 3px;text-align: center;">
        <button type="button" id="lostcheckRange" class="btn btn-success">Get Report</button></div>
<button class="btn btn-primary" style="margin-left:80%;margin-top:-5%;margin-bottom:-5%" id="lostbtnPrintReport" type="button"><span class="glyphicon glyphicon-print"></span>Print</button>
        
        </div></div>
        </div></form>
        <span style="color:green"></span><br>
        <div class="table-responsive">
        <table class="table table-bordered">
          <caption>Report of Losts <span id="lostsReportHeader" class="pull-right" style="color: black;margin-right: 5%;"></span> </caption>
          <thead>
            <tr>
             <th># Count  </th>
             <th>Owner  </th>
              <th>Item Type</th>
              <th>Identication </th>
              <th>Postname </th>
              <th>Done By </th>
              <th>Status </th>
              <th>Date </th>
            </tr>
          </thead>
          <tbody id="loadedreport"></tbody>
        </table>
        </div>
      </div>
  <?php
    break;
    case'citizens':
    ?>
    <div class="row" id="citizenviewform" style="padding-left:2%;padding-right:2%;padding-bottom:2%">
        <form action="" method="GET" id="citFilterForm">
          <div class="row">
        <div id="viewby" class="col-lg-4 col-md-4 col-sm-12">Filter and View By Combinations of Criterias &nbsp;&nbsp;
        <div class="row">
          <div class="form-group col-lg-6 col-md-6 col-sm-12">
        <select class="form-control " id="citbyStatus">
        <option value="default">Select Payment</option>
        <option value="0">None</option>
        <option value="1">Paid</option>
        </select>
        </div>
        <div class="form-group col-lg-6 col-md-6 col-sm-12">
            <select class="form-control" id="citbyCommissioner" style=""><option>Select Commissioner</option></select>
          </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <div class="col-lg-8 col-md-8 col-sm-12"><br>
 <div class="form-group col-lg-6 col-md-6 col-sm-12">
  <input type="text" id="citstart" class="start form-control" placeholder="From" style="border:1px solid lightgrey; border-radius:3%;padding: 3px;text-align: center;">
 </div>
 <div class="form-group col-lg-6 col-md-6 col-sm-12">
        <input type="text" id="citend" placeholder="To" class="form-control" style="border:1px solid lightgrey; border-radius:3%;padding: 3px;text-align: center;">
      </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-left: 0%"><br>
  <button type="button" id="citcheckRange" class="btn btn-success">Get Report</button>
<button class="btn btn-primary"  id="citbtnPrintReport" type="button" style="margin-left: 2%"><span class="glyphicon glyphicon-print"></span>Print</button>
          </div>
        </div>
      </div>
    </form>
        <div class="table-responsive">
        <table class="table table-bordered" id="tblCitizen">
          <caption>Registered Citizens <span id="citReportHeader" class="pull-right" style="color: black;margin-right: 5%;"></span></caption>
          <thead>
            <tr>
               <th>#Count</th>
              <th>Names  </th>
              <th>NID  </th>
              <th>Phone</th>
              <th>Commissioner</th>
              <th>Paid</th>
              <th>  Registration Date</th>
              <th class="loadedcitmodif">Modifications</th>
            </tr>
          </thead>
          <tbody id="loadedCitizens">
      
          </tbody>
        </table>
        </div>
      </div>
    <?php
    break;
    case'payhist':
    ?>
    <div class="row" id="payhisteviewform" style="padding-left:2%;padding-right:2%;padding-bottom:2%">
 <div class="row">
  <form action="" method="GET" id="payhistFilterForm">
        <div id="viewby" class="col-lg-4 col-md-4 col-sm-12">Filter and View By Combinations of Criterias &nbsp;&nbsp;

        <div class="row">
          <div class="form-group col-lg-4 col-md-4 col-sm-12">
       <select class="form-control" id="payhistbyStatus" style="width:120px;margin-left:0%;margin-top:0%">
        <option value="default">Status</option>
        <option value="all">All</option>
        <option value="pending">Pending</option>
        <option value="approved">Approved</option>
        <option value="declined">Declined</option>
        </select>
        </div>
        <div class="form-group col-lg-4 col-md-4 col-sm-12">
            <select class="form-control" id="payhistByType" >
              <option value="default">Type</option>
        <option value="Citizen">Citizens</option>
        <option value="Commissioner">Commissioners</option>
        <option value="Postoffice">Postoffices</option>
      </select>
          </div>
          <div class="form-group col-lg-4 col-md-4 col-sm-12">
        <select class="form-control" id="paymode">
          <option>Select Paymode</option>
        </select> 
        </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <div class="col-lg-8 col-md-8 col-sm-12"><br>
 <div class="form-group col-lg-6 col-md-6 col-sm-12">
  <input type="text" id="payhiststart" class="start form-control" placeholder="From" style="border:1px solid lightgrey; border-radius:3%;padding: 3px;text-align: center;">
 </div>
 <div class="form-group col-lg-6 col-md-6 col-sm-12">
        <input type="text" id="payhistend" placeholder="To" class="form-control" style="border:1px solid lightgrey; border-radius:3%;padding: 3px;text-align: center;">
      </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="right:0%"><br>
  <button type="button" id="payhistcheckRange" class="btn btn-success">Get Report</button>
<button class="btn btn-primary"  id="payhistbtnPrintReport" type="button" style="margin-left: 2%"><span class="glyphicon glyphicon-print"></span>Print</button>
          </div>
        </div>
      </form>
      </div>
        <span style="color:green"></span>
        <div class="table-responsive">
         <table class="table table-bordered" id="tblPaymentHistory" width="100%" cellspacing="0">
          <caption>Report of Payment History Done and Their Approval<span id="payhistReportHeader" class="pull-right" style="color: black;margin-right: 5%;"></span></caption>
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
                   <th class='loadedapproval'>Approval</th>
                 </tr>
              </thead>
              <tbody id="loadedpayhistory">
              </tbody>
            </table>
        </div>
      </div>
    <?php
    break;
    case'withdraw':
    ?>
<div class="row" id="withdrawviewform" style="padding-left:2%;padding-right:2%;padding-bottom:2%">
        <form action="" method="GET" id="wthFilterForm">
   <div class="row">
        <div id="viewby" class="col-lg-4 col-md-4 col-sm-12">Filter and View By Combinations of Criterias &nbsp;&nbsp;
        <div class="row">
          <div class="form-group col-lg-4 col-md-4 col-sm-12">
       <select class="form-control" id="wthbyStatus" style="width:120px;margin-left:0%;margin-top:0%">
        <option value="default">Status</option>
        <option value="all">All</option>
        <option value="pending">Pending</option>
        <option value="approved">Approved</option>
        <option value="declined">Declined</option>
        </select>
        </div>
        <div class="form-group col-lg-4 col-md-4 col-sm-12">
            <select class="form-control" id="wthByType" >
              <option value="default">Type</option>
        <option value="Commissioner">Commissioners</option>
        <option value="Postoffice">Postoffices</option>
        <option value="Agaciro">Agaciro Development Fund</option>
      </select>
          </div>
          <div class="form-group col-lg-4 col-md-4 col-sm-12">
        <select class="form-control" id="wthCompany">
          <option>Select Paymode</option>
        </select> 
        </div>
          </div>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <div class="col-lg-8 col-md-8 col-sm-12"><br>
 <div class="form-group col-lg-6 col-md-6 col-sm-12">
  <input type="text" id="wthstart" class="start form-control" placeholder="From" style="border:1px solid lightgrey; border-radius:3%;padding: 3px;text-align: center;">
 </div>
 <div class="form-group col-lg-6 col-md-6 col-sm-12">
        <input type="text" id="wthend" placeholder="To" class="form-control" style="border:1px solid lightgrey; border-radius:3%;padding: 3px;text-align: center;">
      </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="right:0%"><br>
  <button type="button" id="wthcheckRange" class="btn btn-success">Get Report</button>
<button class="btn btn-primary"  id="wthbtnPrintReport" type="button" style="margin-left: 2%"><span class="glyphicon glyphicon-print"></span>Print</button>
          </div>
        </div>
      </div>
    </form>
        <span style="color:green"></span>
        <div class="table-responsive">
         <table class="table table-bordered" id="tblPaymentWithdraw" width="100%" cellspacing="0">
              <caption>Withdraws Done and their Approval<span id="wthReportHeader" class="pull-right" style="color: black;margin-right: 5%;"></span></caption> <thead>
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
                   <th class='loadedapproval'>Approval</th>
                 </tr>
              </thead>
              <tbody id="loadedwthhistory">
              </tbody>
            </table>
        </div>
      </div>
    <?php
    break;
    case 'balance':
    ?>
<div class="row" id="balanceviewform" style="padding-left:2%;padding-right:2%;padding-bottom:2%">
        <form action="" method="GET" id="balanceFilterForm">
          <div class="row">
        <div id="viewby" class="col-lg-6 col-md-12 col-sm-12">Filter and View By Combinations of Criterias &nbsp;&nbsp;
<div class="col-lg-6 col-md-12 col-sm-12" id="repbtn">
<div style="margin-left:0%"><div style="padding-left:-250px;padding-top:20px;" id="rangediv"><span>Range:&nbsp; </span>
        <input type="text" class="start" id="start" placeholder="From" style="border:1px solid lightgrey; border-radius:3%;padding: 3px;text-align: center;">
        <input type="text" id="end" placeholder="To" style="border:1px solid lightgrey; border-radius:3%;padding: 3px;text-align: center;">
        <button type="button" id="checkRange" class="btn btn-success">Get Report</button></div>
<button class="btn btn-primary" style="margin-left:80%;margin-top:-5%;margin-bottom:-5%" id="btnPrintReport" type="button"><span class="glyphicon glyphicon-print"></span>Print</button>
        
        </div></div>
        </div></form>
        <span style="color:green"></span><br>
        <div class="table-responsive">
        <table class="table table-bordered">
          <caption>Report of Losts at Certain Range Period </caption>
          <thead>
            <tr>
             <th># Count  </th>
             <th>Owner  </th>
              <th>Item Type</th>
              <th>Identication </th>
              <th>Postname </th>
              <th>Done By </th>
              <th>Status </th>
              <th>Date </th>
            </tr>
          </thead>
          <tbody id="loadedreport"></tbody>
        </table>
        </div>
      </div>
    <?php
      break;
      case'items':
?>
<div class="row" id="itemsviewform" style="padding-left:2%;padding-right:2%;padding-bottom:2%">
        <form action="" method="GET" id="itemsFilterForm">
          <div class="row">
        <div id="viewby" class="col-lg-4 col-md-4 col-sm-12">Filter and View By Combinations of Criterias &nbsp;&nbsp;
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <div class="col-lg-8 col-md-8 col-sm-12">

        <div class="form-group col-lg-4 col-md-4 col-sm-12">
            <select class="form-control" id="itemsByType" >
              <option value="default">Type</option>
      </select>
          </div>
 <div class="form-group col-lg-4 col-md-4 col-sm-12">
  <input type="text" id="itemsstart" class="start form-control" placeholder="From" style="border:1px solid lightgrey; border-radius:3%;padding: 3px;text-align: center;">
 </div>
 <div class="form-group col-lg-4 col-md-4 col-sm-12">
        <input type="text" id="itemsend" placeholder="To" class="form-control" style="border:1px solid lightgrey; border-radius:3%;padding: 3px;text-align: center;">
      </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="margin-left: 0%">
  <button type="button" id="itemscheckRange" class="btn btn-success">Get Report</button>
<button class="btn btn-primary"  id="itemsbtnPrintReport" type="button" style="margin-left: 2%"><span class="glyphicon glyphicon-print"></span>Print</button>
          </div>
        </div>
      </div>
    </form>
        <div class="table-responsive">
        <table class="table table-bordered" id="tblQueues">
          <caption>Registered Items:&nbsp;<span id="itemsReportHeader" class="pull-right" style="color: black;margin-right: 5%;"></caption>
          <thead>
            <tr>
              <th>#Counts</th>
              <th>Citizen </th>
              <th>Type </th>
               <th>Identifier </th>
              <th>Notify By  </th>
                   <th>Date</th>
            </tr>
          </thead>
          <tbody id="loadedqueue">
          
          </tbody>
        </table>
        </div>
      </div>
<?php
      break;
      default:
      echo "Invalid Requests";
}
}
?>
 <div aria-hidden="true" aria-labelledby="modalViewPostOffice" role="dialog" tabindex="-1" id="modalViewPostOffice" class="modal fade">
            <div class="modal-dialog" style="width:80%;">
                <div class="modal-content" style="padding-left: 20px;padding-right:20px;padding-bottom: 20px;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Post Office View Report Losts</h4>
                    </div>
                      <div class="row">
				       <div class="modal-body">
		<div class="container">
<div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <div class="card mb-3">
          <div class="card-header" style="font-size:19px;">
              <i class="fa fa-bar-chart"></i> Bar Chart For Lost Analysis</div><br><br>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-8 my-auto">
                  <canvas id="myBarChart" width="100" height="50"></canvas>
                </div>
              <div class="col-sm-4 text-center my-auto">
                  <div class="h4 mb-0 text-primary">Total</div>
                  <div class="small text-muted" id="totlostnum"></div>
                  <hr>
                  <div class="h4 mb-0 text-success" >Taken</div>
                  <div class="small text-muted" id="takenlostnum"></div>
                  <hr>
                  <div class="h4 mb-0 text-danger">Remain</div>
                  <div class="small text-muted" id="remlostnum"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- /Card Columns-->
        </div>
        <div class="col-lg-4">
          <!-- Example Pie Chart Card-->
          <div class="card mb-3">
            <div class="card-header" style="font-size:19px;">
              <i class="fa fa-pie-chart"></i> Pie Chart For Lost Type</div>
            <div class="card-body">
              <canvas id="myPieChart" width="100%" height="100"></canvas>
            </div>
          </div>
        </div>
      
      </div>
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
  
</div><!--end container-->
	</nav>	
<?php
include"includes/footer.php";
?>
</div>
</body>
<script type="text/javascript" src="bootstrap/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  $("#loststart").datepicker();
  $("#lostend").datepicker();
  $("#citstart").datepicker();
  $("#citend").datepicker();
  $("#payhiststart").datepicker();
  $("#payhistend").datepicker();
  $("#wthstart").datepicker();
  $("#wthend").datepicker();
  $("#itemsstart").datepicker();
  $("#itemsend").datepicker();
</script>
    </html>