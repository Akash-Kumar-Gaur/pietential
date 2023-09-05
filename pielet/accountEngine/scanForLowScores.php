<?php
extract($_GET);
extract($_POST);
error_reporting(E_ALL);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
$j = file_get_contents("../ids/all.json");
$master = json_decode($j, true);
echo "<pre>";
echo count($master);
echo "\n\n";
$l = 60;
$targetPartner = "organic";
foreach ($master as $k => $v) {
    extract($v);
    if ($PN && $SA && $EC && $LB && $SN && $userID) {
        if ($partnerID == $targetPartner) {
            if ($SA < $l || $EC < $l || $LB < $l || $SN < $l || $PN < $l) {
                echo "$userID: $SA,$EC,$LB,$SN,$PN\n";
            }
        }
    }
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
<style>
        table, tr, td{
            font-family: sans-serif;
            padding:8px;
            border:1px solid #eee;
            border-collapse: collapse;
        }
        tr:nth-child(even){
            background: #eee;
        }
    </style>
<body>
    <script>
        var master = <?php echo $j; ?>;
        var f = [];
        var s = [];
        for (let a of master) {
            if (a.joinDate) {
                var obj = {};
                obj.time  = a.joinDate;
                obj.data = a;
                f.push(a.joinDate+";"+a.userID);
                s.push(obj);
            }
        }
        f.sort();
        var g = [];
        for (let a of f){
            for (let b of master){
                if (a.replace(/;.+/ig, "") == b.joinDate){
                    g.push(b);
                }
            }
        }




        s.sort();
        var out ='';
        for (let a of g){
            var sc = (a.SA+a.EC+a.LB+a.SN+a.PN)/5;
            sc = Math.ceil(sc);
            out+="<tr>";
            out+= `]]${a.joinDate};${a.userID};${a.email};${a.fname};${a.lname};${sc}[[`;
            out+="</tr>";
        }
        out = out.replace(/;/ig, "</td><td>");
        out = out.replace(/\]\]/ig, "<td>");
        out = out.replace(/\[\[/ig, "</td>");
        document.body.innerHTML += `<table>${out}</table>`;
    </script>
    
</body>

</html>