
var out = '';
var rane = localStorage.randomEmails.split("\n");
var el = document.getElementsByClassName("userList")[1];
el.classList.add("gonzo");
var hc = el.outerHTML;
for (var i = 0; i<30; i++){
    hc = `<div class="userList users" >${rane[i]}</div>`;
    out += `${hc}`;
}
el.outerHTML=out;

var headline = "Advisor Dashboard";
for (let a of document.getElementsByTagName("div")) {
    if (a.innerHTML.match(/^Pietential TA/)) {
        a.innerHTML = headline;
        i++;
    }
}
pid.innerHTML = 'Partner ID: Smith Advisors';
adminName.innerHTML = 'Smith Advisors';
numusers.innerHTML = '33';
masthead.innerHTML = 'Smith Advisors Dashboard';

rc = JSON.parse(localStorage.randomCompanies);
for (let a of document.getElementsByClassName("rebuildCompanyList")){
    var s = shuffle(rc)[0];
    a.innerHTML = s;
}


