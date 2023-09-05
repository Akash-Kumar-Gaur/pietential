<?php

if( !$_COOKIE['mule77']){
    exit;
} else {
    setcookie('mule77', "shuihdvc898", time() + 7776000, "/"); //90 days
}
$j = file_get_contents("../../pielet/ids/all.json");
$master = json_decode($j, true);
$c = count($master['users']);
echo $c;
exit;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users.length</title>
</head>
<body>
   <script>
    var j = <?php echo $j;?>;
    var k = j.users.length;
    document.body.innerHTML +=  `${k} users`;
</script>
 
</body>
</html>