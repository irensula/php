<?php require "header.php"; ?>

<body id="index-body">
    <div class="container">
        <h1 class="title">Tiedoston kirjoittaminen</h1>
        <form action="index.php" method="get">
            <div class="input-container">
                <label for="name">Tiedoston nimi</label><br>
                <input class="input-index" type="text" name="name" id="name">
            </div>
            <div class="input-container">
                <label for="text">Sisältö</label><br>
                <textarea type="text" name="text" id="text" cols="60" rows="10"></textarea>
            </div>
            
            <button class="button-orange" role="button" type="submit">Kirjoittaa</button>
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
