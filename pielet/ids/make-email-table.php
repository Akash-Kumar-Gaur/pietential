<?php
date_default_timezone_set('America/New_York');
$offset = time() - filemtime("emailTable.json.txt");
// echo "<br>$offset";
if($offset<6){
    exit();
}
 
$_ = glob("./*.json.txt");
$i = 0;
foreach ($_ as $e) {
    $u = json_decode(file_get_contents($e), true);
    $master[$u['email']] = $u["userID"];
    $i++;
}
file_put_contents("emailTable.json.txt", json_encode($master));
// https://pietential.com/pielet/ids/make-email-table.php
// https://pietential.com/pielet/ids/emailTable.json.txt
// http://192.168.0.121:8937/pie2/pielet/ids/emailTable.json.txt
/*
<img style="display:none" src="https://pietential.com/pielet/ids/make-email-table.php">
*/
exit(" $i");