<?php
	session_start();
	//desctop all sessions and redirect to the home page
	session_destroy();
	header("Location: index.php");
?>