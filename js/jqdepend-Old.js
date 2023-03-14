
function ajax(url,getpars,typ,responseType,responseFunc){
$.ajax({
 url:url,type:typ,data:getpars,dataType:responseType,success:responseFunc,statuscode:{
	 404:function(){
		 alert('Response not found');
	 }
 }
 });
}

function registerUser(){
clickController("disable","#btnadduser");
	setLoaders({elem:'regUserResponse',elemtype:'container',msg:'Saving Data...'});
	ajax("ajax/users",{"cate":"register","sessid":$("#sessid").val(),"name":$("#names").val(),"uname":$("#uname").val(),"nid":$("#nid").val(),"phone":$("#phone").val(),"email":$("#email").val(),"category":$("#userCate").val(),"password":$("#pwd").val(),"address":$("#address").val()},"POST","text",function(res){
		if(res=="ok"){
			loadUser("setContent",null);
			$("#names").val("");$("#uname").val("");$("#phone").val("");$("#email").val("");$("#pwd").val("");$("#confPwd").val("");$("#address").val("");$("#nid").val("");
		$("#regUserResponse").html("<font color='green'>User Registered Success</font>");
		clickController("enable","#btnadduser");
}else{
clickController("enable","#btnadduser");
		$("#regUserResponse").html("<font color='red'>Failed to Register User</font> ");
		}
clearMsg("#regUserResponse");
	});
}
function loadUser(cate,reference){
	var data={};data.cate="load";
	if(cate=='setContent'){
	setLoaders({elem:'tblUsers',elemtype:'table',msg:'Loading Data...'});
}else if(cate=='setComboCommissioner'){
	data.cate="loadcommissioner";
}
	ajax("ajax/users",data,"GET","json",function(res){
if(res.user!=null){	
switch(cate){
	case'setContent':
	setLoadedUser(res);break;
	case 'setCombo':
	setComboUsers(res,"#userCate",reference);break;
	case 'updsetCombo':
	setComboUsers(res,"#upduserCate",reference);break;
	case'setComboCommissioner':
	setLoadedComboUsers(res,"#citbyCommissioner",reference);
	default:
	}			
}else{
	$("#loadedusers").html("");
		}
});
}
function setLoadedUser(loadeduser){
var users="";
if(loadeduser.user.length!=0){
		 for(var i=0;i<loadeduser.user.length;i++){		 
		 	var passdata={cate:'setContent',reference:loadeduser.user[i].uid,username:loadeduser.user[i].username,phone:loadeduser.user[i].phone};
         users+="<tr>"
             +"<td>"+ (parseInt(i)+1)+"</td>"
             +"<td>"+ loadeduser.user[i].names +"</td>"
             +"<td>"+ loadeduser.user[i].nid+"</td>"
             //+"<td>"+ loadeduser.user[i].username +"</td>"
              +"<td>"+ loadeduser.user[i].email+"</td>"
               +"<td>"+ loadeduser.user[i].phone+"</td>"
               +"<td>"+ loadeduser.user[i].category+"</td>"
              +"<td>"+ loadeduser.user[i].usr_regdate.substring(0,16)+"</td>"
              +"<td style='text-align:center;position:inherit;' class='infostester'><li class='dropdown' style='list-style-type:none'><a href='#'id='dropBtnTester"+i+"' class='btn btn-primary glyphicon glyphicon-full-screen dropdown-toggle' data-toggle='dropdown'>More <i class='fa fa-caret-down'></i></a>"
               +"</a>"
                 +"<ul id='dropMenus"+i+"' class='dropdown-menu text-white' role='menu' aria-labelledby='dropBtn"+i+"'>"
              +"<li><div class='umoreInfo' style='padding-left:5px;padding-right:5px;'> Username:"+loadeduser.user[i].username+"<br>Registered:"+loadeduser.user[i].usr_registered+(loadeduser.user[i].usr_registered==0?" Person":" People")+" <br> Balance:"+(loadeduser.user[i].usr_amount!=null?loadeduser.user[i].usr_amount:0)+" RWF <br> Paid:"+loadeduser.user[i].paid_amount+" RWF<br> Remain:"+loadeduser.user[i].usr_remain_amount+" RWF<br> Address:"+loadeduser.user[i].address+"</div></li>"
              +"</div></ul></li></td>"
              +"<td style='text-align:center;position:inherit;' class='cflmore'><li class='dropdown' style='list-style-type:none'><a href='#'id='dropBtn"+i+"' class='btn btn-info glyphicon glyphicon-full-screen dropdown-toggle' data-toggle='dropdown'>Action <i class='fa fa-caret-down'></i></a>"
               +"</a>"
                 +"<ul id='dropMenus"+i+"' class='dropdown-menu text-white' role='menu' aria-labelledby='dropBtn"+i+"'>"
               /* +"<td style='text-align:center;'><a href='#' onclick='loadUserById(\"reset\","+loadeduser.user[i].uid+")' class='btn btn-primary reset' data-toggle='modal' data-target='#modalResetUser'><i class='fa fa-lock'></i> Reset</a> &nbsp;&nbsp;"
             +"<a href='#'  onclick='loadUserById(\"edit\","+loadeduser.user[i].uid+")'  class='btn btn-warning edituser glyphicon glyphicon-pencil'>Edit</a>"
              +"&nbsp;&nbsp;&nbsp;<a href='#' onclick='loadUserById(\"delete\","+loadeduser.user[i].uid+")' class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal' >Delete</a>"
                +"</a></td>"
               */
              +"<li><a href='#' onclick='loadUserById(\"reset\","+loadeduser.user[i].uid+")' class='btn btn-primary reset' data-toggle='modal' data-target='#modalResetUser'><i class='fa fa-lock'></i> Reset</a></li>"
              +"<li><a href='#'  onclick='loadUserById(\"edit\","+loadeduser.user[i].uid+")'  class='btn btn-warning edituser glyphicon glyphicon-pencil'>Edit</a></li>"
              +"<li><a href='#' onclick='loadUserById(\"delete\","+loadeduser.user[i].uid+")' class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal' >Delete</a></li>"
              +"</div></ul></li></td>"
            +"</tr>";
			}
		}else{
		 users+="<tr>"
             +"<td colspan='10'><center>No Users Found</center></td></tr>"
              }
			$("#loadedusers").html(users);
      jslive.pagingTable({id:'#tblUsers',shows:25,active:0});
	}
	function setComboUsers(obj,elem,reference) {
		var selreps="";
		selreps="<option>Select Category</option>";
		for (var i=0;i<obj.user.length;i++) {
			if (elem=="#upduserCate") {
				if (obj.user[i].uid==reference) {//selected current representer
selreps+="<option value="+obj.user[i].uid+" selected>"+obj.user[i].name+"</option>";
} else if (obj.user[i].name==null) {//for one who has doesnt represent site
selreps+="<option value="+obj.user[i].uid+">"+obj.user[i].name+"</option>";
}
}else{//for new site registration assign representer
		if (elem=="#userCate" && obj.user[i].name==reference) {
selreps+="<option value="+obj.user[i].uid+">"+obj.user[i].name+"</option>";
}
//for Selection of Lab Technician Only
if (elem=="#labtechid") {
selreps+="<option value="+obj.user[i].uid+">"+obj.user[i].name+"</option>";
}
}
}//end loop
	$(elem).html(selreps);
}
function setLoadedComboUsers(obj,elem,reference){
var data=null;
if(reference==null){
  data="<option value='default'>Select Commissioner</option>";
  data+="<option value='0'>None</option>";
for(var i=0;i<obj.user.length;i++){
data+="<option value='"+obj.user[i].uid+"'>"+obj.user[i].names+"</option>"
}
}else{
for(var i=0;i<obj.user.length;i++){
if(obj.user[i].id==reference){
data+="<option value='"+obj.user[i].uid+"'>"+obj.user[i].names+"</option>"
}else{
data+="<option value='"+obj.user[i].uid+"'>"+obj.user[i].names+"</option>"
}
} 
}
$(elem).html(data);
}
function loadUserById(cate,id){
	ajax("ajax/users",{"cate":"loadbyid","id":id},"GET","json",function(res){
        if(cate=='profile'){
            $("#resetid").val(res.user[0].uid);
            $("#profUname").html(res.user[0].username);
            $("#profEmail").html(res.user[0].email);
            $("#profPhone").html(res.user[0].phone);
            $("#profCategory").html(res.user[0].cate_name);
            $("#profAddress").html(res.user[0].address);
        }
        if(cate=='reset'){
            $("#resetid").val(res.user[0].uid);
            $("#resetuser").html(res.user[0].names);
        }
	if(cate=='edit'){
		setEditUser(res);
	$("#userinfo").hide();
	$("#breadcrumb").hide();
	$("#updmoduserform").show();
	}
	if(cate=='delete'){
		setDeleteUser(res);
	}
	});
}
function setEditUser(data){
	$("#usrid").val(data.user[0].uid);
	$("#updnames").val(data.user[0].names);
	$("#upduname").val(data.user[0].username);
	$("#updphone").val(data.user[0].phone);
	$("#updemail").val(data.user[0].email);
	$("#updaddress").val(data.user[0].address);
	$("#updnid").val(data.user[0].nid);
//var userCateDOM=document.getElementById('upduserCate').getElementsByTagName('option');
loadCategory("updsetCombo",data.user[0].cate_id);
}
function setDeleteUser(data){
	$("#deleteid").val(data.user[0].uid);
	$("#deluser").html("&nbsp;&nbsp;"+data.user[0].username);
}
function searchUser(){
	ajax("ajax/users",{"cate":"search","key":$("#keyUser").val()},"GET","json",function(res){
if(res.users.length!=0){
	setLoadedUser(res);
	}else{
		$("#loadedusers").html("");
	}
	});
}
function updateUser(){
clickController("disable","#btnupduser");
	setLoaders({elem:'updUserResponse',elemtype:'container',msg:'Updating Data...'});
	ajax("ajax/users",{"cate":"update","id":$("#usrid").val(),"sessid":$("#sessid").val(),"name":$("#updnames").val(),"uname":$("#upduname").val(),"nid":$("#updnid").val(),"phone":$("#updphone").val(),"email":$("#updemail").val(),"category":$("#upduserCate").val(),"address":$("#updaddress").val()},"POST","text",function(res){
		if(res=="ok"){
			loadUser("setContent",null);
			$("#updUserResponse").html("<font color='green'>User Updated Success</font>");
		}else{
clickController("enable","#btnupduser");
		$("#updUserResponse").html("<font color='red'>Failed to Update User</font> ");
		}
clearMsg("#updUserResponse");
	});
}
function resetUserPassword(){
    ajax("ajax/users",{"cate":"reset","sessid":$("#sessid").val(),"usercate":$("#usercate").val(),"id":$("#resetid").val(),"password":$("#resetnwpassword").val()},"POST","text",function(res){
        if(res=="ok"){
            loadUser("setContent",null);
            $("#resetResponse").html("<font color='green'>User Resetted Success Password</font>");
        }else{
            $("#resetResponse").html("<font color='red'>Failed to User Business Password</font>");
        }
        clearMsg("#resetResponse");
    });
}
function deleteUser(){
	ajax("ajax/users",{"cate":"delete","sessid":$("#sessid").val(),"usercate":$("#usercate").val(),"id":$("#deleteid").val(),"reason":$("#delReason").val()},"POST","text",function(res){				
	//alert(res);
	if(res=="ok"){
		loadUser("setContent");
		$("#delResponse").html("<font color='green'>User Removed Success</font>");
		}else{
		$("#delResponse").html("<font color='red'>Failed to Remove User</font>");
		}
clearMsg("#delResponse");
	});
}	
function loadProfile(){
	ajax("ajax/users",{"cate":"loadbyid","id":document.getElementById('sessid').value},"GET","json",function(res){
if (res.user.length!=0) {
	$("#profUname").html(res.user[0].names);
	$("#profEmail").html(res.user[0].email);
	$("#profPhone").html(res.user[0].phone);
	$("#profCategory").html(res.user[0].category);
	$("#profAddress").html(res.user[0].address);
	//document.getElementById('loadProfile').setAttribute('src',res.user[0].pic_name!==null?'attaches/'+res.user[0].pic_name:'webuse/profile6.png');
//document.getElementById('profile').setAttribute('src',res.user[0].pic_name!==null?'attaches/'+res.user[0].pic_name:'webuse/profile6.png');
}
	});
}
function loadCategory(cate,reference){
  if(cate=='setContent'){
  setLoaders({elem:'tblCategory',elemtype:'table',msg:'Loading Data...'});
}
  ajax("ajax/categories",{"cate":"load"},"GET","json",function(res){
if(res.categories!=null){ 
switch(cate){
  case'setContent':
  setLoadedCategory(res);break;
  case 'setCombo':
  setComboCategories(res,"#userCate",reference);break;
  case 'updsetCombo':
  setComboCategories(res,"#upduserCate",reference);break;
  default:
  }     
}
});
}
function setLoadedCategory(loadedcategory){
var category="";
if(loadedcategory.categories.length!=0){
     for(var i=0;i<loadedcategory.categories.length;i++){      
         category+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ loadedcategory.categories[i].usrt_name +"</td>"
              +"<td>"+ loadedcategory.categories[i].regdate.substring(0,16)+"</td>"
           //   +"<td class='loadedcategorymodif' style='text-align:center;'><a href='#'  onclick='loadCategoryById(\"edit\","+loadedcategory.categories[i].cate_id+")' class='btn btn-warning edit glyphicon glyphicon-pencil' data-toggle=\'modal\' data-target='#updateCateModal'>Edit</a>"
            //  +"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' onclick='loadCategoryById(\"delete\","+loadedcategory.categories[i].cate_id+")' class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal' >Delete</a>"
              //  +"</a></td>"
            +"</tr>";
      }
    }else{
     category+="<tr>"
             +"<td colspan='5'><center>No Category Found</center></td></tr>"
              }
$("#loadedcategories").html(category);
      jslive.pagingTable({id:'#tblCategory',shows:25,active:0});
  }
