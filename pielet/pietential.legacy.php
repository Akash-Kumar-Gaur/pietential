<?php
extract($_GET);
extract($_POST);

if (!$_COOKIE['LifeBalanceID']) {
    function getrandom( $len ) {
        $data = "abcdefghijklmnopqrstuvwxyz01234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $arr = str_split( $data );
        while ( $i < $len ) {
        shuffle( $arr );
        $f .= $arr[ 0 ];
        $i++;
        }
        return $f;
        }

    $LifeBalanceID =  getrandom(12);   
    setcookie('LifeBalanceID', $LifeBalanceID, time() + 7776000, "/");
    $pietentialData[LifeBalanceID] = $LifeBalanceID;
    $json = json_encode($pietentialData);
    file_put_contents("$LifeBalanceID.json.txt", $json);
    $scripts .= "<script>
    let pietentialData = $json ;
    </script>";
}

$domain = $_SERVER['HTTP_HOST'];
$filepath = $_SERVER['SCRIPT_NAME'];
$lastslash = strrpos($filepath, "/");
$path = substr($filepath, 0, $lastslash);
$hi = "https://" . $domain . $path . "/";

date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d');
$timestampForReload = date('Y-m-d--H-i-s');

$googleAnalyics = '<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117957204-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag(\'js\', new Date());
  gtag(\'config\', \'UA-117957204-2\');
</script>';
$twitterCard = '<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="https://pietential.com/social.php">
<meta name="twitter:creator" content="@hankenstein">
<meta name="twitter:title" content="Realize Your Growth Potential in 5 Minutes">
<meta name="twitter:description" content="Pietential is a survey-based life balance visualization tool based on Maslow’s Hierarchy of needs.">
<meta name="twitter:image" content="https://pietential.com/pietential-social.png">
<meta property="og:url" content="https://pietential.com/social.php"/>
<meta property="og:type" content="website"/>
<meta property="og:title" content="Realize Your Growth Potential in 5 Minutes"/>
<meta property="og:description" content="Pietential is a survey-based life balance visualization tool based on Maslow’s Hierarchy of needs."/>
<meta property="og:image" content="https://pietential.com/pietential-social.png"/>';


if (preg_match('/jstar/', $hi)) {
    header("Location: https://pietential.com/");
    exit;
}


if ($pdf) {



    header('Content-type: application/octet-stream');
    header('Content-Disposition: attachment; filename="Pietential.com - ' . $pdf . '.pdf"');
    echo (file_get_contents("https://pietential.com/pdf.php?combine=$pdf"));
    // https://pietential.com/pdf.php?downloadPDF=eXHu9aqGZfsl
    exit;
}



if ($LifeBalanceformData) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    $s = json_decode($LifeBalanceformData, true);
    unset($s[LifeBalanceformData]);
    $filename = $s['LifeBalanceID'] . ".json.txt";
    $sessionstamp = date('Y-m-d');
    //$sessionstamp = date('Y-m-d--H-i-s');
    $fullstamp = date('Y-m-d--H-i-s');
    if (file_exists($filename)) {
        $existing = json_decode(file_get_contents($filename), true);
        if ($existing['sessions']) {
            $sessions = $existing['sessions'];
        }
    }

    $nullcheck = 0;
    foreach ($s as $key => $value) {
        if (preg_match('/^Q[0-9]/', $key)) {
            $todayDate[$key] = $value;
            if ($value == 0) {
                $nullcheck = 1;
            }
        }
    }
    if (!$nullcheck) {
        $sessions[$sessionstamp] = $todayDate;
        $s['sessions'] = $sessions;
    }
    $s['timestamp'] = $fullstamp;
    file_put_contents($filename, json_encode($s));
    setcookie('LifeBalanceID', $s['LifeBalanceID'], time() + 7776000, "/"); //90 days
    exit("success");
}
if ($download) {
    $filename = $_COOKIE['LifeBalanceID'] . ".png";
    header('Content-type: application/octet-stream');
    header('Content-Disposition: attachment; filename="Pietential.com - ' . $filename . '"');
    echo (file_get_contents($filename));
    exit();
}

if ($share) {

    if ($share == "discover") {
        $share = $_COOKIE['LifeBalanceID'];
    }


    echo '<!DOCTYPE html><html>

    <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="manifest" href="pietential.webmanifest">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="styles.css?' . $timestampForReload . '" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">
    
    <link rel="icon" type="image/png" href="icon.png">
    <title>Pietential - Growth Potential Visualization Survey</title>
</head>
    <link rel="stylesheet" href="https://d1azc1qln24ryf.cloudfront.net/114779/Socicon/style-cf.css?u8vidh">
    <section id ="social" style="font-size: 15px; font-family: segoe ui, sans-serif;">
    
    <body>
   
    
    <div id="shareButtons" style="margin:auto;text-align:center;margin-top:30px;" >
    
    <a href="https://pietential.com/"><img src="pietential.png" style="width:200px;"></a><br><br>
    
    <a  href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fpietential.com%2F%3Fsocialshare%3D' . $share . '&amp;src=sdkpreparse" style="font-size: 11px; font-family: segoe ui, sans-serif; color: white; padding: 5px 8px; border: 0px solid rgb(201, 62, 41); background-color: rgb(46, 133, 165); text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank"><i class="socicon-facebook" style="padding-right:12px;"></i> Share on Facebook</a>
    <br>
    <a  href="https://twitter.com/intent/tweet?text=I just got my Pietential visualization: https://pietential.com/?socialshare=' . $share . '" style="font-size: 11px; font-family: segoe ui, sans-serif; color: white; padding: 5px 8px; border: 0; background-color: rgb(46, 133, 165); text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank"><i class="socicon-twitter" style="padding-right:12px;"></i> Share on Twitter</a>
     <br>
     
     <a  href="https://www.linkedin.com/shareArticle?mini=true&url=https://pietential.com/?socialshare=' . $share . 'title=I just got my Pietential visualization" style="font-size: 11px; font-family: segoe ui, sans-serif; color: white; padding: 5px 8px; border: 0; background-color: rgb(46, 133, 165); text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank"><i class="socicon-linkedin" style="padding-right:12px;"></i> Share on linkedin</a>
     <br>
     <a  href="https://pietential.com/?socialshare=' . $share . '" style="font-size: 11px; font-family: segoe ui, sans-serif; color: white; padding: 5px 8px; border: 0; background-color: rgb(248, 126, 2); text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank">Preview Shared Link</a>

     </div>

     
   
    
    <div style="padding: 12px; font-family: sans-serif;margin:auto;text-align:center;"><br>
    OR...
    <br><br>Copy and paste the following snippet:<br><div class="copybox"><strong id="container">I just got my Pietential visualization:<br>https://pietential.com/?socialshare=' . $share . '<br>Get yours at https://pietential.com/</strong></div>
    
    <a  href="javascript://" style="font-size: 11px; font-family: segoe ui, sans-serif; color: white; padding: 5px 8px; border: 0px solid rgb(201, 62, 41); background-color: rgb(46, 133, 165); text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" id="theButton" onclick="CopyToClipboard(\'container\')">COPY TO CLIPBOARD</a>
    
    <!-- <a  href="https://pietential.com/?socialshare=' . $share . '" style="font-size: 11px; font-family: segoe ui, sans-serif; color: white; padding: 5px 8px; border: 0px solid rgb(201, 62, 41); background-color: rgb(46, 133, 165); text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank">Preview Shared Link</a>-->
    
    </div>
    
    <script>
				function CopyToClipboard( containerid ) {

					
					if ( document.selection ) {
						var range = document.body.createTextRange();
						range.moveToElementText( document.getElementById( containerid ) );
						range.select().createTextRange();
						document.execCommand( "Copy" );

					} else if ( window.getSelection ) {
						var range = document.createRange();
						range.selectNode( document.getElementById( containerid ) );
						console.log(range);
						window.getSelection().addRange( range );
						document.execCommand( "Copy" );

					}
					
					document.getElementById( "theButton" ).innerHTML = "copied";
					
				}
    </script>
    ' . $googleAnalyics . $twitterCard . '
    </section>
    </body>
    </html>
    ';
    exit;
}

if ($socialshare) {
    $_ = file_get_contents("$socialshare.json.txt");
    $master = json_decode($_, true);
    $chart = file_get_contents("https://pietential.com/makechart.php?chart=$socialshare");
    $out = "<div style='margin:4% 8%;max-width:1100px;'>$chart
    <div id='resultsAsTex
    t' style='display:none;'><h2>Admins only see complete scoring
    (You are an admin) </h2>$out</div>

    </div> ";
    $footer = file_get_contents("footer.html");
    $footer = str_replace("{{privacyHardCoded}}", file_get_contents("privacy.html"), $footer);
    $_ = file_get_contents("shell.html");
    $_ = str_replace("{{content}}", $out .  $googleAnalyics . $twitterCard, $_);
    $_ .= $footer;
    $_ .= `<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>`;


    exit($_);
}

