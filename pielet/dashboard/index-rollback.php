<?php
extract($_GET);
extract($_POST);
// dashboard/index.php
if ($test) {
    echo "<pre>";
    print_r($_COOKIE);
    exit;
}
if (!$userID) {
    $userID = $_COOKIE['userID'];
}
if (!$userID) {
    header("Location: /?user-not-supplied");
    exit;
}
$pieletDataJSON = @file_get_contents("../ids/$userID.json.txt");
$master = json_decode($pieletDataJSON, true);

if (!$master || !$pieletDataJSON) {
    header("Location: /?no-user-data");
    exit;
}

if (!$master['hash']) {
    header("Location: /pielet/create/");
    exit;
}

if ($master['snapshots']) {
    $snappy = print_r($master['snapshots'],true);
    foreach ($master['snapshots'] as $key => $value) {
        $snappy .= json_encode($value);
    }
    //echo "<!-- SNAPPY $snappy -->\n\n\n";
    $csnap = count($master['snapshots']);
    foreach ($master['snapshots'] as $key => $value) {
        $stamp = $value['timestamp'];
        $date[] = $stamp;
    }
    $dateJSON = json_encode($date);
    echo "<!-- The dateArray is $dateJSON -->";
    //$csnap = $csnap + 1;
    $zs = 0;
    while ($zs < $csnap) {
       
        $snapdata = $master['snapshots'][$zs];
        // if(!$snapdata){
        //     continue;
        // }
        $snapdata = json_encode($snapdata);
        $snapdata = "<!-- $snapdata -->";
        $ts = $date[$zs];
        if(!$date[$zs]){
            $ts = "unavailable $snapdata";
        }
        $csout .= "<div style='width:30%;display:inline-block;'>
        <div style='clear:both;text-align:center;'>Date: $ts </div>
        <canvas id='csnap$zs' ></canvas></div>\n\n";
        $zs++;
    }
    $csout = "<div style='width:100%;'>$csout</div><div style='clear:both;'></div>";
}


if ($countryOfOrigin && $userID) {
    // save the form data and exit-redirect //
    foreach ($_POST as $key => $value) {
        $master[$key] = trim($value);
    }
    $masterJSON = json_encode($master);
    file_put_contents("../ids/$userID.json.txt", $masterJSON);
    echo "<script>
    localStorage.pieletDataJSON = `$masterJSON`;
    location.assign(`?wellDone`);
    </script>";
    exit();
}

