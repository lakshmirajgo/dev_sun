<?php
session_start();

	//no  cache headers 
	header("Expires: Mon, 26 Jul 1990 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = 'reservation_manager.php?cAction=edit&id='.$_GET['id'].'';
	header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
	include_once("includes/functions/general_functions.php");
	include_once("includes/functions/drivers_functions.php");
	include_once("includes/functions/reservation_functions.php");
	include_once("includes/functions/client_functions.php");
	include_once("includes/functions/vehicle_functions.php");
	include_once("includes/functions/location_functions.php");
	include_once("includes/functions/trip_type_functions.php");		
	include_once("includes/functions/status_functions.php");	
	include_once("includes/functions/transfer_report_functions.php");
	
//Check permissions for User BEGIN

if ($_GET['search_by'] =='shadesofgreen') {
$page_name_val = 'shades_of_green';
} else {
$page_name_val = 'reservations';
}

if (!chech_permissions($_SESSION['user_details'], $page_name_val)) {
//header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/index.php");
echo '<script language="javascript">alert(\'You dont have a permissions access to this page!\');window.location=\'index.php\';</script>';
// Quit the script
exit(); 
}
//Check permissions for User END	

//we need to unset all this data because if the admin chooses a client but then navigates away fro the page and then returns to it, all this data is still on the session, so the forms get populated with old information.
unset ($_SESSION['client_id']);
unset ($_SESSION['vehicle_id']);
unset ($_SESSION['passenger_count']);
unset ($_SESSION['child_carseat']);
unset ($_SESSION['child_boosterseat']);
unset ($_SESSION['trip_type_new']);
unset ($_SESSION['trip_type']);
unset ($_SESSION['from1']);
unset ($_SESSION['to1']);
unset ($_SESSION['from2']);
unset ($_SESSION['to2']);
unset ($_SESSION['first_name']);
unset ($_SESSION['last_name']);
unset ($_SESSION['address']);
unset ($_SESSION['address2']);
unset ($_SESSION['town']);
unset ($_SESSION['state']);
unset ($_SESSION['zip']);
unset ($_SESSION['country']);
unset ($_SESSION['email']);
unset ($_SESSION['phone_number']);
unset ($_SESSION['cellphone']);
unset ($_SESSION['first_name_billing']);
unset ($_SESSION['last_name_billing']);
unset ($_SESSION['address_billing']);
unset ($_SESSION['address2_billing']);
unset ($_SESSION['city_billing']);
unset ($_SESSION['state_billing']);
unset ($_SESSION['zip_billing']);
unset ($_SESSION['country_billing']);
unset ($_SESSION['total_amount']);
unset ($_SESSION['card_type']);
unset ($_SESSION['card_number']);
unset ($_SESSION['ExpMonth']);
unset ($_SESSION['ExpYear']);
unset ($_SESSION['customer_comments']);
unset ($_SESSION['city']);
unset ($_SESSION['telephone']);
unset ($_SESSION['telephone2']);
unset ($_SESSION['fax']);


		
if(isset($_GET['userid'])){
		$client_details = get_client_view($_GET['userid']);
		
		/**
		 *	pre populate billing information and payment information
		 */
		$client_payment_info = get_client_recent_payment_info_blah($_GET['userid']);
		
		if (isset($client_payment_info['first_name_billing'])) {
			$_SESSION['first_name_billing'] = $client_payment_info['first_name_billing'];
		}
		if (isset($client_payment_info['last_name_billing'])) {
			$_SESSION['last_name_billing'] = $client_payment_info['last_name_billing'];
		}
		if (isset($client_payment_info['address_billing'])) {
			$_SESSION['address_billing'] = $client_payment_info['address_billing'];
		}
		if (isset($client_payment_info['address2_billing'])) {
			$_SESSION['address2_billing'] = $client_payment_info['address2_billing'];
		}
		if (isset($client_payment_info['city_billing'])) {
			$_SESSION['city_billing'] = $client_payment_info['city_billing'];
		}
		if (isset($client_payment_info['state_billing'])) {
			$_SESSION['state_billing'] = $client_payment_info['state_billing'];
		}
		if (isset($client_payment_info['zip_billing'])) {
			$_SESSION['zip_billing'] = $client_payment_info['zip_billing'];
		}
		if (isset($client_payment_info['country_billing'])) {
			$_SESSION['country_billing'] = $client_payment_info['country_billing'];
		}
		
		
		foreach($client_details as $key=>$value)
			$_SESSION[$key] = $value;
	}
		if ($_POST['action'] == 'create_new') {
	
		if (empty($_POST['client_id'])) {
		
		$client_id = add_clients_blank();
		}
		
		if(add_reservations($client_id)) {
		unset ($_SESSION['client_id']);
		unset ($_SESSION['vehicle_id']);
		unset ($_SESSION['passenger_count']);
		unset ($_SESSION['child_carseat']);
		unset ($_SESSION['child_boosterseat']);
		unset ($_SESSION['trip_type_new']);
		unset ($_SESSION['trip_type']);
		unset ($_SESSION['from1']);
		unset ($_SESSION['to1']);
		unset ($_SESSION['from2']);
		unset ($_SESSION['to2']);
		unset ($_SESSION['first_name']);
		unset ($_SESSION['last_name']);
		unset ($_SESSION['address']);
		unset ($_SESSION['address2']);
		unset ($_SESSION['town']);
		unset ($_SESSION['state']);
		unset ($_SESSION['zip']);
		unset ($_SESSION['country']);
		unset ($_SESSION['email']);
		unset ($_SESSION['phone_number']);
		unset ($_SESSION['cellphone']);
		unset ($_SESSION['first_name_billing']);
		unset ($_SESSION['last_name_billing']);
		unset ($_SESSION['address_billing']);
		unset ($_SESSION['address2_billing']);
		unset ($_SESSION['city_billing']);
		unset ($_SESSION['state_billing']);
		unset ($_SESSION['zip_billing']);
		unset ($_SESSION['country_billing']);
		unset ($_SESSION['total_amount']);
		unset ($_SESSION['card_type']);
		unset ($_SESSION['card_number']);
		unset ($_SESSION['ExpMonth']);
		unset ($_SESSION['ExpYear']);
		unset ($_SESSION['customer_comments']);
		unset ($_SESSION['city']);
		unset ($_SESSION['telephone']);
		unset ($_SESSION['telephone2']);
		unset ($_SESSION['fax']);

		echo '<script language="javascript">alert(\'Reservation created successfully\');window.location=\'reservation_manager.php\';</script>';
		} else {
			echo '<script language="javascript">alert(\'Error creating reservation\');</script>';
		}
	}
	
	if ($_GET['cAction'] == 'status_update') {
		update_status($_GET['status'], $_GET['id']);
		header ("Location: reservation_manager.php");	
	}
	
	if ($_GET['cAction'] == 'edit'){
		$reservation_view = get_reservation_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
		
		if (empty($_POST['client_id'])) {
		
		$client_id = add_clients_blank();
		}
		
			if (edit_reservations($_GET['id'], $client_id))
			echo '<script language="javascript">alert(\'Reservation updated successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error updating reservation\');</script>';
			
			$reservation_view = get_reservation_view($_GET['id']);
		}
	}
	
	if (!empty($_POST['delete_selected'])){
	if (delete_reservations($_POST['id']))
	echo '<script language="javascript">alert(\'Reservation(s) Deleted Successfully\');window.location=\'reservation_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the reservation(s)\n\nPlease try again\');window.location=\'reservation_manager.php\';</script>';
		
	$all_reservations = get_all_reservations();

	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_reservations($delete_id))
		echo '<script language="javascript">alert(\'Reservation Deleted Successfully\');window.location=\'reservation_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the reservation\n\nPlease try again\');window.location=\'reservation_manager.php\';</script>';
		$all_reservations = get_all_reservations();
		
	}
	$all_vehicles = get_all_vehicles();
    $all_reservations = get_all_reservations();
	$all_clients = get_all_clients();
	include ("includes/common/header.php");	
 	include ("includes/common/menu.php");
	
	// Show all Reservations
	if (empty($_GET['cAction']) || $_GET['cAction'] == 'delete') {
	$transfer_report=get_transfer_report();
	?>
    
    
    <?php
if ($_SESSION['user_details']['account_type']!='Manager') {
?>
    
    
    
    <?php $today = date("Y-m-d");
	$today = explode("-", $today);
	//print_r($today['0']);  
	?>
	<?php echo get_3_month_summary($transfer_report); ?>
	<!--
    <table width="600" cellpadding="0" cellspacing="0" border="1" style="border:#999999 solid 1px;">
    <tr>
    	<td width="34%" height="20" valign="middle">&nbsp;</td>
        <td width="33%" height="20" valign="middle" bgcolor="#999999" align="center"><strong><?php echo $today['0']; ?></strong></td>
        <td width="33%" height="20" valign="middle" bgcolor="#999999" align="center"><strong><?php echo $prev_year = $today['0'] - 1; ?></strong></td>
    </tr>
    <tr>
    	<td width="34%" height="20" valign="middle" style="padding-left:10px;"><?php echo $d_monthname_previous = date('F', mktime(0, 0, 0, date("m")-3, date("d"),   date("Y"))); $d_monthname_previous_num = date('m', mktime(0, 0, 0, date("m")-3, date("d"),   date("Y"))); ?></td>
        <td width="33%" height="20" valign="middle" align="center"><?php $from_t1= $today['0'].'-'.$d_monthname_previous_num.'-01'; $to_t1=$today['0'].'-'.$d_monthname_previous_num.'-31'; $total_t1 = get_reservations_reports_for_stats($from_t1, $to_t1); echo count($total_t1); ?></td>
        <td width="33%" height="20" valign="middle" align="center"><?php $from_t1_pr= $prev_year.'-'.$d_monthname_previous_num.'-01'; $to_t1_pr=$prev_year.'-'.$d_monthname_previous_num.'-31'; $total_t1_pr = get_reservations_reports_for_stats($from_t1_pr, $to_t1_pr); echo count($total_t1_pr); ?></td>
    </tr>
    <tr>
    	<td width="34%" height="20" valign="middle" style="padding-left:10px;"><?php echo $d_monthname_previous = date('F', mktime(0, 0, 0, date("m")-2, date("d"),   date("Y"))); $d_monthname_previous_num = date('m', mktime(0, 0, 0, date("m")-2, date("d"),   date("Y"))); ?></td>
        <td width="33%" height="20" valign="middle" align="center"><?php $from_t2= $today['0'].'-'.$d_monthname_previous_num.'-01'; $to_t2=$today['0'].'-'.$d_monthname_previous_num.'-31'; $total_t2 = get_reservations_reports_for_stats($from_t2, $to_t2); echo count($total_t2); ?></td>
        <td width="33%" height="20" valign="middle" align="center"><?php $from_t2_pr= $prev_year.'-'.$d_monthname_previous_num.'-01'; $to_t2_pr=$prev_year.'-'.$d_monthname_previous_num.'-31'; $total_t2_pr = get_reservations_reports_for_stats($from_t2_pr, $to_t2_pr); echo count($total_t2_pr); ?></td>
    </tr>
    <tr>
    	<td width="34%" height="20" valign="middle" style="padding-left:10px;"><?php echo $d_monthname_previous = date('F', mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"))); $d_monthname_previous_num = date('m', mktime(0, 0, 0, date("m")-1, date("d"),   date("Y"))); ?></td>
        <td width="33%" height="20" valign="middle" align="center"><?php $from_t3= $today['0'].'-'.$d_monthname_previous_num.'-01'; $to_t3=$today['0'].'-'.$d_monthname_previous_num.'-31'; $total_t3 = get_reservations_reports_for_stats($from_t3, $to_t3); echo count($total_t3); ?></td>
        <td width="33%" height="20" valign="middle" align="center"><?php $from_t3_pr= $prev_year.'-'.$d_monthname_previous_num.'-01'; $to_t3_pr=$prev_year.'-'.$d_monthname_previous_num.'-31'; $total_t3_pr = get_reservations_reports_for_stats($from_t3_pr, $to_t3_pr); echo count($total_t3_pr); ?></td>
    </tr>
    <tr>
    	<td width="34%" height="20" valign="middle" style="padding-left:10px;"><?php echo $d_monthname_previous = date('F', mktime(0, 0, 0, date("m"), date("d"),   date("Y"))); $d_monthname_previous_num = date('m', mktime(0, 0, 0, date("m"), date("d"),   date("Y"))); ?></td>
        <td width="33%" height="20" valign="middle" align="center"><?php $from_t4= $today['0'].'-'.$d_monthname_previous_num.'-01'; $to_t4=$today['0'].'-'.$d_monthname_previous_num.'-31'; $total_t4 = get_reservations_reports_for_stats($from_t4, $to_t4); echo count($total_t4); ?></td>
        <td width="33%" height="20" valign="middle" align="center"><?php $from_t4_pr= $prev_year.'-'.$d_monthname_previous_num.'-01'; $to_t4_pr=$prev_year.'-'.$d_monthname_previous_num.'-31'; $total_t4_pr = get_reservations_reports_for_stats($from_t4_pr, $to_t4_pr); echo count($total_t4_pr); ?></td>
    </tr>
    <tr>
   	  <td width="34%" height="20" valign="middle" style="padding-left:10px;" bgcolor="e4e4e4"><strong>Total Transfers</strong></td>
        <td width="33%" height="20" valign="middle" align="center" bgcolor="e4e4e4"><strong><?php $from_t= $today['0'].'-01-01'; $to_t=$today['0'].'-12-31'; $total_t = get_reservations_reports_for_stats($from_t, $to_t); echo count($total_t); ?></strong></td>
        <td width="33%" height="20" valign="middle" align="center" bgcolor="e4e4e4"><strong><?php $from_t_pr= $prev_year.'-01-01'; $to_t_pr=$prev_year.'-12-31'; $total_t_pr = get_reservations_reports_for_stats($from_t_pr, $to_t_pr); echo count($total_t_pr); ?></strong></td>
    </tr>
    </table>
	-->
    <br />
    <form name="report" method="post" action="get_report.php" style="padding:0px; margin:0px;">
    <table width="700" cellpadding="0" cellspacing="0" border="0" style="border:#999999 solid 1px;" bgcolor="#e4e4e4">
    <tr>
    	<td colspan="3" align="center" valign="middle"><h3>Reports</h3></td>
    </tr>
    <tr>
    	<td style="padding:5px;">
    For <select name="vehicle_id" size="1" class="bodytxt">
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
                </select>
                </td>
                <td style="padding:5px;">
                From <input name="from" type="text" id="from" size="8" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onclick="javascript:cal1.popup();"><i> <font color="#ff0000" size=2>select date</font></i>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
            	<td style="padding:5px;">
                <select name="trip_type" size="1" class="bodytxt">
                <option value="">All Trip Types</option>
                                      <optgroup label="Orlando Area">
                                      <option value="1">Orlando Area - One Way</option>
                                      <option value="2">Orlando Area - Round Trip</option>
                                      </optgroup>
                                      <optgroup label="Cruise Transfer">
                                      <option value="3">MCO to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="4">MCO to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="5">Disney/Universal to Cruise Terminal/Port Area - One Way</option>
                                      <option value="6">Disney/Universal to Cruise Terminal/Port Area - Round Trip</option>
                                      <option value="7">MCO>Disney or Universal>Cruise terminal>MCO (3 leg)</option>
                                      <option value="8">MCO>Cruise Terminals>Disney or Universal>MCO (3 leg)</option>
                                      <option value="9">Sanford to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="11">Sanford to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="10">Sanford>Cruise Terminals>Disney or Universal>Sanford</option>
                                      </optgroup>
                                      <optgroup label="Attraction Transfer">
                                      <option value="12">Disney Resort to Universal/Sea World - One Way</option>
                                      <option value="13">Disney Resort to Universal/Sea World - Round Trip</option>
                                      <option value="77">Disney Resort to SeaWorld Theme Park - One Way</option>
                                      <option value="78">Disney Resort to SeaWorld Theme Park - Round Trip</option>
                                      <option value="79">Disney Resort to Universal Theme Park - One Way</option>
                                      <option value="80">Disney Resort to Universal Theme Park - Round Trip</option>
									  </optgroup>
                </select>
                </td>
                <td style="padding:5px;">
                To &nbsp;&nbsp;&nbsp;&nbsp;<input name="to" type="text" id="to" size="8" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onclick="javascript:cal2.popup();"><i> <font color="#ff0000" size=2>select date</font></i>
                </td>
                <td style="padding:5px;"><input name="calculate_total" type="submit" value="Get Report">
                </td>
            </tr>
        </table>
    </form>
    
    
    <?php
	}
	?>
    
    
    
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
    <?php
	get_all_reservations_with_pages();
	
	}
	?>
    <?php
	// Create a New Reservation
	if ($_GET[cAction] == 'create_new') {
	?>
    <script language="Javascript">
function xmlhttpPost(strURL) {
    var xmlHttpReq = false;
    var self = this;
    // Mozilla/Safari
    if (window.XMLHttpRequest) {
        self.xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject) {
        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
    self.xmlHttpReq.open('POST', strURL, true);
    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    self.xmlHttpReq.onreadystatechange = function() {
        if (self.xmlHttpReq.readyState == 4) {
            updatepage(self.xmlHttpReq.responseText);
        }
    }
    self.xmlHttpReq.send(getquerystring());
}

function getquerystring() {
    var form     = document.forms['create_new'];
	var vehicle_id = form.vehicle_id.value;
    var passenger_count = form.passenger_count.value;
	var trip_type = form.trip_type.value;
	var from1 = form.from1.value;
	var to1 = form.to1.value;

	qstr = 'vehicle_id=' + escape(vehicle_id) +  '&passenger_count=' + escape(passenger_count) +  '&trip_type=' + escape(trip_type) +  '&from1=' + escape(from1) +  '&to1=' + escape(to1);  // NOTE: no '?' before querystring
    return qstr;
}

function updatepage(str){
    //document.getElementById("result").innerHTML = str;
	document.create_new.total_amount.value = str;
}
</script>
<span name="myspan" id="myspan"></span>

	<form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="reservation_manager.php?cAction=create_new" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="create_new">
	<table border="0" cellpadding="0" cellspacing="0" width="580" class="ot">
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
        <form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="javascript:get(document.getElementsByTagName('create_new'));" onsubmit="return validate(this)">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>ADD A NEW RESERVATION</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">
            
            <table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Transportation Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Client</strong></td>
                <td align="left" height="30" width="100%" class="ot2"><select name="client_id" id="client_id" size="1" onchange="location.href='reservation_manager.php?cAction=create_new&userid='+this.value;" class="bodytxt">
                  <option value="">Add New Client</option>
				  <?php if (!empty($_SESSION['client_id'])) {
				  echo '<option value="'.$_SESSION['client_id'].'" selected="selected">'.$client_view['last_name'].' '.$client_view['first_name'].'</option>';
				  };
				   
				if(count($all_clients)>0){
				foreach($all_clients as $value){
				if($_GET['userid']==$value['id']){
				?>
                  <option value="<?php echo $value['id']; ?>" selected="selected"><?php echo $value['last_name']; ?> <?php echo $value['first_name']; ?></option>
                  <?php
				  }
				  else{ ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['last_name']; ?> <?php echo $value['first_name']; ?></option>
<? }
					}
				}
				?>
                </select></td>
			  </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Vehicle</strong></td>
                <td align="left" height="30" width="100%" class="ot2"><select name="vehicle_id" id="vehicle_id" size="1" class="bodytxt" onchange="JavaScript:xmlhttpPost('calculate_sog.php');">
                  <?php 
				
				if(count($all_vehicles)>=1){
				foreach($all_vehicles as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </select></td>
			  </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Passengers</strong></td>
                <td align="left" height="30" width="100%" class="ot2"><select name="passenger_count" id="passenger_count" size="1" class="bodytxt">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Car Seat</strong></td>
                <td align="left" height="30" width="100%" class="ot2"><select name="child_carseat" size="1" class="bodytxt">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Booster Seat</strong></td>
                <td align="left" height="30" width="100%" class="ot2"><select name="child_boosterseat" size="1" class="bodytxt">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
                </select></td>
              </tr>
              <script type="text/javascript">
var http = createRequestObject();
function createRequestObject() {
	var objAjax;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
		objAjax = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		objAjax = new XMLHttpRequest();
	}
	return objAjax;
}

function getNewContent(){
var val = document.create_new.trip_type.value;
http.open('get','loadlocations.php?val='+val);
http.onreadystatechange = updateNewContent;
http.send(null);
return false;
}

function updateNewContent(){
if(http.readyState == 4){
document.getElementById('myLocation').innerHTML = http.responseText;
}
}

function getNewlocationContent1(val){
http.open('get','loadflight1_1.php?val='+val);
http.onreadystatechange = updateNewLocationContent1;
http.send(null);
return false;
}

function updateNewLocationContent1(){
if(http.readyState == 4){
document.getElementById('myLocationdetails1').innerHTML = http.responseText;
}
}

function getNewlocationtoContent1_1(val){
http.open('get','loadflight1_1.php?val='+val);
http.onreadystatechange = updateNewLocationtoContent1_1;
http.send(null);
return false;
}

function updateNewLocationtoContent1_1(){
if(http.readyState == 4){
document.getElementById('myLocationdetailsto1').innerHTML = http.responseText;
}
}

function getNewlocationContent2(val){
http.open('get','loadflight2_1.php?val='+val);
http.onreadystatechange = updateNewLocationContent2;
http.send(null);
return false;
}

function updateNewLocationContent2(){
if(http.readyState == 4){
document.getElementById('myLocationdetails2').innerHTML = http.responseText;
}
}

function getNewlocationtoContent1_2(val){
http.open('get','loadflight2_1.php?val='+val);
http.onreadystatechange = updateNewLocationtoContent1_2;
http.send(null);
return false;
}

function updateNewLocationtoContent1_2(){
if(http.readyState == 4){
document.getElementById('myLocationdetailsto2').innerHTML = http.responseText;
}
}
</script>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Trip Type</strong></td>
                <td align="left" height="30" width="100%" class="ot2"><select name="trip_type" id="trip_type" required="yes" size="1" onchange="javascript:getNewContent(this.value);">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <optgroup label="Orlando Area">
                                      <option value="1">Orlando Area - One Way</option>
                                      <option value="2">Orlando Area - Round Trip</option>
                                      </optgroup>
                                      <optgroup label="Cruise Transfer">
                                      <option value="3">MCO to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="4">MCO to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="5">Disney/Universal to Cruise Terminal/Port Area - One Way</option>
                                      <option value="6">Disney/Universal to Cruise Terminal/Port Area - Round Trip</option>
                                      <option value="7">MCO>Disney or Universal>Cruise terminal>MCO (3 leg)</option>
                                      <option value="8">MCO>Cruise Terminals>Disney or Universal>MCO (3 leg)</option>
                                      <option value="9">Sanford to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="11">Sanford to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="10">Sanford>Cruise Terminals>Disney or Universal>Sanford</option>
									  </optgroup>
                                      <optgroup label="Attraction Transfer">
                                      <option value="12">Disney Resort to Universal/Sea World - One Way</option>
                                      <option value="13">Disney Resort to Universal/Sea World - Round Trip</option>
                                      <option value="77">Disney Resort to SeaWorld Theme Park - One Way</option>
                                      <option value="78">Disney Resort to SeaWorld Theme Park - Round Trip</option>
                                      <option value="79">Disney Resort to Universal Theme Park - One Way</option>
                                      <option value="80">Disney Resort to Universal Theme Park - Round Trip</option>
									  </optgroup>
                                    </select></td>
              </tr>
              <tr valign="middle">
              	<td colspan="2" height="30"><p id="myLocation" align="center">When you click the trip type, this content will be replaced.</p>                </td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Passenger Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>First Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name" class="bodytxt" size="39" type="text" value="<?php echo $_SESSION['first_name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Last Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name" class="bodytxt" size="39" type="text" value="<?php echo $_SESSION['last_name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address</strong></td>
                <td align="left" height="30"><input name="address" class="bodytxt" size="39" id="address" type="text" value="<?php echo $_SESSION['address']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2</strong></td>
                <td align="left" height="30"><input name="address2" class="bodytxt" size="39" id="address2" type="text" value="<?php echo $_SESSION['address2']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City</strong></td>
                <td align="left" height="30"><input name="town" class="bodytxt" size="39" id="town" type="text" value="<?php echo $_SESSION['city']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State</strong></td>
                <td align="left" height="30">
                						<select name="state" id="state" class="bodytxt">
                        <?php if (!empty($_SESSION['state'])) {
                  		echo '<option value="'.$_SESSION['state'].'" selected="selected">'.$_SESSION['state'].'</option>';
				  		};
				 		?>
                        <option value="Outside USA">Outside USA</option>                        
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
                      </select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code</strong></td>
                <td align="left" height="30"><input name="zip" class="bodytxt" size="10" id="zip" type="text" value="<?php echo $_SESSION['zip']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country</strong></td>
                <td align="left" height="30">
                <select name="country" id="country" class="bodytxt">
  				<?php if (!empty($_SESSION['country'])) {
                 echo '<option value="'.$_SESSION['country'].'" selected="selected">'.$_SESSION['country'].'</option>';
				 };
				 ?>
                <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option>
                            <option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Azores">Azores</option>
                            <option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia Herzegowina">Bosnia Herzegowina</option>
                            <option value="Bosnia-Herzegovina">Bosnia-Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option><option value="British Indian O. Terr">British Indian O. Terr</option>
                            <option value="British Virgin Isl">British Virgin Isl</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option><option value="Central African Rep">Central African Rep</option><option value="Chad">Chad</option>
                            <option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Isl">Cocos (Keeling) Isl</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option><option value="Congo, The Dem Rep">Congo, The Dem Rep</option><option value="Cook Islands">Cook Islands</option>
                            <option value="Corsica">Corsica</option><option value="Costa Rica">Costa Rica</option><option value="Cote d` Ivoire">Cote d` Ivoire</option>
                            <option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France (Incl Monaco)">France (Incl Monaco)</option>
                            <option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option>
                            <option value="French Polynesia">French Polynesia</option><option value="French S. Territories">French S. Territories</option>
                            <option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option><option value="Heard And Mc Donald Isl">Heard And Mc Donald Isl</option>
                            <option value="Holy See (Vatican City)">Holy See (Vatican City)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option>
                            <option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option>
                            <option value="Ireland (Eire)">Ireland (Eire)</option><option value="Israel">Israel</option><option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic Rep">Korea, Democratic Rep</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option>
                            <option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Madeira Islands">Madeira Islands</option>
                            <option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option>
                            <option value="Moldova, Republic Of">Moldova, Republic Of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option>
                            <option value="Myanmar (Burma)">Myanmar (Burma)</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Isl">Northern Mariana Isl</option><option value="Norway">Norway</option>
                            <option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option>
                            <option value="Palestinian Territory">Palestinian Territory</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia-Montenegro">Serbia-Montenegro</option>
                            <option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option>
                            <option value="Slovak Republic">Slovak Republic</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia">South Georgia</option>
                            <option value="South Korea">South Korea</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option>
                            <option value="St. Christopher, Nevis">St. Christopher, Nevis</option><option value="St. Helena">St. Helena</option><option value="St. Lucia">St. Lucia</option>
                            <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="St. Vincent and Gren">St. Vincent and Gren</option>
                            <option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard And Jan M Isl">Svalbard And Jan M Isl</option>
                            <option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Rep">Syrian Arab Rep</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tristan da Cunha">Tristan da Cunha</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Isl">Turks and Caicos Isl</option><option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option><option value="Great Britain">Great Britain</option>
                            <option value="United States" selected="selected">United States</option><option value="U.S. Minor Outlying Isl">U.S. Minor Outlying Isl</option>
                            <option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Furuna Isl">Wallis and Furuna Isl</option>
                            <option value="Western Sahara">Western Sahara</option><option value="Western Samoa">Western Samoa</option><option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
				</select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>E-mail</strong></td>
                <td align="left" height="30"><input name="email" class="bodytxt" size="39" id="email" type="text" value="<?php echo $_SESSION['email']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Phone Number</strong></td>
                <td align="left" height="30"><input name="phone_number" class="bodytxt" size="20" id="phone_number" type="text" value="<?php echo $_SESSION['telephone']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Mobile Phone</strong></td>
                <td align="left" height="30"><input name="cellphone" class="bodytxt" size="20" id="cellphone" type="text" value="<?php echo $_SESSION['cellphone']; ?>"></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="bodytxt">
                <tr>
                	<td width="40%" align="right"><span style="color:#677bca; font-weight:bold;">Billing Information</span>&nbsp;&nbsp;&nbsp;</td><td align="center"><input name="billing_adr" value="1" id="billing-checkbox" onclick="auto_address_update(document.create_new)" type="checkbox"></td><td> Billing Address is the same as Passenger Address.</td>
                </tr>
              </table></div>       	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>First Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name_billing" class="bodytxt" size="39" type="text" value="<?php echo $_SESSION['first_name_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Last Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name_billing" class="bodytxt" size="39" type="text" value="<?php echo $_SESSION['last_name_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address</strong></td>
                <td align="left" height="30"><input name="address_billing" class="bodytxt" size="39" id="address_billing" type="text" value="<?php echo $_SESSION['address_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2</strong></td>
                <td align="left" height="30"><input name="address2_billing" class="bodytxt" size="39" id="address2_billing" type="text" value="<?php echo $_SESSION['address2_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City</strong></td>
                <td align="left" height="30"><input name="city_billing" class="bodytxt" size="39" id="city_billing" type="text" value="<?php echo $_SESSION['city_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State</strong></td>
                <td align="left" height="30">
                						<select name="state_billing" id="state_billing" class="bodytxt">
                        <?php if (!empty($_SESSION['state_billing'])) {
                 		echo '<option value="'.$_SESSION['state_billing'].'" selected="selected">'.$_SESSION['state_billing'].'</option>';
				 		};
				 		?>
                        <option value="Outside USA">Outside USA</option>                        
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
                      </select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code</strong></td>
                <td align="left" height="30"><input name="zip_billing" class="bodytxt" size="10" id="zip_billing" type="text" value="<?php echo $_SESSION['zip_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country</strong></td>
                <td align="left" height="30">
                <select name="country_billing" id="country_billing" class="bodytxt">
  				<?php if (!empty($_SESSION['country_billing'])) {
                echo '<option value="'.$_SESSION['country_billing'].'" selected="selected">'.$_SESSION['country_billing'].'</option>';
				};
				?>
                <option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option>
                            <option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Azores">Azores</option>
                            <option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia Herzegowina">Bosnia Herzegowina</option>
                            <option value="Bosnia-Herzegovina">Bosnia-Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option><option value="British Indian O. Terr">British Indian O. Terr</option>
                            <option value="British Virgin Isl">British Virgin Isl</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option><option value="Central African Rep">Central African Rep</option><option value="Chad">Chad</option>
                            <option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Isl">Cocos (Keeling) Isl</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option><option value="Congo, The Dem Rep">Congo, The Dem Rep</option><option value="Cook Islands">Cook Islands</option>
                            <option value="Corsica">Corsica</option><option value="Costa Rica">Costa Rica</option><option value="Cote d` Ivoire">Cote d` Ivoire</option>
                            <option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France (Incl Monaco)">France (Incl Monaco)</option>
                            <option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option>
                            <option value="French Polynesia">French Polynesia</option><option value="French S. Territories">French S. Territories</option>
                            <option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option><option value="Heard And Mc Donald Isl">Heard And Mc Donald Isl</option>
                            <option value="Holy See (Vatican City)">Holy See (Vatican City)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option>
                            <option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option>
                            <option value="Ireland (Eire)">Ireland (Eire)</option><option value="Israel">Israel</option><option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic Rep">Korea, Democratic Rep</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option>
                            <option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Madeira Islands">Madeira Islands</option>
                            <option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option>
                            <option value="Moldova, Republic Of">Moldova, Republic Of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option>
                            <option value="Myanmar (Burma)">Myanmar (Burma)</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Isl">Northern Mariana Isl</option><option value="Norway">Norway</option>
                            <option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option>
                            <option value="Palestinian Territory">Palestinian Territory</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia-Montenegro">Serbia-Montenegro</option>
                            <option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option>
                            <option value="Slovak Republic">Slovak Republic</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia">South Georgia</option>
                            <option value="South Korea">South Korea</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option>
                            <option value="St. Christopher, Nevis">St. Christopher, Nevis</option><option value="St. Helena">St. Helena</option><option value="St. Lucia">St. Lucia</option>
                            <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="St. Vincent and Gren">St. Vincent and Gren</option>
                            <option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard And Jan M Isl">Svalbard And Jan M Isl</option>
                            <option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Rep">Syrian Arab Rep</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tristan da Cunha">Tristan da Cunha</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Isl">Turks and Caicos Isl</option><option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option><option value="Great Britain">Great Britain</option>
                            <option value="United States" selected="selected">United States</option><option value="U.S. Minor Outlying Isl">U.S. Minor Outlying Isl</option>
                            <option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Furuna Isl">Wallis and Furuna Isl</option>
                            <option value="Western Sahara">Western Sahara</option><option value="Western Samoa">Western Samoa</option><option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
				</select>                </td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Payment Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Total Amount</strong></td>
                <td align="left" height="30" width="100%" class="ot2"><!-- <div id="result"></div><br /> -->$<input name="total_amount" id="total_amount" class="bodytxt" size="12" type="text"><input value="Calculate Total" type="button" onclick='JavaScript:xmlhttpPost("calculate_sog.php")'><br /><span style="color:#FF0000;"><em>(20% driver gratuity will be applied for limo reservations)</em></span></td>
  			  </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Payment Method</strong></td>
                <td align="left" height="30" width="100%" class="ot2">
                    <select id="card_type" name="card_type" size="1">
                    	<?php if (isset($client_payment_info['card_type'])) { ?>
                        	<option value="<?php print $client_payment_info['card_type']; ?>" selected="selected"><?php print $client_payment_info['card_type']; ?></option>
                        <?php } else { ?>
                        	<option value="**" selected="selected">- Select Card Type -</option>
                        <?php } ?>
                        <option value="Visa">Visa</option>
                        <option value="MasterCard">MasterCard</option>
                        <option value="Discover">Discover</option>
                    </select>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Credit Card Number</strong></td>
                <td align="left" height="30" width="100%" class="ot2"><input name="card_number" class="bodytxt" size="32" type="text" value="<?php print isset($client_payment_info['card_number']) ? $client_payment_info['card_number'] : ''; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Expiration Date</strong></td>
                <td align="left" height="30" width="100%" class="ot2">
                
<select id="ExpMonth" name="ExpMonth" size="1">
	<?php if (isset($client_payment_info['ExpMonth'])) { ?>
        <option value="<?php print $client_payment_info['ExpMonth']; ?>" selected="selected"><?php print $client_payment_info['ExpMonth']; ?></option>
    <?php } ?>
    
	<?php
        for ($i = 1; $i <= 12; $i++) {
            print '<option value="' . date('M', strtotime($i . '/01/2000')) . '" ' . ( ! isset($client_payment_info['ExpMonth']) && $i == date('n') ? 'selected="selected"' : '') . '>';
            print date('M', strtotime($i . '/01/2000'));
            print '</option>';
        }
    ?>
</select>
<select id="ExpYear" name="ExpYear" size="1">
	<?php if (isset($client_payment_info['ExpYear'])) { ?>
        <option value="<?php print $client_payment_info['ExpYear']; ?>" selected="selected"><?php print $client_payment_info['ExpYear']; ?></option>
    <?php } ?>
    
	<?php
        for ($i = (date("Y") + 20); $i >= 2008; $i--) {
            print '<option value="' . $i . '" ' . ( ! isset($client_payment_info['ExpYear']) && $i == date('Y') ? 'selected="selected"' : '') . '>' .$i . '</option>';
        }
    ?>
</select>

				</td>
              </tr>
              <tr>
              	<td width="100%" colspan="2">
                	<div style="background-color:#efefef; padding:5px; border:#CCCCCC solid 1px;"><span style="color:#000000;">
                    	<input name="paying_cash" value="Yes" id="paying_cash" type="checkbox" <?php print isset($client_payment_info['paying_cash']) && strtolower($client_payment_info['paying_cash']) == 'yes' ? 'checked="checked"' : ''; ?>> Please do not charge my credit card. I will be paying cash or traveler check upon arrival I understand I am submitting my credit card info only to guarantee my reservation. I also read and understand Sunstate Transportation cancellation policy.</span>
                    </div>                
                </td>
              </tr>
              <tr>
              	<td width="100%" height="10" colspan="2"></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Reservation Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Reservation Status</strong></td>
                <td align="left" height="30" width="100%" class="ot2"><select name="status" size="1" class="bodytxt">
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
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Payment Status</strong></td>
                <td align="left" height="30" width="100%" class="ot2"><select name="payment_status" size="1" class="bodytxt">
				<option value=""> -- Select Payment Status -- </option>
                <option value="Approved">Approved</option>
                <option value="Declined">Declined</option>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Approval Code</strong></td>
                <td align="left" height="30" width="100%" class="ot2"><textarea name="approval_code" rows="2" cols="36" class="bodytxt"></textarea></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Customer Comments</strong></td>
                <td align="left" height="30" width="100%" class="ot2"><textarea name="customer_comments" rows="3" cols="36" class="bodytxt"></textarea></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="100%" class="ob"><strong>Admin Comments</strong></td>
                <td align="left" height="30" width="100%" class="ot2"><textarea name="admin_comments" rows="3" cols="36" class="bodytxt"></textarea></td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input src="images/but_create.jpg" border="0" height="22" type="image" width="68"></td>
              </tr>
            </tbody></table>
			</form>
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
	// Edit Reservation
	if ($_GET[cAction] == 'edit') {
	include_once("includes/functions/location_functions.php");
	$all_locations = get_all_locations();
	$all_airports = get_all_airports();
	?>
	<form id="edit_reservation" style="padding-bottom:0px;" name="edit_reservation" method="post" action="reservation_manager.php?cAction=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="edit">
	<script language="Javascript">
function xmlhttpPost(strURL) {
    var xmlHttpReq = false;
    var self = this;
    // Mozilla/Safari
    if (window.XMLHttpRequest) {
        self.xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject) {
        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
    self.xmlHttpReq.open('POST', strURL, true);
    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    self.xmlHttpReq.onreadystatechange = function() {
        if (self.xmlHttpReq.readyState == 4) {
            updatepage(self.xmlHttpReq.responseText);
        }
    }
    self.xmlHttpReq.send(getquerystring());
}

function getquerystring() {
    var form     = document.forms['edit_reservation'];
	var vehicle_id = form.vehicle_id.value;
    var passenger_count = form.passenger_count.value;
	var trip_type = form.trip_type.value;
	var from1 = form.from1.value;
	var to1 = form.to1.value;

	qstr = 'vehicle_id=' + escape(vehicle_id) +  '&passenger_count=' + escape(passenger_count) +  '&trip_type=' + escape(trip_type) +  '&from1=' + escape(from1) +  '&to1=' + escape(to1);  // NOTE: no '?' before querystring
    return qstr;
}




function xmlhttpPost2(strURL) {
    var xmlHttpReq = false;
    var self = this;
    // Mozilla/Safari
    if (window.XMLHttpRequest) {
        self.xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject) {
        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
    self.xmlHttpReq.open('POST', strURL, true);
    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    self.xmlHttpReq.onreadystatechange = function() {
        if (self.xmlHttpReq.readyState == 4) {
            updatepage(self.xmlHttpReq.responseText);
        }
    }
    self.xmlHttpReq.send(getquerystring2());
}

function getquerystring2() {
    var form     = document.forms['edit_reservation'];
	var vehicle_id = form.vehicle_id.value;
    var passenger_count = form.passenger_count.value;
	var trip_type = form.trip_type.value;
	var from1 = form.from0.value;
	var to1 = form.to0.value;

	qstr = 'vehicle_id=' + escape(vehicle_id) +  '&passenger_count=' + escape(passenger_count) +  '&trip_type=' + escape(trip_type) +  '&from1=' + escape(from1) +  '&to1=' + escape(to1);  // NOTE: no '?' before querystring
    return qstr;
}


function updatepage(str){
    //document.getElementById("result").innerHTML = str;
	document.edit_reservation.total_amount.value = str;
}
</script>

<script type="text/javascript">
var http = createRequestObject();
function createRequestObject() {
	var objAjax;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
		objAjax = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		objAjax = new XMLHttpRequest();
	}
	return objAjax;
}

function getNewContent(){
var val = document.edit_reservation.trip_type.value;
http.open('get','loadlocations.php?val='+val);
http.onreadystatechange = updateNewContent;
http.send(null);
return false;
}

function updateNewContent(){
if(http.readyState == 4){
document.getElementById('myLocation').innerHTML = http.responseText;
}
}

function getNewlocationContent0(val){
http.open('get','loadflight1_0.php?val='+val);
http.onreadystatechange = updateNewLocationContent0;
http.send(null);
return false;
}

function updateNewLocationContent0(){
if(http.readyState == 4){
document.getElementById('myLocationdetails0').innerHTML = http.responseText;
}
}

function getNewlocationtoContent1_0(val){
http.open('get','loadflight1_0.php?val='+val);
http.onreadystatechange = updateNewLocationtoContent1_0;
http.send(null);
return false;
}

function updateNewLocationtoContent1_0(){
if(http.readyState == 4){
document.getElementById('myLocationdetailsto0').innerHTML = http.responseText;
}
}

function getNewlocationContent1(val){
http.open('get','loadflight2_0.php?val='+val);
http.onreadystatechange = updateNewLocationContent1;
http.send(null);
return false;
}

function updateNewLocationContent1(){
if(http.readyState == 4){
document.getElementById('myLocationdetails1').innerHTML = http.responseText;
}
}

function getNewlocationtoContent1_1(val){
http.open('get','loadflight2_0.php?val='+val);
http.onreadystatechange = updateNewLocationtoContent1_1;
http.send(null);
return false;
}

function updateNewLocationtoContent1_1(){
if(http.readyState == 4){
document.getElementById('myLocationdetailsto1').innerHTML = http.responseText;
}
}





function getNewlocationContent2(val){
http.open('get','loadflight2_1.php?val='+val);
http.onreadystatechange = updateNewLocationContent2;
http.send(null);
return false;
}

function updateNewLocationContent2(){
if(http.readyState == 4){
document.getElementById('myLocationdetails2').innerHTML = http.responseText;
}
}

function getNewlocationtoContent1_2(val){
http.open('get','loadflight2_1.php?val='+val);
http.onreadystatechange = updateNewLocationtoContent1_2;
http.send(null);
return false;
}

function updateNewLocationtoContent1_2(){
if(http.readyState == 4){
document.getElementById('myLocationdetailsto2').innerHTML = http.responseText;
}
}
</script>
    <table border="0" cellpadding="0" cellspacing="0" width="580" class="ot">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>EDIT RESERVATION - <strong>Date Submitted: <?php echo format_date_calendar2($reservation_view['reservation_date']); ?> </strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Resend Email Confirmations</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="center" height="60" valign="middle" width="100%" colspan="2"><a href="customers_invoice.php?id=<?php echo $_GET['id']; ?>" title="Click to Resend confirmation email"><img src="images/confirmation_email.jpg" onclick="return confirm('Are you sure you want to resend confirmation email?')" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="resend_arrival_email.php?id=<?php echo $_GET['id']; ?>" title="Click to Resend awaiting arrival email"><img src="images/awaiting_arrival_email.jpg" onclick="return confirm('Are you sure you want to resend awaiting arrival email?')" border="0"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="resend_departure_email.php?id=<?php echo $_GET['id']; ?>" title="Click to Resend departured email"><img src="images/departured_email.jpg" onclick="return confirm('Are you sure you want to resend departured email?')" border="0"></a>
                  </td>
              </tr>
              </tbody>
            </table>
          	</td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Transportation Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Clients</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $client_view = get_client_view($reservation_view['client_id']);?>
                <select name="client_id" size="1" class="bodytxt">
                <option value="<?php echo $client_view['id']; ?>"><?php echo $client_view['last_name']; ?> <?php echo $client_view['first_name']; ?></option>
                <option value="">Add New Client</option>
                  <?php 
				$all_clients = get_all_clients();
				if(count($all_clients)>=1){
				foreach($all_clients as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['last_name']; ?> <?php echo $value['first_name']; ?></option>
                  <?php
					}
				}
				?>
                </select></td>
			  </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Vehicle</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $vehicle_view = get_vehicles_view($reservation_view['vehicle_id']);?>
                <select name="vehicle_id" size="1" class="bodytxt">
                <option value="<?php echo $reservation_view['vehicle_id']; ?>"><?php echo $vehicle_view['name']; ?></option>
                  <?php 
				
				if(count($all_vehicles)>=1){
				foreach($all_vehicles as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </select></td>
			  </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Quick Grocery Stop:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><input name="store_stop" id="store_stop" value="Yes" type="checkbox" <?php if ($reservation_view['store_stop'] =='Yes') { ?> checked="checked" <?php } ?> /></td>
              </tr>
               <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Passengers</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="passenger_count" size="1" class="bodytxt">
                <option value="<?php echo $reservation_view['passenger_count']; ?>"><?php echo $reservation_view['passenger_count']; ?></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Child Car Seat</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="child_carseat" size="1" class="bodytxt">
                <option value="<?php echo $reservation_view['child_carseat']; ?>"><?php echo $reservation_view['child_carseat']; ?></option>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Child Booster Seat</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="child_boosterseat" size="1" class="bodytxt">
                <option value="<?php echo $reservation_view['booster_seat']; ?>"><?php echo $reservation_view['booster_seat']; ?></option>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Trip Type</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $trip_type = get_trip_types_view($reservation_view['trip_type']); ?>
                <select name="trip_type" required="yes" size="1" onchange="javascript:getNewContent(this.value);">
                                      <option value="<?php echo $reservation_view['trip_type']; ?>" selected="selected"><?php echo $trip_type['name']; ?></option>
                                      <optgroup label="Orlando Area">
                                      <option value="1">Orlando Area - One Way</option>
                                      <option value="2">Orlando Area - Round Trip</option>
                                      </optgroup>
                                      <optgroup label="Cruise Transfer">
                                      <option value="3">Airport to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="4">Airport to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="5">Disney/Universal to Cruise Terminal/Port Area - One Way</option>
                                      <option value="6">Disney/Universal to Cruise Terminal/Port Area - Round Trip</option>
                                      <option value="7">MCO>Disney or Universal>Cruise terminal>MCO (3 leg)</option>
                                      <option value="8">MCO>Cruise Terminals>Disney or Universal>MCO (3 leg)</option>
                                      <option value="9">Sanford to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="11">Sanford to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="10">Sanford>Cruise Terminals>Disney or Universal>Sanford</option>
                                      </optgroup>
                                      <optgroup label="Attraction Transfer">
                                      <option value="12">Disney Resort to Universal/Sea World - One Way</option>
                                      <option value="13">Disney Resort to Universal/Sea World - Round Trip</option>
                                      <option value="77">Disney Resort to SeaWorld Theme Park - One Way</option>
                                      <option value="78">Disney Resort to SeaWorld Theme Park - Round Trip</option>
                                      <option value="79">Disney Resort to Universal Theme Park - One Way</option>
                                      <option value="80">Disney Resort to Universal Theme Park - Round Trip</option>
									  </optgroup>
</select></td>
              </tr>
              
              
              
              <tr valign="middle">
              	<td colspan="2" height="30" id="myLocation" align="center">
                
                <?php
		  //Number of legs -> make a loop BEGIN
          $reservation_details = get_all_reservation_details($_GET['id']);
			  
			  $num_legs = count($reservation_details);
			  $_SESSION['num_legs'] = $num_legs;
		  	  for ($count =0; $count <= $num_legs - 1; $count += 1) {
		  	  //print_r($reservation_details[$count]['from']);
			  
			  $count_new = $count+1;
			  $from[$count] = get_locations_view($reservation_details[$count]['from']);
		  	  $to[$count] = get_locations_view($reservation_details[$count]['to']);
		  ?>
          <input name="details_id<?php echo $count; ?>" type="hidden" value="<?php echo $reservation_details[$count]['id']; ?>" />
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
           	  <td width="100%" class="ot">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              <td colspan="2" width="100%" valign="top" align="center">
              <div style="background-color:#ffff82; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-size:12px; font-weight:bold;"><?php if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { ?><?php if (check_arrival($reservation_details[$count]['from'])) { echo "Arrival"; } else { echo "Departure"; }; ?><? } else { echo "Transfer"; }; ?></span></div></td>
             </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php //echo $from[$count]['name']; ?>
                
                <!-- <input name="from<?php echo $count; ?>" type="hidden" value="<?php echo $reservation_details[$count]['from']; ?>" />-->
                
                <select name="from<?php echo $count; ?>" id="from<?php echo $count; ?>" required="yes" size="1" onchange="javascript:getNewlocationContent<?php echo $count; ?>(this.value); JavaScript:xmlhttpPost2('calculate_sog.php');">
                                      <option value="<?php echo $reservation_details[$count]['from']; ?>" selected="selected"><?php echo $from[$count]['name']; ?></option>
                                      <optgroup label="Orlando Airports">
                                      <?php 
				
				if(count($all_airports)>=1){
				foreach($all_airports as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                                      </optgroup>
                                      <optgroup label="Orlando Hotels">
                                     <?php 
				
				if(count($all_locations)>=1){
				foreach($all_locations as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </optgroup>
                <optgroup label="Cruise Lines">
                                     <?php 
				
				if(count($all_cruises)>=1){
				foreach($all_cruises as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </optgroup>
                
                <optgroup label="Theme Parks">
                  <option value="431">Universal Studios</option>
                  <option value="432">Sea World</option>
                                      </optgroup>
                                      <optgroup label="Disney resorts">
                                     <?php 
				
				if(count($all_disney_resorts)>=1){
				foreach($all_disney_resorts as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </optgroup>
                
                
                <optgroup label="SHADES OF GREEN TRANSFERS">
                <optgroup label="&nbsp;&nbsp;&nbsp;Orlando Hotels">
                                      <option value="517">Shades of Green</option>
                                      </optgroup>
                                      <optgroup label="&nbsp;&nbsp;&nbsp;GATEWAYS">
                                     <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(13);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                					</optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;DISNEY ATTRACTIONS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(5);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;ATTRACTIONS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(6);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;DISNEY RESORTS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(7);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;GOLF COURSES">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(8);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;SHOPPING">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(9);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;RESTAURANTS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(10);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;OTHER">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(11);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;LBV">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(12);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    </optgroup>
                </select>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><input name="date<?php echo $count; ?>" type="text" id="date<?php echo $count; ?>" size="10" maxlength="10" value="<?php echo format_to_caldate($reservation_details[$count]['date']);?>">&nbsp;<img src="img/cal.gif" width="16" height="16" onclick="javascript:cal<?php echo $count; ?>.popup();"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY
                <script language="JavaScript">
				var cal<?php echo $count; ?> = new calendar2(document.forms['edit_reservation'].elements['date<?php echo $count; ?>']);
				cal<?php echo $count; ?>.year_scroll = true;
				cal<?php echo $count; ?>.time_comp = false;
				//-->
				</script>                </td>
              </tr>
              <tr valign="middle">
              	<td colspan="2"><div id="myLocationdetails<?php echo $count; ?>" align="center">
                
                <?php if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { ?>
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
            	<td class="ot" colspan="2" align="center">
                Select your Airline from the list below.</td>
            </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong><strong>
                  <?php if (check_arrival($reservation_details[$count]['from'])) { echo "Arriving"; } else { echo "Departing"; }; ?>
                </strong> Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="airline<?php echo $count; ?>" size="1">
                <?php if (!empty($reservation_details[$count]['airline'])) { echo '<option value="'.$reservation_details[$count]['airline'].'">'.$reservation_details[$count]['airline'].'</option>'; } ;?>
			    <?php if ($reservation_details[$count]['from'] == '422') { ?>
                <option value="Allegiant Air">Allegiant Air</option>
                <option value="Direct Air">Direct Air</option>
                <option value="flyglobespan">flyglobespan</option>
                <option value="Icelandair">Icelandair</option>
                <option value="Jetairfly">Jetairfly</option>
                <option value="First Choice (Air 2000)">First Choice (Air 2000)</option>																																																													                <option value="Monarch">Monarch</option>
                <option value="Thomas Cook">Thomas Cook</option>
                <option value="Thomsonfly">Thomsonfly</option>
                <?php } else { ?>
				<option value="AirTran Airways">AirTran Airways</option>
				<option value="Alaska Airlines">Alaska Airlines</option>
                <option value="American Airlines">American Airlines</option>
                <option value="British Airways">British Airways</option>
                <option value="Continental Airlines">Continental Airlines</option>
                <option value="Delta Air Lines">Delta Air Lines</option>
                <option value="JetBlue Airways Corporation">JetBlue Airways Corporation</option>
                <option value="Midwest Airlines">Midwest Airlines</option>
                <option value="Northwest Airlines">Northwest Airlines</option>
                <option value="Southwest Airlines">Southwest Airlines</option>
                <option value="United Airlines">United Airlines</option>
                <option value="US Airways">US Airways</option>
                <option value="Virgin Atlantic Airways">Virgin Atlantic Airways</option>
                
				<option value="Aer Lingus">Aer Lingus</option>
				<option value="Aeromexico">Aeromexico</option>
				<option value="Air Canada">Air Canada</option>
				<option value="Air Europa">Air Europa</option>
				<option value="Air France">Air France</option>
				<option value="Air Jamaica">Air Jamaica</option>
				<option value="Air New Zealand">Air New Zealand</option>
				<option value="Air One">Air One</option>
				<option value="Air Transat A.T.Inc.">Air Transat A.T.Inc.</option>
				<option value="Alitalia">Alitalia</option>
				<option value="All Nippon Airways">All Nippon Airways</option>
				<option value="Asiana Airlines">Asiana Airlines</option>
				<option value="Austrian Airlines AG">Austrian Airlines AG</option>
				<option value="Bahamasair">Bahamasair</option>
                <option value="bmi british midland">bmi British Midland</option>
				<option value="Brussels Airlines">Brussels Airlines</option>
				<option value="Cathay Pacific Airways">Cathay Pacific Airways</option>
				<option value="China Airlines">China Airlines</option>
				<option value="China Southern Airlines">China Southern Airlines</option>
				<option value="Copa Airlines">Copa Airlines</option>
				<option value="Czech Airlines">Czech Airlines</option>
                <option value="Frontier Airlines Inc.">Frontier Airlines Inc.</option>
				<option value="Iberia">Iberia</option>
                <option value="Japan Airlines International">Japan Airlines International</option>
				<option value="Korean Air">Korean Air</option>
				<option value="KLM-Royal Dutch Airlines">KLM-Royal Dutch Airlines</option>
				<option value="Lan Airlines">Lan Airlines</option>
				<option value="Lan Peru">Lan Peru</option>
				<option value="Lufthansa German Airlines">Lufthansa German Airlines</option>
				<option value="LOT - Polish Airlines">LOT - Polish Airlines</option>
				<option value="Mexicana de Aviacion">Mexicana de Aviacion</option>
				<option value="MALEV Hungarian Airlines">MALEV Hungarian Airlines</option>																									
				<option value="Qantas Airways">Qantas Airways</option>
				<option value="Qatar Airways">Qatar Airways</option>
				<option value="Royal Air Maroc">Royal Air Maroc</option>
				<option value="Singapore Airlines">Singapore Airlines</option>
				<option value="South African Airways">South African Airways</option>
				<option value="Spirit Airlines">Spirit Airlines</option>
				<option value="Sun Country Airlines">Sun Country Airlines</option>
				<option value="Sunwing Airlines Inc.">Sunwing Airlines Inc.</option>
				<option value="Swiss">Swiss</option>
				<option value="SAS Scandinavian Airlines">SAS Scandinavian Airlines</option>
				<option value="TAM Linhas Aereas">TAM Linhas Aereas</option>
				<option value="TAP Air Portugal">TAP Air Portugal</option>
				<option value="Thomsonfly">Thomsonfly</option>
				<option value="Westjet">Westjet</option>
                <?php } ?>
				</select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><input name="flight_number<?php echo $count; ?>" class="bodytxt" size="10" type="text" value="<?php echo $reservation_details[$count]['flight_number'];?>"></td>
              </tr>
              </table>
              <?php } ?>
                
                </div></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong><?php if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { if (check_arrival($reservation_details[$count]['from'])) { echo "Arriving"; } else { echo "Departing"; }; } else { echo "Pickup"; }; ?> at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php  $time = format_time2($reservation_details[$count]['time']); ?><?php $time= explode(":", $time);?><select name="h<?php echo $count; ?>" size="1"><?php if (!empty($time[0])) { echo '<option value="'.$time[0].'" selected="selected">'.$time[0].'</option>'; } ;?><option value="12">12</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option></select><select name="m<?php echo $count; ?>" size="1"><?php if (!empty($time[1])) { echo '<option value="'.$time[1].'">'.$time[1].'</option>'; } ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm<?php echo $count; ?>" size="1"><?php if (!empty($time[2])) { echo '<option value="'.$time[2].'">'.$time[2].'</option>'; } ;?><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php //echo $to[$count]['name']; ?>
                
                <!-- <input name="to<?php echo $count; ?>" type="hidden" value="<?php echo $reservation_details[$count]['to']; ?>" />-->
                
                <select name="to<?php echo $count; ?>" id="to<?php echo $count; ?>" required="yes" size="1" onchange="javascript:getNewlocationtoContent1_<?php echo $count; ?>(this.value); JavaScript:xmlhttpPost2('calculate_sog.php');">
                                      <option value="<?php echo $reservation_details[$count]['to']; ?>" selected="selected"><?php echo $to[$count]['name']; ?></option>
                                      <optgroup label="Orlando Airports">
                                      <?php 
				
				if(count($all_airports)>=1){
				foreach($all_airports as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                                      </optgroup>
                                      <optgroup label="Orlando Hotels">
                                     <?php 
				
				if(count($all_locations)>=1){
				foreach($all_locations as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </optgroup>
                <optgroup label="Cruise Lines">
                                     <?php 
				
				if(count($all_cruises)>=1){
				foreach($all_cruises as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </optgroup>
                <optgroup label="Theme Parks">
                  <option value="431">Universal Studios</option>
                  <option value="432">Sea World</option>
                                      </optgroup>
                                      <optgroup label="Disney resorts">
                                     <?php 
				
				if(count($all_disney_resorts)>=1){
				foreach($all_disney_resorts as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </optgroup>
                
                <optgroup label="SHADES OF GREEN TRANSFERS">
                <optgroup label="&nbsp;&nbsp;&nbsp;Orlando Hotels">
                                      <option value="517">Shades of Green</option>
                                      </optgroup>
                                      <optgroup label="&nbsp;&nbsp;&nbsp;GATEWAYS">
                                     <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(13);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                					</optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;DISNEY ATTRACTIONS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(5);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;ATTRACTIONS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(6);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;DISNEY RESORTS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(7);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;GOLF COURSES">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(8);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;SHOPPING">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(9);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;RESTAURANTS">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(10);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;OTHER">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(11);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    <optgroup label="&nbsp;&nbsp;&nbsp;LBV">
                                    <?php 
									 $shadesofgreen_locations = get_shadesofgreen_locations(12);
									if(count($shadesofgreen_locations)>=1){
									foreach($shadesofgreen_locations as $value){
									?>
                 					 <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  					<?php
										}
									}
									?>
                                    </optgroup>
                                    </optgroup>
                </select>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Driver:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">
                  <select name="drivers_id<?php print $count?>">
                    <option value="0"> -- Select One -- </option>
                    <?php
						$all_drivers = get_all_drivers(); 
                        
						foreach ($all_drivers as $driver) {
                        
                            if($driver['status'] == '3')
                            {
    							if ($driver["id"] == $reservation_details[$count]['drivers_id']) {
    								$default_driver = 'selected="selected"';
    							}
    							else {
    								$default_driver = '';
    							}
    							print '<option value="' . $driver["id"] . '" ' . $default_driver . '>';
    							print ucfirst($driver["first_name"]) . ' ' . ucfirst($driver["last_name"]);
    							print '</option>';
                            }
						} 
					?>
				  </select>
                </td>
              </tr>
              <tr valign="middle">
              	<td colspan="2"><p id="myLocationdetailsto<?php echo $count; ?>"></p></td>
              </tr>
          </table>
          </td>
          </tr>
          </table>
          <?php
		  //Number of legs -> make a loop END
		  } ?>
                
                
                </td>
              </tr>
              
            
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Passenger Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>First Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name" class="bodytxt" size="39" type="text" value="<?php echo $reservation_view['first_name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Last Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name" class="bodytxt" size="39" type="text" value="<?php echo $reservation_view['last_name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address</strong></td>
                <td align="left" height="30"><input name="address" class="bodytxt" size="39" id="address" type="text" value="<?php echo $reservation_view['address']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2</strong></td>
                <td align="left" height="30"><input name="address2" class="bodytxt" size="39" id="address2" type="text" value="<?php echo $reservation_view['address2']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City</strong></td>
                <td align="left" height="30"><input name="town" class="bodytxt" size="39" id="town" type="text" value="<?php echo $reservation_view['city']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State</strong></td>
                <td align="left" height="30">
                						<select name="state" id="state" class="bodytxt">
                        <option value="<?php echo $reservation_view['state']; ?>"><?php echo $reservation_view['state']; ?></option>
                        <option value="Outside USA">Outside USA</option>                        
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
                      </select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code</strong></td>
                <td align="left" height="30"><input name="zip" class="bodytxt" size="10" id="zip" type="text" value="<?php echo $reservation_view['zip']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country</strong></td>
                <td align="left" height="30">
                <select name="country" id="country" class="bodytxt">
                <option value="<?php echo $reservation_view['country']; ?>"><?php echo $reservation_view['country']; ?></option>
  				<option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option>
                            <option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Azores">Azores</option>
                            <option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia Herzegowina">Bosnia Herzegowina</option>
                            <option value="Bosnia-Herzegovina">Bosnia-Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option><option value="British Indian O. Terr">British Indian O. Terr</option>
                            <option value="British Virgin Isl">British Virgin Isl</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option><option value="Central African Rep">Central African Rep</option><option value="Chad">Chad</option>
                            <option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Isl">Cocos (Keeling) Isl</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option><option value="Congo, The Dem Rep">Congo, The Dem Rep</option><option value="Cook Islands">Cook Islands</option>
                            <option value="Corsica">Corsica</option><option value="Costa Rica">Costa Rica</option><option value="Cote d` Ivoire">Cote d` Ivoire</option>
                            <option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France (Incl Monaco)">France (Incl Monaco)</option>
                            <option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option>
                            <option value="French Polynesia">French Polynesia</option><option value="French S. Territories">French S. Territories</option>
                            <option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option><option value="Heard And Mc Donald Isl">Heard And Mc Donald Isl</option>
                            <option value="Holy See (Vatican City)">Holy See (Vatican City)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option>
                            <option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option>
                            <option value="Ireland (Eire)">Ireland (Eire)</option><option value="Israel">Israel</option><option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic Rep">Korea, Democratic Rep</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option>
                            <option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Madeira Islands">Madeira Islands</option>
                            <option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option>
                            <option value="Moldova, Republic Of">Moldova, Republic Of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option>
                            <option value="Myanmar (Burma)">Myanmar (Burma)</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Isl">Northern Mariana Isl</option><option value="Norway">Norway</option>
                            <option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option>
                            <option value="Palestinian Territory">Palestinian Territory</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia-Montenegro">Serbia-Montenegro</option>
                            <option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option>
                            <option value="Slovak Republic">Slovak Republic</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia">South Georgia</option>
                            <option value="South Korea">South Korea</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option>
                            <option value="St. Christopher, Nevis">St. Christopher, Nevis</option><option value="St. Helena">St. Helena</option><option value="St. Lucia">St. Lucia</option>
                            <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="St. Vincent and Gren">St. Vincent and Gren</option>
                            <option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard And Jan M Isl">Svalbard And Jan M Isl</option>
                            <option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Rep">Syrian Arab Rep</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tristan da Cunha">Tristan da Cunha</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Isl">Turks and Caicos Isl</option><option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option><option value="Great Britain">Great Britain</option>
                            <option value="United States" selected="selected">United States</option><option value="U.S. Minor Outlying Isl">U.S. Minor Outlying Isl</option>
                            <option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Furuna Isl">Wallis and Furuna Isl</option>
                            <option value="Western Sahara">Western Sahara</option><option value="Western Samoa">Western Samoa</option><option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
				</select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>E-mail</strong></td>
                <td align="left" height="30"><input name="email" class="bodytxt" size="39" id="email" type="text" value="<?php echo $reservation_view['email']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Phone Number</strong></td>
                <td align="left" height="30"><input name="phone_number" class="bodytxt" size="39" id="phone_number" type="text" value="<?php echo $reservation_view['telephone']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Mobile Phone</strong></td>
                <td align="left" height="30"><input name="cellphone" class="bodytxt" size="39" id="cellphone" type="text" value="<?php echo $reservation_view['cellphone']; ?>"></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="bodytxt">
                <tr>
                	<td width="40%" align="right"><span style="color:#677bca; font-weight:bold;">Billing Information</span>&nbsp;&nbsp;&nbsp;</td><td align="center"><input name="billing_adr" value="1" id="billing-checkbox" onclick="auto_address_update(document.edit_reservation)" type="checkbox"></td><td> Billing Address is the same as Passenger Address.</td>
                </tr>
              </table></div> </td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>First Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name_billing" class="bodytxt" size="39" type="text" value="<?php echo $reservation_view['first_name_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Last Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name_billing" class="bodytxt" size="39" type="text" value="<?php echo $reservation_view['last_name_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address</strong></td>
                <td align="left" height="30"><input name="address_billing" class="bodytxt" size="39" id="address_billing" type="text" value="<?php echo $reservation_view['address_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2</strong></td>
                <td align="left" height="30"><input name="address2_billing" class="bodytxt" size="39" id="address2_billing" type="text" value="<?php echo $reservation_view['address2_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City</strong></td>
                <td align="left" height="30"><input name="city_billing" class="bodytxt" size="39" id="city_billing" type="text" value="<?php echo $reservation_view['city_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State</strong></td>
                <td align="left" height="30">
                						<select name="state_billing" id="state_billing" class="bodytxt">
                        <option value="<?php echo $reservation_view['state_billing']; ?>"><?php echo $reservation_view['state_billing']; ?></option>
                        <option value="Outside USA">Outside USA</option>                        
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
                      </select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code</strong></td>
                <td align="left" height="30"><input name="zip_billing" class="bodytxt" size="10" id="zip_billing" type="text" value="<?php echo $reservation_view['zip_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country</strong></td>
                <td align="left" height="30">
                <select name="country_billing" id="country_billing" class="bodytxt">
                <option value="<?php echo $reservation_view['country_billing']; ?>"><?php echo $reservation_view['country_billing']; ?></option>
  				<option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option>
                            <option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Azores">Azores</option>
                            <option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia Herzegowina">Bosnia Herzegowina</option>
                            <option value="Bosnia-Herzegovina">Bosnia-Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option><option value="British Indian O. Terr">British Indian O. Terr</option>
                            <option value="British Virgin Isl">British Virgin Isl</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option><option value="Central African Rep">Central African Rep</option><option value="Chad">Chad</option>
                            <option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Isl">Cocos (Keeling) Isl</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option><option value="Congo, The Dem Rep">Congo, The Dem Rep</option><option value="Cook Islands">Cook Islands</option>
                            <option value="Corsica">Corsica</option><option value="Costa Rica">Costa Rica</option><option value="Cote d` Ivoire">Cote d` Ivoire</option>
                            <option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France (Incl Monaco)">France (Incl Monaco)</option>
                            <option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option>
                            <option value="French Polynesia">French Polynesia</option><option value="French S. Territories">French S. Territories</option>
                            <option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option><option value="Heard And Mc Donald Isl">Heard And Mc Donald Isl</option>
                            <option value="Holy See (Vatican City)">Holy See (Vatican City)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option>
                            <option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option>
                            <option value="Ireland (Eire)">Ireland (Eire)</option><option value="Israel">Israel</option><option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic Rep">Korea, Democratic Rep</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option>
                            <option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Madeira Islands">Madeira Islands</option>
                            <option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option>
                            <option value="Moldova, Republic Of">Moldova, Republic Of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option>
                            <option value="Myanmar (Burma)">Myanmar (Burma)</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Isl">Northern Mariana Isl</option><option value="Norway">Norway</option>
                            <option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option>
                            <option value="Palestinian Territory">Palestinian Territory</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia-Montenegro">Serbia-Montenegro</option>
                            <option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option>
                            <option value="Slovak Republic">Slovak Republic</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia">South Georgia</option>
                            <option value="South Korea">South Korea</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option>
                            <option value="St. Christopher, Nevis">St. Christopher, Nevis</option><option value="St. Helena">St. Helena</option><option value="St. Lucia">St. Lucia</option>
                            <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="St. Vincent and Gren">St. Vincent and Gren</option>
                            <option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard And Jan M Isl">Svalbard And Jan M Isl</option>
                            <option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Rep">Syrian Arab Rep</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tristan da Cunha">Tristan da Cunha</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Isl">Turks and Caicos Isl</option><option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option><option value="Great Britain">Great Britain</option>
                            <option value="United States" selected="selected">United States</option><option value="U.S. Minor Outlying Isl">U.S. Minor Outlying Isl</option>
                            <option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Furuna Isl">Wallis and Furuna Isl</option>
                            <option value="Western Sahara">Western Sahara</option><option value="Western Samoa">Western Samoa</option><option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
				</select>                </td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Payment Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Total Amount</strong></td>
                <td align="left" height="30" width="62%" class="ot2">$<input name="total_amount" class="bodytxt" size="12" type="text" value="<?php echo $reservation_view['total_amount']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Payment Method</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <select id="card_type" name="card_type" size="1">
																	<option value="<?php echo $reservation_view['card_type']; ?>" selected="selected"><?php echo $reservation_view['card_type']; ?></option>
																	<option value="Visa">Visa</option>
																	<option value="MasterCard">MasterCard</option>
																	<option value="Discover">Discover</option>
																</select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Credit Card Number</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="card_number" class="bodytxt" size="32" type="text" value="<?php echo $reservation_view['card_number']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Expiration Date</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $exp_date = format_exp_date($reservation_view['exp_date']); ?>
                <select id="ExpMonth" name="ExpMonth" size="1">
                													<option value="<?php echo $exp_date[0] ; ?>"><?php echo $exp_date[0] ; ?></option>
																	
																	<option value="Jan">Jan</option>
																	
																	<option value="Feb">Feb</option>
																	
																	<option value="Mar">Mar</option>
																	
																	<option value="Apr">Apr</option>

																	
																	<option value="May">May</option>
																	
																	<option value="Jun">Jun</option>
																	
																	<option value="Jul">Jul</option>
																	
																	<option value="Aug">Aug</option>
																	
																	<option value="Sep">Sep</option>
																	
																	<option value="Oct">Oct</option>

																	
																	<option value="Nov">Nov</option>
																	
																	<option value="Dec">Dec</option>
																	
																</select>
                                                                <select id="ExpYear" name="ExpYear" size="1">
                                                                	<option value="<?php echo $exp_date[1] ; ?>"><?php echo $exp_date[1] ; ?></option>
																	
																	<?php
        for ($i = (date("Y") + 15); $i >= date("Y"); $i--) {
            print '<option value="' . $i . '" ' . ( ! isset($exp_date[1]) && $i == date('Y') ? 'selected="selected"' : '') . '>' .$i . '</option>';
        }
    ?>
																</select>                                                                
                                                                </td>
              </tr>
              <tr>
              	<td width="100%" colspan="2"><div style="background-color:#efefef; padding:5px; border:#CCCCCC solid 1px;"><span style="color:#000000;"><input name="paying_cash" value="Yes" id="paying_cash" type="checkbox" <?php if ($reservation_view['paying_cash'] == 'Yes') { ?> checked="checked" <?php } ?>> Please do not charge my credit card. I will be paying cash or traveler check upon arrival I understand I am submitting my credit card info only to guarantee my reservation. I also read and understand Sunstate Transportation cancellation policy.</span></div>      
                </td>
              </tr>
              <tr>
              	<td width="100%" height="10" colspan="2"></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Reservation Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Reservation Status</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $status = get_statuses_view($reservation_view['status']); ?>
                <select name="status" size="1" class="bodytxt">
                <option value="<?php echo $reservation_view['status'] ; ?>"><?php echo $status['name'] ; ?></option>
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
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Payment Status</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="payment_status" size="1" class="bodytxt">
				<?php if (!empty($reservation_view['payment_status'])) {
				echo '<option value="'.$reservation_view['payment_status'].'">'.$reservation_view['payment_status'].'</option>';
				}
				?>
                <option value="">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Declined">Declined</option>
                </select><input name="payment_status_old" type="hidden" value="<?php echo $reservation_view['payment_status']; ?>" />&nbsp;&nbsp;&nbsp;<?php if (empty($reservation_view['payment_status']) || $reservation_view['payment_status'] == 'Declined') { echo '<a href="make_single_payment.php?id='.$_GET['id'].'" class="menu">Run Credit Card manualy</a>'; }; ?></td>
              </tr>
              <?php if ($reservation_view['payment_date'] != '0000-00-00 00:00:00') { ?>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Payment Date</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><?php echo format_to_caldate_time($reservation_view['payment_date']); ?>
                  <input type="hidden" name="payment_date_old" id="payment_date_old" value="<?php echo $reservation_view['payment_date']; ?>" /></td>
              </tr>
              <?php
			  } 
			  ?>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Approval Code</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="approval_code" rows="2" cols="36" class="bodytxt"><?php echo $reservation_view['approval_code']; ?></textarea></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Customer Comments</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="customer_comments" rows="3" cols="36" class="bodytxt"><?php echo $reservation_view['customer_comments']; ?></textarea></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Admin Comments</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="admin_comments" rows="3" cols="36" class="bodytxt"><?php echo $reservation_view['admin_comments']; ?></textarea></td>
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
