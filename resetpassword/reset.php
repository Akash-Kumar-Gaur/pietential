<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');

function createResetCode()
{
    $_ = 'A,S,D,V,M,R,m,n,b,v,c,x,z,a,s,d,f,g,h,j,k,l,p,o,i,u,y,t,r,e,w,q,0,9,8,7,6,5,4,3,2,1';
    $e = explode(",", $_);
    shuffle($e);
    $i = 0;
    $np = '';
    while ($i < 15) {
        $np .= $e[$i];
        $i++;
    }
    // now we have a unique reset code.
    // add it to the users data and save.
    return ($np);
}

// https://pietential.com/resetpassword/reset.php?reset=i7hztAgpscbwdyv&email=Oren.Hubert@mailstripe.com&userID=9XWvfZ5nN2ts&NP=n7sjkf83kfncvsdk9
// reset xMrgmda1v0hqn9l

// https://pietential.com/resetpassword/reset.php?reset=xMrgmda1v0hqn9l&email=Oren.Hubert@mailstripe.com&userID=9XWvfZ5nN2ts <<-- authenticated

// Oren.Hubert@mailstripe.com>n7sjkf83kfncvsdk9
// newpassword n7sjkf83kfncvsdk9
// reset@silvercrayon.com
if ($newPassword && $userID && $reset && $mode){
    $pieletData = json_decode(file_get_contents("../pielet/ids/$userID.json.txt"), true);
    if (!$pieletData) {
        exit("there was a problem: error P9X7126"); // big error for reset@sliver
    }
    if (!$pieletData['salt']) {
        exit("there was a problem: error SAL126");
    }
    if ($reset == $pieletData['reset']) {
        $hash = hash('whirlpool', $newPassword.$pieletData['salt']);
        $pieletData['hash'] = $hash;
        file_put_contents("../pielet/ids/$userID.json.txt", json_encode($pieletData));
        exit("Success - Your password has been changed<br>Checksum: $hash");
    }
}

if ($reset && $email && $userID) {
    // https://pietential.com/resetpassword/reset.php?email=hank@silvercrayon.com&userID=lc5xgiro4ze8ntp
    $j2 = file_get_contents("../pielet/ids/$userID.json.txt");
    $pieletData = json_decode($j2, true);
    if (!$pieletData) {
        exit("there was a problem: error 2334FD6");
    }
    if ($reset == $pieletData['reset']) {

        // ok things check out
        // create a new password
        $page = file_get_contents("reset-form.html");
        $s = "localStorage.resetCode = '$reset';localStorage.pieletDataJSON = '$j2';";
        $page = str_replace("SCRIPPY", $s,$page );
       
        exit($page);
    } else {
        exit("there was a problem: error 221HGG6");
    }
}

function sendMlor($subject, $message, $sendername, $toemail, $senderemail)
{
    if ($message == strip_tags($message)) {
        $message = str_replace("\r\n", "\n", $message);
        $message = str_replace("\n", "<br>\r\n", $message);
    }
    $url = 'http://mg.silvercrayon.us/mlor/';
    $data['subject'] = $subject;
    $data['message'] = $message;
    $data['sendername'] = $sendername;
    $data['toemail'] = $toemail;
    $data['senderemail'] = $senderemail;
    $options['http']['header'] = "Content-type: application/x-www-form-urlencoded\r\n";
    $options['http']['method'] = "POST";
    $options['http']['content'] = http_build_query($data);
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
//     header('Content-Type: image/gif');
// echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
}

if($emailConfirm){
    error_reporting(E_ALL);
    //https://pietential.com/resetpassword/reset.php?emailConfirm=hank.mitchell@gmail.com 
    echo "Trying $emailConfirm ...<br>";
    $file = file_get_contents("../pielet/ids/emailTable.json.txt");
    $eData = json_decode($file, true);
    $notFound = "yes";
    $pieletData = "null";
    $z = 0;
    foreach ($eData as $k => $v) {
        if ($emailConfirm == $k) {
            $userID = $v;
            $notFound = "found it";
            $pieletData = file_get_contents("../pielet/ids/$userID.json.txt");
            echo $notFound;
            exit($pieletData);
        }
    }
}



if ($email) {
    $file = file_get_contents("../pielet/ids/emailTable.json.txt");
    $eData = json_decode($file, true);
    $noEmail = 'yes';
    foreach ($eData as $k => $v) {
        if ($email == $k) {
            $noEmail = '';
            $userID = $v;
            $pieletData = file_get_contents("../pielet/ids/$userID.json.txt");
            $resetCode = createResetCode();
            $pieletData = json_decode($pieletData, true);
            $pieletData['reset'] = $resetCode;
            $pieletData['resetTime'] = $timestamp;
            file_put_contents("../pielet/ids/$userID.json.txt", json_encode($pieletData));
            $magicLink = "https://pietential.com/resetpassword/reset.php?userID=$userID&email=$email&reset=$resetCode";
            // mail the link
            $subject = "Pietential Password Reset";
            $message = "Hi $email, \r\n\r\n\rYour password can be reset by visiting this link:\n\n$magicLink";
            $sendername = "Pietential Support";
            $toemail = $email;
            $senderemail = "PietentialSupport@mg.silvercrayon.us";
            sendMlor($subject, $message, $sendername, $toemail, $senderemail);
            // exit("success for user $userID - $email - $timestamp - $resetCode");
            exit("success");
        }
    }
    if ($noEmail) {
        exit("$email Not found in database! Error G6651A");
    }
}
//wZCrSMf2QRY1&email=hank.mitchell@gmail.com&reset=0gsnerpkczxfVwD
exit();

    // $file = file_get_contents("../pielet/ids/$userID.json.txt");
    // $pieletData = json_decode($file, true);
    // // check orig password
    // $hashCheck = $currentpassword . $pieletData['salt'];
    // $hashCheck = hash('whirlpool', $hashCheck);
    // if ($pieletData['hash'] == $hashCheck) {
    //     // authenticated
    //     $newHash = $newpassword . $pieletData['salt'];
    //     $newHash = hash('whirlpool', $newHash);
    //     $pieletData['hash'] = $newHash;
    //     file_put_contents("../pielet/ids/$userID.json.txt", json_encode($pieletData));
    //     echo "AUTHENTICATED - $hash";
    // } else {
    //     echo "FAIL";
    // }
