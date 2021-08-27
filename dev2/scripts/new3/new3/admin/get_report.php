<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
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
	 $report_reservations = get_report_reservations($_GET['from'], $_GET['to'], $vehicle_id, $status_id);
	 
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
	<table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>REPORT BY DATE</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="center" height="20" valign="top">
                  
                  From
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="center" height="20" valign="top"><input name="from" type="text" id="from" size="8" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal1.popup();"><i> <font color="#ff0000" size=2>select date</font></i>
</td><td style="border-bottom: 1px solid rgb(220, 220, 220);" align="center" height="20" valign="top">&nbsp;&nbsp;&nbsp;To</td><td style="border-bottom: 1px solid rgb(220, 220, 220);" align="center" height="20" valign="top"><input name="to" type="text" id="to" size="8" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal2.popup();"><i> <font color="#ff0000" size=2>select date</font></i>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><input src="images/but_submit.jpg" border="0" height="22" type="image" width="68"></td>
                </tr>
              </tbody></table></form>
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
			  if (!empty($_GET['from'])) { $from = $_GET['from']; };
			  if (!empty($_GET['to'])) { $to = $_GET['to']; };
			  $vehicle_id = $_POST['vehicle_id'];
			  $status_id = $_POST['status_id'];
			  $report_reservations = get_report_reservations($from, $to, $vehicle_id, $status_id);
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
            <td class="bodytxt" align="center" height="48" valign="bottom" background="images/top_center_curve.jpg"><h2><strong>Report from 
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
            </strong></h2>
            </td>
          </tr>
          <tr>
          	<td>
		<table width="820" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="margin-top: 10px;" class="bodytxt">
             <tr bgcolor="#646464" >
             		  <td width="5"></td>
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">ID</td>
                      <td width="140" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Name</td>
                       <td width="242" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1" align="left">Transportation Info</td>
                      <td width="123" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Vehicle</td>
                      <td width="60" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Status</td>
                      <td width="105" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">Total Amount</td>
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
                      <td width="140" height="22" align="left" class="ot1"><a href="reservation_manager.php?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt"><strong><?php echo $value['first_name']; ?> <?php echo $value['last_name']; ?></strong></a></td>
                      <td width="242" align="left" class="ot1"><?php $trip_type = get_trip_types_view($value['trip_type']); ?><strong><?php echo $trip_type['name']; ?></strong><br /><i><strong>From:</strong></i>&nbsp; <?php if ($value['location1_id'] == '1a' || $value['location1_id'] == '2a') { $from = get_airports_view($value['location1_id']); } else { $from = get_locations_view($value['location1_id']); }; ?><?php echo $from['name']; ?><br /><i><strong>To:</strong></i>&nbsp; <?php if ($value['location2_id'] == '1a' || $value['location2_id'] == '2a') { $to = get_airports_view($value['location2_id']); } else { $to = get_locations_view($value['location2_id']); }; ?><?php echo $to['name']; ?></td>
                      <td width="123" align="center" class="ot1"><?php echo $value['name']; ?></td>
                      <td width="60" align="center" class="ot1"><?php $status = get_statuses_view($value['status']); $icons = get_statuses_icon($status['icon_id']); if (empty($icons)) { echo $status['name']; } else { echo '<img src="images/icons/'.$icons['image'].'" border="0">'; }; ?></td>
                      <td width="100" height="22" align="center">$<?php 
					  if (empty($value['total_amount'])) { echo "0.00"; } else { echo sprintf("%01.2f", $value['total_amount']); }; ?><input name="fee[]" type="hidden" value="<?php echo sprintf("%01.2f", $value['total_amount']); ?>"></td>
                      <td width="5"></td>
                    </tr>
                    <? } ?>
                    <tr bgcolor="#646464" >
             		  <td width="5"></td>
                      <td width="40" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">&nbsp;</td>
                      <td width="140" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">&nbsp;</td>
                       <td width="242" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1" align="center">&nbsp;</td>
                      <td width="123" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
					  $segments=count($report_owners);
				  	  $sreptotal=0;
				  	  $i=0;
 				  	  while($i < $segments) {
  				  	  $sreptotal=$sreptotal + ($report_owners[$i]['listing_fee'] * $report_owners[$i]['commission'])/100;
 				  	  $i++;
 				  	  };
					  
					  if (!empty($sreptotal)) { 
					  //echo "$".$sreptotal; 
					  } else { //echo "$0.00"; 
					  };
					  ?>
                      </td>
                      <td width="60" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1"></td>
                      <td width="105" align="center" style="font-weight: bold; color:#FFFFFF" class="ot1">
                      <?php
					  $segments=count($report_reservations);
				  	  $total=0;
				  	  $i=0;
 				  	  while($i < $segments) {
  				  	  $total=$total + $report_reservations[$i]['total_amount'];
 				  	  $i++;
 				  	  };
					  
					  if (!empty($total)) { echo "$".sprintf("%01.2f", $total); } else { echo "$0.00"; };
					  ?>
                      </td>
                      <td width="5"></td>
                  </tr>
                    <?php	
					
						} else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>Not found. There is no reports that matches the search criteria. </strong></div><table><tr><td></td></tr>'; } 
					?> 
                  </table>  
                  <div align="right" style="padding-right:20px; padding-top:5px; padding-bottom:5px;">Total NET: <strong>$<?php
				  $total_net = $total - $sreptotal;
				   if (!empty($total_net)) { echo sprintf("%01.2f", $total_net); } else { echo "0.00"; };?></strong></div>
    
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg"><input name="calculate_total" type="submit" value="Get Report"> &nbsp;&nbsp;For <select name="vehicle_id" size="1" class="bodytxt">
                <option value="">All Vehicles</option>
               	<?php
				$all_vehicles = get_all_vehicles();
				if(count($all_vehicles)>=1){
				foreach($all_vehicles as $value){
				?>
				<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                <?php
					}
				}
				?>
                </select> <select name="status_id" size="1" class="bodytxt">
                <option value="">All Statuses</option>
               	<?php
				$all_statuses = get_all_statuses();
				if(count($all_statuses)>=1){
				foreach($all_statuses as $value){
				?>
				<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                <?php
					}
				}
				?>
                </select></td>

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
include ("includes/common/footer.php");
?>