<?php
extract($_GET);
extract($_POST);
include_once 'lib/functions.php';

// test of slash \'
// build date 12/3/2015 by Hank Mitchell

?>
<title>Quickstart</title>
<link href="lib/silvercrayon.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/png" href="'.$iconurl.'">
<body>
<p>
  <?php

// determine if the hash for user admin is still 1234
// bounce if not

if (@file_get_contents('users/admin') != '2f9959b230a44678dd2dc29f037ba1159f233aa9ab183ce3a0678eaae002e5aa6f27f47144a1a4365116d3db1b58ec47896623b92d85cb2f191705daf11858b8'){
	exit ('Sorry, but the admin password has been already updated. The quick start is no longer available.');
	
	}


if ($url){
	$url = trim($url);
	$url = rtrim($url,'/');
	$sitename = trim($sitename);
	$pw = trim($pw);
	if (!$url){
		exit('url required.');
	}
	if (!$sitename){
		exit('sitename required.');
	}
	if (!$pw){
		exit('password required.');
	}
	if ($pw==1234){
		exit('Use a stronger password please.');
	}	

	
	$settingsdata = @file_get_contents('settings.php');
	$settingsdata = str_replace('*sitename*',$sitename,$settingsdata);
	$settingsdata = str_replace("$publicURL = 'http://silvercrayon.com/cms2/'","$publicURL = '".$url."/'",$settingsdata);
	
	file_put_contents('settings.php',$settingsdata);
	
	$salt128 = getrandom(128);
	$passwordhash = hash('whirlpool',$pw.$salt128);
	file_put_contents('users/admin',$passwordhash.';'.$salt128);

	
	exit('Changes saved. Now <a href="./">Login as admin</a>');
	}

?>
  <span class="san13gray" style="font-size:33px;"><strong>Silvercrayon Quick Start</strong></span> </p>
<p>Welcome to the quick start form, it will help you get set up for first use.</p><form action="" method="post">
<table width="50%" border="0" cellpadding="12" cellspacing="0" class="san13">
  <tr>
    <td width="32%" align="right">Site Name:</td>
    <td width="68%">
    <input name="sitename" type="text" size="50" placeholder="www.mywebsite.com"></td>
  </tr>
  <tr>
    <td align="right">Site URL:</td>
    <td><input name="url" type="text" size="50" placeholder="http://" ></td>
  </tr>
  <tr>
    <td align="right">New admin password:</td>
    <td><input name="pw" type="text" size="50" placeholder="Store this somewhere safe!" ></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td><input name="submit" type="submit" class="orangesubmitbox1" id="submit" value="Submit"></td>
  </tr>
</table></form>
<p>&nbsp;</p>
</body>
</html>