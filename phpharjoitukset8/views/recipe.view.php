<?php require "partials/header.php"; ?>

<div class="recipe-page">
    <h2 class="form-title centered"><?=$name?></h2>

    <?php
    $imageDirectory = '../public/images/';

    // Get all files in the directory
    $files = scandir($imageDirectory);

    // Remove . and .. from the list
    $files = array_diff($files, array('.', '..'));?>
    <div class='row'>
        
    <?php
    // Loop through each file and display as an image
    foreach ($files as $file) {
        // Check if it's an image file 
        if (in_array(pathinfo($file, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', 'gif', 'avif'))) {
            
            echo '<img src="' . $imageDirectory . $file . '" alt="' . $file . '" width="300">'; 
        }
    }
    ?>
    </div>

    <p><span class="bold">Kategoria: </span><?=$category?></p>
    <h2 class="middle-title">Ainekset:</h2><p><?=$ingredients?></p>
    <h2 class="middle-title">Valmistusohje: </h2><p><?=$preparation?></p>
    <p><span class="bold">Lisäyspäivämäärä: </span><?=$additionDate?></p>   
    <button class="yellow-button" id="sendbutton" type="submit" value="Lähetä"><a href='/update_recipe?id=<?=$id?>'>Päivitä</a></button>
    <button>Tulosta</button>
</div>

<?php require "partials/footer.php"; ?>