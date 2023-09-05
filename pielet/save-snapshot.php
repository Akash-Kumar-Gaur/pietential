<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York'); 
$timestamp = date('Y-m-d--') . date('H-i-s');
// cloudburst@silvercrayon.com
// ak1a*wt%vbnX

// https://pietential.com/pielet/save-snapshot.php?email=uityiuyt@ytyttrytr.com&userID=Bs6duHDeVveP&snapshot=eyJRMHJlc3BvbnNlIjo0LCJRMXJlc3BvbnNlIjo1LCJRMnJlc3BvbnNlIjo2LCJRM3Jlc3BvbnNlIjo1LCJRNHJlc3BvbnNlIjo1LCJRNXJlc3BvbnNlIjo2LCJRNnJlc3BvbnNlIjo2LCJRN3Jlc3BvbnNlIjo1LCJROHJlc3BvbnNlIjo2LCJROXJlc3BvbnNlIjo2LCJRMTByZXNwb25zZSI6NywiUTExcmVzcG9uc2UiOjcsIlExMnJlc3BvbnNlIjo3LCJRMTNyZXNwb25zZSI6NywiUTE0cmVzcG9uc2UiOjYsIlExNXJlc3BvbnNlIjo2LCJRMTZyZXNwb25zZSI6NywiUTE3cmVzcG9uc2UiOjcsIlExOHJlc3BvbnNlIjo3LCJRMTlyZXNwb25zZSI6NiwiUTIwcmVzcG9uc2UiOjcsIlEyMXJlc3BvbnNlIjo3LCJRMjJyZXNwb25zZSI6NiwiUTIzcmVzcG9uc2UiOjcsIlEyNHJlc3BvbnNlIjo2LCJRMjVyZXNwb25zZSI6NywiUTI2cmVzcG9uc2UiOjYsIlEyN3Jlc3BvbnNlIjo3LCJRMjhyZXNwb25zZSI6NiwiUTI5cmVzcG9uc2UiOjR9
if ($email && $userID && $snapshot) {
    $master = json_decode(file_get_contents("$userID.json.txt"), true);
    foreach($master as $key => $value){
        if (preg_match('/^Q|completed|currentpart/i',$key)){
            unset($master[$key]);
        }
    }
    $tdata = json_decode(base64_decode($snapshot), true);
    $tdata[time] = $timestamp;
    if ($tdata) {
        $master['snapshots'][] = $tdata;
        file_put_contents("$userID.json.txt", json_encode($master));
        file_put_contents("$userID.snapshot.txt", $snapshot);
        file_put_contents("$userID.snapshotJSON.txt", base64_decode($snapshot));
        echo json_encode($master);
    }
}
if ($email && $userID && $state) {
    $master = json_decode(file_get_contents("$userID.json.txt"), true);
    foreach($master as $key => $value){
        if (preg_match('/^Q|completed|currentpart/i',$key)){
            unset($master[$key]);
        }
    }
    $tdata = json_decode(base64_decode($state));
    if ($tdata) {
        foreach($tdata as $key=>$value){
            $master[$key] = $value;
        }
        file_put_contents("$userID.json.txt", json_encode($master));
    }
}
