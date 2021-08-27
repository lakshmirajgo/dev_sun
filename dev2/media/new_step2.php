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

print '<pre>';
print_r ($_SESSION);
print_r ($_POST);
print ',</pre>';
print '=====================================';

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
		 } ;
//end quote	summary variables

if  ($_SESSION['child_boosterseat'] == 'Yes') {$child_booster =  "checked";};
if  ($_SESSION['child_carseat'] == 'Yes') {$child_carseat =  "checked";};
?>





<!-- head of page -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Disney Transportation | Orlando Limo | MCO Airport Limousine, Shuttle, Towncar | Ground Transportation</title>
<link href="css/master.css" rel="stylesheet" type="text/css" />

		<!--// jQuery STUFF //-->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.0/jquery-ui.min.js"></script>
		<script type="text/javascript" src="jquery-ui-timepicker-addon.js"></script>

		<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.0/themes/smoothness/jquery-ui.css" />
		<link rel="stylesheet" media="all" type="text/css" href="jquery-ui-timepicker-addon.css" />
		
		
<script language="JavaScript">

function setVisibility() {
document.getElementById("pane01").style.display = "none";
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

function getNewContent(val, loc1){
//alert(val);
http.open('get','loadlocations2.php?val='+val+'&loc1='+loc1);
http.onreadystatechange = updateNewContent;
http.send(null);
return false;
}

function updateNewContent(){
if(http.readyState == 4){
document.getElementById('myLocation').innerHTML = http.responseText;
	if (typeof document.getElementById("from") != 'undefined') {
		document.getElementById("from").value = <?php print $_SESSION['from']; ?>;
	}
if (typeof document.getElementById("to") != 'undefined') {
		document.getElementById("to").value = <?php print $_SESSION['to']; ?>;
	}
}
}

function getNewlocationContent(val){
http.open('get','loadflight1.php?val='+val);
http.onreadystatechange = updateNewLocationContent;
http.send(null);
return false;
}

function updateNewLocationContent(){
if(http.readyState == 4){
document.getElementById('myLocationdetails').innerHTML = http.responseText;
}
}

function getNewlocationtoContent(val){
http.open('get','loadflight2.php?val='+val);
http.onreadystatechange = updateNewLocationtoContent;
http.send(null);
return false;
}

function updateNewLocationtoContent(){
if(http.readyState == 4){
document.getElementById('myLocationdetailsto').innerHTML = http.responseText;
document.getElementById("from").value = <?php print $_SESSION['from']; ?>;
}
}
</script>



<script type="text/javascript" >



window.onload = function () {
							getNewContent(<?php print $_SESSION['trip_type']; ?>, <?php print $_SESSION['from']; ?>);
							if (typeof document.getElementById("from") != 'null') {
								document.getElementById("Select1").value = <?php print $_SESSION['trip_type']; ?>;
							}

					};

</script>





<script type="text/javascript" src="js/animatedcollapse.js"></script>

<script type="text/javascript">

animatedcollapse.addDiv('pane01', 'fade=1,speed=400,group=pets,hide=1')
animatedcollapse.addDiv('pane02', 'fade=1,speed=400,group=pets,hide=1')

animatedcollapse.ontoggle=function($, divobj, state){ 

}

animatedcollapse.init()

</script>


<!-- End -->


		

		
		<script type="text/javascript">
			
			$(function(){
		
				$('.example-container > pre').each(function(i){
					eval($(this).text());
				});
			});
			
		</script>
  
  
  
  <script>
  $(function() {
  	$('#basic_example_1').datetimepicker();
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
		
		<table>
			<tr>
			<!--begin trip type dropdown-->
				<td>
						<p>Trip Type</p>
						<select name="from" id="Select1" required="yes" size="1"  onchange="javascript:getNewContent(this.value)" >
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
					</td>
					<!--end trip type dropdown-->
					<td>
						Passenger Count<br>
						<input name="" type="text" style="width: 25px;"value = "<?php echo $_SESSION[passenger_count];?>" >
					</td>
					<td>
						Date & Time<br>
					 		<input type="text" name="basic_example_1" id="basic_example_1" style="width: 140px;" value="<?php echo $_SESSION['travel_date']; ?>" />
											
						<pre style="display:none">
							$('#basic_example_1').datetimepicker();
						</pre>
										
					</td>
				</tr>
			</table><br>
			<!--this will display the location dropdowns   -->
			<table>
				<tr>
					<td>
						<p id="myLocation"></p><br><br>
					</td>
				</tr>
			</table>
			<br><br><br><br><br>
			<!--end location drop downs-->	
			<p>

			</p>
		
		
		<div class="seat-sec">
			<span>
				<p><input name="" type="checkbox" value="" <?php echo $child_booster; ?> ></p>
				<p>Booster Seat </p>
				<p><input name="" type="checkbox" value="" /></p>
				<p>Grocery Stop  </p>
				<p><input name="" type="checkbox" value="" <?php echo $child_carseat; ?>/></p>
				<p>Car Seat</p>
			</span>
		</div>
	</div>
	<!--Disney-->
	<div class="trans-mid-inn">
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