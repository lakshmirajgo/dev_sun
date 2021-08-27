<?php
	//Get ALL Trip types
	function get_all_trip_types(){
		global $db;
			$get_all_trip_types_sql = "SELECT * FROM trip_types ORDER BY id ASC";
			if(!$result = $db->select($get_all_trip_types_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_trip_types[] = $data;
				return $all_trip_types;
			}
	}
	
	// Get current Trip type
	function get_trip_types_view($id){
		global $db;
			$get_trip_types_view_sql = "SELECT * FROM trip_types where id='$id'";
			if(!$result = $db->select($get_trip_types_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit Trip type
	function edit_trip_type($id){
	global $db;
		$edit_trip_type_sql = "UPDATE trip_types SET name='".mysql_real_escape_string($_POST['name'])."' where id='$id'";
		if(!$result = $db->insert_sql($edit_trip_type_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	
	
	// Add a new Trip type
	function add_trip_types(){
	global $db; 
		$add_trip_types_sql = "INSERT INTO trip_types (name) values('".mysql_real_escape_string($_POST['name'])."')";
		if(!$result = $db->insert_sql($add_trip_types_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}

	// Delete Selected Trip types
	function delete_trip_types($id){
	global $db;
	$count =0;
		while($count < count($id)){
			$delete_trip_types_sql = "Delete from trip_types where id='".$id[$count]."'";
			if(!$db->select($delete_trip_types_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	// Delete Single Trip Type
	function delete_trip_type($id){
	global $db;
	$delete_trip_type_sql = "Delete from trip_types where id='$id'";
		if(!$db->select($delete_trip_type_sql)){
		//$_SESSION['notice'] = "Database Error. Please try again";
		exit;
		}
		return true;
	}
?>