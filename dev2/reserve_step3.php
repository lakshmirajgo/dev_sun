<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/location_functions.php");
include ("includes/functions/price_functions.php");
include_once("includes/functions/trip_type_functions.php");	
include ("includes/functions/page_functions.php");

$page_buttom = get_pages_view('reserve_step3_buttom');
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

<style>
.date_error
{
background: rgb(255, 146, 146);
padding: 9px;
border-radius: 4px;
color: black;
}
</style>



<script type="text/javascript" src="includes/js/date.js"></script>
<script type="text/javascript" src="scripts/custom_elements.js"></script>
<script type="text/javascript" src="includes/js/validate.js"></script>
<script type="text/javascript" src="includes/js/menu.js"></script>
<script language="JavaScript">
<!--
var url = location.href;	
if(url.charAt(4) != "s" || url.charAt(4) == "w" ){
window.location = "https://www.sunstatelimo.com/reserve_step3.php";
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>jQuery.noConflict();</script>

<script>

jQuery(function(){

    jQuery('#reserve_btn').on('click', function(e){
    
        date = jQuery('#date1').val();
        h1 = jQuery('#h1').val();
        m1 = jQuery('#m1').val();
        ampm1 = jQuery('#ampm1').val();
        
        actual_date = date + ' ' + h1 + ':' + m1 + ':00 ' + ampm1;
               
        jQuery.ajax({
          type: "POST",
          url: "/admin/locked_dates_manager.php",
          data: { date: actual_date, check: true},
          async: false
        })
          .done(function( res ) {          
            if(res)
            {       
                alert("We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.");
                e.preventDefault();
                return false;
            }
          });
          
          
          date2 = jQuery('#date2').val();
            h2 = jQuery('#h2').val();
            m2 = jQuery('#m2').val();
            ampm2 = jQuery('#ampm2').val();
        
        actual_date2 = date2 + ' ' + h2 + ':' + m2 + ':00 ' + ampm2;
               
        if(date2 != undefined)
        {
            jQuery.ajax({
              type: "POST",
              url: "/admin/locked_dates_manager.php",
              data: { date: actual_date2, check: true},
              async: false
            })
              .done(function( res ) {
                if(res)
                {       
                    alert("We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.");
                    e.preventDefault();
                    return false;
                }
              });
        }
        
        
        
        date3 = jQuery('#date3').val();
            h3 = jQuery('#h3').val();
            m3 = jQuery('#m3').val();
            ampm3 = jQuery('#ampm3').val();
        
        actual_date3 = date3 + ' ' + h3 + ':' + m3 + ':00 ' + ampm3;
               
        if(date3 != undefined)
        {
            jQuery.ajax({
              type: "POST",
              url: "/admin/locked_dates_manager.php",
              data: { date: actual_date3, check: true},
              async: false
            })
              .done(function( res ) {
                if(res)
                {       
                    alert("We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.");
                    e.preventDefault();
                    return false;
                }
              });
        }
        
        
        
        
        
        
    });

});
</script>
</head>
<body onload="MM_preloadImages('images/fleet_active.gif','images/faq_active.gif','images/contact_active.gif','images/home_active.gif','images/rates_active.gif','images/testimonials_active.gif');">
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


/*if ($_SERVER['REMOTE_ADDR'] == '97.79.85.221') {

    print '<pre>';

    print_r($_SESSION);
    print_r($_POST);

    print '</pre>';

}*/
?><br />
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
          <?php
		  //Number of legs -> make a loop BEGIN
          $num_legs = $_SESSION['num_legs'];
		  for ($count =1; $count <= $num_legs; $count += 1) {
          
          ?>
          <script>

jQuery(function() {

	var $travel_date<?php echo $count;?> = jQuery('#date<?php echo $count;?>');
	var $travel_h<?php echo $count;?> = jQuery('#h<?php echo $count;?>');
	var $travel_m<?php echo $count;?> = jQuery('#m<?php echo $count;?>');
	var $travel_ampm<?php echo $count;?> = jQuery('#ampm<?php echo $count;?>');
    
    var date, hr, min, ampm, actual_date;
    
    $travel_date<?php echo $count;?>.on('blur', function(){
        date = $travel_date<?php echo $count;?>.val();
        h<?php echo $count;?> = jQuery('#h<?php echo $count;?>').val();
        m<?php echo $count;?> = jQuery('#m<?php echo $count;?>').val();
        ampm<?php echo $count;?> = jQuery('#ampm<?php echo $count;?>').val();
        
        actual_date = date + ' ' + h<?php echo $count;?> + ':' + m<?php echo $count;?> + ':00 ' + ampm<?php echo $count;?>;
        
        
        jQuery.ajax({
          type: "POST",
          url: "/admin/locked_dates_manager.php",
          data: { date: actual_date, check: true}
        })
          .done(function( res ) {
          
            
            
            if(res)
            {
                alert("We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.");
            }
          });
    });
    
    $travel_h<?php echo $count;?>.on('change', function(){
        date = $travel_date<?php echo $count;?>.val();
        h<?php echo $count;?> = jQuery('#h<?php echo $count;?>').val();
        m<?php echo $count;?> = jQuery('#m<?php echo $count;?>').val();
        ampm<?php echo $count;?> = jQuery('#ampm<?php echo $count;?>').val();
        
        actual_date = date + ' ' + h<?php echo $count;?> + ':' + m<?php echo $count;?> + ':00 ' + ampm<?php echo $count;?>;
        
        
        jQuery.ajax({
          type: "POST",
          url: "/admin/locked_dates_manager.php",
          data: { date: actual_date, check: true}
        })
          .done(function( res ) {
            if(res)
            {
                alert("We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.");
            }
          });
    });
    
    $travel_m<?php echo $count;?>.on('change', function(){
        date = $travel_date<?php echo $count;?>.val();
        h<?php echo $count;?> = jQuery('#h<?php echo $count;?>').val();
        m<?php echo $count;?> = jQuery('#m<?php echo $count;?>').val();
        ampm<?php echo $count;?> = jQuery('#ampm<?php echo $count;?>').val();
        
        actual_date = date + ' ' + h<?php echo $count;?> + ':' + m<?php echo $count;?> + ':00 ' + ampm<?php echo $count;?>;
        
        
        jQuery.ajax({
          type: "POST",
          url: "/admin/locked_dates_manager.php",
          data: { date: actual_date, check: true}
        })
          .done(function( res ) {
            if(res)
            {
                alert("We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.");
            }

          });
    });
    
    $travel_ampm<?php echo $count;?>.on('change', function(){
        date = $travel_date<?php echo $count;?>.val();
        h<?php echo $count;?> = jQuery('#h<?php echo $count;?>').val();
        m<?php echo $count;?> = jQuery('#m<?php echo $count;?>').val();
        ampm<?php echo $count;?> = jQuery('#ampm<?php echo $count;?>').val();
        
        actual_date = date + ' ' + h<?php echo $count;?> + ':' + m<?php echo $count;?> + ':00 ' + ampm<?php echo $count;?>;
        
        
        jQuery.ajax({
          type: "POST",
          url: "/admin/locked_dates_manager.php",
          data: { date: actual_date, check: true}
        })
          .done(function( res ) {
            if(res)
            {
                alert("We do not have availability in the dates and hours you have tried to reserve please contact Sunstate Transport for further information. We apologize for any inconveniences this may have caused you. Sincerely, Sunstate Transport.");
            }

          });
    });
    
    
        
});
</script>
          <?php
          
          
		  $from[$count] = get_locations_view($_SESSION['from'.$count.'']);
		  $to[$count] = get_locations_view($_SESSION['to'.$count.'']);
		  ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          
            
          
          
           <tr>
           	  <td width="100%" class="ot">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              <td colspan="2" width="100%" valign="top" align="center" bgcolor="#ffff82" class="BorderBox" style="padding:5px;">
              <strong><?php if(check_departure($_SESSION['from'.$count.'']) || check_arrival($_SESSION['from'.$count.'']) || check_departure($_SESSION['to'.$count.'']) || check_arrival($_SESSION['to'.$count.''])) { ?><?php if (check_arrival($_SESSION['from'.$count.''])) { echo "Arrival"; } else { echo "Departure"; }; ?><? } else { echo "Transfer " . $count; }; ?></strong>              </td>
             </tr>
             
             <?php

                if(isset($_SESSION['date'.$count.'_error']))
                {
                ?>
                <tr style="padding: 5px;">
                    <td colspan="2">
                        <div class="date_error"><?php echo $_SESSION['date'.$count.'_error'];?></div>
                    </td>
                </tr>
                <?php
                
                    unset($_SESSION['date'.$count.'_error']);
                
                }
                 
            ?>
             
             
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from[$count]['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2">
				<input value="U" name="datefmt" type="radio" checked="checked" style="display:none;"><input value="W" name="datefmt" type="radio" style="display:none;"><input value="J" name="datefmt" type="radio" style="display:none;"><input value="P" name="daterng" type="radio" style="display:none;"><input value="A" name="daterng" type="radio" style="display:none;"><input value="F" name="daterng" type="radio" checked="checked" style="display:none;">
				<?php 
				// Modification by Rash 03/18/09
				if(isset($_SESSION['travel_date']))  $_SESSION['date1'] = $_SESSION['travel_date'];
				
				if(empty($_SESSION['date1'])) { $_SESSION['date1'] = $_SESSION['travel_date']; }; ?><input name="date<?php echo $count; ?>" type="text" id="date<?php echo $count; ?>" size="10" maxlength="10" value="<?php echo $_SESSION['date'.$count.''];?>">&nbsp;<img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('date<?php echo $count; ?>');"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY
                <script language="JavaScript">
                /**
				var cal<?php echo $count; ?> = new calendar(document.forms['reserve'].elements['date<?php echo $count; ?>']);
				cal<?php echo $count; ?>.year_scroll = true;
				cal<?php echo $count; ?>.time_comp = false;
                **/
				//-->
				</script>                </td>
              </tr>
              <?php if(check_departure($_SESSION['from'.$count.'']) || check_arrival($_SESSION['from'.$count.'']) || check_departure($_SESSION['to'.$count.'']) || check_arrival($_SESSION['to'.$count.''])) { ?>
              <tr>
            	<td class="ot" colspan="2" align="center">
                Select your Airline from the list below.</td>
            </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong><strong>
                  <?php if (check_arrival($_SESSION['from'.$count.''])) { echo "Arriving"; } else { echo "Departing"; }; ?>
                </strong> Airline:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="airline<?php echo $count; ?>" size="1">
                <?php if (!empty($_SESSION['airline'.$count.''])) { echo '<option value="'.$_SESSION['airline'.$count.''].'">'.$_SESSION['airline'.$count.''].'</option>'; } ;?>
			    <?php if ($_SESSION['from'] == '422') { ?>
                <option value="Allegiant Air SFB">Allegiant Air (SFB)</option>
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
                <!--<option value="Allegiant Air MCO">Allegiant Air (MCO)</option>-->                
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
                <td align="left" height="20" width="62%" class="ot2"><input name="flight_number<?php echo $count; ?>" class="bodytxt" size="10" type="text" value="<?php echo $_SESSION['flight_number'.$count.''];?>"></td>
              </tr>
              <?php } ?>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong><?php if(check_departure($_SESSION['from'.$count.'']) || check_arrival($_SESSION['from'.$count.'']) || check_departure($_SESSION['to'.$count.'']) || check_arrival($_SESSION['to'.$count.''])) { if (check_arrival($_SESSION['from'.$count.''])) { echo "Arriving"; } else { echo "Departing"; }; } else { echo "Pickup"; }; ?> at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><select name="h<?php echo $count; ?>" id="h<?php echo $count; ?>" size="1"><?php if (!empty($_SESSION['h'.$count.''])) { echo '<option value="'.$_SESSION['h'.$count.''].'" selected="selected">'.$_SESSION['h'.$count.''].'</option>'; } ;?><option value="12">12</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option></select><select name="m<?php echo $count; ?>" id="m<?php echo $count; ?>" size="1"><?php if (!empty($_SESSION['m'.$count.''])) { echo '<option value="'.$_SESSION['m'.$count.''].'">'.$_SESSION['m'.$count.''].'</option>';
} ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option
value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option
value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm<?php echo $count; ?>" id="ampm<?php echo $count; ?>" size="1"><?php if (!empty($_SESSION['ampm'.$count.''])) { echo '<option value="'.$_SESSION['ampm'.$count.''].'">'.$_SESSION['ampm'.$count.''].'</option>'; } ;?><option value="PM">PM</option><option value="AM">AM</option></select><br /><span style="font-weight:bold; font-size:11px; color:#FF0000;">Please provide actual <?php if(check_departure($_SESSION['from'.$count.'']) || check_arrival($_SESSION['from'.$count.'']) || check_departure($_SESSION['to'.$count.'']) || check_arrival($_SESSION['to'.$count.''])) { if (check_arrival($_SESSION['from'.$count.''])) { echo "arrival"; } else { echo "departure"; }; } else { echo "pickup"; }; ?> time</span></td>
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
        	<td align="left" class="ot"><a href="reserve_step2.php" title="Back"><img src="images/back.png" title="Back" border="0" /></a>
            </td>
            <td align="center" valign="middle">
           <img src="images/secure_site.jpg" border="0" alt="THIS IS A SECURE SITE" title="THIS IS A SECURE SITE" />
        	</td>
            <td align="right" class="ot"><input src="images/continue.png" border="0" type="image" id="reserve_btn" onclick="
                var date1val = new Date(reserve.date1.value);
                var date2val = new Date(reserve.date2.value);
                var date3val = new Date(reserve.date3.value);
                
                if(date2val == 'Invalid Date'){
                    alert('You must select a Departure Transfer Date');
                    return false;
                }
                else
                {
                    if(date1val > date2val)
                    {
                        alert('Your Transfer dates are incorrect. Please check your dates again and modify accordingly.');
                        return false;
                    }
                }
                
                if(date3val == 'Invalid Date'){
                    alert('You must select a Departure Transfer Date');
                    return false;
                }
                else
                {
                    if(date2val > date3val)
                    {
                        alert('Your Transfer dates are incorrect. Please check your dates again and modify accordingly.');
                        return false;
                    }
                }
                
            if (validateDate(reserve.date1.value, valDateFmt(reserve.datefmt),valDateRng(reserve.daterng))) {} else {alert('You can only reserve online if your arrival is <?php echo $company_info['minimum_time']*24; ?>hrs prior.\n\nPlease call 407-601-7900 to reserve over the phone'); return false;}; if (validateDate(reserve.date2.value, valDateFmt(reserve.datefmt),valDateRng(reserve.daterng))) {} else {alert('You can only reserve online if your arrival is <?php echo $company_info['minimum_time']*24; ?>hrs prior.\n\nPlease call 407-601-7900 to reserve over the phone'); return false;}; if (validateDate(reserve.date3.value, valDateFmt(reserve.datefmt),valDateRng(reserve.daterng))) {} else {alert('You can only reserve online if your arrival is <?php echo $company_info['minimum_time']*24; ?>hrs prior.\n\nPlease call 407-601-7900 to reserve over the phone'); return false;}
            
            
            
            ">
            </td>
        </tr>
      </table>  
    </div>
			 <br />
                  <?php echo $page_buttom['page_content']; ?>
                       
            
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
