<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
include("includes/functions/price_functions.php");	
include("includes/functions/vehicle_functions.php");
include_once("includes/functions/zone_functions.php");	
include_once("includes/functions/trip_type_functions.php");	

//Check permissions for User BEGIN
if (!chech_permissions($_SESSION['user_details'], 'price')) {
//header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/index.php");
echo '<script language="javascript">alert(\'You dont have a permissions access to this page!\');window.location=\'index.php\';</script>';
// Quit the script
exit(); 
}
//Check permissions for User END

	if ($_POST['action'] == 'create_new') {
		if(add_prices())
		echo '<script language="javascript">alert(\'Price created successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error creating price\');</script>';
	}
	
	if ($_GET['cAction'] == 'edit'){
		$price_view = get_current_prices_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			if (edit_prices($_GET['id'])) {
			echo '<script language="javascript">alert(\'Price updated successfully\');</script>';
						$price_view = get_current_prices_view($_GET['id']);
						} else {
			echo '<script language="javascript">alert(\'Error updating price\');</script>';	
			};
		}
	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_prices($delete_id))
		echo '<script language="javascript">alert(\'Price Deleted Successfully\');window.location=\'price_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the price\n\nPlease try again\');window.location=\'price_manager.php\';</script>';
		$all_prices = get_all_prices($_POST['vehicle_id'], $_POST['where']);
	}
	
	if (!empty($_POST['delete_selected'])){
		if(delete_prices($_POST['id']))
		echo '<script language="javascript">alert(\'Price Deleted Successfully\')</script>';
		$all_prices = get_all_prices($_POST['vehicle_id'], $_POST['where']);
	}
		
	include ("includes/common/header.php");	

	$all_vehicles = get_all_vehicles();
    $all_prices = get_all_prices($_POST['vehicle_id'], $_POST['where']);
	 include ("includes/common/menu.php");	
	// Show all prices
	if (empty($_GET['cAction']) || $_GET['cAction'] == 'delete'){
	?>
    <form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="javascript:get(document.getElementsByTagName('create_new'));" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="create_new">
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



http.open('get','loadlocations_for_calculator.php?val='+val);
http.onreadystatechange = updateNewContent;
http.send(null);
return false;
}