function setComboCategories(obj,elem,reference) {
    var selreps="";
    selreps="<option>Select Category</option>";
    for (var i=0;i<obj.categories.length;i++) {
        if (obj.categories[i].usrt_id==reference) {//selected current representer
selreps+="<option value="+obj.categories[i].usrt_id+" selected>"+obj.categories[i].usrt_name+"</option>";
} else{//for one who has doesnt represent site
selreps+="<option value="+obj.categories[i].usrt_id+">"+obj.categories[i].usrt_name+"</option>";
}
}//end loop
  $(elem).html(selreps);
}
function registerPostOffices(){
clickController("disable","#btnSavePostOffice");
	setLoaders({elem:'regPostOfficeResponse',elemtype:'container',msg:'Saving Data...'});
	ajax("ajax/postoffices",{"cate":"register",sessid:$("#sessid").val(),"name":$("#postName").val(),"representative":$("#representativeName").val(),"phone":$("#postPhone").val(),"password":$("#postPassword").val(),"provid":$("#province").val(),"district":$("#district").val(),"sector":$("#sector").val(),"cell":$("#postCell").val(),"address":$("#place").val()},"GET","text",function(res){
		if(res=="ok"){
clickController("enable","#btnSavePostOffice");
			$("#postName").val("");$("#representativeName").val("");$("#postPhone").val("");$("#postPassword").val("");$("#sector").val("");$("#postCell").val("");$("#place").val("");
		loadPostOffices("setContent");loadRepresentative('setCombo',null);
		$("#regPostOfficeResponse").html("<font color='green'>PostOffice Registered Success</font>");
		}else{
clickController("enable","#btnSavePostOffice");
		$("#regPostOfficeResponse").html("<font color='red'>Failed to Register PostOffice</font>");
		}
clearMsg("#regPostOfficeResponse");
	});
}
function loadPostOffices(cate){
		if(cate=='setContent'){
	setLoaders({elem:'tblPostoffices',elemtype:'table',msg:'Loading Data...'});
	}
	ajax("ajax/postoffices",{"cate":"load"},"GET","json",function(res){
if (res!=null) {	
	switch(cate){
			case'setContent':
			setLoadedPostOffice(res);break;
			case 'setCombo':
			setLoadedComboPost(res,"#byPostoffice");
		}
		}
		});
	}
	function setLoadedComboPost(obj,elem) {
	var post="";
	post+="<option>All Post Offices</option>";
	for (var i=0;i<obj.length;i++) {
		post+="<option value="+obj[i].postoff_id+">"+obj[i].name+"</option>";
	}	
	$(elem).html(post);
	}
	function loadLostsByPostOffice(id) {
		setLoaders({elem:'tblByPostoffices',elemtype:'table',msg:'Loading Data...'});
		ajax("ajax/losts",{"cate":"loadbypostoffice","id":id},"GET","json",function(res){
			$("#postnametitl").html("");
			$("#loadedlostsbypostoffice").html("");
		if (res.losts.length!=0) {
		setLoadedLostsByPostOffice(res);
}else {
		$("#postnametitl").html("Sorry No Losts Found for That Post");
		$("#loadedlostsbypostoffice").html("");
	}		
		});
	}
	function setLoadedLostsByPostOffice(obj) {
var postoffice="";
		 for(var i=0;i<obj.losts.length;i++){		 
         postoffice+="<tr>"
             +"<td>"+ obj.losts[i].owner +"</td>"
			  +"<td>"+ obj.losts[i].doctype +"</td>"
			  +"<td>"+ obj.losts[i].identifier +"</td>"
			+"<td>"+ obj.losts[i].regdate+"</td>"
            +"</tr>";
			}
			$("#postnametitl").html(obj.losts[0].name);
$("#loadedlostsbypostoffice").html("");
			$("#loadedlostsbypostoffice").append(postoffice);
			jslive.pagingTable({id:'#tblPostoffices',shows:25,active:0});
		
	}
function setLoadedPostOffice(loadedpostoffice){
 var postoffice="";
		 for(var i=0;i<loadedpostoffice.length;i++){		
		 var repCont="";
		 repCont=loadedpostoffice[i].repstatus=='1'?loadedpostoffice[i].representer +"<br><font color='red'>&nbsp;&nbsp;Deleted</font>":
		 loadedpostoffice[i].representer;
         postoffice+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ loadedpostoffice[i].name +"</td>"
          		+"<td>"+repCont+"</td>"
              +"<td>"+ loadedpostoffice[i].phone +"</td>"
			  +"<td>"+ loadedpostoffice[i].province_name +"</td>"
			  +"<td>"+ loadedpostoffice[i].district_name +"</td>"
			 +"<td>"+ loadedpostoffice[i].sector_name +"</td>"
			 +"<td>"+ loadedpostoffice[i].cell +"</td>"
			+"<td>"+ loadedpostoffice[i].regdate+"</td>"
           +"<td style='text-align:center;position:inherit;' class='infostester'><li class='dropdown' style='list-style-type:none'><a href='#'id='dropBtnTester"+i+"' class='btn btn-primary glyphicon glyphicon-full-screen dropdown-toggle' data-toggle='dropdown'>More <i class='fa fa-caret-down'></i></a>"
               +"</a>"
                 +"<ul id='dropMenus"+i+"' class='dropdown-menu text-white' role='menu' aria-labelledby='dropBtn"+i+"'>"
              +"<li><div class='umoreInfo' style='padding-left:5px;padding-right:5px;'> Balance:"+(loadedpostoffice[i].usr_amount!=null?loadedpostoffice[i].usr_amount:0)+" RWF <br> Paid:"+loadedpostoffice[i].paid_amount+" RWF<br> Remain:"+loadedpostoffice[i].usr_remain_amount+" RWF<br> Address:"+loadedpostoffice[i].address+"</div></li>"
              +"</div></ul></li></td>"
            +"<td style='text-align:center;position:inherit;' class='cflmore'><li class='dropdown' style='list-style-type:none'><a href='#'id='dropBtn"+i+"' class='btn btn-info glyphicon glyphicon-full-screen dropdown-toggle' data-toggle='dropdown'>Actions <i class='fa fa-caret-down'></i></a>"
               +"</a>"
                 +"<ul id='dropMenus"+i+"' class='dropdown-menu text-white' role='menu' aria-labelledby='dropBtn"+i+"'>"
               /* +"<td class='loadedpostmodif' style='text-align:center;'><a href='#' onclick='loadPostOfficesById(\"view\","+loadedpostoffice[i].postoff_id+")' class='btn btn-success view glyphicon' data-toggle='modal' data-target='#modalViewPostOffice' "+(loadedpostoffice[i].totlosts==0?'disabled':'')+">"+loadedpostoffice[i].totlosts+"&nbsp;View</a>"
              +"&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' onclick='loadPostOfficesById(\"edit\","+loadedpostoffice[i].postoff_id+")' class='btn btn-warning edit glyphicon glyphicon-pencil' data-toggle='modal' data-target='#modalUpdatePostOffice'>Edit</a>"
              +"&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' onclick='loadPostOfficesById(\"delete\","+loadedpostoffice[i].postoff_id+")' class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal' >Delete</a>"
                +"</a></td>"
               */
              +"<li><a href='#' onclick='loadPostOfficesById(\"view\","+loadedpostoffice[i].postoff_id+")' class='btn btn-success view glyphicon' data-toggle='modal' data-target='#modalViewPostOffice' "+(loadedpostoffice[i].totlosts==0?'disabled':'')+">"+loadedpostoffice[i].totlosts+"&nbsp;View</a></li>"
              +"<li><a href='#' onclick='loadPostOfficesById(\"edit\","+loadedpostoffice[i].postoff_id+")' class='btn btn-warning edit glyphicon glyphicon-pencil' data-toggle='modal' data-target='#modalUpdatePostOffice'>Edit</a></li>"
              +"<li><a href='#' onclick='loadPostOfficesById(\"delete\","+loadedpostoffice[i].postoff_id+")' class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal' >Delete</a></li>"
              +"</div></ul></li></td>"
            +"</tr>";
            +"</tr>";
			}
$("#loadedPostOffice").html("");
			$("#loadedPostOffice").append(postoffice);
			jslive.pagingTable({id:'#tblPostoffices',shows:25,active:0});
	}
function setCombLoadedPost(loadedpostoffice){
	var postoffice="";
		 for(var i=0;i<loadedpostoffice.length;i++){		 
         postoffice+="<option value='"+loadedpostoffice[i].postoff_id+"'>"+ loadedpostoffice[i].name +"</option>"
		 }
	
		 $("#combPostStock").html("");
		 $("#combPostStock").append(postoffice);
}
function setComboProv(elem){
	ajax("ajax/geoloc",{cate:"loadprovince"},"GET","json",function(res){
		setCombOptions(res,elem);
});
}
function setComboDist(elemval,elem){
	ajax("ajax/geoloc",{cate:"loaddistrictsbyprov",id:$(elemval).val()},"GET","json",function(res){
		setCombOptions(res,elem);
})
}
function setComboSec(elemval,elem){
	ajax("ajax/geoloc",{cate:"loadsectorsbydist",id:$(elemval).val()},"GET","json",function(res){
		setCombOptions(res,elem);
});
}

