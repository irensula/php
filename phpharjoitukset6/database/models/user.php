<?php
require_once "../database/connection.php";

function addUser($username, $password){
    $pdo = connectDB();
    $hashedpassword = hashPassword($password);
    $data = [$username, $hashedpassword];
    $sql = "INSERT INTO user (username, pwd) VALUES(?,?)";
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function login($username, $password){
    $pdo = connectDB();
    $sql = "SELECT * FROM user WHERE username=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$username]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    $hashedpassword = $user["pwd"];

    if($hashedpassword && password_verify($password, $hashedpassword))
        return $user;
    else 
        return false;
}