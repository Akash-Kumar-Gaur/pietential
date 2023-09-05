<?php
extract($_GET);
extract($_POST);
// analyzseit/index.php
$fullURL = "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if (!$_COOKIE['percent']) {
    header("Location: /?no-percent(analyse)");
    exit;
}
if (!$_COOKIE['email']) {
    setcookie('dashboard', '', time() + 7776000, "/");
    setcookie('percent', '', time() + 7776000, "/");
    setcookie('email', '', time() + 7776000, "/");
    setcookie('userID', '', time() + 7776000, "/");
    echo "<script> location.assign(`/?no-email-found(analyze)`)</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pietential</title>
    <link href="../styles.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="https://pietential.com/social.php">
    <meta name="twitter:creator" content="@hankenstein">
    <meta name="twitter:title" content="Realize Your Growth Potential in 5 Minutes">
    <meta name="twitter:description" content="Pietential is a survey-based life balance visualization tool based on Maslow’s Hierarchy of needs.">
    <meta name="twitter:image" content="http://pietential.com/pie-social-banner.png">
    <meta property="og:url" content="https://pietential.com/social.php" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Realize Your Growth Potential in 5 Minutes" />
    <meta property="og:description" content="Pietential is a survey-based life balance visualization tool based on Maslow’s Hierarchy of needs." />
    <meta property="og:image" content="http://pietential.com/pie-social-banner.png" />
    <script>
        if (!window.location.href.match(/https/ig)) {
            location.assign(`https://pietential.com/`);
        }
        if (window.location.href.match(/jstar/ig)) {
            location.assign(`https://pietential.com/`);
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <script src="https://pietential.com/chartjs-plugin-watermark.js"></script>
    <?php
    $userID = $_COOKIE['userID'];
    //echo file_get_contents("https://pietential.com/pielet/generate-login-bar.php?userID=$userID&fullURL=$fullURL");
    ?>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117957204-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-117957204-2');
    </script>
</head>

<body>

    <?php echo file_get_contents("../../navbar.html"); //new nav 10/26 
    ?>


    <div id="minibranding" style="padding-top:50px;margin: auto; text-align: center;">
        <a href="#"><img onmouseover="" src="https://pietential.com/pietential.png" class="minibrand"></a>
    </div>
    <div id="scoreboard"></div>
    <div id="analyze" style="display:none;">
        <div id="shellContent" style="max-width: 1200px; margin: auto; box-sizing: border-box; padding: 20px;">
            <!-- <a href="#"
style="display: block; text-align:center;"><img onmouseover="" src="https://pietential.com/pietential.png"
style="width:200px;"></a>
<div id="adminBar"></div>
<br><br><br> -->
            <div id="scoreSummary" style="display:none;"><b>Your Scores:</b><br><br>
                <div style="color:#94083b;margin-top:5px;"><b>Physiological Needs</b>: 57% (needs improvement)</div>
                <div style="color:#94083b;margin-top:5px;"><b>Self-Esteem and Contribution</ your chartb>: 53% (needs improvement)
                </div>
                <div style="color:#94083b;margin-top:5px;"><b>Safety Needs</b>: 54% (needs improvement)</div>
                <div style="color:#94083b;margin-top:5px;"><b>Love and Belonging</b>: 56% (needs improvement)</div>
            </div><br>
            <div id="responderIntro"><b>
                    <div style="padding-bottom:65px; text-align:center;">
                        <!--<div class="bt" id="" style="background:#fb0000;font-size: 34px;padding: 10px 20px;margin:auto;" >Pietential private analysis</div>-->
                        <div style="font-weight:bold;font-size: 34px;padding: 10px 20px;margin:auto; box-sizing:border-box;">Your Pietential Analysis</div>
                    </div>
                    According to the answers you recently supplied to Pietential, the following areas of life have been
                    identified as
                    having considerable growth potential for you.
                </b><br>
                 <br>
            </div>

            <div id="responderActualization" class="analyzeborder">
                <strong>Self Actualization: Your score: <span id="SAscore"></span>/100</strong><br><br>
                <span id="SAtext"></span>
            </div>
            
            <div id="responderEsteem" class="analyzeborder">
                <strong>Self-Esteem and Contribution: Your score: <span id="ECscore"></span>/100</strong><br><br><span id="ECtext"></span>
            </div>
            
            <div id="responderLove" class="analyzeborder">
                <strong>Love and Belonging: Your score: <span id="LBscore"></span>/100</strong><br><br>
                <span id="LBtext"></span>
            </div>
            
            <div id="responderSafety" class="analyzeborder">
                <strong>Safety Needs: Your score: <span id="SNscore"></span>/100</strong><br><br>
                <span id="SNtext"></span>
            </div>

            <div id="responderPhysiological" class="analyzeborder">
                <strong>Physiological Needs: Your score: <span id="PNscore"></span>/100</strong><br><br>
                <span id="PNtext"></span>
            </div>
           
            <!--
<hr>
This set of recommendations was generated for you algorithmically by Pietential, based on your responses to
the Pietential survey. We want you to realize your full potential, and we encourage you to join the
Pietential Growth Group on FaceBook. It’s a small, but growing group of people committed to realizing their
potential, and helping others reach theirs. It is a private group, and you are invited to participate.
-->
             <br>
             <br>
            <div id="minichart">
                <!-- <div>
<canvas id="myChartA" style="width: 760px; display: block; height: 380px;"
class="chart chartjs-render-monitor" width="760" height="380"></canvas>
<canvas id="barchartA" style="width: 760px; display: block; height: 380px;" chart"="" width="760"
height="380" class="chartjs-render-monitor"></canvas></div> -->
            </div>
            <div style="text-align:center;" onmouseover="genPNG('barchart');">
                <!-- <button class="bt" onclick="" style="margin: 0px; display: inline-block; width: 120px; text-align: center;">Return to Home</button> -->
                <!--<button class="bt" onclick="socialShare();">Share your Pietential</button>-->
                <div id="printMan" style="display:none;
margin: auto;position: absolute;
left:.5%;
text-align: center;
">
                    <div style="
position:relative;
background: #eeeeee;
width: 400px;
padding: 30px;
border-radius: 7px;
overflow: visible;
box-sizing: border-box;
box-shadow: rgb(0, 0, 0) 10px 10px 52px 0px;
z-index:9;
margin: auto;
">
                        <!--A new window will open. When prompted, choose "Save as PDF" in the print dialog box.<br><br>-->
                        <button class="bt" id="pdfd" onclick="hide(`printMan`);
window.open(`https://pietential.com/pielet/pdf.php?genHTML=${pieletData.userID}`);" style="font-size:20px; padding:1% 8%;">Open window to save as PDF or print</button>
                        <br><br>
                        <button class="bt" onclick="hide('printMan')" style="font-size:20px; padding:1% 8%;background-color:#242f3e;">Cancel</button>
                    </div>
                </div>
                <!--<button onmouseover="genPNG('myChart');" class="bt" id="pdfd" onclick="show('printMan')" >Download or Print Private Analysis</button>
-->
                <button class="bt" id="realizebutton" onclick="location.assign('/pielet/dashboard')">Realize it ➜</button>
                <br><br>
            </div>
            <br><br>
            <!--*Only your Visualization will be shared - not your Analysis
<br>-->
        </div>
    </div>
    <script>
        var part1color = `rgba(110, 148, 248, 1)`; //blue
        var part2color = `rgba(2, 183, 45, 1)`; //green
        var part3color = `rgba(249, 186, 3, 1)`; // yellow
        var part4color = `rgba(248, 126, 2, 1)`; // orange
        var part5color = `rgba(251, 0, 0, 1)`; // red
        var colorParts = [];
        colorParts.push(part1color);
        colorParts.push(part2color);
        colorParts.push(part3color);
        colorParts.push(part4color);
        colorParts.push(part5color);
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
        if (localStorage.pieletDataJSON) {
            pieletData = JSON.parse(localStorage.pieletDataJSON);
        }
        var f = pieletData.LBscorevalues;
        var SA = f.SA;
        var EC = f.EC;
        var LB = f.LB;
        var SN = f.SN;
        var PN = f.PN;

        function getAnalysis() {
            var queryString = '';
            for (let a in pieletData) {
                if (a.match(/^Q[0-9]/)) {
                    var valueT = pieletData[a];
                    queryString += `&${a}=${valueT}`;
                }
            }
            queryString = `../calcEngine/?userID=${pieletData.userID}&mode=calc${queryString}`;
            console.log(queryString);

            fetch(queryString)
                .then(r => {
                    return r.text()
                })
                .then(a => {
                    var pieletR = JSON.parse(a);
                    console.log(pieletR);
                    localStorage.analysis = a;
                    document.getElementById("SAscore").innerHTML = pieletR.SA;
                    document.getElementById("ECscore").innerHTML = pieletR.EC;
                    document.getElementById("LBscore").innerHTML = pieletR.LB;
                    document.getElementById("SNscore").innerHTML = pieletR.SN;
                    document.getElementById("PNscore").innerHTML = pieletR.PN;
                    document.getElementById("SAtext").innerHTML = pieletR.SAresponse;
                    document.getElementById("ECtext").innerHTML = pieletR.ECresponse;
                    document.getElementById("LBtext").innerHTML = pieletR.LBresponse;
                    document.getElementById("SNtext").innerHTML = pieletR.SNresponse;
                    document.getElementById("PNtext").innerHTML = pieletR.PNresponse;
                    // pieletData.PDFsummary += pieletR.SAresponse;
                    // pieletData.PDFsummary += pieletR.ECresponse;
                    // pieletData.PDFsummary += pieletR.LBresponse;
                    // pieletData.PDFsummary += pieletR.SNresponse;
                    // pieletData.PDFsummary += pieletR.PNresponse;
                    pieletData.SAresponse = pieletR.SAresponse;
                    pieletData.ECresponse = pieletR.ECresponse;
                    pieletData.LBresponse = pieletR.LBresponse;
                    pieletData.SNresponse = pieletR.SNresponse;
                    pieletData.PNresponse = pieletR.PNresponse;

                    localStorage.pieletDataJSON = JSON.stringify(pieletData);
                });
        }


        getAnalysis();






        function removeDescriptionAndScore(id, scoreName) {
            var el = document.getElementById(id);
            var el60 = document.getElementById(id + '60');
            var em = document.getElementById("scoreSummary");
            var sv = pieletData.LBscorevalues;
            var score = sv[scoreName];
            //score = roundNumber(score);
            if (score > 98) {
                score = 100;
            }
            var headline = el.getElementsByTagName("strong")[0];
            var headline60 = el60.getElementsByTagName("strong")[0];
            var secName = headline.innerHTML;
            headline.innerHTML += `: Your score: ${score}/100`;
            headline60.innerHTML += `: Your score: ${score}/100`;
            //pieletData.PDFsummary += headline.innerHTML;
            if (score > 59) {
                headline60.innerHTML += `<br><i style="color:#377dd4;">Suggestions for improvement:</i> `;
                pieletData.PDFsummary += headline60.innerHTML;
                pieletData.PDFsummary += el60.innerHTML;
                //pieletData.PDFsummary += el.innerHTML
                pieletData.svTotal++;
                el.style.display = "none";
                el60.style.display = "";
                //alert("the score is "+score);
            } else {
                el60.style.display = "none";
                el.style.display = "";
                headline.innerHTML += `<br><i style="color:#377dd4;">Suggestions for improvement:</i> `;
                em.innerHTML += `<div style="color:#94083b;margin-top:5px;"><b>${secName}</b>: ${score}% (needs improvement)</div>`;
                pieletData.PDFsummary += em.innerHTML;
                // pieletData.PDFsummary += headline.innerHTML;
            }
        }
        // removeDescriptionAndScore(`responderPhysiological`, `PN`);
        // removeDescriptionAndScore(`responderActualization`, `SA`);
        // removeDescriptionAndScore(`responderEsteem`, `EC`);
        // removeDescriptionAndScore(`responderSafety`, `SN`);
        // removeDescriptionAndScore(`responderLove`, `LB`);
        analyze.style.display = "block";

        function drawBar(b, l, a, c, k) {
            var ctx2 = document.getElementById('barchart').getContext('2d');
            var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
            var alphaValue = 1;
            Chart.defaults.global.defaultFontSize = 18;
            var barchart = new Chart(ctx2, {
                type: 'bar',
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
                    // image: "https://pietential.com/watermark.png",
                    // alignY: "top",
                    // alignX: "right",
                    // width: "20%",
                    // height: "45%",
                    // position: "back",
                    // },
                    legend: {
                        display: false,
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                max: 100
                            }
                        }]
                    }
                }
            });
        }

        function makeChartsVisible() {
            document.getElementById("myChart").style.display = "block";
            document.getElementById("barchart").style.display = "block";
        }

        function makeChartsInVisible() {
            document.getElementById("myChart").style.display = "none";
            document.getElementById("barchart").style.display = "none";
        }

        function drawChart(b, l, a, c, k) {
            //updateTextInput();
            if (pieletData.chartHide == 1 && !location.href.match(/anal/)) {
                console.log(`drawChart halted`);
                return;
            }
            // if (hety > 0) {
            // //return;
            // }
            // hety++;
            //var toggle = shuffle(['polarArea', "line", "pie", "bar", 'radar', 'doughnut',])[0];
            //var toggle = 'doughnut';
            //cc.innerHTML = "";
            document.getElementById("scoreboard").outerHTML += `<div style="text-align:center;">
<h1>Your Growth Potential Visualized</h1>
<!--
<button class="bt" style="margin: 0px; display: inline-block; width: 120px; text-align: center;" onclick="analyzeit()">Analyze It</button>
<button class="bt" onclick="sendChartAsPNG('myChart')" style="margin: 0px; display: inline-block; width: 120px; text-align: center;">Return to Home</button> 
<button class="bt" onclick="socialShare();" class="bt">Share results on social media</button>
<button class="bt" onclick="download()">Download chart</button>
</div>
-->
<div>
</div> `;
            var datesHTML = "";
            scoreboard.outerHTML += datesHTML;
            //previousDates.style.margin = "7%";
            //cc.innerHTML = ``;
            //mainformParent.style.display = "none";
            //bigChart.innerHTML = `<canvas id="bc" width="1500" height="1500" class="chart"></canvas>`;
            var ctx = document.getElementById('myChart').getContext('2d');
            if (pieletData.email) {
                //branding.style.display = "none";
                scoreboard.style.display = "none";
                //mainForm.style.marginTop = "-75px";
            }
            var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
            if (!pieletData.email) {
                // ls = shuffle(ls);
            }
            Chart.defaults.global.defaultFontSize = 18;
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
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            defaultFontSize: 18
                        }
                    },
                    watermark: {
                        image: "https://pietential.com/watermark.png",
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
    </script>
    <?php echo file_get_contents("../universal-footer.php"); ?>
    <script>
        if (localStorage.pieletDataJSON) {
            pieletData = JSON.parse(localStorage.pieletDataJSON);
        } else {
            location.assign("/");
        }
        // drawChart(pieletData.SA, pieletData.EC, pieletData.LB, pieletData.SN, pieletData.PN);
        // drawBar(pieletData.SA, pieletData.EC, pieletData.LB, pieletData.SN, pieletData.PN);
        function show(id) {
            try {
                document.getElementById(id).style.display = "block";
            } catch (err) {}
        }

        function hide(id) {
            try {
                document.getElementById(id).style.display = "none";
            } catch (err) {}
        }

        if (!pieletData.PN) {
            desktopnav.style.display = "none";
            navbarmobile.style.display = "none";
        }
        if (window.innerWidth > 1200 && pieletData.PN) {
            desktopnav.style.display = "block";
        }
        if (window.innerWidth < 1200 && pieletData.PN) {
            navbarmobile.style.display = "block";
        }
    </script>
</body>

</html>