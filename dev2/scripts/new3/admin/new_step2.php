<?php
session_start();
/*if (isset($_POST)) {
 foreach($_POST as $key => $val)
    $_SESSION[$key] = $val;
 };*/
include ("includes/functions/general_functions.php");
include ("includes/functions/location_functions.php");
include ("includes/functions/price_functions.php");
include ("includes/functions/vehicle_functions.php");
include_once("includes/functions/trip_type_functions.php");	

#$_POST[from] = "3";
/*
print '<pre>';
print_r ($_SESSION);
print_r ($_POST);
print ',</pre>';
print '=====================================';*/

//print_r($_SESSION);


//begin quote	summary variables

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

	if ($_SESSION['trip_type'] == '2' || $_SESSION['trip_type'] == '1') {
		if ($_SESSION['trip_type'] == '2') { 
		$trip_kind = "Orlando Area - Round Trip";
		if (!empty($round_trip['price_value'])) {$price_val =  sprintf("%01.2f", $round_trip['price_value']); } else { $price_val =  "Rate not found"; };
      }
      if ($_SESSION['trip_type'] == '1') { 
             $trip_kind =  "Orlando Area - One Way";
            if (!empty($one_way['price_value'])) { $price_val =  sprintf("%01.2f", $one_way['price_value']); } else { $price_val =  "Rate not found"; };
           } 
	}
	else {
		$trip_type = get_trip_types_view($_SESSION['trip_type']);
		//Special prices for Shades of Green Round trip BEGIN
		if ($_SESSION['trip_type_new'] == '2') {
		  	$trip_type['name'] = 'Round trip: '.$trip_type['name'];
	      };
		//Special prices for Shades of Green Round trip END
		 $trip_kind =  $trip_type['name']; 
		 if (!empty($transfer['price_value'])) { 
			$price_val =  sprintf("%01.2f", $transfer['price_value']);
				} 
		else {
			 echo "Rate not found"; 
			};
		 } 
//end quote	summary variables


?>





<!-- head of page -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Disney Transportation | Orlando Limo | MCO Airport Limousine, Shuttle, Towncar | Ground Transportation</title>
<link href="css/master.css" rel="stylesheet" type="text/css" />


<script language="JavaScript">

function setVisibility() {
document.getElementById("pane01").style.display = "none";
}


</script>



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/animatedcollapse.js"></script>

<script type="text/javascript">

animatedcollapse.addDiv('pane01', 'fade=1,speed=400,group=pets,hide=1')
animatedcollapse.addDiv('pane02', 'fade=1,speed=400,group=pets,hide=1')

animatedcollapse.ontoggle=function($, divobj, state){ 

}

animatedcollapse.init()

</script>
<script type="text/javascript" src="js/jwplayer.js"></script>

<!-- End -->


<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.0/themes/smoothness/jquery-ui.css" />
		<link rel="stylesheet" media="all" type="text/css" href="jquery-ui-timepicker-addon.css" />
		
		<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.0/jquery-ui.min.js"></script>
		<script type="text/javascript" src="jquery-ui-timepicker-addon.js"></script>
		
		<script type="text/javascript">
			
			$(function(){
				$('#tabs').tabs();
		
				$('.example-container > pre').each(function(i){
					eval($(this).text());
				});
			});
			
		</script>
  
  
  
  <script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>
  
  
  
  
  
  <script type="text/javascript">
function clearText(field){

    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;

}
</script>

</head>

<body>

<div class="wrap">

<div id="Header">
		<table cellspacing="0" cellpadding="0" border="0" width="100%">
	<tbody><tr>
		<td width="19%" valign="middle"><img alt="Sunstate" src="images/sunstate.gif"></td>
		<td align="right" width="81%"><img height="102" border="0" width="367" usemap="#Map" src="images/topRightCars.jpg"></td>
	</tr>
</tbody></table>		<!--
    	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="19%" valign="middle"><img src="images/sunstate.gif" alt="Sunstate" /></td>
              <td width="81%" align="right"><img src="images/topRightCars.jpg" width="367" height="102" border="0" usemap="#Map" /></td>
            </tr>
          </table>
		  -->
          
       
    	</div>


<div class="from-top">

<h3><?php echo $price_val;?>  <?php echo $vehicle['name']; ?></h3>

<h2><?php echo $trip_kind; ?></h2>


<div class="from-to">
<h3><?php echo $from['name']; ?></h3>

<h4><?php echo $to['name']; ?></h4>
</div>

<p class="top-note">For round trip you can enter return date on next step The above quote includes everything except your drivers gratuity</p>

</div>


<div class="user">
 
<div class="login gallery clearfix">
<a href="#" rel="toggle[pane01]"></a>
</div>

 <div id="pane01">
 <div class="form">

<p><input name="" type="text" value="Username" onfocus="clearText(this)" onblur="clearText(this)"/></p>

<p><input name="" type="text" value="Password" onfocus="clearText(this)" onblur="clearText(this)"/></p>

<p><a href="#"><img src="images/login-btn-2.png" /></a></p>


<p style="float:right; margin:0 30px 0 0 "><a href="#" onclick="setVisibility();"><img src="images/close.png"  /></a></p>

</div>
 </div>



</div>


<div class="passenger">
<div class="pass-top"><img src="images/pass-top.jpg"/></div>
<div class="pass-mid">


<div class="pass-mid-inn">
<h2>Passenger Information</h2>

<div class="pass-left">
<p>Name</p>
<p><input name="" type="text" /></p>

<p>Address</p>
<p><input name="" type="text" /></p>


<p>Telephone</p>
<p><input name="" type="text" /></p>

<p>Create Password</p>
<p><input name="" type="text" /></p>

</div>


<div class="pass-right">
<p></p>
<p>&nbsp;</p>

<p class="region">
<span>City</span>
<span>State</span>
<span>Zip</span>
</p>
<p class="region">
<span><input name="" type="text" /></span>
<span><input name="" type="text" /></span>
<span><input name="" type="text" /></span>
</p>


<p>Email Address</p>
<p><input name="" type="text" /></p>

<p>Confirm Password</p>
<p><input name="" type="text" /></p>

</div>



</div>


</div>
<div class="pass-bott"><img src="images/pass-bott.jpg" width="738" height="13" /></div>
</div>







<div class="passenger">
<div class="pass-top"><img src="images/transfer-top.jpg"/></div>

<div class="trans-mid">

<div class="trans-mid-inn">
<h2>Transfer Details</h2>

<div class="pass-left">
<p>Trip Type</p>
<p>
<select name="from" id="Select1" required="yes" size="1">
                                      <option value = "<?php echo $_SESSION['trip_type'];?>"  selected="selected"> <?php echo $trip_kind;?> </option>
                                      
                                      <OPTGROUP LABEL="Orlando Area">
                                      <option value="1">Orlando Area - One Way</option>
                                      <option value="2">Orlando Area - Round Trip</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Cruise Transfer">
                                      <option value="76">Disney/Universal>Cruise>MCO - Round trip</option>
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
</p>

