<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York'); 
$timestamp = date('Y-m-d--') . date('H-i-s');
function val() {
    $a = [1,2,3,4,5,6,7,8,9];
    shuffle($a);
    $val = $a[0];
    return ($val);
}
$i=0;
while($i<33){
    $h = "Q".$i."response";
    $t[$h]= val();
    $i++;
}

$t[userID] = "Bs6duHDeVveP";
$t[email] = "uityiuyt@ytyttrytr.com";
$t[hash] = "434ca95e99ac921c0247ea51bc832768d913b39ac67125158b135e9e61e53e78d00aafbd9a0a2921faaa098861cac6ee248edfa14fa4f645da5b1669aea0c316";
$t[salt] = "EDJYqHCJyExO0HzEC577DAgTDYTT4!^3TC3U4!KT@T4*#e%eeb05Oe61EKq8J!R8x";
$t[Part1Completed] = 100;
$t[Part2Completed] = 100;
$t[Part3Completed] = 100;
$t[Part4Completed] = 100;
$t[Part5Completed] = 100;
$q = base64_encode(json_encode($t));

echo json_encode($t);
echo "<img src='https://pietential.com/pielet/?pieletData=$q'>";
echo $q;
exit;




exit;

// cloudburst@silvercrayon.com
// ak1a*wt%vbnX

// https://pietential.com/pielet/save-snapshot.php?email=uityiuyt@ytyttrytr.com&userID=Bs6duHDeVveP&snapshot=eyJRMHJlc3BvbnNlIjo0LCJRMXJlc3BvbnNlIjo1LCJRMnJlc3BvbnNlIjo2LCJRM3Jlc3BvbnNlIjo1LCJRNHJlc3BvbnNlIjo1LCJRNXJlc3BvbnNlIjo2LCJRNnJlc3BvbnNlIjo2LCJRN3Jlc3BvbnNlIjo1LCJROHJlc3BvbnNlIjo2LCJROXJlc3BvbnNlIjo2LCJRMTByZXNwb25zZSI6NywiUTExcmVzcG9uc2UiOjcsIlExMnJlc3BvbnNlIjo3LCJRMTNyZXNwb25zZSI6NywiUTE0cmVzcG9uc2UiOjYsIlExNXJlc3BvbnNlIjo2LCJRMTZyZXNwb25zZSI6NywiUTE3cmVzcG9uc2UiOjcsIlExOHJlc3BvbnNlIjo3LCJRMTlyZXNwb25zZSI6NiwiUTIwcmVzcG9uc2UiOjcsIlEyMXJlc3BvbnNlIjo3LCJRMjJyZXNwb25zZSI6NiwiUTIzcmVzcG9uc2UiOjcsIlEyNHJlc3BvbnNlIjo2LCJRMjVyZXNwb25zZSI6NywiUTI2cmVzcG9uc2UiOjYsIlEyN3Jlc3BvbnNlIjo3LCJRMjhyZXNwb25zZSI6NiwiUTI5cmVzcG9uc2UiOjR9

//https://pietential.com/pielet/?account=jstar
if ($email && $userID && $snapshot) {
    $master = json_decode(file_get_contents("$userID.json.txt"), true);
    foreach($master as $key => $value){
        if (preg_match('/^Q|completed|currentpart/i',$key)){
            unset($master[$key]);
        }
    }
    $tdata = json_decode(base64_decode($snapshot), true);
    $tdata[time] = $timestamp;
    if ($tdata) {
        $master['snapshots'][] = $tdata;
        file_put_contents("$userID.json.txt", json_encode($master));
        file_put_contents("$userID.snapshot.txt", $snapshot);
        file_put_contents("$userID.snapshotJSON.txt", base64_decode($snapshot));
        echo json_encode($master);
    }
}
if ($email && $userID && $state) {
    $master = json_decode(file_get_contents("$userID.json.txt"), true);
    foreach($master as $key => $value){
        if (preg_match('/^Q|completed|currentpart/i',$key)){
            unset($master[$key]);
        }
    }
    $tdata = json_decode(base64_decode($state));
    if ($tdata) {
        foreach($tdata as $key=>$value){
            $master[$key] = $value;
        }
        file_put_contents("$userID.json.txt", json_encode($master));
    }
}
