<?php

$opmode = 'Text Cleaner';
$item = stripslashes($item);
$item = smartypants($item);
$item = hankpants($item);
$item = newpants($item);
$item2 = str_replace("\n","<br>",$item);

$cmessage = ' <p><b class="headlines">Text cleaner</b><br />
Pasting directly from Word or a web page, or anywhere else that has formatted text 
will generally cause problems, this utility will clean up the formatting<br />
</p>
<form action="" method="post" name="form2" id="form2">
<input name="mode" type="hidden" value="textcleanget" />
<p><em>Paste text from word (or anywhere else):</em><br />
<br />
<textarea name="item" cols="60" rows="12" class="bodycopy" id="item">'.$item.'</textarea>
</p>
<p>
<input name="Submit" type="submit" class="submit" value="Clean it" />
&nbsp;&nbsp;</p>
<p>&nbsp;</p> 
<span style="text-decoration: none; color: ; font-family: ; font-size: ;">'.$textcleanoutput.'</span>
</form>';