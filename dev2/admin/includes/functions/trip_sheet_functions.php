<?php

	//Get ALL trips
	function get_all_trips(){
		global $db;
		
		if (empty($_GET['orderby'])) {
			$orderby_sql = "id ASC";
			} else {
				
				if ($_GET['orderby'] == 'time') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = "id ASC";
					} else {
					$orderby_sql = "id DESC";
					}
				}
				
			}

			$get_all_trips_sql = "SELECT * FROM trip_sheet ORDER BY $orderby_sql";
			echo "I am here! SQL IS: " . $get_all_trips_sql ;
			exit;
			if(!$result = $db->select($get_all_trips_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_trips[] = $data;
				//print_r($all_trips); exit;
				return $all_trips;
			}
	}
	
	// Get current trip
	function get_trip_sheet_view($id){
		global $db;
			$get_trip_sheet_view_sql = "SELECT * FROM trip_sheet where id='$id'";
			if(!$result = $db->select($get_trip_sheet_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
		//Get Trip Sheet for Certain Driver
	function get_trip_sheet1($drivers_id, $from, $to){
		global $db;
		if(empty($drivers_id))
			$get_trip_sheet_sql = "SELECT * FROM trip_sheet WHERE date BETWEEN '$from' AND '$to' ORDER BY id DESC";
		else
			$get_trip_sheet_sql = "SELECT * FROM trip_sheet WHERE drivers_id = '$drivers_id' AND date BETWEEN '$from' AND '$to' ORDER BY id DESC";
			//echo "SQL is: ".$get_trip_sheet_sql;
			if(!$result = $db->select($get_trip_sheet_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				}
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$drivers_trip_sheet[] = $data;
					print_r ($drivers_trip_sheet['date']);
					
				return $drivers_trip_sheet;
			}
	}
	

	
			//Get Trip Sheets for Last 30 Days
	function get_trip_sheet($from, $to){
		global $db;
			$get_trip_sheet_sql = "SELECT * FROM trip_sheet WHERE date BETWEEN '$from' AND '$to'  ORDER BY time DESC";
			//echo "SQL is: ".$get_trip_sheet_sql;
			if(!$result = $db->select($get_trip_sheet_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				}
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$drivers_trip_sheet[] = $data;
					//print_r ($drivers_trip_sheet);
					
				return $drivers_trip_sheet;
			}
	}
	
	// Add a new trip to the trip sheet
	function add_trip(){
    
    //sanitize post data
    foreach($_POST as $key => $data)
    {
        $_POST[$key] = mysql_real_escape_string($data);
    }
    
	global $db; 
	
	//$date_submitted = date('Y-m-d');	
	//if (empty($_POST['status'])) {
	//$status = '2'; //Default value Active = 2	
	//}
		
		$add_trip_sql = "INSERT INTO trip_sheet (time, ampm, date, drivers_id, car, from_place, to_place, pax, fare, cc, money, pp, fuel, carwash, misc) values('".format_time_sql($_POST['time'],$_POST['ampm'])."', '".$_POST['ampm']."', '".format_date_calendar($_POST['date'])."', '".$_POST['drivers_id']."', '".$_POST['car']."', '".$_POST['from_place']."', '".$_POST['to_place']."', '".$_POST['pax']."', '".$_POST['fare']."', '".$_POST['cc']."', '".$_POST['money']."', '".$_POST['pp']."', '".$_POST['fuel']."', '".$_POST['carwash']."', '".$_POST['misc']."')";
		//echo "I am here. SQL is: ".$add_trip_sql; exit;
		//print_r ($add_trip_sql);


		if(!$result = $db->insert_sql($add_trip_sql)){ 
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else
			return true;	
	}

	// Delete Selected trip from the trip sheet
	function delete_trip($id){
	global $db;
	$count =0;
		while($count < count($id)){
		
			$delete_trip_sql = "Delete from trip_sheet where id='".$id[$count]."'";
			
			//print_r ($id);
			//echo "I am here SQl is:". $delete_trip_sql;
			
			if(!$db->select($delete_trip_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
				exit;
			}
			$count++;
		}
			
		return true;
	}
?>