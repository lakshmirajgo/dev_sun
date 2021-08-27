<?php
/**
 *	This script dispatches trip_sheet_print.php as email to the drivers
 *
 */
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

session_start();

if ( ! isset($_SESSION['auth_admin'])) {
	$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
	header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
	// Quit the script
	exit(); 
}

if (isset($_GET['multi_drivers_id']) && is_array($_GET['multi_drivers_id'])) {
	$driver_ids = $_GET['multi_drivers_id'];
}
elseif (isset($_GET['drivers_id'])) {
	$driver_ids = array($_GET['drivers_id']);
}
else {
	die('No driver selected.');
}

foreach ($driver_ids as $id) {

	if (empty($id)) {
		die('No driver selected.');
	}
	// overwrite global $_GET
	$_GET['drivers_id'] = $id;
	
	// set flags
	$no_trips_flag = false;
	
	ob_start();
	
	include('trip_sheet_print.php');
	
	$content = ob_get_clean();
	
	if ( ! $content) {
		print 'An error has occured while processing your request. ';
		print '<br>';
		print 'Error: driver_id = ' . $id;
		print '<br>';
	}
	else {
		
		$subject = "Trip Sheet " . date('m/d/Y', strtotime($_GET['from'])) . ' - ' . date('m/d/Y', strtotime($_GET['to']));
		$to = trim($driver['email']);
		$from = "no-reply@" . str_replace('www.', '', $_SERVER['HTTP_HOST']);
		
			$headers = "Content-type: text/html; charset=iso-8859-1 \r\n";
			$headers .= "From: " . $from . "\r\n";
			//$headers .= "Reply-To: " . $from . "\r\n";
			//$headers .= "Return-Path: " . $from . "\r\n";
			//$headers .= "CC: andy@sunstatelimo.com, mimi@sunstatelimo.com, moulay@sunstatelimo.com\r\n";
			$headers .= "CC: andy@sunstatelimo.com, moulay@sunstatelimo.com\r\n";
			//$headers .= "BCC: karl@imperialwebsolutions.net\r\n";
			
		if (filter_var($to, FILTER_VALIDATE_EMAIL) && ! $no_trips_flag && mail($to, $subject, $content, $headers)) {
			print 'Trip sheet sent to ';
			print $driver['first_name'] . ' ' . $driver['last_name'] . ' &lt;' . $driver['email'] . '&gt;';
			print '<br>';
		}
		else {
			print 'Failed to send trip sheet to ';
			print $driver['first_name'] . ' ' . $driver['last_name'] . ' &lt;' . $driver['email'] . '&gt;';
			if ( ! filter_var($to, FILTER_VALIDATE_EMAIL)) print ' (Driver has no email address on record)';
			elseif (isset($no_trips_flag)) print ' (Driver has no scheduled trips)';
			else print ' (Unknown error)';
			print '<br>';
		}
	}
}
?>