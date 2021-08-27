<?php
include("includes/functions/email_functions.php");
$email_view = get_emails_view('1');
$message_sunstate_admin .='The following reservation was placed online:';
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
			  //Special prices for Shades of Green Round trip BEGIN
			  if ($_SESSION['trip_type_new'] == '2') {
			  $trip_type['name'] = 'Round trip: '.$trip_type['name'];
			  };
			  //Special prices for Shades of Green Round trip END
			
			  if ($reservation_view['store_stop'] =='Yes') {
			 $message_sunstate .='
			 Quick Grocery Stop: '.$reservation_view['store_stop'].'<br />';
			  }
			  $message_sunstate .='
			  Trip Type: '.$trip_type['name'].'<br/>';
			  
			  $reservation_details = get_all_reservation_details($reservation_view['id']);
			  
			  $num_legs = count($reservation_details);
		  	  for ($count =0; $count <= $num_legs - 1; $count += 1) {
		  	  //print_r($reservation_details[$count]['from']);
			  $from[$count] = get_locations_view($reservation_details[$count]['from']);
		  	  $to[$count] = get_locations_view($reservation_details[$count]['to']);
			  
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['to'])) { ?><?php if (check_arrival($reservation_details[$count]['from'])) { $message_sunstate .= "Arrival: "; } else { $message_sunstate .= "Departure: "; }; } 
			  $message_sunstate .='(From: '.$from[$count]['name'].' To: '.$to[$count]['name'].')<br>
			  Transfer Date: '.format_to_caldate($reservation_details[$count]['date']).'<br>';
			  
			  if(check_departure($reservation_details[$count]['from']) || check_arrival($reservation_details[$count]['from']) || check_departure($reservation_details[$count]['to']) || check_arrival($reservation_details[$count]['from'])) {
              if (check_arrival($reservation_details[$count]['from'])) { $message_sunstate .= "Arriving: "; } else { $message_sunstate .= "Departing: "; };
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
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sun State Transportation - Reservation Information</title>
<link href="http://sunstatelimo.com/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div style="margin: 20px;">
<div align="left"><img src="http://sunstatelimo.com/images/sunstate.gif" alt="Sunstate"></div>
<br><br>
Dear <?php print $reservation_view['first_name']; ?>:
<br><br>
Thank you for choosing Sunstate Transportation. This confirms that we have received your transportation request. Your confirmation number is SUNSTATE-<?php print $reservation_view['id']; ?>.
<br><br>

<?php print $email_view['email_content']; ?>

<?php print $email_view['email_content2']; ?>

Again, we thank you for your business and look forward to seeing you on <?php print format_to_caldate($reservation_details[0]['pickup_date']); ?> at <?php print format_time($reservation_details[0]['pickup_time']); ?> in Orlando, Florida!!
<br><br>
We look forward to providing you with excellent service.
<br>
<em>Sincerely,</em><br><strong>Sun State Transportations</strong>
<br><br>
Your transportation information appears below:
<br>
Please review this information below and let us know if there are any changes or issues.
<br><br>
You can view your reservation online 24 hours a day. <a href="http://sunstatelimo.com/my_account.php">http://sunstatelimo.com/my_account.php</a>

<?php print $message_sunstate; ?>
</div>
</body>
</html>