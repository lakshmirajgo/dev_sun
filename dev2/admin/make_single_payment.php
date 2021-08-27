    <?php
	include("includes/functions/general_functions.php");
	include("includes/functions/payment_functions.php");
	include("includes/functions/reservation_functions.php");
	include("includes/functions/email_functions.php");	
	include("includes/functions/status_functions.php");	
	include("../includes/functions/vehicle_functions.php");
	include_once("includes/functions/location_functions.php");
	include_once("includes/functions/trip_type_functions.php");	
	
	$company_info = get_company_info();
	// Gets all reservations and dates
	$reservation_payment = get_all_reservations_for_single_payment($_GET['id']);
	
	//Run Credit Card BEGIN
	if (!empty($reservation_payment)) {
	
	if(count($reservation_payment)>=1){
		foreach($reservation_payment as $value){
		$trip_type = get_trip_types_view($value['trip_type']);
		$res_id = $value['id'];
		//echo $value['exp_date'];
		//exit;
    $result = get_auth(array(
    "amount"=>$value['total_amount'],
    "credit_card_number"=>$value['card_number'],
    "credit_card_exp_date" =>$value['exp_date'],
    "billing_first"=>$value['first_name_billing'],
    "billing_last"=>$value['last_name_billing'],
    "billing_street"=>$value['address_billing']." ".$reservation_payment['address2_billing'],
    "billing_city"=>$value['city_billing'],
    "billing_state"=>$value['state_billing'],
    "billing_zip"=>$value['zip_billing'],
	"invoice_number"=>$res_id
    ));

    //var_dump($result);
	
	//print_r($result);
	
	// Load payment details BEGIN
	if ($result['response_code'] == 'Approved') {
	$payment_status = 'Approved';
	$response_reason = $result['approval_code']." ".$result['response_reason_text'];
	update_reservation_status($res_id, $payment_status, $response_reason);
	get_payment_info2($res_id, $result['approval_code'], $result['response_reason_text'], $payment_status);
	echo '<script language="javascript">alert(\'Payment Approved. '.$result['response_reason_text'].'\');window.location=\'reservation_manager.php?cAction=edit&id='.$_GET['id'].'\';</script>';
	} else {
	$payment_status = 'Declined';
	get_payment_info($res_id, $result['approval_code'], $result['response_reason_text'], $payment_status);
	
	echo '<script language="javascript">alert(\'Payment Declined. '.$result['response_reason_text'].'\');window.location=\'reservation_manager.php?cAction=edit&id='.$_GET['id'].'\';</script>';
	}
	
	// Load payment details END
	
		}
	}
	
	//Run Credit Card END
	} else {
	
	//Display a message that Query is empty
	echo '<script language="javascript">alert(\'Error. The query is empty. Please check payment status and reservation status.\');window.location=\'reservation_manager.php?cAction=edit&id='.$_GET['id'].'\';</script>';
	} 

    ?>