<?php
/**
 * Ottaa yhteyden tietokantaan, palauttaa 
 * pdo-olion.
 * 13.2.2023/EM
 */
function connect() {
    $servername = "irysul23.treok.io";
    $username = "irysul23_tietovisa";
    $password = "saspiDm18&86";
    //$port = 3306;
    $dbname = "irysul23_tietovisa";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
}
// show all classes
function getAllQuestions() {
    $pdo = connect();
    $sql = "SELECT * FROM questions";
    $stm = $pdo->query($sql);
    $questions = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $questions;
}
function getAllAnswers() {
    $pdo = connect();
    // $sql = "SELECT * FROM questions";
    $sql = "SELECT questions.questionID, questionText, answers.correct,
        answers.answerText AS answerText
        FROM questions
        INNER JOIN answers ON answers.questionID = questions.questionID;";
    $stm = $pdo->query($sql);
    $answers = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $answers;
}

// get character by id
function getCharacterById($characterID){
    $pdo = connect();
    $sql = "SELECT * FROM characters WHERE characterID=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$characterID]);
    $all = $stm->fetch(PDO::FETCH_ASSOC);
    return $all;
}