<?php
session_start();
include("includes/functions/general_functions.php");
include("includes/functions/reservation_functions.php");
include("includes/functions/vehicle_functions.php");
include_once("includes/functions/location_functions.php");
include_once("includes/functions/trip_type_functions.php");	
include("includes/functions/email_functions.php");	

$company_info = get_company_info(); 

$reservation_view = get_reservation_view($_SESSION['reservation_id']);	

$email_view = get_emails_view('1');

$vehicle = get_vehicles_view($_SESSION['vehicle']);
$trip_type = get_trip_types_view($reservation_view['trip_type']);
	
if (!empty($_POST)) {
	$_SESSION['first_name'] = $_POST['first_name'];
	$_SESSION['last_name'] = $_POST['last_name'];
	$_SESSION['address'] = $_POST['address'];
	$_SESSION['address2'] = $_POST['address2'];
	$_SESSION['town'] = $_POST['town'];
	$_SESSION['state'] = $_POST['state'];
	$_SESSION['zip'] = $_POST['zip'];
	$_SESSION['country'] = $_POST['country'];
	$_SESSION['phone_number'] = $_POST['phone_number'];
	$_SESSION['cellphone'] = $_POST['cellphone'];
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
	if (empty($_SESSION['phone_number'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your Phone number!</span></div>';
	header ("Location: check_out.php");
	exit();
	};
	if (empty($_SESSION['cellphone'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Please enter your Mobile Phone!</span></div>';
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
	
	if (isset($_POST['ExpMonth']) && isset($_POST['ExpYear'])) {
		if (strtotime($_POST['ExpMonth'] . ' 1 ' . $_POST['ExpYear']) < strtotime(date('m/d/y'))) {
			$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Your credit card has expired!</span></div>';
			header ("Location: check_out.php");
			exit;
		}
	}
	else {
		$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Your credit card expiration date is required!</span></div>';
		header ("Location: check_out.php");
		exit;
	}
	
	if (!check_email_address($_SESSION['email'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Your Email address is not valid!</span></div>';
	header ("Location: check_out.php");
	exit();
	} else {
	if (!checkCreditCard($_POST['card_number'], $_POST['card_type'], $errornumber, $errortext)) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">'.$errortext.'</span></div>';
	header ("Location: check_out.php");
	exit();
	} else {
	if(add_reservations()) {
$reservation_view = get_reservation_view($_SESSION['reservation_id']);

// Destroy Session here

$message_sunstate_admin .='The following reservation was placed online:';
$message_sunstate .='<br><br>
Reservation ID: SUNSTATE-'.$reservation_view['id'].'<br />
Date Submitted: '.format_to_caldate($reservation_view['reservation_date']).'<br />
Total Amount: $'.sprintf("%01.2f", $reservation_view['total_amount']).'<br />
Name: '.$reservation_view['first_name'].' '.$reservation_view['last_name'].'<br />
Phone Number: '.$reservation_view['phone_number'].'<br />
Mobile Phone: '.$reservation_view['cellphone'].'<br />';
			  if ($reservation_view['paying_cash'] == 'Yes') {
			  $message_sunstate .='
			  Paying Cash or Traveler check: '.$reservation_view['paying_cash'].'<br />';
			  }
			  
			  $message_sunstate .='
          Vehicle: '.$vehicle['name'].'<br />
		  Passengers: '.$reservation_view['passenger_count'].'<br />';
              
			  if (!empty($reservation_view['child_carseat'])) { 
			  
			  $message_sunstate .='
              Child Car Seat: '.$reservation_view['child_carseat'].'<br />';
              }
			  
			  if (!empty($reservation_view['booster_seat'])) { 
			  
			  $message_sunstate .='
              Child Booster Seat: '.$reservation_view['booster_seat'].'<br />';
              }
			  $trip_type = get_trip_types_view($reservation_view['trip_type']);
			  //Special prices for Shades of Green Round trip BEGIN
			  if ($_SESSION['trip_type_new'] == '2') {
			  $trip_type['name'] = 'Round trip: '.$trip_type['name'];
			  };
			  //Special prices for Shades of Green Round trip END
			
			  if ($reservation_view['store_stop'] =='Yes') {
			 $message_sunstate .='
			 Quick Grocery Stop: '.$reservation_view['store_stop'].'<br />';
			  }
			  $message_sunstate .='
			  Trip Type: '.$trip_type['name'].'<br/>';
			  
			  $reservation_details = get_all_reservation_details($_SESSION['reservation_id']);
			  
			  $num_legs = count($reservation_details);
		  	  for ($count =0; $count <= $num_legs - 1; $count += 1) {
		  	  //print_r($reservation_details[$count]['from']);
			  $from[$count] = get_locations_view($reservation_details[$count]['from']);
		  	  $to[$count] = get_locations_view($reservation_details[$count]['to']);
			  
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { ?><?php if (check_arrival($reservation_details[$count]['from'])) { $message_sunstate .= "Arrival: "; } else { $message_sunstate .= "Departure: "; }; } 
			  $message_sunstate .='(From: '.$from[$count]['name'].' To: '.$to[$count]['name'].')<br>
			  Transfer Date: '.format_to_caldate($reservation_details[$count]['date']).'<br>';
			  
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['from'])) {
              if (check_arrival($reservation_details[$count]['from'])) { $message_sunstate .= "Arriving: "; } else { $message_sunstate .= "Departing: "; };
			  $message_sunstate .='
                Airline: '.$reservation_details[$count]['airline'].'<br>
				Flight Number: '.$reservation_details[$count]['flight_number'].'<br>';
              } 
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { 
			  
			  if (check_arrival($reservation_details[$count]['from'])) { 
			  $message_sunstate .='Arrival '; 
			  } else { $message_sunstate .='Departure '; 
			  }; 
			  } else { $message_sunstate .='Pickup '; };
			  
			  $message_sunstate .='
			   at: '.format_time($reservation_details[$count]['time']).'<br>';
               }
	$message_sunstate .='
	Customer Comments: '.$reservation_view['customer_comments'];

	
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
$message .='Dear '.$reservation_view['first_name'].':<br /><br />Thank you for choosing Sunstate Transportation. This confirms that we have received your transportation request. Your confirmation number is SUNSTATE-'.$reservation_view['id'].'.<br /><br />';
$message .= $email_view['email_content'];

	$message .= $email_view['email_content2'];
	
	$reservation_details = get_all_reservation_details($_SESSION['reservation_id']);
	
	/*$message .='The day before you are scheduled to return to the airport we will attempt to get in touch with you by using the cell phone number you provide. If you do not hear from us by that day please call the above telephone number to confirm. Again, we thank you for your business and look forward to seeing you on '.format_to_caldate($reservation_details[0]['pickup_date']).' at '.format_time($reservation_details[0]['pickup_time']).' in Orlando, Florida!!<br/><br/>We look forward to providing you with excellent service.<br /><p><em>Sincerely,</em><br /><strong>Sun State Transportations</strong><br><br>
	
	Your transportation information appears below:<br />
	Please review this information below and let us know if there are any changes or issues.<br /><br />
	You can view your reservation online 24 hours a day. <a href="http://sunstatelimo.com/my_account.php" target="_blank">http://sunstatelimo.com/my_account.php</a>
	';*/
	
	$message .='Again, we thank you for your business and look forward to seeing you on '.format_to_caldate($reservation_details[0]['pickup_date']).' at '.format_time($reservation_details[0]['pickup_time']).' in Orlando, Florida!!<br/><br/>We look forward to providing you with excellent service.<br /><p><em>Sincerely,</em><br /><strong>Sun State Transportations</strong><br><br>
	
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
	'Bcc: '. $from . "\r\n" .
	"MIME-Version: 1.0\r\n" .
	"Content-type: text/html; charset=iso-8859-1\r\n".
    'X-Mailer: PHP/' . phpversion();
	
	// Send the Message
	//function format mail("to", "subject", "message");
	
	//print_r($message);
	//exit;
	mail($to, $email_view['email_title'], $message, $headers);

	$headers = 'From: '. $to . "\r\n" .
    'Reply-To: '. $to . "\r\n" .
	"MIME-Version: 1.0\r\n" .
	"Content-type: text/html; charset=iso-8859-1\r\n".
    'X-Mailer: PHP/' . phpversion();
	mail($from, 'New Transportation Request', $message_sunstate_admin, $headers);
		header ("Location: reservation_confirmation.php");
		} else {
			//header ("Location: reservation_error.php");if($_SERVER['REMOTE_ADDR'] == '97.68.74.30')
            {
                echo '<pre>';
                echo 'THIS CODE LOCATION: line:'; print_r(__LINE__ - 3); echo '<br />';
                echo 'FILE:'; print_r(__FILE__); echo '<br /><br />';
                
            	//INSERT OUTPUT DATA HERE
            	echo 'DATA:'; print_r($_SESSION['notice']);
                echo '</pre>';
            }
		}
	}
	}
	}
?>
