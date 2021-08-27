<?php
	//Get ALL Clients
	function get_all_users(){
		global $db;
			$users_sql = "SELECT username FROM users where username != 'admin'";
			if(!$result = $db->select($users_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$users[] = $data;
				if(!empty($users))
					return $users;
				else 
					return "No users found!";
			}
	}
	

	// Delete user
	function delete_user($username){
	global $db;
			$delete_user_sql = "Delete from users where username='$username'";
			if(!$db->select($delete_user_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				exit;
			}
			else{
				$_SESSION['notice'] = $username . " deleted successfully";
				return true;
			}
	}
	// Add user
	function add_user($userinfo){
	global $db; 
		//print_r($userinfo); exit;
        
        //sanitize post data
    foreach($userinfo as $key => $data)
    {
        $userinfo[$key] = mysql_real_escape_string($data);
    }
		
		$add_user_sql = "INSERT INTO users (username, password, user_ip, clients, reservations, shades_of_green, vehicle, zone, location, price, price_sog, pages, email, status, reports, users, settings, account_type) values('".$userinfo['username']."', '".md5($userinfo['password'])."', '".$userinfo['user_ip']."', '".$userinfo['clients']."', '".$userinfo['reservations']."', '".$userinfo['shades_of_green']."', '".$userinfo['vehicle']."', '".$userinfo['zone']."', '".$userinfo['location']."', '".$userinfo['price']."', '".$userinfo['price_sog']."', '".$userinfo['pages']."', '".$userinfo['email']."', '".$userinfo['status']."', '".$userinfo['reports']."', '".$userinfo['users']."', '".$userinfo['settings']."', '".$userinfo['account_type']."')";

		if(!$result = $db->insert_sql($add_user_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			$_SESSION['notice'] = $userinfo['username']. " added successfully";
			return true;
		}	
	}

	// Get current User
	function get_user_view($username){
		global $db;
			$get_user_view_sql = "SELECT * FROM users where username='$username'";
			if(!$result = $db->select($get_user_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit user
	function edit_user($userinfo){
	global $db; 
		
        //sanitize post data
        foreach($userinfo as $key => $data)
        {
            $userinfo[$key] = mysql_real_escape_string($data);
        }
		
		$edit_user_sql = "UPDATE users SET username='".$userinfo['username']."', user_ip='".$userinfo['user_ip']."', account_type='".$userinfo['account_type']."', clients='".$userinfo['clients']."', reservations='".$userinfo['reservations']."', shades_of_green='".$userinfo['shades_of_green']."', vehicle='".$userinfo['vehicle']."', zone='".$userinfo['zone']."', location='".$userinfo['location']."', price='".$userinfo['price']."', price_sog='".$userinfo['price_sog']."', pages='".$userinfo['pages']."', email='".$userinfo['email']."', status='".$userinfo['status']."', reports='".$userinfo['reports']."', users='".$userinfo['users']."', settings='".$userinfo['settings']."' WHERE user_id='".$userinfo['user_id']."'";
		
		//print_r($edit_user_sql);
		//exit;
		
		if(!$result = $db->insert_sql($edit_user_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			$_SESSION['notice'] = $userinfo['username']. " updated successfully";
			return true;
		}	
	}
	
	// Edit user
	function edit_user_password($userinfo){
	global $db; 
		//print_r($userinfo); exit;
		
		$edit_user_password_sql = "UPDATE users SET password='".md5($userinfo['password'])."' WHERE user_id='".$userinfo['user_id']."'";
		
		if(!$result = $db->insert_sql($edit_user_password_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			$_SESSION['notice'] = $userinfo['username']. " updated successfully";
			return true;
		}	
	}
?>