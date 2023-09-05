<?php
extract($_GET);
extract($_POST);
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain; charset=utf-8");


$_ = file_get_contents("index.php");

echo ($_);

?>