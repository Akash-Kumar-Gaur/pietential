<?php

$s = glob("./*");
shuffle($s);
foreach ($s as $_){

    $out .= " <img src='$_' class='smicon'> ";
}






?>
<img src="./social-1_logo-facebook.svg" class="smicon">
<img src="./social-1_logo-twitter.svg" class="smicon">
<img src="./social-1_logo-linkedin.svg" class="smicon">
<style>
    .smicon{
        float:left;width:32px;
        margin:10px;
        filter: invert(0) sepia(1) saturate(14) hue-rotate(172deg);
}
</style>

<br><br><hr>
<?= $out ?>
