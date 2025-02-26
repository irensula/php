<?php
require_once "../database/connection.php";

function getAllReviews(){
    $pdo = connectDB();
    $sql = "SELECT reviewID, date, type, name, grade, text, review.userID, user.username AS userName
    FROM review 
    INNER JOIN user ON 
    review.userID = user.userID;";
    $stm = $pdo->query($sql);
    $all = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $all;
}

// function arguments are variables from addReviewController
function addReview($rType, $rName, $rGrade, $rText, $userId){
    $pdo =connectDB();
    date_default_timezone_set('UTC'); // get date automatically
    $rDate = date('Y-m-d'); // get date automatically
    $data = [$rDate, $rType, $rName, $rGrade, $rText, $userId];
    $sql = "INSERT INTO review (date, type, name, grade, text, userID) VALUES(?,?,?,?,?,?)";
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function getReviewById($rID){
    $pdo = connectDB();
    $sql = "SELECT * FROM review WHERE reviewID=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$rID]);
    $all = $stm->fetch(PDO::FETCH_ASSOC);
    return $all;
}

function deleteReview($rID){
    $pdo = connectDB();
    $sql = "DELETE FROM review WHERE reviewID=?";
    $stm=$pdo->prepare($sql);
    return $stm->execute([$rID]);
}

function updateReview($rType, $rName, $rGrade, $rText, $rId){
    $pdo = connectDB();
    date_default_timezone_set('UTC'); // get date automatically
    $rDate = date('Y-m-d'); // get date automatically
    $data = [$rDate, $rType, $rName, $rGrade, $rText, $rId];
    $sql = "UPDATE review SET date = ?, type = ?, name = ?, grade = ?, text = ? WHERE reviewID = ?";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}

function getReviewType($rType){
    $pdo =connectDB();
    $sql = "SELECT * FROM review WHERE type = ?";
    $stm=$pdo->prepare($sql);
    $stm->execute(array($rType));
    $all = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $all;
} 