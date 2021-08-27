<?php
session_start();
include("includes/functions/general_functions.php");
include("includes/functions/drivers_functions.php");

submit_driver($_GET['resDetailsId'], $_GET['resId'], $_GET['driversId'], $_GET['notifyDriver']); ?>
<html>
<head> 
<script type="text/javascript">
setTimeout("window.close();",2000);
</script>
<style type="text/css">
#success{
	text-align:center;
	font-size:16px;
	color:#CC0000;
	font-weight:bold;
	font-style:italic;
}
</style>
<body>
<br/>
<br/>
<div id="success">Driver Assigned Successfully!</div>
</body>
</html>