function setCombOptions(loaded,elem){
	var data="";
		 for(var i in loaded){
		data+="<option value='"+loaded[i]["id"]+"'>"+loaded[i]["displayer"]+"</option>"
		 	 }
		 $(elem).html("");
		 $(elem).html(data);
		 $(elem).prepend("<option selected>Select</option>");
}
function loadPostOfficesById(cate,id){
	ajax("ajax/postoffices",{"cate":"loadbyid","id":id},"GET","json",function(res){
	if(cate=='view'){
		loadLostsByPostOffice(id);
	}
	if(cate=='edit'){
		setEditPostOffice(res);
		loadRepresentative("updsetCombo",res.postoffice[0].representative);
	}
	if(cate=='delete'){
		setDeletePostOffice(res.postoffice);
	}
	});
}
function setEditPostOffice(data){
	$("#postid").val(data.postoffice[0].postoff_id);
	$("#updpostName").val(data.postoffice[0].name);
	$("#updrepresentativeName").val(data.postoffice[0].representative);
	loadRepresentative("setCombo",data.postoffice[0].representative);
	$("#updpostPhone").val(data.postoffice[0].phone);
setEditGeoLoc(data);
	$("#updpostCell").val(data.postoffice[0].cell);
	$("#updaddress").val(data.postoffice[0].address);
	$("#updunitymeasure").val(data.postoffice[0].unit);
}
function setEditGeoLoc(data){
	ajax("ajax/geoloc",{cate:"loadprovince"},"GET","json",function(res){
	var prov="";
	for(var i=0;i<res.length;i++){
		if(res[i].id==data.postoffice[0].prov_id){
	prov+="<option value='"+res[i].id+"' selected>"+res[i].displayer+"</option>";
	}else{
	prov+="<option value='"+res[i].id+"'>"+res[i].displayer+"</option>";
	}
	}
	$("#updprovince").html(prov);
});
ajax("ajax/geoloc",{cate:"loaddistrictsbyprov",id:data.postoffice[0].prov_id},"GET","json",function(res){
	var dist="";
	for(var i=0;i<res.length;i++){
		if(res[i].id==data.postoffice[0].distr_id){
	dist+="<option value='"+res[i].id+"' selected>"+res[i].displayer+"</option>";
	}else{
	dist+="<option value='"+res[i].id+"'>"+res[i].displayer+"</option>";
	}
	}
	$("#upddistrict").html(dist);
});
ajax("ajax/geoloc",{cate:"loadsectorsbydist",id:data.postoffice[0].distr_id},"GET","json",function(res){
	var sec="";
	for(var i=0;i<res.length;i++){
		if(res[i].id==data.postoffice[0].sector){
	sec+="<option value='"+res[i].id+"' selected>"+res[i].displayer+"</option>";
	}else{
	sec+="<option value='"+res[i].id+"'>"+res[i].displayer+"</option>";
	}
	}
	$("#updsector").html(sec);
});

}

function loadQueues(cate){
	ajax("ajax/queue",{"cate":"load"},"GET","json",function(res){
if (res!=null) {	
	switch(cate){
			case'setContent':
			setLoadedQueues(res);break;
		}
		}
		});
	}
	function searckQueues(cate){
	ajax("ajax/queue",{"cate":"search","key":$("#keyQueue").val()},"GET","json",function(res){
if (res!=null) {	
	switch(cate){
			case'setContent':
			setLoadedQueues(res);break;
		}
		}
		});
	}
	function setLoadedQueues(obj) {
		var queue="";
		for (var i=0;i<obj.queues.length;i++) {
	queue+="<tr><td>"+(obj.queues[i].cit_names!=null?obj.queues[i].cit_names:obj.queues[i].name)+"</td>"
			 +"<td>"+obj.queues[i].doctype+"</td>"
			 +"<td>"+obj.queues[i].queue_identifier+"</td>"
			 +"<td>"+obj.queues[i].address+"</td>"
			 +"<td>"+obj.queues[i].regdate+"</td></tr>"
			 		
		}
		$("#loadedQueue").html(queue);
		jslive.pagingTable({id:'#tblQueues',shows:25,active:0});
	}

function loadCitizens(cate,reference){
	var data={};data.cate="load";
  if(cate=='setContent'){
    setLoaders({elem:'tblCitizen',elemtype:'table',msg:'Loading Data...'});
    }else if(cate=='setReport'){
  	if($("#citstart").val()!="" && $("#citend").val()!=""){
  		data.start=$("#citstart").val();
  		data.end=$("#citend").val();
  	}
  	if($("#citbyCommissioner").val()!="default"){
  		data.commid=$("#citbyCommissioner").val();
  	}
  	if($("#citbyStatus").val()!="default"){
  		data.paid=$("#citbyStatus").val();
  	}
  }
  ajax("ajax/citizens",data,"GET","json",function(res){
if(res.citizens!=null){ 
switch(cate){
  case'setContent':
  case'setReport':
  setLoadedCitizen(res);break;
default:
  }     
}else{
  $("#loadedCitizens").html("");
    }
})
   if(cate=='setContent'){  jslive.pagingTable({id:'#tblCitizen',shows:25,active:0});}

}
function setLoadedCitizen(obj){
var cits="";
     for(var i=0;i<obj.citizens.length;i++){  
         cits+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ obj.citizens[i].cit_names +"</td>"
              +"<td>"+ obj.citizens[i].cit_nid+"</td>"
               +"<td>"+ obj.citizens[i].cit_phone+"</td>"
               +"<td>"+ (obj.citizens[i].names!=null?obj.citizens[i].names:'None')+"</td>"
               +"<td>"+(obj.citizens[i].reg_amount==0?'No':'Yes')+"</td>"
                +"<td>"+ obj.citizens[i].regdate+"</td>"
              +"<td class='loadedcitmodif' style='text-align:center;'><a href='#' onclick='loadQueuesByCitizens(\"queues\","+obj.citizens[i].cit_id+")' class='btn btn-info edit fa fa-eye' data-toggle='modal' data-target='#modalViewQueue' "+(obj.citizens[i].total_items==0?'disabled':'')+"> "+obj.citizens[i].total_items+" Items</a></td>"
              +"</a></td>"
            +"</tr>";
      }
$("#loadedCitizens").html("");
      $("#loadedCitizens").append(cits);
     }
function loadQueuesByCitizens(cate,id){
  if(cate=='queues'){
    setLoaders({elem:'tblByQueues',elemtype:'table',msg:'Loading Data...'})
  }
  ajax("ajax/queue",{"cate":"load",citid:id},"GET","json",function(res){
if(res.queues.length!=0){ 
switch(cate){
  case'queues':
  setLoadedCitizenQueues(res);break;
  default:
  }     
}else{
  $("#loadedqueuebycitizen").html("");
    }
})
}
function loadQueues(cate,id){
	var data={};data.cate='load';
  if(cate=='setContent' || cate=='setReport'){
    setLoaders({elem:'tblQueues',elemtype:'table',msg:'Loading Data...'})
  }
  if(cate=='setReport'){
if($("#itemsstart").val()!='' && $("#itemsend").val()!=''){
data.start=$("#itemsstart").val();
data.end=$("#itemsend").val();
}
  }
  ajax("ajax/queue",data,"GET","json",function(res){
if(res.queues.length!=0){ 
switch(cate){
  case'setContent':
  case'setReport':
  setLoadedQueues(res);break;
  default:
  }     
}else{
  $("#loadedqueue").html("<tr><td colspan='6'><center>No Items Found</center></td></tr>");
    }
})
}
function setLoadedQueues(obj){
var cits="";
     for(var i=0;i<obj.queues.length;i++){   
         cits+="<tr>"
             +"<td>"+(i+1)+"</td>"
             +"<td>"+ obj.queues[i].cit_names+"</td>"
             +"<td>"+ obj.queues[i].doctype +"</td>"
              +"<td>"+ obj.queues[i].queue_identifier+"</td>"
               +"<td>"+ obj.queues[i].notification_receive.toUpperCase()+"</td>"
                +"<td>"+ obj.queues[i].regdate.substring(0,10)+"</td>"
             +"</tr>";
      }
$("#loadedqueue").html(cits);
  }
function setLoadedCitizenQueues(obj){
var cits="";
$("#citnametitl").html(obj.queues[0].cit_names);
     for(var i=0;i<obj.queues.length;i++){  
if(obj.queues[i].cit_names!=null){    
         cits+="<tr>"
             +"<td>"+(i+1)+"</td>"
             +"<td>"+ obj.queues[i].doctype +"</td>"
              +"<td>"+ obj.queues[i].queue_identifier+"</td>"
               +"<td>"+ obj.queues[i].notification_receive.toUpperCase()+"</td>"
                +"<td>"+ obj.queues[i].regdate.substring(0,10)+"</td>"
             +"</tr>";
      }
      }
$("#loadedqueuebycitizen").html("");
      $("#loadedqueuebycitizen").append(cits);
      jslive.pagingTable({id:'#tblByQueues',shows:25,active:0});
  }

function registerRepresentative(){
clickController("disable","#btnSaveRep");
	setLoaders({elem:'regRepResponse',elemtype:'container',msg:'Saving Data...'});
	ajax("ajax/representatives",{"cate":"register",sessid:$("#sessid").val(),"name":$("#repname").val(),"phone":$("#repphone").val(),"email":$("#repemail").val()},"GET","text",function(res){
		if(res=="ok"){
clickController("enable","#btnSaveRep");
			loadRepresentative("setContent",null);
			$("#repname").val("");$("#repphone").val("");$("#repemail").val("");
		$("#regRepResponse").html("<font color='green'>Representative Registered Success</font>");
		}else{
clickController("enable","#btnSaveRep");
		$("#regRepResponse").html("<font color='red'>Failed to Register Representative</font> ");
		}
clearMsg("#regRepResponse");
	});
}
function loadRepresentative(cate,reference){
	if(cate=='setContent'){
		setLoaders({elem:'tblRepresentative',elemtype:'table',msg:'Loading Data...'})
	}
	ajax("ajax/representatives",{"cate":"load"},"GET","json",function(res){
if(res.representative!=null){	
switch(cate){
	case'setContent':
	setLoadedRepresentative(res);break;
	case 'setCombo':
	setComboReps(res,"#representativeName",reference);break;
	case 'updsetCombo':
	setComboReps(res,"#updrepresentativeName",reference);break;
	default:
	}			
}else{
	$("#loadedreps").html("");
		}
})
}
function setLoadedRepresentative(loadedrep){
var reps="";

		 for(var i=0;i<loadedrep.representative.length;i++){	
if(loadedrep.representative[i].rep_name!=null){		 
         reps+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ loadedrep.representative[i].rep_name +"</td>"
              +"<td>"+ loadedrep.representative[i].rep_phone+"</td>"
               +"<td>"+ loadedrep.representative[i].rep_email+"</td>"
                +"<td>"+ loadedrep.representative[i].regdate+"</td>"
              +"<td class='loadedrepmodif' style='text-align:center;'><a href='#' onclick='loadRepresentativeById(\"edit\","+loadedrep.representative[i].rep_id+")' class='btn btn-warning edit glyphicon glyphicon-pencil' data-toggle='modal' data-target='#updateRepModal'>Edit</a>"
              +"&nbsp;&nbsp;&nbsp;<a href='#' onclick='loadRepresentativeById(\"delete\","+loadedrep.representative[i].rep_id+")' class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal' >Delete</a>"
                +"</a></td>"
            +"</tr>";
			}
			}
$("#loadedreps").html("");
			$("#loadedreps").append(reps);
			jslive.pagingTable({id:'#tblRepresentative',shows:25,active:0});
	}
	function setComboReps(obj,elem,reference) {
		var selreps="";
		selreps="<option>Select Representative</option>";
		for (var i=0;i<obj.representative.length;i++) {
			if (elem=="#updrepresentativeName") {
				if (obj.representative[i].rep_id==reference) {//selected current representer
selreps+="<option value="+obj.representative[i].rep_id+" selected>"+obj.representative[i].rep_name+"</option>";
} else if (obj.representative[i].name==null) {//for one who has doesnt represent post
selreps+="<option value="+obj.representative[i].rep_id+">"+obj.representative[i].rep_name+"</option>";
}
}else{//for new post registration assign representer
		if (elem=="#representativeName" && obj.representative[i].name==reference) {
selreps+="<option value="+obj.representative[i].rep_id+">"+obj.representative[i].rep_name+"</option>";
}
}
}//end loop
	$(elem).html(selreps);
}
function loadRepresentativeById(cate,id){
	ajax("ajax/representatives",{"cate":"loadbyid","id":id},"GET","json",function(res){
	if(cate=='edit'){
		setEditRepresentative(res);
	}
	if(cate=='delete'){
		setDeleteRepresentative(res);
	}
	});
}
function setEditRepresentative(data){
	$("#repid").val(data.representative[0].rep_id);
	$("#updrepname").val(data.representative[0].rep_name);
	$("#updrepphone").val(data.representative[0].rep_phone);
	$("#updrepemail").val(data.representative[0].rep_email);
}
function setDeleteRepresentative(data){
	$("#repdeleteid").val(data.representative[0].rep_id);
	$("#repdelModalTitle").html("");
	$("#repdelModalTitle").html("Dou want to Delete "+data.representative[0].rep_name+"?");
}
function searchRepresentative(){
	ajax("ajax/representatives",{"cate":"search","key":$("#keyRep").val()},"GET","json",function(res){
if(res.types!=null){
	setLoadedRepresentative(res);
	}else{
		$("#loadedreps").html("");
	}
	});
}
function updateRepresentative(){
	setLoaders({elem:'updateRepResponse',elemtype:'container',msg:'Updating Data...'});
ajax("ajax/representatives",{"cate":"update","id":$("#repid").val(),"name":$("#updrepname").val(),"phone":$("#updrepphone").val(),"email":$("#updrepemail").val()},"GET","text",function(res){
		if(res=="ok"){
			loadRepresentative("setContent");
			$("#updateRepResponse").html("<font color='green'>Representer Updated Success</font>");
		}else{
		$("#updateRepResponse").html("<font color='red'>Failed to Update Representer</font>");
		}
clearMsg("#updateRepResponse");
	});
}
function deleteRepresentative(){
	ajax("ajax/representatives",{"cate":"delete","id":$("#repdeleteid").val(),"reason":$("#repdelReason").val()},"GET","text",function(res){				
	//alert(res);
	if(res=="ok"){
		loadRepresentative("setContent");
		$("#repdelResponse").html("<font color='green'>Representatives Removed Success</font>");
		}else{
		$("#repdelResponse").html("<font color='red'>Failed to Remove Representatives</font>");
		}
clearMsg("#repdelResponse");
	});
}	

