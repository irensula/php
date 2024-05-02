<?php require "header.php"; ?>

<body id="tapahtumat-body">
    <div class="tapahtumat-container">
        <h1 class="title">Rekisteröityminen</h1>
        <form class="tapahtumat-form" action="tapahtumat.php" method="get">
            
            <label for="name">Nimi:</label>
            <input class="input-index" type="text" name="name" id="name" maxlength=30><br>

            <label for="email">Sähköpostiosoite:</label>
            <input class="input-index" type="text" name="email" id="email" maxlength=30><br>

            <label for="phone">Puhelinnumero:</label>
            <input class="input-index" type="text" name="phone" id="phone"><br>

            <label for="company">Yritys:</label>
            <input class="input-index" type="text" name="company" id="company"><br>

            <label for="text">Esittelyteksti:</label>
            <input class="input-index" type="text" name="text" id="text">

            <fieldset>
                <legend>Valitse roolisi:</legend>
                    <div>
                        <input class="input-radio" type="radio" id="radioChoice1" name="radioChoice" value="performer" />
                        <label for="radioChoice1">Esiintyjä</label>

                        <input class="input-radio" type="radio" id="radioChoice2" name="radioChoice" value="organizer" />
                        <label for="radioChoice2">Järjestäjä</label>

                        <input class="input-radio" type="radio" id="radioChoice3" name="radioChoice" value="visitor" />
                        <label for="radioChoice3">Vierailija</label>
                </div>
            </fieldset>

            <button class="button-orange" type="submit">Lähetä</button>
        </form>
    </div>
    </body>
</html>
        <?php
            if(isset($_GET['name'], $_GET['email'], $_GET['phone'], $_GET['company'], $_GET['text'], $_GET['radioChoice'])){
                $name = htmlspecialchars($_GET['name']);
                $email = htmlspecialchars($_GET['email']);
                $phone = htmlspecialchars($_GET['phone']);
                $company = htmlspecialchars($_GET['company']);
                $text = htmlspecialchars($_GET['text']);
                $role = htmlspecialchars($_GET['radioChoice']);
                $info = "Nimi: " . $name . PHP_EOL .
                "Sähköpostiosoite: " . $email . PHP_EOL .
                "Puhelinnumero: " . $phone . PHP_EOL .
                "Yritys: " . $company . PHP_EOL .
                "Esittelyteksti: " . $text . PHP_EOL .
                "Rooli: " . $role . PHP_EOL . PHP_EOL;

                echo "Tarkistathan tietosi ja paina sitten “Lähetä” - nappia.<br>";
                echo "<p class='participants-info'>$info</p>";
                echo '<form action="tapahtumat.php" method="get">
                        <label for="info"></label>
                        <input type="submit" class="button-orange" value="Lähetä" name="info">
                    </form>';
                
                    
                    $file = fopen('participants.txt', 'a');
                    fwrite($file, $info);
                    fclose($file); 
                
            } 
        ?>
