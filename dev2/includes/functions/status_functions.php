<?php
	//Get ALL Statuses
	function get_all_statuses(){
		global $db;
			$get_all_statuses_sql = "SELECT * FROM statuses ORDER BY id ASC";
			if(!$result = $db->select($get_all_statuses_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_statuses[] = $data;
				return $all_statuses;
			}
	}
	
	// Get current status
	function get_statuses_view($id){
		global $db;
			$get_statuses_view_sql = "SELECT * FROM statuses where id='$id'";
			if(!$result = $db->select($get_statuses_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Get current status icon
	function get_statuses_icon($icon_id){
		global $db;
			$get_statuses_icon_sql = "SELECT * FROM icons where id='$icon_id'";
			if(!$result = $db->select($get_statuses_icon_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	
	
	// Edit Status
	function edit_statuses($id){
	global $db;
		$edit_statuses_sql = "UPDATE statuses SET name='".mysql_real_escape_string($_POST['name'])."', description='".mysql_real_escape_string($_POST['description'])."', icon_id='".$_POST['icon_id']."' where id='$id'";
		if(!$result = $db->insert_sql($edit_statuses_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	
	
	// Add a new Status
	function add_statuses(){
	global $db; 
		$add_statuses_sql = "INSERT INTO statuses (name, description, icon_id) values('".mysql_real_escape_string($_POST['name'])."', '".mysql_real_escape_string($_POST['description'])."', '".$_POST['icon_id']."')";
		if(!$result = $db->insert_sql($add_statuses_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}

	// Delete Selected Statuses
	function delete_statuses($id){
	global $db;
	$count =0;
		while($count < count($id)){
			$delete_statuses_sql = "Delete from statuses where id='".$id[$count]."'";
			if(!$db->select($delete_statuses_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	// Delete Single Status
	function delete_status($id){
	global $db;
	$delete_status_sql = "Delete from statuses where id='$id'";
		if(!$db->select($delete_status_sql)){
		//$_SESSION['notice'] = "Database Error. Please try again";
		exit;
		}
			
		return true;
	}
?>