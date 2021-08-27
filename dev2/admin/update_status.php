<?php
	include("includes/functions/general_functions.php");
	include("includes/functions/reservation_functions.php");
	include("includes/functions/email_functions.php");	
	include("includes/functions/status_functions.php");	

	$company_info = get_company_info();
	// Gets all reservations and dates
//	$reservation_info = get_all_reservations_for_statuses();
//	echo count($reservation_info).'<br />';
    $reservation_info = get_all_reservations_for_status_update();
//	echo count($reservation_info).'<br />';

	//Chech if there's any reservations = 7 days before arrival
	if(count($reservation_info)>=1)
	{
		foreach($reservation_info as $value)
		{
			// Get Data for Arrivals!!! (1st result from Query)
			$arrival_data=get_arrival_data_new($value['id']);
			//Check Reservation if Arrival date is TODAY 
			if (check_reservation_today($arrival_data['date'])) {
				//Update status BEGIN
				//echo "Arrival";
				//print_r($value);
				//echo "<br><br>";
				$status='4'; // Status Arrived
				update_status($status, $value['id']);
				//Update status END
			}
			
			$departure_data=get_departure_data($value['id']); 
			//Check Reservation if Departure date is TODAY 
			if (check_reservation_today($departure_data['date'])) {
				//Update status BEGIN
				//echo "Departure";
				//print_r($value);
				//echo "<br><br>";
				$status='3'; // Status Departed
				update_status($status, $value['id']);
				//Update status END
			}
		}
	}
	// There are no Reservations with this date
	else{
		echo "No Emails found with this date ";
		exit;
	}

?>