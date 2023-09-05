<?php
extract($_GET);
extract($_POST);
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: text/plain; charset=utf-8");
$domain = $_SERVER['HTTP_HOST'];
$filepath = $_SERVER['SCRIPT_NAME'];
$lastslash = strrpos($filepath, "/");
$path = substr($filepath, 0, $lastslash);
$hi = "http://" . $domain . $path . "/";

date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d');

$_ = file_get_contents("codesIV.txt");
$_ = str_replace("\r\n", "\n", $_);
$codes = explode("\n", $_);

if ($i) {
    $out = "$i is not a valid code, please try again.";
    $out .= '<form action=""  >
    <input type="text" placeholder="Enter an invite code." name="i">
    <input type="submit" style="width: auto;">
    </form>';
    foreach ($codes as $_) {
        if ($_ == $i) {
            $out = "$i is a valid code, click here to continue.";
        }
    }
}
if (!$i) {
    $out .= '
    <form action=""  >
    <input type="text" placeholder="Enter an invite code." name="i">
    <input type="submit" style="width: auto;">
    </form>';
}

$_ = file_get_contents("../shell.html");
$_ = str_replace("{{content}}", "<div id='content'><div id='signUp' style='width: 400px;display: block;text-align: center;margin: auto;'>$out</div></div>", $_);
echo($_);
?>



<script>
    // if(validCode){
    //     content.innerHTML = `<?php echo $i ?> is a valid code.`;
    // } else {
    //     content.innerHTML  = signUp.innerHTML;
    // }
</script>




<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invite code</title>
</head>
<body>
    
</body>
</html> -->


<?

