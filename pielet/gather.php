<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gather</title>
</head>
<body>
    <pre>
    <?php

$master = loadurls();
$i=0;
while($i<10){
    // $file=file_get_contents($master[$i]);
    // $m2[]= $file;
    // echo base64_encode($file);
    // echo"<br><br>";
     $i++;
}

$j = json_encode($master);
echo "<script>localStorage.gatherBaseFull = `$j`;</script>";



print_r($master);
function loadurls($dir)
{
    if (!$dir) {
        $dir = "./";
    }
    static $master;
    $dir = str_replace("//", "/", $dir);
    $_ = glob("$dir/*");
    foreach ($_ as $d) {
        if (is_dir($d)) {
            loadurls($d); // here is the recursion, requires static array
        } else {
            $d = str_replace("//", "/", $d);
            $master[] = $d;
        }
    }
    return ($master);
}
?>

    </pre>
</body>
</html>