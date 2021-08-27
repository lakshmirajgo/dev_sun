<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/page_functions.php");
include("includes/functions/vehicle_functions.php");

//print_r($_SESSION);

$all_vehicles = get_all_vehicles();
$page = get_pages_view('index');
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
<meta name="verify-v1" content="xW+PxO8wGC7dI4P7aSIdeDceylTAnulPQxKkx1YeBW8=" />
<meta name="msvalidate.01" content="28C912B6D4DAF1D9375673C2FB676C85" />
<META name="y_key" content="01e0d029447d7513">
<link href="style.css" rel="stylesheet" type="text/css" />
<!-- European format dd-mm-yyyy -->
<script language="JavaScript" src="calendar1.js"></script><!-- Date only with year scrolling -->
<!-- American format mm/dd/yyyy -->
<script language="JavaScript" src="calendar2.js"></script><!-- Date only with year scrolling -->
<!-- mySQL format yyyy-mm-dd -->
<script language="JavaScript" src="calendar3.js"></script><!-- Date only with year scrolling -->
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
<body onload="MM_preloadImages('images/rates_active.gif','images/fleet_active.gif','images/faq_active.gif','images/testimonials_active.gif','images/reserve_active.gif','images/contact_active.gif')">
<div id="Wrapper"> 
 <!--Start Header Here -->
    	<div id="Header">
    	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="19%" valign="middle"><img src="images/sunstate.gif" alt="Sunstate" /></td>
              <td width="81%" align="right"><img src="images/topRightCars.jpg" width="367" height="102" border="0" usemap="#Map" /></td>
            </tr>
          </table>
    	</div>
<!--End Header Here -->
<!--Start Navigation Here -->
        <div id="Navigation">
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><a href="index.php"><img src="images/home_active.gif" alt="Home" width="71" height="33" border="0" /></a></td>
                <td><a href="rates.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','images/rates_active.gif',1)"><img src="images/rates_normal.gif" name="Image4" width="93" height="33" border="0" id="Image4" /></a></td>
                <td><a href="fleet.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','images/fleet_active.gif',1)"><img src="images/fleet_normal.gif" name="Image5" width="85" height="33" border="0" id="Image5" /></a></td>
                <td><a href="faq.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/faq_active.gif',1)"><img src="images/faq_normal.gif" name="Image6" width="81" height="33" border="0" id="Image6" /></a></td>
                <td><a href="testimonial.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','images/testimonials_active.gif',1)"><img src="images/testimonials_normal.gif" name="Image7" width="139" height="33" border="0" id="Image7" /></a></td>
                <td><a href="reserve.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','images/reserve_active.gif',1)"><img src="images/reserve_normal.gif" name="Image8" width="153" height="33" border="0" id="Image8" /></a></td>
                <td><a href="contact.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9','','images/contact_active.gif',1)"><img src="images/contact_normal.gif" name="Image9" width="116" height="33" border="0" id="Image9" /></a></td>
              </tr>
            </table>
        </div>
