<?php
session_start();
include ("includes/functions/general_functions.php");
include ("includes/functions/page_functions.php");
include("includes/functions/vehicle_functions.php");

$page = get_pages_view('links');

$company_info = get_company_info(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from www.siteplusdesign.com/rash/sunstate/fleet.htm by HTTrack Website Copier/3.x [XR&CO'2004], Fri, 07 Nov 2008 18:30:11 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $page['page_title'];?></title>
<meta name="keywords" content="<?php echo $page['meta_keywords']; ?>">
<meta name="description" content="<?php echo $page['meta_description']; ?>">
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
                <td><a href="index.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image19','','images/home_active.gif',1)"><img src="images/home_normal.gif" name="Image19" width="71" height="33" border="0" id="Image19" /></a><a href="index.php"></a></td>
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
      <div id="b3" style="margin-bottom:3px;"><a href="reserve.php"><img src="../images/Image/B3.jpg" border="0" /></a></div>
    
    
    </div> 
    
    <div id="RightColumn"> 
    		<h1><?php echo $page['page_title'];?></h1>
            <p style="padding-left:10px;"><?php echo $page['page_content'];?></p>
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
