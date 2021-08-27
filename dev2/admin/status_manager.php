<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
include("includes/functions/status_functions.php");	

//Check permissions for User BEGIN
if (!chech_permissions($_SESSION['user_details'], 'status')) {
//header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/index.php");
echo '<script language="javascript">alert(\'You dont have a permissions access to this page!\');window.location=\'index.php\';</script>';
// Quit the script
exit(); 
}
//Check permissions for User END

	if ($_POST['action'] == 'create_new') {
		if(add_statuses())
		echo '<script language="javascript">alert(\'Status created successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error creating status\');</script>';
	}
	
	if ($_GET['cAction'] == 'edit'){
		$status_view = get_statuses_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			if (edit_statuses($_GET['id'])) {
			echo '<script language="javascript">alert(\'Status updated successfully\');</script>';
						$status_view = get_statuses_view($_GET['id']);
						} else {
			echo '<script language="javascript">alert(\'Error updating status\');</script>';	
			};
		}
	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_statuses($delete_id))
		echo '<script language="javascript">alert(\'Status Deleted Successfully\');window.location=\'status_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the status\n\nPlease try again\');window.location=\'status_manager.php\';</script>';
		$all_statuses = get_all_statuses();
		
	}
	
	if (!empty($_POST['delete_selected'])){
		if(delete_statuses($_POST['id']))
		echo '<script language="javascript">alert(\'Status Deleted Successfully\')</script>';
		$all_statuses = get_all_statuses();
	}
		
	include ("includes/common/header.php");	

    $all_statuses = get_all_statuses();
	 include ("includes/common/menu.php");	
	// Show all statuses
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>STATUS MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="status_manager.php?cAction=create_new"><img src="images/add_status.jpg" border="0" type="image" alt="Add a New Status" title="Add a New Status"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="status_manager.php">
		<input type="hidden" value="" name="action">
		<table width="570" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bodytxt" style="margin-top: 10px;">
             <tr bgcolor="#646464" >
               		  <td width="37" style="font-weight: bold; color:#FFFFFF"></td>
                      <td width="22"></td>
                      <td width="484" align="left" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Status Name</td>
                      <td width="22"></td>
                      <td width="5"></td>
                  </tr>
                  <?php 	
					if(count($all_statuses)>=1){
					foreach($all_statuses as $value){
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="37" height="22" align="center" class="ot1"><input name="id[]" type="checkbox" value="<?php echo $value['id']; ?>"></td>
                      <td width="22" height="22" align="center"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a></td> 
                      <td width="484" align="left" class="ot1"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Edit Status"><strong><?php echo $value['name']; ?> </strong><?php if (!empty($value['description'])) { echo "- ".$value['description']; }; ?></a></td>                      <td width="22" height="22" align="center"><a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this status?\n\nNotice: deleted status cannot be restored')" /></a></td> 
                      <td width="5"></td>
                    </tr>
                    <? } 
					
					
						} else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no statuses in the database. <a href="status_manager.php?cAction=create_new" class="link1">Create a new status</a></strong></div><table><tr><td></td></tr>'; } 
					?> 
					<tr>
					<td colspan="5"><input name="delete_selected" type="submit" value="Delete selected"  onclick="return confirm('Are you sure you want to delete selected status(es)?\n\nNotice: deleted status(es) cannot be restored')"> </td>
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
	// Create a New Status
	if ($_GET[cAction] == 'create_new') {
	?>
	<form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="status_manager.php" onsubmit="return validate(this)">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>ADD A NEW STATUS</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Status Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="name" class="bodytxt" size="39" type="text"></td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Status Description:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="description" rows="3" cols="36" class="bodytxt"></textarea></td>
              </tr>
              <tr valign="middle">
                <td colspan="2" height="30" width="38%" class="ob" align="center">
                <table border="1" cellpadding="0" cellspacing="0">
                	<tr>
                    	<td width="30" align="center" style="padding:5px;"><img src="images/icons/icon9.png" border="0" /></td>
                    	<td width="30" align="center" style="padding:5px;"><img src="images/icons/icon_green_on.gif" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon_red_on.gif" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon1.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon2.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon3.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon4.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon5.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon6.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon7.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon8.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon10.png" border="0" /></td>
                   </tr>
                   <tr>
                    	<td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="9" checked="checked" /></td>
                    	<td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="11" /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="12" /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="1" /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="2" /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="3" /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="4" /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="5" /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="6" /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="7" /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="8" /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="10" /></td>
                   </tr>
              </table>
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
	// Edit Status
	if ($_GET[cAction] == 'edit') {
	?>
	<form id="edit_status" style="padding-bottom:0px;" name="edit_status" method="post" action="status_manager.php?cAction=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>EDIT STATUS</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Status Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="name" class="bodytxt" size="39" type="text" value="<?php echo $status_view['name']; ?>"></td>
              </tr>
   			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Status Description:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="description" rows="3" cols="36" class="bodytxt"><?php echo $status_view['description']; ?></textarea></td>
              </tr>
              <tr valign="middle">
                <td colspan="2" height="30" width="38%" class="ob" align="center">
                <table border="1" cellpadding="0" cellspacing="0">
                	<tr>
                    	<td width="30" align="center" style="padding:5px;"><img src="images/icons/icon9.png" border="0" /></td>
                    	<td width="30" align="center" style="padding:5px;"><img src="images/icons/icon_green_on.gif" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon_red_on.gif" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon1.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon2.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon3.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon4.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon5.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon6.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon7.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon8.png" border="0" /></td>
                        <td width="30" align="center" style="padding:5px;"><img src="images/icons/icon10.png" border="0" /></td>
                   </tr>
                   <tr>
                    	<td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="9" <?php if ($status_view['icon_id'] =='9') { echo 'checked="checked" '; } ; ?>/></td>
                    	<td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="11" <?php if ($status_view['icon_id'] =='11') { echo 'checked="checked" '; } ; ?> /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="12" <?php if ($status_view['icon_id'] =='12') { echo 'checked="checked" '; } ; ?> /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="1" <?php if ($status_view['icon_id'] =='1') { echo 'checked="checked" '; } ; ?> /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="2" <?php if ($status_view['icon_id'] =='2') { echo 'checked="checked" '; } ; ?> /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="3" <?php if ($status_view['icon_id'] =='3') { echo 'checked="checked" '; } ; ?> /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="4" <?php if ($status_view['icon_id'] =='4') { echo 'checked="checked" '; } ; ?> /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="5" <?php if ($status_view['icon_id'] =='5') { echo 'checked="checked" '; } ; ?> /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="6" <?php if ($status_view['icon_id'] =='6') { echo 'checked="checked" '; } ; ?> /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="7" <?php if ($status_view['icon_id'] =='7') { echo 'checked="checked" '; } ; ?> /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="8" <?php if ($status_view['icon_id'] =='8') { echo 'checked="checked" '; } ; ?> /></td>
                        <td width="30" align="center" style="padding:5px;"><input name="icon_id" type="radio" value="10" <?php if ($status_view['icon_id'] =='10') { echo 'checked="checked" '; } ; ?> /></td>
                   </tr>
              </table>
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