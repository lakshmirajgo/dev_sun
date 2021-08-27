<?php
include ("includes/functions/general_functions.php");
include("includes/functions/client_functions.php");	

if (!empty($_POST['email'])) {
reset_password($_POST['email']);
};

$company_info = get_company_info(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Orlando's Airport Premier Transportation Services - Forgot Password</title>
<meta name="keywords" content="orlando airport, orlando airport transportation, limousine orlando, florida transportation, orlando limousine service, transportation in orlando, disney world transportation, transportation, orlando airport shuttle, Disney world, universal studios, Orlando limousine, Disney transportation, Disney world transportation, orlando airport bus, Orlando limousine service, Towncar, luxury sedans, Limo Services, Limos, Walt Disney World transportation">
<meta name="description" content="Orlando's Airport Premier Transportation Services - Limousine, Towncar, Passenger Van">
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="includes/js/validate.js"></script>
<script type="text/javascript" src="includes/js/menu.js"></script>
<!-- European format dd-mm-yyyy -->
<script language="JavaScript" src="calendar1.js"></script><!-- Date only with year scrolling -->
<!-- American format mm/dd/yyyy -->
<script language="JavaScript" src="calendar2.js"></script><!-- Date only with year scrolling -->
<!-- mySQL format yyyy-mm-dd -->
<script language="JavaScript" src="calendar3.js"></script><!-- Date only with year scrolling -->
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
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
    <form id="forgot_password" style="padding-bottom:0px;" name="forgot_password" method="post" action="forgot_password.php">
	<table border="0" cellpadding="0" cellspacing="0" width="580" class="ot" align="center">
      <tbody><tr>
        <td align="center" valign="middle" width="100%">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" background="images/middle_part.jpg">
          <tbody><tr>
          	<td width="11" height="11" background="images/top_left_curve.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
            <td class="bodytxt" align="center" height="48" valign="middle" background="images/top_center_curve.jpg"><strong>&nbsp;&nbsp;&nbsp;</strong>
              <table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>FORGOTTEN PASSWORD</strong></td>
                </tr>
              </tbody></table>
              <strong> </strong></td>
          	<td width="11" height="11" background="images/top_right_curve.jpg" style="background-repeat:no-repeat; background-position:top;">&nbsp;</td>
          </tr>
          <tr>
          	<td width="11" height="11">&nbsp;</td>
            <td align="left" valign="top">
            Enter your email address below and we'll send you an email message containing your new password. <span class="style1"><strong>Note: </strong>Please check your Junk or Trash folder just incase the email goes there.</span><br />
            <br />
            <table class="bodytxt" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody><tr valign="middle">
                <td height="30" width="38%" align="right" class="ob"><strong>Email: <font color="#ff0000" size="2">*</font></strong></td>
                <td align="left" height="30" width="62%">
                  <label>
                  <input name="email" class="bodytxt" size="39" id="email" type="text">
                  </label>
                 </td>
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

               	<td style="padding-top: 5px;" align="right" valign="top" background="images/bottom_center_curve.jpg"><input src="images/but_submit.jpg" border="0" height="22" type="image"></td>
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
?>
<map name="Map" id="Map"><area shape="rect" coords="257,5,276,25" href="index.php" alt="Home page" title="Home page" />
<area shape="rect" coords="284,5,306,25" href="my_account.php" alt="My account" title="My account" />
<area shape="rect" coords="316,6,336,25" href="contact.php" alt="Contact Us" title="Contact Us" /></map></body>
</html>
