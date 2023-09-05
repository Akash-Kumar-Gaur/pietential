<?php
extract( $_GET );
extract( $_POST );

if ( $LifeBalanceformData ) {
    header( "Access-Control-Allow-Origin: *" );
    header( "Content-Type: text/plain; charset=utf-8" );
    $s = json_decode( $LifeBalanceformData, true );
    file_put_contents( $s[ email ] . ".json.txt", $LifeBalanceformData );
    //file_put_contents("r.txt", print_r($GLOBALS, true));
    exit( "success" );
}
?>


<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="styles.css" rel="stylesheet" type="text/css">
    <!--<link rel="icon" type="image/png" href="apps-icon.png"> -->
    <title>Life balance evaluation</title>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>

<body style="padding:20px;" cz-shortcut-listen="true">




    <div id="scoreboard" class="m10" style="width:45%;padding:12px; border:1px solid silver; border-radius:6px; margin: auto;">
        <div id="score" class="m10" style="padding:0px; font-weight: 700;">Others taking the evaluation:</div>
        <div style="padding:0px; " id="results"></div>
    </div>
    <br>
    
    <img src="logo.png" style="width:45%; margin-bottom:10px;display:none;"><br>
    <form id="mainform" style="margin:auto;" enctype="multipart/form-data" action="" onclick="addValues();" method="post">
        <h1>Life balance evaluation</h1>

        <div id="emailCapture">

            <input name="email" id="email" placeholder="Enter your email to begin the evaluation">
            <br>
            <div class="bt" onclick="getmail()">Start survey</div><br><br>
        </div>
        <div id="progressGroupTop"></div>
        <div id="mainForm" style="display:none;">
            <section id="partPicker" style="margin:0px 0px 15px 0px;">
                <div class="bt color1" onclick="nextsection('Part1');">Part 1</div>
                <div class="bt color2" onclick="nextsection('Part2');">Part 2</div>
                <div class="bt color3" onclick="nextsection('Part3');">Part 3</div>
                <div class="bt color4" onclick="nextsection('Part4');">Part 4</div>
                <div class="bt color5" onclick="nextsection('Part5');">Part 5</div>
            </section>

            <div id="partsContainer"></div>
            <div id="progressGroup">
                
                
                <div id="sectionprogressParent" style="display: none; border-radius: 2px; width:100%; background: #eee;padding:0px;margin:10px">
                    <span class="note">Section progress:<br></span>
                    <div style="padding: 2px;font-size: 11px; border-radius: 2px; color:white; background: #377dd4; " class="sectionprogress"></div>
                </div>
                <span class="note">Overall progress:<br></span>
                <div id="pbarParent" style="border-radius: 6px; width:100%; background: #eee;padding:0px;margin:10px;">
                    <div class="pbar" style="padding:10px;border-radius: 6px; color:white; background: #377dd4; "></div>
                </div>
