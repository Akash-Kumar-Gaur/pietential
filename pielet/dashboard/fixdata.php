<?php
$master = json_decode(file_get_contents("https://pietential.com/pielet/ZLcGKSYyn8Ao.json.txt"), true);
$ar = $master[snapshots];
echo "<pre>";

foreach ($ar as $key => $value) {
    foreach ($value as $key2 => $value2) {
        if (preg_match('/time/', $key2)) {
            $blaster[$key2] = $value2;
        }
        if (preg_match('/^Q/', $key2)) {
            $s = [4,5,6,7,8,9];
            shuffle($s);
            $blaster[$key2] = $s[0];
            //$blaster[$key2] = $value2;
            
        }
    }
    $sar[] = $blaster;
}
$master[snapshots]=$sar;


print_r($master);
echo json_encode($master);
