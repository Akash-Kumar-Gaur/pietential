
fetch("/pricing/p.html")
    .then(r => {
        return r.text()
    })
    .then(a => {
        document.getElementById("pricingBlock").innerHTML = a;
        piblur(`piadv`);
        piblur(`pient`);
        piblur(`pibiz`);
        //piblur(`piworld`);
        pifocus(`pipro`);
        localStorage.arrowClick = `pipro`;

    });




function adjustBlurred() {
    for (let a of document.getElementsByClassName("productBox")) {
        if (a.style.height == "0px") {
            a.style.display = "none";
        }
    }
}

function pifocus(id) {
    for (let a of document.getElementsByClassName("pifocused")) {
        piblur(a.id);
    }
    var buttonID = id + 'Button';
    document.getElementById(buttonID).style.transform = "scale(1.2)";
    document.getElementById(buttonID).style.zIndex = 9;
    var el = document.getElementById(id);
    el.style.zIndex = 5;
    el.style.opacity = 1;
    el.style.filter = "";
    el.style.transform = "";
    el.style.filter = "blur(0px)";
    el.style.transform = "scale(1)";
    el.classList.add("pifocused");
    el.style.display = "";
    el.style.height = "";
}

function piblur(id) {
    var el = document.getElementById(id);
    el.style.opacity = 0;
    el.style.zIndex = 4;
    el.style.transform = "scale(1.1)";
    el.classList.add("piblurred");
    for (let a of document.getElementsByClassName("fancyButton1")) {
        a.style.transform = "scale(1)";
        a.style.zIndex = 2;
    }
    el.style.height = 0;
}

function clickUP(negate) {

    var arr = `pipro,piadv,pibiz,pient`.split(",");
    var currentPos = arr.indexOf(localStorage.arrowClick);

    if (negate) {
        if (currentPos < 1) {
            currentPos = 4;
        }
        var targetDiv = arr[currentPos - 1];
    } else {
        if (currentPos > 2) {
            currentPos = -1;
        }
        var targetDiv = arr[currentPos + 1];
    }

    console.log("scroll to " + targetDiv);
    pifocus(targetDiv);
    localStorage.arrowClick = targetDiv;
    document.getElementsByClassName("arrow")[0].title = `Click to scroll next to ${targetDiv}`;
}
