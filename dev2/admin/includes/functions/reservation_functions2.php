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
					if (check_arrivals_new($arrival_data['from'], $arrival_data['to'])) {
					return $arrival_data;
					}
			}
	}
	
	//Get Destination Data
	function get_destination_data($reservation_id){
		global $db;
			$get_destination_data_sql = "SELECT * FROM reservation_details WHERE reservation_id='$reservation_id' ORDER BY date, time ASC";

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
			$get_reservations_reports_sql = "SELECT * FROM reservations WHERE reservation_date BETWEEN '$from' AND '$to'  ORDER BY id DESC";
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
	
	//Format Exp Date
	function format_exp_date($date){
		$newdate = substr($date, 0,10);
		$date_array = explode("/", $newdate);
		$newdate = $date_array;
		return $newdate;
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
			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.admin_comments, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE (rd.pickup_date BETWEEN '$todays_date' AND '$expiration_date') ORDER BY $orderby_sql";
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
			
			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.pickup_time, rd.pickup_date, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.admin_comments, r.cellphone, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs, r.payment_status FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE r.status !='11' AND (rd.pickup_date BETWEEN '$todays_date' AND '$expiration_date') ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
			//exit;	
					
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="drivers_schedule_search.php" method="get">';
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
				echo '&lt;&lt; <a href="drivers_schedule_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '&from='.$_GET['from'].'&to='.$_GET['to'].'" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="drivers_schedule_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '&from='.$_GET['from'].'&to='.$_GET['to'].'" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="drivers_schedule_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '&from='.$_GET['from'].'&to='.$_GET['to'].'" class="bodytxt">next</a> &gt;&gt;';
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
                  <td  align="center" height="20" valign="top"><strong>Schedule <?php if (!empty($_GET['from'])) { echo $_GET['from'];}; if (!empty($_GET['to'])) { echo ' - '.$_GET['to']; }; ?></strong></td><br/>
                  <td align="left" height="20" valign="top">
                  <!--<form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>-->
                  </td>
                </tr>
              </tbody></table></td>
          </tr>
          <tr>
          	<td>
    <form name="drivers_schedule_search" method="post" action="drivers_schedule_search.php?from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>">        
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="21%" bgcolor="#ffffcc" class="ob"><strong>Client, <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index2.php?order_by2=date&sort=asc" class="link3">Depart/Arrival Date<?php } else { ?>
                      <a href="index2.php?order_by2=date&sort=desc" class="link3">Depart/Arrival Date</a>
					  <?php } ?></strong></td>
                <td width="22%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index2.php?order_by2=time&sort=asc" class="link3">Time</a>
					  <?php } else { ?>
                      <a href="index2.php?order_by2=time&sort=desc" class="link3">Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="27%" bgcolor="#ffffcc" class="ob"><strong>Passengers, Vehicle, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
            <?php 
					$count_res='0';	
					$res_info='';
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
						
		// flag to determine if reservation detail is the final leg
		$flag_final_leg = false;
		$flag_transfer_leg = false;
		
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
							if ($value['trip_type'] != '1') {
								// this trip is a transfer leg
								$flag_transfer_leg = true;
							}
						}
						
						if ($count_res_destination_data == 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#ff0000";
							if ($value['trip_type'] != '1') {
								// this trip is the final leg
								$flag_final_leg = true;
							}
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[2]['id'] == $value['id']) {
						$bgcolor="#ff0000";
							if ($value['trip_type'] != '1') {
								// this trip is the final leg
								$flag_final_leg = true;
							}
						}
						
					}
					
					echo '<tr>';
					?>
                      <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong>Detail</strong><br /><?php echo $value['reservation_id']; ?></a></td>
                	  <td width="21%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>">
                      
                      <?php //if (check_departure($value['id'], $value['location1_id'], $value['location2_id'], $value['location1'], $value['location3'], $value['travel_date_roundtrip'])) { echo "Arrival"; } ; ?>
                      <a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong><?php echo $value['last_name']; ?></strong>, <?php echo $value['first_name']; ?></a><br />
                      
                      <?php
                      $client_name = $value['first_name'].' '.$value['last_name'];
					  
					  $time = format_time($value['pickup_time']);
					  $date = format_to_caldate($value['pickup_date']);
					  
					  $passenger_count = $value['passenger_count'];
					  ?>
                      <input name="client_name<?php echo $count_res; ?>" type="hidden" value="<?php echo $client_name; ?>" />
                      <input name="time<?php echo $count_res; ?>" type="hidden" value="<?php echo $time; ?>" />
                      <input name="date<?php echo $count_res; ?>" type="hidden" value="<?php echo $date; ?>" />
                      <input name="passenger_count<?php echo $count_res; ?>" type="hidden" value="<?php echo $passenger_count; ?>" />
                      
                      
                      <br /><?php $trip_type = get_trip_types_view($value['trip_type']); ?><?php echo $trip_type['name']; ?></td>
                	  <td width="22%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php
					  echo "<strong>".format_time_admin($value['time'], $value['from'], $value['to'], $value['date'])."</strong>, "; ?>
                	    <?php if (!empty($value['airline'])) { echo $value['airline']."/" .$value['flight_number']; }; ?>                	    &nbsp;</td>
                      <td width="27%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php echo $value['passenger_count']; ?>, <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>, 
                      <?php
					  //print_r($value);
					  $from = get_locations_view($value['from']);
		  	  		  $to = get_locations_view($value['to']);
					  echo "<strong>From:</strong> ".$from['name']." <strong>To:</strong> ".$to['name'];			  
					  
					  
					  $from = $from['name'];
					  $to = $to['name'];
					  
					  
					  ?>     
                      <input name="from<?php echo $count_res; ?>" type="hidden" value="<?php echo $from; ?>" />
                      <input name="to<?php echo $count_res; ?>" type="hidden" value="<?php echo $to; ?>" />
                                       </td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php if ($value['child_carseat'] == 'Yes') { echo "<strong>CS:</strong> ".$value['child_carseat'].", "; }; ?><?php if ($value['booster_seat'] == 'Yes') { echo "<strong>BS:</strong> ".$value['booster_seat'].","; }; ?> <?php if ($value['store_stop'] == 'Yes') { echo "<strong>Quick Grocery Stop:</strong> ".$value['store_stop']; }; ?>&nbsp;</td>
                	  <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php 
					  //Check for Return trip to Airport 
					  $pp='';
					  $cc='';
					  $cash='';
					  
					  
						// MODIFIED 2012-10-20
						if ( ! empty($departure_value) || $flag_final_leg == true) {
							
							print '<strong>Return</strong>';
							$pp = 'Yes';
						} 
						elseif ($flag_transfer_leg == true) {
							print '<strong>Transfer</strong>';
						}
						else {
							if ( ! empty($value['total_amount'])) {
								
								print '$' . $value['total_amount'];
								$pp = 'No';
							}
						} // end MOD

					  
					  if ($value['paying_cash']) {
					  
					  $cc = $value['total_amount'];
					  
					  } else {
					  $cash = $value['total_amount'];
					  }
					  ?>
                       <input name="pp<?php echo $count_res; ?>" type="hidden" value="<?php echo $pp; ?>" />
                       <input name="cc<?php echo $count_res; ?>" type="hidden" value="<?php echo $cc; ?>" />
                       <input name="cash<?php echo $count_res; ?>" type="hidden" value="<?php echo $cash; ?>" />
                      
                      </td>
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
							$departure_data=get_departure_data($value['reservation_id']); 
							if ( ! empty($departure_data)) {
								echo "<strong>Depart:</strong> "; 
								echo format_to_caldate($departure_data['date']); 
								echo " ".format_time($departure_data['time']);
							}
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
						 echo "<strong>Depart Date:</strong> "; 
						 echo format_to_caldate($value['date']);
					  }; ?>
