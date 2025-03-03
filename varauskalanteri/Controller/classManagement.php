<?php 
require_once "Database/Model/class.php";
require_once "../libraries/cleaner.php";

function classController() {
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_POST['className'], $_POST['classDescription'])) {
        $className = htmlspecialchars($_POST['className']);
        $classDescription = htmlspecialchars($_POST['classDescription']);
        $addClass = addClass($className, $classDescription);
        if($addClass) {
            $_SESSION['message'] = "Luokka on lisätty!";
        } else {
            $_SESSION['message'] = "Jotakin meni väärin.";
        }   
        header('Location: /classes');
        exit();
    }
    // delete class
    if(isset($_GET['id'])) {
        $classID = intval($_GET["id"]);
        deleteClass($classID);
        header('Location: /classes');
        exit();
    } 
    
    /* pagination */
    // Get current page number from the URL, default to 1 if not set
    $page = isset($_GET['page-nr']) ? (int)$_GET['page-nr'] : 1;

    // Ensure the page number is valid
    if ($page < 1) {
        $page = 1;
    }
        $rows_per_page = 4;
        $total_rows = getTotalRows();  // Fetch total number of rows from the database
        $pages = ceil($total_rows / $rows_per_page);
        $start = ($page - 1) * $rows_per_page;
    
    // search class
    $searchQuery = '';
    if (isset($_GET['search'])) {
        $searchQuery = trim($_GET['search']);
    }
    // fetch classes based on whether a search query is present
    if($searchQuery != '') {
        $paginatedClasses = searchClasses($searchQuery, $start, $rows_per_page);
    } else {
        $paginatedClasses = getAllClasses($start, $rows_per_page);
        
    }
    
    require "View/class.view.php";
}

function editClassController() {
    try {
        if(isset($_GET['classID'])) {
            $classID = intval($_GET['classID']);
            $class = getClassById($classID);
        } else {
            echo "Virhe: id puuttuu";
        }
    } catch (PDOException $e) {
        echo "Virhe luokasta haettaessa: " . $e->getMessage();
    }

    if($class) {
        $classID = $class['luokkaID'];
        $className = $class['luokantunnus'];
        $classDescription = $class['kuvaus'];

        require "View/editClass.view.php";
    } else {
        header('Location: /classes');
        exit;
    }
}

function updateClassController() {
    if(isset($_POST['className'], $_POST['classDescription'], $_POST['classID'])) {
        $className = htmlspecialchars($_POST['className']);
        $classDescription = htmlspecialchars($_POST['classDescription']);
        $classID = intval($_POST['classID']);
        try {
            $updateClass = updateClass($className, $classDescription, $classID);
            if($updateClass) {
                $_SESSION['message'] = "Luokka on muokattu!";
            } else {
                $_SESSION['message'] = "Jotakin meni väärin.";
            }   
            header('Location: /classes');
            exit;
        } catch (PDOException $e) {
            echo "Virhe luokasta päivitettäessä: " . $e->getMessage();
        }
    } else {
        header('Location: /classes');
        exit;
    }
}