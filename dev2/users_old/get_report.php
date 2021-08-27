<?php
session_start();

if (!isset($_SESSION['auth_user'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
	include("includes/functions/reservation_functions.php");
	include("includes/functions/vehicle_functions.php");
	include_once("includes/functions/location_functions.php");
	include_once("includes/functions/trip_type_functions.php");	
	include("includes/functions/status_functions.php");		

if (!empty($_POST['calculate_total'])){
	  $vehicle_id = $_POST['vehicle_id'];
	  $status_id = $_POST['status_id'];
	  $from = format_date($_POST['from']);
	  $to = format_date($_POST['to']);	
	 $report_reservations = get_report_reservations($from, $to, $vehicle_id, $status_id, $trip_type);
	 //$report_reservations = array_unique($report_reservations['id']);
	}

include ("includes/common/header.php");	
?>
	<div align="center">	
<?php include ("includes/common/menu.php");	?>
	<br />
    <?php 
	$from = format_date_calendar($_POST['from']);
		  $to = format_date_calendar($_POST['to']);	  
	?>
    <form name="report" method="post" action="get_report.php" style="padding:0px; margin:0px;">
    <table width="700" cellpadding="0" cellspacing="0" border="0" style="border:#999999 solid 1px;" bgcolor="#e4e4e4">
    <tr>
    	<td colspan="3" align="center" valign="middle"><h3>Reservation Lookup</h3></td>
    </tr>
    <tr>
    	<td style="padding:5px;">&nbsp;</td>
  <td style="padding:5px;">
                From <input name="from" type="text" id="from" size="8" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal1.popup();"><i> <font color="#ff0000" size=2>select date</font></i>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
            	<td style="padding:5px;">&nbsp;</td>
              <td style="padding:5px;">
                To &nbsp;&nbsp;&nbsp;&nbsp;<input name="to" type="text" id="to" size="8" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal2.popup();"><i> <font color="#ff0000" size=2>select date</font></i>
                </td>
                <td style="padding:5px;"><input name="calculate_total" type="submit" value="Get Report">
                </td>
            </tr>
        </table>
    </form>
    <script language="JavaScript">
<!-- // create calendar object(s) just after form tag closed
	 // specify form element as the only parameter (document.forms['formname'].elements['inputname']);
	 // note: you can have as many calendar objects as you need for your application
	var cal1 = new calendar2(document.forms['report'].elements['from']);
	cal1.year_scroll = true;
	cal1.time_comp = false;
	var cal2 = new calendar2(document.forms['report'].elements['to']);
	cal2.year_scroll = true;
	cal2.time_comp = false;
//-->
</script>
              
              <br /><br />
              <?php 
			  //if (!empty($_GET['from'])) { $from = $_GET['from']; };
			  //if (!empty($_GET['to'])) { $to = $_GET['to']; };
			  $vehicle_id = $_POST['vehicle_id'];
			  $status_id = $_POST['status_id'];
			  $trip_type = $_POST['trip_type'];
			  $from = format_date($_POST['from']);
	  		  $to = format_date($_POST['to']);
			  $report_reservations = get_report_reservations($from, $to, $vehicle_id, $status_id, $trip_type);
			  ?>
              <form name="displayfrm" method="post" action="get_report.php?from=<?php if (!empty($_GET['from'])) { echo $_GET['from']; } else { echo $from; }; ?>&to=<?php if (!empty($_GET['to'])) { echo $_GET['to']; } else { echo $to; }; ?>">
		<input type="hidden" value="" name="action">
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
            <td class="bodytxt" align="center" height="58" valign="bottom" background="images/top_center_curve.jpg"><h2><strong>Report from 
			<?php
			if (!empty($_GET['from'])) { 
			echo format_date_calendar2($from = $_GET['from']);
			} else { 
			echo $_POST['from']; }; 
			?> to 
            <?php
			if (!empty($_GET['to'])) { 
			echo format_date_calendar2($from = $_GET['to']);
			} else { 
			echo $_POST['to']; }; 
			?>
            <?php if (!empty($_POST['vehicle_id'])) {
			$vehicle_view = get_vehicles_view($_POST['vehicle_id']);
			echo '<br>Vehicle: '.$vehicle_view['name'].',';
			} else {
			echo '<br>Vehicle: All Vehicles,';
			}
			?>     
            <?php if (!empty($_POST['status_id'])) {
			$status_view = get_statuses_view($_POST['status_id']);
			echo ' Status: '.$status_view['name'].',';
			} else {
			echo ' Status: All Statuses,';
			}
			?>
            <?php if (!empty($_POST['trip_type'])) {
			$trip_type = get_trip_types_view($_POST['trip_type']); 
			echo ' Trip Type: '.$trip_type['name'];
			} else {
			echo ' Trip Type: All Trip Types';
			}
			?>
            </strong></h2>
            <h2>Found <?php echo count($report_reservations); ?> reservations</h2>
            </td>
          </tr>
          <tr>
          	<td>
		<table width="1210" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt" align="center">
             <tr bgcolor="#646464" >
             		  <td width="5"></td>
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">ID</td>
                      <td width="169" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Name</td>
                      <td width="139" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Car Type</td>
                       <td width="381" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1" align="left">From/To</td>
                       <td width="90" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Arrival Date                      </td>
                      <td width="100" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Departure Date                      </td>
                      <td width="88" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Status</td>
                      <td width="90" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Price</td>
                      <td width="103" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Date submitted                      </td>
                      <td width="5"></td>
                  </tr>
                  <?php 	
				  //print_r($report_reservations);
				  //exit;
					if(count($report_reservations)>=1){
					foreach($report_reservations as $value){
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="5"></td>
                      <td width="40" height="22" align="left" class="ot1"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['id']; ?></strong></a></td>
                      <td width="169" height="22" align="left" class="ot1"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?></strong></a></td>
                      <td width="139" align="center" class="ot1"><?php echo $value['name']; ?></td>
                      <td width="381" align="left" class="ot1">
                      <?php $destination = get_destination_data($value['id']);
					  $num_legs = count($destination);
					  $from = get_locations_view($destination[0]['from']);
					  echo $from['name'];
		  	  		  for ($count =0; $count <= $num_legs - 1; $count += 1) {
					  $to = get_locations_view($destination[$count]['to']);
					  echo "->";
					  echo $to['name'];
					  };
					  
					  ?></td>				  
                      <td width="90" align="center" class="ot1"><?php
					  $arrival_data=get_arrival_data($value['id']); 
					  if (!empty($arrival_data)) {
					  echo format_to_caldate($arrival_data['date']);
					  };
					 ?></td>			  <td width="100" align="center" class="ot1"><?php 
					  $departure_data=get_departure_data($value['id']); 
					  if (!empty($departure_data)) {
					  echo format_to_caldate($departure_data['date']); 
					  }
					  ?></td>
                      <td width="88" align="center" class="ot1"><?php $status = get_statuses_view($value['status']); $icons = get_statuses_icon($status['icon_id']); if (empty($icons)) { echo $status['name']; } else { echo '<img src="images/icons/'.$icons['image'].'" border="0" title="'.$status['name'].'">'; }; ?></td>
                      <td width="90" height="22" align="center">$<?php 
					  if (empty($value['total_amount'])) { echo "0.00"; } else { echo sprintf("%01.2f", $value['total_amount']); }; ?>
                        <input name="fee[]" type="hidden" value="<?php echo sprintf("%01.2f", $value['total_amount']); ?>"></td>
                      <td width="103" align="center" class="ot1"><?php echo format_to_caldate($value['reservation_date']); ?></td>
                      <td width="5"></td>
                    </tr>
                    <? } ?>
                    <tr bgcolor="#646464" >
             		  <td width="5"></td>
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">&nbsp;</td>
                      <td width="169" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">&nbsp;</td>
                       <td width="139" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1" align="center">&nbsp;</td>
                      <td width="381" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">&nbsp;</td>
                      <td width="90" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1"></td>
                      <td width="100" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1"></td>
                      <td width="88" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">&nbsp;</td>
                      <td width="90"></td>
                      <td width="103"></td>
                      <td width="5"></td>
                  </tr>
                    <?php	
					
						} else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>Not found. There is no reports that matches the search criteria. </strong></div><table><tr><td></td></tr>'; } 
					?> 
                  </table>  
                  <div align="right" style="padding-right:40px; padding-top:5px; padding-bottom:5px;"></div>
    
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
    </div>
<?php
unset ($_SESSION['redirect']);
include ("includes/common/footer.php");
?>