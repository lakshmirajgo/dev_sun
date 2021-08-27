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
	include("includes/functions/status_functions.php");		

	if ($_POST['action'] == 'create_new') {
		if(add_reservations())
		echo '<script language="javascript">alert(\'Reservation created successfully\');window.location=\'reservation_manager.php\';</script>';
		else
			echo '<script language="javascript">alert(\'Error creating reservation\');</script>';
	}
	
	if ($_GET['cAction'] == 'status_update') {
		update_status($_GET['status'], $_GET['id']);
		header ("Location: reservation_manager.php");	
	}
	
	if ($_GET['cAction'] == 'edit'){
		$reservation_view = get_reservation_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			if (edit_reservations($_GET['id']))
			echo '<script language="javascript">alert(\'Reservation updated successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error updating reservation\');</script>';
			
			$reservation_view = get_reservation_view($_GET['id']);
		}
	}
	
	if (!empty($_POST['delete_selected'])){
	if (delete_reservations($_POST['id']))
	echo '<script language="javascript">alert(\'Reservation(s) Deleted Successfully\');window.location=\'reservation_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the reservation(s)\n\nPlease try again\');window.location=\'reservation_manager.php\';</script>';
		
	$all_reservations = get_all_reservations();

	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_reservations($delete_id))
		echo '<script language="javascript">alert(\'Reservation Deleted Successfully\');window.location=\'reservation_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the reservation\n\nPlease try again\');window.location=\'reservation_manager.php\';</script>';
		$all_reservations = get_all_reservations();
		
	}
	$all_vehicles = get_all_vehicles();
    $all_reservations = get_all_reservations();
	include ("includes/common/header.php");	
 	include ("includes/common/menu.php");	
	// Show all Reservations
	if (empty($_GET['cAction']) || $_GET['cAction'] == 'delete') {

	get_all_reservations_with_pages();
	
	}
	?>
    <?php
	// Create a New Reservation
	if ($_GET[cAction] == 'create_new') {
	?>
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
	var from = form.from.value;
	var to = form.to.value;

	qstr = 'vehicle_id=' + escape(vehicle_id) +  '&passenger_count=' + escape(passenger_count) +  '&trip_type=' + escape(trip_type) +  '&from=' + escape(from) +  '&to=' + escape(to);  // NOTE: no '?' before querystring
    return qstr;
}

function updatepage(str){
    //document.getElementById("result").innerHTML = str;
	document.create_new.total_amount.value = str;
}
</script>
<span name="myspan" id="myspan"></span>

	<form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="http://www.sunstatelimo.com/new/admin/reservation_manager.php?cAction=create_new" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="create_new">
	<table border="0" cellpadding="0" cellspacing="0" width="580" class="ot">
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
        <form id="create_new" style="padding-bottom:0px;" name="create_new" method="post" action="javascript:get(document.getElementsByTagName('create_new'));" onsubmit="return validate(this)">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody><tr>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>ADD A NEW RESERVATION</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top">
            
            <table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Transportation Information</span></div>              	</td>
              </tr>
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
                <td align="right" height="30" width="38%" class="ob"><strong>Child Car Seat</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="child_carseat" size="1" class="bodytxt">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Child Booster Seat</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="child_boosterseat" size="1" class="bodytxt">
                <option value="No">No</option>
                <option value="Yes">Yes</option>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Transfer Date</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="travel_date" type="text" id="travel_date" size="10" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal1.popup();"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Transfer Date</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="travel_date_roundtrip" type="text" id="travel_date2" size="10" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal2.popup();"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY</td>
              </tr>
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


