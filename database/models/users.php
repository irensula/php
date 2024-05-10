<?php
require_once "../database/connection.php";
// *** unique email
function uniqueEmail($email) {
    $pdo = connectDB();
    $sql = "SELECT COUNT(email) AS EmailCount FROM users WHERE email = 'test@gmail.com';";
    $stm= $pdo->prepare($sql);
    $stm->execute([$email]);
    $all = $stm->fetch(PDO::FETCH_ASSOC);
    return $all;
}

// PDO instantiation here
function uniqueEmailSO($email) {
    $pdo = connectDB();
    $stmt = $pdo->prepare('SELECT COUNT(email) AS EmailCount FROM users WHERE email = :email');
    $stmt->execute(array('email' => $_POST['email']));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['EmailCount'] == 0) {
        $stmt = $pdo->prepare('INSERT INTO emails (email) VALUES (:email)');
        $stmt->execute(array('email' => $_POST['email']));
        echo 'Thank you for Submitting. Redirecting back to Home Page';
    } else {
        echo 'E-mail exists!';
    }
}

// unique email ***

function addUser($username, $password, $email, $birthyear){
    $pdo = connectDB();
    $hashedpassword = hashPassword($password);
    $data = [$username, $hashedpassword, $email, $birthyear];
    $sql = "INSERT INTO users (username, password, email, birthyear) VALUES(?,?,?,?)";
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function login($username, $password){
    $pdo = connectDB();
    $sql = "SELECT * FROM users WHERE username=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$username]);
    $user = $stm->fetch(PDO::FETCH_ASSOC);
    $hashedpassword = $user["password"];

    if($hashedpassword && password_verify($password, $hashedpassword))
        return $user;
    else 
        return false;
}

function getUserById($id){
    $pdo = connectDB();
    $sql = "SELECT * FROM users WHERE userID=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$id]);
    $all = $stm->fetch(PDO::FETCH_ASSOC);
    return $all;
}

function updateUserInfo($username, $password, $email, $birthyear, $userID){
    $pdo = connectDB();
    $data = [$username, $password, $email, $birthyear, $userID];
    $sql = "UPDATE users SET username = ?, password = ?, email = ?, birthyear = ? WHERE userID = ?";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}
