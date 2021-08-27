<?php

	//Get ALL logs
	function get_all_logs(){
		global $db;
		
		if (empty($_GET['orderby'])) {
			$orderby_sql = " type ASC";
			} else {
				if ($_GET['orderby'] == 'type') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " type ASC";
					} else {
					$orderby_sql = " type DESC";
					}
				}
				
				
				if ($_GET['orderby'] == 'date') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " date ASC";
					} else {
					$orderby_sql = " date DESC";
					}
				}
				
				
				if ($_GET['orderby'] == 'first_name') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " first_name ASC";
					} else {
					$orderby_sql = " first_name DESC";
					}
				}
			}

			$get_all_logs_sql = "SELECT * FROM mod_expense_log ORDER BY $orderby_sql";
			//echo "I am here! SQL IS: " . $get_all_logs_sql ;
			//exit;
			if(!$result = $db->select($get_all_logs_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_logs[] = $data;
					//print_r($all_logs);
				return $all_logs;
			}
	}
	
	// Get current log
	function get_log_view($id){
		global $db;
			$get_log_view_sql = "SELECT * FROM mod_expense_log where id='$id'";
			if(!$result = $db->select($get_log_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit logs
	function edit_log($id){
	global $db;
		$edit_log_sql = "UPDATE mod_expense_log SET type='".$_POST['type']."', date='".format_date_calendar($_POST['date'])."', amount='".$_POST['amount']."', comment='".mysql_real_escape_string($_POST['comment'])."', drivers_id='".$_POST['drivers_id']."' where id='$id'";
		
		//echo "I am here! SQL IS: " . $edit_log_sql ; exit;
		
		if(!$result = $db->insert_sql($edit_log_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
		//Get Reservations for Reports
	function get_log($from, $to){
		global $db;
			$get_log_reports_sql = "SELECT * FROM mod_expense_log WHERE date BETWEEN '$from' AND '$to'  ORDER BY id DESC";
			if(!$result = $db->select($get_log_reports_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				}
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_logs[] = $data;
					
				return $all_logs;
			}
	}
	
		//Get Reservations for Reports
	function get_log_by_drivers_id($from, $to, $drivers_id){
		global $db;
			$get_log_reports_sql = "SELECT type, SUM(amount) FROM mod_expense_log WHERE drivers_id='$drivers_id' AND date BETWEEN '$from' AND '$to'  GROUP BY type";
			
			//print_r($get_log_reports_sql);
			if(!$result = $db->select($get_log_reports_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				}
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_logs[] = $data;
					
				return $all_logs;
			}
	}
	
	// Add a new log
	function add_log(){
	global $db; 
		
	//$date_submitted = date('Y-m-d');	
	//if (empty($_POST['status'])) {
	//$status = '2'; //Default value Active = 2	
	//}
	
		$add_log_sql = "INSERT INTO mod_expense_log (type, date, amount, comment, drivers_id) values('".$_POST['type']."', '".format_date_calendar($_POST['date'])."', '".$_POST['amount']."', '".mysql_real_escape_string($_POST['comment'])."', '".$_POST['drivers_id']."')";
		//print_r ($add_log_sql);


		if(!$result = $db->insert_sql($add_log_sql)){ 
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}

	// Delete Selected log
	function delete_log($id){
	global $db;
	$count =0;
		while($count < count($id)){
		
			$delete_log_sql = "Delete from mod_expense_log where id='".$id[$count]."'";
			
			//print_r ($id);
			//echo "I am here SQl is:". $delete_log_sql;
			
			if(!$db->select($delete_log_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	function total_expenses(){
		$counter =0; $total_amount=0; $total_misc=0; $total_fuel=0; $total_carwash=0; 
		while($counter < count($all_trips)){	
								//echo $all_trips[$counter]["id"].' '.$all_trips[$counter]["misc"];
								$misc= $all_trips[$counter]["misc"];
								$fuel= $all_trips[$counter]["fuel"];
								$carwash= $all_trips[$counter]["carwash"];
								$total_misc= $total_misc + $misc;
								$total_fuel= $total_fuel + $fuel;
								$total_carwash= $total_carwash + $carwash;
								$counter++;
							}
							//echo $total_misc." ".$total_fuel." ".$total_carwash;
						$total_amount = $total_misc+$total_fuel+$total_carwash;
						echo "<b>Total Expenses:</b>  $".$total_amount;
	}
	
	function get_expenses_type($type){
		if ($type == '' || $type =='8') {
		$type_name = 'Miscellaneous';
		} 
		
		if ($type =='1') {
		$type_name = 'Utilities';
		} 
		
		if ($type =='2') {
		$type_name = 'Rent';
		} 
		
		if ($type =='3') {
		$type_name = 'Auto Repair';
		} 
		
		if ($type =='4') {
		$type_name = 'Office Equipment Supplies';
		} 
		
		if ($type =='5') {
		$type_name = 'Licenses & Taxes';
		} 
		
		if ($type =='6') {
		$type_name = 'Gas';
		} 
		
		if ($type =='7') {
		$type_name = 'Salary';
		} 
		
		if ($type =='8') {
		$type_name = 'Miscellaneous';
		} 
		
		return $type_name;
	}
?>