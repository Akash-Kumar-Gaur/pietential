<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');


if($mappy){
    file_put_contents("../map.txt",$mappy);
    exit("Map written!");
}

if($ab){
    file_put_contents("ab.txt",$_GET['ab']);
}
if($clientName){
    $json = json_encode($_POST);
    file_put_contents("$clientName.txt",$json);
    $_ = file_get_contents("https://pietential.com/pieTools/mailer.php?mailID=$clientName");
}



