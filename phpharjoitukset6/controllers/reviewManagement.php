<?php 
require_once "../database/models/review.php";
require_once '../libraries/cleaners.php';

function viewReviewsController(){
    $allReviews = null;
    if (isset($_POST['type'])) {
        $type = cleanUpInput($_POST['type']);
        $allReviews = getTypeReviews($type);
        if($type == "Kaikki tyypit") {
            $allReviews = getAllReviews();
        }
    }
    else {
        $allReviews = getAllReviews();
    }
    require "../views/review.view.php";    
}

// POST values are from "name" in views
function addReviewController(){
    if(isset($_POST['reviewName'], $_POST['reviewText'], $_POST['reviewGrade'], $_POST['type'])){
        $rName = cleanUpInput($_POST['reviewName']);
        $rText = cleanUpInput($_POST['reviewText']);
        $rGrade = cleanUpInput($_POST['reviewGrade']);
        $rType = cleanUpInput($_POST['type']);   
        $userId = $_SESSION["userid"];
        addReview($rType, $rName, $rGrade, $rText, $userId); 
        header("Location: /all_reviews");    
    } else {
        require ".././views/newReview.view.php";
    }
}

function editReviewController(){
    try {
        if(isset($_GET["id"])){
            $rId = cleanUpInput($_GET["id"]);
            $reviews = getReviewById($rId);
        } else {
            echo "Virhe: id puuttuu ";    
        }
    } catch (PDOException $e){
        echo "Virhe uutista haettaessa: " . $e->getMessage();
    }
    
    if($reviews){
        $rId = $reviews['reviewID'];
        $rType = $reviews['type'];
        $rName = $reviews['name'];
        $rGrade = $reviews['grade'];
        $rText = $reviews['text'];
        $userId = $reviews['userID'];
        require ".././views/updateReview.view.php";
    } 
    else {
        header("Location: /all_reviews");
        exit;
    }
}

function updateReviewController(){
    if(isset($_POST['reviewName'], $_POST['reviewText'], $_POST['reviewGrade'], $_POST['type'], $_POST["reviewId"])){
        $rName = cleanUpInput($_POST['reviewName']);
        $rText = cleanUpInput($_POST['reviewText']);
        $rGrade = cleanUpInput($_POST['reviewGrade']);
        $rType = cleanUpInput($_POST['type']);
        $rId = cleanUpInput($_POST["reviewId"]);

        try{
            updateReview($rType, $rName, $rGrade, $rText, $rId);
            header("Location: /all_reviews");    
        } catch (PDOException $e){
                echo "Virhe uutista päivitettäessä: " . $e->getMessage();
        }
    } 
    else {
        header("Location: /all_reviews");
        exit;
    }
}

function deleteReviewController(){
    try {
        if(isset($_GET["id"])){
            $rId = cleanUpInput($_GET["id"]);
            deleteReview($rId);
        } else {
            echo "Virhe: id puuttuu ";    
        }
    } catch (PDOException $e){
        echo "Virhe uutista poistettaessa: " . $e->getMessage();
    }

    $allReviews = getAllReviews();

    header("Location: /all_reviews");
    exit;
}





