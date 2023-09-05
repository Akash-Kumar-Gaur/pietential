<?php
$id = $edit;
$opmode = 'Rich Edit';
$today = date("F j, Y");
$timestamp = date('Y-m-d--').date('H-i-s');
$lastslash = strrpos($data,"/");
$mode='rich-edit';
if ($_GET[recover]){
$datac = @file_get_contents('history/'.$_GET[recover]);
}
else {
$datac = @file_get_contents('ids/'.$id.'.slvr');
}
if ($datac){
foreach (json_decode($datac,true) as $key=>$value) 
{ 
$$key = $value; 
}
}
// now look for an older version of the id manager
if (!$datac){
$ty = @file('ids/'.$id);
$slvr_page = $ty[10];
$slvr_title = $ty[0];
$slvr_template = $ty[0];
if (!$confirmupdate and $slvr_page){
$cmessage .=('An older version of this ID was encountered. To convert it to the new data format. <a href="?edit='.$id.'&confirmupdate=1">Click here</a> or use the back button to return to ID list.');
$mode = 'notice about older IDs format';
$loadhalt = 1;
}
}

$slvr_page = str_replace("\\", "", $slvr_page);
$slvr_page = str_replace('&quot;', '"', $slvr_page);
//$slvr_page = htmltidy($slvr_page);
$slvr_page = trim($slvr_page);
if (!$slvr_author){
$slvr_author = $_COOKIE['slvr_author'];
}



?>

<link rel="icon" type="image/png" href="<?php echo $iconurl ?>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
body {
font-size: 13px;
}
.style1 {

font-size: 11px;
}
.ed_button {

font-size: 9px;
}
a:link {
color: #006699;
text-decoration: none;
}
a:visited {
color: #006699;
text-decoration: none;
}
a:hover {
color: #006699;
text-decoration: underline;
}
a:active {
color: #006699;
text-decoration: none;
}
.style7 {
color: #FF0000
}
.style7 {
color: #009900
}
-->
</style>
<script type="text/javascript" src="<?PHP echo $editcodeurl ?>"></script>
<link href="lib/silvercrayon.css" rel="stylesheet" type="text/css">
<body style="font-size: 13px; color: #333333; margin-left: 0px;
margin-top: 00px;
margin-right: 0px;
margin-bottom: 00px;">
<form name="f1" method="post" action="<?PHP echo $processurl ?>" >
<!--<input name="mode" type="hidden" id="mode" value="<?PHP echo $mode ?>">-->
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#EFEFEF" style="font-size: 11px;  color: #333333;">
<tr>
<td bgcolor="#FFFFFF" style="padding: 40px;">
<p align="left"><a href="./"><img src="images/silvercrayon-cms-logo-250-RGB.png" alt="silverCMS" width="250" height="74" border="0" /></a></p>
<p align="left"><strong>Edit Content</strong> Mode </p>
<p align="left"><a href="./" class="graybutton"><strong>View available IDs</strong></a> <a href="?mode=medialist" target="_blank" class="graybutton" ><strong>Upload photo/file</strong></a> <strong>TIP</strong>: paste as plain text by using crtl-shift-V<br>
&nbsp;<br>
<strong>Current ID:</strong> &nbsp;<span class="style7">
<input name="id" type="text" class="style1" id="id" value="<?php echo idclean($id) ?>">
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Page Title:</strong> <span class="style7">
<input name="slvr_title" type="text" class="style1" value="<?php echo $slvr_title ?>" size="40">
</span> <strong>Template to use</strong> &nbsp;
<input name="slvr_template" type="text" class="style1" value="<?php echo $slvr_template ?>" size="20">
&nbsp;&nbsp;Draft? 
  <input type="checkbox" name="slvr_pubStatus" value="draft" id="slvr_pubStatus" <?php if($slvr_pubStatus=="draft"){echo "checked";}?>>

<input name="Process" type="submit" class="orangesubmitbox1" id="Process" value="Process">
</p>
<hr size="1" noshade>
<p align="left"><strong>Main Body:</strong><br>
<textarea name="slvr_page" rows="50" style="height:100%;" class="ckeditor" id= "editor1"><?php echo $slvr_page ?></textarea>
<br>
<br>
Excerpt: <br><textarea name="slvr_excerpt" rows="3" style="width:600px; height:200px; font-family:segoe ui, sans-serif;"><?php echo $slvr_excerpt ?></textarea>
<br>
Author: <br><input name="slvr_author" style="font-family:segoe ui, sans-serif;" value="<?php echo $slvr_author ?>">
<br>
Tags: <br><input name="slvr_tags" style="font-family:segoe ui, sans-serif;" value="<?php echo $slvr_tags ?>">
<br>
Redirect:<br>
<input name="slvr_redirect" style="font-family:segoe ui, sans-serif;" value="<?php echo $slvr_redirect ?>">
<br>
</p>
<p>
<input name="slvr_account" type="hidden" value="<?php echo $username ?>">
<input type="submit" class="orangesubmitbox" value="Process">
</p>
<p>&nbsp;</p></td>
</tr>
</table>
<script>
CKEDITOR.replace( 'editor1',
{
toolbar :
[
[ 'Source','-','Save'],
[ 'Bold','Italic','RemoveFormat' ] ,
[ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ],
'/', [ 'Link','Unlink' ],
[ 'Font','FontSize' ] ,
[ 'TextColor' ],
[ 'Maximize', 'ShowBlocks'] 
]
});
CKEDITOR.config.font_names = 'Arial;Times New Roman;georgia;Verdana';
CKEDITOR.config.fontSize_sizes = '9px/9px;10px/10px;11px/11px;12px/12px;14px/14px;16px/16px;20px/20px;24px/24px;30px/30px';
CKEDITOR.config.pasteFromWordRemoveFontStyles = true;
CKEDITOR.config.autoParagraph = false;
CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
CKEDITOR.config.height = 800;
</script>
</form>


