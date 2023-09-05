<?php
//recursive.php
extract($_GET);
extract($_POST);

if ($dl) {
    unlink($dl);
    header("Location: fix-f-bug.php?gphp=3&$dl-was-deleted.");
    exit;
}

if ($inspect) {
    $_ = file_get_contents($inspect);
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    exit("$_");
}
if ($gphp) {
    //http://ncvfoundation.org/fix-f-bug.php?gphp=2
    $master = json_decode(file_get_contents("recursive.json.txt"), true);
    foreach ($master as $_) {
        if (preg_match('/\.php/i', $_)) {
            $out .= "$_ - <a href='fix-f-bug.php?inspect=$_'>inspect</a> <a href='fix-f-bug.php?dl=$_'>delete</a><br>";
        }
    }
}

function grec($re)
{
    $master = json_decode(file_get_contents("recursive.json.txt"), true);
    foreach ($master as $_) {
        if (preg_match('/' . $re . '/i', $_)) {
            $t[] = $_;
        }
    }
    natcasesort($t);
    return $t;
}

if ($grec) {
    $t = grec($grec);
    foreach ($t as $_) {
        $out .= "$_ - <a href='fix-f-bug.php?inspect=$_'>inspect</a> <a href='fix-f-bug.php?dl=$_'>delete</a><br>";
    }
}



function grecINNER($re)
{
    $master = json_decode(file_get_contents("recursive.json.txt"), true);
    foreach ($master as $_) {
        $fz = @filesize($_);
        if ($fz < 30000000) {
            $d = @file_get_contents($_);
            if (preg_match('/' . $re . '/ism', $d)) {
                $t[] = $_;
            }
        }
    }
    natcasesort($t);
    return $t;
}


if (!file_exists("fix.json.txt") && file_exists("recursive.json.txt")) {
    $t = grecINNER("fwrite");
    natcasesort($t);
    file_put_contents('fix.json.txt', json_encode($t));
}

if ($buildFwrite) {
    $t = grecINNER("fwrite");
    natcasesort($t);
    file_put_contents('fix.json.txt', json_encode($t));
}

if ($listFwrite) {
    $t = json_decode(file_get_contents("fix.json.txt"), true);
    foreach ($t as $_) {
        $out .= "$_ - <a href='?dl=$_' target='_blank'>Delete</a><br>\n";
    }
}

function loadurls($dir)
{
    static $master;
    $dir = str_replace("//", "/", $dir);
    $_ = glob("$dir/*");
    foreach ($_ as $d) {
        if (is_dir($d)) {
            loadurls($d); // here is the recursion, requires static array
        } else {
            $master[] = $d;
        }
    }
    return ($master);
}

if (!$dir) {
    $dir = "./";
}

if ($v) {
    if (!file_exists("recursive.json.txt")) {
        file_put_contents("recursive.json.txt", json_encode(loadurls($dir)));
    }
    $_ = json_decode(file_get_contents("recursive.json.txt"), true);
    foreach ($_ as $x) {
        $out .= "<a href='$x'>$x</a><br>\n";
    }
}

if ($j) {
    file_put_contents("recursive.json.txt", json_encode(loadurls($dir)));
    exit("file created");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>listFwrite</title>

    <style type="text/css">
        html,
        body {
            font-family: sans-serif;
            font-size: 18px;
        }

        a:link {
            color: #0099CC;
        }
    </style>
</head>

<body>
    <a href="?listFwrite=1">?listFwrite=1</a><br>
    <a href="?gphp=1">?gphp=1</a><br>
    <a href="?buildFwrite=1">?gphp=1 rebuild fwrite list</a><br>
    <a href="?v=1">?v=1 to view file tree recursive</a><br>
    <a href="?j=1">?j=1 to build json file tree recursive</a><br>
    <a href="?grec=pattern">?grec=pattern to search filenames</a><br>
    <br><br><br><?php echo $out; ?>
</body>

</html>