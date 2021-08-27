<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/page_functions.php");

$page = get_pages_view('faq');
$company_info = get_company_info(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $page['page_title'];?></title>
<meta name="keywords" content="<?php echo $page['meta_keywords']; ?>">
<meta name="description" content="<?php echo $page['meta_description']; ?>">
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="includes/js/validate.js"></script>
<script type="text/javascript" src="includes/js/menu.js"></script>
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
                <td><a href="fleet.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image41','','images/fleet_active.gif',1)"><img src="images/fleet_normal.gif" name="Image41" width="85" height="33" border="0" id="Image41" /></a><a href="fleet.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image41','','images/faq_active.gif',1)"></a></td>
                <td><img src="images/faq_active.gif" width="81" height="33" border="0" /></td>
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
        <div id="b2" style="margin-bottom:3px;"><img src="../images/Image/B2.jpg" border="0" usemap="#Map2" />
<map name="Map2" id="Map2"><area shape="rect" coords="13,8,168,79" href="reserve.php?vehicle=town_car" />
<area shape="rect" coords="12,89,170,153" href="reserve.php?vehicle=limousine" />
<area shape="rect" coords="12,164,169,237" href="reserve.php?vehicle=van" />
<area shape="rect" coords="4,243,172,268" href="reserve.php" />
</map></div>
        <div id="b3" style="margin-bottom:3px;"><a href="reserve.php"><img src="../images/Image/B3.jpg" border="0" /></a> </div>
    	<div id="b4" style="margin-bottom:3px;"><a href="reserve.php"><img src="../images/Image/B4.jpg" border="0" /></a> </div>
    
    </div> 
    
    <div id="RightColumn"> 
    		
            <?php echo $page['page_content']; ?>
        	
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

<map name="Map" id="Map"><area shape="rect" coords="257,5,276,25" href="index.php" alt="Home page" title="Home page" />
<area shape="rect" coords="284,5,306,25" href="my_account.php" alt="My account" title="My account" />
<area shape="rect" coords="316,6,336,25" href="contact.php" alt="Contact Us" title="Contact Us" /></map></body>
</html>
