<?php
//https://pietential.com/reviewresults.php?id=j4GXayTwbEnD
extract($_GET);
extract($_POST);
//

$_ = file_get_contents("$id.json.txt");
$master = json_decode($_, true);

$formQuestions = json_decode(file_get_contents('formQuestions.json'), true);
$i = 0;
foreach ($formQuestions as $_) {
    $formarrayKey = "Q$i" . "response";
    $score = $master[$formarrayKey];
    $q[] = $_[Question];
    $resultsText .= $_[Question] . " = " . $score . "<br>";
    $i++;
}
$rawdata = print_r($q, true);
$rawdata = "<pre>$rawdata</pre>";
//echo $rawdata;


$rawdata = print_r($master, true);
$rawdata = "<pre>$rawdata</pre>";
$email = $master[LifeBalanceEmail];
$chart = file_get_contents("https://pietential.com/pielet/makechart.php?chart=$id");
$out .= "<div style='margin:4% 8%;max-width:1100px;'>$chart $resultsText
    <div id='resultsAsTex
    t' style='display:none;'><h2>Admins only see complete scoring
    (You are an admin) </h2>$out </div>

    </div> ";
$footer = file_get_contents("footer.html");
$footer = str_replace("{{privacyHardCoded}}", file_get_contents("../privacy.html"), $footer);
$_ = file_get_contents("shell.html");
$_ = str_replace("{{content}}", $out . $rawdata, $_);
$_ = str_replace("I just got my", $email, $_);
$_ .= $footer;
$_ .= `<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>`;


exit($_);
