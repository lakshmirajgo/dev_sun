<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/reservation_functions.php");
include ("includes/functions/location_functions.php");
include ("includes/functions/price_functions.php");
include_once("includes/functions/trip_type_functions.php");	
include ("includes/functions/vehicle_functions.php");
include ("includes/functions/client_functions.php");

$company_info = get_company_info(); 

print_r($_SESSION['email_address']);

if (!isset($_SESSION['step3'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve.php");
// Quit the script
exit(); 
}

if (!isset($_SESSION['trip_type'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve.php");
// Quit the script
exit(); 
}


if ($_SESSION['from'] == '1a' || $_SESSION['from'] == '2a') {
$from = get_airports_view($_SESSION['from']);
} else {
	if ($_SESSION['from'] == '1c' || $_SESSION['from'] == '2c' || $_SESSION['from'] == '3c' || $_SESSION['from'] == '4c' || $_SESSION['from'] == '5c' || $_SESSION['from'] == '6c' || $_SESSION['from'] == '7c' || $_SESSION['from'] == '8c') {
	$from = get_cruises_view($_SESSION['from']);
	} else {
	$from = get_locations_view($_SESSION['from']);
	};
};

if ($_SESSION['to'] == '1a' || $_SESSION['to'] == '2a') {
$to = get_airports_view($_SESSION['to']);
} else {
	if ($_SESSION['to'] == '1c' || $_SESSION['to'] == '2c' || $_SESSION['to'] == '3c' || $_SESSION['to'] == '4c' || $_SESSION['to'] == '5c' || $_SESSION['to'] == '6c' || $_SESSION['to'] == '7c' || $_SESSION['to'] == '8c') {
	$to = get_cruises_view($_SESSION['to']);
	} else {
$to = get_locations_view($_SESSION['to']);
	};
};

$from1 = get_airports_view($_SESSION['location1']);
$to1 = get_locations_view($_SESSION['location2']);
if ($_SESSION['trip_type'] == '7') {
$from2 = get_locations_view($_SESSION['location2']);
$to2 = get_cruises_view($_SESSION['location3']);
$from3 = get_cruises_view($_SESSION['location3']);
}
if ($_SESSION['trip_type'] == '8' || $_SESSION['trip_type'] == '10') {
$to1 = get_cruises_view($_SESSION['location3']);
$from2 = get_cruises_view($_SESSION['location3']);
$to2 = get_locations_view($_SESSION['location2']);
$from3 = get_locations_view($_SESSION['location2']);
}
$to4 = get_airports_view($_SESSION['location1']);


$vehicle = get_vehicles_view($_SESSION['vehicle']);

if ($_SESSION['trip_type'] > 2) {
$transfer = get_prices_view($_SESSION['vehicle'], $_SESSION['trip_type']);
} else {
$price_local = get_prices_view_local($_SESSION['vehicle'], $_SESSION['trip_type'], $from['zone_id'], $to['zone_id']);
};

//Get Customer's info
$client_view = get_client_view_by_id($_SESSION['client_id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Orlando's Airport Premier Transportation Services - Reserve Online</title>
<meta name="keywords" content="orlando airport, orlando airport transportation, limousine orlando, florida transportation, orlando limousine service, transportation in orlando, disney world transportation, transportation, orlando airport shuttle, Disney world, universal studios, Orlando limousine, Disney transportation, Disney world transportation, orlando airport bus, Orlando limousine service, Towncar, luxury sedans, Limo Services, Limos, Walt Disney World transportation">
<meta name="description" content="Orlando's Airport Premier Transportation Services - Limousine, Towncar, Passenger Van">
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="includes/js/validate.js"></script>
<script type="text/javascript" src="includes/js/menu.js"></script>
<!-- European format dd-mm-yyyy -->
<script language="JavaScript" src="calendar1.js"></script><!-- Date only with year scrolling -->
<!-- American format mm/dd/yyyy -->
<script language="JavaScript" src="calendar2.js"></script><!-- Date only with year scrolling -->
<!-- mySQL format yyyy-mm-dd -->
<script language="JavaScript" src="calendar3.js"></script><!-- Date only with year scrolling -->
<script src="lib/prototype.js" type="text/javascript"></script>
<script src="src/scriptaculous.js" type="text/javascript"></script>
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
<?php if ($_SESSION['trip_type'] > 2) {
echo '<img src="images/header_cruise.jpg" />';
} else {
echo '<img src="images/banner.jpg" />';
}
?>
</div>
<!--Start ContentPanl Here -->
<div id="ContentPanel"> 
	<div id="CenterColumn">
    <br /> 
    <div align="center">
    <img src="images/status_bar4.jpg" border="0" />
    </div>
    <?php if (!empty($_SESSION['notice'])) { ?>
    <table width="100%" align="center" style="padding-top:10px;">
    <tr>
    	<td align="center">
    <?php echo $_SESSION['notice']; ?> 
    	</td>
    </tr>
    </table>
    <?php } ?>
    <br />
<div id="NormalText" class="NormalText"> 
			<div id="Box2" class="Box">
      <form id="reserve" style="padding-bottom:0px;" name="reserve" method="post" action="submit_order.php">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="top" align="center">Your Current Itinerary</td>
        </tr>
        <tr>
          <td class="middle">
          <table width="100%" cellpadding="0" cellspacing="0" border="0">
          	  <tr>
              	<td width="100%" colspan="2" align="right" valign="middle"><div style="background-color:#ced5f3; padding-top:2px; padding-right:5px; padding-bottom:2px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Travel Information</span>&nbsp;&nbsp;<a href="#" onClick="Effect.BlindDown('blinddown'); return false;"><img src="images/plus_btn.png" border="0" alt="View details" title="View details" align="absmiddle" width="24"></a> <a href="#" onClick="$('blinddown').hide(); return false;"><img src="images/minus_btn.png" border="0" alt="Hide details" title="Hide details" align="absmiddle" width="24"></a></div>              	</td>
              </tr>
              </table>
              <table width="100%" id="blinddown" style="display:none;">
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Vehicle:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $vehicle['name']; ?><input name="vehicle_id" type="hidden" value="<?php echo $_SESSION['vehicle']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Passengers:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $_SESSION['passenger_count']; ?><input name="passenger_count" type="hidden" value="<?php echo $_SESSION['passenger_count']; ?>" /></td>
              </tr>
              <?php if (!empty($_SESSION['child_carseat'])) { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Car Seat:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $_SESSION['child_carseat']; ?><input name="child_carseat" type="hidden" value="<?php echo $_SESSION['child_carseat']; ?>" /></td>
              </tr>
              <?php } ?>
              <?php if (!empty($_SESSION['child_boosterseat'])) { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Booster Seat:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $_SESSION['child_boosterseat']; ?><input name="child_boosterseat" type="hidden" value="<?php echo $_SESSION['child_boosterseat']; ?>" /></td>
              </tr>
              <?php } ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><span class="date"><?php echo $_SESSION['travel_date']; ?></span><input name="travel_date" type="hidden" value="<?php echo $_SESSION['travel_date']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Trip Type:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php $trip_type = get_trip_types_view($_SESSION['trip_type']); echo $trip_type['name']; ?><input name="trip_type" type="hidden" value="<?php echo $_SESSION['trip_type']; ?>" /></td>
              </tr>
              <?php if ($_SESSION['store_stop'] =='Yes') { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Quick Grocery Stop:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['store_stop']; ?><input name="store_stop" type="hidden" value="<?php echo $_SESSION['store_stop']; ?>" /></td>
              </tr>
              <?php } ?>
              <?php if ($_SESSION['trip_type'] == '1' || $_SESSION['trip_type'] == '2' || $_SESSION['trip_type'] == '3' || $_SESSION['trip_type'] == '4' || $_SESSION['trip_type'] == '5' || $_SESSION['trip_type'] == '6' || $_SESSION['trip_type'] == '9' || $_SESSION['trip_type'] == '11') { ?>
              <tr valign="middle">
                <td height="5" width="100%" colspan="2">&nbsp;</td>
              </tr>
              <tr>
              <td colspan="2" width="100%" height="30" valign="middle" align="center" bgcolor="#ffff82" class="BorderBox">
              <?php
			   if (check_arrival2($_SESSION['from'])) { echo "<strong>Arrival</strong>"; } else { echo "<strong>Departure</strong>"; } ; ?>
              </td>
            </tr>
            <tr valign="middle">
                <td height="5" width="100%" colspan="2">&nbsp;</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $from['name']; ?><input name="from" type="hidden" value="<?php echo $_SESSION['from']; ?>" /></td>
              </tr>
              <?php 
              if ($_SESSION['from'] != '1a' && $_SESSION['from'] != '2a' && $_SESSION['to'] != '1a' && $_SESSION['to'] != '2a') { ?>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h'];?>:<?php echo $_SESSION['m'];?> <?php echo $_SESSION['ampm'];?><input name="h" type="hidden" value="<?php echo $_SESSION['h']; ?>" /><input name="m" type="hidden" value="<?php echo $_SESSION['m']; ?>" /><input name="ampm" type="hidden" value="<?php echo $_SESSION['ampm']; ?>" /></td>
              	</tr>
              <?php } ?>
              <?php
              //Show Flight details BEGIN
			  if ($_SESSION['from'] == '1a' || $_SESSION['from'] == '2a') { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['arriving_airline'];?><input name="arriving_airline" type="hidden" value="<?php echo $_SESSION['arriving_airline']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['flight_number'];?><input name="flight_number" type="hidden" value="<?php echo $_SESSION['flight_number']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h1'];?>:<?php echo $_SESSION['m1'];?> <?php echo $_SESSION['ampm1'];?><input name="h1" type="hidden" value="<?php echo $_SESSION['h1']; ?>" /><input name="m1" type="hidden" value="<?php echo $_SESSION['m1']; ?>" /><input name="ampm1" type="hidden" value="<?php echo $_SESSION['ampm1']; ?>" /></td>
              </tr>
              <?php
			  //Show Flight details END
			  }
			  ?>
              <?php 
			  //Show Flight details BEGIN
			  if ($_SESSION['to'] =='1a' || $_SESSION['to'] == '2a') {
			  ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['arriving_airline'];?><input name="arriving_airline" type="hidden" value="<?php echo $_SESSION['arriving_airline']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['flight_number'];?><input name="flight_number" type="hidden" value="<?php echo $_SESSION['flight_number']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h1'];?>:<?php echo $_SESSION['m1'];?> <?php echo $_SESSION['ampm1'];?><input name="h1" type="hidden" value="<?php echo $_SESSION['h1']; ?>" /><input name="m1" type="hidden" value="<?php echo $_SESSION['m1']; ?>" /><input name="ampm1" type="hidden" value="<?php echo $_SESSION['ampm1']; ?>" /></td>
              </tr>
              <?php
			  //Show Flight details END
			  }
			  ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $to['name']; ?><input name="to" type="hidden" value="<?php echo $_SESSION['to']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td height="5" width="100%" colspan="2">&nbsp;</td>
              </tr>
           <!-- Round trip -->
           <?php if ($_SESSION['trip_type'] == '2' || $_SESSION['trip_type'] == '4' || $_SESSION['trip_type'] == '6' || $_SESSION['trip_type'] == '11') { ?>
           <tr>
              <td colspan="2" width="100%" height="30" valign="middle" align="center" bgcolor="#ffff82" class="BorderBox">
              <?php
			   if (!check_arrival2($_SESSION['from'])) { echo "<strong>Arrival</strong>"; } else { echo "<strong>Departure</strong>"; } ; ?>
              </td>
            </tr>
            <tr valign="middle">
                <td height="5" width="100%" colspan="2">&nbsp;</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $to['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><span class="date"><?php echo $_SESSION['travel_date_roundtrip']; ?></span><input name="travel_date_roundtrip" type="hidden" value="<?php echo $_SESSION['travel_date_roundtrip']; ?>" /></td>
              </tr>
              <?php 
              if ($_SESSION['from'] != '1a' && $_SESSION['from'] != '2a' && $_SESSION['to'] != '1a' && $_SESSION['to'] != '2a') { ?>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h2'];?>:<?php echo $_SESSION['m2'];?> <?php echo $_SESSION['ampm2'];?><input name="h2" type="hidden" value="<?php echo $_SESSION['h2']; ?>" /><input name="m2" type="hidden" value="<?php echo $_SESSION['m2']; ?>" /><input name="ampm2" type="hidden" value="<?php echo $_SESSION['ampm2']; ?>" /></td>
              	</tr>
              <?php } ?>
              <?php
              //Show Flight details BEGIN
			  if ($_SESSION['to'] == '1a' || $_SESSION['to'] == '2a') { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['departing_airline_roundtrip']; ?><input name="departing_airline_roundtrip" type="hidden" value="<?php echo $_SESSION['departing_airline_roundtrip']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['flight_number_roundtrip']; ?><input name="flight_number_roundtrip" type="hidden" value="<?php echo $_SESSION['flight_number_roundtrip']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h3'];?>:<?php echo $_SESSION['m3'];?> <?php echo $_SESSION['ampm3'];?><input name="h3" type="hidden" value="<?php echo $_SESSION['h3']; ?>" /><input name="m3" type="hidden" value="<?php echo $_SESSION['m3']; ?>" /><input name="ampm3" type="hidden" value="<?php echo $_SESSION['ampm3']; ?>" /></td>
              </tr>
              <?php
			  //Show Flight details END
			  }
			  ?>
              <?php 
			  //Show Flight details BEGIN
			  if ($_SESSION['from'] =='1a' || $_SESSION['from'] == '2a') {
			  ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['departing_airline_roundtrip']; ?><input name="departing_airline_roundtrip" type="hidden" value="<?php echo $_SESSION['departing_airline_roundtrip']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['flight_number_roundtrip']; ?><input name="flight_number_roundtrip" type="hidden" value="<?php echo $_SESSION['flight_number_roundtrip']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h3'];?>:<?php echo $_SESSION['m3'];?> <?php echo $_SESSION['ampm3'];?><input name="h3" type="hidden" value="<?php echo $_SESSION['h3']; ?>" /><input name="m3" type="hidden" value="<?php echo $_SESSION['m3']; ?>" /><input name="ampm3" type="hidden" value="<?php echo $_SESSION['ampm3']; ?>" /></td>
              </tr>
              <?php
			  //Show Flight details END
			  }
			  ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $from['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td height="10" width="100%" colspan="2">&nbsp;</td>
              </tr>
              		<?php
					} // For Transfers BEGIN
		   } else { 
		   
		   if ($_SESSION['trip_type'] == '7' || $_SESSION['trip_type'] == '8' || $_SESSION['trip_type'] == '10') {
		   ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $from1['name']; ?><input name="from1" type="hidden" value="<?php echo $from1['name']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['arriving_airline'];?><input name="arriving_airline" type="hidden" value="<?php echo $_SESSION['arriving_airline']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['flight_number']; ?><input name="flight_number" type="hidden" value="<?php echo $_SESSION['flight_number']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h1'];?>:<?php echo $_SESSION['m1'];?> <?php echo $_SESSION['ampm1'];?><input name="h1" type="hidden" value="<?php echo $_SESSION['h1']; ?>" /><input name="m1" type="hidden" value="<?php echo $_SESSION['m1']; ?>" /><input name="ampm1" type="hidden" value="<?php echo $_SESSION['ampm1']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $to1['name']; ?><input name="to1" type="hidden" value="<?php echo $to1['name']; ?>" /></td>
              </tr>
           	  <tr valign="middle">
                <td height="10" width="100%" colspan="2">&nbsp;</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $from2['name']; ?><input name="from2" type="hidden" value="<?php echo $from2['name']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><span class="date"><?php echo $_SESSION['travel_date_extra']; ?></span><input name="travel_date_extra" type="hidden" value="<?php echo $_SESSION['travel_date_extra']; ?>" /></td>
              </tr>
              <?php 
              if ($_SESSION['from'] != '1a' && $_SESSION['from'] != '2a' && $_SESSION['to'] != '1a' && $_SESSION['to'] != '2a') { ?>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h4'];?>:<?php echo $_SESSION['m4'];?> <?php echo $_SESSION['ampm4'];?><input name="h4" type="hidden" value="<?php echo $_SESSION['h4']; ?>" /><input name="m4" type="hidden" value="<?php echo $_SESSION['m4']; ?>" /><input name="ampm4" type="hidden" value="<?php echo $_SESSION['ampm4']; ?>" /></td>
              	</tr>
              <?php } ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $to2['name']; ?><input name="to2" type="hidden" value="<?php echo $to2['name']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td height="10" width="100%" colspan="2">&nbsp;</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $from3['name']; ?><input name="from3" type="hidden" value="<?php echo $from3['name']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><span class="date"><?php echo $_SESSION['travel_date_roundtrip']; ?></span><input name="travel_date_roundtrip" type="hidden" value="<?php echo $_SESSION['travel_date_roundtrip']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['departing_airline_roundtrip']; ?><input name="departing_airline_roundtrip" type="hidden" value="<?php echo $_SESSION['departing_airline_roundtrip']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['flight_number_roundtrip']; ?><input name="flight_number_roundtrip" type="hidden" value="<?php echo $_SESSION['flight_number_roundtrip']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h3'];?>:<?php echo $_SESSION['m3'];?> <?php echo $_SESSION['ampm3'];?><input name="h3" type="hidden" value="<?php echo $_SESSION['h3']; ?>" /><input name="m3" type="hidden" value="<?php echo $_SESSION['m3']; ?>" /><input name="ampm3" type="hidden" value="<?php echo $_SESSION['ampm3']; ?>" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $to4['name']; ?><input name="to4" type="hidden" value="<?php echo $to4['name']; ?>" /></td>
              </tr>
           			<?php
					 } ?>
               <tr valign="middle">
                <td height="10" width="100%" colspan="2">&nbsp;</td>
              </tr>
              </table>
              <?php } ?>
     
          <!-- Round trip -->  
          <br />
          <table width="100%" cellpadding="0" cellspacing="0" border="0">
           <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Passenger Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>First Name: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name" class="bodytxt" size="39" type="text" value="<?php if(!empty($_SESSION['notice'])) { echo $_SESSION['first_name']; } else { echo $client_view['first_name']; } ;?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Last Name: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name" class="bodytxt" size="39" type="text" value="<?php if(!empty($_SESSION['notice'])) { echo $_SESSION['last_name']; } else { echo $client_view['last_name']; }; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30"><input name="address" class="bodytxt" size="39" id="address" type="text" value="<?php if(!empty($_SESSION['notice'])) { echo $_SESSION['address']; } else { echo $client_view['address']; };?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2:</strong></td>
                <td align="left" height="30"><input name="address2" class="bodytxt" size="39" id="address2" type="text" value="<?php if(!empty($_SESSION['notice'])) { echo $_SESSION['address2']; } else { echo $client_view['address2']; };?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30"><input name="town" class="bodytxt" size="19" id="town" type="text" value="<?php if(!empty($_SESSION['notice'])) { echo $_SESSION['town']; } else { echo $client_view['city']; };?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30">
                						<select name="state" id="state" class="bodytxt">
                                        <option value="<?php if(!empty($_SESSION['notice'])) { echo $_SESSION['state']; } else { echo $client_view['state']; }; ?>"><?php if(!empty($_SESSION['notice'])) { echo $_SESSION['state']; } else { echo $client_view['state']; }; ?></option>
                        <option value="Outside USA">Outside USA</option>                        
                        <option value="AK">AK</option>

                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>

                        <option value="CO">CO</option>
                        <option value="CT">CT</option>

                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>

                        <option value="HI">HI</option>
                        <option value="IA">IA</option>

                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>

                        <option value="KY">KY</option>
                        <option value="LA">LA</option>

                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>

                        <option value="MN">MN</option>
                        <option value="MO">MO</option>

                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>

                        <option value="NE">NE</option>
                        <option value="NH">NH</option>

                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>

                        <option value="OH">OH</option>
                        <option value="OK">OK</option>

                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>

                        <option value="SD">SD</option>
                        <option value="TN">TN</option>

                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VA">VA</option>
                        <option value="VT">VT</option>

                        <option value="WA">WA</option>
                        <option value="WI">WI</option>

                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                      </select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30"><input name="zip" class="bodytxt" size="10" id="zip" type="text" value="<?php if(!empty($_SESSION['notice'])) { echo $_SESSION['zip']; } else { echo $client_view['zip']; };?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30">
                <select name="country" id="country" class="bodytxt">
                <option value="<?php if(!empty($_SESSION['notice'])) { echo $_SESSION['country']; } else { echo $client_view['country']; }; ?>"><?php if(!empty($_SESSION['notice'])) { echo $_SESSION['country']; } else { echo $client_view['country']; }; ?></option>
  				<option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option>
                            <option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Azores">Azores</option>
                            <option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia Herzegowina">Bosnia Herzegowina</option>
                            <option value="Bosnia-Herzegovina">Bosnia-Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option><option value="British Indian O. Terr">British Indian O. Terr</option>
                            <option value="British Virgin Isl">British Virgin Isl</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option><option value="Central African Rep">Central African Rep</option><option value="Chad">Chad</option>
                            <option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Isl">Cocos (Keeling) Isl</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option><option value="Congo, The Dem Rep">Congo, The Dem Rep</option><option value="Cook Islands">Cook Islands</option>
                            <option value="Corsica">Corsica</option><option value="Costa Rica">Costa Rica</option><option value="Cote d` Ivoire">Cote d` Ivoire</option>
                            <option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France (Incl Monaco)">France (Incl Monaco)</option>
                            <option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option>
                            <option value="French Polynesia">French Polynesia</option><option value="French S. Territories">French S. Territories</option>
                            <option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option><option value="Heard And Mc Donald Isl">Heard And Mc Donald Isl</option>
                            <option value="Holy See (Vatican City)">Holy See (Vatican City)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option>
                            <option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option>
                            <option value="Ireland (Eire)">Ireland (Eire)</option><option value="Israel">Israel</option><option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic Rep">Korea, Democratic Rep</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option>
                            <option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Madeira Islands">Madeira Islands</option>
                            <option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option>
                            <option value="Moldova, Republic Of">Moldova, Republic Of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option>
                            <option value="Myanmar (Burma)">Myanmar (Burma)</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Isl">Northern Mariana Isl</option><option value="Norway">Norway</option>
                            <option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option>
                            <option value="Palestinian Territory">Palestinian Territory</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia-Montenegro">Serbia-Montenegro</option>
                            <option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option>
                            <option value="Slovak Republic">Slovak Republic</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia">South Georgia</option>
                            <option value="South Korea">South Korea</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option>
                            <option value="St. Christopher, Nevis">St. Christopher, Nevis</option><option value="St. Helena">St. Helena</option><option value="St. Lucia">St. Lucia</option>
                            <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="St. Vincent and Gren">St. Vincent and Gren</option>
                            <option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard And Jan M Isl">Svalbard And Jan M Isl</option>
                            <option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Rep">Syrian Arab Rep</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tristan da Cunha">Tristan da Cunha</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Isl">Turks and Caicos Isl</option><option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option><option value="Great Britain">Great Britain</option>
                            <option value="United States" selected="selected">United States</option><option value="U.S. Minor Outlying Isl">U.S. Minor Outlying Isl</option>
                            <option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Furuna Isl">Wallis and Furuna Isl</option>
                            <option value="Western Sahara">Western Sahara</option><option value="Western Samoa">Western Samoa</option><option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
				</select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>E-mail: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30"><input name="email" class="bodytxt" size="39" id="email" type="text" value="<?php if(!empty($_SESSION['notice'])) { echo $_SESSION['email_address']; } else { echo $client_view['email_address']; };?>"></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                	<td width="40%" align="right"><span style="color:#677bca; font-weight:bold;">Cardholder Information</span>&nbsp;&nbsp;&nbsp;</td><td align="center"><input name="billing_adr" value="1" id="billing-checkbox" onclick="auto_address_update(document.reserve)" type="checkbox"></td><td> My Billing Address is the same as Shipping Address.</td>
                </tr>
              </table></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>First Name: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name_billing" class="bodytxt" size="39" type="text" value="<?php echo $_SESSION['first_name_billing'];?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Last Name: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name_billing" class="bodytxt" size="39" type="text" value="<?php echo $_SESSION['last_name_billing'];?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30"><input name="address_billing" class="bodytxt" size="39" type="text" value="<?php echo $_SESSION['address_billing'];?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2:</strong></td>
                <td align="left" height="30"><input name="address2_billing" class="bodytxt" size="39" type="text" value="<?php echo $_SESSION['address2_billing'];?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30"><input name="city_billing" class="bodytxt" size="19" type="text" value="<?php echo $_SESSION['city_billing'];?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30">
                						<select name="state_billing" class="bodytxt">
                                        <option value="<?php if(!empty($_SESSION['state_billing'])) { echo $_SESSION['state_billing']; };?>"><?php if(!empty($_SESSION['state_billing'])) { echo $_SESSION['state_billing']; };?></option>
                        <option value="Outside USA">Outside USA</option>                        
                        <option value="AK">AK</option>

                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>

                        <option value="CO">CO</option>
                        <option value="CT">CT</option>

                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>

                        <option value="HI">HI</option>
                        <option value="IA">IA</option>

                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>

                        <option value="KY">KY</option>
                        <option value="LA">LA</option>

                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>

                        <option value="MN">MN</option>
                        <option value="MO">MO</option>

                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>

                        <option value="NE">NE</option>
                        <option value="NH">NH</option>

                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>

                        <option value="OH">OH</option>
                        <option value="OK">OK</option>

                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>

                        <option value="SD">SD</option>
                        <option value="TN">TN</option>

                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VA">VA</option>
                        <option value="VT">VT</option>

                        <option value="WA">WA</option>
                        <option value="WI">WI</option>

                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                      </select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30"><input name="zip_billing" class="bodytxt" size="10" type="text" value="<?php echo $_SESSION['zip_billing'];?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30">
                <select name="country_billing" class="bodytxt">
                <option value="<?php if(!empty($_SESSION['country_billing'])) { echo $_SESSION['country_billing']; };?>"><?php if(!empty($_SESSION['country_billing'])) { echo $_SESSION['country_billing']; };?></option>
  				<option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option>
                            <option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Azores">Azores</option>
                            <option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia Herzegowina">Bosnia Herzegowina</option>
                            <option value="Bosnia-Herzegovina">Bosnia-Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option><option value="British Indian O. Terr">British Indian O. Terr</option>
                            <option value="British Virgin Isl">British Virgin Isl</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option><option value="Central African Rep">Central African Rep</option><option value="Chad">Chad</option>
                            <option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Isl">Cocos (Keeling) Isl</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option><option value="Congo, The Dem Rep">Congo, The Dem Rep</option><option value="Cook Islands">Cook Islands</option>
                            <option value="Corsica">Corsica</option><option value="Costa Rica">Costa Rica</option><option value="Cote d` Ivoire">Cote d` Ivoire</option>
                            <option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France (Incl Monaco)">France (Incl Monaco)</option>
                            <option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option>
                            <option value="French Polynesia">French Polynesia</option><option value="French S. Territories">French S. Territories</option>
                            <option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option><option value="Heard And Mc Donald Isl">Heard And Mc Donald Isl</option>
                            <option value="Holy See (Vatican City)">Holy See (Vatican City)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option>
                            <option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option>
                            <option value="Ireland (Eire)">Ireland (Eire)</option><option value="Israel">Israel</option><option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic Rep">Korea, Democratic Rep</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option>
                            <option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Madeira Islands">Madeira Islands</option>
                            <option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option>
                            <option value="Moldova, Republic Of">Moldova, Republic Of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option>
                            <option value="Myanmar (Burma)">Myanmar (Burma)</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Isl">Northern Mariana Isl</option><option value="Norway">Norway</option>
                            <option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option>
                            <option value="Palestinian Territory">Palestinian Territory</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia-Montenegro">Serbia-Montenegro</option>
                            <option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option>
                            <option value="Slovak Republic">Slovak Republic</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia">South Georgia</option>
                            <option value="South Korea">South Korea</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option>
                            <option value="St. Christopher, Nevis">St. Christopher, Nevis</option><option value="St. Helena">St. Helena</option><option value="St. Lucia">St. Lucia</option>
                            <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="St. Vincent and Gren">St. Vincent and Gren</option>
                            <option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard And Jan M Isl">Svalbard And Jan M Isl</option>
                            <option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Rep">Syrian Arab Rep</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tristan da Cunha">Tristan da Cunha</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Isl">Turks and Caicos Isl</option><option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option><option value="Great Britain">Great Britain</option>
                            <option value="United States" selected="selected">United States</option><option value="U.S. Minor Outlying Isl">U.S. Minor Outlying Isl</option>
                            <option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Furuna Isl">Wallis and Furuna Isl</option>
                            <option value="Western Sahara">Western Sahara</option><option value="Western Samoa">Western Samoa</option><option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
				</select>                </td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Payment Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Total Amount:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><span class="price"><?php if ($_SESSION['trip_type'] > 2) { echo "$".sprintf("%01.2f", $transfer['price_value']); } else { echo "$".sprintf("%01.2f", $price_local['price_value']);}; ?></span><input name="total_amount" id="total_amount" class="bodytxt" size="12" type="hidden" value="<?php if ($_SESSION['trip_type'] > 2) { echo sprintf("%01.2f", $transfer['price_value']); } else { echo sprintf("%01.2f", $price_local['price_value']);}; ?>">
  </td>
  			  </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Payment Method:</strong></td>
                <td align="left" height="30" width="62%" class="ot2" valign="middle">
                <div style="padding-bottom:2px;">
                <img src="images/credit_cards.jpg" border="0" height="26"/>
                </div>
                <select id="card_type" name="card_type" size="1">
																	<option value="" selected="selected">- Select Card Type -</option>
                                                                    <option value="Visa">Visa</option>
																	<option value="MasterCard">MasterCard</option>
																	<option value="Discover">Discover</option>
																</select> </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Credit Card Number:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="card_number" class="bodytxt" size="32" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Expiration Date:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select id="ExpMonth" name="ExpMonth" size="1">
																	
																	<option value="Jan">Jan</option>
																	
																	<option value="Feb">Feb</option>
																	
																	<option value="Mar">Mar</option>
																	
																	<option value="Apr">Apr</option>

																	
																	<option value="May">May</option>
																	
																	<option value="Jun">Jun</option>
																	
																	<option value="Jul">Jul</option>
																	
																	<option value="Aug">Aug</option>
																	
																	<option value="Sep">Sep</option>
																	
																	<option value="Oct">Oct</option>

																	
																	<option value="Nov">Nov</option>
																	
																	<option value="Dec">Dec</option>
																	
																</select>
                                                                <select id="ExpYear" name="ExpYear" size="1">
																	
																	<option value="2008" selected="selected">2008</option>

																	
																	<option value="2009">2009</option>
																	
																	<option value="2010">2010</option>
																	
																	<option value="2011">2011</option>
																	
																	<option value="2012">2012</option>
																	
																	<option value="2013">2013</option>
																	
																	<option value="2014">2014</option>

																	
																	<option value="2015">2015</option>
																	
																	<option value="2016">2016</option>
																	
																	<option value="2017">2017</option>
																	
																	<option value="2018">2018</option>
																</select></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2"><div style="background-color:#efefef; padding:5px; border:#CCCCCC solid 1px;"><span style="color:#000000;"><input name="paying_cash" value="Yes" id="paying_cash" type="checkbox"> Please do not charge my credit card. I will be paying cash or traveler check upon arrival I understand I am submitting my credit card info only to guarantee my reservation. I also read and understand Sunstate Transportation cancellation policy.</span></div>      
                </td>
              </tr>
              <tr>
              	<td width="100%" height="10" colspan="2"></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Reservation Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Customer Comments:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="customer_comments" rows="3" cols="36" class="bodytxt"><?php echo $_SESSION['customer_comments'];?></textarea></td>
              </tr>
          </table>
          </td>
        </tr>
        <tr>
          <td class="footer">&nbsp;</td>
        </tr>
      </table>
    </div>
			
                       
            
                  </div>
    <div align="center">
                <input src="images/submit_reservation.jpg" border="0" type="image">
                </div>
                <br />
     </form>
    </div>
</div>
<!--End ContentPanl Here -->
<div id="Clear"> </div>
<!--Start Footer Here -->
        <div id="Footer">
          <?php include("includes/common/footer.php"); ?>
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
