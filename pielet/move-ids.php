<?php
extract($_GET);
extract($_POST);

$_ = glob("./*");


// https://pietential.com/pielet/create-email-table.php?img=1
foreach ($_ as $r) {
    if (preg_match('/.\.json\.txt/ism', $r)) {
        copy ($r, "ids/$r");
    }
}