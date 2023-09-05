<?
extract($_GET);
extract($_POST);
date_default_timezone_set('America/New_York');


if($downloadPDF){
    header('Content-type: application/octet-stream');
    header('Content-Disposition: attachment; filename="Pietential.com '.$downloadPDF.'.pdf"');
    echo (file_get_contents("https://pietential.com/pdf.php?pdf=$downloadPDF"));
    // https://pietential.com/pdf.php?downloadPDF=eXHu9aqGZfsl
    exit;
}




if($summary){
    $a = explode(';;;', $summary);
    $pdf = trim($a[0]);
    $summary = trim($a[1]);
    file_put_contents($pdf.".summary.txt", $summary);
    exit;
}

if($combine){
    $pdf = $combine;
    $temp = file_get_contents("https://pietential.com/pdf.php?pdf=$combine");
    file_put_contents("temp.pdf",$temp);
    $fileArray= array("cover.pdf","temp.pdf");
    $outputName = "$pdf-merged.pdf";
    $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";
    foreach($fileArray as $file) {
            $cmd .= $file." ";
        }
        $result = shell_exec($cmd);

echo file_get_contents("$pdf-merged.pdf");
exit;
// https://pietential.com/pdf.php?combine=G9giH1pdlhsN
}



// Below is the php PDF merge command.

// $fileArray= array("name1.pdf","name2.pdf","name3.pdf","name4.pdf");

// $datadir = "save_path/";
// $outputName = $datadir."merged.pdf";

// $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";
// //Add each pdf file to the end of the command
// foreach($fileArray as $file) {
//     $cmd .= $file." ";
// }
// $result = shell_exec($cmd);



$master = json_decode(file_get_contents("$pdf.json.txt"), true);

$SA = $master[LBscorevalues][SA] ;
$EC = $master[LBscorevalues][EC] ;
$LB = $master[LBscorevalues][LB] ;
$SN = $master[LBscorevalues][SN] ;
$PN = $master[LBscorevalues][PN] ;

$_ .= "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n";

//$_ .= "Your Pietential URL: https://pietential.com/?socialshare=$pdf\n\n";

$passValue = 59;

$sep = "********************************\n\n";

$_.= "{{PNtext}}{{SNtext}}{{LBtext}}{{ECtext}}{{SAtext}}"



if($PN>$passValue){
    $_ .= "$sep Physiological Needs: Your Score: $PN/100
    
    Your physiological needs are in pretty good shape. You seem to be taking good care of yourself regarding your general health and well-being, and there's room for improvement.

A long and healthy life is within your reach, because you have a solid physiological foundation to work from. You'd be wise to work with a nutritionist and personal trainer, and start dialing in your nutrition and exercise regimen in to your specific needs, considering factors like your age, weight, BMI, and very specific health goals.

A key to maintaining, and growing your good physiological foundation is the company you keep. You'd do well to keep your distance from people that smoke, drink excessively, or are recreational drug users, as their lifestyles run counter to yours, and could hinder your progress to an even healthier life.
    
";
} else {
    $_ .= "$sep Physiological Needs: Your Score: $PN/100
    
You would benefit from eating better, getting more exercise, and a better night’s sleep.
 
If you consume alcohol, caffeine, or use recreational drugs, these substances may be affecting your ability to sleep well at night, practice mindfulness (be in the moment) during your waking hours, and exercise the following day.
 
Pay special attention to what you’re eating - and when, as the food you eat is providing you your base-level fuel to set and accomplish all of your other goals.
 
Your community is key.  Work to surround yourself with people that are healthier than you, as they’ll be a good influence on your actions. 

Depending on your specific circumstance you might consider working with a nutritionist, personal trainer, talk therapist, or addictions counselor if your actions regarding alcohol and/or drugs have ever caused harm to you or others, and you’ve continued to consume them.

";
}

if($SN>$passValue){
    $_ .= "$sep Safety Needs: Your Score: $SN/100
    
    You have a reasonable amount of certainty in your life regarding fundamental issues of safety and security, and that allows you to act from a spirit of abundance, rather than scarcity.

This foundation of safety gives you a strong basis of emotional balance and personal fortitude, and makes you a rational actor in times when issues like housing security, food security, and personal safety might be in question. You know what safety and security in these areas look and feel like, thus you know that they are always attainable, even if life circumstances sometimes raise temporary doubts about them.

Your core relationship to money is likely a healthy one, which is a key part of your foundation regarding the issues above. All the same you might consider seeking the advice of a qualified financial advisor, or retirement specialists and developing a long-term plan to maintain and grow your financial assets over time. Doing so can alleviate some of the unspoken anxieties you might feel in these areas, freeing up your attention to apply to other important areas of your life.

";
} else {
    $_ .= "$sep Safety Needs: Your Score: $SN/100
    
There’s a certain amount of (conscious or unconscious) uncertainty regarding your needs for fundamental safety and security.  You may sometimes experience doubts in and around issues of sustainable access to housing, food security, and/or your personal safety. You may question your ability to deal with real or perceived shortfalls in these areas, and those doubts can affect your overall emotional stability and mental health. 
    
Conversely, if you feel off balance emotionally, or out of sorts from a mental health standpoint, it can negatively effect your ability to keep a positive mindset towards these fundamental life issues, and that can create a downward spiral.
    
You might benefit from taking stock of your current financial situation, and seeking some objective input from a qualified financial advisor, or retirement specialists, or at the minimum seeking out resources on managing your cash flow, living within your means, saving and investing. 
    
Our core relationship with money itself is often at the root of feelings of uncertainty regarding issues like the fear of someday being homeless, of not having enough food to eat, or not being able to keep ourselves and our loved ones safe.
    
    ";
}

