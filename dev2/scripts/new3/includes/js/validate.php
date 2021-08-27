function validate(form){
	if(form.username.value==''){
		alert('Please enter your username');
		form.username.focus();
		return false;
	}
		if(form.password.value==''){
		alert('Please enter  your password');
		form.password.focus();
		return false;
	}

}

function validate2(form){
	if(form.username.value==''){
		alert('Please enter your username');
		form.username.focus();
		return false;
	}
		if(form.password_old.value==''){
		alert('Please enter  your old password');
		form.password_old.focus();
		return false;
	}
	
	if(form.password_new.value==''){
		alert('Please enter  your new password');
		form.password_new.focus();
		return false;
	}
	
	if(form.password_confirm.value==''){
		alert('Please confirm your new password');
		form.password_confirm.focus();
		return false;
	}
}


// Date Validation Javascript
// copyright 30th October 2004, by Stephen Chapman
// http://javascript.about.com

// You have permission to copy and use this javascript provided that
// the content of the script is not changed in any way.

function valDateFmt(datefmt) {myOption = -1;
for (i=0; i<datefmt.length; i++) {if (datefmt[i].checked) {myOption = i;}}
if (myOption == -1) {alert("You must select a date format");return ' ';}
return datefmt[myOption].value;}
function valDateRng(daterng) {myOption = -1;
for (i=0; i<daterng.length; i++) {if (daterng[i].checked) {myOption = i;}}
if (myOption == -1) {alert("You must select a date range");return ' ';}
return daterng[myOption].value;}
function stripBlanks(fld) {var result = "";for (i=0; i<fld.length; i++) {
if (fld.charAt(i) != " " || c > 0) {result += fld.charAt(i);
if (fld.charAt(i) != " ") c = result.length;}}return result.substr(0,c);}
var numb = '0123456789';
function isValid(parm,val) {if (parm == "") return true;
for (i=0; i<parm.length; i++) {if (val.indexOf(parm.charAt(i),0) == -1)
return false;}return true;}
function isNumber(parm) {return isValid(parm,numb);}
var mth = new Array(' ','january','february','march','april','may','june','july','august','september','october','november','december');
var day = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
function validateDate(fld,fmt,rng) {
var dd, mm, yy; var today=new Date();
var t = new Date;fld = stripBlanks(fld);
today.setDate(today.getDate()+2);
//today.setDate(today.getDate()-3);
if (fld == '') return false;var d1 = fld.split('\/');
if (d1.length != 3) d1 = fld.split(' ');
if (d1.length != 3) return false;
if (fmt == 'u' || fmt == 'U') {
  dd = d1[1]; mm = d1[0]; yy = d1[2];}
else if (fmt == 'j' || fmt == 'J') {
  dd = d1[2]; mm = d1[1]; yy = d1[0];}
else if (fmt == 'w' || fmt == 'W'){
  dd = d1[0]; mm = d1[1]; yy = d1[2];}
else return false;
var n = dd.lastIndexOf('st');
if (n > -1) dd = dd.substr(0,n);
n = dd.lastIndexOf('nd');
if (n > -1) dd = dd.substr(0,n);
n = dd.lastIndexOf('rd');
if (n > -1) dd = dd.substr(0,n);
n = dd.lastIndexOf('th');
if (n > -1) dd = dd.substr(0,n);
n = dd.lastIndexOf(',');
if (n > -1) dd = dd.substr(0,n);
n = mm.lastIndexOf(',');
if (n > -1) mm = mm.substr(0,n);
if (!isNumber(dd)) return false;
if (!isNumber(yy)) return false;
if (!isNumber(mm)) {
  var nn = mm.toLowerCase();
  for (var i=1; i < 13; i++) {
    if (nn == mth[i] ||
        nn == mth[i].substr(0,3)) {mm = i; i = 13;}
  }
}
if (!isNumber(mm)) return false;
dd = parseFloat(dd); mm = parseFloat(mm); yy = parseFloat(yy);
if (yy < 100) yy += 2000;
if (yy < 1582 || yy > 4881) return false;
if (mm == 2 && (yy%400 == 0 || (yy%4 == 0 && yy%100 != 0))) day[mm-1]++;
if (mm < 1 || mm > 12) return false;
if (dd < 1 || dd > day[mm-1]) return false;
t.setDate(dd); t.setMonth(mm-1); t.setFullYear(yy);
if (rng == 'p' || rng == 'P') {
if (t > today) return false;
}
else if (rng == 'f' || rng == 'F') {
if (t < today) return false;
}
else if (rng != 'a' && rng != 'A') return false;
return true;
}


function validate3(form){
	
	if(form.trip_type.value==''){
		alert('Please select Trip type');
		form.trip_type.focus();
		return false;
	}
	
	if(form.travel_date.value==''){
		alert('Please enter the travel date');
		form.travel_date.focus();
		return false;
	}
	
	if(form.passenger_count.value==''){
		alert('Please enter the number of passengers');
		form.passenger_count.focus();
		return false;
	}
	
	var vehiclechosen = getCheckedValue(form.vehicle);
	
	//Validate for towncar
	if(vehiclechosen ==1 && form.passenger_count.value >4 )
	{
		alert('Sorry you can only have a maximum of 4 passengers in a town car.\nPlease select a limo or van');
		form.passenger_count.focus();
		return false;
	}
	
	//Validate for limo
	if(vehiclechosen ==3 && form.passenger_count.value >8 )
	{
		alert('Sorry you can only have a maximum of 8 passengers in a Limousine car.\nPlease select a luxury van');
		form.passenger_count.focus();
		return false;
	}
	
	//Validate for Van
	if(vehiclechosen ==2 && form.passenger_count.value >14 )
	{
		alert('Sorry you can only have a maximum of 14 passengers in a Van.\nPlease enter 14 or less passengers');
		form.passenger_count.focus();
		return false;
	}

alert(form.vehicle.selectedIndex);

	//Check if No car is selected
	if(form.vehicle.selectedIndex.value =="")
	
	{
		alert('Please select a vehicle');
		//form.vehicle.focus();
		return false;
	}
}

function auto_address_update(form){
		form.first_name_billing.value = form.first_name.value;
		form.last_name_billing.value = form.last_name.value;
		form.address_billing.value = form.address.value;
		form.address2_billing.value = form.address2.value;
		form.city_billing.value = form.town.value;
		form.state_billing.value = form.state.value;
		form.zip_billing.value = form.zip.value;
		form.country_billing.value = form.country.value;
	}

