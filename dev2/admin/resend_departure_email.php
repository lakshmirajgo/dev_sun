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
	
		//echo $reservation_view['travel_date'];
		//echo $reservation_view['travel_date_roundtrip'];
		
		$departure_data=get_departure_data($_GET['id']); 
		
		if (!empty($departure_data)) {
		$message2 = $reservation_view['first_name']." ".$reservation_view['last_name'].",<br><br>";
		
		$message2 .= $email_view2['email_content'];
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
		//print_r($message2);
		//echo "<br><br>";
		$message2 = str_replace("href=\"../", "href=\"http://www.sunstatelimo.com/", $message2);
		
		//print_r($to);
		mail($to, $email_view2['email_title'], $message2, $headers);
		echo "<script language=\"javascript\">alert('Email resent successfully. \\n\\n'); window.location='".$_SERVER['HTTP_REFERER']."';</script>";
		} else {
		echo "<script language=\"javascript\">alert('The departure data not found. \\n\\n'); window.location='".$_SERVER['HTTP_REFERER']."';</script>";
		}
?>