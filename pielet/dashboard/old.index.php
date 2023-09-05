<?php
extract($_GET);
extract($_POST);
// dashboard/index.php
if ($test) {
    echo "<pre>";
    print_r($_COOKIE);
    exit;
}
if (!$userID) {
    $userID = $_COOKIE['userID'];
}
if (!$userID) {
    header("Location: /?user-not-supplied");
    exit;
}
if (!$_COOKIE['email']) {
    echo "<script> location.assign(`/?no-email-found(dashboard)`)</script>";
    exit;
}
$pieletDataJSON = @file_get_contents("../ids/$userID.json.txt");
$master = json_decode($pieletDataJSON, true);

if ($_COOKIE['email'] !== $master['email']) {
    $e = $master['email'];
    echo "<script> alert(`email accounts do not match. you need to log in as $e`);
    location.assign(`/pielet/login.php`);
    </script>";
    exit;
}




if (!$master || !$pieletDataJSON) {
    header("Location: /?no-user-data");
    exit;
}

if (!$master['hash']) {
    header("Location: /pielet/create/");
    exit;
}

$numberOfSnapshots = count($master['snapshots']);

if ($master['Q29response']) {
    // they have a set of current results in the dataset
    $numberOfSnapshots++;
}


if ($master['snapshots']) { // need more than one
    if ($numberOfSnapshots > 1) {
        $snappy = print_r($master['snapshots'], true);
        foreach ($master['snapshots'] as $key => $value) {
            $snappy .= json_encode($value);
        }
        //echo "<!-- SNAPPY $snappy -->\n\n\n";
        $csnap = count($master['snapshots']);

        foreach ($master['snapshots'] as $key => $value) {
            $stamp = $value['timestamp'];
            $date[] = $stamp;
        }
        $dateJSON = json_encode($date);
        echo "<!-- The dateArray is $dateJSON -->";

        if ($master['Q29response']) {
            $csnap = $csnap + 1; // if the user has an active chart outside of the snapshots, we need to account for that extra chart
        }

        $zs = 0;
        while ($zs < $csnap) {

            $snapdata = $master['snapshots'][$zs];
            // if(!$snapdata){
            //     continue;
            // }
            $snapdata = json_encode($snapdata);
            $snapdata = "<!-- $snapdata -->";
            $ts = $date[$zs];
            if (!$date[$zs]) {
                $currentday = date('Y-m-d');
                $ts = "$currentday $snapdata"; //ymd
            }
            $csout .= "<div class ='dashCanvasContainer'>
        <div style='clear:both;text-align:center;'>Date: $ts </div>
        <canvas id='csnap$zs' ></canvas></div>\n\n";
            $zs++;
        }
        $csout = "<div style='width:100%;'>$csout</div><div style='clear:both;'></div>";
    }
}

if ($countryOfOrigin && $userID) {
    // save the form data and exit-redirect //
    foreach ($_POST as $key => $value) {
        $master[$key] = trim($value);
    }
    $masterJSON = json_encode($master);
    file_put_contents("../ids/$userID.json.txt", $masterJSON);
    echo "<script>
    localStorage.pieletDataJSON = `$masterJSON`;
    location.assign(`?wellDone`);
    </script>";
    exit();
}

