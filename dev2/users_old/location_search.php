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
	include("includes/functions/zone_functions.php");	

	if ($_POST['action'] == 'create_new') {
		if (add_locations())
				echo '<script language="javascript">alert(\'Location created successfully\');window.location=\'location_manager.php\';</script>';
		else
			echo '<script language="javascript">alert(\'Error creating location\');</script>';	
	}
	
	if ($_GET['cAction'] == 'edit'){
		$location_view = get_locations_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			if (edit_locations($_GET['id']))
			echo '<script language="javascript">alert(\'Location updated successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error updating location\');</script>';
			
			$location_view = get_locations_view($_GET['id']);
		}
	}
	
	if (!empty($_POST['delete_selected'])){
	if (delete_locations($_POST['id']))
	echo '<script language="javascript">alert(\'Location(s) Deleted Successfully\');window.location=\'location_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the location(s)\n\nPlease try again\');window.location=\'location_manager.php\';</script>';
		
	$all_locations = get_all_locations();

	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_locations($delete_id))
		echo '<script language="javascript">alert(\'Location Deleted Successfully\');window.location=\'location_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the location\n\nPlease try again\');window.location=\'location_manager.php\';</script>';
		$all_locations = get_all_locations();
		
	}
    $all_locations = get_all_locations();
	$zone_view = get_zones_view($location_view['zone_id']);
	include ("includes/common/header.php");	
 	include ("includes/common/menu.php");	
	$all_zones = get_all_zones();
	
	// Show all locations
	if (empty($_GET['cAction']) || $_GET['cAction'] == 'delete') {

	get_search_locations_with_pages();
	}
	?>
<?php
unset ($_SESSION['redirect']);
include ("includes/common/footer.php");
?>