<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/location_functions.php");
include ("includes/functions/price_functions.php");
include_once("includes/functions/trip_type_functions.php");	
include("includes/functions/locked_dates_functions.php");


$company_info = get_company_info(); 
if (!empty($_POST)) {
$_SESSION['step4'] = '1';
};

if (!isset($_SESSION['step4'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve.php");
// Quit the script
exit(); 
}

if (!isset($_SESSION['trip_type'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve.php");
// Quit the script
exit(); 
}

$_SESSION['step4'] = 'yes';
if ($_SESSION['trip_type'] > 2) {
$transfer = get_prices_view($_SESSION['vehicle'], $_SESSION['trip_type']);
} else {
$price_local = get_prices_view_local($_SESSION['vehicle'], $_SESSION['trip_type'], $from['zone_id'], $to['zone_id']);
};







$date = $_POST['date1'] . ' ' . $_POST['h1'] . ':' . $_POST['m1'] . ' ' . $_POST['ampm1'];
$date = date('Y-m-d H:i:s', strtotime($date));

$forty8 = date('Y-m-d H:i:s', strtotime('+2 days'));

if($date <= $forty8)
{
    $_SESSION['date1_error'] = 'You can only reserve online if your arrival is 48hrs prior. <br /><br />Please call 407-601-7900 to reserver over the phone';
    header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve_step3.php");
}

$res = is_locked_date($date);


if($res == TRUE)
{
    $_SESSION['date1_error'] = 'We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.';
    header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve_step3.php");
}


if(isset($_POST['date2']))
{
    $date2 = $_POST['date2'] . ' ' . $_POST['h2'] . ':' . $_POST['m2'] . ' ' . $_POST['ampm2'];
    $date2 = date('Y-m-d H:i:s', strtotime($date2));

    $res = is_locked_date($date2);
    
    
    if($res == TRUE)
    {
        $_SESSION['date2_error'] = 'We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.';
        header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve_step3.php");
    }
    
    if($date >= $date2)
    {
        $_SESSION['date1_error'] = 'Invalid date. Please check and try again';
        header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve_step3.php");
    }
}


if(isset($_POST['date3']))
{
    $date3 = $_POST['date3'] . ' ' . $_POST['h3'] . ':' . $_POST['m3'] . ' ' . $_POST['ampm3'];
    $date3 = date('Y-m-d H:i:s', strtotime($date3));

    $res = is_locked_date($date3);
    
    
    if($res == TRUE)
    {
        $_SESSION['date3_error'] = 'We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.';
        header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve_step3.php");
    }
    
    if($date2 >= $date3)
    {
        $_SESSION['date2_error'] = 'Invalid date. Please check and try again';
        header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve_step3.php");
    }
}

if(isset($_POST['date4']))
{
    $date4 = $_POST['date4'] . ' ' . $_POST['h4'] . ':' . $_POST['m4'] . ' ' . $_POST['ampm4'];
    $date4 = date('Y-m-d H:i:s', strtotime($date4));

    $res = is_locked_date($date4);
    
    
    if($res == TRUE)
    {
        $_SESSION['date4_error'] = 'We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.';
        header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve_step3.php");
    }
    
    if($date3 >= $date4)
    {
        $_SESSION['date3_error'] = 'Invalid date. Please check and try again';
        header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve_step3.php");
    }
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Orlando's Airport Premier Transportation Services - Reserve Online</title>
<meta name="keywords" content="orlando airport, orlando airport transportation, limousine orlando, florida transportation, orlando limousine service, transportation in orlando, disney world transportation, transportation, orlando airport shuttle, Disney world, universal studios, Orlando limousine, Disney transportation, Disney world transportation, orlando airport bus, Orlando limousine service, Towncar, luxury sedans, Limo Services, Limos, Walt Disney World transportation">
<meta name="description" content="Orlando's Airport Premier Transportation Services - Limousine, Towncar, Passenger Van">
<link href="style.css" rel="stylesheet" type="text/css" />
<!-- European format dd-mm-yyyy -->
<script language="JavaScript" src="calendar1.js"></script><!-- Date only with year scrolling -->
<!-- American format mm/dd/yyyy -->
<script language="JavaScript" src="calendar2.js"></script><!-- Date only with year scrolling -->
<!-- mySQL format yyyy-mm-dd -->
<script language="JavaScript" src="calendar3.js"></script><!-- Date only with year scrolling -->
<script type="text/javascript" src="includes/js/validate.js"></script>
<script type="text/javascript" src="includes/js/menu.js"></script>
<script language="JavaScript">
<!--
var url = location.href;	
if(url.charAt(4) != "s" || url.charAt(4) == "w" ){
window.location = "https://www.sunstatelimo.com/reserve_step4.php";
}
-->
</script>
<script language="javascript" type="text/javascript">
//<![CDATA[
var cot_loc0=(window.location.protocol == "https:")? "https://www.sunstatelimo.com/includes/js/cot.js" :
"https://www.sunstatelimo.com/includes/js/cot.js";
document.writeln('<scr' + 'ipt language="JavaScript" src="'+cot_loc0+'" type="text\/javascript">' + '<\/scr' + 'ipt>');
//]]>
</script>
</head>
<body onload="MM_preloadImages('images/fleet_active.gif','images/faq_active.gif','images/contact_active.gif','images/home_active.gif','images/rates_active.gif','images/testimonials_active.gif'); hidefields();">
<div id="Wrapper"> 
 <!--Start Header Here -->
    	<div id="Header">
		<?php include('includes/common/seasonal_header.php'); ?>
		<!--
    	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="19%" valign="middle"><img src="images/sunstate.gif" alt="Sunstate" /></td>
              <td width="81%" align="right"><img src="images/topRightCars.jpg" width="367" height="102" border="0" usemap="#Map" /></td>
            </tr>
          </table>
		  -->
    	</div>
<!--End Header Here -->
<!--Start Navigation Here -->
        <div id="Navigation">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td><a href="index.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image19','','images/home_active.gif',1)"><img src="images/home_normal.gif" alt="Home" name="Image19" width="71" height="33" border="0" id="Image19" /></a><a href="index.php"></a></td>
              <td><a href="rates.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image40','','images/rates_active.gif',1)"><img src="images/rates_normal.gif" alt="Rates" name="Image40" width="93" height="33" border="0" id="Image40" /></a></td>
              <td><a href="fleet.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image41','','images/fleet_active.gif',1)"><img src="images/fleet_normal.gif" alt="Fleet" name="Image41" width="85" height="33" border="0" id="Image41" /></a><a href="fleet.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image41','','images/faq_active.gif',1)"></a></td>
              <td><a href="faq.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image15','','images/faq_active.gif',1)"><img src="images/faq_normal.gif" alt="FAQ" name="Image15" width="81" height="33" border="0" id="Image15" /></a></td>
              <td><a href="testimonial.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image16','','images/testimonials_active.gif',1)"><img src="images/testimonials_normal.gif" alt="Testimonials" name="Image16" width="139" height="33" border="0" id="Image16" /></a></td>
              <td><img src="images/reserve_active.gif" alt="Reseve Online" width="153" height="33" /></td>
              <td><a href="contact.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9','','images/contact_active.gif',1)"><img src="images/contact_normal.gif" alt="Contact Us" name="Image9" width="116" height="33" border="0" id="Image9" /></a></td>
            </tr>
          </table>
        </div>
<!--End Navigation Here --> 
<div id="Banner"> 
<?php //Validate Shades of Green Customers BEGIN
if (isset($_SESSION['shadesofgreen'])) {
echo '<img src="images/header_shadesofgreen.jpg" />';
//Validate Shades of Green Customers END
} else {
	if ($_SESSION['trip_type'] > 2) {
	echo '<img src="images/header_cruise.jpg" />';	
	} else {
	echo '<img src="images/'.$img_head.'" />';
	}
}
?><br />
</div>
<!--Start ContentPanl Here -->
<form id="reserve" style="padding-bottom:0px;" name="reserve" method="post" action="check_out.php">
<div id="ContentPanel"> 
	<div id="CenterColumn"> 
     <div align="center">
    <img src="images/status_bar3.jpg" border="0" />
    </div>
    <br />
<div id="NormalText" class="NormalText"> 
			<div id="Box2" class="Box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="top" align="center">Your Current Itinerary</td>
        </tr>
        <tr>
          <td class="middle">
          <?php
		  //Number of legs -> make a loop BEGIN
          $num_legs = $_SESSION['num_legs'];
		  for ($count =1; $count <= $num_legs; $count += 1) {
		  $from[$count] = get_locations_view($_SESSION['from'.$count.'']);
		  $to[$count] = get_locations_view($_SESSION['to'.$count.'']);
		  // Setup sessions if post is not empty
		  if (!empty($_POST)) {
		  $_SESSION['date'.$count.''] = $_POST['date'.$count.''];
		  $_SESSION['airline'.$count.''] = $_POST['airline'.$count.''];
		  $_SESSION['flight_number'.$count.''] = $_POST['flight_number'.$count.''];
		  $_SESSION['h'.$count.''] = $_POST['h'.$count.''];
		  $_SESSION['m'.$count.''] = $_POST['m'.$count.''];
		  $_SESSION['ampm'.$count.''] = $_POST['ampm'.$count.''];
		  }
		  ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
           	  <td width="100%" class="ot">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              <td colspan="2" width="100%" valign="top" align="center" bgcolor="#ffff82" class="BorderBox" style="padding:5px;">
              <strong><?php if(check_departure($_SESSION['from'.$count.'']) || check_arrival($_SESSION['from'.$count.'']) || check_departure($_SESSION['to'.$count.'']) || check_arrival($_SESSION['to'.$count.''])) { ?><?php if (check_arrival($_SESSION['from'.$count.''])) { echo "Arrival"; } else { echo "Departure"; }; ?><? } else { echo "Transfer"; }; ?></strong>              </td>
             </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from[$count]['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['date'.$count.''];?></td>
              </tr>
              <?php if(check_departure($_SESSION['from'.$count.'']) || check_arrival($_SESSION['from'.$count.'']) || check_departure($_SESSION['to'.$count.'']) || check_arrival($_SESSION['to'.$count.''])) { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong><strong>
                  <?php if (check_arrival($_SESSION['from'.$count.''])) { echo "Arriving"; } else { echo "Departing"; }; ?>
                </strong> Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">
                <?php echo $_SESSION['airline'.$count.'']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['flight_number'.$count.''];?></td>
              </tr>
              <?php } ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong><?php if(check_departure($_SESSION['from'.$count.'']) || check_arrival($_SESSION['from'.$count.'']) || check_departure($_SESSION['to'.$count.'']) || check_arrival($_SESSION['to'.$count.''])) { if (check_arrival($_SESSION['from'.$count.''])) { echo "Arriving"; } else { echo "Departing"; }; } else { echo "Pickup"; }; ?> at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $_SESSION['h'.$count.''];?>:<?php echo $_SESSION['m'.$count.''];?> <?php echo $_SESSION['ampm'.$count.''];?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $to[$count]['name']; ?></td>
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
          <td class="footer">&nbsp;</td>
        </tr>
      </table>
      <br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr>
        	<td align="left" class="ot"><a href="reserve_step3.php" title="Back"><img src="images/back.png" title="Back" border="0" /></a>
            </td>
            <td align="center" valign="middle">
           <img src="images/secure_site.jpg" border="0" alt="THIS IS A SECURE SITE" title="THIS IS A SECURE SITE" />
        	</td>
            <td align="right" class="ot"><input src="images/check_out_now.jpg" border="0" type="image">
            </td>
        </tr>
      </table>  
    </div>
                  </div>
                <br />
    </div>
</div>
</form>
<!--End ContentPanl Here -->
<div id="Clear"> </div>
<!--Start Footer Here -->
        <div id="Footer">
          <?php include("includes/common/footer.php"); ?>
</div>
	<div align="center" style="padding:5px;">
    Designed by: <a href="http://www.imperialwebsolutions.net/" target="_blank">Imperial Web Solutions</a>
    | For Support Click <a href="mailto:support@sunstatelimo.com">Here</a>
    </div>
<!--End Footer Here -->
</div>

<map name="Map" id="Map"><area shape="rect" coords="257,5,276,25" href="index.php" alt="Home page" title="Home page" />
<area shape="rect" coords="284,5,306,25" href="my_account.php" alt="My account" title="My account" />
<area shape="rect" coords="316,6,336,25" href="contact.php" alt="Contact Us" title="Contact Us" /></map>
<a href="http://www.instantssl.com" id="comodoTL">SSL</a>
<script language="JavaScript" type="text/javascript">
COT("https://sunstatelimo.com/images/cot.gif", "SC2", "none");
</script>
</body>
</html>
