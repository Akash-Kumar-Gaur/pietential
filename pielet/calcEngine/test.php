<?php

function generateQuestions(){
    echo "<pre>";
    $c = json_decode(file_get_contents("codes.txt"));
    shuffle($c);
    echo json_encode($c);
    //print_r($c);
    
    
    foreach($c as $key => $value){
        if ($value['Part']=="Part 1"){
            $v1[] = $value;
        }
        if ($value['Part']=="Part 2"){
            $v2[] = $value;
        }
        if ($value['Part']=="Part 3"){
            $v3[] = $value;
        }
        if ($value['Part']=="Part 4"){
            $v4[] = $value;
        }
        if ($value['Part']=="Part 5"){
            $v5[] = $value;
        }
    }
    shuffle($v1);
    shuffle($v2);
    shuffle($v3);
    shuffle($v4);
    shuffle($v5);
    $collection = [$v1,$v2,$v3,$v4,$v5];
   print_r($collection) ;
    
    exit;

}
generateQuestions();



?>