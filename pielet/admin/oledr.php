<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width='device-width', initial-scale=1.0">
    <title>Users who have created an account</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">
    <link href="https://pietential.com/pielet/styles.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="branding" style="margin: auto; text-align: center; display: block;">
        <img onmouseover="" src="https://pietential.com/pietential.png" style="width: 90%;max-width: 500px;margin-bottom:10px;margin: auto;">
    </div>

    <div style="margin: auto; max-width:800px; display: block;">
    <div id="focusIt" style="margin: auto; max-width:800px; display: block;">

    </div>

        <?php
        extract($_GET);
        extract($_POST);
        

        $j = file_get_contents("../ids/all.json");
        $master = json_decode($j, true);
        //print_r($master);

        foreach ($master as $key => $value) {
            if ($value['email']) {
                //print_r($value);
                $uid = $value['userID'];
                $joinDate = $value['joinDate'];
                $email = $value['email'];
                if (!$joinDate) {
                    $joinDate = $value['timestamp'];
                }
                if (!$joinDate) {
                    continue;
                }
                $arr[] = "$joinDate;$uid;$email";
                //echo "<a href='?inspect=$uid'>$email</a> Join Date: $joinDate<br>";
            }
        }
        rsort($arr);
        foreach ($arr as $_) {
            $g = explode(";", $_);
            $uid = $g[1];
            $joinDate = $g[0];
            $email = $g[2];
            $rawData = file_get_contents("../ids/$uid.json.txt");
            $rawDataDisplay = print_r(json_decode($rawData, true), true);
            echo "
            <div id='rawDataDisplay$uid' style='margin: auto; max-width:800px; display: none;'>
<pre>
$rawDataDisplay
</pre>
    </div>
            
            <a onmouseout='hideInfo(`$uid`)' onmouseover='showInfo(`$uid`)' onclick='focusMe(`rawDataDisplay$uid`);window.scrollTop (0);' href='javascript://'>$email</a> 
        Join Date: $joinDate<br>
        <div id='$uid' style='display: none; position: absolute; width:500px; height:auto;padding:12px; background:white;font-size:11px;border: 1px solid gray;word-wrap: break-word;'>$rawData</div>";
        }


        echo "<div style='display:none;' id='json'>$j</div>";
        echo "<img src='https://pietential.com/pielet/ids/make-all.php' style='width:1px;'>";

        ?>

    </div>
    <script>
        function showInfo(id) {
            document.getElementById(id).style.display = "inline-block";
        }

        function hideInfo(id) {
            document.getElementById(id).style.display = "none";
        }
        function focusMe(id) {
            document.getElementById('focusIt').style.display = "block";
            document.getElementById('focusIt').innerHTML = document.getElementById(id).innerHTML;
            document.getElementById('focusIt').scrollIntoView({
        behavior: 'smooth'
    });
        }
       
    </script>

</body>

</html>