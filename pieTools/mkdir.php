<?php
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
$loc = '//' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


$a = ['contact/responses', 'pieWidget/build', 'pieWidget/test', 'pielet/accountEngine', 'pielet/admin', 'pielet/admin/adminlogin', 'pielet/admin/adminlogin/ids', 'pielet/admin/codex', 'pielet/admin/create', 'pielet/analyzeit', 'pielet/becomeamember', 'pielet/calcEngine', 'pielet/coach', 'pielet/create', 'pielet/dashboard', 'pielet/download', 'pielet/ids', 'pielet/invite', 'pielet/new-account', 'pielet/privacy', 'pielet/privacy/new-thread', 'pielet/promocode', 'pielet/retake', 'pielet/share', 'pielet/shareMyChart', 'pielet/shell', 'pielet/survey', 'pielet/visualizeit', 'pielet/vote'];


foreach($a as $v){
    mkdir($v);
}
