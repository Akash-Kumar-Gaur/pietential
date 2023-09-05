// use example
// <script id='helloScript' src='https://silvercrayon.us/pielet/?account=ErlvGACECnWj'></script>
//http://www.holtergraham.com/TRASH

var s = document.getElementById("pieScript");

s.outerHTML += `
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<script src="chartjs-plugin-watermark.js"></script>
<div class="pie" id="pieCloud" style="margin-bottom:90px;"></div>`;

var el = document.getElementById("pieCloud");

if(localStorage.pieletData){
    pieletData = JSON.parse(localStorage.pieletData);
   
}


function buildParts(){
    var colorParts = [];
    var part1color = `rgba(255, 99, 132, 1)`;
    var part2color = `rgba(54, 162, 235, 1)`;
    var part3color = `rgba(195, 144, 19, 1)`; //rgb(195, 144, 19);
    var part4color = `rgba(75, 192, 192, 1)`;
    var part5color = `rgba(153, 102, 255, 1)`;

    var part1color = `rgba(110, 148, 248, 1)`;
    var part2color = `rgba(2, 183, 45, 1)`;
    var part3color = `rgba(249, 186, 3, 1)`;
    var part4color = `rgba(248, 126, 2, 1)`;
    var part5color = `rgba(251, 0, 0, 1)`;

    colorParts.push(part1color);
    colorParts.push(part2color);
    colorParts.push(part3color);
    colorParts.push(part4color);
    colorParts.push(part5color);

    var formQuestions = setQdata();
    var out = "";
    var token = 0;
    var endDiv = "";
    var y = 0;
    for (var i = 0; i < formQuestions.length; i++) {
        var thePartNoSpace = formQuestions[i].Part.replace(/\s+/ig, "");
        var thePartNoLetters = thePartNoSpace.replace(/[a-z]+/ig, "");
        thePartNoLetters = parseInt(thePartNoLetters - 1);
        var theSectionTitle = sectionNames[thePartNoLetters];

        if (thePartNoSpace !== token) {
            out += `${endDiv}<div id="${thePartNoSpace}" style="background:${colorParts[y]}; padding:12px;border-radius:8px;color:white;">
            <h2>${theSectionTitle}</h2>On a scale of 1-10, with 1 being I completely disagree with this statement and 10 being I completely agree with this statement, how would you rate each of the following statements?<br><br>`;
            var token = thePartNoSpace;
            endDiv = "</div>";
            //pietentialData[ `${thePartNoSpace}Completed` ] = 0;
            y++;
        }

        out += `<div style="color:white;" id="Q${i}" data-assignedColor="${returnRandomColor()}" ><strong>${formQuestions[i].Subject}</strong>: ${formQuestions[i].Question}. Current Rating: <span id="rangeEchoQ${i}">0</span><br><span id="Q${i}Cat1"></span>
<div  class="rangeHolder">
<!--<input value="0" type="range" min="0" max="10" name="Q${i}response" onchange="addValues();" placeholder="${formQuestions[i].Question} Rate on a 0 - 10 scale" alt="${formQuestions[i]['Part description']}" title="${formQuestions[i].Part}" class="rangeSlider">-->

<div class="rangeHolder">
<input name="Q${i}response" style="display:none;" id="Q${i}responseVal">
<span onclick="setvalue(1,'Q${i}response' );" class="rangeButton Q${i}response">1</span>
<span onclick="setvalue(2,'Q${i}response');" class="rangeButton Q${i}response">2</span>
<span onclick="setvalue(3,'Q${i}response');" class="rangeButton Q${i}response">3</span>
<span onclick="setvalue(4,'Q${i}response');" class="rangeButton Q${i}response">4</span>
<span onclick="setvalue(5,'Q${i}response');" class="rangeButton Q${i}response">5</span>
<span onclick="setvalue(6,'Q${i}response');" class="rangeButton Q${i}response">6</span>
<span onclick="setvalue(7,'Q${i}response');" class="rangeButton Q${i}response">7</span>
<span onclick="setvalue(8,'Q${i}response');" class="rangeButton Q${i}response">8</span>
<span onclick="setvalue(9,'Q${i}response');" class="rangeButton Q${i}response">9</span>
<span onclick="setvalue(10,'Q${i}response');" class="rangeButton Q${i}response">10</span>
</div>


</div>
<br>
<span class="valueHolder" id="valueHolderQ${i}" style="margin-top:-40px;"></span>

            </div>`;
    }
    partsContainer.innerHTML = out;
}

buildParts();



