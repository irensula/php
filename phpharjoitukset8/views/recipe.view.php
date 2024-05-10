<?php require "partials/header.php"; ?>

<div class="recipe-page">
    <h2 class="form-title centered"><?=$name?></h2>
    <p><span class="bold">Kategoria: </span><?=$category?></p>
    <h2 class="middle-title">Ainekset:</h2><p><?=$ingredients?></p>
    <h2 class="middle-title">Valmistusohje: </h2><p><?=$preparation?></p>
    <p><span class="bold">Lisäyspäivämäärä: </span><?=$additionDate?></p>   
    <button class="yellow-button" id="sendbutton" type="submit" value="Lähetä"><a href='/update_recipe?id=<?=$id?>'>Päivitä</a></button>
    <button>Tulosta</button>
</div>

<?php require "partials/footer.php"; ?>