if ($generate) {
    $_ = file_get_contents("$generate.json.txt");
    $master = json_decode($_, true);
    $LifeBalanceEmail = $master['LifeBalanceEmail'];
    $LifeBalanceID = $master['LifeBalanceID'];
    echo "<script>
    pietentialData = $_;
    pietentialData.LifeBalanceEmail = `$LifeBalanceEmail`;
    pietentialData.LifeBalanceID = `$LifeBalanceID`;
    location.assign(`?ing`);
    </script>";

    exit;
}

//$savePNG = 'R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==';

if ($userID){

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");

    if($savePNGPIE){
        $iname = $userID . ".png";
        $savePNG = $savePNGPIE;
        $decodedData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $savePNG));
    
    file_put_contents($iname, $decodedData);
    exit;
    }
    if($savePNGBAR){
        $iname = $userID. ".bar.png";
        $savePNG = $savePNGBAR;
        $decodedData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $savePNG));
        file_put_contents($iname, $decodedData);
    exit;
    }



 exit;   
}




if ($savePNGPIE || $savePNGBAR) {
    
    if($savePNGPIE){
        $iname = $_COOKIE['LifeBalanceID'] . ".png";
        $savePNG = $savePNGPIE;
        $decodedData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $savePNG));
    
    file_put_contents($iname, $decodedData);
    exit;
    }
    if($savePNGBAR){
        $iname = $_COOKIE['LifeBalanceID'] . ".bar.png";
        $savePNG = $savePNGBAR;
        $decodedData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $savePNG));
        file_put_contents($iname, $decodedData);
    exit;
    }
    
}


if ($_COOKIE['LifeBalanceID']) {
    $LifeBalanceID = $_COOKIE['LifeBalanceID'];
    setcookie('LifeBalanceID', $LifeBalanceID, time() + 7776000, "/");
    $a = file_get_contents("$LifeBalanceID.json.txt");
    $scripts .= "<script> let pietentialData = $a; </script>";
    
}

if(!$LifeBalanceID){
    $scripts .= "<script> let pietentialData = {}; </script>";
}


