<?


$h = '#Options -Indexes
#Options -ExecCGI 
#AddHandler cgi-script .php3 .php4 .phtml .pl .py .jsp .asp .htm .shtml .sh .cgi .txt .csv
# prevent uploaded scripts from executing
<files "*.csv"> 
deny from all 
</files>
<files "*.json"> 
deny from all 
</files>';

file_put_contents(".htaccess", $h);