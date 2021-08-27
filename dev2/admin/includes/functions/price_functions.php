<?php
	//Get ALL Prices
	function get_all_prices($vehicle_id, $price){
		global $db;
		if (!empty($vehicle_id)) {
			if (!empty($price)) {
			$searchby_sql2 = " WHERE vehicle_id='$vehicle_id' AND price_value ='$price'";
			} else {
			$searchby_sql = " WHERE vehicle_id='$vehicle_id'";
			}
		}
		if (!empty($price)) {
			if (!empty($vehicle_id)) {
			$searchby_sql2 = " WHERE vehicle_id='$vehicle_id' AND price_value ='$price'";
			} else {
			$searchby_sql2 = " WHERE price_value LIKE '$price'";
			}
		}
		
			$get_all_prices_sql = "SELECT * FROM prices $searchby_sql $searchby_sql2 ORDER BY id ASC";
			if(!$result = $db->select($get_all_prices_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_prices[] = $data;
				return $all_prices;
			}
	}
	
	
	//Get ALL Prices for Shades of Green
	function get_all_prices_sog($vehicle_id, $price){
		global $db;
		if (!empty($vehicle_id)) {
			if (!empty($price)) {
			$searchby_sql2 = " WHERE vehicle_id='$vehicle_id' AND (oneway_price ='$price' OR roundtrip_price ='$price')";
			} else {
			$searchby_sql = " WHERE vehicle_id='$vehicle_id'";
			}
		}
		if (!empty($price)) {
			if (!empty($vehicle_id)) {
			$searchby_sql2 = " WHERE vehicle_id='$vehicle_id' AND (oneway_price ='$price' OR roundtrip_price ='$price')";
			} else {
			$searchby_sql2 = " WHERE oneway_price LIKE '$price' OR roundtrip_price LIKE '$price'";
			}
		}
		
			$get_all_prices_sog_sql = "SELECT * FROM prices_sog $searchby_sql $searchby_sql2 ORDER BY id, vehicle_id ASC";
			if(!$result = $db->select($get_all_prices_sog_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_prices_sog[] = $data;
				return $all_prices_sog;
			}
	}
	
	// Get current price for Price Manager
	function get_current_prices_view($id){
		global $db;
			$get_current_prices_view_sql = "SELECT * FROM prices where id='$id'";
			if(!$result = $db->select($get_current_prices_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Get current price for Price Manager (Shades of Green)
	function get_current_prices_sog_view($id){
		global $db;
			$get_current_prices_sog_view_sql = "SELECT * FROM prices_sog where id='$id'";
			if(!$result = $db->select($get_current_prices_sog_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Get current price for Transfers
	function get_prices_view($vehicle_id, $trip_type){
		global $db;
			$get_prices_view_sql = "SELECT * FROM prices where vehicle_id='$vehicle_id' and trip_type='$trip_type' LIMIT 1";
			if(!$result = $db->select($get_prices_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Get current price for Shades of Green
	function get_prices_sog_view($vehicle_id, $location1_id, $location2_id){
		global $db;
			$get_prices_view_sql = "SELECT * FROM prices_sog where vehicle_id='$vehicle_id' AND location1_id='$location1_id' AND location2_id='$location2_id' LIMIT 1";
			
			//print_r($get_prices_view_sql);
			//exit;
			if(!$result = $db->select($get_prices_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				// If result is empty then try it in a different way
				if (empty($data)) {
					$get_prices_view2_sql = "SELECT * FROM prices_sog where vehicle_id='$vehicle_id' AND location1_id='$location2_id' AND location2_id='$location1_id' LIMIT 1";
					//print_r($get_prices_view2_sql);
					//exit;
						if(!$result = $db->select($get_prices_view2_sql)){
						//$_SESSION['notice'] = "Database Error. Please try again";
						return false;
						} else {
						$data=$db->get_row($result, 'MYSQL_ASSOC');
						}
					}
						
				return $data;
			}
	}
	
	// Get current price for Orlando
	function get_prices_view_local($vehicle_id, $trip_type, $from, $to){
		global $db;
			$get_prices_view_local_sql = "SELECT * FROM prices where vehicle_id='$vehicle_id' and trip_type='$trip_type' and ((location1_id ='$from' and location2_id='$to') OR (location1_id ='$to' and location2_id='$from')) LIMIT 1";
			if(!$result = $db->select($get_prices_view_local_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit Price
	function edit_prices($id){
	global $db;
		$edit_prices_sql = "UPDATE prices SET trip_type='".$_POST['trip_type']."', price_value='".$_POST['price_value']."', vehicle_id='".$_POST['vehicle_id']."', location1_id='".$_POST['from']."', location2_id='".$_POST['to']."', custom_bundle='".$_POST['custom_bundle']."' where id='$id'";
		if(!$result = $db->insert_sql($edit_prices_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	// Edit Price for Shades of Green
	function edit_prices_sog($id){
	global $db;
		$edit_prices_sog_sql = "UPDATE prices_sog SET vehicle_id='".$_POST['vehicle_id']."', location1_id='".$_POST['from']."', location2_id='".$_POST['to']."', oneway_price='".$_POST['oneway_price']."', roundtrip_price='".$_POST['roundtrip_price']."' where id='$id'";
		if(!$result = $db->insert_sql($edit_prices_sog_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	
	
	// Add a new Price
	function add_prices(){
	global $db; 
		$add_prices_sql = "INSERT INTO prices (price_value, vehicle_id, location1_id, location2_id, custom_bundle, trip_type) values('".$_POST['price_value']."', '".$_POST['vehicle_id']."', '".$_POST['from']."', '".$_POST['to']."', '".$_POST['custom_bundle']."', '".$_POST['trip_type']."')";
		if(!$result = $db->insert_sql($add_prices_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	// Add a new Price for Shades of Green
	function add_prices_sog(){
	global $db; 
		$add_prices_sog_sql = "INSERT INTO prices_sog (vehicle_id, location1_id, location2_id, oneway_price, roundtrip_price) values('".$_POST['vehicle_id']."', '".$_POST['from']."', '".$_POST['to']."', '".$_POST['oneway_price']."', '".$_POST['roundtrip_price']."')";
		
		//print_r($add_prices_sog_sql);
		//exit;
		if(!$result = $db->insert_sql($add_prices_sog_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}

	// Delete Selected Prices
	function delete_prices($id){
	global $db;
	$count =0;
		while($count < count($id)){
			$delete_prices_sql = "Delete from prices where id='".$id[$count]."'";
			if(!$db->select($delete_prices_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	// Delete Selected Prices for Shades of Green
	function delete_prices_sog($id){
	global $db;
	$count =0;
		while($count < count($id)){
			$delete_prices_sog_sql = "Delete from prices_sog where id='".$id[$count]."'";
			if(!$db->select($delete_prices_sog_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	// Delete Single Price
	function delete_price($id){
	global $db;
	$delete_price_sql = "Delete from prices where id='$id'";
		if(!$db->select($delete_price_sql)){
		//$_SESSION['notice'] = "Database Error. Please try again";
		exit;
		}
			
		return true;
	}
?>