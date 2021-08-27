<?php
	//Get ALL Locations
	function get_all_locations(){
		global $db;
			//$get_all_locations_sql = "SELECT * FROM hotels ORDER BY name ASC";
			$get_all_locations_sql = "SELECT * FROM locations WHERE location_type='1' ORDER BY name ASC";
			if(!$result = $db->select($get_all_locations_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_locations[] = $data;
				return $all_locations;
			}
	}
	
	
	//Get ALL Location Types
	function get_all_location_types(){
		global $db;
			$get_all_location_types_sql = "SELECT * FROM location_types ORDER BY location_type_name ASC";
			if(!$result = $db->select($get_all_location_types_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_location_types[] = $data;
				return $all_location_types;
			}
	}
	
	
	//Get Shades of Green Locations
	function get_shadesofgreen_locations($location_type){
		global $db;
			$get_shadesofgreen_locations_sql = "SELECT * FROM locations WHERE location_type='$location_type' ORDER BY id ASC";
			
			if(!$result = $db->select($get_shadesofgreen_locations_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_locations[] = $data;
				return $all_locations;
			}
	}
	
	
	//Get ALL Locations
	function get_all_locations_new(){
		global $db;
			$get_all_locations_new_sql = "SELECT * FROM locations WHERE location_type='1' ORDER BY name ASC";
			if(!$result = $db->select($get_all_locations_new_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_locations[] = $data;
				return $all_locations;
			}
	}
	
	//Get ALL Airports
	function get_all_airports(){
		global $db;
			$get_all_airports_sql = "SELECT * FROM locations WHERE location_type='2' ORDER BY name ASC";
			if(!$result = $db->select($get_all_airports_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_airports[] = $data;
				return $all_airports;
			}
	}
	
	// Get current Location
	function get_locations_view($id){
		global $db;
			$get_locations_view_sql = "SELECT * FROM locations where id='$id'";
			if(!$result = $db->select($get_locations_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Get current Location Type
	function get_location_types_view($id){
		global $db;
			$get_location_types_view_sql = "SELECT * FROM location_types where id='$id'";
			if(!$result = $db->select($get_location_types_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Get current Airport
	function get_airports_view($id){
		global $db;
			$get_airports_view_sql = "SELECT * FROM airports where id='$id'";
			if(!$result = $db->select($get_airports_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Get current Cruises
	function get_cruises_view($id){
		global $db;
			$get_cruises_view_sql = "SELECT * FROM cruise_lines where id='$id'";
			if(!$result = $db->select($get_cruises_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit Location
	function edit_locations($id){
	global $db;
		$edit_locations_sql = "UPDATE locations SET zone_id='".$_POST['zone_id']."', location_type='".
            mysql_real_escape_string($_POST['location_type'])."', name='".
            mysql_real_escape_string($_POST['name'])."', address='".
            mysql_real_escape_string($_POST['address'])."', city='".
            mysql_real_escape_string($_POST['town'])."', state='".
            mysql_real_escape_string($_POST['state'])."', zip='".
            mysql_real_escape_string($_POST['zip'])."', phone='".
            mysql_real_escape_string($_POST['phone'])."' where id='$id'";
		if(!$result = $db->insert_sql($edit_locations_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	
	
	// Add a new Location
	function add_locations(){
	global $db; 
		$add_locations_sql = "INSERT INTO locations  (zone_id, location_type, name, address, city, state, zip, phone) values('".
        mysql_real_escape_string($_POST['zone_id'])."', '".
        mysql_real_escape_string($_POST['location_type'])."', '".
        mysql_real_escape_string($_POST['name'])."', '".
        mysql_real_escape_string($_POST['address'])."', '".
        mysql_real_escape_string($_POST['town'])."', '".
        mysql_real_escape_string($_POST['state'])."', '".
        mysql_real_escape_string($_POST['zip'])."', '".
        mysql_real_escape_string($_POST['phone'])."')";

		if(!$result = $db->insert_sql($add_locations_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}

	// Delete Selected Locations
	function delete_locations($id){
	global $db;
	$count =0;
		while($count < count($id)){
			$delete_locations_sql = "Delete from locations where id='".$id[$count]."'";
			if(!$db->select($delete_locations_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	//Get ALL Disney Resorts
	function get_all_disney_resorts(){
		global $db;
			$get_all_disney_resorts_sql = "SELECT * FROM locations WHERE location_type ='4' ORDER BY name ASC";
			if(!$result = $db->select($get_all_disney_resorts_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$disney_resorts[] = $data;
				return $disney_resorts;
			}
	}
	
	//Get ALL Cruises
	function get_all_cruises(){
		global $db;
			$get_all_cruises_sql = "SELECT * FROM locations WHERE location_type='3' ORDER BY id ASC";
			
			if(!$result = $db->select($get_all_cruises_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_cruises[] = $data;
				return $all_cruises;
			}
	}
	
	// Get Search Result with pages
	function get_all_locations_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 25;
			} else {
			$display = $_GET['pages'];
			};
			
			// Search criteria BEGIN
			
			
			if (empty($_GET['orderby'])) {
			$orderby_sql = " name ASC";
			} else {
				if ($_GET['orderby'] == 'name') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " name ASC";
					} else {
					$orderby_sql = " name DESC";
					}
				}

				if ($_GET['orderby'] == 'code') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " code ASC";
					} else {
					$orderby_sql = " code DESC";
					}
				}
				
				if ($_GET['orderby'] == 'zone') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " zone_id ASC";
					} else {
					$orderby_sql = " zone_id DESC";
					}
				}
				
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			
			$query = "SELECT id, zone_id, location_type, name, address, city, state, zip, phone FROM locations ORDER BY $orderby_sql";
			
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

			$query = "SELECT id, zone_id, location_type, name, address, city, state, zip, phone, location_type FROM locations ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query; exit;
			
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="search" action="location_manager.php" method="get">';
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
            	echo '<option value="500">500</option>';
            	echo '<option value="1000">1000</option>';
            	echo '<option value="1500">1500</option>';
            	echo '<option value="2000">2000</option>';
            	echo '</select>';
				echo '</td><td style="padding-left:10px;" class="bodytxt" align="right">';
				echo '<span style="margin-right:10px" class="bodytxt">';
				$current_page = ($start/$display) + 1;
				//If it's not the first page, make a`Previous button.
				if ($current_page != 1) {
				echo '&lt;&lt; <a href="location_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="location_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';
				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="location_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>LOCATION MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="location_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="city">City</option><option value="state">State</option><option value="zip">Zip Code</option><option value="country">Country</option><option value="telephone">Phone</option></select> <input name="where" class="bodytxt" size="29" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="location_manager.php?cAction=create_new"><img src="images/add_location.jpg" border="0" type="image" alt="Add a New Location" title="Add a New Location"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="location_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="190" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="location_manager.php?orderby=name&sort=desc<?php if(isset($_GET['pages'])) echo "&pages=".$_GET['pages']; ?>" class="link2">Name</a>
					  <?php } else { ?>
                      <a href="location_manager.php?orderby=name&sort=asc<?php if(isset($_GET['pages'])) echo "&pages=".$_GET['pages']; ?>" class="link2">Name</a>
					  <?php } ?>                      </td>
                      <td width="173" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Location Type</td>
                      <td width="220" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1"><?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="location_manager.php?orderby=zone&sort=desc<?php if(isset($_GET['pages'])) echo "&pages=".$_GET['pages']; ?>" class="link2">Zone</a>
					  <?php } else { ?>
                      <a href="location_manager.php?orderby=zone&sort=asc<?php if(isset($_GET['pages'])) echo "&pages=".$_GET['pages']; ?>" class="link2">Zone</a>
					  <?php } ?>                      </td>
                      <td width="60" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                  <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
            		echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="37" height="22" align="center" class="ot1"><input name="id[]" type="checkbox" value="<?php echo $value['id']; ?>"></td> 
                      <td width="190" height="22" align="left" class="ot1"><a href="location_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['name']; ?></strong></a></td>
                      <td width="173" align="left" class="ot1"><?php $location_type = get_location_types_view($value['location_type']); if (!empty($location_type['location_type_name'])) { echo $location_type['location_type_name']; } ?></td>
                      <td width="220" align="left" class="ot1"><?php $zone = get_zones_view($value['zone_id']); echo "<strong>".$zone['name']."</strong><br>".$zone['description']; ?></td>
                      <td width="60" height="22" align="center"><a href="location_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a>&nbsp;&nbsp;<a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this location?\n\nNotice: deleted location cannot be restored')" /></a></td>
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>LOCATION MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="location_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="city">City</option><option value="state">State</option><option value="zip">Zip Code</option><option value="country">Country</option><option value="telephone">Phone</option></select> <input name="where" class="bodytxt" size="29" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="client_manager.php?cAction=create_new"><img src="images/add_location.jpg" border="0" type="image" alt="Add a New Location" title="Add a New Location"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="location_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="190" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Name</td>
                      <td width="173" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Location Type</td>
                      <td width="35" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Code</td>
                      <td width="220" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Zone</td>
                      <td width="60" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                    <? echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no locations in the database. <a href="location_manager.php?cAction=create_new" class="link1">Create a new location</a></strong></div><table><tr><td></td></tr>';  
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
	function get_search_locations_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 25;
			} else {
			$display = $_GET['pages'];
			};
			
			// Search criteria BEGIN
			if (empty($_GET['search_by'])) {
			$searchby_sql = " name LIKE '%".$_GET['where']."%'";
			} else {
				if ($_GET['search_by'] == 'name') {
					$searchby_sql = " name LIKE '%".$_GET['where']."%'";
				}
				
				
				if ($_GET['search_by'] == 'city') {
					$searchby_sql = " city LIKE '%".$_GET['where']."%'";
				}
				
				if ($_GET['search_by'] == 'state') {
					$searchby_sql = " state LIKE '%".$_GET['where']."%'";
				}
				
				if ($_GET['search_by'] == 'zip') {
					$searchby_sql = " zip = '".$_GET['where']."'";
				}
				
				if ($_GET['search_by'] == 'country') {
					$searchby_sql = " country LIKE '%".$_GET['where']."%'";
				}
				
				if ($_GET['search_by'] == 'telephone') {
					$searchby_sql = " phone LIKE '%".$_GET['where']."%'";
				}
		
			}
			
			if (empty($_GET['orderby'])) {
			$orderby_sql = " name ASC";
			} else {
				if ($_GET['orderby'] == 'name') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " name ASC";
					} else {
					$orderby_sql = " name DESC";
					}
				}
				
				
				if ($_GET['orderby'] == 'code') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " code ASC";
					} else {
					$orderby_sql = " code DESC";
					}
				}
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			
			$query = "SELECT id, zone_id, location_type, name, address, city, state, zip, phone FROM locations WHERE $searchby_sql ORDER BY $orderby_sql";
			
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

			$query = "SELECT id, zone_id, location_type, name, address, city, state, zip, phone FROM locations WHERE $searchby_sql ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
						
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="location_search" action="location_manager.php" method="get">';
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
            	echo '<option value="500">500</option>';
            	echo '<option value="1000">1000</option>';
            	echo '<option value="1500">1500</option>';
            	echo '<option value="2000">2000</option>';
            	echo '</select>';
				echo '</td><td style="padding-left:10px;" class="bodytxt" align="right">';
				echo '<span style="margin-right:10px" class="bodytxt">';
				$current_page = ($start/$display) + 1;
				//If it's not the first page, make a`Previous button.
				if ($current_page != 1) {
				echo '&lt;&lt; <a href="location_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="location_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="location_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>LOCATION SEARCH</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="location_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="city">City</option><option value="state">State</option><option value="zip">Zip Code</option><option value="country">Country</option><option value="telephone">Phone</option></select> <input name="where" class="bodytxt" size="29" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="location_manager.php?cAction=create_new"><img src="images/add_location.jpg" border="0" type="image" alt="Add a New Location" title="Add a New Location"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="location_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="190" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="location_search.php?orderby=name&sort=desc" class="link2">Name</a>
					  <?php } else { ?>
                      <a href="location_search.php?orderby=name&sort=asc" class="link2">Name</a>
					  <?php } ?>
                      </td>
                      <td width="173" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Location Type</td>
                      <td width="220" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Zone  
                      </td>
                      <td width="60" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                  <?php 	
					while ($value =mysql_fetch_array($result, MYSQL_ASSOC)) {
					if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
            		echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="37" height="22" align="center" class="ot1"><input name="id[]" type="checkbox" value="<?php echo $value['id']; ?>"></td> 
                      <td width="190" height="22" align="left" class="ot1"><a href="location_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['name']; ?></strong></a></td>
                      <td width="173" align="left" class="ot1"><?php $location_type = get_location_types_view($value['location_type']); if (!empty($location_type['location_type_name'])) { echo $location_type['location_type_name']; } ?></td>
                      <td width="220" align="left" class="ot1"><?php $zone = get_zones_view($value['zone_id']); echo "<strong>".$zone['name']."</strong><br>".$zone['description']; ?></td>
                      <td width="60" height="22" align="center"><a href="location_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a>&nbsp;&nbsp;<a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this location?\n\nNotice: deleted location cannot be restored')" /></a></td>
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>LOCATION SEARCH</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="location_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="city">City</option><option value="state">State</option><option value="zip">Zip Code</option><option value="country">Country</option><option value="telephone">Phone</option></select> <input name="where" class="bodytxt" size="29" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="location_manager.php?cAction=create_new"><img src="images/add_location.jpg" border="0" type="image" alt="Add a New Location" title="Add a New Location"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="location_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="190" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Name</td>
                      <td width="173" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Location Type</td>
                      <td width="35" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Code</td>
                      <td width="220" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Zone</td>
                      <td width="60" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                    <? echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>Sorry no location(s) found matching your search criteria.<br /> Please <a href="http://www.sunstatelimo.com/admin/location_manager.php">Go back </a> or click here to <a href="location_manager.php?cAction=create_new" class="link1">Create a new location</a></strong></div><table><tr><td></td></tr>';  
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
?>