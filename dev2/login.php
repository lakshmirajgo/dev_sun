<?php
	session_start();	
		include("includes/functions/general_functions.php");

	if(isset($_POST['email']) && isset($_POST['password'])){
		if(login($_POST['email'], $_POST['password']) || master_login($_POST['email'], $_POST['password'])){
			$_SESSION['auth'] = true;
			$_SESSION['email'] = $_POST['email'];
			if (!empty($_GET['redirect'])) {
				header("Location: my_account.php?redirect=".$_GET['redirect']."");
				exit;
			} 
			else {
				header("Location: my_account.php");
				exit;
			}
		}
		else{
			unset($_SESSION['auth']);
			$_SESSION['notice'] = '<div style="background-color:#fce3e3; padding:5px; border:#FF0000 solid 1px; width:580px;" align="center"><span style="color:#FF0000;">Invalid username or password.</span></div>';
			if (!empty($_GET['redirect'])) {
			echo '<script language="javascript">alert(\'Invalid username or password.\');window.location=\'returning_client.php?redirect='.$_GET['redirect'].'\';</script>';
			} else {
			echo '<script language="javascript">alert(\'Invalid username or password.\');window.location=\'returning_client.php\';</script>';
			};
		}
	}
	else {
		header("Location: returning_client.php");
		exit;
	}
?>