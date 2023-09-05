<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');


$arr = glob("../pielet/ids/*json.txt");
$i = 1;
foreach ($arr as $_) {
    $e = file_get_contents($_);
    if (preg_match('/tempUserID/', $e)) {
        $master = json_decode($e, true);
        $master['promoCode'] = $master['companycode'];
        $master['partnerID'] = $master['companycode'];
        $master['company'] = $master['companycode'];
        $master['companyCode'] = $master['companycode'];
        $master['userID'] = $master['tempUserID']; //  partnerID company
        $master['userLevel'] = 'pro';
        $master['saveMethod'] = "Converted from tempUserID; $timestamp";
        file_put_contents($_, json_encode($master));
        $tuid = $master['tempUserID'];
        echo "$i - $tuid<br>\n";
        $i++;
    }
}
