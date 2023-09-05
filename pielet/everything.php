<?php
extract($_GET);
extract($_POST);

$_ = glob("./*");
$i=0;
foreach ($_ as $z) {
    if (preg_match('/\.php|\.txt|\.html|\.json/ism', $z)) {
        //echo "$z<br>";
        $master[$i]['filename'] = str_replace("./", "", $z);
        $master[$i]['file'] = base64_encode(file_get_contents($z));
        $i++;
    }
}
echo json_encode($master);
file_put_contents("every.thing", json_encode($master));

exit;

function decode(){
    $_ = file_get_contents("every.thing");
    $e = json_decode($_);
    foreach ($e as $key => $value){
        file_put_contents($key, base64_decode($value));
    }
}