<?php
extract($_POST);
extract($_GET);

$d = json_decode($thedata, true);
if (!$d){
    exit("no d.");
}
$master = json_decode(file_get_contents("thedata.json"),true);
foreach ($d as $k => $v){
    //echo "$k\n";
    $master[] = $v;
}
//print_r($master);
$jd = json_encode($master);
file_put_contents("thedata.json",  $jd);
$jd2 = json_encode($d);
echo "<textarea>$jd2</textarea>";
echo "<pre>";
print_r($d);
?>
<script>
    location.assign(`review-data.html`);
</script>

