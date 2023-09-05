<?php
extract($_GET);
extract($_POST);
//error_reporting(E_ALL);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');

    $master = json_decode(file_get_contents("all.json"), true);
    foreach ($master['users'] as $k => $v) {
        $uid = $v['userID'];
        file_put_contents("merged/$uid.json.txt", json_encode($v));
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//formsaber.com/f2.css" rel="stylesheet" type="text/css">
</head>
<body>
    <button onclick="makeAll()">Backup IDs on server</button><br><br>
<button onclick="location.assign(`?go=1`)">Download and inflate IDs</button>


</body>
</html>

