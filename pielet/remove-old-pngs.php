<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>


<?php
$K = glob("*.png");
foreach ($K as $_) {
    $we[] = filemtime($_) . $_;
}
rsort($we);
foreach ($we as $_) {
    $modtime = substr($_, 0, 10);
    $id = str_replace($modtime, '', $_);
    $arr[] = str_replace(".json.txt", '', $id);
    $mtime = date("n/d/y H:i:s", $modtime);
    $out .= "$id -  modified: $mtime<br>\n";
}
echo $out;

?>
    <script>
       
    </script>
</body>
</html>