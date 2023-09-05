<?php

foreach (glob("*.json.txt") as $f){
    $master = json_decode(file_get_contents($f));
    echo $master['partnerID'];
    echo "<br>";
}


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

