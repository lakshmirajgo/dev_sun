<?php
	session_start();
	include_once('includes/functions/general_functions.php');
	include_once('includes/functions/testimonials_functions.php');
	$company_info = get_company_info(); 

// this function checks for our  honey pot captcha which is an input field but kept in a hidden element
// and has empty value. typical bots will disable javascript that hides the element and fills out the form
// for more information http://haacked.com/archive/2007/09/11/honeypot-captcha.aspx
function is_valid_form() {
	if (empty($_POST)) {
		return false;
	}
	
	if ( ! isset($_POST['imperial_web_solutions'])) {
		//$errMsg = "CAPTCHA was not detected!";
		return false;
	}
	elseif ( ! empty($_POST['imperial_web_solutions'])) {
		//$errMsg = "CAPTCHA is invalid! Please leave the last input field blank.";
		return false;
	}
	else {
		unset($_POST['imperial_web_solutions']);
	}
	// clean post vars
	foreach($_POST as $key => $value) { $_POST[$key] = trim($value); }


	if ( ! isset($_POST['name'])) {
		return false;
	}
	if (empty($_POST['email_address'])) {
		return false;
	}
	if ( ! isset($_POST['testimonial'])) {
		return false;
	}
	// return validated
	return true;
} // end function

	if(is_valid_form())
	{
		if($_POST['action']=='submit')
		{
			unset($_POST['action']);
			unset($_POST['submit']);
			if($id=add_testimony($_POST))
			{	
				$message = "You have received a new testimony form submitted on your website: ". $_SERVER['HTTP_HOST']." Below are the contents of the form submitted.<br /><br />";
				foreach($_POST as $key=>$value)
				{
					if(strtolower($value) !="submit" )
					{
						if(strtolower($key) !="sendto" )
						{
							//echo $key . ": \t" . $value . "<br />";
							$message .= "<strong>".ucfirst(str_replace("_", " ",$key)) . ":</strong> " . $value . "<br />\n";
						}
					}
				}
				$message.='<a href="http://www.sunstatelimo.com/b418543b103102440ae4284b2235f72a.php?id='.$id.'">Click Here to approve this testimonial</a>';
				
				$from = 'testimonials@sunstatelimo.com <'.$_POST['name'].'>';
				ini_set("sendmail_from", $from);
				//$to = $company_info['email'];
				$to = 'andy@sunstatelimo.com';
//				$to = 'achinn@imperialwebsolutions.net';
				//$to = 'karl@imperialwebsolutions.net';
				$headers = 'From: '. $from . "\r\n" .
				    'Reply-To: '. $from . "\r\n" .
					"MIME-Version: 1.0\r\n" .
					"Content-type: text/html; charset=iso-8859-1\r\n".
				    'X-Mailer: PHP/' . phpversion();
				mail($to, "Web Site Testimony (SunStateLimo.com)", $message, $headers);
				?>
					<script type="text/javascript" language="javascript">
						alert('Your Feedback has been added, Thank you!');
						window.location.href='http://<?php echo $_SERVER['HTTP_HOST'];?>';
					</script>
				<?php
			}
			else
			{
				?>
					<script type="text/javascript" language="javascript">
						alert('Your Feedback could not saved. Please Try Again');
						window.location.href='<?php echo $_SERVER['HTTP_REFERER'];?>';
					</script>
				<?php
			}	
		}
	}
	?>
	<script type="text/javascript" language="javascript">
		window.location.href='<?php echo $_SERVER['HTTP_REFERER'];?>';
	</script>