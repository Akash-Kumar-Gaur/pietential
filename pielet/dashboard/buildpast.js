function buildPastCharts() {
    document.getElementById("graph").outerHTML = `<canvas id="graph" class="UID:${userData.userID}"></canvas>`;
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

        var chart = new Chart('canvas', {
            type: 'line',
            data: data,
            options: options
        });

    }
}