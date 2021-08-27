<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
	include("includes/functions/general_functions.php");
	include("includes/functions/location_functions.php");
	include("includes/functions/zone_functions.php");	

//Check permissions for User BEGIN
if (!chech_permissions($_SESSION['user_details'], 'location')) {
//header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/index.php");
echo '<script language="javascript">alert(\'You dont have a permissions access to this page!\');window.location=\'index.php\';</script>';
// Quit the script
exit(); 
}
//Check permissions for User END

	if ($_POST['action'] == 'create_new') {
		if (add_locations())
				echo '<script language="javascript">alert(\'Location created successfully\');window.location=\'location_manager.php\';</script>';
		else
			echo '<script language="javascript">alert(\'Error creating location\');</script>';	
	}
	
	if ($_GET['cAction'] == 'edit'){
		$location_view = get_locations_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			if (edit_locations($_GET['id']))
			echo '<script language="javascript">alert(\'Location updated successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error updating location\');</script>';
			
			$location_view = get_locations_view($_GET['id']);
		}
	}
	
	if (!empty($_POST['delete_selected'])){
	if (delete_locations($_POST['id']))
	echo '<script language="javascript">alert(\'Location(s) Deleted Successfully\');window.location=\'location_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the location(s)\n\nPlease try again\');window.location=\'location_manager.php\';</script>';
		
	$all_locations = get_all_locations();

	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_locations($delete_id))
		echo '<script language="javascript">alert(\'Location Deleted Successfully\');window.location=\'location_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the location\n\nPlease try again\');window.location=\'location_manager.php\';</script>';
		$all_locations = get_all_locations();
		
	}
    $all_locations = get_all_locations();
	$zone_view = get_zones_view($location_view['zone_id']);
	include ("includes/common/header.php");	
 	include ("includes/common/menu.php");	
	$all_zones = get_all_zones();
	
	// Show all locations
	if (empty($_GET['cAction']) || $_GET['cAction'] == 'delete') {

	get_all_locations_with_pages();
	}
	?>
    <?php
	// Create a New Location
	if ($_GET[cAction] == 'create_new') {
	?>
	<form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="location_manager.php?cAction=create_new&redirect=<?php echo $_GET['redirect'];?>" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="create_new">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>ADD A NEW LOCATION</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Zone ID</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
				<select name="zone_id" size="1" class="bodytxt">
                <option value=" " selected="selected"> -- Select Zone ID -- </option>
				<?php 					
				if(count($all_zones)>=1){
				foreach($all_zones as $value){
				?>
				<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?> - <?php echo $value['description']; ?></option>
                <?php
					}
				}
				?>
                </select>
				</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Location Type</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="location_type" size="1" class="bodytxt">
                <option value=" " selected="selected"> -- Select Location Type -- </option>
				<?php 
				$all_location_types = get_all_location_types();					
				if(count($all_location_types)>=1){
				foreach($all_location_types as $value){
				?>
				<option value="<?php echo $value['id']; ?>"><?php echo $value['location_type_name']; ?></option>
                <?php
					}
				}
				?>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Name</strong></td>
                <td align="left" height="30"><input name="name" class="bodytxt" size="39" id="address" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address</strong></td>
                <td align="left" height="30"><input name="address" class="bodytxt" size="39" id="address2" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City</strong></td>
                <td align="left" height="30"><input name="town" class="bodytxt" size="39" id="town" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State</strong></td>
                <td align="left" height="30">
                						<select name="state" id="state" class="bodytxt">                      
                        <option value="AK">AK</option>

                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>

                        <option value="CO">CO</option>
                        <option value="CT">CT</option>

                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL" selected="selected">FL</option>
                        <option value="GA">GA</option>

                        <option value="HI">HI</option>
                        <option value="IA">IA</option>

                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>

                        <option value="KY">KY</option>
                        <option value="LA">LA</option>

                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>

                        <option value="MN">MN</option>
                        <option value="MO">MO</option>

                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>

                        <option value="NE">NE</option>
                        <option value="NH">NH</option>

                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>

                        <option value="OH">OH</option>
                        <option value="OK">OK</option>

                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>

                        <option value="SD">SD</option>
                        <option value="TN">TN</option>

                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VA">VA</option>
                        <option value="VT">VT</option>

                        <option value="WA">WA</option>
                        <option value="WI">WI</option>

                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                      </select>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code</strong></td>
                <td align="left" height="30"><input name="zip" class="bodytxt" size="39" id="zip" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Phone</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="phone" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input src="images/but_create.jpg" border="0" height="22" type="image" width="68"></td>
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
	</form>
	<?php
	}
	?>
    <?php
	// Edit Location
	if ($_GET[cAction] == 'edit') {
	?>
	<form id="edit_location" style="padding-bottom:0px;" name="edit_location" method="post" action="location_manager.php?cAction=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="edit">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>EDIT LOCATION</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Zone ID</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
				<select name="zone_id" size="1" class="bodytxt">
                <option value="<?php echo $location_view['zone_id']; ?>"><?php echo $zone_view['name']; ?> - <?php echo $zone_view['description']; ?></option>
                <?php 	
				
				if(count($all_zones)>=1){
				foreach($all_zones as $value){
				?>
				<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?> - <?php echo $value['description']; ?></option>
                <?php
					}
				}
				?>
                </select>
				</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Location Type</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="location_type" size="1" class="bodytxt">
                <option value="<?php echo $location_view['location_type ']; ?>"><?php $location_type = get_location_types_view($location_view['location_type']); if (!empty($location_type['location_type_name'])) { echo $location_type['location_type_name']; } ?></option>
				<?php 
				$all_location_types = get_all_location_types();					
				if(count($all_location_types)>=1){
				foreach($all_location_types as $value){
				?>
				<option value="<?php echo $value['id']; ?>"><?php echo $value['location_type_name']; ?></option>
                <?php
					}
				}
				?>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Name</strong></td>
                <td align="left" height="30"><input name="name" class="bodytxt" size="39" id="address" type="text" value="<?php echo $location_view['name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address</strong></td>
                <td align="left" height="30"><input name="address" class="bodytxt" size="39" id="address2" type="text" value="<?php echo $location_view['address']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City</strong></td>
                <td align="left" height="30"><input name="town" class="bodytxt" size="39" id="town" type="text" value="<?php echo $location_view['city']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State</strong></td>
                <td align="left" height="30">
                						<select name="state" id="state" class="bodytxt">                        
                        <option value="<?php echo $location_view['state']; ?>"><?php echo $location_view['state']; ?></option>
                        <option value="AK">AK</option>

                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>

                        <option value="CO">CO</option>
                        <option value="CT">CT</option>

                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>

                        <option value="HI">HI</option>
                        <option value="IA">IA</option>

                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>

                        <option value="KY">KY</option>
                        <option value="LA">LA</option>

                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>

                        <option value="MN">MN</option>
                        <option value="MO">MO</option>

                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>

                        <option value="NE">NE</option>
                        <option value="NH">NH</option>

                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>

                        <option value="OH">OH</option>
                        <option value="OK">OK</option>

                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>

                        <option value="SD">SD</option>
                        <option value="TN">TN</option>

                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VA">VA</option>
                        <option value="VT">VT</option>

                        <option value="WA">WA</option>
                        <option value="WI">WI</option>

                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                      </select>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code</strong></td>
                <td align="left" height="30"><input name="zip" class="bodytxt" size="39" id="zip" type="text" value="<?php echo $location_view['zip']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Phone</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="phone" class="bodytxt" size="39" type="text" value="<?php echo $location_view['phone']; ?>"></td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input src="images/but_update.jpg" border="0" height="22" type="image" width="68"></td>
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
	</form>
	<?php
	}
	?>
<?php
unset ($_SESSION['redirect']);
include ("includes/common/footer.php");
?>