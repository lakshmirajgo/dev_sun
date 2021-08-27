<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/location_functions.php");
include ("includes/functions/price_functions.php");
include_once("includes/functions/trip_type_functions.php");	

$company_info = get_company_info(); 
if (!empty($_POST)) {
$_SESSION['step4'] = '1';
};

if (!isset($_SESSION['step4'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve.php");
// Quit the script
exit(); 
}

if (!isset($_SESSION['trip_type'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve.php");
// Quit the script
exit(); 
}

$_SESSION['step4'] = 'yes';
if (!empty($_POST)) {
$_SESSION['h'] = $_POST["h"];
$_SESSION['m'] = $_POST["m"];
$_SESSION['ampm'] = $_POST["ampm"];
$_SESSION['arriving_airline'] = $_POST["arriving_airline"];
$_SESSION['flight_number'] = $_POST["flight_number"];
$_SESSION['h1'] = $_POST["h1"];
$_SESSION['m1'] = $_POST["m1"];
$_SESSION['ampm1'] = $_POST["ampm1"];
$_SESSION['departing_airline_roundtrip'] = $_POST["departing_airline_roundtrip"];
$_SESSION['flight_number_roundtrip'] = $_POST["flight_number_roundtrip"];
$_SESSION['travel_date_roundtrip'] = $_POST["travel_date_roundtrip"];
$_SESSION['travel_date_extra'] = $_POST["travel_date_extra"];
$_SESSION['h2'] = $_POST["h2"];
$_SESSION['m2'] = $_POST["m2"];
$_SESSION['ampm2'] = $_POST["ampm2"];
$_SESSION['h3'] = $_POST["h3"];
$_SESSION['m3'] = $_POST["m3"];
$_SESSION['ampm3'] = $_POST["ampm3"];
$_SESSION['h4'] = $_POST["h4"];
$_SESSION['m4'] = $_POST["m4"];
$_SESSION['ampm4'] = $_POST["ampm4"];
};

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


if ($_SESSION['trip_type'] > 2) {
$transfer = get_prices_view($_SESSION['vehicle'], $_SESSION['trip_type']);
} else {
$price_local = get_prices_view_local($_SESSION['vehicle'], $_SESSION['trip_type'], $from['zone_id'], $to['zone_id']);
};
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Orlando's Airport Premier Transportation Services - Reserve Online</title>
<meta name="keywords" content="orlando airport, orlando airport transportation, limousine orlando, florida transportation, orlando limousine service, transportation in orlando, disney world transportation, transportation, orlando airport shuttle, Disney world, universal studios, Orlando limousine, Disney transportation, Disney world transportation, orlando airport bus, Orlando limousine service, Towncar, luxury sedans, Limo Services, Limos, Walt Disney World transportation">
<meta name="description" content="Orlando's Airport Premier Transportation Services - Limousine, Towncar, Passenger Van">
<link href="style.css" rel="stylesheet" type="text/css" />
<!-- European format dd-mm-yyyy -->
<script language="JavaScript" src="calendar1.js"></script><!-- Date only with year scrolling -->
<!-- American format mm/dd/yyyy -->
<script language="JavaScript" src="calendar2.js"></script><!-- Date only with year scrolling -->
<!-- mySQL format yyyy-mm-dd -->
<script language="JavaScript" src="calendar3.js"></script><!-- Date only with year scrolling -->
<script type="text/javascript" src="includes/js/validate.js"></script>
<script type="text/javascript" src="includes/js/menu.js"></script>
</head>
<body onload="MM_preloadImages('images/fleet_active.gif','images/faq_active.gif','images/contact_active.gif','images/home_active.gif','images/rates_active.gif','images/testimonials_active.gif'); hidefields();">
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
<form id="reserve" style="padding-bottom:0px;" name="reserve" method="post" action="check_out.php">
<div id="ContentPanel"> 
	<div id="CenterColumn"> 
     <div align="center">
    <img src="images/status_bar3.jpg" border="0" />
    </div>
    <br />
<div id="NormalText" class="NormalText"> 
			<div id="Box2" class="Box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="top" align="center">Your Current Itinerary</td>
        </tr>
        <tr>
          <td class="middle">
          <?php if ($_SESSION['trip_type'] == '1' || $_SESSION['trip_type'] == '2' || $_SESSION['trip_type'] == '3' || $_SESSION['trip_type'] == '4' || $_SESSION['trip_type'] == '5' || $_SESSION['trip_type'] == '6' || $_SESSION['trip_type'] == '9' || $_SESSION['trip_type'] == '11') { ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
           	  <td width="100%" class="ot">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><span class="date"><?php echo $_SESSION['travel_date']; ?></span></td>
              </tr>
              <?php 
              if ($_SESSION['from'] != '1a' && $_SESSION['from'] != '2a' && $_SESSION['to'] != '1a' && $_SESSION['to'] != '2a') { ?>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h'];?>:<?php echo $_SESSION['m'];?> <?php echo $_SESSION['ampm'];?></td>
              	</tr>
              <?php } ?>
              <?php
              //Show Flight details BEGIN
			  if ($_SESSION['from'] == '1a' || $_SESSION['from'] == '2a') { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['arriving_airline'];?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['flight_number'];?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h1'];?>:<?php echo $_SESSION['m1'];?> <?php echo $_SESSION['ampm1'];?></td>
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
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['arriving_airline'];?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['flight_number'];?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h1'];?>:<?php echo $_SESSION['m1'];?> <?php echo $_SESSION['ampm1'];?></td>
              </tr>
              <?php
			  //Show Flight details END
			  }
			  ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $to['name']; ?></td>
              </tr>
              </table>
              </td>
            </tr>
          </table>
          
          <br />
          <table width="100%" border="0" cellspacing="1" cellpadding="0" class="BorderBox">
            <tr>
              <td colspan="2" width="100%" valign="top" align="center" bgcolor="#ffff82" class="ot">
              <strong><?php $trip_type = get_trip_types_view($_SESSION['trip_type']); echo $trip_type['name']; ?></strong>:</strong> <span class="price"><?php if ($_SESSION['trip_type'] > 2) { echo "$".sprintf("%01.2f", $transfer['price_value']); } else { echo "$".sprintf("%01.2f", $price_local['price_value']);}; ?></span>
              </td>
            </tr>
          </table>
          <?php if ($_SESSION['trip_type'] == '2' || $_SESSION['trip_type'] == '4' || $_SESSION['trip_type'] == '6' || $_SESSION['trip_type'] == '11') { ?>
          <br />
          <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $to['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><span class="date"><?php echo $_SESSION['travel_date_roundtrip']; ?></span></td>
              </tr>
              <?php 
              if ($_SESSION['from'] != '1a' && $_SESSION['from'] != '2a' && $_SESSION['to'] != '1a' && $_SESSION['to'] != '2a') { ?>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h2'];?>:<?php echo $_SESSION['m2'];?> <?php echo $_SESSION['ampm2'];?></td>
              	</tr>
              <?php } ?>
              <?php
              //Show Flight details BEGIN
			  if ($_SESSION['to'] == '1a' || $_SESSION['to'] == '2a') { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['departing_airline_roundtrip']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['flight_number_roundtrip']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h3'];?>:<?php echo $_SESSION['m3'];?> <?php echo $_SESSION['ampm3'];?></td>
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
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['departing_airline_roundtrip']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['flight_number_roundtrip']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h3'];?>:<?php echo $_SESSION['m3'];?> <?php echo $_SESSION['ampm3'];?></td>
              </tr>
              <?php
			  //Show Flight details END
			  }
			  ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from['name']; ?></td>
              </tr>
              </table>
              <?php 
			  }
			  // For Transfers BEGIN
		   } else { 
		   
		   if ($_SESSION['trip_type'] == '7' || $_SESSION['trip_type'] == '8' || $_SESSION['trip_type'] == '10') {
		   ?>
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from1['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><span class="date"><?php echo $_SESSION['travel_date']; ?></span></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['arriving_airline'];?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['flight_number']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h1'];?>:<?php echo $_SESSION['m1'];?> <?php echo $_SESSION['ampm1'];?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $to1['name']; ?></td>
              </tr>
           </table>
           <br /><br />
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from2['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><span class="date"><?php echo $_SESSION['travel_date_extra']; ?></span></td>
              </tr>
              <?php 
              if ($_SESSION['from'] != '1a' && $_SESSION['from'] != '2a' && $_SESSION['to'] != '1a' && $_SESSION['to'] != '2a') { ?>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h4'];?>:<?php echo $_SESSION['m4'];?> <?php echo $_SESSION['ampm4'];?></td>
              	</tr>
              <?php } ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $to2['name']; ?></td>
              </tr>
           </table>
           <br /><br />
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from3['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><span class="date"><?php echo $_SESSION['travel_date_roundtrip']; ?></span></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['departing_airline_roundtrip']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['flight_number_roundtrip']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h3'];?>:<?php echo $_SESSION['m3'];?> <?php echo $_SESSION['ampm3'];?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $to4['name']; ?></td>
              </tr>
           </table>
           			<?php } ?>
          <?php } ?>
          </td>
        </tr>
        <tr>
          <td class="footer">&nbsp;</td>
        </tr>
      </table>
      <br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr>
        	<td align="left" class="ot"><a href="reserve_step3.php" title="Back"><img src="images/back.png" title="Back" border="0" /></a>
            </td>
            <td align="right" class="ot"><input src="images/check_out_now.jpg" border="0" type="image">
            </td>
        </tr>
      </table>  
    </div>
                  </div>
                <br />
    </div>
</div>
</form>
<!--End ContentPanl Here -->
<div id="Clear"> </div>
<!--Start Footer Here -->
        <div id="Footer">
          <?php include("includes/common/footer.php"); ?>
</div>
<!--End Footer Here -->
</div>

<map name="Map" id="Map"><area shape="rect" coords="257,5,276,25" href="index.php" alt="Home page" title="Home page" />
<area shape="rect" coords="284,5,306,25" href="my_account.php" alt="My account" title="My account" />
<area shape="rect" coords="316,6,336,25" href="contact.php" alt="Contact Us" title="Contact Us" /></map></body>
</html>
