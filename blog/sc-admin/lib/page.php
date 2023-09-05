<?php

$p = $_GET['p'];
$currenturl = trim($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

if (preg_match('/\?p\=/', $currenturl)) {
	header('Location: ./' . $p);
	exit;
}

if (preg_match('/\/$/', $currenturl) && $p) {
	$p = str_replace('/', '', $p);
	header('Location: /' . $p);
	exit;
}
if (!$p) {
	$p = 'home'; // if no p is supplied serve the home page by assigning the parameter home | you can also make this a 404
}
$pageFailID = '404'; // this is the ID that is displayed when an ID is not found (a 404 error, so we would need an ID named '404')
$forcedTemplate = ''; // force a template if you like
// this builds the page from the ID
echo pagebuild($p, $pageFailID, $assemblerPath, $forcedTemplate, $publicURL, $CMSfolder);
/*
check out the function pagebuild if you need more control over how the page is generated
*/