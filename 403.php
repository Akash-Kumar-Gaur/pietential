<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/pielet/styles.css" rel="stylesheet" type="text/css">
    <link rel="preload" href="/pielet/survey/pielon.js" crossorigin="anonymous" as="script">
    <title>403</title>
</head>

<body>

<script>
    location.assign("/");
</script>




<section id="navi"></section>
    <script type="text/javascript" src="/navigation/topNav.js"></script>





    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&amp;display=swap" rel="stylesheet">
    <div style="margin:auto; max-width:90%; text-align:center">

        <section id="brandi">
            <div id="branding" style="padding-top:50px;margin: auto; text-align: center;">
                <a href="/"><img onmouseover="" src="/pietential.png" class="minibrand"></a>
            </div>
        </section>

        <h1 style="text-align: center;">Pietential™</h1>

        <h2>403</h2>
        <p>This URL is not valid.</p>

    </div>




    <div id="scaz" style="display:none"></div>

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