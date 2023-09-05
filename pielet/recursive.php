<?php
//recursive.php
extract($_GET);
extract($_POST);

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
echo "<pre>";
?>

to view: ?v=1<br>
to write JSON file: ?j=1 "recursive.json.txt"<br>
to spec a new dir: ?dir="the dir name"

<?php
if (!$dir) {
    $dir = "./";
}

if ($v) {
    print_r(loadurls($dir));
}

if ($j) {
    file_put_contents("recursive.json.txt", json_encode(loadurls($dir)));
}
