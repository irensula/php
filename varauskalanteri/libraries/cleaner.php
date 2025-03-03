<?php
function cleaner($userinput){
    $input = trim($userinput);
    $cleanInput = filter_var($input,FILTER_SANITIZE_STRING);
    return $cleanInput;
}

function hashPassword($password){
    return password_hash($password, PASSWORD_DEFAULT);
}

function cleanUpOutput($useroutput){
    $output = trim($useroutput);
    $cleanoutput = htmlspecialchars($output);
    return $cleanoutput;
}
?>