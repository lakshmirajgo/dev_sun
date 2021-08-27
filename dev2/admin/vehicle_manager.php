<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
include("includes/functions/vehicle_functions.php");	

//Check permissions for User BEGIN
if (!chech_permissions($_SESSION['user_details'], 'vehicle')) {
//header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/index.php");
echo '<script language="javascript">alert(\'You dont have a permissions access to this page!\');window.location=\'index.php\';</script>';
// Quit the script
exit(); 
}
//Check permissions for User END	

	if ($_POST['action'] == 'create_new'){
		if (add_vehicles()) {
			if (!empty($_FILES['upload']['name']))	
			add_vehicle_image($vehicle_name, $id);
				echo '<script language="javascript">alert(\'Vehicle created successfully\');window.location=\'vehicle_manager.php\';</script>';
				 
		} else {
			echo '<script language="javascript">alert(\'Error creating vehicle\');</script>';
		}
	}
		
	if ($_GET['cAction'] == 'edit'){
		$vehicle_view = get_vehicles_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			if (edit_vehicles($_GET['id'])) {
			echo '<script language="javascript">alert(\'Vehicle updated successfully\');</script>';
			if (!empty($_FILES['upload']['name'])) {
			add_vehicle_image($vehicle_view['name'], $_GET['id']);
			};
						$vehicle_view = get_vehicles_view($_GET['id']);
						} else {
			echo '<script language="javascript">alert(\'Error updating vehicle\');</script>';	
			};
		}
	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_vehicles($delete_id))
		echo '<script language="javascript">alert(\'Vehicle Deleted Successfully\');window.location=\'vehicle_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the vehicle\n\nPlease try again\');window.location=\'vehicle_manager.php\';</script>';
		$all_vehicles = get_all_vehicles();
		
	}
	
	if (!empty($_POST['delete_selected'])){
		if(delete_vehicles($_POST['id']))
		echo '<script language="javascript">alert(\'Vehicle Deleted Successfully\')</script>';
		$all_vehicles = get_all_vehicles();
	}
		
	include ("includes/common/header.php");	
    $all_vehicles = get_all_vehicles();
	 include ("includes/common/menu.php");	
	// Show all vehicles
	if (empty($_GET['cAction']) || $_GET['cAction'] == 'delete'){
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>VEHICLE MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="vehicle_manager.php?cAction=create_new"><img src="images/add_vehicle.jpg" border="0" type="image" alt="Add a New Vehicle" title="Add a New Vehicle"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="vehicle_manager.php">
		<input type="hidden" value="" name="action">
		<table width="570" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bodytxt" style="margin-top: 10px;">
             <tr bgcolor="#646464" >
               		  <td width="37" style="font-weight: bold; color:#FFFFFF"></td>
                      <td width="22"></td>
                      <td width="484" align="left" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Vehicle Title</td>
                      <td width="22"></td>
                      <td width="5"></td>
                  </tr>
                  <?php 	
					if(count($all_vehicles)>=1){
					foreach($all_vehicles as $value){
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="37" height="22" align="center" class="ot1"><input name="id[]" type="checkbox" value="<?php echo $value['id']; ?>"></td>
                      <td width="22" height="22" align="center"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a></td> 
                      <td width="484" align="left" class="ot1"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Edit Vehicle"><strong><?php echo $value['name']; ?></strong></a></td><td width="22" height="22" align="center"><a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this vehicle?\n\nNotice: deleted vehicle cannot be restored')" /></a></td> 
                      <td width="5"></td>
                    </tr>
                    <? } 
					
					
						} else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no vehicles in the database. <a href="vehicle_manager.php?cAction=create_new" class="link1">Create a new vehicle</a></strong></div><table><tr><td></td></tr>'; } 
					?> 
					<tr>
					<td colspan="5"><input name="delete_selected" type="submit" value="Delete selected"  onclick="return confirm('Are you sure you want to delete selected vehicle(s)?\n\nNotice: deleted vehicle(s) cannot be restored')"> </td>
					</tr>
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
    </form>
	<?php
	}
	?>
    <?php
	// Create a New Vehicle
	if ($_GET[cAction] == 'create_new') {
	?>
	<form id="create_new" style="padding-bottom:0px;" enctype="multipart/form-data" name="create_new" method="post" action="vehicle_manager.php" onsubmit="return validate(this)">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>ADD A NEW VEHICLE</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Vehicle Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="name" class="bodytxt" size="19" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Passengers</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="passengers" class="bodytxt" size="3" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="left" colspan="2" height="30" width="100%" class="ot2"><strong>Vehicle Description:</strong><br /><textarea name="description" rows="10" style="width:100%"  class="mceEditor"></textarea>
				</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Vehicle Picture</strong></td>
                <td align="left" height="30"><input NAME="upload" TYPE="file" class="bodytxt" size="39" id="upload"></td>
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
	// Edit Vehicle
	if ($_GET[cAction] == 'edit') {
	?>
	<form id="edit_vehicle" style="padding-bottom:0px;" name="edit_vehicle" enctype="multipart/form-data" method="post" action="vehicle_manager.php?cAction=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>EDIT VEHICLE</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Vehicle Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="name" class="bodytxt" size="19" type="text" value="<?php echo $vehicle_view['name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Passengers</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="passengers" class="bodytxt" size="3" type="text" value="<?php echo $vehicle_view['passengers']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="left" colspan="2" height="30" width="100%" class="ot2"><strong>Vehicle Description:</strong><br /><textarea name="description" rows="10" style="width:100%"  class="mceEditor"><?php echo $vehicle_view['description']; ?></textarea>
				</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Vehicle Picture</strong></td>
                <td align="left" height="30"><input NAME="upload" TYPE="file" class="bodytxt" size="39" id="upload"><br />
                <?php if (!empty($vehicle_view['vehicle_image'])) { ?>
                <div align="center" style="width:170px;">
                <img src="../media/images/thumbs/<?php echo $vehicle_view['vehicle_image']; ?>" border="0" width="170" height="109" style="padding-top:5px; border:#000000 solid 1px;"><br /><a href="picture_manager.php?delete=yes&image_name=<?php echo $vehicle_view['vehicle_image']; ?>&id=<?php echo $_GET['id']; ?>" class="contact_link">Delete Image</a>
                </div>
                <? } ?>
                </td>
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