<!--                <i style="font-size: 11px;  opacity: .5;  text-align: right;margin-top: -3%;  position: absolute; left: 30%;">all changes saved...</i>-->
            </div>

    </form>
        <div id="contains2charts" style="transform: scale(1);">
        <div id="cc" style="width:100%;"><canvas id="myChart" class="chart"></canvas><br>
        </div>

    </div>
    <script>
        
        
        if (location.href.match(/\?r/)) {
            //assignRandom();
            localStorage.LifeBalanceEmail = "";
            localStorage.LifeBalanceformData = "";
            localStorage.currentPart = "";
            location.assign('?axel=1');  
        }
        
        
        function setQdata() {
            var formQuestions = JSON.parse( `[{"Part":"Part 1","Part description":"Self Actualization","Subject":"Personal Development","Question":"I'm actively engaged in my own personal development to become the best me I can be."},{"Part":"Part 1","Part description":"Self Actualization","Subject":"Well Being","Question":"I'm comfortable with myself. I feel balanced and fulfilled. My daily mindset is positive."},{"Part":"Part 1","Part description":"Self Actualization","Subject":"Spirituality and Life Purpose","Question":"I know my life has meaning. I know my purpose in life and I'm living it."},{"Part":"Part 1","Part description":"Self Actualization","Subject":"Education","Question":"I seek and gain the education I need to have a fulfilling life."},{"Part":"Part 1","Part description":"Self Actualization","Subject":"Achievement","Question":"I'm satisfied with what I've achieved in life so far."},{"Part":"Part 1","Part description":"Self Actualization","Subject":"Mastery","Question":"I am working to master new skills."},{"Part":"Part 2","Part description":"Esteem and Contribution","Subject":"Contribution","Question":"I've made contributions to my community that I'm proud of."},{"Part":"Part 2","Part description":"Esteem and Contribution","Subject":"Purpose","Question":"My life has purpose."},{"Part":"Part 2","Part description":"Esteem and Contribution","Subject":"Self Respect","Question":"I have a high degree of self respect. I matter to me and my actions show it."},{"Part":"Part 2","Part description":"Esteem and Contribution","Subject":"Respect and Status","Question":"People respect me. I'm recognized for my efforts. and have achieved a certain amount of status in life."},{"Part":"Part 2","Part description":"Esteem and Contribution","Subject":"Strength/Empowerment","Question":"I feel empowered and strong. I fully express myself."},{"Part":"Part 2","Part description":"Esteem and Contribution","Subject":"Freedom and Expression","Question":"I have a lot of personal freedom to call my own shots in life."},{"Part":"Part 3","Part description":"Love and Belonging","Subject":"Family Relationships","Question":"I have a solid, healthy relationship with my family."},{"Part":"Part 3","Part description":"Love and Belonging","Subject":"Friendship","Question":"I make and have deep, lasting, healthy friendships."},{"Part":"Part 3","Part description":"Love and Belonging","Subject":"Social Relationship","Question":"My social relationships are full of positive interactions."},{"Part":"Part 3","Part description":"Love and Belonging","Subject":"Intimacy","Question":"My intimate relationships are fulfilling"},{"Part":"Part 3","Part description":"Love and Belonging","Subject":"Play","Question":"I allow myself the freedom to play."},{"Part":"Part 3","Part description":"Love and Belonging","Subject":"Compassion","Question":"I have deep compassion for others."},{"Part":"Part 4","Part description":"Safety Needs","Subject":"Certainty","Question":"I feel certain about good about how things are. Everything is fine and will continue to be."},{"Part":"Part 4","Part description":"Safety Needs","Subject":"Resiliency","Question":"I can handle whatever life brings me. I have been knocked in life before, and I always get back up."},{"Part":"Part 4","Part description":"Safety Needs","Subject":"Physical Security","Question":"I feel physically safe in my daily life."},{"Part":"Part 4","Part description":"Safety Needs","Subject":"Emotional/Mental Health","Question":"I feel emotionally stable and my mental health is good."},{"Part":"Part 4","Part description":"Safety Needs","Subject":"Food Security","Question":"I have enough food, and access to food - and I never worry about it."},{"Part":"Part 4","Part description":"Safety Needs","Subject":"Dwelling Security","Question":"I have a roof over my head, and I'm confident that I always will."},{"Part":"Part 5","Part description":"Physiological Needs","Subject":"Nutrition","Question":"I consciously manage my nutrition. I'm fueling my body with what it needs to excel."},{"Part":"Part 5","Part description":"Physiological Needs","Subject":"Health","Question":"I'm in excellent health for my age."},{"Part":"Part 5","Part description":"Physiological Needs","Subject":"Exercise","Question":"I exercise regularly, because fitness is a high priority for me."},{"Part":"Part 5","Part description":"Physiological Needs","Subject":"Mindfulness","Question":"I practice mindfulness daily and am able to be in the moment."},{"Part":"Part 5","Part description":"Physiological Needs","Subject":"Sleep","Question":"I'm getting good quality sleep each night."},{"Part":"Part 5","Part description":"Physiological Needs","Subject":"Substance Abuse","Question":"I don't undermine my physiology with harmful substances."}]` );
            return ( formQuestions );
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
            colors = colors.split( /\n/ );
            return ( shuffle( colors )[ 0 ].trim() );
        }

        var colorParts = [];
        var part1color = `rgba(255, 99, 132, 1)`;
        var part2color = `rgba(54, 162, 235, 1)`;
        var part3color = `rgba(195, 144, 19, 1)`; //rgb(195, 144, 19);
        var part4color = `rgba(75, 192, 192, 1)`;
        var part5color = `rgba(153, 102, 255, 1)`;
        
        var part1color = `rgba(110, 148, 248,1)`;
