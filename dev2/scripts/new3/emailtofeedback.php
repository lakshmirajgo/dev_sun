<?php
session_start();
include("includes/functions/general_functions.php");
	if(isset($_POST) && (!empty($_POST['Name'])) && (!empty($_POST['Email']))){
		foreach($_POST as $key=>$value){
			if(strtolower($value) !="submit" ){
			if(strtolower($key) !="sendto" ){
				//echo $key . ": \t" . $value . "<br />";
				if($key !='Email')
				$message .= ucfirst(str_replace("_", " ",$key)) . ": " . $value . "<br />\n";
			}
			}
		}
	
	//Add a salutation an intro to the email
	$message = "You have received a new feedback from submitted on your website: ". $_SERVER['HTTP_HOST']." Below are the contents of the form submitted.<br /><br /> \n\n" . $message;
	
	// Send Email with content to info@ the domain name. This script should work for any site. 
	$from = $_POST['Email'];
	$from = trim(str_replace(" ", "", $from));
	//This is a modification to make windows forms work
	ini_set("sendmail_from", $from);

	//ATTENTION: Please set the to email address that the content of this form will be sent to
	//Uncomment the below if you have created a hidden value named sendto in the form. Otherwise set the to email address manually by changing the $to variable
	//$to = $_POST['sendto'];
	
	//$to = $company_info['email'];
	//$to = "alexey@imperialwebsolutions.net";
	$to = "andy@sunstatelimo.com";
	$to = trim(str_replace(" ", "", $to));
	
	
	$headers = 'From: '. $from . "\r\n" .
    'Reply-To: '. $from . "\r\n" .
	"MIME-Version: 1.0\r\n" .
	"Content-type: text/html; charset=iso-8859-1\r\n".
    'X-Mailer: PHP/' . phpversion();
	
	// Send the Message
	//function format mail("to", "subject", "message");
	mail($to, "Web Site Feedback (SunStateLimo.com)", $message, $headers);
	
	//Display thank you message. 
	echo "<script language=\"javascript\">alert('Thank you. Form submitted successfully. \\n\\n'); window.location='http://".$_SERVER['HTTP_HOST']."';</script>";

	}
	else{
		if(!empty($_SERVER['HTTP_REFERER']))
			echo "<script language=\"javascript\">alert('Please complete all fields. \\n\\n'); window.location='".$_SERVER['HTTP_REFERER']."';</script>";
			//header("Location: ".$_SERVER['HTTP_REFERER']);
		else
			header("Location: http://". $_SERVER['HTTP_HOST']);		

	}
?>