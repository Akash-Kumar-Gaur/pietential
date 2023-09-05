<?php


extract($_GET);
extract($_POST);

if($payload){
    $n = $_SERVER['REMOTE_ADDR'];
    $p = base64_decode($payload);
    file_put_contents("$n.txt", $p);
    echo "<br>data saved - thanks";
}