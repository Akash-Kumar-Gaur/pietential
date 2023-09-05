<?php
// begin form functions


foreach($_POST as $key => $value){
	
	if (preg_match('/<scrip/ism',$value) && $key !="Q4thanksMessage"){
		exit("an error occured");
		}
	
	}
$dmess[]="page loaded without script exit";

/*
modes:
if ($mode=='selectforms){}
if ($mode=='saveforms){}
if ($mode=='editforms){}
if ($mode=='deleteforms){}
if ($mode=='buildforms){}
if ($mode=='submitforms){}

iframeforms 
makepageforms
makecsvformseditforms
makespreadsheetforms
if (preg_match('/forms/i',$mode)){
require_once('forms.php');
}
*/
function fieldclean($file)
{
$file = trim($file);
$file = str_replace(",", '_', $file);
$file = preg_replace('/[^a-zA-Z0-9]+/ism', '-', $file);
$file = preg_replace('/-+/i', '-', $file);
$file = preg_replace('/(\.|-)(\.|-)+/i', '.', $file);
$file = rtrim($file, '-');
$file = ltrim($file, '-');
$file = rtrim($file, '.');
$file = ltrim($file, '.');
$file = str_replace("-", '_', $file);
return $file;
}
function makeCamel($_)
{
$_ = preg_replace('/[^a-zA-Z0-9]+/ism', ' ', $_);
preg_match_all('/\s+[a-zA-Z]/', $_, $matches);
foreach ($matches[0] as $file) {
$newfile = strtoupper($file);
$_ = str_replace($file, $newfile, $_);
}
$_ = str_replace(' ', '', $_);
$_ = substr($_, 0, 30);
$_{0} = strtolower($_{0});
return $_;
}
function makeSpreadSheet($file){
$htmlcode = @file_get_contents($file);
if (!$htmlcode) {
echo 'Nothing at URL ' . $file . ' Try again.';
exit;
}
$tdstyle = 'style="font-size:12px; padding:10px;"';
$tdstyle2 = 'style="font-size:12px; padding:10px; background:#eeeeee;"';
$i = 2;
function is_odd($int)
{
return ($int & 1);
}
if (is_odd($i)) {
$tdstyle = 'style="font-size:12px; padding:10px;"';
} else {
$tdstyle = 'style="font-size:12px; padding:10px; background:#eeeeee;"';
}
$htmlcode = trim($htmlcode);
$tablerows = explode("\n", $htmlcode);
$out .= "<table cellspacing=\"0\">\n";
foreach ($tablerows as $row) {
if (is_odd($i)) {
$tdstyle = 'style="font-size:12px; padding:10px;"';
} else {
$tdstyle = 'style="font-size:12px; padding:10px; background:#eeeeee;"';
}
$out .= "<tr>\n";
$tablecells = explode(",", $row);
foreach ($tablecells as $_) {
$out .= " <td " . $tdstyle . ">";
$out .= trim($_);
$out .= "</td>\n";
}
$out .= "</tr>\n";
$i++;
}
$spit = '<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<head>
<link href="lib/silvercrayon.css" rel="stylesheet" type="text/css" />
</head> 
<body style="line-height:2.5em;">'.$out. "</table>\n</body>";
return $spit;
}
$pagetop1 = '<!doctype html>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link href="//silvercrayon.us/css/fastforward.css" rel="stylesheet" type="text/css">
<link href="../lib/silvercrayon.css" rel="stylesheet" type="text/css">
';
$form = $_GET[form];
if (!$form) {
$form = $_POST[form];
}
$navBU = '<br><a href="./" class="graybutton">Forms Home</a> <a href="?new=1" class="orangesubmitbox1">New form</a><br><br>';
$timestamp = date('Y-m-d-') . date('H-i-s');
if ($mode == 'selectforms') {
$dir = 'forms/ids/';
$counter = 0;
if (is_dir($dir)) {
if ($dh = opendir($dir)) {
while (($file = readdir($dh)) !== false) {
if ($file != '.' && $file != '..' && $file != 'index.php' && $file != 'files.php' && preg_match('/\.json/', $file)) {
$jsonlist[$counter] = trim($file);
$counter++;
}
}
}
}
foreach ($jsonlist as $_) {
$_ = trim($_);
$_ = str_replace('.json', '', $_);
$cmessage .= '<div class="downloadButton"><b style="color:black;">' . $_ . '</b>: <a href="?mode=editforms&form=' . $_ . '">Edit</a> | <a href="?mode=buildforms&form=' . $_ . '">Preview</a> | <a href="?mode=iframeforms&form=' . $_ . '">Get iframe code</a> | <a href="?mode=makepageforms&form=' . $_ . '">Make a page with this form</a> | <a href="?mode=makecsvforms&form=' . $_ . '">Download results in CSV format</a> | <a href="?mode=makespreadsheetforms&form=' . $_ . '">View results in browser as spreadsheet</a> | <a href="?mode=deleteforms&form=' . $_ . '" style="color:red;">Delete</a></div>' . "\n";
}
$cmessage = '<a class="orangesubmitbox1" style="color:white;" href="?mode=editforms&form=My New Form">New form</a><br><br>'.$cmessage; 
} // end selectforms mode
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
$helpmessage = 'These are the forms you can edit or preview. Click the name to preview the page, </p>';
if ($mode == 'buildforms') {
$helpmessage = 'You are in form edit display mode</p>';
$theform = "forms/ids/" . $form . '.json';
if (file_exists($theform)) {
$_ = file_get_contents($theform) or die('Form not found');
} else {
exit("item not found");
}
$y = json_decode($_, true);
$pieces = explode("\n", $y[Q3formFields]);
$i = 0;
$formname = preg_replace('/Q[0-9]/', '', $y[tname]);
$staffemail = preg_replace('/Q[0-9]/', '', $y[Q2staffEmailAddress]);
foreach ($pieces as $_) {
$r++;
$fieldNames[$i] = 'Q' . $r . makeCamel($_);
$output .= $_ . ' <input type="text" id="' . $fieldNames[$i] . '" name="' . $fieldNames[$i] . '"><br>' . "\n";
$i++;
}
$i = 0;
// begin field array loop
////////////////////////////////////////////////
foreach ($pieces as $_) {
    unset($isChecked);
    unset($isreq);
if (preg_match('/[a-zA-Z0-9]/', $_)) {
$i++;
$_ = trim($_);
$_ = stripslashes($_);
$_2 = 'Q' . $i . fieldclean(makeCamel($_));
$_2 = preg_replace('/(REQUIRED|TEXTAREA|CHECKBOX|CHECKED)/', '', $_2);
$formvalscleaned = $formvalscleaned . ',' . $_2;
if ($y[useplaceholders]){
$placeholder = 'placeholder="' . $_ . '"';
}else { unset($placeholder);
}
if ($prepend) {
$ival = ' value="<?PHP echo $yourDataArray[' . $_2 . ']; ?>" ';
$ivaltextarea = '<?PHP echo $yourDataArray[' . $_2 . ']; ?>';
}
if (preg_match('/REQUIRED/', $_)) {
$isreq = 'required';
if ($y[useplaceholders]){
$placeholder = 'placeholder="' . $_ . ' (required)"';
}else { unset($placeholder);
}
$isreq = 'required';
$star = '<span style="color:red;">*</span>';
$_ = str_replace("REQUIRED", '', $_);
$_ = trim($_);
$_2 = trim($_2);
}
if (preg_match('/\*/', $_)) {
$isreq = 'required';
if ($y[useplaceholders]){
$placeholder = 'placeholder="' . $_ . ' (required)"';
} else { 
unset($placeholder);
//unset($isChecked);
}
$isreq = 'required';
$star = '<span style="color:red;">*</span>';
$_ = str_replace("*", '', $_);
$_ = trim($_);
$_2 = trim($_2);
}
$placeholder = str_replace('REQUIRED', '', $placeholder);
$placeholder = str_replace('*', '', $placeholder);
$phpcookiesearch .= "$" . $_2 . " = \$_COOKIE ['" . $formsubject . $_2 . "'];\n";
$phpcookietoarray .= '$yourDataArray[' . $_2 . '] = $_COOKIE [' . $formsubject . $_2 . '];' . "\n";
$rowout = '
<tr>
<td valign="top" ><br>' . $_ . $star . '<br>
<input name="' . $_2 . '" id="' . $_2 . '" type="text" size="40" ' . $isreq . ' ' . $placeholder . $ival . ' class="hcinputbox"></td>
</tr>
';
if ($elegant) {
$rowout = '
<tr>
<td valign="top" ><br>' . $_ .$star. '<br><input name="' . $_2 . '" id="' . $_2 . '" type="text" size="40" ' . $isreq . ' ' . $placeholder . $ival . ' class="hcinputbox"></td>
</tr>
';
}
if (preg_match('/HEADLINE/', $_)) {
$_ = str_replace('HEADLINE','',$_);
$rowout = '<tr><td valign="top" class="hctext" style="font-size:120%; font-weight:bold;">
<br>' . trim($_) . '</td></tr>';
$i--;
}
if (preg_match('/NOTE/', $_)) {
$thenote = trim($_);
$thenote = str_replace('NOTE','',$thenote);
$rowout = '<tr><td valign="top" class="hctext" style="font-size:80%; font-weight:normal; opacity:.8;">
' . trim($thenote) . '</td></tr>';
$i--;
}
if (preg_match('/\{/', $_)) {
$pieces = explode("{", $_);
$question = trim($pieces[0]);
$question2 = 'Q' . $i . fieldclean(makeCamel($question));
$answers = trim($pieces[1]);
$pieces = explode(",", $answers);
$red ='';
foreach ($pieces as $_){
$_ = str_replace('{','',$_);
$_ = str_replace('}','',$_);
$_ = trim($_);
$red .= '<option value="'.$_.'" class="hctext bordernone" >'.$_."</option>\n";
}
//$placeholder = str_replace('textarea', '', $placeholder);
$rowout = '
<tr>
<td valign="top" class="hctext" ><br>' . $question . $star . '<br><select name="'.$question2.'" id="select" class="hctext" >'."\n".$red.'</select></td>
</tr>
';
}
if (preg_match('/\[/', $_)) {
$_ = str_replace('[','~~~1',$_);
$_ = str_replace(']','~~~2',$_);
$pieces = explode("~~~1", $_);
$question = trim($pieces[0]);
$question2 = 'Q' . $i . fieldclean(makeCamel($question));
$answers = trim($pieces[1]);
$pieces = explode(",", $answers);
$red ='';
unset($F);
foreach ($pieces as $_){
$F++;
$_ = str_replace('~~~1','',$_);
$_ = str_replace('~~~2','',$_);
$_ = trim($_);
$red .= '
<input name="'.$question2.'[]" type="hidden" value="0"><!-- honeypot -->
<input type="checkbox" value="'.$_.'" name="'.$question2.'[]"> '.$_."<br>\n";
}
$rowout = '<tr>
<td valign="top" class="hctext" line-height:1.5em;"><br>' . $question . $star . '<br></td>
</tr>
<tr>
<td class="hctext" >'.$red.'</td>
</tr>';
}
if (preg_match('/TEXTAREA/', $_)) {
$_ = str_replace("TEXTAREA", '', $_);
$_ = trim($_);
$_2 = trim($_2);
$placeholder = str_replace('TEXTAREA', '', $placeholder);
$rowout = '
<tr>
<td valign="top"><br>' . $_ . $star . '		<br>
<textarea class="hcinputbox" name="' . $_2 . '" id="' . $_2 . '" ' . $isreq . ' cols="40" rows="10" ' . $placeholder . '>' . $ivaltextarea . '</textarea></td>
</tr>
';
if ($elegant) {
$rowout = '
<tr>
<td valign="top"><br>' . $_ . $star . '<br>
<textarea class="hcinputbox" name="' . $_2 . '" id="' . $_2 . '" ' . $isreq . ' cols="40" rows="10" ' . $placeholder . '>' . $ivaltextarea . '</textarea></td>
</tr>
';
}
}
if (preg_match('/CHECKBOX/', $_)) {
if (preg_match('/CHECKED/', $_)) {
$isChecked=' checked ';
}
$_ = str_replace("CHECKBOX", '', $_);
$_ = str_replace("CHECKED", '', $_);
$_ = trim($_);
$_2 = trim($_2);
$placeholder = str_replace('CHECKBOX', '', $placeholder);
$placeholder = str_replace('CHECKED', '', $placeholder);
$rowout = '
<tr>
<td valign="top"><br>
<input name="' . $_2 . '" type="hidden" value="0"><!-- honeypot -->
<input name="' . $_2 . '" id="' . $_2 . '" type="checkbox" value="1" ' . $isreq .$isChecked. ' >' . $_ . '</td>
</tr>
';
if ($elegant) {
$rowout = '
<tr>
<td valign="top"><br>
<input name="' . $_2 . '" type="hidden" value="0"><!-- honeypot -->
<input name="' . $_2 . '" id="' . $_2 . '" type="checkbox" value="1" ' . $isreq . ' >' . $_ . '</td>
</tr>
';
}
}

$isreq = '';
$star = '';
$tablerows = $tablerows . $rowout;
$numrows++;
}
} // end field array loop
////////////////////////////////////////////////
$cmessage = '
<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
<input type="hidden" id="refer" name="refer" value="' . $_SERVER["HTTP_REFERER"] . '">
<input type="hidden" id="formname" name="formname" value="' . $formname . '">
<input type="hidden" id="staffemail" name="staffemail" value="' . $staffemail . '">
<input type="hidden" id="processForm" name="processForm" value="1">
<input type="hidden" name="mode" value="submitforms">
<table>
' . $tablerows . '
</table>
<br><br>
<input name="submit" type="submit" class="orangesubmitbox1" id="submit" value="Submit">
</form>';
exit($pagetop1 . $cmessage);
}
if ($mode == 'editforms') {
	$dmess[]="enter edit forms mode";
$_ = @file_get_contents("forms/ids/" . $form . '.json');
$y = json_decode($_, true);
$Q1formTitle = stripslashes($y[Q1formTitle]);
$Q2staffEmailAddress = stripslashes($y[Q2staffEmailAddress]);
$Q3formFields = stripslashes($y[Q3formFields]);
$Q4thanksMessage = stripslashes($y[Q4thanksMessage]);
if (!$Q1formTitle) {
$Q1formTitle = $_COOKIE['Q1formTitle'];
}
if (!$Q1formTitle) {
$Q1formTitle = $_GET['form'];
}
if (!$Q2staffEmailAddress) {
$Q2staffEmailAddress = $_COOKIE['Q2staffEmailAddress'];
}
if (!$Q3formFields) {
$Q3formFields = $_COOKIE['Q3formFields'];
}
if (!$Q4thanksMessage) {
$Q4thanksMessage = $_COOKIE['Q4thanksMessage'];
}
$cmessage = '
<form method="post" action="./">
<table cellpadding="0" cellspacing="0">
<input name="formsubject" type=hidden value="DynamicFormBuilder">
<input name="mode" type=hidden value="saveforms">
<tr>
<td valign="top" style="padding: 5px; font-size: 13px; line-height: 1.5em; text-align: right;"><strong>Build/edit form:</strong></td>
<td valign="top" style="padding: 5px; font-size: 13px; line-height:1.5em;">  </td>
</tr>
<tr>
<td width="293" valign="top" style="padding: 5px; font-size: 13px; line-height: 1.5em; text-align: right;">Form Title</td>
<td width="990" valign="top" style="padding: 5px; font-size: 13px; line-height:1.5em;"><input name="Q1formTitle" id="Q1formTitle" type="text" size="40" placeholder="Form Title" value="' . $Q1formTitle . '" required ></td>
</tr>
<tr>
<td valign="top" style="padding: 5px; font-size: 13px; line-height: 1.5em; text-align: right;">Staff Email Address</td>
<td valign="top" style="padding: 5px; font-size: 13px; line-height:1.5em;"><input name="Q2staffEmailAddress" id="Q2staffEmailAddress" type="text" size="40" placeholder="Staff Email Address" value="' . $Q2staffEmailAddress . '" required ></td>
</tr>
<tr>
<td valign="top" style="padding: 5px; font-size: 13px; line-height: 1.5em; text-align: right;"><strong>Custom Form fields</strong>.<br>
separate with newlines. <br>
(one question per line)</td>
<td valign="top" style="padding: 5px; font-size: 13px; line-height:1.5em;"><p>
<textarea name="Q3formFields" id="Q3formFields" cols="40" rows="10" placeholder="Form Fields " required class="san13">' . $Q3formFields . '</textarea>
</p>
<p>If the value is  <strong>required</strong>  include an  <strong>asterisk *</strong>  in the field like so:  <strong>First Name *</strong><br>
If the value is a textarea (long multi-line answer) include the word  <strong>TEXTAREA</strong>  in the field like so:  Comments  <strong>TEXTAREA</strong><br>
If the value is a checkbox include the word  <strong>CHECKBOX</strong>  in the field like so:  Please contact me  <strong>CHECKBOX</strong>  <br>
If the value is a drop down menu,  <strong>list the responses in curly brackets</strong>  after the question > {yes,no,maybe}<br>
If the value is a multiple selection checkbox menu,  <strong>list the responses in square brackets</strong>  after the question > [start,middle,finish]<br>
If the value is a separator or headline, include the word  <strong>HEADLINE</strong>  in the field like so:  Part 2: Personal information  <strong>HEADLINE</strong><br>
If the value is a note, include  <strong>NOTE</strong>  in the field like so:  We use this information to better serve our customers  <strong>NOTE</strong></p>
<p><strong>Sample custom form fields:</strong></p>
<p style="color:gray;">Your Name *<br>
Your Title *<br>
Your Email *<br>
Company<br>
Phone<br>
Your Website *<br>
Please contact me CHECKBOX<br>
Please contact me and please send my custom report for my company CHECKBOX<br>
Gender{male,female,rather not say}<br>
US Citizen{yes,no}<br>
Specifically what would you like to learn more about? TEXTAREA<br>
Comments TEXTAREA</p>
<p>   </p></td>
</tr>
<tr>
<td valign="top" style="padding: 5px; font-size: 13px; line-height: 1.5em; text-align: right;"><p><strong>Thanks Message</strong></p>
<p>This message can be an ID <br>
(use the $$idname method) or it can be txt/html</p></td>
<td valign="top" style="padding: 5px; font-size: 13px; line-height:1.5em;"><textarea name="Q4thanksMessage" id="Q4thanksMessage" cols="40" rows="10" placeholder="Thanks Message " class="san13">' . $Q4thanksMessage . '</textarea></td>
</tr>
<tr>
<td valign="top" style="padding: 5px; font-size: 13px; line-height: 1.5em; text-align: right;"></td>
<td valign="top" style="padding: 5px; font-size: 13px; line-height:1.5em;"><input name="go" type="submit" class="orangesubmitbox1" id="go" value="Submit"></td>
</tr>
</table>
</form>
';
} // end editforms 
if ($mode == 'saveforms') {
	$dmess[]="enter save forms mode";
$_POST[Q1formTitle] = trim(stripslashes($_POST[Q1formTitle]));
$_POST[Q2staffEmailAddress] = trim(stripslashes($_POST[Q2staffEmailAddress]));
$_POST[Q3formFields] = trim(stripslashes($_POST[Q3formFields]));
$_POST[Q4thanksMessage] = trim(stripslashes($_POST[Q4thanksMessage]));
$_POST[tname] = makeCamel(stripslashes($_POST[Q1formTitle]));
$callname = stripslashes($_POST[tname]);
setcookie('Q1formTitle', $Q1formTitle, time() + 18144000, "/"); // 3 weeks
setcookie('Q2staffEmailAddress', $Q2staffEmailAddress, time() + 18144000, "/"); // 3 weeks
setcookie('Q3formFields', $Q3formFields, time() + 18144000, "/"); // 3 weeks
setcookie('Q4thanksMessage', $Q4thanksMessage, time() + 18144000, "/"); // 3 weeks
$_ = json_encode($_POST);
file_put_contents('forms/ids/' . makeCamel($_POST[Q1formTitle]) . '.json', $_);
$formurl = $publicCMSfolder . '?mode=buildforms&form=' . $callname;
$iframecode = '<textarea cols="50" rows="10"><iframe frameborder="0" height="680" src="' . $formurl . '" width="440"></iframe></textarea>';
$cmessage = "Form Saved
<br>
<br>
Your form will appear like this:	<br>
<br>
" . file_get_contents($formurl) . " 
<br><br>
You can also copy the iframe code below:<br><BR>" . $iframecode;
}
if ($mode == 'submitforms') {
	
	foreach($_POST as $key => $value){
	$_POST[$key] = strip_tags($value);
	
	}
	$dmess[]="submit forms entered";
	
extract($_POST);

if (!$formname || !$staffemail) {
exit;
}
$domain = $_SERVER["HTTP_HOST"];
$domain = str_replace('www.', '', $domain);
$staffsubject = 'A ' . $formname . ' form was filled out';
$staffemailaddress = $staffemail;
$theform = "forms/ids/" . $formname . '.json';
if (file_exists($theform)) {
$_ = @file_get_contents($theform);
$y = json_decode($_, true);
$thanksmessage = $y[Q4thanksMessage];
} else {
$thanksmessage = 'Thanks. Your form was submitted.';
}
$robotname = $formname . ' form robot';
$robotmail = $formname . '@' . $domain;
$formid = $formname;
$formsubject = trim($formid);
$formsubjectorig = $formid;
$formsubject = str_replace(' ', '_', $formsubject);
$txtdatabase = 'forms/results/' . $formsubject . '-formresults.txt';
$csvdatabase = 'forms/results/' . $formsubject . '-formresults.csv';
if (!file_exists($txtdatabase)) {
$fp = fopen($txtdatabase, 'w');
fwrite($fp, '');
fclose($fp);
}
if (!file_exists($csvdatabase)) {
$fp = fopen($csvdatabase, 'w');
fwrite($fp, '');
fclose($fp);
}
$timestamp = date('Y-m-d--') . date('H-i-s');
$csvdata = $timestamp . ',';
$hdata = 'Timestamp = ' . $timestamp . '
';
$mdata = 'Timestamp = ' . $timestamp . "\n";
$htmldata = 'Timestamp = ' . $timestamp . "<br />\n";
$formvals = $_POST;
$formvals['Timestamp'] = $timestamp;
$fomvalsAsJSON = json_encode($formvals);
foreach ($formvals as $key => $value) {
	unset($checked);
	if (is_array($value)){
		foreach($value as $f){
		$checked .= $f.'; ';
		}
		$value = $checked;
		$value = trim($value);
		$value = rtrim($value,";");
}
$value = trim($value);
$value = stripslashes($value);
$value = str_replace(',', ' - ', $value);
$value = str_replace("\r\n", ' - ', $value);
$value = str_replace("\n", ' - ', $value);

$csvdata = $csvdata . $value . ',';
$hdata = $hdata . $key . ' = ' . $value . '
';
$mdata = $mdata . $key . " = " . $value . "\r\n\r\n";
$htmldata = $htmldata . $key . " = " . $value . "<br />\n";
//setcookie($formid . $key, $value, time() + 18144000, "/"); // 3 weeks
}
$fp = fopen($txtdatabase, 'a');
$content = $csvdata . "\n";
fwrite($fp, $content);
fclose($fp);
$fp = fopen($csvdatabase, 'a');
$content = $csvdata . "\n";
fwrite($fp, $content);
fclose($fp);

$staffmessage = "All form results are stored on the server. Log in to the CMS to view latest results.\r\n\r\nThis message is just to let you know that the following information was submitted:\r\n\r\n" . $mdata;
mail($staffemailaddress, $staffsubject, $staffmessage, "From:" . $robotname . "<" . $robotmail . ">\r\n", "-f" . $robotmail);


// look for included ids
if (preg_match('/\$\$/',$thanksmessage)){
$y = preg_match_all('/\$\$[a-zA-Z0-9_-]+/ism', $thanksmessage, $matches);
if ($matches){
foreach ($matches[0] as $m){
$m2 = trim (str_replace("$$","", $m ));
$assemblerPathAdjust = str_replace('sc-admin/','',$assemblerPath);
if (file_exists($assemblerPathAdjust.$m2.'.slvr')){
$v = json_decode(@file_get_contents($assemblerPathAdjust.$m2.'.slvr'),true);
if ($v[slvr_page]){
$thanksmessage .='<br>dollar match 4';
$thanksmessage = str_replace($m,$v[slvr_page], $thanksmessage );
}
}
}
$i++;
}
}
echo $pagetop1;
echo $thanksmessage;
//print_r ($dmess);
exit;
}
if ($mode == 'iframeforms') {
$ifurl = $publicCMSfolder . '?mode=buildforms&form=' . $form;
$iframecode = '<BR>Iframe code:<br><br><textarea cols="50" rows="10"><iframe frameborder="0" height="680" src="' . $ifurl . '" width="440"></iframe></textarea>
';
$cmessage = $iframecode;
}
if ($mode == 'makepageforms') {
$tempid = 'FormTestPage-' . time();
$slvr_title = $tempid;
$slvr_id = $tempid;
$slvr_page = 'Here is your form in a test page. You can adjust and copy and paste 
the iframe below to any other pages. Have fun!<br><br>
<iframe frameborder="0" height="680" src="' . $publicCMSfolder . '?mode=buildforms&form=' . $form . '" width="440"></iframe>';
$slvrpay = array(
'slvr_id' => $slvr_id,
'slvr_title' => $slvr_title,
'slvr_page' => $slvr_page
);
$dataset = json_encode($slvrpay);
file_put_contents('ids/' . $slvr_id . '.slvr', $dataset);
$url = '?edit=' . $tempid;
header('Location: ' . $url);
exit;
}
if ($mode == 'makecsvforms') {
$csvurl = 'forms/results/'.$form.'-formresults.csv';
$file = file_get_contents($csvurl);
header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.$form.'-formresults.csv');
echo $file;
exit;
}
if ($mode == 'makespreadsheetforms') {
$ssurl = 'forms/results/'.$form.'-formresults.txt';
//$cmessage = makeSpreadSheet($ssurl);
exit( makeSpreadSheet($ssurl));
}
if ($mode == 'deleteforms') {
if ($mode && $_COOKIE['loggedin']) {
unlink('forms/ids/' . $form . '.json');
$cmessage = "$form form deleted.";
}
}