function setEditRepresenter(data){
	ajax("ajax/representatives",{cate:"load"},"GET","json",function(res){
	var reps="";
	for(var i=0;i<res.length;i++){
		if(res.representative[i].rep_id==data.postoffice[0].prov_id){
	reps+="<option value='"+res.representative[i].rep_id+"' selected>"+res.representative[i].rep_name+"</option>";
	}else{
	reps+="<option value='"+res.representative[i].rep_id+"'>"+res.representative[i].rep_name+"</option>";
	}
	}
	$("#updrepresentativeName").html(reps);
});
}

function setDeletePostOffice(data){
	$("#deletepostid").val(data[0].postoff_id);
	$("#delModalTitle").html("Do you want to delete "+data[0].name+"?");
}
function searchPostOffices(){
	ajax("ajax/postoffices",{"cate":"search","key":$("#keyPostOffice").val()},"GET","json",function(res){
if (res!=null) {
setLoadedPostOffice(res);
}else{
$("#loadedPostOffice").html("");
}
	});
}
function updatePostOffices(){
 // alert("Update ID:"++"=>Name:"+$("#updpostName").val()+"=>Phone:"+$("#updpostPhone").val()+"=>Province:"+$("#updprovince").val()+"District:"+$("#upddistrict").val()+"=>Sector:"+$("#updsector").val()+"=>Cell:"+$("#updpostCell").val()+"=>Address:"+$("#updaddress").val());
setLoaders({elem:'updPostOfficeResponse',elemtype:'container',msg:'Updating Data...'});
ajax("ajax/postoffices",{"cate":"update","id":$("#postid").val(),"name":$("#updpostName").val(),"representative":$("#updrepresentativeName").val(),"phone":$("#updpostPhone").val(),"provid":$("#updprovince").val(),"district":$("#upddistrict").val(),"sector":$("#updsector").val(),"cell":$("#updpostCell").val(),"address":$("#updaddress").val()},"GET","text",function(res){
		if(res=="ok"){
			loadPostOffices("setContent");
		$("#updPostOfficeResponse").html("<font color='green'>PostOffice Updated Success</font>");
		}else{
		$("#updPostOfficeResponse").html("<font color='red'>Failed to Update PostOffice</font>");
		}
clearMsg("#updPostOfficeResponse");
	});

}
function deletePostOffices(){
	ajax("ajax/postoffices",{"cate":"delete","id":$("#deletepostid").val(),"reason":$("#delPostReason").val()},"GET","text",function(res){		
		if(res=="ok"){
		loadPostOffices("setContent");
		$("#delResponse").html("<font color='green'>PostOffice Deleted Success</font>");
		$("#delPostReason").val("");
		}else{
		$("#delResponse").html("<font color='red'>Failed to Delete PostOffice</font>");
		}
clearMsg("#delResponse");
	});
}
function registerTypes(){
clickController("disable","#btnSaveType");
	setLoaders({elem:'regTypeResponse',elemtype:'container',msg:'Saving Data...'});
	ajax("ajax/types",{"cate":"register",sessid:$("#sessid").val(),"doctype":$("#type").val(),"max":$("#maxItem").val()},"GET","text",function(res){
		if(res=="ok"){
clickController("enable","#btnSaveType");
			loadTypes("setContent");
			$("#type").val("");$("maxItem").val("");
		$("#regTypeResponse").html("<font color='green'>Item Type Registered Success</font>");
		}else{
clickController("enable","#btnSaveType");
		$("#regTypeResponse").html("<font color='red'>Failed to Register Item Type</font> ");
		}
clearMsg("#regTypeResponse");
	});
}
function loadTypes(cate){
	if(cate=='setContent'){
	setLoaders({elem:'tblTypes',elemtype:'table',msg:'Loading Data...'});
}
	ajax("ajax/types",{"cate":"load"},"GET","json",function(res){
if(res.types!=null){	
switch(cate){
	case'setContent':
	setLoadedTypes(res);break;
	case 'setCombo':
	setComboTypes(res,"#loststype");
	default:
	}			
}else{
	$("#loadedtype").html("");
		}
})
}
function setLoadedTypes(loadedtype){
var doctyp="";
		 for(var i=0;i<loadedtype.types.length;i++){	
if(loadedtype.types[i].doctype!=null){		 
         doctyp+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ loadedtype.types[i].doctype +"</td>"
             +"<td>"+ (loadedtype.types[i].max_items==0?"Unlimited":loadedtype.types[i].max_items)+"</td>"
              +"<td>"+ loadedtype.types[i].regdate+"</td>"
              +"<td class='loadedtypemodif' style='text-align:center;'><a href='#' onclick='loadTypesById(\"edit\","+loadedtype.types[i].doc_id+")' class='btn btn-warning edit glyphicon glyphicon-pencil' data-toggle='modal' data-target='#updateTypeModal'>Edit</a>"
              +"&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' onclick='loadTypesById(\"delete\","+loadedtype.types[i].doc_id+")' class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal' >Delete</a>"
                +"</a></td>"
            +"</tr>";
			}
			}
$("#loadedtypes").html("");
			$("#loadedtypes").append(doctyp);
			jslive.pagingTable({id:'#tblTypes',shows:25,active:0});
	}
	function setComboTypes(obj,elem) {
		var seltype="";
		seltype="<option>All Types</option>";
		for (var i=0;i<obj.types.length;i++) {
seltype+="<option value="+obj.types[i].doc_id+">"+obj.types[i].doctype+"</option>";
	}
	$(elem).html(seltype);
}
function loadTypesById(cate,id){
	ajax("ajax/types",{"cate":"loadbyid","id":id},"GET","json",function(res){
	if(cate=='edit'){
		setEditTypes(res);
	}
	if(cate=='delete'){
		setDeleteTypes(res.types);
	}
	});
}
function setEditTypes(data){
	$("#typeid").val(data.types[0].doc_id);
	$("#updType").val(data.types[0].doctype);
}
function setDeleteTypes(data){
	$("#deleteid").val(data[0].doc_id);
	$("#delModalTitle").html("Do you want to delete "+data[0].doctype+"?");
}
function searchTypes(){
	ajax("ajax/types",{"cate":"search","key":$("#keyType").val()},"GET","json",function(res){
if(res.types!=null){
	setLoadedTypes(res);
	}else{
		$("#loadedtypes").html("<tr><td colspan='5'><center>No Item Types Found</center><td></tr>");
	}
	});
}
function updateTypes(){
	setLoaders({elem:'updateTypeResponse',elemtype:'container',msg:'Updating Data...'});
 ajax("ajax/types",{"cate":"update","id":$("#typeid").val(),"doctype":$("#updType").val(),"max":$("#updmaxItem").val()},"GET","text",function(res){
		if(res=="ok"){
			loadTypes("setContent");
			$("#updateTypeResponse").html("<font color='green'>Item Type Updated Success</font>");
		}else{
		$("#updateTypeResponse").html("<font color='red'>Failed to Update Item Type</font>");
		}
clearMsg("#updateTypeResponse");
	});
}
function deleteTypes(){
	ajax("ajax/types",{"cate":"delete","id":$("#deleteid").val(),"reason":$("#delReason").val()},"GET","text",function(res){
	//	alert(res);
		if(res=="ok"){
		loadTypes("setContent");
		$("#delReason").val("");
		$("#delResponse").html("<font color='green'>Item Type Removed Success</font>");
		}else{
		$("#delResponse").html("<font color='red'>Failed to Remove Item Type</font>");
		}
clearMsg("#delResponse");
	});
}	
function registerWithdrawCompany(){
clickController("disable","#btnSaveWithdrawCompany");
setLoaders({elem:'regWithdrawCompanyResponse',elemtype:'container',msg:'Saving Data...'});
	  ajax("ajax/wthcompany",{"cate":"register",sessid:$("#sessid").val(),"accr":$("#wthcAccr").val(),"name":$("#wthcName").val()},"GET","text",function(res){
    if(res=="ok"){
clickController("enable","#btnSaveWithdrawCompany");
      loadWithdrawCompany("setContent",null);
      $("#wthcName").val("");$("#wthcAccr").val("");
    $("#regWithdrawCompanyResponse").html("<font color='green'>Withdraw Company Registered Success</font>");
    }else if(res=='exist'){
clickController("enable","#btnSaveWithdrawCompany");
    $("#regWithdrawCompanyResponse").html("<font color='blue'>Failed to Register Withdraw Company,Company Allready Exist</font> ");
    }else{
clickController("enable","#btnSaveWithdrawCompany");
    $("#regWithdrawCompanyResponse").html("<font color='red'>Failed to Register Withdraw Company</font> ");
    }
clearMsg("#regWithdrawCompanyResponse");
  });
}
function loadWithdrawCompany(cate,reference){
  if(cate=='setContent'){
  setLoaders({elem:'tblWithdrawCompany',elemwthc:'table',msg:'Loading Data...'});
}
  ajax("ajax/wthcompany",{"cate":"load"},"GET","json",function(res){
if(res.wthcompany!=null){  
switch(cate){
  case'setContent':
  setLoadedWithdrawCompany(res);break;
  case 'setCombo':
  setComboWithdrawCompany(res,"#wthmode",reference);break;
  default:
  }     
}else{
  $("#loadedwthcompany").html("<tr><td colspan='5'><center>No Withdraw Company Available</center><td></tr>");
    }
})
}
function setLoadedWithdrawCompany(loadedwthc){
var doctyp="";
     for(var i=0;i<loadedwthc.wthcompany.length;i++){  
if(loadedwthc.wthcompany[i].wthc_accronym!=null){     
         doctyp+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ (loadedwthc.wthcompany[i].wthc_name==0?"Unlimited":loadedwthc.wthcompany[i].wthc_name)+"</td>"
             +"<td>"+ loadedwthc.wthcompany[i].wthc_accronym +"</td>"
              +"<td>"+ loadedwthc.wthcompany[i].regdate.substring(0,10)+"</td>"
              +"<td class='loadedwthcmodif' style='text-align:center;'><a href='#' onclick='loadWithdrawCompanyById(\"edit\","+loadedwthc.wthcompany[i].wthc_id+")' class='btn btn-warning edit glyphicon glyphicon-pencil' data-toggle='modal' data-target='#updateWithdrawCompanyModal'>Edit</a>"
              +"&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' onclick='loadWithdrawCompanyById(\"delete\","+loadedwthc.wthcompany[i].wthc_id+")' class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal' >Delete</a>"
                +"</a></td>"
            +"</tr>";
      }
      }
$("#loadedwthcompany").html("");
      $("#loadedwthcompany").append(doctyp);
      jslive.pagingTable({id:'#tblWithdrawCompany',shows:25,active:0});
  }
