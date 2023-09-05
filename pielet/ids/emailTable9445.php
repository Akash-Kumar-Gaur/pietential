<?php
extract($_GET);
extract($_POST);
//error_reporting(E_ALL);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
$_ = glob("./*.json.txt");

if ($fix){
    foreach ($_ as $e) {
        $userinfo = json_decode(file_get_contents($e), true);
        if ($userinfo['prcoded']){
            echo "$e has prcoded<br>";
            $userinfo['prcoded'] = "";
            file_put_contents($e, json_encode($userinfo));
        } 
    }
    exit;
}
$w = [];
$admins = glob("../admin/adminlogin/ids/*.json.txt");
foreach ($admins as $x){
    $adminName = str_replace(".json.txt", "", $x);
    $admininfo = json_decode(file_get_contents($x), true);
    $w[] = $admininfo;
}
$data = [];
$data['admins'] = $w;
foreach ($_ as $e) {
    $userinfo = json_decode(file_get_contents($e), true);
    $userinfo['prcoded'] = "";
    $users[]=$userinfo;
    $all .= "\n\n##^^FILENAME-$e^^##\n\n";
    $all .= file_get_contents($e);
}  

foreach ($users as $k => $v) {
    $uid = $v['userID'];
    $email = $v['email'];
    if ($email){
    $emailTable[$email] = $uid;
    }
}
$data['users'] = $users;

$cdx = glob("../admin/codex/*.json.txt");
$w = [];
foreach ($cdx as $x){
    $r = json_decode(file_get_contents($x), true);
    $w[] = $r;
}
// removed 3/24 file_put_contents("../admin/codex/all.json", json_encode($w));
//fetch("//pietential.com/pielet/ids/emailTable9445.php")

file_put_contents("all.txt", $all);
file_put_contents("all.json", json_encode($data));
file_put_contents("emailTable.json.txt", json_encode($emailTable));

header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain; charset=utf-8");
echo json_encode($emailTable);

exit;
