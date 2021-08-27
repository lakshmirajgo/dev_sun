<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}

include("includes/functions/general_functions.php");
include("includes/functions/reservation_functions.php");
include("includes/functions/vehicle_functions.php");
include_once("includes/functions/location_functions.php");
include_once("includes/functions/trip_type_functions.php");	

$company_info = get_company_info(); 
$reservation_view = get_reservation_view($_GET['id']);
//print_r($reservation_view);	

$vehicle = get_vehicles_view($reservation_view['vehicle_id']);
?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sun State Transportation - Print Reservation</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div align="center">
<img src="images/sunstate.gif" alt="Sunstate" />
</div>
<br /><br />
<div id="Box2" class="Box_new">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="top" align="center">Reservation confirmation</td>
        </tr>
        <tr>
          <td class="middle">
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
                <td align="left" height="20" width="62%" class="ot2"><?php $trip_type = get_trip_types_view($reservation_view['trip_type']); echo $trip_type['name']; ?></td>
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
         	$reservation_details = get_all_reservation_details($_GET['id']);
			  
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
      <div align="center">
                <a href="javascript:window.print();"><img src="../images/print_reservation.jpg" border="0"></a>
                </div>
    </div>
</body>
</html>
