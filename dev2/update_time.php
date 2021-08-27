<?php
	include("includes/classes/custom_db.php");
	
	$db = new db_class;
	
	// Get Company Info
	function update_time(){
		global $db;
			$sql = "SELECT `id`, `actual_time` FROM `reservation_details2` WHERE `reservation_id` = 1592 AND `to_location` = 421";
			if(!$result = $db->select($sql)){
				echo "Database Error. Please try again 1";
				print_r($db);
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				echo $data['id'] . " " . $data['actual_time'];
				exit;
			}
	}

update_time();

?>