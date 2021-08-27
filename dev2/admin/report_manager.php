<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
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
	
//Check permissions for User BEGIN
if (!chech_permissions($_SESSION['user_details'], 'reports')) {
//header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/index.php");
echo '<script language="javascript">alert(\'You dont have a permissions access to this page!\');window.location=\'index.php\';</script>';
// Quit the script
exit(); 
}
//Check permissions for User END	
		
include ("includes/common/header.php");	
?>
	<div align="center">	
<?php include ("includes/common/menu.php");	?>
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
                From <input name="from" type="text" id="from" size="8" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal1.popup();"><i> <font color="#ff0000" size=2>select date</font></i>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
            	<td style="padding:5px;">
                <select name="trip_type" size="1" class="bodytxt">
                <option value="">All Trip Types</option>
                                      <OPTGROUP LABEL="Orlando Area">
                                      <option value="1">Orlando Area - One Way</option>
                                      <option value="2">Orlando Area - Round Trip</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Cruise Transfer">
                                      <option value="3">MCO to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="4">MCO to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="5">Disney/Universal to Cruise Terminal/Port Area - One Way</option>
                                      <option value="6">Disney/Universal to Cruise Terminal/Port Area - Round Trip</option>
                                      <option value="7">MCO>Disney or Universal>Cruise terminal>MCO (3 leg)</option>
                                      <option value="8">MCO>Cruise Terminals>Disney or Universal>MCO (3 leg)</option>
                                      <option value="9">Sanford to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="11">Sanford to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="10">Sanford>Cruise Terminals>Disney or Universal>Sanford</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Attraction Transfer">
                                      <option value="12">Disney Resort to Universal/Sea World - One Way</option>
                                      <option value="13">Disney Resort to Universal/Sea World - Round Trip</option>
                                      <option value="77">Disney Resort to SeaWorld Theme Park - One Way</option>
                                      <option value="78">Disney Resort to SeaWorld Theme Park - Round Trip</option>
                                      <option value="79">Disney Resort to Universal Theme Park - One Way</option>
                                      <option value="80">Disney Resort to Universal Theme Park - Round Trip</option>
									  </OPTGROUP>
                </select>
                </td>
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
              <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
              	<tr>
                	<td width="50%" align="center">
                    
                      <a href="cpanel_login.php" target="_blank"><img src="images/cpanel_reports.jpg" alt="View Website Statistics" border="0"></a> </td>
                    <td width="50%" align="center">
                    <form method="get" name="langform" action="https://www.google.com/accounts/ServiceLoginBoxAuth" target="_blank">
              <input type="hidden" name="ctu" value="https://www.google.com/analytics/settings/?hl=en-US">
<input name="continue" value="https://www.google.com/analytics/settings/?&amp;et=reset&amp;hl=en-US" type="hidden"><input name="service" value="analytics" type="hidden">  <input name="nui" value="1" type="hidden">                 <input name="hl" value="en-US" type="hidden">                          
<input name="GA3T" value="wc0HAw4hWb4" type="hidden">
<input name="Email" value="sunstatelimoseo@gmail.com" class="gaia le val" size="18" id="Email" type="hidden">
<input name="Passwd" class="gaia le val" id="Passwd" size="18" type="hidden" value="rash4075">
<input name="PersistentCookie" value="yes" type="hidden">
<input name="rmShown" value="1" type="hidden">
<input src="images/google_reports.jpg" border="0" type="image">

</form>
                   </td>
                </tr>
             </table>
    </div>
<?php
unset ($_SESSION['redirect']);
include ("includes/common/footer.php");
?>