function setComboWithdrawCompany(obj,elem,reference){
var data=null;
if(reference==null){
  data="<option>Select Payment Company</option>";
for(var i=0;i<obj.wthcompany.length;i++){
data+="<option value='"+obj.wthcompany[i].wthc_id+"'>"+obj.wthcompany[i].wthc_name+"</option>"
}
}else{
for(var i=0;i<obj.wthcompany.length;i++){
if(obj.wthcompany[i].wthc_id==reference){
data+="<option value='"+obj.wthcompany[i].wthc_id+"'>"+obj.wthcompany[i].wthc_name+"</option>"
}else{
data+="<option value='"+obj.wthcompany[i].wthc_id+"'>"+obj.wthcompany[i].wthc_name+"</option>"
}
} 
}
$(elem).html(data);
}
function loadWithdrawCompanyById(cate,id){
  ajax("ajax/wthcompany",{"cate":"loadbyid","id":id},"GET","json",function(res){
  if(cate=='edit'){
    setEditWithdrawCompany(res);
  }
  if(cate=='delete'){
    setDeleteWithdrawCompany(res.wthcompany);
  }
  });
}
function setEditWithdrawCompany(data){
  $("#wthcompanyid").val(data.wthcompany[0].wthc_id);
  $("#updWthcAccr").val(data.wthcompany[0].wthc_accronym);
  $("#updWthcName").val(data.wthcompany[0].wthc_name);
}
function setDeleteWithdrawCompany(data){
  $("#deleteid").val(data[0].wthc_id);
  $("#delModalTitle").html("Do you want to delete "+data[0].wthc_accronym+"?");
}
function searchWithdrawCompany(){
  ajax("ajax/wthcompany",{"cate":"search","key":$("#keyWithdrawCompany").val()},"GET","json",function(res){
if(res.wthcompany!=null){
  setLoadedWithdrawCompany(res);
  }else{
    $("#loadedwthcompany").html("");
  }
  });
}
function updateWithdrawCompany(){
   setLoaders({elem:'updateWithdrawCompanyResponse',elemtype:'container',msg:'Updating Data...'});
 ajax("ajax/wthcompany",{"cate":"update","id":$("#wthcompanyid").val(),"accr":$("#updWthcAccr").val(),"name":$("#updWthcName").val()},"GET","text",function(res){
    if(res=="ok"){
    	loadWithdrawCompany("setContent",null);
      $("#updateWithdrawCompanyResponse").html("<font color='green'>Withdraw Company Updated Success</font>");
    }else{
    $("#updateWithdrawCompanyResponse").html("<font color='red'>Failed to Update Withdraw Company</font>");
    }
clearMsg("#updateWithdrawCompanyResponse");
  });
}
function deleteWithdrawCompany(){
  ajax("ajax/wthcompany",{"cate":"delete","id":$("#deleteid").val(),"reason":$("#delReason").val()},"GET","text",function(res){
  //  alert(res);
    if(res=="ok"){
    loadWithdrawCompany("setContent");
    $("#delReason").val("");
    $("#delResponse").html("<font color='green'>Withdraw Company Removed Success</font>");
    }else{
    $("#delResponse").html("<font color='red'>Failed to Remove Withdraw Company</font>");
    }
clearMsg("#delResponse");
  });
} 
function registerPayments(){
clickController("disable","#btnSavePayments");
  ajax("ajax/payments",{"cate":"register",sessid:$("#sessid").val(),"amount":$("#amount").val()},"GET","text",function(res){
    if(res=="ok"){
clickController("enable","#btnSavePayments");
      loadPayments("setContent");
      $("#amount").val("");
    $("#regPaymentResponse").html("<font color='green'>Payment Registered Success</font>");
    }else{
clickController("enable","#btnSavePayments");
    $("#regPaymentResponse").html("<font color='red'>Failed to Register Payment</font> ");
    }
clearMsg("#regPaymentResponse");
  });
}
function loadPayments(cate){
	var data={};data.cate="load";
	 ajax("ajax/payments",data,"GET","json",function(res){
if(res.payments!=null){  
switch(cate){
  case'setContent':
  setLoadedPayments(res);break;
  default:
  }     
}else{
  $("#loadedpayment").html("<tr><td colspan='6'>No Payment Found</td></tr>");
    }
})
  jslive.pagingTable({id:'#tblPayments',shows:25,active:0});
}
function setLoadedPayments(loadedpayment){
var payinfo="";
     for(var i=0;i<loadedpayment.payments.length;i++){  
         payinfo+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ loadedpayment.payments[i].pay_name +"</td>"
              +"<td>"+ loadedpayment.payments[i].payer_type +"</td>"
              +"<td>"+ loadedpayment.payments[i].pay_amount +" RWF</td>"
              +"<td>"+ loadedpayment.payments[i].regdate.substring(0,16)+"</td>"
              +"<td class='loadedpaymentmodif' style='text-align:center;'><a href='#' onclick='loadPaymentsById(\"edit\","+loadedpayment.payments[i].pay_id+")' class='btn btn-warning edit glyphicon glyphicon-pencil' data-toggle='modal' data-target='#updatePaymentModal'>Edit</a></td>"
              //+"<td class='loadedpaymentmodif' style='text-align:center;'><a href='#' onclick='loadPaymentsById(\"delete\","+loadedpayment.payments[i].pay_id+")' class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal' >Delete</a>"
              //  +"</a></td>"
            +"</tr>";
      }
$("#loadedpayments").html("");
      $("#loadedpayments").append(payinfo);
  }
function loadPaymentsById(cate,id){
  ajax("ajax/payments",{"cate":"loadbyid","id":id},"GET","json",function(res){
  if(cate=='edit'){
    setEditPayments(res);
  }
  if(cate=='delete'){
    setDeletePayments(res.payments);
  }
  });
}
function setEditPayments(data){
  $("#payid").val(data.payments[0].pay_id);
  $("#updPaymentName").val(data.payments[0].pay_name);
  $("#updPaymentType").val(data.payments[0].payer_type);
  $("#updPaymentAmount").val(data.payments[0].pay_amount);
}
function setDeletePayments(data){
  $("#deleteid").val(data[0].pay_id);
  $("#delModalTitle").html("Do you want to delete "+data[0].amount+"?");
}
function searchPayments(){
  ajax("ajax/payments",{"cate":"search","key":$("#keyPayment").val()},"GET","json",function(res){
if(res.payments!=null){
  setLoadedPayments(res);
  }else{
    $("#loadedpayments").html("");
  }
  });
}
function updatePayments(){
   setLoaders({elem:'updatePaymentResponse',elemtype:'container',msg:'Updating Data...'});
 ajax("ajax/payments",{"cate":"update","id":$("#payid").val(),"amount":$("#updPaymentAmount").val()},"GET","text",function(res){
    if(res=="ok"){
      loadPayments("setContent");
      $("#updatePaymentResponse").html("<font color='green'>Payment Updated Success</font>");
    }else{
    $("#updatePaymentResponse").html("<font color='red'>Failed to Update Payment</font>");
    }
clearMsg("#updatePaymentResponse");
  });
}
function deletePayments(){
  ajax("ajax/payments",{"cate":"delete","id":$("#deleteid").val(),"reason":$("#delReason").val()},"GET","text",function(res){
  //  alert(res);
    if(res=="ok"){
    loadPayments("setContent");
    $("#delReason").val("");
    $("#delResponse").html("<font color='green'>Item Payment Removed Success</font>");
    }else{
    $("#delResponse").html("<font color='red'>Failed to Remove Item Payment</font>");
    }
clearMsg("#delResponse");
  });
} 
function registerPaymentsHistory(){
clickController("disable","#btnSavePayhist");
  ajax("ajax/payhist",{"cate":"register",sessid:$("#sessid").val(),"amount":$("#amount").val()},"GET","text",function(res){
    if(res=="ok"){
clickController("enable","#btnSavePayhist");
      loadPaymentsHistory("setContent");
      $("#amount").val("");
    $("#regPaymentResponse").html("<font color='green'>Payment Registered Success</font>");
    }else{
clickController("disable","#btnSavePayhist");
    $("#regPaymentResponse").html("<font color='red'>Failed to Register Payment</font> ");
    }
clearMsg("#regPaymentResponse");
  });
}
function loadPaymentsHistory(cate){
	var data={};data.cate="load"
	 if(cate=='setContent'){
	 	setLoaders({elem:'tblPaymentHistory',elemtype:'table',msg:'Loading Data...'});
    }else if(cate=='setReport'){
  	if($("#payhiststart").val()!="" && $("#payhistend").val()!=""){
  		data.start=$("#payhiststart").val();
  		data.end=$("#payhistend").val();
  	}
  	if($("#paymode").val()!="Select Payment Mode"){
  		data.paymode=$("#paymode").val();
  	}
  	if($("#payhistByType").val()!="default"){
  		data.payertype=$("#payhistByType").val();
  	}
  	if($("#payhistbyStatus").val()!="default"){
  		data.status=$("#payhistbyStatus").val();
  	}
  }
    ajax("ajax/payhist",data,"GET","json",function(res){
if(res.payhistory.length!=0){  
switch(cate){
  case'setContent':
  case'setReport':
  setLoadedPaymentsHistory(res);break;
  default:
  }     
}else{
  $("#loadedpayhistory").html("<tr><td colspan='12'><center>No Payment Found</center></td></tr>");
    }
})
    if(cate=='setContent'){
  jslive.pagingTable({id:'#tblPaymentHistory',shows:25,active:0});
}
}
function setLoadedPaymentsHistory(loadedpayment){
var payinfo="";
     for(var i=0;i<loadedpayment.payhistory.length;i++){  
         payinfo+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ (loadedpayment.payhistory[i].payer_names==null?'None':loadedpayment.payhistory[i].payer_names)+"</td>"
              +"<td>"+ loadedpayment.payhistory[i].pmth_payer_type +"</td>"
              +"<td>"+ loadedpayment.payhistory[i].pmtd_name +"</td>"
              +"<td>"+ loadedpayment.payhistory[i].pmtd_account_name +"</td>"
              +"<td>"+ loadedpayment.payhistory[i].pmtd_account_number+"</td>"
              +"<td>"+ loadedpayment.payhistory[i].pmth_sender_name +"</td>"
              +"<td>"+ loadedpayment.payhistory[i].pmth_sender_phone+"</td>"
              +"<td>"+ loadedpayment.payhistory[i].pmth_amount +" RWF</td>"
              +"<td>"+ loadedpayment.payhistory[i].pmth_status+"</td>"
              +"<td>"+ loadedpayment.payhistory[i].regdate.substring(0,10)+"</td>"
              +"<td class='loadedapproval' style='text-align:center;'><a href='#' class='btn btn-warning edit fa fa-check-square-o' data-toggle='modal' data-target='#approvePaymentModal' "+(loadedpayment.payhistory[i].pmth_status!='pending'?'disabled':"onclick='loadPaymentsHistoryById(\"approve\","+loadedpayment.payhistory[i].pmth_id+")'")+">Approve</a></td>"
              +"</tr>";
      }
$("#loadedpayhistory").html("");
      $("#loadedpayhistory").append(payinfo);
  }
