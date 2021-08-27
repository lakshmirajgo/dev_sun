<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
include ("includes/common/header.php");	
?>
	<div align="center">	
<?php include ("includes/common/menu.php");	?>
	<br />
    <form name="report" method="post" action="get_report.php" style="padding:0px; margin:0px;">
	<table border="0" cellpadding="0" cellspacing="0" width="90%">
                <tbody><tr>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><strong>REPORT BY DATE</strong></td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="center" height="20" valign="top">
                  
                  From
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="center" height="20" valign="top"><input name="from" type="text" id="from" size="8" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal1.popup();"><i> <font color="#ff0000" size=2>select date</font></i>
</td><td style="border-bottom: 1px solid rgb(220, 220, 220);" align="center" height="20" valign="top">&nbsp;&nbsp;&nbsp;To</td><td style="border-bottom: 1px solid rgb(220, 220, 220);" align="center" height="20" valign="top"><input name="to" type="text" id="to" size="8" maxlength="10">&nbsp;<img src="img/cal.gif" width="16" height="16" onClick="javascript:cal2.popup();"><i> <font color="#ff0000" size=2>select date</font></i>
                  </td>
                  <td style="border-bottom: 1px solid rgb(220, 220, 220);" align="left" height="20" valign="top"><input src="images/but_submit.jpg" border="0" height="22" type="image" width="68"></td>
                </tr>
              </tbody></table></form>
              <br /><br />
              <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
              	<tr>
                	<td width="50%" align="center">
                    
                      <a href="cpanel_login.php" target="_blank"><img src="images/cpanel_reports.jpg" alt="View Website Statistics" border="0"></a> </td>
                    <td width="50%" align="center">
                    <form method="get" name="langform" action="https://www.google.com/accounts/ServiceLoginBoxAuth" target="_blank">
              <input type="hidden" name="ctu" value="https://www.google.com/analytics/settings/?hl=en-US">
<input name="continue" value="https://www.google.com/analytics/settings/?&amp;et=reset&amp;hl=en-US" type="hidden"><input name="service" value="analytics" type="hidden">  <input name="nui" value="1" type="hidden">                 <input name="hl" value="en-US" type="hidden">                          
<input name="GA3T" value="wc0HAw4hWb4" type="hidden">
<input name="Email" value="sunstatelimoseo@gmail.com" class="gaia le val" size="18" id="Email" type="hidden">
<input name="Passwd" class="gaia le val" id="Passwd" size="18" type="hidden" value="rash4075">
<input name="PersistentCookie" value="yes" type="hidden">
<input name="rmShown" value="1" type="hidden">
<input src="images/google_reports.jpg" border="0" type="image">

</form>
                   </td>
                </tr>
             </table>
              <script language="JavaScript">
<!-- // create calendar object(s) just after form tag closed
	 // specify form element as the only parameter (document.forms['formname'].elements['inputname']);
	 // note: you can have as many calendar objects as you need for your application
	var cal1 = new calendar2(document.forms['report'].elements['from']);
	cal1.year_scroll = true;
	cal1.time_comp = false;
	var cal2 = new calendar2(document.forms['report'].elements['to']);
	cal2.year_scroll = true;
	cal2.time_comp = false;
//-->
</script>
    </div>
<?php
include ("includes/common/footer.php");
?>