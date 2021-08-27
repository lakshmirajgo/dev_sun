<?php

session_start();

if (!empty($_POST)) {
$_SESSION['step2'] = '1';
};


if (!isset($_SESSION['step2'])) {
header ("Location: https://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve.php");
// Quit the script
exit(); 
}

include ("includes/functions/general_functions.php");
include ("includes/functions/location_functions.php");
include ("includes/functions/price_functions.php");
include ("includes/functions/vehicle_functions.php");
include_once("includes/functions/trip_type_functions.php");	

//print_r($_SESSION);
$company_info = get_company_info(); 
if (empty($_SESSION['step3'])) {
	$_SESSION['vehicle'] = $_POST["vehicle"];
	$_SESSION['trip_type']= $_POST["trip_type"];
	$_SESSION['trip_type_new'] = $_POST['trip_type_new'];
	$_SESSION['travel_date']= $_POST["travel_date"];
	$_SESSION['passenger_count']= $_POST["passenger_count"];
	$_SESSION['child_carseat']= $_POST["child_carseat"];
	$_SESSION['child_boosterseat']= $_POST["child_boosterseat"];
	$_SESSION['store_stop']= $_POST["store_stop"];
	if (!empty($_POST["from"])) {
		$_SESSION['from']= $_POST["from"];
	};
	if (!empty($_POST["to"])) {
		$_SESSION['to']= $_POST["to"];
	};
	
	if ($_SESSION['trip_type'] == '7' || $_SESSION['trip_type'] == '8' || $_SESSION['trip_type'] == '10') {
	$_SESSION['location1']= $_POST["location1"];
	$_SESSION['location2']= $_POST["location2"];
	$_SESSION['location3']= $_POST["location3"];
	};	

};

// Get locations Info BEGIN
$from = get_locations_view($_SESSION['from']);
$to = get_locations_view($_SESSION['to']);
// Get locations Info END

$one_way = get_prices_view_local($_SESSION['vehicle'], '1', $from['zone_id'], $to['zone_id']);
$round_trip = get_prices_view_local($_SESSION['vehicle'], '2', $from['zone_id'], $to['zone_id']);
$transfer = get_prices_view($_SESSION['vehicle'], $_SESSION['trip_type']);
$vehicle = get_vehicles_view($_SESSION['vehicle']);

//Special prices for Shades of Green Round trip BEGIN
if (!empty($_SESSION['shadesofgreen'])) {

		$calculate_total_sog = get_prices_sog_view($_SESSION['vehicle'], $_SESSION['from'], $_SESSION['to']);
	
		//print_r($calculate_total_sog);
		//exit;
	
		if (!empty($calculate_total_sog)) {
			//One Way BEGIN
			if ($_POST['trip_type'] =='1') {
				if ($calculate_total_sog['oneway_price'] !='0') {
				$one_way['price_value'] = $calculate_total_sog['oneway_price'];
				} else {
				$calculate_total_sog = $calculate_total_sog['roundtrip_price']/2;
				$one_way['price_value'] = $calculate_total_sog;
				}
			}
			
			//Round Trip BEGIN
			if ($_POST['trip_type'] =='2') {
				if ($calculate_total_sog['roundtrip_price'] !='0') {
				$round_trip['price_value'] = $calculate_total_sog['roundtrip_price'];
				} else {
				$calculate_total_sog = $calculate_total_sog['oneway_price']*2;
				$round_trip['price_value'] = $calculate_total_sog;
				}
			}
		}
};

//Special prices for Shades of Green Round trip END

// Prepare a reservation details BEGIN
$trip_type = get_trip_types_view($_SESSION['trip_type']);



//Get num of legs from trip types table
$_SESSION['num_legs'] = $trip_type['num_legs'];


//Special for Shades of Green Round trip BEGIN
if ($_SESSION['trip_type_new'] == '2') {
$_SESSION['num_legs'] = $_SESSION['num_legs']+1;
};
//Special for Shades of Green Round trip END


$num_legs = $_SESSION['num_legs'];

$_SESSION['from1'] = $_SESSION['from'];
$_SESSION['to1'] = $_SESSION['to'];
if ($num_legs == '2') {
$_SESSION['from2'] = $_SESSION['to'];
$_SESSION['to2'] = $_SESSION['from'];
	//New modification by Alexey 23 Apr 2009 BEGIN
	if (empty($_SESSION['to']) && empty($_SESSION['from'])) {
	$_SESSION['from1']= $_POST["location1"];
	$_SESSION['to1']= $_POST["location2"];
	$_SESSION['from2']= $_POST["location2"];
	$_SESSION['to2']= $_POST["location3"];
	}
	//New modification by Alexey 23 Apr 2009 END
};
if ($num_legs == '3') {
$_SESSION['from1']= $_POST["location1"];
$_SESSION['to1']= $_POST["location2"];
$_SESSION['from2']= $_POST["location2"];
$_SESSION['to2']= $_POST["location3"];
$_SESSION['from3']= $_POST["location3"];
$_SESSION['to3']= $_POST["location1"];
};
//for ($count =1; $count <= $num_legs; $count += 1) {
//$_SESSION['from'.$count.''] = $_SESSION['from'];
//}
// Prepare a reservation details END

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>rlando's Airport Premier Transportation Services - Reserve Online</title>
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
window.location = "https://www.sunstatelimo.com/reserve_step2.php";
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
<form id="reserve" style="padding-bottom:0px;" name="reserve" method="post" action="reserve_step3.php">
<div id="ContentPanel"> 
	<div id="CenterColumn"> 
     <div align="center">
    <img src="images/status_bar2.jpg" border="0" />
    </div>
    <br />
