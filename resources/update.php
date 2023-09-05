<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
    <link href="/pielet/styles.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,800&display=swap" rel="stylesheet">
    <style>
        td{width:unset}
        tr:nth-child(1) {
    background: unset;
    color: unset;
}
    </style>
</head>
<body>
    <div id='rdata'></div>
    <script>
        async function getData() {
                    var c = await fetch("services.json");
                    window.x = await c.json();
                    var out = '';
                    var i = 0;
                    for (let a of x){
                        out += `<tr><td>Resource Type: <input class="rt" value="${a['Resource Type']}"></td><td>`;
                        out += `Resource Name: <input class="rt" value="${a['Resource Name']}"></td><td>`;
                        out += ` Resource Website: <input class="rt" value="${a['Resource Website']}" style="width:50%"></td></tr>`;
                    }
                    while (i<12){
                        out += `<tr><td>Resource Type: <input class="rt" value=""></td><td>`;
                        out += `Resource Name: <input class="rt" value=""></td><td>`;
                        out += ` Resource Website: <input class="rt" value="" style="width:50%"></td></tr>`;
                        i++;
                    }
                    rdata.innerHTML = `<table>${out}</table>`;
                }
                getData();
    </script>
</body>
</html>