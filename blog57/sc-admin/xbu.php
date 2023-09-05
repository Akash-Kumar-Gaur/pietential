<?php

require_once 'lib/functions.php';
require_once 'lib/settings.php';
require_once 'lib/smartypants.php';


set_time_limit(300);


if (!$_POST[password]){$passwordhash = $_COOKIE[$cookiename];}
if (!$_POST[username]){$username = $_COOKIE['username'];}

if (!$username){
	$username='admin';
	}
	
$challenge = @file_get_contents('users/'.$username);

$_ = @file_get_contents('users/'.$username);
$_ = trim($_);
$F = explode(";",$_);
$challenge = trim($F[0]);
$storedsalt = trim($F[1]);
//$combine = $challenge.$storedsalt;
//$challenge = trim(hash('whirlpool',$combine));

if (!$challenge){echo 'Hash not set'; exit;}

if ($password){$passwordhash = (hash('whirlpool',$password.$storedsalt));}
if ($passwordhash == $challenge )
{
setcookie($cookiename,$passwordhash, time()+1814400,"/"); // 3 weeks
setcookie('username',$username, time()+1814400,"/"); // 3 weeks
setcookie('loggedin',1, time()+1814400,"/"); // 3 weeks
}
else
{
setcookie($cookiename,'', time()+1,"/"); // 3 weeks
$currenturl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'];
echo '<title>login</title>
<link href="silvercrayon.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/png" href="'.$iconurl.'">
<body>
<form enctype="multipart/form-data" action="./" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="10">
<tr valign="top">
<td width="29%"><img src="images/loginsign.png" width="73" height="69" align="right"> </td>
<td width="71%" style="	font-family: Arial, Helvetica, sans-serif;
color: #999999;
font-size: 80px;
letter-spacing:-4px;
text-shadow: silver 2px 2px 2px;"> login</td>
</tr>
<tr valign="top" >
  <td class="san13gray"><div align="right"><strong>Username:</strong></div></td>
  <td><input name="username" type="text" id="username" placeholder="admin" value="'.$username.'"></td>
</tr>
<tr valign="top" >
<td class="san13gray"><div align="right"><strong>Passphrase:</strong></div></td>
<td><input name="password" type="password" id="pass" placeholder="Enter your passphrase">
&nbsp;&nbsp;&nbsp;&nbsp; </td>
</tr>
<tr valign="top" class="style1">
<td>&nbsp;</td>
<td><p>
<input type="submit" class="orangesubmitbox1" value="enter">
</p></td>
</tr>
</table>
</form>
</body>
</html>
';
exit;
}
if ($_GET[mode] == 'logout'){ 
setcookie($cookiename,'', time()+1,"/"); // 3 weeks
header('Location: ./');
exit;
}


if ($_GET[edit]){
	
	// first lets make a backup of the current ID
	if (file_exists('ids/'.$_GET['file'].'.slvr')){
		$timestamp = date('Y-m-d--').date('H-i-s');
		$_ = file_get_contents('ids/'.$idname);
		file_put_contents('history/'.$id.'-lastsaved-'.$timestamp, $content);
		}
		//header ('Location: ./?edit='.$idname.'&recover=1');
		exit;
	
	}
 
if ($_GET[mode]=='preview'){
	if (file_exists('history/'.$_GET[file])){
		$_ = file_get_contents('history/'.$_GET[file]);
		//echo $_;
		foreach (json_decode($_,true) as $key=>$value) 
			{ 
			$$key = trim($value); 
			}
		echo $slvr_page;
		exit;
	}
}







$filter = trim($_GET[filter]);
$dir='history/';
$i="0";
if (is_dir($dir)) {
if ($dh = opendir($dir)) {
while (($file = readdir($dh)) !== false ) {
if ($file!='.' && $file!='..'&& $file!='index.php'&& $file!='files.php'&& $file!='.htaccess')
{ 
if ($filter && preg_match('/'.$filter.'/ism',$file) ){
$we[$i] = @filemtime($dir.$file).$file;
$i++;
}
if (!$filter) {
$we[$i] = @filemtime($dir.$file).$file;
$i++;
}
}
}
closedir($dh);
}
} 
@rsort($we);
$we = @array_values($we);
$iloop = count ($we);
$iloop = 2500;
$i=0;
if (!$we){
	$output = 'No results found for '.$filter;
	}
	else{
foreach ($we as $_){
	$_ = trim($_);
	$idcount ++;
	$file = substr_replace($_, '', 0, 10);
	$file = trim($file);
	$idname = preg_replace('/-lastsaved-.+/','',$file);
	$saveddate = str_replace($idname.'-lastsaved-','',$file);
	$saveddate = str_replace('.slvr','',$saveddate);
	$editurl = './?edit='.$idname.'-recovered&recover='.$file.'&kj=';
	$output .= '<div class="downloadButton"><a href="?mode=preview&file='.$file.'">'.$idname.'</a> <a href="'.$editurl.'" style="color:green;">recover/ edit</a> Last backup date: '.$saveddate."<br>\n</div>";
	//$output .= idrail($idname,true);
		}
	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="lib/silvercrayon.css" rel="stylesheet" type="text/css">
<link rel="icon" type="image/png" href="http://silvercrayon.com/silvercrayonicon.png">
<title>Silvercrayon- Content Management</title>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
window.open(theURL,winName,features);
}
//-->
</script>
<link href="silvercrayon.css" rel="stylesheet" type="text/css">
</head>
<body>
<p>
 
  <a href="./shell_files/shell.html"><img src="images/silvercrayon-cms-logo-250-RGB.png" alt="silverCMS" width="250" height="74" border="0"></a></p>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tbody>
    <tr valign="top">
      <td width="79%" bgcolor="#666666"><a style="color:white;" href="../"><b class="sitename">Site: <?php echo $sitename ?></b></a> &nbsp;&nbsp;&nbsp;<b style="font-size:18px; color:white;">Mode: Available Backups</b></td>
      <td width="21%" bgcolor="#666666"><div align="right"><b style="text-align:right; color:white;"><a style="color:white;" href="../">Site Preview</a> | <a style="color:white;" href="../">ID Manager</a></b></div></td>
    </tr>
  </tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tbody>
    <tr valign="top">
      <td bgcolor="#eeeeee"  style="padding:12px; font-size:12px;"><a href="./" class="graybutton"><strong>ID Manager</strong></a>&nbsp;<a href="./xbu.php" class="graybutton"><strong>See all backups</strong></td>
    </tr>
  </tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tbody>
    <tr valign="top" class="san12">
      <form name="form1" method="get" action="">
      </form>
      <td bgcolor="#E4E4E4">
<form>Filter: <input type="text" name="filter" value="<?php echo $filter ?>"> <input type="submit"></form></td>
    </tr>
  </tbody>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tbody>
    <tr valign="top" class="san12">
      <td width="163" bgcolor="#eeeeee" style="padding:12px; color:silver;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody>
            <tr>
              <td><p>&nbsp;</p></td>
              <td><img src="images/rightarrow.png" width="50" height="50"><br>
              Preview the ID by clicking the name. Recover the file by selecting recover. Remember to use a new name if you want to retain different versions.</td>
            </tr>
          </tbody>
        </table></td>
      <td bgcolor="#eeeeee" style="padding:12px;"><?php echo $output;?></td>
    </tr>
  </tbody>
</table>
<p><a href="./shell_files/shell.html"><img src="images/silvercrayon-cms-logo-250-RGB.png" alt="silverCMS" width="250" height="74" border="0"></a></p>
</body>
</html>