if ($loadDate) {
    $dateData = $master[$loadDate];
    echo "<pre>";
    print_r($dateData);

    $SA = 0;
    function calcScore($dateData)
    {

        foreach ($dateData as $key => $value) {
            if (preg_match('/Q0response|Q1response|Q2response|Q3response|Q4|Q5/ism', $key)) {
                $score['SA'] += ($value * 1.66);
            }
            if (preg_match('/Q6|Q7|Q8|Q9|Q10|Q11/ism', $key)) {
                $score['EC'] += ($value * 1.66);
            }
            if (preg_match('/Q12|Q13|Q14|Q15|Q16|Q17/ism', $key)) {
                $score['LB'] += ($value * 1.66);
            }
            if (preg_match('/Q18|Q19|Q20|Q21|Q22|Q23/ism', $key)) {
                $score['SN'] += ($value * 1.66);
            }
            if (preg_match('/Q24|Q25|Q26|Q27|Q28|Q29/ism', $key)) {
                $score['PN'] += ($value * 1.66);
            }
        }


            drawChart( SA, EC, LB, SN, PN );

        return ($score);
        //return($thenum);
    }

    $score = calcScore($dateData);
    //echo $score;
    print_r($score);
    exit;
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">
    <link rel="manifest" href="pietential.webmanifest">
    <link href="styles.css?<?php echo $timestampForReload ?>" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="icon.png">
    <title>Pietential - Growth Potential Visualization Survey</title>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<!--php scripts-->
<?php echo $scripts; ?>
<body style="padding:0px;margin:80px 0px;" cz-shortcut-listen="true">




    <div id="scoreboard" class="m10" style="display:none; width:45%;padding:12px; border:1px solid silver; border-radius:6px; margin: auto;">
        <div id="score" class="m10" style="padding:0px; font-weight: 700;">Others taking the evaluation:</div>
        <div style="padding:0px; " id="results"></div>
    </div>
    <div id="minibranding" style="margin: auto; text-align: center; display:none;">
        <a href="./"><img src="pietential.png" style="width: 10%;max-width: 500px;margin-bottom:10px;margin: auto;"></a>
    </div>
    <div id="branding" style="margin: auto; text-align: center;">
        <img src="pietential.png" style="width: 90%;max-width: 500px;margin-bottom:10px;margin: auto;">
        <h1>Realize Your Growth Potential</h1>
        <style>
            .col2 {
                width: 48%;
                float: left;
                text-align: left;
                margin: 12px;
            }
        </style>
        <section style="max-width:1000px; margin:auto">
            <div style="margin:0px;">
                <div id="abstract" style="text-align: left; margin: 30px 0px; box-sizing:border-box;padding: 12px;">
                    <img src="images/photo.png" style="float:right; max-width:50%;">
                    <p><span style="font-size: 16px;"><strong>Your Growth Potential
                                <br><span style="font-size: 18px;">The better you can Visualize it</span>
                                <br><span style="font-size: 22px;">The more effectively you can Analyze it.</span>
                                <br><span style="font-size: 26px;">And the easier you can Realize it.</span></strong></span>
                        <br>
                        <br><b>Pietential is a survey-based life balance visualization tool, developed by John Starling, and based on Maslow’s Hierarchy of needs.</b></p>
                    <p style="margin-top:6px;">I’ve always been fascinated by Maslow’s Needs, as being the core of what’s common to us all - but I’ve never agreed with it being represented as a hierarchy.</p>
                    <p style="margin-top:6px;">The way these needs are typically represented, it’s as if your entire life is organized to support a precious little amount of self-actualization, that only a few of us ever reach. It makes it seem like if you don’t have the lower echelons firmly in place, you’ll never achieve any level of self-actualization. That’s ridiculous. By this standard, Ghandi, Bhudda, and Jesus shouldn’t have had a chance to become the self-actualizing beings that they were. </p>
                    <p style="margin-top:6px;"><b>I see it differently. Maybe you will too?</b>

                        <br>I see these issues regarding Physiological needs, Safety needs, Love and Belonging, Esteem, and Self-actualization as a continuum. And with the help of my friends at <a href="https://www.silvercrayon.com/" target="_top">Silvercrayon Labs,</a> we were able to create a simple 3-5 minute survey that allows you to visualize your own current relationship to the components of Maslow’s “Hierarchy” of Needs as pie chart. </p>
                    <p style="margin-top:6px;"><b>Pietential </b>helps you <b>Visualize</b>, and <b>Analyze</b> where you stand on these core issues that are central to life, so you can set and <b>Realize</b> your goals for self improvement.</p>
                    <p style="margin-top:6px;">~<a href="https://www.starlinggrowthadvisory.com/history" target="_self">John Starling</a></p>
                    <p style="margin-top:6px;"><span style="font-size: 30px;"><b>Visualize. Analyze. Realize.</b></span></p>
                </div>
            </div>
        </section>


        <section id="explainer" style="max-width: 800px;text-align: center;margin: auto;">

        </section>


    </div>

    <div id="emailCapture" onclick="resetOnEmail();" class="max500" style="padding-top:80px;max-width:800px; margin:auto; text-align:center;">

        <input name="email" id="email" required type="email" placeholder="Enter your email to begin the evaluation" style="width:80%; max-width:500px;text-align:center;">
        <br>
        <div class="bt" onclick="getmail()" style="padding: 12px 49px;
    font-size: 20px;">Start evaluation</div><br><br>
    </div>




    <form class="max500" id="mainformParent" style="margin:auto;" enctype="multipart/form-data" action="" onclick="addValues();" method="post">


        <section id="headline" style="display:none;">
            <h1>Pietential</h1>
            <h2 style="display: inline-block; margin-top: -3%;">Growth Potential Visualization Survey</h2>
        </section>
        <!--<div class="bt" style="padding:1% 8%;" onclick="">More info </div>-->


        <section id="topChartGen" style="display:none; margin:auto">
            <!-- Form has been completed.<br><br>-->
            <div class="bt" style="font-size:30px; padding:1% 8%;" onclick="location.assign('?showResults')">Visualize It</div><br><br><br>

            <!--<div class="bt" onclick="sendChartAsPNG()">Return to editing</div>-->


        </section>
        <div id="mainForm" style="display:none;">
            <section id="partPicker" style="margin:0px 0px 15px 0px; text-align: center;">
                <div class="bt color1 partpickerButton" onclick="nextsection('Part1');">Self-Actualization</div>
                <div class="bt color2 partpickerButton" onclick="nextsection('Part2');">Esteem</div>
                <div class="bt color3 partpickerButton" onclick="nextsection('Part3');">Love and Belonging</div>
                <div class="bt color4 partpickerButton" onclick="nextsection('Part4');">Safety needs</div>
                <div class="bt color5 partpickerButton" onclick="nextsection('Part5');">Physiological needs</div>
            </section>




            <div id="progressGroupTop">
                <div style="border-radius: 6px; width:100%; background: #eee;padding:0px;margin:10px 0px;">
                    <div class="pbar" style="padding:10px;border-radius: 6px; color:white; background: #377dd4; "></div>
                </div>
            </div>
            <div id="partsContainer"></div>
            <section id="partPickerBottom" style="margin:15px 0px 15px 0px; text-align: center;">
                <div class="bt color1 partpickerButton" onclick="nextsection('Part1');">Self-Actualization</div>
                <div class="bt color2 partpickerButton" onclick="nextsection('Part2');">Esteem</div>
                <div class="bt color3 partpickerButton" onclick="nextsection('Part3');">Love and Belonging</div>
                <div class="bt color4 partpickerButton" onclick="nextsection('Part4');">Safety needs</div>
                <div class="bt color5 partpickerButton" onclick="nextsection('Part5');">Physiological needs</div>
            </section>
            <div id="progressGroup">



                <div id="sectionprogressParent" style="display: none; border-radius: 2px; width:100%; background: #eee;padding:0px;margin:10px 0px">
                    <span class="note">Section progress:<br></span>
                    <div style="padding: 2px;font-size: 11px; border-radius: 2px; color:white; background: #377dd4; " class="sectionprogress"></div>
                </div>
                <span class="note" style="display:none;">Overall progress:<br></span>
                <div id="pbarParent" style="border-radius: 6px; width:100%; background: #eee;padding:0px;margin:10px 0px;">
                    <div class="pbar" style="padding:10px;border-radius: 6px; color:white; background: #377dd4; "></div>
                </div>
                <!--                <i style="font-size: 11px;  opacity: .5;  text-align: right;margin-top: -3%;  position: absolute; left: 30%;">all changes saved...</i>-->
            </div>
        </div>
    </form>
    <section id="processSection" style="display:none; margin:auto; text-align:center;">

        <div style="margin:auto;">
            <!--Form has been completed.<br><br> -->
            <div class="bt" style="font-size:30px; padding:1% 8%;" onclick="location.assign('?showResults')">Visualize It.</div><br><br><br>

            <!--<div class="bt" onclick="sendChartAsPNG()">Return to editing</div>
            <div class="bt" onclick="location.assign('https://pietential.com/?share=discover');" class="bt">Share results on social media</div>

            <div class="bt" onclick="download()">Download chart</div>
            <br><br>-->
            <div onclick="location.assign('./?renewFromModal');" class="bt">Clear data and start over</div>
        </div>
    </section>
    <div id="contains2charts" style="transform: scale(1);">
        <div id="cc" style="width:100%;">
        <canvas id="myChart" class="chart"></canvas>
        <canvas id="barchart" class="chart"></canvas>
        <br>
        </div>
        <div id="bigChart" style="display:none"></div>
        <div id="branding2" style="margin: auto; text-align: center;"></div>
        <div id="achart"></div>
        <div id="footer" style="text-align: center;">
            <div id="analyzeit" style="display:none">
                <div class="bt" style="font-size:30px; padding:1% 8%;" onclick="location.assign('?analyzeit')">Analyze It</div><br><br><br>
            </div>

            <div id="logos" style="opacity:.5;transform:scale(.5)">
                Created and developed by: <br>
                <a href="https://starlinggrowthadvisory.com/" target="_top"><img src="starling-logo.png" style="width: 25%;max-width: 800px;margin-bottom:10px;margin: auto;"></a>

                <a href="https://silvercrayon.us/" target="_top"><img src="labs.svg" style="width: 22%;max-width: 800px;margin-bottom:10px;margin: auto;filter: brightness(0.1);"></a><br>
            </div>


            <div id="plinks" style="text-align: center;margin-top: 28px;">© 2020 <a href="https://www.starlinggrowthadvisory.com/" target="_top">Starling Growth Advisory.</a> <a href="javascript://" onclick="showPrivacy();">Privacy Policy</a></div>

        </div>

    </div>

    <div id="adminBar" style="    text-align: center;
    display: none;
    position: fixed;
    color:white;
    top: 0px;
    background: #307ef3;
    padding: 10px;">Admin tools: <a style="color:white;" href="javascript://" onclick="sim();">Load simulated values</a> | <a style="color:white;" href="list.php">View submissions</a></div>

    <? echo $endscripts; ?>

    <script src="chartjs-plugin-watermark.js"></script>

    <script>
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////

        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('serviceworker.js');
        }

        if (window.location.protocol === 'http:') {
            var p = location.href;
            location.assign(p.replace('http://', 'https://'));
        }

        function setQdata() {
            var formQuestions = JSON.parse(`<?= file_get_contents('formQuestions.json') ?>`);
            return (formQuestions);
        }
        var responder = `<?= file_get_contents('responder.html') ?>`;
        var privacy = `<?= file_get_contents('privacy.html') ?>`;
        var shell = `<?= file_get_contents('shell.html') ?>`;
        

        function buildPage(id) {
            shell = shell.replace(/\{\{content\}\}/, id);
            //shell += `<div><canvas id="myChart"  style="width:90%;  top:100px; " class="chart"></canvas></div>`;
            document.body.innerHTML = shell;
        }

        if (!location.href.match(/https/) && !location.href.match(/192\.168|blacktar/)) {
            location.assign(location.href.replace(/http\:/, `https:`));
        }
        if (location.href.match(/iamtheadmin/)) {
            pietentialData.adminBar = 1;
            location.assign("?you-are-now-an-admin");
            //  https://pietential.com/?iamtheadmin
        }


        var sectionNames = [`Self-Actualization`, `Esteem`, `Love and Belonging`, `Safety needs`, `Physiological needs`];


        if (top != self) {
            top.location = location;
        }

        function sim() {
            var j = document.getElementsByTagName("input");
            console.log(j);
            for (var i = 0; i < j.length; i++) {
                if (j[i].name.match(/^Q[0-9]/g)) {
                    j[i].value = shuffle([1, 2, 3, 4, 5, 6])[0];
                }
            }
            addValues();
            location.assign("/?23");           
        }


        function resetSession() {
            if (pietentialData.LifeBalanceID) {
                for (const property in pietentialData) {
                    if (property.match(/^Q[0-9]/g)) {
                        
                        pietentialData[property] = 0;
                    }
                }
                }
            
            pietentialData.Part1Completed = "";
            pietentialData.Part2Completed = "";
            pietentialData.Part3Completed = "";
            pietentialData.Part4Completed = "";
            pietentialData.Part5Completed = "";
            pietentialData.currentPart = "";
            pietentialData.chartHide = 1;
            pietentialData.newUser = 1;
            pietentialData.resetSession = 1;
        }




        pietentialData.LifeBalanceTimestamp = `<?PHP echo $timestamp; ?>`;
        if (!pietentialData.LifeBalanceEmail) {
            partPickerBottom.style.display = "none";
        }

        if (location.href.match(/\?r/ || !pietentialData.LifeBalanceID)) {
            resetSession();
            location.assign('/');
            //location.assign( '?wipeSessionValues=1' );
        }

        if (!pietentialData.LifeBalanceID) {
            pietentialData.newUser = 1;
        }

        if (!location.href.match(/showResults/ig) && !pietentialData.newUser && pietentialData.LifeBalanceEmail && !pietentialData.resetSession) {

            document.body.innerHTML += ` <div style="position:fixed; top:0px;padding:0px; background:black; text-align:center;display:none;">
        <div style="margin:8px; color:white" id="topBar">You are resuming were you left off.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <div  style="width: 155px; display: inline-block;text-align: center;"onclick="location.assign('?renewFromModal');"  class="bt">Clear data and start over</div></div></div>
`;
        }


        function dataURL() {

            var imagep = myChart.toDataURL("image/png");
            document.body.innerHTML += `<img id="myChartPNG" src="${imagep}">`;
        }

        function resetOnEmail() {
            var d = document.querySelectorAll("input");
            for (var i = 0; i < d.length; i++) {
                if (d[i].name.match(/Q/)) {
                    d[i].value = 0;
                }
            }
            
            pietentialData.Part1Completed = 0;
            pietentialData.Part2Completed = 0;
            pietentialData.Part3Completed = 0;
            pietentialData.Part4Completed = 0;
            pietentialData.Part5Completed = 0;
            pietentialData.chartHide = 1;
            pietentialData.newUser = 1;

        }

        function updateCompleteness() {
            if (!pietentialData.LifeBalanceformID) {
                pietentialData.Part1Completed = 0;
                pietentialData.Part2Completed = 0;
                pietentialData.Part3Completed = 0;
                pietentialData.Part4Completed = 0;
                pietentialData.Part5Completed = 0;
                return;
            }
            
            var flag = 0;
            if (pietentialData.Q0response > 0 && pietentialData.Q1response > 0 && pietentialData.Q2response > 0 && pietentialData.Q3response > 0 && pietentialData.Q4response > 0 && pietentialData.Q5response > 0) {
                pietentialData.Part1Completed = 100;
            }
            if (pietentialData.Q6response > 0 && pietentialData.Q7response > 0 && pietentialData.Q8response > 0 && pietentialData.Q9response > 0 && pietentialData.Q10response > 0 && pietentialData.Q11response > 0) {
                pietentialData.Part2Completed = 100;
            }
            if (pietentialData.Q12response > 0 && pietentialData.Q13response > 0 && pietentialData.Q14response > 0 && pietentialData.Q15response > 0 && pietentialData.Q16response > 0 && pietentialData.Q17response > 0) {
                pietentialData.Part3Completed = 100;
            }
            if (pietentialData.Q18response > 0 && pietentialData.Q19response > 0 && pietentialData.Q20response > 0 && pietentialData.Q21response > 0 && pietentialData.Q22response > 0 && pietentialData.Q23response > 0) {
                pietentialData.Part4Completed = 100;
            }
            if (pietentialData.Q24response > 0 && pietentialData.Q25response > 0 && pietentialData.Q26response > 0 && pietentialData.Q27response > 0 && pietentialData.Q28response > 0 && pietentialData.Q29response > 0) {
                pietentialData.Part5Completed = 100;
            }
        }

        updateCompleteness();


        function showPrivacy() {
            footer.innerHTML = privacy + footer.innerHTML;
            plinks.style.display = "none";
        }

        function returnRandomColor() {
            var colors = `rgba(170, 57, 57,1) 
rgba(255,170,170,1) 
rgba(212,106,106,1) 
rgba(128, 21, 21,1) 
rgba( 85,  0,  0,1) 
rgba(170,108, 57,1) 
rgba(255,209,170,1) 
rgba(212,154,106,1) 
rgba(128, 69, 21,1) 
rgba( 85, 39,  0,1) 
rgba( 34,102,102,1) 
rgba(102,153,153,1) 
rgba( 64,127,127,1) 
rgba( 13, 77, 77,1) 
rgba(  0, 51, 51,1) 
rgba( 45,136, 45,1) 
rgba(136,204,136,1) 
rgba( 85,170, 85,1) 
rgba( 17,102, 17,1) 
rgba(  0, 68,  0,1) `;
            colors = colors.split(/\n/);
            return (shuffle(colors)[0].trim());
        }

        var colorParts = [];
        var part1color = `rgba(255, 99, 132, 1)`;
        var part2color = `rgba(54, 162, 235, 1)`;
        var part3color = `rgba(195, 144, 19, 1)`; //rgb(195, 144, 19);
        var part4color = `rgba(75, 192, 192, 1)`;
        var part5color = `rgba(153, 102, 255, 1)`;

        var part1color = `rgba(110, 148, 248, 1)`;
        var part2color = `rgba(2, 183, 45, 1)`;
        var part3color = `rgba(249, 186, 3, 1)`;
        var part4color = `rgba(248, 126, 2, 1)`;
        var part5color = `rgba(251, 0, 0, 1)`;

        colorParts.push(part1color);
        colorParts.push(part2color);
        colorParts.push(part3color);
        colorParts.push(part4color);
        colorParts.push(part5color);

        var formQuestions = setQdata();
        var out = "";
        var token = 0;
        var endDiv = "";
        var y = 0;
        for (var i = 0; i < formQuestions.length; i++) {
            var thePartNoSpace = formQuestions[i].Part.replace(/\s+/ig, "");
            var thePartNoLetters = thePartNoSpace.replace(/[a-z]+/ig, "");
            thePartNoLetters = parseInt(thePartNoLetters - 1);
            var theSectionTitle = sectionNames[thePartNoLetters];

            if (thePartNoSpace !== token) {
                out += `${endDiv}<div id="${thePartNoSpace}" style="background:${colorParts[y]}; padding:12px;border-radius:8px;color:white;">
                <h2>${theSectionTitle}</h2>On a scale of 1-10, with 1 being I completely disagree with this statement and 10 being I completely agree with this statement, how would you rate each of the following statements?<br><br>`;
                var token = thePartNoSpace;
                endDiv = "</div>";
                //pietentialData[ `${thePartNoSpace}Completed` ] = 0;
                y++;
            }

            out += `<div style="color:white;" id="Q${i}" data-assignedColor="${returnRandomColor()}" ><strong>${formQuestions[i].Subject}</strong>: ${formQuestions[i].Question}. Current Rating: <span id="rangeEchoQ${i}">0</span><br><span id="Q${i}Cat1"></span>
<div  class="rangeHolder">
<!--<input value="0" type="range" min="0" max="10" name="Q${i}response" onchange="addValues();" placeholder="${formQuestions[i].Question} Rate on a 0 - 10 scale" alt="${formQuestions[i]['Part description']}" title="${formQuestions[i].Part}" class="rangeSlider">-->

<div class="rangeHolder">
<input name="Q${i}response" style="display:none;" id="Q${i}responseVal">
    <span onclick="setvalue(1,'Q${i}response' );" class="rangeButton Q${i}response">1</span>
    <span onclick="setvalue(2,'Q${i}response');" class="rangeButton Q${i}response">2</span>
    <span onclick="setvalue(3,'Q${i}response');" class="rangeButton Q${i}response">3</span>
    <span onclick="setvalue(4,'Q${i}response');" class="rangeButton Q${i}response">4</span>
    <span onclick="setvalue(5,'Q${i}response');" class="rangeButton Q${i}response">5</span>
    <span onclick="setvalue(6,'Q${i}response');" class="rangeButton Q${i}response">6</span>
    <span onclick="setvalue(7,'Q${i}response');" class="rangeButton Q${i}response">7</span>
    <span onclick="setvalue(8,'Q${i}response');" class="rangeButton Q${i}response">8</span>
    <span onclick="setvalue(9,'Q${i}response');" class="rangeButton Q${i}response">9</span>
    <span onclick="setvalue(10,'Q${i}response');" class="rangeButton Q${i}response">10</span>
</div>


</div>
<br>
<span class="valueHolder" id="valueHolderQ${i}" style="margin-top:-40px;"></span>

                </div>`;
        }
        partsContainer.innerHTML = out;


        document.body.innerHTML += `<style>
        .color1{background: ${part1color}}
        .color2{background: ${part2color}}
        .color3{background: ${part3color}}
        .color4{background: ${part4color}}
        .color5{background: ${part5color}}
        </style>`;

        pietentialData.currentPart = "part1";
        pietentialData.currentColor = part1color;

        function checkForLogin() {
            if (pietentialData.LifeBalanceEmail) {
                emailCapture.style.display = "none";
                scoreboard.style.display = "none";
                Part1.style.display = "";
                mainForm.style.display = "";
                reLoadFormState();
                pietentialData.chartHide = 1;
            }
        }

        document.addEventListener("DOMContentLoaded", function(event) {
            checkForLogin();
        });

        function lightBox() {
            for (const property in pietentialData) {
                if (property.match(/Q/)) {
                    setvalue(pietentialData[property], property);
                }
            }
        }


        function addValues() {
            //

            //alert(JSON.stringify(pietentialData));
            minibranding.style.display = "block";
            pietentialData.restrequest = "";
            var SA = 0;
            var EC = 0;
            var LB = 0;
            var SN = 0;
            var PN = 0;
            var results = {};
            var d = [];
            
            
            var d = document.querySelectorAll("select, input, textarea");
            var o = "";
            var summary = "";
            var arr = [];
            var obj = {};
            var keys = [];
            pietentialData.LifeBalanceID;
            pietentialData.LifeBalanceEmail;
            pietentialData.LifeBalanceEmail;
            for (var i = 0; i < d.length; i++) {
                summary = d[i].name + ";" + d[i].alt + ";" + d[i].placeholder + "=" + parseInt(d[i].value);
                pietentialData[d[i].name] = parseInt(d[i].value);
                //keys.push(summary);
            }
            //pietentialData.keys = keys;

            


            for (const property in pietentialData) {

                if (property.match(/Q0response|Q1response|Q2response|Q3response|Q4|Q5/g) && Number.isInteger(pietentialData[property])) {
                    SA += parseInt(pietentialData[property]) * 1.66;
                    SA = roundNumber(SA);
                }
                if (property.match(/Q6|Q7|Q8|Q9|Q10|Q11/g) && Number.isInteger(pietentialData[property])) {
                    EC += parseInt(pietentialData[property]) * 1.66;
                    EC = roundNumber(EC);
                }
                if (property.match(/Q12|Q13|Q14|Q15|Q16|Q17/g) && Number.isInteger(pietentialData[property])) {
                    LB += parseInt(pietentialData[property]) * 1.66;
                    LB = roundNumber(LB);
                }
                if (property.match(/Q18|Q19|Q20|Q21|Q22|Q23/g) && Number.isInteger(pietentialData[property])) {
                    //33-38
                    SN += parseInt(pietentialData[property]) * 1.66;
                    SN = roundNumber(SN);
                }
                if (property.match(/Q24|Q25|Q26|Q27|Q28|Q29/g) && Number.isInteger(pietentialData[property])) {
                    //40-45
                    PN += parseInt(pietentialData[property]) * 1.66;
                    PN = roundNumber(PN);
                }
                
                console.log(SA + "; " + EC + "; " + LB + "; " + SN + "; " + PN);

            }
            var LBscorevalues = {};
            LBscorevalues.SA = SA;
            LBscorevalues.EC = EC;
            LBscorevalues.LB = LB;
            LBscorevalues.SN = SN;
            LBscorevalues.PN = PN;
            pietentialData.LBscorevalues = LBscorevalues;
            
            drawChart(SA, EC, LB, SN, PN);
            
            drawBar(SA, EC, LB, SN, PN);
            document.getElementById('results').innerHTML = `SA - ${SA} EC - ${EC} LB - ${LB} SN - ${SN} PN - ${PN}`;
            addWatermark();
            progressBar();
            checkForCompletedForm();
        }

        function calculateGradient(n) {
            var arr = n.split(`j`);
            if (pietentialData.LifeBalanceEmail) {
                //myChart.style.display = "none";
                var bars = document.getElementsByClassName('pbar');
                for (var i = 0; i < bars.length; i++) {
                    //bars[ i ].style.background = 
                    //`linear-gradient(left, ${part2color} 50%, white 50%)`;
                }
            }
        }

        function hideSections() {
            var pse = document.getElementsByTagName('div');
            for (var i = 0; i < pse.length; i++) {
                if (pse[i].id.match(/^Part[0-9]+/ig)) {
                    pse[i].style.display = "none";
                    //pse[ i ].style.opacity = ".2";

                }
            }
            //focusOnCurrentPart();
            window.scrollTo(0, 0);
        }

        function nextsection(id) {
            hideSections();
            if (!pietentialData.LifeBalanceEmail) {
                return;
            }
            var desiredNext = id.replace(/part/ig, "");
            console.log(`desiredNext ` + desiredNext);
            if (desiredNext != 1) {
                var previousPart = `Part` + (desiredNext - 1);
                if (pietentialData[`${previousPart}Completed`] != 100) {
                    alert(`Please fully complete all the sections in order. Score each question from 1 to 10. (You must score at least 1 for each question.)`);
                    focusOnCurrentPart();
                    return;
                }
            }
            document.getElementById(id).style.display = "block";
            
            pietentialData.currentPart = id;
            pietentialData.currentColor = document.getElementById(id).style.background;
            progressBar();
        }
        var onCurrent = 0;



        function focusOnCurrentPart() {
            if (pietentialData.newUser) {
                pietentialData.newUser = "";
                nextsection('Part1');
                return;
            }
            if (pietentialData.Part4Completed == 100) {
                nextsection("Part5");
                onCurrent = 5;
                mainForm.style.display = "";
                return;
            }
            if (pietentialData.Part3Completed == 100) {
                nextsection("Part4");
                onCurrent = 4;
                mainForm.style.display = "";
                return;
            }
            if (pietentialData.Part2Completed == 100) {
                nextsection("Part3");
                onCurrent = 3;
                mainForm.style.display = "";
                return;
            }
            if (pietentialData.Part1Completed == 100) {
                nextsection("Part2");
                onCurrent = 1;
                mainForm.style.display = "";
                return;
            }
            nextsection("Part1");
        }
        if (pietentialData.LifeBalanceEmail) {
            focusOnCurrentPart();
        }

        function progressBar() {
            if (!pietentialData.currentPart || !pietentialData.LifeBalanceEmail) {
                progressGroupTop.style.display = "none";
                return;
            }
            var total = 0;
            var t = 0;
            var qs = 0;
            var w = document.getElementsByTagName("input");
            

            for (var i = 0; i < w.length; i++) {
                if (w[i].value > 0) {
                    t++;
                }

                if (w[i].name.match(/Q/)) {
                    total++;
                }

            }
            console.log(t, total);
            buildProgressBar(t, total);
            buildsectionProgressBar();
        }

        function buildsectionProgressBar() {
            if (!pietentialData.currentPart || !pietentialData.LifeBalanceEmail) {
                return;
            }
            if (!document.getElementById(pietentialData.currentPart)) {
                return;
            }
            var t = 0;
            var total = 0;
            var color = pietentialData.currentColor;
            var q = document.getElementById(pietentialData.currentPart).getElementsByTagName("input");
            for (var i = 0; i < q.length; i++) {
                if (q[i].value > 0) {
                    t++;
                }
                if (q[i].name.match(/Q/)) {
                    total++;
                }
            }

            var percent = Math.floor((t * 100) / total);
            var bars = document.getElementsByClassName('sectionprogress');
            for (var i = 0; i < bars.length; i++) {
                bars[i].style.display = `block`;
                bars[i].style.width = `${percent}%`;
                //bars[ i ].style.background = color;
                bars[i].innerHTML = `${percent}%`;
                bars[i].title = `This section is ${percent}% complete`;
                bars[i].style.display = `none`;
            }
            var currentPart = pietentialData.currentPart;
            pietentialData[`${currentPart}Completed`] = percent;
            
        }


        function checkForCompletedForm() {
            //lightBox();
            pietentialData.flag2 = 0;
            
            makeChartsInVisible();
            for (const property in pietentialData) {
                if(property.match(/^Q/ig) && property.value == 0)
                pietentialData.flag2 = 1;
                processSection.style.display = "none";
                topChartGen.style.display = "none";
            }

            if (location.href.match(/showResults/ig)) {
                minibranding.style.display = "none";
                makeChartsVisible();
                pietentialData.flag2 = 1;
                pietentialData.chartHide = "";
                var resultsURL = `https://pietential.com/?share=${pietentialData.LifeBalanceID}`;
                processSection.innerHTML = ``;
                pietentialData.resultsURL = resultsURL;
                //myChart.style.display = "";
                processSection.style.display = "";

                var ps = processSection.outerHTML;
                
                var urlmessage = `<br>Your personal results URL is:<BR><BR> <a href="${resultsURL}">${resultsURL}</a><BR><BR>You may want to bookmark it.<br>(It also logs you in with a unique ID, so share with caution)
<br><br>
<!--<div class="bt" onclick="sendChartAsPNG('myChart')">Return to editing</div><br>-->`;
                var urlmessage = `<div class="bt" onclick="sendChartAsPNG('myChart')">Return to editing</div><br>`;
                var urlmessage = ``;
                hideSections();
                analyzeit.style.display = "";

                footer.style.display = "block";
                footer.classList.add("padFooter");
                myChart.style.marginTop = "-130px";
            }

            if (pietentialData.Part1Completed == 100 && pietentialData.Part2Completed == 100 && pietentialData.Part3Completed == 100 && pietentialData.Part4Completed == 100 && pietentialData.Part5Completed == 100) {
                if (!pietentialData.formComplete) {
                    sendajaxShifts();
                    pietentialData.formComplete = 1;
                    console.log(pietentialData);
                } else {
                    if (typeof topBar !== "undefined") {
                        if (topBar.innerHTML.match(/You have completed/)) {
                            return;
                        }
                    }
                    formHasBeenCompleted();
                    minibranding.style.display = "none";
                    branding.innerHTML = `<a href="./"><img src="pietential.png" style="width: 90%;max-width: 300px;margin-bottom:10px;margin: auto;"></a><br><br><h1 style="margin-top:4%; opacity:.7;"><span style="font-size:1.4em;">Congratulations!</span><br>You have completed the survey.</h1><br>`;
                    branding.style.display = "";
                    myChart.style.display = "none";
                    processSection.style.display = "";
                    mainForm.style.display = "none";
                    topBar.innerHTML = `You have completed the form 
<button style="width: 155px; display: inline-block;text-align: center;" onclick="location.assign('?showResults');" class="bt">View results</button>

<button style="width: 155px; display: inline-block;text-align: center;" onclick="location.assign('${pietentialData.resultsURL}');" class="bt">Share results on social media</button>
<br>
<button style="width: 155px; display: inline-block;text-align: center;" onclick="location.assign('./?renewFromModal');" class="bt">Clear data and start over</button>`
                }


            }
        }









        function buildProgressBar(t, total) {
            var percent = Math.floor((t * 100) / total);
            var bars = document.getElementsByClassName('pbar');
            for (var i = 0; i < bars.length; i++) {
                if (percent > 60) {
                    bars[i].innerHTML = `Progress: - ${percent}%`;
                }
                if (percent <= 60) {
                    bars[i].innerHTML = `${percent}%`;
                }
                bars[i].style.display = `block`;
                bars[i].style.width = `${percent}%`;
                // bars[ i ].style.background = `rgba(2,183,45,1)`;
                bars[i].style.background = `rgba(50, 86, 86, 1)`;


                var n = [pietentialData.Part1Completed, pietentialData.Part2Completed, pietentialData.Part3Completed, pietentialData.Part4Completed, pietentialData.Part5Completed];
                n[0] = parseInt(n[0]);
                n[1] = parseInt(n[1]);
                n[2] = parseInt(n[2]);
                n[3] = parseInt(n[3]);
                n[4] = parseInt(n[4]);

                if (n[1] < 1) {
                    var grad = `linear-gradient(to right, ${part1color} 0%,${part1color} 100%)`;
                }
                if (n[1] > 1) {
                    var grad = `linear-gradient(to right, 
${part1color} 0%,
${part1color} 50%,
${part2color} 50%,
${part2color} 100%
)`;
                }
                if (n[2] > 1) {
                    var grad = `linear-gradient(to right, 
${part1color} 0%,
${part1color} 33%,
${part2color} 33%,
${part2color} 66%,
${part3color} 66%,
${part3color} 100%
)`;
                }
                if (n[3] > 1) {
                    var grad = `linear-gradient(to right, 
${part1color} 0%,
${part1color} 25%,
${part2color} 25%,
${part2color} 50%,
${part3color} 50%,
${part3color} 75%,
${part4color} 75%,
${part4color} 100%
)`;
                }
                if (n[4] > 1) {
                    var grad = `linear-gradient(to right, 
${part1color} 0%,
${part1color} 20%,
${part2color} 20%,
${part2color} 40%,
${part3color} 40%,
${part3color} 60%,
${part4color} 60%,
${part4color} 80%,
${part5color} 80%,
${part5color} 100%
)`;
                }

                n[0] = n[0] / 5;
                n[1] = n[0] + (n[1] / 5);
                n[2] = n[1] + n[2] / 5;
                n[3] = n[2] + n[3] / 5;
                n[4] = n[3] + n[4] / 5;



                
                bars[i].style.background = grad;
                console.log(grad);

                //progressGroupTop.style.display = "block";
            }
        }

        function sendSummary() {


            var parameters = `summary=${encodeURIComponent(pietentialData.LifeBalanceID)};;;${encodeURIComponent(pietentialData.PDFsummary)}`;
            parameters = parameters.trim();
            var xhttp = new XMLHttpRequest();
            console.log(parameters);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("success.");
                }
            };
            xhttp.open("POST", `pdf.php`, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(parameters);
        }

        function genPNG(el) {
            console.log("opening AJAX connection....");
            var chartPNG = document.getElementById(el).toDataURL("image/png");
            if (el=="myChart"){
                var parameters = `savePNGPIE=${encodeURIComponent(chartPNG)}`;
            }
            if (el=="barchart"){
                var parameters = `savePNGBAR=${encodeURIComponent(chartPNG)}`;
            }
            parameters = parameters.trim();
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("success.");
                }
            };
            xhttp.open("POST", `index.php`, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(parameters);
        }

        function sendChartAsPNG(el) {
            console.log("opening AJAX connection....");
            //pietentialData.chartPNG = document.getElementById(el).toDataURL("image/png");
            if (el==`myChart`){
            var parameters = `savePNGPIE=${encodeURIComponent(pietentialData.chartPNG)}`;
            }
            if (el==`barchart`){
            var parameters = `savePNGBAR=${encodeURIComponent(pietentialData.chartPNG)}`;
            }
            parameters = parameters.trim();
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("success.");
                    if (pietentialData.LifeBalanceDownload == 1) {
                        pietentialData.LifeBalanceDownload = 0;
                        location.assign('?download=true');

                    } else {
                        location.assign('?home');
                    }

                }
            };
            xhttp.open("POST", `index.php`, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(parameters);
        }

        function sendajaxShifts() {

            var payload = JSON.stringify(pietentialData);
            console.log("opening AJAX connection....");
            var filename = pietentialData.LifeBalanceEmail + ".json.txt";
            var parameters = "LifeBalanceformData=" + payload;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("success.");
                }
            };
            xhttp.open("POST", `index.php`, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(parameters);
        }

        var counter = 0;
        if (pietentialData.LifeBalanceEmail && counter < 300) {

            setInterval(function() {
                if (counter < 5) {
                    sendajaxShifts();
                    console.log("Counter: " + counter);
                }
                counter++;
            }, 7000);

        }

        function download() {
            pietentialData.LifeBalanceDownload = 1;
            sendChartAsPNG('myChart');
        }

        function reLoadFormState() {
            var obj = pietentialData;
            for (const property in obj) {
                if (document.getElementsByName(property)[0]) {
                    document.getElementsByName(property)[0].value = obj[property];
                }
            }
        }

        function formHasBeenCompleted() {
            // branding.style.display = "none";
            branding2.style.display = "none";
            minibranding.style.display = "none";
        }
        var hety = 0;

        function roundNumber(n){
            n = Math.round(n);
            if(n>98){
                n = 100;
            }
            if (n==59 || n==58){
                n=60;
            }
            return(n);
        }

        function drawChartMini(b, l, a, c, k) {
            // b = roundNumber(b);
            // l = roundNumber(l);
            // a = roundNumber(a);
            // c = roundNumber(c);
            // k = roundNumber(k);
            var ctx = document.getElementById('myChart').getContext('2d');
            var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
            var alphaValue = 1;
            var border1 = part1color;
            var border2 = part2color;
            var border3 = part3color;
            var border4 = part4color;
            var border5 = part5color;

            var fill1 = part1color.replace(" 1)", `${alphaValue})`);
            var fill2 = part2color.replace(" 1)", `${alphaValue})`);
            var fill3 = part3color.replace(" 1)", `${alphaValue})`);
            var fill4 = part4color.replace(" 1)", `${alphaValue})`);
            var fill5 = part5color.replace(" 1)", `${alphaValue})`);
            var myChart = new Chart(ctx, {
                //type: toggle,
                type: 'polarArea',
               // type: 'doughnut',
                data: {
                    labels: ls,
                    datasets: [{
                        label: 'Score',
                        data: [b, l, a, c, k],
                        backgroundColor: [
                            fill1,
                            fill2,
                            fill3,
                            fill4,
                            fill5
                        ],
                        borderColor: [
                            border1,
                            border2,
                            border3,
                            border4,
                            border5
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    watermark: {
                        image: "watermark.png",

                        alignY: "bottom",
                        alignX: "right",
                        width: "20%",
                        height: "45%",
                        position: "back",
                    },
                    scale: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                display: false
                             }
                        }],
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                display: false
                             }
                        }]
                    }
                }
            });


        }

        function drawBar(b, l, a, c, k) {
            // b = roundNumber(b);
            // l = roundNumber(l);
            // a = roundNumber(a);
            // c = roundNumber(c);
            // k = roundNumber(k);
var ctx = document.getElementById('barchart').getContext('2d');
var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
var alphaValue = 1;
var border1 = part1color;
var border2 = part2color;
var border3 = part3color;
var border4 = part4color;
var border5 = part5color;

var fill1 = part1color.replace(" 1)", `${alphaValue})`);
var fill2 = part2color.replace(" 1)", `${alphaValue})`);
var fill3 = part3color.replace(" 1)", `${alphaValue})`);
var fill4 = part4color.replace(" 1)", `${alphaValue})`);
var fill5 = part5color.replace(" 1)", `${alphaValue})`);
var barchart = new Chart(ctx, {
    //type: toggle,
    type: 'bar',
   // type: 'doughnut',
    data: {
        labels: ls,
        datasets: [{
            label: 'Your score',
            data: [b, l, a, c, k],
            backgroundColor: [
                fill1,
                fill2,
                fill3,
                fill4,
                fill5
            ],
            borderColor: [
                border1,
                border2,
                border3,
                border4,
                border5
            ],
            borderWidth: 1
        }]
    },

    options: {
        // watermark: {
        //     image: "watermark.png",

        //     alignY: "top",
        //     alignX: "right",
        //     width: "20%",
        //     height: "45%",
        //     position: "back",
        // },
        legend: {
    display: false,
},
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    max:100
                }
            }]
        }
        
        
    }
});




}


