<?php
require_once "../database/connection.php";

function getAllRecipes(){
    $pdo =connectDB();
    $sql = "SELECT recipeID, name, additionDate, category, ingredients, preparation, recipes.userID, username AS userName
    FROM recipes
    INNER JOIN users ON users.userID = recipes.userID;";
    $stm = $pdo->query($sql);
    $all = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $all;
}

function addRecipe($name, $additionDate, $category, $ingredients, $preparation, $userID){
    $pdo =connectDB();
    $data = [$name, $additionDate, $category, $ingredients, $preparation, $userID];
    $sql = "INSERT INTO recipes (name, additionDate, category, ingredients, preparation, userID) VALUES(?,?,?,?,?,?)";
    $stm=$pdo->prepare($sql);
    return $stm->execute($data);
}

function getRecipeById($id){
    $pdo = connectDB();
    $sql = "SELECT * FROM recipes WHERE recipeID=?";
    $stm= $pdo->prepare($sql);
    $stm->execute([$id]);
    $all = $stm->fetch(PDO::FETCH_ASSOC);
    return $all;
}

function deleteRecipe($id){
    $pdo = connectDB();
    $sql = "DELETE FROM recipes WHERE recipeID=?";
    $stm=$pdo->prepare($sql);
    return $stm->execute([$id]);
}

function updateRecipe($name, $additionDate, $category, $ingredients, $preparation, $recipeID){
    $pdo = connectDB();
    $data = [$name, $additionDate, $category, $ingredients, $preparation, $recipeID];
    $sql = "UPDATE recipes SET name = ?, additionDate = ?, category = ?, ingredients = ?, preparation = ? WHERE recipeID = ?";
    $stm = $pdo->prepare($sql);
    return $stm->execute($data);
}

function getCategoryRecipes($category){
    $pdo = connectDB();
    $sql = "SELECT * FROM recipes WHERE category = ?";
    $stm=$pdo->prepare($sql);
    $stm->execute(array($category));
    $all = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $all;
} 