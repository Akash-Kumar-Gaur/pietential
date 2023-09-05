<?php
if ($_GET['run77']){
    setcookie('run77', "iuhdfihvuh", time() + 7776000, "/"); //90 days
    exit(file_get_contents('fader.html'));
    // https://pietential.com/pricing/?run77=sde
}
if(!$_COOKIE['run77']){
    exit(file_get_contents('coming-soon.html'));
    echo "<script> location.assign(`/`); </script>";
} else {
    setcookie('run77', "iuhdfihvuh", time() + 7776000, "/"); //90 days
    exit(file_get_contents('fader.html'));
}