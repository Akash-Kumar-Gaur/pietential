<?php
$f1 = $_GET[f1];
$img = $_GET[img];
$mode = $_GET[mode];
if (!$mode) {
    $mode = $_POST[mode];
}
if ($_POST) {
    //print_r($_POST);
    //exit;
}
if (basename($_FILES['userfile']['name'])) {
    $maxwidth = $_POST[maxwidth];
    $url = $_POST[url];
    $photopadding = $_POST[photopadding];
    $photoalt = $_POST[photoalt];
    $photoalign = $_POST[photoalign];
    lockdir('uploads');
    $opmode = 'Mediabucket';
    $domain = $_SERVER['HTTP_HOST'];
    $filepath = $_SERVER['SCRIPT_NAME'];
    $lastslash = strrpos($filepath, "/");
    $path = substr($filepath, 0, $lastslash);
    $hi = "//" . $domain . $path . "/";
    $fullpath = $hi . 'uploads/' . $id . '.html';
    $newname = basename($_FILES['userfile']['name']);
    $file_size = $_FILES['userfile']['size'];
    $filek = $file_size / 1024;
    $filek = round($filek, 1);
    if ($file_size >= 6000000) {
        echo "Your file size is over limit<BR>";
        echo "Your file size = " . $filek;
        echo " K";
        echo "<BR>File size limit = 6000 k";
        exit;
    }
    $filesizemessage = 'Original file size: ' . $filek . 'kb.<br><br>';
    $newname = filenameclean($newname);
    $newname = strtolower($newname);
    $newname = str_replace('.jpeg', '.jpg', $newname);
    $newname = safepants($newname);
    $newname = filenamerandomizer($newname, 4);
    $extension = substr($newname, strrpos($newname, '.'), strlen($newname));
    if (preg_match('/\.png|\.gif|\.jpg|\.jpeg/i', $extension)) {
        $isimage = '1';
    }
    $uploaddir = 'uploads/';
    $uploadfile = $uploaddir . $newname;
    // Add the original filename to our target path. Result is "uploads/filename.extension" 
    $target_path = $target_path . $newname;
    $target_path = "uploads/";
    $target_path = $target_path . $newname;
    $photo = $newname;
    $newurl = $hi . 'uploads/' . $photo;
    move_uploaded_file($_FILES['userfile']['tmp_name'], $target_path);
    $imageData = getImageSize($target_path);
    $idim = $imageData[3];
    if ($imageData) {
        $displayphoto = '<img src= "' . $newurl . '" align= "' . $photoalign . '" hspace= "' . $photopadding . '" border="0" alt="' . $photoalt . '" ' . $idim . ' >';
        $displayphoto = stripslashes($displayphoto);
        $displayphoto = str_replace("```", '"', $displayphoto);
    }
    if ($url) {
        $displayphoto = '<a href="' . $url . '">' . $displayphoto . '</a>';
    }
    if ($maxwidth) {
        list($width, $height, $type, $attr) = getimagesize($target_path);
    }
    if ($width > $maxwidth & $isimage) {
        $proxyurl = $reproxyurl . '?maxwidth=' . $maxwidth . '&newurl=' . $newurl;
        //$proxyurl = 'http://creative.epsinternet.com/apps/reproxy/?maxwidth='.$maxwidth.'&newurl='.$newurl;
        $reimage = file_get_contents($proxyurl);
        $reimage = trim($reimage);
        $simage = file_get_contents($reimage);
        //$simage = file_get_contents('http://silvercrayon.com/apps/reproxy/golf-ball-Twlw.jpg-resampled-100.gif');
        //echo $reimage; echo $simage;
        $proxyname = substr($reimage, strrpos($reimage, '/'), strlen($reimage));
        $proxyname = str_replace('/', '', $proxyname);
        $proxyname = 'uploads/' . $proxyname;
        $fp = fopen($proxyname, 'w');
        fwrite($fp, $simage);
        fclose($fp);
        unlink($target_path);
        lockdir('uploads');
        $newurl = $hi . $proxyname;
        $imageData = getImageSize($proxyname);
        $idim = $imageData[3];
        $file_size = filesize($proxyname);
        $filek2 = $file_size / 1024;
        $filek2 = round($filek2, 1);
        $filesizemessage = 'Original file size: ' . $filek . 'kb<BR>New file size: ' . $filek2 . 'kb.<br><br>';
        $displayphoto = '<img src= "' . $newurl . '" align= "' . $photoalign . '" hspace= "' . $photopadding . '" border="0" alt="' . $photoalt . '" ' . $idim . ' >';
        $displayphoto = stripslashes($displayphoto);
        $displayphoto = str_replace("```", '"', $displayphoto);
        if ($url) {
            $displayphoto = '<a href="' . $url . '">' . $displayphoto . '</a>';
        }
    }
    header("Location: ?mode=medialist");
    exit;
} // end if files
if ($_POST[idata]) {
    //exit ("pasted data");
    $dir = "uploads/";
    //print_r($_POST);
    $imagepng = $_POST['idata'];
    $iname = $_POST['iname'];
    //echo "found image: $imagepng";
    if ($imagepng) {
        //echo "found imagepng";
        $imagepng = str_replace('"', '', $imagepng);
        $imagepng2 = str_replace("data:image/png;base64,", "", $imagepng);
        $decodedData = base64_decode($imagepng2);
        //$decodedData = file_get_contents($imagepng);
        $iname = $dir . $iname;
        file_put_contents($iname, $decodedData);
        $imageURL = $iname;
        $file_size = filesize($imageURL);
        $filek = $file_size / 1024;
        $filek = round($filek, 1);
        if ($filek > 200) {
            //if file size over 200k save as jpg	
            $image = imagecreatefrompng($imageURL);
            $newjpgname = str_replace(".png", ".jpg", $imageURL);
            imagejpeg($image, $newjpgname, 80);
            imagedestroy($image);
            unlink($imageURL);
            $imageURL = $newjpgname;
        }
        $ia = getimagesize($imageURL);
        $newurl = "$publicCMSfolder$imageURL";
        //exit($_FILES[ 'userfile' ][ 'tmp_name' ].$newurl);
        if ($ia[0] < 3) {
            //file_put_contents( "upload.txt", 'error' );
            unlink("$filename");
            exit("Wrong kind of file. - exiting. error 22");
        }
        //file_put_contents( "upload.txt", $filename );
        if ($ia[0] > 2000) {
            //echo $ia[0]; exit;
            //resample
            $maxwidth = 2000;
            $proxyurl = $reproxyurl . '?maxwidth=' . $maxwidth . '&newurl=' . $newurl;
            $reimage = file_get_contents($proxyurl);
            $reimage = trim($reimage);
            $simage = file_get_contents($reimage);
            $proxyname = substr($reimage, strrpos($reimage, '/'), strlen($reimage));
            $proxyname = str_replace('/', '', $proxyname);
            $proxyname = $dir . $proxyname;
            file_put_contents($proxyname, $simage);
            $testimage = $proxyname;
            file_put_contents("upload.txt", $proxyname);
            unlink($imageURL);
            $newurl = "$publicCMSfolder/uploads/$proxyname";
            $imageURL = $proxyname;
        }
    }
    header("Location: ?mode=medialist");
    exit;
}



