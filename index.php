<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pietential - The Life Balance Realization System</title>
   
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="https://pietential.com/social.php">
<meta name="twitter:creator" content="@hankenstein">
<meta name="twitter:title" content="Realize Your Growth Potential in 5 Minutes">
<meta name="twitter:description" content="Pietential is a survey-based life balance visualization tool based on Maslow’s Hierarchy of needs.">
<meta name="twitter:image" content="http://pietential.com/pie-social-banner.png">



<link rel="canonical" href="https://pietential.com/"/>
<meta property="og:title" content="Realize Your Growth Potential in 5 Minutes"/>
<meta property="og:image" content="https://static.wixstatic.com/media/82f34a_c86a23ceb96c4ac7b4101649c78c83f3~mv2.png/v1/fill/w_1280,h_720,al_c/82f34a_c86a23ceb96c4ac7b4101649c78c83f3~mv2.png"/>
<meta property="og:image:width" content="1280"/>
<meta property="og:image:height" content="720"/>
<meta property="og:url" content="https://pietential.com/"/>
<meta property="og:site_name" content="Pietential"/>
<meta property="og:type" content="website"/>
</head>
<body>


    <script id="logoutScript">
        if (document.cookie == ""){
            console.log("new user");
            var userID = random(12);
            document.cookie = `userID=${userID}; SameSite=Lax; expires=31 Dec 2031 12:00:00 UTC; path=/`;
        }

        var c = document.cookie.split(';');
        var cookies = {};
        for (let a of c) {
            var prop = a.split("=")[0].trim();
            var val = a.split("=")[1].trim();
            cookies[prop] = val;
        }

        try {
            if (cookies.dashboard.length > 0 && cookies.userID.length > 0) {
                location.assign("/pielet/dashboard/");
            }
        } catch (e) {}
        try {
            if (parseInt(cookies.percent) > 93 && cookies.userID.length > 0) {
                location.assign("/pielet/visualizeit/?welcome-back-" + cookies.email);
            }
        } catch (e) {}
        try {
            if (parseInt(cookies.email.length) > 3) {
                pieletData = JSON.parse(localStorage.pieletDataJSON);
                location.assign("/pielet/survey/?welcome-back-" + cookies.email);
            }
        } catch (e) {}

        if (location.href.match(/logout/)) {
            document.cookie = "userID=; ; path=/";
            document.cookie = "email=; ; path=/";
            document.cookie = "partnerID=; ; path=/";
            document.cookie = "dashboard=; ; path=/";
            document.cookie = "percent=; ; path=/";
            location.assign("?new-session");
        }
        if (location.href.match(/retake/)) {
            document.cookie = "dashboard=; ; path=/";
            document.cookie = "percent=; ; path=/";
            location.assign("?start-new");
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
        function random(len){
            var str = `abcdefghjkmnpqrstuvwxyz234567894567ABCDEFGHJKLMNPQRSTUVWXYZ`;
            var s2 = shuffle(str.split(''));
            var out = ""
            for (var i = 0; i<len; i++){
                out+=s2[i];
            }
            return (out);
        }
    </script>


    <section id="navi"></section>
    <script>
        fetch("navbar.html")
            .then(r => {
                return r.text()
            })
            .then(a => {
                document.getElementById("navi").innerHTML = a;
                adjustLoginBar();
            });
    </script>

<script id='navScript'>
        function testVars() {
            var b = `loginLink,logoutLink,emailAddress,mobileLoginButton,mobileHomeButton,gotodash,mobileRetakeButton,retakeLink,returnLink,printResults`.split(',');

            for (let a of b) {
                try {
                    console.log(document.getElementById(a).innerHTML)
                } catch (e) {
                    console.log(a+" is not here");
                }
            }
        }
        try {
            NavData = JSON.parse(localStorage.pieletDataJSON);
        } catch (e) { }

        function adjustLoginBar() {
            try {
                if (NavData.email.length > 3) {
                    disableButton("loginLink");
                    enableButton("logoutLink");
                    document.getElementById("emailAddress").innerHTML = pieletData.email;
                    document.getElementById("emailAddress").title = pieletData.userID;
                    document.getElementById("mobileLoginButton").style.display = "none";
                }
            } catch (e) {
                enableButton("loginLink");

            }
            try {
                if (NavData.snapshots.length > 0) {
                    enableButton("gotodash");
                    document.getElementById("mobileHomeButton").innerHTML = "<button>Dashboard</button>";
                    document.getElementById("mobileHomeButton").href = "pielet/dashboard/";
                    document.getElementById("mobileRetakeButton").style.display = "inline-block";
                }
            } catch (e) { }
            try {
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
                    document.getElementById("printResults").href = `/pielet/download`;
                    enableButton("logoutLink");
                }
                if (location.href.match(/visualizeit/)) {
                    enableButton("logoutLink");
                    enableButton("printResults");
                    document.getElementById("printResults").href = `/pielet/analyzeit/`;
                    document.getElementById("printResults").innerHTML = `Analyze It`;
                }
                if (location.href.match(/8937/)) {
                    var buttons = "mobileHomeButton,mobileRetakeButton,mobileLoginButton,mobileLogoutButton,loginLink,logoutLink,gotodash,returnLink,printResults,retakeLink".split(",");
                    for (let a of buttons) {
                        document.getElementById(a).href = document.getElementById(a).href.replace(/8937/, "8937/pie2") + "?19992";
                        document.getElementById(a).classList.add("localized");
                    }
                }

            } catch (e) { }
        }

        function disableButton(id) {
            document.getElementById(id).style.opacity = ".3";
            document.getElementById(id).style.cursor = "not-allowed";
        }

        function enableButton(id) {
            document.getElementById(id).style.opacity = "1";
            document.getElementById(id).style.cursor = "pointer";
        }
    </script>






    <!-- begin branding-->
 

    <section id="brandi"></section>
    <script>
        fetch("pielet/branding.html")
            .then(r => {
                return r.text()
            })
            .then(a => {
                document.getElementById("brandi").innerHTML = a;
            });
    </script>


    <!-- END branding-->

    <div class="pie" id="pieCloud" style="margin-bottom:90px;max-width: 900px;margin: auto;">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&amp;display=swap" rel="stylesheet">
        <link href="https://pietential.com/pielet/styles.css" rel="stylesheet" type="text/css">

        <link href="https://pietential.com/pielet/styles.css" rel="stylesheet" type="text/css">


        <h1 style="text-align: center;">The Life Balance Realization System™</h1>
        <style>
            .col2 {
                width: 48%;
                float: left;
                text-align: left;
                margin: 12px;
            }
        </style>
        <section style="max-width:1000px;margin:auto;margin-bottom: 43px;">
            <div style="margin:0px;max-width: 900px;text-align: center;margin: auto;">
                <div id="abstract" style="text-align: center; box-sizing:border-box">
                    <p style="margin-top:6px;">Pietential is “The Life Balance Realization System.” Based on Maslow’s Hierarchy of Needs, it helps you Visualize, and Analyze where you stand regarding the core issues that are central to what it is to be human: Physiological Needs, Safety Needs, Love and Belonging, Esteem, and Self-actualization, so you can set and Realize your goals, and live your best life.<br><br><br>

                        <b>Realize Your Growth Potential</b>
                    </p>
                </div>
            </div>
        </section>
        <div style="text-align:center;">



            <form action='/pielet/accountEngine/' method='POST' id="signup">
                <input name='fname' id='fname' placeholder='Enter your first name*' type='text' required=''><br>
                <input name='lname' id='lname' placeholder='Enter your last name*' type='text'><br>
                <input name='email' placeholder='Enter your email address*' id='email' required='' type='email'>
                <input name='password' placeholder='Password*' id='password' required='' type='password'>

                <input class='bt green' value='Get Started' type='submit'><br>
                <!--<b>It's Free</b>--><br>
                <img src='/images/promoImage002.png' id='promoImage' style='max-width:100%;'>
                Already have an account? <a href='/login/'>Login</a>
            </form>


        </div>
        <br>


    </div>

    <script>
        if (!window.location.href.match(/https/ig)) {
            location.assign(`https://pietential.com/`);
        }
        if (window.location.href.match(/jstar/ig)) {
            location.assign(`https://pietential.com/`);
        }

        function updateOther() {
            var carny = document.getElementById(`otherType`).value.trim();
            var jsname = carny.replace(/[^a-z]+/ig, "");
            document.getElementById(`TYPEnewCat`).value = `TYPE` + jsname;
            document.getElementById(`newBizType`).innerHTML = carny;
            getBusinessType();
            document.getElementById('businessCategories').value = jsname;
            window.userSelectedType = 1;
        }

        function handleOtherType() {
            document.getElementById(`otherType`).style.display = `block`;
            document.getElementById(`businessCategories`).value = document.getElementById(`otherType`).value.replace(/[^a-z]+/ig, "");
        }

        function getBusinessType() {
            window.userSelectedType = 1;
            var businessType = "";
            for (let a of document.getElementsByTagName("input")) {
                if (a.id.match(/TYPE/)) {
                    if (a.checked) {
                        businessType += a.id.replace(/TYPE/ig, "") + " ";
                    }
                }
            }

            document.getElementById('businessCategories').value = businessType.trim();
            if (document.getElementById(`TYPEnewCat`).checked) {
                document.getElementById('businessCategories').value = document.getElementById(`TYPEnewCat`).value;
            }
            console.log(businessType);
            return businessType;
        }
    </script>



    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117957204-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-117957204-2');

    </script>



    <section id="footi"></section>
    <script>
        fetch("pielet/universal-footer.php")
            .then(r => {
                return r.text()
            })
            .then(a => {
                document.getElementById("footi").innerHTML = a;
            });
    </script>
</body>

</html>