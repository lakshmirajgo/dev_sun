<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/location_functions.php");
include ("includes/functions/price_functions.php");
include ("includes/functions/reservation_functions.php");
include_once("includes/functions/trip_type_functions.php");	
include ("includes/functions/vehicle_functions.php");

if (!isset($_SESSION['step4'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "reserve.php");
// Quit the script
exit(); 
}

if (!isset($_SESSION['trip_type'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "reserve.php");
// Quit the script
exit(); 
}


//print_r($_SESSION);
$company_info = get_company_info(); 


$price_local = get_prices_view_local($_SESSION['vehicle'], $_SESSION['trip_type'], $from['zone_id'], $to['zone_id']);

//echo $_SESSION['reservation_id'];

$reservation_view = get_reservation_view($_SESSION['reservation_id']);	
//print_r($reservation_view);

$vehicle = get_vehicles_view($_SESSION['vehicle']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Orlando's Airport Premier Transportation Services - Reservation Confirmation</title>
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
<script language="JavaScript">
<!--
var url = location.href;	
if(url.charAt(4) != "s" || url.charAt(4) == "w" ){
window.location = "https://www.sunstatelimo.com/reservation_confirmation.php";
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
<?php //Validate Shades of Green Customers BEGIN
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
<div id="ContentPanel"> 
	<div id="CenterColumn">
    <br /> 
    <div align="center">
    <img src="images/status_bar5.jpg" border="0" />
    </div>
    <br />
<div id="NormalText" class="NormalText"> 
	<div id="Box2" class="Box_new">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="top" align="center">Reservation confirmation</td>
        </tr>
        <tr>
          <td class="middle">
          A copy of your confirmation which includes your transportation request has been sent to your email address. <!--<i><?php echo $reservation_view['email']; ?></i> //--><br />
          <br />
          Below is all of your reservation information.<br />
          <strong>Reservation ID:</strong> <?php echo $reservation_view['id']; ?><br />
          <strong>Date:</strong> <?php echo format_to_caldate($reservation_view['reservation_date']); ?>
          <br /><br />
          <table width="100%" cellpadding="0" cellspacing="0" border="0">
          	<tr>
            	<td width="50%" valign="top" style="padding-right:3px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
           <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Passenger Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>First Name:</strong></td>
                <td align="left" height="20" width="50%" class="ot2"><?php echo $reservation_view['first_name']; ?></td>
			  </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Last Name:</strong></td>
                <td align="left" height="20" width="50%" class="ot2"><?php echo $reservation_view['last_name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Street Address:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['address']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Address Line 2:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['address2']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>City:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['city']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>State:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['state']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Zip Code:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['zip']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Country:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['country']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Phone Number:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['phone_number']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Mobile Phone:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['cellphone']; ?></td>
              </tr>
               <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Reservation Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Customer Comments:</strong></td>
                <td align="left" height="20" width="50%" class="ot2"><?php echo $reservation_view['customer_comments']; ?></td>
              </tr>
              </table>
                </td>
                <td width="50%" valign="top" style="padding-left:3px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Billing Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>First Name:</strong></td>
                <td align="left" height="20" width="50%" class="ot2"><?php echo $reservation_view['first_name_billing']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Last Name:</strong></td>
                <td align="left" height="20" width="50%" class="ot2"><?php echo $reservation_view['last_name_billing']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Street Address:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['address_billing']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Address Line 2:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['address2_billing']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>City:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['city_billing']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>State:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['state_billing']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Zip Code:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['zip_billing']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Country:</strong></td>
                <td align="left" height="20"><?php echo $reservation_view['country_billing']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob">&nbsp;</td>
                <td align="left" height="20">&nbsp;</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob">&nbsp;</td>
                <td align="left" height="20">&nbsp;</td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Payment Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Total Amount:</strong></td>
                <td align="left" height="20" width="50%" class="ot2"><span class="price"><?php echo "$".sprintf("%01.2f", $reservation_view['total_amount']); ?></span></td>
  			  </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Payment Method:</strong></td>
                <td align="left" height="20" width="50%" class="ot2"><?php echo $reservation_view['card_type']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Credit Card Number:</strong></td>
                <td align="left" height="20" width="50%" class="ot2">************<?php echo substr($reservation_view['card_number'],12, 4);?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Expiration Date:</strong></td>
                <td align="left" height="20" width="50%" class="ot2"><?php echo $reservation_view['exp_date']; ?></td>
              </tr>
              <?php if ($reservation_view['paying_cash'] == 'Yes') { ?> 
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Paying Cash or Traveler check:</strong></td>
                <td align="left" height="20" width="50%" class="ot2"><?php echo $reservation_view['paying_cash']; ?></td>
              </tr>
              <?php } ?>
          </table>
                </td>
            </tr>
          </table>
          
          
          <table width="100%" cellpadding="0" cellspacing="0" border="0">
          	<tr>
              	<td width="100%" colspan="2" align="center" valign="middle"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Travel Information</span></div>              	</td>
              </tr>
           </table>
           
           
           
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Vehicle:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $vehicle['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Passengers:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $reservation_view['passenger_count']; ?></td>
              </tr>
              <?php if (!empty($reservation_view['child_carseat'])) { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Car Seat:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $reservation_view['child_carseat']; ?></td>
              </tr>
              <?php } ?>
              <?php if (!empty($reservation_view['booster_seat'])) { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Booster Seat:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $reservation_view['booster_seat']; ?></td>
              </tr>
              <?php } ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Trip Type:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php $trip_type = get_trip_types_view($reservation_view['trip_type']);
				//Special prices for Shades of Green Round trip BEGIN
				$reservation_details = get_all_reservation_details($_SESSION['reservation_id']);
			  	if (count($reservation_details) >= '2') {
			  	$trip_type['name'] = 'Round trip: '.$trip_type['name'];
			  	};
			  	//Special prices for Shades of Green Round trip END
				
				echo $trip_type['name']; ?></td>
              </tr>
               <?php if ($reservation_view['store_stop'] =='Yes') { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Quick Grocery Stop:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $reservation_view['store_stop']; ?></td>
              </tr>
              <?php } ?>
             </table>
              <?php
		  //Number of legs -> make a loop BEGIN
         	$reservation_details = get_all_reservation_details($_SESSION['reservation_id']);
			  
			  $num_legs = count($reservation_details);
		  	  for ($count =0; $count <= $num_legs - 1; $count += 1) {
		  	  //print_r($reservation_details[$count]['from']);
			  $from[$count] = get_locations_view($reservation_details[$count]['from']);
		  	  $to[$count] = get_locations_view($reservation_details[$count]['to']);
		  ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
           	  <td width="100%" class="ot">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              <td colspan="2" width="100%" valign="top" align="center" bgcolor="#ffff82" class="BorderBox" style="padding:5px;">
              <strong><?php if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { ?><?php if (check_arrival($reservation_details[$count]['from'])) { echo "Arrival"; } else { echo "Departure"; }; ?><? } else { echo "Transfer"; }; ?></strong>              </td>
             </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from[$count]['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo format_to_caldate($reservation_details[$count]['date']);?></td>
              </tr>
              <?php if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong><strong>
                  <?php if (check_arrival($reservation_details[$count]['from'])) { echo "Arriving"; } else { echo "Departing"; }; ?>
                </strong> Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">
                <?php echo $reservation_details[$count]['airline']; ;?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $reservation_details[$count]['flight_number'];?></td>
              </tr>
              <?php } ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong><?php if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { if (check_arrival($reservation_details[$count]['from'])) { echo "Arriving"; } else { echo "Departing"; }; } else { echo "Pickup"; }; ?> at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo format_time($reservation_details[$count]['time']); ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $to[$count]['name']; ?></td>
              </tr>
          </table>
          </td>
          </tr>
          </table>
          <?php
		  //Number of legs -> make a loop END
		  } ?>
          </td>
        </tr>
        <tr>
          <td class="footer">&nbsp;</td>
        </tr>
      </table>
    </div>  
    </div>
    <div align="center">
                <a href="print_reservation.php?id=<?php echo $_SESSION['reservation_id']; ?>" target="_blank"><img src="images/print_reservation.jpg" border="0"></a> <a href="my_account.php"><img src="images/continue.jpg" border="0"></a>
                </div>
                <br />
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
    </div>
<!--End Footer Here -->
</div>
<?php
unset ($_SESSION['vehicle']);
unset ($_SESSION['phone_number']);
unset ($_SESSION['cellphone']);
unset ($_SESSION['trip_type']);
unset ($_SESSION['from']);
unset ($_SESSION['to']);
unset ($_SESSION['from1']);
unset ($_SESSION['to1']);
unset ($_SESSION['from2']);
unset ($_SESSION['to2']);
unset ($_SESSION['from3']);
unset ($_SESSION['to3']);
unset ($_SESSION['travel_date']);
unset ($_SESSION['date1']);
unset ($_SESSION['date2']);
unset ($_SESSION['date3']);
unset ($_SESSION['airline1']);
unset ($_SESSION['airline2']);
unset ($_SESSION['airline3']);
unset ($_SESSION['passenger_count']);
unset ($_SESSION['child_carseat']);
unset ($_SESSION['child_boosterseat']);
unset ($_SESSION['h']);
unset ($_SESSION['m']);
unset ($_SESSION['ampm']);
unset ($_SESSION['flight_number1']);
unset ($_SESSION['flight_number2']);
unset ($_SESSION['flight_number3']);
unset ($_SESSION['h1']);
unset ($_SESSION['m1']);
unset ($_SESSION['ampm1']);
unset ($_SESSION['h2']);
unset ($_SESSION['m2']);
unset ($_SESSION['ampm2']);
unset ($_SESSION['h3']);
unset ($_SESSION['m3']);
unset ($_SESSION['ampm3']);
unset ($_SESSION['h4']);
unset ($_SESSION['m4']);
unset ($_SESSION['ampm4']);
unset ($_SESSION['first_name_billing']);
unset ($_SESSION['last_name_billing']);
unset ($_SESSION['address_billing']);
unset ($_SESSION['address2_billing']);
unset ($_SESSION['city_billing']);
unset ($_SESSION['state_billing']);
unset ($_SESSION['zip_billing']);
unset ($_SESSION['country_billing']);
unset ($_SESSION['customer_comments']);
unset ($_SESSION['reservation_id']);
unset ($_SESSION['step2']);
unset ($_SESSION['step3']);
unset ($_SESSION['step4']);
unset ($_SESSION['first_name']);
unset ($_SESSION['last_name']);
unset ($_SESSION['address']);
unset ($_SESSION['address2']);
unset ($_SESSION['town']);
unset ($_SESSION['state']);
unset ($_SESSION['zip']);
unset ($_SESSION['country']);
unset ($_SESSION['location1']);
unset ($_SESSION['location2']);
unset ($_SESSION['location3']);
?>
<map name="Map" id="Map"><area shape="rect" coords="257,5,276,25" href="index.php" alt="Home page" title="Home page" />
<area shape="rect" coords="284,5,306,25" href="my_account.php" alt="My account" title="My account" />
<area shape="rect" coords="316,6,336,25" href="contact.php" alt="Contact Us" title="Contact Us" /></map>
<a href="http://www.instantssl.com" id="comodoTL">SSL</a>
<script language="JavaScript" type="text/javascript">
COT("https://sunstatelimo.com/images/cot.gif", "SC2", "none");
</script>
</body>
</html>
