<?php
extract($_GET);
extract($_POST);


if ($getInfo){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    echo json_encode($_COOKIE);
    exit;
}
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
fetch("?getInfo=hello")
    .then(r => {
        return r.text()
    })
    .then(a => {
        console.log(`server responed: ${a}`);
        var d = JSON.parse(a);
        var out = "";
        for (let c in d){
            out += `${c}: ${d[c]}<br>`;
        }
        document.body.innerHTML += out;
    });
    </script>
</body>
</html>