<?php
extract($_GET);
extract($_POST);
$html = file_get_contents("shell.html");
$html = str_replace("{{social}}", file_get_contents("../../social-cards.php"), $html);
if (!$userID) {
    $userID = $_COOKIE['userID'];
}
if (!$_COOKIE['userID']) {
    // header("Location: /?user-not-supplied");
    // exit;
$c = "You will be able to share your progress after you complete the survey.";
    $html = str_replace("{{content}}", $c, $html);

exit ($html);
}

$c = '
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap"
  rel="stylesheet"
/>
<link rel="stylesheet" href="https://pietential.com/style/public.css" type="text/css" />
<link rel="stylesheet" href="https://pietential.com/style/responsive.css" type="text/css" />
<section id="social" style="margin-top: 100px; font-size: 15px; display: block;">
<div id="shareButtons" style="margin:auto;text-align:center;margin-top:30px;">
<!--
<a href="https://pietential.com/"><img src="https://pietential.com/pietential.png" style="width:200px;"></a><br><br>
-->
<div id="shareIntro" style="max-width: 1200px;
margin: auto;
box-sizing: border-box;
padding: 0px 0px 20px 0px;text-align:left;">
<h1 style="text-align:center;">Share your Pietential with your Friends!</h1>
It’s an authentic picture of how life is for you right now, and sharing yourself authentically gives your friends an opportunity to offer you advice, recommendations, moral support - and the chance to reach out and learn from you in areas of life where you’re crushing it!
<br><br>
If shared, only your “Pietential Growth Potential Visualizations” will appear. Pietential does not share your Pietential Analysis.</div>
<a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fpietential.com/pielet/share/{{userID}}&src=sdkpreparse" style="font-size: 11px; padding: 5px 8px; text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank"><img src="https://pietential.com/pielet/icons/social-1_logo-facebook.svg" class="smicon" style="width:100px;"><br> Share your chart on Facebook</a>
<a href="https://twitter.com/intent/tweet?text=I just got my Pietential visualization: https://pietential.com/pielet/share/{{userID}}" style="font-size: 11px; padding: 5px 8px; text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank"><img src="https://pietential.com/pielet/icons/social-1_logo-twitter.svg" class="smicon" style="width:100px;"><br>Share your chart on Twitter</a>
<a href="https://www.linkedin.com/shareArticle?mini=true&url=https://pietential.com/pielet/share/{{userID}}&title=I just got my Pietential visualization" style="font-size: 11px; padding: 5px 8px; text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank"><img src="https://pietential.com/pielet/icons/social-1_logo-linkedin.svg" class="smicon" style="width:100px;"><br> Share your chart on Linkedin</a>
<a href="https://www.pinterest.com/pin/create/link/?url=https%3A%2F%2Fpietential.com" style="font-size: 11px; ; padding: 5px 8px; text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank"><img src="https://pietential.com/pielet/icons/social-1_logo-pinterest.svg" class="smicon" style="width:100px;"><br> Share your chart on Pinterest</a>
<div style="margin-top:30px;">
<br>This is the URL you will be sharing:<br><a class="shareURL" style="word-break: break-all;" href="https://pietential.com/pielet/share/{{userID}}" target="_blank">https://pietential.com/pielet/share/{{userID}}</a>
</div>
</div>
<div style="padding: 12px; font-family: sans-serif;margin:auto;text-align:center;"><br>
OR...
<br><br>Copy and paste the following snippet:<br>
<div class="copybox" id="copybox"><strong id="container">I just got my Pietential visualization:<br>https://pietenti<br>al.com/pielet/share/{{userID}}<br>Get yours at https://pietential.com/</strong></div>
<div></div>
<div class="bt" style=" font-size: 20px;
padding: 1% 8%;
margin: 20px;
display: inline-block;
width: 200px;" onclick="location.assign(\'/pielet/dashboard\');">More Info
</div>
</div>
</section>';
$html = str_replace("{{content}}", $c, $html);
$html = str_replace("{{userID}}", $userID, $html);
echo $html;
