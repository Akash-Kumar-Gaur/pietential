<?php
extract($_GET);
extract($_POST);
//error_reporting(E_ALL);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');

if ($go) {
    if ($_SERVER['HTTP_HOST'] == "192.168.0.121:8937") {
        $all = file_get_contents("http://pietential.com/pielet/ids/all.json");
        file_put_contents("all.json", $all);
    }
    $master = json_decode(file_get_contents("all.json"), true);
    foreach ($master['users'] as $k => $v) {
        $uid = $v['userID'];
        file_put_contents("$uid.json.txt", json_encode($v));
    }
    foreach ($master['users'] as $k => $v) {
        $uid = $v['userID'];
        $email = $v['email'];
        if ($email) {
            $emailTable[$email] = $uid;
            file_put_contents("emailTable.json.txt", json_encode($emailTable));
        }
    }
    exit("files updated.");
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

<script>
    function makeAll() {
        fetch("https://pietential.com/pielet/ids/make-all.php")
            .then(r => {
                return r.text()
            })
            .then(a => {
                document.body.innerHTML += `<br><br>Files backed up sucessfully.<br><br>${a}`;
            });

    }
</script>
</body>
</html>

