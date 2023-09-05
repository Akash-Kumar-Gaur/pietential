<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');

if($email){
    $_ = file_get_contents("emails.txt");
    $_ .="\n$email";
    file_put_contents("emails.txt", $_);
}
if($list){
    echo (json_encode(glob("*.txt")));
}
exit();