<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');

// https://pietential.com/pielet/pdf.php?genHTML=r5dQMf7dqdxd

// Include autoloader 
require_once 'dompdf/autoload.inc.php'; 
 
// Reference the Dompdf namespace 
use Dompdf\Dompdf; 
 
// Instantiate and use the dompdf class 
$dompdf = new Dompdf();

// Load HTML content 
//$dompdf->loadHtml(file_get_contents("https://pietential.com/pielet/pdf.php?genHTML=r5dQMf7dqdxd"));

$dompdf->loadHtml("hello world");
 
// (Optional) Setup the paper size and orientation 
$dompdf->setPaper('A4', 'portrait'); 
 
// Render the HTML as PDF 
$dompdf->render(); 
 
// Output the generated PDF to Browser 
$dompdf->stream();
