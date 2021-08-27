<?php
session_start();

if (!isset($_SESSION['auth'])) {
$_SESSION['redirect'] = 'edit_reservation.php?cAction=edit&id='.$_GET['id'].'';
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "index.php");
// Quit the script
exit(); 
}

	include("includes/functions/general_functions.php");
	include("includes/functions/reservation_functions.php");
	include("includes/functions/vehicle_functions.php");
	include_once("includes/functions/location_functions.php");
	include_once("includes/functions/trip_type_functions.php");		
	include("includes/functions/status_functions.php");	
	
	$company_info = get_company_info(); 
	$reservation_view = get_reservation_view($_GET['id']);
	
	// Redirect if customer's id is not = this reservation
	if ($reservation_view['client_id'] != $_SESSION['client_id']) {
	header ("Location: my_account.php");
	// Quit the script
	exit(); 
	}
	
	//Check Reservation Arrival Date
	$arrival_data=get_arrival_data($_GET['id']); 
	if (!check_reservation2($arrival_data[0]['date'])) {
	header ("Location: view_reservation.php?id=".$_GET['id']."");
	// Quit the script
	exit(); 
	}
	
	if ($_GET['cAction'] == 'edit'){
		$reservation_view = get_reservation_view($_GET['id']);
		
		if ($_POST['action'] == 'payment_info') {
			if (!checkCreditCard($_POST['card_number'], $_POST['card_type'], &$errornumber, &$errortext)) {
			$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">'.$errortext.'</span></div>';
			} else {
			if (edit_payment_info($_GET['id']))
			echo '<script language="javascript">alert(\'Reservation updated successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error updating reservation\');</script>';
			
			$reservation_view = get_reservation_view($_GET['id']);
		}
		}
	}
	
	if ($_GET['cAction'] == 'edit'){
	$reservation_view = get_reservation_view($_GET['id']);
		if ($_POST['action'] == 'cardholder_info') {
			if (edit_cardholder_info($_GET['id']))
			echo '<script language="javascript">alert(\'Reservation updated successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error updating reservation\');</script>';
			
			$reservation_view = get_reservation_view($_GET['id']);
		}
	}
	
	if ($_GET['cAction'] == 'edit'){
	$reservation_view = get_reservation_view($_GET['id']);
		if ($_POST['action'] == 'passenger_info') {
			if (edit_passenger_info($_GET['id']))
			echo '<script language="javascript">alert(\'Reservation updated successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error updating reservation\');</script>';
			
			$reservation_view = get_reservation_view($_GET['id']);
		}
	}
	
	if ($_GET['cAction'] == 'edit'){
	$reservation_view = get_reservation_view($_GET['id']);
		if ($_POST['action'] == 'reservation_info') {
			if (edit_reservation_info($_GET['id']))
			echo '<script language="javascript">alert(\'Reservation updated successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error updating reservation\');</script>';
			
			$reservation_view = get_reservation_view($_GET['id']);
		}
	}
	
	if ($_GET['cAction'] == 'edit'){
	$reservation_view = get_reservation_view($_GET['id']);
		if ($_POST['action'] == 'transportation_info') {
			if (edit_transportation_info($_GET['id']))
			echo '<script language="javascript">alert(\'Reservation updated successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error updating reservation\');</script>';
			
			$reservation_view = get_reservation_view($_GET['id']);
		}
	}
	
	include_once("includes/functions/location_functions.php");
	$all_locations = get_all_locations();
	$all_airports = get_all_airports();
	$all_vehicles = get_all_vehicles();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Orlando's Airport Premier Transportation Services - Edit Reservation</title>
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
<script language="JavaScript">
<!--
var url = location.href;	
if(url.charAt(4) != "s" || url.charAt(4) == "w" ){
window.location = "https://www.sunstatelimo.com/edit_reservation.php";
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
              <td><a href="reserve.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','images/reserve_active.gif',1)"><img src="images/reserve_normal.gif" name="Image8" width="153" height="33" border="0" id="Image8" /></a></td>
              <td><a href="contact.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9','','images/contact_active.gif',1)"><img src="images/contact_normal.gif" alt="Contact Us" name="Image9" width="116" height="33" border="0" id="Image9" /></a></td>
            </tr>
          </table>
        </div>
<!--End Navigation Here --> 
<div id="Banner"> 
<img src="images/<?php echo $img_head;?>" /><br />
</div>
<!--Start ContentPanl Here -->
<div id="ContentPanel"> 
	<div>
    <table width="100%" align="center" style="padding-top:10px;">
    <tr>
    	<td align="center">
    <?php echo $_SESSION['notice']; ?> 
    	</td>
    </tr>
    </table> 
    		<?php include("includes/common/menu.php"); ?>
<div id="NormalText" class="NormalText"> 
       
       <?php
	// Edit Reservation
	if ($_GET[cAction] == 'edit') {
	?>
	<table border="0" cellpadding="0" cellspacing="0" width="580" class="ot" align="center">
      <tbody><tr>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" background="images/middle_part.jpg">
          <tbody><tr>
          	<td width="11" height="11" background="images/top_left_curve.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>EDIT RESERVATION</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          	<td width="11" height="11" background="images/top_right_curve.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
          </tr>
          <tr>
          	<td width="11" height="11">&nbsp;</td>
            <td align="left" valign="top">
            <?php 
            //Check Reservation Arrival Date for Change request
			$arrival_data=get_arrival_data($_GET['id']); 
			if (check_reservation($arrival_data[0]['date'])) {
			?>
            <form id="edit_reservation" style="padding-bottom:0px;" name="edit_reservation" method="post" action="change_request_email.php?id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              	<td width="100%" height="10" colspan="2"></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Reservation Change Request</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="left" height="30" width="100%" colspan="2" class="ob" style="padding:5px;">To request a change on your reservation, please enter your message or change instructions below and Sunstate Transportation will update your reservation accordingly.</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Contact Phone: </strong></td>
                <td align="left" height="30"><input name="contact_phone" class="bodytxt" size="20" id="contact_phone" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Customer Comments:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="Change_request" rows="3" cols="36" class="bodytxt"></textarea></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob">&nbsp;</td>
                <td align="right" height="30" width="62%" class="ot2"><input src="images/submit_btn.jpg" border="0" height="22" type="image" width="80"></td>
              </tr>
            </table>
            </form>
            <?php } ?>
            <form id="reserve" style="padding-bottom:0px;" name="reserve" method="post" action="edit_reservation.php?cAction=edit&id=<?php echo $_GET['id']; ?>">
            <input name="action" type="hidden" value="transportation_info">
            <table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Transportation Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Vehicle:</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $vehicle_view = get_vehicles_view($reservation_view['vehicle_id']);?>
                <?php echo $vehicle_view['name']; ?></td>
			  </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Trip Type:</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $trip_type = get_trip_types_view($reservation_view['trip_type']); ?>
                <?php echo $trip_type['name']; ?>
                </td>
              </tr>
               <?php if ($reservation_view['store_stop'] =='Yes') { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Quick Grocery Stop:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">Yes</td>
              </tr>
              <?php } ?>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Passengers:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><?php echo $reservation_view['passenger_count']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Car Seat:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><?php echo $reservation_view['child_carseat']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Booster Seat:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><?php echo $reservation_view['booster_seat']; ?></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2">
                <?php
		  //Number of legs -> make a loop BEGIN
          $reservation_details = get_all_reservation_details($_GET['id']);
			  
			  $num_legs = count($reservation_details);
		  	  for ($count =0; $count <= $num_legs - 1; $count += 1) {
		  	  //print_r($reservation_details[$count]['from']);
			  $from[$count] = get_locations_view($reservation_details[$count]['from']);
		  	  $to[$count] = get_locations_view($reservation_details[$count]['to']);
		  ?>
          <input name="details_id<?php echo $count; ?>" type="hidden" value="<?php echo $reservation_details[$count]['id']; ?>" />
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
                <td align="left" height="20" width="62%" class="ot2">
                <input value="U" name="datefmt" type="radio" checked="checked" style="display:none;"><input value="W" name="datefmt" type="radio" style="display:none;"><input value="J" name="datefmt" type="radio" style="display:none;"><input value="P" name="daterng" type="radio" style="display:none;"><input value="A" name="daterng" type="radio" style="display:none;"><input value="F" name="daterng" type="radio" checked="checked" style="display:none;">
                <?php echo format_to_caldate($reservation_details[$count]['date']);?></td>
              </tr>
              <?php if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong><strong>
                  <?php if (check_arrival($reservation_details[$count]['from'])) { echo "Arriving"; } else { echo "Departing"; }; ?>
                </strong> Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $reservation_details[$count]['airline'] ;?>
			    </td>
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
           </tbody>
           </table>
           </form>
           <form id="edit_reservation" style="padding-bottom:0px;" name="edit_reservation" method="post" action="edit_reservation.php?cAction=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="passenger_info">
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Passenger Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>First Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><?php echo $reservation_view['first_name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Last Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><?php echo $reservation_view['last_name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address:</strong></td>
                <td align="left" height="30"><?php echo $reservation_view['address']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2:</strong></td>
                <td align="left" height="30"><?php echo $reservation_view['address2']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City:</strong></td>
                <td align="left" height="30"><?php echo $reservation_view['city']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State:</strong></td>
                <td align="left" height="30"><?php echo $reservation_view['state']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code:</strong></td>
                <td align="left" height="30"><?php echo $reservation_view['zip']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country:</strong></td>
                <td align="left" height="30">
                <?php echo $reservation_view['country']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>E-mail:</strong></td>
                <td align="left" height="30"><?php echo $reservation_view['email']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Phone Number: </strong></td>
                <td align="left" height="30"><?php echo $reservation_view['phone_number']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Mobile Phone: </strong></td>
                <td align="left" height="30"><?php echo $reservation_view['cellphone']; ?></td>
              </tr>
           </table>
           </form>
           
          <form id="edit_reservation" style="padding-bottom:0px;" name="edit_reservation" method="post" action="edit_reservation.php?cAction=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="cardholder_info">
          <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Billing Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>First Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name_billing" class="bodytxt" size="39" type="text" value="<?php echo $reservation_view['first_name_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Last Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name_billing" class="bodytxt" size="39" type="text" value="<?php echo $reservation_view['last_name_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address:</strong></td>
                <td align="left" height="30"><input name="address_billing" class="bodytxt" size="39" id="address" type="text" value="<?php echo $reservation_view['address_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2:</strong></td>
                <td align="left" height="30"><input name="address2_billing" class="bodytxt" size="39" id="address2" type="text" value="<?php echo $reservation_view['address2_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City:</strong></td>
                <td align="left" height="30"><input name="city_billing" class="bodytxt" size="39" id="town" type="text" value="<?php echo $reservation_view['city_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State:</strong></td>
                <td align="left" height="30">
                						<select name="state_billing" id="state_billing" class="bodytxt">
                        <option value="<?php echo $reservation_view['state_billing']; ?>"><?php echo $reservation_view['state_billing']; ?></option>
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
                <td align="right" height="30" class="ob"><strong>Zip Code:</strong></td>
                <td align="left" height="30"><input name="zip_billing" class="bodytxt" size="10" id="zip" type="text" value="<?php echo $reservation_view['zip_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country:</strong></td>
                <td align="left" height="30">
                <select name="country_billing" id="country_billing" class="bodytxt">
                <option value="<?php echo $reservation_view['country_billing']; ?>"><?php echo $reservation_view['country_billing']; ?></option>
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
                <td align="right" height="30" width="38%" class="ob">&nbsp;</td>
                <td align="right" height="30" width="62%" class="ot2"><input src="images/but_update.jpg" border="0" height="22" type="image" width="68"></td>
              </tr>
           </table>
           </form>
           
           <form id="edit_reservation" style="padding-bottom:0px;" name="edit_reservation" method="post" action="edit_reservation.php?cAction=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="payment_info">
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Payment Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Total Amount:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><span class="price"><?php echo "$".sprintf("%01.2f", $reservation_view['total_amount']); ?></span></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Payment Method:</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <select id="card_type" name="card_type" size="1">
																	<option value="<?php echo $reservation_view['card_type']; ?>" selected="selected"><?php echo $reservation_view['card_type']; ?></option>
																	<option value="Visa">Visa</option>
																	<option value="MasterCard">MasterCard</option>
																	<option value="Discover">Discover</option>
																</select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Credit Card Number:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="card_number" class="bodytxt" size="32" type="text" value="<?php echo "************". substr($reservation_view['card_number'],12, 4);?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Expiration Date:</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $exp_date = format_exp_date($reservation_view['exp_date']); ?>
                <select id="ExpMonth" name="ExpMonth" size="1">
                													<option value="<?php echo $exp_date[0] ; ?>"><?php echo $exp_date[0] ; ?></option>
																	
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
                                                                	<option value="<?php echo $exp_date[1] ; ?>"><?php echo $exp_date[1] ; ?></option>
																	
																	<option value="2008">2008</option>

																	
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
              	<td width="100%" colspan="2"><div style="background-color:#efefef; padding:5px; border:#CCCCCC solid 1px;"><span style="color:#000000;"><input name="paying_cash" value="Yes" id="paying_cash" type="checkbox" <?php if ($reservation_view['paying_cash'] == 'Yes') { ?> checked="checked" <?php } ?>> Please do not charge my credit card. I will be paying cash or traveler check upon arrival I understand I am submitting my credit card info only to guarantee my reservation. I also read and understand Sunstate Transportation cancellation policy.</span></div>      
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob">&nbsp;</td>
                <td align="right" height="30" width="62%" class="ot2"><input src="images/but_update.jpg" border="0" height="22" type="image" width="68"></td>
              </tr>
           </table>
           </form>
           
           <form id="edit_reservation" style="padding-bottom:0px;" name="edit_reservation" method="post" action="edit_reservation.php?cAction=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="reservation_info">
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              	<td width="100%" height="10" colspan="2"></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Reservation Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Customer Comments:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="customer_comments" rows="3" cols="36" class="bodytxt"><?php echo $reservation_view['customer_comments']; ?></textarea></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob">&nbsp;</td>
                <td align="right" height="30" width="62%" class="ot2"><input src="images/but_update.jpg" border="0" height="22" type="image" width="68"></td>
              </tr>
            </table>
            </form>
          </td>
          <td width="11" height="11">&nbsp;</td>
          </tr>
          </tbody>
          </table>
          <table cellpadding="0" cellspacing="0" border="0" width="100%" background="images/middle_part.jpg">
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
              	<td width="11" height="11" background="images/bottom_left_curve.jpg" style="background-repeat:no-repeat; background-position:bottom;"></td>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
                <td width="11" height="11" background="images/bottom_right_curve.jpg" style="background-repeat:no-repeat; background-position:bottom;"></td>
              </tr>
            </table>
			</td>
          </tr>
        </table>   
        
		</td>
      </tr>
    </tbody></table>
	<?php
	}
	?>
       <br />
    </div>
                  </div>
    			
                <br />
    </div>
</div>

<!--End ContentPanl Here -->
<div id="Clear"> </div>
<!--Start Footer Here -->
<?php 
unset ($_SESSION['redirect']);
?>
        <div id="Footer">
          <?php include("includes/common/footer.php"); ?>
</div>
	<div align="center" style="padding:5px;">
    Designed by: <a href="http://www.imperialwebsolutions.net/" target="_blank">Imperial Web Solutions</a>
    </div>
<!--End Footer Here -->
</div>
<?php
unset ($_SESSION['notice']);
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
