<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');


if ($g) {
    $K = glob("../pielet/ids/*.json.txt");
    foreach ($K as $_) {
        $we[] = filemtime($_) . $_;
    }
    rsort($we);
    foreach ($we as $_) {
        $modtime = substr($_, 0, 10);
        $obj['modtime'] = $modtime;
        $obj['path'] = str_replace($modtime, '', $_);
        $master[] = $obj;
    }
    exit(json_encode($master));
}
if ($i) {
    exit(file_get_contents($i));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>latest users</title>
</head>

<body>
<div id="ins"></div>
    <div id="results"></div>
    <script>
        if (!sessionStorage.j) {
            fetch("?g=1")
                .then(r => {
                    return r.text()
                })
                .then(a => {
                    sessionStorage.j = a;
                    list();
                });
        } else {
            list();
        }


        function update(){
            var k = localStorage.pieletDataJSON;
            k = btoa(k);
            fetch("?i="+id)
                .then(r => {
                    return r.text()
                })
                .then(a => {
                    //ins.innerHTML = a;
                    var user = JSON.parse(a);
                    document.getElementById(id).innerHTML = user.email;
                    document.getElementById(id).outerHTML += `<br>${a}<br>`;
                });
        }



        function inspect(id){
            fetch("?i="+id)
                .then(r => {
                    return r.text()
                })
                .then(a => {
                    //ins.innerHTML = a;
                    var user = JSON.parse(a);
                    document.getElementById(id).innerHTML = user.email;
                    document.getElementById(id).outerHTML += `<br>${a}<br>`;
                });
        }

        function convertToEmail(id){
            if(document.getElementById(id).innerHTML.match(/\@/)){
                return;
            }
            fetch("?i="+id)
                .then(r => {
                    return r.text()
                })
                .then(a => {
                    var user = JSON.parse(a);
                    document.getElementById(id).innerHTML = user.email;
                });
        }

        function list() {
            var out = '';
            var i = 0;
            window.j = JSON.parse(sessionStorage.j);
            for (let a of j) {
                var n = a.path.replace(/[\s\S]+\//ig,'').replace(".json.txt", '');
                out += `<div><button  id="${a.path}" onclick="inspect('${a.path}')">${n}</button></div>`;
                i++;
                if (i > 300) {
                    break;
                }
            }
            results.innerHTML = out;
        }
    </script>
</body>

</html>