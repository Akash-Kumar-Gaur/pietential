<?php
// may 2022
// hank mitchell - @hankenstein
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');

// secret key is not in use (may 2022)
$skh = 'd1b0292e5f6821925b1806cb5aaa15e3bd515f95c97ddf1cfadc857468e68296a1c708347316c1978b5990c963a325e9264d3541b7e5d04081512e94aea2bcff';
// you can find the secret key by looking for the file AWS 2021 Pietential.txt
// its not stored anywhere on the server
if ($_POST['secretKey']) {
    if (hash('whirlpool', $secretKey) !== $skh) {
        exit('bad skh creds');
    }
}
// PILLARS
// EVOLUTIONOFBRAND
// john is giving out promo codes
// so they are stored in a plain txt file for occaisional updating
// the proguest property allows to use for free
// by setting $purchaseCode == "realized"
// $promoCodes = file_get_contents('promo-codes.txt');
// $promoCodesArray = explode(",", $promoCodes);
// foreach ($promoCodesArray as $k => $v) {
//     if (preg_match('/' . $v . '/ism', $promoCode)) {
//         setcookie('proguest', $promoCode, time() + 7776000, "/"); //90 days
//         $proguest = $promoCode;
//     }
// }


// the purchase code is a simple way to assign the user
// to their level of service.
// the code is revealed to them 
// after a credit card payment (at stripe)


// june 9 2022 make all users pro users
if (!$purchaseCode || !preg_match('/realized|pillars|meaning|wellness/ism', $purchaseCode)){
   // $purchaseCode = "realized";
}
// end june 9 adjustment


if (preg_match('/wellness|meaning/i', $promoCode)){
    $purchaseCode = $promoCode;
}


if ($purchaseCode) {
    $purchaseCode = trim(strtolower($purchaseCode));
    if (!$_COOKIE['userID']) {
        //$purchaseURL = "https://pietential.com/pielet/promocode/";
        //exit("You are not logged in. Make sure you are logged in and re-apply the purchase code here: <a href='$purchaseURL'>$purchaseURL</a>.");
        $pieletData['userID'] = getrandom(12);
    } else {
        $pieletData = returnUserDataFull($_COOKIE['userID']);
    }

    $purchaseCode = strtolower($purchaseCode);
    if (preg_match('/pillars/ig', $purchaseCode)) {
        $purchaseCode = 'realized';
    }
    $pieletData['purchaseCode'] = $purchaseCode;
    //pieletData.
    // these are the 3 passwords
    $continueURL = "/";

    if ($purchaseCode == "realized" || $purchaseCode == "pillars"  || $purchaseCode == "meaning" || $purchaseCode == "wellness") {
        $pieletData['userLevel'] = "pro";
        $pieletData['fname'] = $fname;
        $pieletData['lname'] = $lname;
        $pieletData['email'] = $email;
        $pieletData['userID'] = $userID;
        setcookie('applyThirds', "1", time() + 77760000, "/"); //90 days
        if ($purchaseCode == "realized") {
            $pieletData['purchaseLevel'] = "pro";
            $continueURL = "/pielet/dashboard/?pro";
            savePowerUser($continueURL,$pieletData,$userID);
            exit;
        }
        if ($purchaseCode == "meaning") {
            $pieletData['purchaseLevel'] = "advisor";
            $continueURL = "/pielet/admin/create/?advisor";
            savePowerUser($continueURL,$pieletData,$userID);
            exit;
        }
        if ($purchaseCode == "wellness") {
            $pieletData['purchaseLevel'] = "business";
            $continueURL = "/pielet/admin/create/?business";
            savePowerUser($continueURL,$pieletData,$userID);
            exit;
        }
    
    //      write the user data as a json str on the file system
    //     $pieletDataJSON = json_encode($pieletData);
    //     file_put_contents("../ids/$userID.json.txt", $pieletDataJSON);
    //     exit("$pageOut <section style='padding:70px;'>
    // <b>Your account has been upgraded</b>.<br> As a Pientential Pro member, you can now retake the survey and track your progress. If you are business or advisor member, you can start inviting clients with your company code. <a href='$continueURL'>Click to continue</a></section>
    // <script> localStorage.pieletDataJSON = `$pieletDataJSON`;
    // </script>");
    } else {
        // exit("There was a problem with the promo code you entered. 
        // Please use the contact form to contact customer service.");
    }
}

function savePowerUser($continueURL,$pieletData,$userID){
    $pieletDataJSON = json_encode($pieletData);
    file_put_contents("../ids/$userID.json.txt", $pieletDataJSON);
    exit("<script>
    localStorage.pieletDataJSON = `$pieletDataJSON`;
    location.assign(`$continueURL`)</script>");
}

// detect multiple account requests and build json array of accounts
if (preg_match('/,/', $getAPI)) {
    foreach (explode(",", $getAPI) as $n) {
        $arr[] = returnUserData($n);
    }
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    exit(json_encode($arr));
    //e.g. https://pietential.com/pielet/accountEngine/?getAPI=zGX676w1F2ry,pKAC2N6ttAXR
}

// simple single account data returned
if ($getAPI) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    exit(json_encode(returnUserData($getAPI)));
}