&nbsp;                      </td>
                	  <td bgcolor="#FFFFFF" colspan="1" class="ob" valign="top">
					  <?php if ($value['paying_cash']) {
					  
					  $res_info[]['cc'] = 'No';
					  
					   ?><!--Please do not charge my credit card. I will be paying cash or traveler check upon arrival.<br />--><?php } ?><?php if (!empty($value['customer_comments'])) { echo '<strong>Customer Comments:</strong> '.$value['customer_comments'].'<br />'; }; ?><?php if (!empty($value['admin_comments'])) { '<strong>Admin Comments:</strong> '.$value['admin_comments'].'<br />'; }; ?><?php if (!empty($value['cellphone'])) { echo '<strong>Cellphone:</strong> '.$value['cellphone']; }; ?></td>
                      <td bgcolor="#FFFFFF" colspan="1" class="ob" valign="top">
                    <!-- <form name="driverfrm<?php echo $value['id']; ?>" target="_blank" method="post" action="assign_driver.php">-->
                    <input type="hidden" value="<?php echo $value['reservation_id']; ?>" name="reservation_id[]" />
                    <input type="hidden" value="<?php echo $value['id']; ?>" name="res_details_id[]" />
					<!--<input type="hidden" value="submit_driver" name="action" />-->
       				 Driver's Name&nbsp;
        			<select name="drivers_id[]">
                    <option selected="selected" value="<?php $drivers_id = get_drivers_id($value['id']); echo $drivers_id[0]['drivers_id'];?>"><?php $driver = get_driver_view($drivers_id[0]['drivers_id']);  echo ucfirst($driver['first_name']). " " . ucfirst($driver['last_name']); if(!$driver){echo "None";}?></option>
                    <?php if($driver) echo '<option value="">None</option>';?>
                      <?php 
					 	$counter =0; $all_drivers=get_all_drivers(); 
                         
                         while($counter < count($all_drivers))
                         {
                        
                                /**
                                 * @edited  11.29.13
                                 * @dev     Martin Garcia
                                 */
                                //only displays active drivers
                                if($all_drivers[$counter]["status"] == 3)
                                {
								    echo '<option value="'.$all_drivers[$counter]["id"].'">'.ucfirst($all_drivers[$counter]["first_name"]) .' '. ucfirst($all_drivers[$counter]["last_name"]) .'</option>';
								    echo $all_drivers[$counter]["id"];
								}
                                /**
                                 * END EDIT
                                 */
                                
                                
                                $counter++;
					   } 
					?>
                    </select><br/>Do you want the driver to by notified?
     				<input type="checkbox" name="notify_driver<?php echo $count_res; ?>" value="yes"<?php if($drivers_id[0]['notify_driver'] == 'yes') echo'checked="checked"';?>/>&nbsp;&nbsp;&nbsp;
                   
                    <!--<input type="submit" value="Assign Driver" onclick="return assign_driver(driverfrm<?php echo $value['id']; ?>.reservation_id.value, driverfrm<?php echo $value['id']; ?>.res_details_id.value, driverfrm<?php echo $value['id']; ?>.drivers_id.value, driverfrm<?php echo $value['id']; ?>.notify_driver.value);" />-->
                    <!--</form>--></td>
                      <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					   <?php if ($value['paying_cash']) { ?>Cash<?php } else { ?>Credit Card<?php } ?> <?php if (empty($value['payment_status'])) { echo '<span style="color:#FF0000;">Pending</span>'; } else { if ($value['payment_status'] =='Declined') { echo '<span style="color:#FF0000;">'.$value['payment_status'].'</span>'; } else { echo '<span style="color:#00CC00;">'.$value['payment_status'].'</span>'; }; }; ?><div style="float:right"><?php if ((empty($value['payment_status']) || $value['payment_status'] == 'Declined') && empty($value['paying_cash'])) { echo '<a href="make_single_payment.php?id='.$value['reservation_id'].'" class="menu">Run Credit Card</a>'; }; ?></div></td>
            		</tr>
                    <? 
									$count_res++;
					} 
					?>
        </table>
        <div style="width:100%; padding-top:10px;" align="right">
        <input type="image" src="images/assign_drivers.jpg" name="assign_drivers" value="Assign Drivers" />
        </div>
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
	function get_future_reservations_with_pages_print(){
		global $db;
		// payments place holder
		$payments = array('cash' => 0, 'credit_card' => 0, 'total' => 0);
		
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
			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.admin_comments, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE (rd.pickup_date BETWEEN '$todays_date' AND '$expiration_date') ORDER BY $orderby_sql";
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
			
			$query = "SELECT rd.id, rd.reservation_id, rd.time, rd.pickup_time, rd.pickup_date, rd.airline, rd.flight_number, rd.date, rd.store_stop, rd.from, rd.to, rd.transfer_type, r.client_id, r.vehicle_id, r.passenger_count, r.child_carseat, r.booster_seat, r.trip_type, r.first_name, r.last_name, r.address, r.address2, r.city, r.state, r.zip, r.country, r.email, r.first_name_billing, r.last_name_billing, r.address_billing, r.address2_billing, r.city_billing, r.state_billing, r.zip_billing, r.country_billing, r.total_amount, r.status, r.customer_comments, r.admin_comments, r.cellphone, r.admin_comments, r.paying_cash, r.store_stop, r.ip_address, t.num_legs, r.payment_status FROM reservation_details rd INNER JOIN reservations r ON rd.reservation_id = r.id INNER JOIN trip_types t ON r.trip_type = t.id WHERE r.status !='11' AND (rd.pickup_date BETWEEN '$todays_date' AND '$expiration_date') ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
			//exit;	
					
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="drivers_schedule_search.php" method="get">';
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
				echo '&lt;&lt; <a href="drivers_schedule_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '&from='.$_GET['from'].'&to='.$_GET['to'].'" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="drivers_schedule_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '&from='.$_GET['from'].'&to='.$_GET['to'].'" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="drivers_schedule_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '&from='.$_GET['from'].'&to='.$_GET['to'].'" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>

              <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tbody><tr>
                  <td  align="center" height="20" valign="top"><strong>Schedule <?php if (!empty($_GET['from'])) { echo $_GET['from'];}; if (!empty($_GET['to'])) { echo ' - '.$_GET['to']; }; ?></strong></td><br/>
                  <td align="left" height="20" valign="top">
                  <!--<form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option><option value="phone_number">Phone Number</option><option value="cellphone">Mobile Phone</option><option value="payment_status">Payment Status</option><option value="approval_code">Gateway Response</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>-->
                  </td>
                </tr>
              </tbody></table>       
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="21%" bgcolor="#ffffcc" class="ob"><strong>Client, Depart/Arrival Date</strong></td>
                <td width="22%" bgcolor="#ffffcc" class="ob"><strong>Time, Airline/Flight #</strong></td>
                <td width="27%" bgcolor="#ffffcc" class="ob"><strong>Passengers, Vehicle, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
            <?php 
					$total_for_reservations ='0';
					$count_res='0';	
					$res_info='';
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
						
						
		// flag to determine if reservation detail is the final leg
		$flag_final_leg = false;
		$flag_transfer_leg = false;
		
					
					//Shades of Green BG setup BEGIN
					if ($value['from'] == '517' || $value['to'] == '517'
						|| $value['from'] == '525' || $value['to'] == '525') {
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
					if($value['trip_type'] !='1') { 
						$departure_value='yes'; 
					}; }; ?><? } else { //$bgcolor="#f49502"; 
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
							if ($value['trip_type'] != '1') {
								// this trip is a transfer leg
								$flag_transfer_leg = true;
							}
						}
						
						if ($count_res_destination_data == 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#ff0000";
							if ($value['trip_type'] != '1') {
								// this trip is the final leg
								$flag_final_leg = true;
							}
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[2]['id'] == $value['id']) {
						$bgcolor="#ff0000";
							if ($value['trip_type'] != '1') {
								// this trip is the final leg
								$flag_final_leg = true;
							}
						}
						
					}
					
					echo '<tr>';
					?>
                      <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong>Detail</strong><br /><?php echo $value['reservation_id']; ?></a></td>
                	  <td width="21%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>">
                      <a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" style="color:<?php echo $bgcolor; ?>"><strong><?php echo $value['last_name']; ?></strong>, <?php echo $value['first_name']; ?></a><br />
                      
                      <?php
                      $client_name = $value['first_name'].' '.$value['last_name'];
					  
					  $time = format_time($value['pickup_time']);
					  $date = format_to_caldate($value['pickup_date']);
					  
					  $passenger_count = $value['passenger_count'];
					  ?>
                      
                      
                      <?php $trip_type = get_trip_types_view($value['trip_type']); ?><?php echo $trip_type['name']; ?></td>
                	  <td width="22%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php
					  echo "<strong>".format_time_admin($value['time'], $value['from'], $value['to'], $value['date'])."</strong>, "; ?>
                	    <?php if (!empty($value['airline'])) { echo $value['airline']."/" .$value['flight_number']; }; ?>                	    &nbsp;</td>
                      <td width="27%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php echo $value['passenger_count']; ?>, <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>, 
                      <?php
					  //print_r($value);
					  $from = get_locations_view($value['from']);
		  	  		  $to = get_locations_view($value['to']);
					  echo "<strong>From:</strong> ".$from['name']." <strong>To:</strong> ".$to['name'];			  
					  
					  
					  $from = $from['name'];
					  $to = $to['name'];
					  
					  
					  ?>     
                                       </td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php if ($value['child_carseat'] == 'Yes') { echo "<strong>CS:</strong> ".$value['child_carseat'].", "; }; ?><?php if ($value['booster_seat'] == 'Yes') { echo "<strong>BS:</strong> ".$value['booster_seat'].","; }; ?> <?php if ($value['store_stop'] == 'Yes') { echo "<strong>Quick Grocery Stop:</strong> ".$value['store_stop']; }; ?>&nbsp;</td>
                	  <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php 

					  //Check for Return trip to Airport 
					  $pp='';
					  $cc='';
					  $cash='';
					  if ($value['paying_cash']) {
					  
					  $cc = $value['total_amount'];
					  
					  } else {
					  $cash = $value['total_amount'];
					  }
						// MODIFIED 2012-10-20
						if ( ! empty($departure_value) || $flag_final_leg == true) {
							
							print '<strong>Return</strong>';
							$pp = 'Yes';
						} 
						elseif ($flag_transfer_leg == true) {
							print '<strong>Transfer</strong>';
						}
						else {
							if ( ! empty($value['total_amount'])) {
								
								print '$' . $value['total_amount'];
								$total_for_reservations += $value['total_amount'];
								$pp = 'No';
								
								// calculate total amount, cash amount and
								// credit card amount
								$payments['total'] += $value['total_amount'];
								if (strtolower(trim($value['paying_cash'])) == 'yes') {
									$payments['cash'] += $value['total_amount'];
								}
								else {
									$payments['credit_card'] += $value['total_amount'];
								}
							}
						} // end MOD
					  ?>
                      
                      </td>
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
							$departure_data=get_departure_data($value['reservation_id']); 
							if ( ! empty($departure_data)) {
								echo "<strong>Depart:</strong> "; 
								echo format_to_caldate($departure_data['date']); 
								echo " ".format_time($departure_data['time']);
							}
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
						 echo "<strong>Depart Date:</strong> "; 
						 echo format_to_caldate($value['date']);
					  }; ?>
