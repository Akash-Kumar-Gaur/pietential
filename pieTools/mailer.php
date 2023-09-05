<?php
extract($_GET);
extract($_POST);
error_reporting(E_ALL);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
if(!$mailID){
    exit;
}

// https://pietential.com/pieTools/mailer.php?mailID=Test-of-piebot-mailer



$message = "admin account requested: https://pietential.com/editR96.php?dir=./pieTools/ $mailID";
$subject = "admin account requested";
$toemail = "pieadmin@silvercrayon.com";
$sendername = "piebot";
$senderemail = "piebot@mg.silvercrayon.us";
//file_put_contents("emails.txt","$audioID $emails");
echo sendMlor($subject, $message, $sendername, $toemail, $senderemail);


function sendMlor($subject, $message, $sendername, $toemail, $senderemail)
{
    if ($message == strip_tags($message)) {
        $message = str_replace("\r\n", "\n", $message);
        $message = str_replace("\n", "<br>\r\n", $message);
    }
    $url = 'http://mg.silvercrayon.us/mlor/';
    $data['subject'] = $subject;
    $data['message'] = $message;
    $data['sendername'] = $sendername;
    $data['toemail'] = $toemail;
    $data['senderemail'] = $senderemail;
    $options['http']['header'] = "Content-type: application/x-www-form-urlencoded\r\n";
    $options['http']['method'] = "POST";
    $options['http']['content'] = http_build_query($data);
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    header('Content-Type: image/gif');
echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
}