function buildProgressBar(t, total) {
    var percent = Math.floor((t * 100) / total);
    var bars = document.getElementsByClassName('pbar');
    for (var i = 0; i < bars.length; i++) {
        if (percent > 60) {
            bars[i].innerHTML = `Progress: - ${percent}%`;
        }
        if (percent <= 60) {
            bars[i].innerHTML = `${percent}%`;
        }
        bars[i].style.display = `block`;
        bars[i].style.width = `${percent}%`;
        // bars[ i ].style.background = `rgba(2,183,45,1)`;
        bars[i].style.background = `rgba(50, 86, 86, 1)`;


        var n = [pieletData.Part1Completed, pieletData.Part2Completed, pieletData.Part3Completed, pieletData.Part4Completed, pieletData.Part5Completed];
        n[0] = parseInt(n[0]);
        n[1] = parseInt(n[1]);
        n[2] = parseInt(n[2]);
        n[3] = parseInt(n[3]);
        n[4] = parseInt(n[4]);

        if (n[1] < 1) {
            var grad = `linear-gradient(to right, ${part1color} 0%,${part1color} 100%)`;
        }
        if (n[1] > 1) {
            var grad = `linear-gradient(to right, 
${part1color} 0%,
${part1color} 50%,
${part2color} 50%,
${part2color} 100%
)`;
        }
        if (n[2] > 1) {
            var grad = `linear-gradient(to right, 
${part1color} 0%,
${part1color} 33%,
${part2color} 33%,
${part2color} 66%,
${part3color} 66%,
${part3color} 100%
)`;
        }
        if (n[3] > 1) {
            var grad = `linear-gradient(to right, 
${part1color} 0%,
${part1color} 25%,
${part2color} 25%,
${part2color} 50%,
${part3color} 50%,
${part3color} 75%,
${part4color} 75%,
${part4color} 100%
)`;
        }
        if (n[4] > 1) {
            var grad = `linear-gradient(to right, 
${part1color} 0%,
${part1color} 20%,
${part2color} 20%,
${part2color} 40%,
${part3color} 40%,
${part3color} 60%,
${part4color} 60%,
${part4color} 80%,
${part5color} 80%,
${part5color} 100%
)`;
        }

        n[0] = n[0] / 5;
        n[1] = n[0] + (n[1] / 5);
        n[2] = n[1] + n[2] / 5;
        n[3] = n[2] + n[3] / 5;
        n[4] = n[3] + n[4] / 5;



        
        bars[i].style.background = grad;
        console.log(grad);

        //progressGroupTop.style.display = "block";
    }
}

