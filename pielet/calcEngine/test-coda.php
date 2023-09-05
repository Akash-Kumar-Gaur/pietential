<?php

function generateQuestions()
{
    echo "<pre>";
    $c = json_decode(file_get_contents("coda.txt"), true);
    //shuffle($c);
    //echo json_encode($c);
    //print_r($c);


    foreach ($c as $key => $value) {

        if ($value['Part'] == "Part 1") {
            $v1[] = assignRandomQuestion($value);
        }
        if ($value['Part'] == "Part 2") {
            $v2[] = assignRandomQuestion($value);
        }
        if ($value['Part'] == "Part 3") {
            $v3[] = assignRandomQuestion($value);
        }
        if ($value['Part'] == "Part 4") {
            $v4[] = assignRandomQuestion($value);
        }
        if ($value['Part'] == "Part 5") {
            $v5[] = assignRandomQuestion($value);
        }
    }
    shuffle($v1);
    shuffle($v2);
    shuffle($v3);
    shuffle($v4);
    shuffle($v5);




    $collection = [$v1, $v2, $v3, $v4, $v5];
    print_r($collection);

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


generateQuestions();
