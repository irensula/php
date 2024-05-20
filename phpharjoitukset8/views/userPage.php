<?php require "partials/header.php"; ?>

<?php

    if(isLoggedIn() && ($_SESSION["userID"])):

        $userID = $_SESSION["userID"]; ?>

        <div class="own-page-container">
            <h2 class="form-title">Tietosi</h2>
            <div class="info">
                <p id="username"><span class="bold">Nimimerkki: </span><?=$userInfo["username"]?></p> 
                <p id="email"><span class="bold">Sähköposti: </span><?=$userInfo["email"]?></p>         
                <p id="birthyear own-page-p"><span class="bold">Syntymävuosi: </span><?=$userInfo["birthyear"]?></p>
            </div>
                                  
            <a class="yellow-button" href='/update_userInfo?id=<?=$userID?>'>Päivitä tietosi</a>

        </div>
<?php endif; ?>

<?php require "partials/footer.php"; ?>