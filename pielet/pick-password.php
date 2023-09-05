<?php
extract($_GET);
extract($_POST);
if (!$userID || !$email || !$password) {
    header("Location: ./");
    exit;
}

$salt = getrandom(65);
$hash = trim($password) . $salt;
$hash = hash('whirlpool', $hash);
$master = json_decode(file_get_contents("$userID.json.txt"), true);
$master[salt] = $salt;
$master[hash] = $hash;
$masterJSON = json_encode($master);
file_put_contents("$userID.json.txt", $masterJSON);

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>password picker</title>
</head>
<body>
    
</body>

<script>
    localStorage.pieletDataJSON = `<?php echo $masterJSON; ?>`;
    //document.body.innerHTML = localStorage.pieletDataJSON;
    location.assign(`https://pietential.com/`);
</script>
</html>


