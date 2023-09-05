var gColor1 = `rgba(110,148,248,1)`;
var gColor2 = `rgba(2,183,45,1)`;
var gColor3 = `rgba(249,186,3,1)`;
var gColor4 = `rgba(248, 126, 2,1)`;
var gColor5 = `rgba(251,0,0,1)`;

var gradFullcolor = `linear-gradient(to right, 
    ${gColor1} 0%,${gColor1} 20%,
    ${gColor2} 20%,${gColor2} 40%,
    ${gColor3} 40%,${gColor3} 60%,
    ${gColor4} 60%,${gColor4} 80%,
    ${gColor5} 80%,${gColor5} 100%
    )`;

var     gradientToUse = gradFullcolor;
var grad2color = `linear-gradient(to right, 
        ${gColor1} 0%,${gColor1} 95%,
        ${gColor2} 95%,${gColor2} 100%)`;
var grad3color = `linear-gradient(to right, 
        ${gColor1} 0%,${gColor1} 50%,
        ${gColor2} 50%,${gColor2} 95%,
        ${gColor3} 95%,${gColor3} 100%)`;
var grad4color = `linear-gradient(to right, 
            ${gColor1} 0%,${gColor1} 33%,
            ${gColor2} 33%,${gColor2} 66%,
            ${gColor3} 66%,${gColor3} 66%,${gColor3} 95%,${gColor4} 95%, ${gColor4} 100% )`;  
var grad4color = `linear-gradient(to right, 
                ${gColor1} 0%,${gColor1} 25%,
                ${gColor2} 25%,${gColor2} 50%,
                ${gColor3} 50%,${gColor3} 75%,
                ${gColor4} 75%,${gColor4} 95%,
                ${gColor5} 95%,${gColor5} 100%
                )`;   

var gradientToUse = ``;
if (localStorage.Part2Completed < 15) {
    gradientToUse = `linear-gradient(to right, 
        ${gColor1} 0%,${gColor1} 100%`;
}
if (localStorage.Part2Completed > 15) {
    gradientToUse = grad2color.replace(/95/ig, "66");
}
if (localStorage.Part2Completed > 30) {
    gradientToUse = grad2color.replace(/95/ig, "50");
}
if (localStorage.Part2Completed > 45) {
    gradientToUse = grad2color.replace(/95/ig, "33");
}
if (localStorage.Part2Completed > 60) {
    gradientToUse = grad2color.replace(/95/ig, "15");
}
if (localStorage.Part2Completed > 80) {
    gradientToUse = grad2color.replace(/95/ig, "5");
}


if (localStorage.Part3Completed > 15) {
    gradientToUse = ``;
}
if (localStorage.Part3Completed > 30) {
    gradientToUse = ``;
}
if (localStorage.Part3Completed > 45) {
    gradientToUse = ``;
}
if (localStorage.Part3Completed > 60) {
    gradientToUse = ``;
}
if (localStorage.Part3Completed > 80) {
    gradientToUse = ``;
}


if (localStorage.Part4Completed > 15) {
    gradientToUse = ``;
}
if (localStorage.Part4Completed > 30) {
    gradientToUse = ``;
}
if (localStorage.Part4Completed > 45) {
    gradientToUse = ``;
}
if (localStorage.Part4Completed > 60) {
    gradientToUse = ``;
}
if (localStorage.Part4Completed > 80) {
    gradientToUse = ``;
}


if (localStorage.Part5Completed > 15) {
    gradientToUse = ``;
}
if (localStorage.Part5Completed > 30) {
    gradientToUse = ``;
}
if (localStorage.Part5Completed > 45) {
    gradientToUse = ``;
}
if (localStorage.Part5Completed > 60) {
    gradientToUse = ``;
}
if (localStorage.Part5Completed > 80) {
    gradientToUse = ``;
}