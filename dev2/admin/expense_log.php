<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
include("includes/functions/expense_log_functions.php");
include ("includes/functions/drivers_functions.php");

	if ($_POST['action'] == 'create_new') {
		if(add_log())
		echo '<script language="javascript">alert(\'Expense logged successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error creating log\');</script>';
	}
	
	if ($_GET['cAction'] == 'edit'){
		$log_view = get_log_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			if (edit_log($_GET['id'])) {
			echo '<script language="javascript">alert(\'Log updated successfully\');</script>';
						$log_view = get_log_view($_GET['id']);
						} else {
			echo '<script language="javascript">alert(\'Error updating log\');</script>';	
			};
		}
	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_log($delete_id))
		echo '<script language="javascript">alert(\'Log Deleted Successfully\');window.location=\'expense_log.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the log\n\nPlease try again\');window.location=\'expense_log.php\';</script>';
		$all_logs = get_all_logs();
		
	}
	
	if (!empty($_GET['delete_selected'])){
		if(delete_log($_GET['id']))
		echo '<script language="javascript">alert(\'Log Deleted Successfully\')</script>';
		$all_logs = get_all_logs();
	}
		
	//Get reports if TO and FROM get values are set
	if($_GET['cAction']=="get_report")
		$all_logs = get_log( format_date_calendar($_GET["from"]),  format_date_calendar($_GET["to"]));
		//print_r($expense_log); exit;

	//Default - Diplay this month date range
	if(empty($_GET['cAction']))
	$all_logs = get_log(date("Y-m-01"), date("Y-m-30"));
	
	include ("includes/common/header.php");
 	include ("includes/common/menu.php");
    //$all_logs = get_all_logs();
	//print_r( $all_logs); exit;
	$all_drivers = get_all_drivers();
	//print_r($all_drivers); exit;

	// Show all logs
	if (empty($_GET['cAction']) || $_GET['cAction'] == 'get_report' || $_GET['cAction'] == 'delete'){
	?>
    <form name="displayfrm" method="get" action="expense_log.php">
    <input type="hidden" value="get_report" name="cAction" />
            <table border="0" cellpadding="5" cellspacing="0" width="765" class="ot" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">
             <tbody><tr>
        	   <td align="center" valign="middle" width="100%">
                 <table border="0" cellpadding="3" cellspacing="0" width="100%">
                   <tbody><tr>
                     <td width="19%" height="20" align="center" valign="top" style="border-bottom: 1px solid rgb(220, 220, 220);"><em><strong>REPORT</strong></em></td>
                     <td width="81%" height="20" align="center" valign="top" style="border-bottom: 1px solid rgb(220, 220, 220);">From
                     <input name="from" type="text" id="from" size="8" maxlength="10" value="<?php if($_GET['cAction']=="get_report"){ echo $_GET['from'];} else { echo date("m/01/Y");}?>"><img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('from');" /><i> <font color="#ff0000" size="1"> select date</font></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To<input name="to" type="text" id="to" size="8" maxlength="10" value="<?php if($_GET['cAction']=="get_report"){ echo $_GET['to'];} else { echo date("m/30/Y");}?>"><img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('to');" /><i> <font color="#ff0000" size="1"> select date</font></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="get_report" type="submit" value="Get Report"></td>
                    </tr>
                  </tbody>
                 </table>
                </td>
               </tr>
              </tbody>
            </table>
          </form>
	 <table border="0" cellpadding="0" cellspacing="0" width="765" class="ot" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">
      <tbody><tr>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle">
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong><em>EXPENSE LOG</em></strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="expense_log.php?cAction=create_new"><img src="images/add_expense_log.jpg" border="0" type="image" alt="Add a New Expense Log" title="Add a New Expense Log"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="expense_log.php">
		<input type="hidden" value="" name="action">
		<table width="730" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bodytxt" style="margin-top: 10px;">
             <tr bgcolor="#646464" >
               		  <td width="31" style="font-weight: bold; color:#FFFFFF"></td>
                      <td width="34"></td>
                      <td width="120" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1"><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                      <a href="?orderby=date&sort=asc" class="link2">Date</a><?php } else { ?>
                      <a href="?orderby=date&sort=desc" class="link2">Date</a>
					  <?php } ?></td>
                      <td width="171" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1"><?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                      <a href="?orderby=type&sort=desc" class="link2">Account</a><?php } else { ?>
                      <a href="?orderby=type&sort=asc" class="link2">Account</a>
					  <?php } ?></td>
                      <td width="207" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Memo</td>
                      <td width="121" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Amount</td>
                      <td width="46"></td>
                  </tr>
                  <?php 	
					if(count($all_logs)>=1){
					foreach($all_logs as $value){
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="31" height="22" align="center" class="ot1"><input name="id[]" type="checkbox" value="<?php echo $value['id']; ?>"></td>
                      <td width="34" height="22" align="center"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" title="Click to Edit"><img src="images/edit.png" border="0" /></a></td> 
                      <td width="120" align="center" class="ot1"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Edit Expenses"><strong><?php if (!empty($value['date'])) { echo format_date_calendar2($value['date']); }; ?></strong></a></td> 
                      <td width="171" align="center" class="ot1"><?php if (!empty($value['type'])) { if ($value['type'] == 1){echo "Utilities";} elseif ($value['type'] == 2){echo "Rent";} elseif ($value['type'] == 3){echo "Auto Repair";} elseif ($value['type'] == 4){echo "Office Equipment Supplies";} elseif ($value['type'] == 5){echo "Licenses & Taxes";} elseif ($value['type'] == 6){echo "Gas";} elseif ($value['type'] == 7){echo "Salary";} elseif ($value['type'] == 8){echo "Miscellaneous";} }; ?></td>
                      <td width="207" align="center" class="ot1"><?php if (!empty($value['comment'])) { echo $value['comment']; }; ?></td> 
                      <td width="121" height="22" align="center"><?php if (!empty($value['amount'])) { echo '$'.number_format($value['amount'], 2, '.', ''); }; ?></td> 
                      <td width="46" height="22" align="center"><a href="?cAction=delete&id=<?php echo $value['id']; ?>" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this log?\n\nNotice: deleted log cannot be restored')" /></a></td>
                    </tr>
                    <tr>
                    <?php } ?>
					<td colspan="5" valign="bottom" height="30"><input name="delete_selected" type="submit" value="Delete selected"  onclick="return confirm('Are you sure you want to delete selected logs?\n\nNotice: deleted logs cannot be restored')"></td>
                    <td colspan="3" valign="bottom" height="30" align="right"><?php $counter =0; $total_amount = 0; while($counter < count($all_logs)){	
								//echo $all_logs[$counter]["id"].' '.$all_logs[$counter]["amount"];
								$amount = $all_logs[$counter]["amount"];
								$total_amount = $total_amount + $all_logs[$counter]["amount"];
								$counter++;
							}
							echo '<strong>Total:</strong>  $'.number_format($total_amount, 2, '.', '');
					?>
					</tr>
                    <?php 					
						} else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>No expenses found for that date range <a href="expense_log.php?cAction=create_new" class="link1">Enter a new Expense</a></strong></div><table><tr><td></td></tr>'; } 
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
	// Create a New Expense
	if ($_GET[cAction] == 'create_new') {
	?>
	<form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="expense_log.php">
	<input name="action" type="hidden" value="create_new">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
      <tbody><tr>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="580" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong><em>ADD A NEW LOG</em></strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Expense Type:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><span style="border-bottom: 1px solid rgb(220, 220, 220);"><strong><em>
                  <select name="type">
                    <option value="" selected="selected">Please Select</option>
                    <option value="1">Utilities</option>
                    <option value="2">Rent</option>
                    <option value="3">Auto Repair</option>
                    <option value="4">Office Equipment Supplies</option>
                    <option value="5">Licenses & Taxes</option>
                    <option value="6">Gas</option>
                    <option value="7">Salary</option>
                    <option value="8">Miscellaneous</option>
                  </select>
                </em></strong></span></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Date of Expense:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="date" class="bodytxt" size="10" type="text"><img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('date');"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY                				</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Amount of Expense:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="amount" class="bodytxt" size="10" type="text"></td>
              </tr>
                            <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Driver Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                	<select name="drivers_id"> 
                    <option value="">None</option>
					<?php $counter =0; while($counter < count($all_drivers)){
								
								echo '<option value="'.$all_drivers[$counter]["id"].'">'.ucfirst($all_drivers[$counter]["first_name"]) .' '. ucfirst($all_drivers[$counter]["last_name"]) .'</option>';
								echo $all_drivers[$counter]["id"];
								$counter++;
							} 
					?>
                    </select>                    </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Comment:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="comment" class="bodytxt" cols="36" rows="4" type="text"></textarea></td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle">&nbsp;</td>
                <td style="padding-top: 5px; padding-right:20px;" align="right" valign="top"><input border="0" height="22" value="Add New Log" type="submit" width="68" style="border:#1d557f solid 1px; color:#1d557f; background-color:#9edbee; font-weight:bold; padding:3px;" /></td>
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
	// Edit Expense
	if ($_GET[cAction] == 'edit') {
	?>
	<form id="edit_expenses" style="padding-bottom:0px;" name="edit_expenses" method="post" action="expense_log.php?cAction=edit&id=<?php echo $_GET['id']; ?>">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong><em>EDIT EXPENSES</em></strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tbody>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Type of Expense:</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <select name="type">
                <?php if ($log_view['type']=='1') { ?>
                <option value="<?php echo $log_view['type']; ?>" selected="selected">Utilities</option>
                <?php } elseif ($log_view['type']=='2') { ?>
                <option value="<?php echo $log_view['type']; ?>">Rent</option>
                <?php } elseif ($log_view['type']=='3') { ?>
                <option value="<?php echo $log_view['type']; ?>">Auto Repair</option>
                <?php } elseif ($log_view['type']=='4') { ?>
                <option value="<?php echo $log_view['type']; ?>">Office Equipment Supplies</option>
                <?php } elseif ($log_view['type']=='5') { ?>
                <option value="<?php echo $log_view['type']; ?>">Licenses & Taxes</option>
                <?php } elseif ($log_view['type']=='6') { ?>
                <option value="<?php echo $log_view['type']; ?>">Gas</option>
                <?php } elseif ($log_view['type']=='7') { ?>
                <option value="<?php echo $log_view['type']; ?>">Salary</option>
                <?php } else  { ?>
                <option value="<?php echo $log_view['type']; ?>">Miscellaneous</option>
                <?php } ?>
                <option value="1">Utilities</option>
                <option value="2">Rent</option>
                <option value="3">Auto Repair</option>
                <option value="4">Office Equipment Supplies</option>
                <option value="5">Licenses & Taxes</option>
                <option value="6">Gas</option>
                <option value="7">Salary</option>
                <option value="8">Miscellaneous</option>
                </select>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Date of Expense:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="date" class="bodytxt" size="10" type="text" value="<?php echo format_date_calendar2($log_view['date']); ?>"><img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('date');"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY                				</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Amount:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="amount" class="bodytxt" size="10" type="text" value="<?php echo number_format($log_view['amount'], 2, '.', ''); ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Driver Name:</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <select name="drivers_id"> 
                    <option selected="selected" value="<?php echo $log_view['drivers_id'];?>"><?php $driver = get_driver_view($log_view['drivers_id']); echo $driver['first_name']. " " . $driver['last_name']; if(!$driver){echo "None";}?></option>
                    <option value="">None</option>
					<?php $counter =0; while($counter < count($all_drivers)){
								
								echo '<option value="'.$all_drivers[$counter]["id"].'">'.ucfirst($all_drivers[$counter]["first_name"]) .' '. ucfirst($all_drivers[$counter]["last_name"]) .'</option>';
								echo $all_drivers[$counter]["id"];
								$counter++;
							} 
					?>
                    </select>
                    </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Comments:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="comment" class="bodytxt" cols="36" rows="5" type="text"><?php echo $log_view['comment']; ?></textarea></td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle">&nbsp;</td>
                <td style="padding-top: 5px; padding-right:20px;" align="right" valign="top"><input border="0" height="22" value="Update Log" type="submit" width="68" style="border:#1d557f solid 1px; color:#1d557f; background-color:#9edbee; font-weight:bold; padding:3px;" /></td>
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
include ("includes/common/footer.php");
?>