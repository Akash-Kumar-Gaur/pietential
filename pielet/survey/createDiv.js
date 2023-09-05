

if (location.href.match(/wipe|logout/)) {
    localStorage.pieletDataJSON = ``;
    document.cookie = "";
    location.assign(`?logout=1`);
}

var prcoded = 'removed';



var sectionNames = [`Self-Actualization`, `Esteem`, `Love and Belonging`, `Safety needs`, `Physiological needs`];
function nuke() {
    var e = document.getElementsByTagName("div");
    for (var i = 0; i < e.length; i++) {
        e[i].style.display = "block";
    }
    var e = document.getElementsByTagName("section");
    for (var i = 0; i < e.length; i++) {
        e[i].style.display = "block";
    }
}
function saveLocal() {
    localStorage.pieletDataJSON = JSON.stringify(pieletData);
}


var s = document.getElementById("pieScript");
s.outerHTML += `
    <script src="chartjs-plugin-watermark.js"></script>
    <div class="pie" id="pieCloud" style="margin-bottom:90px;">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">
    <link href="https://pietential.com/pielet/styles.css" rel="stylesheet" type="text/css"></link>
    </div>`;
var el = document.getElementById("pieCloud");
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

















function buildParts() {
    var out = "";
    var token = 0;
    var endDiv = "";
    var y = 0;
    var i = 0;

    i = 0;

    for (i = 0; i < formQuestions.length; i++) {
        var thePartNoSpace = formQuestions[i].Part.replace(/\s+/ig, "");
        var thePartNoLetters = thePartNoSpace.replace(/[a-z]+/ig, "");
        thePartNoLetters = parseInt(thePartNoLetters - 1);
        var theSectionTitle = sectionNames[thePartNoLetters];
        if (thePartNoSpace !== token) {
            out += `${endDiv}<div id="${thePartNoSpace}" style="background:${colorParts[y]}; padding:12px;border-radius:8px;color:white;box-sizing:border-box;">
    <h2>${theSectionTitle}</h2>On a scale of 1-10, with 1 being I completely disagree with this statement and 10 being I completely agree with this statement, how would you rate each of the following statements?<br><br>`;
            var token = thePartNoSpace;
            endDiv = "</div>";
            //pietentialData[ `${thePartNoSpace}Completed` ] = 0;
            y++;
        }
        out += `<div style="color:white;" id="Q${i}" ><strong>${formQuestions[i].Subject}</strong>: ${formQuestions[i].Question} <!--Current Rating: <span id="rangeEchoQ${i}">0</span>--><br><span id="Q${i}Cat1"></span>
    <div class="rangeHolder">
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

function buildParts2() {
    var formQuestions = JSON.parse(localStorage.formQuestions);
    shuffle(formQuestions);
    var obj = {};
    obj.p1 = "";
    obj.p2 = "";
    obj.p3 = "";
    obj.p4 = "";
    obj.p5 = "";

    localStorage.incred23 = 0;
    for (let a of formQuestions) {

        if (a.Part == "Part 1") {
            obj.p1 += buildsectionChunk(a);
            obj.name = a.Part;
        }
        if (a.Part == "Part 2") {
            obj.p2 += buildsectionChunk(a);
            obj.name = a.Part;
        }
        if (a.Part == "Part 3") {
            obj.p3 += buildsectionChunk(a);
            obj.name = a.Part;
        }
        if (a.Part == "Part 4") {
            obj.p4 += buildsectionChunk(a);
            obj.name = a.Part;
        }
        if (a.Part == "Part 5") {
            obj.p5 += buildsectionChunk(a);
            obj.name = a.Part;
        }
    }



    var snout = "";
    snout += `



<div id="Part1" style="background:${colorParts[0]}; padding:12px;border-radius:8px;color:white;box-sizing:border-box;">
<h2>Self-Actualization</h2>On a scale of 1-10, with 1 being I completely disagree with this statement and 10 being I completely agree with this statement, how would you rate each of the following statements?<br><br>${obj.p1}</div>

<div id="Part2" style="background:${colorParts[1]}; padding:12px;border-radius:8px;color:white;box-sizing:border-box;">
<h2>Esteem</h2>On a scale of 1-10, with 1 being I completely disagree with this statement and 10 being I completely agree with this statement, how would you rate each of the following statements?<br><br>${obj.p2}</div>
<div id="Part3" style="background:${colorParts[2]}; padding:12px;border-radius:8px;color:white;box-sizing:border-box;">
<h2>Love and Belonging</h2>On a scale of 1-10, with 1 being I completely disagree with this statement and 10 being I completely agree with this statement, how would you rate each of the following statements?<br><br>${obj.p3}</div>
<div id="Part4" style="background:${colorParts[3]}; padding:12px;border-radius:8px;color:white;box-sizing:border-box;">
<h2>Safety Needs</h2>On a scale of 1-10, with 1 being I completely disagree with this statement and 10 being I completely agree with this statement, how would you rate each of the following statements?<br><br>${obj.p4}</div>
<div id="Part5" style="background:${colorParts[4]}; padding:12px;border-radius:8px;color:white;box-sizing:border-box;">
<h2>Physiological Needs</h2>On a scale of 1-10, with 1 being I completely disagree with this statement and 10 being I completely agree with this statement, how would you rate each of the following statements?<br><br>${obj.p5}</div>`;

    partsContainer.innerHTML = snout;
}




function buildsectionChunk(a) {
    var out = "";
    //var i = parseInt(localStorage.incred23);
    //var i = 0;
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
    var tcolor = colorParts[0];
    if (a.Part == "Part 1") {
        tcolor = colorParts[0];
    }
    if (a.Part == "Part 2") {
        tcolor = colorParts[1];
    }
    if (a.Part == "Part 3") {
        tcolor = colorParts[2];
    }
    if (a.Part == "Part 4") {
        tcolor = colorParts[3];
    }
    if (a.Part == "Part 5") {
        tcolor = colorParts[4];
    }
    var thePartNoSpace = a.Part.replace(/\s+/ig, "");
    var thePartNoLetters = thePartNoSpace.replace(/[a-z]+/ig, "");
    thePartNoLetters = parseInt(thePartNoLetters - 1);
    var theSectionTitle = sectionNames[thePartNoLetters];

    var i = a.questionNumber;

    out = `<div style="color:white;" id="Q${i}" ><strong>${a.Subject}</strong>: ${a.Question} <!--Current Rating: <span id="rangeEchoQ${i}">0</span>--><br><span id="Q${i}Cat1"></span>
<div class="rangeHolder">
<!--<input value="0" type="range" min="0" max="10" name="Q${i}response" onchange="addValues();" placeholder="${a.Question} Rate on a 0 - 10 scale"  title="${a.Part}" class="rangeSlider">-->
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
    //localStorage.incred23 = i + 1;
    return out;
}


function buildProgressBar(t, total) {
    //branding.style.display = "none";
    //branding2.style.display = "none";
    var percent = Math.floor((t * 100) / total);
    var bars = document.getElementsByClassName('pbar');
    var st = ``;
    //pieletData.prcoded = prcoded;
    pieletData.percent = percent;
    for (var i = 0; i < bars.length; i++) {
        if (percent > 0) {
            st = ` Actualization`;
        }
        if (percent > 19) {
            st = ` Self esteem`;
        }
        if (percent > 39) {
            st = ` Belonging`;
        }
        if (percent > 59) {
            st = ` Safety`;
        }
        if (percent > 79) {
            st = ` Wellness`;
        }
        bars[i].style.display = `block`;
        bars[i].style.width = `${percent}%`;
        // bars[ i ].style.background = `rgba(2,183,45,1)`;
        bars[i].style.background = `rgb(55, 125, 212)`;
        var n = [pieletData.Part1Completed, pieletData.Part2Completed, pieletData.Part3Completed, pieletData.Part4Completed, pieletData.Part5Completed];
        n[0] = parseInt(n[0]);
        n[1] = parseInt(n[1]);
        n[2] = parseInt(n[2]);
        n[3] = parseInt(n[3]);
        n[4] = parseInt(n[4]);
        if (percent > 0) {
            var grad = `linear-gradient(to right, ${part1color} 0%,${part1color} 100%)`;
        }
        if (percent > 19) {
            var grad = `linear-gradient(to right, 
    ${part1color} 0%,
    ${part1color} 50%,
    ${part2color} 50%,
    ${part2color} 100%
    )`;
        }
        if (percent > 39) {
            var grad = `linear-gradient(to right, 
    ${part1color} 0%,
    ${part1color} 33%,
    ${part2color} 33%,
    ${part2color} 66%,
    ${part3color} 66%,
    ${part3color} 100%
    )`;
        }
        if (percent > 59) {
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
        if (percent > 79) {
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
        bars[i].innerHTML = `<div style="width:300px">${percent}% ${st}</div>`;
    }
    buildsectionProgressBar();
}
function socialShare() {
    location.assign(`../share/`);
}
function populate() {
    if (localStorage.pieletDataJSON) {
        pieletData = JSON.parse(localStorage.pieletDataJSON);

    }





    let htm = `
    <link href="https://pietential.com/pielet/styles.css" rel="stylesheet" type="text/css"></link>
    
    
    
    
    <style>
    .htm {
        /* line 214 */
    }
    .col2 {
    width: 48%;
    float: left;
    text-align: left;
    margin: 12px;
    }
    .hankm{
        text-align: left;
    }
    </style>
    <section style="max-width:1000px; margin:auto">
    <div style="margin:0px;max-width: 900px;text-align: center;margin: auto;">
    <div id="abstract" style="text-align: left; box-sizing:border-box">
    <p style="margin-top:6px;"></p>
    </div>
    </div>
    </section>
    <section id="explainer" style="max-width: 1200px;text-align: center;margin: auto;">
    </section>
    </div>
    <div id="emailCapture" class="max500" style="display:none;padding-top:20px;max-width:800px; margin:auto; text-align:center;">
    <input name="email" id="email" required="" type="email" placeholder="Enter your email to begin the evaluation" style="width:80%; max-width:500px;text-align:center;">
    <br>
    <div class="bt login-bar" onclick="getmail()" >Start evaluation ➜</div><br><br>
    Have an account? <a href="https://pietential.com/pielet/login/">Member login</a>
    </div>
    <form class="max500" id="mainformParent" style="margin:auto;" enctype="multipart/form-data" action="" onclick="addValues();" method="post">
    <section id="topChartGen" style="display:none; margin:auto">
    <!-- Form has been completed.<br><br>-->
    <div class="bt" onclick="showResults()">Visualize It</div><br><br><br>
    <!--<div class="bt" onclick="sendChartAsPNG()">Return to editing</div>-->
    </section>
    <div id="mainForm" style="">
    <div id="scoreboard"></div>
    <div id="branding2" style="margin: auto; text-align: center;"></div>
    <section id="partPicker" style="margin: 0px 0px 15px; text-align: center; display: none;">
    <!--
    <div class="bt color1 partpickerButton" onclick="nextsection('Part1');">Self-Actualization</div>
    <div class="bt color2 partpickerButton" onclick="nextsection('Part2');">Esteem</div>
    <div class="bt color3 partpickerButton" onclick="nextsection('Part3');">Love and Belonging</div>
    <div class="bt color4 partpickerButton" onclick="nextsection('Part4');">Safety needs</div>
    <div class="bt color5 partpickerButton" onclick="nextsection('Part5');">Physiological needs</div>
    -->
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
    <!-- <h1>Pietential</h1>
    <h2 style="display: inline-block; margin-top: -3%;">Growth Potential Visualization Survey</h2> -->
    </section>
    <!--<div class="bt" style="padding:1% 8%;" onclick="">More info </div>-->
    <section id="topChartGen" style="display:none; margin:auto">
    <!-- Form has been completed.<br><br>-->
    <div class="bt" onclick="showResults()">Visualize It</div><br><br><br>
    <!--<div class="bt" onclick="sendChartAsPNG()">Return to editing</div>-->
    </section>
    <div id="mainForm2" style="">
    <section id="partPicker" style="margin: 0px 0px 15px; text-align: center; display: none;">
    <div class="bt color1 partpickerButton" onclick="nextsection('Part1');">Self-Actualization</div>
    <div class="bt color2 partpickerButton" onclick="nextsection('Part2');">Esteem</div>
    <div class="bt color3 partpickerButton" onclick="nextsection('Part3');">Love and Belonging</div>
    <div class="bt color4 partpickerButton" onclick="nextsection('Part4');">Safety needs</div>
    <div class="bt color5 partpickerButton" onclick="nextsection('Part5');">Physiological needs</div>
    </section>
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
    <!-- <i style="font-size: 11px; opacity: .5; text-align: right;margin-top: -3%; position: absolute; left: 30%;">all changes saved...</i>-->
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
    <!-- <i style="font-size: 11px; opacity: .5; text-align: right;margin-top: -3%; position: absolute; left: 30%;">all changes saved...</i>-->
    </div>
    </div>
    </form>
    <div id="congrats" class="powerage" style="display:none; text-align:center;margin-bottom:23%;">
    <h1>Congratulations</h1>
    You have finished the evaluation.<div style="height:240px;"></div>
    <div class="bt xswitch" onclick="congratsFunc()">Visualize It ➜</div>
    <!--
    <div id="choosePassword" style="margin-top: 40px;">
    Create an account so you can track your progress over time.<br><br>
    <div class="bt" onclick="location.assign('../create/?userID=${pieletData.userID}')">Create Account ➜</div>
    </div>
    -->
    </div>
    <div id="cc" style="display:none;">
    <!-- <h2 style="text-align:center;">Your Pietential Growth Potential Visualizations</h2> -->
    <canvas id="myChart" style="width:90%; top:0px;" class="chart"></canvas>
    <div id="socialButtonContainer" style="text-align:center;">
    <a class="bt" id="social2button" href="/pielet/shareMyChart" target="_blank" 
    >Share Your Pie Chart <img style="padding: 0px 0px 0px 10px;position: relative;top: 4px;filter: invert(1);" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAABmJLR0QA/wD/AP+gvaeTAAAA/klEQVRIie2VTQrCMBCFP21XegXd+XMr76dWXbvwGgqewYotulPqoilWSdIWZwqCD2Y1Id8QMu/BXz+sIRABqakNMG0DGgPZR51NT02RBVrUQhOcesBJ+WBXEBpU3JdJgwNgBhyAvufcVoD1Bjzyes4j9s91AgbfAkMHcGZ6Y/JPlpia14WW9zABVuayKuBXcu1hrAUs5NtDFWAh3x5eJYFN1qkjBbWBd56zPWCP0lNPyQ297ucKJOFDckNPgAuwBEa4DUN8AJeqBpgAazO4Sh43sUyVPLY5Wqt5HAI3D1gtj+/Aw9MXz+OyfD4glsc2uXxAJI+rVPaBRnn8l4qeweqVPDCgtmYAAAAASUVORK5CYII="/></a>
    </div>
    <canvas id="barchart" style="width:90%; top:100px;" class="chart"></canvas>
    <section id="social" style="margin-top:100px;font-size: 15px; display:none;">
    <div id="shareButtons" style="margin:auto;text-align:center;margin-top:30px;">
    <!--
    <a href="https://pietential.com/"><img src="https://pietential.com/pietential.png" style="width:200px;"></a><br><br>
    -->
    <div id="shareIntro" style="max-width: 1200px;
    margin: auto;
    box-sizing: border-box;
    padding: 0px 0px 20px 0px;text-align:left;">
    It’s an authentic picture of how life is for you right now, and sharing yourself authentically gives your friends an opportunity to offer you advice, recommendations, moral support - and the chance to reach out and learn from you in areas of life where you’re crushing it!
    <br><br>
    If shared, only your “Pietential Growth Potential Visualizations” will appear. Pietential does not share your Pietential Analysis.</div>
    <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fpietential.com/pielet/share/{{userID}}&src=sdkpreparse" style="font-size: 11px; padding: 5px 8px; text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank"><img src="https://pietential.com/pielet/icons/social-1_logo-facebook.svg" class="smicon" style="width:100px;"><br> Share your chart on Facebook</a>
    <a href="https://twitter.com/intent/tweet?text=I just got my Pietential visualization: https://pietential.com/pielet/share/{{userID}}" style="font-size: 11px; padding: 5px 8px; text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank"><img src="https://pietential.com/pielet/icons/social-1_logo-twitter.svg" class="smicon" style="width:100px;"><br>Share your chart on Twitter</a>
    <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://pietential.com/pielet/share/{{userID}}&title=I just got my Pietential visualization" style="font-size: 11px; padding: 5px 8px; text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank"><img src="https://pietential.com/pielet/icons/social-1_logo-linkedin.svg" class="smicon" style="width:100px;"><br> Share your chart on Linkedin</a>
    <a href="https://www.pinterest.com/pin/create/link/?url=https%3A%2F%2Fpietential.com" style="font-size: 11px; ; padding: 5px 8px; text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank"><img src="https://pietential.com/pielet/icons/social-1_logo-pinterest.svg" class="smicon" style="width:100px;"><br> Share your chart on Pinterest</a>
    <div style="margin-top:30px;">
    <br>This is the URL you will be sharing:<br><a href="https://pietential.com/pielet/share/{{userID}}" target="_blank" >https://pietential.com/pielet/share/{{userID}}</a>
    </div>
    <!--<a href="https://pietential.com/pielet/share/{{userID}}" style="font-size: 11px; color: white; padding: 5px 8px; border: 0; background-color: rgb(248, 126, 2); text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank">Preview Shared Link</a>-->
    </div>
    <div style="padding: 12px; font-family: sans-serif;margin:auto;text-align:center;"><br>
    OR...
    <br><br>Copy and paste the following snippet:<br>
    <div class="copybox" id="copybox"><strong id="container">I just got my Pietential visualization:<br>https://pietenti<br>al.com/pielet/share/{{userID}}<br>Get yours at https://pietential.com/</strong></div>
    <!--
    <a href="javascript://" style="font-size: 11px; color: white; padding: 5px 8px; border: 0px solid rgb(201, 62, 41); background-color: rgb(46, 133, 165); text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" id="theButton" onclick="CopyToClipboard('copybox')">COPY TO CLIPBOARD</a>
    -->
    <!-- <a href="https://pietential.com/?socialshare=' . $share . '" style="font-size: 11px; color: white; padding: 5px 8px; border: 0px solid rgb(201, 62, 41); background-color: rgb(46, 133, 165); text-transform: uppercase; border-radius: 4px; font-weight: bold; text-decoration-line: none; margin-top:30px;display:inline-block;" target="_blank">Preview Shared Link</a>-->
    </div>
    </section>
    <div id="analyzeit" style="text-align:center;position:relative; top:100px;">
    <div class="bt" onclick="analyzeitFunc()">Analyze It ➜</div><br><br>
    <br><br><br>
    </div>
    </div>
    <div id="analyze" style="display:none;">
    <div id="shellContent" style="max-width: 1200px; margin: auto; box-sizing: border-box; padding: 20px;">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"><a href="#"
    style="display: block; text-align:center;"><img onmouseover="" src="https://pietential.com/pietential.png"
    style="width:200px;"></a>
    <div id="adminBar"></div>
    <br><br><br>
    <div id="scoreSummary" style="display:none;"><b>Your Scores:</b><br><br>
    <div style="color:#94083b;margin-top:5px;"><b>Physiological Needs</b>: 57% (needs improvement)</div>
    <div style="color:#94083b;margin-top:5px;"><b>Self-Esteem and Contribution</ your chartb>: 53% (needs improvement)
    </div>
    <div style="color:#94083b;margin-top:5px;"><b>Safety Needs</b>: 54% (needs improvement)</div>
    <div style="color:#94083b;margin-top:5px;"><b>Love and Belonging</b>: 56% (needs improvement)</div>
    </div><br>
    <div id="responderIntro"><b>
    <div style="padding-bottom:65px; text-align:center;">
    <!--<div class="bt" id="" >Pietential private analysis</div>-->
    <div style="font-weight:bold;font-size: 34px;padding: 10px 20px;margin:auto;" >Your Pietential Analysis</div>
    </div>
    According to the answers you recently supplied to Pietential, the following areas of life have been
    identified as
    having considerable growth potential for you.</b><br>
     <br>
    </div>

    <div id="responderActualization" class="analyzeborder" style="display: none;">
    <strong>Self Actualization</strong><br>
    
    </div>

    <div id="responderActualization60" class="analyzeborder">
    <strong>Self Actualization</strong><br>
    
    </div>

    <div id="responderEsteem" class="analyzeborder">
    <strong>Self-Esteem and Contribution</strong><br>
    
    </div>

    <div id="responderEsteem60" class="analyzeborder" style="display: none;">
    <strong>Self-Esteem and Contribution</strong><br>
    
    </div>

    <div id="responderLove" class="analyzeborder">
    <strong>Love and Belonging:</strong><br>
    
    </div>

    <div id="responderLove60" class="analyzeborder" style="display: none;">
    <strong>Love and Belonging</strong><br>
    
    </div>
 

  
    <div id="responderSafety" class="analyzeborder">
    <strong>Safety Needs</strong><br>
    
    </div>


    <div id="responderSafety60" class="analyzeborder"style="display: none;">
    <strong>Safety Needs</strong><br>
    
    </div>

    <div id="responderPhysiological" class="analyzeborder">
    <strong>Physiological Needs</strong><br>
    
    </div>


    <div id="responderPhysiological60" class="analyzeborder" style="display: none;">
    <strong>Physiological Needs</strong><br>
    
    </div>

    <!--
    <hr>
    This set of recommendations was generated for you algorithmically by Pietential, based on your responses to
    the Pietential survey. We want you to realize your full potential, and we encourage you to join the
    Pietential Growth Group on FaceBook. It’s a small, but growing group of people committed to realizing their
    potential, and helping others reach theirs. It is a private group, and you are invited to participate.
    -->
     <br>
     <br>
    <div id="minichart">
    <div>
    <canvas id="myChartA" style="width: 760px; display: block; height: 380px;"
    class="chart chartjs-render-monitor" width="760" height="380"></canvas>
    <canvas id="barchartA" style="width: 760px; display: block; height: 380px;" chart"="" width="760"
    height="380" class="chartjs-render-monitor"></canvas></div>
    </div>
    <div style="text-align:center;" onmouseover="genPNG('barchart');">
    <!-- <button class="bt" onclick="" style="margin: 0px; display: inline-block; width: 120px; text-align: center;">Return to Home</button> -->
    <!--<button class="bt" onclick="socialShare();">Share your Pietential</button>-->
    <div id="printMan" style="display:none;
    margin: auto;position: absolute;
    left:.5%;
    text-align: center;
    ">
    <div style="
    position:relative;
    background: #eeeeee;
    width: 400px;
    padding: 30px;
    border-radius: 7px;
    overflow: visible;
    box-sizing: border-box;
    box-shadow: rgb(0, 0, 0) 10px 10px 52px 0px;
    margin: auto;
    ">A new window will open. When prompted, choose "Save as PDF" in the print dialog box.<br><br>
    <button class="bt" id="pdfd" onclick="openpdf()">Open window to save/print</button>
    <br><br>
    <button class="bt navy" onclick="hide('printMan')" >Cancel</button></div></div>
    <!--<button onmouseover="genPNG('myChart');" class="bt" id="pdfd" onclick="show('printMan')">Download or Print Private Analysis</button>
    -->
    <button class="bt" id="realizebutton" onclick="location.assign('../dashboard')" >Realize it ➜</button>
    <br><br>
    </div>
    <br><br>
    <!--*Only your Visualization will be shared - not your Analysis
    <br>-->
    </div>
    </div>
    `;
    el.innerHTML += htm;
}
function showSocial() {
    hide("responderIntro");
    hide("responderPhysiological");
    hide("responderPhysiological60");
    hide("responderSafety");
    hide("responderSafety60");
    hide("responderLove");
    hide("responderLove60");
    hide("responderEsteem");
    hide("responderEsteem60");
    hide("responderActualization");
    hide("responderActualization60");
    hide("shellContent");
    hide("analyzeit");
    show("social");
    show("cc");
    //memberPrint.addEventListener('click', function (){location.assign("/")});
    memberPrint.href = `javascript:location.assign("/")`;
    memberPrint.innerHTML = 'Return home';
    document.getElementById('pieCloud').scrollIntoView({
        behavior: 'smooth'
    });
    scrollTo(0, 0);
    shareIntro.innerHTML += myChart.outerHTML;
    var f = pieletData.LBscorevalues;
    var SA = f.SA;
    var EC = f.EC;
    var LB = f.LB;
    var SN = f.SN;
    var PN = f.PN;
    window.scrollTo(0, document.body.scrollHeight);
    myChart.style.height = 0;
    // drawChart(SA, EC, LB, SN, PN);
}
populate();
function formHasBeenCompleted() {
    branding2.style.display = "none";

}
function CopyToClipboard(containerid) {
    var copyText = document.getElementById(containerid);
    copyText.select();
    copyText.setSelectionRange(0, 99999); /*For mobile devices*/
    document.execCommand("copy");
    document.getElementById("theButton").innerHTML = "copied";
}
pieletData = JSON.parse(localStorage.pieletDataJSON);
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
function introducePietential() {
    //show("headline");
    //show("partPicker");
    //show("progressGroupTop");
    ////hide("Part1");
    ///hide("emailCapture");
    show("mainForm");
    show("branding");
    branding.innerHTML += `<br><br><br><div class="bt beginbar" onclick="beginSurvey()">Begin ➜</div>`;
    ///addValues();
    //pieletData.beginSurvey = 1;
    if (pieletData.Part5Completed == 100) {
        // show congrats
        hideSections();
        hide("mainForm");
        //hide("branding");
        mainForm.style.display = "none";
        var year = new Date().getFullYear().toString();
        var Month = new Date().getMonth();
        Month++; Month = Month.toString();
        var Day = new Date().getDate();
        Day = Day.toString();
        pieletData.completionDate = `${year}-${Month}-${Day}`;
        show("congrats");
        return;
    }
    hide("Part1");
    if (pieletData.Q0response) {
        addValues();
        //  hide("branding");
    }
}
function beginSurvey() {
    show("headline");
    show("partPicker");
    show("progressGroupTop");
    show("Part1");
    hide("emailCapture");
    //hide("libar");
    show("mainForm");
    focusOnCurrentPart();
    addValues();
    pieletData.beginSurvey = 1;
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
        hide("emailCapture");
        show("mainForm");
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
    saveLocal();
    if (className.match(/Q5r|Q10r|Q15r|Q19r|Q29r/)) {
        saveState();
    }
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
            pieletData[className] = n;
            addValues();
        }
    }
    //alert(Q0response);
    progressBar();
}
function recoverPart1IfNotComplete() {
    if (Part1.style.display == "none" &&
        Part2.style.display == "none" &&
        Part3.style.display == "none" &&
        Part4.style.display == "none" &&
        Part5.style.display == "none" &&
        pieletData.Q0response > 0 &&
        !pieletData.formComplete) {
        Part1.style.display = "";
    }
}
function makeAllButtonsBlack(className) {
    var r = document.getElementsByClassName(className);
    for (var i = 0; i < r.length; i++) {
        r[i].style.background = "rgba(0, 0, 0, .2)";
        //r[i].style.opacity = ".2";
    }
}

function setCompletionDate() {
    var year = new Date().getFullYear().toString();
    var Month = new Date().getMonth();
    Month++; Month = Month.toString();
    var Day = new Date().getDate();
    Day = Day.toString();
    pieletData.completionDate = `${year}-${Month}-${Day}`;
}
function addValues() {
    //
    //alert(JSON.stringify(pieletData));
    all29answered();
    setCompletionDate();
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

    if (pieletData.Q0response > 0 &&
        pieletData.Q1response > 0 &&
        pieletData.Q2response > 0 &&
        pieletData.Q3response > 0 &&
        pieletData.Q4response > 0 &&
        pieletData.Q5response > 0) {
        pieletData.Part1Completed = 100;
    }
    if (pieletData.Q6response > 0 &&
        pieletData.Q7response > 0 &&
        pieletData.Q8response > 0 &&
        pieletData.Q9response > 0 &&
        pieletData.Q10response > 0 &&
        pieletData.Q11response > 0) {
        pieletData.Part2Completed = 100;
    }
    if (pieletData.Q12response > 0 &&
        pieletData.Q13response > 0 &&
        pieletData.Q14response > 0 &&
        pieletData.Q15response > 0 &&
        pieletData.Q16response > 0 &&
        pieletData.Q17response > 0) {
        pieletData.Part3Completed = 100;
    }
    if (pieletData.Q18response > 0 &&
        pieletData.Q19response > 0 &&
        pieletData.Q20response > 0 &&
        pieletData.Q21response > 0 &&
        pieletData.Q22response > 0 &&
        pieletData.Q23response > 0) {
        pieletData.Part4Completed = 100;
    }
    if (pieletData.Q24response > 0 &&
        pieletData.Q25response > 0 &&
        pieletData.Q26response > 0 &&
        pieletData.Q27response > 0 &&
        pieletData.Q28response > 0 &&
        pieletData.Q29response > 0) {
        pieletData.Part5Completed = 100;
    }

    if (pieletData.Part5Completed == 100) {
        // show congrats
        if (all29answered().match(/pass/)) {
            console.log("all29answered = " + all29answered());
            hideSections();
            hide("mainForm");
            //  hide("branding");
            mainForm.style.display = "none";
            show("congrats");
            return;
        }
    }
    if (pieletData.Part4Completed == 100) {
        pieletData.currentPart = 'Part5';
        focusOnCurrentPart();
        if (!pieletData.scroll5) {
            document.getElementById('pieCloud').scrollIntoView({
                behavior: 'smooth'
            });
            pieletData.scroll5 = 1;
        }
        return;
    }
    if (pieletData.Part3Completed == 100) {
        pieletData.currentPart = 'Part4';
        focusOnCurrentPart();
        if (!pieletData.scroll4) {
            document.getElementById('pieCloud').scrollIntoView({
                behavior: 'smooth'
            });
            pieletData.scroll4 = 1;
        }
        return;
    }
    if (pieletData.Part2Completed == 100) {
        pieletData.currentPart = 'Part3';
        focusOnCurrentPart();
        if (!pieletData.scroll3) {
            document.getElementById('pieCloud').scrollIntoView({
                behavior: 'smooth'
            });
            pieletData.scroll3 = 1;
        }
        return;
    }
    if (pieletData.Part1Completed == 100) {
        pieletData.currentPart = 'Part2';
        focusOnCurrentPart();
        if (!pieletData.scroll2) {
            document.getElementById('pieCloud').scrollIntoView({
                behavior: 'smooth'
            });
            pieletData.scroll2 = 1;
        }
        return;
    }
    progressBar();
}
function congratsFunc() {
    //saveState();
    //question29ensure();
    document.cookie = "percent=96; expires=31 Dec 2030 12:00:00 UTC; path=/";
    document.body.innerHTML = ``;
    sendScores();
}

function sendScores() {
    var queryString = '';
    var obj = {};
    obj.userID = pieletData.userID;
    obj.mode = "calc";
    for (let a in pieletData) {
        if (a.match(/^Q[0-9]/)) {
            var valueT = pieletData[a];
            queryString += `&${a}=${valueT}`;
            obj[a] = valueT;
        }
    }
    console.log(JSON.stringify(obj));
    queryString = `../calcEngine/?userID=${pieletData.userID}&mode=calc${queryString}`;

    fetch(queryString)
        .then(r => {
            return r.text()
        })
        .then(a => {
            var pieletR = JSON.parse(a);

            var LBscorevalues = {};
            LBscorevalues.SA = pieletR.SA;
            LBscorevalues.EC = pieletR.EC;
            LBscorevalues.LB = pieletR.LB;
            LBscorevalues.SN = pieletR.SN;
            LBscorevalues.PN = pieletR.PN;

            pieletData.SA = pieletR.SA;
            pieletData.EC = pieletR.EC;
            pieletData.LB = pieletR.LB;
            pieletData.SN = pieletR.SN;
            pieletData.PN = pieletR.PN;
            pieletData.LBscorevalues = LBscorevalues;
            saveState();
            location.assign(`../visualizeit/`);
        });
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
    //window.scrollTo(0, 0);
}
function nextsection(id) {
    hideSections();
    var desiredNext = id.replace(/part/ig, "");
    if (desiredNext !== "1") {
        var previousPart = `Part` + (desiredNext - 1);
        if (pieletData[`${previousPart}Completed`] !== 100) {
            //alert(`Please fully complete all the sections in order. Score each question from 1 to 10. (You must score at least 1 for each question.)`);
            //focusOnCurrentPart();
            //return;
        }
    }
    document.getElementById(id).style.display = "block";
    pieletData.currentPart = id;
    pieletData.currentColor = document.getElementById(id).style.background;
    progressBar();
}
var onCurrent = 0;
function question29ensure() {
    PN = Q24response;
    PN = PN + Q25response;
    PN = PN + Q26response;
    PN = PN + Q27response;
    PN = PN + Q28response;
    PN = PN + Q29response;
    PN = PN * 1.66;
    PN = roundNumber(PN);
    pieletData.PN = PN;
    localStorage.pieletDataJSON = JSON.stringify(pieletData);
    saveState();
}
function all29answered() {
    var out = "";
    for (var i = 0; i < 30; i++) {
        var prop = `Q${i}response`;
        if (pieletData[prop] > 0) {
            out += pieletData[prop] + " ";
        } else {
            out += prop + " : fail ";
        }
    }
    console.log(out);
    if (out.match(/fail/)) {
        return (out);
        
    }
    else {
        return ("pass");
    }
}

function focusOnCurrentPart() {
    if (pieletData.Part4Completed == 100) {
        pieletData.currentPart = "Part5";
        hideSections();
        if (pieletData.Q29response > 0) {
            // question29ensure();
            // return;
        }
        show("Part5");
        onCurrent = 5;
        document.getElementById("mainForm").style.display = "";
        return;
    }
    if (pieletData.Part3Completed == 100) {
        pieletData.currentPart = "Part4";
        hideSections();
        show("Part4");
        onCurrent = 4;
        document.getElementById("mainForm").style.display = "";
        return;
    }
    if (pieletData.Part2Completed == 100) {
        pieletData.currentPart = "Part3";
        hideSections();
        show("Part3");
        onCurrent = 3;
        document.getElementById("mainForm").style.display = "";
        return;
    }
    if (pieletData.Part1Completed == 100) {
        pieletData.currentPart = "Part2";
        hideSections();
        show("Part2");
        onCurrent = 1;
        document.getElementById("mainForm").style.display = "";
        return;
    }
    hideSections();
    show("Part1");
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
function drawChartMini(b, l, a, c, k) {
    // b = roundNumber(b);
    // l = roundNumber(l);
    // a = roundNumber(a);
    // c = roundNumber(c);
    // k = roundNumber(k);
    var ctx = document.getElementById('myChart').getContext('2d');
    var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
    var alphaValue = 1;
    Chart.defaults.global.defaultFontSize = 18;
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
            legend: {
                labels: {
                    // This more specific font property overrides the global property
                    defaultFontSize: 18
                }
            },
            watermark: {
                image: "https://pietential.com/watermark.png",
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
    var ctx2 = document.getElementById('barchart').getContext('2d');
    var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
    var alphaValue = 1;
    Chart.defaults.global.defaultFontSize = 18;
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
    updateTextInput();
    if (pieletData.chartHide == 1 && !location.href.match(/anal/)) {
        console.log(`drawChart halted`);
        return;
    }
    if (hety > 0) {
        //return;
    }
    hety++;
    var toggle = shuffle(['polarArea', "line", "pie", "bar", 'radar', 'doughnut',])[0];
    //var toggle = 'doughnut';
    //cc.innerHTML = "";
    document.getElementById("scoreboard").outerHTML += `<div style="text-align:center;">
    
    <h1>Your Growth Potential Visualized</h1>
    <!--
    <button class="bt" style="margin: 0px; display: inline-block; width: 120px; text-align: center;" onclick="analyzeit()">Analyze It</button>
    <button class="bt" onclick="sendChartAsPNG('myChart')" style="margin: 0px; display: inline-block; width: 120px; text-align: center;">Return to Home</button> 
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
    mainformParent.style.display = "none";
    //bigChart.innerHTML = `<canvas id="bc" width="1500" height="1500" class="chart"></canvas>`;
    var ctx = document.getElementById('myChart').getContext('2d');
    if (pieletData.email) {
        //  branding.style.display = "none";
        scoreboard.style.display = "none";
        //mainForm.style.marginTop = "-75px";
    }
    var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
    if (!pieletData.email) {
        ls = shuffle(ls);
    }
    Chart.defaults.global.defaultFontSize = 18;
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
            watermark: {
                image: "https://pietential.com/watermark.png",
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
function resetForm() {
    document.getElementById("mainForm").style.display = "block";
    emailCapture.style.display = "none";
    if (pieletData.email) {
        //reLoadFormState();
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
function removeDescriptionAndScore(id, scoreName) {
    var el = document.getElementById(id);
    var el60 = document.getElementById(id + '60');
    var em = document.getElementById("scoreSummary");
    var sv = pieletData.LBscorevalues;
    var score = sv[scoreName];
    //score = roundNumber(score);
    if (score > 98) {
        score = 100;
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
        el60.style.display = "";
        //alert("the score is "+score);
    } else {
        el60.style.display = "none";
        el.style.display = "";
        headline.innerHTML += `<br><i style="color:#377dd4;">Suggestions for improvement:</i> `;
        em.innerHTML += `<div style="color:#94083b;margin-top:5px;"><b>${secName}</b>: ${score}% (needs improvement)</div>`;
        pieletData.PDFsummary += em.innerHTML;
        // pieletData.PDFsummary += headline.innerHTML;
    }
}
function analyzeitFunc() {
    localStorage.sbc = document.getElementById("socialButtonContainer").outerHTML;
    location.assign("../analyzeit/");
    return;
    show("social");
    // show("libar");

    hide("cc");
    changeBecomeMemberToPrintSave();
    pieletData.PDFsummary = "";
    pieletData.svTotal = 0;
    pieletData.analyzeit = 1;
    show("analyze");
    //buildPage(responder);
    analyze.style.maxWidth = "1200px";
    analyze.style.margin = "auto";
    analyze.style.boxSizing = "border-box";
    analyze.style.padding = "20px";
    //addFooter();
    //explainer.style.display = "none";
    branding.style.display = "none";
    emailCapture.style.display = "none";
    removeDescriptionAndScore(`responderPhysiological`, `PN`);
    removeDescriptionAndScore(`responderActualization`, `SA`);
    removeDescriptionAndScore(`responderEsteem`, `EC`);
    removeDescriptionAndScore(`responderSafety`, `SN`);
    removeDescriptionAndScore(`responderLove`, `LB`);
    document.getElementById("myChart").outerHTML = ``;
    document.getElementById("barchart").outerHTML = ``;
    document.getElementById("myChartA").outerHTML = `<div><canvas id="myChart" style="width:90%;" class="chart"></canvas>${localStorage.sbc}<br><br><br>
    <canvas id="barchart" style="width:90%; class="chart"></canvas></div>`;
    document.getElementById("barchartA").outerHTML = ``;
    var f = pieletData.LBscorevalues;
    var SA = f.SA;
    var EC = f.EC;
    var LB = f.LB;
    var SN = f.SN;
    var PN = f.PN;
    drawChart(SA, EC, LB, SN, PN);
    drawBar(SA, EC, LB, SN, PN);
    document.getElementById('pieCloud').scrollIntoView({
        behavior: 'smooth'
    });
    window.scrollTo(0, 0);
    //sendSummary();
}
function addFooter() {
    if (!document.body.innerHTML.match(/id="footer"/)) {
        //document.body.style.paddingBottom = "200px"; //min-height: 100vh;
        document.body.style.position = "relative";
        document.body.style.minHeight = "100vh";
        //document.body.innerHTML += `{{universal-footer}}`;
    }
}
function addWatermark() {
    //myChart.style.background = "url(https://pietential.com/watermark.png) 100% 100% / 14% no-repeat";
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
    //console.log(t, total);
    buildProgressBar(t, total);
    buildsectionProgressBar();
    progressGroupTop.style.display = "block";
    document.getElementsByClassName("pbar")[0].style.display = "block";
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
function changeBecomeMemberToPrintSave() {
    memberPrint.innerHTML = "Save or print results";
    memberPrint.href = "javascript:genPNG('myChart');show('printMan');goToPrint();";
}
function goToPrint() {
    window.scrollTo(0, document.body.scrollHeight);
    printMan.style.zIndex = 9;
}
function saveState() {
    pieletData.saveMethod = "saveState via fetch formData";
    pieletData.userURL = location.href;
    localStorage.pieletDataJSON = JSON.stringify(pieletData);
    //var parameters = "pieletData=" + btoa(JSON.stringify(pieletData));
    const fd = new FormData();
    fd.append('pieletData', btoa(JSON.stringify(pieletData)));
    const options = {
        method: 'POST',
        //mode: 'no-cors',
        body: fd
    };

    fetch("../accountEngine/", options)
        .then(r => {
            return r.text()
        })
        .then(a => {
            console.log("ajax success.");
            console.log(a);
        });
}
var hety = 0;

//pieCloud.innerHTML += `<div id="part1"></div><div id="part2"></div><div id="part3"></div><div id="part4"></div><div id="part5"></div>`;
//shuffle(formQuestions);
fetch(`../calcEngine/?mode=generateQuestions`)
    .then(r => {
        return r.text()
    })
    .then(a => {
        localStorage.formQuestions = a;
        buildParts2();
        focusOnCurrentPart();
        if (pieletData.email && !pieletData.currentPart) {
            nextsection("Part1");
            show("mainForm");
        }
        recoverPart1IfNotComplete();
    });


// var formQuestions = JSON.parse(localStorage.formQuestions);
// buildParts();


function randomize() {
    var reg = `Part1,Part2,Part3,Part4,Part5`.split(",");
    for (let a of reg) {
        var p = document.getElementById(a);
        var l = [];
        var r = [];
        for (let b of p.getElementsByTagName("div")) {
            if (b.id.match(/Q[0-9]/)) {
                l.push(b);
                r.push(b);
            }
        }
        l = shuffle(l);
        var i = 0;
        for (let a of r) {
            a.outerHTML = l[i].outerHTML;
            i++;
        }
    }
}

//randomize();


if (typeof Q0responseVal !== "undefined") {
    if (Q0responseVal.value < 1) {
        progressGroupTop.style.display == "none";
        document.getElementsByClassName("pbar")[0].style.display = "none";
    }
}
function show(id) {
    try {
        document.getElementById(id).style.display = "block";
    }
    catch (err) { }
}
function hide(id) {
    try {
        document.getElementById(id).style.display = "none";
    }
    catch (err) { }
}
function restoreSession() {
    pieletData = JSON.parse(localStorage.pieletDataJSON);
    if (pieletData.email) {
        email.value = pieletData.email;
        emailCapture.style.display = "none";
        // branding.style.display = "none";

    }
    for (const property in pieletData) {
        if (property.match(/Q/)) {
            setvalue(pieletData[property], property);
        }
    }
    console.log(pieletData);
}
function genPNG(el) {
    document.getElementById(el).crossOrigin = "Anonymous";
    console.log("opening AJAX connection....");
    var chartPNG = document.getElementById(el).toDataURL("image/png");
    if (el == "myChart") {
        var parameters = `savePNGPIE=${encodeURIComponent(chartPNG)}`;
        parameters += `&userID=${pieletData.userID}`;
    }
    if (el == "barchart") {
        var parameters = `savePNGBAR=${encodeURIComponent(chartPNG)}`;
        parameters += `&userID=${pieletData.userID}`;
    }
    parameters = parameters.trim();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("success.");
        }
    };
    xhttp.open("POST", `https://pietential.com/pielet/`, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(parameters);
}
function saveSurveyResults() {
    var obj = {};
    var keys = Object.keys(pieletData);
    for (var fey of keys) {
        if (fey.match(/response/)) {
            obj[fey] = pieletData[fey];
        }
    }
    obj.timestamp = pieletData.timestamp;
    var snapshot = btoa(JSON.stringify(obj));
    //document.body.innerHTML += `<img src="https://pietential.com/pielet/save-snapshot.php?email=${pieletData.email}&userID=${pieletData.userID}&snapshot=${snapshot}" style="width:1px;">`;
    localStorage.pieletDataJSON = ``;
    obj2 = pieletData;
    pieletData = {};
    pieletData.userID = obj2.userID;
    pieletData.email = obj2.email;
    pieletData.hash = obj2.hash;
    pieletData.partnerID = obj2.partnerID;
    pieletData.salt = obj2.salt;
    localStorage.pieletDataJSON = JSON.stringify(pieletData);
    location.assign(`?newSurvey=${pieletData.userID}`);
}
function sendChartAsPNG(el) {
    console.log("opening AJAX connection....");
    //pietentialData.chartPNG = document.getElementById(el).toDataURL("image/png");
    if (el == `myChart`) {
        var parameters = `savePNGPIE=${encodeURIComponent(pietentialData.chartPNG)}`;
        parameters += `&userID=${pieletData.userID}`;
    }
    if (el == `barchart`) {
        var parameters = `savePNGBAR=${encodeURIComponent(pietentialData.chartPNG)}`;
        parameters += `&userID=${pieletData.userID}`;
    }
    parameters = parameters.trim();
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log("success.");
            if (pieletData.LifeBalanceDownload == 1) {
                pietentialData.LifeBalanceDownload = 0;
                location.assign('?download=true');
            } else {
                location.assign('?home');
            }
        }
    };
    xhttp.open("POST", `https://pietential.com/pielet/`, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(parameters);
}
document.addEventListener("DOMContentLoaded", function (event) {
    if (localStorage.pieletDataJSON) {
        restoreSession();
    }
    if (pieletData.email) {
        document.getElementById("partPicker").style.display = "block";
    }
    if (location.href.match(/showResults/ig)) {

        myChart.style.display = "";
        partPicker.style.display = "none";
        progressGroupTop.style.display = "none";
        partPickerBottom.style.display = "none";
        pbarParent.style.display = "none";
        //branding.style.display = "none";
        hideSections();
        makeChartsVisible();
        return;
    }
    hideSections();
    if (typeof mainForm !== 'undefined') {
        document.getElementById("mainForm").style.display = "none";
    }
    focusOnCurrentPart();
    if (!pieletData.email) {
        //progressGroupTop.style.display = "none";
    } else {
        myChart.style.display = "";
        movebranding();
    }
    //recoverPart1IfNotComplete();
    if (pieletData.adminBar && adminBar) {
        adminBar.style.display = "block";
    }
    if (pieletData.Part5Completed && typeof mainForm !== 'undefined') {
        // Part1.style.display = "none";
        // Part2.style.display = "none";
        // Part3.style.display = "none";
        // Part4.style.display = "none";
        // Part5.style.display = "none";
        document.getElementById("mainForm").style.display = "none";
    }
    if (pieletData.formComplete) {
        analyzeitFunc();
    }

    if (location.href.match(/return.to/ig)) {
        congratsFunc();
        analyzeitFunc();
        window.scrollTo(0, 0);
    }
    if (pieletData.hash) {
        //choosePassword.innerHTML = `<div class="bt" style="font-size: 15px; padding: 1% 8%;" onclick="saveSurveyResults(${pieletData.timestamp})">Retake and track your progress<!-- (${pieletData.timestamp}) and re-take survey.--></div>`;
    }
    //addFooter();
    function showlibar() {
        var loginStatus = ``;
        //var proxyUser = `<a class="bt yellow login-bar" id="memberPrint" href='https://pietential.com/pielet/coach/?userID=${pieletData.userID}'>Coach login</a> <a class="bt green login-bar" id="memberPrint" href='https://pietential.com/pielet/login.php?userID=${pieletData.userID}'>Member login</a>`;
        if (pieletData.hash) {
            proxyUser = `<a id="memberPrint" class="bt login-bar" href='https://pietential.com/pielet/dashboard/?userID=${pieletData.userID}'>Dashboard</a>`;
            loginStatus = `<span style="text-align:left;position: absolute;left: 5px;font-size:15px;"> ${pieletData.email} <a class="bt red login-bar" href="/?logout">Logout</a></span> `;
        }
        var inspecter = ``;
        if (localStorage.showInspector) {
            inspecter = `<a class="bt login-bar" target="_blank" href='/?inspect'>i</a>`;
        }
        var loginBar = `<div id="libar" class="libar" style="box-sizing: border-box;position:fixed;top:0px;height:45px;padding: 12px 27px; text-align:right;margin-right:20px;display:block;">${loginStatus} ${proxyUser} ${inspecter}</div>`;
        document.body.innerHTML += loginBar;
    }
    if (location.href.match(/\?inspect/)) {
        document.body.innerHTML = `<BR><BR><BR><pre>` + localStorage.pieletDataJSON.replace(/,/ig, " \n,");
    }
    if (location.href.match(/\?newSurvey/)) {

    }
    if (pieletData.Part5Completed && pieletData.hash && localStorage.returnToLatest < 1) {
        location.assign(`../dashboard`);
    }
    if (pieletData.Part5Completed || localStorage.returnToLatest > 0) {
        addValues();
        localStorage.returnToLatest = 0;
    }
    if (localStorage.retake > 0) {
        localStorage.retake = 0;
        pieletData.scroll1 = 0;
        pieletData.scroll2 = 0;
        pieletData.scroll3 = 0;
        pieletData.scroll4 = 0;
        pieletData.scroll5 = 0;
        saveSurveyResults();
    }
    //introducePietential();
    nextsection("Part1");
    //showlibar();
    show("mainForm");
    //localStorage.pieletFooter = footer.outerHTML;
    if (pieletData.hash) {
        //   brandingLogo.style.display="none";
    }

    // pieletData.PNO = ``;
    // pieletData.PNU = ``;
    // pieletData.SNO = ``;
    // pieletData.SNU = ``;
    // pieletData.SAO = ``;
    // pieletData.SAU = ``;
    // pieletData.ECU = ``;
    // pieletData.ECO = ``;
    // pieletData.LBU = ``;
    // pieletData.LBO = ``;
    if (!pieletData.PN) {
        //desktopnav.style.display = "none";
        // navbarmobile.style.display = "none";
    }
    if (window.innerWidth > 1200 && pieletData.PN) {
        desktopnav.style.display = "";
    }
    if (window.innerWidth < 1200 && pieletData.PN) {
        navbarmobile.style.display = "";
    }




});