function loadPaymentsHistoryById(cate,id){
  ajax("ajax/payhist",{"cate":"loadbyid","id":id},"GET","json",function(res){
 if(cate=='approve'){
$("#payhistid").val(res.payhistory[0].pmth_id);
  }
  if(cate=='edit'){
    setEditPaymentsHistory(res);
  }
  if(cate=='delete'){
    setDeletePaymentsHistory(res.payhistory);
  }
  });
}
function setEditPaymentsHistory(data){
  $("#payid").val(data.payhistory[0].pay_id);
  $("#updPaymentName").val(data.payhistory[0].payer_name);
  $("#updPaymentType").val(data.payhistory[0].payer_type);
  $("#updPaymentAmount").val(data.payhistory[0].pay_amount);
}
function setDeletePaymentsHistory(data){
  $("#deleteid").val(data[0].pay_id);
  $("#delModalTitle").html("Do you want to delete "+data[0].amount+"?");
}
function searchPaymentsHistory(){
  ajax("ajax/payhist",{"cate":"search","key":$("#keyPayment").val()},"GET","json",function(res){
if(res.payhistory!=null){
  setLoadedPaymentsHistory(res);
  }else{
    $("#loadedpayhistory").html("");
  }
  });
}
function updatePaymentsHistory(){
  setLoaders({elem:'updatePaymentResponse',elemtype:'container',msg:'Updating Data...'});
 ajax("ajax/payhist",{"cate":"update","id":$("#payid").val(),"amount":$("#updPaymentAmount").val()},"GET","text",function(res){
    if(res=="ok"){
      loadPaymentsHistory("setContent");
      $("#updatePaymentResponse").html("<font color='green'>Payment Updated Success</font>");
    }else{
    $("#updatePaymentResponse").html("<font color='red'>Failed to Update Payment</font>");
    }
clearMsg("#updatePaymentResponse");
  });
}

function approvePaymentsHistory(){
 setLoaders({elem:'approvePaymentResponse',elemtype:'container',msg:'Approving Payment History...'});
 ajax("ajax/payhist",{"cate":"approve",sessid:$("#sessid").val(),"id":$("#payhistid").val()},"GET","text",function(res){
    if(res=="ok"){
      loadPaymentsHistory("setContent");
    $("#approvePaymentResponse").html("<font color='green'>Payment Approved Success</font>");
    }else if(res=='notexist'){
    $("#approvePaymentResponse").html("<font color='blue'>Payment Allready Approved</font> ");
    }else{
    $("#approvePaymentResponse").html("<font color='red'>Failed to Approve Payment</font> ");
    }
clearMsg("#approvePaymentResponse");
  });
}
function deletePaymentsHistory(){
  ajax("ajax/payhist",{"cate":"delete","id":$("#deleteid").val(),"reason":$("#delReason").val()},"GET","text",function(res){
  //  alert(res);
    if(res=="ok"){
    loadPaymentsHistory("setContent");
    $("#delReason").val("");
    $("#delResponse").html("<font color='green'>Item Payment Removed Success</font>");
    }else{
    $("#delResponse").html("<font color='red'>Failed to Remove Item Payment</font>");
    }
clearMsg("#delResponse");
  });
} 
function registerWithdrawsHistory(){
clickController("disable","#btnSaveWthhist");
  ajax("ajax/withdrawhist",{"cate":"register",sessid:$("#sessid").val(),"amount":$("#amount").val()},"GET","text",function(res){
    if(res=="ok"){
clickController("enable","#btnSaveWthhist");
      loadWithdrawsHistory("setContent");
      $("#amount").val("");
    $("#regWithdrawResponse").html("<font color='green'>Withdraw Registered Success</font>");
    }else{
clickController("enable","#btnSaveWthhist");
    $("#regWithdrawResponse").html("<font color='red'>Failed to Register Withdraw</font> ");
    }
clearMsg("#regWithdrawResponse");
  });
}
function loadWithdrawsHistory(cate){
   	var data={};data.cate="load";
  if(cate=='setContent'){
    setLoaders({elem:'tblPaymentWithdraw',elemtype:'table',msg:'Loading Data...'});
    }else if(cate=='setReport'){
  	if($("#wthstart").val()!="" && $("#wthend").val()!=""){
  		data.start=$("#wthstart").val();
  		data.end=$("#wthend").val();
  	}
  	if($("#wthmode").val()!="Select Payment Company"){
  		data.wthcompany=$("#wthmode").val();
  	}
  	if($("#wthByType").val()!="default"){
  		data.wthtype=$("#wthByType").val();
  	}
  	if($("#wthbyStatus").val()!="default"){
  		data.status=$("#wthbyStatus").val();
  	}
  }
     ajax("ajax/withdrawhist",data,"GET","json",function(res){
if(res.withdraws.length!=0){  
switch(cate){
  case'setContent':
  case'setReport':
  setLoadedWithdrawsHistory(res);break;
  default:
  }     
}else{
  $("#loadedwthhistory").html("<tr><td colspan='12'><center>No Withdraw Found</center></td></tr>");
    }
})
if(cate=='setContent'){
  jslive.pagingTable({id:'#tblPaymentWithdraw',shows:25,active:0});
}

}
function setLoadedWithdrawsHistory(loadedwthment){
var wthinfo="";
     for(var i=0;i<loadedwthment.withdraws.length;i++){  
         wthinfo+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ loadedwthment.withdraws[i].withdrawer_names+"</td>"
              +"<td>"+ loadedwthment.withdraws[i].wth_withdrawer_type +"</td>"
              +"<td>"+ loadedwthment.withdraws[i].wth_company_name +"</td>"
              +"<td>"+ loadedwthment.withdraws[i].wth_withdrawer_accname +"</td>"
              +"<td>"+ loadedwthment.withdraws[i].wth_withdrawer_accnumber+"</td>"
              +"<td>"+ loadedwthment.withdraws[i].wth_amount_requested +" RWF</td>"
              +"<td>"+ loadedwthment.withdraws[i].wth_amount_given+" RWF</td>"
              +"<td>"+ loadedwthment.withdraws[i].wth_status+"</td>"
              +"<td>"+ loadedwthment.withdraws[i].regdate.substring(0,10)+"</td>"
              +"<td class='loadedwthmodif' style='text-align:center;'><a href='#' class='btn btn-warning edit fa fa-check-square-o' data-toggle='modal' data-target='#approveWithdrawModal' "+(loadedwthment.withdraws[i].wth_status!='pending'?'disabled':"onclick='loadWithdrawsHistoryById(\"approve\","+loadedwthment.withdraws[i].wth_id+")'")+">Approve</a></td>"
              +"</tr>";
      }
$("#loadedwthhistory").html("");
      $("#loadedwthhistory").append(wthinfo);
  }
function loadWithdrawsHistoryById(cate,id){
  ajax("ajax/withdrawhist",{"cate":"loadbyid","id":id},"GET","json",function(res){
 if(cate=='approve'){
$("#withdrawhistid").val(res.withdraws[0].wth_id);
$("#requested").val(res.withdraws[0].wth_amount_requested);
$("#given").val(res.withdraws[0].wth_amount_given);
  }
  if(cate=='edit'){
    setEditWithdrawsHistory(res);
  }
  if(cate=='delete'){
    setDeleteWithdrawsHistory(res.withdraws);
  }
  });
}
function setEditWithdrawsHistory(data){
  $("#wthid").val(data.withdraws[0].wth_id);
  $("#updWithdrawName").val(data.withdraws[0].wth_withdrawer_name);
  $("#updWithdrawType").val(data.withdraws[0].wth_withdrawer_type);
  $("#updWithdrawAmount").val(data.withdraws[0].wth_amount_requested);
}
function setDeleteWithdrawsHistory(data){
  $("#deleteid").val(data[0].wth_id);
  $("#delModalTitle").html("Do you want to delete "+data[0].amount+"?");
}
function searchWithdrawsHistory(){
  ajax("ajax/withdrawhist",{"cate":"search","key":$("#keyWithdraw").val()},"GET","json",function(res){
if(res.withdraws!=null){
  setLoadedWithdrawsHistory(res);
  }else{
    $("#loadedwithdraws").html("");
  }
  });
}
function updateWithdrawHistory(){
 setLoaders({elem:'updateWithdrawResponse',elemtype:'container',msg:'Updating Data...'});
  ajax("ajax/withdrawhist",{"cate":"update","id":$("#wthid").val(),"amount":$("#updWithdrawAmount").val()},"GET","text",function(res){
    if(res=="ok"){
      loadWithdrawsHistory("setContent");
      $("#updateWithdrawResponse").html("<font color='green'>Withdraw Updated Success</font>");
    }else{
    $("#updateWithdrawResponse").html("<font color='red'>Failed to Update Withdraw</font>");
    }
clearMsg("#updateWithdrawResponse");
  });
}

function approveWithdrawsHistory(){
clickController("disable","#btnApproveWithdraw");
  setLoaders({elem:'approveWithdrawResponse',elemtype:'container',msg:'Approving Withdraw History...'});
 ajax("ajax/withdrawhist",{"cate":"approve",sessid:$("#sessid").val(),"id":$("#withdrawhistid").val(),"given":$("#given").val()},"GET","text",function(res){
    if(res=="ok"){
clickController("enable","#btnApproveWithdraw");
      loadWithdrawsHistory("setContent");
    $("#approveWithdrawResponse").html("<font color='green'>Withdraw Approved Success</font>");
    }else if(res=='notexist'){
clickController("enable","#btnApproveWithdraw");
    $("#approveWithdrawResponse").html("<font color='blue'>Withdraw Allready Approved</font> ");
    }else{
clickController("enable","#btnApproveWithdraw");
    $("#approveWithdrawResponse").html("<font color='red'>Failed to Approve Withdraw</font> ");
    }
clearMsg("#approveWithdrawResponse");
  });
}
function deleteWithdrawsHistory(){
  ajax("ajax/withdrawhist",{"cate":"delete","id":$("#deleteid").val(),"reason":$("#delReason").val()},"GET","text",function(res){
  //  alert(res);
    if(res=="ok"){
    loadWithdrawsHistory("setContent");
    $("#delReason").val("");
    $("#delResponse").html("<font color='green'>Item Withdraw Removed Success</font>");
    }else{
    $("#delResponse").html("<font color='red'>Failed to Remove Item Withdraw</font>");
    }
clearMsg("#delResponse");
  });
} 
function registerCommissions(){
clickController("disable","#btnSaveCommission");
  ajax("ajax/commissions",{"cate":"register",sessid:$("#sessid").val(),"amount":$("#amount").val()},"GET","text",function(res){
    if(res=="ok"){
clickController("enable","#btnSaveCommission");
      loadCommissions("setContent");
      $("#amount").val("");
    $("#regCommissionResponse").html("<font color='green'>Ratio Payment Registered Success</font>");
    }else{
clickController("enable","#btnSaveCommission");
    $("#regCommissionResponse").html("<font color='red'>Failed to Register Payment</font> ");
    }
clearMsg("#regCommissionResponse");
  });
}
function loadCommissions(cate){
  setLoaders({elem:'tblCommissions',elemtype:'table',msg:'Loading Data...'});
  ajax("ajax/commissions",{"cate":"load"},"GET","json",function(res){
if(res.commissions!=null){  
switch(cate){
  case'setContent':
  setLoadedCommissions(res);break;
  default:
  }     
}else{
  $("#loadedcommission").html("<tr><td colspan='6'><center>No Commission Found</center></td></tr>");
    }
})
  jslive.pagingTable({id:'#tblCommissions',shows:25,active:0});
}
function setLoadedCommissions(loadedcommission){
var payinfo="";
     for(var i=0;i<loadedcommission.commissions.length;i++){  
         payinfo+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ loadedcommission.commissions[i].pay_name+(loadedcommission.commissions[i].payer_type!=''?" ["+loadedcommission.commissions[i].payer_type+"]":'') +"</td>"
              +"<td>"+ loadedcommission.commissions[i].comm_target +"</td>"
              +"<td>"+ loadedcommission.commissions[i].comm_rate+" "+loadedcommission.commissions[i].comm_rate_type +"</td>"
              +"<td>"+ loadedcommission.commissions[i].regdate.substring(0,16)+"</td>"
              +"<td class='loadedcommissionmodif' style='text-align:center;'><a href='#' onclick='loadCommissionsById(\"edit\","+loadedcommission.commissions[i].comm_id+")' class='btn btn-warning edit glyphicon glyphicon-pencil' data-toggle='modal' data-target='#updateCommissionModal'>Edit</a></td>"
              //+"<td class='loadedcommissionmodif' style='text-align:center;'><a href='#' onclick='loadCommissionsById(\"delete\","+loadedcommission.commissions[i].pay_id+")' class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal' >Delete</a>"
              //  +"</a></td>"
            +"</tr>";
      }
$("#loadedcommissions").html("");
      $("#loadedcommissions").append(payinfo);
  }
