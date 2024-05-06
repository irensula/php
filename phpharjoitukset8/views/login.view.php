<?php require "partials/header.php"; ?>

<h2 class="form-title centered">Login</h2>

<div class="inputarea">
    <form  action="/login" method="post">
        <label for="username">Käyttäjänimi:</label>
        <input id="username" type="text" name="username" maxlength=30>

        <label for="pword">Salasana:</label>
        <input id="pword" type="password" name="password" maxlength=30>
        
        <button class="yellow-button" id="sendbutton" type="submit" value="Lähetä">Lähetä</button>
    </form>
</div>

<?php require "partials/footer.php"; ?>