<p>From</p>
<p>
<select name="to" id="Select2" required="yes" size="1">
                                      <option value = "<?php echo $from[id];?>"  selected="selected"> <?php echo $from[name];?> </option>    
                                      <optgroup label="Orlando Airports">
                                                        <option value="421">Orlando Airport </option>
                                    <option value="512">Orlando Exec. Airport</option>
                                    <option value="422">Orlando Sanford Airport </option>
                                                        </optgroup>
                                      <optgroup label="Orlando Hotels">
                                                       <option value="186">Adventure Motel</option>
                                    <option value="187">All-Star Movies Resort</option>
                                    <option value="188">All-Star Music Resort</option>
                                    <option value="189">All-Star Sports Resort</option>
                                    <option value="389">Ambassador Motel</option>
                                    <option value="22">Ambassador TD Waterhouse</option>
                                    <option value="190">Amerihost Resort at Main Gate</option>
                                    <option value="69">AmeriSuites Convention Center</option>
                                    <option value="1">AmeriSuites International Airport </option>
                                    <option value="191">AmeriSuites Lake Buena Vista South</option>
                                    <option value="70">AmeriSuites Universal</option>
                                    <option value="23">Amtrak - Orlando</option>
                                    <option value="193">Animal Kingdom Park</option>
                                    <option value="194">Arabian Nights</option>
                                    <option value="71">Bay Hill Club &amp; Lodge</option>
                                    <option value="72">Baymont In &amp; Suites</option>
                                    <option value="195">Baymont Inn Kissimmee</option>
                                    <option value="73">Baymont Universal Hotel</option>
                                    <option value="24">Best Value Inn</option>
                                    <option value="390">Best Western Heritage Park</option>
                                    <option value="196">Best Western Lake Buena Vista</option>
                                    <option value="198">Best Western Lakeside</option>
                                    <option value="197">Best Western Main Gate East Hotel &amp; Suites</option>
                                    <option value="74">Best Western MovieLand</option>
                                    <option value="391">Best Western Mt. Vernon</option>
                                    <option value="25">Best Western Orlando West</option>
                                    <option value="75">Best Western Plaza International</option>
                                    <option value="76">Best Western Universal Inn</option>
                                    <option value="26">Best Western Winter Garden</option>
                                    <option value="199">Blizzard Beach</option>
                                    <option value="200">Blue Tree Resort</option>
                                    <option value="201">BoardWalk at Disney</option>
                                    <option value="202">Bryans Spanish Cove</option>
                                    <option value="203">Budget Inn West</option>
                                    <option value="204">Buena Vista Motel</option>
                                    <option value="205">Buena Vista Palace Resort and Spa</option>
                                    <option value="206">Buena Vista Suites</option>
                                    <option value="392">Candlewood Suites</option>
                                    <option value="207">Caribbean Beach Resort</option>
                                    <option value="208">Caribe Royale Suites</option>
                                    <option value="209">Casa Rosa Main Gate</option>
                                    <option value="210">Celebration Hotel</option>
                                    <option value="211">Celebrity Resorts Lake Buena Vista</option>
                                    <option value="218">Celebrity World Resort</option>
                                    <option value="212">Central Motel</option>
                                    <option value="213">Chalet Motel</option>
                                    <option value="214">Chateau Motel</option>
                                    <option value="215">Chatham Square</option>
                                    <option value="216">Cirque Du Soleil</option>
                                    <option value="27">Citrus Bowl</option>
                                    <option value="28">Citrus Club</option>
                                    <option value="2">Clarion Hotel Airport</option>
                                    <option value="78">Clarion Hotel Universal</option>
                                    <option value="217">Clarion Main Gate West</option>
                                    <option value="79">Comfort Inn International</option>
                                    <option value="219">Comfort Inn Lake Buena Vista</option>
                                    <option value="220">Comfort Inn Main Gate West</option>
                                    <option value="393">Comfort Inn North</option>
                                    <option value="80">Comfort Inn Universal</option>
                                    <option value="221">Comfort Suites</option>
                                    <option value="3">Comfort Suites Airport</option>
                                    <option value="29">Comfort Suites Downtown Orlando</option>
                                    <option value="222">Comfort Suites Main Gate</option>
                                    <option value="81">Comfort Suites Orlando Turkey Lake</option>
                                    <option value="223">Commons Apartments</option>
                                    <option value="225">Continental Motel</option>
                                    <option value="227">Country Hearth Inn &amp; Suites</option>
                                    <option value="228">Country Inn &amp; Suites</option>
                                    <option value="82">Country Inn &amp; Suites Universal</option>
                                    <option value="229">Crown Motel</option>
                                    <option value="4">Crowne Plaza Orlando Airport</option>
                                    <option value="83">Crowne Plaza Resort</option>
                                    <option value="84">Crowne Plaza Universal</option>
                                    <option value="231">Cypress Pointe Resort</option>
                                    <option value="32">Days Inn &amp; Suites Landstreet</option>
                                    <option value="30">Days Inn 33rd Street</option>
                                    <option value="5">Days Inn Airport</option>
                                    <option value="85">Days Inn Convention Center</option>
                                    <option value="86">Days Inn International North</option>
                                    <option value="232">Days Inn Kissimmee Airport</option>
                                    <option value="233">Days Inn Kissimmee West</option>
                                    <option value="234">Days Inn Main Gate East</option>
                                    <option value="235">Days Inn Main Gate West</option>
                                    <option value="31">Days Inn Midtown</option>
                                    <option value="395">Days Inn Turnpike</option>
                                    <option value="87">Days Inn Universal</option>
                                    <option value="33">Days Inn West Hwy 50</option>
                                    <option value="394">Days Inn Winter Park</option>
                                    <option value="236">Days Suites - Old Town</option>
                                    <option value="34">DeLux Inn</option>
                                    <option value="88">Discovery Cove</option>
                                    <option value="237">Disney Back Yard Barbeque</option>
                                    <option value="238">Disney Beach Club Resort LBV</option>
                                    <option value="239">Disney Beach Club Villas</option>
                                    <option value="260">Disney MGM Studios</option>
                                    <option value="262">Dixie Stampede</option>
                                    <option value="263">Dolphin Hotel at Disney</option>
                                    <option value="459">Double Tree Guest Suite</option>
                                    <option value="89">Doubletree Castle</option>
                                    <option value="264">DoubleTree Club Hotel</option>
                                    <option value="90">Doubletree Universal Orlando</option>
                                    <option value="261">Downtown Disney</option>
                                    <option value="254">Eastgate Inn Resort</option>
                                    <option value="91">Econo Roadway</option>
                                    <option value="35">Econolodge Central</option>
                                    <option value="255">Econolodge Hawaiian Village</option>
                                    <option value="256">Econolodge Main Gate Central</option>
                                    <option value="257">Econolodge Polynesian Resort</option>
                                    <option value="258">Embassy Grand Beach</option>
                                    <option value="6">Embassy Suites Airport</option>
                                    <option value="396">Embassy Suites Altamonte</option>
                                    <option value="38">Embassy Suites Downtown Orlando</option>
                                    <option value="92">Embassy Suites International Drive</option>
                                    <option value="93">Embassy Suites Jamaican</option>
                                    <option value="259">Embassy Suites LBV</option>
                                    <option value="240">Enterprise Motel</option>
                                    <option value="241">Epcot</option>
                                    <option value="36">Executive Inn</option>
                                    <option value="37">Executive Inn Oak Ridge</option>
                                    <option value="94">Extended Stay</option>
                                    <option value="96">Extended Stay America Universal</option>
                                    <option value="130">Extended Stay Deluxe</option>
                                    <option value="98">Fairfield Inn &amp; Suites Universal</option>
                                    <option value="7">Fairfield Inn Airport</option>
                                    <option value="97">Fairfield Inn and Suites</option>
                                    <option value="242">Fairfield Inn at Lake Bryan</option>
                                    <option value="39">Fairfield Inn Orlando South</option>
                                    <option value="243">Fairfield Inn Resort Bonnet Creek</option>
                                    <option value="244">Fantasy World Club Villas</option>
                                    <option value="40">Flamingo Motel North</option>
                                    <option value="41">Florida Mall</option>
                                    <option value="42">Florida Mall Hotel</option>
                                    <option value="43">Florida Mall Inn</option>
                                    <option value="245">Florida Vacation Villas</option>
                                    <option value="246">Fort Wilderness Campgrounds</option>
                                    <option value="247">Four Winds Motel</option>
                                    <option value="248">Gator Motel</option>
                                    <option value="397">Gatorland</option>
                                    <option value="249">Gaylord Palms Resort</option>
                                    <option value="250">Golden Link Motel</option>
                                    <option value="99">Grande Lakes Orlando</option>
                                    <option value="252">Grande Lakes Resort</option>
                                    <option value="44">Greyhound Bus Lines</option>
                                    <option value="253">Grosvenor Resort</option>
                                    <option value="45">Guest House International</option>
                                    <option value="100">Hampton Inn &amp; Suites</option>
                                    <option value="104">Hampton Inn &amp; Suites I-Drive</option>
                                    <option value="8">Hampton Inn Airport</option>
                                    <option value="398">Hampton Inn Altamonte</option>
                                    <option value="101">Hampton Inn Convention Center</option>
                                    <option value="46">Hampton Inn Florida Mall</option>
                                    <option value="102">Hampton Inn Kirkman </option>
                                    <option value="266">Hampton Inn Lake Buena Vista</option>
                                    <option value="267">Hampton Inn Main Gate</option>
                                    <option value="268">Hampton Inn Main Gate West</option>
                                    <option value="103">Hampton Inn Universal</option>
                                    <option value="105">Hard Rock Hotel</option>
                                    <option value="106">Hard Rock Live</option>
                                    <option value="107">Hawthorn Suites At SeaWorld </option>
                                    <option value="108">Hawthorn Suites Universal</option>
                                    <option value="269">Hawthorne Suites LBV</option>
                                    <option value="270">High Point World Resort</option>
                                    <option value="110">Hilton Garden Inn</option>
                                    <option value="9">Hilton Garden Inn Airport</option>
                                    <option value="109">Hilton Garden Inn Westwood Boulevard</option>
                                    <option value="111">Hilton Grand Vacation Club</option>
                                    <option value="271">Hilton Grand Vacation I - Drive</option>
                                    <option value="272">Hilton in the Walt Disney Resort</option>
                                    <option value="112">Holiday Express Wet 'n' Wild</option>
                                    <option value="113">Holiday Inn Convention Center</option>
                                    <option value="10">Holiday Inn Express Airport</option>
                                    <option value="399">Holiday Inn Express Exit 244</option>
                                    <option value="47">Holiday Inn Express Hotel &amp; Suites</option>
                                    <option value="274">Holiday Inn Express LBV</option>
                                    <option value="114">Holiday Inn International Drive</option>
                                    <option value="275">Holiday Inn MGW - Nikki Bird</option>
                                    <option value="273">Holiday Inn MGW Blacklake Road</option>
                                    <option value="400">Holiday Inn Orlando North</option>
                                    <option value="11">Holiday Inn Select Airport</option>
                                    <option value="276">Holiday Inn Sunspree Lake Buena Vista</option>
                                    <option value="115">Holiday Inn Universal Towers</option>
                                    <option value="277">Holiday Inn Walt Disney World</option>
                                    <option value="278">Holiday Villas Of Sommerset</option>
                                    <option value="116">Holy Land Zion Experience</option>
                                    <option value="117">Homewood Suites International</option>
                                    <option value="279">Homewood Suites Lake Buena Vista</option>
                                    <option value="280">Homewood Suites Parkway</option>
                                    <option value="118">Horizons at Orlando</option>
                                    <option value="401">Hotel Orlando North</option>
                                    <option value="281">House of Blues</option>
                                    <option value="282">Howard Johnson Enchanted Land</option>
                                    <option value="283">Howard Johnson Express &amp; Suite</option>
                                    <option value="284">Howard Johnson Express Inn</option>
                                    <option value="119">Howard Johnson Express Inn Suites</option>
                                    <option value="120">Howard Johnson Hawaiian Court</option>
                                    <option value="121">Howard Johnson International  Drive</option>
                                    <option value="285">Howard Johnson MGE Watermania</option>
                                    <option value="122">Howard Johnson Plaza Resort</option>
                                    <option value="286">Howard Johnson Westgate</option>
                                    <option value="48">Howard Johnson's TD Waterhouse</option>
                                    <option value="402">Howard Johnson's Turnpike</option>
                                    <option value="49">Howard Vernon Motel</option>
                                    <option value="287">Hyatt Grand Cypress</option>
                                    <option value="12">Hyatt Orlando Airport</option>
                                    <option value="123">I-Drive Inn</option>
                                    <option value="124">Inn and Suites International</option>
                                    <option value="288">Inn at Summer Bay</option>
                                    <option value="125">Islands Of Adventure</option>
                                    <option value="50">Jet Air Orlando</option>
                                    <option value="126">JW Marriott Grande Lakes</option>
                                    <option value="289">Kids Village</option>
                                    <option value="403">Kingswood Resort</option>
                                    <option value="290">Knight's Inn Kissimmee</option>
                                    <option value="291">Knight's Inn Main Gate East</option>
                                    <option value="292">Knight's Inn Main Gate West</option>
                                    <option value="51">Knights Inn East Colonial</option>
                                    <option value="127">La Quinta Inn &amp; Suites</option>
                                    <option value="14">La Quinta Inn &amp; Suites Airport</option>
                                    <option value="13">La Quinta Inn Airport</option>
                                    <option value="152">La Quinta International Drive</option>
                                    <option value="95">La Quinta International Drive North</option>
                                    <option value="404">La Quinta Orlando North</option>
                                    <option value="293">Lake Buena Vista Hotel</option>
                                    <option value="405">Lambert Inn</option>
                                    <option value="52">Landmark Hotel</option>
                                    <option value="294">Legacy Grand Hotel</option>
                                    <option value="128">Leisure Resorts</option>
                                    <option value="295">Liki Tiki Village</option>
                                    <option value="53">Loch Haven Inn</option>
                                    <option value="296">Magic Castle East Rodeway Inn West 192</option>
                                    <option value="297">Magic Castle Main Gate</option>
                                    <option value="298">Magic Kingdom</option>
                                    <option value="299">Magic Tree Resort</option>
                                    <option value="300">Main Gate Inn</option>
                                    <option value="301">Maple Leaf Hotel</option>
                                    <option value="15">Marriott Airport</option>
                                    <option value="54">Marriott Court Yard Downtown</option>
                                    <option value="16">Marriott Courtyard Airport</option>
                                    <option value="302">Marriott Courtyard at Little Lake Bryan</option>
                                    <option value="129">Marriott Courtyard International Drive</option>
                                    <option value="406">Marriott Courtyard Mailand</option>
                                    <option value="303">Marriott Courtyard Palm Parkway Lake Buena Vista</option>
                                    <option value="153">Marriott Cypress Harbor</option>
                                    <option value="55">Marriott Downtown Centroplex</option>
                                    <option value="154">Marriott Grand Vista</option>
                                    <option value="304">Marriott Orlando World Center</option>
                                    <option value="155">Marriott Residence At SeaWorld</option>
                                    <option value="156">Marriott Residence Inn I-Drive</option>
                                    <option value="157">Marriott Residence Universal</option>
                                    <option value="158">Masters Inn International Drive</option>
                                    <option value="305">Masters Inn Main Gate East</option>
                                    <option value="306">Masters Inn Main Gate West</option>
                                    <option value="307">Medieval Times</option>
                                    <option value="159">Mercado</option>
                                    <option value="160">Microtel Inn and Suites</option>
                                    <option value="308">Monte Carlo Motel</option>
                                    <option value="161">Motel 6 International Drive</option>
                                    <option value="309">Motel 6 Orlando</option>
                                    <option value="310">Motel 6 Orlando West</option>
                                    <option value="311">Nickelodeon Family Suites</option>
                                    <option value="312">Oak Plantation Resort</option>
                                    <option value="313">Oasis Inn Main Gate</option>
                                    <option value="314">Oasis Lakes Resort</option>
                                    <option value="315">Old Key West</option>
                                    <option value="316">Old Town</option>
                                    <option value="162">Orange County Convention Center</option>
                                    <option value="317">Orbit One</option>
                                    <option value="163">Orlando Grand Plaza Hotel &amp; Suites</option>
                                    <option value="318">Orlando Premium Outlets</option>
                                    <option value="164">Orlando Resort</option>
                                    <option value="165">Orlando Sunshine Resort</option>
                                    <option value="319">Outdoor Resort</option>
                                    <option value="320">Palm Lake Resort &amp; Hostile</option>
                                    <option value="321">Palm Motel</option>
                                    <option value="131">Parc Corniche Resorts</option>
                                    <option value="322">Park Inn West</option>
                                    <option value="407">Park Plaza Hotel</option>
                                    <option value="323">Parkside Record Inn &amp; Suites</option>
                                    <option value="324">Parkway International</option>
                                    <option value="325">Parkway Motel</option>
                                    <option value="56">Parliament House</option>
                                    <option value="132">Peabody Orlando</option>
                                    <option value="133">Pirates Dinner Adventure</option>
                                    <option value="326">Planet Hollywood</option>
                                    <option value="134">Pointe Orlando</option>
                                    <option value="327">Polynesian Isles Resort</option>
                                    <option value="328">Polynesian Resort</option>
                                    <option value="329">Pop Century Resort</option>
                                    <option value="330">Port Orleans French Quarter</option>
                                    <option value="331">Port Orleans Riverside</option>
                                    <option value="135">Portofino Bay Hotel</option>
                                    <option value="332">Premium Outlet Mall</option>
                                    <option value="136">Prime Factory Outlet Mall</option>
                                    <option value="57">Quality Inn &amp; Suites Florida Mall</option>
                                    <option value="18">Quality Inn Airport</option>
                                    <option value="408">Quality Inn Altamonte</option>
                                    <option value="137">Quality Inn Low Q</option>
                                    <option value="333">Quality Inn Main Gate West</option>
                                    <option value="138">Quality Inn Plaza International</option>
                                    <option value="334">Quality Inn Polynesian Resort</option>
                                    <option value="335">Quality Inn Suites East Gate</option>
                                    <option value="409">Quality Inn Turnpike</option>
                                    <option value="336">Quality Suites Main Gate East</option>
                                    <option value="139">Quality Suites Universal Studios</option>
                                    <option value="140">Race Rock</option>
                                    <option value="375">Radison World Gate Resort</option>
                                    <option value="141">Radisson Barcelo</option>
                                    <option value="373">Radisson Lake Buena Vista</option>
                                    <option value="374">Radisson Parkway</option>
                                    <option value="58">Radisson Plaza Downtown Orlando</option>
                                    <option value="412">Ramada Downtown Kissimmee</option>
                                    <option value="376">Ramada East Gate Fountain Park</option>
                                    <option value="59">Ramada Inn &amp; Suites Orlando</option>
                                    <option value="142">Ramada Inn All Suites at SeaWorld</option>
                                    <option value="410">Ramada Inn Downtown Kissimmee</option>
                                    <option value="60">Ramada Ltd. Florida Mall</option>
                                    <option value="377">Ramada Plaza Gateway</option>
                                    <option value="61">Ramada Plaza John Young</option>
                                    <option value="378">Ramada Resort Main Gate Reedy Creek</option>
                                    <option value="413">Ramada Vacation Homes</option>
                                    <option value="411">RDV Sportsplex</option>
                                    <option value="379">Red Carpet Inn</option>
                                    <option value="143">Red Roof Inn International Drive</option>
                                    <option value="380">Red Roof Inn Main Gate East</option>
                                    <option value="144">Red Roof Inn Universal</option>
                                    <option value="523">Regal Sun LBV</option>
                                    <option value="19">Renaissance Airport</option>
                                    <option value="145">Renaissance Orlando Resort</option>
                                    <option value="414">Residence Inn Altamonte</option>
                                    <option value="531">Reunion </option>
                                    <option value="146">Riande Continental Plaza</option>
                                    <option value="415">Ritz Express</option>
                                    <option value="147">Ritz-Carlton Grande Lakes, The</option>
                                    <option value="337">RIU Orlando Resort</option>
                                    <option value="148">Rodeway Inn International Drive</option>
                                    <option value="149">Rosen Centre Hotel</option>
                                    <option value="150">Rosen Plaza Hotel</option>
                                    <option value="338">Royal Celebration Inn</option>
                                    <option value="151">Royal Pacific Resort</option>
                                    <option value="339">Royal Palms</option>
                                    <option value="340">Royal Plaza</option>
                                    <option value="341">Saratoga Resort Villas</option>
                                    <option value="342">Saratoga Springs Resort &amp; Spa</option>
                                    <option value="166">SeaWorld</option>
                                    <option value="343">Seralago Hotel &amp; Suites MGE</option>
                                    <option value="344">Sevilla Inn</option>
                                    <option value="525">Shades of Green</option>
                                    <option value="346">Sheraton Safari</option>
                                    <option value="167">Sheraton Studio City Hotel</option>
                                    <option value="20">Sheraton Suites</option>
                                    <option value="21">Sheraton Suites Airport</option>
                                    <option value="347">Sheraton Vistana Resort</option>
                                    <option value="348">Sheraton Vistana Villages</option>
                                    <option value="168">Sheraton World</option>
                                    <option value="169">Shingle Creek</option>
                                    <option value="349">Sierra Lago Hotel &amp; Suites</option>
                                    <option value="350">Sierra Suites Lake Buena Vista</option>
                                    <option value="351">Silver Lake Resort</option>
                                    <option value="170">Sleep Inn</option>
                                    <option value="171">Sleep Inn &amp; Suites</option>
                                    <option value="352">Sleep Inn Main Gate</option>
                                    <option value="172">Spring Hill Suites</option>
                                    <option value="353">Spring Hill Suites at Little Lake Bryan</option>
                                    <option value="416">Stadium Inn</option>
                                    <option value="354">Star Island Resort</option>
                                    <option value="175">Staybridge Suites I-Drive</option>
                                    <option value="355">Staybridge Suites Lake Buena Vista</option>
                                    <option value="173">Studio Inn</option>
                                    <option value="174">Studio Plus</option>
                                    <option value="62">Suburban Lodge</option>
                                    <option value="176">Suburban Lodge</option>
                                    <option value="356">Suites and Resort Hotel on Lake Cecile</option>
                                    <option value="357">Summer Bay Resort</option>
                                    <option value="358">Summer Florida Inn</option>
                                    <option value="359">Sun Motel</option>
                                    <option value="360">Super 8</option>
                                    <option value="361">Super 8 East Main Gate</option>
                                    <option value="362">Super 8 Lake Side Main Gate</option>
                                    <option value="177">Super 8 Universal</option>
                                    <option value="417">Super 8 Vine Street</option>
                                    <option value="363">Swan Hotel</option>
                                    <option value="63">TD Waterhouse Centre</option>
                                    <option value="364">Thriftlodge East</option>
                                    <option value="365">Travelers Inn</option>
                                    <option value="418">Travelodge Altamonte</option>
                                    <option value="64">Travelodge Centroplex</option>
                                    <option value="65">Travelodge East Colonial</option>
                                    <option value="366">Travelodge Freedom Resort &amp; Spa</option>
                                    <option value="178">Travelodge I-Drive</option>
                                    <option value="419">Travelodge Kissimmee_Exit 244</option>
                                    <option value="367">Travelodge Main Gate East</option>
                                    <option value="368">Travelodge Suites East Gate Orange</option>
                                    <option value="369">Travelodge Suites Main Gate East</option>
                                    <option value="370">Tropical Palms Resort</option>
                                    <option value="371">Typhoon Lagoon</option>
                                    <option value="77">Universals CityWalk</option>
                                    <option value="67">Vacation Lodge </option>
                                    <option value="372">Vacation Village At Parkway</option>
                                    <option value="420">Vacation Village Resort</option>
                                    <option value="381">Viking Motel</option>
                                    <option value="382">Villas Of Grand Cypress</option>
                                    <option value="383">Vista Way Apartments</option>
                                    <option value="532">Waldorf Astoria Orlando</option>
                                    <option value="179">Wellesley Inn &amp; Suites</option>
                                    <option value="180">Wellesley Inn &amp; Suites Orlando</option>
                                    <option value="181">West Gate Lakes</option>
                                    <option value="182">West Gate Palace</option>
                                    <option value="385">West Gate Towers</option>
                                    <option value="386">West Gate Vacation Villas</option>
                                    <option value="384">Westgate Inn</option>
                                    <option value="68">Westin Grand Bohemian</option>
                                    <option value="66">Westside Inn &amp; Suites</option>
                                    <option value="183">Wet 'n' Wild</option>
                                    <option value="529">Wilderness Lodge</option>
                                    <option value="184">Wingate Hotel</option>
                                    <option value="185">Wyndham Orlando Resort</option>
                                    <option value="522">Wyndham Palace Resorts</option>
                                    <option value="388">Yacht Club</option>
                                  </optgroup>
                </select>

