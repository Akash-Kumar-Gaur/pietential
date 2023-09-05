<?php
extract( $_GET );
extract( $_POST );
date_default_timezone_set( 'America/New_York' );
$timestamp = date( 'Y-m-d--' ) . date( 'H-i-s' );

makeThumb("../uploads/pexels-fauxels-3184360-1500-rHJY.jpg");

function makeThumb($pathToImage){
    $subfolder = "../uploads/thumbs/";
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
        echo "<br>the chal is $chal";
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
        echo "<br>the iname is $newiname";
		$newiname = "$newiname.jpg";
        echo "<br>the iname is $newiname";
        echo "<br>the new name  is $newiname";
		imagejpeg( $image_p, $subfolder . $newiname, 90 );
        //imagejpeg( $image_p, $newiname, 90 );
		imagedestroy( $image_p );
    }
}


