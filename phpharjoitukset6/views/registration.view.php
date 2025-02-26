<?php require "../partials/header.php"; ?>

    <div class="form-container">
        <h1>Rekisetröidy</h1>

        <form action="/registration" method="post">
            <label for="username">Kirjoita nimesi:</label>
            <input type="text" name="username" id="username">

            <label for="password">Kirjoita salasasi:</label>
            <input type="password" name="password" id="password">

            <button class="yellow-button">Lähetä</button>
        </form>
    </div>

<?php require "../partials/footer.php"; ?>