</p>
 

<p>

<div class="example-container">
						<p>Date & Time</p>
						<div>
					 		<input type="text" name="basic_example_1" id="basic_example_1" value=" <?php echo $_SESSION['travel_date']; ?> " />
						</div>					
<pre style="display:none">
$('#basic_example_1').datetimepicker();
</pre>
					</div>
                    
                    
             
                    </p>

</div>


<div class="pass-right">
<p>Passenger Count</p>
<p><input name="" type="text" value = <?php echo $_SESSION[passenger_count];?>></p>

<p>To</p>
<p>
<select name="to" id="to" required="yes" size="1">
                                      <option value = "<?php echo $to[id];?>"  selected="selected"> <?php echo $to[name];?> </option>
                                      <optgroup label="Orlando Airports">
                                                        <option value="421">Orlando Airport </option>
                                    <option value="512">Orlando Exec. Airport</option>
                                    <option value="422">Orlando Sanford Airport </option>
                                                        </optgroup>
                                      <optgroup label="Orlando Hotels">
                                                       <option value="186">Adventure Motel</option>
                                    <option value="187">All-Star Movies Resort</option>
                                    <option value="188">All-Star Music Resort</option>
                                    <option value="189">All-Star Sports Resort</option>
                                    <option value="389">Ambassador Motel</option>
                                    <option value="22">Ambassador TD Waterhouse</option>
                                    <option value="190">Amerihost Resort at Main Gate</option>
                                    <option value="69">AmeriSuites Convention Center</option>
                                    <option value="1">AmeriSuites International Airport </option>
                                    <option value="191">AmeriSuites Lake Buena Vista South</option>
                                    <option value="70">AmeriSuites Universal</option>
                                    <option value="23">Amtrak - Orlando</option>
                                    <option value="193">Animal Kingdom Park</option>
                                    <option value="194">Arabian Nights</option>
                                    <option value="71">Bay Hill Club &amp; Lodge</option>
                                    <option value="72">Baymont In &amp; Suites</option>
                                    <option value="195">Baymont Inn Kissimmee</option>
                                    <option value="73">Baymont Universal Hotel</option>
                                    <option value="24">Best Value Inn</option>
                                    <option value="390">Best Western Heritage Park</option>
                                    <option value="196">Best Western Lake Buena Vista</option>
                                    <option value="198">Best Western Lakeside</option>
                                    <option value="197">Best Western Main Gate East Hotel &amp; Suites</option>
                                    <option value="74">Best Western MovieLand</option>
                                    <option value="391">Best Western Mt. Vernon</option>
                                    <option value="25">Best Western Orlando West</option>
                                    <option value="75">Best Western Plaza International</option>
                                    <option value="76">Best Western Universal Inn</option>
                                    <option value="26">Best Western Winter Garden</option>
                                    <option value="199">Blizzard Beach</option>
                                    <option value="200">Blue Tree Resort</option>
                                    <option value="201">BoardWalk at Disney</option>
                                    <option value="202">Bryans Spanish Cove</option>
                                    <option value="203">Budget Inn West</option>
                                    <option value="204">Buena Vista Motel</option>
                                    <option value="205">Buena Vista Palace Resort and Spa</option>
                                    <option value="206">Buena Vista Suites</option>
                                    <option value="392">Candlewood Suites</option>
                                    <option value="207">Caribbean Beach Resort</option>
                                    <option value="208">Caribe Royale Suites</option>
                                    <option value="209">Casa Rosa Main Gate</option>
                                    <option value="210">Celebration Hotel</option>
                                    <option value="211">Celebrity Resorts Lake Buena Vista</option>
                                    <option value="218">Celebrity World Resort</option>
                                    <option value="212">Central Motel</option>
                                    <option value="213">Chalet Motel</option>
                                    <option value="214">Chateau Motel</option>
                                    <option value="215">Chatham Square</option>
                                    <option value="216">Cirque Du Soleil</option>
                                    <option value="27">Citrus Bowl</option>
                                    <option value="28">Citrus Club</option>
                                    <option value="2">Clarion Hotel Airport</option>
                                    <option value="78">Clarion Hotel Universal</option>
                                    <option value="217">Clarion Main Gate West</option>
                                    <option value="79">Comfort Inn International</option>
                                    <option value="219">Comfort Inn Lake Buena Vista</option>
                                    <option value="220">Comfort Inn Main Gate West</option>
                                    <option value="393">Comfort Inn North</option>
                                    <option value="80">Comfort Inn Universal</option>
                                    <option value="221">Comfort Suites</option>
                                    <option value="3">Comfort Suites Airport</option>
                                    <option value="29">Comfort Suites Downtown Orlando</option>
                                    <option value="222">Comfort Suites Main Gate</option>
                                    <option value="81">Comfort Suites Orlando Turkey Lake</option>
                                    <option value="223">Commons Apartments</option>
                                    <option value="225">Continental Motel</option>
                                    <option value="227">Country Hearth Inn &amp; Suites</option>
                                    <option value="228">Country Inn &amp; Suites</option>
                                    <option value="82">Country Inn &amp; Suites Universal</option>
                                    <option value="229">Crown Motel</option>
                                    <option value="4">Crowne Plaza Orlando Airport</option>
                                    <option value="83">Crowne Plaza Resort</option>
                                    <option value="84">Crowne Plaza Universal</option>
                                    <option value="231">Cypress Pointe Resort</option>
                                    <option value="32">Days Inn &amp; Suites Landstreet</option>
                                    <option value="30">Days Inn 33rd Street</option>
                                    <option value="5">Days Inn Airport</option>
                                    <option value="85">Days Inn Convention Center</option>
                                    <option value="86">Days Inn International North</option>
                                    <option value="232">Days Inn Kissimmee Airport</option>
                                    <option value="233">Days Inn Kissimmee West</option>
                                    <option value="234">Days Inn Main Gate East</option>
                                    <option value="235">Days Inn Main Gate West</option>
                                    <option value="31">Days Inn Midtown</option>
                                    <option value="395">Days Inn Turnpike</option>
                                    <option value="87">Days Inn Universal</option>
                                    <option value="33">Days Inn West Hwy 50</option>
                                    <option value="394">Days Inn Winter Park</option>
                                    <option value="236">Days Suites - Old Town</option>
                                    <option value="34">DeLux Inn</option>
                                    <option value="88">Discovery Cove</option>
                                    <option value="237">Disney Back Yard Barbeque</option>
                                    <option value="238">Disney Beach Club Resort LBV</option>
                                    <option value="239">Disney Beach Club Villas</option>
                                    <option value="260">Disney MGM Studios</option>
                                    <option value="262">Dixie Stampede</option>
                                    <option value="263">Dolphin Hotel at Disney</option>
                                    <option value="459">Double Tree Guest Suite</option>
                                    <option value="89">Doubletree Castle</option>
                                    <option value="264">DoubleTree Club Hotel</option>
                                    <option value="90">Doubletree Universal Orlando</option>
                                    <option value="261">Downtown Disney</option>
                                    <option value="254">Eastgate Inn Resort</option>
                                    <option value="91">Econo Roadway</option>
                                    <option value="35">Econolodge Central</option>
                                    <option value="255">Econolodge Hawaiian Village</option>
                                    <option value="256">Econolodge Main Gate Central</option>
                                    <option value="257">Econolodge Polynesian Resort</option>
                                    <option value="258">Embassy Grand Beach</option>
                                    <option value="6">Embassy Suites Airport</option>
                                    <option value="396">Embassy Suites Altamonte</option>
                                    <option value="38">Embassy Suites Downtown Orlando</option>
                                    <option value="92">Embassy Suites International Drive</option>
                                    <option value="93">Embassy Suites Jamaican</option>
                                    <option value="259">Embassy Suites LBV</option>
                                    <option value="240">Enterprise Motel</option>
                                    <option value="241">Epcot</option>
                                    <option value="36">Executive Inn</option>
                                    <option value="37">Executive Inn Oak Ridge</option>
                                    <option value="94">Extended Stay</option>
                                    <option value="96">Extended Stay America Universal</option>
                                    <option value="130">Extended Stay Deluxe</option>
                                    <option value="98">Fairfield Inn &amp; Suites Universal</option>
                                    <option value="7">Fairfield Inn Airport</option>
                                    <option value="97">Fairfield Inn and Suites</option>
                                    <option value="242">Fairfield Inn at Lake Bryan</option>
                                    <option value="39">Fairfield Inn Orlando South</option>
                                    <option value="243">Fairfield Inn Resort Bonnet Creek</option>
                                    <option value="244">Fantasy World Club Villas</option>
                                    <option value="40">Flamingo Motel North</option>
                                    <option value="41">Florida Mall</option>
                                    <option value="42">Florida Mall Hotel</option>
                                    <option value="43">Florida Mall Inn</option>
                                    <option value="245">Florida Vacation Villas</option>
                                    <option value="246">Fort Wilderness Campgrounds</option>
                                    <option value="247">Four Winds Motel</option>
                                    <option value="248">Gator Motel</option>
                                    <option value="397">Gatorland</option>
                                    <option value="249">Gaylord Palms Resort</option>
                                    <option value="250">Golden Link Motel</option>
                                    <option value="99">Grande Lakes Orlando</option>
                                    <option value="252">Grande Lakes Resort</option>
                                    <option value="44">Greyhound Bus Lines</option>
                                    <option value="253">Grosvenor Resort</option>
                                    <option value="45">Guest House International</option>
                                    <option value="100">Hampton Inn &amp; Suites</option>
                                    <option value="104">Hampton Inn &amp; Suites I-Drive</option>
                                    <option value="8">Hampton Inn Airport</option>
                                    <option value="398">Hampton Inn Altamonte</option>
                                    <option value="101">Hampton Inn Convention Center</option>
                                    <option value="46">Hampton Inn Florida Mall</option>
                                    <option value="102">Hampton Inn Kirkman </option>
                                    <option value="266">Hampton Inn Lake Buena Vista</option>
                                    <option value="267">Hampton Inn Main Gate</option>
                                    <option value="268">Hampton Inn Main Gate West</option>
                                    <option value="103">Hampton Inn Universal</option>
                                    <option value="105">Hard Rock Hotel</option>
                                    <option value="106">Hard Rock Live</option>
                                    <option value="107">Hawthorn Suites At SeaWorld </option>
                                    <option value="108">Hawthorn Suites Universal</option>
                                    <option value="269">Hawthorne Suites LBV</option>
                                    <option value="270">High Point World Resort</option>
                                    <option value="110">Hilton Garden Inn</option>
                                    <option value="9">Hilton Garden Inn Airport</option>
                                    <option value="109">Hilton Garden Inn Westwood Boulevard</option>
                                    <option value="111">Hilton Grand Vacation Club</option>
                                    <option value="271">Hilton Grand Vacation I - Drive</option>
                                    <option value="272">Hilton in the Walt Disney Resort</option>
                                    <option value="112">Holiday Express Wet 'n' Wild</option>
                                    <option value="113">Holiday Inn Convention Center</option>
                                    <option value="10">Holiday Inn Express Airport</option>
                                    <option value="399">Holiday Inn Express Exit 244</option>
                                    <option value="47">Holiday Inn Express Hotel &amp; Suites</option>
                                    <option value="274">Holiday Inn Express LBV</option>
                                    <option value="114">Holiday Inn International Drive</option>
                                    <option value="275">Holiday Inn MGW - Nikki Bird</option>
                                    <option value="273">Holiday Inn MGW Blacklake Road</option>
                                    <option value="400">Holiday Inn Orlando North</option>
                                    <option value="11">Holiday Inn Select Airport</option>
                                    <option value="276">Holiday Inn Sunspree Lake Buena Vista</option>
                                    <option value="115">Holiday Inn Universal Towers</option>
                                    <option value="277">Holiday Inn Walt Disney World</option>
                                    <option value="278">Holiday Villas Of Sommerset</option>
                                    <option value="116">Holy Land Zion Experience</option>
                                    <option value="117">Homewood Suites International</option>
                                    <option value="279">Homewood Suites Lake Buena Vista</option>
                                    <option value="280">Homewood Suites Parkway</option>
                                    <option value="118">Horizons at Orlando</option>
                                    <option value="401">Hotel Orlando North</option>
                                    <option value="281">House of Blues</option>
                                    <option value="282">Howard Johnson Enchanted Land</option>
                                    <option value="283">Howard Johnson Express &amp; Suite</option>
                                    <option value="284">Howard Johnson Express Inn</option>
                                    <option value="119">Howard Johnson Express Inn Suites</option>
                                    <option value="120">Howard Johnson Hawaiian Court</option>
                                    <option value="121">Howard Johnson International  Drive</option>
                                    <option value="285">Howard Johnson MGE Watermania</option>
                                    <option value="122">Howard Johnson Plaza Resort</option>
                                    <option value="286">Howard Johnson Westgate</option>
                                    <option value="48">Howard Johnson's TD Waterhouse</option>
                                    <option value="402">Howard Johnson's Turnpike</option>
                                    <option value="49">Howard Vernon Motel</option>
                                    <option value="287">Hyatt Grand Cypress</option>
                                    <option value="12">Hyatt Orlando Airport</option>
                                    <option value="123">I-Drive Inn</option>
                                    <option value="124">Inn and Suites International</option>
                                    <option value="288">Inn at Summer Bay</option>
                                    <option value="125">Islands Of Adventure</option>
                                    <option value="50">Jet Air Orlando</option>
                                    <option value="126">JW Marriott Grande Lakes</option>
                                    <option value="289">Kids Village</option>
                                    <option value="403">Kingswood Resort</option>
                                    <option value="290">Knight's Inn Kissimmee</option>
                                    <option value="291">Knight's Inn Main Gate East</option>
                                    <option value="292">Knight's Inn Main Gate West</option>
                                    <option value="51">Knights Inn East Colonial</option>
                                    <option value="127">La Quinta Inn &amp; Suites</option>
                                    <option value="14">La Quinta Inn &amp; Suites Airport</option>
                                    <option value="13">La Quinta Inn Airport</option>
                                    <option value="152">La Quinta International Drive</option>
                                    <option value="95">La Quinta International Drive North</option>
                                    <option value="404">La Quinta Orlando North</option>
                                    <option value="293">Lake Buena Vista Hotel</option>
                                    <option value="405">Lambert Inn</option>
                                    <option value="52">Landmark Hotel</option>
                                    <option value="294">Legacy Grand Hotel</option>
                                    <option value="128">Leisure Resorts</option>
                                    <option value="295">Liki Tiki Village</option>
                                    <option value="53">Loch Haven Inn</option>
                                    <option value="296">Magic Castle East Rodeway Inn West 192</option>
                                    <option value="297">Magic Castle Main Gate</option>
                                    <option value="298">Magic Kingdom</option>
                                    <option value="299">Magic Tree Resort</option>
                                    <option value="300">Main Gate Inn</option>
                                    <option value="301">Maple Leaf Hotel</option>
                                    <option value="15">Marriott Airport</option>
                                    <option value="54">Marriott Court Yard Downtown</option>
                                    <option value="16">Marriott Courtyard Airport</option>
                                    <option value="302">Marriott Courtyard at Little Lake Bryan</option>
                                    <option value="129">Marriott Courtyard International Drive</option>
                                    <option value="406">Marriott Courtyard Mailand</option>
                                    <option value="303">Marriott Courtyard Palm Parkway Lake Buena Vista</option>
                                    <option value="153">Marriott Cypress Harbor</option>
                                    <option value="55">Marriott Downtown Centroplex</option>
                                    <option value="154">Marriott Grand Vista</option>
                                    <option value="304">Marriott Orlando World Center</option>
                                    <option value="155">Marriott Residence At SeaWorld</option>
                                    <option value="156">Marriott Residence Inn I-Drive</option>
                                    <option value="157">Marriott Residence Universal</option>
                                    <option value="158">Masters Inn International Drive</option>
                                    <option value="305">Masters Inn Main Gate East</option>
                                    <option value="306">Masters Inn Main Gate West</option>
                                    <option value="307">Medieval Times</option>
                                    <option value="159">Mercado</option>
                                    <option value="160">Microtel Inn and Suites</option>
                                    <option value="308">Monte Carlo Motel</option>
                                    <option value="161">Motel 6 International Drive</option>
                                    <option value="309">Motel 6 Orlando</option>
                                    <option value="310">Motel 6 Orlando West</option>
                                    <option value="311">Nickelodeon Family Suites</option>
                                    <option value="312">Oak Plantation Resort</option>
                                    <option value="313">Oasis Inn Main Gate</option>
                                    <option value="314">Oasis Lakes Resort</option>
                                    <option value="315">Old Key West</option>
                                    <option value="316">Old Town</option>
                                    <option value="162">Orange County Convention Center</option>
                                    <option value="317">Orbit One</option>
                                    <option value="163">Orlando Grand Plaza Hotel &amp; Suites</option>
                                    <option value="318">Orlando Premium Outlets</option>
                                    <option value="164">Orlando Resort</option>
                                    <option value="165">Orlando Sunshine Resort</option>
                                    <option value="319">Outdoor Resort</option>
                                    <option value="320">Palm Lake Resort &amp; Hostile</option>
                                    <option value="321">Palm Motel</option>
                                    <option value="131">Parc Corniche Resorts</option>
                                    <option value="322">Park Inn West</option>
                                    <option value="407">Park Plaza Hotel</option>
                                    <option value="323">Parkside Record Inn &amp; Suites</option>
                                    <option value="324">Parkway International</option>
                                    <option value="325">Parkway Motel</option>
                                    <option value="56">Parliament House</option>
                                    <option value="132">Peabody Orlando</option>
                                    <option value="133">Pirates Dinner Adventure</option>
                                    <option value="326">Planet Hollywood</option>
                                    <option value="134">Pointe Orlando</option>
                                    <option value="327">Polynesian Isles Resort</option>
                                    <option value="328">Polynesian Resort</option>
                                    <option value="329">Pop Century Resort</option>
                                    <option value="330">Port Orleans French Quarter</option>
                                    <option value="331">Port Orleans Riverside</option>
                                    <option value="135">Portofino Bay Hotel</option>
                                    <option value="332">Premium Outlet Mall</option>
                                    <option value="136">Prime Factory Outlet Mall</option>
                                    <option value="57">Quality Inn &amp; Suites Florida Mall</option>
                                    <option value="18">Quality Inn Airport</option>
                                    <option value="408">Quality Inn Altamonte</option>
                                    <option value="137">Quality Inn Low Q</option>
                                    <option value="333">Quality Inn Main Gate West</option>
                                    <option value="138">Quality Inn Plaza International</option>
                                    <option value="334">Quality Inn Polynesian Resort</option>
                                    <option value="335">Quality Inn Suites East Gate</option>
                                    <option value="409">Quality Inn Turnpike</option>
                                    <option value="336">Quality Suites Main Gate East</option>
                                    <option value="139">Quality Suites Universal Studios</option>
                                    <option value="140">Race Rock</option>
                                    <option value="375">Radison World Gate Resort</option>
                                    <option value="141">Radisson Barcelo</option>
                                    <option value="373">Radisson Lake Buena Vista</option>
                                    <option value="374">Radisson Parkway</option>
                                    <option value="58">Radisson Plaza Downtown Orlando</option>
                                    <option value="412">Ramada Downtown Kissimmee</option>
                                    <option value="376">Ramada East Gate Fountain Park</option>
                                    <option value="59">Ramada Inn &amp; Suites Orlando</option>
                                    <option value="142">Ramada Inn All Suites at SeaWorld</option>
                                    <option value="410">Ramada Inn Downtown Kissimmee</option>
                                    <option value="60">Ramada Ltd. Florida Mall</option>
                                    <option value="377">Ramada Plaza Gateway</option>
                                    <option value="61">Ramada Plaza John Young</option>
                                    <option value="378">Ramada Resort Main Gate Reedy Creek</option>
                                    <option value="413">Ramada Vacation Homes</option>
                                    <option value="411">RDV Sportsplex</option>
                                    <option value="379">Red Carpet Inn</option>
                                    <option value="143">Red Roof Inn International Drive</option>
                                    <option value="380">Red Roof Inn Main Gate East</option>
                                    <option value="144">Red Roof Inn Universal</option>
                                    <option value="523">Regal Sun LBV</option>
                                    <option value="19">Renaissance Airport</option>
                                    <option value="145">Renaissance Orlando Resort</option>
                                    <option value="414">Residence Inn Altamonte</option>
                                    <option value="531">Reunion </option>
                                    <option value="146">Riande Continental Plaza</option>
                                    <option value="415">Ritz Express</option>
                                    <option value="147">Ritz-Carlton Grande Lakes, The</option>
                                    <option value="337">RIU Orlando Resort</option>
                                    <option value="148">Rodeway Inn International Drive</option>
                                    <option value="149">Rosen Centre Hotel</option>
                                    <option value="150">Rosen Plaza Hotel</option>
                                    <option value="338">Royal Celebration Inn</option>
                                    <option value="151">Royal Pacific Resort</option>
                                    <option value="339">Royal Palms</option>
                                    <option value="340">Royal Plaza</option>
                                    <option value="341">Saratoga Resort Villas</option>
                                    <option value="342">Saratoga Springs Resort &amp; Spa</option>
                                    <option value="166">SeaWorld</option>
                                    <option value="343">Seralago Hotel &amp; Suites MGE</option>
                                    <option value="344">Sevilla Inn</option>
                                    <option value="525">Shades of Green</option>
                                    <option value="346">Sheraton Safari</option>
                                    <option value="167">Sheraton Studio City Hotel</option>
                                    <option value="20">Sheraton Suites</option>
                                    <option value="21">Sheraton Suites Airport</option>
                                    <option value="347">Sheraton Vistana Resort</option>
                                    <option value="348">Sheraton Vistana Villages</option>
                                    <option value="168">Sheraton World</option>
                                    <option value="169">Shingle Creek</option>
                                    <option value="349">Sierra Lago Hotel &amp; Suites</option>
                                    <option value="350">Sierra Suites Lake Buena Vista</option>
                                    <option value="351">Silver Lake Resort</option>
                                    <option value="170">Sleep Inn</option>
                                    <option value="171">Sleep Inn &amp; Suites</option>
                                    <option value="352">Sleep Inn Main Gate</option>
                                    <option value="172">Spring Hill Suites</option>
                                    <option value="353">Spring Hill Suites at Little Lake Bryan</option>
                                    <option value="416">Stadium Inn</option>
                                    <option value="354">Star Island Resort</option>
                                    <option value="175">Staybridge Suites I-Drive</option>
                                    <option value="355">Staybridge Suites Lake Buena Vista</option>
                                    <option value="173">Studio Inn</option>
                                    <option value="174">Studio Plus</option>
                                    <option value="62">Suburban Lodge</option>
                                    <option value="176">Suburban Lodge</option>
                                    <option value="356">Suites and Resort Hotel on Lake Cecile</option>
                                    <option value="357">Summer Bay Resort</option>
                                    <option value="358">Summer Florida Inn</option>
                                    <option value="359">Sun Motel</option>
                                    <option value="360">Super 8</option>
                                    <option value="361">Super 8 East Main Gate</option>
                                    <option value="362">Super 8 Lake Side Main Gate</option>
                                    <option value="177">Super 8 Universal</option>
                                    <option value="417">Super 8 Vine Street</option>
                                    <option value="363">Swan Hotel</option>
                                    <option value="63">TD Waterhouse Centre</option>
                                    <option value="364">Thriftlodge East</option>
                                    <option value="365">Travelers Inn</option>
                                    <option value="418">Travelodge Altamonte</option>
                                    <option value="64">Travelodge Centroplex</option>
                                    <option value="65">Travelodge East Colonial</option>
                                    <option value="366">Travelodge Freedom Resort &amp; Spa</option>
                                    <option value="178">Travelodge I-Drive</option>
                                    <option value="419">Travelodge Kissimmee_Exit 244</option>
                                    <option value="367">Travelodge Main Gate East</option>
                                    <option value="368">Travelodge Suites East Gate Orange</option>
                                    <option value="369">Travelodge Suites Main Gate East</option>
                                    <option value="370">Tropical Palms Resort</option>
                                    <option value="371">Typhoon Lagoon</option>
                                    <option value="77">Universals CityWalk</option>
                                    <option value="67">Vacation Lodge </option>
                                    <option value="372">Vacation Village At Parkway</option>
                                    <option value="420">Vacation Village Resort</option>
                                    <option value="381">Viking Motel</option>
                                    <option value="382">Villas Of Grand Cypress</option>
                                    <option value="383">Vista Way Apartments</option>
                                    <option value="532">Waldorf Astoria Orlando</option>
                                    <option value="179">Wellesley Inn &amp; Suites</option>
                                    <option value="180">Wellesley Inn &amp; Suites Orlando</option>
                                    <option value="181">West Gate Lakes</option>
                                    <option value="182">West Gate Palace</option>
                                    <option value="385">West Gate Towers</option>
                                    <option value="386">West Gate Vacation Villas</option>
                                    <option value="384">Westgate Inn</option>
                                    <option value="68">Westin Grand Bohemian</option>
                                    <option value="66">Westside Inn &amp; Suites</option>
                                    <option value="183">Wet 'n' Wild</option>
                                    <option value="529">Wilderness Lodge</option>
                                    <option value="184">Wingate Hotel</option>
                                    <option value="185">Wyndham Orlando Resort</option>
                                    <option value="522">Wyndham Palace Resorts</option>
                                    <option value="388">Yacht Club</option>
                                  </optgroup>
                </select>
 </p>