function populate() {
    let htm = `
    <link href="//pietential.com/styles.css" rel="stylesheet" type="text/css"></link>
    <div id="minibranding" style="margin: auto; text-align: center; display:none;">
    <a href="./"><img src="https://pietential.com/pietential.png" style="width: 10%;max-width: 500px;margin-bottom:10px;margin: auto;"></a>
</div>
<div id="branding" style="margin: auto; text-align: center;">
        <img src="//pietential.com/pietential.png" style="width: 90%;max-width: 500px;margin-bottom:10px;margin: auto;">
        <h1>Realize Your Growth Potential</h1>
        <style>
            .col2 {
                width: 48%;
                float: left;
                text-align: left;
                margin: 12px;
            }
        </style>
        <section style="max-width:1000px; margin:auto">
            <div style="margin:0px;">
                <div id="abstract" style="text-align: left; margin: 30px 0px; box-sizing:border-box;padding: 12px;">
                    
                    <p><span style="font-size: 16px;"><strong>Your Growth Potential
                                <br><span style="font-size: 18px;">The better you can Visualize it</span>
                                <br><span style="font-size: 22px;">The more effectively you can Analyze it.</span>
                                <br><span style="font-size: 26px;">And the easier you can Realize it.</span></strong></span>
                        <br>
                        <br><b>Pietential is a survey-based life balance visualization tool, developed by {{firstName}} {{lastName}}, and based on Maslow’s Hierarchy of needs.</b></p>
                    <p style="margin-top:6px;">I’ve always been fascinated by Maslow’s Needs, as being the core of what’s common to us all - but I’ve never agreed with it being represented as a hierarchy.</p>
                    <p style="margin-top:6px;">The way these needs are typically represented, it’s as if your entire life is organized to support a precious little amount of self-actualization, that only a few of us ever reach. It makes it seem like if you don’t have the lower echelons firmly in place, you’ll never achieve any level of self-actualization. That’s ridiculous. By this standard, Ghandi, Bhudda, and Jesus shouldn’t have had a chance to become the self-actualizing beings that they were. </p>
                    <p style="margin-top:6px;"><b>I see it differently. Maybe you will too?</b>

                        <br>I see these issues regarding Physiological needs, Safety needs, Love and Belonging, Esteem, and Self-actualization as a continuum. I was able to create a simple 3-5 minute survey that allows you to visualize your own current relationship to the components of Maslow’s “Hierarchy” of Needs as pie chart. </p>
                    <p style="margin-top:6px;"><b>Pietential </b>helps you <b>Visualize</b>, and <b>Analyze</b> where you stand on these core issues that are central to life, so you can set and <b>Realize</b> your goals for self improvement.</p>
                    <p style="margin-top:6px;">~<a href="https://www.starlinggrowthadvisory.com/history" target="_self">{{firstName}} {{lastName}}</a></p>
                    <p style="margin-top:6px;"><span style="font-size: 30px;"><b>Visualize. Analyze. Realize.</b></span></p>
                </div>
            </div>
        </section>


        <section id="explainer" style="max-width: 800px;text-align: center;margin: auto;">

        </section>


    </div>

    <div id="emailCapture" class="max500" style="padding-top:80px;max-width:800px; margin:auto; text-align:center;">

    <span style="
    font-size: 66px;
    color: cornflowerblue;
    display: inline-block;
    position: absolute;
    margin-top: -13px;
    margin-left: -63px;
    ">➡</span><input name="email" id="email" required="" type="email" placeholder="Enter your email to begin the evaluation" style="width:80%; max-width:500px;text-align:center;">
        <br>
        <div class="bt" onclick="getmail()" style="padding: 12px 49px;
    font-size: 20px;">Start evaluation</div><br><br>
    </div>


    <form class="max500" id="mainformParent" style="margin:auto;" enctype="multipart/form-data" action="" onclick="addValues();" method="post">


        <section id="headline" style="display:none;">
            <h1>Pietential</h1>
            <h2 style="display: inline-block; margin-top: -3%;">Growth Potential Visualization Survey</h2>
        </section>
        <!--<div class="bt" style="padding:1% 8%;" onclick="">More info </div>-->


        <section id="topChartGen" style="display:none; margin:auto">
            <!-- Form has been completed.<br><br>-->
            <div class="bt" style="font-size:30px; padding:1% 8%;" onclick="location.assign('?showResults')">Visualize It</div><br><br><br>

            <!--<div class="bt" onclick="sendChartAsPNG()">Return to editing</div>-->


        </section>
        <div id="mainForm" style="">
        <div id="scoreboard"></div>
        <div id="cc">
        <canvas id="myChart"  style="width:90%;  top:100px;"  class="chart"></canvas>
<canvas id="barchart"  style="width:90%;  top:100px;"  class="chart"></canvas>
</div>
<div id="branding2" style="margin: auto; text-align: center;"></div>
            <section id="partPicker" style="margin: 0px 0px 15px; text-align: center; display: none;">
                <div class="bt color1 partpickerButton" onclick="nextsection('Part1');">Self-Actualization</div>
                <div class="bt color2 partpickerButton" onclick="nextsection('Part2');">Esteem</div>
                <div class="bt color3 partpickerButton" onclick="nextsection('Part3');">Love and Belonging</div>
                <div class="bt color4 partpickerButton" onclick="nextsection('Part4');">Safety needs</div>
                <div class="bt color5 partpickerButton" onclick="nextsection('Part5');">Physiological needs</div>
            </section>




            <div id="progressGroupTop" style="display: none;">
                <div style="border-radius: 6px; width:100%; background: #eee;padding:0px;margin:10px 0px;">
                    <div class="pbar" style="padding:10px;border-radius: 6px; color:white; background: #377dd4; "></div>
                </div>
            </div>
            <div id="partsContainer">
</div>

<br>
<span class="valueHolder" id="valueHolderQ25" style="margin-top:-40px;"></span>

<form class="max500" id="mainformParent" style="margin:auto;" enctype="multipart/form-data" action="" onclick="addValues();" method="post">


<section id="headline" style="display:none;">
    <h1>Pietential</h1>
    <h2 style="display: inline-block; margin-top: -3%;">Growth Potential Visualization Survey</h2>
</section>
<!--<div class="bt" style="padding:1% 8%;" onclick="">More info </div>-->


<section id="topChartGen" style="display:none; margin:auto">
    <!-- Form has been completed.<br><br>-->
    <div class="bt" style="font-size:30px; padding:1% 8%;" onclick="location.assign('?showResults')">Visualize It</div><br><br><br>

    <!--<div class="bt" onclick="sendChartAsPNG()">Return to editing</div>-->


</section>
<div id="mainForm" style="">
    <section id="partPicker" style="margin: 0px 0px 15px; text-align: center; display: none;">
        <div class="bt color1 partpickerButton" onclick="nextsection('Part1');">Self-Actualization</div>
        <div class="bt color2 partpickerButton" onclick="nextsection('Part2');">Esteem</div>
        <div class="bt color3 partpickerButton" onclick="nextsection('Part3');">Love and Belonging</div>
        <div class="bt color4 partpickerButton" onclick="nextsection('Part4');">Safety needs</div>
        <div class="bt color5 partpickerButton" onclick="nextsection('Part5');">Physiological needs</div>
    </section>




    <div id="progressGroupTop" style="display: none;">
        <div style="border-radius: 6px; width:100%; background: #eee;padding:0px;margin:10px 0px;">
            <div class="pbar" style="padding:10px;border-radius: 6px; color:white; background: #377dd4; "></div>
        </div>
    </div>
    
    <section id="partPickerBottom" style="margin: 15px 0px; text-align: center; display: none;">
        <div class="bt color1 partpickerButton" onclick="nextsection('Part1');">Self-Actualization</div>
        <div class="bt color2 partpickerButton" onclick="nextsection('Part2');">Esteem</div>
        <div class="bt color3 partpickerButton" onclick="nextsection('Part3');">Love and Belonging</div>
        <div class="bt color4 partpickerButton" onclick="nextsection('Part4');">Safety needs</div>
        <div class="bt color5 partpickerButton" onclick="nextsection('Part5');">Physiological needs</div>
    </section>
    <div id="progressGroup" style="display: none;">



        <div id="sectionprogressParent" style="display: none; border-radius: 2px; width:100%; background: #eee;padding:0px;margin:10px 0px">
            <span class="note">Section progress:<br></span>
            <div style="padding: 2px;font-size: 11px; border-radius: 2px; color:white; background: #377dd4; " class="sectionprogress"></div>
        </div>
        <span class="note" style="display:none;">Overall progress:<br></span>
        <div id="pbarParent" style="border-radius: 6px; width:100%; background: #eee;padding:0px;margin:10px 0px;">
            <div class="pbar" style="padding:10px;border-radius: 6px; color:white; background: #377dd4; "></div>
        </div>
        <!--                <i style="font-size: 11px;  opacity: .5;  text-align: right;margin-top: -3%;  position: absolute; left: 30%;">all changes saved...</i>-->
    </div>
</div>
</form>


</div>

<br>
<span class="valueHolder" id="valueHolderQ29" style="margin-top:-40px;"></span>

                </div></div></div>
            <section id="partPickerBottom" style="margin: 15px 0px; text-align: center; display: none;">
                <div class="bt color1 partpickerButton" onclick="nextsection('Part1');">Self-Actualization</div>
                <div class="bt color2 partpickerButton" onclick="nextsection('Part2');">Esteem</div>
                <div class="bt color3 partpickerButton" onclick="nextsection('Part3');">Love and Belonging</div>
                <div class="bt color4 partpickerButton" onclick="nextsection('Part4');">Safety needs</div>
                <div class="bt color5 partpickerButton" onclick="nextsection('Part5');">Physiological needs</div>
            </section>
            <div id="progressGroup" style="display: none;">



                <div id="sectionprogressParent" style="display: none; border-radius: 2px; width:100%; background: #eee;padding:0px;margin:10px 0px">
                    <span class="note">Section progress:<br></span>
                    <div style="padding: 2px;font-size: 11px; border-radius: 2px; color:white; background: #377dd4; " class="sectionprogress"></div>
                </div>
                <span class="note" style="display:none;">Overall progress:<br></span>
                <div id="pbarParent" style="border-radius: 6px; width:100%; background: #eee;padding:0px;margin:10px 0px;">
                    <div class="pbar" style="padding:10px;border-radius: 6px; color:white; background: #377dd4; "></div>
                </div>
                <!--                <i style="font-size: 11px;  opacity: .5;  text-align: right;margin-top: -3%;  position: absolute; left: 30%;">all changes saved...</i>-->
            </div>
        </div>
    </form>
`;
    el.innerHTML += htm;
}

