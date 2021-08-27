<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/reservation_functions.php");
include ("includes/functions/vehicle_functions.php");
include ("includes/functions/page_functions.php");

$_SESSION['shadesofgreen'] = true;

$page = get_pages_view('reserve_shadesofgreen');
$page_buttom = get_pages_view('reserve_buttom');
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
<script type="text/javascript" src="scripts/custom_elements.js"></script>
<script type="text/javascript" src="includes/js/validate.js"></script>
<script type="text/javascript" src="includes/js/menu.js"></script>
<!-- European format dd-mm-yyyy -->
<script language="JavaScript" src="calendar1.js"></script><!-- Date only with year scrolling -->
<!-- American format mm/dd/yyyy -->
<script language="JavaScript" src="calendar2.js"></script><!-- Date only with year scrolling -->
<!-- mySQL format yyyy-mm-dd -->
<script language="JavaScript" src="calendar3.js"></script><!-- Date only with year scrolling -->
<script language="javascript">
	function setcarseat(id){
		if(id=="1"){
			document.reserve.child_carseat.disabled = true;
			document.reserve.child_carseat.checked = false;
		}
		else
			document.reserve.child_carseat.disabled = false;
	}
</script>
<script language="JavaScript">
<!--
var url = location.href;	
if(url.charAt(4) != "s" ){
window.location = "https://www.sunstatelimo.com/reserve_shadesofgreen.php";
}
-->
</script>
<script language="javascript" type="text/javascript">
//<![CDATA[
var cot_loc0=(window.location.protocol == "https:")? "https://www.sunstatelimo.com/includes/js/cot.js" :
"https://www.sunstatelimo.com/includes/js/cot.js";
document.writeln('<scr' + 'ipt language="JavaScript" src="'+cot_loc0+'" type="text\/javascript">' + '<\/scr' + 'ipt>');
//]]>
</script>
</head>
<body onload="MM_preloadImages('images/fleet_active.gif','images/faq_active.gif','images/contact_active.gif','images/home_active.gif','images/rates_active.gif','images/testimonials_active.gif'); hidefields();">
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
              <td><a href="index.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image19','','images/home_active.gif',1)"><img src="images/home_normal.gif" alt="Home" name="Image19" width="71" height="33" border="0" id="Image19" /></a><a href="index.php"></a></td>
              <td><a href="rates.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image40','','images/rates_active.gif',1)"><img src="images/rates_normal.gif" alt="Rates" name="Image40" width="93" height="33" border="0" id="Image40" /></a></td>
              <td><a href="fleet.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image41','','images/fleet_active.gif',1)"><img src="images/fleet_normal.gif" alt="Fleet" name="Image41" width="85" height="33" border="0" id="Image41" /></a><a href="fleet.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image41','','images/faq_active.gif',1)"></a></td>
              <td><a href="faq.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image15','','images/faq_active.gif',1)"><img src="images/faq_normal.gif" alt="FAQ" name="Image15" width="81" height="33" border="0" id="Image15" /></a></td>
              <td><a href="testimonial.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image16','','images/testimonials_active.gif',1)"><img src="images/testimonials_normal.gif" alt="Testimonials" name="Image16" width="139" height="33" border="0" id="Image16" /></a></td>
              <td><img src="images/reserve_active.gif" alt="Reseve Online" width="153" height="33" /></td>
              <td><a href="contact.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9','','images/contact_active.gif',1)"><img src="images/contact_normal.gif" alt="Contact Us" name="Image9" width="116" height="33" border="0" id="Image9" /></a></td>
            </tr>
          </table>
        </div>
