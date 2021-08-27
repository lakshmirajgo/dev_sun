<?php  
session_start();

if (!isset($_SESSION['auth_user'])) {
$_SESSION['redirect'] = $_SERVER['HTTP_REFERER'];
header ("Location: http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']). "/login.php");
// Quit the script
exit(); 
}
//header("Location: http://sunstlim:adam1106@www.sunstatelimo.com:2082/awstats.pl?config=sunstatelimo.com&ssl=&lang=en");
header("Location: http://sunstlim:adam1106@sunstatelimo.com:2082/awstats.pl?config=sunstatelimo.com&ssl=&lang=en");
?> 