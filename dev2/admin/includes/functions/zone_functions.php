<?php
	//Get ALL Zones
	function get_all_zones(){
		global $db;
			$get_all_zones_sql = "SELECT * FROM zones ORDER BY name ASC";
			if(!$result = $db->select($get_all_zones_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_zones[] = $data;
				return $all_zones;
			}
	}
	
	// Get current zone
	function get_zones_view($id){
		global $db;
			$get_zones_view_sql = "SELECT * FROM zones where id='$id'";
			if(!$result = $db->select($get_zones_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit Zone
	function edit_zones($id){
	global $db;
    
    //sanitize post data
        foreach($_POST as $key => $data)
        {
            $_POST[$key] = mysql_real_escape_string($data);
        }
        
		$edit_zones_sql = "UPDATE zones SET code='".$_POST['code']."', name='".$_POST['name']."', description='".$_POST['description']."' where id='$id'";
		if(!$result = $db->insert_sql($edit_zones_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	
	
	// Add a new Zone
	function add_zones(){
	global $db; 
    
    //sanitize post data
        foreach($_POST as $key => $data)
        {
            $_POST[$key] = mysql_real_escape_string($data);
        }
        
		$add_zones_sql = "INSERT INTO zones (code, name, description) values('".$_POST['code']."', '".$_POST['name']."', '".$_POST['description']."')";
		if(!$result = $db->insert_sql($add_zones_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}

	// Delete Selected Zones
	function delete_zones($id){
	global $db;
	$count =0;
		while($count < count($id)){
			$delete_zones_sql = "Delete from zones where id='".$id[$count]."'";
			if(!$db->select($delete_zones_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	// Delete Single Zone
	function delete_zone($id){
	global $db;
	$delete_zone_sql = "Delete from zones where id='$id'";
		if(!$db->select($delete_zone_sql)){
		//$_SESSION['notice'] = "Database Error. Please try again";
		exit;
		}
			
		return true;
	}
?>