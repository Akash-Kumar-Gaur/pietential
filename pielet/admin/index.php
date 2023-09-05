<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&amp;display=swap" rel="stylesheet">
</head>
<style>
    * {
        font-family: Roboto Slab, 'Segoe UI', sans-serif;
        box-sizing: border-box;
        padding: 0;
        margin: 0;

    }

    html {
        /* height: 100%; */
    }

    body {
        min-height: 100%;
        /* height: 100%; */
    }

    .grass {
        background: #21BDCA;
        padding: 20px;
        color: white;
    }


    .blue {
        background: #263DAF;
        /* padding: 20px; */
        color: white;
        justify-content: center;
        align-content: center;
        text-align: center;

    }

    .iconContainer {
        margin-bottom: 50px;
        margin-top: 50px;
        cursor: pointer;
        margin-left: 20%;
        margin-right: 20%;
        text-align: center;

    }

    .lightblue {
        background: #4154ac;
        /* padding: 20px; */
        color: white;
    }

    .white {
        background: #efefef;
        padding: 20px;
        color: #333;
    }

    .bright {
        background: #fff;
        padding: 20px;
        color: #333;
    }

    .soft {
        border-radius: 5px;
        box-shadow: -5px 10px 21px 0px rgb(110 110 110 / 21%);

    }

    .icon {
        filter: invert(1);
        width: 36px;

        transition: all .5s;
    }

    .icon:hover {
        filter: invert(0);
        transition: all .5s;
        transform: scale(150%);
    }

    .photoIcon {
        width: 90px;
        height: 90px;
        background-repeat: no-repeat;
        background-size: cover;
        border-radius: 50%;
        background-image: url(miller.jpg);
        margin: auto;
        border-color: #f0ffff82;
        border-width: 3px;
        border-style: solid;
        background-position: center;
    }

    .title {
        margin: 30px;
        font-weight: 800;
    }

    .fifty {
        flex: 1 1 45%;
        margin: 8px;
    }

    .userList {
        padding: 12px;
        display: block;
        border: 1px solid #eee;
        border-radius: 4px;
        color: #336699;
        margin: 10px;
        cursor: pointer;
    }

    button {
        padding: 2px 20px;
    }

    .donutSpinner {
        display: inline-block;
        border: 20px solid rgba(0, 0, 0, 0.1);
        border-left-color: #5778F3;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: donut-spin 1.2s linear infinite;
    }

    @keyframes donut-spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<script src="https://pietential.com/chartjs-plugin-watermark.js"></script>

