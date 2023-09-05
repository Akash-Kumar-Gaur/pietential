<?php
header("Location: /");
exit;
extract($_GET);
extract($_POST);
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: text/plain; charset=utf-8");
$domain = $_SERVER['HTTP_HOST'];
$filepath = $_SERVER['SCRIPT_NAME'];
$lastslash = strrpos($filepath, "/");
$path = substr($filepath, 0, $lastslash);
$hi = "http://" . $domain . $path . "/";
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d');
//$_ = file_get_contents("codesIV.txt");
//$_ = str_replace("\r\n", "\n", $_);
//$codes = explode("\n", $_);
//echo "You are not logged in as a coach. Please contact us at 703-291-1590 if you think this is in error.";
if ($ghost) {
    // need a way to return to latest
    // when in ghost mode
    // visualizeit/?returnView=1
    $j = file_get_contents("../ids/$ghost.json.txt");
    $master = json_decode($j, true);
    $master['ghostMode'] = 1;
    $master['ghost'] = $ghost;
    $j = json_encode($master);
    setcookie('userID', $ghost, time() + 7776000, "/"); //90 days
    setcookie('partnerID', $master['partnerID'], time() + 7776000, "/"); //90 days 
    $script = "
<script>
localStorage.pieletDataJSON = `$j`;
location.href = `/pielet/?userID=$ghost&ghost=$ghost`</script>";
    echo "<html><body>$script</body></html>";
    //echo "$ghost - $j";
    //GOKXbRd3UZ0u
    exit;
}
if ($rebuild) {
    $_ = glob("../ids/*");
    foreach ($_ as $key) {
        $ma = file_get_contents($key);
        $ma = json_decode($ma, true);
        $master[] = $ma;
    }
    file_put_contents("all.json.txt", json_encode($master));
    header('Content-Type: image/gif');
    echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
    exit;
}
if ($y) {

    $master = json_decode(file_get_contents("all.json.txt"), true);
    foreach ($master as $key => $value) {
        $counter++;
        $email = $value["email"];
        $userID = $value["userID"];
        $userIDuser = $value["userID"]."user".$email;
        $out .= "
<div style='padding:10px;margin:12px; border:1px solid silver; border-radius:6px;' id='$userIDuser' class='resultList'>
<a style='padding:12px; background:#2188b9; border-radius:6px;display:inline-block;color:white;text-decoration:none;margin:10px;' href='?ghost=$userID'>Ghost user $userID <span style='color:silver'> #$counter </span></a> Users email (if supplied): $email
</div>
";


    }
    $searchBar = ' <div><input type="text" id="filter" placeholder="Start typing any name or email" onkeyup="showresults();"><br><br></div>
    <div id="filterButton"></div>';
    $out .= "<img src='?rebuild=1'>";
    $out = $searchBar . $out;
    $_ = file_get_contents("shell.html");
    $_ = str_replace("{{content}}", $out, $_);
    $_ = str_replace("{{title}}", "Ghost mode", $_);
    $_ = str_replace("{{headline}}", "Your Clients:", $_);
    exit($_);
}
function gr()
{
    $x = "";
    $i = 0;
    $pl = "";
    $s = "1234567890abcdefghijklmnopqwertyMNBVCFGHJKLPOIUYYTREEWQ";
    $y = str_split($s);
    shuffle($y);
    while ($i < 12) {
        $pl .= $y[$i];
        $i++;
    }
    return $pl;
}
if ($fname) {
    $j['hash'] = hash('whirlpool', $password);
    $password = "";
    $j['adminID'] = gr();
    $j['fname'] = $fname;
    $j['lname'] = $lname;
    $j['partnerID'] = $partnerID;
    $j['email'] = $email;
    $_ = json_encode($j);
    //file_put_contents("$adminID.admin.json.txt", $_)
    echo ($_);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Coaches</title>
</head>
<style>
    div {
        font-size: 23px;
    }

    .col2 {
        width: 48%;
        float: left;
        text-align: left;
        margin: 12px;
    }
</style>

<body>
    <div class="pie" id="pieCloud" style="margin-bottom:90px;">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">
        <link href="https://pietential.com/pielet/styles.css" rel="stylesheet" type="text/css">
        <link href="https://pietential.com/pielet/styles.css" rel="stylesheet" type="text/css">
        <div id="minibranding" style="padding-top:50px;margin: auto; text-align: center; display:none;">
            <a href="#"><img onmouseover="" src="https://pietential.com/pietential.png" class="minibrand"></a>
        </div>
        <div id="branding" style="margin: auto; text-align: center; display: block;">





            
            <img onmouseover="" src="https://pietential.com/pietential.png" style="width: 90%;max-width: 500px;margin-bottom:10px;margin: auto;">
            <h1>Welcome to Pietential</h1>
            <section style="max-width:1000px; margin:auto">
                <div style="margin:0px;max-width: 900px;text-align: center;margin: auto;">
                    <div id="abstract" style="text-align: left; box-sizing:border-box">
                        <p style="margin-top:6px;">You have been selected to create a no cost coach account that helps your clients realize thier potential.</p>
                    </div>
                    <div style="margin:auto;">
                        <form action="" method="POST">
                            <h2>Create credentials for your account:</h2>
                            <input required placeholder="Enter your first name:" type="text" id="fname" name="fname"><br>
                            <input required placeholder="Enter your last name:" type="text" id="lname" name="lname"><br>
                            <input placeholder="Enter your email address:" type="email" id="email" name="email" required><br>
                            <input required placeholder="Enter your password:" type="password" id="password" name="password"><br>
                            <input required placeholder="Enter your partner ID:" type="text" id="partnerID" name="partnerID"><br>
                            <span style="font-size:13px;">Your partner ID should be a short, yet descriptive set of characters without spaces or unusual characters, and cannot start with a number. <br>
                                Examples: AjaxConsulting, BillSmithCoach, CoachJohnS, wisdomGroup, NextLevelLLC, BrainStorm.</span><br>
                            <input value="submit" type="submit"><br>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>