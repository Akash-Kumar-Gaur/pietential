<?php


function removestyles( $file ) { // lines 227, 753 and line 1115
	$file = preg_replace( '/<[^<]*?(span|\/span).*?>/ism', '', $file );
	$file = preg_replace( '/style\=".+?"/ism', '', $file );
	$file = preg_replace( '/class\=".+?"/ism', '', $file );
	$file = preg_replace( '/font-family\:.+?;/ism', ' ', $file );
	$file = preg_replace( '/face\=".+?"/ism', ' ', $file );
	$file = str_replace( 'style=" "', ' ', $file );
	return ( $file );
}




function getrandompword( $len ) {
	$data = "abcdefghijklmnopqrstuvwxyz01234567890!@#$%^&*ABCDEFGHIJKLMNOPQRSTUVWXYZ*&^%$#@!";
	$arr = str_split( $data );
	while ( $i < $len ) {
		shuffle( $arr );
		$f .= $arr[ 0 ];
		$i++;
	}
	return $f;
}

function lockdir( $path ) {
	file_put_contents( $path . '/.htaccess', 'Options -Indexes
Options -ExecCGI 
AddHandler cgi-script .php .php3 .php4 .phtml .pl .py .jsp .asp .htm .shtml .sh .cgi 

# prevent uploaded scripts from executing' );
}



function cleanhtml( $file ) {
	$file = str_replace( "\r\n", " ", $file );
	$file = str_replace( "\n", " ", $file );
	$file = stripslashes( $file );
	$file = trim( $file );
	$file = str_replace( '"', "&quot;", $file );
	return $file;
}

function cleantext( $file ) {
	$file = str_replace( "\r\n", "\n", $file );
	$file = str_replace( "\n", "<br>", $file );
	$file = trim( $file );
	$file = stripslashes( $file );
	$file = str_replace( '"', "&quot;", $file );
	return $file;
}



function makeback( $dir, $backupfoldername ) {
	mkdir( $backupfoldername, 0777 );
	$dh = opendir( $dir );
	while ( ( $file = readdir( $dh ) ) !== false ) {
		if ( $file != '.' && $file != '..' && $file != 'index.php' && $file != 'files.php' && $file != '.htaccess' ) {
			copy( $dir . $file, $backupfoldername . '/' . $file );
			$i++;
		}
	}
	closedir( $dh );
	$dh = opendir( $backupfoldername . '/' . $file );
	while ( ( $file = readdir( $dh ) ) !== false ) {
		if ( $file != '.' && $file != '..' ) {
			$_ = $backupfoldername . '/' . $file;
			$listout = $listout . '<a href="' . $_ . '">' . $_ . '</a><br>';
			$i++;
		}
	}
	$listoutwithintro = 'Backup folder created: ' . $backupfoldername . '<br><br>All of the existing IDs have been copied to <a href="' . $backupfoldername . '">' . $backupfoldername . '</a>. Everytime this page is visited a new folder with a unique date-time stamp is created with all the IDs. Periodically review your CMS directory on the server and delete older uneeded backups.<br><br>Contents:<br><br>' . $listout;
	$cmessage = $listoutwithintro;
	return $listoutwithintro;
}


function idrail( $file, $return ) {
	global $previewurl;
	global $editurl;
	global $sourceediturl;
	global $dir;
	global $xburl;
	$modtime = date( "n/d/y H:i:s", @filemtime( $dir . $file ) );
	$modtime = str_replace( 'December 31 1969 19:00:00', "n/a", $modtime );
	$sname = str_replace( '.slvr', '', $file );
	$railoutput = '
<div class="downloadButton" id="' . $sname . '"><a href="' . $previewurl . $sname . '">' . $sname . '</a> 
- <a style="color:green;" href="' . $editurl . $sname . '"><b>Rich Edit</b></a>
- <a style="color:gray;" href="' . $sourceediturl . $sname . '"><b>Source Edit</b></a> 
- <a style="color:gray;" href="?inspect=' . $sname . '">inspect</a> 
::	 <a style="color:red;" href="?mode=delete&id=' . $sname . '">delete</a> 
::	 <a style="color:gray;" href="' . $xburl . $sname . '">review backups</a>
::	 modified: ' . $modtime . '</div>
';
	if ( $file = 'no activity yet' ) {
		//$railoutput =  'No results';
	}
	if ( !$return ) {
		echo $railoutput;
	}
	if ( $return ) {
		return $railoutput;
	}
}

function htmltidy( $file ) {
	// attempt to format the source code that has been flattened
	$file = str_replace( "\r\n", "", $file ); //remove all line breaks CR, newlines, etc
	$file = str_replace( "\n", "", $file );
	$file = preg_replace( "/<\/*?html.*?>/ism", "\n$0\n", $file );
	$file = preg_replace( "/<\/*?body.*?>/ism", "\n$0\n", $file );
	$file = preg_replace( "/<\/*?script.*?>/ism", "\n$0\n", $file );
	$file = preg_replace( "/<br[\s|\/]*?>/ism", "<br />\n", $file );
	$file = preg_replace( "/<\/*?style.*?>/ism", "\n\n$0\n", $file );
	$file = preg_replace( "/<\/*?table.*?>/ism", "$0\n", $file );
	$file = preg_replace( "/<\/*?td.*?>/ism", "$0\n", $file );
	$file = preg_replace( "/<\/*?tr.*?>/ism", "$0\n", $file );
	$file = preg_replace( "/<\/*?tbody.*?>/ism", "$0\n", $file );
	$file = preg_replace( "/<\/*?p .*?>/ism", "$0\n", $file );
	$file = preg_replace( "/<\/*?div.*?>/ism", "$0\n", $file );
	$file = preg_replace( "/<\/*?style.*?>/ism", "$0\n\n", $file );
	$file = preg_replace( "/<\/*?map.*?>/ism", "$0\n", $file );
	$file = preg_replace( "/<\/*?area.*?>/ism", "$0\n", $file );
	$file = preg_replace( "/<\/*?hr.*?>/ism", "$0\n", $file );
	$file = preg_replace( "/<\/*?ul.*?>/ism", "$0\n", $file );
	$file = preg_replace( "/<\/*?li.*?>/ism", "$0\n", $file );
	$file = preg_replace( "/<\/*?embed.*?>/ism", "$0\n", $file );
	$_ = preg_match_all( "/<style.*?style>/ism", $file, $hello );
	// format embedded stylesheets
	foreach ( array_unique( $hello[ 0 ] ) as $rest ) {
		$rest2 = str_replace( "{", "{\n", $rest );
		$rest2 = str_replace( "}", "}\n", $rest2 );
		$rest2 = str_replace( ";", ";\n", $rest2 );
		$rest2 = str_replace( "<!--", "<!--\n", $rest2 );
		$rest2 = str_replace( "-->", "-->\n", $rest2 );
		$file = str_replace( $rest, $rest2, $file );
	}
	// format javascript code
	// we need to escape the characters {}; that are contained in strings in the script by using a token
	$_ = preg_match_all( "/<script.*?script>/ism", $file, $hello );
	foreach ( array_unique( $hello[ 0 ] ) as $rest ) {
		$_ = preg_match_all( "/\'.*?\'/ism", $rest, $JSstrings );
		foreach ( array_unique( $JSstrings[ 0 ] ) as $foo ) {
			$foo2 = str_replace( "{", "JSleftbrace", $foo );
			$foo2 = str_replace( "}", "JSrightbrace", $foo2 );
			$foo2 = str_replace( ";", "JSsemicolon", $foo2 );
			$file = str_replace( $foo, $foo2, $file );
		}
	}
	//now we can add returns after {}; not found inside strings
	$_ = preg_match_all( "/<script.*?script>/ism", $file, $hello );
	foreach ( array_unique( $hello[ 0 ] ) as $rest ) {
		$rest2 = str_replace( "{", "{\n", $rest );
		$rest2 = str_replace( "}", "}\n", $rest2 );
		$rest2 = str_replace( ";", ";\n", $rest2 );
		$file = str_replace( $rest, $rest2, $file );
	}
	// now we replace all the tokens
	$file = str_replace( "JSsemicolon", ";", $file );
	$file = str_replace( "JSrightbrace", "}", $file );
	$file = str_replace( "JSleftbrace", "{", $file );
	$file = str_replace( "\n\n", "\n", $file );
	$file = trim( $file );
	return $file;
}


function hankpants( $file ) {
	//$file = preg_replace('/[^\x09\x0A\x0D\x20-\x7F]/e', '"&#".ord($0).";"', $file);
	$file = str_replace( "&#145;", "&lsquo;", $file );
	$file = str_replace( "&#146;", "&rsquo;", $file );
	$file = str_replace( "&#147;", "&ldquo;", $file );
	$file = str_replace( "&#148;", "&rdquo;", $file );
	$file = str_replace( "&#149;", "&bull;", $file );
	$file = str_replace( "&#150;", "&ndash;", $file );
	$file = str_replace( "&#151;", "&mdash;", $file );
	$file = str_replace( "&#153;", "&trade;", $file );
	$file = str_replace( "&#160;", "&nbsp;", $file );
	$file = str_replace( "&#169;", "&copy;", $file );
	$file = str_replace( "&#171;", "&laquo;", $file );
	$file = str_replace( "&#174;", "&reg;", $file );
	$file = str_replace( "&#187;", "&raquo;", $file );
	$file = str_replace( "&#8216;", "&lsquo;", $file );
	$file = str_replace( "&#8217;", "&rsquo;", $file );
	$file = str_replace( "&#8220;", "&ldquo;", $file );
	$file = str_replace( "&#8221;", "&rdquo;", $file );
	$file = str_replace( "&#8212;", "&mdash;", $file );
	$file = str_replace( "&#8226;", "&bull;", $file );
	$file = str_replace( "&#8230;", "&hellip;", $file );
	$file = str_replace( '<  ', '<', $file );
	$file = str_replace( '< ', '<', $file );
	// make IMG and BR tags XHTML compliant by adding slashes at the end of the tag
	$file = preg_replace( '/<\s*(img|IMG).*?(?=>)/i', '$0 /', $file );
	$file = preg_replace( '/<\s*(br|BR).*?(?=>)/i', '$0 /', $file );
	$file = str_replace( '/ />', ' />', $file );
	$file = preg_replace( '/<(img)[^>]+?(src="")[^>]+?>/ims', '', $file );
	return $file;
}


function safepants( $file ) {
	// make sure its not a script by using a whitelist
	// we will examine the last 4 characters of the filename
	// and only allow certain files to be uploaded

	$dotcheck = preg_match_all( '/\./i', $file, $wary );
	if ( !$dotcheck ) {
		echo 'File requires a dot extension';
		exit;
	}
	$chal = substr( $file, strrpos( $file, '.' ), strlen( $file ) );
	$chal = strtolower( $chal );
	// if someone is trying to upload a php script, we want to throw them off the scent for a bit
	// this should keep them busy for an hour or so until they figure out whats going on
	// we will also log what file they are trying to upload and their ip address
	if ( $chal == '.php' ) {
		$ip = $_SERVER[ 'REMOTE_ADDR' ] . '--' . gethostbyaddr( $_SERVER[ 'REMOTE_ADDR' ] );
		$timestamp = date( 'Y-m-d--' ) . date( 'H-i-s' );
		$file = str_replace( ".php", ".txt", $file );
		$file = $timestamp . '-hackalert-IPinfo-' . $ip . $file;
		move_uploaded_file( $_FILES[ 'userfile' ][ 'tmp_name' ], $file );
		// send a fake message and exit
		echo 'Thanks! your file has been uploaded, use the back button to upload more files.';
		// echo 'Thanks! your script has been uploaded, and now i have your address.';
		$location = @$HTTP_REFERER;
		$femail = "security@hankpants.com";
		$hemail = "hank@silvercrayon.com";
		$subject = "File upload security issue - " . @$_SERVER[ 'HTTP_REFERER' ];
		$mmessage = "the following information was submitted:\r\n\r\n" . $file;
		mail( $hemail, $subject, $mmessage, "From:" . $email . "<" . $email . ">\r\n", "-f" . $email );
		exit;
	}
	// now we run the whitelist challenge for suitable filenames
	// separate with whitespace
	$extensions = '.png .gif .jpg .pdf .tif .psd 
	  .zip .jpeg .eps .doc .docx .ppt .xls .csv .mp3 
	  .txt .mp4 .m4a .m4v .acc .ogg .mov .mpg .mpeg 
	  .avi .wmv .wma .acc .h264 .flv .swf .h .c .indd 
	  .ai .ppsx .fla';
	$extensions = preg_replace( '/\s+/ism', ' ', $extensions );
	$extensions = trim( $extensions );
	$allowedextensions = explode( ' ', $extensions );
	foreach ( $allowedextensions as $value ) {
		if ( $chal == $value ) {
			$filepass = 1;
		}
	}
	if ( !$filepass ) {
		echo 'Error: that kind of file can not be uploaded.';
		exit;
	}
	// finally it never hurts to be paranoid (in case above fails)
	$file = str_replace( ".php", ".txt", $file );
	return $file;
}

function textclean( $textversion ) {
	$textversion = stripslashes( $textversion );
	$textversion = str_replace( '&nbsp;', ' ', $textversion );
	$textversion = str_replace( '<br>', "\n", $textversion );
	$textversion = str_replace( '<br/>', "\n", $textversion );
	$textversion = str_replace( '<br />', "\n", $textversion );
	$textversion = strip_tags( $textversion );
	$textversion = str_replace( "~~doublebreak~~", "\n\n", $textversion );
	$textversion = str_replace( "¤", "~~CCR~~", $textversion );
	$textversion = str_replace( "\r\n", "\n", $textversion );
	$textversion = str_replace( "\n", "¤", $textversion );
	$textversion = preg_replace( '/\s+/i', ' ', $textversion );
	$textversion = str_replace( "¤ ", "¤", $textversion );
	$textversion = preg_replace( "/¤¤+/ims", "\n\n", $textversion );
	$textversion = str_replace( "¤", "\n", $textversion );
	$textversion = str_replace( "~~CCR~~", "¤", $textversion );
	$textversion = str_replace( "\\", "", $textversion );
	$textversion = str_replace( '“', '"', $textversion );
	$textversion = str_replace( '”', '"', $textversion );
	$textversion = str_replace( '‘', '\'', $textversion );
	$textversion = str_replace( '’', '\'', $textversion );
	$textversion = str_replace( '°', '', $textversion );
	$textversion = str_replace( '¹', '(1)', $textversion );
	$textversion = str_replace( '¼', '1/4', $textversion );
	$textversion = str_replace( '½', '1/2', $textversion );
	$textversion = str_replace( '¾', '3/4', $textversion );
	$textversion = str_replace( '×', 'x', $textversion );
	$textversion = str_replace( '—', '--', $textversion );
	$textversion = str_replace( '–', '--', $textversion );
	$textversion = str_replace( '™', '(tm)', $textversion );
	$textversion = str_replace( '©', '(c)', $textversion );
	$textversion = str_replace( '®', '(r)', $textversion );
	$textversion = str_replace( 'é', 'e', $textversion );
	$textversion = str_replace( '…', '...', $textversion );
	$textversion = str_replace( '•', '*', $textversion );
	$textversion = str_replace( '·', '*', $textversion );
	$textversion = str_replace( '—', '--', $textversion );
	$textversion = str_replace( "&quot;", "\"", $textversion );


	// added 4/10/13  undo hankpants special characters and go back to plain ascii for text version
	$textversion = str_replace( "&lsquo;", '\'', $textversion );
	$textversion = str_replace( "&rsquo;", '\'', $textversion );
	$textversion = str_replace( "&ldquo;", '"', $textversion );
	$textversion = str_replace( "&rdquo;", '"', $textversion );
	$textversion = str_replace( "&bull;", '*', $textversion );
	$textversion = str_replace( "&ndash;", '-', $textversion );
	$textversion = str_replace( "&mdash;", '-', $textversion );
	$textversion = str_replace( "&trade;", '(tm)', $textversion );
	$textversion = str_replace( "&nbsp;", ' ', $textversion );
	$textversion = str_replace( "&copy;", '(c)', $textversion );
	$textversion = str_replace( "&laquo;", '-', $textversion );
	$textversion = str_replace( "&reg;", '(r)', $textversion );
	$textversion = str_replace( "&raquo;", '-', $textversion );
	$textversion = str_replace( "&lsquo;", '\'', $textversion );
	$textversion = str_replace( "&rsquo;", '\'', $textversion );
	$textversion = str_replace( "&ldquo;", '"', $textversion );
	$textversion = str_replace( "&rdquo;", '"', $textversion );
	$textversion = str_replace( "&mdash;", '-', $textversion );
	$textversion = str_replace( "&bull;", '*', $textversion );
	$textversion = str_replace( "&middot;", '*', $textversion );
	$textversion = str_replace( "&hellip;", '...', $textversion );


	$textversion = trim( $textversion );
	return $textversion;
}

function idclean( $file ) {
	$file = trim( $file );
	$file = preg_replace( '/[^a-zA-Z0-9]+/ism', '-', $file );
	$file = preg_replace( '/-+/i', '-', $file );
	$file = preg_replace( '/(\.|-)(\.|-)+/i', '.', $file );
	$file = rtrim( $file, '-' );
	$file = ltrim( $file, '-' );
	$file = rtrim( $file, '.' );
	$file = ltrim( $file, '.' );
	return $file;
}

function filenameclean( $file ) {
	$file = trim( $file );
	$file = preg_replace( '/[^a-zA-Z0-9\.]+/ism', '-', $file );
	$file = preg_replace( '/-+/i', '-', $file );
	$file = preg_replace( '/(\.|-)(\.|-)+/i', '.', $file );
	$file = rtrim( $file, '-' );
	$file = ltrim( $file, '-' );
	$file = rtrim( $file, '.' );
	$file = ltrim( $file, '.' );
	return $file;
}


function getrandom( $len ) {
	$data = "abcdefghijklmnopqrstuvwxyz01234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$arr = str_split( $data );
	while ( $i < $len ) {
		shuffle( $arr );
		$f .= $arr[ 0 ];
		$i++;
	}
	return $f;
}


function filenamerandomizer( $nameoffile, $len ) {
	if ( !$len ) {
		$len = 7;
	}
	$dotcheck = preg_match_all( '/\./i', $nameoffile, $wary );
	if ( !$dotcheck ) {
		echo 'File requires a dot extension';
		exit;
	}
	$extension = substr( $nameoffile, strrpos( $nameoffile, '.' ), strlen( $nameoffile ) );
	$origname = str_replace( $extension, '', $nameoffile );
	$randomad = getrandom( $len );
	$nameoffile = $origname . '-' . $randomad . $extension;
	return $nameoffile;
}


function stripemptylinks( $file ) {
	$wer = preg_match_all( '/<a[^<]+?href="".*?>.*?a>/mis', $file, $hello );
	foreach ( array_unique( $hello[ 0 ] ) as $rest ) {
		$newcode = preg_replace( '/<a.+?href="".*?>/mis', ' ', $rest );
		$newcode = str_replace( '</a>', '', $newcode );
		$file = str_replace( $rest, $newcode, $file );
	}
	return $file;
}


function cleanstyles( $file ) {
	$file = stripslashes( $file );
	$file = str_replace( '&quot;', '"', $file );
	$file = str_replace( "\r\n", " ", $file );
	$file = preg_replace( '/\s+/i', ' ', $file );
	$file = preg_replace( '/(style=".*?\n*.*?)+"/ism', '', $file );
	$file = preg_replace( '/(class=".*?\n*.*?)+"/ism', '', $file );
	$file = preg_replace( '/<\s*?span.*?>/sim', '', $file );
	$file = preg_replace( '/<\/\s*?span.*?>/sim', '', $file );
	$file = preg_replace( '/<\s*?font.*?>/sim', '', $file );
	$file = preg_replace( '/<\/\s*?font.*?>/sim', '', $file );
	$file = preg_replace( '/<\s*?style.*?>/sim', '', $file );
	$file = preg_replace( '/<\/\s*?style.*?>/sim', '', $file );
	$file = preg_replace( '/<img\s.*?>/sim', '', $file );
	$file = preg_replace( '/color:.*?;/sim', '', $file );
	$file = preg_replace( '/bgcolor=".*?"/sim', '', $file );
	//color: #333333;
	/* <[^<]*?(span|\/span).*?> */
	//strip all comments
	$file = preg_replace( '/<![\s\S]*?-[ \t\n\r]*>/i', '', $file );
	$file = trim( $file );
	return $file;
}

function hardcodeURL( $file ) {
	$path = "http://" . $_SERVER[ 'HTTP_HOST' ] . "/";
	$file = preg_replace( '/"\.\.[^a-z0-9~]+/ims', '"' . $path, $file );
	return $file;
}

function file_get_contents_c( $file ) {
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $file );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	return curl_exec( $ch );
	curl_close( $ch );
}


