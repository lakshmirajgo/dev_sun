<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/page_functions.php");

$company_info = get_company_info(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from www.siteplusdesign.com/rash/sunstate/fleet.htm by HTTrack Website Copier/3.x [XR&CO'2004], Fri, 07 Nov 2008 18:30:11 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Orlando's Airport Premier Transportation Services - Publix Aisle Chart</title>
<meta name="keywords" content="orlando airport, orlando airport transportation, limousine orlando, florida transportation, orlando limousine service, transportation in orlando, disney world transportation, transportation, orlando airport shuttle, Disney world, universal studios, Orlando limousine, Disney transportation, Disney world transportation, orlando airport bus, Orlando limousine service, Towncar, luxury sedans, Limo Services, Limos, Walt Disney World transportation">
<meta name="description" content="Orlando's Airport Premier Transportation Services - Limousine, Towncar, Passenger Van">
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
</head>
<body onload="MM_preloadImages('images/rates_active.gif','images/fleet_active.gif','images/faq_active.gif','images/testimonials_active.gif','images/reserve_active.gif','images/contact_active.gif')">
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
                <td><a href="index.php"><img src="images/home_active.gif" alt="Home" width="71" height="33" border="0" /></a></td>
                <td><a href="rates.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','images/rates_active.gif',1)"><img src="images/rates_normal.gif" name="Image4" width="93" height="33" border="0" id="Image4" /></a></td>
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
<img src="images/banner.jpg" /><br />
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
      <div id="b3" style="margin-bottom:3px;"><a href="reserve.php"><img src="../images/Image/B3.jpg" border="0" /></a></div>
    
    
    </div> 
    
    <div id="RightColumn"> 
    		<h1>Publix Aisle Chart</h1>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="BorderBox">
              <tbody>
              	<tr>
                  <td height="25" width="40%" class="ot" bgcolor="#D7E0E4"><strong>Product</strong>
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#D7E0E4"><strong>Aisle</strong>
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#D7E0E4"><strong>Product</strong>
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#D7E0E4"><strong>Aisle</strong>
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Ammonia 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">8
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Meats, Canned 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">3 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Apple Sauce 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">2
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Medicine 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">11
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Baby Needs 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">12
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Milk, Canned 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">1 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Bar Soap 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">11
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Moth Balls 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">8 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Batteries 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">6
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Canned Mushrooms 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">2  
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Beer – Cold 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">13
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Mustard 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">4
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Bleaches 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">8 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Nuts, Canned 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">10 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Bread 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">10 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Oats
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">5 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Brooms, Mops 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">8
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Oils 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">4 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Cake Mixes 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">4 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Olives 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">4 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Candles
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">8 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Organic 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">Produce
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Candy 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">12
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Paper Goods 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">7
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Catsup 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">4 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Peanut Butter 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">10 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Cereals 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">5 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Pet Foods 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">6 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Charcoal 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">10 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Pickles 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">4 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Cheese 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">1 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Pie Crust 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">4 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Cleaners 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">8 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Popcorn 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">10
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Cocoa 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">1 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Potato Chips 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">10 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Coffee 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">5 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Prunes 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">10 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Cookies, Crackers 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">3
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Raisins 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">10
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Dietetic Foods 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">12 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Rice 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">2
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Disinfectants 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">8 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Salad Dressing 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">4 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Eggs 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">1 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Salt
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">4 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Ethnic Foods 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">3 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Sauces, Meat 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">2 
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Eye Care 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">Pharmacy
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Seafood, Canned 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">3
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Flour/Yeast 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">4 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Soap-Detergents 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">8
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Foot Care 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">Pharmacy
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Soda, Baking
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">4
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Frozen Food 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">13
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Soft Drinks 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">9
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Fruits, Canned
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">2
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Soup 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">3
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Fruits, Dried 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">10
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Spaghetti, Dried
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">2
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Gelatins
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">4
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Spices 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">4
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Grits 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">5 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Sugar
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">4
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Health Foods
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">Produce
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Syrup 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">5
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Honey 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">5
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Tea 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">5
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Insecticides
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">8
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Tissue
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">7
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Jellies 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">10 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Tomato Paste
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">2
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Juices, Canned
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">1
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Toothpicks 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">7
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Light Bulbs 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">6
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Toys/Games
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">12
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Macaroni
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">2
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Vegetables, canned
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">2
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Margarine 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">1
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Vinegar
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">4
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Marshmallows
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">12
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Water
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">9
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Matches
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">10
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#fefa8e">Waxes
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#fefa8e">8
                  </td>
                </tr>
                <tr>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Mayonnaise 
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">4 
                  </td>
                  <td height="25" width="40%" class="ot" bgcolor="#FFFFCC">Wines
                  </td>
                  <td height="25" width="10%" class="ot" bgcolor="#FFFFCC">9
                  </td>
                </tr>
              </tbody>
            </table>
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
<?php
unset ($_SESSION['notice']);
?>
<map name="Map" id="Map"><area shape="rect" coords="257,5,276,25" href="index.php" alt="Home page" title="Home page" />
<area shape="rect" coords="284,5,306,25" href="my_account.php" alt="My account" title="My account" />
<area shape="rect" coords="316,6,336,25" href="contact.php" alt="Contact Us" title="Contact Us" /></map></body>
</html>
