<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shuff2(arr)</title>
</head>
<body>
    <div id="main" style="width:1200px;height:1200px; background:#eee;">


        <button onclick="go()">go</button>

    </div>
    <script>


        function shuff2(arr) {
            var q = [];
            while (arr.length > 0) {
                var pos = Math.floor(Math.random() * arr.length);
                q.push(arr.at(pos));
                arr.splice(pos, 1);
            }
            arr = q;
            return (arr);
        }

        var arr = `abcdqwertyuioplkjhgfdsazxcvbnm`.split("");
        arr = shuff2(arr);
        console.log(arr);







        function go() {
            main.style.background = "black";
            main.style.cursor = "wait";
            fetch("/editR96.php")
                .then(response => {
                    return response.text()
                })
                .then(payload => {
                    console.log("hello");
                    main.style.background = "#eee";
                    main.style.cursor = "pointer";
                    main.innerHTML = payload;
                });
        }







    </script>


</body>

</html>