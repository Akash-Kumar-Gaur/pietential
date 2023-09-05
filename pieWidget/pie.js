function pw () {
    var endpointDomain = location.href.replace(/^https?:/, "").replace(/pieWidget.+/, "");
    var el = document.getElementById("pieWidget");
if (location.href.match(/\?id=[a-z0-9]{12}/ig)) {
    var userID = location.href.replace(/[\S\s]+=/ig, "");
} else {
    var userID = el.classList[0];
}
// https://pietential.com/pieWidget/?id=zGX676w1F2ry
localStorage.pieID = userID;
el.innerHTML = `<b><a href="${endpointDomain}" target="_blank">Pietential.com</a> Results:</b><br><canvas id="pietentialChart"></canvas>
<br><canvas id="barchart"></canvas>
<section id="history"><br><b>User History:</b><br><canvas id="graph" class="UID:${userID}" style="max-height:290px;margin-top:30px"></canvas></section>`;
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
var furl = `${endpointDomain}pielet/accountEngine/?getAPI=${userID}`;
console.log(furl);
fetch(furl)
    .then(r => {
        return r.text()
    })
    .then(a => {
        console.log(a);
        localStorage.pieWidgetData = a;
        p = JSON.parse(a);
        drawChart(p.SA, p.EC, p.LB, p.SN, p.PN);
        drawBar(p.SA, p.EC, p.LB, p.SN, p.PN);
        try {
            if (p.snapshots.length < 2) {
                document.getElementById("history").outerHTML = '';
            } else {
                localStorage.goodSnapshots = 1;
                buildPastCharts();
            }
        } catch (e) {
            document.getElementById("history").outerHTML = '';
        }
    });

function drawChart(b, l, a, c, k) {
    if (!localStorage.pieWidgetData) {
        console.log(`drawChart halted`);
        return;
    }
    var ctx = document.getElementById('pietentialChart').getContext('2d');
    var ls = [`Self Actualization ${b}%`, `Esteem and ContributionActualization ${l}%`, `Love and BelongingActualization ${a}%`, `Safety NeedsActualization ${c}%`, `Physiological NeedsActualization ${k}%`];
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


a = localStorage.pieWidgetData;
p = JSON.parse(a);


function buildPastCharts() {

    a = localStorage.pieWidgetData;
    p = JSON.parse(a);
    if (!p.snapshots) {
        console.log("could not read snapshots!");
        document.getElementById("history").outerHTML = '';
        return;
    } else {
        console.log(p.snapshots);
        //return;
    }

    var times = [];
    for (let t of p.snapshots) {



        var obj = {};
        obj.time = t.time;
        obj.SA = t.SA;
        obj.EC = t.EC;
        obj.LB = t.LB;
        obj.SN = t.SN;
        obj.PN = t.PN;
        times.push(obj);
        console.log(obj);

        console.log(times);
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

                label: 'Esteem and Contribution',
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
            },]
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
        try{
            chart.destroy();
        }
        catch(e){}
        var chart = new Chart('graph', {
            type: 'line',
            data: data,
            options: options
        });

    }
}
}

pw();