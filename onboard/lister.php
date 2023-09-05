<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');

if (!$_COOKIE['run77']) {
    exit("nc");
}

if ($read) {
    exit(file_get_contents($_GET['read']));
}

if ($repairUsers) {
    $i=0;
    $arr = glob("../pielet/ids/*json.txt");
    echo "files:" . count($arr);
    echo "<br>";
    foreach ($arr as $_) {
        $master = json_decode(file_get_contents($_), true);
        $uid = $master['userID'];
        $tuid = $master['tempUserID'];
        if ($master['companycode'] && !$master['promoCode']) {
            $master['promoCode'] = $master['companycode'];
            file_put_contents($_, json_encode($master));
            echo "<a href='$_'>$tuid</a><br>";
            $i++;
            if ($i>9){
                exit("$i user repaired");
            }
        }
    }
    exit("$i user repaired");
}


if ($assignAdmin) {
    $arr = glob("../pielet/ids/*json.txt");
    $propertyToScan = "companycode";
    foreach ($arr as $_) {
        $j = file_get_contents($_);
        $master = json_decode($j, true);
        if ($master[$propertyToScan]) {
            $codedUsers[] = $master;
            $userID = $master['userID'];
            if (!$userID) {
                $userID = $master['tempUserID'];
            }
            $v = $master[$propertyToScan];
            $out .= "<a id='$userID' href='javascript://' onclick='view(\"$userID\")'>$userID</a> $v<br>";
        }
    }

    

    $j = json_encode($codedUsers);
    echo    $out; ?>
    <script>
        var users = <?php echo $j ?>;

        function view(id) {
            for (let a of users) {
                if (a.userID == id || a.tempUserID == id) {
                    var k = JSON.stringify(a);
                    document.getElementById(id).outerHTML += `<br><textarea>` + k + `</textarea><br>`;
                }
            }

        }
    </script>

<?php
    exit;
}



if ($add) {
    //echo "<pre>found add\n";
    $a = json_decode($add, true);
    foreach ($a as $_) {
        $userID = $_['tempUserID'];
        $dataIndividual = json_encode($_);
        $target = "../pielet/ids/$userID.json.txt";
        if (file_exists($target)) {
            $out .= "CONFLICT";
        } else {
            file_put_contents($target, $dataIndividual);
            $out .= "$target\n";
        }
    }
    //print_r($a);
    exit($out);
}


$x = glob("./*.json");
foreach ($x as $_) {
    $we[] = filemtime($_) . $_;
}
rsort($we);
foreach ($we as $_) {
    $modtime = substr($_, 0, 10);
    $unit['filetime'] = $modtime;
    $unit['filename'] = str_replace($modtime, '', $_);
    $master[] = $unit;
}
exit(json_encode($master));
