<?php
	//Get ALL Reservations
	function get_all_reservations(){
		global $db;
			$get_all_reservations_sql = "SELECT * FROM reservations ORDER BY id DESC";
			if(!$result = $db->select($get_all_reservations_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_reservations[] = $data;
				return $all_reservations;
			}
	}
	
	//Get Arrival Data
	function get_arrival_data($reservation_id){
		global $db;
			$get_arrival_data_sql = "SELECT * FROM reservation_details WHERE reservation_id='$reservation_id' ORDER BY date ASC LIMIT 1";
			
			if(!$result = $db->select($get_arrival_data_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$arrival_data = $data;
					
					if (!check_departure_new($arrival_data['from'], $arrival_data['to'])) {
					return $arrival_data;
					}
			}
	}
	
	
	//Get Arrival Data
	function get_arrival_data_new($reservation_id){
		global $db;
			$get_arrival_data_new_sql = "SELECT * FROM reservation_details WHERE reservation_id='$reservation_id' ORDER BY id ASC LIMIT 1";
			
			if(!$result = $db->select($get_arrival_data_new_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$arrival_data = $data;
					// Function at General Functions
					if (check_arrivals_new($arrival_data['from'], $arrival_data['to'])) 
					{
						return $arrival_data;
					}
			}
	}
	
	//Get Destination Data
	function get_destination_data($reservation_id){
		global $db;
			$get_destination_data_sql = "SELECT * FROM reservation_details WHERE reservation_id='$reservation_id' ORDER BY id ASC";

			if(!$result = $db->select($get_destination_data_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$arrival_data[] = $data;
				return $arrival_data;
			}
	}
	
	//Get Departure Data
	function get_departure_data($reservation_id){
		global $db;
			$get_departure_data_sql = "SELECT * FROM reservation_details WHERE reservation_id='$reservation_id' ORDER BY date DESC LIMIT 1";
			if(!$result = $db->select($get_departure_data_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$departure_data = $data;
					if (check_departure_new($departure_data['from'], $departure_data['to'])) {
					return $departure_data;
					}
			}
	}
	
	//Get Transfer Data
	function get_transfer_data_new($reservation_id){
		global $db;
			$get_transfer_data_new_sql = "SELECT * FROM reservation_details WHERE reservation_id='$reservation_id' ORDER BY date DESC LIMIT 1";
			if(!$result = $db->select($get_transfer_data_new_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$transfer_data = $data;
					
					return $transfer_data;
					
			}
	}
	
	//Get Reservations for Reports
	function get_reservations_reports($from, $to){
		global $db;
			$get_reservations_reports_sql = "SELECT * FROM reservations WHERE reservation_date BETWEEN '$from' AND '$to' ORDER BY id DESC";
			if(!$result = $db->select($get_reservations_reports_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_reservations[] = $data;
				return $all_reservations;
			}
	}
	
	//Get Reservations for Reports
	function get_reservations_reports_for_stats($from, $to){
		global $db;
			$get_reservations_reports_sql = "SELECT * FROM reservations WHERE status!='11' AND reservation_date BETWEEN '$from' AND '$to' ORDER BY id DESC";
			if(!$result = $db->select($get_reservations_reports_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_reservations[] = $data;
				return $all_reservations;
			}
	}
	
	function get_all_reservations_for_email(){
		global $db;
			//$get_all_reservations_for_email_sql = "SELECT distinct r.id, r.email, r.first_name, r.last_name, rd.time, rd.date FROM reservations r INNER JOIN reservation_details rd ON r.id=rd.reservation_id WHERE r.status !='11' or r.status !='7' ORDER BY r.id DESC";
			
			
			// Select where status != Credit card verification error OR Cancelled 	
			$get_all_reservations_for_email_sql = "SELECT distinct r.id, r.email, r.first_name, r.last_name, r.status FROM reservations r INNER JOIN reservation_details rd ON r.id=rd.reservation_id WHERE r.status !='11' AND r.status !='7' ORDER BY r.id DESC";
			
			//print_r($get_all_reservations_for_email_sql);
			//exit;
			if(!$result = $db->select($get_all_reservations_for_email_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_reservations_email[] = $data;
				return $all_reservations_email;
			}
	}
	
	
	// Get all reservations for Status Update
	function get_all_reservations_for_statuses(){
		global $db;
			
			// Select where status != Credit card verification error OR Cancelled 	
			$get_all_reservations_for_statuses_sql = "SELECT distinct r.id, r.email, r.first_name, r.last_name, r.status FROM reservations r INNER JOIN reservation_details rd ON r.id=rd.reservation_id WHERE r.status !='11' AND r.status !='7' ORDER BY r.id DESC";
			
			//print_r($get_all_reservations_for_statuses_sql);
			//exit;
			if(!$result = $db->select($get_all_reservations_for_statuses_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$reservation_info[] = $data;
				return $reservation_info;
			}
	}
	
	function get_all_reservations_for_status_update()
	{	global $db;
		$sql="SELECT r,id FROM reservations r INNER JOIN reservation_details rd ON r.id=rd.reservation_id WHERE r.status!='11' AND r.status!='7' AND rd.date=CURDATE()";
		$res=$db->select($sql);
		if(!$res)
		{return false;}
		$data=array();
		while($data=$db->get_row($res,'MYSQL_ASSOC'))
		{$data[]=$row;}
		return $data;
	}
	function get_all_reservations_for_payment(){
		global $db;
		$company_info = get_company_info();
		$before = $company_info['minimum_time'];
		$time = strtotime('+'.$before.' days');
		$payment_date = date("Y-m-d");
		$arrival_date = date("Y-m-d", $time);
			// Get reservations where date between 2 days before arrival and arrival date. Script going to run every day
			$get_all_reservations_for_payment_sql = "SELECT distinct r.id, r.email, r.first_name, r.last_name, r.status, r.paying_cash, r.trip_type, r.card_number, r.reservation_date, r.total_amount, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.exp_date FROM reservations r INNER JOIN reservation_details rd ON r.id=rd.reservation_id WHERE r.status !='11' AND (rd.date BETWEEN '$payment_date' AND '$arrival_date') AND r.paying_cash !='Yes' AND (r.payment_status !='Approved') ORDER BY id DESC";
			
			//Test Query to run current reservation 
			//$get_all_reservations_for_payment_sql = "SELECT distinct r.id, r.email, r.first_name, r.last_name, r.status, r.paying_cash, r.trip_type, r.card_number, r.reservation_date, r.total_amount, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.exp_date FROM reservations r INNER JOIN reservation_details rd ON r.id=rd.reservation_id WHERE r.id='1353'";
			//print_r($get_all_reservations_for_payment_sql);
			//exit;
			if(!$result = $db->select($get_all_reservations_for_payment_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_reservations_payment[] = $data;
				return $all_reservations_payment;
			}
	}
	
	
	function get_all_reservations_for_single_payment($id){
		global $db;
		$company_info = get_company_info();
		$before = $company_info['minimum_time'];
		$time = strtotime('+'.$before.' days');
		$payment_date = date("Y-m-d");
		$arrival_date = date("Y-m-d", $time);
			// Get reservations where date between 2 days before arrival and arrival date. Script going to run every day
			$get_all_reservations_for_payment_sql = "SELECT distinct r.id, r.email, r.first_name, r.last_name, r.status, r.paying_cash, r.trip_type, r.card_number, r.reservation_date, r.total_amount, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.exp_date FROM reservations r INNER JOIN reservation_details rd ON r.id=rd.reservation_id WHERE r.id='$id' AND r.status !='11' AND r.paying_cash !='Yes' AND (r.payment_status !='Approved') ORDER BY id DESC";
			
			//print_r($get_all_reservations_for_payment_sql);
			//exit;
			//Test Query to run current reservation 
			//$get_all_reservations_for_payment_sql = "SELECT distinct r.id, r.email, r.first_name, r.last_name, r.status, r.paying_cash, r.trip_type, r.card_number, r.reservation_date, r.total_amount, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.exp_date FROM reservations r INNER JOIN reservation_details rd ON r.id=rd.reservation_id WHERE r.id='1353'";
			//print_r($get_all_reservations_for_payment_sql);
			//exit;
			if(!$result = $db->select($get_all_reservations_for_payment_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_reservations_payment[] = $data;
				return $all_reservations_payment;
			}
	}
	
	// Update Reservation Status
	function update_reservation_status($id, $status, $approval_code_new){
	global $db;
	$payment_date = date("Y-m-d G:i:s");
		$update_reservation_status_sql = "UPDATE reservations SET payment_status='$status', payment_date='$payment_date', approval_code='$approval_code_new' where id='$id'";

		if(!$result = $db->insert_sql($update_reservation_status_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	// Get current Reservation
	function count_clients_reservations($client_id){
		global $db;
			$get_clients_reservations_sql = "SELECT * FROM reservations WHERE client_id='$client_id' ORDER BY id DESC";
			if(!$result = $db->select($get_clients_reservations_sql)){
				echo $_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$count_clients_reservations[] = $data;
				return $count_clients_reservations;
			}
	}
	
	// Get Clients Reservation
	function get_clients_reservations($client_id){
		global $db;
			$get_clients_reservations_sql = "SELECT * FROM reservations where client_id='$client_id'";
			if(!$result = $db->select($get_clients_reservations_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit Reservation
	function edit_reservations($id, $client_id){
	global $db;
	$exp_date = $_POST['ExpMonth']."/".$_POST['ExpYear'];
	if (!empty($_POST['payment_status']) && $_POST['payment_status'] != $_POST['payment_status_old']) {
	$payment_date = date("Y-m-d G:i:s");
	} else {
	$payment_date = $_POST['payment_date_old'];
	};
	
	if (empty($client_id)) {
	$client_id = $_POST['client_id'];
	};
		$edit_reservations_sql = "UPDATE reservations SET client_id='".$client_id."', vehicle_id='".$_POST['vehicle_id']."', passenger_count='".$_POST['passenger_count']."', child_carseat='".$_POST['child_carseat']."', booster_seat='".$_POST['child_boosterseat']."', trip_type='".$_POST['trip_type']."', first_name='".$_POST['first_name']."', last_name='".$_POST['last_name']."', address='".$_POST['address']."', address2='".$_POST['address2']."', city='".$_POST['town']."', state='".$_POST['state']."', zip='".$_POST['zip']."', country='".$_POST['country']."', email='".$_POST['email']."', phone_number='".$_POST['phone_number']."', cellphone='".$_POST['cellphone']."', first_name_billing='".$_POST['first_name_billing']."',
		last_name_billing='".$_POST['last_name_billing']."', city_billing='".$_POST['city_billing']."', state_billing='".$_POST['state_billing']."', zip_billing='".$_POST['zip_billing']."', country_billing='".$_POST['country_billing']."', card_number='".$_POST['card_number']."', card_type='".$_POST['card_type']."', exp_date='".$exp_date."', status='".$_POST['status']."', customer_comments='".$_POST['customer_comments']."', admin_comments='".$_POST['admin_comments']."', paying_cash='".$_POST['paying_cash']."', store_stop='".$_POST['store_stop']."', total_amount='".$_POST['total_amount']."', payment_status='".$_POST['payment_status']."', payment_date='$payment_date', approval_code='".$_POST['approval_code']."' where id='$id'";

		if(!$result = $db->insert_sql($edit_reservations_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
		//Delete old reservation details BEGIN
		$delete_reservation_details_sql = "Delete from reservation_details where reservation_id='$id'";
			if(!$db->select($delete_reservation_details_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				exit;
			}
		//Delete old reservation details END
		
		$num_legs = $_SESSION['num_legs'];
			  
		//$num_legs = count($reservation_details);
		for ($count =0; $count <= $num_legs; $count++) {
		
		
		if (!empty($_POST['from'.$count.'']) && !empty($_POST['to'.$count.''])) {
		
		
		
		if ($_POST['ampm'.$count.''] == 'PM') {
			if ($_POST['h'.$count.''] == '12') {
			$hours[$count] = $_POST['h'.$count.''];
			} else {
			$hours[$count] = $_POST['h'.$count.''] + 12;
			}
		} else {
			if ($_POST['h'.$count.''] == '12') {
			$hours[$count] = ($_POST['h'.$count.''] - 12)*(-1);
			} else {
			$hours[$count] = $_POST['h'.$count.''];
			}
		}
		
		
		
		$time[$count] = $hours[$count].":".$_POST['m'.$count.''];
		$date[$count] = format_date($_POST['date'.$count.'']);
		
		//Pick up time calculation BEGIN
		$time_admin[$count] = format_time_admin_mysql($time[$count], $_POST['from'.$count.''], $_POST['to'.$count.''], $date[$count]);
		$date_admin[$count] = format_date_admin_mysql($time[$count], $_POST['from'.$count.''], $_POST['to'.$count.''], $date[$count]);
		//Pick up time calculation END
		
		
		
		$add_reservation_details_sql = "INSERT INTO reservation_details (`reservation_id`, `time`, `airline`, `flight_number`, `date`, `from`, `to`, `transfer_type`, `pickup_time`, `pickup_date`) VALUES ('".$id."', '".$time[$count]."', '".$_POST['airline'.$count.'']."', '".$_POST['flight_number'.$count.'']."', '".$date[$count]."', '".$_POST['from'.$count.'']."', '".$_POST['to'.$count.'']."', '', '".$time_admin[$count]."', '".$date_admin[$count]."')";
	
		
		if(!$result = $db->insert_sql($add_reservation_details_sql)){
			echo $_SESSION['notice'] = $db->last_error;
			return false;			
		}
		
		}
		
		}
			return true;
		}	
	}
	
	
	
	// Add a new Reservation
	function add_reservations($client_id){
	global $db; 
	$exp_date = $_POST['ExpMonth']."/".$_POST['ExpYear'];
	
	$reservation_date = date('Y-m-d'); 
	$payment_date = date("Y-m-d G:i:s");
	
	//For Current Customers BEGIN
	if (empty($client_id)) {
	$client_id = $_POST['client_id'];
	}
	//For Current Customers END
	
		$add_reservations_sql = "INSERT INTO reservations (client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, booster_seat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, phone_number, cellphone, first_name_billing, last_name_billing, address_billing, address2_billing, city_billing, state_billing, zip_billing, country_billing, total_amount, card_number, card_type, exp_date, reservation_date, status, customer_comments, admin_comments, location1, location2, location3, pickup_at_extra, travel_date_extra, paying_cash, store_stop, payment_status, payment_date, approval_code) 
		
		values('".$client_id."', 
		'".$_POST['vehicle_id']."', 
		'".$_POST['from']."', 
		'".$_POST['to']."', 
		'".$travel_date."', 
		'".$_POST['passenger_count']."', 
		'".$_POST['child_carseat']."',
		'".$_POST['child_boosterseat']."', 
		'".$_POST['trip_type']."', 
		'".$pickup_at."', 
		'".$_POST['arriving_airline']."', 
		'".$_POST['flight_number']."', 
		'".$arriving_at."', 
		'".$travel_date_roundtrip."', 
		'".$pickup_at_roundtrip."', 
		'".$_POST['departing_airline_roundtrip']."',	
		'".$_POST['flight_number_roundtrip']."', 
		'".$departing_at."', 
		'".$_POST['first_name']."', 
		'".$_POST['last_name']."', 
		'".$_POST['address']."', 
		'".$_POST['address2']."', 
		'".$_POST['town']."', 
		'".$_POST['state']."', 
		'".$_POST['zip']."', 
		'".$_POST['country']."', 
		'".$_POST['email']."',
		'".$_POST['phone_number']."',
		'".$_POST['cellphone']."', 
		'".$_POST['first_name_billing']."', 
		'".$_POST['last_name_billing']."', 
		'".$_POST['address_billing']."',
		'".$_POST['address2_billing']."',
		'".$_POST['city_billing']."',
		'".$_POST['state_billing']."', 
		'".$_POST['zip_billing']."', 
		'".$_POST['country_billing']."', 
		'".$_POST['total_amount']."',
		'".$_POST['card_number']."', 
		'".$_POST['card_type']."', 
		'".$exp_date."', 
		'$reservation_date', 
		'".$_POST['status']."',
		'".$_POST['customer_comments']."', 
		'".$_POST['admin_comments']."', '".$location1."', '".$location2."', '".$location3."', '$pickup_at_extra', '$travel_date_extra', '".$_POST['paying_cash']."', '".$_POST['store_stop']."',  '".$_POST['payment_status']."', '$payment_date', '".$_POST['approval_code']."')";
		
		//print_r($add_reservations_sql);
		//exit;

		if(!$result = $db->insert_sql($add_reservations_sql)){
			$_SESSION['notice'] = $db->last_error;
			//exit;
			return false;			
		}
		else{
	    //$reservation_details = get_all_reservation_details($result);
		  
		$num_legs = $_SESSION['num_legs'];
		$res_id = $result;
		for ($count =1; $count <= $num_legs; $count += 1) {
		  	  //print_r($reservation_details[$count]['from']);
	
		if ($_POST['ampm'.$count.''] == 'PM') {
			if ($_POST['h'.$count.''] == '12') {
			$hours[$count] = $_POST['h'.$count.''];
			} else {
			$hours[$count] = $_POST['h'.$count.''] + 12;
			}
		} else {
			if ($_POST['h'.$count.''] == '12') {
			$hours[$count] = ($_POST['h'.$count.''] - 12)*(-1);
			} else {
			$hours[$count] = $_POST['h'.$count.''];
			}
		}
		$time[$count] = $hours[$count].":".$_POST['m'.$count.''];
		$date[$count] = format_date($_POST['date'.$count.'']);
		
		
		//Pick up time calculation BEGIN
		$time_admin[$count] = format_time_admin_mysql($time[$count], $_POST['from'.$count.''], $_POST['to'.$count.''], $date[$count]);
		$date_admin[$count] = format_date_admin_mysql($time[$count], $_POST['from'.$count.''], $_POST['to'.$count.''], $date[$count]);
		//Pick up time calculation END
		
		$add_reservation_details_sql = "INSERT INTO reservation_details (`reservation_id`, `time`, `airline`, `flight_number`, `date`, `from`, `to`, `transfer_type`, `pickup_time`, `pickup_date`) VALUES ('".$res_id."', '".$time[$count]."', '".$_POST['airline'.$count.'']."', '".$_POST['flight_number'.$count.'']."', '".$date[$count]."', '".$_POST['from'.$count.'']."', '".$_POST['to'.$count.'']."', '', '".$time_admin[$count]."', '".$date_admin[$count]."')";
		
		if(!$result = $db->insert_sql($add_reservation_details_sql)){
			echo $_SESSION['notice'] = $db->last_error;
			return false;			
		}
		}
			return true;
		}	
	}
	
	//Format date
	function format_date($date){
		$newdate = substr($date, 0,10);
		$date_array = explode("/", $newdate);
		$newdate = $date_array[2] . "-".$date_array[0]."-".$date_array[1];
		return $newdate;
	}
	
	//Format back to Calendar date
	function format_to_caldate($date){
		$newdate = substr($date, 0,10);
		$date_array = explode("-", $newdate);
		$newdate = $date_array[1] . "/".$date_array[2]."/".$date_array[0];
		return $newdate;
	}
	
	//Format back to Calendar date
	function format_to_caldate_time($date){
		$newdate = substr($date, 0,10);
		$date_array = explode("-", $newdate);
		$time_array = explode(" ", $date);
		$newdate = $date_array[1] . "/".$date_array[2]."/".$date_array[0]." ".$time_array[1];
		return $newdate;
	}
	
	// Update Status
	function update_status($status, $id){
	global $db;
		$update_status_sql = "UPDATE reservations SET status='$status' where id='$id'";
		
		if(!$result = $db->insert_sql($update_status_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	//Format Exp Date
	function format_exp_date($date){
		$newdate = substr($date, 0,10);
		$date_array = explode("/", $newdate);
		$newdate = $date_array;
		return $newdate;
	}
	
	// Delete Selected Reservations
	function delete_reservations($id){
	global $db;
	$count =0;
		while($count < count($id)){
			$delete_reservations_sql = "Delete from reservations where id='".$id[$count]."'";
			if(!$db->select($delete_reservations_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				exit;
			}
			$delete_reservation_details_sql = "Delete from reservation_details where reservation_id='".$id[$count]."'";
			if(!$db->select($delete_reservation_details_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	// Get Search Result with pages
	function get_all_reservations_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 25;
			} else {
			$display = $_GET['pages'];
			};
			
			// Search criteria BEGIN
			
			if ($_GET['search_by'] == 'shadesofgreen') {
			$search_by_sql = 'WHERE rd.from =517 OR rd.to =517';
			};
			
			
			if (empty($_GET['orderby'])) {
			$orderby_sql = " rs.id DESC";
			} else {
				if ($_GET['orderby'] == 'name') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " rs.first_name ASC";
					} else {
					$orderby_sql = " rs.first_name DESC";
					}
				}
				
				
				if ($_GET['orderby'] == 'id') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " rs.id ASC";
					} else {
					$orderby_sql = " rs.id DESC";
					}
				}
				
				if ($_GET['orderby'] == 'date') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " rs.reservation_date ASC";
					} else {
					$orderby_sql = " rs.reservation_date DESC";
					}
				}
				
				if ($_GET['orderby'] == 'vehicle_id') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " rs.vehicle_id ASC";
					} else {
					$orderby_sql = " rs.vehicle_id DESC";
					}
				}
				
				if ($_GET['orderby'] == 'arrival_date') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " rd.date ASC";
					} else {
					$orderby_sql = " rd.date DESC";
					}
				}
				
				if ($_GET['orderby'] == 'departure_date') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " rd.date ASC";
					} else {
					$orderby_sql = " rd.date DESC";
					}
				}
				
				if ($_GET['orderby'] == 'status') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " rs.status ASC";
					} else {
					$orderby_sql = " rs.status DESC";
					}
				}
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			
			$query = "SELECT distinct rs.id, rs.client_id, rs.vehicle_id, rs.passenger_count, rs.child_carseat, rs.booster_seat, rs.trip_type, rs.first_name, rs.last_name, rs.address, rs.address2, rs.city, rs.state, rs.zip, rs.country, rs.email, rs.first_name_billing, rs.last_name_billing, rs.address_billing, rs.address2_billing, rs.city_billing, rs.state_billing, rs.zip_billing, rs.country_billing, rs.total_amount, rs.status, rs.customer_comments, rs.admin_comments, rs.paying_cash, rs.store_stop, rs.ip_address, rs.reservation_date FROM reservations rs INNER JOIN reservation_details AS rd ON rs.id=rd.reservation_id  $search_by_sql ORDER BY $orderby_sql";
			
			//print_r($query);
			//exit;
			
			//$query = "SELECT id, client_id, vehicle_id, passenger_count, child_carseat, booster_seat, trip_type, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, address_billing, address2_billing, city_billing, state_billing, zip_billing, country_billing, total_amount, status, customer_comments, admin_comments, paying_cash, store_stop, ip_address, reservation_date FROM reservations $search_by_sql ORDER BY $orderby_sql";
						
			$query_result=mysql_query($query);
			$num_records=@mysql_num_rows($query_result);
			if ($num_records > $display) { // More then 1 page.
			$num_pages = ceil ($num_records/$display);
			} else {
			$num_pages = 1;
			}
			}

			// Determinate where in the database to start returning result.
			if (isset($_GET['s'])) { // Already been determinated.
			$start = $_GET['s'];	
			} else {
			$start = 0;
			}

			$query = "SELECT distinct rs.id, rs.client_id, rs.vehicle_id, rs.passenger_count, rs.child_carseat, rs.booster_seat, rs.trip_type, rs.first_name, rs.last_name, rs.address, rs.address2, rs.city, rs.state, rs.zip, rs.country, rs.email, rs.first_name_billing, rs.last_name_billing, rs.address_billing, rs.address2_billing, rs.city_billing, rs.state_billing, rs.zip_billing, rs.country_billing, rs.total_amount, rs.status, rs.customer_comments, rs.admin_comments, rs.paying_cash, rs.store_stop, rs.ip_address, rs.reservation_date FROM reservations rs INNER JOIN reservation_details AS rd ON rs.id=rd.reservation_id $search_by_sql ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query; exit;
			
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="search" action="reservation_manager.php?search_by_sql='.$_GET['search_by_sql'].'" method="get">';
				echo '<table width="100%" style="padding-top:10px;" class="bodytxt">';
				echo '<tr>';
				echo '<td style="padding-left:10px;" class="bodytxt" align="left">';
				echo 'Listings per page ';
            	echo '<select name="pages" class="bodytxt" onchange="this.form.submit();">';
				echo '<option value="'.$display.'">'.$display.'</option>';
            	echo '<option value="10">10</option>';
            	echo '<option value="25">25</option>';
            	echo '<option value="50">50</option>';
            	echo '<option value="75">75</option>';
            	echo '<option value="100">100</option>';
            	echo '</select>';
				echo '</td><td style="padding-left:10px;" class="bodytxt" align="right">';
				echo '<span style="margin-right:10px" class="bodytxt">';
				$current_page = ($start/$display) + 1;
				//If it's not the first page, make a`Previous button.
				if ($current_page != 1) {
				echo '&lt;&lt; <a href="reservation_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '&search_by_sql='.$_GET['search_by_sql'].'" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="reservation_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '&search_by_sql='.$_GET['search_by_sql'].'" class="bodytxt">' . $i . '</a>] ';
				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="reservation_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '&search_by_sql='.$_GET['search_by_sql'].'" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>RESERVATION MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php<?php if (!empty($_GET['search_by_sql'])) { echo '?search_by_sql='.$_GET['search_by_sql']; }; ?>">
		<input type="hidden" value="" name="action">
		<table width="1260" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
                      <td width="37" class="ot1" align="center"><input type="checkbox" name="checkall" onclick="checkedAll(document.displayfrm.id);"></td>
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_manager.php?orderby=id&sort=desc" class="link2">ID</a>
					  <?php } else { ?>
                      <a href="reservation_manager.php?orderby=id&sort=asc" class="link2">ID</a>
					  <?php } ?>                      </td>
                      <td width="140" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_manager.php?orderby=name&sort=desc" class="link2">Client</a>
					  <?php } else { ?>
                      <a href="reservation_manager.php?orderby=name&sort=asc" class="link2">Client</a>
					  <?php } ?>                      </td>
                      <td width="70" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1"><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_manager.php?orderby=vehicle_id&sort=asc" class="link2">Car Type<?php } else { ?>
                      <a href="reservation_manager.php?orderby=vehicle_id&sort=desc" class="link2">Car Type</a>
					  <?php } ?></td>
                      <td width="180" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">From/To</td>
                      <td width="90" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      Arrival<br />Date                      </td>
                      <td width="80" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Arrival<br />Time</td>
                      <td width="110" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Departure<br />Date                      </td>
                      <td width="100" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Departure<br />Time</td>
                      <td width="100" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Pick up<br />Time</td>
                      <td width="110" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_manager.php?orderby=date&sort=asc" class="link2">Date submitted</a>
					  <?php } else { ?>
                      <a href="reservation_manager.php?orderby=date&sort=desc" class="link2">Date submitted</a>
					  <?php } ?>                      </td>
                      <td width="50" colspan="2" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Price                      </td>
                      <td width="70" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                  </tr>
                  <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
            		echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="37" height="22" align="center" class="ot1"><input name="id[]" id="id" type="checkbox" value="<?php echo $value['id']; ?>"></td>
                      <td width="40" height="22" align="left" class="ot1"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['id']; ?></strong></a></td>
                      <td width="140" height="22" align="left" class="ot1"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?></strong></a></td>
                      <td width="70" height="22" align="center" class="ot1">
                      <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>                      </td>
                      <td width="180" align="left" class="ot1">
                      <?php $destination = get_destination_data($value['id']);
					  
					  $num_legs = count($destination);
					  $from = get_locations_view($destination[0]['from']);
					  echo $from['name'];
		  	  		  for ($count =0; $count <= $num_legs - 1; $count += 1) {
					  $to[$count] = get_locations_view($destination[$count]['to']);
					  echo "->";
					  echo $to[$count]['name'];
					  };
					  
					  ?>                     </td>
                     <td width="100" align="center" class="ot1">
					 <?php
					 $arrival_data=get_arrival_data($value['id']); 
					 if (!empty($arrival_data['date'])) {
					  echo format_to_caldate($arrival_data['date']);
					 }
					 ?>					 </td>
                      <td width="80" align="center" class="ot1"><?php
					  $arrival_data=get_arrival_data($value['id']);
					  if (!empty($arrival_data['time'])) {
					  echo " ".format_time($arrival_data['time']);
					  }
					  ?></td>
                      <td width="110" align="center" class="ot1"><?php 
					  $departure_data=get_departure_data($value['id']); 
					  if (!empty($departure_data['date'])) {
					  echo format_to_caldate($departure_data['date']); 
					  }
					  ?></td>
                      <td width="90" align="center" class="ot1"><?php 
					  $departure_data=get_departure_data($value['id']); 
					  if (!empty($departure_data['time'])) {
					  echo " ".format_time($departure_data['time']); 
					  }
					  ?></td>
                      <td width="90" align="center" class="ot1"><?php
					  if (!empty($arrival_data)) {
					  echo format_time_admin($arrival_data['time'], $arrival_data['from'], $arrival_data['to'], $arrival_data['date']);
					  } else {
					  $pickup_time = explode (" ", format_time_admin($departure_data['time'], $departure_data['from'], $departure_data['to'], $departure_data['date']));
					  echo $pickup_time = $pickup_time[0].' '.$pickup_time[1].'<br>'.$pickup_time[2];
					  }
					  ?></td>
                     <td width="110" align="center" class="ot1"><?php echo format_to_caldate($value['reservation_date']); ?></td>
                      <td width="50" colspan="2" align="center" class="ot1"><?php if (!empty($value['total_amount'])) { echo "<strong><i>$".$value['total_amount']."</i></strong>"; }; ?></td>
                      <td width="70" height="22" align="center"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a>&nbsp;&nbsp;<a href="customers_invoice.php?id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Resend confirmation email"><img src="images/mail.png" border="0" onclick="return confirm('Are you sure you want to resend confirmation email?')" /></a>&nbsp;&nbsp;<a href="../print_reservation_admin.php?id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Print" target="_blank"><img src="images/printmgr.png" border="0" /></a>&nbsp;&nbsp;<a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this reservation?\n\nNotice: deleted reservation cannot be restored')" /></a></td>
                    </tr>
                    <? 
					} 
					?>
                  </table>  
                 <input name="delete_selected" type="submit" value="Delete selected"> 
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>RESERVATION MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">ID
                      </td>
                      <td width="110" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Client
                      </td>
                      <td width="293" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Transportation Info</td>
                      <td width="110" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Date submitted
                      </td>
                      <td width="55" colspan="2" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Status
                      </td>
                      <td width="70" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                    <? echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>No reservations found in the database. Please try again or Go back to <a href="reservation_manager.php" class="link1">reservation manager</a></strong></div><table><tr><td></td></tr>';  
					?> 
                  </table>  
                 <input name="delete_selected" type="submit" value="Delete selected"> 
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
	
	// Get Search Result with pages
	function get_search_reservations_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 25;
			} else {
			$display = $_GET['pages'];
			};
			
			// Search criteria BEGIN
			if (empty($_GET['search_by'])) {
			$searchby_sql = " first_name LIKE '%".$_GET['where']."%' OR last_name LIKE '%".$_GET['where']."%'";
			} else {
				if ($_GET['search_by'] == 'name') {
					$searchby_sql = " first_name LIKE '%".$_GET['where']."%' OR last_name LIKE '%".$_GET['where']."%'";
				}
				
				
				if ($_GET['search_by'] == 'id') {
					$searchby_sql = " id ='".$_GET['where']."'";
				}
				
				if ($_GET['search_by'] == 'client_id') {
					$searchby_sql = " client_id ='".$_GET['where']."'";
				}
				
				if ($_GET['search_by'] == 'email') {
					$searchby_sql = " email LIKE '%".$_GET['where']."%'";
				}
				
				if ($_GET['search_by'] == 'phone_number') {
					$searchby_sql = " phone_number LIKE '%".$_GET['where']."%'";
				}
				
				if ($_GET['search_by'] == 'cellphone') {
					$searchby_sql = " cellphone LIKE '%".$_GET['where']."%'";
				}
				
				if ($_GET['search_by'] == 'payment_status') {
					$searchby_sql = " payment_status LIKE '%".$_GET['where']."%'";
				}
				
				if ($_GET['search_by'] == 'approval_code') {
					$searchby_sql = " approval_code LIKE '%".$_GET['where']."%'";
				}
		
			}
			
			if (empty($_GET['orderby'])) {
			$orderby_sql = " id DESC";
			} else {
				if ($_GET['orderby'] == 'name') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " first_name ASC";
					} else {
					$orderby_sql = " first_name DESC";
					}
				}
				
				
				if ($_GET['orderby'] == 'id') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " id ASC";
					} else {
					$orderby_sql = " id DESC";
					}
				}
				
				if ($_GET['orderby'] == 'date') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " reservation_date ASC";
					} else {
					$orderby_sql = " reservation_date DESC";
					}
				}
				
				if ($_GET['orderby'] == 'status') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " status ASC";
					} else {
					$orderby_sql = " status DESC";
					}
				}
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			
			$query = "SELECT id, client_id, vehicle_id, passenger_count, child_carseat, booster_seat, trip_type, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, address_billing, address2_billing, city_billing, state_billing, zip_billing, country_billing, total_amount, status, customer_comments, admin_comments, paying_cash, store_stop, ip_address, reservation_date FROM reservations WHERE $searchby_sql ORDER BY $orderby_sql";
			
			$query_result=mysql_query($query);
			$num_records=@mysql_num_rows($query_result);
			if ($num_records > $display) { // More then 1 page.
			$num_pages = ceil ($num_records/$display);
			} else {
			$num_pages = 1;
			}
			}

			// Determinate where in the database to start returning result.
			if (isset($_GET['s'])) { // Already been determinated.
			$start = $_GET['s'];	
			} else {
			$start = 0;
			}

			$query = "SELECT id, client_id, vehicle_id, passenger_count, child_carseat, booster_seat, trip_type, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, address_billing, address2_billing, city_billing, state_billing, zip_billing, country_billing, total_amount, status, customer_comments, admin_comments, paying_cash, store_stop, ip_address, reservation_date FROM reservations WHERE $searchby_sql ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
						
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="reservation_manager.php" method="get">';
				echo '<table width="100%" style="padding-top:10px;" class="bodytxt">';
				echo '<tr>';
				echo '<td style="padding-left:10px;" class="bodytxt" align="left">';
				echo 'Listings per page ';
            	echo '<select name="pages" class="bodytxt" onchange="this.form.submit();">';
				echo '<option value="'.$display.'">'.$display.'</option>';
            	echo '<option value="10">10</option>';
            	echo '<option value="25">25</option>';
            	echo '<option value="50">50</option>';
            	echo '<option value="75">75</option>';
            	echo '<option value="100">100</option>';
            	echo '</select>';
				echo '</td><td style="padding-left:10px;" class="bodytxt" align="right">';
				echo '<span style="margin-right:10px" class="bodytxt">';
				$current_page = ($start/$display) + 1;
				//If it's not the first page, make a`Previous button.
				if ($current_page != 1) {
				echo '&lt;&lt; <a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>RESERVATION SEARCH</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="1260" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
                      <td width="37" class="ot1" align="center"><input type="checkbox" name="checkall" onclick="checkedAll(document.displayfrm.id);"></td>
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_manager.php?orderby=id&sort=desc" class="link2">ID</a>
					  <?php } else { ?>
                      <a href="reservation_manager.php?orderby=id&sort=asc" class="link2">ID</a>
					  <?php } ?>
                      </td>
                      <td width="140" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_manager.php?orderby=name&sort=desc" class="link2">Client</a>
					  <?php } else { ?>
                      <a href="reservation_manager.php?orderby=name&sort=asc" class="link2">Client</a>
					  <?php } ?>
                      </td>
                      <td width="70" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1"><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_manager.php?orderby=vehicle_id&sort=asc" class="link2">Car Type<?php } else { ?>
                      <a href="reservation_manager.php?orderby=vehicle_id&sort=desc" class="link2">Car Type</a>
					  <?php } ?></td>
                      <td width="180" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">From/To</td>
                      <td width="90" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      Arrival Date
                      </td>
                      <td width="80" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Arrival<br />Time</td>
                      <td width="110" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Departure<br />Date
                      </td>
                      <td width="100" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Departure<br />Time</td>
                      <td width="100" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Pick up<br />Time</td>
                      <td width="110" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_manager.php?orderby=date&sort=asc" class="link2">Date submitted</a>
					  <?php } else { ?>
                      <a href="reservation_manager.php?orderby=date&sort=desc" class="link2">Date submitted</a>
					  <?php } ?>
                      </td>
                      <td width="50" colspan="2" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Price
                      </td>
                      <td width="70" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                  </tr>
                  <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
            		echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="37" height="22" align="center" class="ot1"><input name="id[]" id="id" type="checkbox" value="<?php echo $value['id']; ?>"></td> 
                      <td width="40" height="22" align="left" class="ot1"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['id']; ?></strong></a></td>
                      <td width="140" height="22" align="left" class="ot1"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?></strong></a></td>
                      <td width="70" height="22" align="center" class="ot1">
                      <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>
                      </td>
                      <td width="180" align="left" class="ot1">
                      <?php $destination = get_destination_data($value['id']);
					  
					  $num_legs = count($destination);
		  	  		  for ($count =0; $count <= $num_legs - 1; $count += 1) {
					  $to[$count] = get_locations_view($destination[$count]['to']);
					  echo "->";
					  echo $to[$count]['name'];
					  };
					  
					  ?>
                     </td>
                     <td width="100" align="center" class="ot1">
					 <?php
					 $arrival_data=get_arrival_data($value['id']); 
					 if (!empty($arrival_data['date'])) {
					  echo format_to_caldate($arrival_data['date']);
					 }
					 ?>
					 </td>
                      <td width="80" align="center" class="ot1"><?php
					  $arrival_data=get_arrival_data($value['id']);
					  if (!empty($arrival_data['time'])) {
					  echo " ".format_time($arrival_data['time']);
					  }
					  ?></td>
                      <td width="110" align="center" class="ot1"><?php 
					  $departure_data=get_departure_data($value['id']); 
					  if (!empty($departure_data['date'])) {
					  echo format_to_caldate($departure_data['date']); 
					  }
					  ?></td>
                      <td width="90" align="center" class="ot1"><?php 
					  $departure_data=get_departure_data($value['id']); 
					  if (!empty($departure_data['time'])) {
					  echo " ".format_time($departure_data['time']); 
					  }
					  ?></td>
                      <td width="90" align="center" class="ot1"><?php
					  if (!empty($arrival_data)) {
					  echo format_time_admin($arrival_data['time'], $arrival_data['from'], $arrival_data['to'], $arrival_data['date']);
					  } else {
					  $pickup_time = explode (" ", format_time_admin($departure_data['time'], $departure_data['from'], $departure_data['to'], $departure_data['date']));
					  echo $pickup_time = $pickup_time[0].' '.$pickup_time[1].'<br>'.$pickup_time[2];
					  }
					  ?></td>
                     <td width="110" align="center" class="ot1"><?php echo format_to_caldate($value['reservation_date']); ?></td>
                      <td width="50" colspan="2" align="center" class="ot1"><?php if (!empty($value['total_amount'])) { echo "<strong><i>$".$value['total_amount']."</i></strong>"; }; ?></td>
                      <td width="70" height="22" align="center"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a>&nbsp;&nbsp;<a href="../print_reservation_admin.php?id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Print" target="_blank"><img src="images/printmgr.png" border="0" /></a>&nbsp;&nbsp;<a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this reservation?\n\nNotice: deleted reservation cannot be restored')" /></a></td>
                    </tr>
                    <? 
					} 
					?>
                  </table>  
                 <input name="delete_selected" type="submit" value="Delete selected"> 
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>RESERVATION SEARCH</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">ID
                      </td>
                      <td width="110" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Client
                      </td>
                      <td width="293" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Transportation Info</td>
                      <td width="110" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Date submitted
                      </td>
                      <td width="55" colspan="2" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Status
                      </td>
                      <td width="70" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                  <? echo '<div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>Sorry no reservations found matching your search criteria. <br> Try again or Go back to <a href="reservation_manager.php" class="link1">Reservation Manager</a></strong></div>';  
					?> 
                  </table>  
                 <input name="delete_selected" type="submit" value="Delete selected"> 
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
	
	function checkCreditCard($cardnumber, $cardname, &$errornumber, &$errortext) {
	  // Define the cards we support. You may add additional card types.
	  //  Name:      As in the selection box of the form - must be same as user's
	  //  Length:    List of possible valid lengths of the card number for the card
	  //  prefixes:  List of possible prefixes for the card
	  //  checkdigit Boolean to say whether there is a check digit	  
	  // Don't forget - all but the last array definition needs a comma separator!


	  $cards = array (  array ('name' => 'American Express', 
							  'length' => '15', 
							  'prefixes' => '34,37',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Carte Blanche', 
							  'length' => '14', 
							  'prefixes' => '300,301,302,303,304,305,36,38',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Diners Club', 
							  'length' => '14',
							  'prefixes' => '300,301,302,303,304,305,36,38',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Discover', 
							  'length' => '16', 
							  'prefixes' => '6011',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Enroute', 
							  'length' => '15', 
							  'prefixes' => '2014,2149',
							  'checkdigit' => true
							 ),
					   array ('name' => 'JCB', 
							  'length' => '15,16', 
							  'prefixes' => '3,1800,2131',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Maestro', 
							  'length' => '16,18', 
							  'prefixes' => '5020,6',
							  'checkdigit' => true
							 ),
					   array ('name' => 'MasterCard', 
							  'length' => '16', 
							  'prefixes' => '51,52,53,54,55',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Solo', 
							  'length' => '16,18,19', 
							  'prefixes' => '6334,6767',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Switch', 
							  'length' => '16,18,19', 
							  'prefixes' => '4903,4905,4911,4936,564182,633110,6333,6759',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Visa', 
							  'length' => '13,16', 
							  'prefixes' => '4',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Visa Electron', 
							  'length' => '16', 
							  'prefixes' => '417500,4917,4913',
							  'checkdigit' => true
							 )
					);
	
	  $ccErrorNo = 0;
	
	  $ccErrors [0] = "Unknown card type";
	  $ccErrors [1] = "No card number provided";
	  $ccErrors [2] = "Credit card number has invalid format";
	  $ccErrors [3] = "Credit card number is invalid";
	  $ccErrors [4] = "Credit card number is wrong length";
				   
	  // Establish card type
	  $cardType = -1;
	  for ($i=0; $i<sizeof($cards); $i++) {
	
		// See if it is this card (ignoring the case of the string)
		if (strtolower($cardname) == strtolower($cards[$i]['name'])) {
		  $cardType = $i;
		  break;
		}
	  }
	  
	  // If card type not found, report an error
	  if ($cardType == -1) {
		 $errornumber = 0;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  }
	   
	  // Ensure that the user has provided a credit card number
	  if (strlen($cardnumber) == 0)  {
		 $errornumber = 1;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  }
	  
	  // Remove any spaces from the credit card number
	  $cardNo = str_replace (' ', '', $cardnumber);  
	   
	  // Check that the number is numeric and of the right sort of length.
	  if (!eregi('^[0-9]{13,19}$',$cardNo))  {
		 $errornumber = 2;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  }
		   
	  // Now check the modulus 10 check digit - if required
	  if ($cards[$cardType]['checkdigit']) {
		$checksum = 0;                                  // running checksum total
		$mychar = "";                                   // next char to process
		$j = 1;                                         // takes value of 1 or 2
	  
		// Process each digit one by one starting at the right
		for ($i = strlen($cardNo) - 1; $i >= 0; $i--) {
		
		  // Extract the next digit and multiply by 1 or 2 on alternative digits.      
		  $calc = $cardNo{$i} * $j;
		
		  // If the result is in two digits add 1 to the checksum total
		  if ($calc > 9) {
			$checksum = $checksum + 1;
			$calc = $calc - 10;
		  }
		
		  // Add the units element to the checksum total
		  $checksum = $checksum + $calc;
		
		  // Switch the value of j
		  if ($j ==1) {$j = 2;} else {$j = 1;};
		} 
	  
		// All done - if checksum is divisible by 10, it is a valid modulus 10.
		// If not, report an error.
		if ($checksum % 10 != 0) {
		 $errornumber = 3;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
		}
	  }  
	
	  // The following are the card-specific checks we undertake.
	
	  // Load an array with the valid prefixes for this card
	  $prefix = split(',',$cards[$cardType]['prefixes']);
		  
	  // Now see if any of them match what we have in the card number  
	  $PrefixValid = false; 
	  for ($i=0; $i<sizeof($prefix); $i++) {
		$exp = '^' . $prefix[$i];
		if (ereg($exp,$cardNo)) {
		  $PrefixValid = true;
		  break;
		}
	  }
		  
	  // If it isn't a valid prefix there's no point at looking at the length
	  if (!$PrefixValid) {
		 $errornumber = 3;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  }
		
	  // See if the length is valid for this card
	  $LengthValid = false;
	  $lengths = split(',',$cards[$cardType]['length']);
	  for ($j=0; $j<sizeof($lengths); $j++) {
		if (strlen($cardNo) == $lengths[$j]) {
		  $LengthValid = true;
		  break;
		}
	  }
	  
	  // See if all is OK by seeing if the length was valid. 
	  if (!$LengthValid) {
		 $errornumber = 4;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  };   
	  
	  // The credit card is in the required format.
	  return true;

	}
	
	//Get Report Reservations - Last Version
	function get_report_reservations($from, $to, $vehicle_id, $status_id, $trip_type){
		global $db;
		if (!empty($vehicle_id)) {
		$searchby_sql = " AND vehicle_id='$vehicle_id'";
		}
		if (!empty($status_id)) {
		$searchby_sql2 = " AND status='$status_id'";
		}
		
		if (!empty($trip_type)) {
		$searchby_sql3 = " AND trip_type='$trip_type'";
		}
		if ($from == $to) {
		$searchby_sql3 = " LIKE '$to%'";
		} else {
			if ($from =='--' || $to =='--') {
				if ($from =='--') {
				$searchby_sql3 = " LIKE '$to%'";
				} else {
				$searchby_sql3 = " LIKE '$from%'";
				}
			} else {
			$searchby_sql3 = " BETWEEN '$from' AND '$to'";
			};
		};
			$get_report_reservations_sql = "SELECT distinct r.id, r.vehicle_id, r.trip_type, r.total_amount, v.name, r.first_name, r.last_name, r.status, r.reservation_date FROM reservations r INNER JOIN vehicles v ON r.vehicle_id=v.id LEFT JOIN reservation_details rd ON r.id=rd.reservation_id WHERE rd.pickup_date $searchby_sql3 $searchby_sql $searchby_sql2 ORDER BY rd.pickup_date ASC";
			//ORDER BY rd.pickup_date DESC
			//print_r($get_report_reservations_sql);
			//exit;
			if(!$result = $db->select($get_report_reservations_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC')) {
					$report_reservations[] = $data['id'];  /// Get only reservation IDs
				}
				
				//print_r($report_reservations);
				//exit;
				
				if (!empty($report_reservations)) {
					foreach ($report_reservations as $reports) {
							
							$report_reservations2='';
							$data2 ='';
							
							$get_report_reservations2_sql = "SELECT r.id, r.vehicle_id, r.trip_type, r.total_amount, v.name, r.first_name, r.last_name, r.status, r.reservation_date, rd.pickup_date FROM reservations r INNER JOIN vehicles v ON r.vehicle_id=v.id LEFT JOIN reservation_details rd ON r.id=rd.reservation_id WHERE r.id = '$reports' ORDER BY rd.pickup_date ASC";
							//if ($reports == '2903')	{
							//print_r($get_report_reservations2_sql);
							//echo "<br>";
							//}
							if(!$result2 = $db->select($get_report_reservations2_sql)){
								echo $_SESSION['notice'] = "Database Error. Please try again";
								return false;
							}
		
							else{
								while($data2=$db->get_row($result2, 'MYSQL_ASSOC')) {
									$report_reservations2[] = $data2;
								}
								
								$report_reservations3 ='';
								
								if (!empty($report_reservations2)) {
									$count_unique_res='0';
									foreach ($report_reservations2 as $report_reservations2_value) {
										if ($count_unique_res=='0') {
										$count_unique_res ='1';
										
										if ($report_reservations2_value['pickup_date'] >= $from) {
										$report_reservations3 = $report_reservations2_value;
										//print_r($report_reservations3);
										//echo "<br><br>";
										}
										}
									}
								}
								
							if (!empty($report_reservations3)) {	
							$report_reservations_new2[] = $report_reservations3;
							}			
							}
					
					}
				}
				
				//echo $from;
				
				return $report_reservations_new2;
			}
	}
	
	
	
	//Get Report Reservations - TEST
	function get_report_reservations_old2($from, $to, $vehicle_id, $status_id, $trip_type){
		global $db;
		if (!empty($vehicle_id)) {
		$searchby_sql = " AND vehicle_id='$vehicle_id'";
		}
		if (!empty($status_id)) {
		$searchby_sql2 = " AND status='$status_id'";
		}
		
		if (!empty($trip_type)) {
		$searchby_sql3 = " AND trip_type='$trip_type'";
		}
		if ($from == $to) {
		$searchby_sql3 = " LIKE '$to%'";
		} else {
			if ($from =='--' || $to =='--') {
				if ($from =='--') {
				$searchby_sql3 = " LIKE '$to%'";
				} else {
				$searchby_sql3 = " LIKE '$from%'";
				}
			} else {
			$searchby_sql3 = " BETWEEN '$from' AND '$to'";
			};
		};
			$get_report_reservations_sql = "SELECT distinct r.id, r.vehicle_id, r.trip_type, r.total_amount, v.name, r.first_name, r.last_name, r.status, r.reservation_date FROM reservations r INNER JOIN vehicles v ON r.vehicle_id=v.id LEFT JOIN reservation_details rd ON r.id=rd.reservation_id WHERE rd.pickup_date $searchby_sql3 $searchby_sql $searchby_sql2 ORDER BY rd.pickup_date ASC";
			//ORDER BY rd.pickup_date DESC
			//print_r($get_report_reservations_sql);
			//exit;
			if(!$result = $db->select($get_report_reservations_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC')) {
					$report_reservations[] = $data['id'];  /// Get only reservation IDs
				}
				
				//print_r($report_reservations);
				//exit;
				
				if (!empty($report_reservations)) {
					foreach ($report_reservations as $reports) {
							
							$get_report_reservations2_sql = "SELECT r.id, r.vehicle_id, r.trip_type, r.total_amount, v.name, r.first_name, r.last_name, r.status, r.reservation_date FROM reservations r INNER JOIN vehicles v ON r.vehicle_id=v.id LEFT JOIN reservation_details rd ON r.id=rd.reservation_id WHERE rd.pickup_date $searchby_sql3 $searchby_sql $searchby_sql2 AND r.id = '$reports' ORDER BY rd.pickup_date ASC LIMIT 1";
							//if ($reports == '2903')	{
							//print_r($get_report_reservations2_sql);
							//echo "<br>";
							//}
							if(!$result2 = $db->select($get_report_reservations2_sql)){
								echo $_SESSION['notice'] = "Database Error. Please try again";
								return false;
							}
		
							else{
								while($data2=$db->get_row($result2, 'MYSQL_ASSOC')) {
									$report_reservations2 = $data2;
								}
								
							$report_reservations_new[] = $report_reservations2;			
							}
					
					}
				}
				
				//echo $from;
				
				if (!empty($report_reservations_new)) {
					foreach ($report_reservations_new as $report_reservations_new_value) {
						if ($report_reservations_new_value['pickup_date'] < $from) {
						$report_reservations_new2[] = $report_reservations_new_value;
						}
					}
				}
				
				return $report_reservations_new2;
			}
	}
	
	//Get Report Reservations - Old Version - just in case
	function get_report_reservations_old($from, $to, $vehicle_id, $status_id, $trip_type){
		global $db;
		if (!empty($vehicle_id)) {
		$searchby_sql = " AND vehicle_id='$vehicle_id'";
		}
		if (!empty($status_id)) {
		$searchby_sql2 = " AND status='$status_id'";
		}
		
		if (!empty($trip_type)) {
		$searchby_sql3 = " AND trip_type='$trip_type'";
		}
		if ($from == $to) {
		$searchby_sql3 = " LIKE '$to%'";
		} else {
			if ($from =='--' || $to =='--') {
				if ($from =='--') {
				$searchby_sql3 = " LIKE '$to%'";
				} else {
				$searchby_sql3 = " LIKE '$from%'";
				}
			} else {
			$searchby_sql3 = " BETWEEN '$from' AND '$to'";
			};
		};
			$get_report_reservations_sql = "SELECT distinct r.id, r.vehicle_id, r.trip_type, r.total_amount, v.name, r.first_name, r.last_name, r.status, r.reservation_date FROM reservations r INNER JOIN vehicles v ON r.vehicle_id=v.id LEFT JOIN reservation_details rd ON r.id=rd.reservation_id WHERE rd.pickup_date $searchby_sql3 $searchby_sql $searchby_sql2 ORDER BY rd.pickup_date DESC";
			
			//print_r($get_report_reservations_sql);
			//exit;
			if(!$result = $db->select($get_report_reservations_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC')) {
					$report_reservations[] = $data;
				}
				return $report_reservations;
			}
	}
	
	
	// Get Todays Schedule
	function get_schedule(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 100;
			} else {
			$display = $_GET['pages'];
			};
			
			if (empty($_GET['order_by'])) {
			$order_by_sql = "rd.pickup_time ASC";
			} else {
				if ($_GET['order_by'] == 'time') {
					if ($_GET['sort'] == 'asc') {
					$order_by_sql = " rd.pickup_time ASC";
					} else {
					$order_by_sql = " rd.pickup_time DESC";
					}
				}
				
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			$todays_date = date('Y-m-d'); 
			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE rd.pickup_date = '$todays_date' ORDER BY $order_by_sql";
			
			$query_result=mysql_query($query);
			$num_records=@mysql_num_rows($query_result);
			if ($num_records > $display) { // More then 1 page.
			$num_pages = ceil ($num_records/$display);
			} else {
			$num_pages = 1;
			}
			}

			// Determine where in the database to start returning result.
			if (isset($_GET['s'])) { // Already been determined.
			$start = $_GET['s'];	
			} else {
			$start = 0;
			}

			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.pickup_time, rd.pickup_date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.cellphone, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs, r.payment_status FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE r.status !='11' AND rd.pickup_date = '$todays_date' ORDER BY $order_by_sql LIMIT $start, $display";
			
			//echo $query;
			//exit;
						
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="reservation_manager.php" method="get">';
				echo '<table width="100%" style="padding-top:10px;" class="bodytxt">';
				echo '<tr>';
				echo '<td style="padding-left:10px;" class="bodytxt" align="left">';
				echo 'Listings per page ';
            	echo '<select name="pages" class="bodytxt" onchange="this.form.submit();">';
				echo '<option value="'.$display.'">'.$display.'</option>';
            	echo '<option value="10">10</option>';
            	echo '<option value="25">25</option>';
            	echo '<option value="50">50</option>';
            	echo '<option value="75">75</option>';
            	echo '<option value="100">100</option>';
            	echo '</select>';
				echo '</td><td style="padding-left:10px;" class="bodytxt" align="right">';
				echo '<span style="margin-right:10px" class="bodytxt">';
				$current_page = ($start/$display) + 1;
				//If it's not the first page, make a`Previous button.
				if ($current_page != 1) {
				echo '&lt;&lt; <a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS SCHEDULE</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Client, Depart</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?order_by=time&sort=asc" class="link3">Time</a>
					  <?php } else { ?>
                      <a href="index.php?order_by=time&sort=desc" class="link3">Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Passengers, Vehicle, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
            <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					
					//Shades of Green BG setup BEGIN
					if ($value['from'] == '517' || $value['to'] == '517') {
					//$bgcolor="#335115";
						if (check_departure($value['to']) && $value['trip_type'] !='1') {
						$departure_value='yes';
						//$bgcolor="#ff0000"; 
						} else {
						$departure_value='';
					}
					//Shades of Green BG setup END
					} else {
					$departure_value='';
					if(check_departure($value['from']) || check_arrival($value['from']) || check_departure($value['to']) || check_arrival($value['to'])) { if (check_arrival($value['from'])) { 
					//$bgcolor="#004eff";
					} else { 
					//$bgcolor="#ff0000"; 
					if($value['trip_type'] !='1') { $departure_value='yes'; }; }; ?><? } else { 
					//$bgcolor="#f49502"; 
					};
					};
					
					$res_destination_data = get_destination_data($value['reservation_id']);
					
					$count_res_destination_data = count($res_destination_data);
					
					$bgcolor='';
					
					if ($count_res_destination_data =='1') {
					$bgcolor="#004eff";
					} else {
						
						//print_r($value);
						//exit;
						
						if ($res_destination_data[0]['id'] == $value['id']) {
						$bgcolor="#004eff";
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#f49502";
						}
						
						if ($count_res_destination_data == 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#ff0000";
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[2]['id'] == $value['id']) {
						$bgcolor="#ff0000";
						}
						
					}
					
					
					echo '<tr>';
					?>
                      <td width="5%" class="ob" valign="top"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong>Detail</strong><br /><?php echo $value['reservation_id']; ?></a></td>
                	  <td width="25%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>">
                      <?php //if (check_departure($value['id'], $value['location1_id'], $value['location2_id'], $value['location1'], $value['location3'], $value['travel_date_roundtrip'])) { echo "Arrival"; } ; ?>
                      <a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong><?php echo $value['last_name']; ?></strong>, <?php echo $value['first_name']; ?></a><br /><br /><?php $trip_type = get_trip_types_view($value['trip_type']); ?><?php echo $trip_type['name']; ?></td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php
					  echo "<strong>".format_time_admin($value['time'], $value['from'], $value['to'], $value['date'])."</strong>, "; ?><?php if (!empty($value['airline'])) { echo $value['airline']."/" .$value['flight_number']; }; ?>&nbsp;</td>
                      <td width="25%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php echo $value['passenger_count']; ?>, <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>, 
                      <?php
					  //print_r($value);
					  $from = get_locations_view($value['from']);
		  	  		  $to = get_locations_view($value['to']);
					  echo "<strong>From:</strong> ".$from['name']." <strong>To:</strong> ".$to['name'];			  
					  ?>
                      </td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php if ($value['child_carseat'] == 'Yes') { echo "<strong>CS:</strong> ".$value['child_carseat'].", "; }; ?><?php if ($value['booster_seat'] == 'Yes') { echo "<strong>BS:</strong> ".$value['booster_seat'].","; }; ?> <?php if ($value['store_stop'] == 'Yes') { echo "<strong>Quick Grocery Stop:</strong> ".$value['store_stop']; }; ?>&nbsp;</td>
                	  <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php 
					  //Check for Return trip to Airport 
					  if (!empty($departure_value)) {
					  echo '<strong>Return</strong>';
					  } else {
					  if (!empty($value['total_amount'])) { echo "$".$value['total_amount']; };
					  }; ?></td>
                    </tr>
                    <tr>
            		  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top" >
                      <?php 
					  if(check_departure($value['from']) || check_arrival($value['from']) || check_departure($value['to']) || check_arrival($value['to'])) { ?>
					  <?php 
					  if (check_arrival($value['from'])) { 
					  // Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	echo "<strong>Depart:</strong> "; 
					  	$departure_data=get_departure_data($value['reservation_id']); 
					  	echo format_to_caldate($departure_data['date']); 
					  	echo " ".format_time($departure_data['time']);
						} 
					  } else { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	echo "<strong>Arrived:</strong> "; 
					  	$arrival_data=get_arrival_data($value['reservation_id']); 
					  	echo format_to_caldate($arrival_data['date']);
					  	echo " ".format_time($arrival_data['time']);
						}
					  };  ?><? } else { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
						/*
						$transfer_data=get_transfer_data_new($value['reservation_id']); 
						if (!empty($transfer_data)) {
							foreach ($transfer_data as $value) {
							echo "<strong>Transfer:</strong> ". format_to_caldate($value['date'])."<br>";
							}
						}
						*/
						//print_r($transfer_data);
						//echo "<strong>Transfer:</strong> "; echo format_to_caldate($departure_data[0]['date']);
					  	//echo "<strong>Arrived:</strong> "; echo format_to_caldate($arrival_data[0]['date']);
					  	//echo " ".format_time($arrival_data[0]['time']);  echo "<br>"; echo "<strong>Depart:</strong> "; echo format_to_caldate($departure_data[0]['date']); 
					  	//echo " ".format_time($departure_data[0]['time']); 
						}; 
					  };
					  ?>
                      &nbsp;
                      </td>
                	  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					  <?php if ($value['paying_cash']) { ?>Please do not charge my credit card. I will be paying cash or traveler check upon arrival.<br /><?php } ?><?php if (!empty($value['customer_comments'])) { echo $value['customer_comments'].'<br />'; }; ?><?php if (!empty($value['cellphone'])) { echo '<strong>Cellphone:</strong> '.$value['cellphone']; }; ?></td>
                      <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					   <?php if ($value['paying_cash']) { ?>Cash<?php } else { ?>Credit Card<?php } ?> <?php if (empty($value['payment_status'])) { echo '<span style="color:#FF0000;">Pending</span>'; } else { if ($value['payment_status'] =='Declined') { echo '<span style="color:#FF0000;">'.$value['payment_status'].'</span>'; } else { echo '<span style="color:#00CC00;">'.$value['payment_status'].'</span>'; }; }; ?><div style="float:right"><?php if ((empty($value['payment_status']) || $value['payment_status'] == 'Declined') && empty($value['paying_cash'])) { echo '<a href="make_single_payment.php?id='.$value['reservation_id'].'" class="menu">Run Credit Card</a>'; }; ?></div></td>
            		</tr>
                    <? 
					} 
					?>
        </table>  
    	</form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS SCHEDULE</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
                    <? echo '<div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>Sorry no reservations found matching your search criteria. <br> Try again or Go back to <a href="reservation_manager.php" class="link1">Reservation Manager</a></strong></div>';  
					?> 
                </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
