<?php
$adminhash = '';
extract($_GET);
extract($_POST);
//error_reporting(E_ALL);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
$shell = file_get_contents("../../../shell/shell.html");
if (!$adminID) {
    $adminID = $_COOKIE['adminID'];
}

if($updateThreshold){
    if (!$adminID) {
        exit;
    }
    $adminData = json_decode(file_get_contents("ids/$adminID.json.txt"), true);
    $th = intval(trim($updateThreshold));
    if ($th<10) {
        exit;
    }
    $adminData['triggerThreshold'] = $th;
    file_put_contents("ids/$adminID.json.txt", json_encode($adminData));
}

if ($getCompanyList && $adminID){
    exit(file_get_contents("ids/$adminID.json.txt"));
}


// add a new company for the administrator
if($addNewCompany){
    if (!$adminID) {
        exit;
    }
    $c = json_decode($addNewCompany);
    $adminData = json_decode(file_get_contents("ids/$adminID.json.txt"), true);
    $adminData['companyList'][] = $c;
    file_put_contents("ids/$adminID.json.txt", json_encode($adminData));
}


if ($adminID && $adminhash) {
    $adminData = json_decode(file_get_contents("ids/$adminID.json.txt"), true);
    if ($adminData['adminhash'] == $adminhash) {
        setcookie('adminID', $adminID, time() + 7776000, "/"); //90 days
        echo "<script> location.assign(`../?adminID=$adminID`); </script>";
        exit;
    }
}

// ?createAdmin=1&adminID=demo&password=1234&adminFullName=Demo UserAccount
// ?createAdmin=1&adminID=johnstarling&password=8ehd2nbb47d9vsdz&adminFullName=John Starling
// ?createAdmin=1&adminID=organic&password=1234&adminFullName=Hank Mitchell





if ($createAdmin && $adminID && $password) {
    $acat = "adminID,adminFullName,adminhash,email,promoCode,fname,lname,company,phone,title,website,joinDate,businessCategories";
    $salt = getrandom(32);
    $hash = $password . $salt;
    $hash = hash('whirlpool', $hash);
    $adminData['adminFullName'] = $adminFullName;
    $adminData['salt'] = $salt;
    $adminData['adminhash'] = $hash;
    $adminData['email'] = $email;
    $adminData['promoCode'] = $promoCode;
    $adminData['companyCode'] = $companyCode;
    $adminData['companyList'][] = $companyCode;
    $adminData['fname'] = $fname;
    $adminData['lname'] = $lname;
    $adminData['company'] = $company;
    $adminData['phone'] = $phone;
    $adminData['title'] = $title;
    $adminData['website'] = $website;
    $adminData['adminID'] = $adminID;
    $adminData['joinDate'] = $timestamp;
    //businessCategories
    $adminData['businessCategories'] = $businessCategories;
    $jaypay = json_encode($adminData);
    file_put_contents("ids/$adminID.json.txt", $jaypay);
    setcookie('adminID', $adminID, time() + 7776000, "/"); //90 days
    exit("Account created. <a href='../'>Click here to continue</a>.<br><br>
    <img src='https://pietential.com/pielet/accountEngine/?buildCodex=334' style='display:none;'>");
    
    
}









if ($adminID && $password) {
    $x = file_get_contents("ids/$adminID.json.txt");
    //echo "trying to read ids/$adminID.json.txt - $x";
    $adminData = json_decode($x, true);
    if (!$adminData){
        exit ("Admin user not found: $adminID");
    }
    $challenge = hash('whirlpool', $password . $adminData['salt']);
    $hhs = $adminData['adminhash'];
    $adminFullName = $adminData['adminFullName'];
    if ($challenge == $adminData['adminhash']) {
        setcookie('adminID', $adminID, time() + 7776000, "/"); //90 days

        echo "<html><body>
        <div style='display:none;'>
        <script>
        localStorage.adminhash = '$challenge';
        localStorage.adminID = '$adminID';
        localStorage.adminFullName = '$adminFullName';
        localStorage.adminJSON = '$x';
        
        location.assign(`../?adminID=$adminID`);
        </script>
        </div>
        </body></html>";
        exit;
    } else {
       // echo "hash mismatched<br>$challenge<br>$hhs";
      //  exit;
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


$adminIDC = $_COOKIE['adminID'];


$f = '    <form id="form1" action="" method="post" style="padding: 50px;">
<style>
    input{
        max-width: 200px;
    }
</style>
    Welcome Administrators!<br>Please login:<br><br>
    Username:<br>
    <input type="text" name="adminID" value="'.$adminIDC.'"><br><br>
    Password:<br>
    <input type="password" name="password">
    <br><br>
    <input type="submit">
</form>
<img style="display:none;" src="../../ids/make-all.php" alt="">';

$shell = str_replace("{{content}}", $f,$shell);
echo $shell;

?>
