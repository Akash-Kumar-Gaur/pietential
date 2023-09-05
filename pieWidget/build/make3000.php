<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
if( !$_COOKIE['mule77']){
    exit;
} else {
    setcookie('mule77', "shuihdvc898", time() + 7776000, "/"); //90 days
}

//http://192.168.0.121:8937/pie2/pieWidget/build/make3000.php?wipe=5

if ($wipe) {
    foreach (glob("../../pielet/ids/*.json.txt") as $_) {
        $x = file_get_contents($_);
        if (preg_match('/rr3\.com/', $x)){
             unlink($_);
        }
       
    }
    exit();
}

//http://192.168.0.121:8937/pie2/pieWidget/build/make3000.php?make=300

if ($make) {
    while ($i < $make) {
        if ($i > 10000) {
            break;
        }
        $userID = getrandom(12);
        $master['userID'] = $userID;
        $master['email'] = getrandom(8) . "@rr3.com";
        $master['hash'] = getrandom(26);
        $master['salt'] = getrandom(24);
        file_put_contents("../../pielet/ids/$userID.json.txt", json_encode($master));
        echo "creating $userID<br>";
        $i++;
    }
}


function getrandom($n)
{
    $g = str_split("abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ");
    $v = 0;
    $r = "";
    while ($v < $n) {
        shuffle($g);
        $r .= $g[0];
        $v++;
    }
    return ($r);
}

exit;
