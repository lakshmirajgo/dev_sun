<?php
	include("includes/classes/custom_db.php");
	$db = new db_class;
	
	// Get Company Info
	function get_company_info(){
		global $db;
			$get_company_info_sql = "SELECT * FROM settings LIMIT 1";
			if(!$result = $db->select($get_company_info_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Update Settings
	function edit_settings(){
	global $db;
		$edit_settings_sql = "UPDATE settings SET company='".$_POST['company']."', address='".$_POST['address']."', address2='".$_POST['address2']."', city='".$_POST['town']."', state='".$_POST['state']."', zip='".$_POST['zip']."', country='".$_POST['country']."', tollfree='".$_POST['tollfree']."', telephone='".$_POST['telephone']."', fax='".$_POST['fax']."', email='".$_POST['email']."', slogan='".$_POST['slogan']."', home_page_title='".$_POST['home_page_title']."', show_contact='".$_POST['show_contact']."', show_map='".$_POST['show_map']."', map_engine='".$_POST['map_engine']."', minimum_time='".$_POST['minimum_time']."'";
		if(!$result = $db->insert_sql($edit_settings_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	function login($username, $password){
	global $db;
	$login_sql = "Select username, password from users where username='$username' AND password='".md5($password)."'";
			if(!$result = $db->select($login_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				
				if(empty($data)) return false;
				else return true;
			}
	}
	
	function update_password($username, $oldpassword, $newpassword){
		global $db;
		
			$update_pasword = "UPDATE settings SET password = '".md5($newpassword)."', username = '$username'";
		if(!$result = $db->insert_sql($update_pasword)){
			$_SESSION['notice'] = "Database Error: ".$db->last_error;
			return false;			
		}
		else{
			$_SESSION['notice'] = "Password updated successfully";
			
			return true;
		}
	
	}
	
	//Check if a value is a number
	function isNaN($var) {
     return !ereg ("^[-]?[0-9]+([\.][0-9]+)?$", $var);
	}
	
	
	//Validate an Email Address. This function returns true/false is the email passed is correctly formatted
	function check_email_address($email) {
		  // First, we check that there's one @ symbol, and that the lengths are right
		  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
			// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
			return false;
		  }
		  // Split it into sections to make life easier
		  $email_array = explode("@", $email);
		  $local_array = explode(".", $email_array[0]);
		  for ($i = 0; $i < sizeof($local_array); $i++) {
			 if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
			  return false;
			}
		  }  
		  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
			$domain_array = explode(".", $email_array[1]);
			if (sizeof($domain_array) < 2) {
				return false; // Not enough parts to domain
			}
			for ($i = 0; $i < sizeof($domain_array); $i++) {
			  if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
				return false;
			  }
			}
		  }
		  return true;
	}
	
	//Format date
	function format_date_calendar($date){
		$newdate = substr($date, 0,10);
		$date_array = explode("/", $newdate);
		$newdate = $date_array[2] . "-".$date_array[0]."-".$date_array[1];
		return $newdate;
	}
	
	//Format date
	function format_date_calendar2($date){
		$newdate = substr($date, 0,10);
		$date_array = explode("-", $newdate);
		$newdate = $date_array[1] . "/".$date_array[2]."/".$date_array[0];
		return $newdate;
	}
	
	//Format Time
	function format_time($time){
		//$newtime = substr($date, 0,10);
		$time_array = explode(":", $time);
		if ($time_array[0] < '12') {
			if ($time_array[0] == '00' || $time_array[0] == '0') {
			$time_hours = '12';
			} else {
			$time_hours = $time_array[0];
			}
		$time_array[2]="AM"; 
		} else {
			if ($time_array[0] == '12') {
			$time_hours = '12';
			$time_array[2]="PM";
			} else {
			$time_hours = $time_array[0] - 12;
			$time_array[2]="PM";
			}
		};
		$newtime = $time_hours . ":".$time_array[1]." ".$time_array[2];
		return $newtime;
	}
	
	
	//Format Time
	function format_time_admin($time, $from, $to, $org_date){
	
	//print_r($to);
	//exit;
	
	if(check_departure($from) || check_arrival($from) || check_departure($to) || check_arrival($to)) { 
	if (check_arrival($from)) { 
			// For Arrivals
			$time_before='0';
		} else { 
				// For departures from MCO
				if ($to =='421' || $to =='512') {
				$time_before='2';
				} else {
				// For departures from Sanford
				$time_before='3';
				}
			}; 
	} else { 
	// For Transfers
	$time_before='0'; };
	
		//$newtime = substr($date, 0,10);
		$time_array = explode(":", $time);
		$time_array[0] = $time_array[0]-$time_before;
		if ($time_array[0] < '12') {
			if ($time_array[0] == '00' || $time_array[0] == '0') {
			$time_hours = '12';
			$time_array[2]="AM"; 
			} else {
			if ($time_array[0] < '0') {
			$time_hours = $time_array[0] + 12;
			// Setup a new date
			$uts['mydate'] = strtotime( $org_date );
			$uts['mydate-1d'] = strtotime( '-1 day', $uts['mydate'] );
			$org_date = date( 'Y-m-d', $uts['mydate-1d'] );
			$time_array[2]="PM (".format_to_caldate($org_date).")";
			} else {
			$time_hours = $time_array[0];
			$time_array[2]="AM";
			} 
			}
		} else {
			if ($time_array[0] == '12') {
			$time_hours = '12';
			$time_array[2]="PM";
			} else {
			$time_hours = $time_array[0] - 12;
			$time_array[2]="PM";
			}
		};
		$newtime = $time_hours . ":".$time_array[1]." ".$time_array[2];
		return $newtime;
	}
	
	
	
	//Format Time 24 hours for MySQL
	function format_time_admin_mysql($time, $from, $to, $org_date){
	
	if(check_departure($from) || check_arrival($from) || check_departure($to) || check_arrival($to)) { 
	if (check_arrival($from)) { 
			// For Arrivals
			$time_before='0';
		} else { 
				// For departures from MCO
				if ($to =='421' || $to =='512') {
				$time_before='2';
				} else {
				// For departures from Sanford
				$time_before='3';
				}
			}; 
	} else { 
	// For Transfers
	$time_before='0'; };

		$time_array = explode(":", $time);
		//$time_array[0] = $time_array[0]-$time_before;
		// If we have midnight
		if ($time_array[0] < '1') {
			if ($time_before !=0) {
			$time_hours = 24 - $time_before;
			} else {
			$time_hours = 00;
			}
			} else {
			$time_hours = $time_array[0] - $time_before;			
			if ($time_hours <= 0) { 
			$time_hours = $time_hours + 24;
			}
		};
		
		
		
		$newtime = $time_hours . ":".$time_array[1];
		return $newtime;
	}
	
	
	
	//Format Date for Admin 24 hours for MySQL
	function format_date_admin_mysql($time, $from, $to, $org_date){
	
	if(check_departure($from) || check_arrival($from) || check_departure($to) || check_arrival($to)) { 
	if (check_arrival($from)) { 
			// For Arrivals
			$time_before='0';
		} else { 
				// For departures from MCO
				if ($to =='421' || $to =='512') {
				$time_before='2';
				} else {
				// For departures from Sanford
				$time_before='3';
				}
			}; 
	} else { 
	// For Transfers
	$time_before='0'; };

		$time_array = explode(":", $time);
		//$time_array[0] = $time_array[0]-$time_before;
		// If we have midnight
		if ($time_array[0] < '1') {
			//echo 'Org. date:'.$org_date;
			//echo "<br>";
			echo $time_before;
			
			if ($time_before > 0) {
			$org_date = explode ("-", $org_date);
			$org_date = date('Y-m-d', mktime(0, 0, 0, date($org_date[1]) , date($org_date[2]) - 1, date($org_date[0]))); // The client is arriving a day before
			}
			//echo "<br>";
			//exit;
			} else {
			$time_hours = $time_array[0] - $time_before;			
			if ($time_hours <= 0) { 
			//echo 'Org. date:'.$org_date;
			//echo "<br>";
			$org_date = explode ("-", $org_date);
			$org_date = date('Y-m-d', mktime(0, 0, 0, date($org_date[1]) , date($org_date[2]) - 1, date($org_date[0]))); // The client is arriving day before
			//exit;
			//echo "<br>";
			}
		};
		return $org_date;
	}
	
	
	
	
	
	
	//Format Time
	function format_time_admin_note($time, $from, $to, $org_date){
	
	if(check_departure($from) || check_arrival($from) || check_departure($to) || check_arrival($to)) { 
	if (check_arrival($from)) { 
			// For Arrivals
			$time_before='0';
		} else { 
				// For departures from MCO
				if ($to =='421' || $to =='512') {
				$time_before='2';
				} else {
				// For departures from Sanford
				$time_before='3';
				}
			}; 
	} else { 
	// For Transfers
	$time_before='0'; };
	
		//$newtime = substr($date, 0,10);
		$time_array = explode(":", $time);
		$time_array[0] = $time_array[0]-$time_before;
		if ($time_array[0] < '12') {
			if ($time_array[0] == '00' || $time_array[0] == '0') {
			$time_hours = '12';
			$time_array[2]="AM"; 
			} else {
			if ($time_array[0] < '0') {
			$time_hours = $time_array[0] + 12;
			// Setup a new date
			$uts['mydate'] = strtotime( $org_date );
			$uts['mydate-1d'] = strtotime( '-1 day', $uts['mydate'] );
			$org_date = date( 'Y-m-d', $uts['mydate-1d'] );
			$time_array[2]="PM (".format_to_caldate($org_date).")";
			} else {
			$time_hours = $time_array[0];
			$time_array[2]="AM";
			} 
			}
		} else {
			if ($time_array[0] == '12') {
			$time_hours = '12';
			$time_array[2]="PM";
			} else {
			$time_hours = $time_array[0] - 12;
			$time_array[2]="PM";
			}
		};
		$newtime = $time_hours . ":".$time_array[1]." ".$time_array[2];
		return $newtime;
	}
	
	//Format Time
	function format_time3($time, $time2){
		$time_array = explode(":", $time);
		if ($time_array[0] < '12') {
			if ($time_array[0] == '00' || $time_array[0] == '0') {
			$time_hours = '12';
			} else {
			$time_hours = $time_array[0];
			}
		$time_array[2]="AM"; 
		} else {
			if ($time_array[0] == '12') {
			$time_hours = '12';
			$time_array[2]="PM";
			} else {
			$time_hours = $time_array[0] - 12;
			$time_array[2]="PM";
			}
		};
		$newtime = $time_hours . ":".$time_array[1]." ".$time_array[2];
		return $newtime;
	}
	
	//Format Time
	function format_time2($time){
		//$newtime = substr($date, 0,10);
		$time_array = explode(":", $time);
		if ($time_array[0] < '12') {
			if ($time_array[0] == '00' || $time_array[0] == '0') {
			$time_hours = '12';
			} else {
			$time_hours = $time_array[0];
			}
		$time_array[2]="AM"; 
		} else {
			if ($time_array[0] == '12') {
			$time_hours = '12';
			$time_array[2]="PM";
			} else {
			$time_hours = $time_array[0] - 12;
			$time_array[2]="PM";
			}
		};
		$newtime = $time_hours . ":".$time_array[1].":".$time_array[2];
		return $newtime;
	}
	
	// Check Airport Location
	function check_departure($from){
		global $db;
			$check_departure_sql = "SELECT * FROM locations where id='$from' and (location_type='2' OR location_type='15')";
			if(!$result = $db->select($check_departure_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				if (empty($data)) {
				return false;
				} else {
				return true;
				}
			}
	}
	
	
	// Check Departures New
	function check_departure_new($from, $to){
		global $db;
			$check_departure_new_sql = "SELECT * FROM locations where id='$from' and location_type!='2' and location_type!='15'";
			if(!$result = $db->select($check_departure_new_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				if (empty($data)) {
				return false;
				} else {
				$check_departure_new2_sql = "SELECT * FROM locations where id='$to' and (location_type='2' OR location_type='15')";
					if(!$result = $db->select($check_departure_new2_sql)){
					//$_SESSION['notice'] = "Database Error. Please try again";
					return false;
					}
				return true;
				}
			}
	}
	
	
	// Check Arrivals New
	function check_arrivals_new($from, $to){
		global $db;
			$check_arrivals_new_sql = "SELECT * FROM locations where id='$from' and (location_type='2' OR location_type='15')";
			if(!$result = $db->select($check_arrivals_new_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				if (empty($data)) {
				return false;
				} else {
				return true;
				}
			}
	}
	
	// Check Airport Location
	function check_arrival($from){
		global $db;
			$check_arrival_sql = "SELECT * FROM locations where id='$from' and (location_type='2' OR location_type='15')";
			if(!$result = $db->select($check_arrival_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				if (empty($data)) {
				return false;
				} else {
				return true;
				}
			}
	}
?>
