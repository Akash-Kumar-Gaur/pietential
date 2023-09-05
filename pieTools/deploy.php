<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
$loc = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$serverEndPoint = "https://skypie.silvercrayon.us/aget.php";

if ($getfile) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    echo (file_get_contents($getfile));
    exit;
}


$f = loadurls("../");
foreach ($f as $v) {
    $master[] = $v;
}

$j = json_encode($f, true);
echo "<pre>";
$test = file_get_contents($f[27]);
echo "<textarea>$test</textarea>";
echo "<textarea>$j</textarea>";
echo "<script>var j = $j; console.log(j);</script>";

function loadurls($dir)
{
    static $master;
    $dir = str_replace("//", "/", $dir);
    $_ = glob("$dir/*");
    foreach ($_ as $d) {
        if (is_dir($d)) {
            loadurls($d); // here is the recursion, requires static array
        } else {
            if (!preg_match('/\.doc|psd$|\.png$|\.gif|\.jpe?g$|\/pielet\/ids\/.+json|icons|docx|notes|aws\/|zip|tests/ism', $d)) {
                $master[] = $d;
                if (preg_match('/pielet/ism', $d)) {
                    
                }
            }
            
        }
    }
    //natcasesort($master);
    return ($master);


    if (!preg_match('/psd$|\.png$|\.gif|\.jpe?g$|\/pielet\/ids\/.+json|icons|docx|notes|zip|tests/ism', $d)) {
        $master[] = $d;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>deploy</title>
</head>

<body>


    <div id="results2"></div>
    <div id="results"></div>


    <script>
        var serverEndPoint = "<?php echo $serverEndPoint; ?>";
        var out = '';
        for (let a of j) {
            out += `<a href="javascript://" onclick="getputfile('${a}')">${a}</a><br>`;
            //getputfile(a);
        }
        document.getElementById("results").innerHTML += out;


        function getputfile(a) {
            fetch(`?getfile=${a}`)
                .then(r => {
                    return r.text()
                })
                .then(contents => {
                    console.log(contents);
                    localStorage.a = contents.trim();
                    document.getElementById("results2").innerHTML += `got ${a} contents...<br>`;
                    writeFile(a, contents);
                });
        }
    </script>
    <script>
        function writeFile(a, contents) {
            a = a.replace(/\.php/ig, ".smc").replace("..//", "").replace("../", '');
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
                    document.getElementById("results2").innerHTML += `server says:<b> ${contents}</b><br>`;
                });
        }


        var arr = [];
        var a2 = [];
        var a2 = [];
        for (let a of j) {
            if (a.match(/\/[\s\S]+\//ig)) {
                b = a.replace(/\.\.\/\/?/ig, "").replace(/\/[\s\S]+/ig, "/");
                arr.push(b);
            }
            arr = Array.from(new Set(arr));
            if (a.match(/pielet/ig)) {
                b = a.replace(/[\s\S]+pielet\//ig, "").replace(/\/[\s\S]+/ig, "/");
                if(!b.match(/\./)){
                a2.push("pielet/"+b.replace(/\/$/, ''));
            }
            }
            a2 = Array.from(new Set(a2));
        }
        console.log(a2);


function findAllDirs(){
    var a3 = [];
    for (let a of j) {
        a = a.replace(/\.\.\/\/?/ig, "")
        if (a.match(/\/[\s\S]+\//ig)) {
                a3.push(a.replace(/[^\/]+$/ig,'').replace(/\/$/ig, ''));
            }
    }
    a3 = Array.from(new Set(a3));
    console.log(a3);
    
}


var dirs = ['contact/responses', 'pieWidget/build', 'pieWidget/test', 'pielet/accountEngine', 'pielet/admin', 'pielet/admin/adminlogin', 'pielet/admin/adminlogin/ids', 'pielet/admin/codex', 'pielet/admin/create', 'pielet/analyzeit', 'pielet/becomeamember', 'pielet/calcEngine', 'pielet/coach', 'pielet/create', 'pielet/dashboard', 'pielet/download', 'pielet/ids', 'pielet/invite', 'pielet/new-account', 'pielet/privacy', 'pielet/privacy/new-thread', 'pielet/promocode', 'pielet/retake', 'pielet/share', 'pielet/shareMyChart', 'pielet/shell', 'pielet/survey', 'pielet/visualizeit', 'pielet/vote'];


    </script>

</body>

</html>