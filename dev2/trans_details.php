<?php
session_start();
if (isset ($_SESSION['trip_type'])) {unset ($_SESSION['trip_type']);};
if (isset ($_SESSION['to'])) {unset ($_SESSION['to']);};
if (isset ($_SESSION['from'])) {unset ($_SESSION['from']);};
if (isset ($_SESSION['from1'])) {unset ($_SESSION['from1']);};
if (isset ($_SESSION['to1'])) {unset ($_SESSION['to1']);};
if (isset ($_SESSION['from2'])) {unset ($_SESSION['from2']);};
if (isset ($_SESSION['to2'])) {unset ($_SESSION['to2']);};
if (isset ($_SESSION['from3'])) {unset ($_SESSION['from3']);};
if (isset ($_SESSION['to3'])) {unset ($_SESSION['to3']);};
if (isset ($_SESSION['location1'])) {unset ($_SESSION['location1']);};
if (isset ($_SESSION['location2'])) {unset ($_SESSION['location2']);};
if (isset ($_SESSION['location3'])) {unset ($_SESSION['location3']);};
if (isset ($_POST['confirm_y'])) {unset ($_POST['confirm_y']);};
if (isset ($_POST['confirm_x'])) {unset ($_POST['confirm_x']);};
if (isset ($_POST['x'])) {unset ($_POST['x']);};
if (isset ($_POST['y'])) {unset ($_POST['y']);};
if (isset ($_POST['submit3'])) {unset ($_POST['submit3']);};
if (isset ($_SESSION['submit3'])) {unset ($_SESSION['submit3']);};
if (isset($_POST)) {
 foreach($_POST as $key => $val)
    $_SESSION[$key] = $val;
 };
include ("includes/functions/general_functions.php");
include ("includes/functions/location_functions.php");
include ("includes/functions/price_functions.php");
include ("includes/functions/vehicle_functions.php");
include_once("includes/functions/trip_type_functions.php");			
include_once("includes/functions/general_functions.php");
include("includes/functions/client_functions.php");
include ("includes/functions/reservation_functions.php");

//gets returning user data variables
if(isset($_POST['email']) && isset($_POST['password']) &&  $_POST['logging_in'] == 'true'){
	if(login($_POST['email'], $_POST['password']) || master_login($_POST['email'], $_POST['password'])){
		$_SESSION['auth'] = 1;
//			$client_view = get_client_view($_POST['email']);
		$client_view = get_client_view($_SESSION['email']);
		$_SESSION['client_id'] = $client_view['id'];
		$_SESSION['client_first_name'] = $client_view['first_name'];
		$_SESSION['client_last_name'] = $client_view['last_name'];
		$_SESSION['client_address'] = $client_view['address'];
		$_SESSION['client_address2'] = $client_view['address2'];
		$_SESSION['client_city'] = $client_view['city'];
		$_SESSION['client_state'] = $client_view['state'];
		$_SESSION['client_first_name'] = $client_view['first_name'];
		$_SESSION['client_zip'] = $client_view['zip'];
		$_SESSION['client_telephone'] = $client_view['telephone'];
		unset ($_POST['logging_in']);
		unset ($_SESSION['logging_in']);
		}
}

if(isset($_SESSION['email']) && isset($_SESSION['client_id']) && !isset($_POST['logging_in']) && $_SESSION['auth'] == '1'){
	$_SESSION['email'] = $_SESSION['email'];
	$client_view = get_client_view($_SESSION['email']);
	$_SESSION['client_id'] = $client_view['id'];
	$_SESSION['client_first_name'] = $client_view['first_name'];
	$_SESSION['client_last_name'] = $client_view['last_name'];
	$_SESSION['client_address'] = $client_view['address'];
	$_SESSION['client_address2'] = $client_view['address2'];
	$_SESSION['client_city'] = $client_view['city'];
	$_SESSION['client_state'] = $client_view['state'];
	$_SESSION['client_first_name'] = $client_view['first_name'];
	$_SESSION['client_zip'] = $client_view['zip'];
	$_SESSION['client_telephone'] = $client_view['telephone'];
}
//ends returning user data variables
unset ($_POST['password']);
unset ($_SESSION['password']);

//begin quote	summary variables
$company_info = get_company_info(); 
if (empty($_SESSION['trip_type'])) {
	$_SESSION['vehicle'] = $_POST["vehicle"];
	$_SESSION['trip_type']= $_POST["trip_type"];
	$_SESSION['trip_type_new'] = $_POST['trip_type_new'];
	$_SESSION['travel_date']= $_POST["travel_date"];
	$_SESSION['passenger_count']= $_POST["passenger_count"];
	$_SESSION['child_carseat']= $_POST["child_carseat"];
	$_SESSION['child_boosterseat']= $_POST["child_boosterseat"];
	$_SESSION['store_stop']= $_POST["store_stop"];
	if (!empty($_POST["from"])) {$_SESSION['from']= $_POST["from"];};
	if (!empty($_POST["to"])) {$_SESSION['to']= $_POST["to"];};	
	if ($_SESSION['trip_type'] == '7' || $_SESSION['trip_type'] == '8' || $_SESSION['trip_type'] == '10') {
		$_SESSION['location1']= $_POST["location1"];
		$_SESSION['location2']= $_POST["location2"];
		$_SESSION['location3']= $_POST["location3"];
	};	

};
$_GET['redirect'] = "new_step2.php";
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


