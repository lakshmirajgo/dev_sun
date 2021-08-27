<?php
session_start();
include("includes/functions/general_functions.php");
include("includes/functions/reservation_functions.php");
include("includes/functions/vehicle_functions.php");
include_once("includes/functions/location_functions.php");
include_once("includes/functions/trip_type_functions.php");	

$company_info = get_company_info(); 

	if(isset($_POST) && (!empty($_POST['Change_request']))){
		foreach($_POST as $key=>$value){
			if(strtolower($value) !="submit" ){
			if(strtolower($key) !="sendto" && strtolower($key) !="x" && strtolower($key) !="y"){
				//echo $key . ": \t" . $value . "<br />";
				$message .= "<strong>".ucfirst(str_replace("_", " ",$key)) . ":</strong> " . $value . "<br />\n";
			}
			}
		}
	
	$reservation_view = get_reservation_view($_GET['id']);
	$vehicle = get_vehicles_view($reservation_view['vehicle_id']);
	$trip_type = get_trip_types_view($reservation_view['trip_type']);
	$message_sunstate .='<br><br>
	<strong>Current Reservation Summary:</strong><br>
	Passenger Name: '.$reservation_view['first_name'].' '.$reservation_view['last_name'].'<br />
Total Price: $'.sprintf("%01.2f", $reservation_view['total_amount']).'<br />';
$message_sunstate .='
			  Trip Type: '.$trip_type['name'].'<br/>';
			  
			  $message_sunstate .='
          Transportation Type: '.$vehicle['name'].'<br />';
			  
			  $reservation_details = get_all_reservation_details($_GET['id']);
			  
			  $num_legs = count($reservation_details);
		  	  for ($count =0; $count <= $num_legs - 1; $count += 1) {
		  	  //print_r($reservation_details[$count]['from']);
			  $from[$count] = get_locations_view($reservation_details[$count]['from']);
		  	  $to[$count] = get_locations_view($reservation_details[$count]['to']);
			  
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { ?><?php if (check_arrival($reservation_details[$count]['from'])) { $message_sunstate .="Arrival: "; } else { $message_sunstate .="Departure: "; }; } 
			  $message_sunstate .='(From: '.$from[$count]['name'].' To: '.$to[$count]['name'].')<br>
			  Transfer Date: '.format_to_caldate($reservation_details[$count]['date']).'<br>';
			  
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { 
			  
			  if (check_arrival($reservation_details[$count]['from'])) { 
			  $message_sunstate .='Time of Arrival'; 
			  } else { $message_sunstate .='Time of Departure'; 
			  }; 
			  } else { $message_sunstate .='Time of Pickup'; };
			  
			  $message_sunstate .='
			   : '.format_time($reservation_details[$count]['time']).'<br>';
               }
	$message_sunstate .='
	Customer Comments: '.$reservation_view['customer_comments'].'<br><br>
	
	<strong>Payment Information:</strong><br>';
	
	if ($reservation_view['paying_cash'] == 'Yes') {
			  $message_sunstate .='
			  Paying Cash or Traveler check: '.$reservation_view['paying_cash'].'<br />';
			  }
	if (empty($reservation_view['payment_status'])) {
	$payment_status = 'Pending';
	} else {
	$payment_status = $reservation_view['payment_status'];
	}
	$message_sunstate .='
	Payment status: '.$payment_status.'<br>
	Card: '.$reservation_view['card_type'].' ending '.substr($reservation_view['card_number'],12, 4).' Exp: '.$reservation_view['exp_date'].'<br>
	';
	
	

	
	//Add a salutation an intro to the email
	$message = 'The following  reservation change request was  submitted online.  Please review the change request and update the  reservation accordingly.<br /><br /><strong>Reservation ID:</strong> '.$_GET['id'].'<br><strong>Client Email:</strong> <a href="mailto:'.$reservation_view['email'].'">'.$reservation_view['email'].'</a><br>
' . $message.'<br>Below are is the current reservation detail. To edit this reservation <a href="http://www.sunstatelimo.com/admin/reservation_manager.php?cAction=edit&id='.$_GET['id'].'" target="_blank">click here</a>' . $message_sunstate;
	
	// Send Email with content to info@ the domain name. This script should work for any site. 
	$from = $reservation_view['email'];
	$from = trim(str_replace(" ", "", $from));
	//This is a modification to make windows forms work
	ini_set("sendmail_from", $from);

	//ATTENTION: Please set the to email address that the content of this form will be sent to
	//Uncomment the below if you have created a hidden value named sendto in the form. Otherwise set the to email address manually by changing the $to variable
	//$to = $_POST['sendto'];
	
	//$to = "alexey@imperialwebsolutions.net";
	$to = $company_info['email'];
	//$to = "alexey@imperialwebsolutions.net";
	//$to = "info@".$_SERVER['HTTP_HOST'];
	$to = trim(str_replace(" ", "", $to));
	
	
	$headers = 'From: '. $from . "\r\n" .
    'Reply-To: '. $from . "\r\n" .
	"MIME-Version: 1.0\r\n" .
	"Content-type: text/html; charset=iso-8859-1\r\n".
    'X-Mailer: PHP/' . phpversion();
	
	//echo $reservation_view['email'];
	//exit;
	
	// Send the Message
	//function format mail("to", "subject", "message");
	mail($to, "Reservation#".$_GET['id']." Change request", $message, $headers);
	
	//Display thank you message. 
	$_SESSION['notice'] = '<div style="background-color:#d1fac3; padding:5px; border:#72da4e solid 1px; width:700px;" align="left">Thank you for the updates. We\'ll update your reservation and resend you a new confirmation with in 24hrs you can also log back to your reservation to verify your request has been met. If you are arriving with in 24hrs we strongly recommend that you contact us directly at 407-601-7900.<br><br>
<em>Sincerely,<br>
Sunstate Transportation</em>
</div>';
	echo "<script language=\"javascript\">alert('Thank you. Reservation change request submitted successfully. \\n\\n'); window.location='".$_SERVER['HTTP_REFERER']."';</script>";

	}
	else{
			echo "<script language=\"javascript\">alert('Please complete Change request field. \\n\\n'); window.location='".$_SERVER['HTTP_REFERER']."';</script>";
	}
?>