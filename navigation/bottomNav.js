try {
    document.getElementById("footi").id = '';
} catch(e){};

for(let a of document.getElementsByTagName("script")){
    if (a.src.match(/bottomNav/)){
        a.outerHTML +=
        `<section id="footi"></section>`;
    }
}

fetch("/navigation/universal-footer.php")
    .then(r => {
        return r.text()
    })
    .then(a => {
        document.getElementById("footi").innerHTML = a;

    });


var cdiv = `<div id="cookieSetter" style="text-align:center;padding: 40px;background: #323131;position: fixed;bottom: 0;width: 100%; color:white; z-index: 99;">Pietential requires cookies to work properly. <a onclick="allowCookies()" class="bt green login-bar" href="javascript://">Accept Cookies</a> <a  class="bt bgred login-bar"  onclick="denyCookies()" href="javascript://">Deny Cookies</a></div>`;

if (!localStorage.cookiePrefs) {
    document.body.innerHTML += cdiv;
}

function denyCookies() {
    localStorage.cookiePrefs = 1;
    document.getElementById("cookieSetter").outerHTML = '';
}
function allowCookies() {
    localStorage.cookiePrefs = 2;
    document.getElementById("cookieSetter").outerHTML = '';
}