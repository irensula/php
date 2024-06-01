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

function getQuestionById($questionID){
    $pdo = connect();
    $sql = "SELECT * FROM quiz WHERE quizID=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$questionID]);
    $all = $stm->fetch(PDO::FETCH_ASSOC);
    return $all;
}
// function getTenQuestions() {
//     $pdo = connect();
    
//     $numbers = range(1, 15);
//     shuffle($numbers);
//     $random_numbers = array_slice($numbers, 0, 10);
//     $newnumbers = implode(", ", $random_numbers);

//     $sql = "SELECT * FROM quiz WHERE quizID IN ($newnumbers);";
//     $stm = $pdo->query($sql);
//     $questions = $stm->fetchAll(PDO::FETCH_ASSOC);
//     return $questions;
// }
function getTenQuestions() {
    $pdo = connect();
    
    $numbers = range(1, 15);
    shuffle($numbers);
    $random_numbers = array_slice($numbers, 0, 10);
    $newnumbers = implode(", ", $random_numbers);

    $sql = "SELECT * FROM questions WHERE questionID IN ($newnumbers);";
    $stm = $pdo->query($sql);
    $questions = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $questions;
}
function getAllQuestions() {
    $pdo = connect();
    $sql = "SELECT * FROM questions";
    $stm = $pdo->query($sql);
    $questions = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $questions;
}
function getAllAnswers() {
    $pdo = connect();
    $sql = "SELECT questions.questionID, questionText, answers.correct, answers.answerID, answers.questionID, 
    answers.answerText AS answerText
    FROM questions
    INNER JOIN answers ON answers.questionID = questions.questionID;";
    $stm = $pdo->query($sql);
    $answers = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $answers;
}
function getQuestionById2($questionID){
    $pdo = connect();
    $sql = "SELECT questions.questionID, questionText, answers.correct, answers.answerID,
    answers.answerText AS answerText
    FROM questions
    INNER JOIN answers ON answers.questionID = questions.questionID
    WHERE questionID=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$questionID]);
    $all = $stm->fetch(PDO::FETCH_ASSOC);
    return $all;
}
function rightAnswer($answerID){
    $pdo = connect();
    $sql = "SELECT answerText FROM answers
    INNER JOIN questions ON questions.questionID = answers.questionID
    WHERE correct = 1 AND
    questions.questionID = ?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$answerID]);
    $all = $stm->fetch(PDO::FETCH_ASSOC);
    return $all;
}