var part2color = `rgba(2, 183, 45, 1)`;
var part3color = `rgba(249, 186, 3, 1)`;
var part4color = `rgba(248, 126, 2,1)`;
var part5color = `rgba(251, 0, 0, 1)`;
        
          colorParts.push( part1color );
        colorParts.push( part2color );
        colorParts.push( part3color );
        colorParts.push( part4color );
        colorParts.push( part5color );
      
        
  
        colorParts.push( part1color );
        colorParts.push( part2color );
        colorParts.push( part3color );
        colorParts.push( part4color );
        colorParts.push( part5color );




        
        
        

        var formQuestions = setQdata();
        var out = "";
        var token = 0;
        var endDiv = "";
        var y = 0;
        for ( var i = 0; i < formQuestions.length; i++ ) {


            var thePartNoSpace = formQuestions[ i ].Part.replace( /\s+/ig, "" );

            if ( thePartNoSpace !== token ) {
                out += `${endDiv}<div id="${thePartNoSpace}" style="background:${colorParts[y]}; padding:12px;border-radius:8px;color:white;">`;
                var token = thePartNoSpace;
                endDiv = "</div>";
                localStorage[`${thePartNoSpace}Completed`] = 0;
                y++;
            }

            out += `<div id="Q${i}" data-assignedColor="${returnRandomColor()}" ><strong>${formQuestions[i].Subject}</strong>: ${formQuestions[i].Question}<br><span id="Q${i}Cat1"></span>

<input value="0" type="range" min="0" max="10" name="Q${i}response" onchange="addValues();" placeholder="${formQuestions[i].Question} Rate on a 0 - 10 scale" alt="${formQuestions[i]['Part description']}" title="${formQuestions[i].Part}" width=""><br>
<span class="valueHolder" id="valueHolderQ${i}">
        <span class="valueHolder hint  hintNum" id="valueHolderNum0Q${i}">0</span>
        <span class="valueHolder hint  hintNum" id="valueHolderNum1Q${i}">1</span>
        <span class="valueHolder hint  hintNum" id="valueHolderNum2Q${i}">2</span>
        <span class="valueHolder hint  hintNum" id="valueHolderNum3Q${i}">3</span>
        <span class="valueHolder hint  hintNum" id="valueHolderNum4Q${i}">4</span>
        <span class="valueHolder hint  hintNum" id="valueHolderNum5Q${i}">5</span>
        <span class="valueHolder hint  hintNum" id="valueHolderNum6Q${i}">6</span>
        <span class="valueHolder hint  hintNum" id="valueHolderNum7Q${i}">7</span>
        <span class="valueHolder hint  hintNum" id="valueHolderNum8Q${i}">8</span>
        <span class="valueHolder hint  hintNum" id="valueHolderNum9Q${i}">9</span>
        <span class="valueHolder hint  hintNum" id="valueHolderNum10Q${i}">10</span>
        
        
        </span>
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

        localStorage.currentPart = "part1";
        localStorage.currentColor = part1color;

        function checkForLogin() {
            if ( localStorage.LifeBalanceEmail ) {
                emailCapture.style.display = "none";
                scoreboard.style.display = "none";
                Part1.style.display = "";
                mainForm.style.display = "";
                reLoadFormState();
            }
        }

        document.addEventListener( "DOMContentLoaded", function ( event ) {
            checkForLogin();
        } );


        function addValues() {

            var SA = 0;
            var EC = 0;
            var LB = 0;
            var SN = 0;
            var PN = 0;
            var results = {};


            progressBar();


            var d = document.querySelectorAll( "select, input, textarea" );
            var o = "";
            var summary = "";
            var arr = [];
            var obj = {};
            var keys = [];
            obj.LifeBalanceID = localStorage.LifeBalanceID;
            obj.LifeBalanceEmail = localStorage.LifeBalanceEmail;
            obj.email = localStorage.LifeBalanceEmail;
            for ( var i = 0; i < d.length; i++ ) {
                summary = d[ i ].name + ";" + d[ i ].alt + ";" + d[ i ].placeholder + "=" + parseInt( d[ i ].value );
                obj[ d[ i ].name ] = parseInt( d[ i ].value );
                keys.push( summary );
            }
            obj.keys = keys;
            
            if (!localStorage.LifeBalanceID) {
            var s = "123456789poiuytrewqasdfghjklmnbvcxzHGTFRDEWSAZXCXVCBNHGB";
            s = s.split("");
            LifeBalanceID = "";
            for (var i = 0; i < 12; i++) {
                LifeBalanceID += shuffle(s)[0];
            }
            localStorage.LifeBalanceID = LifeBalanceID;
        }

            localStorage.LifeBalanceformData = JSON.stringify( obj );
            for ( const property in obj ) {

                if ( property.match( /Q0response|Q1response|Q2response|Q3response|Q4|Q5/g ) && Number.isInteger( obj[ property ] ) ) {
                    SA += parseInt( obj[ property ] ) * 1.66;
                }
                if ( property.match( /Q6|Q7|Q8|Q9|Q10|Q11/g ) && Number.isInteger( obj[ property ] ) ) {
                    EC += parseInt( obj[ property ] ) * 1.66;
                }
                if ( property.match( /Q12|Q13|Q14|Q15|Q16|Q17/g ) && Number.isInteger( obj[ property ] ) ) {
                    LB += parseInt( obj[ property ] ) * 1.66;
                }
                if ( property.match( /Q18|Q19|Q20|Q21|Q22|Q23/g ) && Number.isInteger( obj[ property ] ) ) {
                    //33-38
                    SN += parseInt( obj[ property ] ) * 1.66;
                }
                if ( property.match( /Q24|Q25|Q26|Q27|Q28|Q29/g ) && Number.isInteger( obj[ property ] ) ) {
                    //40-45
                    PN += parseInt( obj[ property ] ) * 1.66;
                }
                SA = Math.floor( SA * 100 ) / 100;
                EC = Math.floor( EC * 100 ) / 100;
                LB = Math.floor( LB * 100 ) / 100;
                SN = Math.floor( SN * 100 ) / 100;
                PN = Math.floor( PN * 100 ) / 100;
                console.log( SA + "; " + EC + "; " + LB + "; " + SN + "; " + PN );

            }

             drawChart( SA, EC, LB, SN, PN );
            document.getElementById( 'results' ).innerHTML = `SA - ${SA} EC - ${EC} LB - ${LB} SN - ${SN} PN - ${PN}`;
        }

        function hideSections() {
            var pse = document.getElementsByTagName( 'div' );
            for ( var i = 0; i < pse.length; i++ ) {
                if ( pse[ i ].id.match( /^Part[0-9]+/ig ) ) {
                    pse[ i ].style.display = "none";
                }
            }
            window.scrollTo( 0, 0 );
        }

        function nextsection( id ) {
            hideSections();
            var desiredNext = id.replace(/part/ig, "");
            console.log(`desiredNext ` +desiredNext);
            if (desiredNext!=1){
            var previousPart = `Part`+(desiredNext-1);
            if (localStorage[`${previousPart}Completed`] != 100){
                alert(`Please fully complete all the sections in order.`);
                nextsection( 'Part1' );
                return;
                }
            }
            document.getElementById( id ).style.display = "block";
            localStorage.currentPart = id;
            localStorage.currentColor = document.getElementById( id ).style.background;
            progressBar();
        }


        function progressBar() {
            if ( !localStorage.currentPart || !localStorage.LifeBalanceEmail ) {
                progressGroupTop.style.display = "none";
                return;
            }
            var total = 0;
            var t = 0;
            var qs = 0;
            var w = document.getElementsByTagName( "input" );

            for ( var i = 0; i < w.length; i++ ) {
                if ( w[ i ].value > 0 ) {
                    t++;
                }
                if ( w[ i ].name.match( /Q/ ) ) {
                    total++;
                }

            }
            console.log( t, total );
            buildProgressBar( t, total );
            buildsectionProgressBar();
        }

        function buildsectionProgressBar() {
            if ( !localStorage.currentPart || !localStorage.LifeBalanceEmail ) {
                return;
            }
            var t = 0;
            var total = 0;
            var color = localStorage.currentColor;
            var q = document.getElementById( localStorage.currentPart ).getElementsByTagName( "input" );
            for ( var i = 0; i < q.length; i++ ) {
                if ( q[ i ].value > 0 ) {
                    t++;
                }
                if ( q[ i ].name.match( /Q/ ) ) {
                    total++;
                }
            }

            var percent = Math.floor( ( t * 100 ) / total );
            var bars = document.getElementsByClassName( 'sectionprogress' );
            for ( var i = 0; i < bars.length; i++ ) {
                bars[ i ].style.display = `block`;
                bars[ i ].style.width = `${percent}%`;
                bars[ i ].style.background = color;
                bars[ i ].innerHTML = `${percent}%`;
                bars[ i ].title = `This section is ${percent}% complete`;
                bars[ i ].style.display = `none`;
            }
            var currentPart = localStorage.currentPart;
            localStorage[`${currentPart}Completed`] = percent;
checkForCompletedForm();
        }


function checkForCompletedForm(){
    if (localStorage.Part1Completed == 100
       && localStorage.Part2Completed == 100
        && localStorage.Part3Completed == 100
        && localStorage.Part4Completed == 100
        && localStorage.Part5Completed == 100){
        alert ("Yay, you completed the form!");
        document.body.innerHTML = "<a href='?email'>click here to have your results mailed to you.</a><br> <a href='?r'>Click here to reset the form.</a>";
        }
    
}



        document.addEventListener( "DOMContentLoaded", function ( event ) {
            hideSections();
        } );







        function buildProgressBar( t, total ) {
            var percent = Math.floor( ( t * 100 ) / total );
            var bars = document.getElementsByClassName( 'pbar' );
            for ( var i = 0; i < bars.length; i++ ) {
                if ( percent > 40 ) {
                    bars[ i ].innerHTML = `Progress: - ${percent}%`;
                }
                if ( percent <= 40 ) {
                    bars[ i ].innerHTML = `${percent}%`;
                }
                bars[ i ].style.display = `block`;
                bars[ i ].style.width = `${percent}%`;
                bars[ i ].style.background = `rgba(2,183,45,1)`;
                
                
                progressGroupTop.style.display = "block";
            }
        }



        function sendajaxShifts() {

            var payload = localStorage.LifeBalanceformData;
            // send to ajax to save
            console.log( "opening AJAX connection...." );
            var filename = localStorage.LifeBalanceEmail + ".json.txt";
            var parameters = "LifeBalanceformData=" + payload;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if ( this.readyState == 4 && this.status == 200 ) {
                    console.log( "success." );
                    //results.innerHTML = "Data was imported";
                    //helper.style.display = "none";
                    //helper.innerHTML = "";
                    //saveButton.innerHTML = "Save";
                    //saveButton.style.background = "";
                    //var t = JSON.parse(xhttp.responseText);
                    //location.assign("?shiftsSaved");
                }
            };
            xhttp.open( "POST", `index.php`, true );
            xhttp.setRequestHeader( "Content-type", "application/x-www-form-urlencoded" );
            xhttp.send( parameters );
        }
        var counter = 0;
        if ( localStorage.LifeBalanceEmail && counter < 300 ) {

            setInterval( function () {
                if ( counter < 300 ) {
                    sendajaxShifts();
                    console.log( "Counter: " + counter );
                }
                counter++;
            }, 7000 );

        }



        function reLoadFormState() {
            var o = "";
            var results = {};
            var obj = JSON.parse(localStorage.LifeBalanceformData);
            for (const property in obj) {
                console.log("trying to find " + property + ` and set it to ` + obj[property]);
                if (document.getElementsByName(property)[0]) {

                    document.getElementsByName(property)[0].value = obj[property];
                }


            }
        }

        
        function drawChart(b, l, a, c, k) {

            var toggle = shuffle(['polarArea', "line", "pie", "bar", 'radar', 'doughnut', ])[0];
            //var toggle = 'doughnut';
            cc.innerHTML = "";
            cc.innerHTML = `<canvas id="myChart" width="400" height="400" class="chart"></canvas>`;
            var ctx = document.getElementById('myChart').getContext('2d');

            if (!localStorage.LifeBalanceEmail) {
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

                //                var k = [];
                //
                //                for ( var x = 0; x < 5; x++ ) {
                //                    var base = `rgba(${shuffle(colors)[0]}, ${shuffle(colors)[0]}, ${shuffle(colors)[0]}, 1)`;
                //                    var fill = base.replace( ", 1)", ", .2)" );
                //                    //console.log(base+" "+fill); 
                //                    var obj = {}
                //                    obj.fill = fill;
                //                    obj.base = base;
                //                    k.push( obj );
                //
                //
                //
                //                }

            }
            if (localStorage.LifeBalanceEmail) {

                scoreboard.style.display = "none";
                mainform.style.marginTop = "-75px";
               
                var alphaValue = .5;



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

            if (!localStorage.LifeBalanceEmail) {
                ls = shuffle(ls);
            }

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
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
            updateTextInput();
            //removeChartFromPhone();
        }




        function updateTextInput() {

            var t = document.getElementsByTagName("input");
            for (var i = 0; i < t.length; i++) {
                if (t[i].name.match(/Q/ig)) {
                    var qvalue = t[i].name.match(/Q[0-9]+/ig);
                    
                    document.getElementById(`valueHolder${qvalue}`).classList.add("hint");
                    document.getElementById(`valueHolderNum0${qvalue}`).style.opacity=0;
                    document.getElementById(`valueHolderNum1${qvalue}`).style.opacity=0;
                    document.getElementById(`valueHolderNum2${qvalue}`).style.opacity=0;
                    document.getElementById(`valueHolderNum3${qvalue}`).style.opacity=0;
                    document.getElementById(`valueHolderNum4${qvalue}`).style.opacity=0;
                    document.getElementById(`valueHolderNum5${qvalue}`).style.opacity=0;
                    document.getElementById(`valueHolderNum6${qvalue}`).style.opacity=0;
                    document.getElementById(`valueHolderNum7${qvalue}`).style.opacity=0;
                    document.getElementById(`valueHolderNum8${qvalue}`).style.opacity=0;
                    document.getElementById(`valueHolderNum9${qvalue}`).style.opacity=0;
                    document.getElementById(`valueHolderNum10${qvalue}`).style.opacity=0;
                    document.getElementById(`valueHolderNum${t[i].value}${qvalue}`).style.opacity=1;
                }
            }

        }
        
        

        function shuffle( array ) {
            var currentIndex = array.length,
                temporaryValue, randomIndex;
            // While there remain elements to shuffle...
            while ( 0 !== currentIndex ) {
                // Pick a remaining element...
                randomIndex = Math.floor( Math.random() * currentIndex );
                currentIndex -= 1;
                // And swap it with the current element.
                temporaryValue = array[ currentIndex ];
                array[ currentIndex ] = array[ randomIndex ];
                array[ randomIndex ] = temporaryValue;
            }
            return array;
        }
        
        function getmail() {
            var em = email.value.trim();

            if (em.match(/[a-z0-9]\@[a-z0-9]/ig) && em.match(/\.[a-z0-9]/ig)) {
                mainForm.style.display = "";
                emailCapture.style.display = "none";
                resetForm();
                localStorage.LifeBalanceformData = "";
                localStorage.LifeBalanceEmail = em;
                location.assign('?eg=1');
            } else {
                alert("please enter your valid email address");
            }
        }
        function resetForm() {
            mainForm.style.display = "block";
            emailCapture.style.display = "none";

            if (localStorage.LifeBalanceEmail) {
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
            var d = document.querySelectorAll("input");
            for (var i = 0; i < d.length; i++) {
                if (d[i].name.match(/Q/)) {
                    d[i].value = shuffle([0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10])[0];
                }
            }
            addValues();
        }
        
        var counterNewUser = 0;
        if (!localStorage.LifeBalanceEmail) {
            mainForm.style.display="";
            progressGroup.style.display="none";
            partPicker.style.display="none";
            
            assignRandom();
            setInterval(function() {
                if (counterNewUser < 15) {
                    assignRandom();
                }
                counterNewUser++;
            }, 1200);
        } else {
            mainForm.style.display="";
            progressGroup.style.display="";
            partPicker.style.display="";
            score.innerHTML = "ID: " + localStorage.LifeBalanceEmail + ` <input type="submit" value="Reload previous reponses" onclick="reLoadFormState();" style="display:inline; float:right;width: 245px;"><br>Your score:`;
            resetForm();
        }
        
        
        
        
        nextsection( `Part1` );
        
        
    </script>

</body>

</html>