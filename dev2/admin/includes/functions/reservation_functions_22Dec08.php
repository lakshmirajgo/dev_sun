<?php
	//Get ALL Reservations
	function get_all_reservations(){
		global $db;
			$get_all_reservations_sql = "SELECT * FROM reservations ORDER BY id DESC";
			if(!$result = $db->select($get_all_reservations_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_reservations[] = $data;
				return $all_reservations;
			}
	}
	
	function get_all_reservations_for_email(){
		global $db;
			$get_all_reservations_for_email_sql = "SELECT email, travel_date_roundtrip, travel_date, arriving_at, departing_at FROM reservations WHERE status !='11' or status !='7' ORDER BY id DESC";
			if(!$result = $db->select($get_all_reservations_for_email_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_reservations_email[] = $data;
				return $all_reservations_email;
			}
	}
	
	// Get current Reservation
	function count_clients_reservations($client_id){
		global $db;
			$get_clients_reservations_sql = "SELECT * FROM reservations WHERE client_id='$client_id' ORDER BY id DESC";
			if(!$result = $db->select($get_clients_reservations_sql)){
				echo $_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$count_clients_reservations[] = $data;
				return $count_clients_reservations;
			}
	}
	
	// Get Clients Reservation
	function get_clients_reservations($client_id){
		global $db;
			$get_clients_reservations_sql = "SELECT * FROM reservations where client_id='$client_id'";
			if(!$result = $db->select($get_clients_reservations_sql)){
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
	$_POST['h'] = $_POST['h'] + 12;
	} else {
		$hours = $_POST['h'];
	}
	if ($_POST['ampm1'] == 'PM') {
	$_POST['h1'] = $_POST['h1'] + 12;
	} else {
		$hours1 = $_POST['h1'];
	}
	if ($_POST['ampm2'] == 'PM') {
	$_POST['h2'] = $_POST['h2'] + 12;
	} else {
		$hours2 = $_POST['h2'];
	}
	if ($_POST['ampm3'] == 'PM') {
	$_POST['h3'] = $_POST['h3'] + 12;
	} else {
		$hours3 = $_POST['h3'];
	}
	if ($_POST['ampm4'] == 'PM') {
	$_POST['h4'] = $_POST['h4'] + 12;
	} else {
		$hours4 = $_POST['h4'];
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
		$edit_reservations_sql = "UPDATE reservations SET vehicle_id='".$_POST['vehicle_id']."', location1_id='".$_POST['from']."', location2_id='".$_POST['to']."', travel_date='".$travel_date."', passenger_count='".$_POST['passenger_count']."', child_carseat='".$_POST['child_carseat']."', booster_seat='".$_POST['child_boosterseat']."', trip_type='".$_POST['trip_type']."', pickup_at='".$pickup_at."', arriving_airline='".$_POST['arriving_airline']."', flight_number='".$_POST['flight_number']."', arriving_at='".$arriving_at."', travel_date_roundtrip='".$travel_date_roundtrip."', pickup_at_roundtrip='".$pickup_at_roundtrip."', departing_airline_roundtrip='".$_POST['departing_airline_roundtrip']."', flight_number_roundtrip='".$_POST['flight_number_roundtrip']."', departing_at='".$departing_at."', first_name='".$_POST['first_name']."', last_name='".$_POST['last_name']."', address='".$_POST['address']."', address2='".$_POST['address2']."', city='".$_POST['town']."', state='".$_POST['state']."', zip='".$_POST['zip']."', country='".$_POST['country']."', email='".$_POST['email']."', first_name_billing='".$_POST['first_name_billing']."',
		last_name_billing='".$_POST['last_name_billing']."', city_billing='".$_POST['city_billing']."', state_billing='".$_POST['state_billing']."', zip_billing='".$_POST['zip_billing']."', country_billing='".$_POST['country_billing']."', card_number='".$_POST['card_number']."', card_type='".$_POST['card_type']."', exp_date='".$exp_date."', status='".$_POST['status']."', customer_comments='".$_POST['customer_comments']."', admin_comments='".$_POST['admin_comments']."', paying_cash='".$_POST['paying_cash']."', store_stop='".$_POST['store_stop']."' where id='$id'";

		if(!$result = $db->insert_sql($edit_reservations_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	
	
	// Add a new Reservation
	function add_reservations(){
	global $db; 
	if ($_POST['ampm'] == 'PM') {
	$_POST['h'] = $_POST['h'] + 12;
	} else {
		$hours = $_POST['h'];
	}
	if ($_POST['ampm1'] == 'PM') {
	$_POST['h1'] = $_POST['h1'] + 12;
	} else {
		$hours1 = $_POST['h1'];
	}
	if ($_POST['ampm2'] == 'PM') {
	$_POST['h2'] = $_POST['h2'] + 12;
	} else {
		$hours2 = $_POST['h2'];
	}
	if ($_POST['ampm3'] == 'PM') {
	$_POST['h3'] = $_POST['h3'] + 12;
	} else {
		$hours3 = $_POST['h3'];
	}
	if ($_POST['ampm4'] == 'PM') {
	$_POST['h4'] = $_POST['h4'] + 12;
	} else {
		$hours4 = $_POST['h4'];
	}
	$pickup_at = $hours.":".$_POST['m'];
	if (empty($_POST['m1'])) {
	$arriving_at = $pickup_at;
	} else {
	$arriving_at = $hours1.":".$_POST['m1'];
	};
	$pickup_at_roundtrip = $hours2.":".$_POST['m2'];
	if (empty($_POST['m3'])) {
	$departing_at = $pickup_at_roundtrip;
	} else {
	$departing_at = $hours3.":".$_POST['m3'];
	};
	$travel_date = format_date($_POST['travel_date']);
	$travel_date_roundtrip = format_date($_POST['travel_date_roundtrip']);
	$exp_date = $_POST['ExpMonth']."/".$_POST['ExpYear'];
	
	$reservation_date = date('Y-m-j h:i:s'); 
	$location1 = $_POST['location1'];
	$location2 = $_POST['location3'];
	$location3 = $_POST['location2'];

		$add_reservations_sql = "INSERT INTO reservations (client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, booster_seat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, address_billing, address2_billing, city_billing, state_billing, zip_billing, country_billing, total_amount, card_number, card_type, exp_date, reservation_date, status, customer_comments, admin_comments, location1, location2, location3, pickup_at_extra, travel_date_extra, paying_cash, store_stop) 
		
		values('".$_POST['client_id']."', 
		'".$_POST['vehicle_id']."', 
		'".$_POST['from']."', 
		'".$_POST['to']."', 
		'".$travel_date."', 
		'".$_POST['passenger_count']."', 
		'".$_POST['child_carseat']."',
		'".$_POST['child_boosterseat']."', 
		'".$_POST['trip_type']."', 
		'".$pickup_at."', 
		'".$_POST['arriving_airline']."', 
		'".$_POST['flight_number']."', 
		'".$arriving_at."', 
		'".$travel_date_roundtrip."', 
		'".$pickup_at_roundtrip."', 
		'".$_POST['departing_airline_roundtrip']."',	
		'".$_POST['flight_number_roundtrip']."', 
		'".$departing_at."', 
		'".$_POST['first_name']."', 
		'".$_POST['last_name']."', 
		'".$_POST['address']."', 
		'".$_POST['address2']."', 
		'".$_POST['town']."', 
		'".$_POST['state']."', 
		'".$_POST['zip']."', 
		'".$_POST['country']."', 
		'".$_POST['email']."', 
		'".$_POST['first_name_billing']."', 
		'".$_POST['last_name_billing']."', 
		'".$_POST['address_billing']."',
		'".$_POST['address2_billing']."',
		'".$_POST['city_billing']."',
		'".$_POST['state_billing']."', 
		'".$_POST['zip_billing']."', 
		'".$_POST['country_billing']."', 
		'".$_POST['total_amount']."',
		'".$_POST['card_number']."', 
		'".$_POST['card_type']."', 
		'".$exp_date."', 
		'$reservation_date', 
		'".$_POST['status']."', 
		'".$_POST['customer_comments']."', 
		'".$_POST['admin_comments']."', '".$location1."', '".$location2."', '".$location3."', '$pickup_at_extra', '$travel_date_extra', '".$_POST['paying_cash']."', '".$_POST['store_stop']."')";
		
		//print_r($add_reservations_sql);
		//exit;

		if(!$result = $db->insert_sql($add_reservations_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
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
	
	// Update Status
	function update_status($status, $id){
	global $db;
		$update_status_sql = "UPDATE reservations SET status='$status' where id='$id'";

		if(!$result = $db->insert_sql($update_status_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	//Format Exp Date
	function format_exp_date($date){
		$newdate = substr($date, 0,10);
		$date_array = explode("/", $newdate);
		$newdate = $date_array;
		return $newdate;
	}
	
	// Delete Selected Reservations
	function delete_reservations($id){
	global $db;
	$count =0;
		while($count < count($id)){
			$delete_reservations_sql = "Delete from reservations where id='".$id[$count]."'";
			if(!$db->select($delete_reservations_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				exit;
			}
			$count++;
		}
			
		return true;
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
			
			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date FROM reservations ORDER BY $orderby_sql";
			
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

			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date, status, total_amount, location1, location2, location3, pickup_at_extra, travel_date_extra FROM reservations ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query; exit;
			
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="search" action="reservation_manager.php" method="get">';
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
				echo '&lt;&lt; <a href="reservation_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="reservation_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';
				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="reservation_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>RESERVATION MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_manager.php?orderby=id&sort=desc" class="link2">ID</a>
					  <?php } else { ?>
                      <a href="reservation_manager.php?orderby=id&sort=asc" class="link2">ID</a>
					  <?php } ?>
                      </td>
                      <td width="110" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_manager.php?orderby=name&sort=desc" class="link2">Client</a>
					  <?php } else { ?>
                      <a href="reservation_manager.php?orderby=name&sort=asc" class="link2">Client</a>
					  <?php } ?>
                      </td>
                      <td width="293" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Transportation Info</td>
                      <td width="110" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_manager.php?orderby=date&sort=asc" class="link2">Date submitted</a>
					  <?php } else { ?>
                      <a href="reservation_manager.php?orderby=date&sort=desc" class="link2">Date submitted</a>
					  <?php } ?>
                      </td>
                      <td width="55" colspan="2" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_manager.php?orderby=status&sort=asc" class="link2">Status</a>
					  <?php } else { ?>
                      <a href="reservation_manager.php?orderby=status&sort=desc" class="link2">Status</a>
					  <?php } ?>
                      </td>
                      <td width="70" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                  <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
            		echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="37" height="22" align="center" class="ot1"><input name="id[]" type="checkbox" value="<?php echo $value['id']; ?>"></td> 
                      <td width="40" height="22" align="left" class="ot1"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['id']; ?></strong></a></td>
                      <td width="110" height="22" align="left" class="ot1"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?></strong></a></td>
                      <td width="293" align="left" class="ot1"><?php $trip_type = get_trip_types_view($value['trip_type']); ?><strong><?php echo $trip_type['name']; ?></strong><br /><br />
                      <?php if ($value['trip_type'] == '7' || $value['trip_type'] == '8' || $value['trip_type'] == '10') {
					  echo $value['location1'].">".$value['location2'].">".$value['location3'].">".$value['location1'];
					  echo "<br>";
					  } else { ?>
					  <i><strong>From:</strong></i>&nbsp; <?php if ($value['location1_id'] == '1a' || $value['location1_id'] == '2a') { $from = get_airports_view($value['location1_id']); } else { if ($value['location1_id'] == '1c' || $value['location1_id'] == '2c' || $value['location1_id'] == '3c' || $value['location1_id'] == '4c' || $value['location1_id'] == '5c' || $value['location1_id'] == '6c' || $value['location1_id'] == '7c' || $value['location1_id'] == '8c') { $from = get_cruises_view($value['location1_id']); } else { $from = get_locations_view($value['location1_id']); }; }; ?><?php echo $from['name']; ?><br /><i><strong>To:</strong></i>&nbsp; <?php if ($value['location2_id'] == '1a' || $value['location2_id'] == '2a') { $to = get_airports_view($value['location2_id']); } else { if ($value['location2_id'] == '1c' || $value['location2_id'] == '2c' || $value['location2_id'] == '3c' || $value['location2_id'] == '4c' || $value['location2_id'] == '5c' || $value['location2_id'] == '6c' || $value['location2_id'] == '7c' || $value['location2_id'] == '8c') { $to = get_cruises_view($value['location2_id']); } else { $to = get_locations_view($value['location2_id']); }; }; ?><?php echo $to['name']; ?><br />				  
					  <?php } ?>
                      <i><strong>Vehicle:</strong></i>&nbsp; <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?><br /><i><strong>Passengers:</strong></i>  &nbsp;<?php echo $value['passenger_count']; ?><br /><strong>CS:</strong> <?php echo $value['child_carseat']; ?>; <strong>BS:</strong> <?php echo $value['booster_seat']; ?><br /><?php if (!empty($value['arriving_airline']) || !empty($value['departing_airline_roundtrip'])) { echo '<i><strong>Flight #:</strong></i> &nbsp;'; if (!empty($value['arriving_airline'])) { echo "A: ".$value['arriving_airline']." " .$value['flight_number']."; "; }; if (!empty($value['departing_airline_roundtrip'])) { echo "D: " .$value['departing_airline_roundtrip']." " .$value['flight_number_roundtrip']."<br />"; }; };?></td>
                     <td width="110" align="center" class="ot1"><?php echo format_to_caldate($value['reservation_date']); ?><br /><br /><strong>Transfer date</strong><br /><?php if ($value['travel_date'] !='0000-00-00 00:00:00') { echo "A: ". format_to_caldate($value['travel_date'])."<br />"; }; ?><?php if ($value['travel_date_roundtrip'] !='0000-00-00 00:00:00') { echo "D: ". format_to_caldate($value['travel_date_roundtrip'])."<br />"; }; ?><?php if ($value['travel_date_extra'] !='0000-00-00 00:00:00') { echo "T: ". format_to_caldate($value['travel_date_extra'])."<br />"; }; ?><br /><?php if (!empty($value['total_amount'])) { echo "<strong><i>$".$value['total_amount']."</i></strong>"; }; ?></td>
                      <td width="55" colspan="2" align="center" class="ot1"><?php $status = get_statuses_view($value['status']); $icons = get_statuses_icon($status['icon_id']); if (empty($icons)) { echo $status['name']; } else { echo '<img src="images/icons/'.$icons['image'].'" border="0">'; }; ?></td>
                      <td width="70" height="22" align="center"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a>&nbsp;&nbsp;<a href="print_manager.php?cAction=print&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Print" target="_blank"><img src="images/printmgr.png" border="0" /></a>&nbsp;&nbsp;<a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this reservation?\n\nNotice: deleted reservation cannot be restored')" /></a></td>
                      <td width="5"></td>
                    </tr>
                    <? 
					} 
					?>
                  </table>  
                 <input name="delete_selected" type="submit" value="Delete selected"> 
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>RESERVATION MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">ID
                      </td>
                      <td width="110" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Client
                      </td>
                      <td width="293" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Transportation Info</td>
                      <td width="110" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Date submitted
                      </td>
                      <td width="55" colspan="2" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Status
                      </td>
                      <td width="70" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                    <? echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no reservations in the database. <a href="reservation_manager.php?cAction=create_new" class="link1">Create a new reservation</a></strong></div><table><tr><td></td></tr>';  
					?> 
                  </table>  
                 <input name="delete_selected" type="submit" value="Delete selected"> 
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
	
	// Get Search Result with pages
	function get_search_reservations_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 25;
			} else {
			$display = $_GET['pages'];
			};
			
			// Search criteria BEGIN
			if (empty($_GET['search_by'])) {
			$searchby_sql = " first_name LIKE '%".$_GET['where']."%' OR last_name LIKE '%".$_GET['where']."%'";
			} else {
				if ($_GET['search_by'] == 'name') {
					$searchby_sql = " first_name LIKE '%".$_GET['where']."%' OR last_name LIKE '%".$_GET['where']."%'";
				}
				
				
				if ($_GET['search_by'] == 'id') {
					$searchby_sql = " id ='".$_GET['where']."'";
				}
				
				if ($_GET['search_by'] == 'client_id') {
					$searchby_sql = " client_id ='".$_GET['where']."'";
				}
				
				if ($_GET['search_by'] == 'email') {
					$searchby_sql = " email LIKE '%".$_GET['where']."%'";
				}
		
			}
			
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
			
			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date, status, total_amount FROM reservations WHERE $searchby_sql ORDER BY $orderby_sql";
			
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

			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date, status, total_amount FROM reservations WHERE $searchby_sql ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
						
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="reservation_manager.php" method="get">';
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
				echo '&lt;&lt; <a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>RESERVATION SEARCH</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_search.php?orderby=id&sort=desc" class="link2">ID</a>
					  <?php } else { ?>
                      <a href="reservation_search.php?orderby=id&sort=asc" class="link2">ID</a>
					  <?php } ?>
                      </td>
                      <td width="110" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_search.php?orderby=name&sort=desc" class="link2">Client</a>
					  <?php } else { ?>
                      <a href="reservation_search.php?orderby=name&sort=asc" class="link2">Client</a>
					  <?php } ?>
                      </td>
                      <td width="293" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Transportation Info</td>
                      <td width="110" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_search.php?orderby=date&sort=asc" class="link2">Date submitted</a>
					  <?php } else { ?>
                      <a href="reservation_search.php?orderby=date&sort=desc" class="link2">Date submitted</a>
					  <?php } ?>
                      </td>
                      <td width="55" colspan="2" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="reservation_search.php?orderby=status&sort=asc" class="link2">Status</a>
					  <?php } else { ?>
                      <a href="reservation_search.php?orderby=status&sort=desc" class="link2">Status</a>
					  <?php } ?>
                      </td>
                      <td width="70" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                  <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
            		echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="37" height="22" align="center" class="ot1"><input name="id[]" type="checkbox" value="<?php echo $value['id']; ?>"></td> 
                      <td width="40" height="22" align="left" class="ot1"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['id']; ?></strong></a></td>
                      <td width="110" height="22" align="left" class="ot1"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?></strong></a></td>
                      <td width="293" align="left" class="ot1"><?php $trip_type = get_trip_types_view($value['trip_type']); ?><strong><?php echo $trip_type['name']; ?></strong><br /><br /><i><strong>From:</strong></i>&nbsp; <?php if ($value['location1_id'] == '1a' || $value['location1_id'] == '2a') { $from = get_airports_view($value['location1_id']); } else { if ($value['location1_id'] == '1c' || $value['location1_id'] == '2c' || $value['location1_id'] == '3c' || $value['location1_id'] == '4c' || $value['location1_id'] == '5c' || $value['location1_id'] == '6c' || $value['location1_id'] == '7c' || $value['location1_id'] == '8c') { $from = get_cruises_view($value['location1_id']); } else { $from = get_locations_view($value['location1_id']); }; }; ?><?php echo $from['name']; ?><br /><i><strong>To:</strong></i>&nbsp; <?php if ($value['location2_id'] == '1a' || $value['location2_id'] == '2a') { $to = get_airports_view($value['location2_id']); } else { if ($value['location2_id'] == '1c' || $value['location2_id'] == '2c' || $value['location2_id'] == '3c' || $value['location2_id'] == '4c' || $value['location2_id'] == '5c' || $value['location2_id'] == '6c' || $value['location2_id'] == '7c' || $value['location2_id'] == '8c') { $to = get_cruises_view($value['location2_id']); } else { $to = get_locations_view($value['location2_id']); }; }; ?><?php echo $to['name']; ?><br /><i><strong>Vehicle:</strong></i>&nbsp; <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?><br /><i><strong>Passengers:</strong></i>  &nbsp;<?php echo $value['passenger_count']; ?><br /><strong>CS:</strong> <?php echo $value['child_carseat']; ?>; <strong>BS:</strong> <?php echo $value['booster_seat']; ?><br /><?php if (!empty($value['arriving_airline']) || !empty($value['departing_airline_roundtrip'])) { echo '<i><strong>Flight #:</strong></i> &nbsp;'; if (!empty($value['arriving_airline'])) { echo "A: ".$value['arriving_airline']." " .$value['flight_number']."; "; }; if (!empty($value['departing_airline_roundtrip'])) { echo "D: " .$value['departing_airline_roundtrip']." " .$value['flight_number_roundtrip']."<br />"; }; };?></td>
                     <td width="110" align="center" class="ot1"><?php echo format_to_caldate($value['reservation_date']); ?><br /><br /><strong>Transfer date</strong><br /><?php if ($value['travel_date'] !='0000-00-00 00:00:00') { echo "A: ". format_to_caldate($value['travel_date'])."<br />"; }; ?><?php if ($value['travel_date_roundtrip'] !='0000-00-00 00:00:00') { echo "D: ". format_to_caldate($value['travel_date_roundtrip'])."<br />"; }; ?><?php if ($value['travel_date_extra'] !='0000-00-00 00:00:00') { echo "T: ". format_to_caldate($value['travel_date_extra'])."<br />"; }; ?><br /><?php if (!empty($value['total_amount'])) { echo "<strong><i>$".$value['total_amount']."</i></strong>"; }; ?></td>
                      <td width="55" colspan="2" align="center" class="ot1"><?php $status = get_statuses_view($value['status']); $icons = get_statuses_icon($status['icon_id']); if (empty($icons)) { echo $status['name']; } else { echo '<img src="images/icons/'.$icons['image'].'" border="0">'; }; ?></td>
                      <td width="70" height="22" align="center"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a>&nbsp;&nbsp;<a href="print_manager.php?cAction=print&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Print" target="_blank"><img src="images/printmgr.png" border="0" /></a>&nbsp;&nbsp;<a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this reservation?\n\nNotice: deleted reservation cannot be restored')" /></a></td>
                      <td width="5"></td>
                    </tr>
                    <? 
					} 
					?>
                  </table>  
                 <input name="delete_selected" type="submit" value="Delete selected"> 
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>RESERVATION SEARCH</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">ID
                      </td>
                      <td width="110" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Client
                      </td>
                      <td width="293" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Transportation Info</td>
                      <td width="110" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Date submitted
                      </td>
                      <td width="55" colspan="2" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Status
                      </td>
                      <td width="70" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                    <? echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no reservations in the database. <a href="reservation_manager.php?cAction=create_new" class="link1">Create a new reservation</a></strong></div><table><tr><td></td></tr>';  
					?> 
                  </table>  
                 <input name="delete_selected" type="submit" value="Delete selected"> 
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
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
	function get_report_reservations($from, $to, $vehicle_id, $status_id, $trip_type){
		global $db;
		if (!empty($vehicle_id)) {
		$searchby_sql = " AND vehicle_id='$vehicle_id'";
		}
		if (!empty($status_id)) {
		$searchby_sql2 = " AND status='$status_id'";
		}
		
		if (!empty($trip_type)) {
		$searchby_sql2 = " AND trip_type='$trip_type'";
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
	
	
	
	// Get Arrivals Result with pages
	function get_arrivals_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 100;
			} else {
			$display = $_GET['pages'];
			};
			
			if (empty($_GET['orderby'])) {
			$orderby_sql = " arriving_at ASC";
			} else {
				if ($_GET['orderby'] == 'arrival_time') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " arriving_at ASC";
					} else {
					$orderby_sql = " arriving_at DESC";
					}
				}
				
				if ($_GET['orderby'] == 'vehicle') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " vehicle_id ASC";
					} else {
					$orderby_sql = " vehicle_id DESC";
					}
				}
				
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			$todays_date = date('Y-m-j 00:00:00'); 
			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date, status, total_amount, travel_date_extra, location1, location2, location3 FROM reservations WHERE travel_date = '$todays_date' ORDER BY $orderby_sql";
			
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

			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, booster_seat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date, status, total_amount, travel_date_extra, location1, location2, location3, customer_comments, paying_cash, store_stop FROM reservations WHERE travel_date = '$todays_date' ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
						
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="reservation_manager.php" method="get">';
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
				echo '&lt;&lt; <a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS ARRIVALS</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Client, Depart</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby=arrival_time&sort=asc" class="link3">Arrival Time</a>
					  <?php } else { ?>
                      <a href="index.php?orderby=arrival_time&sort=desc" class="link3">Arrival Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Passengers, <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby=vehicle&sort=asc" class="link3">Vehicle</a>
					  <?php } else { ?>
                      <a href="index.php?orderby=vehicle&sort=desc" class="link3">Vehicle</a>
					  <?php } ?>, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
            <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					if($bgcolor=="#fefef8") $bgcolor="#FFFFFF"; else $bgcolor="#fefef8";
            		echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="5%" class="ob" bgcolor="#CCCCCC" valign="top"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong>Detail</strong><br /><?php echo $value['id']; ?></a></td>
                	  <td width="25%" class="ob" bgcolor="#d9ecff" valign="top"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['last_name']; ?></strong>, <?php echo $value['first_name']; ?></a><br /><br /><?php $trip_type = get_trip_types_view($value['trip_type']); ?><?php echo $trip_type['name']; ?></td>
                	  <td width="20%" class="ob" valign="top"><?php echo "<strong>".format_time($value['arriving_at'])."</strong>, "; ?><?php if (!empty($value['arriving_airline'])) { echo $value['arriving_airline']."/" .$value['flight_number']; };?>&nbsp;</td>
                      <td width="25%" class="ob" valign="top"><?php echo $value['passenger_count']; ?>, <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>, 
                      <?php if ($value['trip_type'] == '7' || $value['trip_type'] == '8' || $value['trip_type'] == '10') {
					  echo $value['location1'].">".$value['location2'].">".$value['location3'].">".$value['location1'];
					  echo "<br>";
					  } else { ?>
					  &nbsp; <?php if ($value['location1_id'] == '1a' || $value['location1_id'] == '2a') { $from = get_airports_view($value['location1_id']); } else { if ($value['location1_id'] == '1c' || $value['location1_id'] == '2c' || $value['location1_id'] == '3c' || $value['location1_id'] == '4c' || $value['location1_id'] == '5c' || $value['location1_id'] == '6c' || $value['location1_id'] == '7c' || $value['location1_id'] == '8c') { $from = get_cruises_view($value['location1_id']); } else { $from = get_locations_view($value['location1_id']); }; }; ?><?php echo "<strong>From:</strong> ". $from['name']; ?>, &nbsp; <?php if ($value['location2_id'] == '1a' || $value['location2_id'] == '2a') { $to = get_airports_view($value['location2_id']); } else { if ($value['location2_id'] == '1c' || $value['location2_id'] == '2c' || $value['location2_id'] == '3c' || $value['location2_id'] == '4c' || $value['location2_id'] == '5c' || $value['location2_id'] == '6c' || $value['location2_id'] == '7c' || $value['location2_id'] == '8c') { $to = get_cruises_view($value['location2_id']); } else { $to = get_locations_view($value['location2_id']); }; }; ?><?php echo "<strong>To:</strong> ". $to['name']; ?><br />				  
					  <?php } ?>
                      </td>
                	  <td width="20%" class="ob" valign="top"><?php if ($value['child_carseat'] == 'Yes') { echo "<strong>CS:</strong> ".$value['child_carseat'].", "; }; ?><?php if ($value['booster_seat'] == 'Yes') { echo "<strong>BS:</strong> ".$value['booster_seat'].","; }; ?> <?php if ($value['store_stop'] == 'Yes') { echo "<strong>Quick Grocery Stop:</strong> ".$value['store_stop']; }; ?>&nbsp;</td>
                	  <td width="5%" class="ob" valign="top"><?php if (!empty($value['total_amount'])) { echo "$".$value['total_amount']; }; ?></td>
                    </tr>
                    <tr>
            		  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">Depart:<br />
                      <?php if ($value['travel_date_roundtrip'] !='0000-00-00 00:00:00') { echo format_to_caldate($value['travel_date_roundtrip']).", "; echo "<strong>".format_time($value['departing_at'])."</strong>"; }; ?>
                      </td>
                	  <td bgcolor="#FFFFFF" colspan="4" class="ob" valign="top"><?php if ($value['paying_cash']) { ?>Please do not charge my credit card. I will be paying cash or traveler check upon arrival.<br /><?php } ?><?php echo $value['customer_comments']; ?>&nbsp;</td>
            		</tr>
                    <? 
					} 
					?>
        </table>  
    	</form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS ARRIVALS</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Client, Depart</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby=arrival_time&sort=asc" class="link3">Arrival Time</a>
					  <?php } else { ?>
                      <a href="index.php?orderby=arrival_time&sort=desc" class="link3">Arrival Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Passengers, <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby=vehicle&sort=asc" class="link3">Vehicle</a>
					  <?php } else { ?>
                      <a href="index.php?orderby=vehicle&sort=desc" class="link3">Vehicle</a>
					  <?php } ?>, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
                    <? echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no reservations in the database. <a href="reservation_manager.php?cAction=create_new" class="link1">Create a new reservation</a></strong></div><table><tr><td></td></tr>';  
					?> 
                  </table>  
                </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
	
	// Get Departures Result with pages
	function get_departures_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 100;
			} else {
			$display = $_GET['pages'];
			};
			
			if (empty($_GET['orderby2'])) {
			$orderby_sql = " pickup_at_roundtrip ASC";
			} else {
				if ($_GET['orderby2'] == 'depart_time') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " departing_at ASC";
					} else {
					$orderby_sql = " departing_at DESC";
					}
				}
				
				if ($_GET['orderby2'] == 'vehicle') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " vehicle_id ASC";
					} else {
					$orderby_sql = " vehicle_id DESC";
					}
				}
				
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			$todays_date = date('Y-m-j 00:00:00'); 
			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date, status, total_amount, travel_date_extra FROM reservations WHERE travel_date_roundtrip = '$todays_date' ORDER BY $orderby_sql";
			
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

			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date, status, total_amount, travel_date_extra, booster_seat, paying_cash, store_stop, location1, location2, location3 FROM reservations WHERE travel_date_roundtrip = '$todays_date' ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
						
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="reservation_manager.php" method="get">';
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
				echo '&lt;&lt; <a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS DEPARTURES</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Client</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby2=depart_time&sort=asc" class="link3">Depart Time</a>
					  <?php } else { ?>
                      <a href="index.php?orderby2=depart_time&sort=desc" class="link3">Depart Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Passengers, <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby2=vehicle&sort=asc" class="link3">Vehicle</a>
					  <?php } else { ?>
                      <a href="index.php?orderby2=vehicle&sort=desc" class="link3">Vehicle</a>
					  <?php } ?>, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
            <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					if($bgcolor=="#fefef8") $bgcolor="#FFFFFF"; else $bgcolor="#fefef8";
            		echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="5%" class="ob" bgcolor="#CCCCCC" valign="top"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong>Detail</strong><br /><?php echo $value['id']; ?></a></td>
                	  <td width="25%" class="ob" bgcolor="#d9ecff" valign="top"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['last_name']; ?></strong>, <?php echo $value['first_name']; ?></a><br /><br /><?php $trip_type = get_trip_types_view($value['trip_type']); ?><?php echo $trip_type['name']; ?></td>
                	  <td width="20%" class="ob" valign="top"><?php echo "<strong>".format_time($value['departing_at'])."</strong>, "; ?> <?php if (!empty($value['departing_airline_roundtrip'])) { echo $value['departing_airline_roundtrip']."/" .$value['flight_number_roundtrip']; };?>&nbsp;</td>
                      <td width="25%" class="ob" valign="top"><?php echo $value['passenger_count']; ?>, <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>, 
                      <?php if ($value['trip_type'] == '7' || $value['trip_type'] == '8' || $value['trip_type'] == '10') {
					  echo $value['location1'].">".$value['location2'].">".$value['location3'].">".$value['location1'];
					  echo "<br>";
					  } else { ?>
					  &nbsp; <?php if ($value['location2_id'] == '1a' || $value['location2_id'] == '2a') { $from = get_airports_view($value['location2_id']); } else { if ($value['location2_id'] == '1c' || $value['location2_id'] == '2c' || $value['location2_id'] == '3c' || $value['location2_id'] == '4c' || $value['location2_id'] == '5c' || $value['location2_id'] == '6c' || $value['location2_id'] == '7c' || $value['location2_id'] == '8c') { $from = get_cruises_view($value['location2_id']); } else { $from = get_locations_view($value['location2_id']); }; }; ?><?php echo "<strong>From:</strong> ". $from['name']; ?>, &nbsp; <?php if ($value['location1_id'] == '1a' || $value['location1_id'] == '2a') { $to = get_airports_view($value['location1_id']); } else { if ($value['location1_id'] == '1c' || $value['location1_id'] == '2c' || $value['location1_id'] == '3c' || $value['location1_id'] == '4c' || $value['location1_id'] == '5c' || $value['location1_id'] == '6c' || $value['location1_id'] == '7c' || $value['location1_id'] == '8c') { $to = get_cruises_view($value['location1_id']); } else { $to = get_locations_view($value['location1_id']); }; }; ?><?php echo "<strong>To:</strong> ". $to['name']; ?><br />				  
					  <?php } ?>
                      </td>
                	  <td width="20%" class="ob" valign="top"><?php if ($value['child_carseat'] == 'Yes') { echo "<strong>CS:</strong> ".$value['child_carseat'].", "; }; ?><?php if ($value['booster_seat'] == 'Yes') { echo "<strong>BS:</strong> ".$value['booster_seat'].","; }; ?> <?php if ($value['store_stop'] == 'Yes') { echo "<strong>Quick Grocery Stop:</strong> ".$value['store_stop']; }; ?>&nbsp;</td>
                	  <td width="5%" class="ob" valign="top"><?php if (!empty($value['total_amount'])) { echo "$".$value['total_amount']; }; ?></td>
                    </tr>
                    <tr>
            		  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">Arrived:<br />
                      <?php if ($value['travel_date'] !='0000-00-00 00:00:00') { echo format_to_caldate($value['travel_date']).", "; echo "<strong>".format_time($value['arriving_at'])."</strong>"; }; ?>
                      </td>
                	  <td bgcolor="#FFFFFF" colspan="4" class="ob" valign="top"><?php if ($value['paying_cash']) { ?>Please do not charge my credit card. I will be paying cash or traveler check upon arrival.<br /><?php } ?><?php echo $value['customer_comments']; ?>&nbsp;</td>
            		</tr>
                    <? 
					} 
					?>
        </table>  
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS DEPARTURES</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Client</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby2=depart_time&sort=asc" class="link3">Depart Time</a>
					  <?php } else { ?>
                      <a href="index.php?orderby2=depart_time&sort=desc" class="link3">Depart Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Passengers, <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby2=vehicle&sort=asc" class="link3">Vehicle</a>
					  <?php } else { ?>
                      <a href="index.php?orderby2=vehicle&sort=desc" class="link3">Vehicle</a>
					  <?php } ?>, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
                    <? echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no reservations in the database. <a href="reservation_manager.php?cAction=create_new" class="link1">Create a new reservation</a></strong></div><table><tr><td></td></tr>';  
					?> 
                  </table>  
                </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
	
	// Get Transfers Result with pages
	function get_transfers_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 100;
			} else {
			$display = $_GET['pages'];
			};
			
			if (empty($_GET['orderby3'])) {
			$orderby_sql = " pickup_at_extra ASC";
			} else {
				if ($_GET['orderby3'] == 'pick_up_time') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " pickup_at_extra ASC";
					} else {
					$orderby_sql = " pickup_at_extra DESC";
					}
				}
				
				if ($_GET['orderby3'] == 'vehicle') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " vehicle_id ASC";
					} else {
					$orderby_sql = " vehicle_id DESC";
					}
				}
				
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			$todays_date = date('Y-m-j 00:00:00'); 
			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date, status, total_amount, travel_date_extra FROM reservations WHERE travel_date_extra = '$todays_date' ORDER BY $orderby_sql";
			
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

			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date, status, total_amount, travel_date_extra, location1, location2, location3, booster_seat, paying_cash, store_stop, pickup_at_extra FROM reservations WHERE travel_date_extra = '$todays_date' ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
						
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="reservation_manager.php" method="get">';
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
				echo '&lt;&lt; <a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS TRANSFERS</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Client, Arrived, Depart</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby3=pick_up_time&sort=asc" class="link3">Pick up Time</a>
					  <?php } else { ?>
                      <a href="index.php?orderby3=pick_up_time&sort=desc" class="link3">Pick up Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Passengers, <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby3=vehicle&sort=asc" class="link3">Vehicle</a>
					  <?php } else { ?>
                      <a href="index.php?orderby3=vehicle&sort=desc" class="link3">Vehicle</a>
					  <?php } ?>, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
            <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					if($bgcolor=="#fefef8") $bgcolor="#FFFFFF"; else $bgcolor="#fefef8";
            		echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="5%" class="ob" bgcolor="#CCCCCC" valign="top"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong>Detail</strong><br /><?php echo $value['id']; ?></a></td>
                	  <td width="25%" class="ob" bgcolor="#d9ecff" valign="top"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['last_name']; ?></strong>, <?php echo $value['first_name']; ?></a><br /><br /><?php $trip_type = get_trip_types_view($value['trip_type']); ?><?php echo $trip_type['name']; ?></td>
                	  <td width="20%" class="ob" valign="top"><?php echo "<strong>".format_time($value['pickup_at_extra'])."</strong>, "; ?> <?php echo $value['location2'];?>&nbsp;</td>
                      <td width="25%" class="ob" valign="top"><?php echo $value['passenger_count']; ?>, <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>, 
                      <?php if ($value['trip_type'] == '7' || $value['trip_type'] == '8' || $value['trip_type'] == '10') {
					  echo $value['location1'].">".$value['location2'].">".$value['location3'].">".$value['location1'];
					  echo "<br>";
					  } else { ?>
					  &nbsp; <?php if ($value['location1_id'] == '1a' || $value['location1_id'] == '2a') { $from = get_airports_view($value['location1_id']); } else { if ($value['location1_id'] == '1c' || $value['location1_id'] == '2c' || $value['location1_id'] == '3c' || $value['location1_id'] == '4c' || $value['location1_id'] == '5c' || $value['location1_id'] == '6c' || $value['location1_id'] == '7c' || $value['location1_id'] == '8c') { $from = get_cruises_view($value['location1_id']); } else { $from = get_locations_view($value['location1_id']); }; }; ?><?php echo $from['name']; ?>, &nbsp; <?php if ($value['location2_id'] == '1a' || $value['location2_id'] == '2a') { $to = get_airports_view($value['location2_id']); } else { if ($value['location2_id'] == '1c' || $value['location2_id'] == '2c' || $value['location2_id'] == '3c' || $value['location2_id'] == '4c' || $value['location2_id'] == '5c' || $value['location2_id'] == '6c' || $value['location2_id'] == '7c' || $value['location2_id'] == '8c') { $to = get_cruises_view($value['location2_id']); } else { $to = get_locations_view($value['location2_id']); }; }; ?><?php echo $to['name']; ?><br />				  
					  <?php } ?>
                      </td>
                	  <td width="20%" class="ob" valign="top"><?php if ($value['child_carseat'] == 'Yes') { echo "<strong>CS:</strong> ".$value['child_carseat'].", "; }; ?><?php if ($value['booster_seat'] == 'Yes') { echo "<strong>BS:</strong> ".$value['booster_seat'].","; }; ?> <?php if ($value['store_stop'] == 'Yes') { echo "<strong>Quick Grocery Stop:</strong> ".$value['store_stop']; }; ?>&nbsp;</td>
                	  <td width="5%" class="ob" valign="top"><?php if (!empty($value['total_amount'])) { echo "$".$value['total_amount']; }; ?></td>
                    </tr>
                    <tr>
            		  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">Arrived:<br />
                      <?php if ($value['travel_date'] !='0000-00-00 00:00:00') { echo format_to_caldate($value['travel_date']).", "; echo "<strong>".format_time($value['arriving_at'])."</strong>"; }; ?><br />
                      Depart:<br />
                      <?php if ($value['travel_date_roundtrip'] !='0000-00-00 00:00:00') { echo format_to_caldate($value['travel_date_roundtrip']).", "; echo "<strong>".format_time($value['departing_at'])."</strong>"; }; ?>
                      </td>
                	  <td bgcolor="#FFFFFF" colspan="4" class="ob" valign="top"><?php if ($value['paying_cash']) { ?>Please do not charge my credit card. I will be paying cash or traveler check upon arrival.<br /><?php } ?><?php echo $value['customer_comments']; ?>&nbsp;</td>
            		</tr>
                    <? 
					} 
					?>
        </table>  
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>TODAYS TRANSFERS</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Client, Arrived, Depart</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby3=pick_up_time&sort=asc" class="link3">Pick up Time</a>
					  <?php } else { ?>
                      <a href="index.php?orderby3=pick_up_time&sort=desc" class="link3">Pick up Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Passengers, <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby3=vehicle&sort=asc" class="link3">Vehicle</a>
					  <?php } else { ?>
                      <a href="index.php?orderby3=vehicle&sort=desc" class="link3">Vehicle</a>
					  <?php } ?>, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
                    <? echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no reservations in the database. <a href="reservation_manager.php?cAction=create_new" class="link1">Create a new reservation</a></strong></div><table><tr><td></td></tr>';  
					?> 
                  </table>  
                </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
	
	// Get Transfers Result with pages
	function get_future_reservations_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 100;
			} else {
			$display = $_GET['pages'];
			};
			
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
			$todays_date = date('Y-m-j 12:00:00'); 
			$expiration_time = strtotime("+30 days");
			$expiration_date = date("Y-m-j 00:00:00", $expiration_time);
			//print_r($expiration_date);
			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date, status, total_amount, travel_date_extra FROM reservations WHERE (travel_date BETWEEN '$todays_date' AND '$expiration_date') OR (travel_date_roundtrip BETWEEN '$todays_date' AND '$expiration_date') OR (travel_date_extra BETWEEN '$todays_date' AND '$expiration_date') ORDER BY id ASC";
			//print_r($query);
			//exit;
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

			$query = "SELECT id, client_id, vehicle_id, location1_id, location2_id, travel_date, passenger_count, child_carseat, trip_type, pickup_at, arriving_airline, flight_number, arriving_at, travel_date_roundtrip, pickup_at_roundtrip, departing_airline_roundtrip, flight_number_roundtrip, departing_at, first_name, last_name, address, address2, city, state, zip, country, email, first_name_billing, last_name_billing, city_billing, state_billing, zip_billing, country_billing, card_number, card_type, exp_date, reservation_date, status, total_amount, travel_date_extra FROM reservations WHERE (travel_date BETWEEN '$todays_date' AND '$expiration_date') OR (travel_date_roundtrip BETWEEN '$todays_date' AND '$expiration_date') OR (travel_date_extra BETWEEN '$todays_date' AND '$expiration_date') ORDER BY id ASC LIMIT $start, $display";
			
			//echo $query;
			//exit;	
					
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="reservation_manager.php" method="get">';
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
				echo '&lt;&lt; <a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="reservation_search.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
				}
				echo '</span></td>';
				echo '</tr></table>';
				echo '</form>';
				} // End of links section.

				?>
      <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>FUTURE TRANSFERS</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="100%" cellpadding="5" cellspacing="0" border="1">
        	<tr>
            	<td width="5%" bgcolor="#FFFFFF" class="ob">&nbsp;</td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Client, Arrived, Depart</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby3=pick_up_time&sort=asc" class="link3">Pick up Time</a>
					  <?php } else { ?>
                      <a href="index.php?orderby3=pick_up_time&sort=desc" class="link3">Pick up Time</a>
					  <?php } ?>, Airline/Flight #</strong></td>
                <td width="25%" bgcolor="#ffffcc" class="ob"><strong>Passengers, <?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="index.php?orderby3=vehicle&sort=asc" class="link3">Vehicle</a>
					  <?php } else { ?>
                      <a href="index.php?orderby3=vehicle&sort=desc" class="link3">Vehicle</a>
					  <?php } ?>, Destination</strong></td>
                <td width="20%" bgcolor="#ffffcc" class="ob"><strong>Car seat, Booster, Stop</strong></td>
                <td width="5%" bgcolor="#ffffcc" class="ob"><strong>Amount</strong></td>
            </tr>
            <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					if($bgcolor=="#fefef8") $bgcolor="#FFFFFF"; else $bgcolor="#fefef8";
            		echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="5%" class="ob" bgcolor="#CCCCCC" valign="top"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong>Detail</strong><br /><?php echo $value['id']; ?></a></td>
                	  <td width="25%" class="ob" bgcolor="#d9ecff" valign="top"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['last_name']; ?></strong>, <?php echo $value['first_name']; ?></a><br /><br /><?php $trip_type = get_trip_types_view($value['trip_type']); ?><?php echo $trip_type['name']; ?></td>
                	  <td width="20%" class="ob" valign="top"><?php echo "<strong>".format_time($value['pickup_at_extra'])."</strong>, "; ?> <?php echo $value['location2'];?>&nbsp;</td>
                      <td width="25%" class="ob" valign="top"><?php echo $value['passenger_count']; ?>, <?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?>, 
                      <?php if ($value['trip_type'] == '7' || $value['trip_type'] == '8' || $value['trip_type'] == '10') {
					  echo $value['location1'].">".$value['location2'].">".$value['location3'].">".$value['location1'];
					  echo "<br>";
					  } else { ?>
					  &nbsp; <?php if ($value['location1_id'] == '1a' || $value['location1_id'] == '2a') { $from = get_airports_view($value['location1_id']); } else { if ($value['location1_id'] == '1c' || $value['location1_id'] == '2c' || $value['location1_id'] == '3c' || $value['location1_id'] == '4c' || $value['location1_id'] == '5c' || $value['location1_id'] == '6c' || $value['location1_id'] == '7c' || $value['location1_id'] == '8c') { $from = get_cruises_view($value['location1_id']); } else { $from = get_locations_view($value['location1_id']); }; }; ?><?php echo $from['name']; ?>, &nbsp; <?php if ($value['location2_id'] == '1a' || $value['location2_id'] == '2a') { $to = get_airports_view($value['location2_id']); } else { if ($value['location2_id'] == '1c' || $value['location2_id'] == '2c' || $value['location2_id'] == '3c' || $value['location2_id'] == '4c' || $value['location2_id'] == '5c' || $value['location2_id'] == '6c' || $value['location2_id'] == '7c' || $value['location2_id'] == '8c') { $to = get_cruises_view($value['location2_id']); } else { $to = get_locations_view($value['location2_id']); }; }; ?><?php echo $to['name']; ?><br />				  
					  <?php } ?>
                      </td>
                	  <td width="20%" class="ob" valign="top"><?php if ($value['child_carseat'] == 'Yes') { echo "<strong>CS:</strong> ".$value['child_carseat'].", "; }; ?><?php if ($value['booster_seat'] == 'Yes') { echo "<strong>BS:</strong> ".$value['booster_seat'].","; }; ?> <?php if ($value['store_stop'] == 'Yes') { echo "<strong>Quick Grocery Stop:</strong> ".$value['store_stop']; }; ?>&nbsp;</td>
                	  <td width="5%" class="ob" valign="top"><?php if (!empty($value['total_amount'])) { echo "$".$value['total_amount']; }; ?></td>
                    </tr>
                    <tr>
            		  <td bgcolor="#FFFFFF" colspan="2" class="ob" valign="top">Arrived:<br />
                      <?php if ($value['travel_date'] !='0000-00-00 00:00:00') { echo format_to_caldate($value['travel_date']).", "; echo "<strong>".format_time($value['arriving_at'])."</strong>"; }; ?><br />
                      Depart:<br />
                      <?php if ($value['travel_date_roundtrip'] !='0000-00-00 00:00:00') { echo format_to_caldate($value['travel_date_roundtrip']).", "; echo "<strong>".format_time($value['departing_at'])."</strong>"; }; ?>
                      </td>
                	  <td bgcolor="#FFFFFF" colspan="4" class="ob" valign="top"><?php if ($value['paying_cash']) { ?>Please do not charge my credit card. I will be paying cash or traveler check upon arrival.<br /><?php } ?><?php echo $value['customer_comments']; ?>&nbsp;</td>
            		</tr>
                    <? 
					} 
					?>
        </table>  
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>                
                <?php
							
				} else {
				?>
     <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_left_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_left_curve.jpg"></td>
          </tr>
        </tbody>
        </table>  
        </td>
        <td align="center" width="100%" valign="middle">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>FUTURE TRANSFERS</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="reservation_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="id">Reservation ID</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="reservation_manager.php?cAction=create_new"><img src="images/add_reservation.jpg" border="0" type="image" alt="Add a New Reservation" title="Add a New Reservation"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="reservation_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">ID
                      </td>
                      <td width="110" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Client
                      </td>
                      <td width="293" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Transportation Info</td>
                      <td width="110" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Date submitted
                      </td>
                      <td width="55" colspan="2" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Status
                      </td>
                      <td width="70" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                    <? echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no reservations in the database. <a href="reservation_manager.php?cAction=create_new" class="link1">Create a new reservation</a></strong></div><table><tr><td></td></tr>';  
					?> 
                  </table>  
                </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
        <td align="left" valign="top" width="11" height="100%">
        <table border="0" cellpadding="0" cellspacing="0" width="11" height="100%">
          <tbody>
          <tr>
            <td width="11" height="11" background="images/top_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="100%" background="images/middle_right_curve.jpg"></td>
          </tr>
          <tr>
            <td width="11" height="11" background="images/bottom_right_curve.jpg"></td>
          </tr>
        </tbody>
        </table> 
        </td>
      </tr>
    </tbody></table>
    <?php
                }

	}
	
	
	//Check Reservation 1 Week before
	function check_reservation_before($date){
	$before = '7';
		$time = strtotime('+'.$before.' days');
		$send_date = date("Y-m-j 00:00:00", $time);
		
		if ($send_date != $date) {
		return false;
		} else {
		return true;
		}
	}
	
	//Check Reservation 1 Week after
	function check_reservation_after($date){
	$after = '7';
		$time = strtotime('+'.$after.' days');
		$send_date = date("Y-m-j", $time);
		if ($send_date != $date) {
		return false;
		} else {
		return true;
		}
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
?>