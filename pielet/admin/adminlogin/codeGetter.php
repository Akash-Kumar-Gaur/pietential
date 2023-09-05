<?php
$adminhash = '';
extract($_GET);
extract($_POST);
//error_reporting(E_ALL);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');


if ($uniqueCodes && $name){
    file_put_contents("../codex/$name.codes.json.txt", $uniqueCodes);
}


