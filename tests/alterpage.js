function getScores() {
    var inputs = `SA,EC,LB,SN,PN,date1,date2,date3`.split(",");
    var fobj = {};
    //var jobj = {};
    for (let a of inputs) {
        var cl = `input${a}`;
        fobj[a] = gid(cl).value.trim();
        localStorage[cl] = fobj[a];
        pieletData[a] = fobj[a];
    }
}


function gid(id) {
    return document.getElementById(id);
}
var d1 = "Date: 2019-02-14";
var d2 = "Date: 2020-02-14";
var d3 = "Date: 2021-02-14";
var ss = [];
var year1 = {};
var year2 = {};
var year3 = {};


function scoree(q) {
    var color = "black";//"#377dd4";
    var color2 = "white";
    var year = parseInt(q[1]);
    var rest = q.replace(/^../, "");
    var score = parseInt(rest.split("s")[1]);
    var question = rest.split("s")[0].replace(/q/, "");
    var nscore = `Q${question}response`;
    if (year == 1) {
        year1[nscore] = score;
    }
    if (year == 2) {
        year2[nscore] = score;
    }
    if (year == 3) {
        year3[nscore] = score;
    }
    for (var i = 1; i < 11; i++) {
        if (i < score + 1) {
            gid(`y${year}q${question}s${i}`).style.background = color;
        } else {
            gid(`y${year}q${question}s${i}`).style.background = color2;
        }
    }
    window.ss = [year1, year2, year3];
}



function runscores() {
    var snapshots = [];
    var obj = ss[2];
    for (let a in obj) {
        pieletData[a] = obj[a];
        console.log(pieletData[a]);
    }
    snapshots[0] = ss[0];
    snapshots[1] = ss[1];
    snapshots[0].timestamp = d1;
    snapshots[1].timestamp = d2;
    pieletData.timestamp = d3;
    pieletData.time = d3;
    pieletData.snapshots = snapshots;
    buildPastCharts();
}
function adjustGraph() {
    var unit = '';
    for (var j = 0; j < 30; j++) {
        var czs;
        if (j==0){
            unit += `<div style="background: blue">`;
        }
        if (j==6){
            unit += `</div><div style="background: green">`;
        }
        if (j==12){
            unit += `</div><div style="background: yellow">`;
        }
        if (j==18){
            unit += `</div><div style="background: orange">`;
        }
        if (j==24){
            unit += `</div><div style="background: red">`;
        }
        for (var m = 1; m < 11; m++) {
            unit += `<div id="y1q${j}s${m}" style="float:left;width:20px;height:10px;background:gray;color:white;margin:2px;font-size:10px" onmouseover="scoree('y1q${j}s${m}')">${m}</div>`;
            if (m == 10) {
                unit += `<div style="clear:both;"></div>`;
            }
        }
        if (j==29){
            unit += `</div>`;
        }
    }
    var unit2 = unit.replace(/y1q/ig, `y2q`);
    var unit3 = unit.replace(/y1q/ig, `y3q`);
    var ts = `<table><tr><td style="width:170px;color:white;">Year 1<br>${unit}</td><td  style="width:170px;color:white;">Year 2<br>${unit2}</td><td  style="width:170px;color:white;">Year 3<br>${unit3}</td></tr></table><br><button onclick="runscores()">runscores</button>
    <button onclick="gid('cboxdiv').style.display = 'none';">close window</button>`;


    var inputs = `SA,EC,LB,SN,PN,date1,date2,date3`.split(",");
    var out = '';
    for (let a of inputs) {
        var cl = `input${a}`;
        out += `${a}: <input id="${cl}" value="${localStorage[cl]}" style="width:90px;font-size:15px;margin:4px;"><br>`;
    }
    var cbox = `<div id="cboxdiv" style="position:absolute;top:30px;width:1200px;height:700px;background: #999;padding: 12px;">${ts}<br><br><button onclick="getScores();">run</button></div>`;
    document.body.innerHTML += cbox;

    var mainHeadline = 'All Employees: Singapore';
    var mainHeadline = 'All Employees: New Hampshire';
    var mainHeadline = 'All Employees: Hong Kong';
    var mainHeadline = 'All Female Employees  Employees Over 30 with Masters Degree in U.S';

    document.getElementsByTagName("h2")[0].innerHTML = mainHeadline;
    var i = 1;
    for (let a of document.getElementsByTagName("div")) {
        if (a.innerHTML.match(/^Date:/)) {
            a.classList.add(`displayDate${i}`);
            i++;
        }
    }
    document.getElementsByClassName("displayDate1")[0].innerHTML = d1;
    document.getElementsByClassName("displayDate2")[0].innerHTML = d2;
    document.getElementsByClassName("displayDate3")[0].innerHTML = d3;

    var obj = JSON.parse(localStorage.pieletDataJSON);
    obj.snapshots[0].timestamp = d1;
    obj.snapshots[1].timestamp = d2;
    obj.timestamp = d3;
    obj.time = d3;
    localStorage.prefEndDate = d3;
    pieletData = obj;
    randomScores();
    pieletData.completionDate = d3;
    localStorage.pieletDataJSON = JSON.stringify(pieletData);

}
adjustGraph();
function shuffle(a) {
    var c = a.length, t, r;
    while (0 !== c) {
        r = Math.floor(Math.random() * c);
        c -= 1;
        t = a[c];
        a[c] = a[r];
        a[r] = t;
    } return a;
}
function randomScores() {
    var p1 = "2019-02-14";
    var p2 = "2020-02-14";
    var p3 = "2021-02-14";
    var lowScores = '1,2,3,8'.split(",");
    var medScores = '4,5,6,9'.split(",");
    var hiScores = '3,8,9,10'.split(",");
    var snapshots = [];
    var obj = {};
    obj.snapShotCompletionDate = p1;
    obj.timestamp = p1;
    obj.time = p3;
    for (let j = 0; j < 30; j++) {
        var innerName = `Q${j}response`;
        obj[innerName] = parseInt(shuffle(lowScores)[0]);

    }
    snapshots.push(obj);
    var obj = {};
    obj.snapShotCompletionDate = p2;
    obj.timestamp = p2;
    obj.time = p2;
    for (let j = 0; j < 30; j++) {
        innerName = `Q${j}response`;
        obj[innerName] = parseInt(shuffle(medScores)[0]);
    }
    snapshots.push(obj);
    var obj = {};
    obj.snapShotCompletionDate = p3;
    obj.timestamp = p3;
    obj.time = p3;
    for (let j = 0; j < 30; j++) {
        innerName = `Q${j}response`;
        obj[innerName] = parseInt(shuffle(hiScores)[0]);
    }


    for (let j = 0; j < 30; j++) {
        innerName = `Q${j}response`;
        pieletData[innerName] = parseInt(shuffle(hiScores)[0]);
    }
    pieletData.snapshots = snapshots;
}
