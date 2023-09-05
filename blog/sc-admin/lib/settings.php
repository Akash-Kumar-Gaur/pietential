<?php
// Generally you only need to edit line 5 and 6//
$sitename = 'Pietential';
$publicURL = 'https://pietential.com/blog/'; 
$relativecmsfolder = 'sc-admin/'; 
$publicCMSfolder = $publicURL.$relativecmsfolder; 
date_default_timezone_set('America/New_York');
// Generally you don't need to edit below this line //
require_once 'smartypants.php';
require_once 'functions.php';
$backupfoldername = 'BU-JSON';
$CMSfolder = './'.$relativecmsfolder; //in most cases this will be /cms or ./sc-admin
$indexpage = '../'; //in most cases this will be index.php or ../index.php
$previewurl = '../'; //in most cases this will be ../ or ?p= or ../?p= if mod rewrite is off
$assemblerTemplateFolder = $relativecmsfolder.'templates/';
$assemblerPath = $relativecmsfolder.'ids/';
$assemblerChallengePath = $relativecmsfolder.'users/admin';
$reproxyurl = 'https://silvercrayon.us/apps/reproxy/';
$editcodeurl = 'https://silvercrayon.us/ck/ckeditor/ckeditor.js';
$iconurl = 'https://silvercrayon.us/silvercrayonicon.png';
$editurl = '?edit=';
$sourceediturl = '?editsource=';
$loginlocation = './';
$processurl = './';
$shortpathtoIDfolder = 'ids/';
$xburl = 'xbu.php?filter=';
$cookiename = idclean($sitename).'-silvercrayoncms';
$newdocname = 'Untitled-Document';
$photourl = $CMSfolder.'?mode=medialist';
$idsourcefolder = $shortpathtoIDfolder;
$dir = $idsourcefolder;
$templatefolder = 'templates/';
$domain = $_SERVER['HTTP_HOST'];
$filepath = $_SERVER['SCRIPT_NAME'];
$lastslash = strrpos($filepath,"/");
$path = substr($filepath, 0, $lastslash);
$hi = "http://".$domain . $path."/";
$timestamp = date('Y-m-d--').date('H-i-s');
$newdocname = 'Untitled-Document-'.$timestamp;
$today = date("F j, Y");
?>