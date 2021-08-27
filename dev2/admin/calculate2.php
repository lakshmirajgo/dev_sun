<?
	include("includes/functions/general_functions.php");
	include("includes/functions/price_functions.php");
	include("includes/functions/location_functions.php");		
//print_r($_GET['trip_type']);

	
	
	if ($_GET['trip_type'] > 2) {
	$calculate_total = get_prices_view($_GET['vehicle_id'], $_GET['trip_type']);
	if (empty($calculate_total['price_value'])) {
	echo "N/A";
	} else {
	print_r($calculate_total['price_value']);
	}
	} else {
	if ($_GET['from'] =='1a' || $_GET['from'] =='2a') {
	$zone_from = get_airports_view($_GET['from']);
	$zone_from = $zone_from['zone_id'];
	} else {
	$zone_from = get_locations_view($_GET['from']);
	$zone_from = $zone_from['zone_id'];
	}
	if ($_GET['to'] =='1a' || $_GET['to'] =='2a') {
	$zone_to = get_airports_view($_GET['to']);
	$zone_to = $zone_to['zone_id'];
	} else {
	$zone_to = get_locations_view($_GET['to']);
	$zone_to = $zone_to['zone_id'];
	}
	
	$calculate_total = get_prices_view_local($_GET['vehicle_id'], $_GET['trip_type'], $zone_from, $zone_to);
	if (empty($calculate_total['price_value'])) {
	echo "N/A";
	} else {
	print_r($calculate_total['price_value']);
	}
	};
?>
