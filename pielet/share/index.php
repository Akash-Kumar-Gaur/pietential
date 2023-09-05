<?php
extract($_GET);
extract($_POST);
if (!$userID) {
    header("Location: ../shareMyChart/");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pietential</title>
    <link href="/pielet/styles.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&amp;display=swap" rel="stylesheet">
    <?php echo file_get_contents("../../social-cards.php"); ?>
</head>
<body>
    <h1></h1>
    <?php
    $_ = file_get_contents("../ids/$userID.json.txt");
    $info = $_;
    $master = json_decode($_, true);
    $chart = file_get_contents("https://pietential.com/pielet/share/makechart.php?chart=$userID");
    $out = "<div style='margin:auto;max-width:1100px;'>$chart
    <div id='resultsAsTex
    t' style='display:none;'><h2>Admins only see complete scoring
    (You are an admin) </h2>$out</div>
    </div> ";
    
    $_ = file_get_contents("../shell/index.php");
    $_ = str_replace("{{content}}", $out .  $googleAnalyics . $twitterCard, $_);
    $_ .= `<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>`;
    echo ($_);

    
    ?>
<div style="text-align:center; max-width:700px; margin:auto;">
<h1>Pietential™</h1>
<p>“The Life Balance Realization System”</p> <br>

<p>Pietential is “The Life Balance Realization System.” Based on Maslow’s Hierarchy of Needs, it helps you Visualize, and Analyze where you stand regarding the core issues that are central to what it is to be human: Physiological Needs, Safety Needs, Love and Belonging, Esteem, and Self-actualization, so you can realize your best life, and track your progress towards it. And Pietential is absolutely free!</p><br><br>
<p>
<button class="bt" onclick="window.open(`/?from-sharing-utility`)">Discover Your Pietential Now!</button></p>


</div>
   
<script type="text/javascript" src="/navigation/bottomNav.js"></script>


    <div style="display:none;"><?php //echo $info;?></div>
    <script>
        // localStorage.pieletFooter = pieletFooter.innerHTML;
        // var intro = abstract.outerHTML;
        // abstract.outerHTML = "";
        // document.getElementsByTagName("h1")[0].outerHTML = intro + document.getElementsByTagName("h1")[0].outerHTML;
        mainContent.style.display = '';
        document.getElementsByTagName("img")[1].style.display = 'none';
    </script>
</body>
</html>