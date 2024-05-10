<?php require "partials/header.php"; ?>

<h2 class="form-title centered">Muokkaa tietosi</h2>

<div class="inputarea">

    <form  action="/update_userInfo" method="post">

        <label for="username">Nimimerkki: </label> 
        <input id="username" type="text" name="username" maxlength=30 value="<?=$username?>">

        <label for="email">Sähköposti: </label>         
        <input id="email" type="email" name="email" maxlength=30 value="<?=$email?>">

        <label for="birthyear">Syntymävuosi: </label>         
        <input id="birthyear" type="number" name="birthyear" min="1950" max="2024" value="<?=$birthyear?>">

        <label for="pword">Salasana: </label>
        <input id="pword" type="password" name="password" maxlength=25 value="<?=$password?>">

        <label for="userID"></label>
        <input id="userID" type="hidden" name="userID" maxlength=25 value="<?=$id?>">
        
        <button class="yellow-button" id="sendbutton" type="submit" value="Lähetä">Lähetä</button>
    </form>

</div>

<?php require "partials/footer.php"; ?>