function updateNewContent(){
if(http.readyState == 4){
document.getElementById('myLocation').innerHTML = http.responseText;
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
</script>
<script language="Javascript">
function xmlhttpPost(strURL) {
    var xmlHttpReq = false;
    var self = this;
    // Mozilla/Safari
    if (window.XMLHttpRequest) {
        self.xmlHttpReq = new XMLHttpRequest();
    }
    // IE
    else if (window.ActiveXObject) {
        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
    self.xmlHttpReq.open('POST', strURL, true);
    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    self.xmlHttpReq.onreadystatechange = function() {
        if (self.xmlHttpReq.readyState == 4) {
            updatepage(self.xmlHttpReq.responseText);
        }
    }
    self.xmlHttpReq.send(getquerystring());
}

function getquerystring() {
    var form     = document.forms['create_new'];
	var vehicle_id = form.vehicle_id.value;
    var passenger_count = form.passenger_count.value;
	var trip_type = form.trip_type.value;
	var from1 = form.from1.value;
	var to1 = form.to1.value;

	qstr = 'vehicle_id=' + escape(vehicle_id) +  '&passenger_count=' + escape(passenger_count) +  '&trip_type=' + escape(trip_type) +  '&from1=' + escape(from1) +  '&to1=' + escape(to1);  // NOTE: no '?' before querystring
    return qstr;
}

function updatepage(str){
    //document.getElementById("result").innerHTML = str;
	document.create_new.total_amount.value = str;
}
</script>

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>PRICE CALCULATOR</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Vehicle</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="vehicle_id" id="vehicle_id" size="1" class="bodytxt">
                  <?php 
				
				if(count($all_vehicles)>=1){
				foreach($all_vehicles as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </select></td>
			  </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Passengers</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="passenger_count" id="passenger_count" size="1" class="bodytxt">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Trip Type</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="trip_type" id="trip_type" required="yes" size="1" onchange="javascript:getNewContent(this.value);">
                                      <option value="" selected="selected"> -- Select One -- </option>
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
                                      <OPTGROUP LABEL="Shades of Green Transfer">
                                      	<optgroup label="&nbsp;&nbsp;GATEWAYS">
                                      	<option value="14">Shades of Green To Orlando Airport</option>
                                      	<option value="15">From Orlando Airport to Shades of Green</option>
                                      	<option value="16">Shades of Green to Orlando Exec. Airport</option>
                                      	<option value="17">Shades of Green to Sanford Airport</option>
                                      	<option value="18">From Sanford Airport to Shades of Green</option>
                                      	<option value="19">Shades of Green - Greyhound</option>
                                      	<option value="20">Shades of Green - Amtrak Orlando</option>
                                      	<option value="21">Shades of Green - Amtrak Kissimmee</option>
                                      	<option value="22">Shades of Green - Port Canaveral</option>
                                        <option value="75">Round trip: Shades of Green - Orlando Airport</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;DISNEY ATTRACTIONS">
                                      	<option value="23">Shades of Green - Animal Kingdom</option>
                                      	<option value="24">Shades of Green - Blizzard Beach</option>
                                      	<option value="25">Shades of Green - Epcot Center</option>
                                      	<option value="26">Shades of Green - Magic Kingdom</option>
                                      	<option value="27">Shades of Green - Hollywood Studios</option>
                                      	<option value="28">Shades of Green - Downtown Disney</option>
                                      	<option value="29">Shades of Green - Typhoon Lagoon</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;ATTRACTIONS">
                                      	<option value="30">Shades of Green - Pirate Dinner Show</option>
                                      	<option value="31">Shades of Green - Arabian Knights</option>
                                      	<option value="32">Shades of Green - Bush Gardens</option>
                                      	<option value="33">Shades of Green - Citrus Bowl</option>
                                      	<option value="34">Shades of Green - Gatorland</option>
                                      	<option value="35">Shades of Green - Kennedy Space Center</option>
                                      	<option value="36">Shades of Green - Medevil Times</option>
                                      	<option value="37">Shades of Green - Sea World</option>
                                      	<option value="38">Shades of Green - Amway Arena</option>
                                      	<option value="39">Shades of Green - Univeral Studios</option>
                                      	<option value="40">Shades of Green - Wet'n Wild</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;DISNEY RESORTS">
                                      	<option value="41">Shades of Green - Swan/Dolphin</option>
                                      	<option value="42">Shades of Green - Epcot Resorts</option>
                                      	<option value="43">Shades of Green - Coranado Springs</option>
                                      	<option value="44">Shades of Green - All Star Resorts</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;GOLF COURSES">
                                      	<option value="45">Shades of Green - Bay Hill</option>
                                      	<option value="46">Shades of Green - Villas of Grand Cypress</option>
                                      	<option value="47">Shades of Green - Lake Buena Vista Golf</option>
                                      	<option value="48">Shades of Green - Lake Nona</option>
                                      	<option value="49">Shades of Green - Eagle Pine/Osprey Ridge</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;SHOPPING">
                                      	<option value="50">Shades of Green - Belz Factory Outlet</option>
                                      	<option value="51">Shades of Green - Crossroads LBV</option>
                                      	<option value="52">Shades of Green - Florida Mall</option>
                                      	<option value="53">Shades of Green - Mall of Millenia</option>
                                      	<option value="54">Shades of Green - Point Orlando</option>
                                      	<option value="55">Shades of Green - Premium Outlet</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;RESTAURANTS">
                                      	<option value="56">Shades of Green - Antonio's Sandlake</option>
                                      	<option value="57">Shades of Green - Charley's Steak 192</option>
                                      	<option value="58">Shades of Green - Charley's Steak I-Drive</option>
                                      	<option value="59">Shades of Green - Christini's Fishbone Sandlake</option>
                                      	<option value="60">Shades of Green - Louis Downtown</option>
                                      	<option value="61">Shades of Green - Moonfish Sandlake</option>
                                      	<option value="62">Shades of Green - Morton's of Chicago</option>
                                      	<option value="63">Shades of Green - Rachel's Steak House</option>
                                      	<option value="64">Shades of Green - Ruth Chris Steak House</option>
                                      	<option value="65">Shades of Green - Timpano's</option>
                                      	<option value="66">Shades of Green - Tuscany (MWC)</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;OTHER">
                                      	<option value="67">Shades of Green - Celebrations Hospital</option>
                                      	<option value="68">Shades of Green - Convention Center</option>
                                      	<option value="69">Shades of Green - I-Drive North</option>
                                      	<option value="70">Shades of Green - I-Drive South</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;LBV">
                                      	<option value="71">Shades of Green - Marriott World Center</option>
                                      	<option value="72">Shades of Green - Mary Queen of the Universe</option>
                                     	<option value="73">Shades of Green - Sandlake Hospital</option>
                                      	<option value="74">Shades of Green - South OBT</option>
                                        </optgroup>
									  </OPTGROUP>
                                    </select></td>
              </tr>
              <tr valign="middle">
              	<td colspan="2" height="30"><p id="myLocation" align="center">When you click the trip type, this content will be replaced.</p>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Price</strong></td>
                <td align="left" height="30" width="62%" class="ot2">$<input name="total_amount" id="total_amount" class="bodytxt" size="12" type="text" disabled="disabled" style="color:#FF0000;"> </td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input value="Calculate Total" type="button" onclick='JavaScript:xmlhttpPost("calculate_sog.php")'></td>
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
	</form>
    
    
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>PRICE MANAGER</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top">
                  <form name="search" method="post" action="price_manager.php" style="padding:0px; margin:0px;">
                  Search by <select name="vehicle_id" size="1" class="bodytxt">
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
                </select> Price <input name="where" class="bodytxt" size="20" type="text">
                  </form>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="right" height="20" valign="top"><a href="price_manager.php?cAction=create_new"><img src="images/add_price.jpg" border="0" type="image" alt="Add a New Price" title="Add a New Price"></a></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
          	<td>
            <form name="displayfrm" method="post" action="price_manager.php">
		<input type="hidden" value="" name="action">
		<table width="770" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bodytxt" style="margin-top: 10px;">
             <tr bgcolor="#646464" >
               		  <td width="37" style="font-weight: bold; color:#FFFFFF"></td>
                      <td width="22"></td>
                      <td width="100" align="left" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Vehicle</td>
                      <td width="484" align="left" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Price Title</td>
                      <td width="100" align="center" height="22" style="font-weight: bold; color:#FFFFFF" class="ot1">Price Value</td>
                      <td width="22"></td>
                      <td width="5"></td>
                  </tr>
                  <?php 	
					if(count($all_prices)>=1){
					foreach($all_prices as $value){
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
                      <td width="37" height="22" align="center" class="ot1"><input name="id[]" type="checkbox" value="<?php echo $value['id']; ?>"></td>
                      <td width="22" height="22" align="center"><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Edit"><img src="images/edit.png" border="0" /></a></td> 
                      <td width="100" align="left" class="ot1"><?php $vehicle_view = get_vehicles_view($value['vehicle_id']); echo $vehicle_view['name']; ?></td>
                      <td width="484" align="left" class="ot1"><strong><a href="?cAction=edit&id=<?php echo $value['id']; ?>" class="bodytxt" title="Edit Page"><?php if (empty($value['location1_id'])) { $trip_type = get_trip_types_view($value['trip_type']); echo $trip_type['name']; } else { $from = get_zones_view($value['location1_id']); $to = get_zones_view($value['location2_id']); echo $from['name']; ?> to <?php echo $to['name']; $trip_type = get_trip_types_view($value['trip_type']); echo " (".$trip_type['name'].")";  } ?></a></strong></td>                      
                      <td width="100" height="22" align="center">$<?php echo sprintf("%01.2f", $value['price_value']); ?></td>
                      <td width="22" height="22" align="center"><a href="?cAction=delete&id=<?php echo $value['id']; ?>" class="bodytxt" title="Click to Delete"><img src="images/remove.png" border="0" onclick="return confirm('Are you sure you want to delete this price?\n\nNotice: deleted price cannot be restored')" /></a></td> 
                      
                      <td width="5"></td>
                    </tr>
                    <? } 
					
					
						} else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no prices in the database. <a href="price_manager.php?cAction=create_new" class="link1">Create a new price</a></strong></div><table><tr><td></td></tr>'; } 
					?> 
					<tr>
					<td colspan="5"><input name="delete_selected" type="submit" value="Delete selected"  onclick="return confirm('Are you sure you want to delete selected price(s)?\n\nNotice: deleted price(s) cannot be restored')"> </td>
					</tr>
                  </table>  
                 
    </form>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"></td>
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
    </form>
	<?php
	}
	?>
    <?php
	// Create a New Price
	if ($_GET[cAction] == 'create_new') {
	?>
	<form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="price_manager.php" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="create_new">
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


http.open('get','loadlocations_for_prices.php?val='+val);
http.onreadystatechange = updateNewContent;
http.send(null);
return false;
}

function updateNewContent(){
if(http.readyState == 4){
document.getElementById('myLocation').innerHTML = http.responseText;
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
</script>

          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>ADD A NEW PRICE</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Vehicle</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="vehicle_id" id="vehicle_id" size="1" class="bodytxt">
                  <?php 
				
				if(count($all_vehicles)>=1){
				foreach($all_vehicles as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </select></td>
			  </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Trip Type</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="trip_type" id="trip_type" required="yes" size="1" onchange="javascript:getNewContent(this.value);">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Area">
                                      <option value="1">Orlando Area - One Way</option>
                                      <option value="2">Orlando Area - Round Trip</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Cruise Transfer">
                                      <option value="76">Disney/Universal>Cruise>MCO - Round trip</option>
                                      <option value="3">Airport to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="4">Airport to Cruise Terminal/Port Area Resorts - Round Trip</option>
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
                                      <OPTGROUP LABEL="Shades of Green Transfer">
                                      	<optgroup label="&nbsp;&nbsp;GATEWAYS">
                                      	<option value="14">Shades of Green To Orlando Airport</option>
                                      	<option value="15">From Orlando Airport to Shades of Green</option>
                                      	<option value="16">Shades of Green to Orlando Exec. Airport</option>
                                      	<option value="17">Shades of Green to Sanford Airport</option>
                                      	<option value="18">From Sanford Airport to Shades of Green</option>
                                      	<option value="19">Shades of Green - Greyhound</option>
                                      	<option value="20">Shades of Green - Amtrak Orlando</option>
                                      	<option value="21">Shades of Green - Amtrak Kissimmee</option>
                                      	<option value="22">Shades of Green - Port Canaveral</option>
                                        <option value="75">Round trip: Shades of Green - Orlando Airport</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;DISNEY ATTRACTIONS">
                                      	<option value="23">Shades of Green - Animal Kingdom</option>
                                      	<option value="24">Shades of Green - Blizzard Beach</option>
                                      	<option value="25">Shades of Green - Epcot Center</option>
                                      	<option value="26">Shades of Green - Magic Kingdom</option>
                                      	<option value="27">Shades of Green - Hollywood Studios</option>
                                      	<option value="28">Shades of Green - Downtown Disney</option>
                                      	<option value="29">Shades of Green - Typhoon Lagoon</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;ATTRACTIONS">
                                      	<option value="30">Shades of Green - Pirate Dinner Show</option>
                                      	<option value="31">Shades of Green - Arabian Knights</option>
                                      	<option value="32">Shades of Green - Bush Gardens</option>
                                      	<option value="33">Shades of Green - Citrus Bowl</option>
                                      	<option value="34">Shades of Green - Gatorland</option>
                                      	<option value="35">Shades of Green - Kennedy Space Center</option>
                                      	<option value="36">Shades of Green - Medevil Times</option>
                                      	<option value="37">Shades of Green - Sea World</option>
                                      	<option value="38">Shades of Green - Amway Arena</option>
                                      	<option value="39">Shades of Green - Univeral Studios</option>
                                      	<option value="40">Shades of Green - Wet'n Wild</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;DISNEY RESORTS">
                                      	<option value="41">Shades of Green - Swan/Dolphin</option>
                                      	<option value="42">Shades of Green - Epcot Resorts</option>
                                      	<option value="43">Shades of Green - Coranado Springs</option>
                                      	<option value="44">Shades of Green - All Star Resorts</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;GOLF COURSES">
                                      	<option value="45">Shades of Green - Bay Hill</option>
                                      	<option value="46">Shades of Green - Villas of Grand Cypress</option>
                                      	<option value="47">Shades of Green - Lake Buena Vista Golf</option>
                                      	<option value="48">Shades of Green - Lake Nona</option>
                                      	<option value="49">Shades of Green - Eagle Pine/Osprey Ridge</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;SHOPPING">
                                      	<option value="50">Shades of Green - Belz Factory Outlet</option>
                                      	<option value="51">Shades of Green - Crossroads LBV</option>
                                      	<option value="52">Shades of Green - Florida Mall</option>
                                      	<option value="53">Shades of Green - Mall of Millenia</option>
                                      	<option value="54">Shades of Green - Point Orlando</option>
                                      	<option value="55">Shades of Green - Premium Outlet</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;RESTAURANTS">
                                      	<option value="56">Shades of Green - Antonio's Sandlake</option>
                                      	<option value="57">Shades of Green - Charley's Steak 192</option>
                                      	<option value="58">Shades of Green - Charley's Steak I-Drive</option>
                                      	<option value="59">Shades of Green - Christini's Fishbone Sandlake</option>
                                      	<option value="60">Shades of Green - Louis Downtown</option>
                                      	<option value="61">Shades of Green - Moonfish Sandlake</option>
                                      	<option value="62">Shades of Green - Morton's of Chicago</option>
                                      	<option value="63">Shades of Green - Rachel's Steak House</option>
                                      	<option value="64">Shades of Green - Ruth Chris Steak House</option>
                                      	<option value="65">Shades of Green - Timpano's</option>
                                      	<option value="66">Shades of Green - Tuscany (MWC)</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;OTHER">
                                      	<option value="67">Shades of Green - Celebrations Hospital</option>
                                      	<option value="68">Shades of Green - Convention Center</option>
                                      	<option value="69">Shades of Green - I-Drive North</option>
                                      	<option value="70">Shades of Green - I-Drive South</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;LBV">
                                      	<option value="71">Shades of Green - Marriott World Center</option>
                                      	<option value="72">Shades of Green - Mary Queen of the Universe</option>
                                     	<option value="73">Shades of Green - Sandlake Hospital</option>
                                      	<option value="74">Shades of Green - South OBT</option>
                                        </optgroup>
									  </OPTGROUP>
                                    </select></td>
              </tr>
              <tr valign="middle">
              	<td colspan="2" height="30"><p id="myLocation" align="center">When you click the trip type, this content will be replaced.</p>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Price</strong></td>
                <td align="left" height="30" width="62%" class="ot2">$<input name="price_value" class="bodytxt" size="12" type="text"></td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input src="images/but_create.jpg" border="0" height="22" type="image" width="68"></td>
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
	</form>
	<?php
	}
	?>
    <?php
	// Edit Price
	if ($_GET[cAction] == 'edit') {
	?>
	<form id="edit_price" style="padding-bottom:0px;" name="edit_price" method="post" action="price_manager.php?cAction=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="edit">
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


http.open('get','loadlocations_for_prices.php?val='+val);
http.onreadystatechange = updateNewContent;
http.send(null);
return false;
}

function updateNewContent(){
if(http.readyState == 4){
document.getElementById('myLocation').innerHTML = http.responseText;
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
</script>
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>EDIT PRICE</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Vehicle</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $vehicle_view = get_vehicles_view($price_view['vehicle_id']); ?>
                <select name="vehicle_id" id="vehicle_id" size="1" class="bodytxt">
                  <option value="<?php echo $price_view['vehicle_id']; ?>"><?php echo $vehicle_view['name']; ?></option>
                  <?php 
				
				if(count($all_vehicles)>=1){
				foreach($all_vehicles as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </select></td>
			  </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Trip Type</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php   $trip_type = get_trip_types_view($price_view['trip_type']); ?>
                <select name="trip_type" id="trip_type" required="yes" size="1" onchange="javascript:getNewContent(this.value);">
                                      <option value="<?php echo $price_view['trip_type']; ?>" selected="selected"><?php echo $trip_type['name']; ?></option>
                                      <OPTGROUP LABEL="Orlando Area">
                                      <option value="1">Orlando Area - One Way</option>
                                      <option value="2">Orlando Area - Round Trip</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Cruise Transfer">
                                      <option value="76">Disney/Universal>Cruise>MCO - Round trip</option>
                                      <option value="3">Airport to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="4">Airport to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="5">Disney/Universal to Cruise Terminal/Port Area - One Way</option>
                                      <option value="6">Disney/Universal to Cruise Terminal/Port Area - Round Trip</option>
                                      <option value="7">MCO>Disney or Universal>Cruise terminal>MCO (3 leg)</option>
                                      <option value="8">MCO>Cruise Terminals>Disney or Universal>MCO (3 leg)</option>
									  </OPTGROUP>
                                      <OPTGROUP LABEL="Attraction Transfer">
                                      <option value="12">Disney Resort to Universal/Sea World - One Way</option>
                                      <option value="13">Disney Resort to Universal/Sea World - Round Trip</option>
                                      <option value="77">Disney Resort to SeaWorld Theme Park - One Way</option>
                                      <option value="78">Disney Resort to SeaWorld Theme Park - Round Trip</option>
                                      <option value="79">Disney Resort to Universal Theme Park - One Way</option>
                                      <option value="80">Disney Resort to Universal Theme Park - Round Trip</option>
									  </OPTGROUP>
                                      <OPTGROUP LABEL="Shades of Green Transfer">
                                      	<optgroup label="&nbsp;&nbsp;GATEWAYS">
                                      	<option value="14">Shades of Green To Orlando Airport</option>
                                      	<option value="15">From Orlando Airport to Shades of Green</option>
                                      	<option value="16">Shades of Green to Orlando Exec. Airport</option>
                                      	<option value="17">Shades of Green to Sanford Airport</option>
                                      	<option value="18">From Sanford Airport to Shades of Green</option>
                                      	<option value="19">Shades of Green - Greyhound</option>
                                      	<option value="20">Shades of Green - Amtrak Orlando</option>
                                      	<option value="21">Shades of Green - Amtrak Kissimmee</option>
                                      	<option value="22">Shades of Green - Port Canaveral</option>
                                        <option value="75">Round trip: Shades of Green - Orlando Airport</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;DISNEY ATTRACTIONS">
                                      	<option value="23">Shades of Green - Animal Kingdom</option>
                                      	<option value="24">Shades of Green - Blizzard Beach</option>
                                      	<option value="25">Shades of Green - Epcot Center</option>
                                      	<option value="26">Shades of Green - Magic Kingdom</option>
                                      	<option value="27">Shades of Green - Hollywood Studios</option>
                                      	<option value="28">Shades of Green - Downtown Disney</option>
                                      	<option value="29">Shades of Green - Typhoon Lagoon</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;ATTRACTIONS">
                                      	<option value="30">Shades of Green - Pirate Dinner Show</option>
                                      	<option value="31">Shades of Green - Arabian Knights</option>
                                      	<option value="32">Shades of Green - Bush Gardens</option>
                                      	<option value="33">Shades of Green - Citrus Bowl</option>
                                      	<option value="34">Shades of Green - Gatorland</option>
                                      	<option value="35">Shades of Green - Kennedy Space Center</option>
                                      	<option value="36">Shades of Green - Medevil Times</option>
                                      	<option value="37">Shades of Green - Sea World</option>
                                      	<option value="38">Shades of Green - Amway Arena</option>
                                      	<option value="39">Shades of Green - Univeral Studios</option>
                                      	<option value="40">Shades of Green - Wet'n Wild</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;DISNEY RESORTS">
                                      	<option value="41">Shades of Green - Swan/Dolphin</option>
                                      	<option value="42">Shades of Green - Epcot Resorts</option>
                                      	<option value="43">Shades of Green - Coranado Springs</option>
                                      	<option value="44">Shades of Green - All Star Resorts</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;GOLF COURSES">
                                      	<option value="45">Shades of Green - Bay Hill</option>
                                      	<option value="46">Shades of Green - Villas of Grand Cypress</option>
                                      	<option value="47">Shades of Green - Lake Buena Vista Golf</option>
                                      	<option value="48">Shades of Green - Lake Nona</option>
                                      	<option value="49">Shades of Green - Eagle Pine/Osprey Ridge</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;SHOPPING">
                                      	<option value="50">Shades of Green - Belz Factory Outlet</option>
                                      	<option value="51">Shades of Green - Crossroads LBV</option>
                                      	<option value="52">Shades of Green - Florida Mall</option>
                                      	<option value="53">Shades of Green - Mall of Millenia</option>
                                      	<option value="54">Shades of Green - Point Orlando</option>
                                      	<option value="55">Shades of Green - Premium Outlet</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;RESTAURANTS">
                                      	<option value="56">Shades of Green - Antonio's Sandlake</option>
                                      	<option value="57">Shades of Green - Charley's Steak 192</option>
                                      	<option value="58">Shades of Green - Charley's Steak I-Drive</option>
                                      	<option value="59">Shades of Green - Christini's Fishbone Sandlake</option>
                                      	<option value="60">Shades of Green - Louis Downtown</option>
                                      	<option value="61">Shades of Green - Moonfish Sandlake</option>
                                      	<option value="62">Shades of Green - Morton's of Chicago</option>
                                      	<option value="63">Shades of Green - Rachel's Steak House</option>
                                      	<option value="64">Shades of Green - Ruth Chris Steak House</option>
                                      	<option value="65">Shades of Green - Timpano's</option>
                                      	<option value="66">Shades of Green - Tuscany (MWC)</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;OTHER">
                                      	<option value="67">Shades of Green - Celebrations Hospital</option>
                                      	<option value="68">Shades of Green - Convention Center</option>
                                      	<option value="69">Shades of Green - I-Drive North</option>
                                      	<option value="70">Shades of Green - I-Drive South</option>
                                      	</optgroup>
                                        <optgroup label="&nbsp;&nbsp;LBV">
                                      	<option value="71">Shades of Green - Marriott World Center</option>
                                      	<option value="72">Shades of Green - Mary Queen of the Universe</option>
                                     	<option value="73">Shades of Green - Sandlake Hospital</option>
                                      	<option value="74">Shades of Green - South OBT</option>
                                        </optgroup>
									  </OPTGROUP>
                                    </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>From Zone</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $from = get_zones_view($price_view['location1_id']); ?>
				<select name="from" size="1" class="bodytxt">
                <option value="<?php echo $price_view['location1_id']; ?>"><?php echo $from['name']; ?> - <?php echo $from['description']; ?></option>
                <?php 
				$all_zones = get_all_zones();
				if(count($all_zones)>=1){
				foreach($all_zones as $value){
				?>
				<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?> - <?php echo $value['description']; ?></option>
                <?php
					}
				}
				?>
                </select>
				</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>To Zone</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $to = get_zones_view($price_view['location2_id']); ?>
				<select name="to" size="1" class="bodytxt">
                <option value="<?php echo $price_view['location2_id']; ?>"><?php echo $to['name']; ?> - <?php echo $to['description']; ?></option>
                <?php 
				
				if(count($all_zones)>=1){
				foreach($all_zones as $value){
				?>
				<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?> - <?php echo $value['description']; ?></option>
                <?php
					}
				}
				?>
                </select>
				</td>
              </tr>

              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Custom Bundle:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="custom_bundle" class="bodytxt" size="69" type="text" value="<?php echo $price_view['custom_bundle']; ?>"></td>
              </tr>
              <tr valign="middle">
              	<td colspan="2" height="30"><p id="myLocation" align="center">When you click the trip type, this content will be replaced.</p>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Price</strong></td>
                <td align="left" height="30" width="62%" class="ot2">$<input name="price_value" class="bodytxt" size="12" type="text" value="<?php echo $price_view['price_value']; ?>"></td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input src="images/but_update.jpg" border="0" height="22" type="image" width="68"></td>
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
	</form>
	<?php
	}
	?>
<?php
unset ($_SESSION['redirect']);
include ("includes/common/footer.php");
?>