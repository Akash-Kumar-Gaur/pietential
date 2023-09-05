<?php
if ($_GET['pic']) {
    extract($_GET);
    extract($_POST);
    $j = file_get_contents("../ids/make-all.php");
    header('Content-Type: image/gif');
    echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
    exit; //https://pietential.com/pielet/admin/getusers.php?pic=1

}
if (!$_COOKIE['adminID']){
    exit;
}
extract($_GET);
extract($_POST);
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain; charset=utf-8");
if (!$_COOKIE['adminRG']){
    //$adminCode == "demo";
    // setcookie('adminRG', $adminID, time() + 7776000, "/"); //90 days
    // document.cookie = "adminRG=1234; expires=31 Dec 2030 12:00:00 UTC;";
}
if ($adminCode){
    $r = file_get_contents('https://pietential.com/pielet/admin/buildPromoCodeBase.php');
    $r = json_decode($r, true);
    //print_r($r);
    foreach($r as $k => $v){
        if (strtoupper($adminCode) == strtoupper($v['promoCode'])){
            $g['fname'] = $v['fname'];
            $g['lname'] = $v['lname'];
            $g['userID'] = $v['userID'];
            $g['email'] = $v['email'];
            $g['promoCode'] = $v['promoCode'];
            $w[] = $g;
        }
    }
    exit(json_encode($w));
}

if (!$adminCode) {
    $adminCode = "DEMO";
}

if ($adminCode == "demo") {
    $adminCode = "DEMO";
}

if ($user) {
    if (!file_exists("../ids/$user.json.txt")) {
        exit("[]");
    }
    $rawData = file_get_contents("../ids/$user.json.txt");
    exit($rawData);
}
$j = file_get_contents("../ids/all.json");
///pie2/pielet/ids/all.json
// https://pietential.com/pielet/ids/all.json
$a = json_decode($j, true);
$master = $a['users'];


// get an array of the admins company codes
foreach ($a['admins'] as $key => $value) {
    if (strtoupper($value['adminID'])  == strtoupper($adminCode)) {
        $complist = $value['companyList'];
    }
}
// build a pattern to match the codes
foreach ($complist as $key => $value) {
    $reggie .= $value['companyCode'] . "|";
}
$reggie = rtrim( $reggie, "|");
if ($test) {
    // fowler id x9d6hp3tRwGW
    echo $reggie;
    echo "\n\n";
    print_r($complist);
    exit();
}




foreach ($master as $key => $value) {
    // matching promocode to list of codes in the admins ID

if ($value['partnerID']=="johnstarling"){
    $value['promoCode'] = "STARLING12345";
}



    if ($value['promoCode'] && preg_match('/'.$reggie.'/', $value['promoCode'])) {
        
        $promoCode = $value['promoCode'];
        $uid = $value['userID'];
        $partnerID =  $value['partnerID'];
        $joinDate = $value['joinDate'];
        $email = $value['email'];
        $company = $value['company'];
        if (!$company) {
            $company = substr($promoCode, 0, strlen($promoCode) - 5);
        }
        if (!$joinDate) {
            $joinDate = $value['timestamp'];
        }
        if (!$joinDate) {
            $joinDate = '2022';
        }
        // build a simplified record of the user 
        $arr[] = "$joinDate;$uid;$email;$partnerID;$company";
    }
}
if ($arr) {
    rsort($arr);
} else {
    exit("[]");
}

foreach ($arr as $_) {
    $g = explode(";", $_);
    // send a simplified record of the user as JSON
    $m2[] = $g;
}


exit(json_encode($m2));



foreach ($arr as $_) {
    $g = explode(";", $_);
    $uid = $g[1];
    $joinDate = $g[0];
    $email = $g[2];
    $rawData = file_get_contents("../ids/$uid.json.txt");
    $rawDataDisplay = print_r(json_decode($rawData, true), true);
}
