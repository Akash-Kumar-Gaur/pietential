
document.getElementById("hustler33");
document.getElementsByClassName("entry-content")
document.getElementsByTagName("entry-content")

var arr = [];
for (let a of document.getElementsByTagName("a")) {
    if (!a.href.match(/#|\?/)) {
        arr.push(a.href);
    }
}
arr.sort();
var out = '';
arr = Array.from(new Set(arr));
for (let a of arr) {
    if (!a.match(/#|\?/)) {
        out += `${a}\n`;
    }
}
document.body.innerHTML += `<textarea>${out}</textarea>`;


localStorage.nogo = 1;
if (!localStorage.nogo) {
    location.assign('http://unbouncepages.com/cirrusinvestments/');
}


function capResults(){
    let i = 0;
    var out = '';
    let a = prompt("integer number");
    a = parseInt(a);
    var collection = document.getElementsByClassName("searchResultContainer");
    for (let p of collection){
        i++;
        if(i < a){
            out += p.outerHTML;
        }
    }
    document.getElementById('d1').innerHTML = out;
}


for (let a of document.getElementsByTagName("li")) {
    var s = a.getElementsByTagName("p")[0].innerHTML;
    a.outerHTML = `<li>${s}</li>`;
}


<li aria-level="1">
    <p role="presentation"> <b>Urine analysis kits</b> that measure the level of luteinizing hormone (LH predictor kits). <a href="https://medlineplus.gov/ency/article/007062.htm#:~:text=The%20test%20detects%20a%20rise,is%20most%20likely%20to%20occur."> The Ovulation home tes </a> t detects a rise in luteinizing hormone (LH) in the urine. A rise in this hormone signals the ovary to release the egg. This at-home test is often used by women to help predict when an egg release is likely. This is when pregnancy is most likely to occur </p></li>

function fixImages() {
    var el = document.getElementsByClassName("entry-content")[0];
    var x = 1;
    for (let a of el.getElementsByTagName("img")) {
        a.style.width = "50%";
        a.style.margin = "4%";
        if ((x % 2) > 0) {
            fl = "left";
        } else {
            fl = "right";
        }
        a.style.float = fl;
        x++;
    }
}
fixImages();




var out = '';
for (let a of document.getElementsByClassName("t4")) {
    var i = a.style.backgroundImage.replace(/url\(/ig, "");
    i = i.replace('"', '');
    i = i.replace('")', '');
    i = "https://pietential.com" + i;
    console.log(i);
    out += `<img style="width:300px" src="${i}">`;
}
document.body.innerHTML += out;



function pickTag() {
    let tagg = prompt("what tag do you want to remove?", localStorage.tagg);
    tagg = tagg.trim();
    localStorage.tagg = tagg;
    //var tagg = 'u';
    for (let a of document.getElementsByTagName(tagg)) {
        var vaso = a.innerText.trim();
        a.title = vaso;
        a.classList.add("hustler33");
        a.outerHTML += ` ${vaso} `;
    }
    var ta = document.getElementsByClassName("hustler33");
    while (ta.length > 0) {
        var asd = ta[0];
        asd.parentElement.removeChild(asd);
    }
}

/*
Sam Richards
VP Operations
United Lens
UnitedLens
srichards@ulc.biz   
123-456-9874
https://ulcpro.net/
Oghq3sPXat6^AkjRO

cdill@ulc.biz
CNENm6**gd2


*/