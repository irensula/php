<?php require "partials/header.php"; ?>

<div class = "recipes">
    <div class="up-container">
        <form class="selection-form" action="/recipes" method="POST">
            <label for="category"></label>
            <select id="category" name="category">
                <option value="Kaikki reseptit">Kaikki reseptit</option>
                <option value="aamiainen">Aamiainen</option>
                <option value="pääruoka">Pääruoka</option>
                <option value="välipala">Välipala</option>
                <option value="jälkiruoka">Jälkiruoka</option>
            </select>
            <button class="yellow-button" type="submit">Submit</button>
        </form>
        <button class="yellow-button"><a href="/add_recipe">Uusi resepti</a></button>
    </div>
    
    <?php

    foreach($allrecipes as $recipe): ?>
        
        <div class='recipe'>
            <h3><?=$recipe["name"] ?></h3>
            <p><?=$recipe["category"]?></p>
            <p><?=$recipe["ingredients"]?></p>
            <p><?=$recipe["preparation"]?></p>
            <p>By user: <?=$recipe["userName"]?></p>
            <p><?=$recipe["additionDate"]?></p>
            <?php
            if(isLoggedIn() && ($recipe["userID"] == $_SESSION["userID"])):
                $id = $recipe['recipeID'];
                $recipeId = 'deleteNews' . $id; ?>
                
                <a id=<?=$recipeId ?> onClick='confirmDelete(<?=$id?>)' href='/delete_recipe?id=<?=$id?>'>Poista</a> |

                <a href='/update_recipe?id=<?=$id?>'>Päivitä</a>
            <?php endif; ?>
            <a href='/recipe?id=<?=$recipe["recipeID"]?>'>Lue lisää</a>
        </div>
    <?php endforeach ?>
</div>

<?php require "partials/footer.php"; ?>