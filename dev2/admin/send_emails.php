<?php
	include("includes/functions/general_functions.php");
	include("includes/functions/reservation_functions.php");
	include("includes/functions/email_functions.php");	
	include("includes/functions/status_functions.php");	
	$company_info = get_company_info();
	// Gets all reservations and dates
	$reservation_email = get_all_reservations_for_email();
	
	// Get HTML EMAIL for Arrival
	$email_view = get_emails_view('2');
	
	$email_view2 = get_emails_view('5');
	
	//Chech if there's any reservations = 7 days before arrival
	
	if(count($reservation_email)>=1){
		foreach($reservation_email as $value){
		
		//print_r($value);
		
		// Get Data for Arrivals!!! (1 result from Query)
		$arrival_data=get_arrival_data($value['id']);
		
		//print_r($arrival_data['date']);
		//echo "<br><br>";
		
		//Check Reservation 1 Week before Arrival - Changed to 2 days before
		if (check_reservation_before($arrival_data['pickup_date'])) {
		$message = "This is a reminder email to confirm that we will see you on ".format_to_caldate($arrival_data['pickup_date'])." , ".format_time($arrival_data['pickup_time']).". ";
		
		$message .= $email_view['email_content'];
		$from = $company_info['email'];
		$from = trim(str_replace(" ", "", $from));
		//This is a modification to make windows forms work
		ini_set("sendmail_from", $from);
		$to = $value['email'];
	
		$headers = 'From: '. $from . "\r\n" .
    	'Reply-To: '. $from . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-type: text/html; charset=iso-8859-1\r\n".
    	'X-Mailer: PHP/' . phpversion();
		//print_r(str_replace("href=\"../", "href=\"http://www.sunstatelimo.com/", $message));
		//echo "<br><br>";
		$message = str_replace("href=\"../", "href=\"http://www.sunstatelimo.com/", $message);
		
		//print_r($value['id']);
		//echo "<br><br>";
		
		
		//Update Reservation status status
		$status='5'; // Status Awaiting Arrival
		update_status($status, $value['id']);
		mail($to, $email_view['email_title'], $message, $headers);
		}
		
		//echo $value['travel_date'];
		//echo $value['travel_date_roundtrip'];
		
		$departure_data=get_departure_data($value['id']); 
		if (check_reservation_after($departure_data['pickup_date'], $departure_data['pickup_date'])) {
		$message2 = $value['first_name']." ".$value['last_name'].",<br><br>";
		
		$message2 .= $email_view2['email_content'];
		$from = $company_info['email'];
		$from = trim(str_replace(" ", "", $from));
		//This is a modification to make windows forms work
		ini_set("sendmail_from", $from);
		$to = $value['email'];
	
		$headers = 'From: '. $from . "\r\n" .
    	'Reply-To: '. $from . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-type: text/html; charset=iso-8859-1\r\n".
    	'X-Mailer: PHP/' . phpversion();
		//print_r($message2);
		//echo "<br><br>";
		$message2 = str_replace("href=\"../", "href=\"http://www.sunstatelimo.com/", $message2);
		
		//print_r($to);
		mail($to, $email_view2['email_title'], $message2, $headers);
		}
		}
	}
	// There are no Reservations with this date
	else{
		echo "No Emails found with this date ";
		exit;
	}

?>