<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain; charset=utf-8");
date_default_timezone_set('America/New_York');
$timestamp = date('Y-m-d--') . date('H-i-s');
extract($_GET);
extract($_POST);

if ($_GET['bypass']) {
    // https://pietential.com/pielet/calcEngine/?mode=calc&bypass=23,45,67,78,76
    $_ = explode(",", $_GET['bypass']);
    $scoreArr["SA"] = roundNumber($_[0]);
    $scoreArr["EC"] = roundNumber($_[1]);
    $scoreArr["LB"] = roundNumber($_[2]);
    $scoreArr["SN"] = roundNumber($_[3]);
    $scoreArr["PN"] = roundNumber($_[4]);
    $master['scores'] = $scoreArr;
    $master['version'] = "June 21, 2022";
    $master = returnFifthResponse($scoreArr, $master);
    echo json_encode($master);
    exit;
}

function returnFifthResponse($scoreArr, $master)
{
    $fifths = json_decode(file_get_contents("fifth-breakout.json"), true);
    // < 100 <80 < 60 < 40 < 20
    foreach ($scoreArr as $k => $v) {
        $varname = $k . "response";
        if ($v < 10000) {
            $ssr = $k . "5";
            $master[$varname] = $fifths[$ssr];
        }
        if ($v < 80) {
            $ssr = $k . "4";
            $master[$varname] = $fifths[$ssr];
        }
        if ($v < 60) {
            $ssr = $k . "3";
            $master[$varname] = $fifths[$ssr];
        }
        if ($v < 40) {
            $ssr = $k . "2";
            $master[$varname] = $fifths[$ssr];
        }
        if ($v < 20) {
            $ssr = $k . "1";
            $master[$varname] = $fifths[$ssr];
        }
    }
    return ($master);
}


function returnThirdResponse($scoreArr, $master)
{
    $thirds = json_decode(file_get_contents("third-bifuracte.json"), true);
    foreach ($scoreArr as $k => $v) {
        $varname = $k . "response";
        if ($v < 100) {
            $ssr = $k . "3";
            $master[$varname] = $thirds[$ssr];
        }
        if ($v < 66) {
            $ssr = $k . "2";
            $master[$varname] = $thirds[$ssr];
        }
        if ($v < 34) {
            $ssr = $k . "1";
            $master[$varname] = $thirds[$ssr];
        }
    }
    return ($master);
}


if ($qs2) {
    $a = json_decode($qs2, true);
    extract($a);
}

if ($mode == "generateQuestions") {
    $master = [];
    $c = json_decode(file_get_contents("coda.txt"), true);
    shuffle($c);
    foreach ($c as $key => $value) {
        $master[] = assignRandomQuestion($value);
    }
    echo json_encode($master);
    exit;
}
function assignRandomQuestion($subjectArray)
{
    $qlist = $subjectArray["questionArray"];
    shuffle($qlist);
    $randomQuestion = $qlist[0];
    $subjectArray['Question'] = $randomQuestion; // "hello";//
    unset($subjectArray["questionArray"]);
    return $subjectArray;
}
// heres the obj structure for the questions
// Part:Part 1
// Part description:Esteem and Contribution
// Subject:Sleep
// Question:I'm getting good quality sleep each night
// questionNumber:25

$subjects = ['Achievement', 'Education', 'Mastery', 'Spirituality and Life Purpose', 'Personal Development', 'Well Being', 'Respect and Status', 'Strength/Empowerment', 'Self Respect', 'Contribution', 'Appreciation', 'Freedom and Expression', 'Intimacy', 'Play', 'Friendship', 'Compassion', 'Family Relationships', 'Social Relationship', 'Food Security', 'Physical Security', 'Dwelling Security', 'Emotional/Mental Health', 'Resiliency', 'Certainty', 'Health', 'Sleep', 'Substance Abuse', 'Exercise', 'Mindfulness', 'Nutrition'];





if (!$_COOKIE['email']) {
    exit("not allowed code: nc email");
}
if (!$userID) {
    exit("not allowed code: nc uid $userID");
}
$m = @file_get_contents("../ids/$userID.json.txt");
if (strlen($m) < 10) {
    exit("not allowed code: nu");
}


