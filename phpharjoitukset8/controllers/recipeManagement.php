<?php
require_once "database/models/recipe.php";
require_once 'libraries/cleaners.php';

function viewRecipesController(){
    $allrecipes = null;
    if (isset($_POST['category'])) {
        $category = cleanUpInput($_POST['category']);
        $allrecipes = getCategoryRecipes($category);
        if($category == "Kaikki receptit") {
            $allrecipes = getAllRecipes();
        }
    }
    else {
        $allrecipes = getAllRecipes();
    }
    require "views/recipes.view.php";    
}

function addRecipeController(){
    if(isset($_POST['name'], $_POST['additionDate'], $_POST['category'], $_POST['ingredients'], $_POST['preparation'])){
        $name = cleanUpInput($_POST['name']);
        $category = cleanUpInput($_POST['category']);
        $ingredients = cleanUpInput($_POST['ingredients']);
        $preparation = cleanUpInput($_POST['preparation']);
        $additionDate = cleanUpInput($_POST['additionDate']);   
        $userID = $_SESSION["userID"];
        addRecipe($name, $additionDate, $category, $ingredients, $preparation, $userID); 
        header("Location: /");    
    } else {
        require "views/newRecipe.view.php";
    }
}

function editRecipeController(){
    try {
        if(isset($_GET["id"])){
            $id = cleanUpInput($_GET["id"]);
            $recipes = getRecipeById($id);
        } else {
            echo "Virhe: id puuttuu ";    
        }
    } catch (PDOException $e){
        echo "Virhe reseptista haettaessa: " . $e->getMessage();
    }
    
    if($recipes){
        $id = $recipes['recipeID'];
        $name = $recipes['name'];
        $additionDate = $recipes['additionDate'];
        $time = implode("T", explode(" ",$additionDate));
        $category = $recipes['category'];
        $ingredients = $recipes['ingredients'];
        $preparation = $recipes['preparation'];
        $id = $recipes['recipeID'];
    
        require "views/updateRecipe.view.php";
     }
    else {
        header("Location: /");
        exit;
    }
}

function updateRecipeController(){
    if(isset($_POST['name'], $_POST['additionDate'], $_POST['category'], $_POST['ingredients'], $_POST['preparation'], $_POST['id'])){
        $name = cleanUpInput($_POST['name']);
        $additionDate = cleanUpInput($_POST['additionDate']);
        $category = cleanUpInput($_POST['category']);
        $ingredients = cleanUpInput($_POST['ingredients']);
        $preparation = cleanUpInput($_POST['preparation']);
        $id = cleanUpInput($_POST["id"]);

        try{
            updateRecipe($name, $additionDate, $category, $ingredients, $preparation, $id);
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

function deleteRecipeController(){
    try {
        if(isset($_GET["id"])){
            $id = cleanUpInput($_GET["id"]);
            deleteRecipe($id);
        } else {
            echo "Virhe: id puuttuu ";    
        }
    } catch (PDOException $e){
        echo "Virhe reseptista poistettaessa: " . $e->getMessage();
    }

    $allrecipes = getAllRecipes();

    header("Location: /");
    exit;
}