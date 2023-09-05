<?php

//update-sc-admin.php
// must be run inside sc-admin

extract( $_GET );
extract( $_POST );
header( "Access-Control-Allow-Origin: *" );
header( "Content-Type: text/plain" );

$library = 'lib/backup.php
lib/browse.php
lib/createnewuser.php
lib/delete.php
lib/edit.php
lib/editsource.php
lib/forms.php
lib/functions.php
lib/htmlclean.php
lib/inspect.php
lib/list.php
lib/login.php
lib/manageusers.php
lib/mediaget.php
lib/medialist.php
lib/mediamanage.php
lib/page.php
lib/read.php
lib/save.php
lib/settings.php
lib/silvercrayon.css
lib/silverdrop.php
lib/smartypants.php
lib/textclean.php
lib/update.php';

$rootFiles = 'index.php
README.html
quickstart.php
silverdrop.php
xbu.php';



$loc = '//' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ];
// should out put //www.silvercrayon.com/cms2/sc-admin/update-sc-admin.php

if ( preg_match( '/silvercrayon\.com\/cms2\//i', $loc ) ) {


	if ( $read ) {
		if ( $read == "root" ) {
			$_ = explode( "\n", $rootFiles );
		} else {
			$_ = explode( "\n", $library );
		}
		foreach ( $_ as $a ) {
			$a = trim( $a );
			$h[ $a ] = file_get_contents( "$a" );
		}
		echo json_encode( $h );
		exit;
	}



	echo "you are at silvercrayon\n";
	$_ = glob( './*' );
	foreach ( $_ as $a ) {
		if ( !is_dir( $a ) ) {
			echo "$a\n";
		} else {
			$arrayOfFolders[] = $a;
		}
	}

	print_r( $arrayOfFolders );
	foreach ( $arrayOfFolders as $a ) {
		$_ = glob( "$a/*" );
		foreach ( $_ as $b ) {
			echo "$b\n";
		}



	}
	exit;
}





$dirsToMake = 'BU-JSON
api
forms
history
images
ids
lib
uploads
users
uploads/thumbs
forms/results
forms/ids';

$extra = 'uploads/thumbs
forms/results
forms/ids';

$_ = explode( "\n", $dirsToMake );

foreach ( $_ as $a ) {
	$a = trim( $a );
	if ( !is_dir( $a ) ) {
		mkdir( $a );
	}
}


$h = file_get_contents( "http://silvercrayon.com/cms2/sc-admin/update-sc-admin.php?read=readLibrary" );

if ($read="root"){
	$h = file_get_contents( "http://silvercrayon.com/cms2/sc-admin/update-sc-admin.php?read=root" );
} else {
	$h = file_get_contents( "http://silvercrayon.com/cms2/sc-admin/update-sc-admin.php?read=library" );
}

//$h["lib/libtest.txt"] = "hello world";
//$h["lib/libtest2.txt"] = "hello again";
//$h = json_encode($h);
//exit;





$t = json_decode( $h, true );
foreach ( $t as $key => $value ) {
	file_put_contents( $key, $value );
}




//print_r($t);









exit;