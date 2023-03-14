<?php
include"includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="css/dashDesigner.css"/>
<style type="text/css">
  .home{background-color:orange;}
  .notifierContainer{display: none;}
</style>
<div class="dashDesign">
  <div class="dashHeading">
<div class="dashHeader">Postoffices</div>
<div class="dashBody"> Income <span id="postincome"></span></div>
<div class="dashFooter">Balance <span id="postbalance"></span></div>
</div>
<div class="dashHeading1">
<div class="dashHeader1">Commissioners</div>
<div class="dashBody1"> Income <span id="commincome"></span></div>
<div class="dashFooter1">Balance <span id="commbalance"></span></div>
</div>
<div class="dashHeading2">
<div class="dashHeader2">Agaciro Development Fund</div>
<div class="dashBody2"> Income <span id="agaciroincome"></span></div>
<div class="dashFooter2">Balance <span id="agacirobalance"></span></div>
</div>
</div>
<br><br>
<div class="container">
<div class="row">  
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->

      
          <div class="card mb-3">
          <div class="card-header" style="font-size:19px;">
              <i class="fa fa-bar-chart"></i> Bar Chart For Lost Analysis</div><br><br>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-8 my-auto" style="width: 60%;height: 40%;">
                  <canvas id="myBarChart"></canvas>
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
            <div class="card-body" style="width: 75%;height: 50%;">
              <canvas id="myPieChart"></canvas>
            </div>
          </div>
        </div>
  <!--div id="footer" style="">
     <div style="">&copy;2017 Be Forward Generation Ltd..!
</div> 
</div-->
      </div>
<div style="">
<!-- <div style="text-align: center;color:blue ;border:1px solid blue;padding:0.3%">&copy;2017 Be Forward Generation Ltd..!
</div> -->
  <?php
  include"includes/footer.php";
  ?>

</div>
      </div>
    
</body>
 <script src="BSHelper/vendor/jquery/jquery.min.js"></script>
    <script src="BSHelper/vendor/popper/popper.min.js"></script>
    <script src="BSHelper/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="BSHelper/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="BSHelper/vendor/chart.js/Chart.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="BSHelper/js/make-charts.js"></script>
</html>