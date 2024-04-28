<?php

function cleanDump($data){
    echo "<pre>";
    var_dump($data); // var_dump - displays structured information about one or more expressions that includes its type and value
    echo "</pre>";
}

function cleanUpInput($userinput){
    $input = trim($userinput); // trim - remove characters from both sides of a string
    $cleaninput = filter_var($input,FILTER_SANITIZE_STRING);
    return $cleaninput;
}

function cleanUpOutput($useroutput){
    $output = trim($useroutput);
    $cleanoutput = htmlspecialchars($output);
    return $cleanoutput;
}


