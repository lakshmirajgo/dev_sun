<?
	include("includes/functions/general_functions.php");
	include("includes/functions/price_functions.php");
	include("includes/functions/location_functions.php");		
//print_r($_POST['trip_type']);

	
	
	if ($_POST['trip_type'] > 2) {
	$calculate_total = get_prices_view($_POST['vehicle_id'], $_POST['trip_type']);
	if (empty($calculate_total['price_value'])) {
	echo "Rate not found";
	} else {
	print_r($calculate_total['price_value']);
	}
	} else {
	if ($_POST['from'] =='1a' || $_POST['from'] =='2a') {
	$zone_from = get_airports_view($_POST['from']);
	$zone_from = $zone_from['zone_id'];
	} else {
	$zone_from = get_locations_view($_POST['from']);
	$zone_from = $zone_from['zone_id'];
	}
	if ($_POST['to'] =='1a' || $_POST['to'] =='2a') {
	$zone_to = get_airports_view($_POST['to']);
	$zone_to = $zone_to['zone_id'];
	} else {
	$zone_to = get_locations_view($_POST['to']);
	$zone_to = $zone_to['zone_id'];
	}
	
	$calculate_total = get_prices_view_local($_POST['vehicle_id'], $_POST['trip_type'], $zone_from, $zone_to);
	if (empty($calculate_total['price_value'])) {
	echo "Rate not found";
	} else {
	print_r($calculate_total['price_value']);
	}
	};
?>