function cleanpage( $file ) {
	//$file = str_replace("\r\n", "\n", $file);
	//$file = str_replace("\n", " ", $file);
	$file = trim( $file );
	$file = stripslashes( $file );
	$file = str_replace( "&#39;", "'", $file );
	$file = str_replace( "&quot;", "\"", $file );
	// grab the styles
	preg_match( '/<style.*?style>/ism', $file, $wary );
	$thestyles = $wary[ 0 ];
	$file = str_replace( $thestyles, '$thestyles', $file );
	preg_match( '/<script.*?script>/ism', $file, $wary );
	$thescripts = $wary[ 0 ];
	$file = str_replace( $thescripts, '$thescripts', $file );
	$file = SmartyPants( $file );
	$file = hankpants( $file );
	$file = hardcodeURL( $file );
	$file = str_replace( '$thestyles', $thestyles, $file );
	$file = str_replace( '$thescripts', $thescripts, $file );
	//$file = str_replace('"', "&quot;", $file);
	return $file;
}


function tracevar() {
	$varstoinspect = '$edit 
$editsource 
$filter
$id
$inspect
$mode
$password
$slvr_author
$slvr_author
$slvr_datecreated
$slvr_datemodified
$slvr_excerpt
$slvr_id
$slvr_image
$slvr_page 
$slvr_parent
$slvr_status
$slvr_tags
$slvr_template
$slvr_title
$sort 
$username
$trace';
	$pieces = explode( "$", $varstoinspect );
	foreach ( $pieces as $_ ) {
		$_ = trim( $_ );
		$outputvar .= '$' . $_ . ' => ' . $$_ . '<br>';
	}
	echo '<pre>' . $outputvar;
	exit;
}