function createThumbs()
{
    // create the thumbnail folder if it does not exist
    if (!file_exists("uploads/thumbs")) {
        mkdir("uploads/thumbs");
    }
    $filesInUploads = glob("uploads/*");
    foreach ($filesInUploads as $_) {
        $fileInThumb = str_replace("uploads", "uploads/thumbs", $_);
        if (!file_exists($fileInThumb)) {
            makeThumb($_);
        }
    }
}
createThumbs();


function makeThumb($pathToImage){
    $subfolder = "uploads/thumbs/";
    $iname = preg_replace('/.+\//',"", $pathToImage);
    //echo "<br>the iname is $iname";
    $maxwidth = 400;
    list( $width, $height, $type, $attr ) = getimagesize( $pathToImage );
    //echo "$width, $height, $type, $attr";
	if ( $width > $maxwidth ) {
		$diff = $width - $maxwidth;
		$percnt_reduced = ( ( $diff / $width ) * 100 );
		$ht = $height - ( ( $percnt_reduced * $height ) / 100 );
		$wd = $width - $diff;
		$ht = round( $ht, 0 );
		$wd = round( $wd, 0 );
		$chal = substr( $pathToImage, -4 );
		$chal = strtolower( $chal );
        //echo "<br>the chal is $chal";
		if ( $chal == '.png' ) {
			$im = @imagecreatefrompng( $pathToImage );
		}
		if ( $chal == '.jpg' ) {
			$im = @imagecreatefromjpeg( $pathToImage );
		}
		if ( $chal == '.gif' ) {
			$im = @imagecreatefromgif( $pathToImage );
		}
		// Resample
		$image_p = imagecreatetruecolor( $wd, $ht );
		@imagecopyresampled( $image_p, $im, 0, 0, 0, 0, $wd, $ht, $width, $height );
        $newiname = preg_replace('/\..+/ism',"", $iname);
        //echo "<br>the iname is $newiname";
		$newiname = "$newiname.jpg";
        //echo "<br>the iname is $newiname";
        //echo "<br>the new name  is $newiname";
		imagejpeg( $image_p, $subfolder . $newiname, 90 );
        //imagejpeg( $image_p, $newiname, 90 );
		imagedestroy( $image_p );
    }
}



