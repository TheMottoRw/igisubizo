	$(document).ready(function(){
	var zeroStatus="";
	var errormsg={
invalidphone:"Invalid Phone Number",
invalidemail:"Invalid Email Address",
phonenbr:"Phone Number must be a number",
pwdmismatch:"Password does not match",
invalidnid:"National Identity number Incorrect"
}
var validate={
				phone:/07[2,3,8][0-9]{7}/i,
				email:/^(([^<>()\[\]\\.,;:\s@]+(\.[^<>()\[\]\\.,;:\s@]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/i,
				nid:/1[0-9]{4}[7,8]{1}[0-9]{9}/i,
			}
	$("#adduserbtn").click(function(e){
	e.preventDefault();
	$("#userinfo").hide();
	$("#breadcrumb").hide();
	$("#reguserform").show();
	loadCategory('setCombo',null)
});
$("#updbackusrinfo").click(function(e){//Back to View to Update
	e.preventDefault();
	$("#breadcrumb").show();
	$("#userinfo").show();
	$("#updmoduserform").hide();
	loadUser("setContent",null);
});

$("#regbackusrinfo").click(function(e){
	e.preventDefault();
	$("#userinfo").show();
	$("#breadcrumb").show();
	$("#reguserform").hide();
	$("#upduserform").hide();
loadUser("setContent",null);
});
//register User
$("#btnadduser").click(function(e){
e.preventDefault();
			
			if ($("#names").val().trim()!="" && $("#uname").val().trim()!="" && $("#email").val().trim()!=""
			&& $("#phone").val().trim()!="" && !isNaN($("#userCate").val()) && $("#pwd").val().trim()!="" && $("#confPwd").val().trim()!=""){ 
			if ($("#pwd").val()===$("#confPwd").val()) {
					if(validate.phone.test($("#phone").val()) && $("#phone").val().length==10 && validate.email.test($("#email").val())){
			if($("#userCate").val()==2){
				if(validate.nid.test($("#nid").val().trim().replace(" ","")) && $("#nid").val().trim().replace(" ","").length==16){
				registerUser();
			}else{
				$("#regUserResponse").html("<font color='red'>"+errormsg.invalidnid+"</font>");
			clearMsg("#regUserResponse");
		}
		}else{
	registerUser();
			}
				}else{//check which is invalid
				if(!validate.phone.test($("#phone").val()) || $("#phone").val().length!=10){
				$("#regUserResponse").html("<font color='red'>"+errormsg.invalidphone+"</font>");
				}
				if(!validate.email.test($("#email").val())){
				$("#regUserResponse").html("<font color='red'>"+errormsg.invalidemail+"</font>");
				}
				clearMsg("#regUserResponse");
			}

			}else{
				$("#regUserResponse").html("<font color='red'>"+errormsg.pwdmismatch+"</font>");
		document.getElementById("pwd").style.borderColor='red';
			document.getElementById("confPwd").style.borderColor='red';
		clearMsg("#regUserResponse");
			}
		}else{
			$("#regUserResponse").html("<font color='red'>Sorry,All Text Box and Combo Box are Required</font>");
		clearMsg("#regUserResponse");
		}
});
$("#keyUser").keyup(function(){
	searchUser();
});
$("#btnupduser").click(function(e){
	e.preventDefault();
			if ($("#updnames").val().trim()!="" && $("#upduname").val().trim()!="" && $("#updnid").val().trim()!="" && $("#updemail").val().trim()!=""
			&& $("#updphone").val().trim()!="" && !isNaN($("#upduserCate").val())){ 
		if(validate.phone.test($("#updphone").val()) && $("#updphone").val().length==10 && validate.email.test($("#updemail").val())){
					if(validate.nid.test($("#nid").val().trim().replace(" ","")) && $("#updnid").val().trim().replace(" ","").length==16){
				updateUser();
			}else{
				$("#updUserResponse").html("<font color='red'>"+errormsg.invalidnid+"</font>");
			clearMsg("#updUserResponse");
		}
				}else{//check which is invalid
				if(!validate.phone.test($("#updphone").val()) || $("#updphone").val().length!=10){
				$("#updUserResponse").html("<font color='red'>"+errormsg.invalidphone+"</font>");
				}
				if(!validate.email.test($("#updemail").val())){
				$("#updUserResponse").html("<font color='red'>"+errormsg.invalidemail+"</font>");
				}
				clearMsg("#updUserResponse");
			}
		}else{
			$("#updUserResponse").html("<font color='red'>Sorry,All Text Box and Combo Box are Required</font>");
			clearMsg("#updUserResponse");
		}	
});
    $("#btnResetUser").click(function(){
        if($("#resetnwpassword").val()==$("#resetconfpassword").val()){
            resetUserPassword();
        }else{
            $("#resetResponse").html("<font color='red'>Password doen not Match");
        }
    });
$("#btnDelUser").click(function(){
	deleteUser();
});
	//end user form
	
	
$("#btnSavePostOffice").click(function(e){
e.preventDefault();
			if ($("#postName").val().trim()!="" && $("#representativeName").val().trim()!="Select Representative" && $("#postPhone").val().trim()!=""
			&& $("#postPassword").val().trim()!="" && !isNaN($("#province").val()) && !isNaN($("#district").val())
			&& !isNaN($("#sector").val()) && $("#postCell").val().trim()!=""){ 
			if(validate.phone.test($("#postPhone").val()) && $("#postPhone").val().trim().replace(" ","").length==10){
			registerPostOffices();
		}else{
		$("#regPostOfficeResponse").html("<font color='red'>"+errormsg.invalidphone+"</font>");
			clearMsg("#regPostOfficeResponse");
		}
		}else{
			$("#postName").val().trim().replace(" ","")==""?document.getElementById("postName").style.borderColor='red':document.getElementById("postName").style.borderColor='lightgray';
			isNaN($("#representativeName").val())?document.getElementById("representativeName").style.borderColor='red':document.getElementById("representativeName").style.borderColor='lightgray';
			$("#postPhone").val().trim().replace(" ","")==""?document.getElementById("postPhone").style.borderColor='red':document.getElementById("postPhone").style.borderColor='lightgray';
			$("#postPassword").val().trim().replace(" ","")==""?document.getElementById("postPassword").style.borderColor='red':document.getElementById("postPassword").style.borderColor='lightgray';
			isNaN($("#province").val())?document.getElementById("province").style.borderColor='red':document.getElementById("province").style.borderColor='lightgray';
			isNaN($("#district").val())?document.getElementById("district").style.borderColor='red':document.getElementById("district").style.borderColor='lightgray';
			isNaN($("#sector").val())?document.getElementById("sector").style.borderColor='red':document.getElementById("sector").style.borderColor='lightgray';
			$("#postCell").val().trim().replace(" ","")==""?document.getElementById("postCell").style.borderColor='red':document.getElementById("postCell").style.borderColor='lightgray';
			$("#regPostOfficeResponse").html("<font color='red'>Sorry,All Text Box and Combo Box are Required,Only Address optional</font>");
			clearMsg("#regPostOfficeResponse");
		}
	});
	
$("#keyPostOffice").keyup(function(){
	searchPostOffices();
});
$("#btnUpdPostOffice").click(function(e){
	e.preventDefault();
			if ($("#updpostName").val().trim()!="" && $("#updrepresentativeName").val().trim()!="Select Representative" && $("#updpostPhone").val().trim()!=""
			&& !isNaN($("#updprovince").val()) && !isNaN($("#upddistrict").val())
			&& !isNaN($("#updsector").val()) && $("#updpostCell").val().trim()!=""){ 
	updatePostOffices();
}else{
	$("#postName").val().trim().replace(" ","")==""?document.getElementById("postName").style.borderColor='red':document.getElementById("postName").style.borderColor='lightgray';
			$("#updrepresentativeName").val().trim().replace(" ","")==""?document.getElementById("updrepresentativeName").style.borderColor='red':document.getElementById("postName").style.borderColor='lightgray';
			$("#updpostPhone").val().trim().replace(" ","")==""?document.getElementById("updpostPhone").style.borderColor='red':document.getElementById("updpostPhone").style.borderColor='lightgray';
			isNaN($("#updprovince").val())?document.getElementById("updprovince").style.borderColor='red':document.getElementById("updprovince").style.borderColor='lightgray';
			isNaN($("#upddistrict").val())?document.getElementById("upddistrict").style.borderColor='red':document.getElementById("upddistrict").style.borderColor='lightgray';
			isNaN($("#updsector").val())?document.getElementById("updsector").style.borderColor='red':document.getElementById("updsector").style.borderColor='lightgray';
			$("#updpostCell").val().trim().replace(" ","")==""?document.getElementById("updpostCell").style.borderColor='red':document.getElementById("updpostCell").style.borderColor='lightgray';
			
			$("#updPostOfficeResponse").html("<font color='red'>Sorry,Fill All Text Box and Combo Box are Required,Only Address optional</font>");
			clearMsg("#updPostOfficeResponse");
}	
});
$("#btnDelPostOffice").click(function(){
	deletePostOffices();
});
$("#addNewPostOfficeMod").click(function(e){
	e.preventDefault();
	setComboProv("#province");
});
$("#btnSaveType").click(function(e){
e.preventDefault();
if ($("#type").val().trim().replace(" ","")!="") {
registerTypes();
}else {
	document.getElementById("type").style.borderColor='red';
	$("#regTypeResponse").html("<font color='red'>Lost type Name can not be empty</font>");
clearMsg("#regTypeResponse");
}
});
$("#keyType").keyup(function(){
	searchTypes();
});
$("#btnUpdType").click(function(e){
	e.preventDefault();
if ($("#updType").val().trim()!="") {
		updateTypes();
		}else {
			document.getElementById("updType").style.borderColor='red';
	$("#updateTypeResponse").html("<font color='red'>Lost type Name can not be empty</font>");
	clearMsg("#updateTypeResponse");
}
});
$("#btnDelType").click(function(){
	if ($("#delReason").val().trim()!="") {
		deleteTypes();
	}else {
		document.getElementById("delReason").style.borderColor='red';
		$("#delResponse").html("Reason Should not be empty");
	}
});
$("#btnSaveWithdrawCompany").click(function(e){
e.preventDefault();
if ($("#wthcName").val().trim().replace(" ","")!="" && $("#wthcAccr").val().trim().replace(" ","")!="") {
registerWithdrawCompany();
}else {
    document.getElementById("wthcName").value.trim().replace(" ","")==""?document.getElementById("wthcName").style.borderColor='red':document.getElementById("wthcName").style.borderColor='lightgray';
    document.getElementById("wthcAccr").value.trim().replace(" ","")==""?document.getElementById("wthcAccr").style.borderColor='red':document.getElementById("wthcAccr").style.borderColor='lightgray';
    $("#regWithdrawCompanyResponse").html("<font color='red'>All Textbox are Required</font>");
clearMsg("#regWithdrawCompanyResponse");
}
});
$("#keyWithdrawCompany").keyup(function(){
    searchWithdrawCompany();
});
$("#btnUpdWithdrawCompany").click(function(e){
    e.preventDefault();
 if ($("#updWthcName").val().trim().replace(" ","")!="" && $("#updWthcAccr").val().trim().replace(" ","")!="") {
  updateWithdrawCompany();
        }else {
           document.getElementById("updWthcName").value.trim().replace(" ","")==""?document.getElementById("updWthcName").style.borderColor='red':document.getElementById("updWthcName").style.borderColor='lightgray';
    document.getElementById("updWthcAccr").value.trim().replace(" ","")==""?document.getElementById("updWthcAccr").style.borderColor='red':document.getElementById("updWthcAccr").style.borderColor='lightgray';
 $("#updateWithdrawCompanyResponse").html("<font color='red'>All Textbox are Required</font>");
    clearMsg("#updateWithdrawCompanyResponse");
}
});
$("#btnDelWithdrawCompany").click(function(){
    if ($("#delReason").val().trim()!="") {
        deleteWithdrawCompany();
    }else {
        document.getElementById("delReason").style.borderColor='red';
        $("#delResponse").html("Reason Should not be empty");
    }
});
//FOR Representatives
$("#btnSaveRep").click(function(e){
e.preventDefault();
if ($("#repname").val().trim()!="" && $("#repphone").val().trim()!=""&& $("#repemail").val().trim()!="") {
registerRepresentative();
}else {
	$("#repname").val().trim().replace(" ","")==""?document.getElementById("repname").style.borderColor='red':document.getElementById("repname").style.borderColor='lightgray';
			$("#repphone").val().trim().replace(" ","")==""?document.getElementById("repphone").style.borderColor='red':document.getElementById("repphone").style.borderColor='lightgray';
			$("#repemail").val().trim().replace(" ","")==""?document.getElementById("repemail").style.borderColor='red':document.getElementById("repemail").style.borderColor='lightgray';
			
	$("#regRepResponse").html("<font color='red'>All TextBox Are Required</font>");
clearMsg("#regRepResponse");
}
});
$("#keyRep").keyup(function(){
	searchRepresentative();
});
$("#btnUpdRep").click(function(e){
	e.preventDefault();
if ($("#updrepname").val().trim()!="" && $("#updrepphone").val().trim()!=""&& $("#updrepemail").val().trim()!="") {
		updateRepresentative();
		}else {
			$("#updrepname").val().trim().replace(" ","")==""?document.getElementById("updrepname").style.borderColor='red':document.getElementById("updrepname").style.borderColor='lightgray';
			$("#updrepphone").val().trim().replace(" ","")==""?document.getElementById("updrepphone").style.borderColor='red':document.getElementById("updrepphone").style.borderColor='lightgray';
			$("#updrepemail").val().trim().replace(" ","")==""?document.getElementById("updrepemail").style.borderColor='red':document.getElementById("updrepemail").style.borderColor='lightgray';
	$("#updateRepResponse").html("<font color='red'>Lost type Name can not be empty</font>");
	clearMsg("#updateRepResponse");
}
});
$("#btnDelRep").click(function(){
	if ($("#repdelReason").val().trim()!="") {
	deleteRepresentative();
	}else {
		document.getElementById("repdelReason").style.borderColor='red';
		$("#repdelResponse").html("<font color='red'>Reason Should not be Empty</font>");
	}
});

$("#province").change(function(){
	setComboDist($(this),"#district")
});
$("#district").change(function(){
	setComboSec($(this),"#sector")
});

$("#updprovince").change(function(){
	setComboDist($(this),"#upddistrict");
});
$("#upddistrict").change(function(){
	setComboSec($(this),"#updsector");
});
$("#changePwd").click(function (e) {//for super admin
	e.preventDefault();
	if ($("#oldpassword").val().trim()!="" && $("#nwpassword").val().trim()!="" && $("#confpassword").val().trim()!="") {
	if ($("#nwpassword").val()==$("#confpassword").val()) {
changePwd();	
	}else{
		document.getElementById("doesnotmatch").style.color='red';
		document.getElementById("doesnotmatch").innerHTML='Password doesn\'t match';
		setTimeout(function () {
			document.getElementById("doesnotmatch").innerHTML='';
		},3000);
			document.getElementById("nwpassword").style.borderColor="red";
		document.getElementById("confpassword").style.borderColor="red";
	}
}else {	setTimeout(function () {
	$("#changePwdResponse").html("<font color='red'>All PasswordBox Are Required</font>");},3000);
		document.getElementById("oldpassword").style.borderColor="red";
		document.getElementById("confpassword").style.borderColor="red";
			document.getElementById("nwpassword").style.borderColor="red";
}
});
$("#reqReset").click(function(){
	requestReset();	
		});
$("#resetPwd").click(function (e) {//Reset Password for postoffice forgotten
	e.preventDefault();
	if ($("#nwresetpassword").val()==$("#confresetpassword").val()) {
resetPwd();	
}else{
		document.getElementById("doesnotmatchreset").style.color='red';
		document.getElementById("doesnotmatchreset").innerHTML='Password doesn\'t match';
		setTimeout(function () {
			document.getElementById("doesnotmatchreset").innerHTML='';
		},3000);
			document.getElementById("nwresetpassword").style.borderColor="red";
		document.getElementById("confresetpassword").style.borderColor="red";
	}
});
$("#btnSavePaymode").click(function(e){
e.preventDefault();
if($("#paymodename").val().trim().replace(" ","")!="" &&$("#company").val().trim().replace(" ","")!="" &&$("#accname").val().trim().replace(" ","")!="" &&$("#accnumber").val().trim().replace(" ","")!=""){
registerPaymentMode();
}else{
	$("#regPaymodeResponse").html("<font color='red'>Sorry..! All Texboxes are Required </font>");
	clearMsg("#regPaymodeResponse");
}
});
$("#keyPaymode").keyup(function(){
	searchPaymentMode();
});
$("#btnUpdPaymode").click(function(e){
	e.preventDefault();
if($("#updpaymodename").val().trim().replace(" ","")!="" &&$("#updcompany").val().trim().replace(" ","")!="" &&$("#updaccname").val().trim().replace(" ","")!="" &&$("#updaccnumber").val().trim().replace(" ","")!=""){
updatePaymentMode();
}else{
	$("#updatePaymodeResponse").html("<font color='red'>Sorry..! All Texboxes are Required </font>");
	clearMsg("#updatePaymodeResponse");
}

});
$("#btnDelPaymode").click(function(){
	if ($("#delReason").val().trim()!="") {
		deletePaymentMode();
	}else {
		document.getElementById("delReason").style.borderColor='red';
		$("#delResponse").html("Reason Should not be empty");
	}
});
//Payment Information
$("#btnUpdPayment").click(function(e){
	e.preventDefault();
if ($("#updPaymentAmount").val().trim()!="") {
	if(!isNaN($("#updPaymentAmount").val())){
		updatePayments();
	}else{
$("#updatePaymentResponse").html("<font color='blue'>Payment Amount Must be a Number<font>");
	clearMsg("#updatePaymentResponse");
	}
		}else {
		$("#updatePaymentResponse").html("<font color='red'>Payment Amount can not be empty</font>");
	clearMsg("#updatePaymentResponse");
	}
});
//Payment approval
$("#btnApprovePayment").click(function(){
approvePaymentsHistory();
});
//Withdraw approval
$("#btnApproveWithdraw").click(function(){
	if($("#given").val().trim().replace(" ","")!="" && $("#given").val().trim().replace(" ","")>0){
if($("#given").val()<=$("#requested").val()){
approveWithdrawsHistory();
}else{
		$("#approveWithdrawResponse").html("<font color='red'>Given can not be greater than Requested</font>");
	clearMsg("#approveWithdrawResponse");	
}
}else{
		$("#approveWithdrawResponse").html("<font color='red'>Amount must be greater Than Zero</font>");
	clearMsg("#approveWithdrawResponse");	
}
});
//Commissions Information
$("#btnUpdCommission").click(function(e){
  e.preventDefault();
if ($("#updCommissionRate").val().trim()!="") {
  if(!isNaN($("#updCommissionRate").val())){
  	if($("#updCommissionRateType").val()!='default'){
    updateCommissions();
}else{
$("#updateCommissionResponse").html("<font color='blue'>You Must Select Rate Type<font>");
  clearMsg("#updateCommissionResponse");
}
  }else{
$("#updateCommissionResponse").html("<font color='blue'>Rate Must be a Number<font>");
  clearMsg("#updateCommissionResponse");
  }
    }else {
    $("#updateCommissionResponse").html("<font color='red'>Rate can not be empty</font>");
  clearMsg("#updateCommissionResponse");
  }
});
//ADMIN INFOS
$("#adprof").click(function () {
	//loadAdminInfo();
	loadProfile();
});
$("#btnEditAdInfo").click(function (e) {
	e.preventDefault();
	$(this).hide();$("#viewAdInfo").hide();$("#changeAdInfo").show();$("#btnChangeAdInfo").show();
	});
	$("#backToView").click(function (e) {
		e.preventDefault();
		loadAdminInfo();
	$("#btnEditAdInfo").show();$("#viewAdInfo").show();$("#changeAdInfo").hide();$("#btnChangeAdInfo").hide();
	});
	$("#btnChangeAdInfo").click(function (e) {
		e.preventDefault();
		if ($("#adUname").val().trim()!="" && $("#adEmail").val().trim()!="") {
		updateAdminInfo();
		}else {
			var msg="";
			if ($("#adUname").val().trim().replace(" ","")=="" && $("#adEmail").val().trim()!="") msg="Username";
			else if ($("#adUname").val().trim()!="" && $("#adEmail").val().trim().replace(" ","")=="") msg="Email";
			else msg="Username and Email";
			$("#changeAdminResponse").html("<font color='red'>"+msg+" Can not be Empty</font>");
			clearMsg("#changeAdminResponse");}
	});
//All Informations about Report and their Filter
//Citizens
$("#citcheckRange").click(function(){
loadCitizens("setReport");
$("#citReportHeader").html(captionReportHeaderGenerator("citizens"));
});
//Losts
$("#lostscheckRange").click(function(){
loadLosts("setReport");
$("#citReportHeader").html(captionReportHeaderGenerator("citizens"));
});
//Payment History
$("#payhistcheckRange").click(function(){
loadPaymentsHistory("setReport");
$("#payhistReportHeader").html(captionReportHeaderGenerator("payhist"));
});
//Withdraw
$("#wthcheckRange").click(function(){
loadWithdrawsHistory("setReport");
$("#wthReportHeader").html(captionReportHeaderGenerator("withdraw"));
});
//Queues
$("#itemscheckRange").click(function(){
loadQueues("setReport");
$("#itemsReportHeader").html(captionReportHeaderGenerator("items"));
});
//losts
$("#lostcheckRange").click(function (e) {
e.preventDefault();
loadDynamicReport();
$("#lostsReportHeader").html(captionReportHeaderGenerator("losts"));
});
$("#citbtnPrintReport").click(function (e) {
printReport("citFilterForm");
});
$("#wthbtnPrintReport").click(function (e) {
printReport("wthFilterForm");
});
$("#payhistbtnPrintReport").click(function (e) {
printReport("payhistFilterForm");
});
$("#lostbtnPrintReport").click(function(e){
printReport("lostsFilterForm");
});

$("#itemsbtnPrintReport").click(function(e){
printReport("itemsFilterForm");
});
$("#btnPrintPost").click(function (e) {
	$(this).hide();$("#addNewPostOfficeMod").hide();$("#keyPostOffice").hide();$(".loadedpostmodif").hide();
	$(document).html($("#postofficeviewform").html());
	window.print();
});
$("#btnPrintType").click(function (e) {
	$(this).hide();$("#btnAddType").hide();$("#keyType").hide();$(".loadedtypemodif").hide();
	$(document).html($("#typeviewform").html());
	window.print();
});
$("#btnPrintWithdrawCompany").click(function (e) {
	$(this).hide();$("#btnAddType").hide();$(".loadedwthcompanymodif").hide();
	$(document).html($("#wthcompanyviewform").html());
	window.print();
});
$("#btnPrintReps").click(function (e) {
	$(this).hide();$("#btnAddRep").hide();$("#keyRep").hide();$(".loadedrepmodif").hide();
	$(document).html($("#repviewform").html());
	window.print();
});
function autoLoad(){
var url=document.URL.replace("#","").split("/");
	var page=url[url.length-1];
	switch(page){
		case'users':loadUser('setContent',null);break;
		case'postoffice':loadPostOffices("setContent");loadRepresentative("setCombo",null);break;
		case'citizens':loadCitizens("setContent");break;
		case'categories':loadCategory("setContent");break;
		case'types':loadTypes("setContent");break;
		case'payments':loadPayments("setContent");break;
		case'payhist':loadPaymentsHistory("setContent");break;
		case'withdraw':loadWithdrawsHistory("setContent");break;
		case'wthcompany':loadWithdrawCompany("setContent",null);break;
		case'modes':loadPaymentMode("setContent",null);break;
		case'ratios':loadCommissions("setContent");break;
		case'support':loadReqReset("setContent");break;
		case'dashboard':fillDashboard();break;
		case'report?cate=citizens':loadUser("setComboCommissioner",null);break;
		case'report?cate=payhist':loadPaymentMode("setCombo",null);break;
		case'report?cate=withdraw':loadWithdrawCompany("setCombo",null);break;
		case 'report?cate=losts':loadTypes("setCombo");loadPostOffices("setCombo");loadDefaultReport();break;
		case 'representatives':loadRepresentative("setContent",null);break;
	}

}
autoLoad();
});