//--------------- TOMORROW SCHEDULE by RaSH  ---------------------------------
	// Get Todays Schedule
	function get_schedule_tomorrow(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 100;
			} else {
			$display = $_GET['pages'];
			};
			
			if (empty($_GET['order_by'])) {
			$order_by_sql = " rd.pickup_time ASC";
			} else {
				if ($_GET['order_by'] == 'time') {
					if ($_GET['sort'] == 'asc') {
					$order_by_sql = " rd.pickup_time ASC";
					} else {
					$order_by_sql = " rd.pickup_time DESC";
					}
				}
				
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			
			$tomorrow = mktime(0, 0, 0, date("m"), date("d")+1, date("y"));
			$tomorrow =date("Y-m-d", $tomorrow); 

			$todays_date = $tomorrow; 
			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE rd.pickup_date = '$tomorrow' ORDER BY $order_by_sql";
			
			$query_result=mysql_query($query);
			$num_records=@mysql_num_rows($query_result);
			if ($num_records > $display) { // More then 1 page.
			$num_pages = ceil ($num_records/$display);
			} else {
			$num_pages = 1;
			}
			}

			// Determinate where in the database to start returning result.
			if (isset($_GET['s'])) { // Already been determinated.
			$start = $_GET['s'];	
			} else {
			$start = 0;
			}

			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.cellphone, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs, r.payment_status FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE r.status !='11' AND rd.pickup_date = '$todays_date' ORDER BY $order_by_sql LIMIT $start, $display";
			
			//echo $query;
			//exit;
						
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="reservation_manager.php" method="get">';
				echo '<table width="100%" style="padding-top:10px;" class="bodytxt">';
				echo '<tr>';
				echo '<td style="padding-left:10px;" class="bodytxt" align="left">';
				echo 'Listings per page ';
            	echo '<select name="pages" class="bodytxt" onchange="this.form.submit();">';
				echo '<option value="'.$display.'">'.$display.'</option>';
            	echo '<option value="10">10</option>';
            	echo '<option value="25">25</option>';
            	echo '<option value="50">50</option>';
            	echo '<option value="75">75</option>';
            	echo '<option value="100">100</option>';
            	echo '</select>';
				echo '</td><td style="padding-left:10px;" class="bodytxt" align="right">';
				echo '<span style="margin-right:10px" class="bodytxt">';
				$current_page = ($start/$display) + 1;
				//If it's not the first page, make a`Previous button.
				if ($current_page != 1) {
				echo '&lt;&lt; <a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>  TOMORROW'S SCHEDULE</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Client, Depart</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?order_by=time&sort=asc" class="link3">Time</a>
					  <?php } else { ?>
                      <a href="index.php?order_by=time&sort=desc" class="link3">Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Passengers, Vehicle, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
            <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					//Shades of Green BG setup BEGIN
					if ($value['from'] == '517' || $value['to'] == '517') {
					//$bgcolor="#335115";
						if (check_departure($value['to']) && $value['trip_type'] !='1') {
						$departure_value='yes';
						//$bgcolor="#ff0000"; 
						} else {
						$departure_value='';
					}
					//Shades of Green BG setup END
					} else {
					$departure_value='';
					if(check_departure($value['from']) || check_arrival($value['from']) || check_departure($value['to']) || check_arrival($value['to'])) { 
						
						if (check_arrival($value['from'])) { 
						//$bgcolor="#004eff";
						} else { //$bgcolor="#ff0000"; 
							if($value['trip_type'] !='1') { $departure_value='yes'; }; }; ?>
							
					<? } else { //$bgcolor="#f49502"; 
					};
					};
					$res_destination_data = get_destination_data($value['reservation_id']);
					
					$count_res_destination_data = count($res_destination_data);
					
					$bgcolor='';
					
					if ($count_res_destination_data =='1') {
					$bgcolor="#004eff";
					} else {
						
						//print_r($value);
						//exit;
						
						if ($res_destination_data[0]['id'] == $value['id']) {
						$bgcolor="#004eff";
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#f49502";
						}
						
						if ($count_res_destination_data == 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#ff0000";
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[2]['id'] == $value['id']) {
						$bgcolor="#ff0000";
						}
						
					}
					echo '<tr>';
					?>
                      <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong>Detail</strong><br /><?php echo $value['reservation_id']; ?></a></td>
                	  <td width="25%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>">
                      <?php //if (check_departure($value['id'], $value['location1_id'], $value['location2_id'], $value['location1'], $value['location3'], $value['travel_date_roundtrip'])) { echo "Arrival"; } ; ?>
                      <a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong><?php echo $value['last_name']; ?></strong>, <?php echo $value['first_name']; ?></a><br /><br /><?php $trip_type = get_trip_types_view($value['trip_type']); ?><?php echo $trip_type['name']; ?></td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php
					  echo "<strong>".format_time_admin($value['time'], $value['from'], $value['to'], $value['date'])."</strong>, "; ?><?php if (!empty($value['airline'])) { echo $value['airline']."/" .$value['flight_number']; }; ?>&nbsp;</td>
                      <td width="25%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php echo $value['passenger_count']; ?>, <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>, 
                      <?php
					  //print_r($value);
					  $from = get_locations_view($value['from']);
		  	  		  $to = get_locations_view($value['to']);
					  echo "<strong>From:</strong> ".$from['name']." <strong>To:</strong> ".$to['name'];			  
					  ?>
                      </td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php if ($value['child_carseat'] == 'Yes') { echo "<strong>CS:</strong> ".$value['child_carseat'].", "; }; ?><?php if ($value['booster_seat'] == 'Yes') { echo "<strong>BS:</strong> ".$value['booster_seat'].","; }; ?> <?php if ($value['store_stop'] == 'Yes') { echo "<strong>Quick Grocery Stop:</strong> ".$value['store_stop']; }; ?>&nbsp;</td>
                	  <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php 
					  //Check for Return trip to Airport 
					  if (!empty($departure_value)) {
					  echo '<strong>Return</strong>';
					  } else {
					  if (!empty($value['total_amount'])) { echo "$".$value['total_amount']; };
					  }; ?></td>
                    </tr>
                    <tr>
            		  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top" >
                      <?php 
					  if(check_departure($value['from']) || check_arrival($value['from']) || check_departure($value['to']) || check_arrival($value['to'])) { ?>
					  <?php 
					  if (check_arrival($value['from'])) { 
					  // Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	echo "<strong>Depart:</strong> "; 
					  	$departure_data=get_departure_data($value['reservation_id']); 
					  	echo format_to_caldate($departure_data['date']); 
					  	echo " ".format_time($departure_data['time']);
						} 
					  } else { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	echo "<strong>Arrived:</strong> "; 
					  	$arrival_data=get_arrival_data($value['reservation_id']); 
					  	echo format_to_caldate($arrival_data['date']);
					  	echo " ".format_time($arrival_data['time']);
						}
					  };  ?><? } else { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	//echo "<strong>Arrived:</strong> "; echo format_to_caldate($arrival_data[0]['date']);
					  	//echo " ".format_time($arrival_data[0]['time']);  echo "<br>"; echo "<strong>Depart:</strong> "; echo format_to_caldate($departure_data[0]['date']); 
					  	//echo " ".format_time($departure_data[0]['time']); 
						}; 
					  };
					  ?>
                      &nbsp;
                      </td>
                	  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					  <?php if ($value['paying_cash']) { ?>Please do not charge my credit card. I will be paying cash or traveler check upon arrival.<br /><?php } ?><?php if (!empty($value['customer_comments'])) { echo $value['customer_comments'].'<br />'; }; ?><?php if (!empty($value['cellphone'])) { echo '<strong>Cellphone:</strong> '.$value['cellphone']; }; ?></td>
                      <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					   <?php if ($value['paying_cash']) { ?>Cash<?php } else { ?>Credit Card<?php } ?> <?php if (empty($value['payment_status'])) { echo '<span style="color:#FF0000;">Pending</span>'; } else { if ($value['payment_status'] =='Declined') { echo '<span style="color:#FF0000;">'.$value['payment_status'].'</span>'; } else { echo '<span style="color:#00CC00;">'.$value['payment_status'].'</span>'; }; }; ?><div style="float:right"><?php if ((empty($value['payment_status']) || $value['payment_status'] == 'Declined') && empty($value['paying_cash'])) { echo '<a href="make_single_payment.php?id='.$value['reservation_id'].'" class="menu">Run Credit Card</a>'; }; ?></div></td>
            		</tr>
                    <? 
					} 
					?>
        </table>  
    	</form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS SCHEDULE</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
                    <? echo '<div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>Sorry no reservations found matching your search criteria. <br> Try again or Go back to <a href="reservation_manager.php" class="link1">Reservation Manager</a></strong></div>';  
					?> 
                </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