//exit($mode);
$opmode = 'Mediabucket';
$cmessage = '<link href="//silvercrayon.us/dropzone/dropzone.css" type="text/css" rel="stylesheet" />
<script src="//silvercrayon.us/dropzone/dropzone.js"></script>
<form id="pasteform" style="display:none;" method="post">
<span id="lester" ></span>
<input id="idata" name="idata" type="hidden">
<input id="iname" name="iname" type="hidden">
<input name="mode" type="hidden" id="mode" value="mediaget"/>
<br><br>
<input type="submit" class="orangesubmitbox1" value="upload pasted image" method="post" action=""/><br>
</form>
<form enctype="multipart/form-data" id="mainform" method="post">
<input name="mode" type="hidden" id="mode" value=""/>
<table width="100%" border="0" cellpadding="6" cellspacing="0" class="style1">
<tr valign="top">
<td> </td>
<td class="san13gray">
<strong>Mediabucket uploader</strong> </td>
</tr>
<tr valign="top">
<td width="28%"><div align="right"><strong>File or image to upload</strong></div></td>
<td width="72%"><div align="left">
<input name="userfile" type="file" class="style1" id="userfile" size="50" />
<br />
6MB limit </div></td>
</tr>
<tr valign="top">
<td><div align="right"><span class="style2">New Width:</span></div></td>
<td><input name="maxwidth" type="text" class="style1" id="maxwidth" value="' . $maxwidth . '" />
<span class="style4">in pixels (<strong>optional</strong> - will resample if smaller than orig width)</span></td>
</tr>
<tr valign="top">
<td><div align="right"><strong>Image Align:</strong></div></td>
<td><div align="left">
<select name="photoalign" class="hinput" id="photoalign">
<option value="Right">Right</option>
<option value="Left">Left</option>
<option selected value="Default">Default</option>
</select>
<strong> (optional)</strong></div></td>
</tr>
<tr valign="top">
<td><div align="right"><strong>Image padding:</strong></div></td>
<td><div align="left">
<input name="photopadding" type="text" class="style1" id="photopadding" value="' . $photopadding . '" size="5" />
<strong> (optional)</strong></div></td>
</tr>
<tr valign="top">
<td><div align="right"><strong>Link URL for image:</strong></div></td>
<td><div align="left">
<input name="url" type="text" class="style1" id="url" value="' . $url . '" size="60" />
<strong> (optional)</strong></div></td>
</tr>
<tr valign="top">
<td> </td>
<td><div align="left"></form>
<input type="submit" class="orangesubmitbox1" value="upload image or file" /><br>
or use drag and drop:<br>
<iframe frameborder="0" height="340" src="silverdrop.php?dir=uploads/" width="640"></iframe>
</div></td>
</tr>
<tr valign="top">
<td><br /></td>
<td class="san13gray">
';
$dir = 'uploads/';
if ($f1 == 'display') {
    $filepath = $_SERVER['SCRIPT_NAME'];
    $lastslash = strrpos($filepath, "/");
    $path = substr($filepath, 0, $lastslash);
    $hi = "http://" . $domain . $path . "/" . $dir;
    $img = $hi . $img;
    $cmessage = $cmessage . 'Image preview of ' . $img;
    $cmessage = $cmessage . '<br /><br /><img src="' . $img . '" border="0" style="max-width:800px;"><br /><br /><br /><br />';
}
if ($mode == 'mediaget') {
    $cmessage = $cmessage . '<table width = "100%"><tr><td><b>' . $filesizemessage . ' Here is the path to the file:</b><br><a href="' . $newurl . '">' . $newurl . '</a><br><br>
';
    if ($isimage) {
        $cmessage = $cmessage . '<b>Here is the HTML code to display the image:</b><br><form name="form1" method="post" action="">
<textarea name="textarea" cols="100" rows="6" class="style1">' . $displayphoto . '</textarea>
</form><br><br>';
        $cmessage = $cmessage . '<b>Here is how the image will appear <br>
(You can highlight the image with your mouse, select copy, <br>
and hit paste in your editor if you are using an web based HTML editor.):</b><br><br>' . $displayphoto;
        $cmessage = $cmessage . '</td></tr></table>';
    }
}
if (!$printlimit) {
    $printlimit = 25;
}
$i = "0";
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != '.' && $file != '..' && $file != 'index.php' && $file != 'files.php' && $file != '.htaccess' && $file != 'thumbs') {
                $we[$i] = filemtime($dir . $file) . $file;
                $i++;
            }
        }
        closedir($dh);
    }
}
rsort($we);
$we = array_values($we);
$iloop = count($we);
if ($iloop > $printlimit) {
    $iloop = $printlimit;
}
for ($i = 0; $i < $iloop; $i++) {
    $nar2 = substr_replace($we[$i], '', 0, 10);
    $chal = substr($nar2, strrpos($nar2, '.') + 1, strlen($nar2));
    $chal = strtolower($chal);
    if ($chal == 'jpg' || $chal == 'jpeg' || $chal == 'gif' || $chal == 'png' || $chal == 'svg') {
        $cmessage = $cmessage . '
<div id="inforow-' . $nar2 . '">
<a href="?f1=display&img=' . $nar2 . '&mode=medialist"><img src="' . $dir . 'thumbs/' . $nar2 . '" style="width:50px;"> <font color=""><b>' . $nar2 . '</b></font></a> 
<br><Br>
<span id="confirmdeleteBox-' . $nar2 . '" style="display:none;">Are you sure you sure want to delete this item? <br><Br><a onclick="ajaxDelete(\'' . $nar2 . '\')" class="orangesubmitbox1 mediaButton mbLight">YES</a> <a onclick="idreset(\'deleteBox-' . $nar2 . '\');" class="orangesubmitbox1 mediaButton" >cancel</a></span>
<span id="deleteBox-' . $nar2 . '"><a onclick="confirmIDdelete(\'deleteBox-' . $nar2 . '\');" class="orangesubmitbox1 mediaButton mbLight" >delete</a>
</span> 
Modified:' . date("n/d/y", filemtime($dir . $nar2)) . '
<hr align="left" size="1" height="1" noshade class="pad10">
</div>
';
    } else {
        $cmessage = $cmessage . '
<div id="inforow-' . $nar2 . '">
<a href="uploads/' . $nar2 . '"><font color=""><b>' . $nar2 . '</b></font></a> 
<br><Br>
<span id="confirmdeleteBox-' . $nar2 . '" style="display:none;">Are you sure you sure want to delete this item? <br><Br><a onclick="ajaxDelete(\'' . $nar2 . '\')" class="orangesubmitbox1 mediaButton mbLight" >YES</a>
<a onclick="idreset(\'deleteBox-' . $nar2 . '\');" class="orangesubmitbox1 mediaButton" >cancel</a>
</span>
<span id="deleteBox-' . $nar2 . '"><a onclick="confirmIDdelete(\'deleteBox-' . $nar2 . '\');" class="orangesubmitbox1 mediaButton mbLight" >delete</a>
</span> 
Modified:' . date("F d Y", filemtime($dir . $nar2)) . '
<hr align="left" size="1" height="1" noshade class="pad10"><br>
</div>
';
    }
}
$scripts = '
<style>
.pad10{
margin:20px 0px 20px 0px;
}
.mediaButton, a.mediaButton:hover{
text-decoration:none;
cursor:pointer;
color:white;
padding:3px 10px;
border-color:#333;
background:#333;
}
.mbLight{
border: 1px solid #C93E29;
background-color: #D54937;
}
</style>
<div id="pixelJax" style="display:none;">hello</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script>
function confirmIDdelete(did){
console.log("confirm"+did);
document.getElementById(did).style.display = "none";
document.getElementById("confirm"+did).style.display = "unset";
}
function idreset(did){
document.getElementById(did).style.display = "unset";
document.getElementById("confirm"+did).style.display = "none";
}
function ajaxDelete(theid){
// use a pixel gif to delete
var newidname = "inforow-"+theid;
var delurl = "?mode=mediaconfirmdelete&id="+theid+"&pixel=1";
var jq = "#"+newidname;
$("#inforow\\-FZBDozSZr7EYSBn\\.jpg").slideUp(1000);
document.getElementById("pixelJax").innerHTML = "<img src=\'"+delurl+"\'>";
document.getElementById(newidname).style.display = "none";
}
function makeid(len) {
var text = "";
var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
for (var i = 0; i < len; i++)
text += possible.charAt(Math.floor(Math.random() * possible.length));
return text;
}
function _getImage(imgData)
{
var blob = imgData.getAsFile();
var URLObj = window.URL || window.webkitURL;
var source = URLObj.createObjectURL(blob);
var image = new Image();
image.src = source;
image.style.maxWidth = "600px";
document.getElementById("idata").value = image.src;
image.onload = function(ev) {
var reader = new FileReader();
reader.onload = function(e)
{
image.src = e.target.result;
var id = makeid(15)+".png";
document.getElementById("idata").value = e.target.result;
document.getElementById("iname").value = id;
document.getElementById("pasteform").style.display = "block";
//document.getElementById("mainform").style.display = "none";
//document.getElementById("filepicker").required = false;
};
reader.readAsDataURL(blob);
};
return image;
}
document.addEventListener("paste", function(e){
console.log("Got Paste.");
if (e.clipboardData && typeof e.clipboardData.items !== "undefined")
{
var items = e.clipboardData.items;
for (var i = 0; i < items.length; i++)
{
if (items[i].type.indexOf("image") != -1)
{
var image = _getImage(items[i]);
if (image) //paste the image
{
console.log("Got Image");
document.getElementById("lester").appendChild(image);
document.getElementById("mainform").style.display = "none";
//document.getElementById("lester")=image;
///document.getElementById("remind").style.display = "none";
//document.getElementById("forImage").innerHTML += image;
}
}
}
}
});
</script>
';
$cmessage = $cmessage . $scripts . '	
</td>
</tr>
</table>
</form>';
