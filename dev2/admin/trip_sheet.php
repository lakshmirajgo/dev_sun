<?php
/**
 *	Trip sheet revised
 *
 *	October 19, 2012
 */

session_start();

if ( ! isset($_SESSION['auth_admin'])) {
	$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
	header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
	// Quit the script
	exit(); 
}


//error_reporting(E_ALL);
//ini_set('display_errors', '1');


include("includes/functions/general_functions.php");

//require_once('includes/application_top.php');
	



	include_once("includes/functions/vehicle_functions.php");	
	include_once("includes/functions/status_functions.php");
	
	
include_once("includes/functions/location_functions.php");
include_once("includes/functions/drivers_functions.php");
include_once("includes/functions/expense_log_functions.php");
//include_once("includes/functions/reservation_functions.php");
include_once("includes/functions/reservation_functions2.php");
include_once("includes/functions/trip_type_functions.php");		
	
	if($_GET['cAction']=="get_trip_sheet"){
		$all_trips = get_driver_from_reservation($_GET['drivers_id'], format_date_calendar($_GET["from"]), format_date_calendar($_GET["to"]));
		}
		
	include ("includes/common/header.php");
 	include ("includes/common/menu.php");
	//$all_trips = get_all_trips();
	//print_r($all_trips); exit;
    $all_drivers = get_all_drivers();
	//print_r( $all_drivers); exit;

	// Show Trip Sheet for Specific Driver
	if (empty($_GET['cAction']) ||  $_GET['cAction'] == 'get_trip_sheet'){
	?>
<form name="displayfrm" method="get" action="trip_sheet.php">
    <input type="hidden" value="get_trip_sheet" name="cAction" />
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
                  <input name="get_trip_sheet" type="submit" value="Get Trip Sheet"></td>
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
                  <td align="center" height="20" valign="top"><strong>DRIVER'S TRIP SHEET</strong></td>
                  </tr>
                  <tr>
                </tr>
              </tbody></table>
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              	<td width="50%" valign="middle" align="left"><strong>Date:</strong> <?php if (!empty($_GET['from'])) { echo $_GET['from'].' - '; } ;?><?php if (!empty($_GET['to'])) { echo $_GET['to']; } ;?><br /><strong>Driver:</strong> <?php $driver = get_driver_view($_GET['drivers_id']); echo  strtoupper($driver['first_name']). " " .strtoupper($driver['last_name']); ?></td>
                <td width="50%" valign="middle" align="right"><strong>Car Number:</strong> ____________</td>
              </tr>
              </table>
            </td>
          </tr>
          <tr>
          	<td>


<br style="clear:both;" />
            
<?php get_future_reservations_trip_sheet_with_pages_print(); ?>

            
            </td>
          </tr>
        </tbody></table>
        
        
        <div style="padding-top:20px;" align="center">
        <a href="trip_sheet_print.php?cAction=get_trip_sheet&drivers_id=<?php echo $_GET['drivers_id']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>" target="_blank"><img src="images/print_trip_sheet.jpg" border="0"></a>
        &nbsp; &nbsp;
        <a href="trip_sheet_email.php?cAction=get_trip_sheet&drivers_id=<?php echo $_GET['drivers_id']; ?>&from=<?php echo $_GET['from']; ?>&to=<?php echo $_GET['to']; ?>" target="_blank" style="font-size:20px;">Email Trip Sheet</a>
        
        </div>
            
		</td>
      </tr>
    </tbody>
  </table>
  
<?php } ?>

<?php include ("includes/common/footer.php"); ?>