<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');

if ($email) {
    $email = strtolower(trim($email));
    $_ = file_get_contents("../pielet/ids/all.json");
    $ua = json_decode($_, true);
    $users = $ua['users'];
    $i = 0;
    foreach ($users as $v) {
        $i++;
        if ($v['email'] == $email) {
            if ($v['hash']){
                exit("hash");
            }
            //echo (json_encode($v));
            $j['salt'] = getTempPassword();
            $j['userID'] = $v['tempUserID'];
            $j['email'] = $v['email'];
            $j['promoCode'] = $v['promoCode'];
            $j['fname'] = $v['fname'];
            $j['lname'] = $v['lname'];
        }
    }
}

function getTempPassword(){
    $r = explode(',',"1,2,3,4,5,6,7,8,9,0,Q,W,E,r,T,Y,t,I,O,P,L,k,J,H,G,F,d,S,A,Z,X,C,V,B,N,M");
    shuffle($r);
    $out = '';
    $i = 0;
    while($i<32){
        shuffle($r);
        $out.=$r[0];
        $i++;
    }
    return $out;
}

if ($j){
    echo json_encode($j);
} else {
    echo "0";
}
