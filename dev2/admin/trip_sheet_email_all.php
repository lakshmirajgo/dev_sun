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
		
include ("includes/common/header.php");
include ("includes/common/menu.php");

$all_drivers = get_all_drivers();

?>

<form method="get" action="trip_sheet_email.php" target="_blank">
  <input type="hidden" value="get_trip_sheet" name="cAction">
  <table border="0" cellpadding="5" cellspacing="0" width="1172" class="ot" style="border:#000000 solid 1px; background-repeat:repeat-x;" background="images/bodyBG.jpg" bgcolor="#FFFFFF">
    <tbody>
      <tr>
        <td align="center" valign="middle" width="100%">
          <table border="0" cellpadding="3" cellspacing="0" width="100%">
            <tbody>
              <tr>
                <td width="76%" height="20" align="center" valign="top">
                  Select Drivers:
                  <select name="multi_drivers_id[]" multiple="multiple" id="multi_drivers_id">
                    <?php 
						foreach ($all_drivers as $driver) {
							print '<option value="' . $driver["id"] . '">';
							print ucfirst($driver["first_name"]) . ' ' . ucfirst($driver["last_name"]);
							print '</option>';
						}
					?>
                  </select>
                  <button id="selectAllDrivers" onclick="selectAll('multi_drivers_id',true); return false;">Select All</button>
                  <button id="selectNoDrivers" onclick="selectAll('multi_drivers_id',false); return false;">Select None</button>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  From
                  <input name="from" type="text" id="from" size="8" maxlength="10" value="<?php print date("m/d/Y", strtotime('+1 day')); ?>">
                  <img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('from');" />
                  <i> <font color="#ff0000" size="1"> select date</font></i>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  To
                  <input name="to" type="text" id="to" size="8" maxlength="10" value="<?php print date("m/d/Y", strtotime('+1 day')); ?>">
                  <img src="img/cal.gif" width="16" height="16" onclick="displayDatePicker('to');" />
                  <i> <font color="#ff0000" size="1"> select date</font></i>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input name="get_trip_sheet" type="submit" value="Get Trip Sheet">
                </td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</form>
<script>
// ref: http://www.qodo.co.uk/blog/javascript-select-all-options-for-a-select-box/
function selectAll(selectBox,selectAll) { 
    // have we been passed an ID 
    if (typeof selectBox == "string") { 
        selectBox = document.getElementById(selectBox);
    } 
    // is the select box a multiple select box? 
    if (selectBox.type == "select-multiple") { 
        for (var i = 0; i < selectBox.options.length; i++) { 
             selectBox.options[i].selected = selectAll; 
        } 
    }
}
</script>
<?php include ("includes/common/footer.php"); ?>