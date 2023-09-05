<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jget-staging.php</title>
    <link href="/pielet/styles.css" rel="stylesheet" type="text/css">
</head>

<body style="margin:160px;">
    <button onclick="location.assign(location.href.replace(/\?[\s\S]+/ig,'')+'?'+Date.now())">reload</button><br><br>


    <?php
    extract($_GET);
    extract($_POST);
    date_default_timezone_set('America/New_York');

    $OldarrayOfPaths = "pielet/dashboard/index.html
pielet/dashboard/buildpast.js
pielet/dashboard/snappy.html
";

    if ($arrayOfPaths) {
        $arrayOfPaths = preg_replace('/\s+/ism', "\n", $arrayOfPaths);
        $aj = trim($arrayOfPaths);
        $arrayOfPaths = explode("\n", trim($arrayOfPaths));
        foreach ($arrayOfPaths as $k) {
            $path = trim($k);
            if (file_exists($k)) {
                $code = file_get_contents(trim($k));
                //$code = preg_replace('/\s+/ism', " ", $code);
                $obj['path'] = trim($k);
                $obj['code'] = $code;
                $master[] = $obj;
            }
        }
        echo "";
        $_ = json_encode($master);
        $mini_ = substr($_, 0, 35);
    ?>
        <style>
            textarea {
                width: 500px;
                height: 400px;
            }
        </style>


        Server side response: <?php echo $mini_; ?> .....
        <br><br>
        <div id='bcount'></div>

        <script>
            localStorage.jgetPaths = `<?php echo $aj; ?>`;
            var payload = <?php echo $_; ?>;
            var payload64 = btoa(unescape(encodeURIComponent(JSON.stringify(payload))));
        </script>
        <br>
        <!--<button onclick='go()'>send payload to server</button><br>
    payload is now in js memory as an object.");-->

        <form id="f2" method="post" action="https://ikigro.silvercrayon.us/jget-expand.php">
            <input type="hidden" value="" id='pl9' name="payload64"><br>
            <input type="submit">
        </form>
        <script>
            pl9.value = payload64;
            document.getElementById("f2").submit();
            document.body.innerHTML = "Sending Data.......";
        </script>
    <?php
        exit;
    }
    ?>



    <form action="" id='f1' method="post">
        Files to upload:<br>
        <textarea name="arrayOfPaths" id="in" cols="30" rows="10"></textarea>
        <br><br><input type="submit" value="Submit" style="
    width: 105px;" onmouseover='saveHistory();'>
        <br>Previous used files:<br>
        <textarea name="" id="history" cols="30" rows="10"></textarea>
    </form>
    <br>


    <script>
        document.getElementById("history").value = localStorage.jgetHistory.trim();

        function saveHistory() {
            var list = document.getElementById("in").value.trim();
            list += "\n" + document.getElementById("history").value;
            var a = list.trim().replace(/\s+/ig, "\n").trim().split("\n").sort();
            console.log(a);
            a = Array.from(new Set(a));
            a.sort();
            var out = '';
            for (let c of a) {
                out += `${c}\n`;
            }
            localStorage.jgetHistory = out.trim();;
            localStorage.jgetPaths = document.getElementById("in").value.trim();
            document.getElementById("history").innerHTML = out.trim();
        }




        if (localStorage.jgetPaths) {
            document.getElementById("in").innerHTML = localStorage.jgetPaths;
        }

        try {
            var arr = document.getElementById("pl").innerHTML;
            var bytes = arr.length;
            arr = JSON.parse(arr);
            console.log(arr);
            document.getElementById("bcount").innerHTML = `${bytes} bytes.`;
        } catch (e) {}

        function go() {
            var p = JSON.stringify(payload);
            pl9.value = btoa(unescape(encodeURIComponent(p)));
            f2.style.display = "";
            f1.style.display = "none";
            history.style.display = "none";
        }

        var his = `404/index.html
about/index.html
advisor/index.html
blog/index.html
blog/sc-admin/index.html
blog/sc-admin/lib/index.html
business/index.html
changepassword/index.html
contact/index.html
dbconnect/index.html
faq/index.html
feedback/index.html
help/index.html
hr/index.html
images/index.html
index.html
login/index.html
navigation/index.html
onboard/index.html
pieTools/biobuild/index.html
pieTools/index.html
pielet/accountEngine/index.html
pielet/admin/adminlogin/index.html
pielet/admin/create/index.html
pielet/admin/index.html
pielet/analyzeit/index.html
pielet/becomeamember/index.html
pielet/calcEngine/index.html
pielet/coach/index.html
pielet/contact/index.html
pielet/create/index.html
pielet/dashboard/buildpast.js
pielet/dashboard/index.html
pielet/dashboard/snappy.html
pielet/download/index.html
pielet/icons/index.html
pielet/ids/index.html
pielet/index.html
pielet/invite/index.html
pielet/new-account/index.html
pielet/privacy/index.html
pielet/promocode/index.html
pielet/retake/index.html
pielet/share/index.html
pielet/shareMyChart/index.html
pielet/shell/index.html
pielet/survey/index.html
pielet/visualizeit/index.html
pielet/vote/index.html
pricing/index.html
pro/index.html
resetpassword/index.html
resources/index.html
settings/index.html
shell/index.html
slice/index.html
staff-bios.js
terms/index.html
unsubscribe/csv/index.html
unsubscribe/index.html
welcome/index.html`
    </script>
</body>

</html>