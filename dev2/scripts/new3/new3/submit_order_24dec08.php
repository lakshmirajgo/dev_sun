<?php
session_start();
include("includes/functions/general_functions.php");
include("includes/functions/reservation_functions.php");
include("includes/functions/vehicle_functions.php");
include_once("includes/functions/location_functions.php");
include_once("includes/functions/trip_type_functions.php");	
include("includes/functions/email_functions.php");	

$company_info = get_company_info(); 

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

$reservation_view = get_reservation_view($_SESSION['reservation_id']);	

$email_view = get_emails_view('1');

$vehicle = get_vehicles_view($_SESSION['vehicle']);
$trip_type = get_trip_types_view($reservation_view['trip_type']);
$pickup_at= explode(":", $reservation_view['pickup_at']);
$arriving_at= explode(":", $reservation_view['arriving_at']);
$pickup_at_roundtrip= explode(":", $reservation_view['pickup_at_roundtrip']); 
$departing_at= explode(":", $reservation_view['departing_at']);
$pickup_at_extra= explode(":", $reservation_view['pickup_at_extra']); 

$from1 = $reservation_view['location1'];
$to1 = $reservation_view['location2'];
$from2 = $reservation_view['location2'];
$to2 = $reservation_view['location3'];
$from3 = $reservation_view['location3'];
$to4 = $reservation_view['location1'];
	
