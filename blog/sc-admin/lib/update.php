<?php
extract( $_GET );
extract( $_POST );
header("Access-Control-Allow-Origin: *");


$j = 'backup.php
browse.php
createnewuser.php
delete.php
edit.php
editsource.php
forms.php
functions.php
htmlclean.php
inspect.php
list.php
login.php
manageusers.php
mediaget.php
medialist.php
mediamanage.php
page.php
read.php
save.php
silvercrayon.css
silverdrop.php
smartypants.php
textclean.php
update.php';

$json = json_encode($j);



if ($update){
	header("Content-Type: text/plain");
	$arr = explode("\n",$j);
	foreach ($arr as $_){
		
		$_ = trim($_);
		$pagename = $_;
		$_ = file_get_contents("http://silvercrayon.com/pageserver.php?rpage=cms2/sc-admin/lib/$_");
		$_ = str_replace("\r\n","\n",$_);
		$jpack[$pagename] = $_;
		//$jpack[] = "$pagename^^$_";
		$f .= "\n\nPAGENAME: $pagename\n\n$_";
		}
		//echo $f;
		//echo $json;
		$j2 = json_encode($jpack);
		echo $j2;
		exit;
}
	
	
	if($confirm){
		foreach ($jpack as $key => $value){
		file_put_contents($key,$value);
		}
	}
	





if($rpage){
header("Content-Type: text/plain");
$_ = file_get_contents($rpage);
echo $_;
exit;
}


if ($glob){
	$_= glob("cms2/sc-admin/lib/*");
	foreach($_ as $e){
		$w = str_replace("cms2/sc-admin/lib/","",$e);
		echo "<a href='?update=$e'>update $w</a><br>";
		}
}

//http://192.168.1.113:8080/DLS/pageserver.php?rpage=editR96.php



?>
This utility returns the library files of silvercrayon CMS in JSON. place this file in /sc-admin/lib to update silvercrayon. it does not update settings .php


<a href="http://silvercrayon.com/pageserver.php?update=1">http://silvercrayon.com/pageserver.php?update=1</a>
<?

/*

<iframe id="youtube" allow="autoplay; encrypted-media" allowfullscreen="" frameborder="0"  src="https://www.youtube.com/embed/4HTUb7stcM8" style="width:100%;"></iframe>


<script>
// iframe resizer for youtube
// assuming you want the width to be 100%
function resizeWidthYoutube(e){
var widthofvideo = document.getElementById(e).clientWidth;
var videoratio  = .5625; // 16x9 video
var heightofvideo = widthofvideo*videoratio;
e.style.height = heightofvideo;
}
resizeWidthYoutube("youtube");
</script>*/

?>
