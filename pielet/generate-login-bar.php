<?php
extract($_GET);
extract($_POST);
//generate-login-bar.php
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: text/plain; charset=utf-8");
//$fullURL = "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// https://pietential.com/pielet/generate-login-bar.php?userID=aMwt3sGEbPrm
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d');
if (!$userID) {
    $_ = file_get_contents("generic-nav.html");
        exit($_);
}
file_put_contents("../styles.css", file_get_contents("styles.css"));
$paydirt = @file_get_contents("ids/$userID.json.txt");
if (!$paydirt) {
    //exit("No userdata supplied for generate-login-bar.php");
} else {
    $master = json_decode($paydirt, true);
    $pl = print_r($master, true);
    echo "<!--\n\n $pl \n\n-->";
}
if (!$master['hash'] && preg_match('/visualizeit/', $fullURL)) {
   // exit("<!-- visualizeit but no hash -->\n\n");
}
if (!$master['email']) {
    $email = ' Not yet a member! ';
    $email = ' ';
} else {
    $email = $master['email'];
}
if (!$master['hash']) {
    $loginBar = ' <a class="bt generate-login-bar" href="/pielet/create/">Become a member</a> </span> ';
    $loginBar = ' ';
} else {
    $loginBar = ' <a class="bt generate-login-bar red" href="/?logout">Logout</a> </span> ';
}
$returnLink = '<a id="returnLink" class="bt generate-login-bar" href="/pielet/visualizeit/?returnView=1">Return to latest visualization</a>';
?>
<!-- begin generate-login-bar.php userID:  <?php echo $userID ?>-- -->
<link href="/pielet/styles.css" rel="stylesheet" type="text/css">

<div id="desktopnav">
    <div id="libar" class="libar" style="background:white;box-sizing: border-box;position:fixed;top:0px;padding: 12px 27px; text-align:right;margin-right:20px;"><span id="emailHolder" style="text-align:left;position: absolute;left: 5px;top:20px;font-size:15px;"> <?php echo $email; ?>
            <?php echo $loginBar; ?>
            <a id="gotodash" class="bt login-bar" href="/pielet/dashboard/?userID=<?php echo $userID; ?>">Dashboard</a>
            <?php echo $returnLink; ?>
            <a id="printResults" class="bt login-bar" href="../pdf.php?genHTML=<?php echo $userID; ?>" target="_blank">Download Analysis</a>
            <a id="retakeLink" class="bt login-bar" href="/pielet/retake/">Retake and track your progress</a>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            if (location.href.match(/visualizeit/)) {
                returnLink.style.display = "none";
                //returnLink.href = "/pielet/dashboard/";
                // returnLink.innerHTML = "Go to dashboard";
            }
            if (!pieletData.hash) {
                retakeLink.style.display = "none";
            }
            if (location.href.match(/analyzeit/) && !pieletData.hash) {
                emailHolder.style.position = "";
            }
            if (location.href.match(/pielet\/create/) && !pieletData.hash) {
                libar.style.display = "none";
            }
        });

        function showid(id) {

            if (navbutton.innerHTML.match(/Close/)) {
                document.getElementById(id).style.display = "none";
                navbutton.innerHTML = " ☰ Navigate  ";
            } else {
                document.getElementById(id).style.display = "block";
                navbutton.innerHTML = "☰ Close nav bar   ";
            }
        }
    </script>

</div>

<div id="navbarmobile">
    <div style="padding:8px; background-color:#007ec4;" class="mnd"><a id="navbutton" href="javascript://" onclick="showid('navbarmobileinner')" style="color:white; text-decoration:none;">☰ Navigate  </a></div>
    <div id="navbarmobileinner" style="display:none;">

        <div style="padding:8px; background-color:#007ec4; ;" class="mnd"><a href="/pielet/dashboard" style="color:white; text-decoration:none;">Dashboard</a></div>
        <div style="padding:8px; background-color:#007ec4; ;" class="mnd"><a href="/pielet/visualizeit" style="color:white; text-decoration:none;">Latest Visualization</a></div>
        <div style="padding:8px; background-color:#007ec4;" class="mnd"><a href="/pielet/pdf.php?genHTML=<?php echo $userID; ?>" style="color:white; text-decoration:none;">Download Analysis</a></div>
        <div style="padding:8px; background-color:#007ec4;" class="mnd"><a href="/pielet/retake" style="color:white; text-decoration:none;">Retake and Track Progress</a></div>
        <div style="padding:8px; background-color:#007ec4; " class="mnd"><a href="/?logout" style="color:white; text-decoration:none;">Logout</a></div>
        <div style="padding:8px; background-color:#007ec4;" class="mnd"><a href="javascript://" onclick="showid('navbarmobileinner')" style="color:white; text-decoration:none;"> ☰ Close nav bar   </a></div>
    </div>
</div>







<!-- END generate-login-bar.php -->