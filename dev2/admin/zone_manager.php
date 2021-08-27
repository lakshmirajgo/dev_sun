<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
include("includes/functions/zone_functions.php");	

//Check permissions for User BEGIN
if (!chech_permissions($_SESSION['user_details'], 'zone')) {
//header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/index.php");
echo '<script language="javascript">alert(\'You dont have a permissions access to this page!\');window.location=\'index.php\';</script>';
// Quit the script
exit(); 
}
//Check permissions for User END	

	if ($_POST['action'] == 'create_new') {
		if(add_zones())
		echo '<script language="javascript">alert(\'Zone created successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error creating zone\');</script>';
	}
	
	if ($_GET['cAction'] == 'edit'){
		$zone_view = get_zones_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			if (edit_zones($_GET['id'])) {
			echo '<script language="javascript">alert(\'Zone updated successfully\');</script>';
						$zone_view = get_zones_view($_GET['id']);
						} else {
			echo '<script language="javascript">alert(\'Error updating zone\');</script>';	
			};
		}
	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_zones($delete_id))
		echo '<script language="javascript">alert(\'Zone Deleted Successfully\');window.location=\'zone_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the zone\n\nPlease try again\');window.location=\'zone_manager.php\';</script>';
		$all_zones = get_all_zones();
		
	}
	
	if (!empty($_POST['delete_selected'])){
		if(delete_zones($_POST['id']))
		echo '<script language="javascript">alert(\'Zone Deleted Successfully\')</script>';
		$all_zones = get_all_zones();
	}
		
	include ("includes/common/header.php");	
    $all_zones = get_all_zones();
	 include ("includes/common/menu.php");	
	// Show all pages
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>ZONE MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="zone_manager.php?cAction=create_new"><img src="images/add_zone.jpg" border="0" type="image" alt="Add a New Zone" title="Add a New Zone"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="zone_manager.php">
		<input type="hidden" value="" name="action">
		<table width="570" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bodytxt" style="margin-top: 10px;">
             <tr bgcolor="#646464" >
               		  <td width="37" style="font-weight: bold; color:#FFFFFF"></td>
                      <td width="22"></td>
                      <td width="484" align="left" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Zone Title</td>
                      <td width="22"></td>
                      <td width="5"></td>
                  </tr>
                  <?php 	
					if(count($all_zones)>=1){
					foreach($all_zones as $value){
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="37" height="22" align="center" class="ot1"><input name="id[]" type="checkbox" value="<?php echo $value['id']; ?>"></td>
                      <td width="22" height="22" align="center"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a></td> 
                      <td width="484" align="left" class="ot1"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Edit Zone"><strong><?php echo $value['name']; ?></strong> - <?php echo $value['description']; ?></a></td>                      <td width="22" height="22" align="center"><a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this zone?\n\nNotice: deleted zone cannot be restored')" /></a></td> 
                      <td width="5"></td>
                    </tr>
                    <? } 
					
					
						} else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no zones in the database. <a href="zone_manager.php?cAction=create_new" class="link1">Create a new zone</a></strong></div><table><tr><td></td></tr>'; } 
					?> 
					<tr>
					<td colspan="5"><input name="delete_selected" type="submit" value="Delete selected"  onclick="return confirm('Are you sure you want to delete selected zone(s)?\n\nNotice: deleted zone(s) cannot be restored')"> </td>
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
	// Create a New Zone
	if ($_GET[cAction] == 'create_new') {
	?>
	<form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="zone_manager.php" onsubmit="return validate(this)">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>ADD A NEW ZONE</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <!-- 
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Zone Code:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="code" class="bodytxt" size="19" type="text"></td>
              </tr>
              -->
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Zone Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="name" class="bodytxt" size="19" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Zone Description</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="description" class="bodytxt" size="69" type="text"></td>
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
	// Edit Zone
	if ($_GET[cAction] == 'edit') {
	?>
	<form id="edit_zone" style="padding-bottom:0px;" name="edit_zone" method="post" action="zone_manager.php?cAction=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>EDIT ZONE</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <!--
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Zone Code:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="code" class="bodytxt" size="19" type="text" value="<?php echo $zone_view['code']; ?>"></td>
              </tr>
              -->
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Zone Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="name" class="bodytxt" size="19" type="text" value="<?php echo $zone_view['name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Zone Description</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="description" class="bodytxt" size="69" type="text" value="<?php echo $zone_view['description']; ?>"></td>
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