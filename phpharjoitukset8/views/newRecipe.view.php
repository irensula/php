<?php require "partials/header.php"; ?>

<h2 class="centered">Syötä uutinen</h2>

<div class="inputarea">
    <form  action="/add_recipe" method="post">
        <label for="name">Nimi:</label>
        <input id="name" type="name" name="name" maxlength=50 value="">
        
        <label for="category">Valitse osasto:</label>
        <select id="category" name="category">
            <option value="aamiainen">Aamiainen</option>
            <option value="pääruoka">Pääruoka</option>
            <option value="välipala">Välipala</option>
            <option value="jälkiruoka">Jälkiruoka</option>
        </select>
        
        <label for="ingredients">Ainesosaluettelo:</label>
        <textarea id="ingredients" name="ingredients" rows="5" cols="30"></textarea>

        <label for="preparation">Valmistusohje:</label>
        <textarea id="preparation" name="preparation" rows="5" cols="30"></textarea>
        
        <label for="additionDate">Lisäyspäivämäärä:</label>
        <input id="additionDate" type="datetime-local"  name="additionDate" value=""> 
        
        <input id="sendbutton" type="submit" value="Lähetä">
        
    </form>
</div>

<?php require "partials/footer.php"; ?>