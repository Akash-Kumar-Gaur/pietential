<?php
date_default_timezone_set('America/New_York');
extract($_GET);
extract($_POST);
$_ = file_get_contents("../blog57-backup.zip");
$f = base64_encode($_);

echo "<pre>";

echo $f;


// $_= glob("../blog57/*");
// foreach ($_ as $v){
//     echo "$v\n";
//     if (is_dir($v)){
//         $n = preg_replace('/[^\/]+/ism', '', $v);
//         mkdir($n);
//     }
// }

// $_ = file_get_contents("http://pietential.com/blog57-backup.zip");
// file_put_contents("blog.zip", $_);
?>