//--------- TOMORROW SCHEDULE FUNCTION END -----------------------------------	
	
	// Get Arrivals Result with pages
	function get_arrivals_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 100;
			} else {
			$display = $_GET['pages'];
			};
			
			if (empty($_GET['orderby'])) {
			$orderby_sql = " rd.pickup_time ASC";
			} else {
				if ($_GET['orderby'] == 'time') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " rd.pickup_time ASC";
					} else {
					$orderby_sql = " rd.pickup_time DESC";
					}
				}
				
				if ($_GET['orderby'] == 'vehicle') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " r.vehicle_id ASC";
					} else {
					$orderby_sql = " r.vehicle_id DESC";
					}
				}
				
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			$todays_date = date('Y-m-d'); 
			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE (rd.from='422' OR rd.from='421' OR rd.from='512') AND rd.pickup_date = '$todays_date' ORDER BY $orderby_sql";
			
			$query_result=mysql_query($query);
			$num_records=@mysql_num_rows($query_result);
			if ($num_records > $display) { // More then 1 page.
			$num_pages = ceil ($num_records/$display);
			} else {
			$num_pages = 1;
			}
			}

			// Determinate where in the database to start returning result.
			if (isset($_GET['s'])) { // Already been determinated.
			$start = $_GET['s'];	
			} else {
			$start = 0;
			}

			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.cellphone, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs, r.payment_status FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE r.status !='11' AND (rd.from='422' OR rd.from='421' OR rd.from='512') AND rd.pickup_date = '$todays_date' ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
						
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="reservation_manager.php" method="get">';
				echo '<table width="100%" style="padding-top:10px;" class="bodytxt">';
				echo '<tr>';
				echo '<td style="padding-left:10px;" class="bodytxt" align="left">';
				echo 'Listings per page ';
            	echo '<select name="pages" class="bodytxt" onchange="this.form.submit();">';
				echo '<option value="'.$display.'">'.$display.'</option>';
            	echo '<option value="10">10</option>';
            	echo '<option value="25">25</option>';
            	echo '<option value="50">50</option>';
            	echo '<option value="75">75</option>';
            	echo '<option value="100">100</option>';
            	echo '</select>';
				echo '</td><td style="padding-left:10px;" class="bodytxt" align="right">';
				echo '<span style="margin-right:10px" class="bodytxt">';
				$current_page = ($start/$display) + 1;
				//If it's not the first page, make a`Previous button.
				if ($current_page != 1) {
				echo '&lt;&lt; <a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS ARRIVALS</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Client, Depart</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?order_by=time&sort=asc" class="link3">Time</a>
					  <?php } else { ?>
                      <a href="index.php?order_by=time&sort=desc" class="link3">Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Passengers, Vehicle, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
            <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					//Shades of Green BG setup BEGIN
					if ($value['from'] == '517' || $value['to'] == '517') {
					//$bgcolor="#335115";
						if (check_departure($value['to']) && $value['trip_type'] !='1') {
						$departure_value='yes';
						//$bgcolor="#ff0000"; 
						} else {
						$departure_value='';
					}
					//Shades of Green BG setup END
					} else {
					$departure_value='';
					if(check_departure($value['from']) || check_arrival($value['from']) || check_departure($value['to']) || check_arrival($value['to'])) { if (check_arrival($value['from'])) { 
					//$bgcolor="#004eff";
					} else { //$bgcolor="#ff0000"; 
					if($value['trip_type'] !='1') { $departure_value='yes'; }; }; ?><? } else { 
					//$bgcolor="#f49502";
					};
					};
					$res_destination_data = get_destination_data($value['reservation_id']);
					
					$count_res_destination_data = count($res_destination_data);
					
					$bgcolor='';
					
					if ($count_res_destination_data =='1') {
					$bgcolor="#004eff";
					} else {
						
						//print_r($value);
						//exit;
						
						if ($res_destination_data[0]['id'] == $value['id']) {
						$bgcolor="#004eff";
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#f49502";
						}
						
						if ($count_res_destination_data == 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#ff0000";
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[2]['id'] == $value['id']) {
						$bgcolor="#ff0000";
						}
						
					}
					echo '<tr>';
					?>
                      <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong>Detail</strong><br /><?php echo $value['reservation_id']; ?></a></td>
                	  <td width="25%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>">
                      <?php //if (check_departure($value['id'], $value['location1_id'], $value['location2_id'], $value['location1'], $value['location3'], $value['travel_date_roundtrip'])) { echo "Arrival"; } ; ?>
                      <a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong><?php echo $value['last_name']; ?></strong>, <?php echo $value['first_name']; ?></a><br /><br /><?php $trip_type = get_trip_types_view($value['trip_type']); ?><?php echo $trip_type['name']; ?></td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php
					  echo "<strong>".format_time_admin($value['time'], $value['from'], $value['to'], $value['date'])."</strong>, "; ?><?php if (!empty($value['airline'])) { echo $value['airline']."/" .$value['flight_number']; }; ?>&nbsp;</td>
                      <td width="25%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php echo $value['passenger_count']; ?>, <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>, 
                      <?php
					  //print_r($value);
					  $from = get_locations_view($value['from']);
		  	  		  $to = get_locations_view($value['to']);
					  echo "<strong>From:</strong> ".$from['name']." <strong>To:</strong> ".$to['name'];			  
					  ?>
                      </td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php if ($value['child_carseat'] == 'Yes') { echo "<strong>CS:</strong> ".$value['child_carseat'].", "; }; ?><?php if ($value['booster_seat'] == 'Yes') { echo "<strong>BS:</strong> ".$value['booster_seat'].","; }; ?> <?php if ($value['store_stop'] == 'Yes') { echo "<strong>Quick Grocery Stop:</strong> ".$value['store_stop']; }; ?>&nbsp;</td>
                	  <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php 
					  //Check for Return trip to Airport 
					  if (!empty($departure_value)) {
					  echo '<strong>Return</strong>';
					  } else {
					  if (!empty($value['total_amount'])) { echo "$".$value['total_amount']; };
					  }; ?></td>
                    </tr>
                    <tr>
            		  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top" >
                      <?php 
					  if(check_departure($value['from']) || check_arrival($value['from']) || check_departure($value['to']) || check_arrival($value['to'])) { ?>
					  <?php 
					  if (check_arrival($value['from'])) { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	echo "<strong>Depart:</strong> "; 
					  	$departure_data=get_departure_data($value['reservation_id']); 
					  	echo format_to_caldate($departure_data['date']); 
					  	echo " ".format_time($departure_data['time']);
						} 
					  } else { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	echo "<strong>Arrived:</strong> "; 
					  	$arrival_data=get_arrival_data($value['reservation_id']); 
					  	echo format_to_caldate($arrival_data['date']);
					  	echo " ".format_time($arrival_data['time']);
						}
					  };  ?><? } else { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	//echo "<strong>Arrived:</strong> "; echo format_to_caldate($arrival_data[0]['date']);
					  	//echo " ".format_time($arrival_data[0]['time']);  echo "<br>"; echo "<strong>Depart:</strong> "; echo format_to_caldate($departure_data[0]['date']); 
					  	//echo " ".format_time($departure_data[0]['time']); 
						};
					  };
					  ?>
                      &nbsp;
                      </td>
                	  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					  <?php if ($value['paying_cash']) { ?>Please do not charge my credit card. I will be paying cash or traveler check upon arrival.<br /><?php } ?><?php if (!empty($value['customer_comments'])) { echo $value['customer_comments'].'<br />'; }; ?><?php if (!empty($value['cellphone'])) { echo '<strong>Cellphone:</strong> '.$value['cellphone']; }; ?></td>
                      <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					   <?php if ($value['paying_cash']) { ?>Cash<?php } else { ?>Credit Card<?php } ?> <?php if (empty($value['payment_status'])) { echo '<span style="color:#FF0000;">Pending</span>'; } else { if ($value['payment_status'] =='Declined') { echo '<span style="color:#FF0000;">'.$value['payment_status'].'</span>'; } else { echo '<span style="color:#00CC00;">'.$value['payment_status'].'</span>'; }; }; ?><div style="float:right"><?php if ((empty($value['payment_status']) || $value['payment_status'] == 'Declined') && empty($value['paying_cash'])) { echo '<a href="make_single_payment.php?id='.$value['reservation_id'].'" class="menu">Run Credit Card</a>'; }; ?></div></td>
            		</tr>
                    <? 
					} 
					?>
        </table>  
    	</form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS ARRIVALS</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
                    <? echo '<div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>Sorry no reservations found matching your search criteria. <br> Try again or Go back to <a href="reservation_manager.php" class="link1">Reservation Manager</a></strong></div>';  
					?>  
                </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
	
	// Get Departures Result with pages
	function get_departures_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 100;
			} else {
			$display = $_GET['pages'];
			};
			
			if (empty($_GET['orderby2'])) {
			$orderby_sql = " rd.pickup_time ASC";
			} else {
				if ($_GET['orderby2'] == 'time') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " rd.pickup_time ASC";
					} else {
					$orderby_sql = " rd.pickup_time DESC";
					}
				}
				
				if ($_GET['orderby2'] == 'vehicle') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " r.vehicle_id ASC";
					} else {
					$orderby_sql = " r.vehicle_id DESC";
					}
				}
				
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			$todays_date = date('Y-m-d'); 
			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE (rd.to='422' OR rd.to='421' OR rd.to='512') AND rd.pickup_date = '$todays_date' ORDER BY $orderby_sql";
			
			$query_result=mysql_query($query);
			$num_records=@mysql_num_rows($query_result);
			if ($num_records > $display) { // More then 1 page.
			$num_pages = ceil ($num_records/$display);
			} else {
			$num_pages = 1;
			}
			}

			// Determinate where in the database to start returning result.
			if (isset($_GET['s'])) { // Already been determinated.
			$start = $_GET['s'];	
			} else {
			$start = 0;
			}

			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.cellphone, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs, r.payment_status FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE r.status !='11' AND (rd.to='422' OR rd.to='421' OR rd.to='512') AND rd.pickup_date = '$todays_date' ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
						
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="reservation_manager.php" method="get">';
				echo '<table width="100%" style="padding-top:10px;" class="bodytxt">';
				echo '<tr>';
				echo '<td style="padding-left:10px;" class="bodytxt" align="left">';
				echo 'Listings per page ';
            	echo '<select name="pages" class="bodytxt" onchange="this.form.submit();">';
				echo '<option value="'.$display.'">'.$display.'</option>';
            	echo '<option value="10">10</option>';
            	echo '<option value="25">25</option>';
            	echo '<option value="50">50</option>';
            	echo '<option value="75">75</option>';
            	echo '<option value="100">100</option>';
            	echo '</select>';
				echo '</td><td style="padding-left:10px;" class="bodytxt" align="right">';
				echo '<span style="margin-right:10px" class="bodytxt">';
				$current_page = ($start/$display) + 1;
				//If it's not the first page, make a`Previous button.
				if ($current_page != 1) {
				echo '&lt;&lt; <a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS DEPARTURES</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Client, Depart</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?order_by=time&sort=asc" class="link3">Time</a>
					  <?php } else { ?>
                      <a href="index.php?order_by=time&sort=desc" class="link3">Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Passengers, Vehicle, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
            <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					//Shades of Green BG setup BEGIN
					if ($value['from'] == '517' || $value['to'] == '517') {
					//$bgcolor="#335115";
						if (check_departure($value['to']) && $value['trip_type'] !='1') {
						$departure_value='yes';
						//$bgcolor="#ff0000"; 
						} else {
						$departure_value='';
					}
					//Shades of Green BG setup END
					} else {
					$departure_value='';
					if(check_departure($value['from']) || check_arrival($value['from']) || check_departure($value['to']) || check_arrival($value['to'])) { if (check_arrival($value['from'])) { //$bgcolor="#004eff";
					} else { //$bgcolor="#ff0000"; 
					if($value['trip_type'] !='1') { $departure_value='yes'; }; }; ?><? } else { //$bgcolor="#f49502"; 
					};
					};
					$res_destination_data = get_destination_data($value['reservation_id']);
					
					$count_res_destination_data = count($res_destination_data);
					
					$bgcolor='';
					
					if ($count_res_destination_data =='1') {
					$bgcolor="#004eff";
					} else {
						
						//print_r($value);
						//exit;
						
						if ($res_destination_data[0]['id'] == $value['id']) {
						$bgcolor="#004eff";
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#f49502";
						}
						
						if ($count_res_destination_data == 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#ff0000";
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[2]['id'] == $value['id']) {
						$bgcolor="#ff0000";
						}
						
					}
					echo '<tr>';
					?>
                      <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong>Detail</strong><br /><?php echo $value['reservation_id']; ?></a></td>
                	  <td width="25%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>">
                      <?php //if (check_departure($value['id'], $value['location1_id'], $value['location2_id'], $value['location1'], $value['location3'], $value['travel_date_roundtrip'])) { echo "Arrival"; } ; ?>
                      <a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong><?php echo $value['last_name']; ?></strong>, <?php echo $value['first_name']; ?></a><br /><br /><?php $trip_type = get_trip_types_view($value['trip_type']); ?><?php echo $trip_type['name']; ?></td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php
					  
					  
					  echo "<strong>".format_time_admin($value['time'], $value['from'], $value['to'], $value['date'])."</strong>, "; ?><?php if (!empty($value['airline'])) { echo $value['airline']."/" .$value['flight_number']; }; ?>&nbsp;</td>
                      <td width="25%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php echo $value['passenger_count']; ?>, <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>, 
                      <?php
					  //print_r($value);
					  $from = get_locations_view($value['from']);
		  	  		  $to = get_locations_view($value['to']);
					  echo "<strong>From:</strong> ".$from['name']." <strong>To:</strong> ".$to['name'];			  
					  ?>
                      </td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php if ($value['child_carseat'] == 'Yes') { echo "<strong>CS:</strong> ".$value['child_carseat'].", "; }; ?><?php if ($value['booster_seat'] == 'Yes') { echo "<strong>BS:</strong> ".$value['booster_seat'].","; }; ?> <?php if ($value['store_stop'] == 'Yes') { echo "<strong>Quick Grocery Stop:</strong> ".$value['store_stop']; }; ?>&nbsp;</td>
                	  <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php 
					  //Check for Return trip to Airport 
					  if (!empty($departure_value)) {
					  echo '<strong>Return</strong>';
					  } else {
					  if (!empty($value['total_amount'])) { echo "$".$value['total_amount']; };
					  }; ?></td>
                    </tr>
                    <tr>
            		  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top" >
                      <?php 
					  if(check_departure($value['from']) || check_arrival($value['from']) || check_departure($value['to']) || check_arrival($value['to'])) { ?>
					  
					  <?php 
					  if (check_arrival($value['from'])) { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	echo "<strong>Depart:</strong> "; 
					  	$departure_data=get_departure_data($value['reservation_id']); 
					  	echo format_to_caldate($departure_data['date']); 
					  	echo " ".format_time($departure_data['time']);
						} 
					  } else { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
						echo "<strong>Arrived:</strong> "; 
					  	$arrival_data=get_arrival_data($value['reservation_id']); 
					  	echo format_to_caldate($arrival_data['date']);
					  	echo " ".format_time($arrival_data['time']);
						}
					  };  ?><? } else { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	//echo "<strong>Arrived:</strong> "; echo format_to_caldate($arrival_data[0]['date']);
					  	//echo " ".format_time($arrival_data[0]['time']);  echo "<br>"; echo "<strong>Depart:</strong> "; echo format_to_caldate($departure_data[0]['date']); 
					  	//echo " ".format_time($departure_data[0]['time']); 
						};
					  };
					  ?>
                      &nbsp;
                      </td>
                	  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					  <?php if ($value['paying_cash']) { ?>Please do not charge my credit card. I will be paying cash or traveler check upon arrival.<br /><?php } ?><?php if (!empty($value['customer_comments'])) { echo $value['customer_comments'].'<br />'; }; ?><?php if (!empty($value['cellphone'])) { echo '<strong>Cellphone:</strong> '.$value['cellphone']; }; ?></td>
                      <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					   <?php if ($value['paying_cash']) { ?>Cash<?php } else { ?>Credit Card<?php } ?> <?php if (empty($value['payment_status'])) { echo '<span style="color:#FF0000;">Pending</span>'; } else { if ($value['payment_status'] =='Declined') { echo '<span style="color:#FF0000;">'.$value['payment_status'].'</span>'; } else { echo '<span style="color:#00CC00;">'.$value['payment_status'].'</span>'; }; }; ?><div style="float:right"><?php if ((empty($value['payment_status']) || $value['payment_status'] == 'Declined') && empty($value['paying_cash'])) { echo '<a href="make_single_payment.php?id='.$value['reservation_id'].'" class="menu">Run Credit Card</a>'; }; ?></div></td>
            		</tr>
                    <? 
					} 
					?>
        </table>   
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS DEPARTURES</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
                    <? echo '<div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>No Departures Found in the database for today</strong></div>';  
					?> 
                </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
	
	// Get Transfers Result with pages
	function get_transfers_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 100;
			} else {
			$display = $_GET['pages'];
			};
			
			if (empty($_GET['orderby3'])) {
			$orderby_sql = " rd.pickup_time ASC";
			} else {
				if ($_GET['orderby3'] == 'time') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " rd.pickup_time ASC";
					} else {
					$orderby_sql = " rd.pickup_time DESC";
					}
				}
				
				if ($_GET['orderby3'] == 'vehicle') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " r.vehicle_id ASC";
					} else {
					$orderby_sql = " r.vehicle_id DESC";
					}
				}
				
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			$todays_date = date('Y-m-d'); 
			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE (rd.from !='422' AND rd.from !='421' AND rd.from !='512' AND rd.to !='422' AND rd.to !='421' AND rd.to !='512') AND rd.pickup_date = '$todays_date' ORDER BY $orderby_sql";
			
			$query_result=mysql_query($query);
			$num_records=@mysql_num_rows($query_result);
			if ($num_records > $display) { // More then 1 page.
			$num_pages = ceil ($num_records/$display);
			} else {
			$num_pages = 1;
			}
			}

			// Determinate where in the database to start returning result.
			if (isset($_GET['s'])) { // Already been determinated.
			$start = $_GET['s'];	
			} else {
			$start = 0;
			}

			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.cellphone, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs, r.payment_status FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE r.status !='11' AND (rd.from !='422' AND rd.from !='421' AND rd.from !='512' AND rd.to !='422' AND rd.to !='421' AND rd.to !='512') AND rd.pickup_date = '$todays_date' ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
						
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="reservation_manager.php" method="get">';
				echo '<table width="100%" style="padding-top:10px;" class="bodytxt">';
				echo '<tr>';
				echo '<td style="padding-left:10px;" class="bodytxt" align="left">';
				echo 'Listings per page ';
            	echo '<select name="pages" class="bodytxt" onchange="this.form.submit();">';
				echo '<option value="'.$display.'">'.$display.'</option>';
            	echo '<option value="10">10</option>';
            	echo '<option value="25">25</option>';
            	echo '<option value="50">50</option>';
            	echo '<option value="75">75</option>';
            	echo '<option value="100">100</option>';
            	echo '</select>';
				echo '</td><td style="padding-left:10px;" class="bodytxt" align="right">';
				echo '<span style="margin-right:10px" class="bodytxt">';
				$current_page = ($start/$display) + 1;
				//If it's not the first page, make a`Previous button.
				if ($current_page != 1) {
				echo '&lt;&lt; <a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS TRANSFERS</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Client, Depart</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?order_by=time&sort=asc" class="link3">Time</a>
					  <?php } else { ?>
                      <a href="index.php?order_by=time&sort=desc" class="link3">Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Passengers, Vehicle, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
            <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					//Shades of Green BG setup BEGIN
					if ($value['from'] == '517' || $value['to'] == '517') {
					//$bgcolor="#335115";
						if (check_departure($value['to']) && $value['trip_type'] !='1') {
						$departure_value='yes';
						//$bgcolor="#ff0000"; 
						} else {
						$departure_value='';
					}
					//Shades of Green BG setup END
					} else {
					$departure_value='';
					if(check_departure($value['from']) || check_arrival($value['from']) || check_departure($value['to']) || check_arrival($value['to'])) { if (check_arrival($value['from'])) { //$bgcolor="#004eff";
					} else { //$bgcolor="#ff0000"; 
					if($value['trip_type'] !='1') { $departure_value='yes'; }; }; ?><? } else { //$bgcolor="#f49502"; 
					};
					};
					$res_destination_data = get_destination_data($value['reservation_id']);
					
					$count_res_destination_data = count($res_destination_data);
					
					$bgcolor='';
					
					if ($count_res_destination_data =='1') {
					$bgcolor="#004eff";
					} else {
						
						//print_r($value);
						//exit;
						
						if ($res_destination_data[0]['id'] == $value['id']) {
						$bgcolor="#004eff";
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#f49502";
						}
						
						if ($count_res_destination_data == 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#ff0000";
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[2]['id'] == $value['id']) {
						$bgcolor="#ff0000";
						}
						
					}
					echo '<tr>';
					?>
                      <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong>Detail</strong><br /><?php echo $value['reservation_id']; ?></a></td>
                	  <td width="25%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>">
                      <?php //if (check_departure($value['id'], $value['location1_id'], $value['location2_id'], $value['location1'], $value['location3'], $value['travel_date_roundtrip'])) { echo "Arrival"; } ; ?>
                      <a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong><?php echo $value['last_name']; ?></strong>, <?php echo $value['first_name']; ?></a><br /><br /><?php $trip_type = get_trip_types_view($value['trip_type']); ?><?php echo $trip_type['name']; ?></td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php
					  echo "<strong>".format_time_admin($value['time'], $value['from'], $value['to'], $value['date'])."</strong>, "; ?><?php if (!empty($value['airline'])) { echo $value['airline']."/" .$value['flight_number']; }; ?>&nbsp;</td>
                      <td width="25%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php echo $value['passenger_count']; ?>, <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>, 
                      <?php
					  //print_r($value);
					  $from = get_locations_view($value['from']);
		  	  		  $to = get_locations_view($value['to']);
					  echo "<strong>From:</strong> ".$from['name']." <strong>To:</strong> ".$to['name'];			  
					  ?>
                      </td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php if ($value['child_carseat'] == 'Yes') { echo "<strong>CS:</strong> ".$value['child_carseat'].", "; }; ?><?php if ($value['booster_seat'] == 'Yes') { echo "<strong>BS:</strong> ".$value['booster_seat'].","; }; ?> <?php if ($value['store_stop'] == 'Yes') { echo "<strong>Quick Grocery Stop:</strong> ".$value['store_stop']; }; ?>&nbsp;</td>
                	  <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php 
					  //Check for Return trip to Airport 
					  if (!empty($departure_value)) {
					  echo '<strong>Return</strong>';
					  } else {
					  if (!empty($value['total_amount'])) { echo "$".$value['total_amount']; };
					  }; ?></td>
                    </tr>
                    <tr>
            		  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top" >
                      <?php 
					  
					  if(check_departure($value['from']) || check_arrival($value['from']) || check_departure($value['to']) || check_arrival($value['to'])) { ?>
					  <?php if (check_arrival($value['from'])) { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	echo "<strong>Depart:</strong> "; 
					  	$departure_data=get_departure_data($value['reservation_id']); 
					  	echo format_to_caldate($departure_data['date']); 
					  	echo " ".format_time($departure_data['time']);
						} 
					  } else { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	echo "<strong>Arrived:</strong> "; 
					  	$arrival_data=get_arrival_data($value['reservation_id']); 
					  	echo format_to_caldate($arrival_data['date']);
					  	echo " ".format_time($arrival_data['time']);
						}
					  };  ?><? } else { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	//echo "<strong>Arrived:</strong> "; echo format_to_caldate($arrival_data[0]['date']);
					  	//echo " ".format_time($arrival_data[0]['time']);  echo "<br>"; echo "<strong>Depart:</strong> "; echo format_to_caldate($departure_data[0]['date']); 
					  	//echo " ".format_time($departure_data[0]['time']); 
						};
					  };
					  ?>
                      &nbsp;
                      </td>
                	  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					  <?php if ($value['paying_cash']) { ?>Please do not charge my credit card. I will be paying cash or traveler check upon arrival.<br /><?php } ?><?php if (!empty($value['customer_comments'])) { echo $value['customer_comments'].'<br />'; }; ?><?php if (!empty($value['cellphone'])) { echo '<strong>Cellphone:</strong> '.$value['cellphone']; }; ?></td>
                      <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					   <?php if ($value['paying_cash']) { ?>Cash<?php } else { ?>Credit Card<?php } ?> <?php if (empty($value['payment_status'])) { echo '<span style="color:#FF0000;">Pending</span>'; } else { if ($value['payment_status'] =='Declined') { echo '<span style="color:#FF0000;">'.$value['payment_status'].'</span>'; } else { echo '<span style="color:#00CC00;">'.$value['payment_status'].'</span>'; }; }; ?><div style="float:right"><?php if ((empty($value['payment_status']) || $value['payment_status'] == 'Declined') && empty($value['paying_cash'])) { echo '<a href="make_single_payment.php?id='.$value['reservation_id'].'" class="menu">Run Credit Card</a>'; }; ?></div></td>
            		</tr>
                    <? 
					} 
					?>
        </table>  
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS TRANSFERS</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
                    <? echo '<div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>Sorry no tranfers found for today</strong></div>';  
					?>  
                </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
	
	// Get Transfers Result with pages
	function get_future_reservations_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 300;
			} else {
			$display = $_GET['pages'];
			};
			
			if (empty($_GET['order_by2'])) {
			$orderby_sql = " rd.pickup_date ASC, rd.pickup_time ASC";
			} else {
				if ($_GET['order_by2'] == 'name') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " r.first_name ASC";
					} else {
					$orderby_sql = " r.first_name DESC";
					}
				}
				
				
				if ($_GET['order_by2'] == 'id') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " r.id ASC";
					} else {
					$orderby_sql = " r.id DESC";
					}
				}
				
				if ($_GET['order_by2'] == 'date') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " rd.date ASC";
					} else {
					$orderby_sql = " rd.date DESC";
					}
				}
				
				if ($_GET['order_by2'] == 'time') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " rd.pickup_time ASC";
					} else {
					$orderby_sql = " rd.pickup_time DESC";
					}
				}
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			
			
			if (!empty($_GET['from'])) {
			$todays_date = format_date_calendar($_GET['from']);
			} else {
			$todays_date = date('Y-m-d'); 
			}
			
			if (!empty($_GET['to'])) {
			$expiration_date = format_date_calendar($_GET['to']);
			} else {
			$expiration_time = strtotime("+300 days");
			$expiration_date = date("Y-m-d", $expiration_time);
			}
			//print_r($expiration_date);
			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE (rd.pickup_date BETWEEN '$todays_date' AND '$expiration_date') ORDER BY $orderby_sql";
			//print_r($query);
			//exit;
			$query_result=mysql_query($query);
			$num_records=@mysql_num_rows($query_result);
			if ($num_records > $display) { // More then 1 page.
			$num_pages = ceil ($num_records/$display);
			} else {
			$num_pages = 1;
			}
			}

			// Determinate where in the database to start returning result.
			if (isset($_GET['s'])) { // Already been determinated.
			$start = $_GET['s'];	
			} else {
			$start = 0;
			}
			
			if (!empty($_GET['from'])) {
			$todays_date = format_date_calendar($_GET['from']);
			} else {
			$todays_date = date('Y-m-d'); 
			}
			
			if (!empty($_GET['to'])) {
			$expiration_date = format_date_calendar($_GET['to']);
			} else {
			$expiration_time = strtotime("+300 days");
			$expiration_date = date("Y-m-d", $expiration_time);
			}
			
			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.cellphone, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs, r.payment_status FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE r.status !='11' AND (rd.pickup_date BETWEEN '$todays_date' AND '$expiration_date') ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
			//exit;	
					
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="index_search.php" method="get">';
				echo '<table width="100%" style="padding-top:10px;" class="bodytxt">';
				echo '<tr>';
				echo '<td style="padding-left:10px;" class="bodytxt" align="left">';
				echo 'Listings per page ';
            	echo '<select name="pages" class="bodytxt" onchange="this.form.submit();">';
				echo '<option value="'.$display.'">'.$display.'</option>';
            	echo '<option value="10">10</option>';
            	echo '<option value="25">25</option>';
            	echo '<option value="50">50</option>';
            	echo '<option value="75">75</option>';
            	echo '<option value="100">100</option>';
            	echo '</select>';
				echo '</td><td style="padding-left:10px;" class="bodytxt" align="right">';
				echo '<span style="margin-right:10px" class="bodytxt">';
				$current_page = ($start/$display) + 1;
				//If it's not the first page, make a`Previous button.
				if ($current_page != 1) {
				echo '&lt;&lt; <a href="index_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '&from='.$_GET['from'].'&to='.$_GET['to'].'" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="index_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '&from='.$_GET['from'].'&to='.$_GET['to'].'" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="index_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '&from='.$_GET['from'].'&to='.$_GET['to'].'" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>UPCOMING TRANSFERS</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Client, <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?order_by2=date&sort=asc" class="link3">Depart/Arrival Date<?php } else { ?>
                      <a href="index.php?order_by2=date&sort=desc" class="link3">Depart/Arrival Date</a>
					  <?php } ?></strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?order_by2=time&sort=asc" class="link3">Time</a>
					  <?php } else { ?>
                      <a href="index.php?order_by2=time&sort=desc" class="link3">Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Passengers, Vehicle, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
            <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					//Shades of Green BG setup BEGIN
					if ($value['from'] == '517' || $value['to'] == '517') {
					//$bgcolor="#335115";
						if (check_departure($value['to']) && $value['trip_type'] !='1') {
						$departure_value='yes';
						//$bgcolor="#ff0000"; 
						} else {
						$departure_value='';
					}
					//Shades of Green BG setup END
					} else {
					$departure_value='';
					if(check_departure($value['from']) || check_arrival($value['from']) || check_departure($value['to']) || check_arrival($value['to'])) { if (check_arrival($value['from'])) { //$bgcolor="#004eff";
					} else { //$bgcolor="#ff0000"; 
					if($value['trip_type'] !='1') { $departure_value='yes'; }; }; ?><? } else { //$bgcolor="#f49502"; 
					};
					};
					$res_destination_data = get_destination_data($value['reservation_id']);
					
					$count_res_destination_data = count($res_destination_data);
					
					$bgcolor='';
					
					if ($count_res_destination_data =='1') {
					$bgcolor="#004eff";
					} else {
						
						//print_r($value);
						//exit;
						
						if ($res_destination_data[0]['id'] == $value['id']) {
						$bgcolor="#004eff";
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#f49502";
						}
						
						if ($count_res_destination_data == 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#ff0000";
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[2]['id'] == $value['id']) {
						$bgcolor="#ff0000";
						}
						
					}
					echo '<tr>';
					?>
                      <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong>Detail</strong><br /><?php echo $value['reservation_id']; ?></a></td>
                	  <td width="25%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>">
                      <?php //if (check_departure($value['id'], $value['location1_id'], $value['location2_id'], $value['location1'], $value['location3'], $value['travel_date_roundtrip'])) { echo "Arrival"; } ; ?>
                      <a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong><?php echo $value['last_name']; ?></strong>, <?php echo $value['first_name']; ?></a><br /><br /><?php $trip_type = get_trip_types_view($value['trip_type']); ?><?php echo $trip_type['name']; ?></td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php
					  echo "<strong>".format_time_admin($value['time'], $value['from'], $value['to'], $value['date'])."</strong>, "; ?>
                	    <?php if (!empty($value['airline'])) { echo $value['airline']."/" .$value['flight_number']; }; ?>                	    &nbsp;</td>
                      <td width="25%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php echo $value['passenger_count']; ?>, <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>, 
                      <?php
					  //print_r($value);
					  $from = get_locations_view($value['from']);
		  	  		  $to = get_locations_view($value['to']);
					  echo "<strong>From:</strong> ".$from['name']." <strong>To:</strong> ".$to['name'];			  
					  ?>                      </td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php if ($value['child_carseat'] == 'Yes') { echo "<strong>CS:</strong> ".$value['child_carseat'].", "; }; ?><?php if ($value['booster_seat'] == 'Yes') { echo "<strong>BS:</strong> ".$value['booster_seat'].","; }; ?> <?php if ($value['store_stop'] == 'Yes') { echo "<strong>Quick Grocery Stop:</strong> ".$value['store_stop']; }; ?>&nbsp;</td>
                	  <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php 
					  //Check for Return trip to Airport 
					  if (!empty($departure_value)) {
					  echo '<strong>Return</strong>';
					  } else {
					  if (!empty($value['total_amount'])) { echo "$".$value['total_amount']; };
					  }; ?></td>
                    </tr>
                    <tr>
            		  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top" >
                     <?php
					 echo "<strong>Transfer Date:</strong> "; 
					 echo format_to_caldate($value['date']);
					 echo "<br>";
					 ?>
                      <?php 
					  // Check for Airport locations
					  if(check_departure($value['from']) || check_arrival($value['from']) || check_departure($value['to']) || check_arrival($value['to'])) { ?>
					  
					  <?php 
					  // Check for Arrivals
					  if (check_arrival($value['from'])) { 
					  	// Check for Trip Type with more than 1 leg
					  	if ($value['num_legs'] > 1) {
					  	echo "<strong>Depart:</strong> "; 
					  	$departure_data=get_departure_data($value['reservation_id']); 
					  	echo format_to_caldate($departure_data['date']); 
					  	echo " ".format_time($departure_data['time']);
						} 
					  } else { 
					  	// For Departures
						if ($value['num_legs'] > 1) {
					  	echo "<strong>Arrived:</strong> "; 
					  	$arrival_data=get_arrival_data($value['reservation_id']); 
					  	echo format_to_caldate($arrival_data['date']);
					  	echo " ".format_time($arrival_data['time']);
						}
					  };  ?><? } else { 
					  	// Info for Transfers
						if ($value['num_legs'] > 1) {
					  	//echo "<strong>Arrived:</strong> "; echo format_to_caldate($arrival_data[0]['date']);
					  	//echo " ".format_time($arrival_data[0]['time']);  echo "<br>"; echo "<strong>Depart:</strong> "; echo format_to_caldate($departure_data[0]['date']); 
					  	//echo " ".format_time($departure_data[0]['time']); 
						};
					  }; ?>
&nbsp;                      </td>
                	  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					  <?php if ($value['paying_cash']) { ?>Please do not charge my credit card. I will be paying cash or traveler check upon arrival.<br /><?php } ?><?php if (!empty($value['customer_comments'])) { echo $value['customer_comments'].'<br />'; }; ?><?php if (!empty($value['cellphone'])) { echo '<strong>Cellphone:</strong> '.$value['cellphone']; }; ?></td>
                      <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					   <?php if ($value['paying_cash']) { ?>Cash<?php } else { ?>Credit Card<?php } ?> <?php if (empty($value['payment_status'])) { echo '<span style="color:#FF0000;">Pending</span>'; } else { if ($value['payment_status'] =='Declined') { echo '<span style="color:#FF0000;">'.$value['payment_status'].'</span>'; } else { echo '<span style="color:#00CC00;">'.$value['payment_status'].'</span>'; }; }; ?><div style="float:right"><?php if ((empty($value['payment_status']) || $value['payment_status'] == 'Declined') && empty($value['paying_cash'])) { echo '<a href="make_single_payment.php?id='.$value['reservation_id'].'" class="menu">Run Credit Card</a>'; }; ?></div></td>
            		</tr>
                    <? 
					} 
					?>
        </table>    
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>UPCOMING TRANSFERS</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
                    <? echo '<div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>Sorry no upcoming transfers found in the database.</strong></div>';  
					?> 
                </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
	
	//Check Reservation 1 Week before - Changed to 2 days before
	function check_reservation_before($date){
	$before = '2';
		$time = strtotime('+'.$before.' days');
		$send_date = date("Y-m-d", $time);
		if ($send_date != $date) {
		return false;
		} else {
		return true;
		}
	}
	
	//Check Reservation today
	function check_reservation_today($date){
		//$time = strtotime('+'.$before.' days');
		$today_date = date("Y-m-d");
		if ($today_date != $date) {
		return false;
		} else {
		return true;
		}
	}

		
	//Check Reservation 1 Week after - Changed to Todays date
	function check_reservation_after($date1, $date2){
	if ($date2 == '0000-00-00') {
	$date = $date1;
	} else {
	$date = $date2;
	}
	
	$after = '7';
		$time = strtotime('-'.$after.' days');
		//$send_date = date("Y-m-d", $time);
		$today_date = date("Y-m-d");
		if ($today_date != $date) {
		return false;
		} else {
		return true;
		}
	}
	
	// Get current Reservation
	function get_reservation_view($id){
		global $db;
			$get_reservation_view_sql = "SELECT * FROM reservations where id='$id'";
			if(!$result = $db->select($get_reservation_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	//Check Reservation
	function check_reservation($date){
		$company_info = get_company_info();
		$before = $company_info['minimum_time'];
		$time = strtotime('+'.$before.' days');
		$send_date = date("Y-m-d", $time);
		
		if ($send_date != $date) {
		return false;
		} else {
		return true;
		}
	}
	
	// Get Reservations Details
	function get_all_reservation_details($reservation_id){
		global $db;
			$get_all_reservation_details_sql = "SELECT * FROM reservation_details WHERE reservation_id='$reservation_id' ORDER BY date ASC";
			if(!$result = $db->select($get_all_reservation_details_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_details[] = $data;
				return $all_details;
			}
	}
	
?>