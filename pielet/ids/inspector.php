<?php
// api requests:
// https://pietential.com/pielet/ids/inspector.php?load=1
// https://pietential.com/pielet/ids/inspector.php?inspect={the ID}
// https://pietential.com/pielet/ids/inspector.php?generate=1

if (!$_COOKIE['d1b0292e5f']) {
    exit;
}
extract($_GET);
// if ($generate) {
//     $K = glob("*.json.txt");
//     foreach ($K as $_) {
//         $we[] = filemtime($_) . $_;
//     }
//     rsort($we);
//     foreach ($we as $_) {
//         $modtime = substr($_, 0, 10);
//         $id = str_replace($modtime, '', $_);
//         $arr[] = str_replace(".json.txt", '', $id);
//     }
//     $o = json_encode($arr);
//     file_put_contents("o.txt", $o);
//     header('Content-Type: image/gif');
//     echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
// }

// if ($load) {
//     header("Access-Control-Allow-Origin: *");
//     header("Content-Type: text/plain; charset=utf-8");
//     exit(file_get_contents("o.txt"));
// }
if ($inspect) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    exit(file_get_contents("$inspect.json.txt"));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inspector</title>
    <style>
        * {
            font-family: 'segoe ui', 'open sans', sans-serif;
            font-size: 16px;
        }

        body {

            background-color: white;
            margin: 80px;

        }
    </style>
</head>

<body>
    <input type="text" id="filter" onkeyup="showresults()" placeholder="start typing to search"><br><br>
    <div id="current"></div>
    <script>
        var pieIDs = <?php echo (file_get_contents('all.json')); ?>;
        showList(pieIDs.users);

        function showList(arr) {
            var out = '';
            var master = [];
            for (let a of arr) {
                try {
                    if (a.completionDate.match(/2/)) {
                        a.joinDate = a.completionDate;
                    }
                    if (a.timestamp.match(/2/)) {
                        a.joinDate = a.timestamp;
                    }
                    
                } catch (e) {}
                master.push(a.joinDate + ";" + a.userID + ";" + a.email);
            }
            master.sort().reverse();
            for (let a of master) {
                out += `<span class="bts" title="${a.split(",")[0]}" ><button  onclick="inspect('${a.split(";")[1]}')">${a.split(";")[0]} ${a.split(";")[2]} ${a.split(";")[1]}</button><br>\n</span>`;
            }
            document.body.innerHTML += out;
        }

        function inspect(id) {
            fetch(`?inspect=${id}`)
                .then(r => {
                    return r.text()
                })
                .then(a => {
                    idData = JSON.parse(a);
                    var out = '';
                    for (let a in idData) {
                        out += `${a}: ${idData[a]}<br>\n`;
                    }
                    document.getElementById("current").innerHTML = out;
                });
        }

        function showresults() {
            var matchcounter = 0;
            var filter = document.getElementById("filter").value;
            var re = new RegExp(filter, 'ig');
            for (let a of document.getElementsByClassName("bts")) {
                if (a.title.match(re)) {
                    a.style.display = "block";
                    matchcounter++;
                } else {
                    a.style.display = "none";
                }
            }
        }
    </script>
</body>

</html>