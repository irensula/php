<?php require "../Partials/header.php"; ?>

<?php if ($class): ?>

<div class="container-wide">
    <h2 class="title">Muokkaa luokka</h2>
    <form method="POST" action="/update_class">
        <label class="label" for="className">Luokan tunnus:</label>
        <input class="input" type="text" id="className" name="className" value="<?=$class['luokantunnus']?>" required>

        <label class="label" for="classDescription">Luokan kuvaus:</label>
        <input class="input" type="text" id="classDescription" name="classDescription" value="<?=$class['kuvaus']?>" required>

        <input class="input" type="hidden" id="classID" name="classID" value="<?=$class['luokkaID']?>" required>

        <button class="button" type="submit">Talenna muutokset</button>
    </form>
</div>

<?php endif; ?>

<?php require "../Partials/footer.php"; ?>