function makeChartsVisible(){
    document.getElementById("myChart").style.display = "block";
    document.getElementById("barchart").style.display = "block";
}

function makeChartsInVisible(){
    document.getElementById("myChart").style.display = "none";
    document.getElementById("barchart").style.display = "none";
}

        function drawChart(b, l, a, c, k) {
            // b = roundNumber(b);
            // l = roundNumber(l);
            // a = roundNumber(a);
            // c = roundNumber(c);
            // k = roundNumber(k);
            if (!location.href.match(/anal/)) {
                formHasBeenCompleted();
            }

            updateTextInput();


            if (pietentialData.chartHide == 1 && !location.href.match(/anal/)) {
                return;
            }
            if (hety > 0) {

                return;
            }
            hety++;



            var toggle = shuffle(['polarArea', "line", "pie", "bar", 'radar', 'doughnut', ])[0];
            //var toggle = 'doughnut';
            cc.innerHTML = "";
            scoreboard.outerHTML += `<div style="text-align:center;">
            <a href="./"><img src="pietential.png" style="width: 10%;max-width: 500px;margin-bottom:10px;margin: auto;"></a>
            <h1>Your Growth Potential Visualized</h1>

            <!--
            <button class="bt" style="margin: 0px; display: inline-block; width: 120px; text-align: center;" onclick="location.assign('?analyzeit')">Analyze It</button>

            <button class="bt" onclick="sendChartAsPNG('myChart')" style="margin: 0px; display: inline-block; width: 120px; text-align: center;">Return to Home</button> 

<button class="bt" onclick="location.assign('https://pietential.com/?share=discover');" class="bt">Share results on social media</button>

<button class="bt" onclick="download()">Download chart</button>

<button class="bt" id="facebookGroup" onclick="location.assign('https://www.facebook.com/GrowThePie/')">Join the Facebook group</button>
</div>
-->
<div>
<canvas id="myChart"  style="width:90%;  top:100px;"  class="chart"></canvas>
<canvas id="barchart"  style="width:90%;  top:100px;"  class="chart"></canvas>
</div> `;
            var datesHTML = "";

            //            if (pietentialData.LifeBalanceDates) {
            //                var datesHTML = `<div id='previousDates' style="border: 1px solid gray; padding: 12px; font-family: sans-serif; border-radius: 8px; line-height: 1.5em; margin:auto; margin-top:40px;opacity: 0.7; max-width:400px; font-size: 14px; font-weight: bold; background: rgb(238, 238, 238);">Your results by date:<br><br>`;
            //                var dateArr = JSON.parse(pietentialData.LifeBalanceDates);
            //                for (var i = 0; i < dateArr.length; i++) {
            //                    datesHTML += `<a href="?loadDate=${dateArr[i]}">${dateArr[i]}</a><br>`;
            //                }
            //                datesHTML += `</div>`;
            //            }

            scoreboard.outerHTML += datesHTML;
            //previousDates.style.margin = "7%";
            cc.innerHTML = ``;
            mainformParent.style.display = "none";

            bigChart.innerHTML = `<canvas id="bc"  width="1500" height="1500" class="chart"></canvas>`;
            var ctx = document.getElementById('myChart').getContext('2d');


            if (!pietentialData.LifeBalanceEmail) {
                hideSections();
                var rgb = ``;
                var colors = [0, 100, 200, 150, 220, 30, 129, 20, 90, 210, 243];
                var alpha = [.1, .2, .3, .4, .5, .6];
                var fill1 = `rgba(${shuffle(colors)[0]}, ${shuffle(colors)[0]}, ${shuffle(colors)[0]}, .2)`;
                var fill2 = `rgba(${shuffle(colors)[0]}, ${shuffle(colors)[0]}, ${shuffle(colors)[0]}, .2)`;
                var fill3 = `rgba(${shuffle(colors)[0]}, ${shuffle(colors)[0]}, ${shuffle(colors)[0]}, .2)`;
                var fill4 = `rgba(${shuffle(colors)[0]}, ${shuffle(colors)[0]}, ${shuffle(colors)[0]}, .2)`;
                var fill5 = `rgba(${shuffle(colors)[0]}, ${shuffle(colors)[0]}, ${shuffle(colors)[0]}, .2)`;
                var border1 = fill1.replace(".2)", " .61)");
                var border2 = fill2.replace(".2)", " .61)");
                var border3 = fill3.replace(".2)", " .61)");
                var border4 = fill4.replace(".2)", " .61)");
                var border5 = fill5.replace(".2)", " .61)");


            }
            if (pietentialData.LifeBalanceEmail) {
                branding.style.display = "none";
                scoreboard.style.display = "none";
                //mainForm.style.marginTop = "-75px";

                var alphaValue = .5;
                var alphaValue = .8;


                var border1 = part1color;
                var border2 = part2color;
                var border3 = part3color;
                var border4 = part4color;
                var border5 = part5color;

                var fill1 = part1color.replace(" 1)", `${alphaValue})`);
                var fill2 = part2color.replace(" 1)", `${alphaValue})`);
                var fill3 = part3color.replace(" 1)", `${alphaValue})`);
                var fill4 = part4color.replace(" 1)", `${alphaValue})`);
                var fill5 = part5color.replace(" 1)", `${alphaValue})`);

            }

            var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];

            if (!pietentialData.LifeBalanceEmail) {
                ls = shuffle(ls);
            }


            var myChart = new Chart(ctx, {
                //type: toggle,
                type: 'polarArea',
                //type: 'bar',
               // type: 'doughnut',
                data: {
                    labels: ls,
                    datasets: [{
                        label: 'Score',
                        data: [b, l, a, c, k],
                        backgroundColor: [
                            fill1,
                            fill2,
                            fill3,
                            fill4,
                            fill5
                        ],
                        borderColor: [
                            border1,
                            border2,
                            border3,
                            border4,
                            border5
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    
                    watermark: {
                        image: "watermark.png",

                        alignY: "bottom",
                        alignX: "right",
                        width: "20%",
                        height: "45%",
                        position: "back",
                    },
                    scale: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                display: false
                             }
                        }],
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                display: false
                             }
                        }]
                    }
                }
            });
            if (pietentialData.LifeBalanceEmail) {
                //myChart.style.display = "none";
            }

        }

        function addWatermark() {
            //myChart.style.background = "url(watermark.png) 100% 100% / 14% no-repeat";
            // myChart.style.backgroundRepeat = "no-repeat";
            // myChart.style.backgroundPositionX = "right";
            // myChart.style.backgroundPositionY = "bottom";
        }


        function updateTextInput() {

            var t = document.getElementsByTagName("input");
            for (var i = 0; i < t.length; i++) {
                if (t[i].name.match(/Q/ig)) {
                    var qvalue = t[i].name.match(/Q[0-9]+/ig);
                    if (document.getElementById(`rangeEcho${qvalue}`)) {
                        document.getElementById(`rangeEcho${qvalue}`).innerHTML = t[i].value;
                    }

                }
            }

        }



        function shuffle(array) {
            var currentIndex = array.length,
                temporaryValue, randomIndex;
            // While there remain elements to shuffle...
            while (0 !== currentIndex) {
                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;
                // And swap it with the current element.
                temporaryValue = array[currentIndex];
                array[currentIndex] = array[randomIndex];
                array[randomIndex] = temporaryValue;
            }
            return array;
        }

        function getmail() {
            //alert(JSON.stringify(pietentialData));
            var em = email.value.trim();

            if (em.match(/[a-z0-9]\@[a-z0-9]/ig) && em.match(/\.[a-z0-9]/ig)) {
                mainForm.style.display = "";
                emailCapture.style.display = "none";
                pietentialData.LifeBalanceformData = "";
                pietentialData.LifeBalanceEmail = em;
                resetForm();
                pietentialData.LifeBalanceformData = "";
                pietentialData.LifeBalanceEmail = em;
                document.cookie = "LifeBalanceEmail="+em;
                var payload = JSON.stringify(pietentialData);
            // send to ajax to save
            console.log("opening AJAX connection....");
            var parameters = "LifeBalanceformData=" + payload;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("success.");
                    location.assign('?eg=1');
                }
            };
            xhttp.open("POST", `index.php`, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(parameters);
        }

                
             else {
                alert("please enter your valid email address");
            }
        }

        if (location.href.match(/\?eg\=1/)) {
            branding.style.display = "none";
        }

        function destroyModal(innerH) {
            var z = document.getElementsByClassName("editDiv");
            for (var i = 0; i < z.length; i++) {
                z[i].outerHTML = "";
            }
        }

        function createModal(innerH) {
            var editDiv = document.createElement('div');
            editDiv.id = "editDiv";
            editDiv.innerHTML = `<div id="closeIcon" style="z-index: 8; position: absolute; right: -15px; top: 9px; cursor: pointer; color: black; font-size: 40px; font-weight: 900;"><a><img onclick="destroyModal();" src="https://pva-cdnendpoint.azureedge.net/prod/libraries/media/pva/library/close-icon2.png" style="width: 40px; /*filter: brightness(1);*/"></a></div>`;
            document.getElementById("mainForm").appendChild(editDiv);
            editDiv.innerHTML += innerH;
            editDiv.classList.add(`editDiv`);
            hideSections();
        }

        function resetForm() {
            mainForm.style.display = "block";
            emailCapture.style.display = "none";

            if (pietentialData.LifeBalanceEmail) {
                reLoadFormState();
            } else {
                var d = document.querySelectorAll("input");
                for (var i = 0; i < d.length; i++) {
                    if (d[i].name.match(/Q/)) {
                        d[i].value = 0;
                    }

                }
            }
            addValues();
        }

        function assignRandom() {
            var b = shuffle([10, 20, 30, 40, 50, 60])[0];
            var l = shuffle([10, 20, 30, 40, 50, 60])[0];
            var a = shuffle([10, 20, 30, 40, 50, 60])[0];
            var c = shuffle([10, 20, 30, 40, 50, 60])[0];
            var k = shuffle([10, 20, 30, 40, 50, 60])[0];
            drawChart(b, l, a, c, k);
        }


        var counterNewUser = 0;
        if (!pietentialData.LifeBalanceEmail) {
            mainForm.style.display = "";
            progressGroup.style.display = "none";
            partPicker.style.display = "none";

            //assignRandom();

            setInterval(function() {
                if (counterNewUser < 15) {
                    // assignRandom();
                    // hideSections();
                }
                counterNewUser++;
            }, 1200);
        } else {
            mainForm.style.display = "";
            progressGroup.style.display = "";
            partPicker.style.display = "";
            score.innerHTML = "ID: " + pietentialData.LifeBalanceEmail + ` <input type="submit" value="Reload previous reponses" onclick="reLoadFormState();" style="display:inline; float:right;width: 245px;"><br>Your score:`;
            resetForm();
        }

        function removeDescriptionAndScore(id, scoreName) {
            var el = document.getElementById(id);
            var el60 = document.getElementById(id + '60');
            var em = document.getElementById("scoreSummary");
            var sv = pietentialData.LBscorevalues;
            var score = sv[scoreName];
            //score = roundNumber(score);
            if(score>98){
                score=100;
            }
            var headline = el.getElementsByTagName("strong")[0];
            var headline60 = el60.getElementsByTagName("strong")[0];
            var secName = headline.innerHTML;
            headline.innerHTML += `: Your score: ${score}/100`;
            headline60.innerHTML += `: Your score: ${score}/100`;
            //pietentialData.PDFsummary += headline.innerHTML;



            if (score > 59) {


                headline60.innerHTML += `<br><i style="color:#377dd4;">Suggestions for improvement:</i> `;
                pietentialData.PDFsummary += headline60.innerHTML;
                pietentialData.PDFsummary += el60.innerHTML;
                //pietentialData.PDFsummary += el.innerHTML
                pietentialData.svTotal++;
                el.style.display = "none";
                //alert("the score is "+score);
            } else {
                el60.style.display = "none";
                headline.innerHTML += `<br><i style="color:#377dd4;">Suggestions for improvement:</i> `;
                em.innerHTML += `<div style="color:#94083b;margin-top:5px;"><b>${secName}</b>: ${score}%  (needs improvement)</div>`;
                pietentialData.PDFsummary += em.innerHTML;
                // pietentialData.PDFsummary += headline.innerHTML;
            }
            if (pietentialData.svTotal > 4) {
                //  responderIntro.innerHTML = `<br><br><b>You have a Pietential score over 200.</b><br>Well done! At this time your life balance appears to be healthy. Keep doing what you are doing!<br><br>`;
                //  pietentialData.PDFsummary += responderIntro.innerHTML
            }
        }

        function analyzeitFunc() {
            pietentialData.PDFsummary = "";
            pietentialData.svTotal = 0;
            pietentialData.analyzeit = 1;
            buildPage(responder);
            shellContent.style.maxWidth = "800px";
            shellContent.style.margin = "auto";
            shellContent.style.boxSizing = "border-box";
            shellContent.style.padding = "20px";
            addFooter();
            explainer.style.display = "none";
            branding.style.display = "none";
            emailCapture.style.display = "none";
            removeDescriptionAndScore(`responderPhysiological`, `PN`);
            removeDescriptionAndScore(`responderActualization`, `SA`);
            removeDescriptionAndScore(`responderEsteem`, `EC`);
            removeDescriptionAndScore(`responderSafety`, `SN`);
            removeDescriptionAndScore(`responderLove`, `LB`);
            document.getElementById("minichart").innerHTML = `<div><canvas id="myChart"  style="width:90%;" class="chart"></canvas>
            <canvas id="barchart"  style="width:90%;  class="chart"></canvas></div>`;
            var f = pietentialData.LBscorevalues;
            var SA = f.SA;
            var EC = f.EC;
            var LB = f.LB;
            var SN = f.SN;
            var PN = f.PN;
            drawChartMini(SA, EC, LB, SN, PN);
            
            drawBar(SA, EC, LB, SN, PN);
            sendSummary();
        }

        function addFooter() {
            if (!document.body.innerHTML.match(/id="footer"/)) {
                document.body.innerHTML += `<?= file_get_contents("footer.html") ?>`;

            }
        }

        function showPrivacy() {
            footer.innerHTML = privacy + footer.innerHTML;
            plinks.style.display = "none";
        }

        function movebranding() {
            branding.style.display = "none";
            branding2.innerHTML = branding.innerHTML;
            if (branding2.innerHTML.match(/Congratulations/)) {
                branding2.style.display = "none";
            }
        }

        function setvalue(n, className) {
            var idname = `${className}Val`;
            document.getElementById(idname).value = n;
            document.getElementById(idname).setAttribute('value', n);
            //alert(idname);
            pietentialData[className] = n;
            addValues();
            makeAllButtonsBlack(className);
            window[className] = n;
            var r = document.getElementsByClassName(className);
            for (var i = 0; i < r.length; i++) {
                var val = parseInt(r[i].innerHTML);
                if (val <= n) {
                    r[i].style.background = "rgb(55, 125, 212)";
                    r[i].style.opacity = "1";
                }
                if (val == n) {
                    r[i].style.background = "rgb(24, 75, 138)";
                }
            }
            //alert(Q0response);
        }

        function makeAllButtonsBlack(className) {
            var r = document.getElementsByClassName(className);
            for (var i = 0; i < r.length; i++) {
                r[i].style.background = "black";
                r[i].style.opacity = ".2";
            }
        }

     

        function openpdf() {
            document.body.outerHTML = `
           <body style="padding:0;margin:0;background: black;height:100%">
    <div style="padding: 0%;  text-align:center; width: 100%;">
        <div
            style="padding: 20%;     background: black;     color: white;     text-align: center;     width: 50%;     margin: 20;">
            <div class="donutSpinner"></div><br><br>
            Generating PDF...<br><br>Once the PDF is downloaded you may close this window or go back.<br><br><br><br> <button class="bt" onclick="window.history.back();"
                style="margin: 0px; display: inline-block; width: 120px; text-align: center;">Go back</button> </div>
    </div>
</body>`;

            location.assign(`?pdf=` + pietentialData.LifeBalanceID);
        }

        document.addEventListener("DOMContentLoaded", function(event) {
            lightBox();
            if (location.href.match(/showResults/ig)) {
                
                minibranding.style.display = "none";
                myChart.style.display = "";
                partPicker.style.display = "none";
                progressGroupTop.style.display = "none";
                partPickerBottom.style.display = "none";
                pbarParent.style.display = "none";
                branding.style.display = "none";
                hideSections();
                makeChartsVisible();
                return;
            }
            hideSections();
            focusOnCurrentPart();
            if (!pietentialData.LifeBalanceEmail) {
                progressGroupTop.style.display = "none";
            } else {
                myChart.style.display = "";
                movebranding();

            }
            if (!location.href.match(/edit/ig)) {
                checkForCompletedForm();

            }
            if (location.href.match(/\?sim/)) {
                sim();
            }
            if (location.href.match(/\?analyze/)) {
                analyzeitFunc();
            }
            if (pietentialData.adminBar && adminBar) {
                adminBar.style.display = "block";
            }

            // if (pietentialData.adminView && resultsAsText) {
            //     resultsAsText.style.display = "";
            // }
            if (pietentialData.Part5Completed && typeof mainForm !== 'undefined') {
                // Part1.style.display = "none";
                // Part2.style.display = "none";
                // Part3.style.display = "none";
                // Part4.style.display = "none";
                // Part5.style.display = "none";
                mainForm.style.display = "none";
            }
            if (pietentialData.formComplete) {
                analyzeitFunc();
            }

        });
    </script>

    <?php
    echo $googleAnalyics;
    echo $twitterCard;
    ?>



</body>

</html>