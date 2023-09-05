<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain; charset=utf-8");
$j = file_get_contents("../ids/all.json");
$a = json_decode($j, true);
$master = $a['users'];
foreach($master as $k => $v){
    if ($v['promoCode'] || $v['companyCode'] ){
        if ($v['promoCode'] !== "organic"){
            $n['fname'] = $v['fname'];
            $n['lname'] = $v['lname'];
            $n['userID'] = $v['userID'];
            $n['promoCode'] = $v['promoCode'];
            $n['email'] = $v['email'];
            $f[] = $v;
            $p[] = $n;
        }
    }
}
//echo "<pre>";
// foreach($f as $k => $v){
//     ////echo $v['promoCode']."\n";
// }
//print_r($f);
$mk = json_encode($f);
file_put_contents("usersWithCodes.json.txt", $mk);
echo json_encode($p);
exit;