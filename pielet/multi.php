<?php
extract($_GET);
extract($_POST);
// cloudburst@silvercrayon.com
// ak1a*wt%vbnX
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <script src="https://pietential.com/chartjs-plugin-watermark.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">
    <link href="https://pietential.com/pielet/styles.css" rel="stylesheet" type="text/css">
    </link>

</head>

<body>
    <div style="width:100%;">
    <h2>Your progress over time:</h2>
        <canvas id="canvas" style="height:500px;"></canvas>
    </div>

    <script>
        // var presets = window.chartColors;
        // var utils = Samples.utils;

// start simulation block 1


        var ard = [];
        var i = 40;
        while (i < 80) {
            ard.push(i);
            i++;
        }

        ard = [1,2,3,4,5,6];

        function gval() {
            var ag = [];
            var start = 40;
            for (var i = 0; i < 5; i++) {
                start +=shuffle(ard)[0];
                ag.push(start);
            }
            //console.log(ag);
            return (ag);
            
        }
   var gloc = [];     
   for (var p = 0;p<5; p++){
var nar = [];

var c = 40;
        for (var i = 0;i<14; i++){
            c = c + shuffle(ard)[0];
            nar.push(c);
        }
        gloc.push(nar);
    }

    // end simulation block 1

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

        var jdata = <?php echo file_get_contents("ZLcGKSYyn8Ao.json.txt"); ?>;
        var times = [];
        for (var i = 0; i < jdata.snapshots.length; i++) {

            var t = jdata.snapshots[i];
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
                if (property.match(/timestamp/g)) {
                    var time = t[property];

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

                    // start simulation block 2

                    var ftime = i+1;
                    time = `January ${ftime}, 2020`;
                    obj.time = time;
                    obj.SA = gval()[0];
                    obj.EC = gval()[0];
                    obj.LB = gval()[0];
                    obj.SN = gval()[0];
                    obj.PN = gval()[0];

                    // end simulation block 2

                    times.push(obj);//gval()
                }
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
        for (var i=0; i<times.length; i++){
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
                data: gloc[0],

                label: 'Physiological Needs',
                fill: '0'
            }, {
                backgroundColor: "rgba(9,0,0,0.1)",
                borderColor: colorParts[1],
                data: SNar,
                data: gloc[1],
                label: 'Safety Needs',
                fill: '0'
            }, {
                backgroundColor: "rgba(9,0,0,0.1)",
                borderColor: colorParts[2],
                data: ECar,
                data: gloc[2],

                label: 'Self-Esteem and Contribution',
                fill: '-1'
            }, {
                backgroundColor: "rgba(9,0,0,0.1)",
                borderColor: colorParts[3],
                data: LBar,
                data: gloc[3],
                label: 'Love and Belonging',
                fill: '-1'
            }, {
                backgroundColor: "rgba(9,0,0,0.1)",
                borderColor: colorParts[4],
                data: SAar,
                data: gloc[4],
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
    </script>



    <script>
        // var lineChartData = {
        // 	labels: ['2020-5-31', '2020-6-12'],
        // 	datasets: [{
        // 		label: 'Physiological Needs',
        // 		borderColor: "green",
        // 		backgroundColor: "white",
        // 		fill: false,
        // 		data: [
        // 			2,3
        // 		],
        // 		yAxisID: 'y-axis-1',
        // 	}, {
        // 		label: 'Physiological Needs Safety Needs',
        // 		borderColor: "blue",
        // 		backgroundColor: "orange",
        // 		fill: false,
        // 		data: [
        // 			9,7
        // 		],
        // 		yAxisID: 'y-axis-2'
        //      }
        //     , {
        // 		label: 'Physiological Needs Safety Needs Love and Belonging',
        // 		borderColor: "purple",
        // 		backgroundColor: "yellow",
        // 		fill: false,
        // 		data: [
        // 			10,5
        // 		],
        // 		yAxisID: 'y-axis-3'
        // 	}, {
        // 		label: 'Physiological Needs Safety Needs Love and Belonging Self-Esteem and Contribution',
        // 		borderColor: "gray",
        // 		backgroundColor: "pink",
        // 		fill: false,
        // 		data: [
        // 			6,5
        // 		],
        // 		yAxisID: 'y-axis-4'
        // 	}, {
        // 		label: 'Physiological Needs Safety Needs Love and Belonging Self-Esteem and Contribution Self Actualization',
        // 		borderColor: "gray",
        // 		backgroundColor: "pink",
        // 		fill: false,
        // 		data: [
        // 			4,8
        // 		],
        // 		yAxisID: 'y-axis-5'
        //     }
        // ]
        // };

        // window.onload = function() {
        // 	var ctx = document.getElementById('canvas').getContext('2d');
        // 	window.myLine = Chart.Line(ctx, {
        // 		data: lineChartData,
        // 		options: {
        // 			responsive: true,
        // 			hoverMode: 'index',
        // 			stacked: false,
        // 			title: {
        // 				display: true,
        // 				text: 'Pietential'
        // 			},
        // 			scales: {
        // 				yAxes: [{
        // 					type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
        // 					display: true,
        // 					position: 'left',
        // 					id: 'y-axis-1',
        // 				}, {
        // 					type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
        // 					display: false,
        // 					position: 'right',
        // 					id: 'y-axis-2',

        // 					// grid line settings
        // 					gridLines: {
        // 						drawOnChartArea: false, // only want the grid lines for one axis to show up
        // 					},
        // 				}, {
        // 					type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
        // 					display: false,
        // 					position: 'right',
        // 					id: 'y-axis-3',

        // 					// grid line settings
        // 					gridLines: {
        // 						drawOnChartArea: false, // only want the grid lines for one axis to show up
        // 					},
        // 				}, {
        // 					type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
        // 					display: false,
        // 					position: 'right',
        // 					id: 'y-axis-4',

        // 					// grid line settings
        // 					gridLines: {
        // 						drawOnChartArea: false, // only want the grid lines for one axis to show up
        // 					},
        // 				}, {
        // 					type: 'linear', // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
        // 					display: false,
        // 					position: 'right',
        // 					id: 'y-axis-5',

        // 					// grid line settings
        // 					gridLines: {
        // 						drawOnChartArea: false, // only want the grid lines for one axis to show up
        // 					},
        // 				}],
        // 			}
        // 		}
        // 	});
        // };
    </script>
</body>

</html>