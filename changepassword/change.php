<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
if ($userID) {
    $file = file_get_contents("../pielet/ids/$userID.json.txt");
    $pieletData = json_decode($file,true);
    // check orig password
    $hashCheck = $currentpassword.$pieletData['salt'];
    $hashCheck = hash('whirlpool', $hashCheck);
    if ($pieletData['hash'] == $hashCheck){
        // authenticated
        $newHash = $newpassword.$pieletData['salt'];
        $newHash = hash('whirlpool', $newHash);
        $pieletData['hash'] = $newHash;
        file_put_contents("../pielet/ids/$userID.json.txt", json_encode($pieletData));
        echo "AUTHENTICATED - $hash";
    } else {
        echo "FAIL";
    }
}
