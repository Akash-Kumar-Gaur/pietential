<?
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
//print_r($D);

if ($score) {
    Header("Location: https://pietential.com/?socialshare=$score");
    exit;
}

?>

<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="icon.png">
    <title>Pietential - Growth Potential Visualization Survey</title>
</head>

<script>
    localStorage.adminView = 1;
</script>

<?




if ($user) {
    $z = json_decode(file_get_contents("$user.json.txt"), true);
    echo "<pre>";


    print_r($z);
    exit;
}

@unlink("all.json.txt");

function globByDate($pathPattern)
{
    $master = glob($pathPattern);  //"$path/*"
    foreach ($master as $_) {
        $we[] = filemtime($_) . $_;
    }
    rsort($we);
    $we = array_values($we);
    foreach ($we as $_) {
        $modtime = substr($_, 0, 10);
        $file = str_replace($modtime, '', $_);
        $arr[] =  $file;
    }
    return ($arr);
}

$master = glob("./*.txt");
foreach ($master as $_) {
    $we[] = filemtime($_) . $_;
}

unset($master);
rsort($we);
$we = array_values($we);
$i = 0;
foreach ($we as $_) {
    $modtime = substr($_, 0, 10);
    $file = str_replace($modtime, '', $_);
    $modtime = date('Y-m-d--H-i-s', $modtime);
    $keymaster[$i][filename] = $file;
    $keymaster[$i][modtime] = $modtime;
    $master[] =  $file;
    $i++;
}
//echo "<pre>";print_r($keymaster);//exit;
foreach ($keymaster as $b) {
    $z = json_decode(file_get_contents($b[filename]), true);
    $user = $z[LifeBalanceID];
    $mail = $z[LifeBalanceEmail];
    $modtime = $b[modtime];
    if ($z) {
        $shout .= "<div class='rows'>$modtime: <b class='namespace' >$mail</b> ➤ 
    
    <a href='reviewresults.php?id=$user' class='bt' >View Score</a>
    
    ($b[filename])" . "</div>";
    }
}
//echo "<pre>";print_r($keymaster);exit;
?>
<style>
    tr:nth-child(even) {
        background: #eee;
    }

    .rows {
        padding: 12px;
    }

    .rows:nth-child(even) {
        background: #eee;
    }

    .namespace {
        width: 300px;
        display: inline-block;
    }
</style>
<div style="line-height:2.2em;">

    <?= $shout ?>
</div>

<?

if ($charlie) {

    foreach ($master as $_) {
        $z = json_decode(file_get_contents($_), true);
        $all[] = $z;
    }
    file_put_contents("all.json.txt", json_encode($all));
}
?>

<img src="?charlie=1" class="poor-Mans-AJAX-img-Src-Method-HaHaHahahaha">