<body style="display: flex;">
    <div style="flex: 1 1 5%" class="lightblue" id="snav">
        <!-- <span style="font-size: 100px;margin: auto;line-height: .2em;padding: 21px 0px;display: block;">◔</span> -->

        <div class="grass" style="text-align: center;"> <img src="pie-chart.svg" alt="" class="icon"></div>
        <!-- <div class="grass" style="text-align: center;"> <img src="https://pietential.com/pietential.png" alt="" class="icon"></div> -->


        <div class="iconContainer"> <img src="people.svg" alt="" class="icon"></div>
        <div class="iconContainer"> <img src="settings.svg" alt="" class="icon"></div>
        <div class="iconContainer"> <img src="history.svg" alt="" class="icon"></div>
    </div>
    <div style="flex: 1 1 20%" class="blue">
        <br><br>
        <div  class="photoIcon"></div>
        <div  class="title">Miller-Davis, Inc.</div>
        Number of users: <span id="numusers">...</span>
        <div>
            <br>Search by email:<br><br>
            <input type="text" class="userList" id="filter" placeholder="start typing to search" onkeyup="showresults()" style="width: 90%; margin: auto;">
        </div>
    </div>
    <div style="flex: 1 1 70%; display: flex; flex-wrap: wrap;" class="white">
        <div style="flex: 1 1 100%">
            <h2>PietentialHR Administrator Dashboard</h2>
        </div>
        <div class="soft bright fifty" id="userListDiv">User List: (waiting to populate....)
            <br><br>
            <div class="donutSpinner"></div>
        </div>
        <div class="soft bright fifty">User Stats: <b id="userTarget">(choose a user to inspect)</b>
            <div id="userStats"></div>
            <canvas id="barchart" style="width:90%; top:-56px;" class="chart"></canvas>
            <canvas id="myChart" style="width:90%;" class="chart"></canvas>
            <section id="history" style="display:none;"><br>User History:<br><canvas id="graph" class="UID:${userData.userID}" style="max-height:290px;margin-top:30px"></canvas></section>
        </div>
    </div>


    <script>
        function showresults() {
            var matchcounter = 0;
            var filter = document.getElementById("filter").value;
            var re = new RegExp(filter, 'ig');
            for (let a of document.getElementsByClassName("users")) {
                if (a.id.match(re)) {
                    a.style.display = "block";
                    matchcounter++;
                } else {
                    a.style.display = "none";
                }
            }
        }

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

        function gid(id) {
            return (document.getElementById(id));
        }

        function getUsers() {
            fetch("https://pietential.com/pielet/admin/getusers.php")
                .then(response => {
                    return response.text()
                })
                .then(userList => {
                    localStorage.userList = userList;
                    var out = '<b>Current Users:</b><br><br>';
                    var j = JSON.parse(localStorage.userList);
                    for (let a of j) {
                        out += `<div id="${a[2]}" class="userList users" 
                        onclick="inspectUser('${a[1]}')">${a[2]}</div>`;
                        localStorage.out = out;
                    }
                    gid("userListDiv").innerHTML = localStorage.out;
                    gid("numusers").innerHTML = j.length;
                    if (location.href.match(/userid/ig)){
                        var userID  = location.href.replace(/[\s\S]+=/, "");
                        inspectUser(userID);
                    }
                    if (location.href.match(/email/ig)){
                        var em  = location.href.replace(/[\s\S]+=/, "");
                        
                        for (let a of j){
                            if (a[2]==em){
                            var userID = a[1]; 
                            console.log(`the em is ${em}`);
                        }
                        }
                        inspectUser(userID);
                    }
                });
        }

        function drawChart(b, l, a, c, k) {

            var datesHTML = "";
            var ctx = document.getElementById('myChart').getContext('2d');
            var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
            //Chart.defaults.global.defaultFontSize = 18;
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
                            //defaultFontSize: 18
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






        function inspectUser(id) {
            // place this block to destroy old charts and prevent flashbacks
            gid("barchart").outerHTML = `<canvas id="barchart" class="UID:${id}"></canvas>`;
            gid("myChart").outerHTML = `<canvas id="myChart" class="UID:${id}"></canvas>`;
            gid("graph").outerHTML = `<canvas id="graph" class="UID:${id}"></canvas>`;
            document.getElementById("barchart").style.display = "none";
            document.getElementById("myChart").style.display = "none";
            gid("snav").scrollIntoView({
                behavior: "smooth",
                block: "start",
                inline: "nearest"
            });
            gid("userStats").innerHTML = `<br><br><div style="text-align:center;"><div class="donutSpinner"></div></div>`;
            fetch(`https://pietential.com/pielet/admin/getusers.php?user=${id}`)
                .then(response => {
                    return response.text()
                })
                .then(pieletJSON => {
                    localStorage.userDataJSON = pieletJSON;
                    var userData = JSON.parse(pieletJSON);
                    var snapLength = 0;
                    window.snapLength = 0;
                    try {
                        window.snapLength = userData.snapshots.length;
                    } catch (e) {}
                    var progressChart = 'The user has 1 dataset available';
                    if (window.snapLength > 0) {
                        var progressChart = `The user has ${window.snapLength + 1} datasets available`;
                    }
                    document.getElementById("userTarget").innerHTML = userData.email;
                    var out = `<b>${userData.email} User Data:</b><br><br>`;
                    out += `<!--<button onclick="zoom('${userData.userID}')">View lastest chart</button>--> <button onclick="zoom('${userData.userID}')">View history graph</button><br><br>`;
                    //out += `${pielet.email}<br>${pielet.userID}<br>${pielet.account}<br>${pielet.partnerID}<br>`;
                    //out += `<textarea>${localStorage.pieletJSON}</textarea><br><br>`;
                    var quit = 0;
                    if (!userData.SA) {
                        var quit = 1;
                    }
                    if (!userData.PN) {
                        var quit = 1;
                    }
                    if (!userData.EC) {
                        var quit = 1;
                    }
                    if (!userData.LB) {
                        var quit = 1;
                    }
                    if (!userData.SN) {
                        var quit = 1;
                    }
                    if (quit > 0) {
                        gid("userStats").innerHTML = '<b style="color:red;">Failed to import data.</b> This usually means the selected user has no current scores. Be sure the user has recently completed the survey.';
                        document.getElementById("barchart").style.display = "none";
                        document.getElementById("myChart").style.display = "none";
                        return;
                    }
                    document.getElementById("myChart").style.display = "block";
                    document.getElementById("barchart").style.display = "block";
                    userData.prcoded = null;
                    userData.salt = null;
                    userData.hash = null;
                    userData.count = 0;
                    for (a in userData) {
                        //out += `${a} - ${pielet[a]}<br>`;
                        userData.count++;
                        if (userData.count > 4) {
                            break;
                        }
                    }
                    gid("userStats").innerHTML = `
                     <br><br>
                    <b>Self Actualization</b>: ${userData.SA}%<br>
                    <b>Esteem</b>: ${userData.EC}%<br>
                    <b>Love and Belonging</b>: ${userData.LB}%<br> 
                    <b>Safety Needs</b>: ${userData.SN}%<br>
                    <b>Physiological Needs</b>: ${userData.PN}%<br><br>
                    ${progressChart}<br><br>
                    `;



                    // now draw chart
                    window.userData = userData;

                    drawChart(userData.SA, userData.EC, userData.LB, userData.SN, userData.PN);
                    drawBar(userData.SA, userData.EC, userData.LB, userData.SN, userData.PN);
                    if (window.snapLength > 0) {
                        buildPastCharts();
                    } else {
                        document.getElementById("history").style.display = "none";
                    }
                });
        }

        //{"userID":"DLYo8nIcD5Fs","account":"organic","partnerID":"organic","joinDate":"2020-11-11","currentPart":"Part5","currentColor":"rgb(110, 148, 248)","prcoded

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


        function drawBar(b, l, a, c, k) {

            var ctx2 = document.getElementById('barchart').getContext('2d');
            var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
            var alphaValue = 1;
            //Chart.defaults.global.defaultFontSize = 18;
            if (window.innerWidth < 1000) {
                Chart.defaults.global.defaultFontSize = 12;
            }

            var barchart = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ls,
                    datasets: [{
                        label: 'score',
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



        function buildPastCharts() {
            document.getElementById("history").style.display = "block";
            document.getElementById("history").outerHTML = `<section id="history"><br><b>User History:</b><br><canvas id="graph" class="UID:${userData.userID}" style="max-height:290px;margin-top:30px"></canvas></section>`;
            var counter = 1;
            var times = [];
            var ar = [];
            for (let c of userData.snapshots) {
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
            if (userData.Q29response && userData.Q29response) {
                var currentResults = {};
                for (let d in userData) {
                    if (d.match(/^Q/)) {
                        currentResults[d] = userData[d];
                    }
                }
                currentResults.time = userData.completionDate;
                ar.push(currentResults);
            }
            console.log(ar);
            userData.ar = ar;
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
                        data: SAar,
                        // data: gloc[4],
                        label: 'Self Actualization',
                        fill: '-1'
                    }, {
                        backgroundColor: "rgba(9,0,0,0.1)",
                        borderColor: colorParts[1],
                        data: ECar,
                        //data: gloc[2],

                        label: 'Self-Esteem and Contribution',
                        fill: '-1'
                    }, {
                        backgroundColor: "rgba(9,0,0,0.1)",
                        borderColor: colorParts[2],
                        data: LBar,
                        //data: gloc[3],
                        label: 'Love and Belonging',
                        fill: '-1'
                    }, {
                        backgroundColor: "rgba(9,0,0,0.1)",
                        borderColor: colorParts[3],
                        data: SNar,
                        //data: gloc[1],
                        label: 'Safety Needs',
                        fill: '0'
                    }, {
                        backgroundColor: "rgba(9,0,0,0.1)",
                        borderColor: colorParts[4],
                        data: PNar,
                        //data: gloc[0],

                        label: 'Physiological Needs',
                        fill: '0'
                    }, ]
                };

                console.log(data);

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

                var chart = new Chart('graph', {
                    type: 'line',
                    data: data,
                    options: options
                });

            }
        }

        getUsers();
    </script>
















    <!-- <div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a
            href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> -->
</body>

</html>