if ($_POST) {
    echo (print_r($_POST, true));
    exit;
}


if ($mode == "calc") {
    calculateScores($_GET);
    exit;
}



function calculateScores($array)
{

    $pr = json_decode('{"PNO":"Your physiological needs are in pretty good shape. You seem to be taking good care of yourself regarding your general health and well-being, and there’s always room for improvement.<br><br>A long and healthy life is within your reach, because you have a solid physiological foundation to work from. You’d be wise to work with a nutritionist and/or personal trainer, and start dialing in your nutrition and exercise regimen in to your specific needs, considering factors like your age, weight, BMI, and your own very specific health goals.<br><br>A key to maintaining, and growing your good physiological foundation is the company you keep. You’d do well to keep your distance from people that smoke, drink excessively, or are recreational drug users, as their lifestyles run counter to yours, and could hinder your progress towards an even healthier life.","SNO":"You have a reasonable amount of certainty in your life regarding fundamental issues of safety and security, and that allows you to act from a spirit of abundance, rather than scarcity.<br><br>This foundation of safety gives you a strong basis of emotional balance and personal fortitude, and makes you a rational actor in times when issues like housing security, food security, and personal safety might be in question. You know what safety and security in these areas look and feel like, thus you know that they are always attainable, even if life circumstances sometimes raise temporary doubts about them.<br><br>Your core relationship to money is likely a healthy one, which is a key part of your foundation regarding the issues above. All the same, you might consider seeking the advice of a qualified financial advisor, or retirement specialists and developing a long-term plan to maintain and grow your financial assets over time. Doing so can alleviate some of the unspoken anxieties you might feel in these areas, freeing up your attention to apply to other important areas of your life.","LBO":"Your relationship with yourself is a good one. You love yourself, and have compassion for yourself - and that’s the root of love and compassion your able to show others.<br><br>Authenticity is an important lever in the realm of love and belonging, and you probably show up pretty authentically in the groups and communities in which you operate. Continue this practice, and work to become ever more authentic, as it will increase you compassion for your fellow being and embed you even deeper into your community as a compassionate leader.<br><br>Your love for yourself allows you a certain level of intimacy with yourself that not everyone has access too, and that level of personal intimacy transcends you and works its way into your personal relationships. People are okay being intimate with you, whether in conversation, or physically, because you’re okay with intimacy. You radiate this in your words, actions and being - and people are attracted to you, because of it.<br><br>Your foundation of love and belonging is a strong one, and with some additional nurturing, and perhaps some formal training, you could become a true force for compassion and healing in your world. You might consider taking some personal development courses, in order to increase your natural capacity for love and belonging.<br><br>At the same time, be careful not to take on too much. Your natural strength in this area can be a beacon to people who feel deficient in this realm, drawing them to you as they seek your energy and love in order to compensate for their own lack of sense of love and belonging.<br><br>Being present, powerful and compassionate towards others can in fact give you energy, but only when you have it to give. Make sure that your own needs in this area are well taken care of so you don’t over-extend yourself and begin to feel drained by something that should give you joy.","ECO":"You have a strong, healthy self-esteem, and you’re a contributor in this world - and there’s an important relationship between the two.<br><br>Your ability to contribute to the world is likely based in your foundation of self-esteem, whereas some people’s self-esteem is dependent on feeling that they make (or have made) and are recognized for their contributions. Good self-esteem, which is often rooted in positive childhood life experiences, allows us to be contributors to society as an end unto itself, not as a means to fill a perceived void within ourselves.<br><br>You may or may not have really come to understand, or embrace your purpose in life - but it’s a great time to begin considering big questions like this, because defining, articulating, and sharing your purpose with others could result in your becoming a super-contributor.<br><br>Contributors affect change in society at the interpersonal level, and at the group level - and that’s amazing in and of itself. Super-contributors affect the world at the community and at the meta level, and even the global level, and you’re capable of that.<br><br>Studying from teachers, mentors, and coaches who are operating a level or two up from where you are currently affecting change would be of benefit to you if you’re interested in operating at a higher level. Some personal development course work would also speed your trajectory towards those aims.","SAO":"You seem to be aware that self actualization is a process - not a result, and you’re consciously self-actualizing (seeking to be the best you that you can be) knowing well what effect that has on you, and others around you.<br><br>Your innate desire to be your most authentic self is an inspiration to so many people who may not have come to know, accept, or embrace themselves in the way in which you have. The world would benefit greatly from you working just as hard to express yourself to others, as you do to yourself.<br><br>Your gift is being you. Share yourself openly with the world, and lead by example. Shine your light as bright as you possibly can, and others will follow. You may light up the world someday, and you’ll definitely light up a few faces, and light some minds on fire along the way.<br><br>Whatever you do - don’t stop. Keep seeking knowledge, wisdom, and mentorship towards the things that are truly important to you - and share it openly.<br><br>Teaching is learning.","SNU":"<i>Suggestions for improvement</i><br>There’s a certain amount of (conscious or unconscious) uncertainty regarding your needs for fundamental safety and security. You may sometimes experience doubts in and around issues of sustainable access to housing, food security, and/or your personal safety. You may question your ability to deal with real or perceived shortfalls in these areas, and those doubts can affect your overall emotional stability and mental health.<br><br>Conversely, if you feel off balance emotionally, or out of sorts from a mental health standpoint, it can negatively effect your ability to keep a positive mindset towards these fundamental life issues, and that can create a downward spiral.<br><br>You might benefit from taking stock of your current financial situation, and seeking some objective input from a qualified financial advisor or retirement specialists, or at the minimum seeking out information and resources on managing your cash flow, living within your means, saving and investing.<br><br>Our core relationship with money itself is often at the root of feelings of uncertainty regarding issues like the fear of someday being homeless, of not having enough food to eat, or not being able to keep ourselves and our loved ones safe.","LBU":"<i>Suggestions for improvement</i><br>Your relationships aren’t as deep and fulfilling as they could be, and (hard as it may be to hear) you’re likely at the root of any deficit you might be feeling regarding love and belonging.<br><br>Shallow or negative social interactions, unhealthy friendships, and poor relationships with our family are often the result of a lack of compassion for ourselves - from ourselves. If we don’t show ourselves compassion; if we can’t be intimate with ourselves; if we can’t drop our defenses and engage in play and truly enjoy our own company how can we expect to show up authentically and have more meaningful relationships with our family, friends, and community?<br><br>Moreover, if we aren’t intimate with ourselves, and showing ourselves and our friends, families and communities our compassion, our passion, and our natural unadulterated playful spirit, then what signals are we putting out to the world - and thus what types of people are we attracting? <br><br>People are like magnets for similarly minded people, and we tend to draw to us people who are similar to what we’re consciously or subconsciously putting out there.<br><br>You might consider taking an inventory of your relationships with your friends and family, and taking a look at the communities in which you’re involved. How are those people showing up? Are they negative? Positive? Compassionate? Cold and unfeeling? Do they show empathy and connectedness? Are their relationships deep or shallow? Are they okay being vulnerable and playful, or are they closed off? Are they authentic, or just operating with others at the level of pretense? <br><br>And how about you? Where can you improve these important areas of your life, and what might be possible for you with an increased opening for love and belonging?<br><br>You might consider working with a life coach, joining a faith-based community, or taking some self improvement courses. What you’ll find in any of those instances is a broader, deeper understanding, and acceptance of your self, which will in turn give you the opportunity to be naturally more connected to others.","ECU":"<i>Suggestions for improvement</i><br>You may have some doubts about the value of the contributions you make, or have made in your life - to society, community, or even your family - and whether or not people respect what you’ve accomplished. It’s natural to measure ourselves against the expectations of others, but more importantly is how do measure ourselves against our own expectations of ourselves. And by what barometer?<br><br>Most people would say that they have a good amount of self respect, but many people often report that they don’t know if their life has purpose - and if so, what that purpose is. Without a defined purpose, it’s hard to measure what our contributions have or have not been; what they are - or what they could be? And though we might like to think of our self esteem as existing in a vacuum - either we have it, or we don’t - it’s often relative. Relative to our expectations or ourselves, to others expectations of us, and most importantly to our spoken or unspoken sense of purpose.<br><br>It’s worthwhile to consider your purpose in life, to begin having that conversation with yourself, and with your friends and family - and in your social circles. You don’t have to have the answer in order to start sharing that inner monologue in your dialogue with other. It will come. <br><br>What matters is that in you’re in a powerful conversation about a purpose-driven life, and from there you can better gauge for yourself whether you’ve made the contributions that you want to make in this world, and whether you’ve been properly recognized for them - and if that even matters to you. To some it doesn’t.<br><br>Living from a declarative purpose, nagging questions of self worth, personal empowerment, inner strength, and self expression tend to naturally give way to the power of your purpose.","SAU":"<i>Suggestions for improvement</i><br>Self Actualization is a process - not a result.<br><br>We are never completely self actualized, though hopefully we are continually self actualizing. All of us are just a work in progress. The quintessential question is are we actively working on it? Am I actively working on me?. <br><br>The answer is yes. You are working on it - right now, in fact. You’re working on you - and that’s a good thing. It’s our nature as humans to seek to improve our lot in life, and our life itself. <br><br>Self actualizing people are people who actively engage in this process of self-improvement by focusing first on the Self itself; by focusing on their Being - and on being the best human being they are capable of being, as fundamental to their well being.<br><br>You might feel inadequate in this regard. Many people do.<br><br>Self actualization looks like a long, steep road of self improvement, where you have to constantly “fix” yourself - but you should consider that choosing to consciously improve your Self does not mean that you’re broken. You are not broken - and you don’t need to be fixed. <br><br>You are fundamentally good, and no matter what your state or situation - you can improve your Self itself, and other areas of your life will follow suit: your self esteem, your ability to be a contributor in life, your relationships and sense of belonging, your feelings of safety and security, and your physiological balance.<br><br>Self Actualization isn’t a result of having gained some level of achievement in the other fundamental areas of your life. The work of continually self actualizing, is a propellent towards further improvement in all of those areas of life.<br><br>Learning and living your purpose in life, seeking education in all of its forms towards practicing the mastery of new skills and achieving the goals that support your purpose to the point where you feel genuinely fulfilled, and capable of imbuing the possibility of that level of fulfillment to others - today, tomorrow, and the next day, until your short time on this Earth has passed. That’s a self actualizing life - and you’re living it. <br><br>Keep living it. Keep sharing it.","PNU":"<i>Suggestions for improvement</i><br>You would benefit from eating better, getting more exercise, and a better night’s sleep.<br><br>If you consume alcohol, caffeine, or use recreational drugs, these substances may be affecting your ability to sleep well at night, practice mindfulness (be in the moment) during your waking hours, and exercise the following day.<br><br>Pay special attention to what you’re eating - and when, as the food you eat is providing you your base-level fuel to set and accomplish all of your other goals.<br><br>Your community is key. Work to surround yourself with people that are healthier than you, as they’ll be a good influence on your actions.<br><br>Depending on your specific circumstance you might consider working with a nutritionist, personal trainer, talk therapist, or addictions counselor if your actions regarding alcohol and/or drugs have ever caused harm to you or others, and you’ve continued to consume them."}', true);




    $SA = 0;
    $EC = 0;
    $LB = 0;
    $SN = 0;
    $PN = 0;
    foreach ($array as $key => $value) {
        if (preg_match('/Q0|Q1r|Q2r|Q3|Q4|Q5/', $key)) {
            $SA += $value * 1.6666;
        }
        if (preg_match('/Q6|Q7|Q8|Q9|Q10|Q11/', $key)) {
            $EC += $value * 1.6666;
        }
        if (preg_match('/Q12|Q13|Q14|Q15|Q16|Q17/', $key)) {
            $LB += $value * 1.6666;
        }
        if (preg_match('/Q18|Q19|Q20|Q21|Q22|Q23/', $key)) {
            $SN += $value * 1.6666;
        }
        if (preg_match('/Q24|Q25|Q26|Q27|Q28|Q29/', $key)) {
            $PN += $value * 1.6666;
        }
    }
    $master["SA"] = roundNumber($SA);
    $master["EC"] = roundNumber($EC);
    $master["LB"] = roundNumber($LB);
    $master["SN"] = roundNumber($SN);
    $master["PN"] = roundNumber($PN);

    $scoreArr["SA"] = roundNumber($SA);
    $scoreArr["EC"] = roundNumber($EC);
    $scoreArr["LB"] = roundNumber($LB);
    $scoreArr["SN"] = roundNumber($SN);
    $scoreArr["PN"] = roundNumber($PN);


    if ($master["SA"] > 59) {
        $master['SAresponse'] = $pr['SAO'];
    } else {
        $master['SAresponse'] = $pr['SAU'];
    }
    if ($master["EC"] > 59) { //
        $master['ECresponse'] = $pr['ECO'];
    } else {
        $master['ECresponse'] = $pr['ECU'];
    }
    if ($master["LB"] > 59) {
        $master['LBresponse'] = $pr['LBO'];
    } else {
        $master['LBresponse'] = $pr['LBU'];
    }
    if ($master["SN"] > 59) {
        $master['SNresponse'] = $pr['SNO'];
    } else {
        $master['SNresponse'] = $pr['SNU'];
    }
    if ($master["PN"] > 59) {
        $master['PNresponse'] = $pr['PNO'];
    } else {
        $master['PNresponse'] = $pr['PNU'];
    }
    // the next 4 lines are just for testing
    $master['nodeBoundary'] = rand(500, 1000) / 100;
    $master['proxyBindingCalc'] = rand(500, 1000) / 10;
    $master['modelSequence'] = 1.81;
    $master['queryStringLength'] = strlen($_SERVER['QUERY_STRING']);


    //$scoreArr["SA"]=23;$scoreArr["EC"]=23;$scoreArr["LB"]=23;$scoreArr["SN"]=23;$scoreArr["PN"]=23;


    $applyThirds = 0;
    if ($_COOKIE['applyThirds']) {
        $applyThirds = 1;
    }
    $applyFifths = 1;
    if ($_COOKIE['applyFifths']) {
        $applyFifths = 1;
    }

    $master['splitValue'] = $applyFifths;
    $master['version'] = "June 21, 2022";
    if ($applyThirds) {
       // $master = returnThirdResponse($scoreArr, $master);
    }
    if ($applyFifths) {
        $master = returnFifthResponse($scoreArr, $master);
    }
    // test QS https://pietential.com/pielet/calcEngine/?userID=Msl9ZeiwE5Hz&mode=calc&Q5response=3&Q1response=2&Q0response=3&Q4response=4&Q2response=1&Q3response=3&Q7response=9&Q8response=8&Q10response=7&Q6response=9&Q11response=10&Q9response=9&Q17response=4&Q13response=5&Q14response=6&Q16response=7&Q12response=7&Q15response=9&Q21response=8&Q20response=6&Q19response=3&Q22response=6&Q23response=5&Q18response=9&Q26response=9&Q28response=10&Q27response=9&Q25response=10&Q24response=9&Q29response=10
    echo json_encode($master);
}

function roundNumber($n)
{
    $n = round($n, 0, PHP_ROUND_HALF_UP);
    if ($n > 98) {
        $n = 100;
    }
    if ($n == 59 || $n == 58) {
        $n = 60;
    }
    return ($n);
}





exit($m);


// https://pietential.com/pielet/calcEngine/?userID=zGX676w1F2ry&mode=calc&Q0response=4&Q1response=9&Q2response=9&Q3response=7&Q4response=5&Q5response=9&Q6response=8&Q7response=8&Q8response=4&Q9response=9&Q10response=2&Q11response=4&Q12response=2&Q13response=5&Q14response=4&Q15response=6&Q16response=8&Q17response=5&Q18response=6&Q19response=9&Q20response=8&Q21response=8&Q22response=7&Q23response=5&Q24response=7&Q25response=5&Q26response=7&Q27response=9&Q28response=5&Q29response=10


$master = json_decode($m, true);
echo $m;
echo "\n\n";
print_r($master);
exit;
