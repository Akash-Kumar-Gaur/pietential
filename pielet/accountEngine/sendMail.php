<?php
extract($_GET);
extract($_POST);
error_reporting(E_ALL);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
// https://pietential.com/pielet/accountEngine/sendMail.php?userID=zGX676w1F2ry&email=john@starlinggrowthadvisory.com&userEmail=Kyle.Romeo@pietential.com

// https://pietential.com/pielet/accountEngine/sendMail.php?userID=zGX676w1F2ry&email=pielet@silvercrayon.com&userEmail=Kyle.Romeo@pietential.com


if(!$userID){
    exit;
}
if(!$email){
    exit;
}
if(!$userEmail){
    exit;
}
$emails = json_decode(file_get_contents("emails.txt"), true);
$emails[] = "$userEmail;$timestamp";
file_put_contents("emails.txt", json_encode($emails));

$message = "Pietential low score alert: https://pietential.com/pielet/admin/?userID=$userID";
$subject = "Pietential low score alert - $userEmail";
$toemail = $email;
$sendername = "PieletRobot";
$senderemail = "PieletRobot@mg.silvercrayon.us";
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
