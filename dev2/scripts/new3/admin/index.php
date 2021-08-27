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
	include_once("includes/functions/status_functions.php");	
	
include ("includes/common/header.php");	
$all_vehicles = get_all_vehicles();
$all_reservations = get_all_reservations();
?>
<div align="center">
	  <?php include ("includes/common/menu.php");	?>
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
    </tbody></table>
    </div>
    <?php
    get_arrivals_with_pages();
	
	get_departures_with_pages();
	
	get_transfers_with_pages();
	?>
    <div style="background-color:#ced5f3; padding-top:2px; padding-right:5px; padding-bottom:2px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">FUTURE TRANSFERS</span>&nbsp;&nbsp;<a href="#" onClick="Effect.BlindDown('blinddown'); return false;"><img src="../images/plus_btn.png" border="0" alt="View details" title="View details" align="absmiddle" width="24"></a> <a href="#" onClick="$('blinddown').hide(); return false;"><img src="../images/minus_btn.png" border="0" alt="Hide details" title="Hide details" align="absmiddle" width="24"></a></div> 
    <div id="blinddown" style="display:none;">
    <?php
	get_future_reservations_with_pages();
	?>
    </div>
    <?php

include ("includes/common/footer.php");
?>