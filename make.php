<?php
extract($_GET);
extract($_POST);

echo "<pre>";
$master = json_decode(file_get_contents("thesite.json"), true);

foreach ($master as $key => $value) {
    if (preg_match('/\//', $key)) {
        $fileName = preg_replace('/.+\//ism', "", $key);
        $folderName = str_replace( $fileName, "", $key);
        //echo "$folderName\n";
        $j[]=$folderName;
    }
}
foreach (array_unique($j) as $_){
    echo "$_\n";
    if (!file_exists($_)){
        mkdir($_);
    }
}
foreach ($master as $key => $value) {
    file_put_contents($key, $value);
}
exit;