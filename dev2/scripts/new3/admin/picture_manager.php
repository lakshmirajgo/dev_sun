<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
include("includes/functions/general_functions.php");
include("includes/functions/vehicle_functions.php");
	
	if (!empty($_GET['delete'])){
	$delete_id[]=$_GET['id'];
	if(delete_images($delete_id, $_GET['image_name']))
		echo '<script language="javascript">alert(\'Picture Deleted Successfully\');window.location=\'vehicle_manager.php?cAction=edit&id='.$_GET['id'].'\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the image\n\nPlease try again\');window.location=\'vehicle_manager.php?cAction=edit&id='.$_GET['id'].'\';</script>';
		
	}
?>