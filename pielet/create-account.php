<?php
extract($_GET);
extract($_POST);
$html = file_get_contents("shell2.html");

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

if ($emailChallenge) {
    $_ = file_get_contents("email-table.json");
    if (!preg_match('/' . $email . '/im', $_)) {
        exit("That email is not  in our records, please <a href='/'>enter your email</a>.");
    } else{
        $master = json_decode($_, true);
        $i =0;
        foreach($master as $obj){
            $email = $obj[email];
            $userID = $obj[userID];
            echo "$email=>$userID<br>\n";
            if ($emailChallenge == $email){
                
                exit("Your user ID is $userID");
            }
            $i++;
        }
    }
}

if ($login) {
    $form = '<h2>Login:</h2><form action="" method="POST">
    Enter your email address: 
    <input type="email" id="emailChallenge" name="emailChallenge">
    <input type="submit">
</form>';
    $html = str_replace("{{content}}", $form, file_get_contents("shell2.html"));
    exit($html);
}

if ($email) {
    checkForUser($email);
    if ($password) {
        $salt = getrandom(65);
        $hash = $password . $salt;
        $hash = hash('whirlpool', $hash);
        $master = json_decode(file_get_contents("$userID.json.txt"), true);
        $master[salt] = $salt;
        $master[hash] = $hash;
        file_put_contents("$userID.json.txt", json_encode($master));
        //echo "salt is $salt. hash is $hash";
    }
    header("Location: ?saved");
    exit();
}

function checkForUser($email)
{
    $email = trim($email);
    if (!preg_match('/' . $email . '/im', file_get_contents("email-table.json"))) {
        exit("That email is not  in our records, please <a href='/'>enter your email</a>.");
    }
}

?>
<div id="signup">
    Create Account:
    <form action="" method="POST">
        User email: <br>
        User ID: <br>
        <input type="email" id="email" name="email"><br>
        <input type="password" name="password" placeholder="Choose a password"><br><input name="userID" id="userID" type="hidden">
        <input type="submit">

    </form>
    <img src="https://pietential.com/pielet/create-email-table.php?img=1">
</div>
<script>
    pieletData = JSON.parse(localStorage.pieletDataJSON);
    document.addEventListener("DOMContentLoaded", function(event) {
        shellContent.innerHTML = signup.innerHTML;
        signup.innerHTML = "";
        email.value = pieletData.email;
        userID.value = pieletData.userID;
        shellContent.style.maxWidth = "500px";

    });
</script>
<?
exit($html);



$_ = glob("./*");
// https://pietential.com/pielet/create-email-table.php?img=1
foreach ($_ as $r) {
    if (preg_match('/.\.json\.txt/ism', $r)) {

        $obj = json_decode(file_get_contents($r), true);
        if ($obj[userID]) {
            $obj2[userID] = $obj[userID];
            $obj2[email] = $obj[email];
            $master[] = $obj2;
            $reel .= $obj[email] . ":" . $obj[userID] . "<br>\n";
        }
    }
}

file_put_contents("email-table.json", json_encode($master));
if ($img) {
    header('Content-Type: image/gif');
    echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
    exit;
}
echo $reel;
echo "<br>";
echo json_encode($master);