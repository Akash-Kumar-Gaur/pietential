<?php
extract( $_GET );
extract( $_POST );

$domain = $_SERVER[ 'HTTP_HOST' ];
$filepath = $_SERVER[ 'SCRIPT_NAME' ];
$lastslash = strrpos( $filepath, "/" );
$path = substr( $filepath, 0, $lastslash );
$hi = "http://" . $domain . $path . "/";

date_default_timezone_set( 'America/New_York' );
$timestamp = date( 'Y-m-d' );
//http://pietential.com/makechart.php?chart=ErlvGACECnWj
if ( $chart ) {
    $_ = file_get_contents( "$chart.json.txt" );
    $master = json_decode( $_, true );
    $scores = $master[ LBscorevalues ];
    $vals = "$scores[SA], $scores[EC], $scores[LB], $scores[SN], $scores[PN]";
}

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<script src="chartjs-plugin-watermark.js"></script>
<h1> I just got my Pietential Visualization:</h1>
<div id="bigChart" style='width:700px;margin:auto;'></div>
<script>
Chart.defaults.global.defaultFontSize = 18;
    drawChart( <? echo $vals; ?> )
    function drawChart( b, l, a, c, k ) {
bigChart.innerHTML = `<canvas id="myChart"  width="1500" height="1500" class="chart"></canvas>`;
        var ctx = document.getElementById( 'myChart' ).getContext( '2d' );
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
        var fill1 = part1color.replace( " 1)", `${alphaValue})` );
        var fill2 = part2color.replace( " 1)", `${alphaValue})` );
        var fill3 = part3color.replace( " 1)", `${alphaValue})` );
        var fill4 = part4color.replace( " 1)", `${alphaValue})` );
        var fill5 = part5color.replace( " 1)", `${alphaValue})` );
        var ls = [ 'Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs' ];
        var myChart = new Chart( ctx, {
            //type: toggle,
            type: 'polarArea',
            data: {
                labels: ls,
                datasets: [ {
                    label: 'Score',
                    data: [ b, l, a, c, k ],
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
                } ]
            },
            options: {
                    watermark: {
                        image: "watermark.png",

                        alignY: "bottom",
                        alignX: "right",
                        width: "20%",
                        height: "22%",
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
        } );



    }
</script>