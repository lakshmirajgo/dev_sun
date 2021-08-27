<?php
function get_auth($data_array) {

    if(empty($data_array['amount']) || !is_numeric($data_array['amount'])) {
    $error->insert("Please provide a valid amount for credit card processing.");
    }

    if(empty($data_array['credit_card_number'])) {
    die("Please provide a valid Credit Card Number.");
    }

    if(empty($data_array['credit_card_exp_date'])) {
    die("Please provide a valid Credit Card Expiration Date.");
    }

   // if(empty($data_array['credit_card_cvv'])) {
    //die("Please provide a valid Credit Card CVV Code.");
    //}

    if(empty($data_array['billing_first'])) {
    die("Please provide the Billing First Name.");
    }

    if(empty($data_array['billing_last'])) {
    die("Please provide the Billing Last Name.");
    }

    if(empty($data_array['billing_city'])) {
    die("Please provide the Billing City.");
    }

    if(empty($data_array['billing_state'])) {
    die("Please provide the Billing State.");
    }

    // set default api credentials
    //$auth_net_login_id			= "4y5BfuW7jm"; // Test SunState Login
	//$auth_net_tran_key			= "4cAmW927n8uLf5J8"; // Test SunState Key
	$auth_net_login_id			= "79ShwVg4W"; // Live SunState Login
	$auth_net_tran_key			= "9gsn85K3rR255ZJk"; // Live SunState Key
	
	$gateway_status 			= "live";
    // Display additional information to track down problems
    $DEBUGGING = 0;

    // Set the testing flag so that transactions are not live
    $TESTING = 0;

    // Number of transactions to post if soft errors occur
    $ERROR_RETRIES = 1;

    if($gateway_status == "testing") {
    $auth_net_url = "https://test.authorize.net/gateway/transact.dll";
    } else if($gateway_status == "live") {
    $auth_net_url = "https://secure.authorize.net/gateway/transact.dll";
    } else {
    die("Undefined Gateway Status. Unable to process trasactions. Contact the system Administrator.");
    }

    $invoice_number = $order_details->cart_id + $invoice_start;

  	$authnet_values				= array
    (

    "x_login" => $auth_net_login_id,
    "x_version" => "3.1",
    "x_delim_char" => "|",
    "x_delim_data" => "TRUE",
    "x_duplicate_window" => "30",
    "x_url" => "FALSE",
    "x_type" => "AUTH_CAPTURE",
    "x_method" => "CC",
    "x_tran_key" => $auth_net_tran_key,
    "x_relay_response" => "FALSE",
    "x_card_num" => $data_array['credit_card_number'],
    "x_exp_date" => $data_array['credit_card_exp_date'],
    "x_description" => $auth_net_description,
    "x_first_name" => $data_array['billing_first'],
    "x_last_name" => $data_array['billing_last'],
    "x_address" => $data_array['billing_street'],
    "x_city" => $data_array['billing_city'],
    "x_state" => $data_array['billing_state'],
    "x_zip" => $data_array['billing_zip'],
    "x_amount" => $data_array['amount'],
    "x_invoice_num" => $data_array['invoice_number']
    );

    $line_item_num = 0;
	
	// set for live mode, you will have to adjust this if processing test transactions
    $ch = curl_init("https://secure.authorize.net/gateway/transact.dll");
	//$ch = curl_init("https://test.authorize.net/gateway/transact.dll"); //Test

    // convert authnet_values to fields in post list
	
    $fields = "";
	foreach( $authnet_values as $key => $value ) $fields .= "$key=" . urlencode( $value ) . "&";
	
    // post payment to Authorize.NET
    curl_setopt($ch, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $fields, "& " )); // use HTTP POST to send form data
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response. ###
    $resp = curl_exec($ch); //execute post and get results
    curl_close ($ch);

    $response_array = explode("|", $resp);

    switch($response_array['0']){
    case "1":
    $response['response_code']="Approved";
    break;
    case "2":
    $response['response_code']="Declined";
    break;
    case "3":
    $response['response_code']="Error";
    break;
    }

    $response['response_subcode'] = $response_array['1'];
    $response['response_reason_code'] = $response_array['2'];
    $response['response_reason_text'] = $response_array['3'];
    $response['approval_code'] = $response_array['4'];
    $response['avs_result_code'] = $response_array['5'];
    $response['transaction_id'] = $response_array['6'];

    if($response['response_code'] != "Approved") {
    //die($response['response_code'].": ".$response['response_reason_text']);
    
	return $response;
	}

    // will only return response if the transaction was approved
    return $response;
    } // end of function

