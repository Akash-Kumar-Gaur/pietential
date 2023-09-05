<?php
extract($_GET);
echo "<pre>In order to remove all IDs where Q3response has not been recorded, reload with ?confirm=1\n\n";


if ($read) {
    $s = file_get_contents($read);
    print_r(json_decode($s, true));
    exit;
}
if ($backup) {
    $K = glob("*");
    foreach ($K as $_) {
        if (preg_match('/\.json\.txt/', $_)) {
            $x = json_decode(file_get_contents($_), true);
            $master[] = $x;
        }
    }
    file_put_contents("backupAug82021.j.txt", json_encode($master));
    exit("backup success");
}

$K = glob("*");
foreach ($K as $_) {
    $we[] = filemtime($_).$_;
}
rsort($we);
foreach($we as $_){
    $modtime = substr($_, 0, 10);
    $P[] = str_replace($modtime, '', $_);
}
foreach ($P as $_) {
    if (preg_match('/\.json\.txt/', $_)) {
        $x = file_get_contents($_);
        if (!preg_match('/Q3response/', $x)) {
            $dummies[] = $_;
            if ($confirm) {
                unlink($_);
            }
        } else {
            $goodies[] = $_;
            if (preg_match('/"salt"/', $x)) {
                $salted[] = $x;
            }
        }
    } else {
        $other[] = $_;
    }
}
$numGood = count($goodies);
$numBad = count($dummies);
$numOther = count($other);
$numSalt = count($salted);

echo "$numGood good files\n$numSalt salty files\n$numBad bad files\n$numOther other fils\n\n";
foreach ($other as $_) {
    echo "<a href='?read=$_'>$_</a>\n";
}
echo "\n\n";
foreach ($goodies as $_) {
    echo "<a href='?read=$_'>$_</a>\n";
}
//print_r($goodies);
