<?php
	//Get ALL Airports
	function get_all_airports2(){
		global $db;
			$get_all_airports_sql = "SELECT * FROM airports ORDER BY id ASC";
			if(!$result = $db->select($get_all_airports_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_airports[] = $data;
				return $all_airports;
			}
	}
	
	// Get current Airport
	function get_airport_view($id){
		global $db;
			$get_airport_view_sql = "SELECT * FROM airports where id='$id'";
			if(!$result = $db->select($get_airport_view_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Get Reservations Details
	function get_all_reservation_details($reservation_id){
		global $db;
			$get_all_reservation_details_sql = "SELECT * FROM reservation_details WHERE reservation_id='$reservation_id' ORDER BY id ASC";
			if(!$result = $db->select($get_all_reservation_details_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_details[] = $data;
				return $all_details;
			}
	}
	
	//Get ALL Hotels
	function get_all_hotels(){
		global $db;
			$get_all_hotels_sql = "SELECT * FROM hotels ORDER BY id ASC";
			if(!$result = $db->select($get_all_hotels_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_hotels[] = $data;
				return $all_hotels;
			}
	}
	
	// Get current Hotel
	function get_hotel_view($id){
		global $db;
			$get_hotel_view_sql = "SELECT * FROM hotels where id='$id'";
			if(!$result = $db->select($get_hotel_view_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	
	// Add a new Reservation
	function add_reservations(){
	global $db; 
	$status = '1';

	if (!empty($_POST['child_carseat'])) {
	$child_carseat = $_POST['child_carseat'];
	} else {
	$child_carseat = 'No';
	};
	if (!empty($_POST['child_boosterseat'])) {
	$child_boosterseat = $_POST['child_boosterseat'];
	} else {
	$child_boosterseat = 'No';
	};
	$exp_date = $_POST['ExpMonth']."/".$_POST['ExpYear'];
	$reservation_date = date('Y-m-j h:i:s'); 
	
	$ip=$_SERVER['REMOTE_ADDR']; 
	
	//clean card info
	$cardnumber = str_replace("-", "", str_replace(" ", "", $_POST['card_number']));

		$add_reservations_sql = "INSERT INTO reservations (client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, booster_seat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, phone_number, cellphone, first_name_billing, last_name_billing, address_billing, address2_billing, city_billing, state_billing, zip_billing, country_billing, total_amount, card_number, card_type, exp_date, reservation_date, status, customer_comments, location1, location2, location3, pickup_at_extra, travel_date_extra, paying_cash, store_stop, ip_address) values('".$_SESSION['client_id']."', '".$_POST['vehicle_id']."', '".$_POST['from']."', '".$_POST['to']."', '".$travel_date."', '".$_POST['passenger_count']."', '".$child_carseat."', '".$child_boosterseat."', '".$_POST['trip_type']."', '".$pickup_at."', '".$_POST['arriving_airline']."', '".$_POST['flight_number']."', '".$arriving_at."', '".$travel_date_roundtrip."', '".$pickup_at_roundtrip."', '".$_POST['departing_airline_roundtrip']."',	'".$_POST['flight_number_roundtrip']."', '".$departing_at."', '".$_POST['first_name']."', '".$_POST['last_name']."', '".$_POST['address']."', '".$_POST['address2']."', '".$_POST['town']."', '".$_POST['state']."', '".$_POST['zip']."', '".$_POST['country']."', '".$_SESSION['email']."', '".$_POST['phone_number']."', '".$_POST['cellphone']."', '".$_POST['first_name_billing']."', '".$_POST['last_name_billing']."', '".$_POST['address_billing']."','".$_POST['address2_billing']."','".$_POST['city_billing']."','".$_POST['state_billing']."', '".$_POST['zip_billing']."', '".$_POST['country_billing']."', '".$_POST['total_amount']."','".$cardnumber."', '".$_POST['card_type']."', '".$exp_date."', '$reservation_date', '".$status."', '".$_POST['customer_comments']."', '".$location1."', '".$location2."', '".$location3."', '$pickup_at_extra', '$travel_date_extra', '".$_POST['paying_cash']."', '".$_POST['store_stop']."', '".$ip."')";
		
		//echo $add_reservations_sql; exit;
		
		if(!$result = $db->insert_sql($add_reservations_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
		
		session_start();
		$_SESSION['reservation_id'] = $result;
		
		$num_legs = $_SESSION['num_legs'];
    for ($count =1; $count <= $num_legs; $count += 1) {
	$from[$count] = get_locations_view($_SESSION['from'.$count.'']);
	$to[$count] = get_locations_view($_SESSION['to'.$count.'']);
	
		if ($_SESSION['ampm'.$count.''] == 'PM') {
			if ($_SESSION['h'.$count.''] == '12') {
			$hours[$count] = $_SESSION['h'.$count.''];
			} else {
			$hours[$count] = $_SESSION['h'.$count.''] + 12;
			}
		} else {
			if ($_SESSION['h'.$count.''] == '12') {
			$hours[$count] = ($_SESSION['h'.$count.''] - 12)*(-1);
			} else {
			$hours[$count] = $_SESSION['h'.$count.''];
			}
		}
		$time[$count] = $hours[$count].":".$_SESSION['m'.$count.''];
		$date[$count] = format_date($_SESSION['date'.$count.'']);
		
		$time_admin[$count] = format_time_admin_mysql($time[$count], $_SESSION['from'.$count.''], $_SESSION['to'.$count.''], $date[$count]);
		$date_admin[$count] = format_date_admin_mysql($time[$count], $_SESSION['from'.$count.''], $_SESSION['to'.$count.''], $date[$count]);
		
		$add_reservation_details_sql = "INSERT INTO reservation_details (`reservation_id`, `time`, `airline`, `flight_number`, `date`, `from`, `to`, `transfer_type`, `pickup_time`, `pickup_date`) VALUES ('".$_SESSION['reservation_id']."', '".$time[$count]."', '".$_SESSION['airline'.$count.'']."', '".$_SESSION['flight_number'.$count.'']."', '".$date[$count]."', '".$_SESSION['from'.$count.'']."', '".$_SESSION['to'.$count.'']."', '', '".$time_admin[$count]."', '".$date_admin[$count]."')";
		
		//print_r($add_reservation_details_sql);
		if(!$result = $db->insert_sql($add_reservation_details_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		/*
		if(check_departure($_SESSION['from'.$count.'']) || check_arrival($_SESSION['from'.$count.'']) || check_departure($_SESSION['to'.$count.'']) || check_arrival($_SESSION['to'.$count.''])) { if (check_arrival($_SESSION['from'.$count.''])) { 
		
		// Update for Arrivals
		$update_reservation_dates_sql = "UPDATE reservations SET travel_date='".$date[0]."', pickup_at='".$time[0]."' WHERE id='".$_SESSION['reservation_id']."'";
		
		//print_r($add_reservation_details_sql);
		if(!$result = $db->insert_sql($update_reservation_dates_sql)){
			echo $_SESSION['notice'] = $db->last_error;
			return false;			
		}
		
		} else { 
		// Update for Departures
		$update_reservation_dates_sql = "UPDATE reservations SET travel_date_roundtrip='".$date[1]."', pickup_at_roundtrip='".$time[1]."' WHERE id='".$_SESSION['reservation_id']."'";
		
		//print_r($add_reservation_details_sql);
		if(!$result = $db->insert_sql($update_reservation_dates_sql)){
			echo $_SESSION['notice'] = $db->last_error;
			return false;			
		}
		};
		*/ 
		
		//} 
		
		
		}
			return true;
		}	
	}

	// Edit Transportation Info
	function edit_transportation_info(){
	global $db; 

	if (!empty($_POST['child_carseat'])) {
	$child_carseat = $_POST['child_carseat'];
	} else {
	$child_carseat = 'No';
	};
	if (!empty($_POST['child_boosterseat'])) {
	$child_boosterseat = $_POST['child_boosterseat'];
	} else {
	$child_boosterseat = 'No';
	}; 
	
	$ip=$_SERVER['REMOTE_ADDR']; 

		$edit_transportation_info_sql = "UPDATE reservations SET child_carseat='".$child_carseat."', booster_seat='".$child_boosterseat."', store_stop='".$_POST['store_stop']."', ip_address='".$ip."' WHERE id ='".$_GET['id']."'";
		
		if(!$result = $db->insert_sql($edit_transportation_info_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
		
		$reservation_details = get_all_reservation_details($_GET['id']);
			  
		$num_legs = count($reservation_details);
		for ($count =0; $count <= $num_legs - 1; $count += 1) {
		  	  //print_r($reservation_details[$count]['from']);
		$from[$count] = get_locations_view($reservation_details[$count]['from']);
		$to[$count] = get_locations_view($reservation_details[$count]['to']);
	
		if ($_POST['ampm'.$count.''] == 'PM') {
		$hours[$count] = $_POST['h'.$count.''] + 12;
		} else {
			if ($_POST['h'.$count.''] == '12') {
			$hours[$count] = ($_POST['h'.$count.''] - 12)*(-1);
			} else {
			$hours[$count] = $_POST['h'.$count.''];
			}
		}
		$time[$count] = $hours[$count].":".$_POST['m'.$count.''];
		$date[$count] = format_date($_POST['date'.$count.'']);
		
		$edit_reservation_details_sql = "UPDATE reservation_details SET time='".$time[$count]."', airline='".$_POST['airline'.$count.'']."', flight_number='".$_POST['flight_number'.$count.'']."', date='".$date[$count]."' WHERE id ='".$_POST['details_id'.$count.'']."'";
		
		//print_r($edit_reservation_details_sql);
		//exit;
		if(!$result = $db->insert_sql($edit_reservation_details_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		}
			return true;
		}	
	}
	
	//Format date
	function format_date($date){
		$newdate = substr($date, 0,10);
		$date_array = explode("/", $newdate);
		$newdate = $date_array[2] . "-".$date_array[0]."-".$date_array[1];
		return $newdate;
	}
	
	//Format back to Calendar date
	function format_to_caldate($date){
		$newdate = substr($date, 0,10);
		$date_array = explode("-", $newdate);
		$newdate = $date_array[1] . "/".$date_array[2]."/".$date_array[0];
		return $newdate;
	}
	
	
	// Get Search Result with pages
	function get_all_reservations_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 25;
			} else {
			$display = $_GET['pages'];
			};
			
			// Search criteria BEGIN
			
			
			if (empty($_GET['orderby'])) {
			$orderby_sql = " id DESC";
			} else {
				if ($_GET['orderby'] == 'name') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " first_name ASC";
					} else {
					$orderby_sql = " first_name DESC";
					}
				}
				
				
				if ($_GET['orderby'] == 'id') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " id ASC";
					} else {
					$orderby_sql = " id DESC";
					}
				}
				
				if ($_GET['orderby'] == 'date') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " reservation_date ASC";
					} else {
					$orderby_sql = " reservation_date DESC";
					}
				}
				
				if ($_GET['orderby'] == 'status') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " status ASC";
					} else {
					$orderby_sql = " status DESC";
					}
				}
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			
			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date FROM reservations WHERE client_id='".$_SESSION['client_id']."' ORDER BY $orderby_sql";
			
			$query_result=mysql_query($query);
			$num_records=@mysql_num_rows($query_result);
			if ($num_records > $display) { // More then 1 page.
			$num_pages = ceil ($num_records/$display);
			} else {
			$num_pages = 1;
			}
			}

			// Determinate where in the database to start returning result.
			if (isset($_GET['s'])) { // Already been determinated.
			$start = $_GET['s'];	
			} else {
			$start = 0;
			}

			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date, status, total_amount, location1, location2, location3, pickup_at_extra, travel_date_extra FROM reservations WHERE client_id='".$_SESSION['client_id']."' ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query; exit;
			
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="search" action="my_account.php" method="get">';
				echo '<table width="100%" style="padding-top:10px;" class="bodytxt">';
				echo '<tr>';
				echo '<td style="padding-left:10px;" class="bodytxt" align="left">';
				echo 'Listings per page ';
            	echo '<select name="pages" class="bodytxt" onchange="this.form.submit();">';
				echo '<option value="'.$display.'">'.$display.'</option>';
            	echo '<option value="10">10</option>';
            	echo '<option value="25">25</option>';
            	echo '<option value="50">50</option>';
            	echo '<option value="75">75</option>';
            	echo '<option value="100">100</option>';
            	echo '</select>';
				echo '</td><td style="padding-left:10px;" class="bodytxt" align="right">';
				echo '<span style="margin-right:10px" class="bodytxt">';
				$current_page = ($start/$display) + 1;
				//If it's not the first page, make a`Previous button.
				if ($current_page != 1) {
				echo '&lt;&lt; <a href="my_account.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="my_account.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';
				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="my_account.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="738" class="ot" align="center">
      <tbody><tr>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" background="images/middle_part2.jpg">
          <tbody><tr>
            <td width="11" height="11" background="images/top_left_curve.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
            </td>
            <td width="11" height="11" background="images/top_right_curve.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
          </tr>
         </tbody>
         </table>
         <table width="100%" cellpadding="0" cellspacing="0" border="0" background="images/middle_part2.jpg">
         <tbody>
          <tr>
          	<td width="11" height="100%">&nbsp;</td>
          	<td>
            <form name="displayfrm" method="post" action="my_account.php">
		<input type="hidden" value="" name="action">
		<table width="718" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="my_account.php?orderby=id&sort=desc" class="link2">ID</a>
					  <?php } else { ?>
                      <a href="my_account.php?orderby=id&sort=asc" class="link2">ID</a>
					  <?php } ?>
                      </td>
                      <td width="283" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Transportation Info</td>
                      <td width="120" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="my_account.php?orderby=date&sort=asc" class="link2">Reservation date</a>
					  <?php } else { ?>
                      <a href="my_account.php?orderby=date&sort=desc" class="link2">Reservation date</a>
					  <?php } ?>
                      </td>
                      <td width="55" colspan="2" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="my_account.php?orderby=status&sort=asc" class="link2">Status</a>
					  <?php } else { ?>
                      <a href="my_account.php?orderby=status&sort=desc" class="link2">Status</a>
					  <?php } ?>
                      </td>
                      <td width="55" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                  <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
            		echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="40" height="22" align="left" class="ot1"><a href="edit_reservation.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['id']; ?></strong></a></td>
                      <td width="283" align="left" class="ot1"><?php $trip_type = get_trip_types_view($value['trip_type']); ?><strong><?php echo $trip_type['name']; ?></strong><br />
                      <i><strong>Vehicle:</strong></i>&nbsp; <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?></td>
                     <td width="120" align="center" class="ot1"><?php echo format_to_caldate($value['reservation_date']); ?><br /><br /><?php if (!empty($value['total_amount'])) { echo "<strong><i>$".$value['total_amount']."</i></strong>"; }; ?></td>
                      <td width="55" colspan="2" align="center" class="ot1"><?php $status = get_statuses_view($value['status']); $icons = get_statuses_icon($status['icon_id']); if (empty($icons)) { echo $status['name']; } else { echo '<img src="images/icons/'.$icons['image'].'" border="0" title="'.$status['name'].'">'; }; ?></td>
                      <td width="55" height="22" align="center"><a href="edit_reservation.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a>&nbsp;&nbsp;<a href="print_reservation.php?id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Print" target="_blank"><img src="images/printmgr.png" border="0" /></a></td>
                      <td width="5"></td>
                    </tr>
                    <? 
					} 
					?>
                  </table>  
    </form>
            </td>
            <td width="11" height="100%">&nbsp;</td>
          </tr>
          </table>
          <table cellpadding="0" cellspacing="0" border="0" width="100%" background="images/middle_part2.jpg">
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
              	<td width="11" height="11" background="images/bottom_left_curve.jpg" style="background-repeat:no-repeat; background-position:bottom;"></td>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
                <td width="11" height="11" background="images/bottom_right_curve.jpg" style="background-repeat:no-repeat; background-position:bottom;"></td>
              </tr>
            </table>
			</td>
          </tr>
        </table>
		</td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="738" class="ot" align="center">
      <tbody><tr>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" background="images/middle_part2.jpg">
          <tbody><tr>
            <td width="11" height="11" background="images/top_left_curve.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
            </td>
            <td width="11" height="11" background="images/top_right_curve.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
          </tr>
         </tbody>
         </table>
         <table width="100%" cellpadding="0" cellspacing="0" border="0" background="images/middle_part2.jpg">
         <tbody>
          <tr>
          	<td width="11" height="100%">&nbsp;</td>
          	<td>
            <form name="displayfrm" method="post" action="my_account.php">
		<input type="hidden" value="" name="action">
		<table width="718" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">ID
                      </td>
                      <td width="283" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Transportation Info</td>
                      <td width="110" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Reservation date
                      </td>
                      <td width="55" colspan="2" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Status
                      </td>
                      <td width="55" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                    <? echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no reservations in the database. <a href="reserve.php" class="link1">Create a new reservation</a></strong></div><table><tr><td></td></tr>';  
					?> 
                  </table>  
                </form>
            </td>
            <td width="11" height="100%">&nbsp;</td>
          </tr>
          </table>
          <table cellpadding="0" cellspacing="0" border="0" width="100%" background="images/middle_part2.jpg">
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
              	<td width="11" height="11" background="images/bottom_left_curve.jpg" style="background-repeat:no-repeat; background-position:bottom;"></td>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
                <td width="11" height="11" background="images/bottom_right_curve.jpg" style="background-repeat:no-repeat; background-position:bottom;"></td>
              </tr>
            </table>
			</td>
          </tr>
        </table>
		</td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
	function checkCreditCard($cardnumber, $cardname, &$errornumber, &$errortext) {
	  // Define the cards we support. You may add additional card types.
	  //  Name:      As in the selection box of the form - must be same as user's
	  //  Length:    List of possible valid lengths of the card number for the card
	  //  prefixes:  List of possible prefixes for the card
	  //  checkdigit Boolean to say whether there is a check digit	  
	  // Don't forget - all but the last array definition needs a comma separator!


	  $cards = array (  array ('name' => 'American Express', 
							  'length' => '15', 
							  'prefixes' => '34,37',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Carte Blanche', 
							  'length' => '14', 
							  'prefixes' => '300,301,302,303,304,305,36,38',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Diners Club', 
							  'length' => '14',
							  'prefixes' => '300,301,302,303,304,305,36,38',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Discover', 
							  'length' => '16', 
							  'prefixes' => '6011',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Enroute', 
							  'length' => '15', 
							  'prefixes' => '2014,2149',
							  'checkdigit' => true
							 ),
					   array ('name' => 'JCB', 
							  'length' => '15,16', 
							  'prefixes' => '3,1800,2131',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Maestro', 
							  'length' => '16,18', 
							  'prefixes' => '5020,6',
							  'checkdigit' => true
							 ),
					   array ('name' => 'MasterCard', 
							  'length' => '16', 
							  'prefixes' => '51,52,53,54,55',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Solo', 
							  'length' => '16,18,19', 
							  'prefixes' => '6334,6767',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Switch', 
							  'length' => '16,18,19', 
							  'prefixes' => '4903,4905,4911,4936,564182,633110,6333,6759',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Visa', 
							  'length' => '13,16', 
							  'prefixes' => '4',
							  'checkdigit' => true
							 ),
					   array ('name' => 'Visa Electron', 
							  'length' => '16', 
							  'prefixes' => '417500,4917,4913',
							  'checkdigit' => true
							 )
					);
	
	  $ccErrorNo = 0;
	
	  $ccErrors [0] = "Unknown card type";
	  $ccErrors [1] = "No card number provided";
	  $ccErrors [2] = "Credit card number has invalid format";
	  $ccErrors [3] = "Credit card number is invalid";
	  $ccErrors [4] = "Credit card number is wrong length";
				   
	  // Establish card type
	  $cardType = -1;
	  for ($i=0; $i<sizeof($cards); $i++) {
	
		// See if it is this card (ignoring the case of the string)
		if (strtolower($cardname) == strtolower($cards[$i]['name'])) {
		  $cardType = $i;
		  break;
		}
	  }
	  
	  // If card type not found, report an error
	  if ($cardType == -1) {
		 $errornumber = 0;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  }
	   
	  // Ensure that the user has provided a credit card number
	  if (strlen($cardnumber) == 0)  {
		 $errornumber = 1;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  }
	  
	  // Remove any spaces from the credit card number
	  $cardNo = str_replace (' ', '', $cardnumber);  
	   
	  // Check that the number is numeric and of the right sort of length.
	  if (!eregi('^[0-9]{13,19}$',$cardNo))  {
		 $errornumber = 2;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  }
		   
	  // Now check the modulus 10 check digit - if required
	  if ($cards[$cardType]['checkdigit']) {
		$checksum = 0;                                  // running checksum total
		$mychar = "";                                   // next char to process
		$j = 1;                                         // takes value of 1 or 2
	  
		// Process each digit one by one starting at the right
		for ($i = strlen($cardNo) - 1; $i >= 0; $i--) {
		
		  // Extract the next digit and multiply by 1 or 2 on alternative digits.      
		  $calc = $cardNo{$i} * $j;
		
		  // If the result is in two digits add 1 to the checksum total
		  if ($calc > 9) {
			$checksum = $checksum + 1;
			$calc = $calc - 10;
		  }
		
		  // Add the units element to the checksum total
		  $checksum = $checksum + $calc;
		
		  // Switch the value of j
		  if ($j ==1) {$j = 2;} else {$j = 1;};
		} 
	  
		// All done - if checksum is divisible by 10, it is a valid modulus 10.
		// If not, report an error.
		if ($checksum % 10 != 0) {
		 $errornumber = 3;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
		}
	  }  
	
	  // The following are the card-specific checks we undertake.
	
	  // Load an array with the valid prefixes for this card
	  $prefix = split(',',$cards[$cardType]['prefixes']);
		  
	  // Now see if any of them match what we have in the card number  
	  $PrefixValid = false; 
	  for ($i=0; $i<sizeof($prefix); $i++) {
		$exp = '^' . $prefix[$i];
		if (ereg($exp,$cardNo)) {
		  $PrefixValid = true;
		  break;
		}
	  }
		  
	  // If it isn't a valid prefix there's no point at looking at the length
	  if (!$PrefixValid) {
		 $errornumber = 3;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  }
		
	  // See if the length is valid for this card
	  $LengthValid = false;
	  $lengths = split(',',$cards[$cardType]['length']);
	  for ($j=0; $j<sizeof($lengths); $j++) {
		if (strlen($cardNo) == $lengths[$j]) {
		  $LengthValid = true;
		  break;
		}
	  }
	  
	  // See if all is OK by seeing if the length was valid. 
	  if (!$LengthValid) {
		 $errornumber = 4;     
		 $errortext = $ccErrors [$errornumber];
		 return false; 
	  };   
	  
	  // The credit card is in the required format.
	  return true;

	}
	
	//Get Report Reservations
	function get_report_reservations($from, $to, $vehicle_id, $status_id){
		global $db;
		if (!empty($vehicle_id)) {
		$searchby_sql = " AND vehicle_id='$vehicle_id'";
		}
		if (!empty($status_id)) {
		$searchby_sql2 = " AND status='$status_id'";
		}
			$get_report_reservations_sql = "SELECT r.id, r.vehicle_id, r.location1_id, r.location2_id, r.trip_type, r.total_amount, v.name, r.first_name, r.last_name, r.status  FROM reservations r INNER JOIN vehicles v ON r.vehicle_id=v.id WHERE r.reservation_date BETWEEN '$from' AND '$to' $searchby_sql $searchby_sql2 ORDER BY r.reservation_date DESC";
			
			if(!$result = $db->select($get_report_reservations_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$report_reservations[] = $data;
				return $report_reservations;
			}
	}
	
	//Format Exp Date
	function format_exp_date($date){
		$newdate = substr($date, 0,10);
		$date_array = explode("/", $newdate);
		$newdate = $date_array;
		return $newdate;
	}
	
	// Get current Reservation
	function get_reservation_view($id){
		global $db;
			$get_reservation_view_sql = "SELECT * FROM reservations where id='$id'";
			if(!$result = $db->select($get_reservation_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit Reservation
	function edit_reservations($id){
	global $db;
	if ($_POST['ampm'] == 'PM') {
	$hours = $_POST['h'] + 12;
	} else {
		if ($_POST['h'] == '12') {
		$hours = ($_POST['h'] - 12)*(-1);
		} else {
		$hours = $_POST['h'];
		}
	}
	if ($_POST['ampm1'] == 'PM') {
	$hours1 = $_POST['h1'] + 12;
	} else {
		if ($_POST['h1'] == '12') {
		$hours1 = ($_POST['h1'] - 12)*(-1);
		} else {
		$hours1 = $_POST['h1'];
		}
	}
	if ($_POST['ampm2'] == 'PM') {
	$hours2 = $_POST['h2'] + 12;
	} else {
		if ($_POST['h2'] == '12') {
		$hours2 = ($_POST['h2'] - 12)*(-1);
		} else {
		$hours2 = $_POST['h2'];
		}
	}
	if ($_POST['ampm3'] == 'PM') {
	$hours3 = $_POST['h3'] + 12;
	} else {
		if ($_POST['h3'] == '12') {
		$hours3 = ($_POST['h3'] - 12)*(-1);
		} else {
		$hours3 = $_POST['h3'];
		}
	}
	if ($_POST['ampm4'] == 'PM') {
	$hours4 = $_POST['h4'] + 12;
	} else {
		if ($_POST['h4'] == '12') {
		$hours4 = ($_POST['h4'] - 12)*(-1);
		} else {
		$hours4 = $_POST['h4'];
		}
	}
	$pickup_at = $hours.":".$_POST['m'];
	$arriving_at = $hours1.":".$_POST['m1'];
	$pickup_at_roundtrip = $hours2.":".$_POST['m2'];
	$departing_at = $hours3.":".$_POST['m3'];
	$travel_date = format_date($_POST['travel_date']);
	$travel_date_roundtrip = format_date($_POST['travel_date_roundtrip']);
	$exp_date = $_POST['ExpMonth']."/".$_POST['ExpYear'];
	//echo $pickup_at_roundtrip;
	//exit;
		$edit_reservations_sql = "UPDATE reservations SET client_id='".$_SESSION['client_id']."', travel_date='".$travel_date."', child_carseat='".$_POST['child_carseat']."', booster_seat='".$_POST['child_boosterseat']."', pickup_at='".$pickup_at."', arriving_airline='".$_POST['arriving_airline']."', flight_number='".$_POST['flight_number']."', arriving_at='".$arriving_at."', travel_date_roundtrip='".$travel_date_roundtrip."', pickup_at_roundtrip='".$pickup_at_roundtrip."', departing_airline_roundtrip='".$_POST['departing_airline_roundtrip']."', flight_number_roundtrip='".$_POST['flight_number_roundtrip']."', departing_at='".$departing_at."', first_name='".$_POST['first_name']."', last_name='".$_POST['last_name']."', address='".$_POST['address']."', address2='".$_POST['address2']."', city='".$_POST['town']."', state='".$_POST['state']."', zip='".$_POST['zip']."', country='".$_POST['country']."', email='".$_POST['email']."', phone_number='".$_POST['phone_number']."', cellphone='".$_POST['cellphone']."', first_name_billing='".$_POST['first_name_billing']."',
		last_name_billing='".$_POST['last_name_billing']."', city_billing='".$_POST['city_billing']."', state_billing='".$_POST['state_billing']."', zip_billing='".$_POST['zip_billing']."', country_billing='".$_POST['country_billing']."', card_number='".$_POST['card_number']."', card_type='".$_POST['card_type']."', exp_date='".$exp_date."', customer_comments='".$_POST['customer_comments']."', paying_cash='".$_POST['paying_cash']."', store_stop='".$_POST['store_stop']."' where id='$id'";

		if(!$result = $db->insert_sql($edit_reservations_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	// Edit Cardholder Info
	function edit_cardholder_info($id){
	global $db;
		$edit_cardholder_info_sql = "UPDATE reservations SET first_name_billing='".$_POST['first_name_billing']."',
		last_name_billing='".$_POST['last_name_billing']."', address_billing='".$_POST['address_billing']."', address2_billing='".$_POST['address2_billing']."', city_billing='".$_POST['city_billing']."', state_billing='".$_POST['state_billing']."', zip_billing='".$_POST['zip_billing']."', country_billing='".$_POST['country_billing']."' where id='$id'";
		
		//print_r($edit_cardholder_info_sql);
		//exit;

		if(!$result = $db->insert_sql($edit_cardholder_info_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	// Edit Passenger Info
	function edit_passenger_info($id){
	global $db;
		$edit_passenger_info_sql = "UPDATE reservations SET first_name='".$_POST['first_name']."', last_name='".$_POST['last_name']."', address='".$_POST['address']."', address2='".$_POST['address2']."', city='".$_POST['town']."', state='".$_POST['state']."', zip='".$_POST['zip']."', country='".$_POST['country']."', phone_number='".$_POST['phone_number']."', cellphone='".$_POST['cellphone']."' where id='$id'";
		
		//print_r($edit_cardholder_info_sql);
		//exit;

		if(!$result = $db->insert_sql($edit_passenger_info_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	// Edit Reservation Info
	function edit_reservation_info($id){
	global $db;
		$edit_reservation_info_sql = "UPDATE reservations SET customer_comments='".$_POST['customer_comments']."' where id='$id'";
		
		//print_r($edit_cardholder_info_sql);
		//exit;

		if(!$result = $db->insert_sql($edit_reservation_info_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	
	// Edit Payment info
	function edit_payment_info($id){
	global $db;
	$exp_date = $_POST['ExpMonth']."/".$_POST['ExpYear'];

		$edit_payment_info_sql = "UPDATE reservations SET card_number='".$_POST['card_number']."', card_type='".$_POST['card_type']."', exp_date='".$exp_date."', paying_cash='".$_POST['paying_cash']."' where id='$id'";

		if(!$result = $db->insert_sql($edit_payment_info_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	//Check Reservation for CC update
	function check_reservation($date){
		$company_info = get_company_info(); 
		//echo $company_info['minimum_time'];
		$expiration_time = strtotime('+'.$company_info['minimum_time'].' days');
		$expiration_date = date("Y-m-d", $expiration_time);
		//print_r($expiration_date);
		//echo "<br>";
		//print_r($date);
		//exit;
		if ($expiration_date > $date) {
		return false;
		} else {
		return true;
		}
	}
	
	// Check Reservation for Change Request 
	function check_reservation2($date){
		$expiration_date = date("Y-m-d");
		//print_r($expiration_date);
		//echo "<br>";
		//print_r($date);
		//exit;
		if ($expiration_date > $date) {
		return false;
		} else {
		return true;
		}
	}
	
	//Get Arrival Data
	function get_arrival_data($reservation_id){
		global $db;
			$get_arrival_data_sql = "SELECT * FROM reservation_details WHERE reservation_id='$reservation_id' ORDER BY id ASC LIMIT 1";

			if(!$result = $db->select($get_arrival_data_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$arrival_data[] = $data;
				return $arrival_data;
			}
	}
?>