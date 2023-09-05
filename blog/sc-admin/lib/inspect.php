<?php
	$mode = 'inspect';
	$cmessage =  '<pre>';
	$_ = json_decode(@file_get_contents('ids/'.$inspect.'.slvr'),true);
	foreach ($_ as $key=>$value) 
	{ 
	$cmessage .= '<b>'.htmlentities($key, ENT_QUOTES, "UTF-8");
	$cmessage .=  ' =></b> ';
	$cmessage .=  htmlentities($value, ENT_QUOTES, "UTF-8");
	$cmessage .=  '<br>';
	$cmessage .=  '<br>';
	}
	$cmessage .= '</pre>';


$helpmessage = 'This mode allows you to view the ID fields as a "raw" data table.';
	
	