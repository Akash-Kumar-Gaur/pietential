<?php
// BUILD DATE : NOVEMBER 5 1015 slash test \\
//error_reporting(E_ALL);
extract($_GET);
extract($_POST);
include_once 'hankpants.php';
date_default_timezone_set('America/New_York');


$statusdrop = $_COOKIE['loggedin'];
if (!$statusdrop){
	exit;
	}


function nameclean($file){
$file = trim($file);
$file = preg_replace('/[^a-zA-Z0-9.]+/ism', '-', $file);
$file = preg_replace('/-+/i', '-', $file);
$file = preg_replace('/(\.|-)(\.|-)+/i', '.', $file);
$file = rtrim($file, '-');
$file = ltrim($file, '-');
$file = rtrim($file, '.');
$file = ltrim($file, '.');
$file = preg_replace('/\.php/ism', '', $file);
return $file;
}

if (empty($_FILES)) {
$adjustfilepath = trim($dir);
$adjustfilepath = str_replace('../','<@>',$adjustfilepath);
$adjustfilepath = ltrim($adjustfilepath,'./');
$adjustfilepath = rtrim($adjustfilepath,'/');
$adjustfilepath = trim($adjustfilepath);
setcookie('adjustfilepath', $adjustfilepath, time() + 36000000, "/");
}

if (!empty($_FILES)) { // this is the dropzone uploader code
$adjustfilepath = $_COOKIE['adjustfilepath'];
$predir = './';

if (preg_match('/\<\@\>/',$adjustfilepath)){
$adjustfilepath = str_replace('<@>','../',$adjustfilepath);
$predir = '';
}
$tempFile = $_FILES['file']['tmp_name'];
$newname = $_FILES['file']['name'];
$newname = safepants($newname);
$newname = filenamerandomizer($newname, 4);
$newname = nameclean($newname);
move_uploaded_file($tempFile,$predir.$adjustfilepath.'/'.$newname); 
exit;
}


if (!$dir){
	$dir = 'uploads/';
	}
?>
<title>drop</title>
<link href="//silvercrayon.us/dropzone/dropzone.css" type="text/css" rel="stylesheet" />
<script src="//silvercrayon.us/dropzone/dropzone.js"></script>
<style type="text/css">
<!--
a:link {
color: #0099CC;
}
a:visited {
color: #006699;
}
a:hover {
color: #003366;
}
a:active {
color: #990000;
}
body{
font-family: sans-serif; 
font-size: 13px; 
line-height: 1.5em; 
padding: 0px;
}
</style>
<body >
<table width="100%" border="0" cellpadding="15" cellspacing="0">
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td valign="top"><form action="<?php echo  $_SERVER['PHP_SELF'] ?>" class="dropzone" >
  </form><div style="font-size:12px;">NOTE: Image resizing and other options are ignored when using drag and drop.<br>
After files have uploaded, <a href="./?mode=medialist" target="_parent">click here to refresh</a>.</div>
  
  
</td>
</tr>
</table></td>
</tr>
<tr>
<td></td>
</tr>
</table>

</body>
