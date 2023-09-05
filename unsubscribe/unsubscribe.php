<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
if($sekritKey){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    exit (file_get_contents("unsubscribe.json"));
}
if(!$unsubscribeEmail){
    exit ("<script>location.assign(`./?message=nodata`)</script>");
}
if(!preg_match('/\@/ism', $unsubscribeEmail)){
    exit('error2');
}
if(strlen($unsubscribeEmail)>250){
    exit('error3');
}
if($unsubscribeEmail){
    if(!$reason){
        $reason = 'no reason given';
    }
    $unsubscribeEmail = trim($unsubscribeEmail);
    $unsubscribeEmail = strtolower($unsubscribeEmail);
    $a = json_decode(file_get_contents("unsubscribe.json"), true);
    $request['timestamp'] = $timestamp;
    $request['email'] = $unsubscribeEmail;
    $request['reason'] = $reason;
    $request['otherText'] = $otherText;
    $a[] = $request;
    file_put_contents("unsubscribe.json", json_encode($a));
    echo "<script>location.assign(`./?message=success`)</script>";
} else {
    exit('error4');
}