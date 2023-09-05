<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>


<canvas id="myChart" class="chart"></canvas>


<script>
        function drawChartMini() {
            var b = shuffle([1, 2, 3, 4, 5, 6])[0];
            var l = shuffle([1, 2, 3, 4, 5, 6])[0];
            var a = shuffle([1, 2, 3, 4, 5, 6])[0];
            var c = shuffle([1, 2, 3, 4, 5, 6])[0];
            var k = shuffle([1, 2, 3, 4, 5, 6])[0];
            var toggle = shuffle(['polarArea', "line", "pie", "bar", 'radar', 'doughnut', ])[0];
            
            var ctx = document.getElementById('myChart').getContext('2d');
            var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
            var alphaValue = 1;

            var rgb = ``;
                var colors = [0, 100, 20sendajaxShifts .4, .5, .6];
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




            
            var myChart = new Chart(ctx, {
                type: toggle,
               // type: 'polarArea',
               // type: 'doughnut',
                data: {
                    labels: ls,
                    datasets: [{
                        label: 'Score',
                        data: [b, l, a, c, k],
                        backgroundColor: [
                            returnRandomColor(),
                            returnRandomColor(),
                            returnRandomColor(),
                            returnRandomColor(),
                            returnRandomColor()
                        ],
                        borderColor: [
                            returnRandomColor(),
                            returnRandomColor(),
                            returnRandomColor(),
                            returnRandomColor(),
                            returnRandomColor()
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    
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

        setInterval(function() {
                if (counter < 5) {
                    drawChartMini();
                    console.log("Counter: " + counter);
                }
                counter++;
            }

</script>
    
</body>
</html>



