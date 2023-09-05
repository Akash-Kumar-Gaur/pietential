<?php
print_r(glob("*"));
foreach(glob('*zapHit.txt') as $_){
echo "$_<br> ";
unlink($_);
}