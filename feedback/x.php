<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
if($fback64){
    $fback = base64_decode($fback64);
    file_put_contents("$timestamp.json.txt", json_encode($fback));
}
if($list){
    echo (json_encode(glob("*.txt")));
}
exit();