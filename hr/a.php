<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');



if ($getData){
    $_ = glob("logs/*.txt");
    foreach($_ as $f){
        $g = json_decode(file_get_contents($f), true);
        $master[] = $g;
    }
    exit(json_encode($master));
}



$r = $_SERVER['REMOTE_ADDR'];
echo $r;


if ($data && $r!=="192.168.0.121"){
    $master['data'] = $data;
    $master['ip'] = $r;
    $master['timestamp'] = $timestamp;
    file_put_contents("logs/$timestamp.txt", json_encode($master));
}