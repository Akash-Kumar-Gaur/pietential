<?php

$sort = $_GET[ 'sort' ];
$filter = $_GET[ 'filter' ];
// alpha sort
// if the sort var and the filter var are defined we will sort by date or name
$dir = $shortpathtoIDfolder;
if ( $sort == 'alpha' && !$cmessage && !$filter ) {
	$i = 0;
	if ( is_dir( $dir ) ) {
		if ( $dh = opendir( $dir ) ) {
			while ( ( $file = readdir( $dh ) ) !== false ) {
				if ( $file != '.' && $file != '..' && $file != 'index.php' && $file != 'files.php' && $file != '.htaccess' ) {
					$narray[ $i ] = $file;
					$i++;
				}
			}
			closedir( $dh );
		}
	}
	if ( $narray[ 0 ] == '' ) {
		$narray[ 0 ] = "Nothing to report!";
	}
	natcasesort( $narray );
	$narray = array_values( $narray );
	for ( $i = 0; $i < sizeof( $narray ); $i++ ) {
		$nar2 = $narray[ $i ];
		idrail( $nar2, false );
	}
}
////////////////////////////////////////////////////////////
// if the sort var and the filter var are defined we will sort by date or name
// date sort
if ( $sort == 'date' || !$sort && !$cmessage && !$filter ) {
	$i = 0;
	if ( is_dir( $dir ) ) {
		if ( $dh = opendir( $dir ) ) {
			while ( ( $file = readdir( $dh ) ) !== false ) {
				if ( $file != '.' && $file != '..' && $file != 'index.php' && $file != 'files.php' && $file != '.htaccess' ) {
					$tt = filemtime( $dir . $file );
					$we[ $i ] = $tt . $file;
					$i++;
				}
			}
			closedir( $dh );
		}
	}
	if ( $we[ 0 ] == '' ) {
		$we[ 0 ] = '0000000000no activity yet';
		echo 'No results';
		$empty = 1;
	}
	rsort( $we );
	$we = array_values( $we );
	for ( $i = 0; $i < sizeof( $we ); $i++ ) {
		$nar2 = substr_replace( $we[ $i ], '', 0, 10 );
		$rid = strlen( $nar2 ) - 10;
		$nar3 = substr_replace( $nar2, '', $rid, strlen( $nar2 ) );
		if ( !$empty ) {
			idrail( $nar2, false );
		}
	}
}
//this is the same as date sort but using a filter, old default was alpha sort
if ( $filter ) {
	$i = 0;
	if ( is_dir( $dir ) ) {
		if ( $dh = opendir( $dir ) ) {
			while ( ( $file = readdir( $dh ) ) !== false ) {
				if ( $file != '.' && $file != '..' && $file != 'index.php' && $file != 'files.php' && $file != '.htaccess' && preg_match( '/' . $filter . '/i', $file ) ) {
					$tt = filemtime( $dir . $file );
					$we[ $i ] = $tt . $file;
					$i++;
				}
			}
			closedir( $dh );
		}
	}
	if ( $we[ 0 ] == '' ) {
		$we[ 0 ] = '0000000000no activity yet';
		echo 'No results matched "' . $filter . '"';
		$empty = 1;
	}
	rsort( $we );
	$we = array_values( $we );
	for ( $i = 0; $i < sizeof( $we ); $i++ ) {
		$nar2 = substr_replace( $we[ $i ], '', 0, 10 );
		$rid = strlen( $nar2 ) - 10;
		$nar3 = substr_replace( $nar2, '', $rid, strlen( $nar2 ) );
		if ( !$empty ) {
			idrail( $nar2, false );
		}
	}
}
// template sort 
if ( $sort == 'template' && !$cmessage ) {
	$i = "0";
	if ( is_dir( $dir ) ) {
		if ( $dh = opendir( $dir ) ) {
			while ( ( $file = readdir( $dh ) ) !== false ) {
				if ( preg_match( "/template/i", $file ) && $file != '.' && $file != '..' && $file != 'index.php' && $file != 'files.php' && $file != '.htaccess' ) {
					$tt = filemtime( $dir . $file );
					$we[ $i ] = $tt . $file;
					$i++;
				}
			}
			closedir( $dh );
		}
	}
	if ( $we[ 0 ] == '' ) {
		$we[ 0 ] = "0000000000no activity yet";
	}
	rsort( $we );
	$we = array_values( $we );
	for ( $i = 0; $i < sizeof( $we ); $i++ ) {
		$nar2 = substr_replace( $we[ $i ], '', 0, 10 );
		$rid = strlen( $nar2 ) - 10;
		$nar3 = substr_replace( $nar2, '', $rid, strlen( $nar2 ) );
		idrail( $nar2, false );
	}
}