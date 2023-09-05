console.log("emailBar.js has loaded");
if(!localStorage.emailUpdate){
    return;
document.body.getElementsByTagName("script")[0].outerHTML +=
    `<section id="emailBarHolder"></section>`;
    fetch("/navigation/emailBar.html")
    .then(r => {
        return r.text()
    })
    .then(a => {
        document.getElementById("emailBarHolder").innerHTML = a;
        document.getElementById("main-logo-top").style.marginTop = '72px';
        if(localStorage.email){
            document.getElementById("emailUpdates").value = localStorage.email;
        }
    });
}

    function gomail() {
        var emailUpdate = document.getElementById("emailUpdates").value.trim();
        localStorage.emailUpdate = emailUpdate;
        document.getElementById("inneremailBar").innerHTML =`Thank you!
        <img src="/emailUpdate/x.php?email=${emailUpdate}" style="display:none"> <button class="bt  login-bar" style="font-size: 13px;" onclick="dismissUpdate()">Close this window</button>`;
    }
    function dismissUpdate() {
        if(!localStorage.emailUpdate){
            localStorage.emailUpdate = 'decline';
        }
        document.getElementById("emailBarHolder").style.display = "none";
        document.getElementById("main-logo-top").style.marginTop = '0px';
    }




    