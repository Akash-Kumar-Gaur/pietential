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
		//exit;
}
	
	
	if($confirm){
		foreach ($jpack as $key => $value){
		file_put_contents("lib/".$key,$value);
		}
	}
	





if($rpage){
header("Content-Type: text/plain");
$_ = file_get_contents($rpage);
echo $_;
exit;
}





















exit;







extract($_GET);
extract($_POST);
$dir = 'ids';
$newdir = 'slvrids';

date_default_timezone_set('America/New_York'); 
$timestamp = date('Y-m-d--').date('H-i-s');


function update_slvr($dir,$newdir){
if (!file_exists($newdir)) 
{
mkdir($newdir);
}
if (is_dir($dir)) {
if ($dh = opendir($dir)) {
while (($file = readdir($dh)) !== false) {
if (!preg_match ('/\.slvr/' , $file) 
and 
!preg_match ('/\.php/' , $file) 
and 
!preg_match ('/htacc/' , $file) 
and 
$file!='.' and $file!='..')
{ 
$da[$i] = trim($file);
$i++;
}
}
closedir($dh);
}
} 
natcasesort($da);
foreach ($da as $_){
echo 'Processing: <a href="'.$newdir.'/'.$slvr_id.'.slvr">'.$_."</a><br>\n";
$slvr_id = $_;
$arr = file($dir.'/'.$_);
$slvr_title = $arr[0];
$slvr_template = $arr[1];
$slvr_page = $arr[10];
$slvrpay = array(
'slvr_id' => trim($slvr_id),
'slvr_title' => trim($slvr_title),
'slvr_template' => trim($slvr_template),
'slvr_page' => trim($slvr_page),
'slvr_tags' => trim($slvr_tags),
'slvr_excerpt' => trim($slvr_excerpt),
'slvr_author' => trim($slvr_author),
'slvr_image' => trim($slvr_image),
'slvr_datecreated' => trim($slvr_datecreated),
'slvr_datemodified' => trim($slvr_datemodified),
'slvr_status' => trim($slvr_status),
'slvr_parent' => trim($slvr_parent),
'slvr_encoding' => 'JSON',
'slvr_JSON_update_date' => $timestamp
);
$dataset = json_encode($slvrpay);
file_put_contents($newdir.'/'.$slvr_id.'.slvr', $dataset);
//unlink($dir.$file);
}
}
update_slvr($dir,$newdir);
exit;