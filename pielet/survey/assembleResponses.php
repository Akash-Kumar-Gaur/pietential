<?php
extract($_GET);
extract($_POST);
header("Access-Control-Allow-Origin: *");
//header("Content-Type: text/plain; charset=utf-8");
$domain = $_SERVER['HTTP_HOST'];
$filepath = $_SERVER['SCRIPT_NAME'];
$lastslash = strrpos($filepath, "/");
$path = substr($filepath, 0, $lastslash);
$hi = "http://" . $domain . $path . "/";
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d');

$PNO = file_get_contents("PN-over.html");
$SNO = file_get_contents("SN-over.html");
$LBO = file_get_contents("LB-over.html");
$ECO = file_get_contents("EC-over.html");
$SAO = file_get_contents("SA-over.html");

$PNU = file_get_contents("PN-under.html");
$SNU = file_get_contents("SN-under.html");
$LBU = file_get_contents("LB-under.html");
$ECU = file_get_contents("EC-under.html");
$SAU = file_get_contents("SA-under.html");



$out .= "<div id='PNO' style='display:none'>$PNO</div>\n";
$out .= "<div id='SNO' style='display:none'>$SNO</div>\n";
$out .= "<div id='LBO' style='display:none'>$LBO</div>\n";
$out .= "<div id='ECO' style='display:none'>$ECO</div>\n";
$out .= "<div id='SAO' style='display:none'>$SAO</div>\n";

$out .= "<div id='PNU' style='display:none'>$PNU</div>\n";
$out .= "<div id='SNU' style='display:none'>$SNU</div>\n";
$out .= "<div id='LBU' style='display:none'>$LBU</div>\n";
$out .= "<div id='ECU' style='display:none'>$ECU</div>\n";
$out .= "<div id='SAU' style='display:none'>$SAU</div>\n";

echo $out;
file_put_contents("assemble.js", $out);
?>
<textarea id='wer'></textarea>

<script>
pieletResponses = {};
pieletResponses.PNO = document.getElementById("PNO").innerHTML;
pieletResponses.SNO = document.getElementById("SNO").innerHTML;
pieletResponses.LBO = document.getElementById("LBO").innerHTML;
pieletResponses.ECO = document.getElementById("ECO").innerHTML;
pieletResponses.SAO = document.getElementById("SAO").innerHTML;

pieletResponses.SNU = document.getElementById("SNU").innerHTML;
pieletResponses.LBU = document.getElementById("LBU").innerHTML;
pieletResponses.ECU = document.getElementById("ECU").innerHTML;
pieletResponses.SAU = document.getElementById("SAU").innerHTML;
pieletResponses.PNU = document.getElementById("PNU").innerHTML;

pieletResponsesJSON = btoa(unescape(encodeURIComponent(JSON.stringify(pieletResponses))));

wer.innerHTML += pieletResponsesJSON;
</script>


<? exit;
// $out .= "pieletData.SNO = `$SNO`;\n";
// $out .= "pieletData.LBO = `$LBO`;\n";
// $out .= "pieletData.ECO = `$ECO`;\n";
// $out .= "pieletData.SAO = `$SAO`;\n";

// $out .= "pieletData.PNU = `$PNU`;\n";
// $out .= "pieletData.SNU = `$SNU`;\n";
// $out .= "pieletData.LBU = `$LBU`;\n";
// $out .= "pieletData.ECU = `$ECU`;\n";
// $out .= "pieletData.SAU = `$SAU`;\n";

// $file = $out;




// $file = str_replace("‘", "&lsquo;", $file);
//       $file = str_replace("’", "&rsquo;", $file);
//       $file = str_replace("“", "&ldquo;", $file);
//       $file = str_replace("”", "&rdquo;", $file);
//       $file = str_replace("•", "&bull;", $file);
//       $file = str_replace("–", "&ndash;", $file);
//       $file = str_replace("—", "&mdash;", $file);
//       $file = str_replace("™", "&trade;", $file);
      
  
      






