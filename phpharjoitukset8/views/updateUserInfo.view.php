<?php require "partials/head.php"; ?>

<h2 class="centered">Muokkaa tietosi</h2>

<div class="inputarea">

<form  action="/update_userInfo" method="post">

    <label for="username">Nimimerkki:</label> 
    <input id="username" type="text" name="username" maxlength=30>

    <label for="email">Sähköposti:</label>         
    <input id="email" type="email" name="email" maxlength=30>

    <label for="birthyear">Syntymävuosi:</label>         
    <input id="birthyear" type="number" name="birthyear" min="1950" max="2024">

    <label for="pword">Salasana:</label>
    <input id="pword" type="password" name="password" maxlength=25>

    <input id="sendbutton" type="submit" value="Lähetä">
</form>
</div>

<?php require "partials/footer.php"; ?>