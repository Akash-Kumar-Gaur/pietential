function adjustLoginBar() {
    try {
        if (pieletData.email.length > 3) {
            disableButton("loginLink");
            enableButton("logoutLink");
            document.getElementById("emailAddress").innerHTML = pieletData.email;
        }
    }
    catch (e) {
        enableButton("loginLink");
    }
    try {
        if (pieletData.snapshots.length > 0) {
            enableButton("gotodash");
        }
    }
    catch (e) { }
    if (location.href.match(/dashboard/)) {
        disableButton("gotodash");
        enableButton("retakeLink");
        enableButton("returnLink");
        enableButton("printResults");
    }
    if (location.href.match(/survey/)) {
        disableButton("gotodash");
        disableButton("retakeLink");
        disableButton("returnLink");
        disableButton("printResults");
    }
    if (location.href.match(/analyzeit/)) {
        enableButton("retakeLink");
        enableButton("returnLink");
        enableButton("printResults");
        document.getElementById("printResults").href = `../pdf.php?genHTML=${pieletData.userID}`;
        enableButton(document.getElementById("logoutLink"));
    }
    if (location.href.match(/visualizeit/)) {
        enableButton("logoutLink");
        enableButton("printResults");
        document.getElementById("printResults").href = `../analyzeit/`;
        document.getElementById("printResults").innerHTML = `Analyze It`;
    }

}

function disableButton(id) {
    document.getElementById(id).style.opacity = ".3";
    document.getElementById(id).style.cursor = "not-allowed";
}
function enableButton(id) {
    document.getElementById(id).style.opacity = "1";
    document.getElementById(id).style.cursor = "pointer";
}


document.addEventListener("DOMContentLoaded", adjustLoginBar);