<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}

include("includes/functions/general_functions.php");
include("includes/functions/location_functions.php");
include("includes/functions/drivers_functions.php");
include("includes/functions/expense_log_functions.php");
	
	
		$all_trips = get_driver_from_reservation_by_iws($_GET['drivers_id'], format_date_calendar($_GET["from"]), format_date_calendar($_GET["to"]));
		
	?>
  <?php 		
	$company_info = get_company_info();
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/master.css" rel="stylesheet" type="text/css"><title>IWS Site Manager Ver 2.0 - <?php echo $company_info['company']; ?></title>
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
          <tbody><tr>
            <td class="bodytxt" align="center" height="28" valign="middle">
              <table border="0" cellpadding="5" cellspacing="0" width="90%">
                <tbody><tr>
                  <td align="center" height="20" valign="top"><strong>DRIVER'S SALARY REPORT</strong></td>
                  </tr>
                  <tr>
                </tr>
              </tbody></table>
              <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              	<td width="50%" valign="middle" align="left"><strong>Date:</strong> <?php if (!empty($_GET['from'])) { echo $_GET['from'].' - '; } ;?><?php if (!empty($_GET['to'])) { echo $_GET['to']; } ;?><br /><strong>Driver:</strong> <?php $driver = get_driver_view($_GET['drivers_id']); echo  strtoupper($driver['first_name']). " " .strtoupper($driver['last_name']); ?></td>
                <td width="50%" valign="middle" align="right">&nbsp;</td>
              </tr>
              </table>
            </td>
          </tr>
          <tr>
          	<td>
                <table width="1044" border="1" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="bodytxt" style="margin-top: 10px; font-size:14px;">
                  <tr bgcolor="#FFFFFF" >
                    <td width="28" style="font-weight: bold; color:#FFFFFF">&nbsp;</td>
                    <td width="100" align="center" height="22" style="font-weight: bold; font-size:14px;" class="ot1">DATE</td>
                    <td width="28%" align="center" height="22" style="font-weight: bold; font-size:14px;" class="ot1">NUMBER OF TRANSFERS</td>
                    <td width="28%" align="center" height="22" style="font-weight: bold; font-size:14px;" class="ot1">WAGE TYPE</td>
                    <td width="28%" align="center" height="22" style="font-weight: bold; font-size:14px;" class="ot1">TOTAL AMOUNT</td>
                  </tr>
                  <?php 	
					if(count($all_trips)>=1 && $_GET['drivers_id'] != ''){
					$list=1;
					$number_of_trips ='0';
					$total_this_day ='0';
					$total_salary = '0';
					foreach($all_trips as $value){
		 			if($bgcolor=="#E4E4E4") $bgcolor="#FFFFFF"; else $bgcolor="#E4E4E4";
                    echo '<tr bgcolor="'.$bgcolor.'">';
					?>
  <td width="28" height="22" align="center" class="ot1"><?php echo $list; $list++; ?></td>
    <td width="100" height="22" align="center"><?php echo format_date_calendar2($value['pickup_date']); ?></td>
    <td width="28%" align="center"><?php  echo $number_of_trips = count_number_of_trips($_GET['drivers_id'], $value['pickup_date'], $value['pickup_date']); ?></td>
    <td width="28%" height="22" align="center"><?php if($number_of_trips > $company_info['driver_minimum_transfers']) { echo 'Daily Wage'; $total_this_day = $driver['daily_wage']; } else { echo '$'.number_format($driver['per_transfer_wage'], 2, '.', ''). ' per transfer'; $total_this_day = $driver['per_transfer_wage']*$number_of_trips; }; ?></td>
    <td width="28%" align="center"><?php echo '$'.number_format($total_this_day, 2, '.', ''); $total_salary = $total_this_day + $total_salary; ?></td>
  </tr>
    <?php } ?>
  <?php 					
						} 
						elseif ($_GET['drivers_id']=="") { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>A driver has not been selected for a Salary Report. Please Select a driver above.</div><table><tr><td></td></tr>'; }
						else { echo '</table><div align="center" style="padding-top:20px; padding-bottom:20px;"><strong>There are no reports for this driver.</div><table><tr><td></td></tr>'; } 
					?>
                </table>
            </td>
          </tr>
        </tbody></table>
        <br />
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
              	<td width="50%" valign="middle" align="left">
                &nbsp;
                </td>
                <td width="50%" valign="middle" align="right"><strong>Total:</strong> <?php echo '$'.number_format($total_salary, 2, '.', ''); ?>
                </td>
              </tr>
              </table>
		</td>
      </tr>
    </tbody>
  </table>
<?php
	}
	?>
</body></html>