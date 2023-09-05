<?php
if (!$_COOKIE['d1b0292e5f']){
    exit;
}

// var hustleProexprire = new Date(Date.now()+36.048e+8).toUTCString(); document.cookie = `d1b0292e5f=yes; expires=${hustleProexprire}; path=/`;
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
$_ = file_get_contents("https://pietential.com/pielet/ids/make-all.php");
$a = file_get_contents("all.json");
header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $timestamp . '.json.txt"');

echo $a;
exit;
?>
<script>
document.cookie = `d1b=yes; expires=13 Jan 2028 20:36:12 GMT; path=/`;   document.cookie = "message=adds to cookie without affecting others; expires=31 Dec 2020 12:00:00 UTC; path=/";

var hustleProexprire = new Date(Date.now()+6.048e+8).toUTCString();
document.cookie = `hpe=yes; expires=${hustleProexprire}; path=/`;


</script>
