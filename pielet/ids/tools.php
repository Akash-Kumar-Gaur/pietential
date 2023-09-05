<?php

// foreach (glob("*.json.txt") as $f){
//     $master = json_decode(file_get_contents($f), true);
//     echo $master['partnerID'];
//     echo "<br>";
// }

$d = "Zachary.Zackary@pietential.com
akrebssmith@gmail.com
cf3mail@gmail.com
cochlear1@naver.com
craig@salesrockit.com
dalem@peponline.org
dereks@peabodypress.com
ingram_brooke@yahoo.com
mrdent@me.com
raheimmyers@icloud.com
ron@bvcvalue.com
sadiehope10@gmail.com
strtmcconnell@gmail.com";

$f = explode("\n", $d);
$m = file_get_contents("http://pietential.com/pielet/ids/all.json");

 
$master = json_decode(file_get_contents("http://pietential.com/pielet/ids/all.json"), true);
foreach ($master as $key => $value){
    echo $value['userID'];
    $uid = $value['userID'];
    $em = $value['email'];
    foreach ($f as $a){
        $a = trim($a);
        if ($em == $a){
            $value['partnerID'] = "johnstarling";
            echo " jstar - $em ";
            
        } else {
            
        }
    }
    $all[] = $value;
    echo "<br>";
}

file_put_contents("all.json", json_encode($all));
exit;



foreach ($master as $f) {
    $master = json_decode(file_get_contents($f), true);
    if (preg_match('/pietential\.com/', $f['email'])) {
        $f['partnerID'] = "DEMO";
        $fn = $f['userID'];
        file_put_contents("$fn.json.txt", json_encode($f));
    }
    echo $f['userID'] . " partnerID:" . $f['partnerID'];
    echo "<br>";
}
