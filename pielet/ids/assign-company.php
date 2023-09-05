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
        var users = `Jamal.Seth@pietential.com
Hilton.Jerrell@pietential.com
Nelson.Rosario@pietential.com
Gomez.Rogelio@pietential.com
Maxwell.Robert@pietential.com
Hugh.Stan@pietential.com
Jamel.Patricia@pietential.com
Jamar.Reinaldo@pietential.com
Julius.Lanny@pietential.com
Bailey.Tyrone@pietential.com
Rudolf.Wade@pietential.com
Shad.Black@pietential.com
Quinn.Tomas@pietential.com
Jim.Wagner@pietential.com
Wilfred.Terrance@pietential.com
gert@pietential.com
Sebastian.Toney@pietential.com
Lyle.Thomas@pietential.com
Kris.Shayne@pietential.com
Fisher.Newton@pietential.com
fortnite@pietential.com
Rod.Jenkins@pietential.com
Trey.Rico@pietential.com
Hayden.Ford@pietential.com
Wayne.William@pietential.com
vent@pietential.com
Kyle.Romeo@pietential.com
Harley.Mckinley@pietential.com
Lenard.Smith@pietential.com
Vincent.Jude@pietential.com
Arnold.King@pietential.com
Spencer.Santo@pietential.com
Rod.Wilford@pietential.com
Roosevelt.Rodrick@pietential.com
Santo.Stevie@pietential.com
Homer.Kim@pietential.com
Minh.Trenton@pietential.com
Rogers.Porter@pietential.com
Stuart.Rene@pietential.com
Stanton.Troy@pietential.com
Joan.Toney@pietential.com
Teddy.Gibson@pietential.com
Theo.Louie@pietential.com
Mason.Malcolm@pietential.com
Rocky.Pierce@pietential.com
Norberto.Lane@pietential.com
Len.Renaldo@pietential.com
Spencer.Hernandez@pietential.com
Lenny.Lorenzo@pietential.com
JIMMIE.BUTLER@pietential.com
MAXWELL.WALLACE@pietential.com
ROSCOE.REYNOLDS@pietential.com`.split("\n");
        var i = 0;
        var arr = [];
        for (let a of users) {
            var obj = {};
            obj.company = "Stanley Black and Decker";
            obj.email = a;
            if (i > 17) {
                obj.company = "General Growth Partners";
            }
            if (i > 34) {
                obj.company = "Lonsdale & Holtzman";
            }
            i++;
            arr.push(obj);
        }
        console.log(arr);


        fetch("all.json")
    .then(r => {
        return r.text()
    })
    .then(a => {
        var w = JSON.parse(a);
        var master = [];
        for (let x of w){
            var email = x.email;
            for (let c of arr){
                if (c.email == email){
                    x.company = c.company;
                }
            }
            master.push(x);
        }
        for (let f of master){
            if (f.company){
                console.log(f.email + " "+ f.company);
            }
        }
        document.body.innerHTML+= `<textarea>${JSON.stringify(master)}}</textarea>`;
    });

    </script>

    <?php
exit;
    $j = '[{"company":"Stanley Black and Decker","email":"Jamal.Seth@pietential.com"},{"company":"Stanley Black and Decker","email":"Hilton.Jerrell@pietential.com"},{"company":"Stanley Black and Decker","email":"Nelson.Rosario@pietential.com"},{"company":"Stanley Black and Decker","email":"Gomez.Rogelio@pietential.com"},{"company":"Stanley Black and Decker","email":"Maxwell.Robert@pietential.com"},{"company":"Stanley Black and Decker","email":"Hugh.Stan@pietential.com"},{"company":"Stanley Black and Decker","email":"Jamel.Patricia@pietential.com"},{"company":"Stanley Black and Decker","email":"Jamar.Reinaldo@pietential.com"},{"company":"Stanley Black and Decker","email":"Julius.Lanny@pietential.com"},{"company":"Stanley Black and Decker","email":"Bailey.Tyrone@pietential.com"},{"company":"Stanley Black and Decker","email":"Rudolf.Wade@pietential.com"},{"company":"Stanley Black and Decker","email":"Shad.Black@pietential.com"},{"company":"Stanley Black and Decker","email":"Quinn.Tomas@pietential.com"},{"company":"Stanley Black and Decker","email":"Jim.Wagner@pietential.com"},{"company":"Stanley Black and Decker","email":"Wilfred.Terrance@pietential.com"},{"company":"Stanley Black and Decker","email":"gert@pietential.com"},{"company":"Stanley Black and Decker","email":"Sebastian.Toney@pietential.com"},{"company":"Stanley Black and Decker","email":"Lyle.Thomas@pietential.com"},{"company":"General Growth Partners","email":"Kris.Shayne@pietential.com"},{"company":"General Growth Partners","email":"Fisher.Newton@pietential.com"},{"company":"General Growth Partners","email":"fortnite@pietential.com"},{"company":"General Growth Partners","email":"Rod.Jenkins@pietential.com"},{"company":"General Growth Partners","email":"Trey.Rico@pietential.com"},{"company":"General Growth Partners","email":"Hayden.Ford@pietential.com"},{"company":"General Growth Partners","email":"Wayne.William@pietential.com"},{"company":"General Growth Partners","email":"vent@pietential.com"},{"company":"General Growth Partners","email":"Kyle.Romeo@pietential.com"},{"company":"General Growth Partners","email":"Harley.Mckinley@pietential.com"},{"company":"General Growth Partners","email":"Lenard.Smith@pietential.com"},{"company":"General Growth Partners","email":"Vincent.Jude@pietential.com"},{"company":"General Growth Partners","email":"Arnold.King@pietential.com"},{"company":"General Growth Partners","email":"Spencer.Santo@pietential.com"},{"company":"General Growth Partners","email":"Rod.Wilford@pietential.com"},{"company":"General Growth Partners","email":"Roosevelt.Rodrick@pietential.com"},{"company":"General Growth Partners","email":"Santo.Stevie@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Homer.Kim@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Minh.Trenton@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Rogers.Porter@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Stuart.Rene@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Stanton.Troy@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Joan.Toney@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Teddy.Gibson@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Theo.Louie@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Mason.Malcolm@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Rocky.Pierce@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Norberto.Lane@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Len.Renaldo@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Spencer.Hernandez@pietential.com"},{"company":"Lonsdale & Holtzman","email":"Lenny.Lorenzo@pietential.com"},{"company":"Lonsdale & Holtzman","email":"JIMMIE.BUTLER@pietential.com"},{"company":"Lonsdale & Holtzman","email":"MAXWELL.WALLACE@pietential.com"},{"company":"Lonsdale & Holtzman","email":"ROSCOE.REYNOLDS@pietential.com"}]';

    echo "<pre>";
    $arr = json_decode($j, true);
print_r($arr);
    $db = json_decode(file_get_contents("all.json"), true);
    
    foreach ($db as $k => $v) {
        $email = $v['email'];
        if (strlen($email) > 3) {
            //echo "trying $email...<br>";
            foreach ($arr as $a => $b) {
                $company = $b['company'];
                if ($b['email'] == $email) {
                    $v['company'] = $company;
                    echo "$email works for $company<br>";
                }
            }
        }
        $master[] = $v;
    }

    $j2 = json_encode($master);
    //echo "<textarea>$j2</textarea>";

    









    ?>





</body>

</html>