&nbsp;                      </td>
                	  <td bgcolor="#FFFFFF" colspan="1" class="ob" valign="top">
					  <?php if ($value['paying_cash']) {
					  
					  $res_info[]['cc'] = 'No';
					  
					   ?><!--Please do not charge my credit card. I will be paying cash or traveler check upon arrival.<br /> //--><?php } ?><?php if (!empty($value['customer_comments'])) { echo '<strong>Customer Comments:</strong> '.$value['customer_comments'].'<br />'; }; ?><?php if (!empty($value['admin_comments'])) { '<strong>Admin Comments:</strong> '.$value['admin_comments'].'<br />'; }; ?><?php if (!empty($value['cellphone'])) { echo '<strong>Cellphone:</strong> '.$value['cellphone']; }; ?></td>
                      <td bgcolor="#FFFFFF" colspan="1" class="ob" valign="top">&nbsp;
                      </td>
                      <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					   <?php if ($value['paying_cash']) { ?>Cash<?php } else { ?>Credit Card<?php } ?> <?php if (empty($value['payment_status'])) { echo '<span style="color:#FF0000;">Pending</span>'; } else { if ($value['payment_status'] =='Declined') { echo '<span style="color:#FF0000;">'.$value['payment_status'].'</span>'; } else { echo '<span style="color:#00CC00;">'.$value['payment_status'].'</span>'; }; }; ?><div style="float:right"><?php if ((empty($value['payment_status']) || $value['payment_status'] == 'Declined') && empty($value['paying_cash'])) { echo '<a href="make_single_payment.php?id='.$value['reservation_id'].'" class="menu">Run Credit Card</a>'; }; ?></div>
                     <br />
       				 Driver's Name: <strong><?php $drivers_id = get_drivers_id($value['id']);?><?php $driver = get_driver_view($drivers_id[0]['drivers_id']); if (!empty($driver)) { echo ucfirst($driver['first_name']). " " . ucfirst($driver['last_name']); } else { echo "None";} ?></strong>
                       </td>
            		</tr>
                    <? 
									$count_res++;
					} 
					?>
        </table>    
        

        <?php if ( ! isset($_SESSION['user_details']) || $_SESSION['user_details']['user_id'] == '1') : // begin display totals
		?>
         <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              	<td width="50%" valign="middle" align="left">&nbsp;
                
                </td>
                <td width="50%" valign="middle" align="right">
                    <strong>Cash:</strong> $<?php print number_format($payments['cash'], 2); ?>
                    <br>
                    <strong>Credit Card:</strong> $<?php print number_format($payments['credit_card'], 2); ?>
                    <br>
                    <strong>Total:</strong> <?php echo '$'.number_format($total_for_reservations, 2, '.', ','); ?>
                </td>
              </tr>
              </table>   
        <?php endif; // end display totals ?>
        
              
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
	
	
	// Assign Drivers
	function assign_drivers_by_iws($reservation_id, $res_details_id, $drivers_id, $notify_driver)
		{
		global $db;
		$count =0;
		
		//print_r($_POST);
		//exit;
		
		while($count < count($reservation_id))
		{
			
		submit_driver($res_details_id[$count], $reservation_id[$count], $drivers_id[$count], $_POST['notify_driver'.$count], $_POST['client_name'.$count], $_POST['time'.$count], $_POST['date'.$count], $_POST['passenger_count'.$count], $_POST['from'.$count], $_POST['to'.$count], $_POST['pp'.$count], $_POST['cc'.$count], $_POST['cash'.$count]);	
		
				$count++;
				
		}

		return true;
	}
	
	
	
	
	
	
	// Get Transfers Result with pages
	function get_future_reservations_trip_sheet_with_pages_print() {
		global $db;
		
		$date_from = (isset($_GET['from']) ? $_GET['from'] : '');
		$date_to = (isset($_GET['to']) ? $_GET['to'] : '');
		$the_drivers_id = (isset($_GET['drivers_id']) ? $_GET['drivers_id'] : '');
		
		if (empty($the_drivers_id))
		{
			print '<h4 align="center">Please select a driver to view details.</h4>';
			return false;
		}
		
		// payments place holder
		$payments = array('cash' => 0, 'credit_card' => 0, 'total' => 0);
		
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
			
			
			if (!empty($date_from)) {
			$todays_date = format_date_calendar($date_from);
			} else {
			$todays_date = date('Y-m-d'); 
			}
			
			if (!empty($date_to)) {
			$expiration_date = format_date_calendar($date_to);
			} else {
			$expiration_time = strtotime("+300 days");
			$expiration_date = date("Y-m-d", $expiration_time);
			}
			//print_r($expiration_date);
			$query = "SELECT
										rd.id,
										rd.reservation_id,
										rd.time,
										rd.airline,
										rd.flight_number,
										rd.date,
										rd.store_stop,
										rd.from,
										rd.to,
										rd.transfer_type,
										rd.drivers_id,
										r.client_id,
										r.vehicle_id,
										r.passenger_count,
										r.child_carseat,
										r.booster_seat,
										r.trip_type,
										r.first_name,
										r.last_name,
										r.address,
										r.address2,
										r.city,
										r.state,
										r.zip,
										r.country,
										r.email,
										r.first_name_billing,
										r.last_name_billing,
										r.address_billing,
										r.address2_billing,
										r.city_billing,
										r.state_billing,
										r.zip_billing,
										r.country_billing,
										r.total_amount,
										r.status,
										r.customer_comments,
										r.admin_comments,
										r.admin_comments,
										r.paying_cash,
										r.store_stop,
										r.ip_address,
										t.num_legs
					FROM reservation_details rd
					INNER JOIN reservations r ON rd.reservation_id = r.id
					INNER JOIN trip_types t ON r.trip_type = t.id 
					WHERE rd.drivers_id = $the_drivers_id
					AND (rd.pickup_date BETWEEN '$todays_date' AND '$expiration_date') 
					ORDER BY $orderby_sql";
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
			
			if (!empty($date_from)) {
			$todays_date = format_date_calendar($date_from);
			} else {
			$todays_date = date('Y-m-d'); 
			}
			
			if (!empty($date_to)) {
			$expiration_date = format_date_calendar($date_to);
			} else {
			$expiration_time = strtotime("+300 days");
			$expiration_date = date("Y-m-d", $expiration_time);
			}
			
			$query = "SELECT
								rd.id,
								rd.reservation_id,
								rd.time,
								rd.pickup_time,
								rd.pickup_date,
								rd.airline,
								rd.flight_number,
								rd.date,
								rd.store_stop,
								rd.from,
								rd.to,
								rd.transfer_type,
								rd.drivers_id,
								r.client_id,
								r.vehicle_id,
								r.passenger_count,
								r.child_carseat,
								r.booster_seat,
								r.trip_type,
								r.first_name,
								r.last_name,
								r.address,
								r.address2,
								r.city,
								r.state,
								r.zip,
								r.country,
								r.email,
								r.first_name_billing,
								r.last_name_billing,
								r.address_billing,
								r.address2_billing,
								r.city_billing,
								r.state_billing,
								r.zip_billing,
								r.country_billing,
								r.total_amount,
								r.status,
								r.customer_comments,
								r.admin_comments,
								r.cellphone,
								r.admin_comments,
								r.paying_cash,
								r.store_stop,
								r.ip_address,
								t.num_legs,
								r.payment_status 
					FROM reservation_details rd
					INNER JOIN reservations r ON rd.reservation_id = r.id
					INNER JOIN trip_types t ON r.trip_type = t.id
					WHERE rd.drivers_id = $the_drivers_id
					AND r.status !='11'
					AND (rd.pickup_date BETWEEN '$todays_date' AND '$expiration_date')
					ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
			//exit;	
					
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="drivers_schedule_search.php" method="get">';
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
				echo '&lt;&lt; <a href="drivers_schedule_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '&from='.$date_from.'&to='.$date_to.'" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="drivers_schedule_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '&from='.$date_from.'&to='.$date_to.'" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="drivers_schedule_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '&from='.$date_from.'&to='.$date_to.'" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>

                     
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="21%" bgcolor="#ffffcc" class="ob"><strong>Client, Depart/Arrival Date</strong></td>
                <td width="22%" bgcolor="#ffffcc" class="ob"><strong>Time, Airline/Flight #</strong></td>
                <td width="27%" bgcolor="#ffffcc" class="ob"><strong>Passengers, Vehicle, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
            <?php 
					$total_for_reservations ='0';
					$count_res='0';	
					$res_info='';
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
						
		// flag to determine if reservation detail is the final leg
		$flag_final_leg = false;
		$flag_transfer_leg = false;
		
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
							if ($value['trip_type'] != '1') {
								// this trip is a transfer leg
								$flag_transfer_leg = true;
							}
						}
						
						if ($count_res_destination_data == 2 && $res_destination_data[1]['id'] == $value['id']) {
						$bgcolor="#ff0000";
							if ($value['trip_type'] != '1') {
								// this trip is the final leg
								$flag_final_leg = true;
							}
						}
						
						if ($count_res_destination_data > 2 && $res_destination_data[2]['id'] == $value['id']) {
						$bgcolor="#ff0000";
							if ($value['trip_type'] != '1') {
								// this trip is the final leg
								$flag_final_leg = true;
							}
						}
						
					}
					
					echo '<tr>';
					?>
                      <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong>Detail</strong><br /><?php echo $value['reservation_id']; ?></a></td>
                	  <td width="21%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>">
                      <a href="reservation_manager.php?cAction=edit&id=<?php echo $value['reservation_id']; ?>" class="bodytxt" style="color:<?php echo $bgcolor; ?>"><strong><?php echo $value['last_name']; ?></strong>, <?php echo $value['first_name']; ?></a><br />
                      
                      <?php
                      $client_name = $value['first_name'].' '.$value['last_name'];
					  
					  $time = format_time($value['pickup_time']);
					  $date = format_to_caldate($value['pickup_date']);
					  
					  $passenger_count = $value['passenger_count'];
					  ?>
                      
                      
                      <?php $trip_type = get_trip_types_view($value['trip_type']); ?><?php echo $trip_type['name']; ?></td>
                	  <td width="22%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php
					  echo "<strong>".format_time_admin($value['time'], $value['from'], $value['to'], $value['date'])."</strong>, "; ?>
                	    <?php if (!empty($value['airline'])) { echo $value['airline']."/" .$value['flight_number']; }; ?>                	    &nbsp;</td>
                      <td width="27%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php echo $value['passenger_count']; ?>, <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>, 
                      <?php
					  //print_r($value);
					  $from = get_locations_view($value['from']);
		  	  		  $to = get_locations_view($value['to']);
					  echo "<strong>From:</strong> ".$from['name']." <strong>To:</strong> ".$to['name'];			  
					  
					  
					  $from = $from['name'];
					  $to = $to['name'];
					  
					  
					  ?>     
                                       </td>
                	  <td width="20%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php if ($value['child_carseat'] == 'Yes') { echo "<strong>CS:</strong> ".$value['child_carseat'].", "; }; ?><?php if ($value['booster_seat'] == 'Yes') { echo "<strong>BS:</strong> ".$value['booster_seat'].","; }; ?> <?php if ($value['store_stop'] == 'Yes') { echo "<strong>Quick Grocery Stop:</strong> ".$value['store_stop']; }; ?>&nbsp;</td>
                	  <td width="5%" class="ob" valign="top" style="color:<?php echo $bgcolor; ?>"><?php 
					  //Check for Return trip to Airport 
					  $pp='';
					  $cc='';
					  $cash='';
					  if ($value['paying_cash']) {
					  

					  $cc = $value['total_amount'];
					  
					  } else {
					  $cash = $value['total_amount'];
					  }
						// MODIFIED 2012-10-20
						if ( ! empty($departure_value) || $flag_final_leg == true) {
							
							print '<strong>Return</strong>';
							$pp = 'Yes';
						} 
						elseif ($flag_transfer_leg == true) {
							print '<strong>Transfer</strong>';
						}
						else {
							if ( ! empty($value['total_amount'])) {
								
								print '$' . $value['total_amount'];
								$total_for_reservations += $value['total_amount'];
								$pp = 'No';
								
								// calculate total amount, cash amount and
								// credit card amount
								$payments['total'] += $value['total_amount'];
								if (strtolower(trim($value['paying_cash'])) == 'yes') {
									$payments['cash'] += $value['total_amount'];
								}
								else {
									$payments['credit_card'] += $value['total_amount'];
								}
							}
						} // end MOD
					  ?>
                      
                      </td>
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
							$departure_data=get_departure_data($value['reservation_id']); 
							if ( ! empty($departure_data)) {
								echo "<strong>Depart:</strong> "; 
								echo format_to_caldate($departure_data['date']); 
								echo " ".format_time($departure_data['time']);
							}
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
						 echo "<strong>Depart Date:</strong> "; 
						 echo format_to_caldate($value['date']);
					  }; ?>