// returns the full user data including personal info
function returnUserDataFull($userID)
{
    $pd = @file_get_contents("../ids/$userID.json.txt");
    $master = json_decode($pd, true);
    return ($master);
}

// returns partial user data -no personal info
function returnUserData($userID)
{
    $pd = @file_get_contents("../ids/$userID.json.txt");
    $master = json_decode($pd, true);
    if ($master['snapshots']) {
        foreach ($master['snapshots'] as $k => $v) {
            $SA  = 0;
            $EC  = 0;
            $LB  = 0;
            $SN  = 0;
            $PN  = 0;
            $date['time'] = $v['timestamp'];
            foreach ($v as $x => $y) {
                if (preg_match('/Q0response|Q1response|Q2response|Q3response|Q4|Q5/ism', $x)) {
                    $SA += (intval($y) * 1.6666);
                }
                if (preg_match('/Q6|Q7|Q8|Q9|Q10|Q11/ism', $x)) {
                    $EC += (intval($y) * 1.6666);
                }
                if (preg_match('/Q12|Q13|Q14|Q15|Q16|Q17/ism', $x)) {
                    $LB += (intval($y) * 1.6666);
                }
                if (preg_match('/Q18|Q19|Q20|Q21|Q22|Q23/ism', $x)) {
                    $SN += (intval($y) * 1.6666);
                }
                if (preg_match('/Q24|Q25|Q26|Q27|Q28|Q29/ism', $x)) {
                    $PN += (intval($y) * 1.6666);
                }
            }
            $date['SA'] = round($SA);
            $date['EC'] = round($EC);
            $date['LB'] = round($LB);
            $date['SN'] = round($SN);
            $date['PN'] = round($PN);
            $ss[] = $date;
        }
    }
    $api['userID'] = $userID;
    $api['PN'] = $master['PN'];
    $api['SA'] = $master['SA'];
    $api['EC'] = $master['EC'];
    $api['LB'] = $master['LB'];
    $api['SN'] = $master['SN'];
    $api['snapshots'] = $ss;
    return ($api);
}

// handle lookup request
// https://pietential.com/pielet/accountEngine/?getInfo=93k8dWREM4Ga
if ($getInfo) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    $pd = @file_get_contents("../ids/$getInfo.json.txt");
    if ($pd) {
        exit($pd);
    }
}

// return all users (if it is small enough)
// at some point around 100000 users it may cease to work.

if ($getAll && $_COOKIE['adminID']) {
    $k = file_get_contents("../ids/make-all.php");
    exit(file_get_contents("../ids/all.json"));
    // $arr = glob("../ids/*");
    // foreach($arr as $_){
    //     $data = file_get_contents($_);
    //     if (preg_match('/promoCode/', $data)){

    //     }
    // }
}

// handle contact form
if ($TYPE) {
    $inf = json_encode($_POST);
    file_put_contents("contact-$email.json.txt", json_encode($_POST));
    exit("Thanks! We will be in touch.");
}

// update temp user



// create new account
if ($userID && $email && $password) {
    // remind them if they already have an account
    // if ($pieletData['email']) {
    //     $e = $pieletData['email'];
    //     exit("Your email is $e. <a href='/'>Continue</a>");
    // }

    if($agreeToTerms!=="Iagree"){
        exit("You must agree to the terms of use to use this site. Use the back button to update.");
    }

    if ($promoCode) {
        // this needs to be adjusted so the promo code is
        // simply the company name
        $_ = file_get_contents('../admin/codex/all.json');
        if (!preg_match('/' . $promoCode . '/', $_)) {
            echo ("That's not a valid code, please use a new promo code.");
            exit;
        } else {
            //$theCompanyName = substr($promoCode, 0, strlen($promoCode) - 5);
            $theCompanyName = trim($promoCode);
            $w = file_get_contents("../ids/all.json");
            $e['admins'] = json_decode($w, true);
            foreach ($e as $k => $v) {
                if ($v['companyList']) {
                    foreach ($v['companyList'] as $z => $h) {
                        if ($h['companyCode'] == $theCompanyName) {
                            $pieletData['company'] = $theCompanyName;
                            $pieletData['partnerID'] = $k;
                        }
                    }
                }
            }
            $pieletData['promoCode'] = $promoCode;
        }
    }

    $salt = getrandom(32);
    $hash = $password . $salt;
    $hash = hash('whirlpool', $hash);
    //$pieletData = json_decode(@file_get_contents("../ids/$userID.json.txt"), true);
    $pieletData['salt'] = $salt;
    $pieletData['hash'] = $hash;
    $pieletData['email'] = $email;
    $pieletData['purchaseCode'] = $purchaseCode;
    $pieletData['promoCode'] = $promoCode;
    $pieletData['fname'] = $fname;
    $pieletData['lname'] = $lname;
    $pieletData['userLevel'] = "pro";
    if ($proguest) {
        $pieletData['proguest'] = $proguest;
        $pieletData['userLevel'] = "pro";
    }

    $pieletData['phone'] = $phone;
    $pieletData['title'] = $title;
    $pieletData['website'] = $website;
    $pieletData['userID'] = $userID;
    $pieletData['joinDate'] = $timestamp;
    //businessCategories
    $pieletData['businessCategories'] = $businessCategories;
    $jaypay = json_encode($pieletData);
    file_put_contents("../ids/$userID.json.txt", $jaypay);
    setcookie('userID', $userID, time() + 7776000, "/"); //90 days
    setcookie('email', $email, time() + 7776000, "/"); //90 days
    setcookie('fname', $fname, time() + 7776000, "/"); //90 days
    //exit($jaypay);
    echo "<script>
    
    localStorage.pieletDataJSON = `$jaypay`;
    location.assign(`../survey/?new&$theCompanyName&$k&$promoCode`);
    
    </script>";
    //header("Location: ../survey/?new-account-created");
    exit;
}

