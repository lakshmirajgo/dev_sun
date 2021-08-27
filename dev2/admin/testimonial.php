<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = 'reservation_manager.php?cAction=edit&id='.$_GET['id'].'';
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
	include("includes/functions/general_functions.php");
	include("includes/functions/reservation_functions.php");
	include("includes/functions/client_functions.php");
	include("includes/functions/vehicle_functions.php");
	include_once("includes/functions/location_functions.php");
	include_once("includes/functions/trip_type_functions.php");		
	include("includes/functions/status_functions.php");	
	
//Check permissions for User BEGIN

if ($_GET['search_by'] =='shadesofgreen') {
$page_name_val = 'shades_of_green';
} else {
$page_name_val = 'reservations';
}

if (!chech_permissions($_SESSION['user_details'], $page_name_val)) {
//header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/index.php");
echo '<script language="javascript">alert(\'You dont have a permissions access to this page!\');window.location=\'index.php\';</script>';
// Quit the script
exit(); 
}
?>