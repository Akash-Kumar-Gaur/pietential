<?php

$j = file_get_contents("../ids/all.json");
///pie2/pielet/ids/all.json
// https://pietential.com/pielet/ids/all.json
$a = json_decode($j, true);
$master = $a['users'];

foreach ($master as $key => $value) {
    if ($value['promoCode']) {
        $pc = $value['promoCode'];
        $uid = $value['userID'];
        $pid = $value['partnerID'];
        if (preg_match('/FOWLER|ORLEANS|EVERREADY|KLAMPIE|MARKUS|GOOFY|PIPER|MCGILLICUDDY|MARSHALL|DOLLAR/',$pc )){
            echo "$pid -- $pc<br>"; 
            $value['partnerID'] = "demo";
            $fixedIDs[] = $value;
        }
    }
}

echo json_encode($fixedIDs);

foreach($fixedIDs as $key => $value){
    $uid = $value['userID'];
    $jload = json_encode($value);
    echo "<br><br><br>will write to id $uid : $jload";
    file_put_contents("../ids/$uid.json.txt", $jload);
}




// [{"companyCode":"FOWLER-FENCE","fullCompanyName":"fowler fence"},{"companyCode":"NEW-ORLEANS-CLASSICS","fullCompanyName":"New Orleans Classics"},{"companyCode":"EVERREADY-TECHNOLOGIES","fullCompanyName":"Everready Technoligies"},{"companyCode":"KLAMPIE","fullCompanyName":"KLAMPIE sys"},{"companyCode":"MARKUS-INDUSTRIES","fullCompanyName":"markus industries"},{"companyCode":"GOOFY-GLUE","fullCompanyName":"Goofy Glue"},{"companyCode":"PIPER-REALTORS","fullCompanyName":"Piper Realtors"},{"companyCode":"MCGILLICUDDY-HAM","fullCompanyName":"McGillicuddy Ham"},{"companyCode":"MARSHALL-AMPLIFIERS","fullCompanyName":"Marshall Amplifiers"},{"companyCode":"DOLLAR-GENERAL","fullCompanyName":"Dollar General"}]