//set trip details
if ($_SESSION['num_legs'] != '3') {
	$trip_details1 = '
		if (typeof document.getElementById("from") != \'null\') {
			document.getElementById("from").value = "'  .$_SESSION['from'].'" ;}
		if (typeof document.getElementById("to") != \'null\') {
			document.getElementById("to").value = "' .$_SESSION['to'].'" ;}';
	$trip_details2 = '<div id="from_top"><span>From: </span>'.$from['name'].'</div><div id="to_top"><span>To:</span>'.$to['name'].'</div>';
};
				
if ($_SESSION['num_legs'] == '3') {
	$trip_details1 = '
	if (typeof document.getElementById("location1") != \'null\') {
		document.getElementById("location1").value = "' .$_SESSION['location1'].'" ;}
	if (typeof document.getElementById("location2") != \'null\') {
		document.getElementById("location2").value = "' .$_SESSION['location2'].'" ;}
	if (typeof document.getElementById("location3") != \'null\') {
		document.getElementById("location3").value = "'.$_SESSION['location3'].'" ;}'; 
	$trip_details2 = " ";

}

//end setting trip details	


print '<pre>';
print_r ($_SESSION);
print '=====================================';
print '</pre>';
print '<pre>';

print_r ($_POST);
print '</pre>';
print '=====================================';


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
		<script type="text/javascript" src="js/animatedcollapse.js"></script>
		
		
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

function getNewContent(val){


http.open('get','loadlocations2.php?val='+val);
http.onreadystatechange = updateNewContent;
http.send(null);
return false;
}

function updateNewContent(){
if(http.readyState == 4){
document.getElementById('myLocation').innerHTML = http.responseText;
<?php echo "$trip_details1" ?>;
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
}
}
</script>



<script type="text/javascript" >



window.onload = function () {
	
	getNewContent (<?php print ($_SESSION['trip_type'])?>);
	if (typeof document.getElementById("Select1") != 'null') {
	document.getElementById("Select1").value = <?php print ($_SESSION['trip_type'])?>};
							}
							
					

</script>




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
  	$('#basic_example_2').datetimepicker();
  	$('#basic_example_3').datetimepicker();
  });
  </script>
  
  
  
  
  
  <script type="text/javascript">
function clearText(field){

    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;

}
</script>

<script>
function FillBilling(f) {
  if(f.billingtoo.checked == true) {
    f.billing_firstname.value = f.client_first_name.value;
    f.billing_last_name.value = f.client_last_name.value;
    f.billing_address.value = f.client_address.value;
    f.billing_city.value = f.client_city.value;
    f.billing_state.value = f.client_state.value;
    f.billing_zip.value = f.client_zip.value;
  }
  if(f.billingtoo.checked != true) {
    f.billing_firstname.value = " ";
    f.billing_last_name.value = " ";
    f.billing_address.value = " ";
    f.billing_city.value = " ";
    f.billing_state.value = " ";
    f.billing_zip.value = " "; 
   }
  
  
}



</script>



		
				<!--// jQuery STUFF //-->
				<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
				<script type="text/javascript" src="http://code.jquery.com/ui/1.10.0/jquery-ui.min.js"></script>
				<script type="text/javascript" src="jquery-ui-timepicker-addon.js"></script>
		
				<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.0/themes/smoothness/jquery-ui.css" />
				<link rel="stylesheet" media="all" type="text/css" href="jquery-ui-timepicker-addon.css" />
				<script type="text/javascript" src="js/animatedcollapse.js"></script>
				
				
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




<script type="text/javascript" src="includes/js/date.js"></script>
<script type="text/javascript" src="scripts/custom_elements.js"></script>
<script type="text/javascript" src="includes/js/validate.js"></script>
<script type="text/javascript" src="includes/js/menu.js"></script>

<script language="javascript" type="text/javascript">
//<![CDATA[
var cot_loc0=(window.location.protocol == "https:")? "https://www.sunstatelimo.com/includes/js/cot.js" :
"https://www.sunstatelimo.com/includes/js/cot.js";
document.writeln('<scr' + 'ipt language="JavaScript" src="'+cot_loc0+'" type="text\/javascript">' + '<\/scr' + 'ipt>');
//]]>
</script>
</head>

<body>

<div class="wrap">

