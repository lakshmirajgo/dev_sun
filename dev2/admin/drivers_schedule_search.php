<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
	include("includes/functions/general_functions.php");
	include("includes/functions/drivers_functions.php");
	include("includes/functions/reservation_functions2.php");
	include("includes/functions/vehicle_functions.php");
	include_once("includes/functions/location_functions.php");
	include_once("includes/functions/trip_type_functions.php");	
	include_once("includes/functions/status_functions.php");	
	

if (!empty($_POST['assign_drivers_x'])){
	assign_drivers_by_iws($_POST['reservation_id'], $_POST['res_details_id'], $_POST['drivers_id'], $notify_driver);
	}
	
include ("includes/common/header.php");	
$all_vehicles = get_all_vehicles();
$all_reservations = get_all_reservations();
?>
<script language="javascript">

	function assign_driver(resId, resDetailsId, driversId, notifyDriver){
		url = 'assign_driver.php?resId='+resId+'&resDetailsId='+resDetailsId+'&driversId='+driversId+'&notifyDriver='+notifyDriver;
		window.open(url,'Assign Drivers','height=130,width=250');
		return false;
	}

</script>

<div align="center">
	  <?php include ("includes/common/menu.php");	?>
<!--	 <table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>IWS Site Manager Ver 2.0</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr class="bodytxt">
          	<td><p>Welcome to IWS Site Manager Ver 2.0 this admin panel will allow you to control various sections of your website.</p>
          	  <p>It gives you total control of your website. It allows you update your website easily using any browser. It's robust user friendly interface makes it a snap updating any page of your website.</p></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg">&nbsp;</td>
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
    </tbody></table>-->
    <form name="report" method="get" action="drivers_schedule_search.php" style="padding:0px; margin:0px;">
    <table width="500" cellpadding="0" cellspacing="0" border="0" style="border:#999999 solid 1px;" bgcolor="#e4e4e4">
    <tr>
    	<td colspan="2" align="center" valign="middle"><h3>Search</h3></td>
    </tr>
    <tr>
                <td style="padding:5px;">
                From <input name="from" type="text" id="from" size="8" maxlength="10" value="<?php if (!empty($_GET['from'])) { echo $_GET['from'];};?>">&nbsp;<img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('from');"><i> <font color="#ff0000" size=2>select date</font></i>
                </td>
                <td>
                To &nbsp;&nbsp;&nbsp;&nbsp;<input name="to" type="text" id="to" size="8" maxlength="10" value="<?php if (!empty($_GET['to'])) { echo $_GET['to'];};?>">&nbsp;<img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('to');"><i> <font color="#ff0000" size=2>select date</font></i></td>
            </tr>
            <tr>
                <td style="padding:5px;">
                </td>
                <td style="padding:5px;" align="right"><input name="calculate_total" type="submit" value="Search">
                </td>
            </tr>
        </table>
        <br /><br />
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
    <table border="1" cellpadding="0" cellspacing="0" class="bodytxt">
    	<tr>
        	<td width="100" align="center" style="padding:5px;"><img src="images/arrivals_legend.jpg" border="0" title="ARRIVALS" alt="ARRIVALS" /></td>
            <td width="100" align="center" style="padding:5px;"><img src="images/departures_legend.jpg" border="0" title="DEPARTURES" alt="DEPARTURES" /></td>
            <td width="160" align="center" style="padding:5px;"><img src="images/transfers_legend.jpg" border="0" title="TRANSFERS" alt="TRANSFERS" /></td>
        </tr>
        <tr>
        	<td width="100" align="center" style="padding:5px;"><strong>FIRST TRANSFER</strong></td>
            <td width="100" align="center" style="padding:5px;"><strong>LAST TRANSFER</strong></td>
            <td width="160" align="center" style="padding:5px;"><strong>TRANSFERS WITH > 2 LEGS</strong></td>
      </tr>
    </table>
    </div>
    <?php
	get_future_reservations_with_pages();
	?>
    <div style="padding-top:20px;" align="center">
        <a href="drivers_schedule_print.php?calculate_total=Search&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>" target="_blank"><img src="images/print_schedule.jpg" border="0"></a>
        </div>
    <?php
unset ($_SESSION['redirect']);
include ("includes/common/footer.php");
?>