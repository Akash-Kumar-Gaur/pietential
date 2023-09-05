<?php



function loadurls($dir)
{
    static $master;
    $dir = str_replace("//", "/", $dir);
    $_ = glob("$dir/*");
    //print_r($_);
    foreach ($_ as $d) {
        if (is_dir($d)) {
            loadurls($d); // here is the recursion, requires static array
        } else {
            if(!preg_match('/txt|ids|icons|json|png|gif|jpg|svg|csv/', $d)){
                
            $master[] = $d;
            }
        }
    }
    return ($master);
}

$b = loadurls('..');

natcasesort($b);


$r ="https://pietential.com/";
foreach ($b as $_){
    $_ = str_replace("../", '', $_);
    $a = $r.$_."<br>";
    $out2.=$a;
    $dirs[] = preg_replace('/[^\/]+$/ism', "", $a);
}

foreach(array_unique($dirs) as $_){
    $out1.=$_ . "<br>";
}

echo $out1.$out2;