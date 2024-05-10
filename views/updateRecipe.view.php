<?php require "partials/header.php"; ?>

<h2 class="centered">Muokkaa resepti</h2>

<div class="inputarea">
<form  action="/update_recipe" method="post" >
    <label for="name">Nimi:</label>
    <input id="name" type="name" name="name" maxlength=50 value="<?=$name?>">
    
    <label for="category">Valitse osasto:</label>
    <select id="category" name="category" class="category-update">
        <option value="aamiainen">Aamiainen</option>
        <option value="pääruoka">Pääruoka</option>
        <option value="välipala">Välipala</option>
        <option value="jälkiruoka">Jälkiruoka</option>
    </select><br>
    
    <label for="ingredients">Ainesosaluettelo:</label>
    <textarea id="ingredients" name="ingredients" rows="10" cols="30" ><?=$ingredients?></textarea>

    <label for="preparation">Valmistusohje:</label>
    <textarea id="preparation" name="preparation" rows="10" cols="30" ><?=$preparation?></textarea>
    
    <label for="additionDate">Lisäyspäivämäärä:</label>
    <input id="additionDate" type="datetime-local"  name="additionDate" value="<?=$additionDate?>">    
    
    <button class="yellow-button" id="sendbutton" type="submit" value="Lähetä">Lähetä</button>
</form>
</div>

<?php require "partials/footer.php"; ?>