<?php
extract($_GET);
extract($_POST);


if ($TYPE){
    $inf = json_encode($_POST);
    file_put_contents("contact-$email.json.txt", json_encode($_POST));
    exit("Thanks! We will be in touch.");

}


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


//echo (json_encode($_POST)); exit;


if ($userID && $email && $password) {
    //echo (json_encode($_POST));
    if ($pieletData['email']) {
        $e = $pieletData['email'];
        exit("Your email is $e. <a href='/'>Continue</a>");
    }
   
    $salt = getrandom(32);
    $hash = $password . $salt;
    $hash = hash('whirlpool', $hash);
    $pieletData = json_decode(file_get_contents("../ids/$userID.json.txt"), true);
    $pieletData['salt'] = $salt;
    $pieletData['hash'] = $hash;
    $pieletData['email'] = $email; //promoCode
    $pieletData['promoCode'] = $promoCode;
    $pieletData['fname'] = $fname;
    $pieletData['lname'] = $lname;
    $pieletData['company'] = $company;
    $pieletData['phone'] = $phone;
    $pieletData['title'] = $title;
    $pieletData['website'] = $website;
    $pieletData['userID'] = $userID;
    //businessCategories
    $pieletData['businessCategories'] = $businessCategories;
    file_put_contents("../ids/$userID.json.txt", json_encode($pieletData));
    setcookie('userID', $userID, time() + 7776000, "/"); //90 days
    setcookie('email', $email, time() + 7776000, "/"); //90 days
    setcookie('fname', $fname, time() + 7776000, "/"); //90 days
    header("Location: ../survey/?new-account-created");
    exit;
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



header("Location: /?no-creds-passed-he662hsve");

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<link href="/pielet/styles.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">

<body>

    <div style="max-width:500px; padding:20px;text-align:center;margin:auto;">
        <div style="margin:auto;">
            <div style="display:none"><?php echo json_encode($pieletData)  ?></div>
            <h2>Create account:</h2>
            <form action="" method="POST">
                <br>
                <input type="hidden" id="userID" name="userID" value="<?php echo $userID; ?>">
                <input placeholder="Enter your first name:" type="text" id="fname" name="fname" required>
                <input placeholder="Enter your email address:" type="email" id="email" name="email" required><br>
                <!--<input placeholder="Enter your password:" type="password" id="password" name="password"><br>-->
                <input value="submit" type="submit"><br>
            </form>
            <img src="https://pietential.com/pielet/create-email-table.php?img=1">
            <img src="https://pietential.com/pielet/list.php?img=1">


        </div>
    </div>

</body>

</html>