</div>








<div class="seat-sec">
<span>
<p><input name="" type="checkbox" value="" /></p>
<p>Booster Seat </p>
<p><input name="" type="checkbox" value="yes" /></p>
<p>Grocery Stop  </p>
<p><input name="" type="checkbox" value="" /></p>
<p>Car Seat</p>
</span>
</div>


</div>



<!--Disney-->
<div class="trans-mid-inn">
<div class="pass-left">

<p>Location 1</p>
<p>
<select name="location1" id="location1" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                  
                                     <optgroup label="Theme Parks">
                  <option value="431">Universal Studios</option>
                  <option value="432">Sea World</option>
                                      </optgroup>
                                      <optgroup label="Disney resorts">
                                                       <option value="441">AKL Resort</option>
                                    <option value="440">All Star Movies</option>
                                    <option value="439">All Star Music</option>
                                    <option value="438">All Star Sports</option>
                                    <option value="443">Beach Club Resort</option>
                                    <option value="457">Best western LBV</option>
                                    <option value="442">Board Walk Resort</option>
                                    <option value="451">Caribbean Beach Resort</option>
                                    <option value="433">Contemporary</option>
                                    <option value="445">Coronado Springs </option>
                                    <option value="446">Dolphin Resort</option>
                                    <option value="434">Grand Floridian</option>
                                    <option value="455">Hilton LBV</option>
                                    <option value="452">Old Key West Resort</option>
                                    <option value="436">Polynesian</option>
                                    <option value="450">Pop Century Resort</option>
                                    <option value="448">Port Orleans French Quarter Resort</option>
                                    <option value="449">Port Orleans Riverside Resort </option>
                                    <option value="456">Regal Sun LBV</option>
                                    <option value="458">Royal Plaza LBV</option>
                                    <option value="453">Saratoga Springs Resort</option>
                                    <option value="432">Sea World</option>
                                    <option value="437">Shades of Green</option>
                                    <option value="447">Swan Resort</option>
                                    <option value="431">Universal Studios</option>
                                    <option value="435">Wilderness Lodge</option>
                                    <option value="454">Wyndham Palace Resorts</option>
                                    <option value="444">Yacht Club Resort</option>
                                  </optgroup>
                </select>
 </p>
 
 <p>Location 2</p>
