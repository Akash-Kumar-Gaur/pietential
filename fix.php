<?php
$_ = glob("./*merged.pdf");
print_r($_);
foreach($_ as $x){
unlink($x);
}