populate();

function formHasBeenCompleted() {
    branding2.style.display = "none";
    minibranding.style.display = "none";
}


if (!localStorage.pieletData) {
    var pieletData = {};
    pieletData.partnerID = s.src.match(/account.+/ig)[0];
    pieletData.partnerID = pieletData.partnerID.replace(/.+=/, '');
    pieletData.userID = pickID();
    localStorage.pieletData = JSON.stringify(pieletData);
} else {
    pieletData = JSON.parse(localStorage.pieletData);
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
function pickID() {
    var n = 0, id = "";
    var c = `abcdefghijklmnopqrstuvwxyz01234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ`;
    var pool = c.split(``);
    while (n < 12) {
        id += shuffle(pool)[0];
        n++;
    }
    return (id);
}



function getmail() {
    //alert(JSON.stringify(pieletData));
    var em = email.value.trim();
    if (em.match(/[a-z0-9]\@[a-z0-9]/ig) && em.match(/\.[a-z0-9]/ig)) {
        pieletData.email = em;
        saveState();
        show("headline");
        show("partPicker");
        show("progressGroupTop");
        show("Part1");
        show("Part1");
        show("Part1");
        show("Part1");
        show("Part1");
    }
}

function showPrivacy() {
    footer.innerHTML = privacy + footer.innerHTML;
    plinks.style.display = "none";
}

function movebranding() {
    branding.style.display = "none";
    branding2.innerHTML = branding.innerHTML;
    if (branding2.innerHTML.match(/Congratulations/)) {
        branding2.style.display = "none";
    }
}

function setvalue(n, className) {
    var idname = `${className}Val`;
    document.getElementById(idname).value = n;
    document.getElementById(idname).setAttribute('value', n);
    //alert(idname);
    pieletData[className] = n;
    addValues();
    makeAllButtonsBlack(className);
    window[className] = n;
    var r = document.getElementsByClassName(className);
    for (var i = 0; i < r.length; i++) {
        var val = parseInt(r[i].innerHTML);
        if (val <= n) {
            r[i].style.background = "rgb(55, 125, 212)";
            r[i].style.opacity = "1";
        }
        if (val == n) {
            r[i].style.background = "rgb(24, 75, 138)";
        }
    }
    //alert(Q0response);
}

function makeAllButtonsBlack(className) {
    var r = document.getElementsByClassName(className);
    for (var i = 0; i < r.length; i++) {
        r[i].style.background = "black";
        r[i].style.opacity = ".2";
    }
}



function openpdf() {
    document.body.outerHTML = `
   <body style="padding:0;margin:0;background: black;height:100%">
<div style="padding: 0%;  text-align:center; width: 100%;">
<div
    style="padding: 20%;     background: black;     color: white;     text-align: center;     width: 50%;     margin: 20;">
    <div class="donutSpinner"></div><br><br>
    Generating PDF...<br><br>Once the PDF is downloaded you may close this window or go back.<br><br><br><br> <button class="bt" onclick="window.history.back();"
        style="margin: 0px; display: inline-block; width: 120px; text-align: center;">Go back</button> </div>
</div>
</body>`;

    location.assign(`?pdf=` + pieletData.email);
}


function addValues() {
    //

    //alert(JSON.stringify(pieletData));
    minibranding.style.display = "block";
    pieletData.restrequest = "";
    var SA = 0;
    var EC = 0;
    var LB = 0;
    var SN = 0;
    var PN = 0;
    var results = {};
    var d = [];
    
    
    var d = document.querySelectorAll("select, input, textarea");
    var o = "";
    var summary = "";
    var arr = [];
    var obj = {};
    var keys = [];
    pieletData.userID;
    pieletData.email;
    pieletData.email;
    for (var i = 0; i < d.length; i++) {
        summary = d[i].name + ";" + d[i].alt + ";" + d[i].placeholder + "=" + parseInt(d[i].value);
        pieletData[d[i].name] = parseInt(d[i].value);
        //keys.push(summary);
    }
    //pieletData.keys = keys;

    


    for (const property in pieletData) {

        if (property.match(/Q0response|Q1response|Q2response|Q3response|Q4|Q5/g) && Number.isInteger(pieletData[property])) {
            SA += parseInt(pieletData[property]) * 1.66;
            SA = roundNumber(SA);
        }
        if (property.match(/Q6|Q7|Q8|Q9|Q10|Q11/g) && Number.isInteger(pieletData[property])) {
            EC += parseInt(pieletData[property]) * 1.66;
            EC = roundNumber(EC);
        }
        if (property.match(/Q12|Q13|Q14|Q15|Q16|Q17/g) && Number.isInteger(pieletData[property])) {
            LB += parseInt(pieletData[property]) * 1.66;
            LB = roundNumber(LB);
        }
        if (property.match(/Q18|Q19|Q20|Q21|Q22|Q23/g) && Number.isInteger(pieletData[property])) {
            //33-38
            SN += parseInt(pieletData[property]) * 1.66;
            SN = roundNumber(SN);
        }
        if (property.match(/Q24|Q25|Q26|Q27|Q28|Q29/g) && Number.isInteger(pieletData[property])) {
            //40-45
            PN += parseInt(pieletData[property]) * 1.66;
            PN = roundNumber(PN);
        }
        
        console.log(SA + "; " + EC + "; " + LB + "; " + SN + "; " + PN);

    }
    var LBscorevalues = {};
    LBscorevalues.SA = SA;
    LBscorevalues.EC = EC;
    LBscorevalues.LB = LB;
    LBscorevalues.SN = SN;
    LBscorevalues.PN = PN;
    pieletData.LBscorevalues = LBscorevalues;
    
    drawChart(SA, EC, LB, SN, PN);
    
    drawBar(SA, EC, LB, SN, PN);
    document.getElementById('results').innerHTML = `SA - ${SA} EC - ${EC} LB - ${LB} SN - ${SN} PN - ${PN}`;
    addWatermark();
    progressBar();
    check();
}

function calculateGradient(n) {
    var arr = n.split(`j`);
    if (pieletData.email) {
        //myChart.style.display = "none";
        var bars = document.getElementsByClassName('pbar');
        for (var i = 0; i < bars.length; i++) {
            //bars[ i ].style.background = 
            //`linear-gradient(left, ${part2color} 50%, white 50%)`;
        }
    }
}

function hideSections() {
    var pse = document.getElementsByTagName('div');
    for (var i = 0; i < pse.length; i++) {
        if (pse[i].id.match(/^Part[0-9]+/ig)) {
            pse[i].style.display = "none";
            //pse[ i ].style.opacity = ".2";

        }
    }
    //focusOnCurrentPart();
    window.scrollTo(0, 0);
}

function nextsection(id) {
    hideSections();
    if (!pieletData.email) {
        return;
    }
    var desiredNext = id.replace(/part/ig, "");
    console.log(`desiredNext ` + desiredNext);
    if (desiredNext != 1) {
        var previousPart = `Part` + (desiredNext - 1);
        if (pieletData[`${previousPart}Completed`] != 100) {
            alert(`Please fully complete all the sections in order. Score each question from 1 to 10. (You must score at least 1 for each question.)`);
            focusOnCurrentPart();
            return;
        }
    }
    document.getElementById(id).style.display = "block";
    
    pieletData.currentPart = id;
    pieletData.currentColor = document.getElementById(id).style.background;
    progressBar();
}
var onCurrent = 0;



function focusOnCurrentPart() {
    if (pieletData.newUser) {
        pieletData.newUser = "";
        nextsection('Part1');
        return;
    }
    if (pieletData.Part4Completed == 100) {
        nextsection("Part5");
        onCurrent = 5;
        mainForm.style.display = "";
        return;
    }
    if (pieletData.Part3Completed == 100) {
        nextsection("Part4");
        onCurrent = 4;
        mainForm.style.display = "";
        return;
    }
    if (pieletData.Part2Completed == 100) {
        nextsection("Part3");
        onCurrent = 3;
        mainForm.style.display = "";
        return;
    }
    if (pieletData.Part1Completed == 100) {
        nextsection("Part2");
        onCurrent = 1;
        mainForm.style.display = "";
        return;
    }
    nextsection("Part1");
}
if (pieletData.email) {
    focusOnCurrentPart();
}

function roundNumber(n){
    n = Math.round(n);
    if(n>98){
        n = 100;
    }
    if (n==59 || n==58){
        n=60;
    }
    return(n);
}

function drawChartMini(b, l, a, c, k) {
    // b = roundNumber(b);
    // l = roundNumber(l);
    // a = roundNumber(a);
    // c = roundNumber(c);
    // k = roundNumber(k);
    var ctx = document.getElementById('myChart').getContext('2d');
    var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
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
    var myChart = new Chart(ctx, {
        //type: toggle,
        type: 'polarArea',
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
            watermark: {
                image: "watermark.png",

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

function drawBar(b, l, a, c, k) {
    // b = roundNumber(b);
    // l = roundNumber(l);
    // a = roundNumber(a);
    // c = roundNumber(c);
    // k = roundNumber(k);
var ctx = document.getElementById('barchart').getContext('2d');
var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
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
var barchart = new Chart(ctx, {
//type: toggle,
type: 'bar',
// type: 'doughnut',
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
//     image: "watermark.png",

//     alignY: "top",
//     alignX: "right",
//     width: "20%",
//     height: "45%",
//     position: "back",
// },
legend: {
display: false,
},
scales: {
    yAxes: [{
        ticks: {
            beginAtZero: true,
            max:100
        }
    }]
}


}
});




}


function makeChartsVisible(){
document.getElementById("myChart").style.display = "block";
document.getElementById("barchart").style.display = "block";
}

function makeChartsInVisible(){
document.getElementById("myChart").style.display = "none";
document.getElementById("barchart").style.display = "none";
}

function drawChart(b, l, a, c, k) {
    // b = roundNumber(b);
    // l = roundNumber(l);
    // a = roundNumber(a);
    // c = roundNumber(c);
    // k = roundNumber(k);
    if (!location.href.match(/anal/)) {
        formHasBeenCompleted();
    }

    updateTextInput();


    if (pieletData.chartHide == 1 && !location.href.match(/anal/)) {
        return;
    }
    if (hety > 0) {

        return;
    }
    hety++;



    var toggle = shuffle(['polarArea', "line", "pie", "bar", 'radar', 'doughnut', ])[0];
    //var toggle = 'doughnut';
    cc.innerHTML = "";
    document.getElementById("scoreboard").outerHTML += `<div style="text-align:center;">
    <a href="./"><img src="pietential.png" style="width: 10%;max-width: 500px;margin-bottom:10px;margin: auto;"></a>
    <h1>Your Growth Potential Visualized</h1>

    <!--
    <button class="bt" style="margin: 0px; display: inline-block; width: 120px; text-align: center;" onclick="location.assign('?analyzeit')">Analyze It</button>

    <button class="bt" onclick="sendChartAsPNG('myChart')" style="margin: 0px; display: inline-block; width: 120px; text-align: center;">Return to Home</button> 

<button class="bt" onclick="location.assign('https://pietential.com/?share=discover');" class="bt">Share results on social media</button>

<button class="bt" onclick="download()">Download chart</button>

<button class="bt" id="facebookGroup" onclick="location.assign('https://www.facebook.com/GrowThePie/')">Join the Facebook group</button>
</div>
-->
<div>

</div> `;
    var datesHTML = "";

    //            if (pieletData.LifeBalanceDates) {
    //                var datesHTML = `<div id='previousDates' style="border: 1px solid gray; padding: 12px; font-family: sans-serif; border-radius: 8px; line-height: 1.5em; margin:auto; margin-top:40px;opacity: 0.7; max-width:400px; font-size: 14px; font-weight: bold; background: rgb(238, 238, 238);">Your results by date:<br><br>`;
    //                var dateArr = JSON.parse(pieletData.LifeBalanceDates);
    //                for (var i = 0; i < dateArr.length; i++) {
    //                    datesHTML += `<a href="?loadDate=${dateArr[i]}">${dateArr[i]}</a><br>`;
    //                }
    //                datesHTML += `</div>`;
    //            }

    scoreboard.outerHTML += datesHTML;
    //previousDates.style.margin = "7%";
    cc.innerHTML = ``;
    mainformParent.style.display = "none";

    //bigChart.innerHTML = `<canvas id="bc"  width="1500" height="1500" class="chart"></canvas>`;
    var ctx = document.getElementById('myChart').getContext('2d');


    if (!pieletData.email) {
        hideSections();
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


    }
    if (pieletData.email) {
        branding.style.display = "none";
        scoreboard.style.display = "none";
        //mainForm.style.marginTop = "-75px";

        var alphaValue = .5;
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

    }

    var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];

    if (!pieletData.email) {
        ls = shuffle(ls);
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
            
            watermark: {
                image: "watermark.png",

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
    if (pieletData.email) {
        //myChart.style.display = "none";
    }

}

function resetForm() {
    mainForm.style.display = "block";
    emailCapture.style.display = "none";

    if (pieletData.email) {
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
    var b = shuffle([10, 20, 30, 40, 50, 60])[0];
    var l = shuffle([10, 20, 30, 40, 50, 60])[0];
    var a = shuffle([10, 20, 30, 40, 50, 60])[0];
    var c = shuffle([10, 20, 30, 40, 50, 60])[0];
    var k = shuffle([10, 20, 30, 40, 50, 60])[0];
    drawChart(b, l, a, c, k);
}


var counterNewUser = 0;
// if (!pieletData.email) {
//     mainForm.style.display = "";
//     progressGroup.style.display = "none";
//     partPicker.style.display = "none";

//     //assignRandom();

//     setInterval(function() {
//         if (counterNewUser < 15) {
//             // assignRandom();
//             // hideSections();
//         }
//         counterNewUser++;
//     }, 1200);
// } else {
//     mainForm.style.display = "";
//     progressGroup.style.display = "";
//     partPicker.style.display = "";
//     score.innerHTML = "ID: " + pieletData.email + ` <input type="submit" value="Reload previous reponses" onclick="reLoadFormState();" style="display:inline; float:right;width: 245px;"><br>Your score:`;
//     resetForm();
// }

function removeDescriptionAndScore(id, scoreName) {
    var el = document.getElementById(id);
    var el60 = document.getElementById(id + '60');
    var em = document.getElementById("scoreSummary");
    var sv = pieletData.LBscorevalues;
    var score = sv[scoreName];
    //score = roundNumber(score);
    if(score>98){
        score=100;
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
        //alert("the score is "+score);
    } else {
        el60.style.display = "none";
        headline.innerHTML += `<br><i style="color:#377dd4;">Suggestions for improvement:</i> `;
        em.innerHTML += `<div style="color:#94083b;margin-top:5px;"><b>${secName}</b>: ${score}%  (needs improvement)</div>`;
        pieletData.PDFsummary += em.innerHTML;
        // pieletData.PDFsummary += headline.innerHTML;
    }
    if (pieletData.svTotal > 4) {
        //  responderIntro.innerHTML = `<br><br><b>You have a Pietential score over 200.</b><br>Well done! At this time your life balance appears to be healthy. Keep doing what you are doing!<br><br>`;
        //  pieletData.PDFsummary += responderIntro.innerHTML
    }
}

function analyzeitFunc() {
    pieletData.PDFsummary = "";
    pieletData.svTotal = 0;
    pieletData.analyzeit = 1;
    buildPage(responder);
    shellContent.style.maxWidth = "800px";
    shellContent.style.margin = "auto";
    shellContent.style.boxSizing = "border-box";
    shellContent.style.padding = "20px";
    addFooter();
    explainer.style.display = "none";
    branding.style.display = "none";
    emailCapture.style.display = "none";
    removeDescriptionAndScore(`responderPhysiological`, `PN`);
    removeDescriptionAndScore(`responderActualization`, `SA`);
    removeDescriptionAndScore(`responderEsteem`, `EC`);
    removeDescriptionAndScore(`responderSafety`, `SN`);
    removeDescriptionAndScore(`responderLove`, `LB`);
    document.getElementById("minichart").innerHTML = `<div><canvas id="myChart"  style="width:90%;" class="chart"></canvas>
    <canvas id="barchart"  style="width:90%;  class="chart"></canvas></div>`;
    var f = pieletData.LBscorevalues;
    var SA = f.SA;
    var EC = f.EC;
    var LB = f.LB;
    var SN = f.SN;
    var PN = f.PN;
    drawChartMini(SA, EC, LB, SN, PN);
    
    drawBar(SA, EC, LB, SN, PN);
    sendSummary();
}

// function addFooter() {
//     if (!document.body.innerHTML.match(/id="footer"/)) {
//         document.body.innerHTML += `<div id="footer" style="text-align: center;">
// <div id="analyzeit" style="display:none">
// <div class="bt" style="font-size:30px; padding:1% 8%;" onclick="location.assign('?analyzeit')">Analyze It</div><br><br><br>
// </div>

// <div id="logos" style="opacity:.5;transform:scale(.5)">
// Created and developed by: <br>
// <a href="https://starlinggrowthadvisory.com/" target="_top"><img src="starling-logo.png" style="width: 25%;max-width: 800px;margin-bottom:10px;margin: auto;"></a>

// <a href="https://silvercrayon.us/" target="_top"><img src="labs.svg" style="width: 22%;max-width: 800px;margin-bottom:10px;margin: auto;filter: brightness(0.1);"></a><br>
// </div>

// <div id="privacyHardCoded" style="display:none;">{{privacyHardCoded}}</div>

// <div id="plinks" style="text-align: center;margin-top: 28px;">© 2020 <a href="https://www.starlinggrowthadvisory.com/" target="_top">Starling Growth Advisory.</a> <a href="javascript://" onclick="privacyHardCoded.style.display='';">Privacy Policy</a></div>

// </div>`;

//     }
// }


function addWatermark() {
    //myChart.style.background = "url(watermark.png) 100% 100% / 14% no-repeat";
    // myChart.style.backgroundRepeat = "no-repeat";
    // myChart.style.backgroundPositionX = "right";
    // myChart.style.backgroundPositionY = "bottom";
}


function updateTextInput() {

    var t = document.getElementsByTagName("input");
    for (var i = 0; i < t.length; i++) {
        if (t[i].name.match(/Q/ig)) {
            var qvalue = t[i].name.match(/Q[0-9]+/ig);
            if (document.getElementById(`rangeEcho${qvalue}`)) {
                document.getElementById(`rangeEcho${qvalue}`).innerHTML = t[i].value;
            }

        }
    }

}



function progressBar() {
    if (!pieletData.currentPart || !pieletData.email) {
        progressGroupTop.style.display = "none";
        return;
    }
    var total = 0;
    var t = 0;
    var qs = 0;
    var w = document.getElementsByTagName("input");
    

    for (var i = 0; i < w.length; i++) {
        if (w[i].value > 0) {
            t++;
        }

        if (w[i].name.match(/Q/)) {
            total++;
        }

    }
    console.log(t, total);
    buildProgressBar(t, total);
    buildsectionProgressBar();
}

function buildsectionProgressBar() {
    if (!pieletData.currentPart || !pieletData.email) {
        return;
    }
    if (!document.getElementById(pieletData.currentPart)) {
        return;
    }
    var t = 0;
    var total = 0;
    var color = pieletData.currentColor;
    var q = document.getElementById(pieletData.currentPart).getElementsByTagName("input");
    for (var i = 0; i < q.length; i++) {
        if (q[i].value > 0) {
            t++;
        }
        if (q[i].name.match(/Q/)) {
            total++;
        }
    }

    var percent = Math.floor((t * 100) / total);
    var bars = document.getElementsByClassName('sectionprogress');
    for (var i = 0; i < bars.length; i++) {
        bars[i].style.display = `block`;
        bars[i].style.width = `${percent}%`;
        //bars[ i ].style.background = color;
        bars[i].innerHTML = `${percent}%`;
        bars[i].title = `This section is ${percent}% complete`;
        bars[i].style.display = `none`;
    }
    var currentPart = pieletData.currentPart;
    pieletData[`${currentPart}Completed`] = percent;
    
}

function saveState() {
    var payload = JSON.stringify(pieletData);
    localStorage.pieletData = payload;
    var parameters = "pieletData=" + payload;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("ajax success.");
        }
    }
    xhttp.open("POST", `//silvercrayon.us/pielet/`, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(parameters);
}

var hety = 0;
function check(){
    var incomplete = 0;
    var inputs = document.getElementsByTagName("input");
    if(inputs.length<1){
        return;
    }
    for(var i = 0; i<inputs.length; i++){
        pieletData[inputs[i].name] = inputs[i].value;
        if(inputs[i].name.match(/^Q/) && inputs[i].value<1){
             incomplete = 1;
        }
    }
    if(incomplete==0){
        // form is complete
        saveState();
    }
}

var formQuestions = [{"Part":"Part 1","Part description":"Self Actualization","Subject":"Personal Development","Question":"I'm actively engaged in my own personal development to become the best me I can be."},{"Part":"Part 1","Part description":"Self Actualization","Subject":"Well Being","Question":"I'm comfortable with myself. I feel balanced and fulfilled. My daily mindset is positive."},{"Part":"Part 1","Part description":"Self Actualization","Subject":"Spirituality and Life Purpose","Question":"I know my life has meaning. I know my purpose in life and I'm living it."},{"Part":"Part 1","Part description":"Self Actualization","Subject":"Education","Question":"I seek and gain the education I need to have a fulfilling life."},{"Part":"Part 1","Part description":"Self Actualization","Subject":"Achievement","Question":"I'm satisfied with what I've achieved in life so far."},{"Part":"Part 1","Part description":"Self Actualization","Subject":"Mastery","Question":"I am working to master new skills."},{"Part":"Part 2","Part description":"Esteem and Contribution","Subject":"Contribution","Question":"I've made contributions to my community that I'm proud of."},{"Part":"Part 2","Part description":"Esteem and Contribution","Subject":"Purpose","Question":"My life has purpose."},{"Part":"Part 2","Part description":"Esteem and Contribution","Subject":"Self Respect","Question":"I have a high degree of self respect. I matter to me and my actions show it."},{"Part":"Part 2","Part description":"Esteem and Contribution","Subject":"Respect and Status","Question":"People respect me. I'm recognized for my efforts. and have achieved a certain amount of status in life."},{"Part":"Part 2","Part description":"Esteem and Contribution","Subject":"Strength/Empowerment","Question":"I feel empowered and strong. I fully express myself."},{"Part":"Part 2","Part description":"Esteem and Contribution","Subject":"Freedom and Expression","Question":"I have a lot of personal freedom to call my own shots in life."},{"Part":"Part 3","Part description":"Love and Belonging","Subject":"Family Relationships","Question":"I have a solid, healthy relationship with my family."},{"Part":"Part 3","Part description":"Love and Belonging","Subject":"Friendship","Question":"I make and have deep, lasting, healthy friendships."},{"Part":"Part 3","Part description":"Love and Belonging","Subject":"Social Relationship","Question":"My social relationships are full of positive interactions."},{"Part":"Part 3","Part description":"Love and Belonging","Subject":"Intimacy","Question":"My intimate relationships are fulfilling"},{"Part":"Part 3","Part description":"Love and Belonging","Subject":"Play","Question":"I allow myself the freedom to play."},{"Part":"Part 3","Part description":"Love and Belonging","Subject":"Compassion","Question":"I have deep compassion for others."},{"Part":"Part 4","Part description":"Safety Needs","Subject":"Certainty","Question":"I feel certain about good about how things are. Everything is fine and will continue to be."},{"Part":"Part 4","Part description":"Safety Needs","Subject":"Resiliency","Question":"I can handle whatever life brings me. I have been knocked in life before, and I always get back up."},{"Part":"Part 4","Part description":"Safety Needs","Subject":"Physical Security","Question":"I feel physically safe in my daily life."},{"Part":"Part 4","Part description":"Safety Needs","Subject":"Emotional/Mental Health","Question":"I feel emotionally stable and my mental health is good."},{"Part":"Part 4","Part description":"Safety Needs","Subject":"Food Security","Question":"I have enough food, and access to food - and I never worry about it."},{"Part":"Part 4","Part description":"Safety Needs","Subject":"Dwelling Security","Question":"I have a roof over my head, and I'm confident that I always will."},{"Part":"Part 5","Part description":"Physiological Needs","Subject":"Nutrition","Question":"I consciously manage my nutrition. I'm fueling my body with what it needs to excel."},{"Part":"Part 5","Part description":"Physiological Needs","Subject":"Health","Question":"I'm in excellent health for my age."},{"Part":"Part 5","Part description":"Physiological Needs","Subject":"Exercise","Question":"I exercise regularly, because fitness is a high priority for me."},{"Part":"Part 5","Part description":"Physiological Needs","Subject":"Mindfulness","Question":"I practice mindfulness daily and am able to be in the moment."},{"Part":"Part 5","Part description":"Physiological Needs","Subject":"Sleep","Question":"I'm getting good quality sleep each night."},{"Part":"Part 5","Part description":"Physiological Needs","Subject":"Substance Abuse","Question":"I don't undermine my physiology with harmful substances."}];

pieCloud.innerHTML += `<div id="part1"></div><div id="part2"></div><div id="part3"></div><div id="part4"></div><div id="part5"></div>`;

for (var i = 0; i<formQuestions.length; i++){
//
}

function show(id){
    document.getElementById(id).style.display = "block";
}
function hide(id){
    document.getElementById(id).style.display = "none";
}


document.addEventListener("DOMContentLoaded", function(event) {
    //lightBox();
    email.value = pieletData.email;
    if (location.href.match(/showResults/ig)) {
        
        minibranding.style.display = "none";
        myChart.style.display = "";
        partPicker.style.display = "none";
        progressGroupTop.style.display = "none";
        partPickerBottom.style.display = "none";
        pbarParent.style.display = "none";
        branding.style.display = "none";
        hideSections();
        makeChartsVisible();
        return;
    }
    hideSections();
    focusOnCurrentPart();
    if (!pieletData.email) {
        progressGroupTop.style.display = "none";
    } else {
        myChart.style.display = "";
        movebranding();

    }
    if (!location.href.match(/edit/ig)) {
        check();

    }
    if (location.href.match(/\?sim/)) {
        sim();
    }
    if (location.href.match(/\?analyze/)) {
        analyzeitFunc();
    }
    if (pieletData.adminBar && adminBar) {
        adminBar.style.display = "block";
    }

  
    if (pieletData.Part5Completed && typeof mainForm !== 'undefined') {
        // Part1.style.display = "none";
        // Part2.style.display = "none";
        // Part3.style.display = "none";
        // Part4.style.display = "none";
        // Part5.style.display = "none";
        mainForm.style.display = "none";
    }
    if (pieletData.formComplete) {
        analyzeitFunc();
    }

});

//pieCloud.outerHTML += ``;



