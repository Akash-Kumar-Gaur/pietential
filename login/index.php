<?php
extract($_GET);
extract($_POST);
// cloudburst@silvercrayon.com
// ak1a*wt%vbnX
$shell = file_get_contents("../shell/shell.html");
if($_COOKIE['email']){
    $_ = $shell;
    $e = $_COOKIE['email'];
    $message = "You appear to be logged in as $e. If you want to log in as a different user, please log out first.";
    $_ = str_replace("{{content}}", $message, $_);
    exit($_);
}

if (!$email && !$password) {
    setcookie('account', "", time() + -7, "/");
    setcookie('userID', "", time() + -7, "/");
    setcookie('partnerID', "", time() + -7, "/");
}
if ($email && $password) {
    $_ = file_get_contents("../pielet/email-table.json");
    if (!preg_match('/' . $email . '/im', $_)) {
        exit("That email is not  in our records, please <a href='/login'>enter your email</a>.");
    } else {
        $master = json_decode($_, true);
        foreach ($master as $obj) {
            if ($obj['email'] == $email) {
                $a = $obj['userID'];
                $b = file_get_contents("../pielet/ids/$a.json.txt");
                $udata = json_decode($b, true);
                $hash = trim($password) . $udata['salt'];
                $challengeHash = hash('whirlpool', $hash);
                if ($challengeHash == $udata["hash"]) {
                    // user is authenticayed
                    setcookie('account', $udata["account"], time() + 7776000, "/"); //90 days
                    setcookie('userID', $udata["userID"], time() + 7776000, "/"); //90 days
                    setcookie('email', $email, time() + 7776000, "/");
                    echo "<script>
                    localStorage.pieletDataJSON = `$b`;
                    //alert(`Login successful! Your user ID is $a`);
                    location.assign(`https://pietential.com/?userID=$a`);
                </script>
                <a href='/'><button>Continue to Pietential</button></a><BR><BR>";
                exit($dcxsdcx);
                } else {
                    exit("Bad username or password");
                }
            }
        }
    }
}

$message = '  <h2>Login:</h2>
<form action="" method="POST" style="text-align:center;">
     <BR>
    <input placeholder="Enter your email address:" type="email" id="email" name="email"><BR>
    <input placeholder="Enter your password:" type="password" id="password" name="password"><BR>
    <input value="submit" type="submit"><BR><br>
    If you are an administrator, please use the admin login below. New users need to create an account first.<br><br>
    <a href="https://pietential.com/pielet/admin/adminlogin/">Admin login</a> | 
   <a href="/#pietential-sign-up">Create an account</a><BR>
</form>

<img src="https://pietential.com/pielet/create-email-table.php?img=1">
<img src="https://pietential.com/pielet/list.php?img=1">';

$shell = str_replace("{{content}}", $message, $shell);
exit($shell);

?>