http.open('get','loadlocations.php?val='+val);
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
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Trip Type</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="trip_type" id="trip_type" required="yes" size="1" onchange="javascript:getNewContent(this.value);">
                                      <option value="" selected="selected"> -- Select One -- </option>
                                      <OPTGROUP LABEL="Orlando Area">
                                      <option value="1">Orlando Area - One Way</option>
                                      <option value="2">Orlando Area - Round Trip</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Cruise Transfer">
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
                                    </select></td>
              </tr>
              <tr valign="middle">
              	<td colspan="2" height="30"><p id="myLocation" align="center">When you click the trip type, this content will be replaced.</p>
                </td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Passenger Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>First Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Last Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address</strong></td>
                <td align="left" height="30"><input name="address" class="bodytxt" size="39" id="address" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2</strong></td>
                <td align="left" height="30"><input name="address2" class="bodytxt" size="39" id="address2" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City</strong></td>
                <td align="left" height="30"><input name="town" class="bodytxt" size="39" id="town" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State</strong></td>
                <td align="left" height="30">
                						<select name="state" id="state" class="bodytxt">
                        <option value="Outside USA">Outside USA</option>                        
                        <option value="AK">AK</option>

                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>

                        <option value="CO">CO</option>
                        <option value="CT">CT</option>

                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>

                        <option value="HI">HI</option>
                        <option value="IA">IA</option>

                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>

                        <option value="KY">KY</option>
                        <option value="LA">LA</option>

                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>

                        <option value="MN">MN</option>
                        <option value="MO">MO</option>

                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>

                        <option value="NE">NE</option>
                        <option value="NH">NH</option>

                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>

                        <option value="OH">OH</option>
                        <option value="OK">OK</option>

                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>

                        <option value="SD">SD</option>
                        <option value="TN">TN</option>

                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VA">VA</option>
                        <option value="VT">VT</option>

                        <option value="WA">WA</option>
                        <option value="WI">WI</option>

                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                      </select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code</strong></td>
                <td align="left" height="30"><input name="zip" class="bodytxt" size="10" id="zip" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country</strong></td>
                <td align="left" height="30">
                <select name="country" id="country" class="bodytxt">
  				<option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option>
                            <option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Azores">Azores</option>
                            <option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia Herzegowina">Bosnia Herzegowina</option>
                            <option value="Bosnia-Herzegovina">Bosnia-Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option><option value="British Indian O. Terr">British Indian O. Terr</option>
                            <option value="British Virgin Isl">British Virgin Isl</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option><option value="Central African Rep">Central African Rep</option><option value="Chad">Chad</option>
                            <option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Isl">Cocos (Keeling) Isl</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option><option value="Congo, The Dem Rep">Congo, The Dem Rep</option><option value="Cook Islands">Cook Islands</option>
                            <option value="Corsica">Corsica</option><option value="Costa Rica">Costa Rica</option><option value="Cote d` Ivoire">Cote d` Ivoire</option>
                            <option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France (Incl Monaco)">France (Incl Monaco)</option>
                            <option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option>
                            <option value="French Polynesia">French Polynesia</option><option value="French S. Territories">French S. Territories</option>
                            <option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option><option value="Heard And Mc Donald Isl">Heard And Mc Donald Isl</option>
                            <option value="Holy See (Vatican City)">Holy See (Vatican City)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option>
                            <option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option>
                            <option value="Ireland (Eire)">Ireland (Eire)</option><option value="Israel">Israel</option><option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic Rep">Korea, Democratic Rep</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option>
                            <option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Madeira Islands">Madeira Islands</option>
                            <option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option>
                            <option value="Moldova, Republic Of">Moldova, Republic Of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option>
                            <option value="Myanmar (Burma)">Myanmar (Burma)</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Isl">Northern Mariana Isl</option><option value="Norway">Norway</option>
                            <option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option>
                            <option value="Palestinian Territory">Palestinian Territory</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia-Montenegro">Serbia-Montenegro</option>
                            <option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option>
                            <option value="Slovak Republic">Slovak Republic</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia">South Georgia</option>
                            <option value="South Korea">South Korea</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option>
                            <option value="St. Christopher, Nevis">St. Christopher, Nevis</option><option value="St. Helena">St. Helena</option><option value="St. Lucia">St. Lucia</option>
                            <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="St. Vincent and Gren">St. Vincent and Gren</option>
                            <option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard And Jan M Isl">Svalbard And Jan M Isl</option>
                            <option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Rep">Syrian Arab Rep</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tristan da Cunha">Tristan da Cunha</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Isl">Turks and Caicos Isl</option><option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option><option value="Great Britain">Great Britain</option>
                            <option value="United States" selected="selected">United States</option><option value="U.S. Minor Outlying Isl">U.S. Minor Outlying Isl</option>
                            <option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Furuna Isl">Wallis and Furuna Isl</option>
                            <option value="Western Sahara">Western Sahara</option><option value="Western Samoa">Western Samoa</option><option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
				</select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>E-mail</strong></td>
                <td align="left" height="30"><input name="email" class="bodytxt" size="39" id="email" type="text"></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="bodytxt">
                <tr>
                	<td width="40%" align="right"><span style="color:#677bca; font-weight:bold;">Cardholder Information</span>&nbsp;&nbsp;&nbsp;</td><td align="center"><input name="billing_adr" value="1" id="billing-checkbox" onclick="auto_address_update(document.create_new)" type="checkbox"></td><td> Billing Address is the same as Shipping Address.</td>
                </tr>
              </table></div>       	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>First Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name_billing" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Last Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name_billing" class="bodytxt" size="39" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address</strong></td>
                <td align="left" height="30"><input name="address_billing" class="bodytxt" size="39" id="address_billing" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2</strong></td>
                <td align="left" height="30"><input name="address2_billing" class="bodytxt" size="39" id="address2_billing" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City</strong></td>
                <td align="left" height="30"><input name="city_billing" class="bodytxt" size="39" id="city_billing" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State</strong></td>
                <td align="left" height="30">
                						<select name="state_billing" id="state_billing" class="bodytxt">
                        <option value="Outside USA">Outside USA</option>                        
                        <option value="AK">AK</option>

                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>

                        <option value="CO">CO</option>
                        <option value="CT">CT</option>

                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>

                        <option value="HI">HI</option>
                        <option value="IA">IA</option>

                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>

                        <option value="KY">KY</option>
                        <option value="LA">LA</option>

                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>

                        <option value="MN">MN</option>
                        <option value="MO">MO</option>

                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>

                        <option value="NE">NE</option>
                        <option value="NH">NH</option>

                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>

                        <option value="OH">OH</option>
                        <option value="OK">OK</option>

                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>

                        <option value="SD">SD</option>
                        <option value="TN">TN</option>

                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VA">VA</option>
                        <option value="VT">VT</option>

                        <option value="WA">WA</option>
                        <option value="WI">WI</option>

                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                      </select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code</strong></td>
                <td align="left" height="30"><input name="zip_billing" class="bodytxt" size="10" id="zip_billing" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country</strong></td>
                <td align="left" height="30">
                <select name="country_billing" id="country_billing" class="bodytxt">
  				<option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option>
                            <option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Azores">Azores</option>
                            <option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia Herzegowina">Bosnia Herzegowina</option>
                            <option value="Bosnia-Herzegovina">Bosnia-Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option><option value="British Indian O. Terr">British Indian O. Terr</option>
                            <option value="British Virgin Isl">British Virgin Isl</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option><option value="Central African Rep">Central African Rep</option><option value="Chad">Chad</option>
                            <option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Isl">Cocos (Keeling) Isl</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option><option value="Congo, The Dem Rep">Congo, The Dem Rep</option><option value="Cook Islands">Cook Islands</option>
                            <option value="Corsica">Corsica</option><option value="Costa Rica">Costa Rica</option><option value="Cote d` Ivoire">Cote d` Ivoire</option>
                            <option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France (Incl Monaco)">France (Incl Monaco)</option>
                            <option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option>
                            <option value="French Polynesia">French Polynesia</option><option value="French S. Territories">French S. Territories</option>
                            <option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option><option value="Heard And Mc Donald Isl">Heard And Mc Donald Isl</option>
                            <option value="Holy See (Vatican City)">Holy See (Vatican City)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option>
                            <option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option>
                            <option value="Ireland (Eire)">Ireland (Eire)</option><option value="Israel">Israel</option><option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic Rep">Korea, Democratic Rep</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option>
                            <option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Madeira Islands">Madeira Islands</option>
                            <option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option>
                            <option value="Moldova, Republic Of">Moldova, Republic Of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option>
                            <option value="Myanmar (Burma)">Myanmar (Burma)</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Isl">Northern Mariana Isl</option><option value="Norway">Norway</option>
                            <option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option>
                            <option value="Palestinian Territory">Palestinian Territory</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia-Montenegro">Serbia-Montenegro</option>
                            <option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option>
                            <option value="Slovak Republic">Slovak Republic</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia">South Georgia</option>
                            <option value="South Korea">South Korea</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option>
                            <option value="St. Christopher, Nevis">St. Christopher, Nevis</option><option value="St. Helena">St. Helena</option><option value="St. Lucia">St. Lucia</option>
                            <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="St. Vincent and Gren">St. Vincent and Gren</option>
                            <option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard And Jan M Isl">Svalbard And Jan M Isl</option>
                            <option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Rep">Syrian Arab Rep</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tristan da Cunha">Tristan da Cunha</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Isl">Turks and Caicos Isl</option><option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option><option value="Great Britain">Great Britain</option>
                            <option value="United States" selected="selected">United States</option><option value="U.S. Minor Outlying Isl">U.S. Minor Outlying Isl</option>
                            <option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Furuna Isl">Wallis and Furuna Isl</option>
                            <option value="Western Sahara">Western Sahara</option><option value="Western Samoa">Western Samoa</option><option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
				</select>                </td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Payment Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Total Amount</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><!-- <div id="result"></div><br /> -->$<input name="total_amount" id="total_amount" class="bodytxt" size="12" type="text"><input value="Calculate Total" type="button" onclick='JavaScript:xmlhttpPost("calculate.php")'>
  </td>
  			  </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Payment Method</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <select id="card_type" name="card_type" size="1">
																	<option value="**" selected="selected">- Select Card Type -</option>
																	<option value="American Express">American Express</option>
																	<option value="MasterCard">MasterCard</option>
																	<option value="Visa">Visa</option>
																</select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Credit Card Number</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="card_number" class="bodytxt" size="32" type="text"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Expiration Date</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select id="ExpMonth" name="ExpMonth" size="1">
																	
																	<option value="Jan">Jan</option>
																	
																	<option value="Feb">Feb</option>
																	
																	<option value="Mar">Mar</option>
																	
																	<option value="Apr">Apr</option>

																	
																	<option value="May">May</option>
																	
																	<option value="Jun">Jun</option>
																	
																	<option value="Jul">Jul</option>
																	
																	<option value="Aug">Aug</option>
																	
																	<option value="Sep">Sep</option>
																	
																	<option value="Oct">Oct</option>

																	
																	<option value="Nov">Nov</option>
																	
																	<option value="Dec">Dec</option>
																	
																</select>
                                                                <select id="ExpYear" name="ExpYear" size="1">
																	
																	<option value="2008" selected="selected">2008</option>

																	
																	<option value="2009">2009</option>
																	
																	<option value="2010">2010</option>
																	
																	<option value="2011">2011</option>
																	
																	<option value="2012">2012</option>
																	
																	<option value="2013">2013</option>
																	
																	<option value="2014">2014</option>

																	
																	<option value="2015">2015</option>
																	
																	<option value="2016">2016</option>
																	
																	<option value="2017">2017</option>
																	
																	<option value="2018">2018</option>
																</select></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Reservation Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Reservation Status</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="status" size="1" class="bodytxt">
               	<?php
				$all_statuses = get_all_statuses();
				if(count($all_statuses)>=1){
				foreach($all_statuses as $value){
				?>
				<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                <?php
					}
				}
				?>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Customer Comments</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="customer_comments" rows="3" cols="36" class="bodytxt"></textarea></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Admin Comments</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="admin_comments" rows="3" cols="36" class="bodytxt"></textarea></td>
              </tr>
              <tr>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input src="images/but_create.jpg" border="0" height="22" type="image" width="68"></td>
              </tr>
            </tbody></table>
			</form>
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
     <script language="JavaScript">
