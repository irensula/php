<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Rekisteröityminen</h1>
    <form action="tapahtumat.php" method="get">
        
        <label for="name">Nimi:</label>
        <input type="text" name="name" id="name" maxlength=30><br>

        <label for="email">Sähköpostiosoite:</label>
        <input type="text" name="email" id="email" maxlength=30><br>

        <label for="phone">Puhelinnumero:</label>
        <input type="text" name="phone" id="phone">

        <label for="company">Yritys:</label>
        <input type="text" name="company" id="company">

        <label for="text">Esittelyteksti:</label>
        <input type="text" name="text" id="text">

        <fieldset>
            <legend>Valitse roolisi:</legend>
                <div>
                    <input type="radio" id="radioChoice" name="radioChoice" value="performer" />
                    <label for="radioChoice">Esiintyjä</label>

                    <input type="radio" id="radioChoice" name="radioChoice" value="organizer" />
                    <label for="radioChoice">Järjestäjä</label>

                    <input type="radio" id="radioChoice" name="radioChoice" value="visitor" />
                    <label for="radioChoice">Vierailija</label>
            </div>
        </fieldset>

        <input type="submit" value="Lähetä">
    </form>

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
            echo $info;
            echo "<button>Lähetä</button>";
            
            $file = fopen('participants.txt', 'a');
            fwrite($file, $info);
            fclose($file);
        }    
    ?>
</body>
</html>