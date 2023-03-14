<style type="text/css">
  .users{background-color:orange;}
</style>
<?php
include"includes/header.php";
?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->

      <!-- Example DataTables Card-->
       <div class="card mb-3" id="userinfo">
        <div class="card-header">
          <i class="fa fa-table"></i> List of Registered Users</div>

        <div class="card-body">
          <div class="table-responsive" style="overflow-x: none;">
            <table class="table table-bordered" id="tblUsers" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>#Count</th>
                   <th>Name</th>
                   <th>NID</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Category</th>
               <th>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                   <th>More Info</th>
                <th>Actions &nbsp;&nbsp;
            <?php if (!isset($_GET['cate'])) {?>
                <button class="btn btn-success btn-sm" id="adduserbtn"><i class="fa fa-plus"></i>Add New</button>
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
              <tbody id="loadedusers">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--Forms-->
      <div id="usermodforms">
<div class="panel card-register mx-auto mt-5" id="reguserform" style="display: none;margin-top: -1%;width:80%;margin-left: 10%">
      <div class="panel-header">
       <button class="btn btn-info btn-sm" type="button" id="regbackusrinfo"><i class="fa fa-arrow-left"></i>Back</button>
       <span style="margin-left: 5%">Register an Account</span></div>
      <div class="panel-body">
        <form>
        <p id="regUserResponse" style="font-size: 14px;"></p>
          <div class="form-group">
            <div class="form-row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
                <label for="names">Names</label>
                <input class="form-control" id="names" type="text" aria-describedby="nameHelp" placeholder="Enter Your name">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
                <label for="uname">Username</label>
                <input class="form-control" id="uname" type="text" aria-describedby="nameHelp" placeholder="Enter Username">
              </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
                <label for="email">Email</label>
                <input class="form-control" id="email" type="text" aria-describedby="nameHelp" placeholder="Enter Email">
              </div>
              
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
                <label for="phone">Phone</label>
                <input class="form-control" id="phone" type="text" aria-describedby="nameHelp" placeholder="Enter Phone Number">
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
          <label for="nid">NID</label>
                <input class="form-control" id="nid" type="text" aria-describedby="nameHelp" placeholder="Enter NID">
             
             <label for="userCate">User Category</label>
                <select class="form-control" id="userCate">
                 
                </select>
              </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
              </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
                <label for="pwd">Password</label>
                <input class="form-control" id="pwd" type="password" placeholder="Password">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
                <label for="confPwd">Confirm password</label>
                <input class="form-control" id="confPwd" type="password" placeholder="Confirm password">
              </div>
            </div>
          </div>
                <label for="address">Address</label>
                <textarea rows="2" class="form-control" style="resize: none;" id="address"></textarea>
                <br/><br/>
          <button type="button" class="btn btn-primary btn-block" id="btnadduser">
          <i class="fa fa-save"></i>
          Register</button>
        </form>
      </div>
    </div>

    <!--UPDATING USER-->
      <div class="card card-register mx-auto mt-5" id="updmoduserform" style="display: none;width: 70%;margin-left: 15%">
      <div class="card-header ">
      <button class="btn btn-info btn-sm" type="button" id="updbackusrinfo"><i class="fa fa-arrow-left"></i>Back</button>
      <span style="margin-left: 5%">Update an Account Information</span></div>
      <div class="card-body">
        <form>
        <p id="updUserResponse" style="font-size: 14px;"></p>
        <input type="hidden" name="usrid" id="usrid">
          <div class="form-group">
            <div class="form-row">
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
                <label for="updnames">Names</label>
                <input class="form-control" id="updnames" type="text" aria-describedby="nameHelp" placeholder="Enter Your name">
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
                <label for="upduname">Username</label>
                <input class="form-control" id="upduname" type="text" aria-describedby="nameHelp" placeholder="Enter Username">
              </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
                <label for="updemail">Email</label>
                <input class="form-control" id="updemail" type="text" aria-describedby="nameHelp" placeholder="Enter Email">
              </div>
              
              <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
                <label for="updphone">Phone</label>
                <input class="form-control" id="updphone" type="text" aria-describedby="nameHelp" placeholder="Enter Phone Number">
              </div>
            </div>
          </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
          <label for="nid">NID</label>
                <input class="form-control" id="updnid" type="text" aria-describedby="nameHelp" placeholder="Enter NID">
              </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs 12">
                <label for="upduserCate">User Category</label>
                <select class="form-control" id="upduserCate">
                 
                </select>
              </div>
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs 12">
                <label for="updaddress">Address</label>
                <textarea rows="2" class="form-control" style="resize: none;" id="updaddress"></textarea>
              </div>

          </div>
          <button type="button" class="btn btn-primary btn-block" id="btnupduser">
          <i class="fa fa-save"></i> Update</button><br>
        </form>
      </div>
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
      <div id="viewUserBusiness" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%;">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title" id="invoiceidentViewModalTilt">Users Business</h4>
          </div>
          <div class="modal-body">
            <p style="color:green;font-size:14px;">  </p>
            <table class="table table-bordered" id="userBusiness">
          <caption>Business Owner <span id="busowner" style="font-weight: bold;color:black"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class='pull-right'  style="margin-right:3%;"> Phone:<span id="busownerphone" style="color:black"></span></span></caption>
          <thead>
            <tr>
              <th>Count </th>
              <th>Agent Name  </th>
              <th>Business  </th>
              <th>Phone </th>
               <th>Email </th>
                <th>Restriction Date</th>
                   <th>Address</th>
              <th>Registration Date</th>
            </tr>
          </thead>
          <tbody id="loadedUsersBusiness">
          
          </tbody>
        </table>
          </div>
          <div class="modal-footer">
           <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>
            Close</button>
          </div>
        </form>
      </div>

    </div>
  </div><!--end  View Users Business Modal-->
<!--User Modal-->
<div id='modalResetUser' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="delModalTitle">Reset User <span id="resetuser"></span></h4>
                </div>
                <div class="modal-body" >
                    <p style="font-size:14px;" id="resetResponse">  </p>
                    <input type="hidden" id="resetid">
                    <label>New Password</label>
                    <input type="password" name="resetnwpassword" id="resetnwpassword" class="form-control">
                    <label>Confirm Password</label>
                    <input type="password" name="resetconfpassword" id="resetconfpassword" class="form-control">

                </div>
                <div class="modal-footer">
                    <button type="button" id="btnResetUser" class="btn btn-success" ><i class="fa fa-check"></i>
                        Reset</button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i>
                        Close</button>
                </div>
            </form>
        </div>

    </div>
</div><!--end Reset User Modal-->
    <!--Delete Modal-->
    <div id='delModal' class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
      <div class="modal-content">
        <form >
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" id="delModalTitle">Do you want to delete<span id="deluser"></span>?</h4>
          </div>
          <div class="modal-body" >
            <p style="font-size:14px;" id="delResponse">  </p>
            <input type="hidden" id="deleteid">  
      <label>Delete reason </label>
            <textarea class="form-control" id="delReason" required></textarea>

          </div>
          <div class="modal-footer">
            <button type="button" id="btnDelUser" class="btn btn-danger" ><i class="fa fa-check"></i>
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
