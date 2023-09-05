fetch(`/pielet/calcEngine/?mode=generateQuestions&userID=jhb`)
    .then(r => {
        return r.text()
    })
    .then(a => {
        localStorage.formQuestions = a;
        console.log(`Successfully loaded questions from ${location.href}.`);
        displayRandomQuestion();
    });

function displayRandomQuestion() {


    var fq = JSON.parse(localStorage.formQuestions);
    var randomQuestion = shuffle(fq)[0];
    var qn = randomQuestion.questionNumber;
    var qpay = JSON.stringify(randomQuestion);
    var infoDiv = `<div id="question${qn}json" style="display:none">${qpay}</div>`;
    
    console.log(`question ${qn} was selected at random.`);
    var subjectAndCat = `<b>${randomQuestion["Part description"]}, ${randomQuestion.Subject}</b>: `;

    //{"Part":"Part 4","Part description":"Safety Needs","Subject":"Certainty","Question":"I'm confident about how things are going. Everything is good, and it will stay that way.","questionNumber":"23"}

    var qtext = subjectAndCat + randomQuestion.Question + infoDiv + 

        `<div class="rangeHolder" id="surveyQuestion" style="max-width:110%; padding:0; margin:0; margin:20px 0; border-radius:12px;">             <input id="Q${qn}responseVal" name="Q${qn}response" style="display:none;"> <span class="rangeButton Q${qn}response" onclick="setBlogValue(1,'Q${qn}response' );">1</span> <span class="rangeButton Q${qn}response" onclick="setBlogValue(2,'Q${qn}response');">2</span> <span class="rangeButton Q${qn}response" onclick="setBlogValue(3,'Q${qn}response');">3</span> <span class="rangeButton Q${qn}response" onclick="setBlogValue(4,'Q${qn}response');">4</span> <span class="rangeButton Q${qn}response" onclick="setBlogValue(5,'Q${qn}response');">5</span> <span class="rangeButton Q${qn}response" onclick="setBlogValue(6,'Q${qn}response');">6</span> <span class="rangeButton Q${qn}response" onclick="setBlogValue(7,'Q${qn}response');">7</span> <span class="rangeButton Q${qn}response" onclick="setBlogValue(8,'Q${qn}response');">8</span> <span class="rangeButton Q${qn}response" onclick="setBlogValue(9,'Q${qn}response');">9</span> <span class="rangeButton Q${qn}response" onclick="setBlogValue(10,'Q${qn}response');">10</span></div>`;
    var a = document.getElementById("bqs");
    
    a.outerHTML += `<div id="blogQuestion">${qtext}</div>`;
}
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


function setBlogValue(value, id) {
    if (localStorage.blogSurveyJSON){
        var obj = JSON.parse(localStorage.blogSurveyJSON);
    } else {
        var obj = {};
    }
    obj[id] = value;
    localStorage.blogSurveyJSON = JSON.stringify(obj);
    surveyQuestion.innerHTML = "Your response has been recorded. Come back any time to finish the survey. <br><br><button class='bt  login-bar' onclick='location.assign(`/pielet/survey/`)'>See the survey now</button>";
    surveyQuestion.style.padding = "16px";
    surveyQuestion.style.textAlign = "center";
    surveyQuestion.style.background = "#eeeeee";
}

