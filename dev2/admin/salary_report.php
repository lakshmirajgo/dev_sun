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
include("includes/functions/expense_log_functions.php");
	
	if($_GET['cAction']=="get_salary_report"){
		$all_trips = get_driver_from_reservation_by_iws($_GET['drivers_id'], format_date_calendar($_GET["from"]), format_date_calendar($_GET["to"]));
		}
		
	include ("includes/common/header.php");
 	include ("includes/common/menu.php");
	
	
    $all_drivers = get_all_drivers();

	// Show Trip Sheet for Specific Driver
	?>
<form name="displayfrm" method="get" action="salary_report.php">
    <input type="hidden" value="get_salary_report" name="cAction" />
        <table border="0" cellpadding="5" cellspacing="0" width="1172" class="ot" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">
          <tbody><tr>
       	    <td align="center" valign="middle" width="100%">
              <table border="0" cellpadding="3" cellspacing="0" width="100%">
                <tbody><tr>
                  <td width="76%" height="20" align="center" valign="top">Driver's Name
                    <select name="drivers_id"> 
                    <option selected="selected" value="<?php echo $_GET['drivers_id'];?>"><?php $driver = get_driver_view($_GET['drivers_id']); echo ucfirst($driver['first_name']). " " . ucfirst($driver['last_name']); if(!$driver){echo "None";}?></option>
                    <option value="">None</option>
					<?php $counter =0; while($counter < count($all_drivers)){
								
								echo '<option value="'.$all_drivers[$counter]["id"].'">'.ucfirst($all_drivers[$counter]["first_name"]) .' '. ucfirst($all_drivers[$counter]["last_name"]) .'</option>';
								echo $all_drivers[$counter]["id"];
								$counter++;
							} 
					?>
                    </select>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From <input name="from" type="text" id="from" size="8" maxlength="10" value="<?php if($_GET['cAction']=="get_trip_sheet"){ echo $_GET['from'];} else { echo date("m/d/Y");}?>"><img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('from');" /><i> <font color="#ff0000" size="1"> select date</font></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To 
                  <input name="to" type="text" id="to" size="8" maxlength="10" value="<?php if($_GET['cAction']=="get_trip_sheet"){ echo $_GET['to'];} else { echo date("m/d/Y");}?>"><img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('to');" /><i> <font color="#ff0000" size="1"> select date</font></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name="get_salary_report" type="submit" value="Get Salary Report"></td>
                  </tr>
                </tbody>
              </table>
             </td>
            </tr>
          </tbody>
</table>
</form>
<table border="0" cellpadding="10" cellspacing="10" width="1172" class="ot" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">
<tbody><tr>
        <td align="center" valign="middle" width="100%">
		
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody><tr>
            <td class="bodytxt" align="center" height="28" valign="middle">
              <table border="0" cellpadding="5" cellspacing="0" width="90%">
                <tbody><tr>
                  <td align="center" height="20" valign="top"><strong>DRIVER'S SALARY REPORT</strong></td>
                  </tr>
                  <tr>
                </tr>
              </tbody></table>
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              	<td width="50%" valign="middle" align="left"><strong>Date:</strong> <?php if (!empty($_GET['from'])) { echo $_GET['from'].' - '; } ;?><?php if (!empty($_GET['to'])) { echo $_GET['to']; } ;?><br /><strong>Driver:</strong> <?php $driver = get_driver_view($_GET['drivers_id']); echo  strtoupper($driver['first_name']). " " .strtoupper($driver['last_name']); ?></td>
                <td width="50%" valign="middle" align="right">&nbsp;</td>
              </tr>
              </table>
            </td>
          </tr>
          <tr>
          	<td>
                <table width="1044" border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bodytxt" style="margin-top: 10px;">
                  <tr bgcolor="#FFFFFF" >
                    <td width="28" style="font-weight: bold; color:#FFFFFF">&nbsp;</td>
                    <td width="100" align="center" height="22" style="font-weight: bold;" class="ot1">DATE</td>
                    <td width="28%" align="center" height="22" style="font-weight: bold;" class="ot1">NUMBER OF TRANSFERS</td>
                    <td width="28%" align="center" height="22" style="font-weight: bold;" class="ot1">WAGE TYPE</td>
                    <td width="28%" align="center" height="22" style="font-weight: bold;" class="ot1">TOTAL AMOUNT</td>
                  </tr>
                  <?php 	
					if(count($all_trips)>=1 && $_GET['drivers_id'] != ''){
					$list=1;
					$number_of_trips ='0';
					$total_this_day ='0';
					$total_salary = '0';
					foreach($all_trips as $value){
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
  <td width="28" height="22" align="center" class="ot1"><?php echo $list; $list++; ?></td>
    <td width="100" height="22" align="center"><a href="trip_sheet.php?cAction=get_trip_sheet&drivers_id=<?php echo $_GET['drivers_id']; ?>&from=<?php echo format_date_calendar2($value['pickup_date']); ?>&to=<?php echo format_date_calendar2($value['pickup_date']); ?>&get_trip_sheet=Get+Trip+Sheet" title="View Trip Sheet for this day" target="_blank" class="bodytxt"><strong><?php echo format_date_calendar2($value['pickup_date']); ?></strong></a></td>
    <td width="28%" align="center" class="ot1"><?php  echo $number_of_trips = count_number_of_trips($_GET['drivers_id'], $value['pickup_date'], $value['pickup_date']); ?></td>
    <td width="28%" height="22" align="center"><?php if($number_of_trips > $company_info['driver_minimum_transfers']) { echo 'Daily Wage'; $total_this_day = $driver['daily_wage']; } else { echo '$'.number_format($driver['per_transfer_wage'], 2, '.', ''). ' per transfer'; $total_this_day = $driver['per_transfer_wage']*$number_of_trips; }; ?></td>
    <td width="28%" align="center" class="ot1"><?php echo '$'.number_format($total_this_day, 2, '.', ''); $total_salary = $total_this_day + $total_salary; ?></td>
  </tr>
    <?php } ?>
  <?php 					
						} 
						elseif ($_GET['drivers_id']=="") { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>A driver has not been selected for a Salary Report. Please Select a driver above.</div><table><tr><td></td></tr>'; }
						else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no reports for this driver.</div><table><tr><td></td></tr>'; } 
					?>
                </table>
            </td>
          </tr>
        </tbody></table>
        <br />
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              	<td width="50%" valign="middle" align="left">&nbsp;
                
                </td>
                <td width="50%" valign="middle" align="right"><strong>Total:</strong> <?php echo '$'.number_format($total_salary, 2, '.', ''); ?>
                </td>
              </tr>
              </table>
        <div style="padding-top:20px;" align="center">
        <a href="salary_report_print.php?cAction=get_trip_sheet&drivers_id=<?php echo $_GET['drivers_id']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>" target="_blank"><img src="images/print_salary_report.jpg" border="0"></a>
        </div>
            
		</td>
      </tr>
    </tbody>
  </table>
<?php
include ("includes/common/footer.php");
?>