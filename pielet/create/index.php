<?php
header("Location: /");
exit;
extract($_GET);
extract($_POST);

if ($test) {
    echo "<pre>Cookies:\n";
    print_r($_COOKIE);
    $userID = $_COOKIE['userID'];
    $pieletDataJSON = @file_get_contents("../ids/$userID.json.txt");
    $master = json_decode($pieletDataJSON, true);
    echo "\n\npieletDataJSON:\n";
    print_r($master);
    exit;
}

if ($payload) {
    $masterJSON = base64_decode($payload);
    $master = json_decode($masterJSON, true);
    $uid = $master['userID'];
    file_put_contents("../ids/$uid.json.txt", $masterJSON);
    header('Content-Type: image/gif');
    echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
    exit;
}

if ($email && $newpassword && $userID) {
    $ebase = file_get_contents("../email-table.json");
    if (preg_match('/' . $email . '/ism', $ebase)) {
        exit("That email is already in use. <a href='../login.php'>Please login</a>.");
    }
    $salt = getrandom(65);
    $hash = trim($newpassword) . $salt;
    $hash = hash('whirlpool', $hash);
    $master = json_decode(file_get_contents("../ids/$userID.json.txt"), true);
    $master[salt] = $salt;
    $master[hash] = $hash;
    $master[email] = trim($email);
    $master[userID] = trim($userID);
    $masterJSON = json_encode($master);
    $account = $master[account];
    file_put_contents("../ids/$userID.json.txt", $masterJSON);
    exit("<html><body>Your account has been created.<script>\n

    document.cookie = `userID=$userID; expires=31 Dec 2040 12:00:00 UTC; path=/`;\n
    document.cookie = `account=$account; expires=31 Dec 2040 12:00:00 UTC; path=/`;\n
    localStorage.pieletDataJSON = `$masterJSON`;\n
    var pieletData = $masterJSON;\n
    location.assign(`https://pietential.com/pielet/dashboard`);\n
    
    </script>
    </body>
    </html>");
}
function getrandom($n)
{
    $g = str_split("abcdefgqyzxw1234567890!@#$%^&*ABCDEFGHJKLOIUYTREW");
    $v = 0;
    $r = "";
    while ($v < $n) {
        shuffle($g);
        $r .= $g[0];
        $v++;
    }
    return ($r);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="manifest" href="pietential.webmanifest">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/styles.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="/icon.png">
    <title>Pietential - Growth Potential Visualization Survey</title>


    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="https://pietential.com/social.php">
    <meta name="twitter:creator" content="@hankenstein">
    <meta name="twitter:title" content="Realize Your Growth Potential in 5 Minutes">
    <meta name="twitter:description" content="Pietential is a survey-based life balance visualization tool based on Maslow’s Hierarchy of needs.">
    <meta name="twitter:image" content="http://pietential.com/pie-social-banner.png">
    <meta property="og:url" content="https://pietential.com/social.php" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Realize Your Growth Potential in 5 Minutes" />
    <meta property="og:description" content="Pietential is a survey-based life balance visualization tool based on Maslow’s Hierarchy of needs." />
    <meta property="og:image" content="http://pietential.com/pie-social-banner.png" />


</head>
<link rel="stylesheet" href="https://d1azc1qln24ryf.cloudfront.net/114779/Socicon/style-cf.css?u8vidh">

<script>
var pieletData = JSON.parse(localStorage.pieletDataJSON);
// if(pieletData.ghost.length>1){
//         location.assign(`/pielet/visualizeit/`);
//     }
    </script>

<style>
    input {
        max-width: 200px;
    }

    .bt {
        font-family: 'Roboto Slab', sans-serif;
    }

    form {
        border: 0;
        background-color: #377dd4;
        border-radius: 4px;
        width: 380px;
        margin: auto;
    }
</style>
<!-- libar -->
<?php
$userID = $_COOKIE['userID'];
echo file_get_contents("https://pietential.com/pielet/generate-login-bar.php?userID=$userID");
?>

<div style="max-width:800px; padding:20px;text-align:center;margin:auto;">
    <div style="margin:auto;">
        <b id="realizebutton" onclick="//" style="font-size:30px; padding:1% 8%;padding-top: 13px;
            margin-top: 20px;">Realize Your Pietential</b>

        <BR><BR>
        <h3>Members can login anytime and retake the survey, and track their growth progress.<br><a href="#membership">Membership is Free</a>. </h3>
    </div></div>
    <!--<b style="font-size:30px; padding:1% 8%;padding-top: 13px;
            margin-top: 20px;z-index:5;position: relative;">What Does Membership Include?</b>--><br><img src="sample.png" style="width:100%; z-index: 0;" alt="">
    <BR>
    <div id="membership" style="margin:auto; max-width: 800px; text-align: center;">
    <h3>Become a Member:</h3>
    <form action="" method="POST">
        <br>
        <input placeholder="Enter your email address:" type="email" id="email" title="An activation code may be mailed to this address" name="email"><br>
        <input placeholder="Choose a password:" type="password" id="newpassword" name="newpassword"><br>
        <input id="userID" value="" name="userID" type="hidden">
        <input value="submit" type="submit"><br>
    </form><br>
    <a href="../login.php">I have an account</a>
    <img src="https://pietential.com/pielet/create-email-table.php?img=1">
    <img src="https://pietential.com/pielet/list.php?img=1">
    </div>




<div id="pieletFooter"></div>

<script>
    pieletFooter.innerHTML = localStorage.pieletFooter;


    var pieletData = JSON.parse(localStorage.pieletDataJSON);
    userID.value = pieletData.userID;

    // if(pieletData.ghost.length>1){
    //     location.href(`/visualizeit/`);
    // }

    navigator.geolocation.getCurrentPosition(showPosition);

    function showPosition(position) {
        pieletData.geolocationLong = Math.floor(position.coords.longitude * 100) / 100;
        pieletData.geolocationLat = Math.floor(position.coords.latitude * 100) / 100;
        localStorage.pieletDataJSON = JSON.stringify(pieletData);
        document.body.innerHTML += `<img src="?payload=${btoa(localStorage.pieletDataJSON)}">`;

    }




    if (pieletData.hash) {
        location.assign(`https://pietential.com/pielet/dashboard/`);
    }
</script>