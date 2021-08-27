<?
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
	$reservation_payment = get_all_reservations_for_payment();
	
	//print_r($reservation_payment);
	//exit;
?>
<!--

###########################################################
#                                                         #
#  D O C U M E N T A T I O N                              #
#                                                         #
#  This code sample has been successfully tested on       #
#  third-party web servers and performed according to     #
#  documented Advanced Integration Method (AIM)           #
#  standards.                                             #
#                                                         #
#  Last updated September 2004.                           #
#                                                         #
#  For complete and freely available documentation,       #
#  please visit the Authorize.Net web site at:            #
#                                                         #
#  http://www.authorizenet.com/support/guides.php         #
#                                                         #
###########################################################

###########################################################
#                                                         #
#  D I S C L A I M E R                                    #
#                                                         #
#  WARNING: ANY USE BY YOU OF THE SAMPLE CODE PROVIDED    #
#  IS AT YOUR OWN RISK.                                   #
#                                                         #
#  Authorize.Net provides this code "as is" without       #
#  warranty of any kind, either express or implied,       #
#  including but not limited to the implied warranties    #
#  of merchantability and/or fitness for a particular     #
#  purpose.                                               #
#                                                         #
#                                                         #
###########################################################

###########################################################
#                                                         #
#  P H P    D E V E L O P E R S                           #
#                                                         #
#  The provided sample code is merely a blue print,       #
#  demonstrating one possible approach to making AIM      #
#  work, by way of performing the required HTTPS POST     #
#  operation.                                             #
#                                                         #
#  1. This sample code is not a tutorial. If you are      #
#  unfamiliar with specific programming functions and     #
#  concepts, please consult the necessary reference       #
#  materials.                                             #
#                                                         #
#  2. This sample code is provided "as is," meaning that  #
#  we will not be able to assist individual e-commerce    #
#  developers with specific programming issues, relating  #
#  to the availability or non-availability of specific    #
#  modules, code libraries or other requirements to make  #
#  this code work on your specific web server             #
#  configuration.                                         #
#                                                         #
#  3. If you cannot get this sample code to work, please  #
#  do not contact Authorize.Net to complain. However, if  #
#  you encounter specific issues and would like to find   #
#  out what you can do to resolve a specific problem, we  #
#  would be happy to help you find a suitable solution    #
#  if time allows and if resources are available. We do   #
#  not promise, however, that we will be able to solve    #
#  your programming problems nor do we make any           #
#  guarantees or promises -- either express or            #
#  implied -- that we will even attempt to address any    #
#  programming issues that anyone encounters using our    #
#  sample code.                                           #
#                                                         #
#  Again, this sample code merely serves as blue print    #
#  for e-commerce developers who either are inexperienced #
#  performing HTTPS POST operations or simply want an     #
#  example of how other developers have dealt with this   #
#  challenge in the past.                                 #
#                                                         #
#                                                         #
###########################################################

###########################################################
#                                                         #
#  P R E R E Q U I S I T E S                              #
#                                                         #
#  To submit any kind of transaction (even test           #
#  transactions) to Authorize.Net, you need to provide    #
#  valid Authorize.Net account information (a merchant    #
#  log-in ID and a valid merchant transaction key).       #
#                                                         #
#                                                         #
#  Required PHP modules to make HTTPS POST                #
#  operations work:                                       #
#                                                         #
#  CURL                                                   #
#  http://curl.haxx.se/                                   #
#                                                         #
#  The required CURL extension comes with PHP and         #
#  requires no additional cost.                           #
#                                                         #
#  If your web host doesn't have it installed already,    #
#  ask them to either compile PHP with this module        #
#  or have the extension enabled for you.                 #
#                                                         #
#                                                         #
###########################################################

###########################################################
#                                                         #
#  C O N T A C T    I N F O R M A T I O N                 #
#                                                         #
#  For specific questions,                                #
#  please contact Authorize.Net's Integration Services:   #
#                                                         #
#  developer at authorize dot net                         #
#                                                         #
#  Please remember that we cannot support individual      #
#  e-commerce developers with programming problems and    #
#  other issues that could be easily solved by referring  #
#  to the available reference materials.                  #
#                                                         #
###########################################################

