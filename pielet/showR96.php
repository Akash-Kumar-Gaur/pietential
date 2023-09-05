<?php
 header("Access-Control-Allow-Origin: *");
 header("Content-Type: text/plain; charset=utf-8");
 $_ =  file_get_contents('editR96.php');
 $BASE64 =  base64_encode ($_);
 if($_GET[b64]){
     exit($BASE64);
 }
echo $_;
?>