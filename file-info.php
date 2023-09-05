<?php
extract($_GET);
extract($_POST);


$globex = "login/,
pielet/,
pielet/survey/,
pielet/admin/,
pielet/analyzeit/,
pielet/becomeamember/,
pielet/calcEngine/,
pielet/coach/,
pielet/create/,
pielet/dashboard/,
pielet/icons/,
pielet/ids/,
pielet/invite/,
pielet/new-account/, 
pielet/privacy/, 
pielet/retake/, 
pielet/share/, 
pielet/shareMyChart/, 
pielet/shell/, 
pielet/visualizeit/, 
pielet/vote/";
$globex = explode(",", $globex);
$k = glob("*.js");
    foreach ($k as $d) {
        $master[] = $d;
    }
    $k = glob("*.php");
    foreach ($k as $d) {
        $master[] = $d;
    }
foreach ($globex as $_) {
    $_ = trim($_);
    $k = glob("$_*.js");
    foreach ($k as $d) {
        $master[] = $d;
    }
    $k = glob("$_*.php");
    foreach ($k as $d) {
        $master[] = $d;
    }
}
sort($master);
foreach ($master as $x) {
    $out .= $x;
    $id['name'] = $x;
    $id['time'] = filemtime($x);
    //$id['hash'] =  hash('whirlpool', file_get_contents($x));
    $id['hash'] =  sha1(file_get_contents($x));
    $master2[] = $id;
    $master3[$x] = $id['hash'];
}
$locals = json_encode($master);
$times = json_encode($master2);
$hashes = json_encode($master3);

if (preg_match('/silve312/', $_SERVER["DOCUMENT_ROOT"])) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    echo $hashes;
    exit;
}
//print_r($master2);
//echo $times;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
locals = <?php echo $hashes;?>;
fetch(`http://pietential.com/file-info.php`)
                .then(r => {
                    return r.text()
                })
                .then(contents => {
                    var remotes = JSON.parse(contents);
                    window.remotes = remotes;
                    var out = '';
                    for (let a in remotes){
                        console.log(remotes[a]);
                        if(remotes[a] !== locals[a]){
                            out += `${a} is different<br>`;
                        }
                    }
                    document.body.innerHTML += out;
                });


    </script>
</body>
</html>


