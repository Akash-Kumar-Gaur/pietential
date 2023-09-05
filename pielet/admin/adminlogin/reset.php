<?php
extract($_GET);
extract($_POST);
//error_reporting(E_ALL);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');

?>

<script src="/pieTools/logCheck.php"></script>



<?php
$adminID = 'Pooja';
$new = 'U5Rx*^c^HiBnIon$RRFowsy';

$j = file_get_contents("ids/$adminID.json.txt");
$master = json_decode($j,true);
$salt = $master['salt'];
$adminhash = hash('whirlpool', $new . $salt);
$master['adminhash'] = $adminhash;
file_put_contents("ids/$adminID.json.txt", json_encode($master));
exit($adminhash);

//d4251cbf21b3094d6071e177aaac8128ac2c50b01b2a7a3a3a7c71c3f98cec5d647a1e73ceb478c5b23ad4e2859dd7a4ee4a030e261f13c137c2cee1c089d3f9


//{"adminFullName":null,"salt":"FcNNTuzQNzwGkbjzNDL2S7x5GUpCRN6O","adminhash":"232e0050a0c12738670d74f64baefeda369646ae7faf8d784d137cb73fcc1408c08cc9abef3ba9c44d1adf96b11b558618248928113ff81d44d07d51dad79e74","email":"pooja@pietential.com","promoCode":null,"companyCode":"TeamPietential","companyList":["TeamPietential"],"fname":"Pooja","lname":"Semwal","company":"Pietential","phone":"9599614211","title":"Director of Operations","website":"www.pietential.com","adminID":"Pooja","joinDate":"2022-06-22--17-23-17","businessCategories":null}

?>