function get_payment_info($res_id, $approval_code, $response_reason, $payment_status){
$company_info = get_company_info();

					$response_reason = $approval_code." ".$response_reason;
					update_reservation_status($res_id, $payment_status, $response_reason);
					$email_view = get_emails_view('7');
					$reservation_view = get_reservation_view($res_id);	
					$destination_data = get_destination_data($res_id);
					//$message_sunstate = $email_view['email_content'];
					//$message_sunstate_admin .='<strong>Reservation ID:</strong> SUNSTATE-'.$res_id.'<br />Credit card verification error:<br><br>';
					$message_sunstate_admin .='The following reservation id: '.$res_id.' for '.$reservation_view['first_name_billing'].' '.$reservation_view['last_name_billing'].' booked on '.format_to_caldate($reservation_view['reservation_date']).' has been declined or the credit card on file cannot be billed.<br><br>

Authorize.net Gateway Response: '.$response_reason.'<br><br>

The client is scheduled to arrive/depart on '.format_to_caldate($destination_data[0]['date']).'. You may contact the client and get another form of payment or update their credit card information in the admin (<a href="https://www.sunstatelimo.com/admin/reservation_manager.php?cAction=edit&id='.$res_id.'" target="_blank">click here</a>). If the reservation date is today, you must process the credit card manually.<br><br> An email has been sent to the client requesting them to contact Sunstate ASAP. A link to update their credit card was also included in the client email. 

Below are the reservation details:<br>';

					
					$message .='
					Dear, '.$reservation_view['first_name_billing'].' '.$reservation_view['last_name_billing'].',

					Thank you for choosing '.$company_info['company'].'. We are experiencing a problem billing your Visa/Mastercard/Discover card ending in: '.substr($reservation_view['card_number'],12, 4).'. Please contact us as soon as possible to update your credit card to ensure that your reservation is confirmed. You can also update your credit card by logging into your account <a href="https://www.sunstatelimo.com/edit_reservation.php?cAction=edit&id='.$res_id.'" target="_blank">here</a>.  We apologize for any inconvenience and we appreciate your business. <br><br>

Gateway Response: '.$response_reason.'<br><br>

Please call: 407-601-7900<br><br>

<em>Sincerely<br>
Andy Negede,<br>
Sunstate Transportation</em><br><br>
Below are your reservation details.<br>';


$email_view = get_emails_view('1');

$vehicle = get_vehicles_view($reservation_view['vehicle_id']);
$trip_type = get_trip_types_view($reservation_view['trip_type']);

					$message_sunstate .='<br><br>
Reservation ID: SUNSTATE-'.$reservation_view['id'].'<br />
Date Submitted: '.format_to_caldate($reservation_view['reservation_date']).'<br />
Total Amount: $'.sprintf("%01.2f", $reservation_view['total_amount']).'<br />
Name: '.$reservation_view['first_name'].' '.$reservation_view['last_name'].'<br />
Phone Number: '.$reservation_view['phone_number'].'<br />
Mobile Phone: '.$reservation_view['cellphone'].'<br />';
			  if ($reservation_view['paying_cash'] == 'Yes') {
			  $message_sunstate .='
			  Paying Cash or Traveler check: '.$reservation_view['paying_cash'].'<br />';
			  }
			  
			  $message_sunstate .='
          Vehicle: '.$vehicle['name'].'<br />
		  Passengers: '.$reservation_view['passenger_count'].'<br />';
              
			  if (!empty($reservation_view['child_carseat'])) { 
			  
			  $message_sunstate .='
              Child Car Seat: '.$reservation_view['child_carseat'].'<br />';
              }
			  
			  if (!empty($reservation_view['booster_seat'])) { 
			  
			  $message_sunstate .='
              Child Booster Seat: '.$reservation_view['booster_seat'].'<br />';
              }
			  $trip_type = get_trip_types_view($reservation_view['trip_type']);
			
			  if ($reservation_view['store_stop'] =='Yes') {
			 $message_sunstate .='
			 Quick Grocery Stop: '.$reservation_view['store_stop'].'<br />';
			  }
			  $message_sunstate .='
			  Trip Type: '.$trip_type['name'].'<br/>';
			  
			  $reservation_details = get_all_reservation_details($res_id);
			  
			  $num_legs = count($reservation_details);
		  	  for ($count =0; $count <= $num_legs - 1; $count += 1) {
		  	  //print_r($reservation_details[$count]['from']);
			  $from[$count] = get_locations_view($reservation_details[$count]['from']);
		  	  $to[$count] = get_locations_view($reservation_details[$count]['to']);
			  
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { ?><?php if (check_arrival($reservation_details[$count]['from'])) { $message_sunstate .="Arrival: "; } else { $message_sunstate .="Departure: "; }; } 
			  $message_sunstate .='(From: '.$from[$count]['name'].' To: '.$to[$count]['name'].')<br>
			  Transfer Date: '.format_to_caldate($reservation_details[$count]['date']).'<br>';
			  
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['from'])) {
              if (check_arrival($reservation_details[$count]['from'])) { $message_sunstate .="Arriving: "; } else { $message_sunstate .="Departing: "; };
			  $message_sunstate .='
                Airline: '.$reservation_details[$count]['airline'].'<br>
				Flight Number: '.$reservation_details[$count]['flight_number'].'<br>';
              } 
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { 
			  
			  if (check_arrival($reservation_details[$count]['from'])) { 
			  $message_sunstate .='Arrival '; 
			  } else { $message_sunstate .='Departure '; 
			  }; 
			  } else { $message_sunstate .='Pickup '; };
			  
			  $message_sunstate .='
			   at: '.format_time($reservation_details[$count]['time']).'<br>';
               }
	$message_sunstate .='
	Customer Comments: '.$reservation_view['customer_comments'];
			
			
			$message .= $message_sunstate;
			$message_sunstate_admin .= $message_sunstate;	
					
					$from = $company_info['email'];
					$from = trim(str_replace(" ", "", $from));
					//This is a modification to make windows forms work
					ini_set("sendmail_from", $from);
	
					$to = $reservation_view['email'];
	
					$headers = 'From: '. $from . "\r\n" .
    				'Reply-To: '. $from . "\r\n" .
					"MIME-Version: 1.0\r\n" .
					"Content-type: text/html; charset=iso-8859-1\r\n".
    				'X-Mailer: PHP/' . phpversion();
					
					
					//mail($to, "Sunstate Transportation Reservation id #".$res_id." ALERT", $message, $headers);

					$headers = 'From: '. $to . "\r\n" .
    				'Reply-To: '. $to . "\r\n" .
					"MIME-Version: 1.0\r\n" .
					"Content-type: text/html; charset=iso-8859-1\r\n".
    				'X-Mailer: PHP/' . phpversion();
					
					mail($from, "Reservation id #".$res_id." for ".$reservation_view['first_name_billing']." ".$reservation_view['last_name_billing']." Reservation -  ALERT", $message_sunstate_admin, $headers);

}



