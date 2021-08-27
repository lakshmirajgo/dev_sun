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
		if ($_POST['vehicle_id']!='3') {
		print_r($calculate_total['price_value']);
		} else {
		print_r($calculate_total['price_value']*1.2);
		}
	}
	} else {
	$zone_from = get_locations_view($_POST['from1']);
	$zone_from = $zone_from['zone_id'];
	
	$zone_to = get_locations_view($_POST['to1']);
	$zone_to = $zone_to['zone_id'];
	
	$calculate_total = get_prices_view_local($_POST['vehicle_id'], $_POST['trip_type'], $zone_from, $zone_to);
	if (empty($calculate_total['price_value'])) {
	//If zone rate is not found then try SOG prices
	$calculate_total_sog = get_prices_sog_view($_POST['vehicle_id'], $_POST['from1'], $_POST['to1']);
	
		if (empty($calculate_total_sog)) {
		echo "Rate not found";
		} else {
			//One Way BEGIN
			if ($_POST['trip_type'] =='1') {
				if ($calculate_total_sog['oneway_price'] !='0') {
					if ($_POST['vehicle_id']!='3') {
						print_r($calculate_total_sog['oneway_price']);
					} else {
						print_r($calculate_total_sog['oneway_price']*1.2);
					}	
				} else {
				$calculate_total_sog = $calculate_total_sog['roundtrip_price']/2;
					if ($_POST['vehicle_id']!='3') {
						print_r($calculate_total_sog);
					} else {
						print_r($calculate_total_sog*1.2);
					}
				}
			}
			
			//Round Trip BEGIN
			if ($_POST['trip_type'] =='2') {
				if ($calculate_total_sog['roundtrip_price'] !='0') {
					if ($_POST['vehicle_id']!='3') {
						print_r($calculate_total_sog['roundtrip_price']);
					} else {
						print_r($calculate_total_sog['roundtrip_price']*1.2);
					}
				} else {
				$calculate_total_sog = $calculate_total_sog['oneway_price']*2;
					if ($_POST['vehicle_id']!='3') {
						print_r($calculate_total_sog);
					} else {
						print_r($calculate_total_sog*1.2);
					}
				}
			}
		
		}
	} else {
		if ($_POST['vehicle_id']!='3') {
			print_r($calculate_total['price_value']);
		} else {
			print_r($calculate_total['price_value']*1.2);
		}
	}
	};
?>
