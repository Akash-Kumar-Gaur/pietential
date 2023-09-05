


function runReport() {
    var data = JSON.parse(sessionStorage.userBase);
    var dateSortedUsers = [];
    for (let a of data.users) {
        if (!a.joinDate) {
            a.joinDate = `2019-01-01--01-01-01`;
        }
        dateSortedUsers.push(a);
    }
    dateSortedUsers.sort((a, b) => (a.joinDate > b.joinDate) ? 1 : -1);
    dateSortedUsers.reverse();
    console.log(dateSortedUsers);
    var out = '';
    var i = 0;
    while (i < 400) {
        var jss = '';
        var obj = dateSortedUsers[i];
        for (let g in obj) {
            jss += `<tr><td>${g}</td><td>${obj[g]}</td></tr>`;
        }
        var id = dateSortedUsers[i].userID;
        var em = dateSortedUsers[i].joinDate + ` - ` + dateSortedUsers[i].email;
        out += `<button onclick='inspect("${id}")'>${em}</button>
    <div class='dataView' id='${id}Data' style='display:none;'><table>${jss}</table></div><br>`;
        i++;
    }
    document.body.innerHTML = out;

}

function inspect(id) {
    clearData();
    var iid = `${id}Data`;
    document.getElementById(iid).style.display = `block`;
}

function clearData() {
    for (let a of document.getElementsByClassName('dataView')) {
        a.style.display = 'none';
    }
}