<?php
//error_reporting( 0 );
extract( $_GET );
extract( $_POST );
date_default_timezone_set( 'America/Chicago' );
$phpTimeNow = date( 'Y-m-d--H-i-s' );
$phpUnixDay = strtotime( date( 'Y-m-d' ) );

if ($savePNG){
$savePNG = trim( $savePNG );
// $savePNG = str_replace( " ", "", $savePNG );
file_put_contents( "pngdata.txt", $savePNG );

$decodedData = base64_decode( preg_replace( '#^data:image/\w+;base64,#i', '', $savePNG ) );
$iname = $_COOKIE[ LifeBalanceID ] . ".png";
file_put_contents( $iname, $decodedData );
exit;
}


        ?>

        <html>


        <div style="border:0;">
            <form id="chartimage" action="pngsaver.php" method="post">
                <input type="input" name="savePNG" id="pinput"> <input type="submit">
            </form>
        </div>




        <script>
            //    localStorage.LifeBalanceformData = <?php echo ($master)?>
            //    location.assign("/?reloaded");

            var nform = ``;
            var resultsURL = `http://pietential.com/?generate=${localStorage.LifeBalanceID}`;
            pinput.value = localStorage.chartPNG;
            
            
             document.addEventListener( "DOMContentLoaded", function ( event ) {
                 chartimage.submit();
                 
             });
        </script>



        </html>