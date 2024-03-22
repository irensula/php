<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="palautelomake.php" method="get">
        <label for="name">Nimesi:</label>
        <input type="text" name="name" id="name">
        <label for="grade">Arvosi:</label>
        <input type="number" name="grade" id="grade" min=1 max=5>
        <label for="feedback">Palaute</label>
        <input type="text" name="feedback" id="feedback">
        <button type="submit">Kirjoita</button>
    </form>
</body>
</html>

<?php
    
    if(isset($_GET['name'], $_GET['grade'], $_GET['feedback'])){
        $name = htmlspecialchars($_GET['name']);
        $grade = htmlspecialchars($_GET['grade']);
        $feedback = htmlspecialchars($_GET['feedback']);

        $info = array();
        array_push($info, $name, $grade, $feedback);
        
        $file = fopen("palautteet.csv", "a");
        fputcsv($file, $info, ';');
        fclose($file);
    }
    
?>