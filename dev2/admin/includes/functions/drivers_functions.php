<?php
	//Get ALL drivers
	function get_all_drivers(){
		global $db;
		
		if (empty($_GET['orderby'])) {
			$orderby_sql = " first_name ASC";
			} else {
				if ($_GET['orderby'] == 'first_name') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " first_name ASC";
					} else {
					$orderby_sql = " first_name DESC";
					}
				}
				
				
				if ($_GET['orderby'] == 'employment_date') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " employment_date ASC";
					} else {
					$orderby_sql = " employment_date DESC";
					}
				}
			}

			$get_all_drivers_sql = "SELECT * FROM mod_drivers ORDER BY $orderby_sql";
			//echo "I am here! SQL IS: " . $get_all_drivers_sql ; exit;
			//print_r($get_all_drivers_sql);
			//exit;
			if(!$result = $db->select($get_all_drivers_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_drivers[] = $data;

				return $all_drivers;
			}
	}
	
	function get_driver_view($id){
		global $db;
			$get_driver_view_sql = "SELECT * FROM mod_drivers where id='$id'";
			if(!$result = $db->select($get_driver_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Get current Driver
	function get_drivers_view($id){
		global $db;
			$get_drivers_view_sql = "SELECT * FROM mod_drivers where id='$id'";
			if(!$result = $db->select($get_drivers_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit drivers
	function edit_drivers($id){
	global $db;
		$edit_drivers_sql = "UPDATE mod_drivers SET first_name='".
        mysql_real_escape_string($_POST['first_name'])."', last_name='".
        mysql_real_escape_string($_POST['last_name'])."', email='".
        mysql_real_escape_string($_POST['email'])."', cellphone='".
        mysql_real_escape_string($_POST['cellphone'])."', telephone='".
        mysql_real_escape_string($_POST['telephone'])."', cellphoneprovider='".
        mysql_real_escape_string($_POST['cellphoneprovider'])."', address='".
        mysql_real_escape_string($_POST['address'])."', address2='".
        mysql_real_escape_string($_POST['address2'])."', city='".
        mysql_real_escape_string($_POST['city'])."', state='".
        mysql_real_escape_string($_POST['state'])."', zip='".
        mysql_real_escape_string($_POST['zip'])."', ssn='".
        mysql_real_escape_string($_POST['ssn'])."', dl='".
        mysql_real_escape_string($_POST['dl'])."', per_transfer_wage='".
        mysql_real_escape_string($_POST['per_transfer_wage'])."', daily_wage='".
        mysql_real_escape_string($_POST['daily_wage'])."', employment_date='".format_date_calendar($_POST['employment_date'])."', status='".$_POST['status']."' where id='$id'";
		
		//echo "I am here! SQL IS: " . $edit_drivers_sql ; exit;
		
		if(!$result = $db->insert_sql($edit_drivers_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	
	// Add a new driver
	function add_drivers(){
	global $db; 
		
	//$date_submitted = date('Y-m-d');	
		$add_drivers_sql = "INSERT INTO mod_drivers (first_name, last_name, email, cellphone, cellphoneprovider, telephone, address, address2, city, state, zip, ssn, dl, per_transfer_wage, daily_wage, employment_date, status) values('".
        mysql_real_escape_string($_POST['first_name'])."', '".
        mysql_real_escape_string($_POST['last_name'])."', '".
        mysql_real_escape_string($_POST['email'])."', '".
        mysql_real_escape_string($_POST['cellphone'])."', '".
        mysql_real_escape_string($_POST['cellphoneprovider'])."', '".
        mysql_real_escape_string($_POST['telephone'])."', '".
        mysql_real_escape_string($_POST['address'])."', '".
        mysql_real_escape_string($_POST['address2'])."', '".
        mysql_real_escape_string($_POST['city'])."', '".
        mysql_real_escape_string($_POST['state'])."', '".
        mysql_real_escape_string($_POST['zip'])."', '".
        mysql_real_escape_string($_POST['ssn'])."', '".
        mysql_real_escape_string($_POST['dl'])."', '".
        mysql_real_escape_string($_POST['per_transfer_wage'])."', '".
        mysql_real_escape_string($_POST['daily_wage'])."', '".format_date_calendar($_POST['employment_date'])."', '".$_POST['status']."')";
		
		//print_r($add_drivers_sql);
		//exit;
		
		if(!$result = $db->insert_sql($add_drivers_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
		//print_r "$add_drivers_sql";
			return true;
		}	
	}

	// Delete Selected driver
	function delete_drivers($id){
	global $db;
	$count =0;
		while($count < count($id)){
		
			$delete_drivers_sql = "Delete from mod_drivers where id='".$id[$count]."'";
			if(!$db->select($delete_drivers_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	//Submit Driver for Reservation
	function submit_driv($res_details_id, $reservation_id, $drivers_id, $notify_driver, $client_name, $time, $date, $passenger_count, $from, $to, $pp, $cc, $cash){
		global $db;
			$drivers_id_new = $drivers_id;
			$email_result=$db->select("SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.cellphone, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs, r.payment_status FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE r.id='$reservation_id' AND rd.id='$res_details_id'");
			$message_info=$db->get_row($email_result);
			$driver = get_driver_view($drivers_id_new); 
						
			$airline=(!empty($message_info['airline']))?'Airline/FlightNumber: '.$message_info['airline'].'/'.$message_info['flight_number'].'<br />':'';
			$contact_number=(!empty($message_info['cellphone']))?'Contact Number: '.$message_info['cellphone'].'<br />':'';
			$message_sunstate_driver="The following reservation was assigned to you:<br /><br />Name: ".$client_name."<br />";
			
				$query=$db->select("select * from reservation_details where reservation_id=".$message_info['reservation_id']." and id<>".$message_info['id']);
				$message_info2=$db->get_row($query);
				$from1=get_locations_view($message_info2['from']);
				$to1=get_locations_view($message_info2['to']);
			
				$message_sunstate_driver.="Date: ".$date."<br />
				Time: ".$time."<br />
				From: ".$from."<br />
				To: ".$to."<br />";
			
			$message_sunstate_driver.="PAX: ".$passenger_count."<br />$airline $contact_number";
			
			if (!empty($cc)) {
			$message_sunstate_driver .="CC: $".number_format($cc, 2, '.', '')."<br />";
			$message_sunstate_driver .="PP: Yes";
			}
			if (!empty($cash)) {
			$message_sunstate_driver .="CASH: $".number_format($cash, 2, '.', '')."<br />";
			$message_sunstate_driver .="PP: ".$pp;
			}
			
			
			if($message_info['trip_type']==2)
			{
				$message_sunstate_driver.="<hr/><br/><u>Additional Transfer Information</u><br/>";
				$message_sunstate_driver.="Return Date: ".format_to_caldate($message_info2['date'])."<br />
				Return Time: ".format_time($message_info2['time'])."<br />
				Return From: ".$from1['name']."<br />
				Return To: ".$to1['name']."<br />";
			}
						
			$company_info = get_company_info();
			
			$from_email = $company_info['email'];
			$from_email = trim(str_replace(" ", "", $from_email));
			//This is a modification to make windows forms work
			ini_set("sendmail_from", $from_email);
			
			$to_email = $driver['email'];
			
			$headers = 'From: '. $from_email . "\r\n" .
    		'Reply-To: '. $from_email . "\r\n" .
			'Bcc: '. $from_email . "\r\n" .
			"MIME-Version: 1.0\r\n" .
			"Content-type: text/html; charset=iso-8859-1\r\n".
    		'X-Mailer: PHP/' . phpversion();
			
			mail($to_email, 'Reservation was assigned to you', $message_sunstate_driver, $headers);
			return true;
		}
		
		
	function submit_driver($res_details_id, $reservation_id, $drivers_id, $notify_driver, $client_name, $time, $date, $passenger_count, $from, $to, $pp, $cash, $cc){
		global $db;
		
		$drivers_id_new = $drivers_id;
	
			//echo $res_details_id." ".$reservation_id." ".$drivers_id." ".$notify_driver;$_GET['resDetailsId'], $_GET['resId'], $_GET['driversId'], $_GET['notify_driver']
		$update_driver_in_reservation_details_sql = "UPDATE reservation_details SET drivers_id='$drivers_id', notify_driver='$notify_driver' WHERE reservation_id='$reservation_id' AND id='$res_details_id'";
		//echo "SQL is: ".$update_driver_in_reservation_details_sql;
		//exit;
		if(!$result = $db->insert_sql($update_driver_in_reservation_details_sql)){
			$_SESSION['notice'] = $db->last_error;
			//echo "here wrong" . $_SESSION['notice']; exit; 
			return false;	
		}
		else{
		
			if ($notify_driver=='yes') {
			$email_result=$db->select("SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.cellphone, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs, r.payment_status FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE r.id='$reservation_id' AND rd.id='$res_details_id' ORDER BY r.id ASC");
			$message_info=$db->get_row($email_result);
			$driver = get_driver_view($drivers_id_new); 
			
			$airline=(!empty($message_info['airline']))?'Airline/FlightNumber: '.$message_info['airline'].'/'.$message_info['flight_number'].'<br />':'';
			$contact_number=(!empty($message_info['cellphone']))?'Contact Number: '.$message_info['cellphone'].'<br />':'';
			$message_sunstate_driver="The following reservation was assigned to you:<br /><br />";
			$message_sunstate_driver.="Driver: ".$driver['first_name'].' '.$driver['last_name'].'<br /><br />';
			$message_sunstate_driver.="Name: ".$client_name."<br />";
			
			$query=$db->select("select passenger_count,vehicle_id from reservations where id=".$message_info['reservation_id']);
			$reservation=$db->get_row($query);
			$vehicle=get_vehicles_view($reservation['vehicle_id']);
			$message_sunstate_driver.'Passengers: '.$reservation['passenger_count'].'<br />
			Vehcile Type: '.$vehicle['name'].'<br />';
			if($message_info['trip_type']==2)
			{
				$query=$db->select("select * FROM reservation_details where reservation_id=".$message_info['reservation_id'].' ORDER BY date ASC');
				while($row=$db->get_row($query))
				{$res_details[]=$row;}
				$count=1;
				foreach($res_details as $value)
				{
					
					if(strtotime($date)<=strtotime($value['date']))
					{
						$from_loc=get_locations_view($value['from']);
						$to_loc=get_locations_view($value['to']);
						
						$message_sunstate_driver.="<br />Transfer ".$count.'<br />
						Passengers: ' . $reservation['passenger_count'] . '<br />
						Vehicle Type: ' . $vehicle['name'] . '<br />
						Date: '.format_to_caldate($value['date']).'<br />
						Time: '.format_time($value['pickup_time']).'<br />
						From : '.$from_loc['name'].'<br />
						To : '.$to_loc['name'].'<br /><br />
						Customer Comments: ' . $message_info['customer_comments'] . '<br />
						Quick Grocery Stop: ' . $message_info['store_stop'] . '<br />
						Child Car Seat: ' . $message_info['child_carseat'] . '<br />
						Child Booster Seat: ' . $message_info['booster_seat'] . '<br />';
						$count++;
					}						
				}

				/*$query=$db->select("select * from reservation_details where reservation_id=".$message_info['reservation_id']." and id<>".$message_info['id']);
				$message_info2=$db->get_row($query);
								
				$from1=get_locations_view($message_info2['from']);
				$to1=get_locations_view($message_info2['to']);
			
				$message_sunstate_driver.="Passengers: ".$reservation['passenger_count']."<br />
				Vehicle Type: ".$vehicle['name']."<br />
				Date: ".format_to_caldate($message_info2['date'])."<br />
				Time: ".format_time($message_info2['time'])."<br />
				From: ".$from1['name']."<br />
				To: ".$to1['name']."<br />";
				
				$message_sunstate_driver.="<hr/><br/><u>Additional Transfer Information</u><br/>";
				$message_sunstate_driver.="Return Date: ".$date."<br />
				Return Time: ".$time."<br />
				Return From: ".$from."<br />
				Return To: ".$to."<br />";
				*/
			}
			else
			{
				$message_sunstate_driver.="Passengers: ".$reservation['passenger_count']."<br />
				Vehicle Type: ".$vehicle['name']."<br />
				Date: ".$date."<br />
				Time: ".$time."<br />
				From: ".$from."<br />
				To: ".$to."<br /><br />
						Customer Comments: " . $message_info['customer_comments'] . "<br />
						Quick Grocery Stop: " . $message_info['store_stop'] . "<br />
						Child Car Seat: " . $message_info['child_carseat'] . "<br />
						Child Booster Seat: " . $message_info['booster_seat'] . "<br />";
			}
			if (!empty($cc)) {
			$message_sunstate_driver .="<br />Credit Card: $".number_format($cc, 2, '.', '')."<br />";
			$message_sunstate_driver .="PP: Yes<br />";
			}
			if (!empty($cash)) {
			$message_sunstate_driver .="<br />Cash: $".number_format($cash, 2, '.', '')."<br />";
			$message_sunstate_driver .="PP: ".$pp.'<br />';
			}
			
			
			if(!empty($airline)) {
			$message_sunstate_driver .=$airline;
			}
			if(!empty($contact_number)) {
			$message_sunstate_driver .=$contact_number;
			}
			
			
			$company_info = get_company_info();
			
			$from_email = $company_info['email'];
			$from_email = trim(str_replace(" ", "", $from_email));
			//This is a modification to make windows forms work
			ini_set("sendmail_from", $from_email);

			//ATTENTION: Please set the to email address that the content of this form will be sent to
			//Uncomment the below if you have created a hidden value named sendto in the form. Otherwise set the to email address manually by changing the $to variable
			//$to = $_POST['sendto'];
	
			
			$email_by_cell = get_email_by_cell_phone($driver['cellphoneprovider'], str_replace(" ", "", str_replace("-", "", $driver['cellphone'])));
			
			if (!empty($email_by_cell)) {
			$to2 = $email_by_cell;
			
			$message_sunstate_driver_mobile .="The following reservation was assigned to you: Date: ".$date."; Time: ".$time."; Name: ".$client_name."; From: ".$from."; To: ".$to."; PAX: ".$passenger_count."; ";
			if (!empty($cc)) {
			$message_sunstate_driver_mobile .="CC: $".number_format($cc, 2, '.', '')."; ";
			}
			if (!empty($cash)) {
			$message_sunstate_driver_mobile .="CASH: $".number_format($cash, 2, '.', '')."; ";
			}
			$message_sunstate_driver_mobile .="PP: ".$pp.$airline.$contact_number;
			
			$headers2 = 'From: '.$from_email.'' . "\r\n" .
    		'Reply-To: '.$from_email.'' . "\r\n" .
    		'X-Mailer: PHP/' . phpversion();
			
			
			mail($to2, 'Reservation was assigned to you', $message_sunstate_driver_mobile, $headers2);
			}
			
			$to_email = $driver['email'];
			
			$headers = 'From: '. $from_email . "\r\n" .
    		'Reply-To: '. $from_email . "\r\n" .
			'Bcc: '. $from_email . "\r\n" .
			"MIME-Version: 1.0\r\n" .
			"Content-type: text/html; charset=iso-8859-1\r\n".
    		'X-Mailer: PHP/' . phpversion();
	
			mail($to_email, 'Reservation was assigned to you', $message_sunstate_driver, $headers);

			}
		
			//echo "here right"; exit;
			return true;
		}
	}
	
	function get_email_by_cell_phone($provider, $cellphone){
		if ($provider=='Metro PCS') {
		$drivers_email = $cellphone.'@mymetropcs.com';
		}
		
		if ($provider=='Verizon') {
		$drivers_email = $cellphone.'@vtext.com';
		}
		
		if ($provider=='Tmobile') {
		$drivers_email = $cellphone.'@tmomail.net';
		}
		
		if ($provider=='Sprint') {
		$drivers_email = $cellphone.'@messaging.sprintpcs.com';
		}
		
		if ($provider=='ATT') {
		$drivers_email = $cellphone.'@txt.att.net';
		}		
		
		if ($provider=='Boost Mobile') {
		$drivers_email = $cellphone.'@myboostmobile.com';
		}
	
		return $drivers_email;
	
	}
	
		//Get reservation info for driver
		function get_driver_from_reservation($drivers_id, $from, $to){
			global $db;
			$get_driver_reservation_details_sql = "SELECT * FROM reservations, reservation_details WHERE reservation_details.drivers_id='$drivers_id' AND reservations.id=reservation_details.reservation_id AND date BETWEEN '$from' AND '$to' ORDER BY reservation_details.pickup_time ASC";
			//echo "SQL is: ".$get_driver_reservation_details_sql; exit;
			if(!$result = $db->select($get_driver_reservation_details_sql)){
			$_SESSION['notice'] = $db->last_error;
			//echo "here wrong" . $_SESSION['notice']; exit;
				return false;
			}
		
			else{
			//echo "here right"; exit;
				while($data=$db->get_row($result, 'MYSQL_ASSOC')){
					$all_details[] = $data;
				}	
				return $all_details;
			}
		}
		
		
		
		function get_driver_from_reservation_by_iws($drivers_id, $from, $to){
			global $db;
			$get_driver_reservation_details_sql = "SELECT * FROM reservations, reservation_details WHERE reservation_details.drivers_id='$drivers_id' AND reservations.id=reservation_details.reservation_id AND date BETWEEN '$from' AND '$to' GROUP BY reservation_details.pickup_date ASC";
			//echo "SQL is: ".$get_driver_reservation_details_sql; exit;
			if(!$result = $db->select($get_driver_reservation_details_sql)){
			$_SESSION['notice'] = $db->last_error;
			//echo "here wrong" . $_SESSION['notice']; exit;
				return false;
			}
		
			else{
			//echo "here right"; exit;
				while($data=$db->get_row($result, 'MYSQL_ASSOC')){
					$all_details[] = $data;
				}	
				return $all_details;
			}
		}
		
		
		function count_number_of_trips($drivers_id, $from, $to){
			global $db;
			$count_number_of_trips_sql = "SELECT COUNT(*) FROM reservations, reservation_details WHERE reservation_details.drivers_id='$drivers_id' AND reservations.id=reservation_details.reservation_id AND date BETWEEN '$from' AND '$to' ORDER BY reservation_details.id ASC";
			//echo "SQL is: ".$count_number_of_trips_sql; exit;
			if(!$result = $db->select($count_number_of_trips_sql)){
			$_SESSION['notice'] = $db->last_error;
			//echo "here wrong" . $_SESSION['notice']; exit;
				return false;
			}
		
			else{
			//echo "here right"; exit;
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data['COUNT(*)'];
			}
		}
		
		//Get the drives_id from the reservation_details table
		function get_drivers_id($res_details_id){
			//echo "here ".$res_details_id;
			global $db;
			$get_drivers_id_sql = "SELECT drivers_id, notify_driver FROM reservation_details WHERE id='$res_details_id'";
			//echo " SQL is: ".$get_drivers_id_sql; exit;
			if(!$result = $db->select($get_drivers_id_sql)){
			$_SESSION['notice'] = $db->last_error;
			//echo "here wrong" . $_SESSION['notice']; exit;
				return false;
			}
		
			else{
			//echo "here right"; exit;
				while($data=$db->get_row($result, 'MYSQL_ASSOC')){
					$drivers_id[] = $data;
				}
				//print_r($drivers_id); exit;
				return $drivers_id;
			}
		}
		
		//Get the client_name from the clients table
		function get_client_name($client_id){
			global $db;
			$get_client_name_sql = "SELECT first_name, last_name FROM clients WHERE id='$client_id'";
			//echo "SQL is: ".$get_client_name_sql; exit;
			if(!$result = $db->select($get_client_name_sql)){
			$_SESSION['notice'] = $db->last_error;
			//echo "here wrong" . $_SESSION['notice']; exit;
				return false;
			}
		
			else{
			//echo "here right"; exit;
				while($data=$db->get_row($result, 'MYSQL_ASSOC')){
					$all_details[] = $data;
				}	
				return $all_details['drivers_id'];
			}
		}
		
		function get_first_leg($reservation_id){
			global $db;
			$get_reservations_sql = "SELECT id, reservation_id FROM reservation_details WHERE reservation_id='$reservation_id' ORDER BY id ASC";
			//echo "SQL is: ".$get_reservations_sql; exit;
			if(!$result = $db->select($get_reservations_sql)){
			$_SESSION['notice'] = $db->last_error;
			//echo "here wrong" . $_SESSION['notice']; exit;
				return false;
			}
		
			else{
			//echo "here right"; exit;
				while($data=$db->get_row($result, 'MYSQL_ASSOC')){
					$all_details[] = $data;
				}
				return $all_details[0]['id'];
			}
		}
		
		
			function compare($all_trips){
			$count=0; $num_runs=0;
				if($all_trips[$count]['pickup_date'] == $all_trips[$count+1]['pickup_date']){
					$num_runs++;
					$count++;
					echo $num_runs;
				}
				else{
					if($num_runs==0)
						$num_runs=1;
					echo $num_runs;
					$all_trips[$count]['[pickup_date'];
					$count++;
					$num_runs=0;
					}
			}
		
		
	
?>