<?php

// only the .html is on the server


















extract($_GET);
extract($_POST);
// retake/index.php
$userID = $_COOKIE['userID'];
$pieletData = json_decode(file_get_contents("../ids/$userID.json.txt"), true);
echo "<pre>";

foreach ($pieletData as $key => $value) {
    if (preg_match('/response/', $key)) {
        $current[$key] = $value;
        
    }
}
$current['timestamp'] = $pieletData['completionDate'];
$current['snapShotCompletionDate'] = $pieletData['completionDate'];
if ($current['Q0response']) {
    $pieletData['snapshots'][] = $current;
  //  echo "<pre>";print_r($current);
}
// now reset all current values to null
foreach ($pieletData as $key => $value) {
    if (preg_match('/response|Completed|scroll|LBscorevalues|percent|current|SA|EC|LB|PN|SN/', $key)) {
        unset($pieletData[$key]);
    }
}
$pieletDataJSON = json_encode($pieletData);
file_put_contents("../ids/$userID.json.txt", $pieletDataJSON);
setcookie('dashboard', '', time() + -7, "/"); //90 days
setcookie('percent', '', time() + -7, "/"); //90 days
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pietential</title>
</head>

<body>
    <script>
        localStorage.pieletDataJSON = `<?php echo $pieletDataJSON; ?>`;
        localStorage.returnToLatest = 1;
        location.assign(`/pielet/survey/?retake=2`);
    </script>
    <a href="/pielet/survey/">Click to continue</a>
</body>

</html>