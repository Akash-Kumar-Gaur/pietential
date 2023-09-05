<?
echo "<pre>";
$promoCode = "KLAMPIEHESL4";
$_ = file_get_contents('../admin/codex/all.json');
if (!preg_match('/' . $promoCode . '/', $_)) {
    echo ("That's not a valid code, please use a new promo code.");
    exit;
} else {
    echo "$promoCode is a valid code.<br>";
    $theCompanyName = substr($promoCode, 0, strlen($promoCode) - 5);
    echo "$theCompanyName is a the company name.<br>";
    $w = file_get_contents("../admin/adminlogin/ids/all.json");
    $partners = json_decode($w, true);
    foreach ($partners as $k => $v) {
        echo "Trying $k<br>";
        if ($v['companyList']) {
            print_r($v['companyList']);
            foreach ($v['companyList'] as $z => $h) {
                if ($h['companyCode'] == $theCompanyName) {
                    $pieletData['company'] = $theCompanyName;
                    $pieletData['partnerID'] = $k;
                }
            }
        }
    }
    $pieletData['promoCode'] = $promoCode;
    
    print_r($pieletData);
}
?>

<script>
    var tags = `h1,h2,h3,h4,h5,strong,b`.split(",");
    for (let tag of tags){
        for (let a of document.getElementsByTagName(tag)){
            a.innerHTML = a.innerHTML.replace(/<\/?strong\s*>/ig, "");
            a.innerHTML = a.innerHTML.replace(/<\/?b\s*>/ig, "");
            a.innerHTML = a.innerHTML.replace(/<\/?h1\s*>/ig, "");
            a.innerHTML = a.innerHTML.replace(/<\/?h2\s*>/ig, "");
            a.innerHTML = a.innerHTML.replace(/<\/?h3\s*>/ig, "");
            a.innerHTML = a.innerHTML.replace(/<\/?h4\s*>/ig, "");
        }
    }
</script>