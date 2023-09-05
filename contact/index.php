<?php
extract($_GET);
extract($_POST);
//error_reporting(E_ALL);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
if ($_POST['Q2email']) {
    if (!$_COOKIE['cform']){
        exit;
    }
    foreach ($_POST as $k => $v) {
        if (preg_match('/\{/', $v)) {
            exit;
        }
        if (preg_match('/script|php/ig', $v)) {
            exit;
        }
        if (strlen($v) > 500) {
            exit;
        }
        file_put_contents("responses/$timestamp.json", json_encode($_POST));
        exit("Thanks for your feedback.");
    }
}





?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/pielet/styles.css" rel="stylesheet" type="text/css">
    <link rel="preload" href="/pielet/survey/pielon.js" crossorigin="anonymous" as="script">
    <title>Contact</title>
</head>

<body>
<section id="navi"></section>
<script type="text/javascript" src="/navigation/topNav.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&amp;display=swap" rel="stylesheet">
    <div style="margin:auto; max-width:90%; text-align:center">

        <section id="brandi">
            <div id="branding" style="padding-top:50px;margin: auto; text-align: center;">
                <a href="/"><img onmouseover="" src="https://pietential.com/pietential.png" class="minibrand"></a>
            </div>
        </section>

        <h1 style="text-align: center;">Pietential™</h1>
        <div style="margin:auto; max-width:900px; text-align:left">
            <h2 style="text-align: center;">Contact Us</h2>
            <form enctype="multipart/form-data" action="" method="post">

                Full Name*<br>
                <input type="text" maxlength="100" required id="Q1fullName" name="Q1fullName" style="margin-bottom:10px;"><br>

                Email*<br>
                <input type="email" maxlength="100" id="Q2email" required name="Q2email" style="margin-bottom:10px;"><br>

                Message*<br>
                <textarea id="Q3message" maxlength="900" style="width: 90%; margin-bottom:10px;" required name="Q3message"></textarea><br>

                Report a bug? (optional)<br>
                <textarea id="Reportabug" maxlength="900" style="width: 90%; margin-bottom:10px;" required name="Reportabug"></textarea><br>

                <input type="submit" style="margin-bottom:10px;">
            </form>
        </div>
    </div>

    <script type="text/javascript" src="/navigation/bottomNav.js"></script>


    <div id="scaz" style="display:none"></div>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-K3VEYCTX6E"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-K3VEYCTX6E');
</script>
    <script id="cacheSurvey">
        fetch(`/pielet/survey/htm.html`)
            .then(r => {
                return r.text()
            })
            .then(a => {
                document.getElementById("scaz").innerHTML = a;
                console.log(`loaded htm.html`);
            });
    </script>
</body>

</html>