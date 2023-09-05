<?php
extract($_GET);
extract($_POST);

$dir = "/home/hankmitchell/pielet/";
$a = glob("$dir*");
$b = glob($dir."share/*");
$master = array_merge($a, $b);


$loc = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if ($name && !$payload) {
    $payload =  base64_encode(file_get_contents($name));
    $serverName = str_replace($dir, "", $name);
}


foreach ($master as $t) {
    $filename = str_replace($dir, "", $t);
    if (is_dir($t)) {
        continue;
    }
    $out .= "<a href='?name=$t' class='bt'>$filename</a><br>";
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://pietential.com/styles.css" rel="stylesheet" type="text/css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX File transfer</title>
</head>

<body style="padding: 50px; box-sizing:border-box;">
    <pre><div id="message"></div></pre>

    <script>
        var payload = `<?php echo $payload ?>`;
        var name = `<?php echo $serverName ?>`;
        var remoteURL = `https://pietential.com/pielet/update.php`;

        function sendUpdatePayload(name, payload, remoteURL) {

            var data = new FormData();
            data.append('payload', payload);
            data.append('name', name);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', remoteURL, true);
            xhr.onload = function() {
                console.log(this.responseText);
                payload2 = atob(payload);
                payload2 = payload2.replace(/</gi, "&lt;");
                document.getElementById("message").innerHTML = this.responseText;
                document.getElementById("message").innerHTML += `<pre><br>${name}:`;
                document.getElementById("message").innerHTML += `<br><br><div style="overflow-wrap: break-word;font-family:monospace;border:1px solid gray; padding:12px; border-radius:8px;background:#eee;font-size:12px;">${payload2}<br><br><span style="overflow-wrap: break-word;"></span></div>`;
                console.log(name);
            }
            xhr.send(data);
        }
        <?PHP if ($payload) {
            echo "sendUpdatePayload(name, payload, remoteURL);";
        }
        ?>
    </script>
    <div style="line-height:1.5em;">
        <?php echo $out; ?>
    </div>
</body>

</html>