<?php 
    require_once "Task.php";
    session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>To Do List</title>
</head>
<body>

    
<div class="center-container">
    <h2>ToDo List</h2>

    <form action="index.php" method="post">
        <div class="container">
            <label for="kuvaus">Mitä haluat tehdä?</label> 
            <input type="text" name="kuvaus" id="kuvaus" maxlength=50><br>
        
            <label for="aloituspaiva">Mikä päivä?</label> 
            <input type="date" id="aloituspaiva" name="aloituspaiva" value="" min="2024-01-01" max="2024-12-31" />
        </div>   
        <button class="button-56" role="button" type="submit">Lähetä</button>
    </form>
</div>
    
    <?php
        
        if (isset($_POST['kuvaus'], $_POST['aloituspaiva'])) {
            
            $kuvaus =  ucfirst(htmlspecialchars($_POST['kuvaus']));
            $aloituspaiva = htmlspecialchars($_POST['aloituspaiva']);
            
            $tasks = array();
            $id = 0;
            $newTask = new Task($id, $kuvaus, $aloituspaiva);
            
            if (isset($_SESSION['tasksArray'])) {
                $tasks = $_SESSION['tasksArray'];
                array_push($tasks, $newTask);
                $_SESSION['tasksArray'] = $tasks;
                $tasksList = $_SESSION['tasksArray'];

                $i = 1;
                echo '<div class="tasks">';
                while($i < count((array)$tasksList)) {
                    
                    echo $i . ". " .  $tasksList[$i] . "<br>";
                    $i++;
                }
                echo '</div>'; 
            } else {
                array_push($tasks, $newTask);
                $_SESSION['tasksArray'] = $tasks;
                $tasksList = $_SESSION['tasksArray'];

                $i = 1;
                echo '<div class="tasks">';
                while($i < count((array)$tasksList)) {
                    
                    echo $i . ". " .  $tasksList[$i] . "<br>";
                    $i++;
                }
                echo '</div>'; 
            }
        }
    ?>
</body>
</html>