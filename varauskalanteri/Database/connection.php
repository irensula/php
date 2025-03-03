<?php
function connect(){
    $servername = "projekti23b.treok.io";
    $username = "projekti23b_user";
    $password = "Ilmoita123!";
    //$port = 1045;
    $dbname = "projekti23b_ilmoittautumis";
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo"Yhdistetty onnistenuusti"."\n";
        return $conn;
    }catch(PDOException $e){
        echo "Yhdistys epäonnistui: " .$e->getMessage();
        die();
    }
}