###########################################################
#                                                         #
#  A I M   I N   A   N U T S H E L L                      #
#                                                         #
###########################################################
#                                                         #
#  1. You gather all the required transaction data on     #
#  your secure web site.                                  #
#                                                         #
#  2. The transaction data gets submitted (via HTTPS      #
#  POST) to Authorize.Net as one long string, consisting  #
#  of specific name/value pairs.                          #
#                                                         #
#  3. When performing the HTTPS POST operation, you       #
#  remain on the same web page from which you’ve          #
#  performed the operation.                               #
#                                                         #
#  4. Authorize.Net immediately returns a transaction     #
#  response string to the same web page from which you    #
#  have performed the HTTPS POST operation.               #
#                                                         #
#  5. You may then parse the response string and act      #
#  upon certain response criteria, according to your      #
#  business needs.                                        #
#                                                         #
#                                                         #
###########################################################

-->


<html>
<head>
<title>Authorize.Net</title>

<style type="text/css">
<!--

body {background-color: #ffffff; color: #000000;}

body, td, th, h1, h2 {font-family: sans-serif;}

pre {margin: 0px; font-family: monospace;}

a:link {color: #000099; text-decoration: none;}

a:hover {text-decoration: underline;}

table {border-collapse: collapse;}

.center {text-align: center;}

.center table { margin-left: auto; margin-right: auto; text-align: left;}

.center th { text-align: center; !important }

td, th { border: 1px solid #000000; font-size: 75%; vertical-align: baseline;}

h1 {font-size: 150%;}

h2 {font-size: 125%;}

.p {text-align: left;}

.q {background-color: #9999cc; font-weight: normal; color: #ffffff;}

.e {background-color: #ccccff; font-weight: bold;}

.h {background-color: #9999cc; font-weight: bold;}

.v {background-color: #cccccc;}

i {color: #666666;}

img {float: right; border: 0px;}

hr {width: 600px; align: center; background-color: #cccccc; border: 0px; height: 1px;}

//-->
</style>

</head>


<body>

<div class="center">

<table border="0" cellpadding="3" width="600">
	<tr class="h">
		<td>


<b>Authorize.Net<br>
Advanced Implementation Method (AIM)<br>
PHP Example Code</b><br>
<br>
This is just a test to:<br>
1) post an HTTP request to the secure Authorize.Net server<br>
2) process feedback from the secure Authorize.Net transaction DLL<br>
<br>

		</td>
	</tr>
	<tr class="v">
		<td>



<?php
												//Testing info BEGIN
												# Login: cnptest003 

												# Password: Authnet001

												# Login URL: https://test.authorize.net/


$DEBUGGING					= 0;				# Display additional information to track down problems
$TESTING					= 0;				# Set the testing flag so that transactions are not live
$ERROR_RETRIES				= 0;				# Number of transactions to post if soft errors occur

$auth_net_login_id			= "79ShwVg4W"; // Live SunState Login
$auth_net_tran_key			= "9gsn85K3rR255ZJk"; // Live SunState Key

//$auth_net_login_id			= "4y5BfuW7jm"; // Test SunState Login
//$auth_net_tran_key			= "4cAmW927n8uLf5J8"; // Test SunState Key

//$auth_net_url				= "https://test.authorize.net/gateway/transact.dll";
#  Uncomment the line ABOVE for test accounts or BELOW for live merchant accounts
$auth_net_url				= "https://secure.authorize.net/gateway/transact.dll"; // Live

if(count($reservation_payment)>=1){
		foreach($reservation_payment as $value){
		$trip_type = get_trip_types_view($value['trip_type']);
		$res_id = $value['id'];
$authnet_values				= array
(
	"x_invoice_num"         => $value['id'],
	"x_login"				=> $auth_net_login_id,
	"x_version"				=> "3.1",
	"x_delim_char"			=> "|",
	"x_delim_data"			=> "TRUE",
	"x_type"				=> "AUTH_CAPTURE",
	"x_method"				=> "CC",
 	"x_tran_key"			=> $auth_net_tran_key,
 	"x_relay_response"		=> "FALSE",
	"x_card_num"			=> $value['card_number'],
	//"x_card_num"			=> "4242424242424242",
	"x_exp_date"			=> $value['exp_date'],
	"x_description"			=> $trip_type['name'],
	"x_amount"				=> $value['total_amount'],
	"x_first_name"			=> $value['first_name_billing'],
	"x_last_name"			=> $value['last_name_billing'],
	"x_address"				=> $value['address_billing']." ".$reservation_payment['address2_billing'],
	"x_city"				=> $value['city_billing'],
	"x_state"				=> $value['state_billing'],
	"x_zip"					=> $value['zip_billing'],
	"CustomerBirthMonth"	=> "",
	"CustomerBirthDay"		=> "",
	"CustomerBirthYear"		=> "",
	"SpecialCode"			=> "",
	"x_duplicate_window"    => "0",
);

$fields = "";
foreach( $authnet_values as $key => $value ) $fields .= "$key=" . urlencode( $value ) . "&";

echo "<hr>";
///////////////////////////////////////////////////////////

echo "<b>01: Post the transaction (see the code for specific information):</b><br>";


//$ch = curl_init("https://test.authorize.net/gateway/transact.dll"); //Test
###  Uncomment the line ABOVE for test accounts or BELOW for live merchant accounts
$ch = curl_init("https://secure.authorize.net/gateway/transact.dll"); // Live
curl_setopt($ch, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $fields, "& " )); // use HTTP POST to send form data
### curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response. ###
$resp = curl_exec($ch); //execute post and get results
curl_close ($ch);


echo "<hr>";
///////////////////////////////////////////////////////////

echo "<b>02: Get post results:</b><br>";
echo $resp;
echo "<br>";

echo "<hr>";
///////////////////////////////////////////////////////////

echo "03: Parse post results (simple approach)<br>";

$text = $resp;

echo "<table cellpadding=\"5\" cellspacing=\"0\" border=\"1\">";
	echo "<tr>";
		echo "<td class=\"v\">";


$tok = strtok($text,"|");
$count='0';
while(!($tok === FALSE)){
//while ($tok) {
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$tok."<br>";
	//Get Approval Code Value BEGIN
	if ($count == '3') {
	$response_reason = $tok;
	};
	
	if ($count == '4') {
	$approval_code = $tok;
	};
	//Get Approval Code Value END
    $tok = strtok("|");
$count++;
}


		echo "</td>";
	echo "</tr>";
echo "</table>";


echo "<hr>";
///////////////////////////////////////////////////////////

echo "<b>04: Parse the results string into individual, meaningful segments:</b><br>";


echo "<table cellpadding=\"5\" cellspacing=\"0\" border=\"1\">";

///////////////////////////////////////////////////////////
//  STATISTICAL USE ONLY:                                //
///////////////////////////////////////////////////////////

	echo "<tr>";
		echo "<td class=\"q\">";
		echo "Length of the returned string from Authorize.Net:";
		echo "</td>";

		echo "<td class=\"q\">";
		echo strlen($resp);
		echo "</td>";

	echo "</tr>";

$howMany = substr_count($resp, "|");

	echo "<tr>";
		echo "<td class=\"q\">";
		echo "Number of delimiter characters in the returned string:";
		echo "</td>";

		echo "<td class=\"q\">";
		echo $howMany;
		echo "</td>";

	echo "</tr>";
///////////////////////////////////////////////////////////



$text = $resp;
$h = substr_count($text, "|");
$h++;




	for($j=1; $j <= $h; $j++){

	$p = strpos($text, "|");

	if ($p === false) { // note: three equal signs

		echo "<tr>";
		echo "<td class=\"e\">";

			//  x_delim_char is obviously not found in the last go-around

			if($j>=69){

				echo "Merchant-defined (".$j."): ";
				echo ": ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $text;
				echo "<br>";

			} else {

				echo $j;
				echo ": ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $text;
				echo "<br>";

			}


		echo "</td>";
		echo "</tr>";

	}else{

		$p++;

		//  We found the x_delim_char and accounted for it . . . now do something with it

		//  get one portion of the response at a time
		$pstr = substr($text, 0, $p);

		//  this prepares the text and returns one value of the submitted
		//  and processed name/value pairs at a time
		//  for AIM-specific interpretations of the responses
		//  please consult the AIM Guide and look up
		//  the section called Gateway Response API
		$pstr_trimmed = substr($pstr, 0, -1); // removes "|" at the end

		if($pstr_trimmed==""){
			$pstr_trimmed="NO VALUE RETURNED";
		}
		
		//echo $pstr_trimmed;
		//Custom Code BEGIN
					/*
					$status = "";
					if ($pstr_trimmed=="1") {
					
					
					$status = 'Approved';
					
					echo $pstr_trimmed;
					exit;
					//update_reservation_status($res_id, $status, $approval_code);
					
					};
					
					if ($pstr_trimmed =="2" || $pstr_trimmed =="3") {
					$status2 = 'Declined';
					$approval_code .= $approval_code;
					$approval_code .= $response_reason;
					update_reservation_status($res_id, $status2, $approval_code);
					$email_view = get_emails_view('7');
					$reservation_view = get_reservation_view($res_id);	
					$destination_data = get_destination_data($res_id);
					//$message_sunstate = $email_view['email_content'];
					//$message_sunstate_admin .='<strong>Reservation ID:</strong> SUNSTATE-'.$res_id.'<br />Credit card verification error:<br><br>';
					$message_sunstate_admin .='The following reservation id: '.$res_id.' for '.$reservation_view['first_name_billing'].' '.$reservation_view['last_name_billing'].' booked on '.format_to_caldate($reservation_view['reservation_date']).' has been declined or the credit card on file cannot be billed.<br><br>

Authorize.net Gateway Response: '.$approval_code.' '.$response_reason.'<br><br>

The client is scheduled to arrive/depart on '.format_to_caldate($destination_data[0]['date']).'. You may contact the client and get another form of payment or update their credit card information in the admin (<a href="https://www.sunstatelimo.com/admin/reservation_manager.php?cAction=edit&id='.$res_id.'" target="_blank">click here</a>). If the reservation date is today, you must process the credit card manually.<br><br> 

Below are the reservation details:<br>';

					
					$message .='
					Dear, '.$reservation_view['first_name_billing'].' '.$reservation_view['last_name_billing'].',

					Thank you for choosing '.$company_info['company'].'. We are experiencing a problem billing your Visa/Mastercard/Discover card ending in: '.substr($reservation_view['card_number'],12, 4).'. Please contact us as soon as possible to update your credit card to ensure that your reservation is confirmed. You can also update your credit card by logging into your account <a href="https://www.sunstatelimo.com/edit_reservation.php?cAction=edit&id='.$res_id.'" target="_blank">here</a>.  We apologize for any inconvenience and we appreciate your business. <br><br>

Gateway Response: '.$approval_code.' '.$response_reason.'<br><br>

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
					
					//mail($from, "Reservation id #".$res_id." for ".$reservation_view['first_name_billing']." ".$reservation_view['last_name_billing']." Reservation -  ALERT, $message, $headers);

					}
					*/
					//Custom Code END;

		echo "<tr>";
		echo "<td class=\"e\">";

		switch($j){

			case 1:
				echo "Response Code: ";

				echo "</td>";
				echo "<td class=\"v\">";

				$fval="";
				$status = "";
				if($pstr_trimmed=="1"){
					$fval="Approved";
					$status = 'Approved';
					update_reservation_status($res_id, $status, $approval_code);
				}elseif($pstr_trimmed=="2"){
					$fval="Declined";
					// Load payment details BEGIN
					get_payment_info($res_id, $approval_code, $response_reason);
					// Load payment details END
				}elseif($pstr_trimmed=="3"){
				
					$fval="Error";
					// Load payment details BEGIN
					//echo $response_reason;
					
					
					get_payment_info($res_id, $approval_code, $response_reason);
					// Load payment details END
				}
					
					
				echo $fval;
				echo "<br>";
				break;

			case 2:
				echo "Response Subcode: ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 3:
				echo "Response Reason Code: ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 4:
				echo "Response Reason Text: ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 5:
				echo "Approval Code: ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 6:
				echo "AVS Result Code: ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 7:
				echo "Transaction ID: ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 8:
				echo "Invoice Number (x_invoice_num): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 9:
				echo "Description (x_description): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 10:
				echo "Amount (x_amount): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 11:
				echo "Method (x_method): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 12:
				echo "Transaction Type (x_type): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 13:
				echo "Customer ID (x_cust_id): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 14:
				echo "Cardholder First Name (x_first_name): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 15:
				echo "Cardholder Last Name (x_last_name): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 16:
				echo "Company (x_company): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 17:
				echo "Billing Address (x_address): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 18:
				echo "City (x_city): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 19:
				echo "State (x_state): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 20:
				echo "ZIP (x_zip): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 21:
				echo "Country (x_country): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 22:
				echo "Phone (x_phone): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 23:
				echo "Fax (x_fax): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 24:
				echo "E-Mail Address (x_email): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 25:
				echo "Ship to First Name (x_ship_to_first_name): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 26:
				echo "Ship to Last Name (x_ship_to_last_name): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 27:
				echo "Ship to Company (x_ship_to_company): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 28:
				echo "Ship to Address (x_ship_to_address): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 29:
				echo "Ship to City (x_ship_to_city): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 30:
				echo "Ship to State (x_ship_to_state): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 31:
				echo "Ship to ZIP (x_ship_to_zip): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 32:
				echo "Ship to Country (x_ship_to_country): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 33:
				echo "Tax Amount (x_tax): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 34:
				echo "Duty Amount (x_duty): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 35:
				echo "Freight Amount (x_freight): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 36:
				echo "Tax Exempt Flag (x_tax_exempt): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 37:
				echo "PO Number (x_po_num): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 38:
				echo "MD5 Hash: ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			case 39:
				echo "Card Code Response: ";

				echo "</td>";
				echo "<td class=\"v\">";

				$fval="";
				if($pstr_trimmed=="M"){
					$fval="M = Match";
				}elseif($pstr_trimmed=="N"){
					$fval="N = No Match";
				}elseif($pstr_trimmed=="P"){
					$fval="P = Not Processed";
				}elseif($pstr_trimmed=="S"){
					$fval="S = Should have been present";
				}elseif($pstr_trimmed=="U"){
					$fval="U = Issuer unable to process request";
				}else{
					$fval="NO VALUE RETURNED";
				}

				echo $fval;
				echo "<br>";
				break;

			case 40:
			case 41:
			case 42:
			case 43:
			case 44:
			case 45:
			case 46:
			case 47:
			case 48:
			case 49:
			case 50:
			case 51:
			case 52:
			case 53:
			case 54:
			case 55:
			case 55:
			case 56:
			case 57:
			case 58:
			case 59:
			case 60:
			case 61:
			case 62:
			case 63:
			case 64:
			case 65:
			case 66:
			case 67:
			case 68:
				echo "Reserved (".$j."): ";

				echo "</td>";
				echo "<td class=\"v\">";

				echo $pstr_trimmed;
				echo "<br>";
				break;

			default:

				if($j>=69){

					echo "Merchant-defined (".$j."): ";
					echo ": ";

					echo "</td>";
					echo "<td class=\"v\">";

					echo $pstr_trimmed;
					echo "<br>";

				} else {

					echo $j;
					echo ": ";

					echo "</td>";
					echo "<td class=\"v\">";

					echo $pstr_trimmed;
					echo "<br>";

				}

				break;

		}

		echo "</td>";
		echo "</tr>";

		// remove the part that we identified and work with the rest of the string
		$text = substr($text, $p);

	}

}

echo "</table>";

echo "<br>";




echo "<hr>";
///////////////////////////////////////////////////////////


echo "<b>04: Done.</b><br>";
	}
}
?>


		</td>
	</tr>
</table>
<?php 
//print_r($message_sunstate_admin);

//print_r($message);
?>
</div>

</body></html>