function get_payment_info2($res_id, $approval_code, $response_reason, $payment_status){
$company_info = get_company_info();

					$response_reason = $approval_code." ".$response_reason;
					//update_reservation_status($res_id, $payment_status, $response_reason);
					$reservation_view = get_reservation_view($res_id);	
					$destination_data = get_destination_data($res_id);
					//$message_sunstate = $email_view['email_content'];
					//$message_sunstate_admin .='<strong>Reservation ID:</strong> SUNSTATE-'.$res_id.'<br />Credit card verification error:<br><br>';
					$message_sunstate_admin .='The following reservation id: '.$res_id.' for '.$reservation_view['first_name_billing'].' '.$reservation_view['last_name_billing'].' booked on '.format_to_caldate($reservation_view['reservation_date']).' has been approved.<br><br>

Authorize.net Gateway Response: '.$response_reason.'<br><br>

The client is scheduled to arrive/depart on '.format_to_caldate($destination_data[0]['date']).'. 

Below are the reservation details:<br>';

$vehicle = get_vehicles_view($reservation_view['vehicle_id']);
$trip_type = get_trip_types_view($reservation_view['trip_type']);

					$message_sunstate .='<br><br>
Reservation ID: SUNSTATE-'.$reservation_view['id'].'<br />
Date Submitted: '.format_to_caldate($reservation_view['reservation_date']).'<br />
Total Amount: $'.sprintf("%01.2f", $reservation_view['total_amount']).'<br />
Credit card ending in: '.substr($reservation_view['card_number'],12, 4).'<br />
Name: '.$reservation_view['first_name'].' '.$reservation_view['last_name'].'<br />
Phone Number: '.$reservation_view['phone_number'].'<br />
Mobile Phone: '.$reservation_view['cellphone'].'<br />';
			  if ($reservation_view['paying_cash'] == 'Yes') {
			  $message_sunstate .='
			  Paying Cash or Traveler check: '.$reservation_view['paying_cash'].'<br />';
			  }
			  
			  $message_sunstate .='
          Vehicle: '.$vehicle['name'].'<br />
		  Passengers: '.$reservation_view['passenger_count'].'<br />';
              
			  if (!empty($reservation_view['child_carseat'])) { 
			  
			  $message_sunstate .='
              Child Car Seat: '.$reservation_view['child_carseat'].'<br />';
              }
			  
			  if (!empty($reservation_view['booster_seat'])) { 
			  
			  $message_sunstate .='
              Child Booster Seat: '.$reservation_view['booster_seat'].'<br />';
              }
			  $trip_type = get_trip_types_view($reservation_view['trip_type']);
			
			  if ($reservation_view['store_stop'] =='Yes') {
			 $message_sunstate .='
			 Quick Grocery Stop: '.$reservation_view['store_stop'].'<br />';
			  }
			  $message_sunstate .='
			  Trip Type: '.$trip_type['name'].'<br/>';
			  
			  $reservation_details = get_all_reservation_details($res_id);
			  
			  $num_legs = count($reservation_details);
		  	  for ($count =0; $count <= $num_legs - 1; $count += 1) {
		  	  //print_r($reservation_details[$count]['from']);
			  $from[$count] = get_locations_view($reservation_details[$count]['from']);
		  	  $to[$count] = get_locations_view($reservation_details[$count]['to']);
			  
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { ?><?php if (check_arrival($reservation_details[$count]['from'])) { $message_sunstate .="Arrival: "; } else { $message_sunstate .="Departure: "; }; } 
			  $message_sunstate .='(From: '.$from[$count]['name'].' To: '.$to[$count]['name'].')<br>
			  Transfer Date: '.format_to_caldate($reservation_details[$count]['date']).'<br>';
			  
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['from'])) {
              if (check_arrival($reservation_details[$count]['from'])) { $message_sunstate .="Arriving: "; } else { $message_sunstate .="Departing: "; };
			  $message_sunstate .='
                Airline: '.$reservation_details[$count]['airline'].'<br>
				Flight Number: '.$reservation_details[$count]['flight_number'].'<br>';
              } 
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { 
			  
			  if (check_arrival($reservation_details[$count]['from'])) { 
			  $message_sunstate .='Arrival '; 
			  } else { $message_sunstate .='Departure '; 
			  }; 
			  } else { $message_sunstate .='Pickup '; };
			  
			  $message_sunstate .='
			   at: '.format_time($reservation_details[$count]['time']).'<br>';
               }
	$message_sunstate .='
	Customer Comments: '.$reservation_view['customer_comments'];
			
			
			$message .= $message_sunstate;
			$message_sunstate_admin .= $message_sunstate;	
					
					$from = $company_info['email'];
					$from = trim(str_replace(" ", "", $from));
					//This is a modification to make windows forms work
					ini_set("sendmail_from", $from);
	
					$to = $reservation_view['email'];
	
					$headers = 'From: '. $from . "\r\n" .
    				'Reply-To: '. $from . "\r\n" .
					"MIME-Version: 1.0\r\n" .
					"Content-type: text/html; charset=iso-8859-1\r\n".
    				'X-Mailer: PHP/' . phpversion();
					
					
					//mail($to, "Sunstate Transportation Reservation id #".$res_id." ALERT", $message, $headers);

					$headers = 'From: '. $to . "\r\n" .
    				'Reply-To: '. $to . "\r\n" .
					"MIME-Version: 1.0\r\n" .
					"Content-type: text/html; charset=iso-8859-1\r\n".
    				'X-Mailer: PHP/' . phpversion();
					
					mail($from, "Reservation id #".$res_id." for ".$reservation_view['first_name_billing']." ".$reservation_view['last_name_billing']." Payment - APPROVED", $message_sunstate_admin, $headers);

}

?>