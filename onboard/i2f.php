<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
if($onboard){
    if (!preg_match('/^\[/', $onboard)){
        exit('Wrong format');
    }
    if (!$_COOKIE['email']){
        exit;
    }
    $tempArray = json_decode($onboard, true);
    if (count($tempArray)<2){
        exit;
    }
    $filename = "$email-$timestamp.json";
    file_put_contents($filename, $onboard);
    echo $filename;
}