if (!empty($_POST)) {
	$_SESSION['first_name'] = $_POST['first_name'];
	$_SESSION['last_name'] = $_POST['last_name'];
	$_SESSION['address'] = $_POST['address'];
	$_SESSION['address2'] = $_POST['address2'];
	$_SESSION['town'] = $_POST['town'];
	$_SESSION['state'] = $_POST['state'];
	$_SESSION['zip'] = $_POST['zip'];
	$_SESSION['country'] = $_POST['country'];
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['first_name_billing'] = $_POST['first_name_billing'];
	$_SESSION['last_name_billing'] = $_POST['last_name_billing'];
	$_SESSION['address_billing'] = $_POST['address_billing'];
	$_SESSION['address2_billing'] = $_POST['address2_billing'];
	$_SESSION['city_billing'] = $_POST['city_billing'];
	$_SESSION['state_billing'] = $_POST['state_billing'];
	$_SESSION['zip_billing'] = $_POST['zip_billing'];
	$_SESSION['country_billing'] = $_POST['country_billing'];
	$_SESSION['customer_comments'] = $_POST['customer_comments'];
	
	if (empty($_SESSION['first_name'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your First name!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['last_name'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your Last name!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['address'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your Address!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['town'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your City!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['state'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your State!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['zip'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your Zip code!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['country'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your Country!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['first_name_billing'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your billing First Name!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['last_name_billing'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your billing Last Name!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['address_billing'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your billing Address!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['city_billing'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your billing City!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['state_billing'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your billing State!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['zip_billing'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your billing Zip code!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['country_billing'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your billing Country!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	
	if (!check_email_address($_POST['email'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Your Email address is not valid!</span></div>';
	header ("Location: check_out.php");
	exit();
	} else {
	if (!checkCreditCard($_POST['card_number'], $_POST['card_type'], &$errornumber, &$errortext)) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">'.$errortext.'</span></div>';
	header ("Location: check_out.php");
	exit();
	} else {
	if(add_reservations()) {
$reservation_view = get_reservation_view($_SESSION['reservation_id']);

$message_sunstate_admin .='The following reservation was placed online:';
$message_sunstate .='<br><br>
<strong>Reservation ID:</strong> SUNSTATE-'.$reservation_view['id'].'<br />
<strong>Date Submitted:</strong> '.format_to_caldate($reservation_view['reservation_date']).'<br />
<strong>Total Amount:</strong> $'.sprintf("%01.2f", $reservation_view['total_amount']).'<br />
<strong>Name:</strong> '.$reservation_view['first_name'].' '.$reservation_view['last_name'].'<br />';
			  if ($reservation_view['paying_cash'] == 'Yes') {
			  $message_sunstate .='
			  <strong>Paying Cash or Traveler check:</strong> '.$reservation_view['paying_cash'].'<br />';
			  }
			  
			  $message_sunstate .='
          <strong>Vehicle:</strong> '.$vehicle['name'].'<br />
		  <strong>Passengers:</strong> '.$reservation_view['passenger_count'].'<br />';
              
			  if (!empty($reservation_view['child_carseat'])) { 
			  
			  $message_sunstate .='
              <strong>Child Car Seat:</strong> '.$reservation_view['child_carseat'].'<br />';
              }
			  
			  if (!empty($reservation_view['booster_seat'])) { 
			  
			  $message_sunstate .='
              <strong>Child Booster Seat:</strong> '.$reservation_view['booster_seat'].'<br />';
              }
			  $trip_type = get_trip_types_view($reservation_view['trip_type']);
			  $message_sunstate .='
              <strong>Transfer Date:</strong> '.format_to_caldate($reservation_view['travel_date']).'<br />';
			  if ($reservation_view['store_stop'] =='Yes') {
			 $message_sunstate .='
			 <strong>Quick Grocery Stop:</strong> '.$reservation_view['store_stop'].'<br />';
			  }
			  $message_sunstate .='
			  <strong>Trip Type:</strong> '.$trip_type['name'].' ';
              
              
              if ($reservation_view['trip_type'] == '1' || $reservation_view['trip_type'] == '2' || $reservation_view['trip_type'] == '3' || $reservation_view['trip_type'] == '4' || $reservation_view['trip_type'] == '5' || $reservation_view['trip_type'] == '6' || $reservation_view['trip_type'] == '9' || $reservation_view['trip_type'] == '11') {
			  
			  $message_sunstate .='
              <strong>(From:</strong> '.$from['name'].' ';
              if ($reservation_view['location1_id'] != '1a' && $reservation_view['location1_id'] != '2a' && $reservation_view['location2_id'] != '1a' && $reservation_view['location2_id'] != '2a') {
			  
			  $message_sunstate .='
			  <strong> - Pickup at:</strong> '.format_time($reservation_view['pickup_at']).' ';
			  
			  }
               
			   $message_sunstate .='
              <strong>To:</strong> '.$to['name'].')<br />'; 
              //Show Flight details BEGIN
			  if ($reservation_view['location1_id'] == '1a' || $reservation_view['location1_id'] == '2a') { 
			  
			  $message_sunstate .='
              <strong>Arriving Airline:</strong> '.$reservation_view['arriving_airline'].'<br />
			  <strong>Flight Number:</strong> '.$reservation_view['flight_number'].'<br />
			  <strong>Arriving at:</strong> '.format_time($reservation_view['arriving_at']).'<br />';
   
			  //Show Flight details END
			  }
			   
			  //Show Flight details BEGIN
			  if ($reservation_view['location2_id'] =='1a' || $reservation_view['location2_id'] == '2a') {
			                
             $message_sunstate .='
              <strong>Departing Airline:</strong> '.$reservation_view['arriving_airline'].'<br />
			  <strong>Flight Number:</strong> '.$reservation_view['flight_number'].'<br />
			  <strong>Departing at:</strong> '.format_time($reservation_view['arriving_at']).'<br />';
      
			  //Show Flight details END
			  }
		   
           if ($reservation_view['trip_type'] == '2' || $reservation_view['trip_type'] == '4' || $reservation_view['trip_type'] == '6' || $reservation_view['trip_type'] == '11') { 
           
           $message_sunstate .='
           <strong>From:</strong> '.$to['name'].' ';
		   $message_sunstate .='
           <strong>To:</strong> '.$from['name'].'<br />
		   <strong>Transfer Date:</strong> '.format_to_caldate($reservation_view['travel_date_roundtrip']).'<br />';
		   
              if ($reservation_view['location1_id'] != '1a' && $reservation_view['location1_id'] != '2a' && $reservation_view['location2_id'] != '1a' && $reservation_view['location2_id'] != '2a') {
			$message_sunstate .='
		   <strong>Pickup at:</strong> '.format_time($reservation_view['pickup_at_roundtrip']).'<br />';
                
            };
         	  //Show Flight details BEGIN
			  if ($reservation_view['location2_id'] == '1a' || $reservation_view['location2_id'] == '2a') {
			  
			  $message_sunstate .='
              <strong>Arriving Airline:</strong> '.$reservation_view['departing_airline_roundtrip'].'<br />
			  <strong>Arriving at:</strong> '.format_time($reservation_view['departing_at']).'<br/>';
              
			  //Show Flight details END
			  }
			   
			  //Show Flight details BEGIN
			  if ($reservation_view['location1_id'] =='1a' || $reservation_view['location1_id'] == '2a') {
			  
			  $message_sunstate .='
              
              <strong>Departing Airline:</strong> '.$reservation_view['departing_airline_roundtrip'].'<br />
			  <strong>Departing at:</strong> '.format_time($reservation_view['departing_at']).'<br />'; 
				
			  //Show Flight details END
			  }
			  
			  
			  
              
              		} // For Transfers BEGIN
		   } else { 
		   
		   if ($reservation_view['trip_type'] == '7' || $reservation_view['trip_type'] == '8' || $reservation_view['trip_type'] == '10') {
		  $message_sunstate .='
           
              <br><strong>From:</strong> '.$from1.'<br />';
	
				$message_sunstate .='
                
               <strong>Arriving Airline:</strong> '.$reservation_view['arriving_airline'].'<br />
			   
			   <strong>Flight Number:</strong> '.$reservation_view['flight_number'].'<br />
			   <strong>Arriving at:</strong> '.format_time($reservation_view['arriving_at']).'<br />'; 
				
				$message_sunstate .='
                <strong>To:</strong> '.$to1.'<br />
				
				<strong>From:</strong> '.$from2.'<br />
				<strong>Transfer Date:</strong> '.format_to_caldate($reservation_view['travel_date_extra']).'<br />';
			
             	if ($reservation_view['location1_id'] != '1a' && $reservation_view['location1_id'] != '2a' && $reservation_view['location2_id'] != '1a' && $reservation_view['location2_id'] != '2a') {
				
				$message_sunstate .='
				<strong>Pickup at:</strong> '.format_time($reservation_view['pickup_at_extra']).'<br />';
				};
				$message_sunstate .='
                <strong>To:</strong> '.$to2.'<br />
				<strong>From:</strong> '.$from3.'<br />';
              
				$message_sunstate .='
                <strong>Transfer Date:</strong> '.format_to_caldate($reservation_view['travel_date_roundtrip']).'<br />
				<strong>Departing Airline:</strong> '.$reservation_view['departing_airline_roundtrip'].'<br />
				<strong>Departing at:</strong> '.format_time($reservation_view['departing_at']).'<br />'; 
				
				$message_sunstate .='
                
                <strong>To:</strong> '.$to4.'<br/>';
           			} 
             
              } 
	$message_sunstate .='
	<strong>Customer Comments:</strong> '.$reservation_view['customer_comments'];

	
$message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sun State Transportation - Reservation Information</title>
<link href="http://sunstatelimo.com/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div align="left">
<img src="http://sunstatelimo.com/images/sunstate.gif" alt="Sunstate" />
</div>
<br /><br />';
$message .='This confirms that Sun Sate Transportation has received your transportation request. Your confirmation number is  SUNSTATE-'.$reservation_view['id'].'.<br /><br />
Dear '.$reservation_view['first_name'].':<br />';
$message .= $email_view['email_content'];

/*
$message .= '
<br /><br />
<div id="Box2" class="Box_new">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="top" align="center">Order confirmation</td>
        </tr>
        <tr>
          <td class="middle">
          Below is all of your reservation information.<br />
          <strong>Reservation ID:</strong> '.$reservation_view['id'].'<br />
          <strong>Date:</strong> '.format_to_caldate($reservation_view['reservation_date']).'
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
                <td align="left" height="20" width="50%" class="ot2">'.$reservation_view['first_name'].'</td>
			  </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Last Name:</strong></td>
                <td align="left" height="20" width="50%" class="ot2">'.$reservation_view['last_name'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Street Address:</strong></td>
                <td align="left" height="20">'.$reservation_view['address'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Address Line 2:</strong></td>
                <td align="left" height="20">'.$reservation_view['address2'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>City:</strong></td>
                <td align="left" height="20">'.$reservation_view['city'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>State:</strong></td>
                <td align="left" height="20">'.$reservation_view['state'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Zip Code:</strong></td>
                <td align="left" height="20">'.$reservation_view['zip'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Country:</strong></td>
                <td align="left" height="20">'.$reservation_view['country'].'</td>
              </tr>
               <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Reservation Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Customer Comments:</strong></td>
                <td align="left" height="20" width="50%" class="ot2">'.$reservation_view['customer_comments'].'</td>
              </tr>
              </table>
                </td>
                <td width="50%" valign="top" style="padding-left:3px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Cardholder Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>First Name:</strong></td>
                <td align="left" height="20" width="50%" class="ot2">'.$reservation_view['first_name_billing'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Last Name:</strong></td>
                <td align="left" height="20" width="50%" class="ot2">'.$reservation_view['last_name_billing'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Street Address:</strong></td>
                <td align="left" height="20">'.$reservation_view['address_billing'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Address Line 2:</strong></td>
                <td align="left" height="20">'.$reservation_view['address2_billing'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>City:</strong></td>
                <td align="left" height="20">'.$reservation_view['city_billing'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>State:</strong></td>
                <td align="left" height="20">'.$reservation_view['state_billing'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Zip Code:</strong></td>
                <td align="left" height="20">'.$reservation_view['zip_billing'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" class="ob"><strong>Country:</strong></td>
                <td align="left" height="20">'.$reservation_view['country_billing'].'</td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Payment Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Total Amount:</strong></td>
                <td align="left" height="20" width="50%" class="ot2"><span class="price">$'.sprintf("%01.2f", $reservation_view['total_amount']).'</span></td>
  			  </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Payment Method:</strong></td>
                <td align="left" height="20" width="50%" class="ot2">'.$reservation_view['card_type'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Credit Card Number:</strong></td>
                <td align="left" height="20" width="50%" class="ot2">************'.substr($reservation_view['card_number'],12, 4).'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Expiration Date:</strong></td>
                <td align="left" height="20" width="50%" class="ot2">'.$reservation_view['exp_date'].'</td>
              </tr>';
			  if ($reservation_view['paying_cash'] == 'Yes') {
			  $message .= '
			  <tr valign="middle">
                <td align="right" height="20" width="50%" class="ob"><strong>Paying Cash or Traveler check:</strong></td>
                <td align="left" height="20" width="50%" class="ot2">'.$reservation_view['paying_cash'].'</td>
              </tr>';
			  }
			  
			  $message .= '
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
                <td align="left" height="20" width="62%" class="ot2">'.$vehicle['name'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Passengers:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['passenger_count'].'</td>
              </tr>';
              
			  if (!empty($reservation_view['child_carseat'])) { 
			  
			  $message .= '
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Child Car Seat:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['child_carseat'].'</td>
              </tr>';
              }
			  
			  if (!empty($reservation_view['booster_seat'])) { 
			  
			  $message .= '
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Child Booster Seat:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['booster_seat'].'</td>
              </tr>';
              }
			  
			  $message .= '
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Travel Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><span class="date">'.format_to_caldate($reservation_view['travel_date']).'</span></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Trip Type:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$trip_type['name'].'</td>
              </tr>';
			 if ($reservation_view['store_stop'] =='Yes') {
			 $message .= '
			 <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Quick stop:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['store_stop'].'</td>
              </tr>';
			  }
              
              
              if ($reservation_view['trip_type'] == '1' || $reservation_view['trip_type'] == '2' || $reservation_view['trip_type'] == '3' || $reservation_view['trip_type'] == '4' || $reservation_view['trip_type'] == '5' || $reservation_view['trip_type'] == '6' || $reservation_view['trip_type'] == '9' || $reservation_view['trip_type'] == '11') {
			  
			  $message .= '
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$from['name'].'</td>
              </tr>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.format_time($reservation_view['pickup_at']).'
                </td>
              	</tr>';
                
              //Show Flight details BEGIN
			  if ($reservation_view['location1_id'] == '1a' || $reservation_view['location1_id'] == '2a') { 
			  
			  $message .= '
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['arriving_airline'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['flight_number'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.format_time($reservation_view['arriving_at']).'
                </td>
              </tr>';
   
			  //Show Flight details END
			  }
			   
			  //Show Flight details BEGIN
			  if ($reservation_view['location2_id'] =='1a' || $reservation_view['location2_id'] == '2a') {
			                
              $message .= '
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['arriving_airline'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['flight_number'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.format_time($reservation_view['arriving_at']).'
                </td>
              </tr>';
      
			  //Show Flight details END
			  }
			  
			  $message .= '
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$to['name'].'</td>
              </tr>
              <tr valign="middle">
                <td height="5" width="100%" colspan="2">&nbsp;</td>
              </tr>
              
           <!-- Round trip -->';
		   
           if ($reservation_view['trip_type'] == '2' || $reservation_view['trip_type'] == '4' || $reservation_view['trip_type'] == '6') { 
           
           $message .= '
           <tr>
              <td colspan="2" width="100%" height="30" valign="middle" align="center" bgcolor="#ffff82" class="BorderBox">
              <strong>Return Trip</strong>
              </td>
            </tr>
            <tr valign="middle">
                <td height="5" width="100%" colspan="2">&nbsp;</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$to['name'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Travel Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><span class="date">'.format_to_caldate($reservation_view['travel_date_roundtrip']).'</span></td>
              </tr>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.format_time($reservation_view['pickup_at_roundtrip']).'
                </td>
              	</tr>';
                
                
         	  //Show Flight details BEGIN
			  if ($reservation_view['location2_id'] == '1a' || $reservation_view['location2_id'] == '2a') {
			  
			  $message .= '
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['departing_airline_roundtrip'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['flight_number_roundtrip'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.format_time($reservation_view['departing_at']).'
                </td>
              </tr>';
              
			  //Show Flight details END
			  }
			   
			  //Show Flight details BEGIN
			  if ($reservation_view['location1_id'] =='1a' || $reservation_view['location1_id'] == '2a') {
			  
			  $message .= '
              
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['departing_airline_roundtrip'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['flight_number_roundtrip'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">';
				
				format_time($reservation_view['departing_at']); 
				
				$message .= '
                </td>
              </tr>';
             
			  //Show Flight details END
			  }
			  
			  
			  $message .= '

              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$from['name'].'</td>
              </tr>
              <tr valign="middle">
                <td height="10" width="100%" colspan="2">&nbsp;</td>
              </tr>';
              
              		} // For Transfers BEGIN
		   } else { 
		   
		   if ($reservation_view['trip_type'] == '7' || $reservation_view['trip_type'] == '8' || $reservation_view['trip_type'] == '10') {
		  $message .= '
           
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$from1.'</td>
              </tr>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">';
				
				format_time($reservation_view['pickup_at']); 
				
				$message .= '
                
                </td>
              	</tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['arriving_airline'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['flight_number'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">';
				
				format_time($reservation_view['arriving_at']); 
				
				$message .= '
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$to1.'</td>
              </tr>
           	  <tr valign="middle">
                <td height="10" width="100%" colspan="2">&nbsp;</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$from2.'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Travel Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><span class="date">'.format_to_caldate($reservation_view['travel_date_extra']).'</span></td>
              </tr>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$pickup_at_extra['0'].':'.$pickup_at_extra['1'].' '.$pickup_at_extra['2'].'
                </td>
              	</tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$to2.'</td>
              </tr>
              <tr valign="middle">
                <td height="10" width="100%" colspan="2">&nbsp;</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$from3.'</td>
              </tr>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$message_new .= $pickup_at_roundtrip['0'].':'.$pickup_at_roundtrip['1'].' '.$pickup_at_roundtrip['2'].'
                </td>
              	</tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Travel Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><span class="date">'.format_to_caldate($reservation_view['travel_date_roundtrip']).'</span></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['departing_airline_roundtrip'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$reservation_view['flight_number_roundtrip'].'</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">';
				
				format_time($reservation_view['departing_at']); 
				
				$message .= '
                
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">'.$to4.'</td>
              </tr>';
           			} 
					
				$message .= '
               <tr valign="middle">
                <td height="10" width="100%" colspan="2">&nbsp;</td>
              </tr>
              </table>';
             
              } 
			  
			  $message .= '
     
          <!-- Round trip -->
           
            </td>
              </tr>
              </table>
              
          </td>
        </tr>
        <tr>
          <td class="footer">&nbsp;</td>
        </tr>
      </table>
    </div><br />';
	*/
	$message .= $email_view['email_content2'];
	
	$message .='Again, we thank you for your business and look forward to seeing you on '.format_to_caldate($reservation_view['travel_date']).' at '.format_time($reservation_view['arriving_at']).' time in Orlando, Florida!!<p><em>Sincerely,</em><br /><strong>Sun State Transportations</strong><br><br>
	
	Your transportation information appears below:<br />
	Please review this information below and let us know if there are any changes or issues.<br /><br />
	You can view your reservation online 24 hours a day. <a href="http://sunstatelimo.com/my_account.php" target="_blank">http://sunstatelimo.com/my_account.php</a>
	';
	
	$message .= $message_sunstate;
	$message .='

</body>
</html>';
$message_sunstate_admin .= $message_sunstate;
	$reservation_view = get_reservation_view($_SESSION['reservation_id']);	
	$from = $company_info['email'];
	$from = trim(str_replace(" ", "", $from));
	//This is a modification to make windows forms work
	ini_set("sendmail_from", $from);

	//ATTENTION: Please set the to email address that the content of this form will be sent to
	//Uncomment the below if you have created a hidden value named sendto in the form. Otherwise set the to email address manually by changing the $to variable
	//$to = $_POST['sendto'];
	
	$to = $reservation_view['email'];
	//$to = "alexey@imperialwebsolutions.net";
	//$to = "info@".$_SERVER['HTTP_HOST'];
	//$to = trim(str_replace(" ", "", $to));
	
	$headers = 'From: '. $from . "\r\n" .
    'Reply-To: '. $from . "\r\n" .
	"MIME-Version: 1.0\r\n" .
	"Content-type: text/html; charset=iso-8859-1\r\n".
    'X-Mailer: PHP/' . phpversion();
	
	// Send the Message
	//function format mail("to", "subject", "message");
	
	//print_r($message_sunstate_admin);
	mail($to, $email_view['email_title'], $message, $headers);

	$headers = 'From: '. $from . "\r\n" .
    'Reply-To: '. $from . "\r\n" .
	"MIME-Version: 1.0\r\n" .
	"Content-type: text/html; charset=iso-8859-1\r\n".
    'X-Mailer: PHP/' . phpversion();
	mail($from, 'New Transportation Request', $message_sunstate_admin, $headers);
		header ("Location: reservation_confirmation.php");
		} else {
			//header ("Location: reservation_error.php");
		}
	}
	}
	}
?>