function loadCommissionsById(cate,id){
  ajax("ajax/commissions",{"cate":"loadbyid","id":id},"GET","json",function(res){
  if(cate=='edit'){
    setEditCommissions(res);
  }
  if(cate=='delete'){
    setDeleteCommissions(res.commissions);
  }
  });
}
function setEditCommissions(data){
	$("#commTitle").html(data.commissions[0].pay_name+"["+data.commissions[0].payer_type+"]");
  $("#commid").val(data.commissions[0].comm_id);
  $("#updCommissionTarget").val(data.commissions[0].comm_target);
  $("#updCommissionRate").val(data.commissions[0].comm_rate);
  setComboSelection(["RWF","%"],"#updCommissionRateType",data.commissions[0].comm_rate_type);
}
function setDeleteCommissions(data){
  $("#deleteid").val(data[0].pay_id);
  $("#delModalTitle").html("Do you want to delete "+data[0].amount+"?");
}
function searchCommissions(){
  ajax("ajax/commissions",{"cate":"search","key":$("#keyCommission").val()},"GET","json",function(res){
if(res.commissions!=null){
  setLoadedCommissions(res);
  }else{
    $("#loadedcommissions").html("");
  }
  });
}
function updateCommissions(){
 setLoaders({elem:'updateCommissionResponse',elemtype:'container',msg:'Updating Data...'});
 ajax("ajax/commissions",{"cate":"update","id":$("#commid").val(),"rate":$("#updCommissionRate").val(),"ratetype":$("#updCommissionRateType").val()},"GET","text",function(res){
    if(res=="ok"){
      loadCommissions("setContent");
      $("#updateCommissionResponse").html("<font color='green'>Commission Updated Success</font>");
    }else{
    $("#updateCommissionResponse").html("<font color='red'>Failed to Update Commission</font>");
    }
clearMsg("#updateCommissionResponse");
  });
}
function deleteCommissions(){
  ajax("ajax/commissions",{"cate":"delete","id":$("#deleteid").val(),"reason":$("#delReason").val()},"GET","text",function(res){
  //  alert(res);
    if(res=="ok"){
    loadCommissions("setContent");
    $("#delReason").val("");
    $("#delResponse").html("<font color='green'>Commission Removed Success</font>");
    }else{
    $("#delResponse").html("<font color='red'>Failed to Remove Commission</font>");
    }
clearMsg("#delResponse");
  });
} 

function registerPaymentMode(){
clickController("disable","#btnSavePaymode");
	setLoaders({elem:'regPaymodeResponse',elemtype:'container',msg:'Saving Data...'});
ajax("ajax/paymodes",{"cate":"register","sessid":$("#sessid").val(),"modename":$("#paymodename").val(),"company":$("#company").val(),"accname":$("#accname").val(),"accnumber":$("#accnumber").val()},"POST","text",function(res){
		if(res=="ok"){
clickController("enable","#btnSavePaymode");
			$("#paymodename").val("");	$("#company").val("");	$("#accname").val("");	$("#accnumber").val("");
		loadPaymentMode("setContent",null);
		$("#regPaymodeResponse").html("<font color='green'>Payment Mode Registered Success</font>");
		}else{
clickController("enable","#btnSavePaymode");
		$("#regPaymodeResponse").html("<font color='red'>Failed to Register Payment Mode</font> ");
		}
clearMsg("#regPaymodeResponse");
	});
}
function loadPaymentMode(cate,reference){
	if(cate=='setContent'){
	setLoaders({elem:'tblModes',elemtype:'table',msg:'Loading Data...'});}
	ajax("ajax/paymodes",{"cate":"load"},"GET","json",function(res){
if(res.paymodes.length!=0){	
switch(cate){
	case'setContent':
	setLoadedPaymentMode(res);break;
	case'setCombo':
	setLoadedComboPaymode(res,"#paymode",reference);
	case'updsetCombo':
	setLoadedComboPaymode(res,"#updpaymode",reference);
	default:
	}			
}else{
	//console.log("Null Value");
	$("#loadedpaymodes").html("");
		}
});
}
function setLoadedPaymentMode(loadedpaymodes){
var modes="";
if(loadedpaymodes.paymodes.length!=0){
		 for(var i=0;i<loadedpaymodes.paymodes.length;i++){		 
         modes+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ loadedpaymodes.paymodes[i].pmtd_name +"</td>"
              +"<td>"+ loadedpaymodes.paymodes[i].pmtd_company +"</td>"
              +"<td>"+ loadedpaymodes.paymodes[i].pmtd_account_name +"</td>"
              +"<td>"+ loadedpaymodes.paymodes[i].pmtd_account_number +"</td>"
              +"<td>"+ loadedpaymodes.paymodes[i].regdate.substring(0,16)+"</td>"
              +"<td class='loadedpaymodemodif' style='text-align:center;'><a href='#'  onclick='loadPaymentModeById(\"edit\","+loadedpaymodes.paymodes[i].pmtd_id+")' class='btn btn-warning edit glyphicon glyphicon-pencil' data-toggle=\'modal\' data-target='#updatePaymodeModal'>Edit</a>"
              +"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='#' onclick='loadPaymentModeById(\"delete\","+loadedpaymodes.paymodes[i].pmtd_id+")' class='btn btn-danger glyphicon glyphicon-remove' data-toggle='modal' data-target='#delModal' >Delete</a>"
                +"</a></td>"
            +"</tr>";
			}
		}else{
		 modes+="<tr>"
             +"<td colspan='7'><center>No Payment Mode Found</center></td></tr>"
              }
$("#loadedpaymodes").html(modes);
      jslive.pagingTable({id:'#tblModes',shows:25,active:0});
	}
function setLoadedComboPaymode(obj,elem,reference){
var data=null;
if(reference==null){
	data="<option>Select Payment Mode</option>";
for(var i=0;i<obj.paymodes.length;i++){
data+="<option value='"+obj.paymodes[i].pmtd_id+"'>"+obj.paymodes[i].pmtd_name+"</option>"
}
}else{
for(var i=0;i<obj.paymodes.length;i++){
if(obj.paymodes[i].pmtd_id==reference){
data+="<option value='"+obj.paymodes[i].pmtd_id+"'>"+obj.paymodes[i].pmtd_name+"</option>"
}else{
data+="<option value='"+obj.paymodes[i].pmtd_id+"'>"+obj.paymodes[i].pmtd_name+"</option>"
}
}	
}
$(elem).html(data);
}
function loadPaymentModeById(cate,id){
	ajax("ajax/paymodes",{"cate":"loadbyid","id":id},"GET","json",function(res){
	if(cate=='edit'){
		setEditPaymentMode(res);
	}
	if(cate=='delete'){
		setDeletePaymentMode(res);
	}
	});
}
function setEditPaymentMode(data){
	$("#paymodeid").val(data.paymodes[0].pmtd_id);
	$("#updpaymodename").val(data.paymodes[0].pmtd_name);
$("#updcompany").val(data.paymodes[0].pmtd_company);
$("#updaccname").val(data.paymodes[0].pmtd_account_name);
$("#updaccnumber").val(data.paymodes[0].pmtd_account_number);
}
function setDeletePaymentMode(data){
	$("#deleteid").val(data.paymodes[0].pmtd_id);
}
function searchPaymentMode(){
	ajax("ajax/paymodes",{"cate":"search","sessid":$("#sessid").val(),"usercate":$("#usercate").val(),"key":$("#keyPaymode").val()},"GET","json",function(res){
if(res.paymodes!=null){
	setLoadedPaymentMode(res);
	}else{
		$("#loadedpaymodes").html("");
	}
	});
}
function updatePaymentMode(){
	setLoaders({elem:'updPaymodeResponse',elemtype:'container',msg:'Updating Data...'});
ajax("ajax/paymodes",{"cate":"update","sessid":$("#sessid").val(),"id":$("#paymodeid").val(),"modename":$("#updpaymodename").val(),"company":$("#updcompany").val(),"accname":$("#updaccname").val(),"accnumber":$("#updaccnumber").val()},"POST","text",function(res){
		if(res=="ok"){
			loadPaymentMode("setContent",null);
			loadPaymentModeById("edit",$("cateid").val());
			$("#updPaymodeResponse").html("<font color='green'>Payment Mode Updated Success</font>");
		}else{
		$("#updPaymodeResponse").html("<font color='red'>Failed to Update Payment Mode</font>");
		}
clearMsg("#updatePaymodeResponse");
	});
}
function deletePaymentMode(){
	ajax("ajax/paymodes",{"cate":"delete","sessid":$("#sessid").val(),"usercate":$("#usercate").val(),"id":$("#deleteid").val(),"reason":$("#delReason").val()},"POST","text",function(res){
	//	alert(res);
		if(res=="ok"){
		loadPaymentMode("setContent",null);
		$("#delReason").val("");
		$("#delResponse").html("<font color='green'>Payment Mode Removed Success</font>");
		}else{
		$("#delResponse").html("<font color='red'>Failed to Remove Payment Mode</font>");
		}
clearMsg("#delResponse");
	});
}	
	function changePwd() {//for superadmin
			ajax("ajax/users",{"cate":"changepwd","old":$("#oldpassword").val(),"new":$("#nwpassword").val()},"POST","text",function(res){
		if(res=="ok"){
		$("#changePwdResponse").html("<font color='green'>Password Changed Success <a href='includes/logout'>Click here to logout</a></font>");
document.getElementById("oldpassword").style.borderColor="gray";
		document.getElementById("confpassword").style.borderColor="gray";
			document.getElementById("nwpassword").style.borderColor="gray";		
		}else{
		$("#changePwdResponse").html("<font color='red'>Failed to Change Password</font>");
		}
	});
	}
	function loadAdminInfo() {
		ajax("ajax/users",{"cate":"load"},"GET","json",function(res){
		if(res!=null){
			setAdInfo(res);
			}
	});
	}
	function setAdInfo(obj) {
		$("#adid").val(obj[0].uid);
		$("#viewUname").html(obj[0].username);
		$("#viewEmail").html(obj[0].email);
		$("#adUname").val(obj[0].username);
		$("#adEmail").val(obj[0].email);
		}
	function updateAdminInfo() {
			ajax("ajax/users",{"cate":"update","id":$("#adid").val(),"uname":$("#adUname").val(),"email":$("#adEmail").val()},"GET","text",function(res){	
		if(res=="ok"){
		$("#changeAdminResponse").html("<font color='green'>Admin Information Successfull Updated</font>");
		}else{
			if (res=='fail') {
		$("#changeAdminResponse").html("<font color='red'>Failed to Update Admin Information</font>");
		}
	}
	clearMsg("#changeAdminResponse");
	});
	}
	function requestReset() {//when password fogotten
			ajax("ajax/postoffices",{"cate":"reqreset","id":$("#postoffid").val(),"phone":$("#postPhone").val(),"reason":$("#reason").val()},"GET","text",function(res){
		if(res=="ok"){
		$("#requestResetResponse").html("<font color='green'>Request Successfull Sent,You will be Notified when Password Resetted</font>");
		}else{
			if (res=='fail') {
		$("#requestResetResponse").html("<font color='red'>Failed to Send Request for Reset Password Try Again</font>");
		}
		if (res=='notexist') {
		$("#requestResetResponse").html("<font color='red'>Phone Number does not exist to Any Account</font>");
		}
		if (res=='allreadyonqueue') {
		$("#requestResetResponse").html("<font color='red'>Sorry Allready waiting for Reset</font>");
		}
	}
	});
	clearMsg("#requestResetResponse")
	}
