<?php
	include("includes/classes/custom_db.php");
	$db = new db_class;
	
	// Get Company Info
	function get_company_info(){
		global $db;
			$get_company_info_sql = "SELECT * FROM settings LIMIT 1";
			if(!$result = $db->select($get_company_info_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Show Map
	function show_map($map_engine, $address, $address2, $city, $state, $zip, $country){
		if ($map_engine == 'google') {
		$map_link = '(<a href ="http://maps.google.com/maps?f=q&hl=en&geocode=&q=' .str_replace(" ", "+",$address).'+' .str_replace(" ", "+",$address2).'+' .str_replace(" ", "+",$city).'+' .str_replace(" ", "+",$state).'+' .str_replace(" ", "+",$zip).'" class="l_readmore_link" target="_blank">Google Map</a>)<br />';
		echo $map_link;
		}
		
		if ($map_engine == 'live_search') {
		$map_link = '(<a href ="http://maps.live.com/default.aspx?where1=' .$address.' ' .$address2.' ' .$city.' ' .$state.' ' .$zip.'" class="l_readmore_link" target="_blank">Live Search Map</a>)<br />';
		echo $map_link;
		}
		
		if ($map_engine == 'yahoo') {
		$map_link = '(<a href ="http://maps.yahoo.com/#mvt=m&lat=29.166041&lon=-81.038594&zoom=17&q1=' .$address.' ' .$address2.' ' .$city.' ' .$state.' ' .$zip.'" class="l_readmore_link" target="_blank">Yahoo Search Map</a>)<br />';
		echo $map_link;
		}
	
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
			//echo $time_before;
			
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

	function login($email, $password){
    
        if (empty($email) || empty($password)) return false;
	       
           global $db;
	
        $login_sql = "Select email, password from clients where email='$email' AND password='".md5(trim($password))."'";
	
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

	/**
	 * MASTER LOGIN
	 * This function checks if the email is valid, and the password supplied
	 * is the MASTER password for administrators.
	 */
	function master_login($email, $password){
		if (empty($email) || empty($password)) return false;
		global $db;
		$sql = "SELECT email FROM clients WHERE email='$email'";
		if ($result = $db->select($sql)) {
			$data = $db->get_row($result, 'MYSQL_ASSOC');

			if (!empty($data) && $password == 'iws@net1$') return true;
			else return false;
		}
		else {
			echo 'b';
			//$_SESSION['notice'] = "Database Error. Please try again";
			return false;
		}
		return false;
	}
?>