/* 

https://pietential.com/pielet/invite/?i=1D5M2PVZ
https://pietential.com/pielet/invite/?i=1MUDRUBV
https://pietential.com/pielet/invite/?i=1RXLM1CL
https://pietential.com/pielet/invite/?i=1VPMDU3X
https://pietential.com/pielet/invite/?i=2BYHAUMB
https://pietential.com/pielet/invite/?i=2G3RG7Q3
https://pietential.com/pielet/invite/?i=3AL6AYZF
https://pietential.com/pielet/invite/?i=3D42T7WA
https://pietential.com/pielet/invite/?i=3FQHZVH7
https://pietential.com/pielet/invite/?i=3K7AQ3JY
https://pietential.com/pielet/invite/?i=3KKDRPVE
https://pietential.com/pielet/invite/?i=3NRNPNKY
https://pietential.com/pielet/invite/?i=3P3QABAF
https://pietential.com/pielet/invite/?i=3TK3AP7M
https://pietential.com/pielet/invite/?i=4DNPW3VR
https://pietential.com/pielet/invite/?i=4KWDRYV8
https://pietential.com/pielet/invite/?i=4TTJVSYU
https://pietential.com/pielet/invite/?i=5EYB87FG
https://pietential.com/pielet/invite/?i=5R7X53GE
https://pietential.com/pielet/invite/?i=6VZNMWE3
https://pietential.com/pielet/invite/?i=7CPVRXUH
https://pietential.com/pielet/invite/?i=7DHNK3NF
https://pietential.com/pielet/invite/?i=7DJAAL4T
https://pietential.com/pielet/invite/?i=7EGHXAGZ
https://pietential.com/pielet/invite/?i=7EPTPCHY
https://pietential.com/pielet/invite/?i=7ERAM9YY
https://pietential.com/pielet/invite/?i=7P93SXYA
https://pietential.com/pielet/invite/?i=7PBL9TNV
https://pietential.com/pielet/invite/?i=7PCK73P5
https://pietential.com/pielet/invite/?i=7TB4RFBL
https://pietential.com/pielet/invite/?i=7XY6JT9T
https://pietential.com/pielet/invite/?i=8XR1DG9W
https://pietential.com/pielet/invite/?i=9JZBDWHW
https://pietential.com/pielet/invite/?i=9PLB4UFA
https://pietential.com/pielet/invite/?i=9ZEYMPDU
https://pietential.com/pielet/invite/?i=22NSFX3W
https://pietential.com/pielet/invite/?i=38LXBPS3
https://pietential.com/pielet/invite/?i=57A1K96P
https://pietential.com/pielet/invite/?i=57W377PY
https://pietential.com/pielet/invite/?i=74RFSCFC
https://pietential.com/pielet/invite/?i=86LJV5DN
https://pietential.com/pielet/invite/?i=92NNJPXS
https://pietential.com/pielet/invite/?i=3384YFNQ
https://pietential.com/pielet/invite/?i=56377LGC
https://pietential.com/pielet/invite/?i=ABXUSA2K
https://pietential.com/pielet/invite/?i=ALFQU37N
https://pietential.com/pielet/invite/?i=APJZFKHP
https://pietential.com/pielet/invite/?i=ASFJPES5
https://pietential.com/pielet/invite/?i=B1RQQGEL
https://pietential.com/pielet/invite/?i=B8MNVMZ7
https://pietential.com/pielet/invite/?i=B88JE37R
https://pietential.com/pielet/invite/?i=BU3KQEXL
https://pietential.com/pielet/invite/?i=BV5RPZTG
https://pietential.com/pielet/invite/?i=C2MRTFVY
https://pietential.com/pielet/invite/?i=C3R3SCNU
https://pietential.com/pielet/invite/?i=C3R7DNEA
https://pietential.com/pielet/invite/?i=C6HC7CRS
https://pietential.com/pielet/invite/?i=CBX5EHRA
https://pietential.com/pielet/invite/?i=CCEWHZVA
https://pietential.com/pielet/invite/?i=CQWP3M1T
https://pietential.com/pielet/invite/?i=D75WFCA6
https://pietential.com/pielet/invite/?i=DEEGN6RL
https://pietential.com/pielet/invite/?i=DFAQS6JA
https://pietential.com/pielet/invite/?i=DFCKVMNA
https://pietential.com/pielet/invite/?i=DLH3P1LN
https://pietential.com/pielet/invite/?i=DRPWWSWN
https://pietential.com/pielet/invite/?i=DSKCMJ83
https://pietential.com/pielet/invite/?i=DTDY74WJ
https://pietential.com/pielet/invite/?i=DUE1WTUD
https://pietential.com/pielet/invite/?i=DX36E73M
https://pietential.com/pielet/invite/?i=E4NMFNBY
https://pietential.com/pielet/invite/?i=EAXAQQAP
https://pietential.com/pielet/invite/?i=EGTT7CPV
https://pietential.com/pielet/invite/?i=EHLFEG1M
https://pietential.com/pielet/invite/?i=EJ7PGNZJ
https://pietential.com/pielet/invite/?i=EKM3SQBV
https://pietential.com/pielet/invite/?i=EMUL9BHU
https://pietential.com/pielet/invite/?i=ENASAU31
https://pietential.com/pielet/invite/?i=ET1T4NTU
https://pietential.com/pielet/invite/?i=EUD2PLH3
https://pietential.com/pielet/invite/?i=EXKGDPSB
https://pietential.com/pielet/invite/?i=FD7RXYVJ
https://pietential.com/pielet/invite/?i=FJBM5UHM
https://pietential.com/pielet/invite/?i=FJPC34NN
https://pietential.com/pielet/invite/?i=FPCENZWM
https://pietential.com/pielet/invite/?i=FRQB4GZ7
https://pietential.com/pielet/invite/?i=FUMSPDSD
https://pietential.com/pielet/invite/?i=FVGKKNM6
https://pietential.com/pielet/invite/?i=FVJJQW5J
https://pietential.com/pielet/invite/?i=FXJFJCAN
https://pietential.com/pielet/invite/?i=FZLB8P7E
https://pietential.com/pielet/invite/?i=GA8EVWKU
https://pietential.com/pielet/invite/?i=GACJASPF
https://pietential.com/pielet/invite/?i=GANGPW7K
https://pietential.com/pielet/invite/?i=GJHYCUAP
https://pietential.com/pielet/invite/?i=GMEQD6KU
https://pietential.com/pielet/invite/?i=GUXDRUTV
https://pietential.com/pielet/invite/?i=HQ3JPJ7Q
https://pietential.com/pielet/invite/?i=HRLG5VR7
https://pietential.com/pielet/invite/?i=HYW4K8MX
https://pietential.com/pielet/invite/?i=J3GFQL8W
https://pietential.com/pielet/invite/?i=JFKYPMPK
https://pietential.com/pielet/invite/?i=JHW3UQDH
https://pietential.com/pielet/invite/?i=JT9CNQP5
https://pietential.com/pielet/invite/?i=JT6237CF
https://pietential.com/pielet/invite/?i=K3EFFZHB
https://pietential.com/pielet/invite/?i=K5RX3NVD
https://pietential.com/pielet/invite/?i=K7QHBYBY
https://pietential.com/pielet/invite/?i=KCBATMUU
https://pietential.com/pielet/invite/?i=KGEG3E3C
https://pietential.com/pielet/invite/?i=KLLFDSSM
https://pietential.com/pielet/invite/?i=KN3HNWET
https://pietential.com/pielet/invite/?i=KPUC33RC
https://pietential.com/pielet/invite/?i=L3ZH773V
https://pietential.com/pielet/invite/?i=L5TYJJRM
https://pietential.com/pielet/invite/?i=L78WWEAD
https://pietential.com/pielet/invite/?i=LJLSDD7Q
https://pietential.com/pielet/invite/?i=LNSCZW8R
https://pietential.com/pielet/invite/?i=M3R69JU3
https://pietential.com/pielet/invite/?i=M3RNCTBL
https://pietential.com/pielet/invite/?i=MLYUNQC6
https://pietential.com/pielet/invite/?i=MNAWLQVS
https://pietential.com/pielet/invite/?i=MPBHUHDN
https://pietential.com/pielet/invite/?i=MPGJY2B7
https://pietential.com/pielet/invite/?i=MWXU889Q
https://pietential.com/pielet/invite/?i=N77B54SQ
https://pietential.com/pielet/invite/?i=NLJ5G2KD
https://pietential.com/pielet/invite/?i=NNKC2AN2
https://pietential.com/pielet/invite/?i=NZ172VXD
https://pietential.com/pielet/invite/?i=P7MYCJGS
https://pietential.com/pielet/invite/?i=P9VFSP6P
https://pietential.com/pielet/invite/?i=PJTDYVFA
https://pietential.com/pielet/invite/?i=PQK364HY
https://pietential.com/pielet/invite/?i=PZ7V2H33
https://pietential.com/pielet/invite/?i=Q55CTV3G
https://pietential.com/pielet/invite/?i=QADN6SDW
https://pietential.com/pielet/invite/?i=QGW9GMBT
https://pietential.com/pielet/invite/?i=QNHHR472
https://pietential.com/pielet/invite/?i=QT4A2EVZ
https://pietential.com/pielet/invite/?i=R7NPTW1T
https://pietential.com/pielet/invite/?i=R8XTLYZY
https://pietential.com/pielet/invite/?i=RMVF2C8K
https://pietential.com/pielet/invite/?i=RUPM963Q
https://pietential.com/pielet/invite/?i=RYAHPXRP
https://pietential.com/pielet/invite/?i=S2VXBREM
https://pietential.com/pielet/invite/?i=SBP7XB3E
https://pietential.com/pielet/invite/?i=SEMEJCHC
https://pietential.com/pielet/invite/?i=SLATNBYV
https://pietential.com/pielet/invite/?i=SXC1QT6C
https://pietential.com/pielet/invite/?i=T1ZAVY1P
https://pietential.com/pielet/invite/?i=T4RJXPJC
https://pietential.com/pielet/invite/?i=T7FNUP87
https://pietential.com/pielet/invite/?i=T7R3KN6P
https://pietential.com/pielet/invite/?i=T9JTSF3T
https://pietential.com/pielet/invite/?i=T6973EQC
https://pietential.com/pielet/invite/?i=TBMVK7KP
https://pietential.com/pielet/invite/?i=TGXJ3VMP
https://pietential.com/pielet/invite/?i=TL7P7ANA
https://pietential.com/pielet/invite/?i=TLRS8K3A
https://pietential.com/pielet/invite/?i=TRGMNUHV
https://pietential.com/pielet/invite/?i=TUUW273R
https://pietential.com/pielet/invite/?i=U77U7WRG
https://pietential.com/pielet/invite/?i=UCFL8A67
https://pietential.com/pielet/invite/?i=UDHVVM1Y
https://pietential.com/pielet/invite/?i=UKQ6HKK3
https://pietential.com/pielet/invite/?i=UNHAF7F2
https://pietential.com/pielet/invite/?i=URBMBBKV
https://pietential.com/pielet/invite/?i=UXU3PBEL
https://pietential.com/pielet/invite/?i=V3YZCAQG
https://pietential.com/pielet/invite/?i=V7F9J4TS
https://pietential.com/pielet/invite/?i=V73VWSPQ
https://pietential.com/pielet/invite/?i=VGNV7NLZ
https://pietential.com/pielet/invite/?i=VGUDVFD3
https://pietential.com/pielet/invite/?i=VL7LSAAD
https://pietential.com/pielet/invite/?i=VQGZQBQ7
https://pietential.com/pielet/invite/?i=VSK3PAV9
https://pietential.com/pielet/invite/?i=VZGEMH7S
https://pietential.com/pielet/invite/?i=W3LBE8RG
https://pietential.com/pielet/invite/?i=WDFB5R37
https://pietential.com/pielet/invite/?i=WQP7TJA5
https://pietential.com/pielet/invite/?i=XDKASSPV
https://pietential.com/pielet/invite/?i=XRNBV5ED
https://pietential.com/pielet/invite/?i=XTRFCGNV
https://pietential.com/pielet/invite/?i=Y7ZNZHH1
https://pietential.com/pielet/invite/?i=YCAC3ZN2
https://pietential.com/pielet/invite/?i=YEVDRLDE
https://pietential.com/pielet/invite/?i=YEVGSUA9
https://pietential.com/pielet/invite/?i=YFFWPJBA
https://pietential.com/pielet/invite/?i=YL3L7UMR
https://pietential.com/pielet/invite/?i=YL87MSQ8
https://pietential.com/pielet/invite/?i=YP9MAJE3
https://pietential.com/pielet/invite/?i=YZKSGNP7
https://pietential.com/pielet/invite/?i=Z3NQMAPH
https://pietential.com/pielet/invite/?i=Z6BPSPUF
https://pietential.com/pielet/invite/?i=Z6KTQQ3A
https://pietential.com/pielet/invite/?i=ZB17QBLH
https://pietential.com/pielet/invite/?i=ZG4SLHB3
https://pietential.com/pielet/invite/?i=ZMHH8HEG
https://pietential.com/pielet/invite/?i=ZRWM38WN
https://pietential.com/pielet/invite/?i=ZVARQP3S

*/