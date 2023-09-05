<?php
echo "<!-- start of media get-->\n\n\n";
$mode = $_POST[mode];
$maxwidth = $_POST[maxwidth];
$url = $_POST[url];
$photopadding = $_POST[photopadding];
$photoalt = $_POST[photoalt];
$photoalign = $_POST[photoalign];
lockdir('uploads');
$opmode = 'Mediabucket';
$domain = $_SERVER['HTTP_HOST'];
$filepath = $_SERVER['SCRIPT_NAME'];
$lastslash = strrpos($filepath,"/");
$path = substr($filepath, 0, $lastslash);
$hi = "//".$domain . $path."/";
$fullpath = $hi.'uploads/'.$id.'.html';
$newname = basename($_FILES['userfile']['name']);
$file_size=$_FILES['userfile']['size'];
$filek = $file_size / 1024;
$filek = round($filek,1);
if($file_size >= 6000000){
echo "Your file size is over limit<BR>";
echo "Your file size = ".$filek;
echo " K";
echo "<BR>File size limit = 6000 k";
exit;
}
$filesizemessage = 'Original file size: '.$filek.'kb.<br><br>';
$newname = filenameclean($newname);
$newname = strtolower($newname); 
$newname = str_replace('.jpeg','.jpg',$newname);
$newname = safepants($newname);
$newname = filenamerandomizer($newname, 4);
$extension = substr($newname, strrpos($newname,'.'), strlen($newname));
if (preg_match ('/\.png|\.gif|\.jpg|\.jpeg/i', $extension))
{ 
$isimage = '1';
}
$uploaddir = 'uploads/';
$uploadfile = $uploaddir . $newname;
// Add the original filename to our target path. Result is "uploads/filename.extension" 
$target_path = $target_path . $newname; 
$target_path = "uploads/";
$target_path = $target_path . $newname; 
$photo = $newname;
$newurl = $hi.'uploads/'.$photo;
move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path);
$imageData = getImageSize($target_path);
$idim = $imageData[3];
if($imageData) {
$displayphoto = '<img src= "'.$newurl.'" align= "'.$photoalign.'" hspace= "'.$photopadding.'" border="0" alt="'.$photoalt.'" '.$idim.' >';
$displayphoto = stripslashes ($displayphoto);
$displayphoto = str_replace("```", '"', $displayphoto);
}
if($url) {
$displayphoto = '<a href="'.$url.'">'.$displayphoto.'</a>';
}
if ($maxwidth){
list($width, $height, $type, $attr)=getimagesize($target_path); 
}
if($width>$maxwidth & $isimage){
$proxyurl = $reproxyurl.'?maxwidth='.$maxwidth.'&newurl='.$newurl;
//$proxyurl = 'http://creative.epsinternet.com/apps/reproxy/?maxwidth='.$maxwidth.'&newurl='.$newurl;
$reimage = file_get_contents($proxyurl);
$reimage = trim($reimage);
$simage = file_get_contents($reimage);
//$simage = file_get_contents('http://silvercrayon.com/apps/reproxy/golf-ball-Twlw.jpg-resampled-100.gif');
//echo $reimage; echo $simage;
$proxyname = substr($reimage, strrpos($reimage,'/'), strlen($reimage));
$proxyname = str_replace('/','',$proxyname);
$proxyname = 'uploads/'.$proxyname;
$fp = fopen($proxyname,'w');
fwrite($fp,$simage);
fclose($fp);
unlink ($target_path);
lockdir('uploads');
$newurl = $hi.$proxyname;
$imageData = getImageSize($proxyname);
$idim = $imageData[3];
$file_size= filesize ($proxyname);
$filek2 = $file_size / 1024;
$filek2 = round($filek2,1);
$filesizemessage = 'Original file size: '.$filek.'kb<BR>New file size: '.$filek2.'kb.<br><br>';
$displayphoto = '<img src= "'.$newurl.'" align= "'.$photoalign.'" hspace= "'.$photopadding.'" border="0" alt="'.$photoalt.'" '.$idim.' >';
$displayphoto = stripslashes ($displayphoto);
$displayphoto = str_replace("```", '"', $displayphoto);
if($url) {
$displayphoto = '<a href="'.$url.'">'.$displayphoto.'</a>';
}
}
/*
header("Location: ?mode=medialist");
exit;
*/
$mode = "medialist";
$dir = 'uploads/';
if ($f1 == 'display'){
$filepath = $_SERVER['SCRIPT_NAME'];
$lastslash = strrpos($filepath,"/");
$path = substr($filepath, 0, $lastslash);
$hi = "//".$domain . $path."/".$dir;
$img = $hi.$img;
$cmessage = $cmessage . 'Image preview of '.$img;
$cmessage = $cmessage . '<br /><br /><img src="'.$img.'" border="0" style="max-width:800px;"><br /><br /><br /><br />';
}
if($mode == 'mediaget'){
$cmessage = $cmessage . '<table width = "100%"><tr><td><b>'.$filesizemessage.' Here is the path to the file:</b><br><a href="'.$newurl.'">'.$newurl.'</a><br><br>
';
if ($isimage){
$cmessage = $cmessage . '<b>Here is the HTML code to display the image:</b><br><form name="form1" method="post" action="">
<textarea name="textarea" cols="100" rows="6" class="style1">'.$displayphoto.'</textarea>
</form><br><br>';
$cmessage = $cmessage . '<b>Here is how the image will appear <br>
(You can highlight the image with your mouse, select copy, <br>
and hit paste in your editor if you are using an web based HTML editor.):</b><br><br>'.$displayphoto;
$cmessage = $cmessage . '</td></tr></table>';
}
}
if (!$printlimit){
$printlimit = 25;
}
$i="0";
if (is_dir($dir)) {
if ($dh = opendir($dir)) {
while (($file = readdir($dh)) !== false ) {
if ($file!='.' && $file!='..'&& $file!='index.php'&& $file!='files.php' && $file!='.htaccess')
{
$we[$i] = filemtime($dir.$file).$file;
$i++;
}
}
closedir($dh);
}
} 
rsort($we);
$we = array_values($we);
$iloop = count ($we);
if ($iloop>$printlimit){
$iloop=$printlimit;
}
for($i=0; $i<$iloop; $i++){
$nar2 = substr_replace($we[$i], '', 0, 10);
$chal = substr($nar2, strrpos($nar2,'.')+1, strlen($nar2));
$chal = strtolower($chal);
if ($chal == 'jpg' || $chal == 'jpeg' || $chal == 'gif' || $chal == 'png' ||$chal == 'svg' )
{
$cmessage = $cmessage . '<a href="?f1=display&img='.$nar2.'&mode=medialist"><font color=""><b>'.$nar2.'</b></font></a> 
-- <a href="?mode=mediadelete&id='.$nar2.'"><font color="red">delete</font></a> 
Modified:'.date ("n/d/y", filemtime($dir.$nar2)).'
<hr align="left" size="1" height="1" noshade>' ;
}
else{
$cmessage = $cmessage . '<a href="uploads/'.$nar2.'"><font color=""><b>'.$nar2.'</b></font></a> 
-- <a href="?mode=mediadelete&id='.$nar2.'"><font color="red">delete</font></a> 
Modified:'.date ("F d Y", filemtime($dir.$nar2)).'
<hr align="left" size="1" height="1" noshade>' ;
}
}
$cmessage = $cmessage.'	
</td>
</tr>
</table>
</form>';