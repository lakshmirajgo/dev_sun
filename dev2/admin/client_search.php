<?php
session_start();

if (!isset($_SESSION['auth_admin'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
	include("includes/functions/general_functions.php");
	include("includes/functions/client_functions.php");	

//Check permissions for User BEGIN
if (!chech_permissions($_SESSION['user_details'], 'clients')) {
//header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/index.php");
echo '<script language="javascript">alert(\'You dont have a permissions access to this page!\');window.location=\'index.php\';</script>';
// Quit the script
exit(); 
}
//Check permissions for User END

	if ($_POST['action'] == 'create_new') {
		if($_POST['password_new'] != $_POST['password_confirm']){
			$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px;"><span style="color:#FF0000;">Sorry the password entered does not match. Try again</span></div>';
		}
		else{	
		if (add_clients())
				echo '<script language="javascript">alert(\'Client created successfully\');window.location=\'client_manager.php\';</script>';
				
		else
			echo '<script language="javascript">alert(\'Error creating client\');</script>';	
		}
	}
	
	if ($_GET['cAction'] == 'edit'){
		$client_view = get_client_view($_GET['id']);
		
		if ($_POST['action'] == 'edit') {
			if (edit_clients($_GET['id']))
			echo '<script language="javascript">alert(\'Client updated successfully\');</script>';
		else
			echo '<script language="javascript">alert(\'Error updating client\');</script>';
			
			$client_view = get_client_view($_GET['id']);
		}
	}
	
	if (!empty($_POST['delete_selected'])){
	if (delete_clients($_POST['id']))
	echo '<script language="javascript">alert(\'Client(s) Deleted Successfully\');window.location=\'client_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the client(s)\n\nPlease try again\');window.location=\'client_manager.php\';</script>';
		
	$all_clients = get_all_clients();

	}
	
	if ($_GET['cAction'] == 'delete'){
	$delete_id[]=$_GET['id'];
	if(delete_clients($delete_id))
		echo '<script language="javascript">alert(\'Client Deleted Successfully\');window.location=\'client_manager.php\';</script>';
	else
		echo '<script language="javascript">alert(\'There was an error deleting the client\n\nPlease try again\');window.location=\'client_manager.php\';</script>';
		$all_clients = get_all_clients();
		
	}
	
	if ($_POST['action2'] == 'update_password') {
		if(md5($_POST['password_old']) != $client_view['password']){
			$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px;"><span style="color:#FF0000;">Sorry the old password entered does not match. Try again</span></div>';
		
		} else {
		if($_POST['password_new'] != $_POST['password_confirm']){
			$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px;"><span style="color:#FF0000;">Sorry the new password entered does not match. Try again</span></div>';
		}
		else{	
			update_client_password($client_view['username'], $_POST['password_old'], $_POST['password_new'], $_GET['id']);
			$_SESSION['notice'] = '<div style="background-color:#d1fac3; padding:5px; border:#72da4e solid 1px;">Your account password update request has processed successfully.</div>';
		}
		}
		
	}
	
	
    $all_clients = get_all_clients();
	include ("includes/common/header.php");	
	
	echo $_SESSION['notice'];
 	include ("includes/common/menu.php");	
	// Show all clients
	if (empty($_GET['cAction']) || $_GET['cAction'] == 'delete') {

	get_search_clients_with_pages();
	
	}
	?>
<?php
unset ($_SESSION['notice']);
unset ($_SESSION['redirect']);
include ("includes/common/footer.php");
?>