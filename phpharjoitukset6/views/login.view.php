<?php require "../partials/header.php"; ?>
<div class="form-container">
    <h1>Kirjaudu</h1>

    <form action="/login" method="post">
        <label for="username">Kirjoita nimesi:</label>
        <input type="text" name="username" id="username">

        <label for="password">Kirjoita salasasi:</label>
        <input type="password" name="password" id="password">

        <button class="yellow-button">Lähetä</button>
    </form>
</div>
</body>
</html>

<?php require "../partials/footer.php"; ?>