if($LB>$passValue){
    $_ .= "$sep Love and Belonging: Your Score: $LB/100
    
Your relationship with yourself is a good one. You love yourself, and have compassion for yourself - and that's the root of love and compassion your able to show others.  
 
Authenticity is an important lever in the realm or love and belonging, and you probably show up pretty authentically in the groups and communities in which you operate. Continue this practice, and work to become ever more authentic, as it will increase you compassion for your fellow being and embed you even deeper into your community as a compassionate leader.  
 
Your love for yourself allows you a certain level of intimacy with yourself that not everyone has access too, and that level of personal intimacy transcends you and works its way into your personal relationships. People are ok being intimate with you, whether in conversation, or physically, because you're ok with intimacy. You radiate this in your words, actions and being and people are attracted to you, because of it.  
 
Your foundation of love and belonging is a strong one, and with some additional nurturing, and perhaps some formal training, you could become a true force for compassion and healing in your world. You might consider taking some personal development courses, in order to increase your natural capacity for love and belonging.  
 
At the same time, be careful not to take on too much. Your natural strength in this area can be a beacon to people who feel deficient in this realm, drawing them to you as they seek your energy and love, in order to compensate for their own lack of belonging. Being present, powerful and compassionate for them can in fact give you energy, but only when you have it to give. Make sure that your own needs in this area are well taken care of so you don't over-extend yourself and begin to feel drained by something that should give you joy.

";
} else {
    $_ .= "$sep Love and Belonging: Your Score: $LB/100
    
Your relationships aren’t as deep and fulfilling as they could be, and (hard as it may be to hear) you’re likely at the root of any deficit you might be feeling regarding love, and belonging.
    
Shallow or negative social interactions, unhealthy friendships, and poor relationships with our family are often the result of a lack of compassion for ourselves - from ourselves.  If we don’t show ourselves compassion, if we can’t be intimate with ourselves, if we can’t drop our defenses, and engage in play and truly enjoy our own company how can we expect to show up authentically, and have more meaningful relationships with our family, friends, and community?

Moreover, if we aren’t intimate with ourselves, and showing ourselves and our friends, families and communities our compassion,  our passion, and our natural unadulterated, playful spirit, then what signals are we putting out to the world, and thus what types of people are we attracting? 

People are like magnets for similarly minded people, and we tend to draw to us people who are similar to what we’re consciously, or subconsciously putting out there.

You might consider taking an inventory of your relationships with your friends and family, and taking a look at the communities in which you’re involved.  How are those people showing up?  Are they negative?  Positive?  Compassionate? Cold and unfeeling?  Do they show empathy and connectedness?  Are their relationships deep or shallow?  Are they ok being vulnerable and playful, or are they closed off?  Are they authentic, or just operating with others at the level of pretense.  And how about you?  Where can you improve these important areas of your life, and what might be possible for you with an increased opening for love and belonging.

You might consider working with a life coach, joining a faith-based community, or taking some self improvement courses.  What you’ll find in any of those instances is a broader, deeper understanding, and acceptance of your self, which will in turn give you the opportunity to be naturally more connected to others.

";
}

if($EC>$passValue){
    $_ .= "$sep Self-Esteem and Contribution: Your Score: $EC/100
    
You have strong, healthy self esteem, and you're a contributor in this world - and there's an important relationship between the two. Your ability to contribute to the world is likely based in your foundation of self esteem, whereas some people's self esteem is dependent on feeling that they make or have made, and are recognized for their contributions. Good self esteem, which is often rooted in positive childhood life experiences, allows us to be contributors to society as an end unto itself, not as a means to fill a perceived void in ourselves.

You may or may not have really come to understand, or embrace your purpose in life - but it's a great time to begin considering these big questions in life, because defining, articulating, and sharing your purpose with others could result in your becoming a super-contributor.

Contributors affect change in society at the interpersonal level, and at the group level - and that's amazing in and of itself. Super-contributors affect the world at the community and at the meta level, and even the global level - and you're capable of that.

Studying from teachers, mentors, and coaches who are operating a level or two up from where your currently affecting change would be of benefit to you if you're interested in operating at a higher level, and development course work, would speed your trajectory towards those aims.

";
} else {
    $_ .= "$sep Self-Esteem and Contribution: Your Score: $EC/100

You may have some doubts about the value of the contributions you make, or have made in your life - to society, community, or even your family - and whether or not people respect what you’ve accomplished.  It’s natural to measure ourselves against the expectations of others, bu\n\nt more importantly is how do measure ourselves against our own expectations.  And by what barometer?
 
Most people would say that they have a good amount of self respect, but many people often report that they don’t know if their life has purpose - and if so, what that purpose is.  Without a defined purpose, it’s hard to measure what our contributions have or or have not been; what they are - or what they could be? And though, we might like to think of our self esteem as existing in a vacuum - we have it, or we don’t - it’s relative: to our expectations or ourselves, to others expectations of us, and most importantly to our spoken or unspoken sense of purpose.
 
It’s worthwhile to consider your purpose in life, to begin having that conversation with yourself, and with your friends, and family - and in your social circles.  You don’t have to have “the answer” in order to start sharing that inner monologue in your dialogue with other.  It will come.
 
What matters is that in you’re in a powerful conversation about a purpose-driven life, and from there you can better gauge for yourself whether you’ve made the contributions that you want to make in this world, and whether you’ve been properly recognized for them - and if that even matters to you.
 
Living from a declarative purpose, nagging questions of self worth, personal empowerment, inner strength, and self expression tend to naturally give way to the power of your purpose.

";
}