<p>
<select name="location2" id="location2" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <optgroup label="Cruise Lines">
                                                       <option value="423c">Disney Cruise Line</option>
                                    <option value="424c">Carnival Cruise Line - Glory</option>
                                    <option value="425c">Carnival Cruise Line - Elasion</option>
                                    <option value="426c">Norwegian Cruise Line</option>
                                    <option value="427c">Royal Caribbean International</option>
                                    <option value="428c">Radisson Resort</option>
                                    <option value="429c">Royal Mansions Resort</option>
                                    <option value="430c">Other</option>
                                  </optgroup>
                </select>
 </p>
 
 
 <p>Location 3</p>
<p>
<select name="location3" id="location3" required="yes" size="1">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                     <optgroup label="Orlando Airports">
                  <option value="421">Orlando International Airport</option>
                                      </optgroup>
                </select>
 </p>
 
</div>

</div>






</div>



<div class="pass-bott"><img src="images/transfer-bott.jpg" width="738" height="13" /></div>
</div>




<div class="passenger">
<div class="pass-top"><img src="images/payment-top.jpg"/></div>
<div class="pmt-mid">


<div class="pmt-mid-inn">
<h2>Payment Details</h2>

<h3>
<p>
<input name="" type="checkbox" value="" style="width:20px; "/>
</p>