function getrandom($n)
{
    $g = str_split("abcdefgqyzxw1234567890!@#$%^&*ABCDEFGHJKLOIUYTREW");
    $v = 0;
    $r = "";
    while ($v < $n) {
        shuffle($g);
        $r .= $g[0];
        $v++;
    }
    return ($r);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="manifest" href="../../pietential.webmanifest">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../styles.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <script src="https://pietential.com/chartjs-plugin-watermark.js"></script>

    <link rel="icon" type="image/png" href="/icon.png">
    <title>Pietential - Growth Potential Visualization Survey</title>


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


</head>
<link rel="stylesheet" href="https://d1azc1qln24ryf.cloudfront.net/114779/Socicon/style-cf.css?u8vidh">

<style>
    input {
        width: 400px;
    }
</style>

<?php
$userID = $_COOKIE['userID'];
echo file_get_contents("https://pietential.com/pielet/generate-login-bar.php?userID=$userID");
?>


<div style="width:90%; padding:20px;text-align:center;margin:auto;">
    <div id="minibranding" style="padding-top: 50px; margin: auto; text-align: center; display: block;">
        <a href="#"><img onmouseover="" src="https://pietential.com/pietential.png" style="width: 10%;max-width: 500px;margin-bottom:10px;margin: auto;"></a>
    </div>
    <div style="margin:auto;">


        <div id="dash" style="display:none;">
            <h2>Account information:</h2>
            <div id="past">
                Progress:<br>
                <?php
                if (!$master['snapshots']) {
                    echo "<br>Your history will be displayed when you have completed more than one evaluation.<br><br>
                    <a class='bt' style='font-size: 15px; padding: 10px 20px;' href='/pielet/retake/'>Retake and track your progress</a>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    ";
                } else {
                    echo '<canvas id="canvas" style="height:500px;"></canvas>
                    
                  ';
                }
                ?>


            </div>
        </div>
        <div id="pastPieCharts"><?php echo $csout; ?></div>

        <div id="additionalQuestions" style="display:none;">
            <BR><BR>
            <h2>Become a full member to see your progress:</h2>
            Pietential members gain access to progress reporting and other tools. There is no charge.<BR>You are logged in as <?php echo $master['email']; ?> <BR>
            <img src="sample.png" style="width:800px;" alt="">
            <BR>

            <form action="" method="post">

                <br>

                <input type="hidden" id="userIDform" name="userID">


                <input type="text" placeholder="Country of Origin (required)" id="countryOfOrigin" name="countryOfOrigin" style="margin-bottom:10px;" required><br>

                <br>
                <input type="text" placeholder="Country of Residence (required)" id="countryOfResidence" name="countryOfResidence" style="margin-bottom:10px;" required><br>

                <br>
                <input type="text" placeholder="City of Residence (required)" id="cityOfResidence" name="cityOfResidence" style="margin-bottom:10px;" required><br>

                <br>
                <input type="text" placeholder="Gender (required)" required id="gender" name="gender" style="margin-bottom:10px;"><br>

                <br>
                <input type="text" placeholder="Birth Year (required)" required id="birthYear" name="birthYear" style="margin-bottom:10px;"><br>

                <br>
                <input type="text" placeholder="Race (required)" required id="race" name="race" style="margin-bottom:10px;"><br>

                <br>
                <input type="text" placeholder="Education (required)" required id="education" name="education" style="margin-bottom:10px;"><br>

                <br>
                <input type="text" placeholder="Religion" id="religion" name="religion" style="margin-bottom:10px;"><br>

                <br>
                <input type="text" placeholder="Net Worth" id="netWorth" name="netWorth" style="margin-bottom:10px;"><br>

                <input type="checkbox" placeholder="" id="memberYes" name="memberYes" CHECKED value="1" style="width:unset;margin-bottom:10px;"> Become a member? <br>


                <input type="submit" value="Join">
                <br><br>Membership is free and gives you Access to Pietential's "Sice Tracker", and access to 100 of the Global View Survey Results.

            </form>

        </div>
    </div>

</div>

<div style="text-align:center;">
<!--<a id="" class="bt" style="background:black; font-size: 15px; padding: 10px 20px; display:inline-block; margin:50px;" href="/pielet/vote/?userID=<?php echo $userID; ?>">🗳️ Vote for new features</a>-->
</div>

<?php echo file_get_contents("dashfooter.html"); ?>

<img src="https://pietential.com/pielet/create-email-table.php?img=1">
<img src="https://pietential.com/pielet/list.php?img=1">
<script>
    var pieletData = <?php echo $pieletDataJSON; ?>;
    localStorage.pieletDataJSON = JSON.stringify(pieletData);

    
    if(location.href.match(/\/?inspect/ig)){
document.body.innerHTML = localStorage.pieletDataJSON;
    }

    
    if (!pieletData.hash) {
        location.assign(`../create`);
    } else {

        //         function showlibar() {
        //             var loginStatus = ``;

        //             var proxyUser = `<a target="_blank" href='https://pietential.com/pielet/create/?userID=${pieletData.userID}'>Create your account</a>`;
        //             if (pieletData.hash) {
        //                 proxyUser = `Your account: <a href="https://pietential.com/pielet/dashboard/?userID=${pieletData.userID}" target="_blank">${pieletData.email}</a> <a href="/">Home page</a>`;
        //                 loginStatus = `<span style="text-align:left;position: absolute;left: 5px;font-size:15px;"> ${pieletData.email} <a class="bt" style="font-size: 15px; padding: 10px 20px;" href="/?logout">Logout</a></span> `;
        //             }
        //             var loginBar = `<div id="libar" class="libar" style="box-sizing: border-box;position:fixed;top:0px;height:45px;padding: 12px 27px; text-align:right;margin-right:20px;">${loginStatus} <a class="bt" style="font-size: 15px; padding: 10px 20px;" href="javascript: localStorage.returnToLatest=1;location.assign('/');
        // ">Return to latest evaluation</a> 

        // <a class="bt" style="font-size: 15px; padding: 10px 20px;" href="javascript: localStorage.retake=1;location.assign('/');
        // ">Retake and track your progress</a>

        // <a class="bt" style="font-size: 15px; padding: 10px 20px;" target="_blank" href="/?inspect">i</a></div>`;
        //             document.body.innerHTML += loginBar;
        //         }

        //         showlibar();
        var snapshots = pieletData.snapshots;
        //dash.innerHTML = JSON.stringify(snapshots).replace(/,/ig, `, `);
    }

    if (!pieletData.countryOfOrigin) {
        // show("additionalQuestions");
    }
    if (pieletData.hash) {
        show("dash");
    }

    function show(id) {
        document.getElementById(id).style.display = "block";
    }

    function hide(id) {
        document.getElementById(id).style.display = "none";
    }

    function buildPastCharts() {


        var counter = 1;
        var times = [];
        var ar = [];
        for (let c of pieletData.snapshots) {
            var obj = {};
            obj.time = c.timestamp;
            for (let d in c) {
                if (d.match(/^Q/)) {
                    obj[d] = c[d];
                }
            }

            ar.push(obj);
            //past.innerHTML += counter + `. Timestamp: ` + obj.time + JSON.stringify(obj) + `<br>`;
            counter++;
        }
        // see if the latest form has been filled out
        if (pieletData.Q29response && pieletData.Q29response) {
            var currentResults = {};
            for (let d in pieletData) {
                if (d.match(/^Q/)) {
                    currentResults[d] = pieletData[d];
                }
            }
            currentResults.time = pieletData.timestamp;
            ar.push(currentResults);
        }
        console.log(ar);
        pieletData.ar = ar;
        var tcx = 2;
        var timelist = [];
        for (let t of ar) {


            var SA = 0;
            var EC = 0;
            var PN = 0;
            var LB = 0;
            var SN = 0;
            for (const property in t) {

                if (property.match(/Q0response|Q1response|Q2response|Q3response|Q4|Q5/g) && Number.isInteger(t[property])) {
                    SA += parseInt(t[property]) * 1.66;
                    SA = roundNumber(SA);
                }
                if (property.match(/Q6|Q7|Q8|Q9|Q10|Q11/g) && Number.isInteger(t[property])) {
                    EC += parseInt(t[property]) * 1.66;
                    EC = roundNumber(EC);
                }
                if (property.match(/Q12|Q13|Q14|Q15|Q16|Q17/g) && Number.isInteger(t[property])) {
                    LB += parseInt(t[property]) * 1.66;
                    LB = roundNumber(LB);
                }
                if (property.match(/Q18|Q19|Q20|Q21|Q22|Q23/g) && Number.isInteger(t[property])) {
                    //33-38
                    SN += parseInt(t[property]) * 1.66;
                    SN = roundNumber(SN);
                }
                if (property.match(/Q24|Q25|Q26|Q27|Q28|Q29/g) && Number.isInteger(t[property])) {
                    //40-45
                    PN += parseInt(t[property]) * 1.66;
                    PN = roundNumber(PN);
                }
                if (property.match(/time/g)) {

                    for (let tvf of timelist) {
                        if (t[property] == tvf) {
                            t[property] += " " + tcx;
                            tcx++;
                        }

                    }
                    var time = t[property];
                    timelist.push(time);
                    // console.log(time);
                }




            }
            if (SA) {
                var obj = {};
                obj.time = time;
                obj.SA = SA;
                obj.EC = EC;
                obj.LB = LB;
                obj.SN = SN;
                obj.PN = PN;

                times.push(obj); //gval()
                //console.log(obj);
            }

            var inputs = {
                min: 20,
                max: 80,
                count: 8,
                decimals: 2,
                continuity: 1
            };




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
            var part1color = `rgba(110, 148, 248, 1)`;
            var part2color = `rgba(2, 183, 45, 1)`;
            var part3color = `rgba(249, 186, 3, 1)`;
            var part4color = `rgba(248, 126, 2, 1)`;
            var part5color = `rgba(251, 0, 0, 1)`;

            var colorParts = [];
            colorParts.push(part1color);
            colorParts.push(part2color);
            colorParts.push(part3color);
            colorParts.push(part4color);
            colorParts.push(part5color);

            var timesar = [];
            var SAar = [];
            var PNar = [];
            var SNar = [];
            var LBar = [];
            var ECar = [];
            var timesar = [];
            for (var i = 0; i < times.length; i++) {
                timesar.push(times[i].time);
                SAar.push(times[i].SA);
                PNar.push(times[i].PN);
                SNar.push(times[i].SN);
                LBar.push(times[i].LB);
                ECar.push(times[i].EC);
            }

            var data = {
                labels: timesar,
                datasets: [{
                    backgroundColor: "rgba(9,0,0,0.1)",
                    borderColor: colorParts[0],
                    data: PNar,
                    //data: gloc[0],

                    label: 'Physiological Needs',
                    fill: '0'
                }, {
                    backgroundColor: "rgba(9,0,0,0.1)",
                    borderColor: colorParts[1],
                    data: SNar,
                    //data: gloc[1],
                    label: 'Safety Needs',
                    fill: '0'
                }, {
                    backgroundColor: "rgba(9,0,0,0.1)",
                    borderColor: colorParts[2],
                    data: ECar,
                    //data: gloc[2],

                    label: 'Self-Esteem and Contribution',
                    fill: '-1'
                }, {
                    backgroundColor: "rgba(9,0,0,0.1)",
                    borderColor: colorParts[3],
                    data: LBar,
                    //data: gloc[3],
                    label: 'Love and Belonging',
                    fill: '-1'
                }, {
                    backgroundColor: "rgba(9,0,0,0.1)",
                    borderColor: colorParts[4],
                    data: SAar,
                    // data: gloc[4],
                    label: 'Self Actualization',
                    fill: '-1'
                }]
            };

            var options = {
                maintainAspectRatio: false,
                spanGaps: false,
                elements: {
                    line: {
                        tension: 0.4
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    filler: {
                        propagate: false
                    },
                    'samples-filler-analyser': {
                        target: 'chart-analyser'
                    }
                }
            };

            var chart = new Chart('canvas', {
                type: 'line',
                data: data,
                options: options
            });

            // eslint-disable-next-line no-unused-vars
            function togglePropagate(btn) {
                var value = btn.classList.toggle('btn-on');
                chart.options.plugins.filler.propagate = value;
                chart.update();
            }

            // eslint-disable-next-line no-unused-vars
            function toggleSmooth(btn) {
                var value = btn.classList.toggle('btn-on');
                chart.options.elements.line.tension = value ? 0.4 : 0.000001;
                chart.update();
            }

            // eslint-disable-next-line no-unused-vars
            function randomize() {
                chart.data.datasets.forEach(function(dataset) {
                    dataset.data = generateData();
                });
                chart.update();
            }
        }

    }

    if (pieletData.snapshots) {
        buildPastCharts();
        buildPastPieCharts();
    }

    function buildPastPieCharts() {
        //pastPieCharts.innerHTML = JSON.stringify(pieletData.ar);
    }


    function roundNumber(n) {
        n = Math.round(n);
        if (n > 98) {
            n = 100;
        }
        if (n == 59 || n == 58) {
            n = 60;
        }
        return (n);
    }
    navigator.geolocation.getCurrentPosition(showPosition);

    function showPosition(position) {
        pieletData.geolocationLong = position.coords.longitude;
        pieletData.geolocationLat = position.coords.latitude;
    }
    userIDform.value = pieletData.userID;

    function drawChart(canvas, b, l, a, c, k) {

        var ctx = document.getElementById(canvas).getContext('2d');
        var part1color = `rgba(110, 148, 248, 1)`;
        var part2color = `rgba(2, 183, 45, 1)`;
        var part3color = `rgba(249, 186, 3, 1)`;
        var part4color = `rgba(248, 126, 2, 1)`;
        var part5color = `rgba(251, 0, 0, 1)`;
        var alphaValue = .5;
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
        var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
        var myChart = new Chart(ctx, {
            //type: toggle,
            type: 'polarArea',
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
                // watermark: {
                //     image: "watermark.png",

                //     alignY: "bottom",
                //     alignX: "right",
                //     width: "20%",
                //     height: "22%",
                //     position: "back",
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
    var n = 0;
    for (let t of pieletData.ar) {
        var SA = 0;
        var EC = 0;
        var PN = 0;
        var LB = 0;
        var SN = 0;

        for (const property in t) {

            if (property.match(/Q0response|Q1response|Q2response|Q3response|Q4|Q5/g) && Number.isInteger(t[property])) {
                SA += parseInt(t[property]) * 1.66;
                SA = roundNumber(SA);
            }
            if (property.match(/Q6|Q7|Q8|Q9|Q10|Q11/g) && Number.isInteger(t[property])) {
                EC += parseInt(t[property]) * 1.66;
                EC = roundNumber(EC);
            }
            if (property.match(/Q12|Q13|Q14|Q15|Q16|Q17/g) && Number.isInteger(t[property])) {
                LB += parseInt(t[property]) * 1.66;
                LB = roundNumber(LB);
            }
            if (property.match(/Q18|Q19|Q20|Q21|Q22|Q23/g) && Number.isInteger(t[property])) {
                //33-38
                SN += parseInt(t[property]) * 1.66;
                SN = roundNumber(SN);
            }
            if (property.match(/Q24|Q25|Q26|Q27|Q28|Q29/g) && Number.isInteger(t[property])) {
                //40-45
                PN += parseInt(t[property]) * 1.66;
                PN = roundNumber(PN);
            }
        }
        drawChart(`csnap${n}`, SA, EC, LB, SN, PN);
        n++;

    }

</script>