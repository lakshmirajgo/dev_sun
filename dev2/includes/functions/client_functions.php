<?php
	//Get ALL Clients
	function get_all_clients(){
		global $db;
			$get_all_clients_sql = "SELECT * FROM clients ORDER BY first_name ASC";
			if(!$result = $db->select($get_all_clients_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				while($data=$db->get_row($result, 'MYSQL_ASSOC'))
					$all_clients[] = $data;
				return $all_clients;
			}
	}
	
	// Get current Client
	function get_client_view($email){
		global $db;
			$get_client_view_sql = "SELECT * FROM clients where email='$email'";
			if(!$result = $db->select($get_client_view_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Get current Client
	function get_client_view_by_id($id){
		global $db;
			$get_client_view_by_id_sql = "SELECT * FROM clients where id='$id'";
			if(!$result = $db->select($get_client_view_by_id_sql)){
				//$_SESSION['notice'] = "Database Error. Please try again";
				return false;
			}
		
			else{
				$data=$db->get_row($result, 'MYSQL_ASSOC');
				return $data;
			}
	}
	
	// Edit Client
	function edit_clients($id){
	global $db;
		$edit_clients_sql = "UPDATE clients SET first_name='"
            .mysql_real_escape_string($_POST['first_name'])."', last_name='"
            .mysql_real_escape_string($_POST['last_name'])."', address='"
            .mysql_real_escape_string($_POST['address'])."', address2='"
            .mysql_real_escape_string($_POST['address2'])."', city='"
            .mysql_real_escape_string($_POST['town'])."', state='"
            .mysql_real_escape_string($_POST['state'])."', zip='"
            .mysql_real_escape_string($_POST['zip'])."', country='"
            .$_POST['country']."', telephone='".$_POST['telephone']."', telephone2='".$_POST['telephone2']."', cellphone='".$_POST['cellphone']."', fax='".$_POST['fax']."' where id='$id'";
		if(!$result = $db->insert_sql($edit_clients_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
			return true;
		}	
	}
	
	
	
	// Add a new Client
	function add_clients(){
	global $db; 
	$signup_date = date('Y-m-j, h-i-s');
		$add_clients_sql = "INSERT INTO clients  (first_name, last_name, address, address2, city, state, zip, country, telephone, telephone2, cellphone, fax, email, username, password, signup_date) values('"
        .mysql_real_escape_string($_POST['first_name'])."', '"
        .mysql_real_escape_string($_POST['last_name'])."', '"
        .mysql_real_escape_string($_POST['address'])."', '"
        .mysql_real_escape_string($_POST['address2'])."', '"
        .mysql_real_escape_string($_POST['town'])."', '"
        .mysql_real_escape_string($_POST['state'])."', '"
        .mysql_real_escape_string($_POST['zip'])."', '".$_POST['country']."', '".$_POST['telephone']."', '".$_POST['telephone2']."', '".$_POST['cellphone']."', '".$_POST['fax']."', '"
        .mysql_real_escape_string($_POST['email'])."', '"
        .mysql_real_escape_string($_POST['username'])."', '".md5($_POST['password_new'])."', '$signup_date')";

		if(!$result = $db->insert_sql($add_clients_sql)){
			$_SESSION['notice'] = $db->last_error;
			return false;			
		}
		else{
		$_SESSION['auth'] = true;
			return true;
		}	
	}

	// Delete Selected Clients
	function delete_clients($id){
	global $db;
	$count =0;
		while($count < count($id)){
			$delete_clients_sql = "Delete from clients where id='".$id[$count]."'";
			if(!$db->select($delete_clients_sql)){
				$_SESSION['notice'] = "Database Error. Please try again";
				exit;
			}
			$count++;
		}
			
		return true;
	}
	
	// Get Search Result with pages
	function get_all_clients_with_pages(){
		global $db;
			if (empty($_GET['pages'])) {
			 $display = 25;
			} else {
			$display = $_GET['pages'];
			};
			
			// Search criteria BEGIN
			
			
			if (empty($_GET['orderby'])) {
			$orderby_sql = " first_name ASC";
			} else {
				if ($_GET['orderby'] == 'name') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " first_name ASC";
					} else {
					$orderby_sql = " first_name DESC";
					}
				}
				
				
				if ($_GET['orderby'] == 'email') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " email ASC";
					} else {
					$orderby_sql = " email DESC";
					}
				}
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			
			$query = "SELECT id, first_name, last_name, address, address2, city, state, zip, country, telephone, telephone2, cellphone, fax, email, signup_date FROM clients ORDER BY $orderby_sql";
			
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

			$query = "SELECT id, first_name, last_name, address, address2, city, state, zip, country, telephone, telephone2, cellphone, fax, email, signup_date FROM clients ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query; exit;
			
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="search" action="client_manager.php" method="get">';
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
				echo '&lt;&lt; <a href="client_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="client_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';
				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="client_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>CLIENT MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="client_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="city">City</option><option value="state">State</option><option value="zip">Zip Code</option><option value="country">Country</option><option value="telephone">Phone</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="29" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="client_manager.php?cAction=create_new"><img src="images/but_create_new.jpg" border="0" height="22" type="image" width="109" alt="Add a New Client" title="Add a New Client"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="client_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="190" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="client_manager.php?orderby=name&sort=desc" class="link2">Name</a>
					  <?php } else { ?>
                      <a href="client_manager.php?orderby=name&sort=asc" class="link2">Name</a>
					  <?php } ?>
                      </td>
                      <td width="173" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Address</td>
                      <td width="255" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="client_manager.php?orderby=email&sort=desc" class="link2">E-mail</a>
					  <?php } else { ?>
                      <a href="client_manager.php?orderby=email&sort=asc" class="link2">E-mail</a>
					  <?php } ?>
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
                      <td width="190" height="22" align="left" class="ot1"><a href="client_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?></strong></a></td>
                      <td width="173" align="left" class="ot1"><?php echo $value['address']; ?>, <?php echo $value['address2']; ?><br /><?php echo $value['city']; ?>, <?php if ($value['state'] !== 'Outside USA') { echo $value['state']; ?> <?php echo $value['zip']; echo '<br />'.$value['country']; } else { echo $value['country'];}; ?></td>
                      <td width="255" align="left" class="ot1"><a href="mailto:<?php echo $value['email']; ?>" class="contact_link"><?php echo $value['email']; ?></a></td><td width="60" height="22" align="center"><a href="client_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a>&nbsp;&nbsp;<a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this client?\n\nNotice: deleted client cannot be restored')" /></a></td>
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>CLIENT MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="client_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="city">City</option><option value="state">State</option><option value="zip">Zip Code</option><option value="country">Country</option><option value="telephone">Phone</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="29" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="client_manager.php?cAction=create_new"><img src="images/but_create_new.jpg" border="0" height="22" type="image" width="109" alt="Add a New Client" title="Add a New Client"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="client_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="190" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Name</td>
                      <td width="173" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Address</td>
                      <td width="255" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">E-mail</td>
                      <td width="60" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                    <? echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no clients in the database. <a href="client_manager.php?cAction=create_new" class="link1">Create a new client</a></strong></div><table><tr><td></td></tr>';  
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
	function get_search_clients_with_pages(){
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
					$searchby_sql = " telephone LIKE '%".$_GET['where']."%' OR telephone2 LIKE '%".$_GET['where']."%' OR cellphone LIKE '%".$_GET['where']."%'";
				}
				
				if ($_GET['search_by'] == 'email') {
					$searchby_sql = " email LIKE '%".$_GET['where']."%'";
				}
		
			}
			
			if (empty($_GET['orderby'])) {
			$orderby_sql = " first_name ASC";
			} else {
				if ($_GET['orderby'] == 'name') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " first_name ASC";
					} else {
					$orderby_sql = " first_name DESC";
					}
				}
				
				
				if ($_GET['orderby'] == 'email') {
					if ($_GET['sort'] == 'asc') {
					$orderby_sql = " email ASC";
					} else {
					$orderby_sql = " email DESC";
					}
				}
			}
			
			// Search criteria END
			
			// Determine how many pages there are.
			if (isset($_GET['np'])) { // Already been determinated.
			$num_pages = $_GET['np'];
			} else { // Need to determinate.
			
			$query = "SELECT id, first_name, last_name, address, address2, city, state, zip, country, telephone, telephone2, cellphone, fax, email, signup_date FROM clients WHERE $searchby_sql ORDER BY $orderby_sql";
			
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

			$query = "SELECT id, first_name, last_name, address, address2, city, state, zip, country, telephone, telephone2, cellphone, fax, email, signup_date FROM clients WHERE $searchby_sql ORDER BY $orderby_sql LIMIT $start, $display";
			
			//echo $query;
						
			$result = @mysql_query($query); // Run the query.
			
			$num=mysql_num_rows($result); // How many users are there?

			if ($num > 0) { // If it ran OK, display the records.
			
			// Make the links to other pages, if necessary.
				if ($num_pages > 1) {
				echo '<form name="client_search" action="client_manager.php" method="get">';
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
				echo '&lt;&lt; <a href="client_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start - $display) . '&np=' . $num_pages . '" class="bodytxt">previous</a>';
				}
	
				// Make all the numbered pages.
				for ($i = 1; $i <= $num_pages; $i++) {
				if ($i !=$current_page) {
				echo ' [<a href="client_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . (($display * ($i - 1))) . '&np=' . $num_pages . '" class="bodytxt">' . $i . '</a>] ';

				} else {
				echo "<strong>".$i."</strong>"  . ' ';
				}
				}
				// If it's not the last page, make a Next button.
				if ($current_page != $num_pages) {
				echo '<a href="client_manager.php?orderby=' .$_GET['orderby']. '&sort=' .$_GET['sort']. '&pages=' .$display. '&s=' . ($start + $display) . '&np=' . $num_pages . '" class="bodytxt">next</a> &gt;&gt;';
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>CLIENT SEARCH</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="client_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="city">City</option><option value="state">State</option><option value="zip">Zip Code</option><option value="country">Country</option><option value="telephone">Phone</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="29" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="client_manager.php?cAction=create_new"><img src="images/but_create_new.jpg" border="0" height="22" type="image" width="109" alt="Add a New Client" title="Add a New Client"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="client_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="190" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="client_search.php?search_by=<?php echo $_GET['search_by']; ?>&where=<?php echo $_GET['where']; ?>&orderby=name&sort=desc" class="link2">Name</a>
					  <?php } else { ?>
                      <a href="client_search.php?search_by=<?php echo $_GET['search_by']; ?>&where=<?php echo $_GET['where']; ?>&orderby=name&sort=asc" class="link2">Name</a>
					  <?php } ?>
                      </td>
                      <td width="173" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Address</td>
                      <td width="255" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="client_search.php?search_by=<?php echo $_GET['search_by']; ?>&where=<?php echo $_GET['where']; ?>&orderby=email&sort=desc" class="link2">E-mail</a>
					  <?php } else { ?>
                      <a href="client_search.php?search_by=<?php echo $_GET['search_by']; ?>&where=<?php echo $_GET['where']; ?>&orderby=email&sort=asc" class="link2">E-mail</a>
					  <?php } ?>
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
                      <td width="190" height="22" align="left" class="ot1"><a href="client_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?></strong></a></td>
                      <td width="173" align="left" class="ot1"><?php echo $value['address']; ?>, <?php echo $value['address2']; ?><br /><?php echo $value['city']; ?>, <?php if ($value['state'] !== 'Outside USA') { echo $value['state']; ?> <?php echo $value['zip']; echo '<br />'.$value['country']; } else { echo $value['country'];}; ?></td>
                      <td width="255" align="left" class="ot1"><a href="mailto:<?php echo $value['email']; ?>" class="contact_link"><?php echo $value['email']; ?></a></td><td width="60" height="22" align="center"><a href="client_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a>&nbsp;&nbsp;<a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this client?\n\nNotice: deleted client cannot be restored')" /></a></td>
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>CLIENT SEARCH</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="get" action="client_search.php" style="padding:0px; margin:0px;">
                  Search by <select name="search_by" size="1" class="bodytxt"><option value="name">Name</option><option value="city">City</option><option value="state">State</option><option value="zip">Zip Code</option><option value="country">Country</option><option value="telephone">Phone</option><option value="email">E-mail</option></select> <input name="where" class="bodytxt" size="29" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="client_manager.php?cAction=create_new"><img src="images/but_create_new.jpg" border="0" height="22" type="image" width="109" alt="Add a New Client" title="Add a New Client"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="client_manager.php">
		<input type="hidden" value="" name="action">
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
               		  <td width="37"></td>
                      <td width="190" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Name</td>
                      <td width="173" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">Address</td>
                      <td width="255" align="left" style="font-weight: bold; color:#FFFFFF" class="ot1">E-mail</td>
                      <td width="60" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Action</td>
                      <td width="5"></td>
                  </tr>
                    <? echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no clients in the database. <a href="client_manager.php?cAction=create_new" class="link1">Create a new client</a></strong></div><table><tr><td></td></tr>';  
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
	
	function update_client_password($email, $oldpassword, $newpassword, $id){
		global $db;
		
			$update_pasword = "UPDATE clients SET password = '".md5($newpassword)."' WHERE id='$id'";

		if(!$result = $db->insert_sql($update_pasword)){
			$_SESSION['notice'] = "Database Error: ".$db->last_error;
			return false;			
		}
		else{
			$_SESSION['notice'] = "Password updated successfully";
			
			return true;
		}
	
	}
	
	function validate_customer($email){
	// Check database if the customer already exits and require them to login.
		global $db;
				
		$validate_customer_sql = "SELECT * FROM clients where email = '$email'";
		
		if(!$result = $db->select($validate_customer_sql)){
			$_SESSION['notice'] = "Sorry could not connect to database";
			return false;
			exit();
		}
		
		if(mysql_num_rows($result) < 1)	return false;	
		else return true;
	}
	
	function reset_password($email){
		global $db;
		
		$email_sql = "SELECT * FROM clients where email like '$email'";
				
		if(!$result = $db->select($email_sql)){
			$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Database Error. Please try again</span></div>';
			//header("Location: forgot_password.php");
			return false;
		}
		else{
		//print_r(mysql_num_rows($result));
		//exit;
			if(mysql_num_rows($result) == 0){
				$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Sorry that email address does not exist in out site! Please register</span></div>';
				//header("Location: forgot_password.php");
				return false;
			}
	
			$newpassword = rand(88888, 9999999);		
			$update_pasword = "UPDATE clients SET password = '".md5($newpassword)."' where email = '$email'";
				
			$db->select($update_pasword);
			
			$_SESSION['notice'] = '<div style="background-color:#d1fac3; padding:5px; border:#72da4e solid 1px; width:580px;" align="center">A new Password has been sent to your email address.<br />Please check your email within a few minutes and login with your new password<br /><br />You can change your password after loggin in by clicking on My Account, then password settings</div>';
			
			$message = "Your account password reset request has processed successfully. To login to your account please use your email address and the password below
				<br><br>
				New Password: $newpassword
				<br><br>
				Click here to login to your account: <a href=\"http://www.sunstatelimo.com/returning_client.php\">http://www.sunstatelimo.com/returning_client.php</a>
				<br><br>
				If you have any questions or concerns please call us 1(407) 601-7900. Thank you and have a nice day
				<br><br>
				<a href=\"http://www.sunstatelimo.com\">Sun State Transportation<br>http://www.sunstatelimo.com</a>";
			
			$from = "info@sunstatelimo.com";
			
			$headers = 'From: '. $from . "\r\n" .
    		'Reply-To: '. $from . "\r\n" .
			"MIME-Version: 1.0\r\n" .
			"Content-type: text/html; charset=iso-8859-1\r\n".
    		'X-Mailer: PHP/' . phpversion();
			
			//send_email($to_email, $to_name, $subject, $body)			
			mail($email, "Sunstate Transportaion Account Update", $message, $headers);		
			return true;
		}
		
	}
?>