<p>
Billing Information Same as Above
</p>
</h3>

<div class="pass-left">
<p>First Name</p>
<p><input name="" type="text" /></p>

<p>Credit/Debit Card #</p>
<p><input name="" type="text" /></p>


<p>Address</p>
<p><input name="" type="text" /></p>

<p>Create Password</p>
<p><input name="" type="text" /></p>

</div>


<div class="pass-right">


<p>Second Name</p>
<p><input name="" type="text" /></p>

<p class="region">
<span>Expiry Date </span>
<span>CVV #</span>

</p>
<p class="region">
<span><input name="" type="text" /></span>
<span><input name="" type="text" /></span>

</p>


<p class="region">
<span>City</span>
<span>State</span>
<span>Zip</span>
</p>
<p class="region">
<span><input name="" type="text" /></span>
<span><input name="" type="text" /></span>
<span><input name="" type="text" /></span>
</p>

</div>



<h3>
<p>
<input name="" type="checkbox" value="" style="width:20px; "/>
</p>

<p>
I will be paying Cash, do not charge my credit card
</p>
</h3>


</div>


</div>
<div class="pass-bott"><img src="images/payment-bott.jpg" width="738" height="13" /></div>
</div>


<div class="foot-txt">
By clicking the submit button below you are confirming this reservation
and we will have a driver waiting for you at the location mentioned above with no credit card needed.
Reservations are confirmed immediately and a detailed confirmation will be emailed to you.
</div>


<div align="center"><input name="" type="button"  class="btn"/></div>

</div>

</body>
</html>
