<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/location_functions.php");
include ("includes/functions/price_functions.php");
include_once("includes/functions/trip_type_functions.php");	

$company_info = get_company_info(); 
if ($_SESSION['auth'] != '1') {
header ("Location: create_account.php?redirect=reserve_step3.php");
};

if (!empty($_POST)) {
$_SESSION['step3'] = '1';
};

if (!isset($_SESSION['step3'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve.php");
// Quit the script
exit(); 
}

if (!isset($_SESSION['trip_type'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/reserve.php");
// Quit the script
exit(); 
}

if ($_SESSION['from'] == '1a' || $_SESSION['from'] == '2a') {
$from = get_airports_view($_SESSION['from']);
} else {
	if ($_SESSION['from'] == '1c' || $_SESSION['from'] == '2c' || $_SESSION['from'] == '3c' || $_SESSION['from'] == '4c' || $_SESSION['from'] == '5c' || $_SESSION['from'] == '6c' || $_SESSION['from'] == '7c' || $_SESSION['from'] == '8c') {
	$from = get_cruises_view($_SESSION['from']);
	} else {
	$from = get_locations_view($_SESSION['from']);
	};
};

if ($_SESSION['to'] == '1a' || $_SESSION['to'] == '2a') {
$to = get_airports_view($_SESSION['to']);
} else {
	if ($_SESSION['to'] == '1c' || $_SESSION['to'] == '2c' || $_SESSION['to'] == '3c' || $_SESSION['to'] == '4c' || $_SESSION['to'] == '5c' || $_SESSION['to'] == '6c' || $_SESSION['to'] == '7c' || $_SESSION['to'] == '8c') {
	$to = get_cruises_view($_SESSION['to']);
	} else {
$to = get_locations_view($_SESSION['to']);
	};
};

$from1 = get_airports_view($_SESSION['location1']);
$to1 = get_locations_view($_SESSION['location2']);
if ($_SESSION['trip_type'] == '7') {
$from2 = get_locations_view($_SESSION['location2']);
$to2 = get_cruises_view($_SESSION['location3']);
$from3 = get_cruises_view($_SESSION['location3']);
}
if ($_SESSION['trip_type'] == '8' || $_SESSION['trip_type'] == '10') {
$to1 = get_cruises_view($_SESSION['location3']);
$from2 = get_cruises_view($_SESSION['location3']);
$to2 = get_locations_view($_SESSION['location2']);
$from3 = get_locations_view($_SESSION['location2']);
}
$to4 = get_airports_view($_SESSION['location1']);

if ($_SESSION['trip_type'] > 2) {
$transfer = get_prices_view($_SESSION['vehicle'], $_SESSION['trip_type']);
} else {
$price_local = get_prices_view_local($_SESSION['vehicle'], $_SESSION['trip_type'], $from['zone_id'], $to['zone_id']);
};
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
</head>
<body onload="MM_preloadImages('images/fleet_active.gif','images/faq_active.gif','images/contact_active.gif','images/home_active.gif','images/rates_active.gif','images/testimonials_active.gif'); hidefields();">
<div id="Wrapper"> 
 <!--Start Header Here -->
    	<div id="Header">
    	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="19%" valign="middle"><img src="images/sunstate.gif" alt="Sunstate" /></td>
              <td width="81%" align="right"><img src="images/topRightCars.jpg" width="367" height="102" border="0" usemap="#Map" /></td>
            </tr>
          </table>
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
<?php if ($_SESSION['trip_type'] > 2) {
echo '<img src="images/header_cruise.jpg" />';
} else {
echo '<img src="images/banner.jpg" />';
}
?>
</div>
<!--Start ContentPanl Here -->
<form id="reserve" style="padding-bottom:0px;" name="reserve" method="post" action="reserve_step4.php">
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
          <td class="top" align="center">Transportation for <?php echo $_SESSION['passenger_count']; ?> passenger(s)</td>
        </tr>
        <tr>
          <td class="middle">
          <?php if ($_SESSION['trip_type'] == '1' || $_SESSION['trip_type'] == '2' || $_SESSION['trip_type'] == '3' || $_SESSION['trip_type'] == '4' || $_SESSION['trip_type'] == '5' || $_SESSION['trip_type'] == '6' || $_SESSION['trip_type'] == '9' || $_SESSION['trip_type'] == '11') { ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
           	  <td width="100%" class="ot">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><span class="date"><?php echo $_SESSION['travel_date']; ?></span></td>
              </tr>
              <?php 
              if ($_SESSION['from'] != '1a' && $_SESSION['from'] != '2a' && $_SESSION['to'] != '1a' && $_SESSION['to'] != '2a') { ?>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="h" size="1"><?php if (!empty($_SESSION['h'])) { echo '<option value="'.$_SESSION['h'].'">'.$_SESSION['h'].'</option>'; } ;?><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12" selected="selected">12</option></select><select name="m" size="1"><?php if (!empty($_SESSION['m'])) { echo '<option value="'.$_SESSION['m'].'">'.$_SESSION['m'].'</option>'; } ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm" size="1"><?php if (!empty($_SESSION['ampm'])) { echo '<option value="'.$_SESSION['ampm'].'">'.$_SESSION['ampm'].'</option>'; } ;?><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <?php } ?>
              <?php
              //Show Flight details BEGIN
			  if ($_SESSION['from'] == '1a' || $_SESSION['from'] == '2a') { ?>
              <tr>
            	<td class="ot" colspan="2" align="center">
                Select your Airline from the list below.</td>
            </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="arriving_airline" size="1">
                <?php if (!empty($_SESSION['arriving_airline'])) { echo '<option value="'.$_SESSION['arriving_airline'].'">'.$_SESSION['arriving_airline'].'</option>'; } ;?>
																													<?php if ($_SESSION['from'] == '2a') { ?>
                                                                                                                    <option value="Allegiant Air">Allegiant Air</option>
                                                                                                                    <option value="Direct Air">Direct Air</option>
                                                                                                                    <option value="flyglobespan">flyglobespan</option>
                                                                                                                    <option value="Icelandair">Icelandair</option>
                                                                                                                    <option value="Jetairfly">Jetairfly</option>
                                                                                                                    <option value="First Choice (Air 2000)">First Choice (Air 2000)</option>																										<option value="Monarch">Monarch</option>
                                                                                                                    <option value="Thomas Cook">Thomas Cook</option>
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
                                                                                                                    <?php } else { ?>
																													<option value="Aer Lingus">Aer Lingus</option>
																													<option value="Aeromexico">Aeromexico</option>
																													<option value="Air Canada">Air Canada</option>
																													<option value="Air Europa">Air Europa</option>

																													<option value="Air France">Air France</option>

																													<option value="Air Jamaica">Air Jamaica</option>
																													<option value="Air New Zealand">Air New Zealand</option>
																													<option value="Air One">Air One</option>
																													<option value="Air Transat A.T.Inc.">Air Transat A.T.Inc.</option>
																													<option value="AirTran Airways">AirTran Airways</option>

																													<option value="Alaska Airlines">Alaska Airlines</option>

																													<option value="Alitalia">Alitalia</option>
																													<option value="All Nippon Airways">All Nippon Airways</option>
                                                                                                                    
																													<option value="American Airlines">American Airlines</option>
																													<option value="Asiana Airlines">Asiana Airlines</option>
																													<option value="Austrian Airlines AG">Austrian Airlines AG</option>

																													<option value="Bahamasair">Bahamasair</option>
                                                                                                                    <option value="bmi british midland">bmi British Midland</option>

																													<option value="British Airways">British Airways</option>
																													<option value="Brussels Airlines">Brussels Airlines</option>
																													<option value="Cathay Pacific Airways">Cathay Pacific Airways</option>
																													<option value="China Airlines">China Airlines</option>
																													<option value="China Southern Airlines">China Southern Airlines</option>

																													<option value="Continental Airlines">Continental Airlines</option>

																													<option value="Copa Airlines">Copa Airlines</option>
																													<option value="Czech Airlines">Czech Airlines</option>
																													<option value="Delta Air Lines">Delta Air Lines</option>
                                                                                                                    
                                                                                                                    
																													<option value="Frontier Airlines Inc.">Frontier Airlines Inc.</option>
																													<option value="Iberia">Iberia</option>
                                                                                                                    

																													<option value="Japan Airlines International">Japan Airlines International</option>
																												    
																													<option value="JetBlue Airways Corporation">JetBlue Airways Corporation</option>
																													<option value="Korean Air">Korean Air</option>
																													<option value="KLM-Royal Dutch Airlines">KLM-Royal Dutch Airlines</option>
																													<option value="Lan Airlines">Lan Airlines</option>
																													<option value="Lan Peru">Lan Peru</option>

																													<option value="Lufthansa German Airlines">Lufthansa German Airlines</option>

																													<option value="LOT - Polish Airlines">LOT - Polish Airlines</option>
																													<option value="Mexicana de Aviacion">Mexicana de Aviacion</option>
																													<option value="Midwest Airlines">Midwest Airlines</option>
																													<option value="MALEV Hungarian Airlines">MALEV Hungarian Airlines</option>																									
																													<option value="Northwest Airlines">Northwest Airlines</option>

																													<option value="Qantas Airways">Qantas Airways</option>

																													<option value="Qatar Airways">Qatar Airways</option>
																													<option value="Royal Air Maroc">Royal Air Maroc</option>
																													<option value="Singapore Airlines">Singapore Airlines</option>
																													<option value="South African Airways">South African Airways</option>
																													<option value="Southwest Airlines">Southwest Airlines</option>

																													<option value="Spirit Airlines">Spirit Airlines</option>

																													<option value="Sun Country Airlines">Sun Country Airlines</option>
																													<option value="Sunwing Airlines Inc.">Sunwing Airlines Inc.</option>
																													<option value="Swiss">Swiss</option>
																													<option value="SAS Scandinavian Airlines">SAS Scandinavian Airlines</option>
																													<option value="TAM Linhas Aereas">TAM Linhas Aereas</option>

																													<option value="TAP Air Portugal">TAP Air Portugal</option>
																													
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
																													<option value="United Airlines">United Airlines</option>
																													<option value="US Airways">US Airways</option>
																													<option value="Virgin Atlantic Airways">Virgin Atlantic Airways</option>
																													<option value="Westjet">Westjet</option>
                                                                                                                    <?php } ?>
																												</select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><input name="flight_number" class="bodytxt" size="10" type="text" value="<?php echo $_SESSION['flight_number'];?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="h1" size="1"><?php if (!empty($_SESSION['h1'])) { echo '<option value="'.$_SESSION['h1'].'">'.$_SESSION['h1'].'</option>'; } ;?><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12" selected="selected">12</option></select><select name="m1" size="1"><?php if (!empty($_SESSION['m1'])) { echo '<option value="'.$_SESSION['m1'].'">'.$_SESSION['m1'].'</option>'; } ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm1" size="1"><?php if (!empty($_SESSION['ampm1'])) { echo '<option value="'.$_SESSION['ampm1'].'">'.$_SESSION['ampm1'].'</option>'; } ;?><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <?php
			  //Show Flight details END
			  }
			  ?>
              <?php 
			  //Show Flight details BEGIN
			  if ($_SESSION['to'] =='1a' || $_SESSION['to'] == '2a') {
			  ?>
              <tr>
            	<td class="ot" colspan="2" align="center">
                Select your Airline from the list below.</td>
            </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="arriving_airline" size="1">
                <?php if (!empty($_SESSION['arriving_airline'])) { echo '<option value="'.$_SESSION['arriving_airline'].'">'.$_SESSION['arriving_airline'].'</option>'; } ;?>																												
																													<?php if ($_SESSION['to'] == '2a') { ?>
                                                                                                                    <option value="Allegiant Air">Allegiant Air</option>
                                                                                                                    <option value="Direct Air">Direct Air</option>
                                                                                                                    <option value="flyglobespan">flyglobespan</option>
                                                                                                                    <option value="Icelandair">Icelandair</option>
                                                                                                                    <option value="Jetairfly">Jetairfly</option>
                                                                                                                    <option value="First Choice (Air 2000)">First Choice (Air 2000)</option>																										<option value="Monarch">Monarch</option>
                                                                                                                    <option value="Thomas Cook">Thomas Cook</option>
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
                                                                                                                    <?php } else { ?>
																													<option value="Aer Lingus">Aer Lingus</option>
																													<option value="Aeromexico">Aeromexico</option>
																													<option value="Air Canada">Air Canada</option>
																													<option value="Air Europa">Air Europa</option>

																													<option value="Air France">Air France</option>

																													<option value="Air Jamaica">Air Jamaica</option>
																													<option value="Air New Zealand">Air New Zealand</option>
																													<option value="Air One">Air One</option>
																													<option value="Air Transat A.T.Inc.">Air Transat A.T.Inc.</option>
																													<option value="AirTran Airways">AirTran Airways</option>

																													<option value="Alaska Airlines">Alaska Airlines</option>

																													<option value="Alitalia">Alitalia</option>
																													<option value="All Nippon Airways">All Nippon Airways</option>
                                                                                                                    
																													<option value="American Airlines">American Airlines</option>
																													<option value="Asiana Airlines">Asiana Airlines</option>
																													<option value="Austrian Airlines AG">Austrian Airlines AG</option>

																													<option value="Bahamasair">Bahamasair</option>
                                                                                                                    <option value="bmi british midland">bmi British Midland</option>

																													<option value="British Airways">British Airways</option>
																													<option value="Brussels Airlines">Brussels Airlines</option>
																													<option value="Cathay Pacific Airways">Cathay Pacific Airways</option>
																													<option value="China Airlines">China Airlines</option>
																													<option value="China Southern Airlines">China Southern Airlines</option>

																													<option value="Continental Airlines">Continental Airlines</option>

																													<option value="Copa Airlines">Copa Airlines</option>
																													<option value="Czech Airlines">Czech Airlines</option>
																													<option value="Delta Air Lines">Delta Air Lines</option>
                                                                                                                    
                                                                                                                    
																													<option value="Frontier Airlines Inc.">Frontier Airlines Inc.</option>
																													<option value="Iberia">Iberia</option>
                                                                                                                    

																													<option value="Japan Airlines International">Japan Airlines International</option>
																												    
																													<option value="JetBlue Airways Corporation">JetBlue Airways Corporation</option>
																													<option value="Korean Air">Korean Air</option>
																													<option value="KLM-Royal Dutch Airlines">KLM-Royal Dutch Airlines</option>
																													<option value="Lan Airlines">Lan Airlines</option>
																													<option value="Lan Peru">Lan Peru</option>

																													<option value="Lufthansa German Airlines">Lufthansa German Airlines</option>

																													<option value="LOT - Polish Airlines">LOT - Polish Airlines</option>
																													<option value="Mexicana de Aviacion">Mexicana de Aviacion</option>
																													<option value="Midwest Airlines">Midwest Airlines</option>
																													<option value="MALEV Hungarian Airlines">MALEV Hungarian Airlines</option>																									
																													<option value="Northwest Airlines">Northwest Airlines</option>

																													<option value="Qantas Airways">Qantas Airways</option>

																													<option value="Qatar Airways">Qatar Airways</option>
																													<option value="Royal Air Maroc">Royal Air Maroc</option>
																													<option value="Singapore Airlines">Singapore Airlines</option>
																													<option value="South African Airways">South African Airways</option>
																													<option value="Southwest Airlines">Southwest Airlines</option>

																													<option value="Spirit Airlines">Spirit Airlines</option>

																													<option value="Sun Country Airlines">Sun Country Airlines</option>
																													<option value="Sunwing Airlines Inc.">Sunwing Airlines Inc.</option>
																													<option value="Swiss">Swiss</option>
																													<option value="SAS Scandinavian Airlines">SAS Scandinavian Airlines</option>
																													<option value="TAM Linhas Aereas">TAM Linhas Aereas</option>

																													<option value="TAP Air Portugal">TAP Air Portugal</option>
																													
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
																													<option value="United Airlines">United Airlines</option>
																													<option value="US Airways">US Airways</option>
																													<option value="Virgin Atlantic Airways">Virgin Atlantic Airways</option>
																													<option value="Westjet">Westjet</option>
                                                                                                                    <?php } ?>
																												</select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><input name="flight_number" class="bodytxt" size="10" type="text" value="<?php echo $_SESSION['flight_number'];?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="h1" size="1"><?php if (!empty($_SESSION['h1'])) { echo '<option value="'.$_SESSION['h1'].'">'.$_SESSION['h1'].'</option>'; } ;?><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12" selected="selected">12</option></select><select name="m1" size="1"><?php if (!empty($_SESSION['m1'])) { echo '<option value="'.$_SESSION['m1'].'">'.$_SESSION['m1'].'</option>'; } ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm1" size="1"><?php if (!empty($_SESSION['ampm1'])) { echo '<option value="'.$_SESSION['ampm1'].'">'.$_SESSION['ampm1'].'</option>'; } ;?><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <?php
			  //Show Flight details END
			  }
			  ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $to['name']; ?></td>
              </tr>
              </table>
              </td>
            </tr>
          </table>
          
          <br />
          <table width="100%" border="0" cellspacing="1" cellpadding="0" class="BorderBox">
            <tr>
              <td colspan="2" width="100%" valign="top" align="center" bgcolor="#ffff82" class="ot">
              <strong><?php $trip_type = get_trip_types_view($_SESSION['trip_type']); echo $trip_type['name']; ?></strong>:</strong> <span class="price"><?php if ($_SESSION['trip_type'] > 2) { echo "$".sprintf("%01.2f", $transfer['price_value']); } else { echo "$".sprintf("%01.2f", $price_local['price_value']);}; ?></span>
              </td>
            </tr>
          </table>
          <?php if ($_SESSION['trip_type'] == '2' || $_SESSION['trip_type'] == '4' || $_SESSION['trip_type'] == '6' || $_SESSION['trip_type'] == '11') { ?>
          <br />
          <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $to['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">
                <input value="U" name="datefmt" type="radio" checked="checked" style="display:none;"><input value="W" name="datefmt" type="radio" style="display:none;"><input value="J" name="datefmt" type="radio" style="display:none;"><input value="P" name="daterng" type="radio" style="display:none;"><input value="A" name="daterng" type="radio" style="display:none;"><input value="F" name="daterng" type="radio" checked="checked" style="display:none;">
                <input name="travel_date_roundtrip" type="text" id="travel_date2" size="10" maxlength="10" value="<?php echo $_SESSION['travel_date_roundtrip'];?>">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal2.popup();"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY</td>
              </tr>
              <?php 
              if ($_SESSION['from'] != '1a' && $_SESSION['from'] != '2a' && $_SESSION['to'] != '1a' && $_SESSION['to'] != '2a') { ?>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="h2" size="1"><?php if (!empty($_SESSION['h2'])) { echo '<option value="'.$_SESSION['h2'].'">'.$_SESSION['h2'].'</option>'; } ;?><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12" selected="selected">12</option></select><select name="m2" size="1"><?php if (!empty($_SESSION['m2'])) { echo '<option value="'.$_SESSION['m2'].'">'.$_SESSION['m2'].'</option>'; } ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm2" size="1"><?php if (!empty($_SESSION['ampm2'])) { echo '<option value="'.$_SESSION['ampm2'].'">'.$_SESSION['ampm2'].'</option>'; } ;?><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <?php } ?>
              <?php
              //Show Flight details BEGIN
			  if ($_SESSION['to'] == '1a' || $_SESSION['to'] == '2a') { ?>
              <tr>
            	<td class="ot" colspan="2" align="center">
                Select your Airline from the list below.</td>
            </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="departing_airline_roundtrip" size="1">
                <?php if (!empty($_SESSION['departing_airline_roundtrip'])) { echo '<option value="'.$_SESSION['departing_airline_roundtrip'].'">'.$_SESSION['departing_airline_roundtrip'].'</option>'; } ;?>
																													<?php if ($_SESSION['to'] == '2a') { ?>
                                                                                                                    <option value="Allegiant Air">Allegiant Air</option>
                                                                                                                    <option value="Direct Air">Direct Air</option>
                                                                                                                    <option value="flyglobespan">flyglobespan</option>
                                                                                                                    <option value="Icelandair">Icelandair</option>
                                                                                                                    <option value="Jetairfly">Jetairfly</option>
                                                                                                                    <option value="First Choice (Air 2000)">First Choice (Air 2000)</option>																										<option value="Monarch">Monarch</option>
                                                                                                                    <option value="Thomas Cook">Thomas Cook</option>
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
                                                                                                                    <?php } else { ?>
																													<option value="Aer Lingus">Aer Lingus</option>
																													<option value="Aeromexico">Aeromexico</option>
																													<option value="Air Canada">Air Canada</option>
																													<option value="Air Europa">Air Europa</option>

																													<option value="Air France">Air France</option>

																													<option value="Air Jamaica">Air Jamaica</option>
																													<option value="Air New Zealand">Air New Zealand</option>
																													<option value="Air One">Air One</option>
																													<option value="Air Transat A.T.Inc.">Air Transat A.T.Inc.</option>
																													<option value="AirTran Airways">AirTran Airways</option>

																													<option value="Alaska Airlines">Alaska Airlines</option>

																													<option value="Alitalia">Alitalia</option>
																													<option value="All Nippon Airways">All Nippon Airways</option>
                                                                                                                    
																													<option value="American Airlines">American Airlines</option>
																													<option value="Asiana Airlines">Asiana Airlines</option>
																													<option value="Austrian Airlines AG">Austrian Airlines AG</option>

																													<option value="Bahamasair">Bahamasair</option>
                                                                                                                    <option value="bmi british midland">bmi British Midland</option>

																													<option value="British Airways">British Airways</option>
																													<option value="Brussels Airlines">Brussels Airlines</option>
																													<option value="Cathay Pacific Airways">Cathay Pacific Airways</option>
																													<option value="China Airlines">China Airlines</option>
																													<option value="China Southern Airlines">China Southern Airlines</option>

																													<option value="Continental Airlines">Continental Airlines</option>

																													<option value="Copa Airlines">Copa Airlines</option>
																													<option value="Czech Airlines">Czech Airlines</option>
																													<option value="Delta Air Lines">Delta Air Lines</option>
                                                                                                                    
                                                                                                                    
																													<option value="Frontier Airlines Inc.">Frontier Airlines Inc.</option>
																													<option value="Iberia">Iberia</option>
                                                                                                                    

																													<option value="Japan Airlines International">Japan Airlines International</option>
																												    
																													<option value="JetBlue Airways Corporation">JetBlue Airways Corporation</option>
																													<option value="Korean Air">Korean Air</option>
																													<option value="KLM-Royal Dutch Airlines">KLM-Royal Dutch Airlines</option>
																													<option value="Lan Airlines">Lan Airlines</option>
																													<option value="Lan Peru">Lan Peru</option>

																													<option value="Lufthansa German Airlines">Lufthansa German Airlines</option>

																													<option value="LOT - Polish Airlines">LOT - Polish Airlines</option>
																													<option value="Mexicana de Aviacion">Mexicana de Aviacion</option>
																													<option value="Midwest Airlines">Midwest Airlines</option>
																													<option value="MALEV Hungarian Airlines">MALEV Hungarian Airlines</option>																									
																													<option value="Northwest Airlines">Northwest Airlines</option>

																													<option value="Qantas Airways">Qantas Airways</option>

																													<option value="Qatar Airways">Qatar Airways</option>
																													<option value="Royal Air Maroc">Royal Air Maroc</option>
																													<option value="Singapore Airlines">Singapore Airlines</option>
																													<option value="South African Airways">South African Airways</option>
																													<option value="Southwest Airlines">Southwest Airlines</option>

																													<option value="Spirit Airlines">Spirit Airlines</option>

																													<option value="Sun Country Airlines">Sun Country Airlines</option>
																													<option value="Sunwing Airlines Inc.">Sunwing Airlines Inc.</option>
																													<option value="Swiss">Swiss</option>
																													<option value="SAS Scandinavian Airlines">SAS Scandinavian Airlines</option>
																													<option value="TAM Linhas Aereas">TAM Linhas Aereas</option>

																													<option value="TAP Air Portugal">TAP Air Portugal</option>
																													
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
																													<option value="United Airlines">United Airlines</option>
																													<option value="US Airways">US Airways</option>
																													<option value="Virgin Atlantic Airways">Virgin Atlantic Airways</option>
																													<option value="Westjet">Westjet</option>
                                                                                                                    <?php } ?>
																												</select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><input name="flight_number_roundtrip" class="bodytxt" size="10" type="text" value="<?php echo $_SESSION['flight_number_roundtrip'];?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="h3" size="1"><?php if (!empty($_SESSION['h3'])) { echo '<option value="'.$_SESSION['h3'].'">'.$_SESSION['h3'].'</option>'; } ;?><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12" selected="selected">12</option></select><select name="m3" size="1"><?php if (!empty($_SESSION['m3'])) { echo '<option value="'.$_SESSION['m3'].'">'.$_SESSION['m3'].'</option>'; } ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm3" size="1"><?php if (!empty($_SESSION['ampm3'])) { echo '<option value="'.$_SESSION['ampm3'].'">'.$_SESSION['ampm3'].'</option>'; } ;?><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <?php
			  //Show Flight details END
			  }
			  ?>
              <?php 
			  //Show Flight details BEGIN
			  if ($_SESSION['from'] =='1a' || $_SESSION['from'] == '2a') {
			  ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="departing_airline_roundtrip" size="1">
                <?php if (!empty($_SESSION['departing_airline_roundtrip'])) { echo '<option value="'.$_SESSION['departing_airline_roundtrip'].'">'.$_SESSION['departing_airline_roundtrip'].'</option>'; } ;?>																													
																													<?php if ($_SESSION['from'] == '2a') { ?>
                                                                                                                    <option value="Allegiant Air">Allegiant Air</option>
                                                                                                                    <option value="Direct Air">Direct Air</option>
                                                                                                                    <option value="flyglobespan">flyglobespan</option>
                                                                                                                    <option value="Icelandair">Icelandair</option>
                                                                                                                    <option value="Jetairfly">Jetairfly</option>
                                                                                                                    <option value="First Choice (Air 2000)">First Choice (Air 2000)</option>																										<option value="Monarch">Monarch</option>
                                                                                                                    <option value="Thomas Cook">Thomas Cook</option>
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
                                                                                                                    <?php } else { ?>
																													<option value="Aer Lingus">Aer Lingus</option>
																													<option value="Aeromexico">Aeromexico</option>
																													<option value="Air Canada">Air Canada</option>
																													<option value="Air Europa">Air Europa</option>

																													<option value="Air France">Air France</option>

																													<option value="Air Jamaica">Air Jamaica</option>
																													<option value="Air New Zealand">Air New Zealand</option>
																													<option value="Air One">Air One</option>
																													<option value="Air Transat A.T.Inc.">Air Transat A.T.Inc.</option>
																													<option value="AirTran Airways">AirTran Airways</option>

																													<option value="Alaska Airlines">Alaska Airlines</option>

																													<option value="Alitalia">Alitalia</option>
																													<option value="All Nippon Airways">All Nippon Airways</option>
                                                                                                                    
																													<option value="American Airlines">American Airlines</option>
																													<option value="Asiana Airlines">Asiana Airlines</option>
																													<option value="Austrian Airlines AG">Austrian Airlines AG</option>

																													<option value="Bahamasair">Bahamasair</option>
                                                                                                                    <option value="bmi british midland">bmi British Midland</option>

																													<option value="British Airways">British Airways</option>
																													<option value="Brussels Airlines">Brussels Airlines</option>
																													<option value="Cathay Pacific Airways">Cathay Pacific Airways</option>
																													<option value="China Airlines">China Airlines</option>
																													<option value="China Southern Airlines">China Southern Airlines</option>

																													<option value="Continental Airlines">Continental Airlines</option>

																													<option value="Copa Airlines">Copa Airlines</option>
																													<option value="Czech Airlines">Czech Airlines</option>
																													<option value="Delta Air Lines">Delta Air Lines</option>
                                                                                                                    
                                                                                                                    
																													<option value="Frontier Airlines Inc.">Frontier Airlines Inc.</option>
																													<option value="Iberia">Iberia</option>
                                                                                                                    

																													<option value="Japan Airlines International">Japan Airlines International</option>
																												    
																													<option value="JetBlue Airways Corporation">JetBlue Airways Corporation</option>
																													<option value="Korean Air">Korean Air</option>
																													<option value="KLM-Royal Dutch Airlines">KLM-Royal Dutch Airlines</option>
																													<option value="Lan Airlines">Lan Airlines</option>
																													<option value="Lan Peru">Lan Peru</option>

																													<option value="Lufthansa German Airlines">Lufthansa German Airlines</option>

																													<option value="LOT - Polish Airlines">LOT - Polish Airlines</option>
																													<option value="Mexicana de Aviacion">Mexicana de Aviacion</option>
																													<option value="Midwest Airlines">Midwest Airlines</option>
																													<option value="MALEV Hungarian Airlines">MALEV Hungarian Airlines</option>																									
																													<option value="Northwest Airlines">Northwest Airlines</option>

																													<option value="Qantas Airways">Qantas Airways</option>

																													<option value="Qatar Airways">Qatar Airways</option>
																													<option value="Royal Air Maroc">Royal Air Maroc</option>
																													<option value="Singapore Airlines">Singapore Airlines</option>
																													<option value="South African Airways">South African Airways</option>
																													<option value="Southwest Airlines">Southwest Airlines</option>

																													<option value="Spirit Airlines">Spirit Airlines</option>

																													<option value="Sun Country Airlines">Sun Country Airlines</option>
																													<option value="Sunwing Airlines Inc.">Sunwing Airlines Inc.</option>
																													<option value="Swiss">Swiss</option>
																													<option value="SAS Scandinavian Airlines">SAS Scandinavian Airlines</option>
																													<option value="TAM Linhas Aereas">TAM Linhas Aereas</option>

																													<option value="TAP Air Portugal">TAP Air Portugal</option>
																													
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
																													<option value="United Airlines">United Airlines</option>
																													<option value="US Airways">US Airways</option>
																													<option value="Virgin Atlantic Airways">Virgin Atlantic Airways</option>
																													<option value="Westjet">Westjet</option>
                                                                                                                    <?php } ?>
																												</select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><input name="flight_number_roundtrip" class="bodytxt" size="10" type="text" value="<?php echo $_SESSION['flight_number_roundtrip'];?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="h3" size="1"><?php if (!empty($_SESSION['h3'])) { echo '<option value="'.$_SESSION['h3'].'">'.$_SESSION['h3'].'</option>'; } ;?><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12" selected="selected">12</option></select><select name="m3" size="1"><?php if (!empty($_SESSION['m3'])) { echo '<option value="'.$_SESSION['m3'].'">'.$_SESSION['m3'].'</option>'; } ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm3" size="1"><?php if (!empty($_SESSION['ampm3'])) { echo '<option value="'.$_SESSION['ampm3'].'">'.$_SESSION['ampm3'].'</option>'; } ;?><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <?php
			  //Show Flight details END
			  }
			  ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from['name']; ?></td>
              </tr>
              </table>
              <script language="JavaScript">
<!-- // create calendar object(s) just after form tag closed
	 // specify form element as the only parameter (document.forms['formname'].elements['inputname']);
	 // note: you can have as many calendar objects as you need for your application
	var cal2 = new calendar2(document.forms['reserve'].elements['travel_date_roundtrip']);
	cal2.year_scroll = true;
	cal2.time_comp = false;
//-->
</script>
              <?php } ?>
          
		  <?php
		  // For Transfers BEGIN
		   } else { 
		   
		   if ($_SESSION['trip_type'] == '7' || $_SESSION['trip_type'] == '8' || $_SESSION['trip_type'] == '10') {
		   ?>
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from1['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><span class="date"><?php echo $_SESSION['travel_date']; ?></span></td>
              </tr>
              <tr>
            	<td class="ot" colspan="2" align="center">
                Select your Airline from the list below.</td>
            </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="arriving_airline" size="1">
                <?php if (!empty($_SESSION['arriving_airline'])) { echo '<option value="'.$_SESSION['arriving_airline'].'">'.$_SESSION['arriving_airline'].'</option>'; } ;?>
																													
																													<?php if ($_SESSION['trip_type'] == '10') { ?>
                                                                                                                    <option value="Allegiant Air">Allegiant Air</option>
                                                                                                                    <option value="Direct Air">Direct Air</option>
                                                                                                                    <option value="flyglobespan">flyglobespan</option>
                                                                                                                    <option value="Icelandair">Icelandair</option>
                                                                                                                    <option value="Jetairfly">Jetairfly</option>
                                                                                                                    <option value="First Choice (Air 2000)">First Choice (Air 2000)</option>																										<option value="Monarch">Monarch</option>
                                                                                                                    <option value="Thomas Cook">Thomas Cook</option>
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
                                                                                                                    <?php } else { ?>
																													<option value="Aer Lingus">Aer Lingus</option>
																													<option value="Aeromexico">Aeromexico</option>
																													<option value="Air Canada">Air Canada</option>
																													<option value="Air Europa">Air Europa</option>

																													<option value="Air France">Air France</option>

																													<option value="Air Jamaica">Air Jamaica</option>
																													<option value="Air New Zealand">Air New Zealand</option>
																													<option value="Air One">Air One</option>
																													<option value="Air Transat A.T.Inc.">Air Transat A.T.Inc.</option>
																													<option value="AirTran Airways">AirTran Airways</option>

																													<option value="Alaska Airlines">Alaska Airlines</option>

																													<option value="Alitalia">Alitalia</option>
																													<option value="All Nippon Airways">All Nippon Airways</option>
                                                                                                                    
																													<option value="American Airlines">American Airlines</option>
																													<option value="Asiana Airlines">Asiana Airlines</option>
																													<option value="Austrian Airlines AG">Austrian Airlines AG</option>

																													<option value="Bahamasair">Bahamasair</option>
                                                                                                                    <option value="bmi british midland">bmi British Midland</option>

																													<option value="British Airways">British Airways</option>
																													<option value="Brussels Airlines">Brussels Airlines</option>
																													<option value="Cathay Pacific Airways">Cathay Pacific Airways</option>
																													<option value="China Airlines">China Airlines</option>
																													<option value="China Southern Airlines">China Southern Airlines</option>

																													<option value="Continental Airlines">Continental Airlines</option>

																													<option value="Copa Airlines">Copa Airlines</option>
																													<option value="Czech Airlines">Czech Airlines</option>
																													<option value="Delta Air Lines">Delta Air Lines</option>
                                                                                                                    
                                                                                                                    
																													<option value="Frontier Airlines Inc.">Frontier Airlines Inc.</option>
																													<option value="Iberia">Iberia</option>
                                                                                                                    

																													<option value="Japan Airlines International">Japan Airlines International</option>
																												    
																													<option value="JetBlue Airways Corporation">JetBlue Airways Corporation</option>
																													<option value="Korean Air">Korean Air</option>
																													<option value="KLM-Royal Dutch Airlines">KLM-Royal Dutch Airlines</option>
																													<option value="Lan Airlines">Lan Airlines</option>
																													<option value="Lan Peru">Lan Peru</option>

																													<option value="Lufthansa German Airlines">Lufthansa German Airlines</option>

																													<option value="LOT - Polish Airlines">LOT - Polish Airlines</option>
																													<option value="Mexicana de Aviacion">Mexicana de Aviacion</option>
																													<option value="Midwest Airlines">Midwest Airlines</option>
																													<option value="MALEV Hungarian Airlines">MALEV Hungarian Airlines</option>																									
																													<option value="Northwest Airlines">Northwest Airlines</option>

																													<option value="Qantas Airways">Qantas Airways</option>

																													<option value="Qatar Airways">Qatar Airways</option>
																													<option value="Royal Air Maroc">Royal Air Maroc</option>
																													<option value="Singapore Airlines">Singapore Airlines</option>
																													<option value="South African Airways">South African Airways</option>
																													<option value="Southwest Airlines">Southwest Airlines</option>

																													<option value="Spirit Airlines">Spirit Airlines</option>

																													<option value="Sun Country Airlines">Sun Country Airlines</option>
																													<option value="Sunwing Airlines Inc.">Sunwing Airlines Inc.</option>
																													<option value="Swiss">Swiss</option>
																													<option value="SAS Scandinavian Airlines">SAS Scandinavian Airlines</option>
																													<option value="TAM Linhas Aereas">TAM Linhas Aereas</option>

																													<option value="TAP Air Portugal">TAP Air Portugal</option>
																													
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
																													<option value="United Airlines">United Airlines</option>
																													<option value="US Airways">US Airways</option>
																													<option value="Virgin Atlantic Airways">Virgin Atlantic Airways</option>
																													<option value="Westjet">Westjet</option>
                                                                                                                    <?php } ?>
																												</select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><input name="flight_number" class="bodytxt" size="10" type="text" value="<?php echo $_SESSION['flight_number'];?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Arriving at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="h1" size="1"><?php if (!empty($_SESSION['h1'])) { echo '<option value="'.$_SESSION['h1'].'">'.$_SESSION['h1'].'</option>'; } ;?><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12" selected="selected">12</option></select><select name="m1" size="1"><?php if (!empty($_SESSION['m1'])) { echo '<option value="'.$_SESSION['m1'].'">'.$_SESSION['m1'].'</option>'; } ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm1" size="1"><?php if (!empty($_SESSION['ampm1'])) { echo '<option value="'.$_SESSION['ampm1'].'">'.$_SESSION['ampm1'].'</option>'; } ;?><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $to1['name']; ?></td>
              </tr>
           </table>
           <br /><br />
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from2['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">
                <input value="U" name="datefmt" type="radio" checked="checked" style="display:none;"><input value="W" name="datefmt" type="radio" style="display:none;"><input value="J" name="datefmt" type="radio" style="display:none;"><input value="P" name="daterng" type="radio" style="display:none;"><input value="A" name="daterng" type="radio" style="display:none;"><input value="F" name="daterng" type="radio" checked="checked" style="display:none;">
                <input name="travel_date_extra" type="text" id="travel_date_extra" size="10" maxlength="10" value="<?php echo $_SESSION['travel_date_extra'];?>">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal3.popup();"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY</td>
              </tr>
              <?php 
              if ($_SESSION['from'] != '1a' && $_SESSION['from'] != '2a' && $_SESSION['to'] != '1a' && $_SESSION['to'] != '2a') { ?>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="h4" size="1"><?php if (!empty($_SESSION['h4'])) { echo '<option value="'.$_SESSION['h4'].'">'.$_SESSION['h4'].'</option>'; } ;?><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12" selected="selected">12</option></select><select name="m4" size="1"><?php if (!empty($_SESSION['m4'])) { echo '<option value="'.$_SESSION['m4'].'">'.$_SESSION['m4'].'</option>'; } ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm4" size="1"><?php if (!empty($_SESSION['ampm4'])) { echo '<option value="'.$_SESSION['ampm4'].'">'.$_SESSION['ampm4'].'</option>'; } ;?><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <?php } ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $to2['name']; ?></td>
              </tr>
           </table>
           <br /><br />
           <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from3['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">
                <input value="U" name="datefmt" type="radio" checked="checked" style="display:none;"><input value="W" name="datefmt" type="radio" style="display:none;"><input value="J" name="datefmt" type="radio" style="display:none;"><input value="P" name="daterng" type="radio" style="display:none;"><input value="A" name="daterng" type="radio" style="display:none;"><input value="F" name="daterng" type="radio" checked="checked" style="display:none;">
                <input name="travel_date_roundtrip" type="text" id="travel_date2" size="10" maxlength="10" value="<?php echo $_SESSION['travel_date_roundtrip'];?>">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal2.popup();"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY</td>
              </tr>
              <tr>
            	<td class="ot" colspan="2" align="center">
                Select your Airline from the list below.</td>
            </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="departing_airline_roundtrip" size="1">
                <?php if (!empty($_SESSION['departing_airline_roundtrip'])) { echo '<option value="'.$_SESSION['departing_airline_roundtrip'].'">'.$_SESSION['departing_airline_roundtrip'].'</option>'; } ;?>																													
																													<?php if ($_SESSION['trip_type'] == '10') { ?>
                                                                                                                    <option value="Allegiant Air">Allegiant Air</option>
                                                                                                                    <option value="Direct Air">Direct Air</option>
                                                                                                                    <option value="flyglobespan">flyglobespan</option>
                                                                                                                    <option value="Icelandair">Icelandair</option>
                                                                                                                    <option value="Jetairfly">Jetairfly</option>
                                                                                                                    <option value="First Choice (Air 2000)">First Choice (Air 2000)</option>																										<option value="Monarch">Monarch</option>
                                                                                                                    <option value="Thomas Cook">Thomas Cook</option>
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
                                                                                                                    <?php } else { ?>
																													<option value="Aer Lingus">Aer Lingus</option>
																													<option value="Aeromexico">Aeromexico</option>
																													<option value="Air Canada">Air Canada</option>
																													<option value="Air Europa">Air Europa</option>

																													<option value="Air France">Air France</option>

																													<option value="Air Jamaica">Air Jamaica</option>
																													<option value="Air New Zealand">Air New Zealand</option>
																													<option value="Air One">Air One</option>
																													<option value="Air Transat A.T.Inc.">Air Transat A.T.Inc.</option>
																													<option value="AirTran Airways">AirTran Airways</option>

																													<option value="Alaska Airlines">Alaska Airlines</option>

																													<option value="Alitalia">Alitalia</option>
																													<option value="All Nippon Airways">All Nippon Airways</option>
                                                                                                                    
																													<option value="American Airlines">American Airlines</option>
																													<option value="Asiana Airlines">Asiana Airlines</option>
																													<option value="Austrian Airlines AG">Austrian Airlines AG</option>

																													<option value="Bahamasair">Bahamasair</option>
                                                                                                                    <option value="bmi british midland">bmi British Midland</option>

																													<option value="British Airways">British Airways</option>
																													<option value="Brussels Airlines">Brussels Airlines</option>
																													<option value="Cathay Pacific Airways">Cathay Pacific Airways</option>
																													<option value="China Airlines">China Airlines</option>
																													<option value="China Southern Airlines">China Southern Airlines</option>

																													<option value="Continental Airlines">Continental Airlines</option>

																													<option value="Copa Airlines">Copa Airlines</option>
																													<option value="Czech Airlines">Czech Airlines</option>
																													<option value="Delta Air Lines">Delta Air Lines</option>
                                                                                                                    
                                                                                                                    
																													<option value="Frontier Airlines Inc.">Frontier Airlines Inc.</option>
																													<option value="Iberia">Iberia</option>
                                                                                                                    

																													<option value="Japan Airlines International">Japan Airlines International</option>
																												    
																													<option value="JetBlue Airways Corporation">JetBlue Airways Corporation</option>
																													<option value="Korean Air">Korean Air</option>
																													<option value="KLM-Royal Dutch Airlines">KLM-Royal Dutch Airlines</option>
																													<option value="Lan Airlines">Lan Airlines</option>
																													<option value="Lan Peru">Lan Peru</option>

																													<option value="Lufthansa German Airlines">Lufthansa German Airlines</option>

																													<option value="LOT - Polish Airlines">LOT - Polish Airlines</option>
																													<option value="Mexicana de Aviacion">Mexicana de Aviacion</option>
																													<option value="Midwest Airlines">Midwest Airlines</option>
																													<option value="MALEV Hungarian Airlines">MALEV Hungarian Airlines</option>																									
																													<option value="Northwest Airlines">Northwest Airlines</option>

																													<option value="Qantas Airways">Qantas Airways</option>

																													<option value="Qatar Airways">Qatar Airways</option>
																													<option value="Royal Air Maroc">Royal Air Maroc</option>
																													<option value="Singapore Airlines">Singapore Airlines</option>
																													<option value="South African Airways">South African Airways</option>
																													<option value="Southwest Airlines">Southwest Airlines</option>

																													<option value="Spirit Airlines">Spirit Airlines</option>

																													<option value="Sun Country Airlines">Sun Country Airlines</option>
																													<option value="Sunwing Airlines Inc.">Sunwing Airlines Inc.</option>
																													<option value="Swiss">Swiss</option>
																													<option value="SAS Scandinavian Airlines">SAS Scandinavian Airlines</option>
																													<option value="TAM Linhas Aereas">TAM Linhas Aereas</option>

																													<option value="TAP Air Portugal">TAP Air Portugal</option>
																													
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
																													<option value="United Airlines">United Airlines</option>
																													<option value="US Airways">US Airways</option>
																													<option value="Virgin Atlantic Airways">Virgin Atlantic Airways</option>
																													<option value="Westjet">Westjet</option>
                                                                                                                    <?php } ?>
																												</select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Flight Number:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><input name="flight_number_roundtrip" class="bodytxt" size="10" type="text" value="<?php echo $_SESSION['flight_number_roundtrip'];?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Departing at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="h3" size="1"><?php if (!empty($_SESSION['h3'])) { echo '<option value="'.$_SESSION['h3'].'">'.$_SESSION['h3'].'</option>'; } ;?><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12" selected="selected">12</option></select><select name="m3" size="1"><?php if (!empty($_SESSION['m3'])) { echo '<option value="'.$_SESSION['m3'].'">'.$_SESSION['m3'].'</option>'; } ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm3" size="1"><?php if (!empty($_SESSION['ampm3'])) { echo '<option value="'.$_SESSION['ampm3'].'">'.$_SESSION['ampm3'].'</option>'; } ;?><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>To:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $to4['name']; ?></td>
              </tr>
           </table>
           <script language="JavaScript">
<!-- // create calendar object(s) just after form tag closed
	 // specify form element as the only parameter (document.forms['formname'].elements['inputname']);
	 // note: you can have as many calendar objects as you need for your application
	var cal2 = new calendar2(document.forms['reserve'].elements['travel_date_roundtrip']);
	cal2.year_scroll = true;
	cal2.time_comp = false;
	
	var cal3 = new calendar2(document.forms['reserve'].elements['travel_date_extra']);
	cal3.year_scroll = true;
	cal3.time_comp = false;
//-->
</script>
           			<?php } ?>
           
           <?php } ?>
          </td>
        </tr>
        <tr>
          <td class="footer">&nbsp;</td>
        </tr>
      </table>
      <br />
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      	<tr>
        	<td align="left" class="ot"><a href="reserve_step2.php" title="Back"><img src="images/back.png" title="Back" border="0" /></a>
            </td>
            <td align="right" class="ot"><input src="images/continue.png" border="0" type="image" onclick="if (validateDate(reserve.travel_date_roundtrip.value, valDateFmt(reserve.datefmt),valDateRng(reserve.daterng))) {} else {alert('You can only reserve online if your arrival is 48hrs prior.\n\nPlease call 407-601-7900 to reserve over the phone'); return false;}; if (validateDate(reserve.travel_date_extra.value, valDateFmt(reserve.datefmt),valDateRng(reserve.daterng))) {} else {alert('You can only reserve online if your arrival is 48hrs prior.\n\nPlease call 407-601-7900 to reserve over the phone'); return false;}">
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
<!--End Footer Here -->
</div>

<map name="Map" id="Map"><area shape="rect" coords="257,5,276,25" href="index.php" alt="Home page" title="Home page" />
<area shape="rect" coords="284,5,306,25" href="my_account.php" alt="My account" title="My account" />
<area shape="rect" coords="316,6,336,25" href="contact.php" alt="Contact Us" title="Contact Us" /></map></body>
</html>
