<?php
session_start();
include("../includes/functions/general_functions.php");
include("../includes/functions/reservation_functions.php");
include("../includes/functions/vehicle_functions.php");
include_once("../includes/functions/location_functions.php");
include_once("../includes/functions/trip_type_functions.php");	
include("../includes/functions/email_functions.php");	

if (!empty($_GET['id'])) {
$company_info = get_company_info(); 
$reservation_view = get_reservation_view($_GET['id']);
$email_view = get_emails_view('1');

$vehicle = get_vehicles_view($reservation_view['vehicle_id']);
$trip_type = get_trip_types_view($reservation_view['trip_type']);


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
			
			  if ($reservation_view['store_stop'] =='Yes') {
			 $message_sunstate .='
			 Quick Grocery Stop: '.$reservation_view['store_stop'].'<br />';
			  }
			  $message_sunstate .='
			  Trip Type: '.$trip_type['name'].'<br/>';
			  
			  $reservation_details = get_all_reservation_details($_GET['id']);
			  
			  $num_legs = count($reservation_details);
		  	  for ($count =0; $count <= $num_legs - 1; $count += 1) {
		  	  //print_r($reservation_details[$count]['from']);
			  $from[$count] = get_locations_view($reservation_details[$count]['from']);
		  	  $to[$count] = get_locations_view($reservation_details[$count]['to']);
			  
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { ?><?php if (check_arrival($reservation_details[$count]['from'])) { $message_sunstate .="Arrival: "; } else { $message_sunstate .="Departure: "; }; } 
			  $message_sunstate .='(From: '.$from[$count]['name'].' To: '.$to[$count]['name'].')<br>
			  Transfer Date: '.format_to_caldate($reservation_details[$count]['date']).'<br>';
			  
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['from'])) {
              if (check_arrival($reservation_details[$count]['from'])) { $message_sunstate .="Arriving: "; } else { $message_sunstate .="Departing: "; };
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
$message .='This confirms that Sun Sate Transportation has received your transportation request. Your confirmation number is  SUNSTATE-'.$reservation_view['id'].'.<br /><br />
Dear '.$reservation_view['first_name'].':<br />';
$message .= $email_view['email_content'];

	$message .= $email_view['email_content2'];
	
	$reservation_details = get_all_reservation_details($_GET['id']);
	
	$message .='The day before you are scheduled to return to the airport we will attempt to get in touch with you by using the cell phone number you provide. If you do not hear from us by that day please call the above telephone number to confirm. Again, we thank you for your business and look forward to seeing you on '.format_to_caldate($reservation_details[0]['pickup_date']).' at '.format_time($reservation_details[0]['pickup_time']).' time in Orlando, Florida!!<p><em>Sincerely,</em><br /><strong>Sun State Transportations</strong><br><br>
	
	Your transportation information appears below:<br />
	Please review this information below and let us know if there are any changes or issues.<br /><br />
	You can view your reservation online 24 hours a day. <a href="http://sunstatelimo.com/my_account.php" target="_blank">http://sunstatelimo.com/my_account.php</a>
	';
	
	$message .= $message_sunstate;
	$message .='

</body>
</html>';
$message_sunstate_admin .= $message_sunstate;
	$reservation_view = get_reservation_view($_GET['id']);	
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
	
	//print_r($to);
	//exit;
	mail($to, "Reservation# ".$_GET['id']." update" , $message, $headers);

	$headers = 'From: '. $to . "\r\n" .
    'Reply-To: '. $to . "\r\n" .
	"MIME-Version: 1.0\r\n" .
	"Content-type: text/html; charset=iso-8859-1\r\n".
    'X-Mailer: PHP/' . phpversion();
	
	//print_r($message_sunstate_admin);
	//exit;
	mail($from, "Reservation# ".$_GET['id']." update", $message_sunstate_admin, $headers);
	
	echo "<script language=\"javascript\">alert('Email confirmation resent successfully. \\n\\n'); window.location='".$_SERVER['HTTP_REFERER']."';</script>";
}
?>
