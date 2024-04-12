<?php
require_once "database/models/users.php";
require_once 'libraries/cleaners.php';

function registerController(){
    if(isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['birthyear'])){
        $username = cleanUpInput($_POST['username']);
        $password = cleanUpInput($_POST['password']);
        $email = cleanUpInput($_POST['email']);
        $birthyear = cleanUpInput($_POST['birthyear']);
        

        try {
            addUser($username, $password, $email, $birthyear);
            header("Location: /login"); 
        } catch (PDOException $e){
            echo "Virhe tietokantaan tallennettaessa: " . $e->getMessage();
        }
    } else {
        require "views/register.view.php";
    }
}

function loginController(){
    if(isset($_POST['username'], $_POST['password'])){
        $username = cleanUpInput($_POST['username']);
        $password = cleanUpInput($_POST['password']);
  
        $result = login($username, $password);
        if($result){
            $_SESSION['username'] = $result['username'];
            $_SESSION['userID'] = $result['userID'];
            $_SESSION['session_id'] = session_id();
            header("Location: /"); 
        } else {
            require "views/login.view.php";
        }
    } else {
        require "views/login.view.php";
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
///////////////////////
function viewUserPageController(){
    if(isset($_SESSION['userID'])){
        $id = $_SESSION['userID'];
        $userInfo = getUserById($id);
        require "views/userPage.php";    
    }
}

function editUserInfoController(){
    try {
        if(isset($_GET["id"])){
            $id = cleanUpInput($_GET["id"]);
            $user = getUserById($id);
        } else {
            echo "Virhe: id puuttuu ";    
        }
    } catch (PDOException $e){
        echo "Virhe reseptista haettaessa: " . $e->getMessage();
    }
    
    if($user){
        $id = $user['userID'];
        $name = $user['username'];
        $password = $user['password'];
        $email = $user['email'];
        $birthyear = $user['birthyear'];
    
        require "views/updateUserInfo.view.php";
     }
    else {
        header("Location: /");
        exit;
    }
}

function updateUserInfoController(){
    if(isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['birthyear'])){
        $username = cleanUpInput($_POST['username']);
        $password = cleanUpInput($_POST['password']);
        $email = cleanUpInput($_POST['email']);
        $birthyear = cleanUpInput($_POST['birthyear']);
        $id = cleanUpInput($_POST["id"]);

        try{
            updateUserInfo($username, $password, $email, $birthyear, $id);
            header("Location: /");    
        } catch (PDOException $e){
                echo "Virhe reseptista päivitettäessä: " . $e->getMessage();
        }
     } 
    else {
        header("Location: /");
        exit;
    }
}
