<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}

	include("includes/functions/general_functions.php");
	include("includes/functions/drivers_functions.php");
	include("includes/functions/reservation_functions2.php");
	include("includes/functions/vehicle_functions.php");
	include_once("includes/functions/location_functions.php");
	include_once("includes/functions/trip_type_functions.php");	
	include_once("includes/functions/status_functions.php");	
	
	
$all_vehicles = get_all_vehicles();
$all_reservations = get_all_reservations();
	?>
  <?php 		
	$company_info = get_company_info();
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/master.css" rel="stylesheet" type="text/css">
<title>IWS Site Manager Ver 2.0 - <?php echo $company_info['company']; ?></title>
<style>
body {
	background-color:#FFFFFF;
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: 14px;
	}

/* the div that holds the date picker calendar */
.dpDiv {
	}


/* the table (within the div) that holds the date picker calendar */
.dpTable {
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 12px;
	text-align: center;
	color: #505050;
	background-color: #ece9d8;
	border: 1px solid #AAAAAA;
	}


/* a table row that holds date numbers (either blank or 1-31) */
.dpTR {
	}


/* the top table row that holds the month, year, and forward/backward buttons */
.dpTitleTR {
	}


/* the second table row, that holds the names of days of the week (Mo, Tu, We, etc.) */
.dpDayTR {
	}


/* the bottom table row, that has the "This Month" and "Close" buttons */
.dpTodayButtonTR {
	}


/* a table cell that holds a date number (either blank or 1-31) */
.dpTD {
	border: 1px solid #ece9d8;
	}


/* a table cell that holds a highlighted day (usually either today's date or the current date field value) */
.dpDayHighlightTD {
	background-color: #CCCCCC;
	border: 1px solid #AAAAAA;
	}


/* the date number table cell that the mouse pointer is currently over (you can use contrasting colors to make it apparent which cell is being hovered over) */
.dpTDHover {
	background-color: #aca998;
	border: 1px solid #888888;
	cursor: pointer;
	color: red;
	}


/* the table cell that holds the name of the month and the year */
.dpTitleTD {
	}


/* a table cell that holds one of the forward/backward buttons */
.dpButtonTD {
	}


/* the table cell that holds the "This Month" or "Close" button at the bottom */
.dpTodayButtonTD {
	}


/* a table cell that holds the names of days of the week (Mo, Tu, We, etc.) */
.dpDayTD {
	background-color: #CCCCCC;
	border: 1px solid #AAAAAA;
	color: white;
	}


/* additional style information for the text that indicates the month and year */
.dpTitleText {
	font-size: 12px;
	color: gray;
	font-weight: bold;
	}


/* additional style information for the cell that holds a highlighted day (usually either today's date or the current date field value) */ 
.dpDayHighlight {
	color: 4060ff;
	font-weight: bold;
	}


/* the forward/backward buttons at the top */
.dpButton {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: gray;
	background: #d8e8ff;
	font-weight: bold;
	padding: 0px;
	}


/* the "This Month" and "Close" buttons at the bottom */
.dpTodayButton {
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: gray;
	background: #d8e8ff;
	font-weight: bold;
	}
	
.ob {
		font-size:14px;
	}	

</style>
</head>
<SCRIPT TYPE="text/Javascript" LANGUAGE="JavaScript">
window.print();
</SCRIPT>
<body>
  <?php
 	//$all_trips = get_all_trips();
	//print_r($all_trips); exit;
    $all_drivers = get_all_drivers();
	//print_r( $all_drivers); exit;

	// Show Trip Sheet for Specific Driver
	if (empty($_GET['cAction']) ||  $_GET['cAction'] == 'get_trip_sheet'){
	?>
  
<table border="0" cellpadding="10" cellspacing="10" width="1172" class="ot" bgcolor="#FFFFFF" align="center">
<tbody><tr>
        <td align="center" valign="middle" width="100%">
        <div align="center">
<img src="../images/sunstate.gif" alt="Sunstate" />
</div>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody>
          <tr>
          	<td width="100%" height="10">&nbsp;</td>
          </tr>
          <tr>
          
            <td class="bodytxt" align="center" height="28" valign="middle">
              
              <table border="1" cellpadding="0" cellspacing="0" class="bodytxt">
    	<tr>
        	<td width="100" align="center" style="padding:5px;"><img src="images/arrivals_legend.jpg" border="0" title="ARRIVALS" alt="ARRIVALS" /></td>
            <td width="100" align="center" style="padding:5px;"><img src="images/departures_legend.jpg" border="0" title="DEPARTURES" alt="DEPARTURES" /></td>
            <td width="160" align="center" style="padding:5px;"><img src="images/transfers_legend.jpg" border="0" title="TRANSFERS" alt="TRANSFERS" /></td>
        </tr>
        <tr>
        	<td width="100" align="center" style="padding:5px;"><strong>FIRST TRANSFER</strong></td>
            <td width="100" align="center" style="padding:5px;"><strong>LAST TRANSFER</strong></td>
            <td width="160" align="center" style="padding:5px;"><strong>TRANSFERS WITH > 2 LEGS</strong></td>
      </tr>
    </table>
            </td>
          </tr>
          <tr>
          	<td>
                <?php 
				get_future_reservations_with_pages_print();
                ?>
            </td>
          </tr>
        </tbody></table>
		</td>
      </tr>
    </tbody>
  </table>
<?php
	}
	?>
</body></html>