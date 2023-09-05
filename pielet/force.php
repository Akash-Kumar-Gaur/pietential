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

$_ .= file_get_contents( "styles.css" );

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>refresh</title>
</head>

<body>
    
    Click <a href="styles.css?reload=<?php echo date( 'Y-m-d-h-i-s' ); ?>">here</a> to reload the style sheet
    <script >
    
    
    
    </script>
</body>
</html>