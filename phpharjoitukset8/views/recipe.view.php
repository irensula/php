<?php require "partials/header.php"; ?>

<div class="recipe-page">
    <h2 class="form-title centered"><?=$name?></h2>
    <div class="flex-container"> 
        <div class="inner-image">
            <img src=".././images/<?php echo $image; ?>">
        </div>
        <div class="recipe-details">
            <p><span class="bold">Kategoria: </span><?=$category?></p>
            <h2 class="middle-title">Ainekset:</h2><p><?=$ingredients?></p>
            
        </div>
    </div>    
        <h2 class="middle-title">Valmistusohje: </h2><p><?=$preparation?></p>
        <p><span class="bold">Lisäyspäivämäärä: </span><?=$additionDate?></p>   
        
        <a href='/update_recipe?id=<?=$id?>'><i class="fa-solid fa-pen-to-square"></i></a>
        
        <a href='/print_recipe?id=<?=$id?>'><i class="fa-solid fa-print"></i></a>

        <a href='/delete_recipe?id=<?=$id?>' onClick='confirmDelete(<?=$id?>)'>
            <i class="fa-solid fa-trash"></i>
        </a>
</div>    



<?php require "partials/footer.php"; ?>