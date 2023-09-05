<?php
extract( $_GET );
extract( $_POST );

$domain = $_SERVER[ 'HTTP_HOST' ];
$filepath = $_SERVER[ 'SCRIPT_NAME' ];
$lastslash = strrpos( $filepath, "/" );
$path = substr( $filepath, 0, $lastslash );
$hi = "http://" . $domain . $path . "/";

date_default_timezone_set( 'America/New_York' );
$timestamp = date( 'Y-m-d' );
//https://pietential.com/creatediv.php?account=ErlvGACECnWj
if ( $account ) {
    $_ .=  "localStorage.pieAccount = '$account';\n";
    $_ .= file_get_contents( "createDiv.js" );
    echo $_;
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script id='helloScript' src='https://pietential.com/creatediv.php?account=ErlvGACECnWj'></script>
</body>
</html>