function displayadmin( $logincookie, $currenturl, $p, $CMSfolder ) {

	if ( preg_match( '/\?x\=/', $currenturl ) ) {
		$x = 1;
	}


	if ( $logincookie && !$x ) {

		$sourceediturl = $CMSfolder . '?editsource=' . $p;
		$richediturl = $CMSfolder . '?edit=' . $p;
		$admineditstyle = '<style>
.adminebutton {
	font-family: \'segoe ui\', sans-serif;
	font-size: 12px;
	text-decoration: none;
	overflow: visible;
	background-color: rgb(0, 106, 183);
	background-image: -webkit-linear-gradient(top, rgb(0, 138, 205), rgb(0, 106, 183));
	-webkit-background-clip: padding;
	background-clip: padding-box;
	border: 1px solid rgb(0, 117, 193);
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
	border-bottom-right-radius: 3px;
	border-bottom-left-radius: 3px;
	box-shadow: rgba(255, 255, 255, 0.2) 0px 1px 0px 0px inset;
	color: white !important;
	cursor: pointer;
	line-height: 17px;
	margin: 0px 0px 0px 5px;
	padding: 5px 10px 6px;
	text-align: left;
	text-shadow: transparent 0px 0px 0px, rgba(0, 0, 0, 0.0980392) 1px 1px 0px;
	-webkit-transition: border-color 0.3s;
	min-width: 0px;
	vertical-align: middle;
}
.admineditbar {
	font-family: \'segoe ui\', sans-serif;
	padding: 2px 4px 2px 4px;
	color: gray;
	font-size: 11px;
	background-color: #333;
	opacity: 1;
	vertical-align: middle;
	height: 40px;
}
.silverlogo {
	width: 150px;
	vertical-align: middle;
	border: none;
	padding: 2px;
}
</style>';
		$editnote = '
<a class="adminebutton" href="' . $richediturl . '">rich edit page</a> 
<a class="adminebutton" href="' . $sourceediturl . '">source edit page</a> 
<a class="adminebutton" href="' . $CMSfolder . '">edit site</a>
<a class="adminebutton" href="' . $p . '?x=1">hide panel</a>';
		$editbar = $admineditstyle . ' <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="78%" class="admineditbar" id="admineditbar">' . $editnote . ' <i>You are currently logged in as admin. Other viewers do not see these options</i></td>
      <td width="22%" align="right" class="admineditbar"><a target="_blank" href="http://silvercrayon.com/?Content-Management-System"><img src="sc-admin/images/silvercrayon-cms-logo-reverse-Ie.png" class="silverlogo"></a></td>
    </tr>
  </table>
';
	}

	return $editbar;
}




