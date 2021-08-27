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
	$login_sql = "Select username, password from settings where username='$username' AND password='".md5($password)."'";
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
		$time_hours = $time_array[0];
		$time_array[2]="AM"; 
		} else {
			if ($time_array[0] != '12') {
			$time_hours = $time_array[0] - 12;
			} else {
			$time_hours = $time_array[0];
			}
			$time_array[2]="PM";
		};
		$newtime = $time_hours . ":".$time_array[1]." ".$time_array[2];
		return $newtime;
	}
	
	//Format Time
	function format_time3($time, $time2){
		//echo $time2 - '02:00:00';		
		//if ($time > $time2) {
		//echo $time;
		//echo "<br><br>";
		//echo $time2;
		//$time_array = $time2;
		//};
		$time_array = explode(":", $time);
		if ($time_array[0] < '12') {
		$time_hours = $time_array[0];
		$time_array[2]="AM"; 
		} else {
			if ($time_array[0] != '12') {
			$time_hours = $time_array[0] - 12;
			} else {
			$time_hours = $time_array[0];
			}
			$time_array[2]="PM";
		};
		$newtime = $time_hours . ":".$time_array[1]." ".$time_array[2];
		return $newtime;
	}
	
	//Format Time
	function format_time2($time){
		//$newtime = substr($date, 0,10);
		$time_array = explode(":", $time);
		if ($time_array[0] < '12') {
		$time_hours = $time_array[0];
		$time_array[2]="AM"; 
		} else {
			if ($time_array[0] != '12') {
			$time_hours = $time_array[0] - 12;
			} else {
			$time_hours = $time_array[0];
			}
			$time_array[2]="PM";
		};
		
		$newtime = $time_hours . ":".$time_array[1].":".$time_array[2];
		return $newtime;
	}
	
?>
