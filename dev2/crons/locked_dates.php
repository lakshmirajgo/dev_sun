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

$today = date('Y-m-d');
$sql = "SELECT * FROM `locked_dates` order by from_date asc";

$result = mysql_query($sql);

if (!$result) {
    die('Invalid query: ' . mysql_error());
}

$num_rows = mysql_num_rows($result);

$to = "martin@imperialwebsolutions.net";
$subject = date('m/d/Y') . " -- (Sunstate Limo) Locked Dates";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$data = '';


if($num_rows > 0)
{
    $header  = date('m/d/Y'). ' -- (Sunstate Limo) Current Locked-Out Dates.<br />';
    
    
    while ($row = mysql_fetch_object($result)) {
    
        $row->from_date = date('m/d/Y h:i:s A', strtotime($row->from_date));
        $row->to_date = date('m/d/Y h:i:s A', strtotime($row->to_date));

        $data .= '<p>ID:' . $row->id . '<br />From date: ' .$row->from_date.'<br />To date: ' .$row->to_date.'</p>';
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
    $header  = date('m/d/Y'). ' -- (Sunstate Limo) No Locked-Out Dates detected.';
    
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
