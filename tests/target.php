<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
$skh = 'd1b0292e5f6821925b1806cb5aaa15e3bd515f95c97ddf1cfadc857468e68296a1c708347316c1978b5990c963a325e9264d3541b7e5d04081512e94aea2bcff';
if ($secretKey) {
    if (hash('whirlpool', $secretKey) !== $skh) {
        exit('bad skh creds');
    } else {
        echo "it worked.";
    }
}
