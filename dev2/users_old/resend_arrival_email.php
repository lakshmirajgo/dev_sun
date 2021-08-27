<?php
	include("includes/functions/general_functions.php");
	include("includes/functions/reservation_functions.php");
	include("includes/functions/email_functions.php");	
	include("includes/functions/status_functions.php");	
	$company_info = get_company_info();
	$reservation_view = get_reservation_view($_GET['id']);
	
	// Get HTML EMAIL for Arrival
	$email_view = get_emails_view('2');
	
	$email_view2 = get_emails_view('5');
		
		// Get Data for Arrivals!!! (1 result from Query)
		$arrival_data=get_arrival_data($_GET['id']);
		
		
		if (!empty($arrival_data)) {
		$message = "This is a reminder email that we will see you on ".format_to_caldate($arrival_data['pickup_date']).", ".format_time($arrival_data['pickup_time']).". ";
		
		$message .= $email_view['email_content'];
		$from = $company_info['email'];
		$from = trim(str_replace(" ", "", $from));
		//This is a modification to make windows forms work
		ini_set("sendmail_from", $from);
		$to = $reservation_view['email'];
	
		$headers = 'From: '. $from . "\r\n" .
    	'Reply-To: '. $from . "\r\n" .
		'Bcc: '. $from . "\r\n" .
		"MIME-Version: 1.0\r\n" .
		"Content-type: text/html; charset=iso-8859-1\r\n".
    	'X-Mailer: PHP/' . phpversion();
		//print_r(str_replace("href=\"../", "href=\"http://www.sunstatelimo.com/", $message));
		//echo "<br><br>";
		$message = str_replace("href=\"../", "href=\"http://www.sunstatelimo.com/", $message);
		
		//print_r($reservation_view['id']);
		//echo "<br><br>";
		
		
		//Update Reservation status status
		//$status='5'; // Status Awaiting Arrival
		//update_status($status, $reservation_view['id']);
		mail($to, $email_view['email_title'], $message, $headers);
		echo "<script language=\"javascript\">alert('Email resent successfully. \\n\\n'); window.location='".$_SERVER['HTTP_REFERER']."';</script>";
		} else {
		echo "<script language=\"javascript\">alert('The arrival data not found. \\n\\n'); window.location='".$_SERVER['HTTP_REFERER']."';</script>";
		}
?>