<div id="NormalText" class="NormalText"> 

			<div id="Box2" class="Box">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="top" align="center">Transportation foor <?php echo $_SESSION['passenger_count']; ?> passenger(s)</td>
        </tr>
        <tr>
          <td class="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="100%" valign="top">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <?php if ($_SESSION['trip_type'] == '1' || $_SESSION['trip_type'] == '2') { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $from['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $to['name']; ?></td>
              </tr>
              <?php } ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><span class="date"><?php echo $_SESSION['travel_date']; ?></span></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Vehicle:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $vehicle['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Passengers:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $_SESSION['passenger_count']; ?></td>
              </tr>
              <?php if (!empty($_SESSION['child_carseat'])) { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Car Seat:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $_SESSION['child_carseat']; ?></td>
              </tr>
              <?php } ?>
              <?php if (!empty($_SESSION['child_boosterseat'])) { ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="obm"><strong>Booster Seat:</strong></td>
                <td align="left" height="20" width="62%" class="ot2m"><?php echo $_SESSION['child_boosterseat']; ?></td>
              </tr>
              <?php } ?>
              </table>
              </td>
            </tr>
          </table>
          <br />
          <table width="100%" border="0" cellspacing="1" cellpadding="0" class="BorderBox">
            <tr>
              <td colspan="2" width="100%" valign="top" align="center" bgcolor="#ffff82" class="ot">
              <h2>Price Quote</h2>
              </td>
            </tr>
            <?php if ($_SESSION['trip_type'] == '2' || $_SESSION['trip_type'] == '1') { ?>
            <?php if ($_SESSION['trip_type'] == '2') { ?>
            <tr>
              <td width="100%" colspan="2" align="center" bgcolor="#d7e0e4" class="ot"><strong>Orlando Area - Round Trip</strong></td>
            </tr>
            <tr>
              <td width="100%" colspan="2" align="center" bgcolor="#FFFFFF" class="ot"><span class="price"><?php if (!empty($round_trip['price_value'])) { echo "$".sprintf("%01.2f", $round_trip['price_value']); } else { echo "Rate not found"; }; ?></span></td>
            </tr>
            <?php }
             if ($_SESSION['trip_type'] == '1') { ?> 
             <tr>
              <td width="100%" colspan="2" align="center" bgcolor="#d7e0e4" class="ot"><strong>Orlando Area - One Way</strong></td>
            </tr> 
            <tr>
              <td width="100%" colspan="2" align="center" bgcolor="#FFFFFF" class="ot"><span class="price"><?php if (!empty($one_way['price_value'])) { echo "$".sprintf("%01.2f", $one_way['price_value']); } else { echo "Rate not found"; }; ?></span></td>
            </tr>
            <?php } 
			} else {
			?>
            <tr>
              <td width="100%" colspan="2" align="center" bgcolor="#d7e0e4" class="ot"><strong><?php $trip_type = get_trip_types_view($_SESSION['trip_type']);
			  //Special prices for Shades of Green Round trip BEGIN
			  if ($_SESSION['trip_type_new'] == '2') {
			  $trip_type['name'] = 'Round trip: '.$trip_type['name'];
			  };
			  //Special prices for Shades of Green Round trip END
			  echo $trip_type['name']; ?></strong></td>
            </tr>
            <tr>
              <td width="100%" align="center" bgcolor="#FFFFFF" class="ot" colspan="2"><span class="price"><?php if (!empty($transfer['price_value'])) { echo "$".sprintf("%01.2f", $transfer['price_value']); } else { echo "Rate not found"; }; ?></span></td>
            </tr>
            <?php } ?>
          </table>
          </td>
        </tr>
        <tr>
          <td class="footer">&nbsp;</td>
        </tr>
      </table>
      <div align="center">
        <span style="text-align:center;color:#FF0000;font-weight:bold;">Please note: For round trip  you can enter return date on next step<br />
        The above quote includes everything except your drivers gratuity<br />
          </span></p>
        </div>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr>
        	<td align="left" class="ot"><a href="reserve.php" title="Back"><img src="images/back.png" title="Back" border="0" /></a>
            </td>
            <td align="center" valign="middle">
           <img src="images/secure_site.jpg" border="0" alt="THIS IS A SECURE SITE" title="THIS IS A SECURE SITE" />
        	</td>
            <td align="right" class="ot"><?php
			
			if ($_SESSION['trip_type'] == '1') {
			$myprice = $one_way['price_value']; 
			}
			if ($_SESSION['trip_type'] == '2') {
			$myprice = $round_trip['price_value']; 
			}
			if ($_SESSION['trip_type'] > 2) {
			$myprice = $transfer['price_value']; 
			}
			
			if ($myprice > 1) {
            echo '<input src="images/continue.png" border="0" type="image">';
			};
			?>
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
    Designed by: <a href="http://www.imperialwebsolutions.net/" target="_blank">Imperial Web Solution</a>
    | For Support Click <a href="mailto:support@sunstatelimo.com">Here</a>
    </div>
<!--End Footer Here -->
</div>
<?php
//unset ($_SESSION['step3']);
?>
<map name="Map" id="Map"><area shape="rect" coords="257,5,276,25" href="index.php" alt="Home page" title="Home page" />
<area shape="rect" coords="284,5,306,25" href="my_account.php" alt="My account" title="My account" />
<area shape="rect" coords="316,6,336,25" href="contact.php" alt="Contact Us" title="Contact Us" /></map>
<a href="http://www.instantssl.com" id="comodoTL">SSL</a>
<script language="JavaScript" type="text/javascript">
COT("https://sunstatelimo.com/images/cot.gif", "SC2", "none");
</script>
</body>
</html>
