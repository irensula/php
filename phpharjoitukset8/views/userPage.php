<?php require "partials/header.php"; ?>

<h2 class="centered">Tietosi</h2>

<?php

    if(isLoggedIn() && ($_SESSION["userID"])):

        $userID = $_SESSION["userID"]; ?>

        <div class="centered">

            <p id="username">Nimimerkki:<?=$userInfo["username"]?></p> 
            <p id="email">Sähköposti:<?=$userInfo["email"]?></p>         
            <p id="birthyear">Syntymävuosi:<?=$userInfo["birthyear"]?></p>
                      
            <a href='/update_userInfo?id=<?=$userID?>'>Päivitä tietosi</a>

        </div>
<?php endif; ?>

<?php require "partials/footer.php"; ?>