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
include("includes/functions/drivers_functions.php");

	if ($_POST['action'] == 'create_new') {
		if(add_drivers())
		echo '<script language="javascript">alert(\'Driver created successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error creating driver\');</script>';
	}
	
	if ($_GET['cAction'] == 'edit'){
		$drivers_view = get_drivers_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			if (edit_drivers($_GET['id'])) {
			echo '<script language="javascript">alert(\'Driver updated successfully\');</script>';
						$drivers_view = get_drivers_view($_GET['id']);
						} else {
			echo '<script language="javascript">alert(\'Error updating driver\');</script>';	
			};
		}
	}
	
	if ($_GET['cAction'] == 'get_salary_report')
	 	$all_trips = get_driver_from_reservation($_GET['drivers_id'], format_date_calendar($_GET["from"]), format_date_calendar($_GET["to"]));
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_drivers($delete_id))
		echo '<script language="javascript">alert(\'Driver Deleted Successfully\');window.location=\'drivers_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the driver\n\nPlease try again\');window.location=\'drivers_manager.php\';</script>';
		$all_drivers = get_all_drivers();
		
	}
	
	if (!empty($_POST['delete_selected'])){
		if(delete_drivers($_POST['id']))
		echo '<script language="javascript">alert(\'Drivers Deleted Successfully\')</script>';
		$all_drivers = get_all_drivers();
	}
		
	include ("includes/common/header.php");
 	include ("includes/common/menu.php");
    $all_drivers = get_all_drivers();
	//print_r( $all_drivers); exit;

	if (empty($_GET['cAction']) || $_POST['action'] == "back_to_drivers_manager" || $_GET['cAction'] == 'delete'){
	?>
<form name="displayfrm" method="get" action="drivers_manager.php">
    <input type="hidden" value="get_salary_report" name="cAction" />
  <table border="0" cellpadding="5" cellspacing="0" width="999" class="ot" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">
          <tbody><tr>
       	    <td align="center" valign="middle" width="100%">
              <table border="0" cellpadding="3" cellspacing="0" width="100%">
                <tbody><tr>
                  <td width="76%" height="20" align="center" valign="top">Driver's Name<select name="drivers_id"> 
                    <option selected="selected" value="<?php echo $_GET['drivers_id'];?>"><?php $driver = get_driver_view($_GET['drivers_id']); echo ucfirst($driver['first_name'])." ".ucfirst($driver['last_name']); ?><?php if(!$driver) echo "None";?></option>
					<?php 
						if($driver)
							echo "<option>None</option>";
							
						$counter =0; while($counter < count($all_drivers)){
								
								echo '<option value="'.$all_drivers[$counter]["id"].'">'.ucfirst($all_drivers[$counter]["first_name"]) .' '. ucfirst($all_drivers[$counter]["last_name"]) .'</option>';
								echo $all_drivers[$counter]["id"];
								$counter++;
							} 
					?>
                    </select>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From<input name="from" type="text" id="from" size="8" maxlength="10" value="<?php if($_GET['cAction']=="get_salary_report"){ echo $_GET['from'];} else { echo date("m/01/Y");}?>"><img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('from');" /><i> <font color="#ff0000" size="1"> select date</font></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To
                  <input name="to" type="text" id="to" size="8" maxlength="10" value="<?php if($_GET['cAction']=="get_salary_report"){ echo $_GET['to'];} else { echo date("m/30/Y");}?>"><img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('to');" /><i> <font color="#ff0000" size="1"> select date</font></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name="get_salary_report" type="submit" value="Get Salary Report" />
                  </td>
                </tr>
                </tbody>
              </table>
            </td>
            </tr>
</tbody>
	   </table>
     </form>
<table border="0" cellpadding="0" cellspacing="0" width="680" class="ot" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">
      <tbody><tr>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong><em>DRIVERS MANAGER</em></strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="drivers_manager.php?cAction=create_new"><img src="images/add_driver.jpg" border="0" type="image" alt="Add a New Driver" title="Add a New Driver"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="drivers_manager.php">
		<input type="hidden" value="" name="action">
		<table width="570" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bodytxt" style="margin-top: 10px;">
             <tr bgcolor="#646464" >
               		  <td width="35" style="font-weight: bold; color:#FFFFFF"></td>
                      <td width="32"></td>
                      <td width="149" align="left" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1"><?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="?orderby=first_name&sort=desc" class="link2">Name</a><?php } else { ?>
                      <a href="?orderby=first_name&sort=asc" class="link2">Name</a>
					  <?php } ?></td>
                      <td width="206" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Employment Status</td>
                      <td width="108" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1"><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="?orderby=employment_date&sort=asc" class="link2">Date Employed</a><?php } else { ?>
                      <a href="?orderby=employment_date&sort=desc" class="link2">Date Employed</a>
					  <?php } ?></td>
                      <td width="32"></td>
                      <td width="8"></td>
                  </tr>
                  <?php 	
					if(count($all_drivers)>=1){
					foreach($all_drivers as $value){
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="35" height="22" align="center" class="ot1"><input name="id[]" type="checkbox" value="<?php echo $value['id']; ?>"></td>
                      <td width="32" height="22" align="center"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" title="Click to Edit"><img src="images/edit.png" border="0" /></a></td> 
                      <td width="149" align="left" class="ot1"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Edit Drivers"><strong><?php if (!empty($value['first_name'])) { echo $value['first_name']." "; }; ?><?php if (!empty($value['last_name'])) { echo $value['last_name']; }; ?></strong></a></td> 
                      <td width="206" align="center" class="ot1"><?php if (!empty($value['status'])) { if ($value['status'] == 1){echo "Terminated";} elseif ($value['status'] == 2){echo "Leave of Absence";} elseif ($value['status'] == 3){echo "Active";} }; ?></td>
                      <td width="108" align="center" class="ot1"><?php if (!empty($value['employment_date'])) { echo format_date_calendar2($value['employment_date']); }; ?></td> 
                      <td width="32" height="22" align="center"><a href="?cAction=delete&id=<?php echo $value['id']; ?>" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this driver?\n\nNotice: deleted driver cannot be restored')" /></a></td> 
                      <td width="8"></td>
                    </tr>
                    <tr>
                    <?php } ?>
					<td colspan="5" valign="bottom" height="30"><input name="delete_selected" type="submit" value="Delete selected"  onclick="return confirm('Are you sure you want to delete selected drivers?\n\nNotice: deleted drivers cannot be restored')"></td>
					</tr>
                    <?php 					
						} else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no drivers in the database. <a href="drivers_manager.php?cAction=create_new" class="link1">Create a new driver</a></strong></div><table><tr><td></td></tr>'; } 
					?> 
                  </table>  
                 
    </form>
            </td>
          </tr>
        </tbody></table>
		</td>
      </tr>
    </tbody></table>
	<?php
	}
	?>
    <?php
	// Create a New Driver
	if ($_GET[cAction] == 'create_new') {
	?>
	<form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="drivers_manager.php">
	<input name="action" type="hidden" value="create_new">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="580" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong><em>ADD A NEW DRIVER</em></strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>First Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Last Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Email:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="email" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Cellphone:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="cellphone" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Cellphone Provider:</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <select name="cellphoneprovider">
                <option value="Metro PCS">Metro PCS</option>
                <option value="Verizon">Verizon</option>
                <option value="Tmobile">Tmobile</option>
                <option value="Sprint">Sprint</option>
                <option value="ATT">AT&T </option>
                <option value="Boost Mobile">Boost Mobile</option>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Telephone:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="telephone" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Address:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="address" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Apt. Number</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="address2" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>City:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="city" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>State:</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <select name="state">
                <option value="" selected="selected">Select State</option>                              <option value="AK">AK</option>
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
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Zip:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="zip"class="bodytxt" size="39" type="text"></input></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Social Security Number:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="ssn" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Drivers License number:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="dl" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Per Transfer Wage:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="per_transfer_wage" class="bodytxt" size="10" type="text">
  				</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Daily Wage:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="daily_wage2" class="bodytxt" size="10" type="text" /></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Employment Date:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="employment_date" class="bodytxt" size="10" type="text"> <img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('employment_date');"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY                				</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Employment Status:</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <select name="status">
                <option value="3">Active</option>
                <option value="2">Leave of Abscence</option>
                <option value="1">Terminated</option>
                </select></td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle">&nbsp;</td>
                <td style="padding-top: 5px; padding-right:20px;" align="right" valign="top"><input border="0" height="22" value="Add New Driver" type="submit" width="68" style="border:#1d557f solid 1px; color:#1d557f; background-color:#9edbee; font-weight:bold; padding:3px;" /></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
      </tr>
    </tbody></table>
	</form>
	<?php
	}
	?>
    <?php
	// Edit Driver
	if ($_GET[cAction] == 'edit') {
	?>
	<form id="edit_drivers" style="padding-bottom:0px;" name="edit_drivers" method="post" action="drivers_manager.php?cAction=edit&id=<?php echo $_GET['id']; ?>">
	<input name="action" type="hidden" value="edit">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>  
        </td>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="580" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong><em>EDIT DRIVERS</em></strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tbody>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>First Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name" class="bodytxt" size="39" type="text" value="<?php echo $drivers_view['first_name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Last Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name" class="bodytxt" size="39" type="text" value="<?php echo $drivers_view['last_name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Email:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="email" class="bodytxt" size="39" type="text" value="<?php echo $drivers_view['email']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Cellphone:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="cellphone" class="bodytxt" size="39" type="text" value="<?php echo $drivers_view['cellphone']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Cellphone Provider:</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <select name="cellphoneprovider">
                <?php if (!empty($drivers_view['cellphoneprovider'])) { ?>
                <option value="<?php echo $drivers_view['cellphoneprovider']; ?>" selected="selected"><?php echo $drivers_view['cellphoneprovider']; ?></option>
                <?php } ?>
                <option value="Metro PCS">Metro PCS</option>
                <option value="Verizon">Verizon</option>
                <option value="Tmobile">Tmobile</option>
                <option value="Sprint">Sprint</option>
                <option value="ATT">AT&T </option>
                <option value="Boost Mobile">Boost Mobile</option>

                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Telephone:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="telephone" class="bodytxt" size="39" type="text" value="<?php echo $drivers_view['telephone']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Address:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="address" class="bodytxt" size="39" type="text" value="<?php echo $drivers_view['address']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Apt. Number:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="address2" class="bodytxt" size="39" type="text" value="<?php echo $drivers_view['address2']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>City:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="city" class="bodytxt" size="39" type="text" value="<?php echo $drivers_view['city']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>State:</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <select name="state">
                <?php if (!empty($drivers_view['state'])) { ?>
                <option value="<?php echo $drivers_view['state']; ?>" selected="selected"><?php echo $drivers_view['state']; ?></option>
                <?php } else { ?>
                <option value="" selected="selected">Select State</option>
                <?php } ?>                              
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
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Zip:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="zip"class="bodytxt" size="39" type="text" value="<?php echo $drivers_view['zip']; ?>"></input></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Social Security Number:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="ssn" class="bodytxt" size="39" type="text" value="<?php echo $drivers_view['ssn']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Drivers License number:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="dl" class="bodytxt" size="39" type="text" value="<?php echo $drivers_view['dl']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Per Transfer Wage:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="per_transfer_wage" class="bodytxt" size="10" type="text"value="<?php echo number_format($drivers_view['per_transfer_wage'], 2, '.', ''); ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Daily Wage:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="daily_wage" class="bodytxt" size="10" type="text" value="<?php echo number_format($drivers_view['daily_wage'], 2, '.', ''); ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Employment Date (yyyy-mm-dd):</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="employment_date" class="bodytxt" size="10" type="text" value="<?php if ($drivers_view['employment_date']!='0000-00-00') { echo format_date_calendar2($drivers_view['employment_date']); } ?>"> <img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('employment_date');"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY                				</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Employment Status:</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <select name="status">
                <?php if ($drivers_view['status']=='1') { ?>
                <option value="<?php echo $drivers_view['status']; ?>">Terminated</option>
                <?php } elseif ($drivers_view['status']=='2') { ?>
                <option value="<?php echo $drivers_view['status']; ?>">Leave of Absence</option>
                <?php } else { ?>
                <option value="<?php echo $drivers_view['status']; ?>" selected="selected">Active</option>
                <?php } ?>
                <option value="3">Active</option>
                <option value="2">Leave of Abscence</option>
                <option value="1">Terminated</option>
                </select></td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle">&nbsp;</td>
                <td style="padding-top: 5px; padding-right:20px;" align="right" valign="top"><input border="0" height="22" value="Update Driver" type="submit" width="68" style="border:#1d557f solid 1px; color:#1d557f; background-color:#9edbee; font-weight:bold; padding:3px;" /></td>
              </tr>
            </tbody></table>
			</td>
          </tr>
        </tbody></table>
		</td>
      </tr>
    </tbody></table>
	</form>
	<?php
	}
	?>
    <?php //To get salary Report
	if ($_GET[cAction] == 'get_salary_report') {
	?>
    <form name="displayfrm" method="get" action="drivers_manager.php">
    <input type="hidden" value="get_salary_report" name="cAction" />
        <table border="0" cellpadding="5" cellspacing="0" width="999" class="ot" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">
          <tbody><tr>
       	    <td align="center" valign="middle" width="100%">
              <table border="0" cellpadding="3" cellspacing="0" width="100%">
                <tbody><tr>
                  <td width="76%" height="20" align="center" valign="top" style="border-bottom: 1px solid rgb(220, 220, 220);">Driver's Name&nbsp;
                    <select name="drivers_id">
                      <option selected="selected" value="<?php echo $_GET['drivers_id'];?>">
                      <?php $driver = get_driver_view($_GET['drivers_id']); echo ucfirst($driver['first_name'])." ".ucfirst($driver['last_name']); ?>
                      <?php if(!$driver) echo "None";?>
                      </option>
                      <?php 
						if($driver)
							echo "<option value=''>None</option>";
							
						$counter =0; while($counter < count($all_drivers)){
								
								echo '<option value="'.$all_drivers[$counter]["id"].'">'.ucfirst($all_drivers[$counter]["first_name"]) .' '. ucfirst($all_drivers[$counter]["last_name"]) .'</option>';
								echo $all_drivers[$counter]["id"];
								$counter++;
							} 
					?>
                    </select>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From
                  <input name="from" type="text" id="from" size="8" maxlength="10" value="<?php if($_GET['cAction']=="get_salary_report"){ echo $_GET['from'];} else { echo date("m/01/Y");}?>"><img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('from');" /><i> <font color="#ff0000" size="1"> select date</font></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To
                  <input name="to" type="text" id="to" size="8" maxlength="10" value="<?php if($_GET['cAction']=="get_salary_report"){ echo $_GET['to'];} else { echo date("m/30/Y");}?>"><img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('to');" /><i> <font color="#ff0000" size="1"> select date</font></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name="get_salary_report" type="submit" value="Get Salary Report"></td>
                  </tr>
                </tbody>
              </table>
            </td>
            </tr>
          </tbody>
</table>
          </form>
	<table border="0" cellpadding="0" cellspacing="0" width="687" class="ot" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">
      <tbody><tr>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong><em>SALARY REPORT</em></strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="drivers_manager.php">
			<input type="hidden" value="" name="action">
            <table width="570" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bodytxt" style="margin-top: 10px;">
              <tr bgcolor="#646464" >
                <td width="103" style="font-weight: bold; color:#FFFFFF" align="center"><?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                    <a href="?orderby=first_name&sort=desc" class="link2">Name</a>
                  <?php } else { ?>
                    <a href="?orderby=first_name&sort=asc" class="link2">Name</a>
                    <?php } ?></td>
                <td width="91"align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Date</td>
                <td width="129" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Employment Status</td>
                <td width="89" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1"># of Trips Run</td>
                <td width="158" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Salary of the day</td>
              </tr>
              <?php 	
					if(count($all_trips)>=1){
					$pickup_date=0; $num_runs=0;
					foreach($all_trips as $value){
					if($pickup_date == $value['pickup_date']){$num_runs++;}
					else{
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
  <td width="103" align="center" class="ot1"><strong>
    <?php $driver = get_driver_view($_GET['drivers_id']); echo ucfirst($driver['first_name']). " " . ucfirst($driver['last_name']); ?>
  </strong></td>
      <td width="91" align="center" class="ot1"><?php echo format_date_calendar2($value['date']); ?></td>
    <td width="129" align="center" class="ot1"><?php if ($driver['status'] == 1){echo "Terminated";} elseif ($driver['status'] == 2){echo "Leave of Absence";} elseif ($driver['status'] == 3){echo "Active";} ?></td>
    <td width="89" align="center" class="ot1"><?php echo compare($all_trips);?></td>
    <td width="158" align="center" class="ot1"><?php if($num_runs > 5) {$salary = $driver[0]['daily_wage'];}  else {$salary = $num_runs * $driver['per_transfer_wage'];} echo $salary;  ?>      </td>
  </tr>
  <tr>
    <?php }} ?>
    <td colspan="5"> <input name="back_to_drivers_manager" type="submit" value="Back to Driver's Manager"  onclick="return confirm('Are you sure you want to go back to the Driver's Manager?')" /></td>
  </tr>
  <?php 					
						} else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no salary Reports for this driver in this date range. <br/>Please pick a new driver or date range above. </strong></div><table><tr><td></td></tr>'; }
					?>
            </table>
        </form>            </td>
          </tr>
        </tbody></table>
		</td>
      </tr>
</tbody></table>
<?php }
  ?>
    
	
<?php
include ("includes/common/footer.php");
?>

<?php /*?><?php $avg_salary= $total_salary/$all_trips;  echo $avg_salary; ?><?php */?>