if($userID && $allowID){
    if (!$_COOKIE['userID']) {
        exit('not allowed u');
    }
    if (file_exists("../ids/$userID.json.txt")) {
        $pieletData = json_decode(file_get_contents("../ids/$userID.json.txt"), true);
        $pieletData['allowID'] = $allowID;
        $jaypay = json_encode($pieletData);
        file_put_contents("../ids/$userID.json.txt", $jaypay);
        echo "user updated, value is $allowID<br>";
        exit;
    }

}


// handle general account update
if ($pdpost) {
    /* typical new user cookies
        '[{"userID":"x8F5jTpYGvKe"},{"percent":"96"},{"_ga":"GA1.2.1710183737.1634742278"},{"adjustfilepath":"aws"},{"_gid":"GA1.2.1512720698.1640374694"},{"email":"Isiah.Ty%40mailstripe.com"},{"fname":"Isiah"},{"_gat_gtag_UA_117957204_2":"1"}]'
        */
    // authenticate user by looking for a cookie and some other things
    // this is not high security
    if (!$_COOKIE['userID']) {
        exit('not allowed u');
    }
    if (!$_COOKIE['percent']) {
        //exit('not allowed p');
    }
    //print_r( $pieletData);
    $pdreveal = base64_decode($pdpost);
    
    $master = json_decode($pdreveal, true);
    $master['timestamp'] = $timestamp;
    $master['accountEngine'] = "yes";
    $master['purchaseCode'] = "realized"; //pieletData.userLevel
    $master['userLevel'] = "pro";
    //$userID = $master['userID'];
    $userID = $master['userID'];
    $j = json_encode($master);
    if ($userID) {
        file_put_contents("../ids/$userID.json.txt", $j);
        echo "User Data written - $j";
    } else {
        echo "User Data NOT written - $j";
    }
    exit;
}

// build the relationship between the business account and the users
if ($buildCodex) {
    // https://pietential.com/pielet/accountEngine/?buildCodex=334
    $master = [];
    $_ = glob("../admin/adminlogin/ids/*.json.txt");
    foreach ($_ as $f) {
        $x = json_decode(file_get_contents($f), true);
        if (strlen($x['companyCode']) > 2) {
            $master[] = $x['companyCode'];
        }
        foreach ($x['companyList'] as $p) {
            if (strlen($p) > 2) {
                $master[] = $p;
            }
        }
    }
    $js = json_encode($master);
    echo $js;
    if (strlen($js) > 8) {
        file_put_contents("../admin/codex/all.json", json_encode($master));
        $master = [];
        $p = glob("../admin/adminlogin/ids/*.json.txt");
        foreach ($p as $c) {
            $partnerID = str_replace(".json.txt", "", $c);
            $partnerID = str_replace("../admin/adminlogin/ids/", "", $partnerID);
            $master[$partnerID] = json_decode(file_get_contents($c), true);
        }
        file_put_contents("../admin/adminlogin/ids/all.json", json_encode($master));
        exit;
    } else {
        exit("not enough characters - empty database");
    }
}



// handle user who doesnt remember email but has ID
if ($_COOKIE['userID']) {
    $userID = $_COOKIE['userID'];
    if (file_exists("../ids/$userID.json.txt")) {
        $pieletData = json_decode(file_get_contents("../ids/$userID.json.txt"), true);
        $userID = $pieletData['userID'];
        if ($pieletData['email']) {
            $e = $pieletData['email'];
            exit("Your email is $e. <a href='/'>Continue</a>");
        }
    }
}

function getrandom($n)
{
    $g = str_split("abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ");
    $v = 0;
    $r = "";
    while ($v < $n) {
        shuffle($g);
        $r .= $g[0];
        $v++;
    }
    return ($r);
}


$r = getrandom(28);
header("Location: /?no-creds-passed-$r");
