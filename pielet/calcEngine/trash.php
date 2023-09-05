<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain; charset=utf-8");
$thirds = json_decode(file_get_contents("third-bifuracte.json"), true);
$master['name'] = "hank";
$master['phone'] = "1234-6676";
print_r($master);

echo "\n\n";

$scoreArr["SA"]=50;
$scoreArr["EC"]=70;
$scoreArr["LB"]=23;
$scoreArr["SN"]=90;
$scoreArr["PN"]=93;

function returnThirdResponse($scoreArr, $thirds, $master){
    foreach($scoreArr as $k => $v){
        $varname = $k . "response";
        if ($v<100){
            $ssr = $k."3";
            $master[$varname] = $thirds[$ssr];
        }
        if ($v<66){
            $ssr = $k."2";
            $master[$varname] = $thirds[$ssr];
        }
        if ($v<34){
            $ssr = $k."1";
            $master[$varname] = $thirds[$ssr];
        }
    }
    return ($master);
}
$applyThirds = 1;
if ($applyThirds){
    $master = returnThirdResponse($scoreArr, $thirds, $master);
}


print_r($master);