function getrandom($n)
{
    $g = str_split("abcdefgqyzxw1234567890!@#$%^&*ABCDEFGHJKLOIUYTREW");
    $v = 0;
    $r = "";
    while ($v < $n) {
        shuffle($g);
        $r .= $g[0];
        $v++;
    }
    return ($r);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="manifest" href="../../pietential.webmanifest">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../styles.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
    <script src="https://pietential.com/chartjs-plugin-watermark.js"></script>

    <link rel="icon" type="image/png" href="/icon.png">
    <title>Pietential - The Life Balance Realization System</title>


    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="https://pietential.com/social.php">
    <meta name="twitter:creator" content="@hankenstein">
    <meta name="twitter:title" content="Realize Your Growth Potential in 5 Minutes">
    <meta name="twitter:description" content="Pietential is a survey-based life balance visualization tool based on Maslow’s Hierarchy of needs.">
    <meta name="twitter:image" content="http://pietential.com/pie-social-banner.png">
    <meta property="og:url" content="https://pietential.com/social.php" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Realize Your Growth Potential in 5 Minutes" />
    <meta property="og:description" content="Pietential is a survey-based life balance visualization tool based on Maslow’s Hierarchy of needs." />
    <meta property="og:image" content="http://pietential.com/pie-social-banner.png" />


</head>
<!--
<link rel="stylesheet" href="https://d1azc1qln24ryf.cloudfront.net/114779/Socicon/style-cf.css?u8vidh">
-->

<style>
    input {
        width: 400px;
    }
</style>

<?php
$userID = $_COOKIE['userID'];
//echo file_get_contents("https://pietential.com/pielet/generate-login-bar.php?userID=$userID");
?>

<?php echo file_get_contents("../../navbar.html"); //new nav 10/26 
?>




<div style="width:90%; padding:20px;text-align:center;margin:auto;">
    <div id="minibranding" style="padding-top: 50px; margin: auto; text-align: center; display: block;">
        <a href="#"><img onmouseover="" src="https://pietential.com/pietential.png" style="width: 10%;max-width: 500px;margin-bottom:10px;margin: auto;"></a>
    </div>
    <div style="margin:auto;">


        <div id="dash">
            <span id="hassnapshots">
                <h2>Account information:</h2>
                <div id="past">
                    Progress:<br>
                </div>
            </span>
            <?php
            if (!$master['snapshots'] || $numberOfSnapshots < 2) {
                
                
                $fname = $master['fname'];
                $lname = $master['lname'];
                $email = $master['email'];

                echo "<style> #hassnapshots {display:none;}</style>";
                echo "<br><h2>New to Pietential?</h2>
                    Each time you complete the Pietential Survey the results are logged into
                    the system, date stamped and line graphed, so you can track your
                    progress over time.<br><br>
                    <a class='bt' style='font-size: 15px; padding: 10px 20px;' href='/pielet/retake/'>Retake and track your progress</a>
                    <br>
                    <br>
                    <img style='max-width:100%;' src='/images/progressChartSample.png'>
                    <br>
                    <br>
                    <br>
                    <br>

                   


    



                    ";
            } else {
                echo '<canvas id="canvas" style="height:500px;"></canvas>
                    

                
                  ';
            }
            ?>

<div id='contactForm' style='display:none;'>
    <br>
                    <br>
                    <br>
    <br><br><br><br>
                    <!-- BEGIN EXTENDED CONTACT INFO -->
                    <form action='/pielet/new-account/' method='POST' >
                    <input name='fname' id='fname' placeholder='Enter your first name*' type='text' value='<?= $fname?>' required=''><br>
                    <input name='lname' value='<?= $lname?>' id='lname' placeholder='Enter your last name*' type='text' ><br>
                    <input name='email' value='<?= $email?>' placeholder='Enter your email address*' id='email' required='' type='email'><br>
    
                    <input name='company' placeholder='Company' id='company' type='text'><br>
                    <input name='title' placeholder='Title' id='title' type='text'><br>
                    <input name='website' placeholder='Website' id='website'  type='text'><br>
                    <input name='phone' placeholder='Phone' id='phone' type='phone'><br>
                    <input type='hidden' id='userID' name='userID' value='$userID'><br><br>
                    
                    <B>Please Check the category for your organization:</B>
                    <br><br>
                    <div id='boxes' style='text-align: center;'>
                    <input required onclick='getBusinessType();' id='TYPEbusinessConsultant' name='TYPE' type='radio' value='1'
                        style='width:40px;'> Business Consultant
                    <br>
                    <input  onclick='getBusinessType();' id='TYPEbusinessBroker' name='TYPE' type='radio' value='TYPEbusinessBroker' style='width:40px;'>
                    Business Broker
                    <br>
                    <input  onclick='getBusinessType();' id='TYPEcertifiedValuationAnalyst' name='TYPE' type='radio' value='TYPEcertifiedValuationAnalyst'
                        style='width:40px;'> Certified Valuation Analyst
                    <br>
                    <input  onclick='getBusinessType();' id='TYPEexitPlanner' name='TYPE' type='radio' value='TYPEexitPlanner' style='width:40px;'> Exit
                    Planner
                    <br>
                    <input  onclick='getBusinessType();' id='TYPEfinancialAdvisor' name='TYPE' type='radio' value='TYPEfinancialAdvisor' style='width:40px;'>
                    Financial Advisor
                    <br>
                    <input  onclick='getBusinessType();' id='TYPElifeCoach' name='TYPE' type='radio' value='TYPElifeCoach' style='width:40px;'> Life Coach
                    <br>
                    <input  onclick='getBusinessType();' id='TYPEnutritionist' name='TYPE' type='radio' value='TYPEnutritionist' style='width:40px;'>
                    Nutritionist
                    <br>
                    <input  onclick='getBusinessType();' id='TYPEpersonalTrainer' name='TYPE' type='radio' value='TYPEpersonalTrainer' style='width:40px;'>
                    Personal Trainer
                    <br>
                    <input  onclick='getBusinessType();' id='TYPEretirementPlanner' name='TYPE' type='radio' value='TYPEretirementPlanner'
                        style='width:40px;'> Retirement Planner
                    <br>
                    <input  onclick='getBusinessType();' id='TYPEsoleProprietorship' name='TYPE' type='radio' value='TYPEsoleProprietorship'
                        style='width:40px;'> Sole Proprietorship
                    <br>
                    <input  onclick='getBusinessType();' id='TYPEsmallOrMediumSizedBusiness' name='TYPE' type='radio' value='TYPEsmallOrMediumSizedBusiness'
                        style='width:40px;'> Small or Medium Sized Business
                    <br>
                    <input  onclick='getBusinessType();' id='TYPElargeCompany' name='TYPE' type='radio' value='TYPElargeCompany' style='width:40px;'> Large
                    Company
                    <br>
                    <input  onclick='getBusinessType();' id='TYPEnonprofitOrganization' name='TYPE' type='radio' value='TYPEnonprofitOrganization'
                        style='width:40px;'> Nonprofit Organization
                    <br>
                    <input  onclick='getBusinessType();' id='TYPEnonGovernmentalOrganization' name='TYPE' type='radio' value='TYPEnonGovernmentalOrganization'
                        style='width:40px;'> Non Governmental Organization
                    <br>
                    <input  onclick='getBusinessType();' id='TYPElocalGovernmentAgency' name='TYPE' type='radio' value='TYPElocalGovernmentAgency'
                        style='width:40px;'> Local Government Agency
                    <br>
                    <input  onclick='getBusinessType();' id='TYPEstateGovernmentAgency' name='TYPE' type='radio' value='TYPEstateGovernmentAgency'
                        style='width:40px;'> State Government Agency
                    <br>
                    <input  onclick='getBusinessType();' id='TYPEfederalGovernmentAgency' name='TYPE' type='radio' value='TYPEfederalGovernmentAgency'
                        style='width:40px;'> Federal Government Agency
                        <br>
                        <input  onclick='getBusinessType();' id='TYPEstudent' name='TYPE' type='radio' value='TYPEstudent'
                        style='width:40px;'> Student
                        <br>
                
                
                
                
                
                
                        <input  onclick='handleOtherType();' id='TYPEnewCat' name='TYPE' type='radio' value='1'
                        style='width:40px;'> <span id='newBizType'>Other</span>
                        <br>  
                        <input id='otherType' placeholder='Enter your business type here.' name='TYPE' onkeyup='updateOther ()' style='display:none; margin:auto;'>
                </div>
                <input type='hidden' id='businessCategories' name='businessCategories' value=''>
                    
                <!-- END EXTENDED CONTACT INFO -->
                <input class='bt green' onmouseover='getBusinessType();' value='Submit' type='submit'><br>
                <!--<b>It's Free</b>--><br>
                <img src='/images/promoImage002.png' id='promoImage' style='max-width:100%;'>
                <br>Already have an account? <a href='/login/'>Login</a>
            </form>

                </div>
        </div>
    </div>
    <div id="pastPieCharts"><?php echo $csout; ?></div>


<script>
        if (!window.location.href.match(/https/ig)) {
            location.assign(`https://pietential.com/`);
        }
        if (window.location.href.match(/jstar/ig)) {
            location.assign(`https://pietential.com/`);
        }

        function updateOther (){
            var carny = document.getElementById(`otherType`).value.trim();
            var jsname = carny.replace(/[^a-z]+/ig, "");
            document.getElementById(`TYPEnewCat`).value = `TYPE`+jsname;
            document.getElementById(`newBizType`).innerHTML = carny;
            getBusinessType();
            document.getElementById('businessCategories').value = jsname;
            window.userSelectedType = 1;
        }
        function handleOtherType(){
            document.getElementById(`otherType`).style.display=`block`;
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
            if (document.getElementById(`TYPEnewCat`).checked){
                document.getElementById('businessCategories').value = document.getElementById(`TYPEnewCat`).value;
            }
            console.log(businessType);
            return businessType;
        }

</script>

    <div id="otherServices">
    <style>
        .containerFLEX {
            display: flex;
            flex-wrap: wrap;
        }

        .innerFLEX {
            flex: 1 1 40%;
            padding: 30px;
            border-radius: 12px;
            justify-content: center;
            align-content: center;
            box-sizing: border-box;
            margin:3%;
        }

        @media all and (max-width:1000px) {
            .innerFLEX {
                flex: 1 1 100%;
            }
        }
    </style>
<div class="containerFLEX">
        <div class="innerFLEX" style="background: #eee;;"><span>
<p dir="ltr"><b></b></p><h3><b>PietentialTA<span>™</span></b></h3>
<p dir="ltr"><b>The Pietential Platform for Trusted Advisors</b></p></span><span>
<p dir="ltr"><span> </span></p><br>
<p dir="ltr"><span>The “PietentialTA” Platform allows trusted advisors to share Pietential with their clients and prospective clients. Those clients and prospective clients then have ability to share their Pietential results and progress with their advisor on an ongoing basis.</span></p> <span>
<p dir="ltr"> <span>Pietential TA is for life coaches, nutritionist and personal trainers, </span><span>business consultants, CVAs, exit planners and business brokers, </span><span>financial advisors and retirement planners. It helps you build trust more quickly, get into a conversation about about life balance, and stay better connected to your clients.</span></p></span>
<p dir="ltr"><b><br><span>Build Trust and Stay Connected with PietentialTA</span><span>™</span></b></p></span></div>
        <div class="innerFLEX" style="background: #eee;;"><p dir="ltr"><span><h3>PietentialENT™</h3></span></p>
<p dir="ltr"><b>The Pietential Platform for Population Well Being</b><br><br></p>
<p dir="ltr"> <span>The&nbsp;</span>“<span>PietentialENT</span>”<span>&nbsp;Platform is for Corporate Leadership, Human Resource Professionals, </span><span>Schools, School Systems, Colleges, Universities and University Systems, NPOs, NGOs, </span><span>Local, State and Federal Agencies who want to be able to </span><span>to visualize, quantify and better understand their population wellbeing, in order that they can take steps to improve it.</span></p>
<p dir="ltr"><span><br><b>Visualize Population Wellbeing with PietnetialENT™</b></span></p></div>
        
    </div>

    </div>



    <div class='bt green' onclick='moreForm()'>Contact Us</div><br>


<script>
    function moreForm(){
        document.getElementById(`contactForm`).style.display=`block`;
        document.getElementById('contactForm').scrollIntoView({
        behavior: 'smooth'
    });
    }
</script>


    <div id="additionalQuestions" style="display:none;">
        <BR><BR>
        <h2>Become a full member to see your progress:</h2>
        Pietential members gain access to progress reporting and other tools. There is no charge.<BR>You are logged in as <?php echo $master['email']; ?> <BR>
        <img src="sample.png" style="width:800px;" alt="">
        <BR>

        <form action="" method="post">

            <br>

            <input type="hidden" id="userIDform" name="userID">


            <input type="text" placeholder="Country of Origin (required)" id="countryOfOrigin" name="countryOfOrigin" style="margin-bottom:10px;" required><br>

            <br>
            <input type="text" placeholder="Country of Residence (required)" id="countryOfResidence" name="countryOfResidence" style="margin-bottom:10px;" required><br>

            <br>
            <input type="text" placeholder="City of Residence (required)" id="cityOfResidence" name="cityOfResidence" style="margin-bottom:10px;" required><br>

            <br>
            <input type="text" placeholder="Gender (required)" required id="gender" name="gender" style="margin-bottom:10px;"><br>

            <br>
            <input type="text" placeholder="Birth Year (required)" required id="birthYear" name="birthYear" style="margin-bottom:10px;"><br>

            <br>
            <input type="text" placeholder="Race (required)" required id="race" name="race" style="margin-bottom:10px;"><br>

            <br>
            <input type="text" placeholder="Education (required)" required id="education" name="education" style="margin-bottom:10px;"><br>

            <br>
            <input type="text" placeholder="Religion" id="religion" name="religion" style="margin-bottom:10px;"><br>

            <br>
            <input type="text" placeholder="Net Worth" id="netWorth" name="netWorth" style="margin-bottom:10px;"><br>

            <input type="checkbox" placeholder="" id="memberYes" name="memberYes" CHECKED value="1" style="width:unset;margin-bottom:10px;"> Become a member? <br>


            <input type="submit" value="Join">
            <br><br>Membership is free and gives you Access to Pietential's "Sice Tracker", and access to 100 of the Global View Survey Results.

        </form>

    </div>
</div>

</div>

<div style="text-align:center;">
    <!--<a id="" class="bt" style="background:black; font-size: 15px; padding: 10px 20px; display:inline-block; margin:50px;" href="/pielet/vote/?userID=<?php echo $userID; ?>">🗳️ Vote for new features</a>-->
</div>

<?php echo file_get_contents("../universal-footer.php"); ?>

<img src="https://pietential.com/pielet/create-email-table.php?img=1">
<img src="https://pietential.com/pielet/list.php?img=1">
<script>
    var pieletData = <?php echo $pieletDataJSON; ?>;
    localStorage.pieletDataJSON = JSON.stringify(pieletData);


    if (location.href.match(/\/?inspect/ig)) {
        document.body.innerHTML = localStorage.pieletDataJSON;
    }





    if (!pieletData.hash) {
        location.assign(`../create`);
    } else {

        //         function showlibar() {
        //             var loginStatus = ``;

        //             var proxyUser = `<a target="_blank" href='https://pietential.com/pielet/create/?userID=${pieletData.userID}'>Create your account</a>`;
        //             if (pieletData.hash) {
        //                 proxyUser = `Your account: <a href="https://pietential.com/pielet/dashboard/?userID=${pieletData.userID}" target="_blank">${pieletData.email}</a> <a href="/">Home page</a>`;
        //                 loginStatus = `<span style="text-align:left;position: absolute;left: 5px;font-size:15px;"> ${pieletData.email} <a class="bt" style="font-size: 15px; padding: 10px 20px;" href="/?logout">Logout</a></span> `;
        //             }
        //             var loginBar = `<div id="libar" class="libar" style="box-sizing: border-box;position:fixed;top:0px;height:45px;padding: 12px 27px; text-align:right;margin-right:20px;">${loginStatus} <a class="bt" style="font-size: 15px; padding: 10px 20px;" href="javascript: localStorage.returnToLatest=1;location.assign('/');
        // ">Return to latest evaluation</a> 

        // <a class="bt" style="font-size: 15px; padding: 10px 20px;" href="javascript: localStorage.retake=1;location.assign('/');
        // ">Retake and track your progress</a>

        // <a class="bt" style="font-size: 15px; padding: 10px 20px;" target="_blank" href="/?inspect">i</a></div>`;
        //             document.body.innerHTML += loginBar;
        //         }

        //         showlibar();
        var snapshots = pieletData.snapshots;
        //dash.innerHTML = JSON.stringify(snapshots).replace(/,/ig, `, `);
    }

    if (!pieletData.countryOfOrigin) {
        // show("additionalQuestions");
    }
    if (pieletData.hash) {
        show("dash");
        if (window.innerWidth > 1200 && pieletData.hash) {
            desktopnav.style.display = "block";
        }
        if (window.innerWidth < 1200 && pieletData.hash) {
            //navbarmobile.style.display = "block";
        }
    }

    function show(id) {
        document.getElementById(id).style.display = "block";
    }

    function hide(id) {
        document.getElementById(id).style.display = "none";
    }

    function buildPastCharts() {

document.getElementById("canvas").outerHTML = `<canvas id="canvas" class="UID:${pieletData.userID}"></canvas>`;
        var counter = 1;
        var times = [];
        var ar = [];
        for (let c of pieletData.snapshots) {
            var obj = {};
            obj.time = c.timestamp;
            for (let d in c) {
                if (d.match(/^Q/)) {
                    obj[d] = c[d];
                }
            }

            ar.push(obj);
            //past.innerHTML += counter + `. Timestamp: ` + obj.time + JSON.stringify(obj) + `<br>`;
            counter++;
        }
        // see if the latest form has been filled out
        if (pieletData.Q29response && pieletData.Q29response) {
            var currentResults = {};
            for (let d in pieletData) {
                if (d.match(/^Q/)) {
                    currentResults[d] = pieletData[d];
                }
            }
            currentResults.time = pieletData.completionDate;
            ar.push(currentResults);
        }
        console.log(ar);
        pieletData.ar = ar;
        var tcx = 2;
        var timelist = [];
        for (let t of ar) {


            var SA = 0;
            var EC = 0;
            var PN = 0;
            var LB = 0;
            var SN = 0;
            for (const property in t) {

                if (property.match(/Q0response|Q1response|Q2response|Q3response|Q4|Q5/g) && Number.isInteger(t[property])) {
                    SA += parseInt(t[property]) * 1.66;
                    SA = roundNumber(SA);
                }
                if (property.match(/Q6|Q7|Q8|Q9|Q10|Q11/g) && Number.isInteger(t[property])) {
                    EC += parseInt(t[property]) * 1.66;
                    EC = roundNumber(EC);
                }
                if (property.match(/Q12|Q13|Q14|Q15|Q16|Q17/g) && Number.isInteger(t[property])) {
                    LB += parseInt(t[property]) * 1.66;
                    LB = roundNumber(LB);
                }
                if (property.match(/Q18|Q19|Q20|Q21|Q22|Q23/g) && Number.isInteger(t[property])) {
                    //33-38
                    SN += parseInt(t[property]) * 1.66;
                    SN = roundNumber(SN);
                }
                if (property.match(/Q24|Q25|Q26|Q27|Q28|Q29/g) && Number.isInteger(t[property])) {
                    //40-45
                    PN += parseInt(t[property]) * 1.66;
                    PN = roundNumber(PN);
                }
                if (property.match(/time/g)) {

                    for (let tvf of timelist) {
                        if (t[property] == tvf) {
                            t[property] += " " + tcx;
                            tcx++;
                        }

                    }
                    var time = t[property];
                    timelist.push(time);
                    // console.log(time);
                }




            }
            if (SA) {
                var obj = {};
                obj.time = time;
                obj.SA = SA;
                obj.EC = EC;
                obj.LB = LB;
                obj.SN = SN;
                obj.PN = PN;

                times.push(obj); //gval()
                //console.log(obj);
            }

            var inputs = {
                min: 20,
                max: 80,
                count: 8,
                decimals: 2,
                continuity: 1
            };




            function shuffle(array) {
                var currentIndex = array.length,
                    temporaryValue, randomIndex;
                // While there remain elements to shuffle...
                while (0 !== currentIndex) {
                    // Pick a remaining element...
                    randomIndex = Math.floor(Math.random() * currentIndex);
                    currentIndex -= 1;
                    // And swap it with the current element.
                    temporaryValue = array[currentIndex];
                    array[currentIndex] = array[randomIndex];
                    array[randomIndex] = temporaryValue;
                }
                return array;
            }
            var part1color = `rgba(110, 148, 248, 1)`;
            var part2color = `rgba(2, 183, 45, 1)`;
            var part3color = `rgba(249, 186, 3, 1)`;
            var part4color = `rgba(248, 126, 2, 1)`;
            var part5color = `rgba(251, 0, 0, 1)`;

            var colorParts = [];
            colorParts.push(part1color);
            colorParts.push(part2color);
            colorParts.push(part3color);
            colorParts.push(part4color);
            colorParts.push(part5color);

            var timesar = [];
            var SAar = [];
            var PNar = [];
            var SNar = [];
            var LBar = [];
            var ECar = [];
            var timesar = [];
            for (var i = 0; i < times.length; i++) {
                timesar.push(times[i].time);
                SAar.push(times[i].SA);
                PNar.push(times[i].PN);
                SNar.push(times[i].SN);
                LBar.push(times[i].LB);
                ECar.push(times[i].EC);
            }

            var data = {
                labels: timesar,
                datasets: [{
                    backgroundColor: "rgba(9,0,0,0.1)",
                    borderColor: colorParts[0],
                    data: SAar,
                    // data: gloc[4],
                    label: 'Self Actualization',
                    fill: '-1'
                }, {
                    backgroundColor: "rgba(9,0,0,0.1)",
                    borderColor: colorParts[1],
                    data: ECar,
                    //data: gloc[2],

                    label: 'Self-Esteem and Contribution',
                    fill: '-1'
                }, {
                    backgroundColor: "rgba(9,0,0,0.1)",
                    borderColor: colorParts[2],
                    data: LBar,
                    //data: gloc[3],
                    label: 'Love and Belonging',
                    fill: '-1'
                }, {
                    backgroundColor: "rgba(9,0,0,0.1)",
                    borderColor: colorParts[3],
                    data: SNar,
                    //data: gloc[1],
                    label: 'Safety Needs',
                    fill: '0'
                }, {
                    backgroundColor: "rgba(9,0,0,0.1)",
                    borderColor: colorParts[4],
                    data: PNar,
                    //data: gloc[0],

                    label: 'Physiological Needs',
                    fill: '0'
                }, ]
            };

            console.log(data);

            var options = {
                maintainAspectRatio: false,
                spanGaps: false,
                elements: {
                    line: {
                        tension: 0.4
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    filler: {
                        propagate: false
                    },
                    'samples-filler-analyser': {
                        target: 'chart-analyser'
                    }
                }
            };

            var chart = new Chart('canvas', {
                type: 'line',
                data: data,
                options: options
            });

            // eslint-disable-next-line no-unused-vars
            function togglePropagate(btn) {
                var value = btn.classList.toggle('btn-on');
                chart.options.plugins.filler.propagate = value;
                chart.update();
            }

            // eslint-disable-next-line no-unused-vars
            function toggleSmooth(btn) {
                var value = btn.classList.toggle('btn-on');
                chart.options.elements.line.tension = value ? 0.4 : 0.000001;
                chart.update();
            }

            // eslint-disable-next-line no-unused-vars
            function randomize() {
                chart.data.datasets.forEach(function(dataset) {
                    dataset.data = generateData();
                });
                chart.update();
            }
        }

    }

    if (pieletData.snapshots) {
        buildPastCharts();
        buildPastPieCharts();
    }

    function buildPastPieCharts() {
        //pastPieCharts.innerHTML = JSON.stringify(pieletData.ar);
    }


    function roundNumber(n) {
        n = Math.round(n);
        if (n > 98) {
            n = 100;
        }
        if (n == 59 || n == 58) {
            n = 60;
        }
        return (n);
    }
    navigator.geolocation.getCurrentPosition(showPosition);

    function showPosition(position) {
        pieletData.geolocationLong = position.coords.longitude;
        pieletData.geolocationLat = position.coords.latitude;
    }
    userIDform.value = pieletData.userID;

    function drawChart(canvas, b, l, a, c, k) {

        var ctx = document.getElementById(canvas).getContext('2d');
        var part1color = `rgba(110, 148, 248, 1)`;
        var part2color = `rgba(2, 183, 45, 1)`;
        var part3color = `rgba(249, 186, 3, 1)`;
        var part4color = `rgba(248, 126, 2, 1)`;
        var part5color = `rgba(251, 0, 0, 1)`;
        var alphaValue = .5;
        var alphaValue = 1;
        var border1 = part1color;
        var border2 = part2color;
        var border3 = part3color;
        var border4 = part4color;
        var border5 = part5color;
        var fill1 = part1color.replace(" 1)", `${alphaValue})`);
        var fill2 = part2color.replace(" 1)", `${alphaValue})`);
        var fill3 = part3color.replace(" 1)", `${alphaValue})`);
        var fill4 = part4color.replace(" 1)", `${alphaValue})`);
        var fill5 = part5color.replace(" 1)", `${alphaValue})`);
        var ls = ['Self Actualization', 'Esteem and Contribution', 'Love and Belonging', 'Safety Needs', 'Physiological Needs'];
        var myChart = new Chart(ctx, {
            //type: toggle,
            type: 'polarArea',
            data: {
                labels: ls,
                datasets: [{
                    label: 'Score',
                    data: [b, l, a, c, k],
                    backgroundColor: [
                        fill1,
                        fill2,
                        fill3,
                        fill4,
                        fill5
                    ],
                    borderColor: [
                        border1,
                        border2,
                        border3,
                        border4,
                        border5
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                // watermark: {
                //     image: "watermark.png",

                //     alignY: "bottom",
                //     alignX: "right",
                //     width: "20%",
                //     height: "22%",
                //     position: "back",
                // },
                scale: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            display: false
                        }
                    }]
                }
            }
        });



    }
    var n = 0;
    for (let t of pieletData.ar) {
        var SA = 0;
        var EC = 0;
        var PN = 0;
        var LB = 0;
        var SN = 0;

        for (const property in t) {
            //console.log(property);
            if (property.match(/Q0response|Q1response|Q2response|Q3response|Q4|Q5/g) && Number.isInteger(t[property])) {
                SA += parseInt(t[property]) * 1.66;
                SA = roundNumber(SA);
            }
            if (property.match(/Q6|Q7|Q8|Q9|Q10|Q11/g) && Number.isInteger(t[property])) {
                EC += parseInt(t[property]) * 1.66;
                EC = roundNumber(EC);
            }
            if (property.match(/Q12|Q13|Q14|Q15|Q16|Q17/g) && Number.isInteger(t[property])) {
                LB += parseInt(t[property]) * 1.66;
                LB = roundNumber(LB);
            }
            if (property.match(/Q18|Q19|Q20|Q21|Q22|Q23/g) && Number.isInteger(t[property])) {
                //33-38
                SN += parseInt(t[property]) * 1.66;
                SN = roundNumber(SN);
            }
            if (property.match(/Q24|Q25|Q26|Q27|Q28|Q29/g) && Number.isInteger(t[property])) {
                //40-45
                PN += parseInt(t[property]) * 1.66;
                PN = roundNumber(PN);
            }
        }
        drawChart(`csnap${n}`, SA, EC, LB, SN, PN);
        n++;

    }
</script>