// pietential llc // hank mitchell // April 20 2022 // @hankenstein

if (location.href.match(/logout/)) {
    location.assign(`/?logout=1`);
}
var prcoded = 'removed';
var sectionNames = [`Self-Actualization`, `Esteem`, `Love and Belonging`, `Safety needs`, `Physiological needs`];

function saveLocal() {
    localStorage.pieletDataJSON = JSON.stringify(pieletData);
}

var s = document.getElementById("pieScript");
s.outerHTML += `
    <script src="chartjs-plugin-watermark.js"></script>
    <div class="pie" id="pieCloud" style="margin-bottom:90px;">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">
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
var alphaValue = 0.8;
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


    try {

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
    catch (e) {
        location.assign(location.href);
    }
}

function buildsectionChunk(a) {
    var out = "";
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
    var percent = Math.floor((t * 100) / total);
    var bars = document.getElementsByClassName('pbar');
    var st = ``;
    var grad = ``;
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
        bars[i].style.background = `rgb(55, 125, 212)`;
        var n = [pieletData.Part1Completed, pieletData.Part2Completed, pieletData.Part3Completed, pieletData.Part4Completed, pieletData.Part5Completed];
        n[0] = parseInt(n[0]);
        n[1] = parseInt(n[1]);
        n[2] = parseInt(n[2]);
        n[3] = parseInt(n[3]);
        n[4] = parseInt(n[4]);
        if (percent > 0) {
            grad = `linear-gradient(to right, ${part1color} 0%,${part1color} 100%)`;
        }
        if (percent > 19) {
            grad = `linear-gradient(to right, 
    ${part1color} 0%,
    ${part1color} 50%,
    ${part2color} 50%,
    ${part2color} 100%
    )`;
        }
        if (percent > 39) {
            grad = `linear-gradient(to right, 
    ${part1color} 0%,
    ${part1color} 33%,
    ${part2color} 33%,
    ${part2color} 66%,
    ${part3color} 66%,
    ${part3color} 100%
    )`;
        }
        if (percent > 59) {
            grad = `linear-gradient(to right, 
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
            grad = `linear-gradient(to right, 
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

function populate() {
    if (localStorage.pieletDataJSON) {
        pieletData = JSON.parse(localStorage.pieletDataJSON);
    }
    fetch("htm.html")
        .then(r => {
            return r.text()
        })
        .then(a => {
            localStorage.a = a;
            el.innerHTML += a;
        });
}

populate();


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
    pieletData.shareMode = 1;
}



function setvalue(n, className) {
    var idname = `${className}Val`;
    document.getElementById(idname).value = n;
    document.getElementById(idname).setAttribute('value', n);
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
    progressBar();
}
function recoverPart1IfNotComplete() {
    try {
    if (Part1.style.display == "none" &&
        Part2.style.display == "none" &&
        Part3.style.display == "none" &&
        Part4.style.display == "none" &&
        Part5.style.display == "none" &&
        pieletData.Q0response > 0 &&
        !pieletData.formComplete) {
        Part1.style.display = "";
    }
}catch(e){}
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
    all29answered();
    setCompletionDate();
    pieletData.restrequest = "";
    d = document.querySelectorAll("select, input, textarea");

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
            // hide("mainForm");
            // hide("branding");
            mainForm.style.display = "block";
            Part5.style.display = "block";
            show("congrats");
            document.getElementById('congrats').scrollIntoView({
                behavior: 'smooth'
            });
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
            console.log("fetch(queryString)505");
            location.assign(`../visualizeit/`);
        });
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
    try {
        document.getElementById(id).style.display = "block";
        pieletData.currentPart = id;
        pieletData.currentColor = document.getElementById(id).style.background;
    } catch (e) { }
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



var counterNewUser = 0;

function analyzeitFunc() {
    localStorage.sbc = document.getElementById("socialButtonContainer").outerHTML;
    location.assign("../analyzeit/");
    return;

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
    buildProgressBar(t, total);
    buildsectionProgressBar();
    try {
        progressGroupTop.style.display = "block";
        document.getElementsByClassName("pbar")[0].style.display = "block";
    } catch (e) { }
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
    fd.append('pdpost', btoa(JSON.stringify(pieletData)));
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

document.addEventListener("DOMContentLoaded", function (event) {

    if (pieletData.formComplete) {
        analyzeitFunc();
    }
    if (location.href.match(/return.to/ig)) {
        congratsFunc();
        analyzeitFunc();
        window.scrollTo(0, 0);
    }
    if (location.href.match(/\?inspect/)) {
        document.body.innerHTML = `<BR><BR><BR><pre>` + localStorage.pieletDataJSON.replace(/,/ig, " \n,");
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
    nextsection("Part1");
    show("mainForm");
    if (window.innerWidth > 1200 && pieletData.PN) {
        desktopnav.style.display = "";
    }
    if (window.innerWidth < 1200 && pieletData.PN) {
        navbarmobile.style.display = "";
    }
});