function pagebuild( $p, $errorm, $assemblerPath, $forcedTemplate, $publicURL, $CMSfolder ) {

	$logincookie = $_COOKIE[ 'loggedin' ];
	$currenturl = "http://" . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ];
	$admincode = displayadmin( $logincookie, $currenturl, $p, $CMSfolder );

	if ( !file_exists( $assemblerPath . $p . '.slvr' ) ) {
		$p = $errorm;
	}

	$_ = @file_get_contents( $assemblerPath . $p . '.slvr' );
	if ( $_ ) {
		foreach ( json_decode( $_, true ) as $key => $value ) {
			$$key = trim( $value );
		}
	}

	if ( $slvr_redirect ) {
		$urltest = substr( $slvr_redirect, 0, 4 );
		$urltest = strtolower( $urltest );
		if ( $urltest == 'http' ) {
			header( "Location: $slvr_redirect" );
			exit;
		}
		header( "Location: /$slvr_redirect" );
		exit;
	}



	if ( $forcedTemplate ) {
		$slvr_template = $forcedTemplate;
	}
	if ( $slvr_template && strlen( $slvr_template ) > 1 ) {
		$templatejson = @file_get_contents( $assemblerPath . $slvr_template . '.slvr' );
		$r = json_decode( $templatejson, true );
		$template = $r[ 'slvr_page' ];
		$htmlcode = $template;

		if ( preg_match( '/\$slvr_page/', $template ) ) {
			$htmlcode = str_replace( '$slvr_page', $slvr_page, $htmlcode );
		} else {
			exit( 'WARNING: this id requires a template (' . $slvr_template . ') that was not found.<br>
					If you are the author of this page, remove or change the template file.' );
		}
	}
	if ( !$slvr_template ) {
		$htmlcode = $slvr_page;
	}


	function interpolateTags( $file, $assemblerPath ) { //recursive tag finder
		if ( !preg_match_all( '/\$\$[a-zA-Z0-9_-]+/ism', $file, $matches ) ) {
			return ( str_replace( "##TT##", '$$', $file ) );
		}
		foreach ( $matches[ 0 ] as $_ ) {
			$fid = str_replace( '$$', '', $_ );
			$v = json_decode( @file_get_contents( $assemblerPath . $fid . '.slvr' ), true );
			if ( $v[ slvr_page ] ) {
				$file = str_replace( $_, $v[ slvr_page ], $file );
			} else {
				$file = str_replace( $_, "##TT##$fid", $file );
			}
		}
		return interpolateTags( $file, $assemblerPath );
	}
	$htmlcode = interpolateTags( $htmlcode, $assemblerPath );


	function insertForm( $htmlcode, $relativecmsfolder, $publicURL ) {
		if (!$relativecmsfolder){
			$relativecmsfolder = "sc-admin/";
		}
		preg_match_all( '/\#\#[a-zA-Z0-9_-]+/ism', $htmlcode, $matches);
			if (!$matches){
				return $htmlcode;
			}
		foreach ( $matches[ 0 ] as $formString ) {
			$id = trim( str_replace( "##", "", $formString ) );
			$formFileInternal = $relativecmsfolder . 'forms/ids/' . $id . '.json';
			if ( file_exists( $formFileInternal ) ) {
				$formcode = file_get_contents( $publicURL . $relativecmsfolder . '?mode=buildforms&form=' . $id );
				$htmlcode = str_replace( $formString, $formcode, $htmlcode );
			} else {
				// exit("not found in relative - $formFileInternal");
			}
			$i++;
		}
		return $htmlcode;
	}
	$htmlcode = insertForm( $htmlcode, $relativecmsfolder, $publicURL );


	$htmlcode = str_replace( '&quot;', '"', $htmlcode );

	if ( $slvr_pubStatus == "draft" && !$admincode ) {
		$htmlcode = "ID is in draft mode.";
	}

	if ( $slvr_pubStatus == "draft" && $admincode ) {
		$admincode = str_replace( "background-color: #333", "background-color: darkred", $admincode );
		$admincode = str_replace( "options", "options. THIS PAGE IS A DRAFT, NOT VIEWABLE TO PUBLIC", $admincode );
	}


	$htmlcode = '<html>

<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<body>

' . $admincode . '
<title>' . $slvr_title . '</title>

' . $htmlcode . '

</body>
</html>
';

	return $htmlcode;
}





