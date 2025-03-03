<?php
require_once "../Database/connection.php";

function getAllClasses($start = 0, $rows_per_page = 4) {
    $pdo = connect(); 
    $query = "SELECT * FROM luokka LIMIT :start, :rows_per_page";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':rows_per_page', $rows_per_page, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getTotalRows() {
    $pdo = connect();
    $query = "SELECT COUNT(*) as total FROM luokka";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];  // Return the total number of rows
}

function searchClasses($searchQuery, $start, $rows_per_page) {
    $pdo = connect();
    if($searchQuery != '') {
        $query = 'SELECT * FROM luokka WHERE luokantunnus LIKE :searchQuery LIMIT :start, :rows_per_page';
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%', PDO::PARAM_STR);
    } else {
        $query = 'SELECT * FROM luokka LIMIT :start, :rows_per_page';
        $stmt = $pdo->prepare($query);
    }
    $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
    $stmt->bindValue(':rows_per_page', (int)$rows_per_page, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addClass($className, $classDescription) {
    $pdo = connect();
    $data = [$className, $classDescription];
    $sql = "INSERT INTO luokka (luokantunnus, kuvaus) VALUES(?, ?)";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}

function getClassById($classID){
    $pdo = connect ();
    $sql = "SELECT * FROM luokka WHERE luokkaID = ?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$classID]);
    $all = $stm->fetch(PDO::FETCH_ASSOC);
    return $all;
}

function updateClass($className, $classDescription, $classID){
    $pdo = connect ();
    $data = [$className, $classDescription, $classID];
    $sql = "UPDATE luokka SET luokantunnus = ?, kuvaus = ? WHERE luokkaID = ?";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}

function deleteClass($classID){
    $pdo = connect ();
    $sql = "DELETE FROM luokka WHERE luokkaID = ?";
    $stm=$pdo->prepare($sql);
    return $stm->execute([$classID]);
}

// origin
// function getAllClasses(){
//     $pdo = connect();
//     $sql = "SELECT * FROM `luokka` ORDER BY luokantunnus";
//     $stm = $pdo->query($sql);
//     $all = $stm->fetchAll(PDO::FETCH_ASSOC);
//     return $all;
// }