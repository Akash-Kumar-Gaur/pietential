<?php
extract($_GET);
extract($_POST);
// dashboard/index.php
$_ = glob("*");

foreach($_ as $f){
    $d = file_get_contents($f);
    if (preg_match('/return\s+to\s+eval/ism', $d)){
        echo htmlentities($f);
        echo "<br>";
    }
}