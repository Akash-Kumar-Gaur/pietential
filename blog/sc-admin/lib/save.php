<?php
$slvr_id = idclean($id);
$slvr_id = stripslashes($slvr_id);
$slvr_id = str_replace(".php", "", $slvr_id);
$slvr_id = str_replace(".", "-", $slvr_id);
$slvr_id = cleanpage($slvr_id);

$slvr_page = stripslashes($slvr_page);
$slvr_page = nukeStyles($slvr_page);////////////////////// added 9/1
$slvr_page = cleanpage($slvr_page);
$slvr_page = removeQuotesInFontFamily($slvr_page);
$slvr_title = stripslashes(trim($slvr_title));
$slvr_title = cleanpage($slvr_title);
$slvr_template = stripslashes($slvr_template);
$slvr_datemodified = time();
$slvr_excerpt = stripslashes($slvr_excerpt);
$slvr_excerpt = cleanpage($slvr_excerpt);
$slvr_tags = stripslashes($slvr_tags);
$slvr_author = stripslashes($slvr_author);
$slvr_encoding = 'JavaScript Object Notation (JSON)';

function nukeStyles($_){
    $_ = trim($_);
	$_ = preg_replace('/style="[^"]+"/ism', ' ',$_);
    $_ = preg_replace('/class="[^"]+"/ism', ' ',$_);
    return $_;
}


$slvrpay = array(
	'slvr_id' => $slvr_id,
	'slvr_title' => $slvr_title,
 	'slvr_template' => $slvr_template,
	 'slvr_page' => $slvr_page,
	'slvr_tags' => $slvr_tags,
	'slvr_excerpt' => $slvr_excerpt,
	'slvr_author' => $slvr_author,
	'slvr_image' => $slvr_image,
	'slvr_datecreated' => $slvr_datecreated,
	'slvr_datemodified' => $slvr_datemodified,
	'slvr_status' => $slvr_status,
	'slvr_parent' => $slvr_parent,
	'slvr_encoding' => $slvr_encoding,
	'slvr_account' => $slvr_account,
	'slvr_redirect' => $slvr_redirect,
	'slvr_pubStatus' => $slvr_pubStatus
	);
	
	
$dataset = json_encode($slvrpay);
file_put_contents('ids/'.$slvr_id.'.slvr', $dataset);
lockdir('ids');

if (!file_exists('history')){
	mkdir('history');
	lockdir('history');
	}
if (file_exists('ids/'.$slvr_id)){
	//unlink('ids/'.$slvr_id);// this removes the wrongly named ID
	}	
$timestamp = date('Y-m-d--').date('H-i-s');
file_put_contents('history/'.$id.'-lastsaved-'.$timestamp.'.slvr', $dataset);
lockdir('history');	
header("Location: ".$previewurl.$slvr_id); 
exit;
