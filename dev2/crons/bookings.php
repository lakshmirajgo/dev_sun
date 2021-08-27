<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('config.php');

$link = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}


$db_selected = mysql_select_db(DB_DATABASE, $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}

$today = date('Y-m-d', strtotime('-1 day'));
$sql = "SELECT * FROM `reservation_details` WHERE `pickup_date` > '$today' and (time <= '06:00:00' and time >= '00:00:00') order by pickup_date asc";

$result = mysql_query($sql);

if (!$result) {
    die('Invalid query: ' . mysql_error());
}

$num_rows = mysql_num_rows($result);

$to = "martin@imperialwebsolutions.net";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$data = '';

if($num_rows > 0)
{
    $header  = date('m/d/Y'). ' -- (Sunstate Limo) Midnight bookings.';
    $subject = date('m/d/Y') . " -- (Sunstate Limo) Midnight bookings Detected";

    while ($row = mysql_fetch_object($result)) {

        $data .= '<p>ID:' . $row->id . '<br />Reservation ID: ' .$row->reservation_id.'<br />Date: ' . date('m/d/Y', strtotime($row->date)).'<br />Time: '.$row->time.'<br />Added by Admin:' . $row->added_by_admin . '</p>';
        
    }
    
    $message = "
    <html>
    <head>
    <title></title>
    </head>
    <body>
    <h4>".$header."</h4>
    <pre>".$data."</pre>
    </body>
    </html>
    ";

    mail($to,$subject,$message,$headers);
    
}
else
{
    $header  = date('m/d/Y'). ' -- (Sunstate Limo) No midnight bookings detected.';
    $subject = date('m/d/Y') . " -- (Sunstate Limo) NO Midnight bookings Detected";
    
    $message = "
    <html>
    <head>
    <title></title>
    </head>
    <body>
    <h4>".$header."</h4>
    </body>
    </html>
    ";

    mail($to,$subject,$message,$headers);
}

mysql_close($link);
