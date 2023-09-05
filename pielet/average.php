<?php
$_ = glob("./*");

foreach ($_ as $r) {
    if (preg_match('/.\.json\.txt/ism', $r)) {

        $obj = json_decode(file_get_contents($r), true);
        if ($obj[userID]) {
            $master[] = $obj;
        }
    }
}

file_put_contents("all.json", json_encode($master));


$numSub =  count($master);
echo "records counted: $numSub";

function sweepBadIDs($master)
{
    foreach ($master as $_) {
        $j = 1;
        while ($j < 30) {
            $q = "Q$j" . "response";
            if ($_[$q] < 1) {
                echo $_[userID] . " has incomplete data<br>";
                unlink($_[userID] . ".json.txt");
                $j = 99;
                continue;
            }
            $j++;
        }
    }
}
sweepBadIDs($master);
//echo json_encode($master);
echo "<br>";
foreach ($master as $_) {
    $j = 1;
    $values = "";
    while ($j < 30) {
        $q = "Q$j" . "response";
        $qt =  "q" . $j . "total";


        $$qt += $_[$q];
        $values .= $_[userID] . " " . $q . " " . $_[$q] . "<br> ";
        //echo $$qt."<br>";
        $j++;
    }
    echo "$values<br>";
}

echo " $q28total";
$j = 1;
while ($j < 30) {

    $qt =  "q" . $j . "total";
    $average = $$qt / $numSub;
    $average = round($average, '2');
    echo "Question $j average = $average";
    echo "<br>";

    //echo $$qt."<br>";
    $j++;
}
