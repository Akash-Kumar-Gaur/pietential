<?php
echo "<pre>";
echo $_SERVER["DOCUMENT_ROOT"];
echo "\n";
echo $_COOKIE['run77'];
?>

<script>
    function MM_reloadPage(init) {
        if (init == true) with(navigator) {
            if ((appName == "Netscape") && (parseInt(appVersion) == 4)) {
                document.MM_pgW = innerWidth;
                document.MM_pgH = innerHeight;
                onresize = MM_reloadPage;
            }
        }
        else if (innerWidth != document.MM_pgW || innerHeight != document.MM_pgH) location.reload();
    }
    MM_reloadPage(true);

    function MM_findObj(n, d) { //v4.01
        var p, i, x;
        if (!d)
            d = document;
        if ((p = n.indexOf("?")) > 0 && parent.frames.length) {
            d = parent.frames[n.substring(p + 1)].document;
            n = n.substring(0, p);
        }
        if (!(x = d[n]) && d.all)
            x = d.all[n];
        for (i = 0; !x && i < d.forms.length; i++)
            x = d.forms[i][n];
        for (i = 0; !x && d.layers && i < d.layers.length; i++)
            x = MM_findObj(n, d.layers[i].document);
        if (!x && d.getElementById)
            x = d.getElementById(n);
        return x;
    }


    var t = "q,x,d,f,g,g,g,g,h,y,t,f,d,s".split(",");
    t = Array.from(new Set(t));

    function displayCookies() {
        var out = "<tr><td>Cookie name</td> <td>Value</td></tr>";
        var obj = {};
        for (let a of document.cookie.split(`;`)) {
            console.log(a);
            var k = a.split('=')[0];
            var v = a.split('=')[1];
            obj[k] = v;
            out += `<tr><td>${k}</td> <td>${v}</td></tr>`;

        }
        var table = `<table style="max-width:600px">${out}</table>`;
        document.body.innerHTML += table;
    }
    displayCookies();
</script>