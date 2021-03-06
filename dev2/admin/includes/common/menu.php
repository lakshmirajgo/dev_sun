<html>
<head>
<link rel="stylesheet" type="text/css" href="../admin/css/ddlevelsmenu-base.css" />
<link rel="stylesheet" type="text/css" href="../admin/css/ddlevelsmenu-topbar.css" />
<link rel="stylesheet" type="text/css" href="../admin/css/ddlevelsmenu-sidebar.css" />

<script type="text/javascript" src="../admin/js/ddlevelsmenu.js">

/***********************************************
* All Levels Navigational Menu- (c) Dynamic Drive DHTML code library (http://www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>
</head>
<body>


<?php
if ($_SESSION['user_details']['account_type']!='Manager') {
?>
<div id="ddtopmenubar" class="mattblackmenu">
<ul>
<li><a href="http://dev.sunstatelimo.com/admin/">Home</a></li>
<li><a href="#" rel="ddsubmenu1">Clients</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/reservation_manager.php" rel="ddsubmenu2">Reservation Manager</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/price_manager.php" rel="ddsubmenu3">Price Manager</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/" rel="ddsubmenu4">Content Manager</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/" rel="ddsubmenu5">User Manager</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/settings.php">Settings</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/" rel="ddsubmenu6">Reports</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/logout.php">Logout</a></li>
</ul>
</div>

<script type="text/javascript">
ddlevelsmenu.setup("ddtopmenubar", "topbar") //ddlevelsmenu.setup("mainmenuid", "topbar|sidebar")
</script>
<ul id="ddsubmenu1" class="ddsubmenustyle">
<li><a href="http://dev.sunstatelimo.com/admin/client_manager.php?cAction=create_new">Add New Client</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/client_manager.php">Client List</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/client_search.php">Client Lookup</a></li>
</ul>
<ul id="ddsubmenu2" class="ddsubmenustyle">
<li><a href="http://dev.sunstatelimo.com/admin/reservation_manager.php?cAction=create_new">Add New Reservation</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/reservation_manager.php">Reservation List</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/reservation_manager.php">Reservation Look Up</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/reservation_manager.php?search_by=shadesofgreen">SOG Reservation List</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/status_manager.php">Reservation Status</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/locked_dates_manager.php">Locked Date Manager</a></li>
</ul>
<ul id="ddsubmenu3" class="ddsubmenustyle">
<li><a href="http://dev.sunstatelimo.com/admin/zone_manager.php">Zones</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/location_manager.php">Locations</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/reservation_manager.php">Reservation Look Up</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/price_manager.php">Zone Pricing</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/price_manager_sog.php">SOG Pricing</a></li>
</ul>
<ul id="ddsubmenu4" class="ddsubmenustyle">
<li><a href="http://dev.sunstatelimo.com/admin/page_manager.php">Add/Edit Pages</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/vehicle_manager.php">Vehicles</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/testimony_manager.php">Testimonials</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/page_manager.php?cAction=edit&id=61">FAQ's</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/email_manager.php">Email Templates</a></li>
</ul>
<ul id="ddsubmenu5" class="ddsubmenustyle">
	<li><a href="http://dev.sunstatelimo.com/admin/drivers_manager.php">Drivers</a>
		<ul>
			<li><a href="http://dev.sunstatelimo.com/admin/drivers_manager.php?cAction=create_new">Add Driver</a></li>
			<li><a href="http://dev.sunstatelimo.com/admin/drivers_manager.php">Driver List</a></li>
			<li><a href="http://dev.sunstatelimo.com/admin/trip_sheet.php">Trip Sheet</a></li>
			<li><a href="http://dev.sunstatelimo.com/admin/trip_sheet_email_all.php">Trip Sheet Email Drivers</a></li>
			<li><a href="http://dev.sunstatelimo.com/admin/drivers_schedule.php">Drivers Schedule</a></li>
    	</ul>
	</li>
    <li><a href="http://dev.sunstatelimo.com/admin/users.php">Admin users</a>
		<ul>
			<li><a href="http://dev.sunstatelimo.com/admin/users.php">User List</a></li>
			<li><a href="http://dev.sunstatelimo.com/admin/users.php">Add/Edit Users</a></li>
    	</ul>
    </li>
</ul>
<ul id="ddsubmenu6" class="ddsubmenustyle">
<li><a href="http://dev.sunstatelimo.com/admin/cpanel_login.php">Cpanel Reports</a></li>
<li><a href="https://www.google.com/accounts/ServiceLoginBoxAuth?ctu=https%3A%2F%2Fwww.google.com%2Fanalytics%2Fsettings%2F%3Fhl%3Den-US&continue=https%3A%2F%2Fwww.google.com%2Fanalytics%2Fsettings%2F%3F%26et%3Dreset%26hl%3Den-US&service=analytics&nui=1&hl=en-US&GA3T=wc0HAw4hWb4&Email=sunstatelimoseo%40gmail.com&Passwd=rash4075&PersistentCookie=yes&rmShown=1&x=59&y=64">Google Analytics</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/get_report.php">Reservation/Revenue Report</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/get_report_sanford.php">Reservation/Revenue Report (Sanford)</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/expense_log.php">Expense Log</a></li>
<li><a href="#">Accounting Ledger</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/salary_report.php">Salary Reports</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/transfer_report.php">Transfer Report</a></li>
</ul>
<?php
} else {
?>
<div style="width:100%" align="center">
<div id="ddtopmenubar" class="mattblackmenu" style="width:680px;" align="center">
<ul>
<li><a href="http://dev.sunstatelimo.com/admin/">Home</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/reservation_manager.php" rel="ddsubmenu2">Reservation Manager</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/" rel="ddsubmenu5">User Manager</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/" rel="ddsubmenu6">Reports</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/logout.php">Logout</a></li>
</ul>
</div>
</div>
<script type="text/javascript">
ddlevelsmenu.setup("ddtopmenubar", "topbar") //ddlevelsmenu.setup("mainmenuid", "topbar|sidebar")
</script>

<ul id="ddsubmenu2" class="ddsubmenustyle">
<li><a href="http://dev.sunstatelimo.com/admin/reservation_manager.php?cAction=create_new">Add New Reservation</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/reservation_manager.php">Reservation List</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/reservation_manager.php">Reservation Look Up</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/reservation_manager.php?search_by=shadesofgreen">SOG Reservation List</a></li>
</ul>
<ul id="ddsubmenu5" class="ddsubmenustyle">
	<li><a href="http://dev.sunstatelimo.com/admin/drivers_manager.php">Drivers</a>
		<ul>
			<li><a href="http://dev.sunstatelimo.com/admin/drivers_manager.php?cAction=create_new">Add Driver</a></li>
			<li><a href="http://dev.sunstatelimo.com/admin/drivers_manager.php">Driver List</a></li>
			<li><a href="http://dev.sunstatelimo.com/admin/trip_sheet.php">Trip Sheet</a></li>
			<li><a href="http://dev.sunstatelimo.com/admin/drivers_schedule.php">Drivers Schedule</a></li>
    	</ul>
	</li>
</ul>
<ul id="ddsubmenu6" class="ddsubmenustyle">
<li><a href="http://dev.sunstatelimo.com/admin/get_report_sanford.php">Reservation/Revenue Report (Sanford)</a></li>
<li><a href="http://dev.sunstatelimo.com/admin/expense_log.php">Expense Log</a></li>
</ul>
<?php
}
?>
<!--<table border="0" cellpadding="0" cellspacing="0" width="100%" class="ot">
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
            <td class="bodytxt" align="center" height="15" valign="middle" background="images/top_center_curve.jpg"></td>
          </tr>
        </tbody></table>
        <div>
        <a href="index.php" class="menu">HOME</a>&nbsp;<b class="line">|</b>&nbsp;<a href="client_manager.php" class="menu">CLIENTS</a>&nbsp;<b class="line">|</b>&nbsp;<a href="reservation_manager.php" class="menu">RESERVATIONS</a>&nbsp;<b class="line">|</b>&nbsp;<a href="reservation_manager.php?search_by=shadesofgreen" class="menu">SHADES OF GREEN RESERVATIONS</a>&nbsp;<b class="line">|</b>&nbsp;<a href="vehicle_manager.php" class="menu">VEHICLE</a>&nbsp;<b class="line">|</b>&nbsp;&nbsp;<a href="zone_manager.php" class="menu">ZONE</a>&nbsp;&nbsp;<b class="line">|</b>&nbsp;&nbsp;<a href="location_manager.php" class="menu">LOCATION</a>&nbsp;&nbsp;<b class="line">|</b>&nbsp;<a href="price_manager.php" class="menu">PRICE</a>&nbsp;<b class="line">|</b>&nbsp;<a href="price_manager_sog.php" class="menu">PRICE SOG</a>&nbsp;<b class="line">|</b>&nbsp;<a href="page_manager.php" class="menu">PAGES</a>&nbsp;<b class="line">|</b>&nbsp;<a href="email_manager.php" class="menu">EMAIL</a>&nbsp;<b class="line">|</b>&nbsp;<a href="status_manager.php" class="menu">STATUS</a>&nbsp;<b class="line">|</b>&nbsp;<a href="report_manager.php" class="menu">REPORTS</a>&nbsp;<b class="line">|</b><b class="line"></b>&nbsp;<a href="users.php" class="menu">USERS</a> <b class="line">|</b>&nbsp;<a href="testimony_manager.php" class="menu">TM</a>&nbsp;<b class="line">|</b>&nbsp;<a href="drivers_manager.php" class="menu">DM</a>&nbsp;<b class="line">|</b>&nbsp;<a href="expense_log.php" class="menu">EL</a>&nbsp;<b class="line">|</b>&nbsp;<a href="expense_report.php" class="menu">R</a>&nbsp;<b class="line">|</b>&nbsp;<a href="trip_sheet.php" class="menu">TS</a>&nbsp;<b class="line">|</b>&nbsp;<a href="settings.php" class="menu">SETTINGS</a>&nbsp;<b class="line">|</b>&nbsp;<a href="logout.php" class="menu">LOG OUT</a>        </div>
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody><tr>
            <td class="bodytxt" align="center" height="15" valign="middle" background="images/bottom_center_curve1.jpg"></td>
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
    </tbody></table>-->
