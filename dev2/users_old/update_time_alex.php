<?php
	include("includes/functions/general_functions.php");
	
	// Get Company Info
	function update_time(){
		global $db;
			$sql = "SELECT `id`, `time`, `from`, `to`, `date` FROM `reservation_details` WHERE `reservation_id` > 0 order by id";
			if(!$result = $db->select($sql)){
				echo "Database Error. Please try again 1" . $db->last_error;
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC')){
					$ids[] = $data['id'];
					$time[] = $data['time']; 
					$from_location[] = $data['from'];
					$to_location[] = $data['to'];
					$date[] = $data['date'];
				}
				
				$count =0;
				// Update the pickup time
				while($count < count($ids)){

				$time_admin[$count] = format_time_admin_mysql($time[$count], $from_location[$count], $to_location[$count], $date[$count]);
				
					$sql = "UPDATE  reservation_details set `pickup_time` = '".$time_admin[$count]. "' WHERE `id` = ". $ids[$count];
					//echo $sql; exit;
					if(!$result = $db->select($sql))
					echo "Database Error. Please try again 2";
					$count++;
					
				}
			}
	}

update_time();
echo "Done Updating";

?>