<?php
//error_reporting(E_ALL);
extract($_GET);
extract($_POST);
$_ = glob("ids/*");


// https://pietential.com/pielet/create-email-table.php?img=1
foreach ($_ as $r) {
    if (preg_match('/.\.json\.txt/ism', $r)) {
        // if ($test) {
        //     echo ("$r<br>");
        // }
        $r = str_replace("}}", "}", $r);
        $obj = json_decode(file_get_contents($r), true);
        if ($obj['email']) {

            // if ($test) {
            //     if ($obj[email]) {
            //         echo "$obj[email]<br>";
            //     }
            // }

            $obj2[userID] = $obj[userID];
            $obj2[email] = $obj[email];
            $master[] = $obj2;
            $reel .= $obj[email] . ":" . $obj[userID] . "<br>\n";
        }
    }
}

file_put_contents("email-table.json", json_encode($master));
if ($img) {
    header('Content-Type: image/gif');
    echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
    exit;
}
echo $reel;
echo "<br>";
echo json_encode($master);
