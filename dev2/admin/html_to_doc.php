<?php
	include("html_to_doc.inc.php");
	
	$htmltodoc= new HTML_TO_DOC();
	
	$trip_sheet_name = 'trip_sheets/trip_sheet_'.$_GET['name'].'';
	$url_name = 'http://www.sunstatelimo.com/admin/trip_sheet_print.php?cAction=get_trip_sheet&drivers_id='.$_GET['drivers_id'].'&from='.$_GET['from'].'&to='.$_GET['to'];
	$htmltodoc->createDocFromURL($url_name, $trip_sheet_name);
	header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/trip_sheets/trip_sheet_".$_GET['name'].".doc");
	

?>