<!--End Navigation Here --> 
<div id="Banner"> 
<img src="images/header_shadesofgreen.jpg" /><br />
</div>
<!--Start ContentPanl Here -->
<form id="reserve" style="padding-top:0px;" name="reserve" method="post" action="reserve_step2.php" onsubmit="return validate5(this);">
<div id="ContentPanel"> 
	<div id="CenterColumn">
    <div align="center">
    <img src="images/status_bar1.jpg" border="0" />
    </div>
    <br />
    <div id="CenterReserveColumn"> 
    		<?php echo $page['page_content']; ?>
			
            <div id="Box3" class="Box">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="top">Select Vehicle:</td>
                </tr>
                <tr>
                  <td class="middle">
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
				//Customized by Rash. Only Show Van and Town car
				if ($count >= 2 ) {
				echo "</tr><tr>";
				break;
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
                <tr>
                  <td class="footer">&nbsp;</td>
                </tr>
              </table>
            </div>
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


http.open('get','loadlocations_shadesofgreen.php?val='+val);
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
            <div id="Box4" class="Box">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="top">Transportation From/To:</td>
                </tr>
                <tr>
                  <td class="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr valign="middle">
                        <td align="right" height="30" class="ob"><strong>Trip Type: <font color="#ff0000" size="2">*</font></strong></td>
                        <td align="left" height="30" class="ot2"><select name="trip_type_new" id="trip_type_new" required="yes" size="1">
                          <option value="" selected="selected"> -- Select One -- </option>
                          <option value="1">Orlando Area - One Way</option>
                          <option value="2">Orlando Area - Round Trip</option>
                        </select></td>
                      </tr>
                      <tr valign="middle">
                        <td align="right" height="30" class="ob"><strong>Transportation FROM: <font color="#ff0000" size="2">*</font></strong></td>
                        <td align="left" height="30" class="ot2">
                            <select name="from" id="from" required="yes" size="1">
                            <option value="" selected="selected"><span class="ot2"> -- Select One -- </span></option>
                            <optgroup label="Orlando Hotels">
                            <option value="517"><span class="ot2">Shades of Green</span></option>
                            </optgroup>
                            <optgroup label="GATEWAYS">
                            <option value="421"><span class="ot2">Orlando International Airport</span></option>
                            <option value="422"><span class="ot2">Orlando Sanford International Airport</span></option>
                            <option value="513"><span class="ot2">Greyhound</span></option>
                            <option value="514"><span class="ot2">Amtrak Orlando</span></option>
                            <option value="515"><span class="ot2">Amtrak Kissimmee</span></option>
                            <option value="516"><span class="ot2">Port Canaveral</span></option>
                            </optgroup>
                            <optgroup label="DISNEY ATTRACTIONS">
                            <option value="460"><span class="ot2">Animal Kingdom</span></option>
                            <option value="461"><span class="ot2">Blizzard Beach</span></option>
                            <option value="462"><span class="ot2">Epcot Center</span></option>
                            <option value="463"><span class="ot2">Magic Kingdom</span></option>
                            <option value="464"><span class="ot2">Hollywood Studios</span></option>
                            <option value="465"><span class="ot2">Downtown Disney</span></option>
                            <option value="466"><span class="ot2">Typhoon Lagoon</span></option>
                            </optgroup>
                            <optgroup label="ATTRACTIONS">
                            <option value="467"><span class="ot2">Pirate Dinner Show</span></option>
                            <option value="468"><span class="ot2">Arabian Knights</span></option>
                            <option value="469"><span class="ot2">Bush Gardens</span></option>
                            <option value="470"><span class="ot2">Citrus Bowl</span></option>
                            <option value="471"><span class="ot2">Gatorland</span></option>
                            <option value="472"><span class="ot2">Kennedy Space Center</span></option>
                            <option value="473"><span class="ot2">Medevil Times</span></option>
                            <option value="474"><span class="ot2">Sea World</span></option>
                            <option value="475"><span class="ot2">Amway Arena</span></option>
                            <option value="476"><span class="ot2">Univeral Studios</span></option>
                            <option value="477"><span class="ot2">Wet'n Wild</span></option>
                            </optgroup>
                            <optgroup label="DISNEY RESORTS">
                            <option value="478"><span class="ot2">Swan/Dolphin</span></option>
                            <option value="479"><span class="ot2">Epcot Resorts</span></option>
                            <option value="480"><span class="ot2">Coranado Springs</span></option>
                            <option value="481"><span class="ot2">All Star Resorts</span></option>
                            </optgroup>
                            <optgroup label="GOLF COURSES">
                            <option value="482"><span class="ot2">Bay Hill</span></option>
                            <option value="483"><span class="ot2">Villas of Grand Cypress</span></option>
                            <option value="484"><span class="ot2">Lake Buena Vista Golf</span></option>
                            <option value="485"><span class="ot2">Lake Nona</span></option>
                            <option value="486"><span class="ot2">Eagle Pine/Osprey Ridge</span></option>
                            </optgroup>
                            <optgroup label="SHOPPING">
                            <option value="487"><span class="ot2">Belz Factory Outlet</span></option>
                            <option value="488"><span class="ot2">Crossroads LBV</span></option>
                            <option value="489"><span class="ot2">Florida Mall</span></option>
                            <option value="490"><span class="ot2">Mall of Millenia</span></option>
                            <option value="491"><span class="ot2">Point Orlando</span></option>
                            <option value="492"><span class="ot2">Premium Outlet</span></option>
                            </optgroup>
                            <optgroup label="RESTAURANTS">
                            <option value="493"><span class="ot2">Antonio's Sandlake</span></option>
                            <option value="494"><span class="ot2">Charley's Steak 192</span></option>
                            <option value="495"><span class="ot2">Charley's Steak I-Drive</span></option>
                            <option value="496"><span class="ot2">Christini's Fishbone Sandlake</span></option>
                            <option value="497"><span class="ot2">Louis Downtown</span></option>
                            <option value="498"><span class="ot2">Moonfish Sandlake</span></option>
                            <option value="499"><span class="ot2">Morton's of Chicago</span></option>
                            <option value="500"><span class="ot2">Rachel's Steak House</span></option>
                            <option value="501"><span class="ot2">Ruth Chris Steak House</span></option>
                            <option value="502"><span class="ot2">Timpano's</span></option>
                            <option value="503"><span class="ot2">Tuscany (MWC)</span></option>
                            </optgroup>
                            <optgroup label="OTHER">
                            <option value="504"><span class="ot2">Celebrations Hospital</span></option>
                            <option value="505"><span class="ot2">Convention Center</span></option>
                            <option value="506"><span class="ot2">I-Drive North</span></option>
                            <option value="507"><span class="ot2">I-Drive South</span></option>
                            </optgroup>
                            <optgroup label="LBV">
                            <option value="508"><span class="ot2">Marriott World Center</span></option>
                            <option value="509"><span class="ot2">Mary Queen of the Universe</span></option>
                            <option value="510"><span class="ot2">Sandlake Hospital</span></option>
                            <option value="511"><span class="ot2">South OBT</span></option>
                            </optgroup>
                          </select>                        </td>
                      </tr>
                      <tr valign="middle">
                <td align="right" height="30" width="34%" class="ob"><strong>Transportation TO: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="66%" class="ot2">
                  <select name="to" id="to" required="yes" size="1">
                    <option value="" selected="selected"><span class="ot2"> -- Select One -- </span></option>
                    <optgroup label="Orlando Hotels">
                    <option value="517"><span class="ot2">Shades of Green</span></option>
                    </optgroup>
                    <optgroup label="GATEWAYS">
                    <option value="421"><span class="ot2">Orlando International Airport</span></option>
                    <option value="422"><span class="ot2">Orlando Sanford International Airport</span></option>
                    <option value="513"><span class="ot2">Greyhound</span></option>
                    <option value="514"><span class="ot2">Amtrak Orlando</span></option>
                    <option value="515"><span class="ot2">Amtrak Kissimmee</span></option>
                    <option value="516"><span class="ot2">Port Canaveral</span></option>
                    </optgroup>
                    <optgroup label="DISNEY ATTRACTIONS">
                    <option value="460"><span class="ot2">Animal Kingdom</span></option>
                    <option value="461"><span class="ot2">Blizzard Beach</span></option>
                    <option value="462"><span class="ot2">Epcot Center</span></option>
                    <option value="463"><span class="ot2">Magic Kingdom</span></option>
                    <option value="464"><span class="ot2">Hollywood Studios</span></option>
                    <option value="465"><span class="ot2">Downtown Disney</span></option>
                    <option value="466"><span class="ot2">Typhoon Lagoon</span></option>
                    </optgroup>
                    <optgroup label="ATTRACTIONS">
                    <option value="467"><span class="ot2">Pirate Dinner Show</span></option>
                    <option value="468"><span class="ot2">Arabian Knights</span></option>
                    <option value="469"><span class="ot2">Bush Gardens</span></option>
                    <option value="470"><span class="ot2">Citrus Bowl</span></option>
                    <option value="471"><span class="ot2">Gatorland</span></option>
                    <option value="472"><span class="ot2">Kennedy Space Center</span></option>
                    <option value="473"><span class="ot2">Medevil Times</span></option>
                    <option value="474"><span class="ot2">Sea World</span></option>
                    <option value="475"><span class="ot2">Amway Arena</span></option>
                    <option value="476"><span class="ot2">Univeral Studios</span></option>
                    <option value="477"><span class="ot2">Wet'n Wild</span></option>
                    </optgroup>
                    <optgroup label="DISNEY RESORTS">
                    <option value="478"><span class="ot2">Swan/Dolphin</span></option>
                    <option value="479"><span class="ot2">Epcot Resorts</span></option>
                    <option value="480"><span class="ot2">Coranado Springs</span></option>
                    <option value="481"><span class="ot2">All Star Resorts</span></option>
                    </optgroup>
                    <optgroup label="GOLF COURSES">
                    <option value="482"><span class="ot2">Bay Hill</span></option>
                    <option value="483"><span class="ot2">Villas of Grand Cypress</span></option>
                    <option value="484"><span class="ot2">Lake Buena Vista Golf</span></option>
                    <option value="485"><span class="ot2">Lake Nona</span></option>
                    <option value="486"><span class="ot2">Eagle Pine/Osprey Ridge</span></option>
                    </optgroup>
                    <optgroup label="SHOPPING">
                    <option value="487"><span class="ot2">Belz Factory Outlet</span></option>
                    <option value="488"><span class="ot2">Crossroads LBV</span></option>
                    <option value="489"><span class="ot2">Florida Mall</span></option>
                    <option value="490"><span class="ot2">Mall of Millenia</span></option>
                    <option value="491"><span class="ot2">Point Orlando</span></option>
                    <option value="492"><span class="ot2">Premium Outlet</span></option>
                    </optgroup>
                    <optgroup label="RESTAURANTS">
                    <option value="493"><span class="ot2">Antonio's Sandlake</span></option>
                    <option value="494"><span class="ot2">Charley's Steak 192</span></option>
                    <option value="495"><span class="ot2">Charley's Steak I-Drive</span></option>
                    <option value="496"><span class="ot2">Christini's Fishbone Sandlake</span></option>
                    <option value="497"><span class="ot2">Louis Downtown</span></option>
                    <option value="498"><span class="ot2">Moonfish Sandlake</span></option>
                    <option value="499"><span class="ot2">Morton's of Chicago</span></option>
                    <option value="500"><span class="ot2">Rachel's Steak House</span></option>
                    <option value="501"><span class="ot2">Ruth Chris Steak House</span></option>
                    <option value="502"><span class="ot2">Timpano's</span></option>
                    <option value="503"><span class="ot2">Tuscany (MWC)</span></option>
                    </optgroup>
                    <optgroup label="OTHER">
                    <option value="504"><span class="ot2">Celebrations Hospital</span></option>
                    <option value="505"><span class="ot2">Convention Center</span></option>
                    <option value="506"><span class="ot2">I-Drive North</span></option>
                    <option value="507"><span class="ot2">I-Drive South</span></option>
                    </optgroup>
                    <optgroup label="LBV">
                    <option value="508"><span class="ot2">Marriott World Center</span></option>
                    <option value="509"><span class="ot2">Mary Queen of the Universe</span></option>
                    <option value="510"><span class="ot2">Sandlake Hospital</span></option>
                    <option value="511"><span class="ot2">South OBT</span></option>
                    </optgroup>
                  </select>                </td>
              </tr>
              
                    </table>
                  </td>
                </tr>
                <tr>
                  <td class="footer">&nbsp;</td>
                </tr>
              </table>
            </div>
            
            <div id="Box5" class="Box">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="top">Travel Information:</td>
                </tr>
                <tr>
                  <td class="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="100%" valign="top">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        	<tr>
                            	<td width="34%" valign="top" class="ot">
                                <strong>Transfer Date: <font color="#ff0000" size="2">*</font></strong>      							</td>
                              <td width="66%" valign="top" class="ot">
                                <input value="U" name="datefmt" type="radio" checked="checked" style="display:none;"><input value="W" name="datefmt" type="radio" style="display:none;"><input value="J" name="datefmt" type="radio" style="display:none;"><input value="P" name="daterng" type="radio" style="display:none;"><input value="A" name="daterng" type="radio" style="display:none;"><input value="F" name="daterng" type="radio" checked="checked" style="display:none;">
                        <input name="travel_date" type="text" id="travel_date" size="10" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal1.popup();"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY                				</td>
                          </tr>
                            <tr>
                            	<td width="34%" valign="top" class="ot">
                                <strong>Number of Passengers: <font color="#ff0000" size="2">*</font></strong>      							</td>
                              <td width="66%" valign="top" class="ot">
                        <input name="passenger_count" type="text" id="passenger_count" size="4" maxlength="4"> &nbsp;&nbsp;&nbsp; <input name="child_carseat" type="checkbox" value="Yes" />
  <label><strong>Car Seat</strong></label>
                                         				<input name="child_boosterseat" type="checkbox" id="child_boosterseat" value="Yes" />
                                                        <label><strong>Booster Seat</strong></label></td>
                          </tr>
                        </table>
                        </td>
                      </tr>
                    </table>
                    <HR />
                    <strong>Note:</strong> When selecting a luxury van you will have the option to request both car seat and booster seat. However only a booster seat is available when selecting town car or limousine. We apologize for any inconvenience this may have caused you.</td>
                </tr>
                <tr>
                  <td class="footer">&nbsp;</td>
                </tr>
              </table>
            </div>
                        <script language="JavaScript">
<!-- // create calendar object(s) just after form tag closed
	 // specify form element as the only parameter (document.forms['formname'].elements['inputname']);
	 // note: you can have as many calendar objects as you need for your application
	var cal1 = new calendar2(document.forms['reserve'].elements['travel_date']);
	cal1.year_scroll = true;
	cal1.time_comp = false;
//-->
</script>
          
                  </div>
    <table width="535" align="center" cellpadding="0" cellspacing="0"style="padding-top:10px; padding-bottom:10px;" border="0">
    <tr>
    	<td align="left" valign="middle">
           <img src="images/secure_site.jpg" border="0" alt="THIS IS A SECURE SITE" title="THIS IS A SECURE SITE" />
        </td>
        <td align="right" valign="middle">
    			<input src="images/request_quote.png" border="0" type="image" onclick="if (validateDate(reserve.travel_date.value, valDateFmt(reserve.datefmt),valDateRng(reserve.daterng))) {} else {alert('You can only reserve online if your arrival is <?php echo $company_info['minimum_time']*24; ?>hrs prior.\n\nPlease call 407-601-7900 to reserve over the phone'); return false;}">
        </td>
   </tr>
   </table>
                <br />
                  <?php echo $page_buttom['page_content']; ?>
    </div>
</div>
<!--End ContentPanl Here -->
            </form>
<div id="Clear"> </div>
<!--Start Footer Here -->
        <div id="Footer">
          <?php include("includes/common/footer.php"); ?>
</div>
	<div align="center" style="padding:5px;">
    Designed by: <a href="http://www.imperialwebsolutions.net/" target="_blank">Imperial Web Solutions</a>
    </div>
<!--End Footer Here -->
</div>

<map name="Map" id="Map"><area shape="rect" coords="257,5,276,25" href="index.php" alt="Home page" title="Home page" />
<area shape="rect" coords="284,5,306,25" href="my_account.php" alt="My account" title="My account" />
<area shape="rect" coords="316,6,336,25" href="contact.php" alt="Contact Us" title="Contact Us" /></map>
<?php
unset ($_SESSION['notice']);
unset ($_SESSION['step2']);
unset ($_SESSION['step3']);
unset ($_SESSION['step4']);
?>
<a href="http://www.instantssl.com" id="comodoTL">SSL</a>
<script language="JavaScript" type="text/javascript">
COT("https://sunstatelimo.com/images/cot.gif", "SC2", "none");
</script>
</body>
</html>
