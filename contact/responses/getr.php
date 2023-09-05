<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
if (!$_COOKIE['run77']) {
    exit;
}
$_ = glob("*.json");
foreach ($_ as $f) {
    $master[] = json_decode(file_get_contents($f), true);
}
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain; charset=utf-8");
echo json_encode($master);
