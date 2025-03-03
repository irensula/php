<?php

require_once "Database/connection.php";

function getAllComputers(){
    $pdo =connect();
    $sql = "SELECT * FROM tietokone";
    $stm = $pdo->query($sql);
    $all = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $all;
}

function getComputerByID($id){
    $pdo =connect();
    $sql = "SELECT * FROM `tietokone` WHERE `tietokoneID` = ?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $computer = $stm->fetch(PDO::FETCH_ASSOC);
    return $computer;
}

function getAllmoods(){
    $pdo = connect();
    $sql = "SELECT * FROM `tila`";
    $stm = $pdo->query($sql);
    $all = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $all;
}

function innerJoinMoodsInComputers(){
    $pdo = connect();
    $sql = "SELECT `tietokone`.`tietokoneID`, `tietokone`.`numero`, `tietokone`.`tietoja`, `tietokone`.`tilaID`, `tila`.`tietokoneentila` FROM `tietokone` 
    INNER JOIN tila ON `tietokone`.`tilaID`=`tila`.`tilaID`;";
    $stm = $pdo->query($sql);
    $all = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $all;
}

function updateComputerMood($tietokoneID, $tilaID){
    $pdo = connect();
    $sql = "UPDATE `tietokone` SET `tilaID` = ? WHERE `tietokoneID` = ?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$tilaID, $tietokoneID]);
}