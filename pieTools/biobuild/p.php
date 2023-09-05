<?php
extract($_POST);
extract($_GET);
if ($biosall){
    file_put_contents("biosall.json", $biosall);
    exit;
}
$m = json_decode($payload, true);
$name = trim($m['name']);
$photo = preg_replace('/\s+/sim', '-', $name);
file_put_contents("$photo.jpg", base64_decode($m['b64']));
$master = [];
$master['name'] = $name;
$master['title'] = $m['title'];
$master['photo'] = "$photo.jpg";
$master['bio'] = $m['bio'];
file_put_contents("$photo.json.txt", json_encode($master));
echo "Saved!";

