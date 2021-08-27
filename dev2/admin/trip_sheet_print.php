<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}

include_once("includes/functions/general_functions.php");
include_once("includes/functions/vehicle_functions.php");	
include_once("includes/functions/status_functions.php");
include_once("includes/functions/location_functions.php");
include_once("includes/functions/drivers_functions.php");
include_once("includes/functions/expense_log_functions.php");
include_once("includes/functions/reservation_functions2.php");
include_once("includes/functions/trip_type_functions.php");	

	
	if($_GET['cAction']=="get_trip_sheet"){
		$all_trips = get_driver_from_reservation($_GET['drivers_id'], format_date_calendar($_GET["from"]), format_date_calendar($_GET["to"]));
		}
		
	?>
  <?php 		
	$company_info = get_company_info();
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<base href="http://<?php print $_SERVER['HTTP_HOST']; ?>">
<link href="css/master.css" rel="stylesheet" type="text/css"><title>IWS Site Manager Ver 2.0 - <?php echo $company_info['company']; ?></title>
<style>
body {
	background-color:#FFFFFF;
	font-family: Verdana, Tahoma, Arial, Helvetica, sans-serif;
	font-size: 14px;
	}
.bodytxt {
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

</style>
</head>
<script type="text/Javascript" language="JavaScript">
window.print();
</script>
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
<img src="images/sunstate.gif" alt="Sunstate" />
</div>
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
          <tbody><tr>
            <td class="bodytxt" align="center" height="28" valign="middle">
              <table border="0" cellpadding="5" cellspacing="0" width="90%">
                <tbody><tr>
                  <td align="center" height="20" valign="top"><strong>DRIVER'S TRIP SHEET</strong></td>
                  </tr>
                  <tr>
                </tr>
              </tbody></table>
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              	<td width="50%" valign="middle" align="left"><strong>Date:</strong> <?php if (!empty($_GET['from'])) { echo $_GET['from'].' - '; } ;?><?php if (!empty($_GET['to'])) { echo $_GET['to']; } ;?><br /><strong>Driver:</strong> <?php $driver = get_driver_view($_GET['drivers_id']); echo  strtoupper($driver['first_name']). " " .strtoupper($driver['last_name']); ?></td>
                <td width="50%" valign="middle" align="right"><strong>Car Number:</strong> ____________</td>
              </tr>
              </table>
            </td>
          </tr>
          <tr>
          	<td>


<br style="clear:both;" />

<?php get_future_reservations_trip_sheet_with_pages_print(); ?>


            
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