if($SA>$passValue){
    $_ .= "$sep Self Actualization: Your Score: $SA/100
    
You seem to be aware that self actualization is a process - not a result, and you're consciously self-actualizing, seeking to be the best you that you can be, knowing well what effect that has you, and others around you.

Your innate desire to be your most authentic self is an inspiration to so many people who may not have come to know, accept, or embrace themselves in the way in which you have. The world would benefit greatly from you working just as hard to express yourself to others, as you do to yourself.

Your gift is being you. Share yourself openly with the world, and lead by example. Shine your light as bright as you possibly can, and others will follow. You may light up the world someday, and you'll definitely light up a few faces, and light some minds on fire along the way.

Whatever you do - don't stop. Keep seeking knowledge, wisdom, and mentorship towards the things that are truly important to you - and share it openly. Teaching is learning.

";
} else {
    $_ .= "$sep Self Actualization: Your Score: $SA/100
    
Self Actualization is a process - not a result.
    
We are never completely self actualized, though hopefully we are continually self actualizing.  See, all of us are just a work in progress.  The quintessential question is “are we actively working on it?  Am I actively working on me?”. 
 
The answer is “yes”.  You are working on it - right now, in fact.  You’re working on you - and that’s a good thing.

As you know, none of us are perfect, and it’s our nature as humans to seek to improve our lot in life, and our life itself. 

Self actualizing people are people who actively engage in this process of “self-improvement” by focusing first on the Self itself; by focusing on their “Being” - and on being the best being they are capable of being, as fundamental to their well being.

You might feel inadequate in this regard.  Many people do.

Self actualization looks like a long, steep road of self improvement, where you have to constantly fix yourself - but you should consider that choosing to consciously improve your Self does not mean that you’re broken.  You are not broken and you don’t need to be “fixed”. 

You are fundamentally good, and no matter what your state or situation - you can improve your Self itself, and other areas of your life will follow suit: your self esteem, your ability to be a contributor in life, your relationships and sense of belonging, your feelings of safety and security, and your physiological balance.

“Self Actualization” isn’t a result of having gained some level of achievement in the other fundamental areas of your life.  The work of continually self actualizing, is a propellent towards further improvement in all of those areas of life.

Learning and living your purpose in life, seeking education in all of its forms towards practicing the mastery of new skills and achieving the goals that support your purpose to the point where you feel genuinely fulfilled, and capable of imbuing the possibility of that level of fulfillment to others; today, tomorrow, and the next day, until your short time on this Earth has passed.  That’s a self actualizing life - and you’re on living it. 

Keep living it.  Keep sharing it.

    ";

}

$_ .= "$sep Created and developed by: Starling Growth Advisory and Silvercrayon Labs. Copyright 2021 Starling Growth Advisory.

Get your score at Pietential.com.";

$_ = str_replace("’", "'", $_);
$_ = str_replace("“", "\"", $_); //“self-improvement” 
$_ = str_replace("”", "\"", $_);
$_ = str_replace("\n", "[newline]", $_);
$_ = preg_replace('/\s+/ism', ' ', $_);
$_ = str_replace("[newline]", "\n", $_);

require('fpdf/fpdf.php');


//$_ .= file_get_contents($pdf.".summary.txt");
// $_ = str_replace("<br>", "\n", $_);
// $_ = str_replace("ne!", "ne!\n", $_);
// $_ = str_replace("100", "100\n", $_);
// $_ = str_replace("nt)", "nt)\n", $_);//✅
// $_ = str_replace("✅", "", $_);//âœ…
// $_ = str_replace("âœ…", "", $_);//âœ…
// $_ = strip_tags($_);

$chart = "$pdf.png";
$chart2 = "$pdf.bar.png";

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',11);

$pdf->Image($chart,10,30,-110);
$pdf->Image($chart2,10,90,-110);
$pdf->MultiCell(189, 5, $_, 0, 1);
//$pdf->Output("$pdf.pdf","F");
$pdf->Output();
exit;

