<?php
session_start();

if (!isset($_SESSION['auth_user'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
include("includes/functions/reservation_functions.php");
include("includes/functions/vehicle_functions.php");
include_once("includes/functions/location_functions.php");
include_once("includes/functions/trip_type_functions.php");	

$reservation_view = get_reservation_view($_GET['id']);	

?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="http://www.onlinevpm.com/admin/css/master_contract.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sun State Transportation - Reservation Information</title>
</head>
<SCRIPT TYPE="text/Javascript" LANGUAGE="JavaScript">
window.print();
</SCRIPT>
<body>
<div align="center">
<img src="../images/sunstate.gif" alt="Sunstate" />
<br /><br />
<span style="font-size:14px;">
      <strong>Reservation Information</strong></span>
</div>
      <table width="100%" border="1" align="center" cellpadding="4" cellspacing="2">
        <tr>
          <td colspan="4" bgcolor="#CCCCCC" class="bodytxt"><b>Transportation Information</b></td>
        </tr>
        <tr>
          <td width="25%" align="right"><strong>Vehicle</strong></td>
          <td width="25%"><?php $vehicle_view = get_vehicles_view($reservation_view['vehicle_id']); echo $vehicle_view['name']; ?>&nbsp;</td>
          <td width="25%" align="right"><strong>Passengers</strong></td>
          <td width="25%"><?php echo $reservation_view['passenger_count'];?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Child Carseat</strong></td>
          <td colspan="3"><?php echo $reservation_view['child_carseat']; ?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Arrival Date </strong></td>
          <td><?php echo format_to_caldate($reservation_view['travel_date']); ?>&nbsp;</td>
          <td align="right"><strong>Departure Date</strong></td>
          <td><?php echo format_to_caldate($reservation_view['travel_date_roundtrip']);?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Trip Type</strong></td>
          <td colspan="3"><?php $trip_type = get_trip_types_view($reservation_view['trip_type']); ?><?php echo $trip_type['name']; ?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Transportation From</strong></td>
          <td><?php if ($reservation_view['location1_id'] == '1a' || $reservation_view['location1_id'] == '2a') { $from = get_airports_view($reservation_view['location1_id']); } else { $from = get_locations_view($reservation_view['location1_id']); }; ?><?php echo $from['name']; ?>&nbsp;</td>
          <td align="right"><strong>Address</strong></td>
          <td><?php echo $from['address']. ", ".$from['city'].", ".$from['state']." ".$from['zip'];?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Pickup at</strong></td>
          <td colspan="3"><?php echo $reservation_view['pickup_at'];?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Arriving Airline</strong></td>
          <td><?php echo $reservation_view['arriving_airline']; ?>&nbsp; (Flight Number <?php echo $reservation_view['flight_number']; ?>)</td>
          <td align="right"><strong>Arriving at</strong></td>
          <td><?php echo $reservation_view['arriving_at'];?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Transportation To</strong></td>
          <td><?php if ($reservation_view['location2_id'] == '1a' || $reservation_view['location2_id'] == '2a') { $to = get_airports_view($reservation_view['location2_id']); } else { $to = get_locations_view($reservation_view['location2_id']); }; ?><?php echo $to['name']; ?>&nbsp;</td>
          <td align="right"><strong>Address</strong></td>
          <td><?php echo $to['address']. ", ".$to['city'].", ".$to['state']." ".$to['zip'];?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Pickup at</strong></td>
          <td colspan="3"><?php echo $reservation_view['pickup_at_roundtrip'];?></td>
        </tr>
        <tr>
          <td align="right"><strong>Departing Airline</strong></td>
          <td><?php echo $reservation_view['departing_airline_roundtrip']; ?>&nbsp; (Flight Number <?php echo $reservation_view['flight_number_roundtrip']; ?>)</td>
          <td align="right"><strong>Departing at</strong></td>
          <td><?php echo $reservation_view['departing_at'];?>&nbsp;</td>
        </tr>
      </table>
      
      <br />
      <table width="100%" border="1" align="center" cellpadding="4" cellspacing="2">
        <tr>
          <td colspan="4" bgcolor="#CCCCCC" class="bodytxt"><b>Passenger Information</b></td>
        </tr>
        <tr>
          <td width="25%" align="right"><strong>First &amp; Last Name</strong></td>
          <td width="25%"><?php echo $reservation_view['first_name'];?> <?php echo $reservation_view['last_name'];?>&nbsp;</td>
          <td width="25%" align="right"><strong>E-mail</strong></td>
          <td width="25%"><?php echo $reservation_view['email'];?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Address</strong></td>
          <td colspan="3"><?php if (empty($reservation_view['address'])) { echo "N/A"; } else { echo $reservation_view['address']; }; ?><?php if (!empty($reservation_view['address2'])) { echo ", ".$reservation_view['address2']; }; ?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>City </strong></td>
          <td><?php if (empty($reservation_view['city'])) { echo "N/A"; } else { echo $reservation_view['city']; }; ?>&nbsp;</td>
          <td align="right"><strong>State</strong></td>
          <td><?php echo $reservation_view['state'];?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Zip Code</strong></td>
          <td><?php if (empty($reservation_view['zip'])) { echo "N/A"; } else { echo $reservation_view['zip']; }; ?>&nbsp;</td>
          <td align="right"><strong>Country</strong></td>
          <td><?php echo $reservation_view['country'];?>&nbsp;</td>
        </tr>
      </table>
      <br />
      <table width="100%" border="1" align="center" cellpadding="4" cellspacing="2">
        <tr>
          <td colspan="4" bgcolor="#CCCCCC" class="bodytxt"><b>Cardholder Information</b></td>
        </tr>
        <tr>
          <td width="25%" align="right"><strong>First &amp; Last Name</strong></td>
          <td width="75%" colspan="3"><?php echo $reservation_view['first_name_billing'];?> <?php echo $reservation_view['last_name_billing'];?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Address</strong></td>
          <td colspan="3"><?php if (empty($reservation_view['address_billing'])) { echo "N/A"; } else { echo $reservation_view['address_billing']; }; ?><?php if (!empty($reservation_view['address2_billing'])) { echo ", ".$reservation_view['address2_billing']; }; ?>&nbsp;</td>
        </tr>
        <tr>
          <td width="25%" align="right"><strong>City </strong></td>
          <td width="25%"><?php if (empty($reservation_view['city_billing'])) { echo "N/A"; } else { echo $reservation_view['city_billing']; }; ?>&nbsp;</td>
          <td width="25%" align="right"><strong>State</strong></td>
          <td width="25%"><?php echo $reservation_view['state_billing'];?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Zip Code</strong></td>
          <td><?php if (empty($reservation_view['zip_billing'])) { echo "N/A"; } else { echo $reservation_view['zip_billing']; }; ?>&nbsp;</td>
          <td align="right"><strong>Country</strong></td>
          <td><?php echo $reservation_view['country_billing'];?>&nbsp;</td>
        </tr>
      </table>
      <br />
      <table width="100%" border="1" align="center" cellpadding="4" cellspacing="2">
        <tr>
          <td colspan="4" bgcolor="#CCCCCC" class="bodytxt"><b>Payment Information</b></td>
        </tr>
        <tr>
          <td width="25%" align="right"><strong>Total Amount</strong></td>
          <td width="25%"><?php echo "$".$reservation_view['total_amount'];?>&nbsp;</td>
          <td width="25%" align="right"><strong>Payment Method</strong></td>
          <td width="25%"><?php echo $reservation_view['card_type'];?>&nbsp;</td>
        </tr>
        <tr>
          <td align="right"><strong>Credit Card Number</strong></td>
          <td><?php echo $reservation_view['card_number'];?>&nbsp;</td>
          <td width="25%" align="right"><strong>Expiration Date</strong></td>
          <td width="25%"><?php echo $reservation_view['exp_date'];?>&nbsp;</td>
        </tr>
      </table>
</body>
</html>
