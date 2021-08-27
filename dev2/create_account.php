<?php
session_start();
	include("includes/functions/general_functions.php");
	include("includes/functions/client_functions.php");

$company_info = get_company_info(); 

	if (!empty($_POST)) {

	$_SESSION['first_name'] = $_POST["first_name"];
	$_SESSION['last_name'] = $_POST["last_name"];
	$_SESSION['address'] = $_POST["address"];
	$_SESSION['address2'] = $_POST["address2"];
	$_SESSION['town'] = $_POST["town"];
	$_SESSION['state'] = $_POST["state"];
	$_SESSION['zip'] = $_POST["zip"];
	$_SESSION['country'] = $_POST["country"];
	$_SESSION['telephone'] = $_POST["telephone"];
	$_SESSION['telephone2'] = $_POST["telephone2"];
	$_SESSION['cellphone'] = $_POST["cellphone"];
	$_SESSION['fax'] = $_POST["fax"];
	$_SESSION['email'] = $_POST["email"];
	
	if (validate_customer($_SESSION['email'])) {
	$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px;"><span style="color:#FF0000;">That email address is already registered. Please login to continue with your reservation</span></div>';
	} else {
		if($_POST['password_new'] != $_POST['password_confirm']){
			$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px;"><span style="color:#FF0000;">Sorry the password entered does not match. Try again</span></div>';
		}
		else{	
			if (add_clients()) {
				echo '<script language="javascript">alert(\'A new account created successfully\');window.location=\'my_account.php?redirect='.$_GET['redirect'].'\';</script>';
				exit;
			} else {
			echo '<script language="javascript">alert(\'Error creating client\');</script>';	
			}
			}
		}
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
<script type="text/javascript" src="includes/js/menu.js"></script>
<script type="text/JavaScript">
<!--
function validate2(form){
	if(form.first_name.value =="" || form.first_name.value.length < 2){
		alert('Please enter your First Name. It should contain at least 2 characters.');
		form.first_name.focus();
		return false;
	}
	
	if(form.last_name.value =="" || form.last_name.value.length < 2){
		alert('Please enter your Last Name. It should contain at least 2 characters.');
		form.last_name.focus();
		return false;
	}
	
	if(form.cellphone.value =="" || form.cellphone.value.length < 10){
		alert('Please enter your Mobile Phone. It should contain at least 10 characters.');
		form.cellphone.focus();
		return false;
	}
	
	if(form.email.value =="" || form.email.value.length < 6){
		alert('Is your email address correct? It should contain at least 6 characters. Please try again.');
		form.email.focus();
		return false;
	}
	
	if(form.username.value =="" || form.username.value.length < 6){
		alert('Please enter your username. It should contain at least 6 characters.');
		form.username.focus();
		return false;
	}
	
	
	if(form.password_new.value =="" || form.password_new.value.length < 6){
		alert('Please enter your password. It should contain at least 6 characters.');
		form.password_new.focus();
		return false;
	}
	
	if(form.password_confirm.value==''){
		alert('Please confirm your password');
		form.password_confirm.focus();
		return false;
	}

}
//-->
</script>
<!-- European format dd-mm-yyyy -->
<script language="JavaScript" src="calendar1.js"></script><!-- Date only with year scrolling -->
<!-- American format mm/dd/yyyy -->
<script language="JavaScript" src="calendar2.js"></script><!-- Date only with year scrolling -->
<!-- mySQL format yyyy-mm-dd -->
<script language="JavaScript" src="calendar3.js"></script><!-- Date only with year scrolling -->
<script src="lib/prototype.js" type="text/javascript"></script>
<script src="src/scriptaculous.js" type="text/javascript"></script>
<script language="JavaScript">
<!--
var url = location.href;	
if(url.charAt(4) != "s" || url.charAt(4) == "w" ){
window.location = "https://www.dev.sunstatelimo.com/create_account.php?redirect=<?php echo $_GET['redirect'];?>";
}
-->
</script>
<script language="javascript" type="text/javascript">
//<![CDATA[
var cot_loc0=(window.location.protocol == "https:")? "https://www.dev.sunstatelimo.com/includes/js/cot.js" :
"https://www.dev.sunstatelimo.com/includes/js/cot.js";
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
              <td><a href="reserve.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','images/reserve_active.gif',1)"><img src="images/reserve_normal.gif" name="Image8" width="153" height="33" border="0" id="Image8" /></a></td>
              <td><a href="contact.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9','','images/contact_active.gif',1)"><img src="images/contact_normal.gif" alt="Contact Us" name="Image9" width="116" height="33" border="0" id="Image9" /></a></td>
            </tr>
          </table>
        </div>
<!--End Navigation Here --> 
<div id="Banner"> 
<img src="images/<?php echo $img_head;?>" /><br />
</div>
<!--Start ContentPanl Here -->
<div id="ContentPanel"> 
	<div id="CenterColumn"> 
    <table width="100%" align="center" style="padding-top:10px;">
    <tr>
    	<td align="center">
    <?php echo $_SESSION['notice']; ?> 
    	</td>
    </tr>
    </table>
<div id="NormalText" class="NormalText"> 
<br />
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
	<? if($_GET['redirect']=="reserve_step3.php"){?>
    <tr>
	  <td colspan="2" align="center">To continue with your reservation please click an option below. If this is your first time using Sunstate Transportation please click on New Client to create your account. If you have previously reserved from us click on returning client and login to continue.<br /><br /></td>
	  </tr>
      <? } ?>
	<tr>
    	<td width="50%" align="center"><a href="#" onClick="$('blinddown2').hide(); Effect.BlindDown('blinddown'); return false;"><img src="images/new_client.jpg" alt="NEW Client?" width="130" height="130" border="0"></a></td>
        <td width="50%" align="center"><a href="#" onClick="$('blinddown').hide(); Effect.BlindDown('blinddown2');return false; "><img src="images/returning_client.jpg" alt="RETURNING Client?" width="130" height="130" border="0" /></a></td>
    </tr>
</table>
<br />
<form style="padding-bottom:0px; display:none;" name="login" method="post" action="login.php?redirect=<?php echo $_GET['redirect'];?>" onsubmit="return validate(this)" id="blinddown2">
	<table border="0" cellpadding="0" cellspacing="0" width="580" class="ot" align="center">
      <tbody><tr>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" background="images/middle_part.jpg">
          <tbody><tr>
          	<td width="11" height="11" background="images/top_left_curve.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>LOGIN DETAILS</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          	<td width="11" height="11" background="images/top_right_curve.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
          </tr>
          <tr>
          	<td width="11" height="11">&nbsp;</td>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody><tr valign="middle">
                <td height="30" width="38%" align="right" class="ob"><strong>Email Address: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="62%">
                  <label>
                  <input name="email" class="bodytxt" size="39" id="email" type="text">
                  </label>
                 </td>
              </tr>
              <tr valign="middle">
                <td height="30" align="right" class="ob"><strong>Password: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30"><input name="password" class="bodytxt" size="39" id="password" type="password"></td>
              </tr>
            </tbody>
            </table>
          <td width="11" height="11">&nbsp;</td>
          </tr>
          </tbody>
          </table>
          <table cellpadding="0" cellspacing="0" border="0" width="100%" background="images/middle_part.jpg">
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
              	<td width="11" height="11" background="images/bottom_left_curve.jpg" style="background-repeat:no-repeat; background-position:bottom;"></td>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input src="images/but_submit.jpg" border="0" height="22" type="image" width="68"></td>
                <td width="11" height="11" background="images/bottom_right_curve.jpg" style="background-repeat:no-repeat; background-position:bottom;">
</td>
              </tr>
            </table>
			</td>
          </tr>
        </table>   
        <a href="forgot_password.php">Forgot password?</a>
		</td>
          </tr>
        </tbody></table>
		</td>
      </tr>
    </tbody></table>
    </form>
    
<form style="padding-bottom:0px; display:none;" name="create_new" method="post" action="create_account.php?redirect=<?php echo $_GET['redirect'];?>" onsubmit="return validate2(this)" id="blinddown">
	<input name="action" type="hidden" value="create_new">
	<table border="0" cellpadding="0" cellspacing="0" width="580" class="ot" align="center">
      <tbody><tr>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" background="images/middle_part.jpg">
          <tbody><tr>
          	<td width="11" height="11" background="images/top_left_curve.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>CREATE A NEW ACCOUNT</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          	<td width="11" height="11" background="images/top_right_curve.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
          </tr>
          <tr>
          	<td width="11" height="11">&nbsp;</td>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
			  <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>First Name: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="first_name" class="bodytxt" size="39" type="text" value="<?php echo $_SESSION['first_name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Last Name: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="last_name" class="bodytxt" size="39" type="text" value="<?php echo $_SESSION['last_name']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Street Address:</strong></td>
                <td align="left" height="30"><input name="address" class="bodytxt" size="39" id="address" type="text" value="<?php echo $_SESSION['address']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Address Line 2:</strong></td>
                <td align="left" height="30"><input name="address2" class="bodytxt" size="39" id="address2" type="text" value="<?php echo $_SESSION['address2']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>City:</strong></td>
                <td align="left" height="30"><input name="town" class="bodytxt" size="39" id="town" type="text" value="<?php echo $_SESSION['town']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>State:</strong></td>
                <td align="left" height="30">
                						<select name="state" id="state" class="bodytxt">
                                        <?php if(!empty($_SESSION['state'])) {
										echo '<option value="'.$_SESSION['state'].'">'.$_SESSION['state'].'</option>';
										};
										?> 
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
                      </select>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Zip Code:</strong></td>
                <td align="left" height="30"><input name="zip" class="bodytxt" size="39" id="zip" type="text" value="<?php echo $_SESSION['town']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Country:</strong></td>
                <td align="left" height="30">
                <select name="country" id="country" class="bodytxt">
                 <?php if(!empty($_SESSION['country'])) {
										echo '<option value="'.$_SESSION['country'].'">'.$_SESSION['country'].'</option>';
										};
										?> 
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
				</select>
                </td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Telephone:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="telephone" class="bodytxt" size="39" type="text" value="<?php echo $_SESSION['telephone']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Alternate Phone Number:</strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="telephone2" class="bodytxt" size="39" type="text" value="<?php echo $_SESSION['telephone2']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" width="38%" class="ob"><strong>Mobile Phone: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="62%" class="ot2"><input name="cellphone" class="bodytxt" size="39" type="text" value="<?php echo $_SESSION['cellphone']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>E-mail: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30"><input name="email" class="bodytxt" size="39" id="email" type="text" value="<?php echo $_SESSION['email']; ?>"></td>
              </tr>
              <tr valign="middle">
                <td align="right" height="30" class="ob"><strong>Password: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30"><input name="password_new" class="bodytxt" size="39" id="password_new" type="password"></td>
              </tr>
              <tr valign="middle">
                <td height="30" align="right" class="ob"><strong>Confirm Password: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30"><input name="password_confirm" class="bodytxt" size="39" id="password_confirm" type="password"></td>
              </tr>
            </tbody>
            </table>
          <td width="11" height="11">&nbsp;</td>
          </tr>
          </tbody>
          </table>
          <table cellpadding="0" cellspacing="0" border="0" width="100%" background="images/middle_part.jpg">
          <tr>
            <td align="left" valign="top"><table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody>
              <tr>
              	<td width="11" height="11" background="images/bottom_left_curve.jpg" style="background-repeat:no-repeat; background-position:bottom;"></td>
                <td align="left" height="48" valign="middle" background="images/bottom_center_curve.jpg">&nbsp;</td>

                <td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input src="images/but_create.jpg" border="0" height="22" type="image" width="68"></td>
                <td width="11" height="11" background="images/bottom_right_curve.jpg" style="background-repeat:no-repeat; background-position:bottom;"></td>
              </tr>
            </table>
			</td>
          </tr>
        </table>   
		</td>
          </tr>
        </tbody></table>
		</td>
      </tr>
    </tbody></table>
	</form>
       <br />
    </div>
                  </div>
    			
                <br />
    </div>
</div>

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
<?php
unset ($_SESSION['notice']);
unset ($_SESSION['first_name']);
unset ($_SESSION['last_name']);
unset ($_SESSION['address']);
unset ($_SESSION['address2']);
unset ($_SESSION['town']);
unset ($_SESSION['state']);
unset ($_SESSION['zip']);
unset ($_SESSION['country']);
unset ($_SESSION['telephone']);
unset ($_SESSION['telephone2']);
unset ($_SESSION['cellphone']);
unset ($_SESSION['fax']);
unset ($_SESSION['email']);
unset ($_SESSION['username']);
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