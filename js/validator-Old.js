var Validator={}
	Validator.errormsg={
invalidphone:"Invalid Phone Number",
invalidemail:"Invalid Email Address",
phonenbr:"Phone Number must be a number",
pwdmismatch:"Password does not match",
pwdlength:"Password character must be between 6 and 24",
invalidnid:"National Identity number Incorrect",
nidnbr:"National Identity must be a number",
nidlength:"National Identity must be a 16 Numbers",
amountnbr:"National Identity must be a number",
emptyamount:"Amount can not be Empty",
zeroamount:"Amount can not be Zero"
}
Validator.patterns={
	phone:/(25?)07[2,3,8][0-9]{7}/i,
	email:/^(([^<>()\[\]\\.,;:\s@]+(\.[^<>()\[\]\\.,;:\s@]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/i,
	nid:/1[0-9]{4}[7,8][0-9]{9}/i,
}
Validator.phone=function(phone){
var feed={};
if(!isNaN(phone) && (phone.length==10 || phone.length==12) && Validator.patterns.phone.test(phone)){
	feed.status=true;
	feed.msg='ok';
	}else{
feed.status=false;
if(isNaN()){
	feed.msg=Validator.errormsg.phonenbr;
}else{
	feed.msg=Validator.errormsg.invalidphone;
}
	}
return feed;
}
Validator.email=function(email){
	var feed={};
	if(Validator.patterns.email.test(email)){
		feed.status=true;
		feed.msg='ok';
	}else{
		feed.status=false;
		feed.msg=Validator.errormsg.invalidemail;
	}
	return feed;
}
Validator.nid=function(nid){
	var feed={}
	if(!isNaN(nid) && nid.length==16 && Validator.patterns.nid.test(nid)){
feed.status=true;
feed.msg='ok';
	}else{
feed.status=false;
if(isNaN(nid)){
feed.msg=Validator.errormsg.nidnbr;
}else if(nid!=16){
	feed.msg=Validator.errormsg.nidlength;
}else{
	feed.msg=Validator.errormsg.invalidnid;
}
}
return feed;
}
Validator.password=function(pwd){
	var feed={};
	if(pwd.length>=6 && pwd.length<=24){
		feed.status=true;
		feed.msg='ok';
	}else{
		feed.status=false;
		feed.msg=Validator.errormsg.pwdlength;
	}
	return feed;
}
Validator.amount=function(amount){
	var feed={},amount=amount.trim();
	if(!isNaN(amount) && amount.length>0 && amount>0){
		feed.status=true;
		feed.msg='ok';
	}else{
		feed.status=false;
		if(isNaN(amount)){
			feed.msg=Validator.errormsg.amountnbr;
		}
		if(amount.length==0){
			feed.msg=Validator.errormsg.emptyamount;
		}
		if(amount==0){
			feed.msg=Validator.errormsg.zeroamount;
		}
	}
}