<?php
date_default_timezone_set('America/New_York');
$serverBaseURL = "https://ikigro.silvercrayon.us";
$serverEndPoint = "$serverBaseURL/aget-staging.php";
$fileBase = "aget-staging-base.json";
//$serverEndPoint = "https://44.192.97.107/aget.php";
//$serverEndPoint = "http://54.91.240.71/aget.php";
// for (let a of document.cookie.split(`;`)){console.log(a)}
if ($_GET['ul']) {
    file_put_contents($fileBase, base64_decode($_GET['ul']));
}
if (preg_match('/bitnami|silve312/', $_SERVER["DOCUMENT_ROOT"])) {
    extract($_GET);
    extract($_POST);
    $mode = "remote";
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    if (!$_COOKIE['run77']) {
        // echo "wrong cookie";
        // print_r($_COOKIE);
    }
    if ($key !== "germ") {
        echo "not allowed g";
        exit;
    }
    if ($path && $file) {
        $path = str_replace(".smc", ".php", $path);
        file_put_contents($path, base64_decode($file));
        echo "Put $path successful.\n";
    } else {
        echo "not allowed p";
    }
    exit;
}
// done with all remote server functions
// now handling mid server function of reading files
extract($_GET);
extract($_POST);
if ($getfile) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    echo (file_get_contents($getfile));
    exit;
}
// done with all mid server functions
// now handling local output
$globex = json_decode(file_get_contents($fileBase), true);
natcasesort($globex);
foreach ($globex as $_) {
    $taout .= "$_\n";
}
$taout = trim($taout);


$k = glob("*");
foreach (array_unique($k) as $d) {
    $master[] = $d;
}
foreach (array_unique($globex) as $_) {
    $_ = trim($_);
    $_ .= "/";
    $k = glob("$_*.js");
    foreach ($k as $d) {
        $master[] = $d;
    }
    $k = glob("$_*.php");
    foreach ($k as $d) {
        $master[] = $d;
    }
    $k = glob("$_*.html");
    foreach ($k as $d) {
        $master[] = $d;
    }
    $k = glob("$_*.png");
    foreach ($k as $d) {
        $master[] = $d;
    }
}

function returnFtypes($array)
{
    $pattern = '/\.js|\.php|\.html|\.css|\.png/ism';
    foreach ($array as $_) {
        if (preg_match($pattern, $_)) {
            $out[] = $_;
        }
    }
    return $out;
}



$master = returnFtypes($master);

sort($master);
foreach ($master as $x) {
    $we[] = filemtime($x) . $x;
    //     $out .= $x;
    //     $id['name'] = $x;
    //     $id['time'] = filemtime($x);
    //     $id['hash'] =  hash('whirlpool', file_get_contents($x));
    //     $master2[] = $id;
}
rsort($we);
foreach ($we as $_) {
    $modtime = substr($_, 0, 10);
    $mtime = date("n/d/y H:i:s", $modtime);
    $xc = str_replace($modtime, '', $_);
    $P[] = $xc;
    $snout .= "$mtime $xc\n";
}

$locals = json_encode($P);
//$times = json_encode($master2);
// now done with all server side tasks.
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>aget STAGING</title>

    <style>
        * {
            font-family: 'Segoe UI', sans-serif;
        }
        body {
            background: wheat;
        }
    </style>




</head>

<body style="margin:4%">
    <div style="display:none"><?php echo $snout; ?></div>
    <textarea name="files" id="files" cols="30" rows="10"></textarea>
    <br><br> <button onclick="go();">Upload</button>
    <br>
    filter: <input type="text" id="filter" onkeyup="runfilter()">
    <br><br>
    <div id="results"></div>
    <div id="newpics" style="display:none;width:400px;border:2px solid #9f2222;padding: 12px; border-radius: 8px;"></div>
    <div name="available" id="available"></div>
    <textarea name="dirs" id="dirs" cols="30" rows="10"><?php echo $taout; ?></textarea> <button onclick="updateList();">update list</button>
    <br><br>
    <script>
        function updateList() {
            var l = document.getElementById("dirs").value.trim().split("\n");
            var j = JSON.stringify(l);
            dirs.outerHTML += `<img src="?ul=${btoa(j)}">`;

        }

        function runfilter() {
            var matchcounter = 0;
            var filter = document.getElementById("filter").value;
            var re = new RegExp(filter, 'ig');
            for (let a of document.getElementsByClassName("fresults")) {
                if (a.id.match(re)) {
                    a.style.display = "block";
                    matchcounter++;
                } else {
                    a.style.display = "none";
                }
            }
        }


        var locals = <?php echo $locals; ?>;
        //var times = <?php echo $times; ?>;
        var serverEndPoint = "<?php echo $serverEndPoint; ?>";
        var ls = '';
        for (let a of locals) {
            var nicename = a.replace(/\//ig, ".");
            var styles = `style="width:200px; margin:4px;"`;
            if (a.match(/index.php/gi, a)) {
                styles = `style="background: springgreen;width:200px; margin:4px;"`;
            }
            if (a.match(/\.js/gi, a)) {
                styles = `style="background: gold;width:200px; margin:4px;"`;
            }
            ls += `<button class="fresults" id="${nicename}" ${styles} onclick="addtolist('${a}')">${a}</button>\n`;
        }

        document.getElementById("files").value = localStorage.chunkrStaging;
        document.getElementById("available").innerHTML = ls;

        function addtolist(a) {
            var fel = document.getElementById("files").value.split("\n");
            fel = Array.from(new Set(fel));
            fel.push(a);
            fel.sort();
            var out = '';
            fel = Array.from(new Set(fel));
            for (let a of fel) {
                out += a.trim() + "\n";
            }
            document.getElementById("files").value = out.trim();
        }

        function go() {
            var chunkr = document.getElementById("files").value.trim();
            localStorage.chunkrStaging = chunkr;
            document.getElementById("files").value = chunkr;
            var listr = chunkr.split(/\n/);
            for (let a of listr) {
                a = a.trim();
                console.log(a);
                document.getElementById("results").innerHTML += `attempting to read ${a}<br>`;
                // get the file contents
                getputfile(a);
            }
        }

        function getputfile(a) {
            fetch(`?getfile=${a}`)
                .then(r => {
                    return r.text()
                })
                .then(contents => {
                    localStorage.a = contents.trim();
                    document.getElementById("results").innerHTML += `got ${a} contents...<br>`;
                    writeFile(a, contents);
                });
        }


        function writeFile(a, contents) {
            a = a.replace(/\.php/ig, ".smc");
            const fd = new FormData();
            fd.append('path', a);
            fd.append('file', btoa(unescape(encodeURIComponent(contents))));

            fd.append('key', "germ");
            const options = {
                method: 'POST',
                //mode: 'no-cors',
                body: fd
            };
            //contents = btoa(contents);
            fetch(serverEndPoint, options)
                .then(r => {
                    return r.text()
                })
                .then(contents => {
                    var urlpart = contents.replace(/put\s/ig, "");
                    urlpart = urlpart.replace(/\ssuccessful./ig, "").trim();
                    var link = `<?php echo $serverBaseURL;?>/${urlpart}`;
                    document.getElementById("results").innerHTML += `<a target="_blank" href="${link}">${link}</a> - looks good.</b><br>`;
                });
        }
    </script>



</body>

</html>