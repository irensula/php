<?php require "../Partials/header.php"; ?>

<div class="container">
    <div class="info-wrap">
        <p class="title greeting">Hei, <?php echo htmlspecialchars($_SESSION["name"]); ?>!</p>
    
        <p class="info">Infoteksti <?= htmlspecialchars($infoText['content']) ?></p>

        <a href="/add_application"><button class="button bookbutton">Varata tietokone</button></a>
    </div>
    <div class="main-image"></div>
</div>

    <?php require "../Partials/footer.php"; ?>