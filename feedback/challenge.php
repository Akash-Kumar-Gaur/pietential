<?php




// create a challenge string and write it to the browser as an image, 
// as well as write the contents to a user cookie so we can compare
// remember to include hankpants
$d = str_split('azxcvbnmkjhgfdswqertyup98765432');
shuffle($d);
$i = 0;
$r = '';
while ($i < 6) {
    $r .= $d[$i];
    $i++;
}
$r = strtolower($r);
$hash = hash ('whirlpool', $r);
setcookie('image-challenge-cookie', $hash, time() + 300, "/");
$imchal = imagecreate(110, 20);
$background = imagecolorallocate($imchal, 0, 0, 0);
$text_colour = imagecolorallocate($imchal, 255, 255, 50);
$line_colour = imagecolorallocate($imchal, 128, 255, 0);
imagestring($imchal, 4, 4, 4, $r, $text_colour);
imagesetthickness($imchal, 5);
header("Content-type: image/png");
imagepng($imchal);
imagecolordeallocate($line_color);
imagecolordeallocate($text_color);
imagecolordeallocate($background);
imagedestroy($imchal);
