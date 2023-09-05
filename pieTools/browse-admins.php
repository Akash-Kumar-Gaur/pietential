<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
$loc = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if ($run77){
    // https://pietential.com/pieTools/browse-users.php?run77=hello
    setcookie('run77', "hkejufhruvguy", time() + 7776000, "/"); //90 days
    ?>

<script>
    location.assign(`?loc=${location.href}`);
</script>


<?php
    
    exit($loc);
}


if (!$_COOKIE['run77']) {
    echo '<script>    location.assign(`/?n7`); </script>';
    exit();
}


?>



<!DOCTYPE html>
<html lang="en">








<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pietential admin tools</title>
    <link href="/pielet/styles.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    $out = '';
    $h = 0;
    $j = file_get_contents("../pielet/ids/all.json");
    $ma = json_decode($j, true);
    $admins = $ma['admins'];
    $k = json_encode($admins);
    echo "<script>var admins = $k; </script>";



    ?>
    <style>
        .hide {
            font-size: 13px;
        }

        textarea {
            width: 700px;
            height: 250px;
            padding: 10px;
            margin: 10px;
        }

        input {
            width: 220px
        }
    </style>
    <div id="stats"></div>
    <input type="text" id="filter" placeholder="Quick search" name="gh" onkeyup="search()">
    <input type="text" id="deep" placeholder="Deep search" name="gh">
    <button onclick="scan()">deep scan</button>
    <button onclick="downloadCSV()">downloadCSV</button>
    <button onclick="location.assign(`?refresh=787`)">refresh database</button>
    <button onclick="sortDate()">sortDate</button>
    <button onclick="sortDateReverse()">sortDateReverse</button>
    <div id="scanner"></div>
    <div id="draw"></div>
    <div id="slaw"></div>
    <script>
        
        stats.innerHTML = `Admins: ${admins.length}`;
        
        function buildFromArray(array, limit) {
            var out = '';
            var i = 0;
            for (let a of array) {
                
                out += `<div id="${a.email}" class="hide ${a.adminID}">
                        ${i}: ${a.joinDate} 
                       <span onclick="inspect('${a.adminID}')">
                       <button>${a.email}</button>
                       </span>
                    </div>`;
                i++;
                if (i > limit) {
                    break;
                }
            }
            slaw.innerHTML = out;
        }

        function downloadCSV(){
            var out = '';
            var tcr = `email,purchaseCode,promoCode,fname,lname,phone,title,website,userID,joinDate,businessCategories,percent,currentPart`.split(",");
            for (let a of m.users){
                for (let b of tcr){
                    try{
                    out+= a[b]+",";
                    } catch {
                        out+= "nodata,";
                    }
                }
                out+="\n";
            }
           
            var h = [];
            h[0] = out;
            var myBlob = new Blob(h, { type: 'text/html' });
            var blobUrl = URL.createObjectURL(myBlob);
            var link = document.createElement("a");
            link.href = blobUrl;
            link.download = "download.csv";
            link.innerHTML = "<button>Download " + link.download + "</button>";
            link.click();

        }

        function sortDate() {
            admins.sort((a, b) => (a.joinDate > b.joinDate) ? 1 : -1);
            buildFromArray(admins, 200);
        }

        function sortDateReverse() {
            buildFromArray(admins.reverse(), 200);
        }

        function search() {
            var s = document.getElementById("filter").value;
            console.log(`searching for ${s}`);
            var re = new RegExp(s, 'ig');
            for (let a of document.getElementsByClassName("hide")) {
                if (a.id.match(re)) {
                    a.style.display = "block";
                } else {
                    a.style.display = "none";
                }
            }
        }

        function scan() {
            scanner.innerHTML = '';
            var allIds = [];
            var s = document.getElementById("deep").value;
            var re = new RegExp(s, 'ig');

            for (let a of admins) {
                allIds.push(`${a.adminID};${JSON.stringify(a)}`);
            }
            for (let a of allIds) {
                if (a.match(re)) {
                    var uid = a.split(";")[0];
                    var user = JSON.parse(a.split(";")[1]);
                    scanner.innerHTML += `<button style="background:#1988e1; border:0; color:white;padding 10px" class="${user.adminID}" onclick="inspect('${user.adminID}')">${user.email}</button><br>`;
                }
            }
        }

        function inspect(id) {
            for (let a of document.getElementsByClassName("terry")) {
                a.style.display = "none";
            }
            for (let a of admins) {
                if (a.adminID == id){
                    var out = '';
                    for (let r in a){
                        out += `<tr><td>${r}</td><td>${a[r]}</td></tr>\n`;
                    }
                    document.getElementsByClassName(id)[0].outerHTML += `<div class="terry"><br><table >${out}</table></div>`;
                }
            }
            
        }

        sortDateReverse();


        if (location.href.match(/scan/ig)) {
            var scanTag = location.href.replace(/[\s\S]+=/ig, "");
            document.getElementById("deep").value = scanTag;
            scan();
        }
    </script>


</body>

</html>