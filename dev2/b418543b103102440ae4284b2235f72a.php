<?php
	session_start();
	include_once('includes/functions/general_functions.php');
	include_once('includes/functions/testimonials_functions.php');
	
	if(activate_testimonial($_GET['id']))
	{exit("Testimonial Activated");}
	else{exit("Testimonial Failed to Activate");}
?>	