<div id="Header">
	<table cellspacing="0" cellpadding="0" border="0" width="100%">
		<tbody>
			<tr>
				<td width="19%" valign="middle"><img alt="Sunstate" src="images/sunstate.gif"></td>
				<td align="right" width="81%"><img height="102" border="0" width="367" usemap="#Map" src="images/topRightCars.jpg"></td>
			</tr>
		</tbody>
	</table>		
          
       
</div>


<div id="price_line"> <span align:left><?php echo $price_val;?></span> <span align:right> - <?php echo $vehicle['name']; ?></span> - <span STYLE = "align:right; font-size:12pt" ><?php echo $trip_type['name']; ?></span> </div>
<div id="details">
	<!--<div id="from_top"><span>From: </span><?php echo $from['name'];?></div><div id="to_top"><span>To:</span><?php echo $from['name'];?></div>-->
	<?php echo $trip_details2;?>
</div>
<div id="botom_line">For round trip you can enter return date on next step The above quote includes everything except your drivers gratuity</div>








<form id="reserve" style="padding-bottom:0px;" name="reserve" method="post" action="submit_order2.php">
<div class="pass-mid">
	

			
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
		  $from[$count] = get_locations_view($_SESSION['from'.$count.'']);
		  $to[$count] = get_locations_view($_SESSION['to'.$count.'']);
		  ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
           <tr>
           	  <td width="100%" class="ot">
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              <td colspan="2" width="100%" valign="top" align="center" class="BorderBox" style="padding:5px;"><br>
              <strong><?php if(check_departure($_SESSION['from'.$count.'']) || check_arrival($_SESSION['from'.$count.'']) || check_departure($_SESSION['to'.$count.'']) || check_arrival($_SESSION['to'.$count.''])) { ?><?php if (check_arrival($_SESSION['from'.$count.''])) { echo "Arrival"; } else { echo "Departure"; }; ?><? } else { echo "Transfer " . $count; }; ?></strong>              </td>
             </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>From:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php echo $from[$count]['name']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><input type="text" name="date<?php echo $count;?>" id="basic_example_<?php echo $count;?>" style="width: 140px;" value="<?php echo $_SESSION['travel_date']; ?>" /></td>
        
        
        
        
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
                <option value="Allegiant Air MCO">Allegiant Air (MCO)</option>                
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
                <td align="left" height="20" width="62%" class="ot2"><select name="h<?php echo $count; ?>" size="1"><?php if (!empty($_SESSION['h'.$count.''])) { echo '<option value="'.$_SESSION['h'.$count.''].'" selected="selected">'.$_SESSION['h'.$count.''].'</option>'; } ;?><option value="12">12</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option></select><select name="m<?php echo $count; ?>" size="1"><?php if (!empty($_SESSION['m'.$count.''])) { echo '<option value="'.$_SESSION['m'.$count.''].'">'.$_SESSION['m'.$count.''].'</option>';
} ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option
value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option
value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm<?php echo $count; ?>" size="1"><?php if (!empty($_SESSION['ampm'.$count.''])) { echo '<option value="'.$_SESSION['ampm'.$count.''].'">'.$_SESSION['ampm'.$count.''].'</option>'; } ;?><option value="AM">AM</option><option value="PM">PM</option></select><br /><span style="font-weight:bold; font-size:11px; color:#FF0000;">Please provide actual <?php if(check_departure($_SESSION['from'.$count.'']) || check_arrival($_SESSION['from'.$count.'']) || check_departure($_SESSION['to'.$count.'']) || check_arrival($_SESSION['to'.$count.''])) { if (check_arrival($_SESSION['from'.$count.''])) { echo "arrival"; } else { echo "departure"; }; } else { echo "pickup"; }; ?> time</span></td>
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
        
      </table>
      </div>
      <br>
  		<center><input src="images/confirm-btn.png" border="0" type="image" onclick="if (validateDate(reserve.date1.value, valDateFmt(reserve.datefmt),valDateRng(reserve.daterng))) {} else {alert('You can only reserve online if your arrival is <?php echo $company_info['minimum_time']*24; ?>hrs prior.\n\nPlease call 407-601-7900 to reserve over the phone'); return false;}; if (validateDate(reserve.date2.value, valDateFmt(reserve.datefmt),valDateRng(reserve.daterng))) {} else {alert('You can only reserve online if your arrival is <?php echo $company_info['minimum_time']*24; ?>hrs prior.\n\nPlease call 407-601-7900 to reserve over the phone'); return false;}; if (validateDate(reserve.date3.value, valDateFmt(reserve.datefmt),valDateRng(reserve.daterng))) {} else {alert('You can only reserve online
if your arrival is <?php echo $company_info['minimum_time']*24; ?>hrs prior.\n\nPlease call 407-601-7900 to reserve over the phone'); return false;}"></center>
  
  
  </form>

    
</div>

<!--End ContentPanl Here -->

</body>
</html>



