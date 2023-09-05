<?php
//recursive.php
extract($_GET);
extract($_POST);

$folders = [];
function loadurls($dir)
{
    static $master;
    $dir = str_replace("//","/", $dir);
    $_ = glob("$dir/*");
    foreach ($_ as $d) {
        if (is_dir($d)) {
            loadurls($d);
            //echo "mkdir($d);<br>";
        } else {
            $master[]=$d;
        }
    }
    return ($master);
}
echo "<pre>";
print_r(loadurls("./"));