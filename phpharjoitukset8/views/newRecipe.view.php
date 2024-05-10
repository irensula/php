<?php require "partials/header.php"; ?>

<h2 class="form-title centered">Syötä resepti</h2>

<div class="inputarea">
    <form  action="/add_recipe" method="post">
        <label for="name">Nimi:</label>
        <input id="name" type="name" name="name" maxlength="50">
        
        <label for="category">Valitse osasto:</label>
        <select id="category" name="category">
            <option value="aamiainen">Aamiainen</option>
            <option value="pääruoka">Pääruoka</option>
            <option value="välipala">Välipala</option>
            <option value="jälkiruoka">Jälkiruoka</option>
        </select><br>
        
        <label for="ingredients">Ainesosaluettelo:</label>
        <textarea id="ingredients" name="ingredients" rows="10" cols="30"></textarea>

        <label for="preparation">Valmistusohje:</label>
        <textarea id="preparation" name="preparation" rows="10" cols="30"></textarea>
        
        <label for="additionDate">Lisäyspäivämäärä:</label>
        <input id="additionDate" type="datetime-local"  name="additionDate" value=""> 
        
        <label for="fileToUpload" class="img-label">Valitse kuva</label>
        <input type="file" name="fileToUpload" id="fileToUpload">

        <button class="yellow-button" id="sendbutton" type="submit" value="Lähetä" name="submit">Lähetä</button>
        
    </form>
</div>

<?php require "partials/footer.php"; ?>