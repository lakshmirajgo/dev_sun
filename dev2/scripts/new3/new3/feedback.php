<?php
session_start();
include ("includes/functions/general_functions.php");
$company_info = get_company_info(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Orlando's Airport Premier Transportation Services - Feedback</title>
<meta name="keywords" content="orlando airport, orlando airport transportation, limousine orlando, florida transportation, orlando limousine service, transportation in orlando, disney world transportation, transportation, orlando airport shuttle, Disney world, universal studios, Orlando limousine, Disney transportation, Disney world transportation, orlando airport bus, Orlando limousine service, Towncar, luxury sedans, Limo Services, Limos, Walt Disney World transportation">
<meta name="description" content="Orlando's Airport Premier Transportation Services - Limousine, Towncar, Passenger Van">
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<script type="text/javascript" src="includes/js/validate.js"></script>
<script type="text/javascript" src="includes/js/menu.js"></script>
<script type="text/javascript">
	function validate_testimony_form(form)
	{
		if(form.name.value=='' || form.testimonial.value=='')
		{
			alert('Required Fields are marked with an asterik (*). \r\n Please check the form for the missing information');
			return false;
		}
		return true;
	}	
</script>
</head>
<body onload="MM_preloadImages('images/fleet_active.gif','images/faq_active.gif','images/testimonials_active.gif','images/reserve_active.gif','images/contact_active.gif','images/home_active.gif','images/rates_active.gif')">
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
                <td><a href="index.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image19','','images/home_active.gif',1)"><img src="images/home_normal.gif" name="Image19" width="71" height="33" border="0" id="Image19" /></a><a href="index.php"></a></td>
                <td><a href="rates.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image40','','images/rates_active.gif',1)"><img src="images/rates_normal.gif" name="Image40" width="93" height="33" border="0" id="Image40" /></a></td>
                <td><a href="fleet.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','images/fleet_active.gif',1)"><img src="images/fleet_normal.gif" name="Image5" width="85" height="33" border="0" id="Image5" /></a></td>
                <td><a href="faq.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/faq_active.gif',1)"><img src="images/faq_normal.gif" name="Image6" width="81" height="33" border="0" id="Image6" /></a></td>
                <td><a href="testimonial.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','images/testimonials_active.gif',1)"><img src="images/testimonials_normal.gif" name="Image7" width="139" height="33" border="0" id="Image7" /></a></td>
                <td><a href="reserve.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','images/reserve_active.gif',1)"><img src="images/reserve_normal.gif" name="Image8" width="153" height="33" border="0" id="Image8" /></a></td>
                <td><a href="contact.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9','','images/contact_active.gif',1)"><img src="images/contact_normal.gif" name="Image9" width="116" height="33" border="0" id="Image9" /></a></td>
              </tr>
            </table>
        </div>
<!--End Navigation Here --> 
<div id="Banner"> 
<img src="images/<?php echo $img_head;?>" /><br />
</div>
<!--Start ContentPanl Here -->
<div id="ContentPanel"> 
	<div id="LeftColumn"> 
   	  <div id="Login" class="LeftBox">
      <?php include("login_tab.php"); ?>
      </div>
        <div id="b2" style="margin-bottom:3px;"><img src="images/B2.jpg" border="0" usemap="#Map2" />
<map name="Map2" id="Map2"><area shape="rect" coords="13,8,168,79" href="reserve.php?vehicle=town_car" />
<area shape="rect" coords="12,89,170,153" href="reserve.php?vehicle=limousine" />
<area shape="rect" coords="12,164,169,237" href="reserve.php?vehicle=van" />
<area shape="rect" coords="4,243,172,268" href="reserve.php" />
</map></div>
        <div id="b3" style="margin-bottom:3px;"><a href="reserve.php"><img src="images/B3.jpg" border="0" /></a> </div>
    
    
    </div> 
    
    <div id="RightColumn"> 
    		<h1>Feedback</h1>
            <div id="NormalText" class="NormalText">To ensure that we continue to provide our customers with top notch service we please ask that you fill out a few short questions to let us know your experience.</div><br />
            <form name="form" method="post" action="submit_testimonial.php" onsubmit="return validate_testimony_form(this);">
				<input type="hidden" name="action" value="submit" />
              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="BorderBox" bgcolor="#e9fbff">
                <tbody><tr> 
                  <td class="ot"><strong>Name <font color="#ff0000" size="2">*</font></strong></td>
                  <td class="ot"><input name="name" value=""></td>
                </tr>

                <tr> 
                  <td class="ot"><strong>Email Address</strong></td>
                  <td class="ot"><input name="email_address"></td>
                </tr>
                <tr valign="middle" class="bodytxt">
						<td align="left" height="30" class="ot"><strong>City:</strong></td>
                		<td align="left" height="30" class="ot"><input name="city" class="bodytxt" size="39" type="text" /></td>
                		</tr>
                <tr valign="middle" class="bodytxt">
						<td align="left" height="30" class="ot"><strong>State:</strong></td>
                		<td align="left" height="30" class="ot"><select name="state">
										<option value="" selected="selected">Select State</option>
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
						</select></td>
                		</tr>
                <tr> 
                  <td class="ot"><strong>Overall SUN STATE TRANSPORTATION experience</strong></td>
                  <td width="40%" class="ot"> 
                    <select name="overall_rating" size="1">

                      <option selected="selected" value="5">5 - Excellent</option>
                      <option value="4">4 - Above Average</option>
                      <option value="3 ">3 - Average</option>
                      <option value="2">2 - Below Average</option>
                      <option value="1">1 - Poor</option>
                    </select></td>
                </tr>
                <tr> 
                  <td width="60%" class="ot"><strong>Cleanliness of your vehicle</strong></td>
                  <td width="40%" class="ot"> 
                    <select name="clean_rating" size="1">
                      <option selected="selected" value="5">5 - Excellent</option>
                      <option value="4">4 - Above Average</option>

                      <option value="3 ">3 - Average</option>
                      <option value="2">2 - Below Average</option>
                      <option value="1">1 - Poor</option>
                    </select>                    </td>
                </tr>
                <tr> 
                  <td class="ot"><strong>Vehicle Type</strong></td>

                  <td class="ot"> 
                    <select name="vehicle" required="no" size="1">
                      <option value="Town Car">Town Car</option>
                      <option value="Luxury Van">Luxury Van</option>
                      <option value="Limo">Limousine</option>
                    </select>                   </td>
                </tr>
                <tr> 
                  <td width="60%" class="ot"><strong>Rate the Service</strong></td>
                  <td width="40%" class="ot"> 
                    <select name="service_rating" size="1">
                      <option selected="selected" value="5">5 - Excellent</option>
                      <option value="4">4 - Above Average</option>
                      <option value="3 ">3 - Average</option>

                      <option value="2">2 - Below Average</option>
                      <option value="1">1 - Poor</option>
                    </select>                  </td>
                </tr>
                <tr> 
                  <td width="60%" class="ot"><strong>Rate the Driver</strong></td>
                  <td width="40%" class="ot"> 
                    <select name="driver_rating" size="1">

                      <option selected="selected" value="5">5 - Excellent</option>
                      <option value="4">4 - Above Average</option>
                      <option value="3 ">3 - Average</option>
                      <option value="2">2 - Below Average</option>
                      <option value="1">1 - Poor</option>
                    </select>                  </td>
                </tr>
                <tr> 
                  <td width="60%" class="ot"><strong>Drivers Name (If you remember)</strong></td>
                  <td class="ot">
                    <input name="drivers_name" value="" size="25" type="text">                  </td>
                </tr>
                <tr> 
                  <td width="60%" class="ot"><strong>Value of the service for&nbsp; the money you spent?</strong></td>

                  <td width="40%" class="ot">
                    <select name="money_rating" size="1">
                      <option selected="selected" value="5">5 - Excellent</option>
                      <option value="4">4 - Above Average</option>
                      <option value="3">3 - Average</option>
                      <option value="2">2 - Below Average</option>
                      <option value="1">1 - Poor</option>
                    </select>                  </td>
                </tr>
                <tr> 
                  <td width="60%" class="ot"><strong>Would you use us again?</strong></td>
                  <td width="40%" class="ot"> 
                    <select name="use_us_again" size="1">
                      <option selected="selected" value="Yes">Yes</option>
                      <option value="No">No</option>
                    </select>                  </td>
                </tr>
                <tr> 
                  <td valign="top" width="60%" class="ot"><strong>Comments or Suggestions to improve our service <font color="#ff0000" size="2">*</font></strong></td>
                  <td width="40%" class="ot"> 
                    <textarea cols="31" rows="5" name="testimonial"></textarea>                  </td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td class="ot"> 
                    <input name="submit" value="Submit" type="submit">
                    <input name="reset" value="Reset" type="reset">                  </td>
                </tr>
              </tbody></table>
            </form> 
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
    </div>
<!--End Footer Here -->
</div>

<map name="Map" id="Map"><area shape="rect" coords="257,5,276,25" href="index.php" alt="Home page" title="Home page" />
<area shape="rect" coords="284,5,306,25" href="my_account.php" alt="My account" title="My account" />
<area shape="rect" coords="316,6,336,25" href="contact.php" alt="Contact Us" title="Contact Us" /></map></body>
</html>
