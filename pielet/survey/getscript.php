<?php
extract($_GET);
extract($_POST);
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain; charset=utf-8");
$domain = $_SERVER['HTTP_HOST'];
$filepath = $_SERVER['SCRIPT_NAME'];
$lastslash = strrpos($filepath, "/");
$path = substr($filepath, 0, $lastslash);
$hi = "http://" . $domain . $path . "/";
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d');



if ($_COOKIE[userID] && $account) {
    $userID = $_COOKIE[userID];
    $paydirt = @file_get_contents("../ids/$userID.json.txt");
    if (!$paydirt) {
        $paydirt = '{"userID":"' . $userID . '","account":"' . $account . '","partnerID":"' . $account . '"}';
    }
    $_ .= "localStorage.pieletDataJSON = `" . $paydirt . "`;\n\n";
    $_ .= file_get_contents("createDiv.js");
    $ufooter = file_get_contents("../universal-footer.php");
    $_ = str_replace('{{universal-footer}}', $ufooter, $_);
    echo $_;
    exit;
}
if ($pieletData) {
    $master = json_decode(base64_decode($pieletData), true);
    $master['timestamp'] = $timestamp;
    $userID = $master['userID'];
    if ($userID) {
        file_put_contents("../ids/$userID.json.txt", json_encode($master));
        //file_put_contents("../$userID.json.txt", json_encode($master));
    }
    exit;
}
if ($savePNGPIE) {
    $iname = $userID . ".png";
    $savePNG = $savePNGPIE;
    $decodedData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $savePNG));
    file_put_contents("../$iname", $decodedData);
    exit;
}
if ($savePNGBAR) {
    $iname = $userID . ".bar.png";
    $savePNG = $savePNGBAR;
    $decodedData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $savePNG));
    file_put_contents("../$iname", $decodedData);
    exit;
}
header("Location: https://pietential.com/");
exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script id='pieScript' src='https://pietential.com/pielet/?account=hanktest'></script>
</body>

</html>