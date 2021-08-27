<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/page_functions.php");
include("includes/functions/vehicle_functions.php");

$all_vehicles = get_all_vehicles();
$page = get_pages_view('fleet');
$page_banner = get_pages_view('specials_banner');
$page_bottom = get_pages_view('quote_bottom');
$company_info = get_company_info(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $page['page_title'];?></title>
<meta name="keywords" content="<?php echo $page['meta_keywords']; ?>">
<meta name="description" content="<?php echo $page['meta_description']; ?>">
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {color: #FF0000}
-->
</style>
<script type="text/javascript" src="includes/js/date.js"></script>
<script type="text/javascript" src="includes/js/validate.js"></script>
<script type="text/javascript" src="includes/js/menu.js"></script>
<script language="javascript">
	function setcarseat(id){
		if(id=="1" || id=="3"){
			document.reserve.child_carseat.disabled = true;
			document.reserve.child_carseat.checked = false;
		}
		else
			document.reserve.child_carseat.disabled = false;
	}
</script>

</head>
<body onload="MM_preloadImages('images/fleet_active.gif','images/faq_active.gif','images/testimonials_active.gif','images/reserve_active.gif','images/contact_active.gif','images/home_active.gif','images/rates_active.gif')">
<div id="Wrapper"> 
 <!--Start Header Here -->
    	<div id="Header">
    	 <?php include('includes/common/seasonal_header.php'); ?>
		<!--
    	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="19%" valign="middle"><img src="images/sunstate.gif" alt="Sunstate" /></td>
              <td width="81%" align="right"><img src="images/topRightCars.jpg" width="367" height="102" border="0" usemap="#Map" /></td>
            </tr>
          </table>
		  -->
    	</div>
<!--End Header Here -->
<!--Start Navigation Here -->
        <div id="Navigation">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><a href="index.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image19','','images/home_active.gif',1)"><img src="images/home_normal.gif" name="Image19" width="71" height="33" border="0" id="Image19" /></a><a href="index.php"></a></td>
                <td><a href="rates.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image40','','images/rates_active.gif',1)"><img src="images/rates_normal.gif" name="Image40" width="93" height="33" border="0" id="Image40" /></a></td>
                <td><img src="images/fleet_active.gif" width="85" height="33" /></td>
                <td><a href="faq.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/faq_active.gif',1)"><img src="images/faq_normal.gif" name="Image6" width="81" height="33" border="0" id="Image6" /></a></td>
                <td><a href="testimonial.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','images/testimonials_active.gif',1)"><img src="images/testimonials_normal.gif" name="Image7" width="139" height="33" border="0" id="Image7" /></a></td>
                <td><a href="reserve.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','images/reserve_active.gif',1)"><img src="images/reserve_normal.gif" name="Image8" width="153" height="33" border="0" id="Image8" /></a></td>
                <td><a href="contact.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9','','images/contact_active.gif',1)"><img src="images/contact_normal.gif" name="Image9" width="116" height="33" border="0" id="Image9" /></a></td>
              </tr>
            </table>
        </div>
<!--End Navigation Here --> 
<div id="Banner"> 
<img src="images/<?php echo $img_head;?>" /><br />
</div>
<!--Start ContentPanl Here -->
<div id="ContentPanel"> 
	<div id="LeftColumn"> 
   	  <div id="Login" class="LeftBox">
      <?php include("login_tab.php"); ?>
      </div>
        <div id="b2" style="margin-bottom:3px;"><img src="../images/Image/B2.jpg" border="0" usemap="#Map2" />
<map name="Map2" id="Map2"><area shape="rect" coords="13,8,168,79" href="reserve.php?vehicle=town_car" />
<area shape="rect" coords="12,89,170,153" href="reserve.php?vehicle=limousine" />
<area shape="rect" coords="12,164,169,237" href="reserve.php?vehicle=van" />
<area shape="rect" coords="4,243,172,268" href="reserve.php" />
</map></div>
        <div id="b3" style="margin-bottom:3px;"><a href="reserve.php"><img src="../images/Image/B3.jpg" border="0" /></a> </div>
           <div style="padding-top:10px; padding-bottom:10px;">
           <img src="images/secure_site.jpg" border="0" alt="THIS IS A SECURE SITE" title="THIS IS A SECURE SITE" />
           </div>
    
    
    </div> 
    
    <div id="RightColumn"> 
            <?php echo $page['page_content']; ?>
            <div id="Box3" class="Box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="top">Orlando Airport Transportation Reservations</td>
        </tr>
        <tr>
          <td class="middle">
          <script type="text/javascript">
var http = createRequestObject();
function createRequestObject() {
	var objAjax;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
		objAjax = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		objAjax = new XMLHttpRequest();
	}
	return objAjax;
}

function getNewContent(val){


http.open('get','loadlocations.php?val='+val);
http.onreadystatechange = updateNewContent;
http.send(null);
return false;
}

function updateNewContent(){
if(http.readyState == 4){
document.getElementById('myLocation').innerHTML = http.responseText;
}
}

function getNewlocationContent(val){
http.open('get','loadflight1.php?val='+val);
http.onreadystatechange = updateNewLocationContent;
http.send(null);
return false;
}

function updateNewLocationContent(){
if(http.readyState == 4){
document.getElementById('myLocationdetails').innerHTML = http.responseText;
}
}

function getNewlocationtoContent(val){
http.open('get','loadflight2.php?val='+val);
http.onreadystatechange = updateNewLocationtoContent;
http.send(null);
return false;
}

function updateNewLocationtoContent(){
if(http.readyState == 4){
document.getElementById('myLocationdetailsto').innerHTML = http.responseText;
}
}
</script>
<script language="Javascript">
function xmlhttpPost(strURL) {
    var xmlHttpReq = false;
    var self = this;
    // Mozilla/Safari
    if (window.XMLHttpRequest) {
        self.xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject) {
        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
    self.xmlHttpReq.open('POST', strURL, true);
    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    self.xmlHttpReq.onreadystatechange = function() {
        if (self.xmlHttpReq.readyState == 4) {
            updatepage(self.xmlHttpReq.responseText);
        }
    }
    self.xmlHttpReq.send(getquerystring());
}

function getquerystring() {
    var form     = document.forms['reserve'];
	var vehicle_id = getCheckedValue(form.vehicle);
    var passenger_count = form.passenger_count.value;
	var trip_type = form.trip_type.value;
	var from = form.from.value;
	var to = form.to.value;

	qstr = 'vehicle_id=' + escape(vehicle_id) +  '&passenger_count=' + escape(passenger_count) +  '&trip_type=' + escape(trip_type) +  '&from=' + escape(from) +  '&to=' + escape(to);  // NOTE: no '?' before querystring
    return qstr;
}

function updatepage(str){
    //document.getElementById("result").innerHTML = str;
	document.reserve.total_amount.value = str;
}
</script>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="100%" valign="top"><form id="reserve" style="padding-top:0px;" name="reserve" method="post" action="https://www.sunstatelimo.com/reserve_step2.php" onsubmit="return validate3(this)">
                      <?php echo $page_banner['page_content']; ?>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr valign="middle">
                <td align="center" height="30" width="100%" colspan="2" class="ob">
                        <?php 
						$all_vehicles = get_all_vehicles();
						if(count($all_vehicles)>=1){
						?>
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="BorderBox">
              <tbody>
                <tr>
                <?php
				$count =0;
				foreach($all_vehicles as $value){
				?>
                <td width="33%" valign="top" height="0" align="center" bgcolor="#fefa8e">
                <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFCC">
                      <tbody>
                        <tr bgcolor="#fefa8e">
                          <td width="100%" height="25" align="center" bgcolor="#D7E0E4" class="ot"><b><?php echo $value['name']; ?></b><br />
                            <input name="vehicle" value="<?php echo $value['id']; ?>" type="radio" onclick="setcarseat(getCheckedValue(this));" />
                            </td>
                        </tr>
                      </tbody>
                  </table>
                  <table border="0" height="100" align="center" cellpadding="0" cellspacing="0">
                  	<tr>
                  		<td valign="bottom" height="0" align="center" bgcolor="#FFFFFF"><div align="center" style="padding-top:5px; padding-bottom:5px;">
                      <?php if (!empty($value['vehicle_image'])) { ?><img src="media/images/thumbs/<?php echo $value['vehicle_image']; ?>" alt="<?php echo $value['name']; ?>" width="168" title="<?php echo $value['name']; ?>" /><?php } ?>
                    
                  </div></td>
                  	</tr>
                 </table>
                 <table width="100%" height="100%" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFCC">
                      <tbody>
                        <tr bgcolor="#fefa8e">
                          <td width="100%" height="100%" class="ot"><?php echo $value['description']; ?></td>
                    </tr>
                  </table>
                  
                  </td>
                <?php
				$count++;
				if ($count > 2 ) {
				echo "</tr><tr>";
				$count =0;
							}
				}
				?>
                 </tr>
              </tbody>
              </table>
              <?php 
			  
			  }
			  
			  ?>
                </td>
			  </tr>
                      <tr valign="middle">
                <td align="right" height="30" width="20%" class="ob"><strong>Trip Type: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="80%" class="ot2"><select name="trip_type" id="trip_type" required="yes" size="1" onchange="javascript:getNewContent(this.value);">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Area">
                                      <option value="1">Orlando Area - One Way</option>
                                      <option value="2">Orlando Area - Round Trip</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Cruise Transfer">
                                      <option value="76">Disney/Universal>Cruise>MCO - Round trip</option>
                                      <option value="3">MCO to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="4">MCO to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="5">Disney/Universal to Cruise Terminal/Port Area - One Way</option>
                                      <option value="6">Disney/Universal to Cruise Terminal/Port Area - Round Trip</option>
                                      <option value="7">MCO>Disney or Universal>Cruise terminal>MCO (3 leg)</option>
                                      <option value="8">MCO>Cruise Terminals>Disney or Universal>MCO (3 leg)</option>
                                      <option value="9">Sanford to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="11">Sanford to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="10">Sanford>Cruise Terminals>Disney or Universal>Sanford</option>
									  </OPTGROUP>
                                      <OPTGROUP LABEL="Attraction Transfer">
                                      <option value="12">Disney Resort to Universal/Sea World - One Way</option>
                                      <option value="13">Disney Resort to Universal/Sea World - Round Trip</option>
                                      <option value="77">Disney Resort to SeaWorld Theme Park - One Way</option>
                                      <option value="78">Disney Resort to SeaWorld Theme Park - Round Trip</option>
                                      <option value="79">Disney Resort to Universal Theme Park - One Way</option>
                                      <option value="80">Disney Resort to Universal Theme Park - Round Trip</option>
									  </OPTGROUP>
                                    </select></td>
              </tr>
              <tr valign="middle">
              	<td colspan="2" height="30"><p id="myLocation" align="center">When you click the trip type, this content will be replaced.</p>
                </td>
              </tr>
                    </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="100%" valign="top">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        	<tr>
                            	<td width="28%" valign="top" class="ot">
                                <strong>Transfer Date: <font color="#ff0000" size="2">*</font></strong>      							</td>
                                <td width="65%" valign="top" class="ot">
                                <input value="U" name="datefmt" type="radio" checked="checked" style="display:none;"><input value="W" name="datefmt" type="radio" style="display:none;"><input value="J" name="datefmt" type="radio" style="display:none;"><input value="P" name="daterng" type="radio" style="display:none;"><input value="A" name="daterng" type="radio" style="display:none;"><input value="F" name="daterng" type="radio" checked="checked" style="display:none;">
                        <input name="travel_date" type="text" id="travel_date" size="10" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('travel_date');"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY                				</td>
                                <td width="7%" valign="top" class="ot">&nbsp;                                </td>
                            </tr>
                            <tr>
                            	<td width="28%" valign="top" class="ot">
                                <strong>Passenger Count: <font color="#ff0000" size="2">*</font></strong>      							</td>
                                <td width="65%" valign="top" class="ot">
                        <input name="passenger_count" type="text" id="passenger_count" size="4" maxlength="4"> &nbsp;&nbsp;&nbsp;
                        <input name="child_carseat" type="checkbox" value="Yes" />
                        <label><strong>Car Seat</strong></label>
                        <input name="child_boosterseat" type="checkbox" id="child_boosterseat" value="Yes" />
                        <label><strong>Booster Seat</strong></label></td>
                                <td width="7%" valign="top" class="ot">&nbsp;                                </td>
                            </tr>
                           <tr valign="middle">
                				<td align="right" height="43" width="28%" class="ob"></td>
                				<td align="left" height="43" width="65%" class="ot2" background="images/price_box.jpg" style="background-repeat:no-repeat;">&nbsp;&nbsp;<span style="font-size:16px;"><strong>Quote:</strong></span> &nbsp;<span style="color:#000000; font-size:16px;">$<input name="total_amount" id="total_amount" class="bodytxt" size="12" type="text" disabled="disabled" style="font-size:16px; color:#000000; background-color:#ff9600; border:#ff9600 solid 1px; font-weight:bold;"> </span></td>
                                <td width="7%" valign="top" class="ot">&nbsp;                                </td>
              				</tr>
                            <tr valign="middle">
                				<td height="10" colspan="2" align="center" class="ob style2"><span class="ob style1 style1 style2">Note: For round trip  you can enter return date on next step</span></td>
                				<td width="7%" valign="top" class="ot">                             </td>
              				</tr>
                        </table>
                        </td>
                      </tr>
                      <tr>
                         <td colspan="2" align="right"><input value="Get Quote" type="button" style="border:#648ACE solid 1px; color:#FFFFFF; background-color:#ff9600; padding:3px;" onclick="return validate4(document.reserve);"> <input name="submit3" value="Click here to Reserve Now" style="border:#648ACE solid 1px; color:#FFFFFF; background-color:#49cb1c; padding:3px;" type="submit" onclick="if (validateDate(reserve.travel_date.value, valDateFmt(reserve.datefmt),valDateRng(reserve.daterng))) {}else {alert('You can only reserve online if your arrival is <?php echo $company_info['minimum_time']*24; ?>hrs prior.\n\nPlease call 407-601-7900 to reserve over the phone'); return false;}">
                         </td>
                     </tr>
                    </table>
                      </form>
                      </td>
                </tr>
              </table>
              <div id="Divider" class="Divider"> </div>
              <div id="Notes" class="Notes"><?php echo $page_bottom['page_content']; ?> </div>
          </td>
        </tr>
        <tr>
          <td class="footer">&nbsp;</td>
        </tr>
      </table>
    </div>
    </div>     	
</div>
      </div>
</div>
<!--End ContentPanl Here -->
<div id="Clear"> </div>
<!--Start Footer Here -->
        <div id="Footer">
          <?php include("includes/common/footer.php"); ?>
</div>
	<div align="center" style="padding:5px;">
    Designed by: <a href="http://www.imperialwebsolutions.net/" target="_blank">Imperial Web Solutions</a>
    | For Support Click <a href="mailto:support@sunstatelimo.com">Here</a>
    </div>
<!--End Footer Here -->
</div>
<?php
unset ($_SESSION['notice']);
?>
<map name="Map" id="Map"><area shape="rect" coords="257,5,276,25" href="index.php" alt="Home page" title="Home page" />
<area shape="rect" coords="284,5,306,25" href="my_account.php" alt="My account" title="My account" />
<area shape="rect" coords="316,6,336,25" href="contact.php" alt="Contact Us" title="Contact Us" /></map></body>
</html>
