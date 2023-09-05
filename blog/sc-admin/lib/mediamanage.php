<?php
$id = $_GET[id];
$pixel = $_GET[pixel];
if ($_GET[mode]=='mediaconfirmdelete' && $_GET[id] && $pixel){ 
$dir = 'uploads/';
@unlink($dir.$id);
header('Content-Type: image/gif');
echo base64_decode('R0lGODlhAQABAJAAAP8AAAAAACH5BAUQAAAALAAAAAABAAEAAAICBAEAOw==');
exit;
}
$cmessage = $cmessage . '
<div style = "position:absolute;
left:310px;
top:234px;
width:406px;
height:205px;
z-index:1;
background-color: #000000;">
<p align="center"><strong style="color:#FFFFFF"><span class="style99">ARE YOU SURE?</span> <br>
</strong></p>
<p align="center">
<a href="?mode=mediaconfirmdelete&id='.$id.'" class="orangesubmitbox1" style="color:white;">Yes, Delete '.$id.'</a>
<a href="?mode=medialist" class="orangesubmitbox1" style="color:white;">Cancel</a>
</p>
</div>';
if ($_GET[mode]=='mediaconfirmdelete'){ 
$dir = 'uploads/';
@unlink($dir.$id);	
$cmessage = $cmessage . $id.' deleted';
header('Location: ?mode=medialist');
}