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
	
	// Get current price for Price Manager
	function get_current_prices_view($id){
		global $db;
			echo $get_current_prices_view_sql = "SELECT * FROM prices where id='$id'";
			if(!$result = $db->select($get_current_prices_view_sql)){
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
			echo $get_prices_view_sql = "SELECT * FROM prices where vehicle_id='$vehicle_id' and trip_type='$trip_type' LIMIT 1";

			if(!$result = $db->select($get_prices_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Get current price for Orlando
	function get_prices_view_local($vehicle_id, $trip_type, $from, $to){
		global $db;
			 echo $get_prices_view_local_sql = "SELECT * FROM prices where vehicle_id='$vehicle_id' and trip_type='$trip_type' and ((location1_id ='$from' and location2_id='$to') OR (location1_id ='$to' and location2_id='$from')) LIMIT 1";//die;
			//print_r($get_prices_view_local_sql);
			//exit;
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
		$edit_prices_sql = "UPDATE prices SET price_value='".mysql_real_escape_string($_POST['price_value'])."', vehicle_id='".$_POST['vehicle_id']."', location1_id='".mysql_real_escape_string($_POST['from'])."', location2_id='".mysql_real_escape_string($_POST['to'])."', custom_bundle='".mysql_real_escape_string($_POST['custom_bundle'])."' where id='$id'";
		if(!$result = $db->insert_sql($edit_prices_sql)){
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
		$add_prices_sql = "INSERT INTO prices (price_value, vehicle_id, location1_id, location2_id, custom_bundle, trip_type) values('".mysql_real_escape_string($_POST['price_value'])."', '".mysql_real_escape_string($_POST['vehicle_id'])."', '".mysql_real_escape_string($_POST['from'])."', '".mysql_real_escape_string($_POST['to'])."', '".mysql_real_escape_string($_POST['custom_bundle'])."', '".$_POST['trip_type']."')";
		if(!$result = $db->insert_sql($add_prices_sql)){
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
?>