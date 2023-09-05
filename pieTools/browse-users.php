<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
$loc = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if ($run77){
    // https://pietential.com/pieTools/browse-users.php?run77=hello
    setcookie('run77', "hkejufhruvguy", time() + 7776000, "/"); //90 days
    exit("<a href='?all-set'>Continue</a>");
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
    echo "<script>sessionStorage.userBase = `$j`; </script>";



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
    <button onclick="scan()">scan</button>
    <button onclick="downloadCSV()">downloadCSV</button>
    <button onclick="location.assign(`?refresh=787`)">refresh database</button>
    <button onclick="sortDate()">sortDate</button>
    <button onclick="sortDateReverse()">sortDateReverse</button>
    <div id="scanner"></div>
    <div id="draw"></div>
    <div id="slaw"></div>
    <script>
        var m = JSON.parse(sessionStorage.userBase);
        var numusers = m.users.length;
        var numadmins = m.admins.length;
        stats.innerHTML = `Users: ${numusers} Admins: ${numadmins}`;
        var userArray = {};
        for (let a of m.users) {
            userArray[a.userID] = a;
        }



        function buildFromArray(array, limit) {
            var out = '';
            var i = 0;
            for (let a of array) {
                var email = a.split(";")[2];
                var userID = a.split(";")[1];
                var joinDate = a.split(";")[0];
                out += `<tr><td><div id="${email}" class="hide ${userID}">
                        ${i}: ${joinDate}  </div></td>
<td>
                       <span onclick="inspect('${userID}')">
                       <button>${email}</button>
                       </span>
</td></tr>
                   `;
                i++;
                if (i > limit) {
                    break;
                }
            }
            slaw.innerHTML = `<table>${out}</table>`;
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
            var dateSortedUsers = [];
            for (let a of m.users) {
                if (!a.joinDate) {
                    a.joinDate = "2019-01-01--01-01-01";
                }
                dateSortedUsers.push(a.joinDate + ";" + a.userID + ";" + a.email);
            }
            dateSortedUsers.sort().reverse();
            sessionStorage.dateSortedUsers = JSON.stringify(dateSortedUsers);
            buildFromArray(dateSortedUsers, 200);
        }

        function sortDateReverse() {
            var dateSortedUsers = JSON.parse(sessionStorage.dateSortedUsers);
            dateSortedUsers.reverse();
            buildFromArray(dateSortedUsers, 200);
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
            for (let a of m.users) {
                allIds.push(`${a.userID};${JSON.stringify(a)}`);
            }
            for (let a of m.admins) {
                allIds.push(`${a.userID};${JSON.stringify(a)}`);
            }
            for (let a of allIds) {
                if (a.match(re)) {
                    var uid = a.split(";")[0];
                    var user = JSON.parse(a.split(";")[1]);
                    scanner.innerHTML += `<button style="background:#1988e1; border:0; color:white;padding 10px" class="${user.userID}" onclick="inspect('${user.userID}')">${user.email}</button><br>`;
                }
            }
        }

        function inspect(id) {
            for (let a of document.getElementsByClassName("terry")) {
                a.style.display = "none";
            }
            document.getElementsByClassName(id)[0].outerHTML += `<div class="terry"><br><textarea >${JSON.stringify(userArray[id])}</textarea></div>`;
        }

        sortDate();


        if (location.href.match(/scan/ig)) {
            var scanTag = location.href.replace(/[\s\S]+=/ig, "");
            document.getElementById("deep").value = scanTag;
            scan();
        }
    </script>


</body>

</html>