&nbsp;                      </td>
                	  <td bgcolor="#FFFFFF" colspan="1" class="ob" valign="top">
					  <?php if ($value['paying_cash']) {
					  
					  $res_info[]['cc'] = 'No';
					  
					   ?><!--Please do not charge my credit card. I will be paying cash or traveler check upon arrival.<br /> //--><?php } ?><?php if (!empty($value['customer_comments'])) { echo '<strong>Customer Comments:</strong> '.$value['customer_comments'].'<br />'; }; ?><?php if (!empty($value['admin_comments'])) { '<strong>Admin Comments:</strong> '.$value['admin_comments'].'<br />'; }; ?><?php if (!empty($value['cellphone'])) { echo '<strong>Cellphone:</strong> '.$value['cellphone']; }; ?></td>
                      <td bgcolor="#FFFFFF" colspan="1" class="ob" valign="top">&nbsp;
                      </td>
                      <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">
					   <?php if ($value['paying_cash']) { ?>Cash<?php } else { ?>Credit Card<?php } ?> <?php if (empty($value['payment_status'])) { echo '<span style="color:#FF0000;">Pending</span>'; } else { if ($value['payment_status'] =='Declined') { echo '<span style="color:#FF0000;">'.$value['payment_status'].'</span>'; } else { echo '<span style="color:#00CC00;">'.$value['payment_status'].'</span>'; }; }; ?><div style="float:right"><?php if ((empty($value['payment_status']) || $value['payment_status'] == 'Declined') && empty($value['paying_cash'])) { echo '<a href="make_single_payment.php?id='.$value['reservation_id'].'" class="menu">Run Credit Card</a>'; }; ?></div>
                       </td>
            		</tr>
                    <? 
									$count_res++;
					} 
					?>
        </table>   
        
		
         <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              	<td width="50%" valign="middle" align="left"><h3>Expenses:</h3>
                
                </td>
                <td width="50%" valign="middle" align="right">
                    <strong>Cash:</strong> $<?php print number_format($payments['cash'], 2); ?>
                    <br>
                    <strong>Credit Card:</strong> $<?php print number_format($payments['credit_card'], 2); ?>
                    <br>
                    <strong>Total:</strong> <?php echo '$'.number_format($total_for_reservations, 2, '.', ','); ?>
                    
                </td>
              </tr>
              </table>  
            
                <?php
							
				}
				else
				{
					global $no_trips_flag;
					$no_trips_flag = true;
					print '<h4 align="center">There are no trips for this driver.</h4>';
				}

	} // get_future_reservations_trip_sheet_with_pages_print
?>