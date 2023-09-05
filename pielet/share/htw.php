<?php
extract($_GET);
extract($_POST);

$pay = '
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^([^/][a-zA-Z0-9-_\/]+)$ index.php?userID=$1 [L]
# RewriteRule ^([^/][a-zA-Z0-9-]+)$ index.php?p=$1 [L]
</IfModule>';

file_put_contents(".htaccess", $pay);

?>

