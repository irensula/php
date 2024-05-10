<?php require "partials/header.php"; ?>

<h2 class="form-title centered">Rekisteröidy</h2>

<div class="inputarea">
    <form  action="/register" method="post">

        <label for="username">Nimimerkki:</label> 
        <input id="username" type="text" name="username" maxlength="30">

        <label for="email">Sähköposti:</label>         
        <input id="email" type="email" name="email" maxlength="30">

        <label for="birthyear">Syntymävuosi:</label>         
        <input id="birthyear" type="number" name="birthyear" min="1950" max="2024">

        
        <label for="pword">Salasana:</label>
        <input id="pword" type="password" name="password" maxlength="25">

        <button class="yellow-button" id="sendbutton" type="submit" value="Lähetä">Lähetä</button>
    </form>
</div>

<?php require "partials/footer.php"; ?>