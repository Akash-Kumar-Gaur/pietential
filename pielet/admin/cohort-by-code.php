<?php
extract($_GET);
extract($_POST);

if ($companyCode) {
    // http://192.168.0.121:8937/pie2/pielet/admin/cohort-by-code.php?companyCode=kjinudustry
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    $_ = file_get_contents("../ids/all.json");
    $s = json_decode($_, true);
    $users = $s['users'];
    foreach ($users as $a => $v) {
        if ($v['companyCode'] == $companyCode) {
            $usersWithCodes[] = $v;
            $userList[] = $v['userID'];
        }
    }
    if($allData==1){
        echo json_encode($usersWithCodes);
    } else {
    echo json_encode($userList);
    }
    exit;
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        var out = '';
        fetch("http://192.168.0.121:8937/pie2/pielet/admin/cohort-by-code.php?companyCode=kjinudustry")
            .then(r => {
                return r.text()
            })
            .then(a => {
                //document.body.innerHTML += a;
                window.f = JSON.parse(a);
                getCohortAsJson(window.f);
            });

            function getCohortAsJson(array) {
            var userList = array;
            var uout = '';
            for (let a of userList) {
                uout += a + ",";
            }
            uout = uout.replace(/;$/, '');
            const fd = new FormData();
            fd.append('getAPI', uout);
            console.log(uout);
            const options = {
                method: 'POST',
                //mode: 'no-cors',
                body: fd
            };
            fetch(`https://pietential.com/pielet/accountEngine/`, options)
                .then(response => {
                    return response.text()
                })
                .then(z => {
                    if(z.match(/null/)){
                        alert("the data returned is not valid. Make sure the IDs exist.");
                        return;
                    }
                    localStorage.cohort = z;
                    document.body.innerHTML =z;
                });
        }
    </script>
</body>

</html>