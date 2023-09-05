<?php
extract($_GET);
extract($_POST);

function loadurls($dir)
{
    if (!$dir) {
        $dir = "./";
    }
    static $master;
    $dir = str_replace("//", "/", $dir);
    $_ = glob("$dir/*");
    foreach ($_ as $d) {
        if (is_dir($d)) {
            loadurls($d); // here is the recursion, requires static array
        } else {
            $master[] = $d;
        }
    }
    return ($master);
}



if ($getJ) {
    $master = loadurls("jstar");
    foreach ($master as $_) {
        if (!preg_match('/\.json\.txt|\.png|\.summary|\.svg|\.pdf/', $_)) {
            $k[] = $_;
        }
    }
    $k = json_encode($k);
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    echo $k;
    exit;
    // https://silvercrayon.us/zippie.php?getJ=1
}

if ($getJ2) {
    $master = loadurls("jstar");
    foreach ($master as $_) {
        if (!preg_match('/\.json\.txt|\.png|\.summary|\.svg|\.pdf/', $_)) {
            $k[] = $_;
            $snout .= "$_\n";
        }
    }
    $k = json_encode($k);
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    echo $snout;
    exit;
    // https://silvercrayon.us/zippie.php?getJ=1
}

if ($request) {
    $_ = file_get_contents($request);
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: text/plain; charset=utf-8");
    echo $_;
    exit;
    // https://silvercrayon.us/zippie.php?request=jstar/pielet/visualizeit/index.php
}




exit;


$output = shell_exec('zip -r pie.zip jstar/*');
$_ = file_get_contents("pie.zip");
header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename="pie.zip"');
echo $_;






/*



jstar/chartjs-plugin-watermark.js
jstar/createDiv.js
jstar/creatediv.php
jstar/fix.php
jstar/footer.html
jstar/formQuestions.json
jstar/index.php
jstar/inspect.php
jstar/inspectCookies.html
jstar/life-balance-form copy.html
jstar/life-balance-form.html
jstar/list.php
jstar/makechart.php
jstar/notes.js
jstar/pdf.php
jstar/pielet/all.json
jstar/pielet/analyzeit/index.php
jstar/pielet/average.php
jstar/pielet/becomeamember/error_log
jstar/pielet/becomeamember/index.php
jstar/pielet/bookmarklet.html
jstar/pielet/chartjs-plugin-watermark.js
jstar/pielet/coach/admin.php
jstar/pielet/coach/formQuestions.json
jstar/pielet/coach/index.php
jstar/pielet/coach/shell.html
jstar/pielet/counter.html
jstar/pielet/create/index.php
jstar/pielet/create/newBanner.html
jstar/pielet/create/template-2020.html
jstar/pielet/create-account.php
jstar/pielet/create-email-table.php
jstar/pielet/createDiv.js
jstar/pielet/dashboard/dashfooter.html
jstar/pielet/dashboard/fixdata.php
jstar/pielet/dashboard/index.php
jstar/pielet/demo.html
jstar/pielet/demo.php
jstar/pielet/dompdf.php
jstar/pielet/editR96.php
jstar/pielet/email-table.json
jstar/pielet/error_log
jstar/pielet/every.thing
jstar/pielet/everything.php
jstar/pielet/fix-f-bug.php
jstar/pielet/footer.html
jstar/pielet/force.php
jstar/pielet/formQuestions.json
jstar/pielet/gather.php
jstar/pielet/generate-login-bar.php
jstar/pielet/icons/index.php
jstar/pielet/ids/all.txt
jstar/pielet/ids/make-all.php
jstar/pielet/index.php
jstar/pielet/invite/codesIV.txt
jstar/pielet/invite/index.php
jstar/pielet/life-balance-form copy.html
jstar/pielet/life-balance-form.html
jstar/pielet/list.php
jstar/pielet/login.php
jstar/pielet/makechart.php
jstar/pielet/move-ids.php
jstar/pielet/multi.php
jstar/pielet/notes.txt
jstar/pielet/pdf.php
jstar/pielet/pick-password.php
jstar/pielet/pietential.legacy.php
jstar/pielet/privacy.html
jstar/pielet/put-files.sh
jstar/pielet/r5dQMf7dqdxd.html
jstar/pielet/recursive.php
jstar/pielet/remove-ids.php
jstar/pielet/responder.html
jstar/pielet/retake/index.php
jstar/pielet/reviewresults.php
jstar/pielet/rsync.txt
jstar/pielet/run-sim.php
jstar/pielet/samples.html
jstar/pielet/samples.php
jstar/pielet/save-snapshot.php
jstar/pielet/serverless-geolocation.js
jstar/pielet/share/getter.php
jstar/pielet/share/htw.php
jstar/pielet/share/index.php
jstar/pielet/share/makechart.php
jstar/pielet/share/rsync.sh
jstar/pielet/shareMyChart/index.php
jstar/pielet/shareMyChart/shell.html
jstar/pielet/shell.html
jstar/pielet/shell2.html
jstar/pielet/showR96.php
jstar/pielet/social.php
jstar/pielet/styles.css
jstar/pielet/temp64
jstar/pielet/test.html
jstar/pielet/test.txt
jstar/pielet/trash.html
jstar/pielet/trash.js
jstar/pielet/universal-footer.php
jstar/pielet/update-localserver.php
jstar/pielet/update.php
jstar/pielet/visualizeit/error_log
jstar/pielet/visualizeit/index.php
jstar/pielet/vote/index.php
jstar/pietential.webmanifest
jstar/pngdata.txt
jstar/pngsaver.php
jstar/privacy.html
jstar/recover.php
jstar/recursive.php
jstar/responder.html
jstar/reviewresults.php
jstar/savepdf.html
jstar/security.php
jstar/serviceworker.js
jstar/serviceworkier.js
jstar/shell.html
jstar/social-cards.php
jstar/social.php
jstar/stepper.php
jstar/styles.css
jstar/temp.html
jstar/test.html
jstar/test.php
jstar/trash.html
jstar/twittercard.txt
jstar/valvet.html
jstar/wipe/index.php

*/ 
