<?php

$arr = explode("\n", 'Subscriber Terms of Use;subscriberterms;Subscriber Terms of Use.html
    Acceptable Use Policy;acceptableuse;Acceptable Use Policy.html
    Website Terms of Use;websiteterms;Website Terms of Use.html
    Copyright Complaint Policy;copyrightcomplaint;Copyright Complaint Policy.html
    Privacy Policy;privacy;Privacy Policy.html
    Data Protection Addendum;dataprotectionaddendum;Data Protection Addendum.html');
foreach ($arr as $_) {
    $q = explode(";", $_);
    $c['id'] = $q[1];
    $c['title'] = $q[0];
    $c['html'] = file_get_contents(trim($q[2]));
    $master[] = $c;
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

</body>

</html>


<div id="legal">
    <nav>
        <a href="#subscriberterms">Subscriber Terms of Use</a> |
        <a href="#acceptableuse">Acceptable Use Policy</a> |
        <a href="#websiteterms">Website Terms of Use</a> |
        <a href="#copyrightcomplaint">Copyright Complaint Policy</a> |
        <a href="#privacy">Privacy Policy</a> |
        <a href="#dataprotectionaddendum">Data Protection Addendum</a> |
    </nav><br><br>
    <section id="subscriberterms"></section>
    <section id="acceptableuse"></section>
    <section id="websiteterms"></section>
    <section id="copyrightcomplaint"></section>
    <section id="privacy"></section>
    <section id="dataprotectionaddendum"></section>
</div>

<script>
    var j = <?php echo json_encode($master); ?>;



    var arr = `Subscriber Terms of Use;subscriberterms;Subscriber Terms of Use.html
    Acceptable Use Policy;acceptableuse;Acceptable Use Policy.html
    Website Terms of Use;websiteterms;Website Terms of Use.html
    Copyright Complaint Policy;copyrightcomplaint;Copyright Complaint Policy.html
    Privacy Policy;privacy;Privacy Policy.html
    Data Protection Addendum;dataprotectionaddendum;Data Protection Addendum.html`.split("\n");

    for (let a of j) {
        document.getElementById(a.id).innerHTML = a.html;

    }
</script>





1. subscriber terms of use
22 Acceptable use policy
Website Terms of use
Copyright Complainyt policy
Privacy Policy
Data Protection Addendum