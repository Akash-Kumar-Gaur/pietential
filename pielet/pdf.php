<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');

if ($genHTML) {
    // https://pietential.com/pielet/pdf.php?genHTML=r5dQMf7dqdxd
    $pdf = $genHTML;
    $chart = "../$pdf.png";
    $chart2 = "../$pdf.bar.png";
    $analysis = buildAnalysis($pdf);
    $analysis = trim($analysis);
    $analysis = str_replace("\n", "<br>\n", $analysis);
    $pbrand = '<div style="text-align:center;
    "><a href="//pietential.com"><img src="private-header.png"
    style="width: 100%;max-width: 900px;margin-bottom:10px;margin: auto;"></a><br></div>';
    $charts = "<br><br><br><img id='piechart'  style='width:100%'><br><img  id='barchart'   style='width:100%'>";
    $analysis = $pbrand . $charts . $analysis;
    $out = file_get_contents("shell2.html");
    $out = str_replace("{{content}}", $analysis, $out);
    $out .= "<script>window.print();</script>";
    echo($out);
    ?>

<script>
document.getElementById("piechart").src = localStorage.myChart;
document.getElementById("barchart").src = localStorage.barchart;

var pieletData = JSON.parse(localStorage.pieletDataJSON);
//{{PNtext}}{{SNtext}}{{LBtext}}{{ECtext}}{{SAtext}}
var dbi = document.body.innerHTML;
document.body.innerHTML = document.body.innerHTML
.replace(/{{PNtext}}/, pieletData.PNresponse)
.replace(/{{SNtext}}/, pieletData.SNresponse)
.replace(/{{LBtext}}/, pieletData.LBresponse)
.replace(/{{ECtext}}/, pieletData.ECresponse)
.replace(/{{SAtext}}/, pieletData.SAresponse)
.replace(/{{PN}}/, pieletData.PN)
.replace(/{{SN}}/, pieletData.SN)
.replace(/{{LB}}/, pieletData.LB)
.replace(/{{EC}}/, pieletData.EC)
.replace(/{{SA}}/, pieletData.SA);

window.print();</script>





<?


    exit;
}

function buildAnalysis($pdf)
{
    $master = json_decode(file_get_contents("ids/$pdf.json.txt"), true);


    $_ = '';
    $_ .= "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";

    //$_ .= "Your Pietential URL: https://pietential.com/?socialshare=$pdf\n\n";

    $passValue = 59;

    $sep = "<hr>\n\n";


 $_.= "
 <b>Physiological Needs: Your score: {{PN}}/100</b>
 {{PNtext}}
 <br><b>Safety Needs: Your score: {{SN}}/100</b>
 {{SNtext}}
 <br><b>Love and Belonging: Your score: {{LB}}/100</b>
 {{LBtext}}
 <br><b>Self-Esteem and Contribution: Your score: {{EC}}/100</b>
 {{ECtext}}
 <br><b>Self Actualization Needs: Your score: {{SA}}/100</b>
 {{SAtext}}
 <br>";


   

    // Created and developed by: Starling Growth Advisory and Silvercrayon Labs. Copyright 2020 Starling Growth Advisory.



    // Get your score at Pietential.com.

    $_ .= "$sep ";

    $_ .= "<BR><BR>
<div style='text-align:center'>
<a class='bt' style='font-size: 15px; padding: 10px 20px;' href=\"javascript: window.close();\">Close this tab and return to previous page</a>
</div>";
    //file_put_contents("$pdf.html", $_);
    return ($_);
}

exit();




if ($downloadPDF) {
    header('Content-type: application/octet-stream');
    header('Content-Disposition: attachment; filename="Pietential.com ' . $downloadPDF . '.pdf"');
    echo (file_get_contents("https://pietential.com/pielet/pdf.php?pdf=$downloadPDF"));
    exit;
}




if ($summary) {
    $a = explode(';;;', $summary);
    $pdf = trim($a[0]);
    $summary = trim($a[1]);
    file_put_contents($pdf . ".summary.txt", $summary);
    exit;
}

if ($combine) {
    $pdf = $combine;
    $temp = file_get_contents("https://pietential.com/pielet/pdf.php?pdf=$combine");
    file_put_contents("temp.pdf", $temp);
    $fileArray = array("page1-001.pdf", "temp.pdf", "lastpage-001.pdf");
    //$fileArray= array("cover.pdf","temp.pdf");
    //$fileArray= array("cover.pdf","temp.pdf");
    $outputName = "$pdf-merged.pdf";
    $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";
    foreach ($fileArray as $file) {
        $cmd .= $file . " ";
    }
    $result = shell_exec($cmd);

    echo file_get_contents("$pdf-merged.pdf");
    exit;
    // https://pietential.com/pdf.php?combine=G9giH1pdlhsN
}



// Below is the php PDF merge command.

// $fileArray= array("name1.pdf","name2.pdf","name3.pdf","name4.pdf");

// $datadir = "save_path/";
// $outputName = $datadir."merged.pdf";

// $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";
// //Add each pdf file to the end of the command
// foreach($fileArray as $file) {
//     $cmd .= $file." ";
// }
// $result = shell_exec($cmd);

$_ = str_replace("’", "'", $_);
$_ = str_replace("“", "\"", $_); //“self-improvement” 
$_ = str_replace("”", "\"", $_);
$_ = str_replace("\n", "[newline]", $_);
$_ = preg_replace('/\s+/ism', ' ', $_);
$_ = str_replace("[newline]", "\n", $_);






require('../fpdf/fpdf.php');


//$_ .= file_get_contents($pdf.".summary.txt");
// $_ = str_replace("<br>", "\n", $_);
// $_ = str_replace("ne!", "ne!\n", $_);
// $_ = str_replace("100", "100\n", $_);
// $_ = str_replace("nt)", "nt)\n", $_);//✅
// $_ = str_replace("✅", "", $_);//âœ…
// $_ = str_replace("âœ…", "", $_);//âœ…
// $_ = strip_tags($_);

$chart = "../$pdf.png";
$chart2 = "../$pdf.bar.png";

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 11);

$pdf->Image($chart, 10, 30, -150);
$pdf->Image($chart2, 10, 130, -150);
$pdf->AddPage();
$pdf->Image("private-header.png", 40, 0, -220);
$pdf->MultiCell(189, 5, $_, 0, 1);
//$pdf->Output("$pdf.pdf","F");
$pdf->Output();
exit;
