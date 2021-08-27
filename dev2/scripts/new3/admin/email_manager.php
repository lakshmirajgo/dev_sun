<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
include("includes/functions/email_functions.php");	
include("includes/functions/status_functions.php");	

	if ($_POST['action'] == 'create_new') {
		if(add_emails())
		echo '<script language="javascript">alert(\'Email template created successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error creating email template\');</script>';


	}
	
	if ($_GET['cAction'] == 'edit'){
		$email_view = get_emails_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			if (edit_emails($_GET['id'])) {
			echo '<script language="javascript">alert(\'Email template updated successfully\');</script>';
						$email_view = get_emails_view($_GET['id']);
						} else {
			echo '<script language="javascript">alert(\'Error updating email template\');</script>';	
			};
		}
	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_emails($delete_id))
		echo '<script language="javascript">alert(\'Email template Deleted Successfully\');window.location=\'email_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the email template\n\nPlease try again\');window.location=\'email_manager.php\';</script>';
		$all_emails = get_all_emails();
		
	}
	
	if (!empty($_POST['delete_selected'])){
		if(delete_emails($_POST['id']))
		echo '<script language="javascript">alert(\'Email template Deleted Successfully\')</script>';
		$all_emails = get_all_emails();
	}
		
	include ("includes/common/header.php");
	$all_statuses = get_all_statuses();	
    $all_emails = get_all_emails();
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>EMAIL TEMPLATE MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="email_manager.php?cAction=create_new"><img src="images/add_email.jpg" border="0" type="image" alt="Add a New Email template" title="Add a New Email template"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="email_manager.php">
		<input type="hidden" value="" name="action">
		<table width="570" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bodytxt" style="margin-top: 10px;">
             <tr bgcolor="#646464" >
               		  <td width="37" style="font-weight: bold; color:#FFFFFF"></td>
                      <td width="22"></td>
                      <td width="484" align="left" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Email Template Name</td>
                      <td width="22"></td>
                      <td width="5"></td>
                  </tr>
                  <?php 	
					if(count($all_emails)>=1){
					foreach($all_emails as $value){
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="37" height="22" align="center" class="ot1"><input name="id[]" type="checkbox" value="<?php echo $value['id']; ?>"></td>
                      <td width="22" height="22" align="center"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a></td> 
                      <td width="484" align="left" class="ot1"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Edit Email Template"><?php echo $value['email_name']; ?></a></td>                      <td width="22" height="22" align="center"><a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this email template?\n\nNotice: deleted email template cannot be restored')" /></a></td> 
                      <td width="5"></td>
                    </tr>
                    <? } 
					
					
						} else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no email templates in the database. <a href="email_manager.php?cAction=create_new" class="link1">Create a new email template</a></strong></div><table><tr><td></td></tr>'; } 
					?> 
					<tr>
					<td colspan="5"><input name="delete_selected" type="submit" value="Delete selected"  onclick="return confirm('Are you sure you want to delete selected email templates(s)?\n\nNotice: deleted email templates(s) cannot be restored')"> </td>
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
	// Create a New Email Template
	if ($_GET[cAction] == 'create_new') {
	?>
	<form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="email_manager.php" onsubmit="return validate(this)">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>ADD A NEW EMAIL TEMPLATE</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Status</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="status_id" id="status_id" size="1" class="bodytxt">
                  <?php 
				
				if(count($all_statuses)>=1){
				foreach($all_statuses as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </select></td>
			  </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Email Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="email_name" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Email Subject</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="email_title" class="bodytxt" size="59" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="left" colspan="2" height="30" width="100%" class="ot2"><strong>Email Content:</strong><br /><textarea name="email_content" rows="20" style="width:100%"  class="mceEditor"></textarea>
				</td>
              </tr>
              <tr valign="middle">
                <td align="left" colspan="2" height="30" width="100%" class="ot2"><strong>Email Content (Bottom):</strong><br /><textarea name="email_content2" rows="20" style="width:100%"  class="mceEditor"></textarea>
				</td>
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
	// Edit Email Template
	if ($_GET[cAction] == 'edit') {
	?>
	<form id="edit_email" style="padding-bottom:0px;" name="edit_page" method="post" action="email_manager.php?cAction=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>EDIT EMAIL TEMPLATE</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			   <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Status</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $status_view = get_statuses_view($email_view['status_id']); ?>
                <select name="status_id" id="status_id" size="1" class="bodytxt">
                <option value="<?php echo $email_view['status_id']; ?>"><?php echo $status_view['name']; ?></option>
                <?php 
				
				if(count($all_statuses)>=1){
				foreach($all_statuses as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </select></td>
			  </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Email Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="email_name" class="bodytxt" size="39" type="text" value="<?php echo $email_view['email_name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Email Subject</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="email_title" class="bodytxt" size="59" type="text" value="<?php echo $email_view['email_title']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="left" colspan="2" height="30" width="100%" class="ot2"><strong>Email Content:</strong><br /><textarea name="email_content" rows="20" style="width:100%"  class="mceEditor"><?php echo $email_view['email_content']; ?></textarea>
				</td>
              </tr>
              <tr valign="middle">
                <td align="left" colspan="2" height="30" width="100%" class="ot2"><strong>Email Content (Bottom):</strong><br /><textarea name="email_content2" rows="20" style="width:100%"  class="mceEditor"><?php echo $email_view['email_content2']; ?></textarea>
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
include ("includes/common/footer.php");
?>