
var formQuestions = [{ "Part": "Part 1", "Part description": "Self Actualization", "Subject": "Personal Development", "Question": "I'm actively engaged in my own personal development to become the best me I can be." }, { "Part": "Part 1", "Part description": "Self Actualization", "Subject": "Well Being", "Question": "I'm comfortable with myself. I feel balanced and fulfilled. My daily mindset is positive." }, { "Part": "Part 1", "Part description": "Self Actualization", "Subject": "Spirituality and Life Purpose", "Question": "I know my life has meaning. I know my purpose in life and I'm living it." }, { "Part": "Part 1", "Part description": "Self Actualization", "Subject": "Education", "Question": "I seek and gain the education I need to have a fulfilling life." }, { "Part": "Part 1", "Part description": "Self Actualization", "Subject": "Achievement", "Question": "I'm satisfied with what I've achieved in life so far." }, { "Part": "Part 1", "Part description": "Self Actualization", "Subject": "Mastery", "Question": "I am working to master new skills." }, { "Part": "Part 2", "Part description": "Esteem and Contribution", "Subject": "Contribution", "Question": "I've made contributions to my community that I'm proud of." }, { "Part": "Part 2", "Part description": "Esteem and Contribution", "Subject": "Appreciation", "Question": "I appreciate my whole self." }, { "Part": "Part 2", "Part description": "Esteem and Contribution", "Subject": "Self Respect", "Question": "I have a high degree of self respect. I matter to me and my actions show it." }, { "Part": "Part 2", "Part description": "Esteem and Contribution", "Subject": "Respect and Status", "Question": "People respect me. I'm recognized for my efforts. I have achieved a certain amount of status in life." }, { "Part": "Part 2", "Part description": "Esteem and Contribution", "Subject": "Strength/Empowerment", "Question": "I feel empowered and strong. I fully express myself." }, { "Part": "Part 2", "Part description": "Esteem and Contribution", "Subject": "Freedom and Expression", "Question": "I have a lot of personal freedom to call my own shots in life." }, { "Part": "Part 3", "Part description": "Love and Belonging", "Subject": "Family Relationships", "Question": "I have a solid, healthy relationship with my family." }, { "Part": "Part 3", "Part description": "Love and Belonging", "Subject": "Friendship", "Question": "I make and have deep, lasting, healthy friendships." }, { "Part": "Part 3", "Part description": "Love and Belonging", "Subject": "Social Relationship", "Question": "My social relationships are full of positive interactions." }, { "Part": "Part 3", "Part description": "Love and Belonging", "Subject": "Intimacy", "Question": "My intimate relationships are fulfilling." }, { "Part": "Part 3", "Part description": "Love and Belonging", "Subject": "Play", "Question": "I allow myself the freedom to play." }, { "Part": "Part 3", "Part description": "Love and Belonging", "Subject": "Compassion", "Question": "I have deep compassion for others." }, { "Part": "Part 4", "Part description": "Safety Needs", "Subject": "Certainty", "Question": "I feel certain about how things are. Everything is fine and will continue to be fine." }, { "Part": "Part 4", "Part description": "Safety Needs", "Subject": "Resiliency", "Question": "I can handle whatever life brings me. I have been knocked down in life before, and I always get back up." }, { "Part": "Part 4", "Part description": "Safety Needs", "Subject": "Physical Security", "Question": "I feel physically safe in my daily life." }, { "Part": "Part 4", "Part description": "Safety Needs", "Subject": "Emotional/Mental Health", "Question": "I feel emotionally stable and my mental health is good." }, { "Part": "Part 4", "Part description": "Safety Needs", "Subject": "Food Security", "Question": "I have enough food, and access to food - and I never worry about it." }, { "Part": "Part 4", "Part description": "Safety Needs", "Subject": "Dwelling Security", "Question": "I have a roof over my head, and I'm confident that I always will." }, { "Part": "Part 5", "Part description": "Physiological Needs", "Subject": "Nutrition", "Question": "I consciously manage my nutrition. I'm fueling my body with what it needs to excel." }, { "Part": "Part 5", "Part description": "Physiological Needs", "Subject": "Health", "Question": "I'm in excellent health for my age." }, { "Part": "Part 5", "Part description": "Physiological Needs", "Subject": "Exercise", "Question": "I exercise regularly, because fitness is a high priority for me." }, { "Part": "Part 5", "Part description": "Physiological Needs", "Subject": "Mindfulness", "Question": "I practice mindfulness daily and am able to be in the moment." }, { "Part": "Part 5", "Part description": "Physiological Needs", "Subject": "Sleep", "Question": "I'm getting good quality sleep each night." }, { "Part": "Part 5", "Part description": "Physiological Needs", "Subject": "Substance Abuse", "Question": "I don't undermine my physiology with harmful substances." }];

var snout = '';
var token = 0;
    var endDiv = "";
localStorage.incred23 = 0;
    for (let a of formQuestions) {
        if (a.Part == "Part 1") {
            snout += buildsectionChunk(a,i);
        }
    }



function buildsectionChunk(a) {
    var i = localStorage.incred23;
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
    if (a.Part == "Part 1"){
        tcolor = colorParts[0];
    }
    if (a.Part == "Part 2"){
        tcolor = colorParts[1];
    }
    if (a.Part == "Part 3"){
        tcolor = colorParts[2];
    }
    if (a.Part == "Part 4"){
        tcolor = colorParts[3];
    }
    if (a.Part == "Part 5"){
        tcolor = colorParts[4];
    }
    var thePartNoSpace = a.Part.replace(/\s+/ig, "");
    var thePartNoLetters = thePartNoSpace.replace(/[a-z]+/ig, "");
    thePartNoLetters = parseInt(thePartNoLetters - 1);
    var theSectionTitle = sectionNames[thePartNoLetters];
    if (thePartNoSpace !== token) {
        out += `${endDiv}<div id="${thePartNoSpace}" style="background:${tcolor}; padding:12px;border-radius:8px;color:white;box-sizing:border-box;">
<h2>${theSectionTitle}</h2>On a scale of 1-10, with 1 being I completely disagree with this statement and 10 being I completely agree with this statement, how would you rate each of the following statements?<br><br>`;
        var token = thePartNoSpace;
        endDiv = "</div>";
    }
    out += `<div style="color:white;" id="Q${i}" ><strong>${a.Subject}</strong>: ${a.Question} <!--Current Rating: <span id="rangeEchoQ${i}">0</span>--><br><span id="Q${i}Cat1"></span>
<div class="rangeHolder">
<!--<input value="0" type="range" min="0" max="10" name="Q${i}response" onchange="addValues();" placeholder="${a.Question} Rate on a 0 - 10 scale" alt="${a['Part description']}" title="${a.Part}" class="rangeSlider">-->
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

return out;
localStorage.incred23 = localStorage.incred23 +1;

}

