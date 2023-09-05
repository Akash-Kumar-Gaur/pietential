<?php
extract($_GET);
extract($_POST);
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: text/plain; charset=utf-8");
// $domain = $_SERVER['HTTP_HOST'];
// $filepath = $_SERVER['SCRIPT_NAME'];
// $lastslash = strrpos($filepath, "/");
// $path = substr($filepath, 0, $lastslash);
// $hi = "http://" . $domain . $path . "/";
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d');
$html = file_get_contents("../shell/index.php");
$html = str_replace("{{title}}", "Pietential Privacy Policy", $html);
$html = str_replace("{{headline}}", "Pietential Privacy Policy", $html);
$_ = file_get_contents("privacy.html");
$html = str_replace("{{content}}", $_, $html);
$html .= file_get_contents("../universal-footer.php");
exit($html);
