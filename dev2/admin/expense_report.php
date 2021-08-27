<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
include ("includes/functions/drivers_functions.php");
include("includes/functions/expense_log_functions.php");

	include ("includes/common/header.php");
 	include ("includes/common/menu.php");
    $log_view = get_log_view($_GET['id']);
	$all_logs = get_all_logs();
	//print_r($all_logs); exit;
	$all_drivers = get_all_drivers();
	//print_r($all_amounts); exit;
	
	// Show all logs
	?>
    <form name="displayfrm" method="post" action="expense_report.php">
	 <table border="0" cellpadding="0" cellspacing="0" width="680" class="ot" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">
      <tbody><tr>
        <td align="center" valign="middle" width="100%">
		<table width="104%" height="196" border="0" cellpadding="0" cellspacing="0">
          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td width="25%" height="20" align="left" valign="top" style="border-bottom: 1px solid rgb(220, 220, 220);"><em><strong>EXPENSE REPORT</strong></em></td>
                  <td width="75%" height="20" align="right" valign="top" style="border-bottom: 1px solid rgb(220, 220, 220);">From
                    <input name="from" type="text" id="from" size="8" maxlength="10"><img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('from');" /><i> <font color="#ff0000" size="1"> select date</font></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To<input name="to" type="text" id="to" size="8" maxlength="10"><img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('to');" /><i> <font color="#ff0000" size="1"> select date</font></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="get_report" type="submit" value="Get Report"></td>
                </tr>
              </tbody></table>
  </form>           
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <table width="649" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bodytxt" style="margin-top: 10px;">
              <tr bgcolor="#646464" >
                <td width="27"></td>
                <td width="111" align="left" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1"><?php
                      if ($_GET['sort'] == 'desc' || $_GET['sort'] == '') {
					  ?>
                    <a href="" class="link2">Date of Expense</a>
                    <?php } else { ?>
                    <a href="" class="link2">Date of Expense</a>
                    <?php } ?></td>
                <td width="149" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1"><?php
                      if ($_GET['sort'] == 'asc' || $_GET['sort'] == '') {
					  ?>
                    <a href="" class="link2">Expense Type</a>
                    <?php } else { ?>
                    <a href="" class="link2">Expense Type</a>
                    <?php } ?></td>
                <td width="201" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Comments</td>
                <td width="161" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Amount</td>
              </tr>
              <?php
			  		if(!isset($_POST['get_report'])){
					if(count($all_logs)>=1){
					foreach($all_logs as $value){
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
  <td width="27" height="22" align="center" class="ot1"></td>
      <td width="111" height="22" align="center"><?php if (!empty($value['date'])) { echo format_date_calendar2($value['date']); }; ?></td>
    <td width="149" align="center" class="ot1"><?php if (!empty($value['type'])) { if ($value['type'] == 1){echo "Utilities";} elseif ($value['type'] == 2){echo "Rent";} elseif ($value['type'] == 3){echo "Vehicle Repair";} elseif ($value['type'] == 4){echo "Other";} }; ?></td>
    <td width="201" align="center" class="ot1"><?php if (!empty($value['comment'])) { echo $value['comment']; }; ?></td>
    <td width="161" align="center" class="ot1"><?php if (!empty($value['amount'])) { echo $value['amount']; }; ?></td>
  </tr>
  <tr>
    <?php } ?>
    <td colspan="4" valign="bottom" height="30"></td>
    <td colspan="1" valign="bottom" align="left" height="30"style="font-weight: bold; color:#000000" class="ot1">Total:
      <?php $counter =0; $total_amount = 0; while($counter < count($all_logs)){	
								//echo $all_logs[$counter]["id"].' '.$all_logs[$counter]["amount"];
								$amount = $all_logs[$counter]["amount"];
								$total_amount = $total_amount + $all_logs[$counter]["amount"];
								$counter++;
							}
							echo "$".$total_amount;
					?></td>
  				</tr>
  			<?php	
			}?>
            </table>
            </td>
          </tr>
        </tbody></table>
		</td>
      </tr>
    </tbody></table>
	<?php
	}
	elseif(isset($_POST['get_report'])){
		echo $_POST['from'].' '.$_POST['to']; exit;
		if(count($all_logs)>=1){
					foreach($all_logs as $value){
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
  <td width="27" height="22" align="center" class="ot1"></td>
      <td width="111" height="22" align="center"><?php if (!empty($value['date'])) { echo format_date_calendar2($value['date']); }; ?></td>
    <td width="149" align="center" class="ot1"><?php if (!empty($value['type'])) { if ($value['type'] == 1){echo "Utilities";} elseif ($value['type'] == 2){echo "Rent";} elseif ($value['type'] == 3){echo "Vehicle Repair";} elseif ($value['type'] == 4){echo "Other";} }; ?></td>
    <td width="201" align="center" class="ot1"><?php if (!empty($value['comment'])) { echo $value['comment']; }; ?></td>
    <td width="161" align="center" class="ot1"><?php if (!empty($value['amount'])) { echo $value['amount']; }; ?></td>
  </tr>
  <tr>
    <?php } ?>
    <td colspan="4" valign="bottom" height="30"></td>
    <td colspan="1" valign="bottom" align="left" height="30"style="font-weight: bold; color:#000000" class="ot1">Total:
      <?php $counter =0; $total_amount = 0; while($counter < count($all_logs)){	
								//echo $all_logs[$counter]["id"].' '.$all_logs[$counter]["amount"];
								$amount = $all_logs[$counter]["amount"];
								$total_amount = $total_amount + $all_logs[$counter]["amount"];
								$counter++;
							}
							echo "$".$total_amount;
					?></td>
  				</tr>
  			<?php	
			}?>
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
	