function loadReqReset(cate){
	ajax("ajax/postoffices",{"cate":"loadreqreset"},"GET","json",function(res){
if(res.requests!=null){	
switch(cate){
	case'setContent':
	setLoadedReqReset(res);break;
	default:
	}			
}else{
	$("#loadedreqreset").html("<tr><td colspan='5'>No Reset Request Found</td></tr>");
		}
})
}
function setLoadedReqReset(loadedreqreset){
var doctyp="";
		 for(var i=0;i<loadedreqreset.requests.length;i++){	
if(loadedreqreset.requests[i].name!=null){		 
         doctyp+="<tr>"
             +"<td>"+ (i+1) +"</td>"
             +"<td>"+ loadedreqreset.requests[i].name +"</td>"
              +"<td>"+ loadedreqreset.requests[i].phone +"</td>"
               +"<td>"+ loadedreqreset.requests[i].reason +"</td>"
              +"<td>"+ loadedreqreset.requests[i].regdate+"</td>"
              +"<td style='text-align:center;'><a href='#' onclick='loadResetReqById(\"loadreset\","+loadedreqreset.requests[i].reset_id+")' class='btn btn-warning edit glyphicon glyphicon-pencil' data-toggle='modal' data-target='#resetPasswordModal'>Reset</a></td>"
              +"</a></td>"
            +"</tr>";
			}
			}
$("#loadedreqreset").html("");
			$("#loadedreqreset").append(doctyp);
			jslive.pagingTable({id:'#tblSupport',shows:25,active:0});
	}
function loadResetReqById(cate,id){
	ajax("ajax/postoffices",{"cate":"loadreqresetbyid","resetid":id},"GET","json",function(res){
	if(cate=='loadreset'){
		setResetRequest(res);
	}
	});
}
function setResetRequest(data){
	$("#resetidreset").val(data.requests[0].reset_id);
	$("#postoffidreset").val(data.requests[0].postoff_id);
	$("#postname").html("Reset Password For "+data.requests[0].name);
}	
function fillDashboard() {
	ajax("ajax/report",{"cate":"dashboard"},"GET","json",function(res){
		if(res.whole!="null"){
		barChart(res.whole);
		pieChart(res.bytype);
		}
	});
	ajax("ajax/report",{"cate":"dashheader"},"GET","json",function(res){
		if(res.dashheader!="null"){
$("#postincome").html((res.dashheader.postoffice.income==null?0:res.dashheader.postoffice.income)+ 'RWF');
$("#postbalance").html((res.dashheader.postoffice.balance==null?0:res.dashheader.postoffice.balance)+ 'RWF');
$("#commincome").html((res.dashheader.commissioner.income==null?0:res.dashheader.commissioner.income)+ 'RWF');
$("#commbalance").html((res.dashheader.commissioner.balance==null?0:res.dashheader.commissioner.balance)+ 'RWF');
$("#agaciroincome").html((res.dashheader.agaciro.income==null?0:res.dashheader.agaciro.income)+ 'RWF');
$("#agacirobalance").html((res.dashheader.agaciro.balance==null?0:res.dashheader.agaciro.balance)+ 'RWF');
		}
	});
}
function loadDefaultReport() {
	ajax("ajax/report",{"cate":"report","start":null,"end":null,"type":"All Types","status":"Status","postoffid":"All Post Offices"},"GET","json",function(res){
		if(res!=null){
		setLoadedReport(res);
		}
	});
}
function loadDynamicReport() {
	ajax("ajax/report",{"cate":"report","start":$("#loststart").val(),"end":$("#lostend").val(),"type":$("#loststype").val(),"status":$("#lostsbyStatus").val(),"postoffid":$("#byPostoffice").val()},"GET","json",function(res){
		if(res!==null){
		setLoadedReport(res);
		}else {
			$("#loadedreport").html("");
		}
	});
}
function setLoadedReport(obj) {
var rep="";
for (var i=0;i<obj.length;i++) {
	rep+="<tr><td>"+(i+1)+"</td>"
	+"<td>"+obj[i].owner+"</td>"
	+"<td>"+obj[i].doctype+"</td>"
	+"<td>"+obj[i].identifier+"</td>"
	+"<td>"+obj[i].name+"</td>"
	+"<td>"+obj[i].representer+"</td>"
	+"<td>"+obj[i].status+"</td>"
	+"<td>"+obj[i].regdate+"</td></tr>"
}
$("#loadedreport").html(rep);
}
function captionReportHeaderGenerator(cate){
var feed="";
switch(cate){
	case'citizens':
	if($("#citbyStatus").val()!='default'){
if($("#citbyStatus").val()=='0'){
		feed+="Paid:<b>No</b>";
	}else{
		feed+="Paid:<b>Yes</b>";
	}
}
	if($("#citbyCommissioner").val()!="default"){
		if($("#citbyCommissioner").val()=='0'){
		feed="&nbsp;&nbsp;&nbsp; Registerd By: <b>Theirselves</b>";
		}else{
var comm=document.getElementById("citbyCommissioner").getElementsByTagName("option");
for(var i=0;i<comm.length;i++){
	if(comm[i].getAttribute("value")==$("#citbyCommissioner").val()){
		feed+="&nbsp;&nbsp;&nbsp; Registered By: <b>"+comm[i].innerHTML+"</b>";
	break;
}
}
}
}

	if($("#citstart").val()!='' && $("#citend").val()!=''){
		feed+="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From <b>"+$("#citstart").val()+"</b> To <b>"+$("#citend").val()+"</b>";
}
	break;
	case'payhist':
	if($("#payhistbyStatus").val()!='default'){
		feed+="Status:<b>"+$("#payhistbyStatus").val()+"</b>";
	}
	if($("#payhistByType").val()!="default"){
		 feed+="&nbsp;Payertype: <b>"+$("#payhistByType").val()+"</b>";
	}
	if($("#paymode").val()!="default"){
var comm=document.getElementById("paymode").getElementsByTagName("option");
for(var i=0;i<comm.length;i++){
	if(comm[i].getAttribute("value")==$("#paymode").val()){
		feed+="&nbsp;&nbsp;&nbsp; Paymode : <b>"+comm[i].innerHTML+"</b>";
	break;
	}
}
}

	if($("#payhiststart").val()!='' && $("#payhistend").val()!=''){
		feed+="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From <b>"+$("#payhiststart").val()+"</b> To <b>"+$("#payhistend").val()+"</b>";
}
	break;
	case'withdraw':
	if($("#wthbyStatus").val()!='default'){
		feed+="Status:<b>"+$("#wthbyStatus").val()+"</b>";
	}
	if($("#wthByType").val()!="default"){
		 feed+="&nbsp;&nbsp; Type: <b>"+$("#wthByType").val()+"</b>";
	}
	if($("#wthmode").val()!="default"){
var comm=document.getElementById("wthmode").getElementsByTagName("option");
for(var i=0;i<comm.length;i++){
	if(comm[i].getAttribute("value")==$("#wthmode").val()){
		feed+="&nbsp;&nbsp;&nbsp; Company : <b>"+comm[i].innerHTML+"</b>";
	break;
	}
}
}

	if($("#wthstart").val()!='' && $("#wthtend").val()!=''){
		feed+="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From <b>"+$("#wthstart").val()+"</b> To <b>"+$("#wthend").val()+"</b>";
}
	break;
	case'losts':
	if($("#lostsbyStatus").val()!='Status'){
		feed+="Status:<b>"+$("#lostsbyStatus").val()+"</b>";
	}
	if($("#loststype").val()!="default"){
var comm=document.getElementById("loststype").getElementsByTagName("option");
for(var i=0;i<comm.length;i++){
	if(comm[i].getAttribute("value")==$("#loststype").val()){
		feed+="&nbsp;&nbsp;&nbsp; Item : <b>"+comm[i].innerHTML+"</b>";
	break;
	}
}
}
	if($("#byPostoffice").val()!="All Post Offices"){
var comm=document.getElementById("byPostoffice").getElementsByTagName("option");
for(var i=0;i<comm.length;i++){
	if(comm[i].getAttribute("value")==$("#byPostoffice").val()){
		feed+="&nbsp;&nbsp;&nbsp; Postoffice : <b>"+comm[i].innerHTML+"</b>";
	break;
	}
}
}

	if($("#loststart").val()!='' && $("#lostend").val()!=''){
		feed+="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From <b>"+$("#loststart").val()+"</b> To <b>"+$("#lostend").val()+"</b>";
}
	break;
	case'items':
		if($("#itemsstart").val()!='' && $("#itemsend").val()!=''){
		feed+="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From <b>"+$("#itemsstart").val()+"</b> To <b>"+$("#itemsend").val()+"</b>";
}
break;
}
return feed;
}
function printReport(filterForm){
	$("#"+filterForm).hide();
	$("#companyInfoHeader").show();
	$("#footer").hide();
	window.print();
	$("#"+filterForm).show();
	$("#companyInfoHeader").hide();
	$("#footer").show();
	}
	function resetPwd() {//Reset Password for forgotten postoffice 
			ajax("ajax/postoffices",{"cate":"reset","resetid":$("#resetidreset").val(),"postoffid":$("#postoffidreset").val(),"postoffid":$("#postoffidreset").val(),"new":$("#nwresetpassword").val()},"GET","text",function(res){
		if(res=="ok"){
		$("#resetPwdResponse").html("<font color='green'>Password Reset Success</font>");
		$("#nwresetpassword").val("");$("#confresetpassword").val("");
		loadReqReset("setContent");
		}else{
		$("#resetPwdResponse").html("<font color='red'>Failed to Reset Password</font>");
		}
	});
	clearMsg("#resetPwdResponse");
	}
//===========OPTIONAL METHOD=======================
function setComboSelection(obj,elem,reference) {
    var selreps="";
    selreps="<option value='default'>Select Rate Type</option>";
    for (var i=0;i<obj.length;i++) {
        if (obj[i]==reference) {//selected current notifications
            selreps+="<option value="+obj[i]+" selected>"+obj[i]+"</option>";
        }else{//for one who has doesnt notifications
            selreps+="<option value="+obj[i]+">"+obj[i]+"</option>";
        }
    }//end loop
    $(elem).html(selreps);
}
function setLoaders(obj){
switch(obj.elemtype){
	case'table':
	var thead=document.getElementById(obj.elem).getElementsByTagName('thead')[0];
	var tdLen=thead.getElementsByTagName('tr')[0].getElementsByTagName('th').length;//colspan for tbody
	var tbody=document.getElementById(obj.elem).getElementsByTagName('tbody')[0];
tbody.innerHTML="<tr><td colspan="+tdLen+" style='font-size:14px;font-weight:bold'><center>"+obj.msg+"</center></td></tr>";
	break;
	case'container':
	document.getElementById(obj.elem).innerHTML=obj.msg;
	break;
}
}
function clickController(status,elem){
	var elems=document.querySelectorAll(elem),elemLenth=elems.length;
	if(status=='disable'){
		for(var i=0;i<elemLenth;i++){
			elems[i].setAttribute('disabled','disabled');
		}
	}else if(status=='enable'){
		for(var i=0;i<elemLenth;i++){
			elems[i].removeAttribute('disabled');
		}
	}
}
//AutoClear Msg
function clearMsg(elem){
setTimeout(function(){
$(elem).html("");
},5000);
}