<!--End Navigation Here --> 
<div id="Banner"> 
<img src="images/banner.jpg" />

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
      <div id="b3" style="margin-bottom:3px;"><a href="reserve.php"><img src="../images/Image/B3.jpg" border="0" /></a> <br /><br />
                    
     
        <div class="wXstickerbody" style="word-wrap:normal !important;width:180px;height:150px;border:1px #000 solid;background:url(http://img.weather.weatherbug.com/images/stickers/v2/180x150/bg.gif) no-repeat;">

           <div class="wXstickerforecast" style="margin-top:7px !important; margin-left:7px !important;">
           <object type="application/x-shockwave-flash" data="http://weather.weatherbug.com/corporate/products/stickers/v2/MySpace_Sticker_180x150.swf?zipcode=32801&ZCode=z5740&StationID=KMCO&units=0" height="100" width="166">
           <param name="movie" value="http://weather.weatherbug.com/corporate/products/stickers/v2/MySpace_Sticker_180x150.swf?zipcode=32801&ZCode=z5740&StationID=KMCO&units=0">
           <param name="allowScriptAccess" value="never">
           <param name="enableJSURL" value="false">
           <param name="enableHREF" value="false">
           <param name="saveEmbedTags" value="true">
           <param name="flashvars" value="zipcode=32801&ZCode=z5740&StationID=KMCO&units=0">
           <embed src="http://weather.weatherbug.com/corporate/products/stickers/v2/MySpace_Sticker_180x150.swf?zipcode=32801&ZCode=z5740&StationID=KMCO&units=0" width="166" height="100" FlashVars="zipcode=32801&ZCode=z5545&StationID=KMCO&units=0"></embed>
           </object>
           </div>
           
          <div class="wXstickerlinks" style="height:9px;line-height:9px;text-align:center !important;margin-top:0px !important;width:180px;">
           <span class="wXstickerlink"><a href="http://weather.weatherbug.com/FL/Orlando-weather/local-forecast/7-day-forecast.html?zcode=z5740&units=0" target="_blank" style="font-family:Arial,Helvetica !important;padding-left:1px !important;text-decoration:none !important;color:#00f !important;font-size:9px !important;font-weight:bold !important;">Forecast</a></span>
           <span class="wXstickerlink"><a href="http://weather.weatherbug.com/FL/Orlando-weather/local-radar/doppler-radar.html?zcode=z5740&units=0" target="_blank" style="font-family:Arial,Helvetica !important;padding-left:1px !important;text-decoration:none !important;color:#00f !important;font-size:9px !important;font-weight:bold !important;">Radar</a></span>
           <span class="wXstickerlink"><a href="http://weather.weatherbug.com/FL/Orlando-weather/weather-cams/local-cams.html?zcode=z5740&units=0" target="_blank" style="font-family:Arial,Helvetica !important;padding-left:1px !important;text-decoration:none !important;color:#00f !important;font-size:9px !important;font-weight:bold !important;">Cameras</a></span>
           <span class="wXstickerlink"><a href="http://community-weather.weatherbug.com/community/weather-photos/photo-gallery.html?zcode=z5740&units=0&zip=32801" target="_blank" style="font-family:Arial,Helvetica !important;padding-left:1px !important;text-decoration:none !important;color:#00f !important;font-size:9px !important;font-weight:bold !important;">Photos</a></span>
           <div class="wXstickerfooter" style="margin-top:6px !important;">
           <a href="http://weather.weatherbug.com/FL/Orlando-weather.html?zcode=z5740&units=0" target="_blank"><img src="http://img.weather.weatherbug.com/images/stickers/v2/180x150/wxbug-logo.jpg" style="border:0px;" border="0" alt="WeatherBug" /></a></div>
           </div>
           </div><br />
           <a href="http://www.flytecomm.com/cgi-bin/trackflight" target="_blank"><img src="images/flighttracker.jpg" alt="Flight Tracker" width="179" height="45" border="0" title="Click Here to track your flight"></a> <br />
           <div style="padding-top:10px; padding-bottom:10px;">
           <img src="images/secure_site.jpg" border="0" alt="THIS IS A SECURE SITE" title="THIS IS A SECURE SITE" />
           </div>
           </div>
    
    
    </div> 
    
    <div id="RightColumn"> 
    		<h1><strong>Orlando Airport</strong> Transportation to Disney</h1>
    <p style="padding-left:10px;"><?php echo $page['page_content']; ?> 
    
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
                            <input name="vehicle" value="<?php echo $value['id']; ?>" type="radio" onclick="setcarseat(getCheckedValue(this));" />                            </td>
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
                  </table>                  </td>
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
			  
			  ?>                </td>
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
                                      <option value="3">MCO to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="4">MCO to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="5">Disney/Universal to Cruise Terminal/Port Area - 