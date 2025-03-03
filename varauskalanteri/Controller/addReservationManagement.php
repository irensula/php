<?php 

require_once "Database/Model/application.php";
require_once "Database/Model/computer.php";
require_once "../libraries/cleaner.php";

function validateDate($date) {
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}

function makeApplicationController(){
    // Handle GET request for checking availability
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['start_date'], $_GET['time'])) {
        $start_date = $_GET['start_date'];
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;
        $time = $_GET['time'];
    
        // Validate and process the parameters
        if (!validateDate($start_date)) {
            $_SESSION['message'] = "Invalid start date format.";
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        }
    
        if ($end_date && !validateDate($end_date)) {
            $_SESSION['message'] = "Invalid end date format.";
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        }
    
        $_SESSION['activeDay'] = $start_date;
        $studentID = $_SESSION["userID"];
    
        // Get available computers based on the query parameters
        $freeComputers = getFreeComputers($start_date, $end_date, $time);
    
        if (!empty($freeComputers)) {
            foreach ($freeComputers as $computer) {
                echo "<div>" . htmlspecialchars($computer['numero']) . " - " . htmlspecialchars($computer['tietoja']) . "</div>";
            }
        } else {
            echo "<p>No available computers found.</p>";
        }
    } else {
        // Render the reservation form for selection
        require "View/addReservation.view.php";
    }
    
    // Handle POST request for reservation
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $start_date = $_POST['start_date'];
        $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;
        $time = $_POST['time'];

        // Validate and process the parameters
        if (!validateDate($start_date)) {
            $_SESSION['message'] = "Invalid start date format.";
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        }

        if ($end_date && !validateDate($end_date)) {
            $_SESSION['message'] = "Invalid end date format.";
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        }

        $_SESSION['activeDay'] = $start_date;
        $studentID = $_SESSION["userID"];

        // Get available computers based on the query parameters
        $freeComputers = getFreeComputers($start_date, $end_date, $time);

        if (!empty($freeComputers)) {
            // Display the list of available computers in the view
            foreach ($freeComputers as $computer) {
                echo "<div>" . htmlspecialchars($computer['numero']) . " - " . htmlspecialchars($computer['tietoja']) . "</div>";
            }
        } else {
            echo "<p>No available computers found.</p>";
        }
        
        // Handle reservation creation after selection
        if (isset($_POST['computer'], $_POST['description'])) {
            $computerID = htmlspecialchars($_POST['computer']);
            $description = htmlspecialchars($_POST['description']);

            if (empty($end_date)) {
                $end_date = null; // Use NULL instead of empty string
            }

            function isWeekend($start_date) {
                $dayOfWeek = date('N', strtotime($start_date)); // 'N' returns 1 (Monday) through 7 (Sunday)
                return ($dayOfWeek >= 6); // 6 is Saturday, 7 is Sunday
            }

            if ($studentID && !isWeekend($start_date) && !isWeekend($end_date) && $time) {
                $conflictExists = oneComputerForOneStudent($studentID, $start_date, $end_date, $time);
                if (!$conflictExists) {
                    makeApplication($studentID, $computerID, $start_date, $end_date, $time, $description);
                    $_SESSION['message'] = "Varauksesi onnistui!";
                } else {
                    $_SESSION['message'] = "Olet jo varannut tietokoneen tähän aikaan.";    
                }
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit();
            }
        }
    }
}
