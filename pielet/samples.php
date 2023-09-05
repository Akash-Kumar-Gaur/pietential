<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=script, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php

$s = glob("../*.png");
shuffle($s);
foreach($s as $_){

    if (preg_match('/silver|labs|logo|water|pieten|legend/ism', $_)){
        continue;
    }
    echo "<img src='$_' style='width:200px;margin:10px;float:left;'>";

}
?>


    
</body>
</html>