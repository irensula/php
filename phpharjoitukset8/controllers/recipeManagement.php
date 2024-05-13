<?php
require_once "database/models/recipe.php";
require_once 'libraries/cleaners.php';

function viewRecipesController(){
    $allrecipes = null;
    if (isset($_POST['category'])) {
        $category = cleanUpInput($_POST['category']);
        $allrecipes = getCategoryRecipes($category);
        if($category == "Kaikki reseptit") {
            $allrecipes = getAllRecipes();
        }
    }
    else {
        $allrecipes = getAllRecipes();
    }
    require "views/recipes.view.php";    
}
function viewRecipeController() {
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
        $image = $recipes['image'];
        $id = $recipes['recipeID'];
    
        require "views/recipe.view.php";
     }
    else {
        header("Location: /recipes");
        exit;
    }
}

// function addRecipeController(){
//     if(isset($_POST['name'], $_POST['additionDate'], $_POST['category'], $_POST['ingredients'], $_POST['preparation'], $_POST['image'])){
//         $name = cleanUpInput($_POST['name']);
//         $category = cleanUpInput($_POST['category']);
//         $ingredients = cleanUpInput($_POST['ingredients']);
//         $preparation = cleanUpInput($_POST['preparation']);
//         $additionDate = cleanUpInput($_POST['additionDate']);
//         $image = cleanUpInput($_POST['image']);   
//         $userID = $_SESSION["userID"];
//         addRecipe($name, $additionDate, $category, $ingredients, $preparation, $image, $userID); 
//         header("Location: /recipes");    
//     } else {
//         require "views/newRecipe.view.php";
//     }
// }

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
        $image = $recipes['image'];
        $id = $recipes['recipeID'];
    
        require "views/updateRecipe.view.php";
     }
    else {
        header("Location: /recipes");
        exit;
    }
}

function updateRecipeController(){
    if(isset($_POST['name'], $_POST['additionDate'], $_POST['category'], $_POST['ingredients'], $_POST['preparation'], $_POST['image'], $_POST['id'])){
        $name = cleanUpInput($_POST['name']);
        $additionDate = cleanUpInput($_POST['additionDate']);
        $category = cleanUpInput($_POST['category']);
        $ingredients = cleanUpInput($_POST['ingredients']);
        $preparation = cleanUpInput($_POST['preparation']);
        $image = $recipes['image'];
        $id = cleanUpInput($_POST["id"]);

        try{
            updateRecipe($name, $additionDate, $category, $ingredients, $preparation, $image, $id);
            header("Location: /recipes");    
        } catch (PDOException $e){
                echo "Virhe reseptista päivitettäessä: " . $e->getMessage();
        }
     } 
    else {
        header("Location: /recipes");
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

    header("Location: /recipes");
    exit;
}


//  UPLOADING IMAGES
if(isset($_FILES["fileToUpload"])) {
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "<div class='img-message'>";
        echo "File is an image - " . $check["mime"] . ".";
        echo "</div>";
        $uploadOk = 1;
      } else {
        echo "<div class='img-message'>";
        echo "File is not an image.";
        echo "</div>";
        $uploadOk = 0;
      }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "<div class='img-message'>";
      echo "Sorry, file already exists.";
      echo "</div>";
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 2000000) {
      echo "<div class='img-message'>";
      echo "Sorry, your file is too large.";
      echo "</div>";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "avif" ) {
      echo "<div class='img-message'>";
      echo "Sorry, only JPG, JPEG, PNG, AVIF & GIF files are allowed.";
      echo "</div>";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "<div class='img-message'>";
      echo "Sorry, your file was not uploaded.";
      echo "</div>";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<div class='img-message'>";
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        echo "</div>";
      } else {
        echo "<div class='img-message'>";
        echo "Sorry, there was an error uploading your file.";
        echo "</div>";
      }
    }
      }
function addRecipeController(){
        if(isset($_POST['name'], $_POST['additionDate'], $_POST['category'], $_POST['ingredients'], $_POST['preparation'], $_FILES["fileToUpload"])){
            
            
            $name = cleanUpInput($_POST['name']);
            $category = cleanUpInput($_POST['category']);
            $ingredients = cleanUpInput($_POST['ingredients']);
            $preparation = cleanUpInput($_POST['preparation']);
            $additionDate = cleanUpInput($_POST['additionDate']);
            $image = cleanUpInput($_FILE['fileToUpload']);   
            $userID = $_SESSION["userID"];


            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
        echo "<div class='img-message'>";
        echo "File is an image - " . $check["mime"] . ".";
        echo "</div>";
        $uploadOk = 1;
      } else {
        echo "<div class='img-message'>";
        echo "File is not an image.";
        echo "</div>";
        $uploadOk = 0;
      }
    }
    
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "<div class='img-message'>";
      echo "Sorry, file already exists.";
      echo "</div>";
      $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 2000000) {
      echo "<div class='img-message'>";
      echo "Sorry, your file is too large.";
      echo "</div>";
      $uploadOk = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "avif" ) {
      echo "<div class='img-message'>";
      echo "Sorry, only JPG, JPEG, PNG, AVIF & GIF files are allowed.";
      echo "</div>";
      $uploadOk = 0;
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "<div class='img-message'>";
      echo "Sorry, your file was not uploaded.";
      echo "</div>";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<div class='img-message'>";
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        echo "</div>";
      } else {
        echo "<div class='img-message'>";
        echo "Sorry, there was an error uploading your file.";
        echo "</div>";
      }
    }
            addRecipe($name, $additionDate, $category, $ingredients, $preparation, $image, $userID); 
            header("Location: /recipes");    
        } else {
            require "views/newRecipe.view.php";
        }
    }    