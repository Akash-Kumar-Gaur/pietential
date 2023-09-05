<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pietential</title>
    <link href="/pielet/styles.css" rel="stylesheet" type="text/css">
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


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117957204-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        if (window.innerWidth < 1000) {
            var mobile = 1;
        }

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-117957204-2');
    </script>
</head>

<body>
    <section id="navi"></section>
    <script>
        fetch("../../navbar.html")
            .then(r => {
                return r.text()
            })
            .then(a => {
                document.getElementById("navi").innerHTML = a;
            });
    </script>


    <div id="minibranding" style="padding-top:50px;margin: auto; text-align: center;">
        <a href="#"><img onmouseover="" src="https://pietential.com/pietential.png" class="minibrand"></a>
    </div>
    <div id="scoreboard"></div>
    <!-- <h2 style="text-align:center;">Your Pietential Growth Potential Visualizations</h2> -->
    <canvas id="myChart" style="width:90%; top:0px;height:500px;" class="chart"></canvas>

    <canvas id="barchart" style="width:90%; top:-56px;" class="chart"></canvas>
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
        drawChart(pieletData.SA, pieletData.EC, pieletData.LB, pieletData.SN, pieletData.PN);
        drawBar(pieletData.SA, pieletData.EC, pieletData.LB, pieletData.SN, pieletData.PN);

        function drawBar(b, l, a, c, k) {
            var ctx2 = document.getElementById('barchart').getContext('2d');
            var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
            var alphaValue = 1;
            Chart.defaults.global.defaultFontSize = 18;
            if (window.innerWidth < 1000) {
                Chart.defaults.global.defaultFontSize = 12;
            }
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
<button class="bt" onclick="analyzeit()">Analyze It</button>
<button class="bt" onclick="sendChartAsPNG('myChart')" >Return to Home</button> 
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
            if (window.innerWidth < 1000) {
                Chart.defaults.global.defaultFontSize = 12;
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
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            defaultFontSize: 18
                        }
                    },
                    // watermark: {
                    // image: "https://pietential.com/watermark.png",
                    // alignY: "bottom",
                    // alignX: "right",
                    // width: "20%",
                    // height: "45%",
                    // position: "back",
                    // },
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

        function genPNG(el) {
            //eturn;
            //myChart.origin = 'anonymous';
            //barchart.origin = 'anonymous';
            document.getElementById(el).crossOrigin = "Anonymous";
            console.log("opening AJAX connection....");
            var chartPNG = document.getElementById(el).toDataURL("image/png");
            //var chartPNG = `123456`;
            if (el == "myChart") {
                var parameters = `savePNGPIE=${encodeURIComponent(chartPNG)}`;
                parameters += `&userID=${pieletData.userID}`;
                //parameters += `&userdata=${userdata}`;
                //parameters += `&userURL=${location.href}`;
            }
            if (el == "barchart") {
                var parameters = `savePNGBAR=${encodeURIComponent(chartPNG)}`;
                parameters += `&userID=${pieletData.userID}`;
                // parameters += `&userdata=${userdata}`;
                // parameters += `&userURL=${location.href}`;
            }
            parameters = parameters.trim();
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log("success.");
                }
            };
            xhttp.open("POST", `https://pietential.com/pielet/`, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(parameters);
        }

        function genBoth(a, b) {
            if (window.chartRequest !== `bcmc`) {
                genPNG(a);
                genPNG(b);
                window.chartRequest = `bcmc`;
            }
        }
    </script>
    <div onmouseover="genBoth(`myChart`,`barchart`);" id="analyzeit" style="text-align:center;position:relative; top:100px;">

        <div id="socialButtonContainer" style="text-align:center;">


            <!--
    <a class="bt green" id="social2button" href="/pielet/shareMyChart" target="_blank" style="padding:1% 4%;">Share Your Pie Chart <img class="emoji" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAA/klEQVRIie2VTQrCMBCFP21XegXd+XMr76dWXbvwGgqewYotulPqoilWSdIWZwqCD2Y1Id8QMu/BXz+sIRABqakNMG0DGgPZR51NT02RBVrUQhOcesBJ+WBXEBpU3JdJgwNgBhyAvufcVoD1Bjzyes4j9s91AgbfAkMHcGZ6Y/JPlpia14WW9zABVuayKuBXcu1hrAUs5NtDFWAh3x5eJYFN1qkjBbWBd56zPWCP0lNPyQ297ucKJOFDckNPgAuwBEa4DUN8AJeqBpgAazO4Sh43sUyVPLY5Wqt5HAI3D1gtj+/Aw9MXz+OyfD4glsc2uXxAJI+rVPaBRnn8l4qeweqVPDCgtmYAAAAASUVORK5CYII=" /></a>
    -->

            <div class="bt" style="display:inline;" onclick="location.assign('/pielet/analyzeit/')">Analyze It ➜</div>




        </div>

        <br>
    </div>
    <br><br><br><br><br><br>
    <!--This page is still beeing developed - it will be a standalone URL containing the charts. This will cut down on the JS flashing.<br><br>
-->

<section id="footi"></section>
    <script>
        fetch("../universal-footer.php")
            .then(r => {
                return r.text()
            })
            .then(a => {
                document.getElementById("footi").innerHTML = a;
            });
    </script>

    <script>
        if (localStorage.pieletDataJSON) {
            pieletData = JSON.parse(localStorage.pieletDataJSON);
        } else {
            location.assign("/?error=noparsedata");
        }
        var j = JSON.stringify(pieletData);
        //document.body.innerHTML += j;

        if (!pieletData.PN) {
            // desktopnav.style.display = "none";
            // navbarmobile.style.display = "none";
        }
        if (window.innerWidth > 1200 && pieletData.hash) {
            //desktopnav.style.display = "block";
        }
        if (window.innerWidth < 1200 && pieletData.hash) {
            //navbarmobile.style.display = "block";
        }
    </script>
</body>

</html>