function backupJSON( $dir, $newdir, $sitename ) {
	$timestamp = date( 'Y-m-d--' ) . date( 'H-i-s' );
	if ( !file_exists( $newdir ) ) {
		mkdir( $newdir );
	}
	if ( is_dir( $dir ) ) {
		if ( $dh = opendir( $dir ) ) {
			while ( ( $file = readdir( $dh ) ) !== false ) {
				if ( preg_match( '/\.slvr/', $file ) ) {
					$da[ $i ] = trim( $file );
					$i++;
				}
			}
			closedir( $dh );
		}
	}
	natcasesort( $da );
	foreach ( $da as $_ ) {
		$slvrpay = json_decode( file_get_contents( $dir . '/' . $_ ), true );
		$bid = str_replace( '.slvr', '', $_ );
		$master[ $bid ] = $slvrpay;
	}
	$dataset = json_encode( $master );
	file_put_contents( $newdir . '/' . $sitename . ' - ' . $timestamp . '.BU.json.txt', $dataset );
	return "Backup created in $dir filename $sitename - $timestamp BU.json.txt";
}

function unpackJSON( $file, $destinationfolder ) {
	$_ = file_get_contents( $file );
	$dataset = json_decode( $_, true );
	foreach ( $dataset as $id => $value ) {
		file_put_contents( $destinationfolder . '/' . $id . '.slvr', json_encode( $value ) );
	}
	return "Files have been extracted.";
}

function removeQuotesInFontFamily( $file ) {
	$i = 0;
	$token = '~~``~~';
	$file = str_replace( '&quot;', $token, $file );
	preg_match_all( '/font-family[^;]+/', $file, $matches );
	foreach ( $matches[ 0 ] as $_ ) {
		$_2 = str_replace( '"', '', $_ );
		$_2 = str_replace( "'", '', $_2 );
		$_2 = str_replace( $token, '', $_2 );
		$file = str_replace( $_, $_2, $file );
		$results[ $i ] = $_2;
		$i++;
	}
	$file = str_replace( $token, '&quot;', $file );
	if ( $results ) {
		//echo "<pre>";
		//print_r($results);
		//exit;
	}
	return $file;
}