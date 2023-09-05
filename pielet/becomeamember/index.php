<?php
extract($_GET);
extract($_POST);
// becomeamember/index.php
if ($test) {
    echo "<pre>Cookies:\n";
    print_r($_COOKIE);
    $userID = $_COOKIE['userID'];
    $pieletDataJSON = @file_get_contents("../ids/$userID.json.txt");
    $master = json_decode($pieletDataJSON, true);
    echo "\n\npieletDataJSON:\n";
    print_r($master);
    exit;
}
header("Location: /pielet/create/");