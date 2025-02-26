<?php
require_once ".././database/models/user.php";
require_once ".././libraries/cleaners.php";

function registerController(){
    if(isset($_POST['username'], $_POST['password'])){
        $username = cleanUpInput($_POST['username']);
        $password = cleanUpInput($_POST['password']);

        try {
            addUser($username, $password);
            header("Location: /login"); 
        } catch (PDOException $e){
            echo "Virhe tietokantaan tallennettaessa: " . $e->getMessage();
        }
    } 
    else { 
        require "../views/registration.view.php";
    }
}

function loginController(){
    if(isset($_POST['username'], $_POST['password'])){
        $username = cleanUpInput($_POST['username']);
        $password = cleanUpInput($_POST['password']);
  
        $result = login($username, $password);
        if($result){
            $_SESSION['username'] = $result['username'];
            $_SESSION['userid'] = $result['userID'];
            $_SESSION['session_id'] = session_id();
            header("Location: /all_reviews"); 
        } 
    }
        else {
            require "../views/login.view.php";
        }
}

function logoutController(){
    session_unset(); //poistaa kaikki muuttujat
    session_destroy();
    setcookie(session_name(),'',0,'/'); //poistaa evästeen selaimesta
    session_regenerate_id(true);
    header("Location: /login"); // forward eli uudelleenohjaus
    die();
}