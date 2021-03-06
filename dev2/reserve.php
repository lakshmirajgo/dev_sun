<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/reservation_functions.php");
include ("includes/functions/vehicle_functions.php");
include ("includes/functions/page_functions.php");

//Validate Shades of Green Customers BEGIN
if (isset($_SESSION['shadesofgreen'])) {
header ("Location: reserve_shadesofgreen.php");
exit;
}
//Validate Shades of Green Customers END

$page = get_pages_view('reserve');
$page_buttom = get_pages_view('reserve_buttom');
$company_info = get_company_info(); die;
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
<script type="text/javascript" src="includes/js/date.js"></script>
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
<script language="JavaScript">
<!--
var url = location.href;	
if(url.charAt(4) != "s" ){
window.location = "https://www.sunstatelimo.com/reserve.php";
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


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
jQuery.noConflict();
jQuery(function() {

    /**
	var $travel_date = jQuery('#travel_date');
    var $reserve_btn = jQuery('#reserve_btn');
    var date;
    $travel_date.on('blur', function(){
        date = $travel_date.val();
        
        jQuery.ajax({
          type: "POST",
          url: "/admin/locked_dates_manager.php",
          data: { date: date, check: true}
        })
          .done(function( res ) {
            if(res)
            {
                alert("We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.");
            };
          });
    });
    
    $reserve_btn.on('click', function(e){
        date = $travel_date.val();
        
        jQuery.ajax({
          type: "POST",
          url: "/admin/locked_dates_manager.php",
          data: { date: date, check: true}
        })
          .done(function( res ) {

            if(res)
            {
                alert("We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.");
                
                window.location.replace("https://www.sunstatelimo.com/reserve.php");
            };
          });
    });
    
    **/
});
</script>
</head>
<body onload="MM_preloadImages('images/fleet_active.gif','images/faq_active.gif','images/contact_active.gif','images/home_active.gif','images/rates_active.gif','images/testimonials_active.gif'); ">
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
<?php
//Validate Shades of Green Customers BEGIN
if (isset($_SESSION['shadesofgreen'])) {
echo '<img src="images/header_shadesofgreen.jpg" />';
//Validate Shades of Green Customers END
} else {
	if ($_SESSION['trip_type'] > 2) {
	echo '<img src="images/header_cruise.jpg" />';	
	} else {
	echo '<img src="images/'.$img_head.'" />';
	}
}
?><br />
</div>
<!--Start ContentPanl Here -->
<form id="reserve" style="padding-top:0px;" name="reserve" method="post" action="reserve_step2.php" onsubmit="return validate3(this);">
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
            <div id="Box4" class="Box">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="top">Transportation From/To:</td>
                </tr>
                <tr>
                  <td class="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr valign="middle">
                <td align="right" height="30" width="20%" class="ob"><strong>Trip Type: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="80%" class="ot2"><select name="trip_type" id="trip_type" size="1" onchange="javascript:getNewContent(this.value);">
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
              	<td colspan="2" height="30"><p id="myLocation" align="center">&nbsp;</p>
                </td>
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
                            	<td width="33%" valign="top" class="ot">
                                <strong>Transfer Date: <font color="#ff0000" size="2">*</font></strong>      							</td>
                                <td width="67%" valign="top" class="ot">
                                <input value="U" name="datefmt" type="radio" checked="checked" style="display:none;"><input value="W" name="datefmt" type="radio" style="display:none;"><input value="J" name="datefmt" type="radio" style="display:none;"><input value="P" name="daterng" type="radio" style="display:none;"><input value="A" name="daterng" type="radio" style="display:none;"><input value="F" name="daterng" type="radio" checked="checked" style="display:none;">
                        <input name="travel_date" type="text" id="travel_date" size="10" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('travel_date');"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY                				</td>
                            </tr>
                            <tr>
                            	<td width="33%" valign="top" class="ot">
                                <strong>Passenger Count: <font color="#ff0000" size="2">*</font></strong>      							</td>
                              <td width="67%" valign="top" class="ot">
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
                  </div>
    <table width="535" align="center" cellpadding="0" cellspacing="0"style="padding-top:10px; padding-bottom:10px;" border="0">
    <tr>
    	<td align="left" valign="middle">
           <img src="images/secure_site.jpg" border="0" alt="THIS IS A SECURE SITE" title="THIS IS A SECURE SITE" />
        </td>
        <td align="right" valign="middle">
    			<input src="images/request_quote.png" border="0" type="image" id="reserve_btn" onclick="if (validateDate(reserve.travel_date.value, valDateFmt(reserve.datefmt),valDateRng(reserve.daterng))) {} else {alert('You can only reserve online if your arrival is <?php echo $company_info['minimum_time']*24; ?>hrs prior.\n\nPlease call 407-601-7900 to reserve over the phone'); return false;}">
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
    | For Support Click <a href="mailto:support@sunstatelimo.com">Here</a>
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
