<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <!-- css -->
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/styles.css">
    
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1 class="title">Tiedoston kirjoittaminen</h1>
        <form action="index.php" method="get">
            <div class="input-container">
                <label for="name">Tiedoston nimi</label><br>
                <input type="text" name="name" id="name">
            </div>
            <div class="input-container">
                <label for="text">Sisältö</label><br>
                <textarea type="text" name="text" id="text" cols="50"></textarea>
            </div>
            
            <button type="submit">Kirjoittaa</button>
        </form>
    </div>
</body>
</html>

<?php
    if(isset($_GET['name'], $_GET['text'])){
        $name = htmlspecialchars($_GET['name']);
        $text = htmlspecialchars($_GET['text']);
        $file = fopen('./temp/'.$name.'.txt', 'w');
        fwrite($file, $text);
        fclose($file);
    }
?>

<!-- $text_3 = "Text_3";
$createfile = fopen('./temp/'.'new.txt', 'w');
fwrite($createfile, $text_3);
fclose($file); -->
