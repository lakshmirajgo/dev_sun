<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
	include("includes/functions/general_functions.php");
	include("includes/functions/reservation_functions.php");
	include("includes/functions/vehicle_functions.php");
	include_once("includes/functions/location_functions.php");
	include_once("includes/functions/trip_type_functions.php");	
	include("includes/functions/status_functions.php");			

	if ($_POST['action'] == 'create_new') {
		if(add_reservations())
		echo '<script language="javascript">alert(\'Reservation created successfully\');window.location=\'reservation_manager.php\';</script>';
		else
			echo '<script language="javascript">alert(\'Error creating reservation\');</script>';
	}
	
	if ($_GET['cAction'] == 'status_update') {
		update_status($_GET['status'], $_GET['id']);
		header ("Location: reservation_manager.php");	
	}
	
	if ($_GET['cAction'] == 'edit'){
		$reservation_view = get_reservation_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			if (edit_reservations($_GET['id']))
			echo '<script language="javascript">alert(\'Reservation updated successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error updating reservation\');</script>';
			
			$reservation_view = get_reservation_view($_GET['id']);
		}
	}
	
	if (!empty($_POST['delete_selected'])){
	if (delete_reservations($_POST['id']))
	echo '<script language="javascript">alert(\'Reservation(s) Deleted Successfully\');window.location=\'reservation_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the reservation(s)\n\nPlease try again\');window.location=\'reservation_manager.php\';</script>';
		
	$all_reservations = get_all_reservations();

	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_reservations($delete_id))
		echo '<script language="javascript">alert(\'Reservation Deleted Successfully\');window.location=\'reservation_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the reservation\n\nPlease try again\');window.location=\'reservation_manager.php\';</script>';
		$all_reservations = get_all_reservations();
		
	}
	$all_vehicles = get_all_vehicles();
    $all_reservations = get_all_reservations();
	include ("includes/common/header.php");	
 	include ("includes/common/menu.php");	
	// Show all Reservations
	if (empty($_GET['cAction']) || $_GET['cAction'] == 'delete') {

	get_search_reservations_with_pages();
	
	}
	?>
<?php
include ("includes/common/footer.php");
?>