<!-- // create calendar object(s) just after form tag closed
	 // specify form element as the only parameter (document.forms['formname'].elements['inputname']);
	 // note: you can have as many calendar objects as you need for your application
	var cal1 = new calendar2(document.forms['create_new'].elements['travel_date']);
	cal1.year_scroll = true;
	cal1.time_comp = false;
	
	var cal2 = new calendar2(document.forms['create_new'].elements['travel_date_roundtrip']);
	cal2.year_scroll = true;
	cal2.time_comp = false;
//-->
</script>
	</form>
	<?php
	}
	?>
    <?php
	// Edit Reservation
	if ($_GET[cAction] == 'edit') {
	include_once("includes/functions/location_functions.php");
	$all_locations = get_all_locations();
	$all_airports = get_all_airports();
	?>
	<form id="edit_reservation" style="padding-bottom:0px;" name="edit_reservation" method="post" action="reservation_manager.php?cAction=edit&id=<?php echo $_GET['id']; ?>" onsubmit="return validate(this)">
	<input name="action" type="hidden" value="edit">
	<table border="0" cellpadding="0" cellspacing="0" width="580" class="ot">
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
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>EDIT RESERVATION</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          </tr>
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Transportation Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Vehicle</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $vehicle_view = get_vehicles_view($reservation_view['vehicle_id']);?>
                <select name="vehicle_id" size="1" class="bodytxt">
                <option value="<?php echo $reservation_view['vehicle_id']; ?>"><?php echo $vehicle_view['name']; ?></option>
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
                <?php $trip_type = get_trip_types_view($reservation_view['trip_type']); ?>
                <select name="trip_type" required="yes" size="1">
                                      <option value="<?php echo $reservation_view['trip_type']; ?>" selected="selected"><?php echo $trip_type['name']; ?></option>
                                      <OPTGROUP LABEL="Orlando Area">
                                      <option value="1">Orlando Area - One Way</option>
                                      <option value="2">Orlando Area - Round Trip</option>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Cruise Transfer">
                                      <option value="3">Airport to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="4">Airport to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="5">Disney/Universal to Cruise Terminal/Port Area - One Way</option>
                                      <option value="6">Disney/Universal to Cruise Terminal/Port Area - Round Trip</option>
                                      <option value="7">MCO>Disney or Universal>Cruise terminal>MCO (3 leg)</option>
                                      <option value="8">MCO>Cruise Terminals>Disney or Universal>MCO (3 leg)</option>
                                      <option value="9">Sanford to Cruise Terminal/Port Area Resorts - One Way</option>
                                      <option value="11">Sanford to Cruise Terminal/Port Area Resorts - Round Trip</option>
                                      <option value="10">Sanford>Cruise Terminals>Disney or Universal>Sanford</option>
</select></td>
              </tr>
              <?php if ($reservation_view['trip_type'] < 7) { ?>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Transportation From</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php if ($reservation_view['location1_id'] == '1a' || $reservation_view['location1_id'] == '2a') { $from = get_airports_view($reservation_view['location1_id']); } else { if ($reservation_view['location1_id'] == '1c' || $reservation_view['location1_id'] == '2c' || $reservation_view['location1_id'] == '3c' || $reservation_view['location1_id'] == '4c' || $reservation_view['location1_id'] == '5c' || $reservation_view['location1_id'] == '6c' || $reservation_view['location1_id'] == '7c' || $reservation_view['location1_id'] == '8c') { $from = get_cruises_view($reservation_view['location1_id']); } else { $from = get_locations_view($reservation_view['location1_id']); }; }; ?>
                <select name="from" id="from" required="yes" size="1" onchange="javascript:getNewlocationContent(this.value);">
                                      <option value="<?php echo $reservation_view['location1_id']; ?>" selected="selected"><?php echo $from['name']; ?></option>
                                      <OPTGROUP LABEL="Orlando Airports">
                                      <?php 
				
				if(count($all_airports)>=1){
				foreach($all_airports as $value){
				?>
                  <option value="<?php echo $value['id']; ?>a"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Orlando Hotels">
                                     <?php 
				
				if(count($all_locations)>=1){
				foreach($all_locations as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select>
</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Transportation To</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php if ($reservation_view['location2_id'] == '1a' || $reservation_view['location2_id'] == '2a') { $to = get_airports_view($reservation_view['location2_id']); } else { if ($reservation_view['location2_id'] == '1c' || $reservation_view['location2_id'] == '2c' || $reservation_view['location2_id'] == '3c' || $reservation_view['location2_id'] == '4c' || $reservation_view['location2_id'] == '5c' || $reservation_view['location2_id'] == '6c' || $reservation_view['location2_id'] == '7c' || $reservation_view['location2_id'] == '8c') { $to = get_cruises_view($reservation_view['location2_id']); } else { $to = get_locations_view($reservation_view['location2_id']); }; }; ?>
                <select name="to" id="to" required="yes" size="1" onchange="javascript:getNewlocationtoContent(this.value);">
                                      <option value="<?php echo $reservation_view['location2_id']; ?>" selected="selected"><?php echo $to['name']; ?></option>
                                      <OPTGROUP LABEL="Orlando Airports">
                                      <?php 
				
				if(count($all_airports)>=1){
				foreach($all_airports as $value){
				?>
                  <option value="<?php echo $value['id']; ?>a"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                                      </OPTGROUP>
                                      <OPTGROUP LABEL="Orlando Hotels">
                                     <?php 
				
				if(count($all_locations)>=1){
				foreach($all_locations as $value){
				?>
                  <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                  <?php
					}
				}
				?>
                </OPTGROUP>
                </select></td>
              </tr>
              <?php } ?>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Passengers</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="passenger_count" size="1" class="bodytxt">
                <option value="<?php echo $reservation_view['passenger_count']; ?>"><?php echo $reservation_view['passenger_count']; ?></option>
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
                <td align="right" height="30" width="38%" class="ob"><strong>Child Car Seat</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="child_carseat" size="1" class="bodytxt">
                <option value="<?php echo $reservation_view['child_carseat']; ?>"><?php echo $reservation_view['child_carseat']; ?></option>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Child Booster Seat</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="child_boosterseat" size="1" class="bodytxt">
                <option value="<?php echo $reservation_view['booster_seat']; ?>"><?php echo $reservation_view['booster_seat']; ?></option>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
                </select></td>
              </tr>
              <?php if ($reservation_view['trip_type'] == '7' || $reservation_view['trip_type'] == '8') { ?>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Location 1</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><?php echo $reservation_view['location1']; ?></td>
              </tr>
              <?php } ?>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Transfer Date</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="travel_date" type="text" id="travel_date" size="10" maxlength="10" value="<?php echo format_to_caldate($reservation_view['travel_date']); ?>">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal1.popup();"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Pickup at</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><?php $pickup_at = format_time2($reservation_view['pickup_at']); ?><?php $pickup_at= explode(":", $pickup_at); ?><select name="h" size="1"><option value="<?php echo $pickup_at['0']; ?>"><?php echo $pickup_at['0']; ?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select><select name="m" size="1"><option value="<?php echo $pickup_at['1']; ?>"><?php echo $pickup_at['1']; ?></option><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm" size="1"><option value="<?php echo $pickup_at['2']; ?>"><?php echo $pickup_at['2']; ?></option><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Arriving Airline</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="arriving_airline" size="1">

																													<option value="<?php echo $reservation_view['arriving_airline']; ?>"><?php echo $reservation_view['arriving_airline']; ?></option>

																													
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
                                                                                                                    <option value="Allegiant Air">Allegiant Air</option>
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
                                                                                                                    <option value="Direct Air">Direct Air</option>
                                                                                                                    <option value="First Choice (Air 2000)">First Choice (Air 2000)</option>
																													<option value="Frontier Airlines Inc.">Frontier Airlines Inc.</option>
																													<option value="Iberia">Iberia</option>
                                                                                                                    <option value="Icelandair">Icelandair</option>

																													<option value="Japan Airlines International">Japan Airlines International</option>
																												    <option value="Jetairfly">Jetairfly</option>
																													<option value="JetBlue Airways Corporation">JetBlue Airways Corporation</option>
																													<option value="Korean Air">Korean Air</option>
																													<option value="KLM-Royal Dutch Airlines">KLM-Royal Dutch Airlines</option>
																													<option value="Lan Airlines">Lan Airlines</option>
																													<option value="Lan Peru">Lan Peru</option>

																													<option value="Lufthansa German Airlines">Lufthansa German Airlines</option>

																													<option value="LOT - Polish Airlines">LOT - Polish Airlines</option>
																													<option value="Mexicana de Aviacion">Mexicana de Aviacion</option>
																													<option value="Midwest Airlines">Midwest Airlines</option>
																													<option value="MALEV Hungarian Airlines">MALEV Hungarian Airlines</option>																									<option value="Monarch">Monarch</option>
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
																													<option value="Thomas Cook">Thomas Cook</option>
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
																													<option value="United Airlines">United Airlines</option>
																													<option value="US Airways">US Airways</option>
																													<option value="Virgin Atlantic Airways">Virgin Atlantic Airways</option>
																													<option value="Westjet">Westjet</option>
																												</select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Flight Number</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="flight_number" class="bodytxt" size="10" type="text" value="<?php echo $reservation_view['flight_number']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Arriving at</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><?php  $arriving_at = format_time2($reservation_view['arriving_at']); ?><?php $arriving_at= explode(":", $arriving_at); ?><select name="h1" size="1"><option value="<?php echo $arriving_at['0']; ?>"><?php echo $arriving_at['0']; ?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select><select name="m1" size="1"><option value="<?php echo $arriving_at['1']; ?>"><?php echo $arriving_at['1']; ?></option><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm1" size="1"><option value="<?php echo $arriving_at['2']; ?>"><?php echo $arriving_at['2']; ?></option><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              
              
              <?php if ($reservation_view['trip_type'] == '7' || $reservation_view['trip_type'] == '8') { ?>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Location 2</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><?php echo $reservation_view['location2']; ?></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Transfer Date:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><input name="travel_date_extra" type="text" id="travel_date_extra" size="10" maxlength="10" value="<?php $travel_date_extra = format_to_caldate($reservation_view['travel_date_extra']); if ($travel_date_extra != '00/00/0000') { echo $travel_date_extra; }; ?>">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal3.popup();"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY</td>
              </tr>
              	<tr valign="middle">
                <td align="right" height="20" width="38%" class="ob"><strong>Pickup at:</strong></td>
                <td align="left" height="20" width="62%" class="ot2"><?php  $pickup_at_extra = format_time2($reservation_view['pickup_at_extra']); ?><?php $pickup_at_extra= explode(":", $pickup_at_extra); ?><select name="h4" size="1"><?php if (!empty($pickup_at_extra['0'])) { echo '<option value="'.$pickup_at_extra['0'].'">'.$pickup_at_extra['0'].'</option>'; } ;?><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12" selected="selected">12</option></select><select name="m4" size="1"><?php if (!empty($pickup_at_extra['1'])) { echo '<option value="'.$pickup_at_extra['1'].'">'.$pickup_at_extra['1'].'</option>'; } ;?><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm4" size="1"><?php if (!empty($pickup_at_extra['2'])) { echo '<option value="'.$pickup_at_extra['2'].'">'.$pickup_at_extra['2'].'</option>'; } ;?><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Location 3</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><?php echo $reservation_view['location3']; ?></td>
              </tr>
              <?php } ?>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Transfer Date</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="travel_date_roundtrip" type="text" id="travel_date2" size="10" maxlength="10" value="<?php $travel_date_roundtrip = format_to_caldate($reservation_view['travel_date_roundtrip']); if ($travel_date_roundtrip != '00/00/0000') { echo $travel_date_roundtrip; }; ?>">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal2.popup();"><i> <font color="#ff0000" size="1">click to select date</font></i><br />
                MM/DD/YYYY</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Pickup at</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><?php  $pickup_at_roundtrip = format_time2($reservation_view['pickup_at_roundtrip']); ?><?php $pickup_at_roundtrip= explode(":", $pickup_at_roundtrip); ?><select name="h2" size="1"><option value="<?php echo $pickup_at_roundtrip['0']; ?>"><?php echo $pickup_at_roundtrip['0']; ?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select><select name="m2" size="1"><option value="<?php echo $pickup_at_roundtrip['1']; ?>"><?php echo $pickup_at_roundtrip['1']; ?></option><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm2" size="1"><option value="<?php echo $pickup_at_roundtrip['2']; ?>"><?php echo $pickup_at_roundtrip['2']; ?></option><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Departing Airline</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><select name="departing_airline_roundtrip" size="1">

																													<option value="<?php echo $reservation_view['departing_airline_roundtrip']; ?>"><?php echo $reservation_view['departing_airline_roundtrip']; ?></option>

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
                                                                                                                    <option value="Allegiant Air">Allegiant Air</option>
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
                                                                                                                    <option value="Direct Air">Direct Air</option>
                                                                                                                    <option value="First Choice (Air 2000)">First Choice (Air 2000)</option>
																													<option value="Frontier Airlines Inc.">Frontier Airlines Inc.</option>
																													<option value="Iberia">Iberia</option>
                                                                                                                    <option value="Icelandair">Icelandair</option>

																													<option value="Japan Airlines International">Japan Airlines International</option>
																												    <option value="Jetairfly">Jetairfly</option>
																													<option value="JetBlue Airways Corporation">JetBlue Airways Corporation</option>
																													<option value="Korean Air">Korean Air</option>
																													<option value="KLM-Royal Dutch Airlines">KLM-Royal Dutch Airlines</option>
																													<option value="Lan Airlines">Lan Airlines</option>
																													<option value="Lan Peru">Lan Peru</option>

																													<option value="Lufthansa German Airlines">Lufthansa German Airlines</option>

																													<option value="LOT - Polish Airlines">LOT - Polish Airlines</option>
																													<option value="Mexicana de Aviacion">Mexicana de Aviacion</option>
																													<option value="Midwest Airlines">Midwest Airlines</option>
																													<option value="MALEV Hungarian Airlines">MALEV Hungarian Airlines</option>																									<option value="Monarch">Monarch</option>
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
																													<option value="Thomas Cook">Thomas Cook</option>
                                                                                                                    <option value="Thomsonfly">Thomsonfly</option>
																													<option value="United Airlines">United Airlines</option>
																													<option value="US Airways">US Airways</option>
																													<option value="Virgin Atlantic Airways">Virgin Atlantic Airways</option>
																													<option value="Westjet">Westjet</option>
																												</select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Flight Number</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="flight_number_roundtrip" class="bodytxt" size="10" type="text" value="<?php echo $reservation_view['flight_number_roundtrip']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Departing at</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><?php  $pickup_at_roundtrip = format_time2($reservation_view['departing_at']); ?><?php $departing_at= explode(":", $pickup_at_roundtrip); ?><select name="h3" size="1"><option value="<?php echo $departing_at['0']; ?>"><?php echo $departing_at['0']; ?></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option></select><select name="m3" size="1"><option value="<?php echo $departing_at['1']; ?>"><?php echo $departing_at['1']; ?></option><option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option><option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option><option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option><option value="46">46</option><option value="47">47</option><option value="48">48</option><option value="49">49</option><option value="50">50</option><option value="51">51</option><option value="52">52</option><option value="53">53</option><option value="54">54</option><option value="55">55</option><option value="56">56</option><option value="57">57</option><option value="58">58</option><option value="59">59</option></select>              
              <select name="ampm3" size="1"><option value="<?php echo $departing_at['2']; ?>"><?php echo $departing_at['2']; ?></option><option value="AM">AM</option><option value="PM">PM</option></select></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Passenger Information</span></div>              	</td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>First Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name" class="bodytxt" size="39" type="text" value="<?php echo $reservation_view['first_name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Last Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name" class="bodytxt" size="39" type="text" value="<?php echo $reservation_view['last_name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address</strong></td>
                <td align="left" height="30"><input name="address" class="bodytxt" size="39" id="address" type="text" value="<?php echo $reservation_view['address']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2</strong></td>
                <td align="left" height="30"><input name="address2" class="bodytxt" size="39" id="address2" type="text" value="<?php echo $reservation_view['address2']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City</strong></td>
                <td align="left" height="30"><input name="town" class="bodytxt" size="39" id="town" type="text" value="<?php echo $reservation_view['city']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State</strong></td>
                <td align="left" height="30">
                						<select name="state" id="state" class="bodytxt">
                        <option value="<?php echo $reservation_view['state']; ?>"><?php echo $reservation_view['state']; ?></option>
                        <option value="Outside USA">Outside USA</option>                        
                        <option value="AK">AK</option>

                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>

                        <option value="CO">CO</option>
                        <option value="CT">CT</option>

                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>

                        <option value="HI">HI</option>
                        <option value="IA">IA</option>

                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>

                        <option value="KY">KY</option>
                        <option value="LA">LA</option>

                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>

                        <option value="MN">MN</option>
                        <option value="MO">MO</option>

                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>

                        <option value="NE">NE</option>
                        <option value="NH">NH</option>

                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>

                        <option value="OH">OH</option>
                        <option value="OK">OK</option>

                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>

                        <option value="SD">SD</option>
                        <option value="TN">TN</option>

                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VA">VA</option>
                        <option value="VT">VT</option>

                        <option value="WA">WA</option>
                        <option value="WI">WI</option>

                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                      </select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code</strong></td>
                <td align="left" height="30"><input name="zip" class="bodytxt" size="10" id="zip" type="text" value="<?php echo $reservation_view['zip']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country</strong></td>
                <td align="left" height="30">
                <select name="country" id="country" class="bodytxt">
                <option value="<?php echo $reservation_view['country']; ?>"><?php echo $reservation_view['country']; ?></option>
  				<option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option>
                            <option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Azores">Azores</option>
                            <option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia Herzegowina">Bosnia Herzegowina</option>
                            <option value="Bosnia-Herzegovina">Bosnia-Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option><option value="British Indian O. Terr">British Indian O. Terr</option>
                            <option value="British Virgin Isl">British Virgin Isl</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option><option value="Central African Rep">Central African Rep</option><option value="Chad">Chad</option>
                            <option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Isl">Cocos (Keeling) Isl</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option><option value="Congo, The Dem Rep">Congo, The Dem Rep</option><option value="Cook Islands">Cook Islands</option>
                            <option value="Corsica">Corsica</option><option value="Costa Rica">Costa Rica</option><option value="Cote d` Ivoire">Cote d` Ivoire</option>
                            <option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France (Incl Monaco)">France (Incl Monaco)</option>
                            <option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option>
                            <option value="French Polynesia">French Polynesia</option><option value="French S. Territories">French S. Territories</option>
                            <option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option><option value="Heard And Mc Donald Isl">Heard And Mc Donald Isl</option>
                            <option value="Holy See (Vatican City)">Holy See (Vatican City)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option>
                            <option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option>
                            <option value="Ireland (Eire)">Ireland (Eire)</option><option value="Israel">Israel</option><option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic Rep">Korea, Democratic Rep</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option>
                            <option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Madeira Islands">Madeira Islands</option>
                            <option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option>
                            <option value="Moldova, Republic Of">Moldova, Republic Of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option>
                            <option value="Myanmar (Burma)">Myanmar (Burma)</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Isl">Northern Mariana Isl</option><option value="Norway">Norway</option>
                            <option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option>
                            <option value="Palestinian Territory">Palestinian Territory</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia-Montenegro">Serbia-Montenegro</option>
                            <option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option>
                            <option value="Slovak Republic">Slovak Republic</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia">South Georgia</option>
                            <option value="South Korea">South Korea</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option>
                            <option value="St. Christopher, Nevis">St. Christopher, Nevis</option><option value="St. Helena">St. Helena</option><option value="St. Lucia">St. Lucia</option>
                            <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="St. Vincent and Gren">St. Vincent and Gren</option>
                            <option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard And Jan M Isl">Svalbard And Jan M Isl</option>
                            <option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Rep">Syrian Arab Rep</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tristan da Cunha">Tristan da Cunha</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Isl">Turks and Caicos Isl</option><option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option><option value="Great Britain">Great Britain</option>
                            <option value="United States" selected="selected">United States</option><option value="U.S. Minor Outlying Isl">U.S. Minor Outlying Isl</option>
                            <option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Furuna Isl">Wallis and Furuna Isl</option>
                            <option value="Western Sahara">Western Sahara</option><option value="Western Samoa">Western Samoa</option><option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
				</select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>E-mail</strong></td>
                <td align="left" height="30"><input name="email" class="bodytxt" size="39" id="email" type="text" value="<?php echo $reservation_view['email']; ?>"></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="bodytxt">
                <tr>
                	<td width="40%" align="right"><span style="color:#677bca; font-weight:bold;">Cardholder Information</span>&nbsp;&nbsp;&nbsp;</td><td align="center"><input name="billing_adr" value="1" id="billing-checkbox" onclick="auto_address_update(document.edit_reservation)" type="checkbox"></td><td> Billing Address is the same as Shipping Address.</td>
                </tr>
              </table></div> </td>
              </tr>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>First Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name_billing" class="bodytxt" size="39" type="text" value="<?php echo $reservation_view['first_name_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Last Name</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name_billing" class="bodytxt" size="39" type="text" value="<?php echo $reservation_view['last_name_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address</strong></td>
                <td align="left" height="30"><input name="address_billing" class="bodytxt" size="39" id="address_billing" type="text" value="<?php echo $reservation_view['address_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2</strong></td>
                <td align="left" height="30"><input name="address2_billing" class="bodytxt" size="39" id="address2_billing" type="text" value="<?php echo $reservation_view['address2_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City</strong></td>
                <td align="left" height="30"><input name="city_billing" class="bodytxt" size="39" id="city_billing" type="text" value="<?php echo $reservation_view['city_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State</strong></td>
                <td align="left" height="30">
                						<select name="state_billing" id="state_billing" class="bodytxt">
                        <option value="<?php echo $reservation_view['state_billing']; ?>"><?php echo $reservation_view['state_billing']; ?></option>
                        <option value="Outside USA">Outside USA</option>                        
                        <option value="AK">AK</option>

                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>

                        <option value="CO">CO</option>
                        <option value="CT">CT</option>

                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>

                        <option value="HI">HI</option>
                        <option value="IA">IA</option>

                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>

                        <option value="KY">KY</option>
                        <option value="LA">LA</option>

                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>

                        <option value="MN">MN</option>
                        <option value="MO">MO</option>

                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>

                        <option value="NE">NE</option>
                        <option value="NH">NH</option>

                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>

                        <option value="OH">OH</option>
                        <option value="OK">OK</option>

                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>

                        <option value="SD">SD</option>
                        <option value="TN">TN</option>

                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VA">VA</option>
                        <option value="VT">VT</option>

                        <option value="WA">WA</option>
                        <option value="WI">WI</option>

                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                      </select>                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code</strong></td>
                <td align="left" height="30"><input name="zip_billing" class="bodytxt" size="10" id="zip_billing" type="text" value="<?php echo $reservation_view['zip_billing']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country</strong></td>
                <td align="left" height="30">
                <select name="country_billing" id="country_billing" class="bodytxt">
                <option value="<?php echo $reservation_view['country_billing']; ?>"><?php echo $reservation_view['country_billing']; ?></option>
  				<option value="Afghanistan">Afghanistan</option>
                            <option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option>
                            <option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Azores">Azores</option>
                            <option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia Herzegowina">Bosnia Herzegowina</option>
                            <option value="Bosnia-Herzegovina">Bosnia-Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option><option value="British Indian O. Terr">British Indian O. Terr</option>
                            <option value="British Virgin Isl">British Virgin Isl</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option><option value="Central African Rep">Central African Rep</option><option value="Chad">Chad</option>
                            <option value="Chile">Chile</option><option value="China">China</option><option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Isl">Cocos (Keeling) Isl</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option><option value="Congo, The Dem Rep">Congo, The Dem Rep</option><option value="Cook Islands">Cook Islands</option>
                            <option value="Corsica">Corsica</option><option value="Costa Rica">Costa Rica</option><option value="Cote d` Ivoire">Cote d` Ivoire</option>
                            <option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="East Timor">East Timor</option>
                            <option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option><option value="Falkland Islands">Falkland Islands</option><option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France (Incl Monaco)">France (Incl Monaco)</option>
                            <option value="France, Metropolitan">France, Metropolitan</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option>
                            <option value="French Polynesia">French Polynesia</option><option value="French S. Territories">French S. Territories</option>
                            <option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option>
                            <option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option><option value="Heard And Mc Donald Isl">Heard And Mc Donald Isl</option>
                            <option value="Holy See (Vatican City)">Holy See (Vatican City)</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option>
                            <option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option>
                            <option value="Ireland (Eire)">Ireland (Eire)</option><option value="Israel">Israel</option><option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic Rep">Korea, Democratic Rep</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option>
                            <option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Madeira Islands">Madeira Islands</option>
                            <option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option>
                            <option value="Moldova, Republic Of">Moldova, Republic Of</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option>
                            <option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option>
                            <option value="Myanmar (Burma)">Myanmar (Burma)</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option><option value="Northern Mariana Isl">Northern Mariana Isl</option><option value="Norway">Norway</option>
                            <option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option>
                            <option value="Palestinian Territory">Palestinian Territory</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option>
                            <option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia-Montenegro">Serbia-Montenegro</option>
                            <option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option>
                            <option value="Slovak Republic">Slovak Republic</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="South Georgia">South Georgia</option>
                            <option value="South Korea">South Korea</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option>
                            <option value="St. Christopher, Nevis">St. Christopher, Nevis</option><option value="St. Helena">St. Helena</option><option value="St. Lucia">St. Lucia</option>
                            <option value="St. Pierre and Miquelon">St. Pierre and Miquelon</option><option value="St. Vincent and Gren">St. Vincent and Gren</option>
                            <option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard And Jan M Isl">Svalbard And Jan M Isl</option>
                            <option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Rep">Syrian Arab Rep</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tristan da Cunha">Tristan da Cunha</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Isl">Turks and Caicos Isl</option><option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option><option value="Great Britain">Great Britain</option>
                            <option value="United States" selected="selected">United States</option><option value="U.S. Minor Outlying Isl">U.S. Minor Outlying Isl</option>
                            <option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option>
                            <option value="Vatican City">Vatican City</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option>
                            <option value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option><option value="Wallis and Furuna Isl">Wallis and Furuna Isl</option>
                            <option value="Western Sahara">Western Sahara</option><option value="Western Samoa">Western Samoa</option><option value="Yemen">Yemen</option>
                            <option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
				</select>                </td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Payment Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Total Amount</strong></td>
                <td align="left" height="30" width="62%" class="ot2">$<input name="total_amount" class="bodytxt" size="12" type="text" value="<?php echo $reservation_view['total_amount']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Payment Method</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <select id="card_type" name="card_type" size="1">
																	<option value="<?php echo $reservation_view['card_type']; ?>" selected="selected"><?php echo $reservation_view['card_type']; ?></option>
																	<option value="American Express">American Express</option>
																	<option value="MasterCard">MasterCard</option>
																	<option value="Visa">Visa</option>
																</select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Credit Card Number</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="card_number" class="bodytxt" size="32" type="text" value="<?php echo $reservation_view['card_number']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Expiration Date</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $exp_date = format_exp_date($reservation_view['exp_date']); ?>
                <select id="ExpMonth" name="ExpMonth" size="1">
                													<option value="<?php echo $exp_date[0] ; ?>"><?php echo $exp_date[0] ; ?></option>
																	
																	<option value="Jan">Jan</option>
																	
																	<option value="Feb">Feb</option>
																	
																	<option value="Mar">Mar</option>
																	
																	<option value="Apr">Apr</option>

																	
																	<option value="May">May</option>
																	
																	<option value="Jun">Jun</option>
																	
																	<option value="Jul">Jul</option>
																	
																	<option value="Aug">Aug</option>
																	
																	<option value="Sep">Sep</option>
																	
																	<option value="Oct">Oct</option>

																	
																	<option value="Nov">Nov</option>
																	
																	<option value="Dec">Dec</option>
																	
																</select>
                                                                <select id="ExpYear" name="ExpYear" size="1">
                                                                	<option value="<?php echo $exp_date[1] ; ?>"><?php echo $exp_date[1] ; ?></option>
																	
																	<option value="2008">2008</option>

																	
																	<option value="2009">2009</option>
																	
																	<option value="2010">2010</option>
																	
																	<option value="2011">2011</option>
																	
																	<option value="2012">2012</option>
																	
																	<option value="2013">2013</option>
																	
																	<option value="2014">2014</option>

																	
																	<option value="2015">2015</option>
																	
																	<option value="2016">2016</option>
																	
																	<option value="2017">2017</option>
																	
																	<option value="2018">2018</option>
																</select></td>
              </tr>
              <tr>
              	<td width="100%" colspan="2" align="center"><div style="background-color:#ced5f3; padding:5px; border:#677bca solid 1px;"><span style="color:#677bca; font-weight:bold;">Reservation Information</span></div>              	</td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Reservation Status</strong></td>
                <td align="left" height="30" width="62%" class="ot2">
                <?php $status = get_statuses_view($reservation_view['status']); ?>
                <select name="status" size="1" class="bodytxt">
                <option value="<?php echo $reservation_view['status'] ; ?>"><?php echo $status['name'] ; ?></option>
                <?php
				$all_statuses = get_all_statuses();
				if(count($all_statuses)>=1){
				foreach($all_statuses as $value){
				?>
				<option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                <?php
					}
				}
				?>
                </select></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Customer Comments</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="customer_comments" rows="3" cols="36" class="bodytxt"><?php echo $reservation_view['customer_comments']; ?></textarea></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Admin Comments</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><textarea name="admin_comments" rows="3" cols="36" class="bodytxt"><?php echo $reservation_view['admin_comments']; ?></textarea></td>
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
    <script language="JavaScript">
<!-- // create calendar object(s) just after form tag closed
	 // specify form element as the only parameter (document.forms['formname'].elements['inputname']);
	 // note: you can have as many calendar objects as you need for your application
	var cal1 = new calendar2(document.forms['edit_reservation'].elements['travel_date']);
	cal1.year_scroll = true;
	cal1.time_comp = false;
	
	var cal2 = new calendar2(document.forms['edit_reservation'].elements['travel_date_roundtrip']);
	cal2.year_scroll = true;
	cal2.time_comp = false;
//-->
</script>
	</form>
	<?php
	}
	?>
<?php
include ("includes/common/footer.php");
?>